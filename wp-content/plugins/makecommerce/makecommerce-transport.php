<?php

	// Parcel machine specific stuff
	function transport_add_method() {

		// Delete all the wc_ship transient scum, you aren’t wanted around here, move along.
		// Same as being in shipping debug mode
		global $wpdb;
		$transients = $wpdb->get_col("SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_wc_ship%'");
		if (count($transients)) {
			foreach ($transients as $tr) {
				$hash = substr($tr, 11);
				delete_transient($hash);
			}
		}
		$transient_value = get_transient('shipping-transient-version');
		WC_Cache_Helper::delete_version_transients( $transient_value );
		if (WC()->session) {
			WC()->session->set('shipping_for_package', '');
		}


		if ( ! class_exists( 'WC_ParcelMachine_Shipping_Method' ) ) {

			class WC_ParcelMachine_Shipping_Method extends WC_Shipping_Method {

				function __construct($instance_id = 0) {
					if (!$this->ext) {
						throw new Exception('Do not call this class directly!');
					}
					$this->id           = 'parcelmachine_' . mb_strtolower($this->ext);
					$this->instance_id  = absint($instance_id);
					$this->method_title = $this->name_ext . ' ' . __(' Parcel Machine (MC)', 'wc_makecommerce_domain');
					// $this->method_description = sprintf(__('Parcel machine transport method for %s', 'wc_makecommerce_domain'), $this->ext);
					$this->supports     = array('shipping-zones', 'instance-settings', 'instance-settings-modal', 'settings');
					$this->init();
					$this->check_updates();
				}

				function check_updates() {
					if (($cur_ver = get_site_option('wc_mc_version', 0)) < WC_MC_VERSION) {
						update_site_option('wc_mc_version', WC_MC_VERSION);
						error_log("Need to update from [{$cur_ver}] to [".WC_MC_VERSION."]");
						if (WC_MC_VERSION === 2.0) {
							// Check if omniva / smartpost is enabled and in which countries
							// Convert to shipping zone
							foreach (array('parcelmachine_omniva' => 'WC_ParcelMachine_Shipping_Method_Omniva', 'parcelmachine_smartpost' => 'WC_ParcelMachine_Shipping_Method_SmartPost', 'parcelmachine_dpd' => 'WC_ParcelMachine_Shipping_Method_DPD') as $method_name => $method_class) {
								$transport_class_omniva = new $method_class();
								if ($transport_class_omniva->enable === 'yes') {
									$zones = WC_Shipping_Zones::get_zones();
									if (!empty($transport_class_omniva->countries)) { continue; }
									foreach ($transport_class_omniva->countries as $ecountry) {
										$has_ecountry = false;
										foreach ($zones as $zone) {
											foreach ($zone['zone_locations'] as $location) {
												if ($location->code === $ecountry) {
													$has_ecountry = $zone['zone_id'];
													foreach ($zone['shipping_methods'] as $method) {
														if ($method->id === $method_name) {
															continue 4;
														}
													}
												}
											}
										}
										if (!$has_ecountry) {
											$zone = new WC_Shipping_Zone();
											$zone->set_zone_name($ecountry);
											$zone->add_location($ecountry, 'country');
											$zone->save();
										} else {
											$zone = new WC_Shipping_Zone($has_ecountry);
										}
										$instance_id = $zone->add_shipping_method($method_name);
										$transport_class = new $method_class($instance_id);
										$price = !empty($transport_class->settings['price_'.strtolower($ecountry)]) ? $transport_class->settings['price_'.strtolower($ecountry)] : 0;
										$free_shipping_min_amount = !empty($transport_class->settings['free_shipping_min_amount_'.strtolower($ecountry)]) ? $transport_class->settings['free_shipping_min_amount_'.strtolower($ecountry)] : 0;
										$transport_class->set_post_data(array($transport_class->get_field_key('price') => $price, $transport_class->get_field_key('free_shipping_min_amount') => $free_shipping_min_amount));
										$transport_class->process_admin_options();
									}
								}
							}
						}
					}
				}

				function init() {
					$this->init_form_fields();
					$this->init_settings();

					$this->enable            = $this->settings['active'];
					$this->title             = !empty($this->settings['method_name']) ? $this->settings['method_name'] : '';
					if (defined('ICL_LANGUAGE_CODE') && !empty($this->settings['method_name_'.ICL_LANGUAGE_CODE])) {
						$this->title = $this->settings['method_name_'.ICL_LANGUAGE_CODE];
					}
					if(!$this->title) {
						$this->title = $this->method_title;
					}
					$this->availability      = 'specific';
					$this->countries         = !empty($this->settings['countries']) ? $this->settings['countries'] : array();
					$this->prioritization    = $this->settings['prioritization'];
					$this->free_shipping_min_amount = !empty($this->settings['free_shipping_min_amount']) ? $this->settings['free_shipping_min_amount'] : 0;
					$this->maximum_weight    = (double)$this->settings['maximum_weight'];
					$this->short_office_names = $this->settings['short_office_names'];
					$this->order_country     = 'unknown';
					add_action('woocommerce_update_options_shipping_' . $this->id, array(&$this, 'process_admin_options'));
					add_filter('woocommerce_review_order_after_shipping' , array(&$this, 'add_parcelmachine_checkout_fields'));
					add_action('woocommerce_checkout_process', array(&$this, 'check_parcelmachine_checkout_fields'));
					add_action('woocommerce_after_checkout_validation', array(&$this, 'check_parcelmachine_checkout_fields'));
					add_action('woocommerce_checkout_update_order_meta', array(&$this, 'add_parcelmachine_order_meta'));

					// Woocommerce Multilingual overrides
					if (is_plugin_active('woocommerce-multilingual/wpml-woocommerce.php')) {
						add_filter('woocommerce_package_rates', array($this, 'override_label_translation'), 50);
						add_filter('woocommerce_order_get_items', array($this, 'override_shipping_title_translation'), 50, 2);
					}
				}

				public function override_label_translation($rates) {
					$id_instance = $this->id . ':' . $this->instance_id;
					if(array_key_exists($id_instance, $rates)) {
						$rates[$id_instance]->label = $this->title;
					}
					return $rates;
				}

				public function override_shipping_title_translation($items, $order) {
					foreach ($items as $key => $item) {
						if($item['type'] == 'shipping') {
							foreach ($item['item_meta_array'] as $meta) {
								if ($meta->key === 'method_id') {
									$tmp = explode(':', $meta->value);
									if ($tmp[0] == $this->id) {
										$items[$key]['name'] = $this->title;
									}
								}
							}
						}
					}
					return $items;
				}

				public function generate_shipping_ui_javascript_html( $key, $data ) { ?>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							var country_select = $('#woocommerce_parcelmachine_<?php echo strtolower($this->ext); ?>_countries');
							var prices = [], free_shippings = [];
							$.each(country_select.find('option'), function(i, option) {
								prices[$(option).val()] = $('#woocommerce_parcelmachine_<?php echo strtolower($this->ext); ?>_price_' + $(option).val().toLowerCase()).closest('tr');
								free_shippings[$(option).val()] = $('#woocommerce_parcelmachine_<?php echo strtolower($this->ext); ?>_free_shipping_min_amount_' + $(option).val().toLowerCase()).closest('tr');
							});
							country_select.on('change', function(){
								var countries = $(this).val();
								if(countries) {
									hidePrices(countries);
								}
							});
							hidePrices(country_select.val());
							function hidePrices(countries) {
								for (var key in prices) {
									if(countries.indexOf(key) == -1){
										prices[key].hide();
										free_shippings[key].hide();
									} else {
										prices[key].show();
										free_shippings[key].show();
									}
								}
							}
						});
					</script>
				<?php }

				function calculate_shipping($package = array()) {
					$price = isset($this->instance_settings['price']) ? $this->instance_settings['price'] : (isset($this->settings['price_'.$package['destination']['country']]) ? $this->settings['price_'.$package['destination']['country']] : 0);

					$free_shipping_min_amount = $this->instance_settings['free_shipping_min_amount'];

					if ($free_shipping_min_amount && $package['contents_cost'] >= $free_shipping_min_amount) {
						$price = 0;
					}

					$free_shipping = true;
					foreach ($package['contents'] as $line) {
						$free_shipping = get_post_meta($line['product_id'], '_no_shipping_cost', true) === 'yes' ? $free_shipping : false;
					}
					if($free_shipping) {
						$price = 0;
					}
					$rate = array(
						'id' 	=> $this->get_rate_id(),
						'label' => $this->title,
						'cost' 	=> $price,
						'package' => $package,
						'calc_tax' => 'per_order',
					);
					$this->add_rate( $rate );
				}

				function calculate_weight($package) {
					$weight = 0;
					foreach ($package['contents'] as $line) {
						$weight += (double)$line['data']->get_weight();
					}
					return $weight;
				}

				function fits_parcel_machine($package) {
					foreach ($package['contents'] as $line) {
						if (get_post_meta($line['product_id'], '_no_parcel_machine', true) === 'yes') {
							return false;
						}
					}
					return true;
				}

				function is_available($package) {
					if (!$this->fits_parcel_machine($package)) {
						return false;
					}
					$package_weight = $this->calculate_weight($package);
					if ($package_weight >= $this->maximum_weight) {
						return false;
					}
					$is_available = $this->enable === 'yes';
					if (!$is_available || !mk_is_api_set()) {
						return false;
					}
					//if (is_array($this->countries) && !in_array($package['destination']['country'], $this->countries)) {
					//	$is_available = false;
					//}
					$this->order_country = $package['destination']['country'];
					return apply_filters('woocommerce_shipping_' . $this->id . '_is_available', $is_available, $package);
				}

				function mk_get_machines() {
					$machines = mk_get_machines($this->ext, $this->order_country);
					if ($this->prioritization === 'yes') {
						usort($machines, function($a, $b) {
							$sortorder = array(
								'tallinn', 'tartu linn','tartu', 'narva', 'pärnu linn','pärnu', 'viljandi', 'kohtla-järve', 'rakvere', 'maardu', 'sillamäe', 'kuressaare',
								'helsinki', 'espoo', 'tampere', 'vantaa', 'oulu', 'turku', 'jüväskülä', 'lahti', 'kuopio', 'kouvola',
								'rīga','riga', 'daugavpils', 'liepāja','liepaja', 'jelgava', 'jūrmala','jurmala', 'ventspils', 'rezekne', 'valmiera', 'jekabpils',
								'vilnius', 'kaunas', 'klaipeda', 'siauliai', 'panevezys', 'alytus', 'mariampole', 'mazeikiai', 'jonava', 'utena'
							);
							$acity = mb_strtolower($a['city']);
							$bcity = mb_strtolower($b['city']);
							if (!$acity) { $acity = 'xxxxxxx'; }
							if (!$bcity) { $bcity = 'xxxxxxx'; }
							$aidx = array_search($acity, $sortorder);
							$bidx = array_search($bcity, $sortorder);
							if ($aidx !== false) {
								$acity = str_pad($aidx, 4, "0", STR_PAD_LEFT) . '-' . $acity;
							}
							if ($bidx !== false) {
								$bcity = str_pad($bidx, 4, "0", STR_PAD_LEFT) . '-' . $bcity;
							}
							$acity .= '-' . mb_strtolower($a['name']);
							$bcity .= '-' . mb_strtolower($b['name']);
							return $acity < $bcity ? -1 : 1;
						});
					}
					return $machines;
				}

				function add_parcelmachine_checkout_fields($fragments) {
					$this->order_country = WC()->customer->get_shipping_country();
					$res = '';
					$res .= '<tr style="display: none;" class="parcel_machine_checkout parcel_machine_checkout_parcelmachine_'.mb_strtolower($this->ext).'">';
					// echo '<th>' . $this->title . '</th>';
					// echo '<td>';
					$res .= '<td colspan="2">';
					$options = array();
					$machines = $this->mk_get_machines();
					$res .= '<p class="form-row" id="'.esc_attr($this->id).'_field">';
					$res .= '<select class="select" name="'.esc_attr($this->id).'" id="'.esc_attr($this->id).'">';
					$res .= '<option value="">'.__('-- select parcel machine --', 'wc_makecommerce_domain').'</option>';
					$pcity = false;
					foreach ($machines as $machine) {
						$city = strtolower($machine['city']);
						if ($city !== $pcity) {
							if ($pcity) $res .= '</optgroup>';
							$res .= '<optgroup label="'.$machine['city'].'">';
						}
						$mname = $machine['name'];
						if ($this->short_office_names !== 'yes') $mname .= ' - ' . $machine['city'] . ', ' . $machine['address'];
						$res .= '<option value="'.esc_attr($machine['carrier'].'||'.$machine['id']).'">'.$mname.'</option>';
						$pcity = $city;
					}
					if ($pcity) $res .= '</optgroup>';
					$res .= '</select>';
					$res .= '</p>';
					$res .= '</td></tr>';
					echo $res;
				}

				function check_parcelmachine_checkout_fields() {
					static $added1 = false;
					static $added2 = false;
					$shipping_method = !empty($_POST['shipping_method']) ? $_POST['shipping_method'] : false;
					if (!empty($shipping_method[0])) { $shipping_method_ext = explode(':', $shipping_method[0]); }
					if (!$added1 && $shipping_method_ext[0] === $this->id && empty($_POST[$shipping_method_ext[0]])) {
						wc_add_notice(__('<strong>Parcel machine</strong> is a required field.', 'wc_makecommerce_domain'), 'error');
						$added1 = true;
					}
					if (!$added2 && $shipping_method_ext[0] === $this->id && !$this->valid_phone_number($_POST['billing_phone'])) {
						wc_add_notice(__('<strong>Parcel machine</strong> can be used with local phone number only. Please specify your phone number with international access code (like +372xxxxxxx)', 'wc_makecommerce_domain'), 'error');
						$added2 = true;
					}
				}

				function valid_phone_number($phone) {
					$phone = trim($phone);
					$phone = trim($phone, '+');
					// Estonia for all
					if (substr($phone, 0, 4) === '3725' || substr($phone, 0, 1) === '5') { return true; }
					// Latvia for Omniva
					if ($this->carrier === 'omniva' && substr($phone, 0, 3) === '371') { return true; }
					// Lithuania for Omniva
					if ($this->carrier === 'omniva' && substr($phone, 0, 3) === '370') { return true; }
					// Finland for Smartpost
					if ($this->carrier === 'smartpost' && substr($phone, 0, 3) === '358') { return true; }
					return false;
				}

				function add_parcelmachine_order_meta($order_id) {
					$shipping_method = !empty($_POST['shipping_method']) ? $_POST['shipping_method'] : false;
					if (!empty($shipping_method[0])) { $shipping_method_ext = explode(':', $shipping_method[0]); }
					if ($shipping_method_ext[0] === $this->id && !empty($_POST[$this->id])) {
						list($carrier, $machine) = explode('||', $_POST[$this->id]);
						$machine = mk_get_machine($carrier, $machine);
						if (!empty($machine['id'])) {
							update_post_meta($order_id, '_shipping_first_name', get_post_meta($order_id, '_billing_first_name', true));
							update_post_meta($order_id, '_shipping_last_name', get_post_meta($order_id, '_billing_last_name', true));
							update_post_meta($order_id, '_shipping_address_1', sanitize_text_field($machine['name']));
							update_post_meta($order_id, '_shipping_address_2', sanitize_text_field($machine['address']));
							update_post_meta($order_id, '_shipping_city', sanitize_text_field($machine['city']));
							update_post_meta($order_id, '_shipping_postcode', '');
							update_post_meta($order_id, '_parcel_machine', sanitize_text_field($_POST[$this->id]));
						}
					}
				}
			}



			$enable = get_option('mk_transport_apt_omniva', 'yes');
			if ($enable === 'yes') {
				class WC_ParcelMachine_Shipping_Method_Omniva extends WC_ParcelMachine_Shipping_Method {
					function __construct($instance_id = 0) {
						$this->ext = 'Omniva';
						$this->name_ext = 'Omniva';
						$this->carrier = 'omniva';
						$this->type = 'apt';
						parent::__construct($instance_id);
						if (is_admin()) {
							add_action( 'wp_ajax_verify_feature_swc', array(&$this, 'mc_check_feature_swc') );
						}
					
					}

					
					public function mc_check_feature_swc() {
						$status = $this->mc_check_feature('shipments_without_credentials');
						wp_send_json(array('feature_name' => 'shipments_without_credentials', 'feature_status' => $status));
						exit; 
					}


					public function mc_check_feature($feature_name = '') {
						
						$feature_enabled = false;
						
						$request_params = array(
							'environment' => json_encode(array(
								'platform' => 'woocommerce '. WC()->version,
								'module' => 'makecommerce feature_staus_check',
							)),
						);

						$MK = mk_get_api();
						if (!$MK) {
							return false;
						}
												
						try {
							$shopConfig = $MK->getShopConfig($request_params);
							$features = $shopConfig->features;	
						} catch (Exception $e) {
							error_log(print_r($e, 1));
							return false;
						}
						
						if(isset($features)) {
							foreach($features as $feature) {
								if ($feature->name == $feature_name) {
									$feature_enabled = $feature->enabled;
								}

							}
						}
							
						return $feature_enabled;
					}


					function init_form_fields() {

						$this->instance_form_fields = array();
						$this->instance_form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->instance_form_fields['price'] = array(
								'title'            => __('Shipping price', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => '5.00'
							);
						$this->instance_form_fields['free_shipping_min_amount'] = array(
								'title'            => __('Free shipping amount', 'wc_makecommerce_domain'),
								'type'             => 'number',
								'default'          => '0',
								'desc_tip'	   	   => __('(0 means no free shipping)', 'wc_makecommerce_domain'),
							);

						$this->form_fields = array();
						$this->form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->form_fields['generic'] = array(
								'type' 				=> 'title', 
								'title'				=> __('Generic and pricing options', 'wc_makecommerce_domain'),
								'description'      	=> __('You can always exclude a product from being available for the Parcel Machine delivery by clicking "Does not fit parcel machine" in the product\'s shipping options.', 'wc_makecommerce_domain').'<br>'.__('You can mark there also a product as "Free shipping in parcel machine."', 'wc_makecommerce_domain'),	
							);
						$this->form_fields['active'] = array(
								'title'            => __('Enable', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('enabled', 'wc_makecommerce_domain'),
								'default'          => 'no',
							);
						$this->form_fields['maximum_weight'] = array(
								'title'            => sprintf(__('Maximum weight allowed for shipping (%s)', 'wc_makecommerce_domain'), get_option('woocommerce_weight_unit' )),
								'type'             => 'text',
								'default'          => '30'
							);

						$this->form_fields['look_and_feel'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('Look and feel options', 'wc_makecommerce_domain'), 'description' => __('Options for presentation on check-out page', 'wc_makecommerce_domain'));

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

						if (empty($languages)) {
							$this->form_fields['method_name'] = array(
									'title'            => __('Shipping Method Title', 'wc_makecommerce_domain'),
									'type'             => 'text',
									'default'          => __('Omniva Parcel Machine', 'wc_makecommerce_domain')
								);
						} else {
							foreach ($languages as $language_code => $language) {
								$language_name = !empty($language['translated_name']) ? $language['translated_name'] : $language_code;
								$defaultName = __('Omniva Parcel Machine', 'wc_makecommerce_domain');
								switch ($language_code) {
									case 'et':
										$defaultName = 'Omniva pakiautomaat';
										break;
									case 'ru':
										$defaultName = 'Omniva посылочный автомат';
										break;
									case 'fi':
										$defaultName = 'Omniva pakettiautomaatti';
										break;  
									case 'lv':
										$defaultName = 'Omniva Pakomāts';
										break;  							             
								}									
								$this->form_fields['method_name_'.$language_code] = array(
										'title'            => __('Shipping Method Title', 'wc_makecommerce_domain').sprintf(' (%s)', $language_code),
										'type'             => 'text',
										'default'          => $defaultName
									);
							}
						}
						$this->form_fields['prioritization'] = array(
								'title'            => __('Prioritize', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('Bigger cities will be on top of list, others sorted alphabetically', 'wc_makecommerce_domain'),
								'default'          => 'yes'
							);
						$this->form_fields['short_office_names'] = array(
								'title'            => __('Short names', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('Display only parcel machine names, without addresses', 'wc_makecommerce_domain'),
								'default'          => 'no'
							);

						$this->form_fields['api_access'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('API access for', 'wc_makecommerce_domain').' '.$this->ext, 'description' => __('You can automatically register the shipments into Omniva system and print out the package labels right here, at the shop orders view. <br> (see more on <a href="https://makecommerce.net/en/integration-modules/makecommerce-woocommerce-payment-plugin/#carriers-integration">MakeCommerce plugin homepage</a>.)', 'wc_makecommerce_domain'). '<br><br>' .__('If you do not have contract with Ominva, no worries - you can send the parcels using MakeCommerce transport mediation service.<br>The cost of transport will be deducted on your Makecommerce account. See more info and pricing <a href="https://makecommerce.net/service/delivery/">here</a>  ', 'wc_makecommerce_domain').'<br>'.__('The service can be enabled in', 'wc_makecommerce_domain').' <a href="https://merchant-test.maksekeskus.ee/features.html">'.__('Merchant Portal', 'wc_makecommerce_domain').'</a>');

						$this->form_fields['use_mk_contract'] = array(
								'type' => 'select',
								'title' => __('Contract', 'wc_makecommerce_domain'),
								'options' => array(
							        false => __('use my own Omniva contract', 'wc_makecommerce_domain'),
							        true => __('use MakeCommerce transport mediation service', 'wc_makecommerce_domain'),
				        			),
								'default' => false,
								'description' => '',
							);
						$this->form_fields['verify_feature_swc'] = array(
								'type' => 'verify_feature_swc',
								'title' => __('Verify service status', 'wc_makecommerce_domain'),
								'description' => __('You must enable the Transport mediation service before using it.', 'wc_makecommerce_domain'),
								'desc_tip' => __('This will check if the Transport mediation service has been enabled for your shop.', 'wc_makecommerce_domain'),
								'placeholder'  => __('Verify', 'wc_makecommerce_domain'),
							);
						$this->form_fields['service_user'] = array(
								'title'            => __('Omniva web services username', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['service_password'] = array(
								'title'            => __('Omniva web services password', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['return_address'] = array( 'type' => 'title', 'title' => '<br><br>'.__('Return address', 'wc_makecommerce_domain'), 'description' => __('Return address is printed on parcel labels, and is also used when customer wants to return the parcel', 'wc_makecommerce_domain'));
						$this->form_fields['shop_name'] = array(
								'type' => 'text',
								'title' => __('Shop name', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_phone'] = array(
								'type' => 'text',
								'title' => __('Shop phone', 'wc_makecommerce_domain'),
								'title' => __('Shop phone', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_email'] = array(
								'type' => 'text',
								'title' => __('Shop email', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_address_country'] = array(
								'type' => 'select',
								'title' => __('Shop address country', 'wc_makecommerce_domain'),
								'options' => array(
							        'EE' => 'EE',
							        'LV' => 'LV',
							        'LT' => 'LT',
				        			),
								'default' => 'EE',
							);
						$this->form_fields['shop_address_city'] = array(
								'type' => 'text',
								'title' => __('Shop address city', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);					
						$this->form_fields['shop_address_street'] = array(
								'type' => 'text',
								'title' => __('Shop address street', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);					
						$this->form_fields['shop_postal_code'] = array(
								'type' => 'text',
								'title' => __('Shop postal code', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shipping_ui_javascript'] = array(
							'type' => 'shipping_ui_javascript',
						);

					}

					public function generate_verify_feature_swc_html( $key, $data ) {		
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
									<input id="verify_feature_swc" class="button <?php echo esc_attr( $data['class'] ); ?>" type="button" name="<?php echo esc_attr( $field ); ?>" id="<?php echo esc_attr( $field ); ?>" style="<?php echo esc_attr( $data['css'] ); ?>" value="<?php echo esc_attr( $data['placeholder'] ); ?>" placeholder="<?php echo esc_attr( $data['placeholder'] ); ?>" <?php disabled( $data['disabled'], true ); ?> <?php echo $this->get_custom_attribute_html( $data ); ?> /> 
										<!-- <br><p><?php echo esc_attr( $data['description'] ); ?></p> -->
									<script type="text/javascript">
									jQuery('input#verify_feature_swc').on('click', function() {
											init_mc_loading();
											jQuery.ajax({
												url: '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php',
												type: 'POST',
												data: 'action=verify_feature_swc',
												success: function (output) {
													if(output) {
														if (output.feature_status == true) {
															alert('<?php echo __('There Transport Mediation service is already enabled for your Shop. \n You are good to go!', 'wc_makecommerce_domain'); ?>');
														} else {
															alert('<?php echo __('There Transport Mediation service is NOT ENABLED enabled for your Shop. \n Please go to Merchant Portal to activate it!', 'wc_makecommerce_domain'); ?>');
														}
														
													} else {
														alert('<?php echo __('There was an error with your request. Please try again.', 'wc_makecommerce_domain'); ?>');
													}
												},
												complete: function() { stop_mc_loading(); }
											});
									});
									
									function init_mc_loading() {
										jQuery('input#verify_feature_swc').attr('disabled', 'disabled');
									}
									
									function stop_mc_loading() {
										jQuery('input#verify_feature_swc').removeAttr('disabled');
									}
									</script>
								</fieldset>
							</td>
						</tr>
						<?php

						return ob_get_clean();
					}

				}
			}

			$enable = get_option('mk_transport_apt_dpd', 'yes');
			if ($enable === 'yes') {
				class WC_ParcelMachine_Shipping_Method_DPD extends WC_ParcelMachine_Shipping_Method {
					function __construct($instance_id = 0) {
						$this->ext = 'DPD';
						$this->name_ext = 'DPD';
						$this->carrier = 'dpd';
						$this->type = 'apt';
						parent::__construct($instance_id);
						$this->method_title = __('DPD Pickup Network', 'wc_makecommerce_domain').' (MC)';
					}
					function init_form_fields() {

						$this->instance_form_fields = array();
						$this->instance_form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->instance_form_fields['price'] = array(
								'title'            => __('Shipping price', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => '5.00'
							);
						$this->instance_form_fields['free_shipping_min_amount'] = array(
								'title'            => __('Free shipping amount', 'wc_makecommerce_domain'),
								'type'             => 'number',
								'default'          => '0',
								'desc_tip'	   	   => __('(0 means no free shipping)', 'wc_makecommerce_domain'),
							);

						$this->form_fields = array();
						$this->form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->form_fields['generic'] = array(
								'type' 				=> 'title', 
								'title'				=> __('Generic and pricing options', 'wc_makecommerce_domain'),
								'description'      	=> __('You can always exclude a product from being available for the Parcel Machine delivery by clicking "Does not fit parcel machine" in the product\'s shipping options.', 'wc_makecommerce_domain').'<br>'.__('You can mark there also a product as "Free shipping in parcel machine."', 'wc_makecommerce_domain'),	
							);
						$this->form_fields['active'] = array(
								'title'            => __('Enable', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('enabled', 'wc_makecommerce_domain'),
								'default'          => 'no',
							);
						$this->form_fields['maximum_weight'] = array(
								'title'            => sprintf(__('Maximum weight allowed for shipping (%s)', 'wc_makecommerce_domain'), get_option('woocommerce_weight_unit' )),
								'type'             => 'text',
								'default'          => '30'
							);

						$this->form_fields['look_and_feel'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('Look and feel options', 'wc_makecommerce_domain'), 'description' => __('Options for presentation on check-out page', 'wc_makecommerce_domain'));

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

						if (empty($languages)) {
							$this->form_fields['method_name'] = array(
									'title'            => __('Shipping Method Title', 'wc_makecommerce_domain'),
									'type'             => 'text',
									'default'          => __('DPD Pickup Network', 'wc_makecommerce_domain')
								);
						} else {
							foreach ($languages as $language_code => $language) {
								$language_name = !empty($language['translated_name']) ? $language['translated_name'] : $language_code;
								$defaultName = __('DPD Pickup Network', 'wc_makecommerce_domain');
								switch ($language_code) {
									case 'et':
										$defaultName = 'DPD Pickup võrgustik';
										break;
									case 'ru':
										$defaultName = 'DPD Pickup сеть';
										break;
									case 'fi':
										$defaultName = 'DPD Pickup verkko';
										break;  
									case 'lv':
										$defaultName = 'DPD Pickup tīkls';
										break;  							             
								}									
								$this->form_fields['method_name_'.$language_code] = array(
										'title'            => __('Shipping Method Title', 'wc_makecommerce_domain').sprintf(' (%s)', $language_code),
										'type'             => 'text',
										'default'          => $defaultName
									);
							}
						}
						$this->form_fields['prioritization'] = array(
								'title'            => __('Prioritize', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('Bigger cities will be on top of list, others sorted alphabetically', 'wc_makecommerce_domain'),
								'default'          => 'yes'
							);
						$this->form_fields['short_office_names'] = array(
								'title'            => __('Short names', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('Display only parcel machine names, without addresses', 'wc_makecommerce_domain'),
								'default'          => 'no'
							);
						if (mk_wc_version("3.4.0")) $a = 'admin.php?page=wc-settings&tab=advanced&section=mk_api'; else $a = 'admin.php?page=wc-settings&tab=api&section=mk_api';
						$this->form_fields['api_access'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('API access for', 'wc_makecommerce_domain').' '.$this->ext, 'description' => sprintf(__('You can automatically create shipments into DPD system, DPD will send parcel-labels automatically to your e-mail <br> Please set your InterConnect (IC) account credentials below here. <br>See more details on <a href="https://makecommerce.net/en/integration-modules/makecommerce-woocommerce-payment-plugin/#carriers-integration">MakeCommerce plugin page</a>.', 'wc_makecommerce_domain'), admin_url($a)));
						$this->form_fields['service_user'] = array(
								'title'            => __('DPD InterConnect username', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['service_password'] = array(
								'title'            => __('DPD InterConnect password', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['return_address'] = array( 'type' => 'title', 'title' => __('Return address', 'wc_makecommerce_domain'), 'description' => __('Please define return address for DPD shipments', 'wc_makecommerce_domain'));
						$this->form_fields['shop_name'] = array(
								'type' => 'text',
								'title' => __('Shop name', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_phone'] = array(
								'type' => 'text',
								'title' => __('Shop phone', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_email'] = array(
								'type' => 'text',
								'title' => __('Shop email', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_address_country'] = array(
								'type' => 'select',
								'title' => __('Shop address country', 'wc_makecommerce_domain'),
								'options' => array(
							        'EE' => 'EE',
							        'LV' => 'LV',
							        'LT' => 'LT',
				        			),
								'default' => 'EE',
							);
						$this->form_fields['shop_address_city'] = array(
								'type' => 'text',
								'title' => __('Shop address city', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);					
						$this->form_fields['shop_address_street'] = array(
								'type' => 'text',
								'title' => __('Shop address street', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);					
						$this->form_fields['shop_postal_code'] = array(
								'type' => 'text',
								'title' => __('Shop postal code', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shipping_ui_javascript'] = array(
							'type' => 'shipping_ui_javascript',
						);
					}
				}
			}





			$enable = get_option('mk_transport_apt_smartpost', 'yes');
			if ($enable === 'yes') {
				class WC_ParcelMachine_Shipping_Method_Smartpost extends WC_ParcelMachine_Shipping_Method {
					function __construct($instance_id = 0) {
						$this->ext = 'SmartPost';
						$this->name_ext = 'SmartPOST';
						$this->carrier = 'smartpost';
						$this->type = 'apt';
						parent::__construct($instance_id);
					}
					function init_form_fields() {

						global $woocommerce;

						$this->instance_form_fields = array();
						$this->instance_form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());

						$this->instance_form_fields['price'] = array(
								'title'            => __('Shipping price', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => '5.00'
							);
						$this->instance_form_fields['free_shipping_min_amount'] = array(
								'title'            => __('Free shipping amount', 'wc_makecommerce_domain'),
								'type'             => 'number',
								'default'          => '0',
								'desc_tip'	   => __('(0 means no free shipping)', 'wc_makecommerce_domain'),
							);

						$this->form_fields = array();
						$this->form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->form_fields['generic'] = array(
								'type' 				=> 'title', 
								'title'				=> __('Generic and pricing options', 'wc_makecommerce_domain'),
								'description'      	=> __('You can always exclude a product from being available for the Parcel Machine delivery by clicking "Does not fit parcel machine" in the product\'s shipping options.', 'wc_makecommerce_domain').'<br>'.__('You can mark there also a product as "Free shipping in parcel machine."', 'wc_makecommerce_domain'),	
							);

						$this->form_fields['active'] = array(
								'title'            => __('Enable', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('enabled', 'wc_makecommerce_domain'),
								'default'          => 'no',
							);
						$this->form_fields['maximum_weight'] = array(
								'title'            => sprintf(__('Maximum weight allowed for shipping (%s)', 'wc_makecommerce_domain'), get_option('woocommerce_weight_unit' )),
								'type'             => 'text',
								'default'          => '30'
							);

						$this->form_fields['look_and_feel'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('Look and feel options', 'wc_makecommerce_domain'), 'description' => __('Options for presentation on checkout page', 'wc_makecommerce_domain'));

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

						if (empty($languages)) {
							$this->form_fields['method_name'] = array(
									'title'            => __('Shipping Method Title', 'wc_makecommerce_domain'),
									'type'             => 'text',
									'default'          => __('SmartPOST Parcel Machine', 'wc_makecommerce_domain')
								);
						} else {
							foreach ($languages as $language_code => $language) {
								$language_name = !empty($language['translated_name']) ? $language['translated_name'] : $language_code;
								$defaultName = __('SmartPOST Parcel Machine', 'wc_makecommerce_domain');
								switch ($language_code) {
									case 'et':
										$defaultName = 'SmartPOST pakiautomaat';
										break;
									case 'ru':
										$defaultName = 'SmartPOST посылочный автомат';
										break;
									case 'fi':
										$defaultName = 'SmartPOST pakettiautomaatti';
										break;   
									case 'lv':
										$defaultName = 'SmartPOST Pakomāts';
										break;       
								}
								$this->form_fields['method_name_'.$language_code] = array(
										'title'            => __('Shipping Method Title', 'wc_makecommerce_domain').sprintf(' (%s)', $language_code),
										'type'             => 'text',
										'default'          => $defaultName
									);
							}
						}
						$this->form_fields['prioritization'] = array(
								'title'            => __('Prioritize', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('Bigger cities will be on top of list, others sorted alphabetically', 'wc_makecommerce_domain'),
								'default'          => 'yes'
							);
						$this->form_fields['short_office_names'] = array(
								'title'            => __('Short names', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('Display only parcel machine names, without addresses', 'wc_makecommerce_domain'),
								'default'          => 'no'
							);
						if (mk_wc_version("3.4.0"))  $a = 'admin.php?page=wc-settings&tab=advanced&section=mk_api'; else $a = 'admin.php?page=wc-settings&tab=api&section=mk_api';
						$this->form_fields['api_access'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('API access for', 'wc_makecommerce_domain').' '.$this->ext, 'description' => sprintf(__('You can automatically create shipments into smartpost.ee system and print the out the package labels right here, at the shop orders view. <br> Please set your smartpost.ee account credentials below here. <br>(See more on <a href="https://makecommerce.net/en/integration-modules/makecommerce-woocommerce-payment-plugin/#carriers-integration">MakeCommerce plugin page</a>.   Don\'t forget to enable also <a href="%s">MC API keys</a>!)', 'wc_makecommerce_domain'), admin_url($a)));
						$this->form_fields['service_user'] = array(
								'title'            => __('eteenindus.smartpost.ee username', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['service_password'] = array(
								'title'            => __('eteenindus.smartpost.ee password', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['return_address'] = array( 'type' => 'title', 'title' => __('Return address', 'wc_makecommerce_domain'), 'description' => __('Please define return address for SmartPOST shipments (used on parcel labels)', 'wc_makecommerce_domain'));
						$this->form_fields['shop_name'] = array(
								'type' => 'text',
								'title' => __('Shop name', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_phone'] = array(
								'type' => 'text',
								'title' => __('Shop phone', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_email'] = array(
								'type' => 'text',
								'title' => __('Shop email', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shipping_ui_javascript'] = array(
							'type' => 'shipping_ui_javascript',
						);
					}
				}
			}

		}

		if ( ! class_exists( 'WC_Courier_Shipping_Method' ) ) {

			class WC_Courier_Shipping_Method extends WC_Shipping_Method {

				public function __construct($instance_id = 0) {
					$this->id           = 'courier_'.$this->carrier;
					$this->type         = 'cou';
					$this->instance_id  = absint($instance_id);
					$this->method_title = $this->name_ext .' '.__('courier (MC)', 'wc_makecommerce_domain');
					// $this->method_description = sprintf(__('Courier transport method for %s', 'wc_makecommerce_domain'), $this->ext);
					$this->supports     = array('shipping-zones', 'instance-settings', 'instance-settings-modal', 'settings');
					$this->init();
				}

				public function init() {
					$this->init_form_fields();
					$this->init_settings();

					$this->enable            = $this->settings['active'];
					if (defined('ICL_LANGUAGE_CODE') && !empty($this->settings['method_name_'.ICL_LANGUAGE_CODE])) {
						$this->title = $this->settings['method_name_'.ICL_LANGUAGE_CODE];
					} else if (!empty($this->settings['method_name'])) {
						$this->title = $this->settings['method_name'];
					}
					if (empty($this->title)) {
						$this->title = $this->method_title;
					}
					$this->availability      = 'specific';
					$this->free_shipping_min_amount = !empty($this->settings['free_shipping_min_amount']) ? $this->settings['free_shipping_min_amount'] : 0;
					$this->maximum_weight    = (double)$this->settings['maximum_weight'];
					$this->order_country     = 'unknown';
					add_action('woocommerce_update_options_shipping_' . $this->id, array(&$this, 'process_admin_options'));
					// !!! Commented out for now
					// add_filter('woocommerce_order_shipping_to_display_shipped_via', array(&$this, 'add_admin_courier_via_field'));
					// add_filter('woocommerce_order_shipping_method', array(&$this, 'add_admin_courier_via_field'));

					// Woocommerce Multilingual overrides
					if (is_plugin_active('woocommerce-multilingual/wpml-woocommerce.php')) {
						add_filter('woocommerce_package_rates', array($this, 'override_label_translation'), 50);
						add_filter('woocommerce_order_get_items', array($this, 'override_shipping_title_translation'), 50, 2);
					}
				}

				public function override_label_translation($rates) {
					$id_instance = $this->id . ':' . $this->instance_id;
					if(array_key_exists($id_instance, $rates)) {
						$rates[$id_instance]->label = $this->title;
					}
					return $rates;
				}

				public function override_shipping_title_translation($items, $order) {
					foreach ($items as $key => $item) {
						if($item['type'] == 'shipping') {
							foreach ($item['item_meta_array'] as $meta) {
								if ($meta->key === 'method_id') {
									$tmp = explode(':', $meta->value);
									if ($tmp[0] == $this->id) {
										$items[$key]['name'] = $this->title;
									}
								}
							}
						}
					}
					return $items;
				}

				public function calculate_shipping($package = array()) {

					$price = $this->instance_settings['price'];

					$free_shipping_min_amount = $this->instance_settings['free_shipping_min_amount'];

					if ($free_shipping_min_amount && $package['contents_cost'] >= $free_shipping_min_amount) {
						$price = 0;
					}

					$rate = array(
						'id' 	=> $this->get_rate_id(),
						'label' => $this->title,
						'cost' 	=> $price,
						'package' => $package,
						'calc_tax' => 'per_order',
					);
					$this->add_rate( $rate );
				}

				public function calculate_weight($package) {
					$weight = 0;
					foreach ($package['contents'] as $line) {
						$weight += (double)$line['data']->get_weight();
					}
					return $weight;
				}

				public function is_available($package) {

					$package_weight = $this->calculate_weight($package);
					if ($package_weight >= $this->maximum_weight) {
						return false;
					}
					$is_available = $this->enable === 'yes';
					if (!$is_available || !mk_is_api_set()) {
						return false;
					}

					$this->order_country = $package['destination']['country'];
					return apply_filters('woocommerce_shipping_' . $this->id . '_is_available', $is_available, $package);
				}

				public function add_admin_courier_via_field($order) {
					return ' <small>(via ' . $this->name_ext . ' ' . __('Courier', 'wc_makecommerce_domain') . ')</small>';
				}
				
			}


			$enable = get_option('mk_transport_courier_omniva', 'yes');
			if ($enable === 'yes') {
				class WC_Courier_Shipping_Method_Omniva extends WC_Courier_Shipping_Method {

					public function __construct($instance_id = 0) {
						$this->ext          = 'Omniva';
						$this->name_ext     = 'Omniva';
						$this->carrier      = 'omniva';
						parent::__construct($instance_id);
					}

					public function init_form_fields() {

						global $woocommerce;

						$this->instance_form_fields = array();
						$this->instance_form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->instance_form_fields['price'] = array(
								'title'            => __('Shipping price', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => '4.95'
							);
						$this->instance_form_fields['free_shipping_min_amount'] = array(
								'title'            => __('Free shipping amount', 'wc_makecommerce_domain'),
								'type'             => 'number',
								'default'          => '0',
								'desc_tip'	   	   => __('(0 means no free shipping)', 'wc_makecommerce_domain'),
							);

						$this->form_fields = array();
						$this->form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->form_fields['generic'] = array(
								'type' 				=> 'title', 
								'title'				=> __('Generic and pricing options', 'wc_makecommerce_domain'),
								// 'description'      	=> __('', 'wc_makecommerce_domain'),	
							);
						$this->form_fields['active'] = array(
								'title'            => __('Enable', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('enabled', 'wc_makecommerce_domain'),
								'default'          => 'no',
							);
						$this->form_fields['maximum_weight'] = array(
								'title'            => sprintf(__('Maximum weight allowed for shipping (%s)', 'wc_makecommerce_domain'), get_option('woocommerce_weight_unit' )),
								'type'             => 'text',
								'default'          => '60'
							);

						$this->form_fields['look_and_feel'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('Look and feel options', 'wc_makecommerce_domain'), 'description' => __('Options for presentation on check-out page', 'wc_makecommerce_domain'));

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

						if (empty($languages)) {
							$this->form_fields['method_name'] = array(
									'title'            => __('Shipping Method Title', 'wc_makecommerce_domain'),
									'type'             => 'text',
									'default'          => __('Omniva Courier', 'wc_makecommerce_domain')
								);
						} else {
							foreach ($languages as $language_code => $language) {
								$language_name = !empty($language['translated_name']) ? $language['translated_name'] : $language_code;
								$defaultName = __('Omniva Courier', 'wc_makecommerce_domain');
								switch ($language_code) {
									case 'et':
										$defaultName = 'Omniva kuller';
										break;
									case 'ru':
										$defaultName = 'Omniva Курьер';
										break;
									case 'fi':
										$defaultName = 'Omniva kuriiri';
										break;   
									case 'lv':
										$defaultName = 'Omniva kurjers';
										break;       
									case 'lt':
										$defaultName = 'Omniva kurjeris';
										break;  
								}
								$this->form_fields['method_name_'.$language_code] = array(
										'title'            => __('Shipping Method Title', 'wc_makecommerce_domain').sprintf(' (%s)', $language_code),
										'type'             => 'text',
										'default'          => $defaultName
									);
							}
						}

						if (mk_wc_version("3.4.0")) $a = 'admin.php?page=wc-settings&tab=advanced&section=mk_api'; else $a = 'admin.php?page=wc-settings&tab=api&section=mk_api';
						$this->form_fields['api_access'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('API access for', 'wc_makecommerce_domain').' '.$this->ext, 'description' => sprintf(__('You can automatically create shipments into Omniva system and print the out the package labels right here, at the shop orders view. <br> Please set your Omniva web servises account credentials below here. <br>(see more on <a href="https://makecommerce.net/en/integration-modules/makecommerce-woocommerce-payment-plugin/#carriers-integration">MakeCommerce plugin page</a>.   Don\'t forget to enable also <a href="%s">MC API keys</a>!)', 'wc_makecommerce_domain'), admin_url($a)));

						$this->form_fields['registerOnPaymentCode'] = array(
								'title'             => __('Register shipments automatically as', 'wc_makecommerce_domain'),
								'type'              => 'select',
								'label'             => __('register on Payment', 'wc_makecommerce_domain'),
								'description' 	    => __('Shipments will be automatically registered on payment using the selected Omniva service code', 'wc_makecommerce_domain'),
								'options' => array(
											'QP' => __('QP - handover to Omniva at Post Office', 'wc_makecommerce_domain'),
											'PK' => __('PK - handover to Omniva via Parcel Machine', 'wc_makecommerce_domain'),
											'' => __('None - do not register automatically', 'wc_makecommerce_domain'),
										),							
								'default'     => 'QP',
							);

						$this->form_fields['service_user'] = array(
								'title'            => __('Omniva web services username', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['service_password'] = array(
								'title'            => __('Omniva web services password', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['return_address'] = array( 'type' => 'title', 'title' => __('Return address', 'wc_makecommerce_domain'), 'description' => __('Please define return address for Omniva shipments', 'wc_makecommerce_domain'));
						$this->form_fields['shop_name'] = array(
								'type' => 'text',
								'title' => __('Shop name', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_phone'] = array(
								'type' => 'text',
								'title' => __('Shop phone', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_email'] = array(
								'type' => 'text',
								'title' => __('Shop email', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_address_country'] = array(
								'type' => 'select',
								'title' => __('Shop address country', 'wc_makecommerce_domain'),
								'options' => array(
							        'EE' => 'EE',
							        'LV' => 'LV',
							        'LT' => 'LT',
				        			),
								'default' => 'EE',
							);
						$this->form_fields['shop_address_city'] = array(
								'type' => 'text',
								'title' => __('Shop address city', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);					
						$this->form_fields['shop_address_street'] = array(
								'type' => 'text',
								'title' => __('Shop address street', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);					
						$this->form_fields['shop_postal_code'] = array(
								'type' => 'text',
								'title' => __('Shop postal code', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
					}
				}
			}

			$enable = get_option('mk_transport_courier_smartpost', 'yes');
			if ($enable === 'yes') {
				class WC_Courier_Shipping_Method_SmartPost extends WC_Courier_Shipping_Method {

					public function __construct($instance_id = 0) {
						$this->ext          = 'SmartPost';
						$this->name_ext     = 'SmartPost';
						$this->carrier      = 'smartpost';
						add_filter('woocommerce_review_order_after_shipping' , array(&$this, 'add_smartpost_courier_checkout_fields'));
						add_action('woocommerce_checkout_process', array(&$this, 'check_checkout_fields'));
						add_action('woocommerce_after_checkout_validation', array(&$this, 'check_checkout_fields'));
						add_action('woocommerce_checkout_update_order_meta', array(&$this, 'add_order_meta'));
						parent::__construct($instance_id);
					}

					public function add_smartpost_courier_checkout_fields($fragment) {
						$res = '';
						$res .= '<tr style="display: none;" class="parcel_machine_checkout parcel_machine_checkout_courier_'.mb_strtolower($this->ext).'">';
						$res .= '<td colspan="2">';
						$res .= '<p class="form-row" id="'.esc_attr($this->id).'_field">';
						$res .= '<select class="select" name="'.esc_attr($this->id).'" id="'.esc_attr($this->id).'">';
						$res .= '<option value="">'.__('-- choose courier arrivel time --', 'wc_makecommerce_domain').'</option>';
						$res .= '<option value="1">'.__('Worktime (09:00..17:00)', 'wc_makecommerce_domain').'</option>';
						$res .= '<option value="2">'.__('After worktime (17:00..21:00)', 'wc_makecommerce_domain').'</option>';
						$res .= '</select>';
						$res .= '</p>';
						$res .= '</td></tr>';
						echo $res;
					}

					function check_checkout_fields() {
						#static $added = false;
						#if (!$added && empty($_POST[$this->id])) {
						#	wc_add_notice(__('<strong>Delivery time</strong> is a required field.', 'wc_makecommerce_domain'), 'error');
						#	$added = true;
						#}
					}

					function add_order_meta($order_id) {
						if (!empty($_POST[$this->id])) {
							update_post_meta($order_id, '_delivery_time', sanitize_text_field($_POST[$this->id]));
						}
					}

					public function init_form_fields() {

						global $woocommerce;

						$this->instance_form_fields = array();
						$this->instance_form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->instance_form_fields['price'] = array(
								'title'            => __('Shipping price', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => '4.95'
							);
						$this->instance_form_fields['free_shipping_min_amount'] = array(
								'title'            => __('Free shipping amount', 'wc_makecommerce_domain'),
								'type'             => 'number',
								'default'          => '0',
								'desc_tip'	   	   => __('(0 means no free shipping)', 'wc_makecommerce_domain'),
							);

						$this->form_fields = array();
						$this->form_fields['logo'] = array('type' => 'title', 'description' => __get_logo_html());
						$this->form_fields['generic'] = array(
								'type' 				=> 'title', 
								'title'				=> __('Generic and pricing options', 'wc_makecommerce_domain'),
								// 'description'      	=> __('', 'wc_makecommerce_domain'),	
							);
						$this->form_fields['active'] = array(
								'title'            => __('Enable', 'wc_makecommerce_domain'),
								'type'             => 'checkbox',
								'label'            => __('enabled', 'wc_makecommerce_domain'),
								'default'          => 'no',
							);
						$this->form_fields['maximum_weight'] = array(
								'title'            => sprintf(__('Maximum weight allowed for shipping (%s)', 'wc_makecommerce_domain'), get_option('woocommerce_weight_unit' )),
								'type'             => 'text',
								'default'          => '60'
							);

						$this->form_fields['look_and_feel'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('Look and feel options', 'wc_makecommerce_domain'), 'description' => __('Options for presentation on check-out page', 'wc_makecommerce_domain'));

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

						if (empty($languages)) {
							$this->form_fields['method_name'] = array(
									'title'            => __('Shipping Method Title', 'wc_makecommerce_domain'),
									'type'             => 'text',
									'default'          => __('SmartPOST Courier', 'wc_makecommerce_domain')
								);
						} else {
							foreach ($languages as $language_code => $language) {
								$language_name = !empty($language['translated_name']) ? $language['translated_name'] : $language_code;
								$defaultName = __('SmartPOST Courier', 'wc_makecommerce_domain');
								switch ($language_code) {
									case 'et':
										$defaultName = 'SmartPOST kuller';
										break;
									case 'ru':
										$defaultName = 'SmartPOST Курьер';
										break;
									case 'fi':
										$defaultName = 'SmartPOST kuriiri';
										break;   
									case 'lv':
										$defaultName = 'SmartPOST kurjers';
										break;       
									case 'lt':
										$defaultName = 'SmartPOST kurjeris';
										break;  
								}
								$this->form_fields['method_name_'.$language_code] = array(
										'title'            => __('Shipping Method Title', 'wc_makecommerce_domain').sprintf(' (%s)', $language_code),
										'type'             => 'text',
										'default'          => $defaultName
									);
							}
						}

						if (mk_wc_version("3.4.0")) $a = 'admin.php?page=wc-settings&tab=advanced&section=mk_api'; else $a = 'admin.php?page=wc-settings&tab=api&section=mk_api';
						$this->form_fields['api_access'] = array( 'type' => 'title', 'title' => '<hr><br>'.__('API access for', 'wc_makecommerce_domain').' '.$this->ext, 'description' => sprintf(__('You can automatically create shipments into SmartPOST system and print the out the package labels right here, at the shop orders view. <br> Please set your SmartPOST web servises account credentials below here. <br>(see more on <a href="https://makecommerce.net/en/integration-modules/makecommerce-woocommerce-payment-plugin/#carriers-integration">MakeCommerce plugin page</a>.   Don\'t forget to enable also <a href="%s">MC API keys</a>!)', 'wc_makecommerce_domain'), admin_url($a)));

						$this->form_fields['service_user'] = array(
								'title'            => __('eteenindus.smartpost.ee username', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['service_password'] = array(
								'title'            => __('eteenindus.smartpost.ee password', 'wc_makecommerce_domain'),
								'type'             => 'text',
								'default'          => ''
							);
						$this->form_fields['return_address'] = array( 'type' => 'title', 'title' => __('Return address', 'wc_makecommerce_domain'), 'description' => __('Please define return address for SmartPOST shipments (used on parcel labels)', 'wc_makecommerce_domain'));
						$this->form_fields['shop_name'] = array(
								'type' => 'text',
								'title' => __('Shop name', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_phone'] = array(
								'type' => 'text',
								'title' => __('Shop phone', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_email'] = array(
								'type' => 'text',
								'title' => __('Shop email', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
						$this->form_fields['shop_postal_code'] = array(
								'type' => 'text',
								'title' => __('Shop postal code', 'wc_makecommerce_domain'),
								'class' => 'input-text regular-input',
							);
					}
				}
			}
		}
	}
	add_action('woocommerce_shipping_init', 'transport_add_method');


	function add_mc_shipping_method($methods) {
		$methods['parcelmachine_omniva'] = 'WC_ParcelMachine_Shipping_Method_Omniva';
		$methods['parcelmachine_smartpost'] = 'WC_ParcelMachine_Shipping_Method_Smartpost';
		$methods['parcelmachine_dpd'] = 'WC_ParcelMachine_Shipping_Method_DPD';
		$methods['courier_omniva'] = 'WC_Courier_Shipping_Method_Omniva';
		$methods['courier_smartpost'] = 'WC_Courier_Shipping_Method_Smartpost';
		return $methods;
	}
	add_filter('woocommerce_shipping_methods', 'add_mc_shipping_method');

	function mk_mc_add_assets() {
		wp_enqueue_style('parcelmachine-css', plugin_dir_url(__FILE__).'/css/parcelmachine.css');
		wp_enqueue_script('parcelmachine-js', plugin_dir_url(__FILE__).'/scripts/parcelmachine.js', array('jquery'));
	}
	function mk_mc_add_assets_admin() {
		wp_enqueue_style('parcelmachine-css-admin', plugin_dir_url(__FILE__).'/css/parcelmachine-admin.css');
		wp_enqueue_script('parcelmachine-js-admin', plugin_dir_url(__FILE__).'/scripts/parcelmachine-admin.js', array('jquery'));
	}
	add_action('wp_enqueue_scripts', 'mk_mc_add_assets');
	add_action('admin_enqueue_scripts', 'mk_mc_add_assets_admin');

	add_action('woocommerce_admin_field_api_javascript_ui', 'api_javascript_ui');



// ======== Woo Admin dialogs related stuff


    function mk_admin_restrict_manage_posts() {
        global $typenow;
        if ( in_array( $typenow, wc_get_order_types( 'order-meta-boxes' ) ) ) {
			$selected_method = !empty($_REQUEST['_shipping_method']) ? $_REQUEST['_shipping_method'] : false;
			$methods = WC()->shipping->load_shipping_methods();
			echo '<select name="_shipping_method" id="shipping_type" class="enhanced">';
			echo '<option value="">'.__('-- filter by shipping method', 'wc_makecommerce_domain') . '</option>';
			foreach ($methods as $method) {
				echo '<option value="'.$method->id.'"'.($selected_method === $method->id ? ' selected="selected"' : '').'>'.$method->title.'</option>';
			}
			echo '</select>';
		}
	}
	function mk_admin_shipping_filter($where, $wp_query) {
		global $pagenow, $wpdb;
		$method = !empty($_REQUEST['_shipping_method']) ? $_REQUEST['_shipping_method'] : false;
		if (is_admin() && $pagenow=='edit.php' && $wp_query->query_vars['post_type'] == 'shop_order' && !empty($method) ) {
			$where .= $GLOBALS['wpdb']->prepare( ' AND ID
				IN (
				SELECT items.order_id
				FROM '.$wpdb->prefix.'woocommerce_order_itemmeta meta, '.$wpdb->prefix.'woocommerce_order_items items
				WHERE meta.order_item_id = items.order_item_id
				AND meta.meta_key = "method_id"
				AND meta.meta_value = %s
			) ', $method );
		}
		return $where;
	}
	add_filter('restrict_manage_posts', 'mk_admin_restrict_manage_posts');
	add_filter('posts_where', 'mk_admin_shipping_filter', 10, 2);

	function mk_admin_bulk_actions() {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('wc_mk_timepicker', plugins_url('/scripts/jquery-ui.timepicker.js', __FILE__));
		wp_enqueue_style('wc_mk_timepicker-css', plugins_url('/css/jquery-ui.timepicker.css', __FILE__));
		global $post_type;
		if ('shop_order' === $post_type) { ?>
            <script type="text/javascript">
            jQuery(function() {
                jQuery('<option>').val('parcel_machine_labels').text('<?php _e( 'Register parcel machine shipments', 'wc_makecommerce_domain' )?>').appendTo('select[name="action"]');
                jQuery('<option>').val('parcel_machine_labels').text('<?php _e( 'Register parcel machine shipments', 'wc_makecommerce_domain' )?>').appendTo('select[name="action2"]');
                jQuery('<option>').val('parcel_machine_print_labels').text('<?php _e( 'Print parcel machine labels', 'wc_makecommerce_domain' )?>').appendTo('select[name="action"]');
                jQuery('<option>').val('parcel_machine_print_labels').text('<?php _e( 'Print parcel machine labels', 'wc_makecommerce_domain' )?>').appendTo('select[name="action2"]');
                //jQuery('<option>').val('parcel_machine_order_courier').text('<?php _e( 'Order courier for parcel machine deliveries', 'wc_makecommerce_domain' )?>').appendTo('select[name="action"]');
                //jQuery('<option>').val('parcel_machine_order_courier').text('<?php _e( 'Order courier for parcel machine deliveries', 'wc_makecommerce_domain' )?>').appendTo('select[name="action2"]');
				jQuery('select[name="action"]').after('<input type="text" name="transport_time" class="hidden timepicker"/>');
				jQuery('select[name="action"], select[name="action2"]').on('change', function(){
					var val = jQuery(this).val();
					if (val === 'parcel_machine_order_courier') {
						jQuery('.timepicker').removeClass('hidden');
					} else {
						jQuery('.timepicker').addClass('hidden');
					}
				});
				jQuery('.tablenav.bottom .actions.bulkactions').hide();
				var now = new Date();
				var mins = now.getMinutes();
				var quarterHours = Math.ceil(mins/15);
				if (quarterHours == 4) { now.setHours(now.getHours()+1); }
				var rounded = (quarterHours*15)%60;
				now.setMinutes(rounded);
				jQuery('.timepicker').datetimepicker({dateFormat: 'dd/mm/yy', timeFormat: 'HH:mm', stepMinute: 15, minDateTime: now, devaultValue: jQuery.datepicker.formatTime('dd/mm/yyyy HH:mm', now)});
			});
			</script>
			<?php if (!empty($_REQUEST['mk_err'])) { ?>
				<script type="text/javascript">
				jQuery(function(){
					alert('<?php echo htmlspecialchars($_REQUEST['mk_err']) ?>');
				});
				</script>
			<?php } ?>
			<?php if (!empty($_REQUEST['mk_pdf'])) { ?>
				<script type="text/javascript">
				jQuery(function(){
					window.open('<?php echo $_REQUEST['mk_pdf'] ?>', 'pdf');
				});
				</script>
			<?php }
		}
	}
	function mk_admin_bulk_action_labels() {
		$wp_list_table = _get_list_table('WP_Posts_List_Table');
		$post_ids = array_map('absint', (array)$_REQUEST['post']);
		mk_get_shipment_ids($post_ids);
	}
	function mk_admin_bulk_action_print() {
		$wp_list_table = _get_list_table('WP_Posts_List_Table');
		$post_ids = array_map('absint', (array)$_REQUEST['post']);
		mk_get_labels($post_ids);
	}
	function mk_admin_bulk_action_order_courier() {
		return;
		$wp_list_table = _get_list_table('WP_Posts_List_Table');
		$post_ids = array_map('absint', (array)$_REQUEST['post']);
		$transport_time = !empty($_REQUEST['transport_time']) ? strtotime(str_replace('/', '-', $_REQUEST['transport_time'])) : false;
		if ($transport_time && $transport_time > time()) {
			mk_get_shipment_ids($post_ids, 'omniva');
		} else {
			die('Please select transport time that is in the future');
		}
	}
	add_action('admin_footer', 'mk_admin_bulk_actions', 11);
	add_action('admin_action_parcel_machine_labels', 'mk_admin_bulk_action_labels');
	add_action('admin_action_parcel_machine_print_labels', 'mk_admin_bulk_action_print');
	add_action('admin_action_parcel_machine_order_courier', 'mk_admin_bulk_action_order_courier');

	function mk_admin_save_post($post_id) {
		$post_type = get_post_type($post_id);
		if ('shop_order' !== $post_type) { return; }
		if (isset($_POST['_mk_machine_id'])) {
			update_post_meta($post_id, '_parcel_machine', $_POST['_mk_machine_id']);
			mk_get_shipment_ids($post_id);
		}
	}

	add_action('save_post', 'mk_admin_save_post');



	function mk_admin_parcelmachine_order_meta($order) {
		echo '</div>';
		echo '<div class="order_data_column" style="float: right;">';
		$order_id = $order->get_order_number();
		$machine_id = get_post_meta($order_id, '_parcel_machine', true);
		if (!empty($machine_id)) {
			list($carrier, $machine) = explode('||', $machine_id);
			if (!empty($machine)) {
				$machine = mk_get_machine($carrier, $machine);
				if ($machine)  {
					echo '<h3>'.__('Selected parcel machine', 'wc_makecommerce_domain').'<a href="#" class="edit_address">'.__('Edit').'</a></h3>';
					echo '<div class="edit_address">';
					echo '<p class="form-field form-field-wide _mk_machine_id">';
					echo '<label for="_mk_machine_id">'.__('Parcel machine', 'wc_makecommerce_domain').'</label>';
					echo '<select id="_mk_machine_id" name="_mk_machine_id" class="wc-enhanced-select select">';
					$res = '';
					$machines = mk_get_machines($carrier, method_exists($order, 'get_shipping_country') ? $order->get_shipping_country() : $order->shipping_country);
					$res .= '<option value="">'.__('-- select parcel machine --', 'wc_makecommerce_domain').'</option>';
					$pcity = false;
					foreach ($machines as $smachine) {
						$city = strtolower($smachine['city']);
						if ($city !== $pcity) {
							if ($pcity) $res .= '</optgroup>';
							$res .= '<optgroup label="'.$smachine['city'].'">';
						}
						$mname = $smachine['name'];
						$res .= '<option value="'.esc_attr($smachine['carrier'].'||'.$smachine['id']).'" '.($machine['id'] === $smachine['id'] ? ' selected="selected"' : '').'>'.$mname.'</option>';
						$pcity = $city;
					}
					if ($pcity) $res .= '</optgroup>';
					echo $res;
					echo '</select>';
					echo '</p>';
					echo '</div>';
					echo '<div class="address">';
					echo '<p>'.$carrier.'</strong><br/>'.$machine['name'] . '<br/><small>' . $machine['address'] . '</small></p>';
					echo '</div>';
				}
			}
		}
		if (empty($carrier)) {
			$carrier = '';
		}
		echo '<div style="clear: both;">';
		$delivery_time = get_post_meta($order_id, '_delivery_time', true);
		if ($delivery_time === '1') {
			echo '<p><strong>'.__('Delivery time', 'wc_makecommerce_domain').'</strong> - 09:00..17:00</p>';
		}
		if ($delivery_time === '2') {
			echo '<p><strong>'.__('Delivery time', 'wc_makecommerce_domain').'</strong> - 17:00..21:00</p>';
		}

		$shipment_id = get_post_meta($order_id, '_parcel_machine_shipment_id', true);
		$shipment_id_error = get_post_meta($order_id, '_parcel_machine_error', true);
		$shipment_manifest = get_post_meta($order_id, '_parcel_machine_manifest', true);
		if ($shipment_id) {			
			switch ($carrier) {
				case 'omniva':
					echo '<p><strong>'.__('Shipment tracking code', 'wc_makecommerce_domain').'</strong> ('. $carrier .'): <br/> <a target="_blank " href="https://www.omniva.ee/abi/jalgimine?barcode=' . $shipment_id . '">'.$shipment_id.'</a>' ;
					break;
				case 'dpd':
					echo '<p><strong>'.__('Shipment tracking code', 'wc_makecommerce_domain').'</strong> ('. $carrier .'): <br/> <a target="_blank " href="https://tracking.dpd.de/parcelstatus?locale=et_EE&Tracking=Track&query=' . $shipment_id . '">'.$shipment_id.'</a>' ;
					break;
				default:
					echo '<p><strong>'.__('Shipment tracking code', 'wc_makecommerce_domain').':</strong><br/>' . $shipment_id . '</small></p>';
					break;
			}
		}
		if ($shipment_manifest) {
			echo '<p><strong>'.__('Shipments pickup manifest').':</strong><br/><a href="' . $shipment_manifest . '" target="_blank">link</a></small></p>';
		}
		if ($shipment_id_error) {
			echo '<p><strong style="color: red;">'.__('Shipment registration error').':</strong><br/>' . $shipment_id_error . '</small></p>';
		}
		echo '</div>';
	}

	function mk_admin_render_shop_order_columns( $column ) {
		global $post, $woocommerce, $the_order;
		if (!$the_order) return;
		$the_order_id = $the_order->get_order_number();
		if (empty($the_order) || $the_order_id != $post->ID) {
			$the_order = wc_get_order($post->ID);
		}
		if ($column === 'shipping_address') {
			$machine_id = get_post_meta($the_order_id, '_parcel_machine', true);
			$shipment_id = get_post_meta($the_order_id, '_parcel_machine_shipment_id', true);
			$shipment_id_error = get_post_meta($the_order_id, '_parcel_machine_error', true);
			if ($machine_id && !$shipment_id) {
				//echo __('Shipment ID not generated for delivery', 'wc_makecommerce_domain');
			}
			if ($shipment_id) {
				echo __('Shipment tracking code', 'wc_makecommerce_domain') . ': ' . $shipment_id . '<br/>';	
				echo '<span class="has_shipment_id"></span>';
			}
			else if ($shipment_id_error) echo '<span style="color: red;">'.__('Package shipment generation error:', 'wc_makecommerce_domain') . '</span><br/>' .$shipment_id_error;
		}
	}
	function mk_add_email_customer_details_fields($fields, $sent_to_admin, $order) {
		$machine_id = get_post_meta($order->get_order_number(), '_parcel_machine', true);
		if (empty($machine_id)) return $fields;
		list($carrier, $machine) = explode('||', $machine_id);
		if (empty($machine)) return $fields;
		$machine = mk_get_machine($carrier, $machine);
		if (!$machine) return $fields;
		$fields[] = array('label' => __('Parcel machine', 'wc_makecommerce_domain').' ('.$carrier.')', 'value' => $machine['name'].' - '.$machine['address']);
		return $fields;
	}
	function mk_add_order_customer_details_fields($order) {
		$machine_id = get_post_meta($order->get_order_number(), '_parcel_machine', true);
		if (empty($machine_id)) return;
		list($carrier, $machine) = explode('||', $machine_id);
		if (empty($machine)) return;
		$machine = mk_get_machine($carrier, $machine);
		if (!$machine) return;
		echo '<tr>';
		echo '<th>'.__('Parcel machine', 'wc_makecommerce_domain').' ('.$carrier.') </th>';
		echo '<td>'.$machine['name'].'<br/>'.$machine['address'].'</td>';
		echo '</tr>';
	}
	function mk_admin_product_option_fields($fields) {
		echo '<div class="options_group">';
		woocommerce_wp_checkbox( 
			array( 
				'id'            => '_no_parcel_machine',
				'label'         => __('Does not fit parcel machine', 'wc_makecommerce_domain'), 
				'description'   => __('When this is checked, parcel machine shipping option is not available for a cart with this product', 'wc_makecommerce_domain')
			)
		);
		woocommerce_wp_checkbox( 
			array( 
				'id'            => '_no_shipping_cost',
				'label'         => __('Free parcel machine', 'wc_makecommerce_domain'), 
				'description'   => __('When this is checked, parcel machine is free for this product', 'wc_makecommerce_domain')
			)
		);
		echo '</div>';
	}
	function mk_admin_product_fields_save($post_id) {
		$no_parcel_machine = isset($_POST['_no_parcel_machine']) ? 'yes' : 'no';
		update_post_meta($post_id, '_no_parcel_machine', $no_parcel_machine);
		$no_shipping_cost = isset($_POST['_no_shipping_cost']) ? 'yes' : 'no';
		update_post_meta($post_id, '_no_shipping_cost', $no_shipping_cost);
	}







	add_action('woocommerce_product_options_shipping', 'mk_admin_product_option_fields');
	add_action('woocommerce_process_product_meta', 'mk_admin_product_fields_save');
	add_action('woocommerce_admin_order_data_after_shipping_address', 'mk_admin_parcelmachine_order_meta', 10, 1);
	add_action('manage_shop_order_posts_custom_column', 'mk_admin_render_shop_order_columns', 3);
	add_filter('woocommerce_email_customer_details_fields', 'mk_add_email_customer_details_fields', 10, 3 );
	add_action('woocommerce_order_details_after_customer_details', 'mk_add_order_customer_details_fields');
	add_action('woocommerce_order_status_processing', 'mk_get_shipment_ids');

	


// =====  MK API communication related stuff

	function mk_get_shipment_ids($post_ids, $select_carrier = null) {
		if (!is_array($post_ids)) {
			$post_ids = array($post_ids);
		}
		transport_add_method();
		$shipping_request = array('credentials' => array(), 'orders' => array());
		$shipping_classes_map = array(
			'parcelmachine_omniva' => 'WC_ParcelMachine_Shipping_Method_Omniva', 
			'parcelmachine_smartpost' => 'WC_ParcelMachine_Shipping_Method_Smartpost', 
			'parcelmachine_dpd' => 'WC_ParcelMachine_Shipping_Method_DPD', 
			'courier_omniva' => 'WC_Courier_Shipping_Method_Omniva',
			'courier_smartpost' => 'WC_Courier_Shipping_Method_Smartpost'
		);
		foreach ($post_ids as $post_id) {
			$oldId = get_post_meta($post_id, '_parcel_machine_shipment_id', true);
			if (strlen($oldId)>6) continue;
			$order = new WC_Order($post_id);
			$shipping_methods = $order->get_shipping_methods();
			if (empty($shipping_methods)) { continue; }
			foreach ($shipping_methods as $shipping_method) {
				$shipping_id = explode(':', $shipping_method['method_id']);
				$shipping_class = $shipping_id[0]; 
				$shipping_instance = !empty($shipping_id[1]) ? $shipping_id[1] : null;
				if (empty($shipping_classes_map[$shipping_class])) {
					continue;
				}

				$transport_class = new $shipping_classes_map[$shipping_class]($shipping_instance);
				$carrier_uc = mb_strtoupper($transport_class->carrier);
				
				if ($transport_class->type === 'apt') {
					$parcel_machine = get_post_meta($post_id, '_parcel_machine', true);
					if (!$parcel_machine) { continue; }
					list($carrier, $machine_id) = explode('||', $parcel_machine);
					if (!$carrier || !$machine_id) { continue; }
				}

				if (empty($shipping_request['credentials'][$carrier_uc])) {
					$api_user = $transport_class->settings['service_user'];
					$api_password = $transport_class->settings['service_password'];

					$use_mk_contract = false;
					if ( isset($transport_class->settings['use_mk_contract']) ) {
						$use_mk_contract = $transport_class->settings['use_mk_contract'];
					}

					if ( (!$api_user || !$api_password) and (!$use_mk_contract) ) {
						add_action('admin_notices', 'mk_admin_error');
						continue;
					}

					// if $use_mk_contract is enabled, do not add credentials array to the request
					if (!$use_mk_contract) {
						$shipping_request['credentials'][$carrier_uc] = array('carrier' => $carrier_uc, 'username' => $api_user, 'password' => $api_password);
					}
				}
				$sender = array(
					'name' => !empty($transport_class->settings['shop_name']) ? $transport_class->settings['shop_name'] : '',
					'phone' => !empty($transport_class->settings['shop_phone']) ? $transport_class->settings['shop_phone'] : '',
					'email' => !empty($transport_class->settings['shop_email']) ? $transport_class->settings['shop_email'] : '',
					'country' => !empty($transport_class->settings['shop_address_country']) ? $transport_class->settings['shop_address_country'] : '',
					'city' => !empty($transport_class->settings['shop_address_city']) ? $transport_class->settings['shop_address_city'] : '',
					'street' => !empty($transport_class->settings['shop_address_street']) ? $transport_class->settings['shop_address_street'] : '',
					'postalCode' => !empty($transport_class->settings['shop_postal_code']) ? $transport_class->settings['shop_postal_code'] : ''
				);
				$s_first_name = method_exists($order, 'get_shipping_first_name') ? $order->get_shipping_first_name() : $order->shipping_first_name;
				$s_last_name = method_exists($order, 'get_shipping_last_name') ? $order->get_shipping_last_name() : $order->shipping_last_name;
				$b_first_name = method_exists($order, 'get_billing_first_name') ? $order->get_billing_first_name() : $order->billing_first_name;
				$b_last_name = method_exists($order, 'get_billing_last_name') ? $order->get_billing_last_name() : $order->billing_last_name;
				$b_phone = method_exists($order, 'get_billing_phone') ? $order->get_billing_phone() : $order->billing_phone;
				$b_email = method_exists($order, 'get_billing_email') ? $order->get_billing_email() : $order->billing_email;
				$recipient_name = $s_first_name && $s_last_name ? $s_first_name . ' ' . $s_last_name : $b_first_name . ' ' . $b_last_name;
				$sr_order = array(
					'carrier' => $carrier_uc,
					'orderId' => $order->get_order_number(),
					'recipient' => array('name' => $recipient_name, 'phone' => $b_phone, 'email' => $b_email),
					'sender' => $sender,
					'destination' => array(),
				);
				$m_service_type = null;
				if ($transport_class->carrier === 'omniva' && $transport_class->type === 'atp') {
					$m_service_type = 'PA';
				} else if (!empty($transport_class->settings['registerOnPaymentCode'])) {
					$m_service_type = $transport_class->settings['registerOnPaymentCode'];
				}

				if (!empty($machine_id)) {
					$sr_order['destination']['destinationId'] = $machine_id;
				}
				if ($transport_class->type === 'cou') {
					$s_postcode = method_exists($order, 'get_shipping_postcode') ? $order->get_shipping_postcode() : $order->shipping_postcode;
					$s_country = method_exists($order, 'get_shipping_country') ? $order->get_shipping_country() : $order->shipping_country;
					$s_state = method_exists($order, 'get_shipping_state') ? $order->get_shipping_state() : $order->shipping_state;
					$s_city = method_exists($order, 'get_shipping_city') ? $order->get_shipping_city() : $order->shipping_city;
					$s_address_1 = method_exists($order, 'get_shipping_address_1') ? $order->get_shipping_address_1() : $order->shipping_address_1;
					$s_address_2 = method_exists($order, 'get_shipping_address_2') ? $order->get_shipping_address_2() : $order->shipping_address_2;
					$sr_order['destination'] = array(
						'postalCode' => $s_postcode,
						'country' => $s_country,
						'county' => $s_state,
						'city' => $s_city,
						'street' => $s_address_1 . ' ' . $s_address_2
					);
					$delivery_time = get_post_meta($post_id, '_delivery_time', true);
					if ($delivery_time) { $sr_order['destination']['timeWindow'] = $delivery_time; }
				}

				if ($m_service_type) {
					$sr_order['services'] = array('serviceType' => $m_service_type);
				}

				$shipping_request['orders'][] = $sr_order;
			}
		}
		$shipping_request['credentials'] = array_values($shipping_request['credentials']);
		if (empty($shipping_request['orders'])) {
			return;
		}
		$MK = mk_get_api();
		if (!$MK) {
			return;
		}
		try {
			$response = $MK->createShipments($shipping_request);
		} catch (Exception $e) {
			error_log('Error while creating shipment ['.$e->getMessage().']');
			return;
		}
		$shipments = !empty($response->shipments) ? $response->shipments : $response;
		$manifest = !empty($response->manifests) ? $response->manifests[0] : false;
		
		foreach ($shipments as $order) {
			if ($manifest) {
				update_post_meta((int)$order->orderId, '_parcel_machine_manifest', sanitize_text_field($manifest));
			}
			if (!empty($order->orderId) && !empty($order->shipmentId)) {
				update_post_meta((int)$order->orderId, '_parcel_machine_shipment_id', sanitize_text_field($order->shipmentId));
				delete_post_meta((int)$order->orderId, '_parcel_machine_error');
			} else if (!empty($order->orderId) && !empty($order->barCode)) {
				update_post_meta((int)$order->orderId, '_parcel_machine_shipment_id', sanitize_text_field($order->barCode));
				delete_post_meta((int)$order->orderId, '_parcel_machine_error');
			} else if (!empty($order->orderId) && !empty($order->errorMessage)) {
				update_post_meta((int)$order->orderId, '_parcel_machine_error', sanitize_text_field($order->errorMessage));
			}
		}
	}

	function mk_get_labels($post_ids, $ajax = false) {
		if (!is_array($post_ids)) {
			$post_ids = array($post_ids);
		}
		transport_add_method();
		$shipping_request = array('credentials' => array(), 'orders' => array(), 'printFormat' => 'A4');
		$shipping_classes_map = array(
			'parcelmachine_omniva' => 'WC_ParcelMachine_Shipping_Method_Omniva', 
			'parcelmachine_smartpost' => 'WC_ParcelMachine_Shipping_Method_Smartpost', 
			'parcelmachine_dpd' => 'WC_ParcelMachine_Shipping_Method_DPD', 
			'courier_omniva' => 'WC_Courier_Shipping_Method_Omniva',
			'courier_smartpost' => 'WC_Courier_Shipping_Method_Smartpost'
		);
		$missing_ids = array();
		foreach ($post_ids as $post_id) {
			$shipment_id = get_post_meta($post_id, '_parcel_machine_shipment_id', true);
			if (!$shipment_id) { 
				$missing_ids[] = $post_id;
				continue;
			}
			$order = new WC_Order($post_id);
			$shipping_methods = $order->get_shipping_methods();
			if (empty($shipping_methods)) { continue; }
			foreach ($shipping_methods as $shipping_method) {
				$shipping_id = explode(':', $shipping_method['method_id']);
				$shipping_class = $shipping_id[0]; 
				$shipping_instance = !empty($shipping_id[1]) ? $shipping_id[1] : null;
				if (empty($shipping_classes_map[$shipping_class])) {
					continue;
				}

				$transport_class = new $shipping_classes_map[$shipping_class]($shipping_instance);
				$carrier_uc = mb_strtoupper($transport_class->carrier);
				
				if ($transport_class->type === 'apt') {
					$parcel_machine = get_post_meta($post_id, '_parcel_machine', true);
					if (!$parcel_machine) { continue; }
					list($carrier, $machine_id) = explode('||', $parcel_machine);
					if (!$carrier || !$machine_id) { continue; }
				}
				if (empty($shipping_request['credentials'][$carrier_uc])) {
					$api_user = $transport_class->settings['service_user'];
					$api_password = $transport_class->settings['service_password'];

					$use_mk_contract = false;
					if ( isset($transport_class->settings['use_mk_contract']) ) {
						$use_mk_contract = $transport_class->settings['use_mk_contract'];
					}

					if ( (!$api_user || !$api_password) and (!$use_mk_contract) ) {
						add_action('admin_notices', 'mk_admin_error');
						continue;
					}
					if (!$use_mk_contract) {
						$shipping_request['credentials'][$carrier_uc] = array('carrier' => $carrier_uc, 'username' => $api_user, 'password' => $api_password);
					}
				}
				$sender = array(
					'name' => $transport_class->settings['shop_name'],
					'phone' => $transport_class->settings['shop_phone'],
					'email' => $transport_class->settings['shop_email'],
					'postalCode' => !empty($transport_class->settings['shop_postal_code']) ? $transport_class->settings['shop_postal_code'] : '',
					'country' => !empty($transport_class->settings['shop_address_country']) ? $transport_class->settings['shop_address_country'] : '',
					'city' => !empty($transport_class->settings['shop_address_city']) ? $transport_class->settings['shop_address_city'] : '',
					'street' => !empty($transport_class->settings['shop_address_street']) ? $transport_class->settings['shop_address_street'] : ''
				);
				$s_first_name = method_exists($order, 'get_shipping_first_name') ? $order->get_shipping_first_name() : $order->shipping_first_name;
				$s_last_name = method_exists($order, 'get_shipping_last_name') ? $order->get_shipping_last_name() : $order->shipping_last_name;
				$recipient = trim($s_first_name . ' ' . $s_last_name);
				if (empty($recipient)) {
					$b_first_name = method_exists($order, 'get_billing_first_name') ? $order->get_billing_first_name() : $order->billing_first_name;
					$b_last_name = method_exists($order, 'get_billing_last_name') ? $order->get_billing_last_name() : $order->billing_last_name;
					$recipient = trim($b_first_name . ' ' . $b_last_name);
				}
				$b_phone = method_exists($order, 'get_billing_phone') ? $order->get_billing_phone() : $order->billing_phone;
				$b_email = method_exists($order, 'get_billing_email') ? $order->get_billing_email() : $order->billing_email;
				$sr_order = array(
					'carrier' => $carrier_uc,
					'orderId' => $order->get_order_number(),
					'recipient' => array('name' => $recipient, 'phone' => $b_phone, 'email' => $b_email),
					'sender' => $sender,
					'shipmentId' => $shipment_id
				);
				$m_service_type = null;
				if ($transport_class->carrier === 'omniva' && $transport_class->type === 'atp') {
					$m_service_type = 'PA';
				} else if (!empty($transport_class->settings['registerOnPaymentCode'])) {
					$m_service_type = $transport_class->settings['registerOnPaymentCode'];
				}

				if (!empty($machine_id)) {
					$sr_order['destination']['destinationId'] = $machine_id;
				}
				if ($transport_class->type === 'cou') {
					$sr_order['destination'] = array(
						'postalCode' => $order->shipping_postcode,
						'country' => $order->shipping_country,
						'county' => $order->shipping_state,
						'city' => $order->shipping_city,
						'street' => $order->shipping_address_1 . ' ' . $order->shipping_address_2
					);
					$delivery_time = get_post_meta($post_id, '_delivery_time', true);
					if ($delivery_time) { $sr_order['destination']['timeWindow'] = $delivery_time; }
				}

				if ($m_service_type) {
					$sr_order['services'] = array('serviceType' => $m_service_type);
				}

				$shipping_request['orders'][] = $sr_order;
			}
		}
		$shipping_request['credentials'] = array_values($shipping_request['credentials']);
		if (empty($shipping_request['orders'])) {
			return;
		}
		$MK = mk_get_api();
		if (!$MK) {
			return;
		}
		try {
			$response = $MK->createLabels($shipping_request);
		} catch (Exception $e) {
			echo $e->getMessage();
			exit();
		}
		if (empty($response->labelUrl)) {
			return;
		}
		if ($ajax) {
			return $response->labelUrl;
		}
		$mk_err = false;
		if (!empty($missing_ids)) { $mk_err = sprintf(__('Orders %s did not have shipment ID attached so no labels was printed! Please register those packages if you think this is an error!', 'wc_makecommerce_domain'), join(', ', $missing_ids)); }
		$sendback = add_query_arg(array('post_type' => 'shop_order', 'mk_pdf' => urlencode($response->labelUrl), 'mk_err' => urlencode($mk_err)), '');
		wp_redirect(esc_url_raw($sendback));
		exit();
	}

	function mk_get_machines($carrier, $country = null) {
		$data         = get_option('mk_machines_cache', false);
		$data_expires = get_option('mk_machines_expires', false);
		if (!$data || empty($data) || $data_expires < time()) {
			$MK = mk_get_api();
			if(!$MK) {
				return array();
			}
			$data = $MK->getDestinations(array('type' => 'APT,PUP'));
			update_option('mk_machines_cache', $data, 'no');
			update_option('mk_machines_expires', time()+3*60*60, 'no');
		}

		$machines = array();
		if (!$data || empty($data)) {
			return array();
		}
		foreach ($data as $machine) {
			if ((!$country || $machine->country === $country) && ($machine->type === 'APT' || $machine->type === 'PUP') && ($carrier === '*' || strtolower($carrier) === strtolower($machine->carrier))) {
				$machines[] = array(
					'carrier' => strtolower($machine->carrier),
					'id' => $machine->id,
					'name' => $machine->name, 
					'city' => $machine->city,
					'address' => !empty($machine->address) ? $machine->address : '',
				);
			}
		}
		usort($machines, function($a, $b){ 
			if ($a['city'] === $b['city']) {
				return $a['name'] > $b['name'];
			}
			return $a['city'] > $b['city'];
		});
		return $machines;
	}

	function mk_get_machine($carrier, $id) {
		$machines = mk_get_machines($carrier);
		foreach ($machines as $machine) {
			if ($machine['carrier'] === $carrier && $machine['id'] == $id) {
				return $machine;
			}
		}
		return false;
	}

	function print_parcel_machine_label_action( $post_id ) {
		$shipment_id = get_post_meta($post_id, '_parcel_machine_shipment_id', true);
		if (!$shipment_id) { return; }
	    ?>
	    <li class="wide">
		    <a id="print_parcel_machine_label" href="#" class="button"><?php _e('Print parcel label', 'wc_makecommerce_domain');?></a>
		    <img class="mc_loading" src="<?php echo site_url('/wp-admin/images/loading.gif');?>">
			<script type="text/javascript">
				jQuery(function($){
					var data = {
						'action': 'print_pml',
						'id': '<?php echo $post_id; ?>'
					};
					var loading = $('.mc_loading');
					$('#print_parcel_machine_label').click(function(e){
						e.preventDefault();
						var button = $(this);
						button.addClass('disabled');
						loading.show();
						$.post(ajaxurl, data, function(response) {
							button.removeClass('disabled');
							loading.hide();
							window.open(response, 'pdf');
						});
					});
				});
			</script>
		</li>
 		<?php
	}
	add_action('woocommerce_order_actions_end', 'print_parcel_machine_label_action');

	function ajax_print_pml() {
		if(!current_user_can('manage_woocommerce') ) {
			die();
		}
		echo mk_get_labels(array(intval($_POST['id'])), true);
		die();
	}	
	add_action( 'wp_ajax_print_pml', 'ajax_print_pml' );


	function clear_wc_shipping_rates_cache(){
		$packages = WC()->cart->get_shipping_packages();
		foreach ($packages as $key => $value) {
			$shipping_session = "shipping_for_package_$key";
			unset(WC()->session->$shipping_session);
		}
	}
	add_filter('woocommerce_checkout_update_order_review', 'clear_wc_shipping_rates_cache');



	function api_javascript_ui( $data ) {
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			var env_select = $('#mk_api_type');
			var test_fields = ['mk_test_shop_id', 'mk_test_private_key', 'mk_test_public_key'];
			var live_fields = ['mk_shop_id', 'mk_private_key', 'mk_public_key'];

			env_select.on('change', function(){
				hideFileds($(this).val());
			});
			hideFileds(env_select.val());
			function hideFileds(type) {
				var hide = type == 'live' ? test_fields : live_fields;
				var show = type == 'live' ? live_fields : test_fields;
				$.each(hide, function(i, elem) {
					$('#'+elem).closest('tr').hide();
				});
				$.each(show, function(i, elem) {
					$('#'+elem).closest('tr').show();
				});
			}
		});
		</script>
		<?php
	}




