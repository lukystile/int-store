<?php

/**
 * SimpleCheckout functionality
 */


function sc_return_trigger($vars) {
	$vars[] = 'mc_cart_to_order';
	$vars[] = 'mc_calculate_shipment';
	$vars[] = 'mc_cart_update';
	$vars[] = 'mc_cart_id';
	$vars[] = 'mc_nonce';
	return $vars;
}
function sc_return_trigger_check() {
	if (intval(get_query_var('mc_cart_to_order')) === 1) {
		$cart_info = json_decode(file_get_contents('php://input'));
		global $wpdb;
		$tmp_order = $wpdb->get_row("select content, order_id from {$wpdb->prefix}woocommerce_makecommerce_sc where cart_id = '{$cart_info->cartId}'");
		if (!$tmp_order) {
			error_log('no such cart');
			echo json_encode(array('code' => -1));
			exit;
		}
		$tmp_cart = new WC_Cart();
		$tmp_order->content = json_decode($tmp_order->content);
		$content = !empty($tmp_order->content->order) ? $tmp_order->content->order : $tmp_order->content;
		$coupons = !empty($tmp_order->content->coupons) ? $tmp_order->content->coupons : array();
		foreach ($content as $item_row) {
			$tmp_cart->add_to_cart($item_row->id, $item_row->qty);
		}
		if ($tmp_order->order_id) {
			$order = new WC_Order($tmp_order->order_id);
		} else {
			$order = wc_create_order();
			foreach ($content as $item_row) {
				$product_id = !empty($item_row->var) ? $item_row->var : $item_row->id;
				if (function_exists('wc_get_product')) {
					$item_id = $order->add_product(wc_get_product($product_id), $item_row->qty);
				} else {
					$item_id = $order->add_product(get_product($product_id), $item_row->qty);
				}
			}
			$order->calculate_totals();
			$free_shipping = 0;
			foreach ($coupons as $coupon) {
				$coupon = new WC_Coupon($coupon);
				$amount = $coupon->get_amount();
				if ($coupon->is_type('percent')) {
					$amount = $order->get_total() / 100 * $amount;
				}
				if (method_exists($order, 'add_item')) {
					$item = new WC_Order_Item_Coupon();
					$item->set_props(array(
						'code' => $coupon->get_code(),
						'discount' => $amount,
						'discount_tax' => 0
					));
					$order->add_item($item);
				} else {
					//$order->add_code($coupon->get_code(), $amount);
				}
				if ((method_exists($coupon, 'get_free_shipping') && $coupon->get_free_shipping()) || $coupon->free_shipping) { $free_shipping = true; }
			}
		}
		$payment_method = new woocommerce_makecommerce();
		$order->set_payment_method($payment_method);
		$billing_address = array(
			'first_name' => $cart_info->customer->firstname,
			'last_name'  => $cart_info->customer->lastname,
			'email'      => $cart_info->customer->email,
			'phone'      => $cart_info->customer->phone,
		);
		$shipping_address = $billing_address;
		$shipment_method = false;
		if (!empty($cart_info->invoiceAddress)) {
			$invoice = $cart_info->invoiceAddress;
			$billing_address['company'] = '';
			if (!empty($invoice->firstname)) { $billing_address['first_name'] = $invoice->firstname; }
			if (!empty($invoice->lastname)) { $billing_address['last_name'] = $invoice->lastname; }
			if (!empty($invoice->country)) { $billing_address['country'] = $invoice->country; }
			if (!empty($invoice->county)) { $billing_address['state'] = $invoice->county; }
			if (!empty($invoice->city)) { $billing_address['city'] = $invoice->city; }
			if (!empty($invoice->street1)) { $billing_address['address_1'] = $invoice->street1; }
			if (!empty($invoice->street2)) { $billing_address['address_2'] = $invoice->street2; }
			if (!empty($invoice->postalCode)) { $billing_address['postcode'] = $invoice->postalCode; }
			if (!empty($invoice->legalName)) { $billing_address['company'] .= $invoice->legalName; }
			if (!empty($invoice->registryCode)) { $billing_address['company'] .= ' ' . $invoice->registryCode; }
			if (!empty($invoice->vatNum)) { $billing_address['company'] .= ' ' . $invoice->vatNum; }
		}
		if (!empty($cart_info->shipmentAddress)) {
			$shipment = $cart_info->shipmentAddress;
			if (!empty($shipment->country)) { $shipment_address['country'] = $shipment->country; }
			if (!empty($shipment->county)) { $shipment_address['state'] = $shipment->county; }
			if (!empty($shipment->city)) { $shipment_address['city'] = $shipment->city; }
			if (!empty($shipment->street1)) { $shipment_address['address_1'] = $shipment->street1; }
			if (!empty($shipment->street2)) { $shipment_address['address_2'] = $shipment->street2; }
			if (!empty($shipment->postalCode)) { $shipment_address['postcode'] = $shipment->postalCode; }
			if (!empty($shipment->firstname)) { $shipment_address['first_name'] = $shipment->firstname; }
			if (!empty($shipment->lastname)) { $shipment_address['last_name'] = $shipment->lastname; }
		}
		if (!empty($cart_info->shipmentMethod)) {
			$shipment_details = $cart_info->shipmentMethod;
			$zones = WC_Shipping_Zones::get_zones();
			$continents = WC()->countries->get_continents();
			$supported_methods = array('parcelmachine_omniva' => 'APT', 'parcelmachine_smartpost' => 'APT', 'parcelmachine_dpd' => 'APT', 'courier_omniva' => 'COU', 'courier_smartpost' => 'COU', 'local_pickup' => 'OTH', 'flat_rate' => 'COU');
			foreach ($zones as $zone) {
				if ($shipment_method) { continue; }
				foreach ($zone['shipping_methods'] as $method) {
					if ($shipment_method) { continue; }
					if (empty($supported_methods[$method->id])) { continue; }
					if ($supported_methods[$method->id] === $shipment_details->type && (empty($shipment_details->carrier) || strtoupper($method->carrier) === $shipment_details->carrier)) {
						foreach ($zone['zone_locations'] as $location) {
							if ($location->type === 'continent' && !empty($continents[$location->code])) {
								if (in_array($shipment->country, $continents[$location->code]['countries'])) {
									$shipment_method = $method;
								}
							} else if ($location->type === 'state') {
								list($country, $state) = explode(':', $location->code);
								if ($country === $shipment->country) {
									$shipment_method = $method;
								}
							} else if ($shipment->country === $location->code) {
								$shipment_method = $method;
							}
						}
					}
				}
			}
		}
		$order->set_address($billing_address, 'billing');
		if (empty($shipment_address)) {
			$order->set_address($billing_address, 'shipping');
		} else {
			$order->set_address($shipment_address, 'shipping');
		}
		$order->remove_order_items('shipping');
		if ($shipment_method) {
			$package = $tmp_cart->get_shipping_packages();
			if (!empty($package)) { $package = $package[0]; }
			$price_int = $shipment_method->get_rates_for_package($package);
			$price_int = get_rate_without_taxes($shipment_method->id.':'.$shipment_method->instance_id, $price_int);
			$price = !empty($cart_info->shipmentMethod->amount) ? (double)$cart_info->shipmentMethod->amount : 0;
			//if (round($price_int,2) != round($price,2)) { error_log('Price does not match ['.round($price,2).'] vs ['.round($price_int,2).']'); exit; }
			if ($free_shipping) $price = $price_int = 0;
			$rate = new WC_Shipping_Rate($shipment_method->id.':'.$shipment_method->instance_id, !empty($shipment_method->name_ext) ? $shipment_method->name_ext : $shipment_method->method_title, $price_int, array(), $shipment_method->id.':'.$shipment_method->instance_id);
			if (class_exists('WC_Order_Item_Shipping')) {
				$item = new WC_Order_Item_Shipping();
				$item->set_order_id($order->get_id());
				$item->set_shipping_rate($rate);
				$shipping_id = $item->save();
			} else {
				$order->add_shipping($rate);
			}
			if (!empty($shipment_method->type) && $shipment_method->type === 'apt') {
				$machine = mk_get_machine(strtolower($shipment_method->carrier), $shipment->destinationId);
				if ($machine) {
					update_post_meta($order->get_id(), '_shipping_first_name', get_post_meta($order->get_id(), '_billing_first_name', true));
					update_post_meta($order->get_id(), '_shipping_last_name', get_post_meta($order->get_id(), '_billing_last_name', true));
					update_post_meta($order->get_id(), '_shipping_address_1', sanitize_text_field($machine['name']));
					update_post_meta($order->get_id(), '_shipping_address_2', sanitize_text_field($machine['address']));
					update_post_meta($order->get_id(), '_shipping_city', sanitize_text_field($machine['city']));
					update_post_meta($order->get_id(), '_shipping_postcode', '');
					update_post_meta($order->get_id(), '_parcel_machine', strtolower($shipment_method->carrier).'||'.$shipment->destinationId);
				}
			}
		}
		update_post_meta($order->get_id(), '_makecommerce_sc_cart_id', $cart_info->cartId);
		$order->calculate_totals();
		if (!empty($tmp_order->content->discount)) { $order->set_discount_total($tmp_order->content->discount); error_log($tmp_order->content->discount); }
		if (!empty($tmp_order->content->discount_tax)) { $order->set_discount_tax($tmp_order->content->discount_tax); error_log($tmp_order->content->discount_tax); }
		$order->set_total($order->get_total() - ($order->get_discount_total() + $order->get_discount_tax()));
		$order->save();
		$wpdb->update($wpdb->prefix.'woocommerce_makecommerce_sc', array('status' => 1, 'order_id' => $order->get_id(), 'modified' => time()), array('cart_id' => $cart_info->cartId));
		$locale = get_locale();
		if ($locale) { $locale = explode('_', $locale); $locale = !empty($locale[1]) ? strtolower($locale[1]) : strtolower($locale[0]); }
		$locale = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : $locale;
		$response = array(
			'cartId' => $cart_info->cartId,
			'reference' => (string)$order->get_id(),
			'locale' => $locale,
			'transactionUrl' => array(
				'returnUrl' => array(
					'url' => site_url('/?mc_cart_update=1'),
					'method' => 'POST'
				),
				'cancelUrl' => array(
					'url' => site_url('/?mc_cart_update=2'),
					'method' => 'POST'
				),
				'notificationUrl' => array(
					'url' => site_url('/?mc_cart_update=3'),
					'method' => 'POST'
				),
			)
		);
		header('Content-type: application/json');
		echo json_encode($response);
		exit;
	}
	if (intval(get_query_var('mc_calculate_shipment')) === 1) {
		$cart_info = json_decode(file_get_contents('php://input'));
		header('Content-type: application/json');
		echo json_encode(array('amount' => 2.99));
	}
	if (intval(get_query_var('mc_cart_update')) > 0) {
		$return_url = mk_check_payment();
		if (intval(get_query_var('mc_cart_update')) === 3) {
			echo json_encode(array('redirect' => $return_url));
		} else {
			wp_redirect($return_url);
		}
		exit;
	}
}
		function sc_cart_scripts() {
?>
			<script>
				jQuery(document).on('updated_cart_totals', function(){
					var rand = Math.round(Math.random() * 100000);
					window.history.pushState({rand: rand}, "Rand "+rand, "./?r="+rand);
				});
			</script>
<?php
			$mcsc = new woocommerce_makecommerce_sc();
			$mcsc->before_cart();
		}
add_filter('query_vars', 'sc_return_trigger');
add_action('template_redirect', 'sc_return_trigger_check');
add_action('woocommerce_before_cart', 'sc_cart_scripts');

function woocommerce_makecommerce_sc_init() {

	load_plugin_textdomain('wc_makecommerce_sc_domain', false, dirname(plugin_basename(__FILE__)) . '/');

	class woocommerce_makecommerce_sc extends WC_Payment_Gateway {
		function __construct() {
			$this->id = 'makecommerce_sc';
			$this->method_title = __('SimpleCheckout (MC)', 'wc_makecommerce_sc_domain');
			$this->init();
		}
		function init() {
			$this->init_form_fields();
			$this->init_settings();
			$this->enabled = $this->settings['active'];
			add_action('woocommerce_before_checkout_form', array(&$this, 'take_over_checkout'), 10, 1);
			add_action('woocommerce_update_options_payment_gateways', array(&$this, 'process_admin_options'));
			add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(&$this, 'process_admin_options'));
		}
		function before_cart() {
			if (!$this->is_available()) { return; }
			if (!empty($this->settings['hide_shipping_methods']) && $this->settings['hide_shipping_methods'] === 'yes') {
				echo '<style>.shipping,.order-total{display:none;}</style>';
				echo '<style>.tax-rate{display:none;}</style>';
			}
		}
		function install_tables() {
			global $wpdb;
			$charset_collate = $wpdb->get_charset_collate();
			$table_name = $wpdb->prefix . "woocommerce_makecommerce_sc"; 
			$sql = "CREATE TABLE `$table_name` (
				`id` int(11) unsigned not null auto_increment,
				`cart_id` varchar(64) not null default '',
				`order_id` int(10) unsigned not null,
				`created` int(10) unsigned not null,
				`modified` int(10) unsigned not null,
				`status` tinyint unsigned not null,
				`content` mediumtext,
				unique key id (`id`),
				key cart_id (`cart_id`)
				) $charset_collate;";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		function take_over_checkout($checkout) {
			if (!$this->is_available()) {
				return;
			}
			$this->install_tables();
			global $woocommerce, $wpdb;
			if (get_option('woocommerce_enable_guest_checkout') !== 'yes' && !is_user_logged_in()) {
				wc_add_notice(__('You have to log in to continue to checkout', 'wc_makecommerce_domain'), 'error');
				$redir_url = $woocommerce->cart->get_cart_url();
				wp_redirect($redir_url);
				exit;
			}
			$data = array(
				'order' => array(), 
				'coupons' => $woocommerce->cart->get_applied_coupons(), 
				'discount' => $woocommerce->cart->get_cart_discount_total(),
				'discount_tax' => $woocommerce->cart->get_cart_discount_tax_total()
			); 
			$free_shipping = false;
			foreach ($woocommerce->cart->get_applied_coupons() as $coupon) {
				$coupon = new WC_Coupon($coupon);
				if ((method_exists($coupon, 'get_free_shipping') && $coupon->get_free_shipping()) || $coupon->free_shipping) { $free_shipping = true; }
			}
			$qty = 0; $amount = 0;
			$cart = $woocommerce->cart->get_cart();
			foreach ($cart as $cart_item) {
				$data['order'][] = array('id' => $cart_item['product_id'], 'qty' => $cart_item['quantity'], 'var' => $cart_item['variation_id']);
				$qty += $cart_item['quantity'];
				$amount += $cart_item['line_total'] + $cart_item['line_tax'];
			}
			if (count($data) > 0) {
				$wpdb->insert($wpdb->prefix.'woocommerce_makecommerce_sc', array(
					'created' => time(),
					'modified' => time(),
					'status' => 0,
					'content' => json_encode($data)
				));
				$tmp_order_id = $wpdb->insert_id;
				$cart_to_order_url = site_url('/?mc_cart_to_order=1');
				$calculate_shipment_url = site_url('/?mc_calculate_shipment=1');

				$locale = get_locale();
				if ($locale) { $locale = explode('_', $locale); $locale = !empty($locale[1]) ? strtolower($locale[1]) : strtolower($locale[0]); }
				$locale = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : $locale;
				if (empty($locale)) { $locale = 'ee'; }
				$tos_url = !empty($this->settings['shop_tos_url']) ? $this->settings['shop_tos_url'] : site_url();
				$data = array(
					'cartRef' => 'PreOrder '.$tmp_order_id,
					'pluginUrls' => array(
						'cartToOrder' => $cart_to_order_url,
						'calculateShipment' => $calculate_shipment_url,
						'tos' => $tos_url
					),
					'amount' => sprintf("%.2f", round(max($amount, 0.01), 2)),
					'currency' => 'EUR',
					'sourceCountry' => WC()->countries->get_base_country(), // 'EE'
					'locale' => $locale,
					'shipmentMethods' => array()
				);
				$package = $woocommerce->cart->get_shipping_packages();
				if (!empty($package)) { $package = $package[0]; }
				$zones = array();

				$zone                                                     = new WC_Shipping_Zone(0);
				$zones[ $zone->get_id() ]                            = $zone->get_data();
				$zones[ $zone->get_id() ]['formatted_zone_location'] = $zone->get_formatted_location();
				$zones[ $zone->get_id() ]['shipping_methods']        = $zone->get_shipping_methods();
				$zones = array_merge( $zones, WC_Shipping_Zones::get_zones() );
				$continents = WC()->countries->get_continents();
				$method_country_x = array();
				$supported_methods = array('parcelmachine_omniva' => 'APT', 'parcelmachine_smartpost' => 'APT', 'parcelmachine_dpd' => 'APT', 'courier_omniva' => 'COU', 'courier_smartpost' => 'COU', 'local_pickup' => 'OTH', 'flat_rate' => 'COU');
				foreach ($zones as $zone) {
					foreach ($zone['shipping_methods'] as $method_key => $method) {
						if ($method->enabled !== 'yes') { continue; }
						if (!empty($supported_methods[$method->id])) {
							foreach ($woocommerce->cart->get_shipping_packages() as $package) {
								if (!$method->is_available($package)) { continue(2); }
							}
							$method_type = $supported_methods[$method->id];
							if (empty($method_country_x[$method_type])) { $method_country_x[$method_type] = array(); }
							$carrier = array('countries' => array());
							if (!empty($method->carrier)) { $carrier['carrier'] = mb_strtoupper($method->carrier); }
							if (empty($zone['zone_locations'])) {
								$carrier['countries'] = array_keys(WC()->countries->get_allowed_countries());
							} else {
								foreach ($zone['zone_locations'] as $location) {
									if ($location->type === 'continent' && !empty($continents[$location->code])) {
										$countries = array_diff($continents[$location->code]['countries'], $method_country_x[$method_type]);
										$carrier['countries'] = array_merge($carrier['countries'], $countries);
									} else if ($location->type === 'state') {
										list($country, $state) = explode(':', $location->code);
										$carrier['countries'][] = $country;
									} else if ($location->type === 'country') {
										$carrier['countries'][] = $location->code;
									}
								}
							}
							$method_country_x[$method_type] = array_merge($method_country_x[$method_type], $carrier['countries']);
							$prices = $method->get_rates_for_package($package);
							$price = $free_shipping ? 0.00 : get_rate_with_taxes($method->id.':'.$method_key, $prices);
							$carrier['type'] = strtoupper($method_type);
							$carrier['name'] = $method->title;
							$carrier['methodId'] = $method->id . ':' . $method_key;
							$carrier['amount'] = sprintf("%.2f", round($price, 2));
							$data['shipmentMethods'][] = $carrier;
						}
					}
				}
				$MK = mk_get_api();
				$cart = $MK->createCart($data);
				$wpdb->update($wpdb->prefix.'woocommerce_makecommerce_sc', array('cart_id' => $cart->id), array('id' => $tmp_order_id));
				wp_redirect($cart->scoUrl);
				exit;
			}
			die('no content');
		}
		function init_form_fields() {
			$this->form_fields = array();
			$this->form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());	
			$this->form_fields['scointro'] = array(
				'type' => 'title', 
				'description' => __('SimpleCheckout replaces Woocommerce built-in check-out dialog with Makecommerce hosted dialog. It is more convenient and faster for your customers', 'wc_makecommerce_domain').'<br>'.__('See more about SimpleCheckout on: <a target=_blank href="https://makecommerce.net/simplecheckout/">makecommerce.net/simplecheckout</a>', 'wc_makecommerce_domain'),
				);						
			$this->form_fields['active'] = array(
				'title' => __('Enable/Disable', 'wc_makecommerce_domain'),
				'type' => 'checkbox',
				'label' => __('Enable SimpleCheckout', 'wc_makecommerce_domain'),
				'default' => 'yes'
			);
			$this->form_fields['shop_tos_url'] = array(
				'title' => __('Shop ToS url', 'wc_makecommerce_domain'),
				'description' => __('paste here url of your shop "Terms and Conditions" page', 'wc_makecommerce_domain'),
				'type'  => 'text',
			);
			$this->form_fields['hide_shipping_methods'] = array(
				'title' => __('Hide shipping methods block', 'wc_makecommerce_domain'),
				'type' => 'checkbox',
				'label' => __('Hide shipping methods block on cart page. This will make it look more clean and simple', 'wc_makecommerce_domain'),
				'default' => 'no'
			);
		}
		public function is_available() {
			if ($this->settings['active'] == "yes" || empty($this->settings['active'])) {
				return true;
			}
			return false;
		}

	}
	
}

function get_rate_without_taxes($method, $rate) {
	if (empty($rate[$method])) { return 0; }
	$rate = $rate[$method];
	$price = $rate->cost;
	return $price;
}

function get_rate_with_taxes($method, $rate) {
	if (empty($rate[$method])) { return 0; }
	$rate = $rate[$method];
	$price = $rate->cost;
	if (empty($rate->taxes)) { return $price; }
	foreach ($rate->taxes as $tax) {
		$price += $tax;
	}
	return $price;
}

function woocommerce_payment_makecommerce_sc_add($methods) {
	$methods[] = 'woocommerce_makecommerce_sc';
	return $methods;
}
add_action('plugins_loaded', 'woocommerce_makecommerce_sc_init');
add_action('woocommerce_payment_gateways', 'woocommerce_payment_makecommerce_sc_add');


