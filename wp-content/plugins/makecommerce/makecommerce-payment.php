<?php



	function woocommerce_payment_makecommerce_init() {

		load_plugin_textdomain('wc_makecommerce_domain', false, dirname(plugin_basename(__FILE__)) . '/');
		
		class woocommerce_makecommerce extends WC_Payment_Gateway {
			
			const MC_CANCELLED = 'CANCELLED';
			const MC_COMPLETED = 'COMPLETED';
			const MC_DEPOSITED = 'DEPOSITED';
			
			const MC_PART_REFUNDED = 'PART_REFUNDED';
			const MC_REFUNDED = 'REFUNDED';
			
			const module_name = 'MakeCommerce';

			const billing_descriptor_dba = '';
			const currencies_allowed = 'EUR';
			const module_homepage_url = 'https://maksekeskus.ee/en/integration-modules/makecommerce-woocommerce-payment-plugin/';
			const testenv_homepage_url = 'http://maksekeskus.ee/en/for-developers/test-environment/';
			
			public $id = 'makecommerce';
			public $version = '2.5.5';
			
			public $payment_return_url;
			public $payment_return_url_m2m;
			public $payment_return_url_cancel;
						
			//protected $_shop_id;
			//protected $_api_key_secret;
			//protected $_api_key_public;
			
			
			protected $_banklinks = array();
			protected $_banklinks_grouped;
			protected $_cards = array();
			protected $_paylater = array();
			protected $_paylater_grouped;
			
			protected $MK;
			protected $_init;

			public function __construct($init = false) {
				$this->_init = $init;
				if(defined('ICL_LANGUAGE_CODE') && function_exists('pll_current_language')) { // function_exists('icl_object_id')
				    $this->payment_return_url = site_url('/'.ICL_LANGUAGE_CODE.'/?makecommerce_return=1');
				    $this->payment_return_url_m2m = site_url('/'.ICL_LANGUAGE_CODE.'/?makecommerce_return=1&ajax_content=1');
				    $this->payment_return_url_cancel = site_url('/'.ICL_LANGUAGE_CODE.'/?makecommerce_return=1');
				} else {
				    $this->payment_return_url = site_url('/?makecommerce_return=1');
				    $this->payment_return_url_m2m = site_url('/?makecommerce_return=1&ajax_content=1');
				    $this->payment_return_url_cancel = site_url('/?makecommerce_return=1');
				}
				// Load the form fields.
				$this->init_form_fields();
				
				// Load the settings.
				$this->init_settings();
				
				$this->initBanklinks();
				
				if (defined('ICL_LANGUAGE_CODE') && !empty($this->settings['ui_widget_title_'.ICL_LANGUAGE_CODE])) {
					$this->title = $this->settings['ui_widget_title_'.ICL_LANGUAGE_CODE];
				} else if (!empty($this->settings['ui_widget_title'])) {
					$this->title = $this->settings['ui_widget_title'];
				} else {
					$this->title = '';
				}

				$this->method_title = 'MakeCommerce';
				$this->description = true;

				$this->enabled = $this->settings['active'];

				$this->MK = mk_get_api();
				if (!$this->MK && $this->_init) {
					add_action( 'admin_notices', array(&$this, 'makecommerce_api_info_missing') );
				}
				
				$this->supports = array(
					'subscriptions',
					'subscription_cancellation', 
					'subscription_suspension', 
					'subscription_reactivation',
					'subscription_amount_changes',
					'subscription_date_changes',
					'subscription_payment_method_change',
					'products',
					'refunds'
				);
				
				add_filter('query_vars', array(&$this, 'makecommerce_return_trigger'));
				add_action('template_redirect', array(&$this, 'makecommerce_return_trigger_check'));
				add_action('woocommerce_scheduled_subscription_payment_' . $this->id, array($this, 'process_subscripion_payment_start'), 10, 2);
				add_action('scheduled_subscription_payment_' . $this->id, array($this, 'process_subscripion_payment_start'), 10, 2);
				
				if($this->_init == false) {
					add_action('woocommerce_update_options_payment_gateways', array(&$this, 'process_admin_options'));
					add_action('woocommerce_update_options_payment_gateways_' . $this->id, array(&$this, 'process_admin_options'));
					add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
					
					add_action('woocommerce_admin_order_data_after_order_details', array(&$this, 'admin_order_page'), 10, 1);
					
					wp_enqueue_script('jquery');
					wp_enqueue_style('makecommerce', plugins_url('/css/makecommerce.css', __FILE__), array(), $this->version);
				}
				if (is_admin()) {
					add_action( 'wp_ajax_mc_banklinks_reload', array(&$this, 'mc_banklinks_reload') );
				
					require_once(ABSPATH.'wp-admin/includes/plugin.php');
					$wc_version = get_plugin_data(__DIR__.'/../woocommerce/woocommerce.php');
					if ((double)$wc_version['Version'] < 2.6) {
						function sample_admin_notice__error() {
								$class = 'notice notice-error';
								$wc_version = get_plugin_data(__DIR__.'/../woocommerce/woocommerce.php');
								$message = sprintf(__( 'Makecommerce plugin needs at least <strong>WooCommerce 2.6</strong> to function correctly. Please update yours (currently %s)', 'wc_makecommerce_domain' ), $wc_version['Version']);
								printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
						}
						add_action( 'admin_notices', 'sample_admin_notice__error' );
					}
				}
				
			}

			public function get_title() {
				// TODO: add multilingual support
				return $this->title;
			}
			
			protected function _getWooCommerce() {
				global $woocommerce;
				return $woocommerce;
			}
			
			public function is_valid_for_use() {
				return true;
			}
			
			public function is_available() {
				if (!($this->settings['active'] == "yes" && mk_is_api_set())) {
					return false;
				}
				return parent::is_available();
			}

			private function initBanklinks() {
				global $wpdb;
				global $mkDbTable;
				$this->_banklinks = array();
				$has_subscriptions = class_exists('WC_Subscriptions_Cart') && WC_Subscriptions_Cart::cart_contains_subscription();
				
				$tableName = $wpdb->prefix . $mkDbTable;
				$methods = $wpdb->get_results('SELECT * FROM '.$tableName);
				
				if(count($methods)) {
					if(is_admin() && $this->_init == true && get_option( 'mc_banklinks_api_type' ) != get_option('mk_api_type', false)) {
						// ??
						add_action( 'admin_notices', array(&$this, 'makecommerce_banklinks_list_type_notice') );
					}
					$banklinks = array();
					$banklinks_grouped = array();
					$cards = array();
					$paylater = array();
					$paylater_grouped = array();
					foreach($methods as $method) {
						if($method->type == 'banklink'|| $method->type == 'other') {
							if (!$has_subscriptions) {
								$banklinks[] = $banklinks_grouped[$method->country][] = $method;
							}
						} elseif($method->type == 'card') {
							$cards[] = $method;
						} elseif($method->type == 'payLater') {
							if (!$has_subscriptions) {
								$paylater[] = $paylater_grouped[$method->country][] = $method;
							}
						}
					}
					
					usort($banklinks, array($this, 'orderBanklinks'));
					foreach($banklinks_grouped as &$country) {
						usort($country, array($this, 'orderBanklinks'));
					}
					
					$this->_banklinks = $banklinks;
					$this->_banklinks_grouped = $banklinks_grouped;
					$this->_cards = $cards;
					$this->_paylater = $paylater;
					$this->_paylater_grouped = $paylater_grouped;
					remove_action('admin_notices', array(&$this, 'makecommerce_banklinks_list_empty'), 30);
				} elseif(is_admin() && $this->_init == true) {
					add_action('admin_notices', array(&$this, 'makecommerce_banklinks_list_empty'), 30);
				}
			}
			
			private function orderBanklinks($a, $b) {
				$order = array_map('trim', explode(",", $this->settings['ui_chorder']));
				
				$posA = array_search($a->name, $order);
				$posB = array_search($b->name, $order);
				
				if($posA === $posB) return $a->id > $b->id ? 1 : -1;
				if($posA === FALSE) return 1;
				if($posB === FALSE) return -1;
				
				return $posA > $posB ? 1 : -1;
			}



			// ===== WC admin related stuff  ======


			public function makecommerce_api_info_missing() {
				?>
				<div class="notice notice-error is-dismissible">
					<p>
						<?php echo __('You have not entered the Shop ID and keys for the MakeCommerce payment module. The module will not work without them.', 'wc_makecommerce_domain'); ?>
						<?php if (mk_wc_version("3.4.0")) { ?>
						<a href="<?php echo admin_url('admin.php?page=wc-settings&tab=advanced&section=mk_api'); ?>"><?php echo __('Click here to enter them', 'wc_makecommerce_domain'); ?></a>
						<?php } else { ?>
						<a href="<?php echo admin_url('admin.php?page=wc-settings&tab=api&section=mk_api'); ?>"><?php echo __('Click here to enter them', 'wc_makecommerce_domain'); ?></a>
						<?php } ?>
					</p>
				</div>
				<?php
			}
			
			public function makecommerce_banklinks_list_empty() {
				?>
				<div class="notice notice-error is-dismissible">
					<p>
						<?php echo __('The payment methods list for MakeCommerce payment module is empty.', 'wc_makecommerce_domain'); ?>
						<a href="<?php echo admin_url('admin.php?page=wc-settings&tab=checkout&section=makecommerce'); ?>"><?php echo __('Go to the settings to update them', 'wc_makecommerce_domain'); ?></a>
					</p>
				</div>
				<?php
			}
			
			public function makecommerce_banklinks_list_type_notice() {
				?>
				<div class="notice notice-error is-dismissible">
					<p>
						<?php echo __('You have changed the environment for MakeCommerce payment module. The payment methods list has been loaded for a different environment.', 'wc_makecommerce_domain'); ?>
						<a href="<?php echo admin_url('admin.php?page=wc-settings&tab=checkout&section=makecommerce'); ?>"><?php echo __('Go to the settings to update them', 'wc_makecommerce_domain'); ?></a>
					</p>
				</div>
				<?php
			}
			

			public function init_form_fields() {

                if ( function_exists('icl_object_id') && ! defined( 'POLYLANG_VERSION' ) ) {
                        $languages = apply_filters('wpml_active_languages', NULL, 'skip_missing=0');
                    }
                    else if ( defined( 'POLYLANG_VERSION' ) ) {
                        $pl_locales = pll_languages_list( array('fields'=>'locale') );
                        foreach ($pl_locales as $key => $locale_pl ) {
                            $language = array( 	'id' => $key,
                                                'code' => $locale_pl) ;
                            $languages[$locale_pl] = $language;
                        }
                    }

				$this->form_fields = array();
				$this->form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
				$this->form_fields['active'] = array(
						'title' => __('Enable/Disable', 'wc_makecommerce_domain'),
						'type' => 'checkbox',
						'label' => __('Enable MakeCommerce payments', 'wc_makecommerce_domain'),
						'default' => 'no'
					);
				if (mk_wc_version("3.4.0")) $a = admin_url('admin.php?page=wc-settings&tab=advanced&section=mk_api'); else $a = admin_url('admin.php?page=wc-settings&tab=api&section=mk_api');
				$this->form_fields['api_title'] = array(
						'title' => __('MakeCommerce API', 'wc_makecommerce_domain'),
						'description' => sprintf(__('Go to <a href="%s">API settings</a> to fill in the credentials', 'wc_makecommerce_domain'), $a),
						'type' => 'title',
					);
				$this->form_fields['ui_title'] = array(
						'title' => '<br>'.__('User Interface', 'wc_makecommerce_domain'),
						'type' => 'title',
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_open_by_default'] = array(
						'title' => __('Set as default selection', 'wc_makecommerce_domain'),
						'label' => __('MakeCommerce payments widget will be selected by default', 'wc_makecommerce_domain'),
						'type' => 'checkbox',
						'default' => 'yes',
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_mode'] = array(
						'title' => __('Display MC payment channels as', 'wc_makecommerce_domain'),
						'type' => 'mc_hidden',
						'default' => 'widget',
						'options' => array(
							'inline' => __('List', 'wc_makecommerce_domain'),
							'widget' => __('Grouped to widget', 'wc_makecommerce_domain'),
						),
						'class' => 'ui-identifier',
					);


				if (empty($languages)) {
					$this->form_fields['ui_widget_title'] = array(
							'title' => __('Payments widget title', 'wc_makecommerce_domain'),
							'type' => 'text',
							'desc_tip' => __("Appropriate title may depend on the configuration you have made, i.e. 'pay with bank-link or credit card', 'pay with bank-links' or 'payment methods'", 'wc_makecommerce_domain'),
							'default' => __('Pay with bank-links or credit card', 'wc_makecommerce_domain'),
							'class' => 'ui-identifier',
						);
				} else {
					foreach ($languages as $language_code => $language) {
						$language_name = !empty($language['translated_name']) ? $language['translated_name'] : $language_code;
						$defaultTitle = __('Pay with bank-links or credit card', 'wc_makecommerce_domain');	
						switch ($language_code) {
						    case 'et':
						        $defaultTitle = 'Maksa pangalingi või krediitkaardiga';
						        break;
						    case 'ru':
						        $defaultTitle = 'оплата в интернет-банке или кредитной картой';
						        break;
						    case 'fi':
						        $defaultTitle = 'Maksaa verkkopankissa tai luottokortilla';
						        break;       
						}							
						$this->form_fields['ui_widget_title_'.$language_code] = array(
								'title' => __('Payments widget title', 'wc_makecommerce_domain').sprintf(' (%s)', $language_code),
								'type' => 'text',
								'desc_tip' => __("Appropriate title may depend on the configuration you have made, i.e. 'pay with bank-link or credit card', 'pay with bank-links' or 'payment methods'", 'wc_makecommerce_domain'),

								'default' => $defaultTitle,	
								'class' => 'ui-identifier',
							);
					}
				}
				$this->form_fields['ui_inline_uselogo'] = array(
						'title' => __('MC payment channels display style', 'wc_makecommerce_domain'),
						'type' => 'select',
						'default' => 'logo',
						'options' => array(
							'logo' => __('Logo', 'wc_makecommerce_domain'),
							'text_logo' => __('Text & logo', 'wc_makecommerce_domain'),
							'text' => __('Text', 'wc_makecommerce_domain'),
						),
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_widget_logosize'] = array(
						'title' => __('Size of payment channel logos', 'wc_makecommerce_domain'),
						'type' => 'select',
						'default' => 'medium',
						'options' => array(
							'small' => __('Small', 'wc_makecommerce_domain'),
							'medium' => __('Medium', 'wc_makecommerce_domain'),
							'large' => __('Large', 'wc_makecommerce_domain')
						),
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_widget_groupcountries'] = array(
						'title' => __('Group bank-links by countries', 'wc_makecommerce_domain'),
						'type' => 'mc_hidden',
						'default' => 'no',
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_widget_countries_hidden'] = array(
						'title' => __('Hide country selector', 'wc_makecommerce_domain'),
						'label' => __('Do not display country selector (flags) at payment methods', 'wc_makecommerce_domain'),
						'type' => 'checkbox',
						'default' => 'no',
					);
				$this->form_fields['ui_widget_countryselector'] = array(
						'title' => __('Country selector style', 'wc_makecommerce_domain'),
						'type' => 'mc_hidden',
						'default' => 'flag',
						'options' => array(
							'flag' => __('Flag', 'wc_makecommerce_domain'),
							'dropdown' => __('Dropdown', 'wc_makecommerce_domain'),
						),
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_widget_groupcc'] = array(
						'title' => __('Group credit card into separate widget', 'wc_makecommerce_domain'),
						'type' => 'mc_hidden',
						'default' => 'no',
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_chorder'] = array(
						'title' => __('Define custom order of payment channels', 'wc_makecommerce_domain'),
						'type' => 'text',
						'desc_tip' => __('If you want to change default order, put here comma separated list of channels. i,e, - seb,lhv,swedbank. see more on the module home page (link above)', 'wc_makecommerce_domain'),
						'class' => 'ui-identifier',
					);
				$this->form_fields['ui_javascript'] = array(
						'type' => 'ui_javascript',
					);
				$this->form_fields['cc_title'] = array(
						'title' => '<br>'.__('Credit Card Settings', 'wc_makecommerce_domain'),
						'type' => 'title',
					);
				$this->form_fields['cc_pass_cust_data'] = array(
						'title' => __('Prefill Credit Card form with customer data', 'wc_makecommerce_domain'),
						'type' => 'checkbox',
						'default' => 'yes',
						'desc_tip' => __('It will pass user Name and e-mail address to the Credit Card dialog to make the form filling easier', 'wc_makecommerce_domain'),
					);
				$this->form_fields['adv_title'] = array(
						'title' => '<hr><br>'.__('Advanced Settings', 'wc_makecommerce_domain'),
						'type' => 'title',
					);
				$this->form_fields['reload_links'] = array(
						'type' => 'mc_banklinks_reload',
						'title' => __('Update payment methods', 'wc_makecommerce_domain'),
						'description' => __('Update', 'wc_makecommerce_domain'),
						'desc_tip' => __('This will update shop configuration from MakeCommerce servers.', 'wc_makecommerce_domain'),
					);
			}

			// Needed to render mc_hidden type fields in admin
			public function generate_mc_hidden_html( $key, $data ) {
				$field_key = $this->get_field_key($key);
				ob_start();
				?>
				<tr style="display: none;">
					<td colspan="2">
						<input type="hidden" name="<?php echo $field_key; ?>" value="<?php echo $data['default']; ?>" />
					</td>
				</tr>
				<?php
				return ob_get_clean();
			}
			
			
			public function generate_mc_banklinks_reload_html( $key, $data ) {		
				$field    = $this->get_field_key( $key );
				$defaults = array(
					'title'             => '',
					'disabled'          => false,
					'class'             => '',
					'css'               => '',
					'placeholder'       => '',
					'type'              => 'text',
					'desc_tip'          => false,
					'description'       => '',
					'custom_attributes' => array()
				);
			
				$data = wp_parse_args( $data, $defaults );
			
				ob_start();
				?>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="<?php echo esc_attr( $field ); ?>"><?php echo wp_kses_post( $data['title'] ); ?></label>
						<?php echo $this->get_tooltip_html( $data ); ?>
					</th>
					<td class="forminp">
						<fieldset>
							<legend class="screen-reader-text"><span><?php echo wp_kses_post( $data['title'] ); ?></span></legend>
							<input id="mc_banklinks_reload" class="button <?php echo esc_attr( $data['class'] ); ?>" type="button" name="<?php echo esc_attr( $field ); ?>" id="<?php echo esc_attr( $field ); ?>" style="<?php echo esc_attr( $data['css'] ); ?>" value="<?php echo esc_attr( $data['description'] ); ?>" placeholder="<?php echo esc_attr( $data['placeholder'] ); ?>" <?php disabled( $data['disabled'], true ); ?> <?php echo $this->get_custom_attribute_html( $data ); ?> />
							<script type="text/javascript">
							jQuery('input#mc_banklinks_reload').on('click', function() {
									init_mc_loading();
									jQuery.ajax({
										url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php',
										type: 'POST',
										data: 'action=mc_banklinks_reload',
										success: function (output) {
											if(output.data) {
												alert(output.data);
											} else {
												alert('<?php echo __('There was an error with your update. Please try again.', 'wc_makecommerce_domain'); ?>');
											}
										},
										complete: function() { stop_mc_loading(); }
									});
							});
							
							function init_mc_loading() {
								jQuery('input#mc_banklinks_reload').attr('disabled', 'disabled');
							}
							
							function stop_mc_loading() {
								jQuery('input#mc_banklinks_reload').removeAttr('disabled');
							}
							</script>
						</fieldset>
					</td>
				</tr>
				<?php
			
				return ob_get_clean();
			}
			
			public function mc_banklinks_reload($force = false) {
				if ($force || (defined('DOING_AJAX') && DOING_AJAX)) {

					global $wpdb;
					global $mkDbTable;
					
					$request_params = array(
						'environment' => json_encode(array(
							'platform' => 'woocommerce '.$this->_getWooCommerce()->version,
							'module' => $this->id.' '.$this->version,
						)),
					);

					if (!$this->MK) {
						return false;
					}
					
					try {
						$shopConfig = $this->MK->getShopConfig($request_params);
						$methods = $shopConfig->paymentMethods;	
					} catch (Exception $e) {
						error_log(print_r($e, 1));
						return false;
					}

					$tableName = $wpdb->prefix . $mkDbTable;
					$sql = "select count(*) as isLogoUrlSet from information_schema.columns where table_name='".$tableName."' and column_name='logo_url'";
                                        $methodstruct = $wpdb->get_results( $sql );
                                        if ($methodstruct[0]->isLogoUrlSet == 0) {
                                                $wpdb->query('ALTER TABLE '.$tableName.' ADD COLUMN logo_url varchar(250)');
                                        }

					$sql = "select count(*) as min_amount from information_schema.columns where table_name='".$tableName."' and column_name='min_amount'";
                                        $methodstruct = $wpdb->get_results( $sql );
                                        if ($methodstruct[0]->min_amount == 0) {
                                                $wpdb->query('ALTER TABLE '.$tableName.' ADD COLUMN min_amount mediumint(9) default 0');
                                        }
					$sql = "select count(*) as max_amount from information_schema.columns where table_name='".$tableName."' and column_name='max_amount'";
                                        $methodstruct = $wpdb->get_results( $sql );
                                        if ($methodstruct[0]->max_amount == 0) {
                                                $wpdb->query('ALTER TABLE '.$tableName.' ADD COLUMN max_amount mediumint(9) default 0');
                                        }
					$wpdb->query('TRUNCATE TABLE '.$tableName);

					if(isset($methods->banklinks)) {
						foreach($methods->banklinks as $method) {
							$wpdb->insert($tableName, array('type' => 'banklink', 'country' => $method->country, 'name' => $method->name, 'url' => $method->url, 'logo_url' => $method->logo_url));
						}
						$updated = true;
					}
					
					if(isset($methods->cards)) {
						foreach($methods->cards as $method) {
							$wpdb->insert($tableName, array('type' => 'card', 'name' => $method->name, 'logo_url' => $method->logo_url));
						}
						$updated = true;
					}

					if(isset($methods->other)) {
						foreach($methods->other as $method) {
							$wpdb->insert($tableName, array('type' => 'other', 'country' => $method->country, 'name' => $method->name, 'url' => $method->url, 'logo_url' => $method->logo_url));
						}
						$updated = true;
					}

					if(isset($methods->payLater)) {
						foreach($methods->payLater as $method) {
							$wpdb->insert($tableName, array('type' => 'payLater', 'country' => $method->country, 'name' => $method->name, 'url' => $method->url, 'logo_url' => $method->logo_url, 'min_amount' => $method->min_amount, 'max_amount' => $method->max_amount));
						}
						$updated = true;
					}
					if(isset($shopConfig) && strlen($shopConfig->name)) {
						update_option( 'mc_shop_name', $shopConfig->name );
					}

					if ($updated) {
						update_option( 'mc_banklinks_api_type', get_option('mk_api_type', false) );
					}

					if ($force) {
						$this->initBankLinks();
						return $updated;
					}
					
					if($updated) {
						wp_send_json(array('success' => 1, 'data' => __('Update successfully completed!', 'wc_makecommerce_domain')));
						exit; 
					}
					
					wp_send_json(array('success' => 0, 'data' => __('There was an error with your update. Please try again.', 'wc_makecommerce_domain')));
					exit; 
				}
				die();
			}


			public function process_subscripion_payment_start($amount_to_charge, $renewal_order, $product_id = '') {
				$result = $this->process_subscription_payment($renewal_order, $amount_to_charge);
				if ( is_wp_error( $result ) ) {
					WC_Subscriptions_Manager::process_subscription_payment_failure_on_order($renewal_order, $product_id);
				} else {
					WC_Subscriptions_Manager::process_subscription_payments_on_order($renewal_order);
				}
			}

			public function process_subscription_payment($order, $amount = 0) {
				if (0 === $amount) {
					$order->payment_complete();
					return true;
				} // if ('processing' === $order->get_status() || 'completed' === $order->get_status()){ // ('processing' === $order->get_status())
				if ('processing' === $order->get_status() || 'completed' === $order->get_status()){
					return true;
				}
				$oorder_id = @WC_Subscriptions_Renewal_Order::get_parent_order_id($order);
				$payment_token = get_post_meta($oorder_id, '_makecommerce_payment_token', true);
				$payment_token_valid_until = get_post_meta($oorder_id, '_makecommerce_payment_token_valid_until', true);
				error_log($payment_token.'=>'. $payment_token_valid_until.'=>'. $order->get_status());
				$body = array(
					'transaction' => array(
						'amount' => (string)sprintf("%.2f", $amount),
						'currency' => method_exists($order, 'get_currency') ? $order->get_currency() : $order->currency,
						'reference' => $order->get_order_number(),
					),
					'customer' => array(
						'email' => $order->get_billing_email(),
						'ip' => $order->get_customer_ip_address(),
						'country' => strtolower($order->get_billing_country()),
						'locale' => strtolower(substr(get_locale(), 0, 2)),
					)
				);
				$transaction = $this->MK->createTransaction($body);
				$paymentRequest = array(
					'amount' => (string)sprintf("%.2f", $transaction->amount), 
					'currency' => $transaction->currency,
					'token' => $payment_token
				);
				try {
					$payment = $this->MK->createPayment($transaction->id, $paymentRequest);
				} catch (Exception $e) {
					error_log('Payment failed ['.$e->getMessage().']');
					$order->add_order_note(__('Unable to renew subscription', 'wc_makecommerce_domain')."\r\n".$e->getMessage());
					return new WP_Error('makecommerce_payment_declined', __( 'Renewal payment was declined', 'wc_makecommerce_domain' ) );
				}
				$orderNote = array();
				$orderNote[] = __('Transaction ID', 'wc_makecommerce_domain') . ': <a target=_blank href="'.$this->MK->getEnvUrls()->merchantUrl.'/merchant/shop/deals/detail.html?id='. $transaction->id .'">'.$transaction->id.'</a>';
				$orderNote[] = __('Payment option', 'wc_makecommerce_domain') . ': ' . get_post_meta($order->get_order_number(), '_makecommerce_preselected_method', true);
				$order->add_order_note(implode("\r\n", $orderNote));
				$order->payment_complete($transaction->id);
				return true;
			}

			public function admin_order_page($order) {
				//
			}
			
			public function process_refund($order_id, $amount = null, $comment = '') {
				if ($this->MK) {
					try {
						$order = new WC_Order($order_id);
						$transactionId = $order->get_transaction_id();

						if ( empty($transactionId) ) {
							$transactionId = get_post_meta( $order_id, '_makecommerce_transaction_id', true);
						}
						
						if($response = $this->MK->createRefund($transactionId, array('amount' => sprintf("%.2f", $amount), 'comment' => ($comment ? : 'refund')))) {
							if($status = (string)$response->transaction->status) {
								switch($status) {
									case self::MC_REFUNDED: 
										$order->add_order_note(sprintf(__('Refund completed for amount %s', 'wc_makecommerce_domain'), $amount));
										return true;
										break;
									case self::MC_PART_REFUNDED: 
										$order->add_order_note(sprintf(__('Partial refund completed for amount %s', 'wc_makecommerce_domain'), $amount));
										return true;
										break;
								}
							}
						}
						return false;
						
					} catch (Exception $e) {
						return new WP_Error('makecommerce_refund_error', $e->getMessage());
					}

					return false;
				}
				return false;
			}


			//  ======  storefront related stuff  =========

			public function generate_ui_javascript_html( $key, $data ) {
				?>
				<script type="text/javascript">
				jQuery(document).ready(function($) {
						
						var api_type = $('#woocommerce_<?php echo $this->id; ?>_api_type');
						
						var ui_inline_uselogo_row = $('#woocommerce_<?php echo $this->id; ?>_ui_inline_uselogo').closest('tr');
						var ui_widget_title_row = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_title').closest('tr');
						var ui_widget_logosize_row = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_logosize').closest('tr');
						var ui_widget_countryselector_row = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_countryselector').closest('tr');
						var ui_widget_groupcountries_row = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_groupcountries').closest('tr');
						var ui_widget_groupcc_row = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_groupcc').closest('tr');
						var ui_widget_groupcc_title_row = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_groupcc_title').closest('tr');
						
						var ui_mode = $('#woocommerce_<?php echo $this->id; ?>_ui_mode');
						var ui_widget_groupcountries = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_groupcountries');
						var ui_widget_groupcc = $('#woocommerce_<?php echo $this->id; ?>_ui_widget_groupcc');
						
						parseVisibility();
						function parseVisibility() {
							$('.ui-identifier').closest('tr').show();
							
							if(api_type.val() == 'live') {
								$('.mc-test-link').hide();
								$('.api-test').closest('tr').hide();
							} else {
								$('.mc-test-link').show();
								$('.api-live').closest('tr').hide();
							}
							
							if(ui_mode.val() == 'inline') {
								ui_widget_title_row.hide();
								ui_widget_logosize_row.hide();
								ui_widget_countryselector_row.hide();
								ui_widget_groupcountries_row.hide();
								ui_widget_groupcc_row.hide();
								ui_widget_groupcc_title_row.hide();
							} else {
								ui_inline_uselogo_row.hide();
								
								if(ui_widget_groupcountries.prop('checked')) {
									ui_widget_countryselector_row.hide();
								}
								if(!ui_widget_groupcc.prop('checked')) {
									ui_widget_groupcc_title_row.hide();
								}
							}
						}
						
						api_type.on('change', parseVisibility);
						ui_mode.on('change', parseVisibility);
						ui_widget_groupcountries.on('change', parseVisibility);
						ui_widget_groupcc.on('change', parseVisibility);
						
				});
				</script>
				<?php
			}
					
			public function payment_fields() {

				
				if($this->settings['ui_mode'] == 'inline') {
					
					?>
					<ul class="makecommerce-picker">
					<?php foreach($this->_banklinks as $method): ?>
						<li class="makecommerce-picker-method">
							<input type="radio" id="makecommerce_method_picker_<?php echo $method->country.'_'.$method->name; ?>" name="PRESELECTED_METHOD_<?php echo $this->id; ?>" value="<?php echo $method->country.'_'.$method->name; ?>"/>
							<label for="makecommerce_method_picker_<?php echo $method->country.'_'.$method->name; ?>">
								<span class="makecommerce-method-title"><?php if(in_array($this->settings['ui_inline_uselogo'], array('text', 'text_logo'))) { echo ucfirst($method->name); if(count($this->_banklinks_grouped) > 1) { echo ' ('.$this->getCountryName($method->country).')'; } } ?></span>
								<?php if(in_array($this->settings['ui_inline_uselogo'], array('logo', 'text_logo'))) : ?>
									<div><img src="<?php echo $method->logo_url; ?>" title="<?php echo ucfirst($method->name); ?>" /></div>
								<?php endif; ?>
							</label>
						</li>
					<?php endforeach; ?>
					<?php foreach($this->_cards as $method): ?>
						<li class="makecommerce-picker-method">
							<input type="radio" id="makecommerce_method_picker_<?php echo 'card_'.$method->name; ?>" name="PRESELECTED_METHOD_<?php echo $this->id; ?>" value="<?php echo 'card_'.$method->name; ?>"/>
							<label for="makecommerce_method_picker_<?php echo 'card_'.$method->name; ?>">
								<span class="makecommerce-method-title"><?php if(in_array($this->settings['ui_inline_uselogo'], array('text', 'text_logo'))) { echo ucfirst($method->name); } ?></span>
								<?php if(in_array($this->settings['ui_inline_uselogo'], array('logo', 'text_logo'))) : ?>
									<div><img src="<?php echo $method->logo_url; ?>" title="<?php echo ucfirst($method->name); ?>" /></div>
								<?php endif; ?>
							</label>
						</li>
					<?php endforeach; ?>
					<?php foreach($this->_paylater as $method): ?>
						<li class="makecommerce-picker-method">
							<input type="radio" id="makecommerce_method_picker_<?php echo $method->country.'_'.$method->name; ?>" name="PRESELECTED_METHOD_<?php echo $this->id; ?>" value="<?php echo $method->country.'_'.$method->name; ?>"/>
							<label for="makecommerce_method_picker_<?php echo $method->country.'_'.$method->name; ?>">
								<span class="makecommerce-method-title"><?php if(in_array($this->settings['ui_inline_uselogo'], array('text', 'text_logo'))) { echo ucfirst($method->name); if(count($this->_banklinks_grouped) > 1) { echo ' ('.$this->getCountryName($method->country).')'; } } ?></span>
								<?php if(in_array($this->settings['ui_inline_uselogo'], array('logo', 'text_logo'))) : ?>
									<div><img src="<?php echo $method->logo_url; ?>" title="<?php echo ucfirst($method->name); ?>" /></div>
								<?php endif; ?>
							</label>
						</li>
					<?php endforeach; ?>
					</ul>
					<?php
					
				} else {
					?>
					<select id="<?php echo $this->id; ?>" name="PRESELECTED_METHOD_<?php echo $this->id; ?>">
						<option value=""></option>
					<?php foreach($this->_banklinks as $method): ?>
						<option value="<?php echo $method->country.'_'.$method->name; ?>"><?php echo strtoupper($method->country).' - '.ucfirst($method->name); ?></option>
					<?php endforeach; ?>
					<?php foreach($this->_cards as $method): ?>
						<option value="card_<?php echo $method->name; ?>"><?php echo ucfirst($method->name); ?></option>
					<?php endforeach; ?>
					<?php foreach($this->_paylater as $method): ?>
						<option value="<?php echo $method->country.'_'.$method->name; ?>"><?php echo strtoupper($method->country).' - '.ucfirst($method->name); ?></option>
					<?php endforeach; ?>
					</select>
					<ul class="makecommerce-picker">
					<?php
					global $woocommerce;
					$cartTotal = $woocommerce->cart->total;
					if($this->_banklinks || $this->_cards) {
						$defaultCountry = $this->getDefaultCountry();
						?>
						<?php if( ( empty($this->settings['ui_widget_groupcountries']) || $this->settings['ui_widget_groupcountries'] == 'no' ) && (!isset($this->settings['ui_widget_countries_hidden']) || $this->settings['ui_widget_countries_hidden'] == 'no') ) : ?>
							<div class="makecommerce_country_picker_countries">
								<?php foreach(array_keys($this->_banklinks_grouped) as $country): ?>
									<input style="display: none;" type="radio" id="makecommerce_country_picker_<?php echo $country; ?>" name="makecommerce_country_picker" value="<?php echo $country; ?>" <?php if($defaultCountry == $country) echo 'checked="checked" '; ?>/><?php if($this->settings['ui_widget_countryselector'] == 'flag') { ?><label for="makecommerce_country_picker_<?php echo $country; ?>" class="makecommerce_country_picker_label" style="background-image: url(<?php echo plugins_url('/images/'.$country.'32.png', __FILE__); ?>);"></label><?php } ?>
								<?php endforeach; ?>
								<?php if($this->settings['ui_widget_countryselector'] == 'dropdown') : ?>
									<select name="makecommerce_country_picker_select">
										<?php foreach(array_keys($this->_banklinks_grouped) as $country): ?>
											<option value="<?php echo $country; ?>" <?php if($defaultCountry == $country) echo 'selected="selected" '; ?>><?php echo $this->getCountryName($country); ?></option>
										<?php endforeach; ?>
										<option value="card" style="display:none;"></option>
									</select>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php 
							$banklinks_grouped = $this->_banklinks_grouped;
							$banklinks_grouped['other'] = array();
							?>
						<?php foreach($banklinks_grouped as $country => $methods): ?>
							<li class="makecommerce-picker-country">
							<?php if($this->settings['ui_widget_groupcountries'] == 'yes') : ?>
								<input type="radio" id="makecommerce_country_picker_<?php echo $country; ?>" name="makecommerce_country_picker" value="<?php echo $country; ?>" <?php if($defaultCountry == $country) echo 'checked="checked" '; ?>/><label for="makecommerce_country_picker_<?php echo $country; ?>"><img src="<?php echo plugins_url('/images/'.$country.'32.png', __FILE__); ?>" /></label>
							<?php endif; ?>
								<div class="makecommerce_country_picker_methods" id="makecommerce_country_picker_methods_<?php echo $country; ?>">
									<?php foreach($methods as $method): ?>
										<div class="makecommerce-banklink-picker" banklink_id="<?php echo $method->country.'_'.$method->name; ?>">
											<img src="<?php echo $method->logo_url; ?>" title="<?php echo ucfirst($method->name); ?>" />
										</div>
									<?php endforeach; ?>
									<?php if($this->_cards && $this->settings['ui_widget_groupcc'] == 'no') : ?>
										<div class="breaker"></div>
										<?php foreach($this->_cards as $method): ?>
											<div class="makecommerce-banklink-picker" banklink_id="card_<?php echo $method->name; ?>">
												<img src="<?php echo $method->logo_url; ?>" title="<?php echo ucfirst($method->name); ?>" />
											</div>
										<?php endforeach; ?>
									<?php elseif($country == 'other') :?>
										<p class="no-methods"><?php _e('No payment methods for selected country' ,'wc_makecommerce_domain');?></p>
									<?php endif; ?>
								</div>
							</li>
						<?php endforeach; ?>
						<?php if($this->_cards && $this->settings['ui_widget_groupcc'] == 'yes') : ?>
							<li class="makecommerce-picker-country">
								<input type="radio" id="makecommerce_country_picker_card" name="makecommerce_country_picker" value="card"/><label for="makecommerce_country_picker_card"><?php echo $this->settings['ui_widget_groupcc_title']; ?></label>
								<div class="makecommerce_country_picker_methods" id="makecommerce_country_picker_methods_card">
									<?php foreach($this->_cards as $method): ?>
										<div class="makecommerce-banklink-picker" banklink_id="card_<?php echo $method->name; ?>">
											<img src="<?php echo $method->logo_url; ?>" title="<?php echo ucfirst($method->name); ?>" />
										</div>
									<?php endforeach; ?>
								</div>
							</li>
						<?php endif; ?>
						<?php 
							$paylater_grouped = $this->_paylater_grouped;
							$paylater_grouped['other'] = array();
							?>
						<?php foreach($paylater_grouped as $country => $methods): ?>
							<li class="makecommerce-picker-country">
							<?php if($this->settings['ui_widget_groupcountries'] == 'yes') : ?>
								<input type="radio" id="makecommerce_country_picker_<?php echo $country; ?>" name="makecommerce_country_picker" value="<?php echo $country; ?>" <?php if($defaultCountry == $country) echo 'checked="checked" '; ?>/><label for="makecommerce_country_picker_<?php echo $country; ?>"><img src="<?php echo plugins_url('/images/'.$country.'32.png', __FILE__); ?>" /></label>
							<?php endif; ?>
								<div class="makecommerce_country_picker_methods" id="makecommerce_country_picker_methods_<?php echo $country; ?>">
									<?php foreach($methods as $method): ?>
									<?php if (($method->min_amount < $cartTotal && $method->max_amount == 0) || ($method->min_amount < $cartTotal && $method->max_amount > $cartTotal)): ?>
										<div class="makecommerce-banklink-picker" banklink_id="<?php echo $method->country.'_'.$method->name; ?>">
											<img src="<?php echo $method->logo_url; ?>" title="<?php echo ucfirst($method->name); ?>" />
										</div>
									<?php endif; ?>
									<?php endforeach; ?>
									<?php if($this->_cards && $this->settings['ui_widget_groupcc'] == 'no') : ?>
									<?php elseif($country == 'other') :?>
										<p class="no-methods"><?php _e('No payment methods for selected country' ,'wc_makecommerce_domain');?></p>
									<?php endif; ?>
								</div>
							</li>
						<?php endforeach; ?>
					<?php
					}
					?>
						</ul>
						<div class="mc-clear-both"></div>
						<script type="text/javascript">
						var makecommerceId = '<?php echo $this->id; ?>';
						var selectedCountry = '<?php echo $defaultCountry; ?>';
						
						var logosize = '<?php echo $this->settings['ui_widget_logosize']; ?>';
						jQuery('div.makecommerce_country_picker_methods').addClass('logosize-'+logosize);
						
					<?php if(count($banklinks_grouped) == 1): ?>
						jQuery('li.makecommerce-picker-country').show();
						jQuery('div.makecommerce_country_picker_countries').hide();
						jQuery('li.makecommerce-picker-country > input, li.makecommerce-picker-country > label').hide();
					<?php else: ?>
						makecommercePick();
						
						jQuery('body').on('change', 'select[name=makecommerce_country_picker_select]', function() {
							selectedCountry = jQuery(this).val();
							jQuery('input[name=makecommerce_country_picker]').removeAttr('checked');
							makecommercePick();
						});
						jQuery('body').on('change', 'input[name=makecommerce_country_picker]', function() {
							if(jQuery(this).is(":checked")) {
								selectedCountry = jQuery(this).val();
								jQuery('select[name=makecommerce_country_picker_select]').val(selectedCountry);
								makecommercePick();
							}
						});
						
						function makecommercePick() {
							jQuery('select#'+makecommerceId).val('');
							jQuery('div.makecommerce-banklink-picker').removeClass('selected');
							jQuery('label.makecommerce_country_picker_label').removeClass('selected');
							
							jQuery('li.makecommerce-picker-country').hide();
							jQuery('div#makecommerce_country_picker_methods_' + selectedCountry).parent().show();
							jQuery('label[for=makecommerce_country_picker_' + selectedCountry + ']').addClass('selected');
						}
					<?php endif; ?>
						
						jQuery('div.makecommerce-banklink-picker').on('click', function() {
								var banklink_id = jQuery(this).attr('banklink_id');
								jQuery('select#'+makecommerceId).val(banklink_id);
								
								jQuery('div.makecommerce-banklink-picker').removeClass('selected');
								jQuery(this).addClass('selected');
						});
						</script>
					<?php
				}
				
				if($this->settings['ui_open_by_default'] == 'yes') {
					?>
					<script type="text/javascript">
					jQuery('input#payment_method_<?php echo $this->id; ?>').trigger('click');
					</script>
					<?php
				}
			}





			protected function getCountryName($slug) {
				switch($slug) {
					case 'ee': return __('Estonia', 'wc_makecommerce_domain'); break;
					case 'lv': return __('Latvia', 'wc_makecommerce_domain'); break;
					case 'lt': return __('Lithuania', 'wc_makecommerce_domain'); break;
					case 'fi': return __('Finland', 'wc_makecommerce_domain'); break;
				}
				return $slug;
			}
			
			private function getDefaultCountry() {
				if ($this->_getWooCommerce()->customer) {
					$customerCountry = strtolower($this->_getWooCommerce()->customer->get_shipping_country());
					if(array_key_exists($customerCountry, $this->_banklinks_grouped)) {
						return $customerCountry;
					} else {
						return 'other';
					}
				}
				
				$localeToCountry = array(
					'et' => 'ee',
					'lv' => 'lv',
					'lt' => 'lt',
					'fi' => 'fi',
				);
				if(array_key_exists(get_locale(), $localeToCountry)) {
					return $localeToCountry[get_locale()];
				}
				
				return key($this->_banklinks_grouped);
			}
			
			
			protected function getImageUrl($methodName) {  // remove it
				$imageUrlPath = $this->MK->getEnvUrls()->staticsUrl.'img/channel/lnd/';
				return $imageUrlPath.$methodName.'.png';
			}
			
			public function validate_fields() {
				$selected = isset($_POST['PRESELECTED_METHOD_' . $this->id]) ? sanitize_text_field($_POST['PRESELECTED_METHOD_' . $this->id]) : false;

				if (!$selected) {
					wc_add_notice(__('Please select suitable payment option!', 'wc_makecommerce_domain'), 'error');
				} else {
					// is this used?? 
					$this->_getWooCommerce()->session->makecommerce_preselected_method = $selected;
				}

				return true;
			}

			
			public function process_payment($orderId) {

				$order = new WC_Order($orderId);

				$selected = isset($_POST['PRESELECTED_METHOD_' . $this->id]) ? sanitize_text_field($_POST['PRESELECTED_METHOD_' . $this->id]) : false;

				if (!empty($selected)) {
					
					update_post_meta($order->get_order_number(), '_makecommerce_preselected_method', $selected);
						
					$request_body = array(
						'transaction' => array(
							'amount' => (string)sprintf("%.2f", $order->get_total()),
							'currency' => method_exists($order, 'get_currency') ? $order->get_currency() : $order->currency,
							'reference' => $order->get_order_number(),
							'transaction_url' => array(
								'return_url' => array(
									'url' => $this->payment_return_url,
									'method' => 'POST',
								),
								'cancel_url' => array(
									'url' => $this->payment_return_url_cancel,
									'method' => 'POST',
								),
								'notification_url' => array(
									'url' => $this->payment_return_url_m2m,
									'method' => 'POST',
								),
							),
						),
						'customer' => array(
							'ip' => $_SERVER['REMOTE_ADDR'],
							'country' => strtolower($order->get_billing_country()),
							'locale' => strtolower(substr(get_locale(), 0, 2)),
						),
					);
					$transaction = $this->MK->createTransaction($request_body);
					
					if(isset($transaction->id)) {
						update_post_meta($order->get_order_number(), '_makecommerce_transaction_id', $transaction->id);
						if (substr($selected, 0, 5) == 'card_') {
							$redirect_url = $order->get_checkout_payment_url( true );
						} else {
							$redirect_url = false;
							foreach ($transaction->payment_methods->banklinks as $banklink) {
								if ($banklink->country.'_'.$banklink->name === $selected) {
									$redirect_url = $banklink->url;
								}
							}
							if (!$redirect_url) {
								$redirect_url = $this->_getRedirectUrl($selected).$transaction->id;
							}
						}
						return array(
							'result' => 'success',
							'redirect' => $redirect_url
						);
					}
				}
				
				wc_add_notice(__('An error occured when trying to process payment!', 'wc_makecommerce_domain'), 'error');
				return array(
					'result' => 'failure',
				);
			}
			

			protected function _getRedirectUrl($selected) {
				foreach($this->_banklinks as $method) {
					if($selected == $method->country.'_'.$method->name)
						return $method->url;
				}
				foreach($this->_paylater as $method) {
					if($selected == $method->country.'_'.$method->name)
						return $method->url;
				}
				
				return false;
			}
			
			/*
			protected function _getOrderConfirmationUrl($order) {
				
				global $sitepress;
				if(isset($sitepress)) {
					$baseUrl = $sitepress->language_url( ICL_LANGUAGE_CODE );
					$lang = ICL_LANGUAGE_CODE;
				} else {
					$baseUrl = site_url();
					$lang = strtolower(substr(get_locale(), 0, 2));
				}
				$url = add_query_arg( array(
				    'makecommerce_card_pay' => '1',
				    'order_id' => $order->get_order_number(),
				    'lang' => $lang,
					), $baseUrl);

				// $url = site_url('?makecommerce_card_pay=1&order_id='.$order->get_order_number().'&lang='.(defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : strtolower(substr(get_locale(), 0, 2))));
				return $url;
			}

			*/
			
			public function receipt_page($orderId) {
				$order = new WC_Order($orderId);
				if (substr(get_post_meta($orderId, '_makecommerce_preselected_method', true), 0, 5) == 'card_' && $order->get_status() == 'pending') {
					echo "<br>".__('The order is still awaiting your payment', 'wc_makecommerce_domain')."<br>";
					echo $this->generateCardForm($order);
				}
			}
			

			public function generateCardForm($orderId) {
				$order = new WC_Order($orderId);
				$has_subscription = function_exists('wcs_order_contains_subscription') && wcs_order_contains_subscription($order);
				$scriptSrc = htmlspecialchars($this->MK->getEnvUrls()->checkoutjsUrl.'checkout.js');
				$transactionId = get_post_meta($order->get_order_number(), '_makecommerce_transaction_id', true);
				$idReference = $order->get_order_number();
				$jsParams = array(
					'key' => $this->MK->getPublishableKey(),
					'transaction' => $transactionId,
					'selector' => '#submit_banklinkmakecommerce_payment_form',
					'amount' => sprintf("%.2f", $order->get_total()),
					'locale' => !empty($_GET['lang']) ? $_GET['lang'] : (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : strtolower(substr(get_locale(), 0, 2))),
					'open-on-load' => 'true',
					'client-name' => ($this->settings['cc_pass_cust_data'] == 'yes' ? (string) ((method_exists($order, 'get_billing_first_name')  ? $order->get_billing_first_name() : $order->billing_first_name) . ' ' . (method_exists($order, 'get_billing_last_name') ? $order->get_billing_last_name() : $order->billing_last_name)) : ''),
					'email' => ($this->settings['cc_pass_cust_data'] == 'yes' ? (string) (method_exists($order, 'get_billing_email')  ? $order->get_billing_email() : $order->billing_email) : ''),
					'name' => get_option('mc_shop_name', ''),
					'description' => __('Order', 'woocommerce') . '&nbsp;' . (string) $idReference,
					'completed' => 'makecommerce_cc_complete',
					'currency' => 'EUR',
					'backdrop-close' => 'false',
				);
				if ($has_subscription) {
					$jsParams['recurring-required'] = 'true';
					$jsParams['recurring-title'] = __('Pay for subscription', 'wc_makecommerce_domain');
					$jsParams['recurring-description'] = __('This order contains subscriptions', 'wc_makecommerce_domain');
					$jsParams['recurring-confirmation'] = __('I agree that my card will be recurringly billed by this store', 'wc_makecommerce_domain');
				}
				?>
				<script type="text/javascript">
				function makecommerce_cc_complete(data) {
					 if(data.paymentToken) {
						 jQuery('div.mc-processing-message').show();

						 var submitform = jQuery('<form action="<?php echo $this->payment_return_url; ?>" method="POST" style="display: none;"><input type="submit"/><input type="hidden" name="transaction" value="<?php echo $transactionId; ?>" /></form>');
						 for(var key in data) {
						 	submitform.append(jQuery('<input type="hidden" name="'+key+'" />').val(data[key])); 
						 }
						 jQuery('body').append(submitform);
						 submitform.submit();
					 }
				}
				</script>
				<form id="cc_form" >
					<input type="submit" class="button-alt" id="submit_banklinkmakecommerce_payment_form" value="<?php echo __('Pay with credit card', 'wc_makecommerce_domain'); ?>" />				
					<script type="text/javascript" src="<?php echo $scriptSrc; ?>" <?php echo $this->_toHtmlAttributes($jsParams); ?>></script>
				</form>
				<div class="mc-processing-message"><img src="<?php echo plugins_url('/images/loading.png', __FILE__); ?>"/> <?php echo __('Please wait, processing payment...', 'wc_makecommerce_domain'); ?></div>
				<?php
			}

			
			protected function _toHtmlAttributes($input) {
				$result = array();
				foreach ($input as $key => $value) {
					$result[] = 'data-' . htmlspecialchars($key) . '=' . '"' . htmlspecialchars($value) . '"';
				}
				return implode(' ', $result);
			}        
			
			public function makecommerce_return_trigger($vars) {
				$vars[] = 'makecommerce_return';
				$vars[] = 'ajax_content';
				$vars[] = 'makecommerce_card_pay';
				return $vars;
			}
			
			public function makecommerce_return_trigger_check() {
				if (intval(get_query_var('makecommerce_return')) > 0) {
					$return_url = mk_check_payment();
					if (intval(get_query_var('ajax_content'))) {
						echo json_encode(array('redirect' => $return_url));
					} else {
						wp_redirect($return_url);
					}
					exit;
				}
			}
	
		
		}  // class ends here
		
		New woocommerce_makecommerce(true);

		// Woocommerce Multilingual overrides
		if (is_plugin_active('woocommerce-multilingual/wpml-woocommerce.php')) {
			add_filter( 'get_post_metadata', 'mc_override_payment_method_string', 5, 4 );
		}

	}  // init ends here




	function woocommerce_payment_makecommerce_add($methods) {
		$methods[] = 'woocommerce_makecommerce';
		return $methods;
	}

	add_action('plugins_loaded', 'woocommerce_payment_makecommerce_init');
	add_action('woocommerce_payment_gateways', 'woocommerce_payment_makecommerce_add');

    // Banklinks update wrapper for action
    function update_mc_banklinks() {
		$obj = new woocommerce_makecommerce(true);
		$obj->mc_banklinks_reload(true);
	}

   			 function mc_override_payment_method_string( $check, $object_id, $meta_key, $single ){
		        if($meta_key == '_payment_method_title') {
		            $payment_method = get_post_meta( $object_id, '_payment_method', true );
		            if( $payment_method == 'makecommerce' ){
		                $payment_gateways = WC()->payment_gateways->payment_gateways();
		                if( isset( $payment_gateways[ $payment_method ] ) ){
		                    $title = $payment_gateways[ $payment_method ]->title;
		                    return $title;
		                }
		            }
		        }
		        return $check;
		    }
