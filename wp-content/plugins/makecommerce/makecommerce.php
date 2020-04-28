<?php
/*
	Plugin Name: MakeCommerce for WooCommerce
	Description: Adds MakeCommerce payment gateway and Itella/Omniva parcel machine shipping methods to Woocommerce checkout
	Version: 2.5.5
	Author: Maksekeskus AS
	Author URI: https://MakeCommerce.net/
	Text Domain: wc_makecommerce_domain
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

include_once(ABSPATH.'wp-admin/includes/plugin.php');
if (is_plugin_active('woocommerce/woocommerce.php')) {

	define('WC_MC_VERSION', 2.0);

	$enable_experimental = get_option('mk_checkout_sco', 'no');
	if ($enable_experimental === 'yes') {
		require_once(__DIR__.'/makecommerce-simplecheckout.php');
	}
	require_once(__DIR__.'/makecommerce-transport.php');
	require_once(__DIR__.'/makecommerce-payment.php');

	if (is_admin() && !extension_loaded('curl')) {
		add_action('admin_notices', function(){
			$class = 'notice notice-error';
			$message = __( 'You have enabled MakeCommerce module but it seems that you don\'t have CURL enabled. This way MakeCommerce unfortunately does not work!', 'wc_makecommerce_domain');
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
		});
	}


	global $mkDbTable;
	$mkDbTable = 'mc_banklinks';

	function mc_install() {
		global $wpdb;
		global $mkDbTable;
		
		$tableName = $wpdb->prefix . $mkDbTable;
			
		$charset = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE $tableName (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			type varchar(10) NOT NULL,
			country char(2) NOT NULL,
			name varchar(25) NOT NULL,
			url varchar(250) NOT NULL,
                        logo_url varchar(250),
                        min_amount mediumint(9),
                        max_amount mediumint(9),
			UNIQUE KEY id (id)
		) $charset;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	register_activation_hook( __FILE__, 'mc_install' );

	// On uninstall remove scheduled hook
	function mc_uninstall() {
		if (wp_next_scheduled ( 'mc_banklinks_update_cron' )) {
			wp_clear_scheduled_hook('mc_banklinks_update_cron');
	    }
	}

	register_deactivation_hook(__FILE__, 'mc_uninstall');

	// WP schedule callable action
	add_action('mc_banklinks_update_cron', 'update_mc_banklinks');
	// Assign schedule if not set, update compatible no need to reactivate, format('U') php 5.2 compatible
	// Assigns task at 23.59.59 by local time, task runs if time has passed and somebody navigates the site
	if (! wp_next_scheduled ( 'mc_banklinks_update_cron' )) {
		$date = new DateTime();
		$date->setTime(04,10,00);
		$timestamp = intval($date->format('U'));
		//$local = 3600 * intval(get_option('gmt_offset'));
		//wp_schedule_event($timestamp - $local, 'twicedaily', 'mc_banklinks_update_cron');
		wp_schedule_event($timestamp, 'twicedaily', 'mc_banklinks_update_cron');
    }

	if (!class_exists('wc_makecommerce_domain')) {
		require_once('includes/vendor/autoload.php');
	 	require_once('includes/Maksekeskus.php');
	}

	function mk_check_payment() {	

		global $woocommerce;
		$api = mk_get_api();

		$returnUrl = home_url();
		
		$request = stripslashes_deep($_POST);
		if ($api->verifyMac($request)) {
			$data = $api->extractRequestData($request);
			$reference = false;

			if (!empty($data['error']) ) {
				wc_add_notice(__('Payment failed', 'wc_makecommerce_domain'), 'error');
				return $returnUrl;
			}

			if (!empty($data['message_type']) ) {
				if ($data['message_type'] == 'payment_return') {
						$transactionId = $data['transaction'];
						$reference = $data['reference'];
						$paymentStatus = $data['status'];
				}
				if ($data['message_type'] == 'token_return') {
					if (!empty($data['transaction']['reference'])) {
						$reference = $data['transaction']['reference'];
					}	
					$paymentStatus = $data['transaction']['status'];
					$transactionId = $data['transaction']['id'];
					
					// for API backward compatibility - if we didn't find reference in the mesage, or the transaction state vas still PENDING
					// we'll fetch the transaction data from API, and make a payment request if needed	
					// this all can be removed after 2017-jan
					if (!$reference or $paymentStatus == 'PENDING') {  
						$transaction = $api->getTransaction($transactionId);
						if (!empty($transaction->reference)) {
							$reference = $transaction->reference;
						}		

						$paymentStatus = $transaction->status;
						
						if ($paymentStatus == 'PENDING') {
							$paymentRequest = array(
								'amount' => (string)sprintf("%.2f", $transaction->amount), 
								'currency' => $transaction->currency,
								'token' => $data['token']['id']
								);
							$payment = $api->createPayment($transactionId, $paymentRequest);
							// TODO: validate
							$paymentStatus = $payment->transaction->status;
						}
			
					}						
				

				}
				
			} 
		}

		// if we didn't find reference to an Order, we send user to shop landing-page. TODO: could be improved	
		if (!$reference) { return $returnUrl; }

		$order = new WC_Order($reference);
		// if we din't find the Order, we send user to shop landing-page. TODO: could be improved
		if (!$order->get_order_number()) { return $returnUrl; }

		$returnUrl = $order->get_checkout_order_received_url();

		switch($paymentStatus) {

			case 'CANCELLED':
				$order->update_status( 'cancelled' );
				wc_add_notice(__('Payment transaction cancelled', 'wc_makecommerce_domain'), 'error');
				$returnUrl = $woocommerce->cart->get_cart_url();
				break;

			case 'COMPLETED':
				$orderNote = array();
				$orderNote[] = __('Transaction ID', 'wc_makecommerce_domain') . ': <a target=_blank href="'.$api->getEnvUrls()->merchantUrl.'/merchant/shop/deals/detail.html?id='. $transactionId .'">'.$transactionId.'</a>';
				$orderNote[] = __('Payment option', 'wc_makecommerce_domain') . ': ' . get_post_meta($order->get_order_number(), '_makecommerce_preselected_method', true);
				$order->add_order_note(implode("\r\n", $orderNote));
				if (!empty($data['token']) && !empty($data['token']['multiuse'])) {
					update_post_meta($order->get_order_number(), '_makecommerce_payment_token', $data['token']['id']);
					update_post_meta($order->get_order_number(), '_makecommerce_payment_token_valid_until', $data['token']['valid_until']);
				}
				
				$order->payment_complete( $transactionId );
				// $order->update_status( 'processing' );
				$woocommerce->cart->empty_cart();
				break;

		}

		return $returnUrl;
	}




	$MKAPI = false;
	function mk_get_api() {
		global $MKAPI;
		if ($MKAPI) {
			//return $MKAPI;
		}
		$mk_api_type = get_option('mk_api_type', false);
		if (!$mk_api_type) {
			return false;
		}
		if ($mk_api_type !== 'live') {
			$key_prefix     = $mk_api_type.'_';
		} else {
			$key_prefix = '';
		}
		$mk_shop_id     = get_option('mk_'.$key_prefix.'shop_id', '');
		$mk_public_key  = get_option('mk_'.$key_prefix.'public_key', '');
		$mk_private_key = get_option('mk_'.$key_prefix.'private_key', '');
		if (!$mk_shop_id || !$mk_public_key || !$mk_shop_id) {
			return false;
		}
		$MKAPI = new \Maksekeskus\Maksekeskus($mk_shop_id, $mk_public_key, $mk_private_key, $mk_api_type === 'live' ? false : true);
		return $MKAPI;
	}

	function mk_is_api_set() {
		$mk_api_type = get_option('mk_api_type', false);
		if (!$mk_api_type) {
			return false;
		}
		if ($mk_api_type !== 'live') {
			$key_prefix     = $mk_api_type.'_';
		} else {
			$key_prefix = '';
		}
		$mk_shop_id     = get_option('mk_'.$key_prefix.'shop_id', '');
		$mk_public_key  = get_option('mk_'.$key_prefix.'public_key', '');
		$mk_private_key = get_option('mk_'.$key_prefix.'private_key', '');
		if (!$mk_shop_id || !$mk_public_key || !$mk_shop_id) {
			return false;
		}
		return true;
	}


	function mk_admin_error() {
		printf( '<div class="%1$s"><p>%2$s</p></div>', 'notice notice-error', __('Please check that you have configured correctly MakeCommerce API accesses', 'wc_makecommerce_domain')); 
	}



	add_filter('query_vars', 'mk_cron_query_vars');
	add_action('parse_request', 'mk_parse_cron_update_vars');

	function mk_cron_query_vars($vars) {
		$vars[] = 'mk-action';
		$vars[] = 'mk-shop-id';
		$vars[] = 'mk-test-shop-id';
    	return $vars;
	}

	function mk_parse_cron_update_vars($wp) {
		if (array_key_exists('mk-action', $wp->query_vars) && $wp->query_vars['mk-action'] == 'mk-update' 
			&& (array_key_exists('mk-shop-id', $wp->query_vars) || array_key_exists('mk-test-shop-id', $wp->query_vars) ) ) {
			if( (strlen($wp->query_vars['mk-shop-id']) && $wp->query_vars['mk-shop-id'] == get_option('mk_shop_id', false) )
				|| (strlen($wp->query_vars['mk-test-shop-id']) && $wp->query_vars['mk-test-shop-id'] == get_option('mk_test_shop_id', false) ) ) {
				update_mc_banklinks();
				exit();
			}
		}
	}

	function mk_admin_login_update($user_login, $user) {
	    if(user_can( $user, 'administrator' )) {
	    	update_mc_banklinks();
	    }
	}
	add_action('wp_login', 'mk_admin_login_update', 10, 2);



	function mk_admin_add_api_settings($sections) { 
		$sections['mk_api'] = __('MakeCommerce API access', 'wc_makecommerce_domain');
		return $sections;
	}

	function mk_admin_api_settings($settings) {
		global $current_section;
		if ($current_section !== 'mk_api') {
			return $settings;
		}
		return array(
			array('type' => 'title', 'desc' => __get_logo_html()),
			array(
				'type' => 'title', 
				'title' => __('MakeCommerce API access credentials', 'wc_makecommerce_domain'), 
				'desc' => __('To use MakeCommerce/Maksekeskus services you need to enter API credentials below here <br/> <br/>', 'wc_makecommerce_domain').
									sprintf( __('To further configure the Payment methods please go to <a href=."%s">MakeCommerce Checkout Options</a>, links to settings of our Shipment methods are listed below', 'wc_makecommerce_domain'), 'admin.php?page=wc-settings&tab=checkout&section=makecommerce'),
				'id' => 'mk_api_settings'
			),
			array(
			        'type' => 'select',
			        'title' => __('Current environment', 'wc_makecommerce_domain'),
			        'desc' => __('See more about <a href="https://maksekeskus.ee/en/for-developers/test-environment/">MakeCommerce Test environment</a>', 'wc_makecommerce_domain'),
			        'default' => 'live',
			        'options' => array(
					        'live' => __('Live', 'wc_makecommerce_domain'),
					        'test' => __('Test', 'wc_makecommerce_domain'),
		        			),
				'id' => 'mk_api_type'
			),
		      	array(
			        'id' => 'mk_shop_id',
			        'type' => 'text',
			        'title' => __('Shop ID (live)', 'wc_makecommerce_domain'),
			        'desc' => __('Get it from <a href="https://merchant.maksekeskus.ee/api.html" target="_blank">Merchant Portal</a>','wc_makecommerce_domain'), 
			        'class' => 'input-text regular-input',
		      	),
		      	array(
			        'id' => 'mk_private_key',
			        'type' => 'text',
			        'title' => __('Secret key (live)', 'wc_makecommerce_domain'),
			        'class' => 'input-text regular-input',
		      	),		      	
		      	array(
			        'id' => 'mk_public_key',
			        'type' => 'text',
			        'title' => __('Publishable key (live)', 'wc_makecommerce_domain'),
			        'class' => 'input-text regular-input',
		      	),
		      	array(
			        'id' => 'mk_test_shop_id',
			        'type' => 'text',
			        'title' => __('Shop ID (test)', 'wc_makecommerce_domain'),
			        'class' => 'input-text regular-input',
			        'default' => 'f64b4f20-5ef9-4b7b-a6fa-d623d87f0b9c',
			        'desc' => __('Get it from <a href="https://merchant-test.maksekeskus.ee/api.html" target="_blank">Merchant Portal Test</a>','wc_makecommerce_domain'), 
		      	),		      	
		      	array(
			        'id' => 'mk_test_private_key',
			        'type' => 'text',
			        'title' => __('Secret key (test)', 'wc_makecommerce_domain'),
			        'default' => 'MPjcVMoRZPAucsTuGK5ZukOlV7BlzgSvXOowJUkk9IFSQPVooRwcVOxzz3mhEpgM',
			        'class' => 'input-text regular-input',
		      	),
		      	array(
			        'id' => 'mk_test_public_key',
			        'type' => 'text',
			        'title' => __('Publishable key (test)', 'wc_makecommerce_domain'),
			        'default' => '7Hog41ci2mKkmtviMycWxpNx14pNP70m',
			        'class' => 'input-text regular-input',
		      	),
				array('type' => 'sectionend', 'id' => 'mk_api_settings'),
				array(
					'type' => 'title',
					'desc' => '<br><hr><br>',
				),	
				array(
					'id' => 'mk_module_title',
					'type' => 'title',
					'title' => __('Makecommerce modules', 'wc_makecommerce_domain'),
					'desc' => __('Our plugin adds several modules to your shop. Here you can switch off modules that are not important for you, they will disappear from Woocommerce settings menus.<br> Each active module have their own settings dialog, where they must also be Enabled before use.', 'wc_makecommerce_domain'),
					'class' => '',
				),
		      	array(
			        'id' => 'mk_transport_apt_omniva',
			        'type' => 'checkbox',
					'default' => 'yes',
			        'title' => __('Omniva Parcel Machine', 'wc_makecommerce_domain'),
			        'desc' => __('enable Omniva parcel machines shipping method', 'wc_makecommerce_domain').' ('. sprintf(__('<a href="%s">module settings</a>', 'wc_makecommerce_domain'), admin_url('admin.php?page=wc-settings&tab=shipping&section=parcelmachine_omniva')).')',
			        'class' => '',
		      	),
		      	array(
			        'id' => 'mk_transport_apt_smartpost',
			        'type' => 'checkbox',
					'default' => 'yes',
			        'title' => __('SmartPOST Parcel Machine', 'wc_makecommerce_domain'),
			        'desc' => __('enable SmartPOST parcel machines shipping method', 'wc_makecommerce_domain').' ('. sprintf(__('<a href="%s">module settings</a>', 'wc_makecommerce_domain'), admin_url('admin.php?page=wc-settings&tab=shipping&section=parcelmachine_smartpost')).')',
			        'class' => '',
		      	),
		      	array(
			        'id' => 'mk_transport_apt_dpd',
			        'type' => 'checkbox',
					'default' => 'no',
			        'title' => __('DPD Pickup Network', 'wc_makecommerce_domain'),
			        'desc' => __('enable DPD Pickup network shipping method', 'wc_makecommerce_domain').' ('. sprintf(__('<a href="%s">module settings</a>', 'wc_makecommerce_domain'), admin_url('admin.php?page=wc-settings&tab=shipping&section=parcelmachine_dpd')).')',
			        'class' => '',
		      	),
		      	array(
			        'id' => 'mk_transport_courier_omniva',
			        'type' => 'checkbox',
					'default' => 'yes',
			        'title' => __('Omniva Courier', 'wc_makecommerce_domain'),
			        'desc' => __('enable Omniva courier shipping method', 'wc_makecommerce_domain').' ('. sprintf(__('<a href="%s">module settings</a>', 'wc_makecommerce_domain'), admin_url('admin.php?page=wc-settings&tab=shipping&section=courier_omniva')).')',			        
			        'class' => '',
		      	),
		      	array(
			        'id' => 'mk_transport_courier_smartpost',
			        'type' => 'checkbox',
					'default' => 'yes',
			        'title' => __('SmartPOST Courier', 'wc_makecommerce_domain'),
			        'desc' => __('enable SmartPOST courier shipping method', 'wc_makecommerce_domain').' ('. sprintf(__('<a href="%s">module settings</a>', 'wc_makecommerce_domain'), admin_url('admin.php?page=wc-settings&tab=shipping&section=courier_smartpost')).')',			        
			        'class' => '',
		      	),
		      	array(
			        'id' => 'mk_checkout_sco',
			        'type' => 'checkbox',
			        'title' => __('SimpleCheckout', 'wc_makecommerce_domain'),
			        'desc' => __('enable SimpleCheckout&trade; Checkout method', 'wc_makecommerce_domain').' ('. sprintf(__('<a href="%s">module settings</a>', 'wc_makecommerce_domain'), admin_url('admin.php?page=wc-settings&tab=checkout&section=makecommerce_sc')).')',			        
			        'class' => '',
		      	),
		      	array(
			        'id' => 'mk_javascript_ui',
			        'type' => 'api_javascript_ui',
		      	),
			array('type' => 'sectionend', 'id' => 'mk_api_settings')
		);
	}
	
	function mk_wc_version($version) {
		global $woocommerce;
		if ( version_compare( $woocommerce->version, "3.4.0", ">=" ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function mk_admin_save_api_settings() {
		// reload banklinks
		global $current_section;
		if ($current_section !== 'mk_api') {
			return;
		}
		update_mc_banklinks();
	}

	function mk_admin_plugin_settings_link($links) {
	        if (mk_wc_version("3.4.0"))
			$settings_link = '<a href="admin.php?page=wc-settings&tab=advanced&section=mk_api">API '.__('Settings').'</a>';
		else
			$settings_link = '<a href="admin.php?page=wc-settings&tab=api&section=mk_api">API '.__('Settings').'</a>';
		array_unshift($links, $settings_link);
		return $links;
	}
	// if (mk_wc_version("3.4.0")) {
	add_filter('woocommerce_get_settings_advanced', 'mk_admin_api_settings', 10, 2);
	add_action('woocommerce_get_sections_advanced', 'mk_admin_add_api_settings');
	add_filter('woocommerce_get_settings_api', 'mk_admin_api_settings', 10, 2);
	// } else {
	add_action('woocommerce_get_sections_api', 'mk_admin_add_api_settings');
	add_action('woocommerce_settings_saved', 'mk_admin_save_api_settings', 30, 0);
	add_filter("plugin_action_links_".plugin_basename(__FILE__), 'mk_admin_plugin_settings_link' );
	// }

	function __get_logo_html() {
		return '<div class="makecommerce-info">'.
			'<div class="makecommerce-logo">'.
			'<a target="_blank" href="http://maksekeskus.ee"><img src="'. plugins_url('/images/makecommerce_logo_en.svg', __FILE__) .'" class="makecommerce-logo"></a>'.
			'</div>'.
			'<div class="makecommerce-links">'.
			'<div class="makecommerce-link"><a target="_blank" href="https://merchant.maksekeskus.ee">Merchant Portal</a></div>'.
			'<div class="makecommerce-link"><a target="_blank" href="https://makecommerce.net/">makecommerce.net</a></div>'.
			'<div class="makecommerce-link"><a target="_blank" href="http://maksekeskus.ee">maksekeskus.ee</a></div>'.
			'</div>'.
			'</div>';
	}
}
