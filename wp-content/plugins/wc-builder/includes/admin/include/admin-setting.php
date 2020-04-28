<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

if ( ! function_exists('is_plugin_active')){ include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }

class WPBForWPbakery_Admin_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WPBForWPbakery_Settings_API();

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 220 );
        add_action( 'wsa_form_bottom_wpbforwpbakery_general_tabs', array( $this, 'wpbforwpbakery_html_general_tabs' ) );
        add_action( 'wsa_form_top_wpbforwpbakery_elements_tabs', array( $this, 'wpbforwpbakery_html_popup_box' ) );
        
        add_action( 'wsa_form_bottom_wpbforwpbakery_buy_pro_tabs', array( $this, 'wpbforwpbakery_html_buy_pro_tabs' ) );

    }

    function admin_init() {
        //set the settings
        $this->settings_api->set_sections( $this->wpbforwpbakery_admin_get_settings_sections() );
        $this->settings_api->set_fields( $this->wpbforwpbakery_admin_fields_settings() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    // Plugins menu Register
    function admin_menu() {
        add_submenu_page( 
        	'wpbforwpbakery_options',
        	esc_html__( 'WC Page Builder Options', 'wpbforwpbakery' ),
        	esc_html__( 'WC Page Builder Options', 'wpbforwpbakery' ),
    		'manage_options',
    		'wpbforwpbakery_options',
    		array ( $this, 'plugin_page' )
    	);
    }

    // Options page Section register
    function wpbforwpbakery_admin_get_settings_sections() {
        $sections = array(
            
            array(
                'id'    => 'wpbforwpbakery_general_tabs',
                'title' => esc_html__( 'General', 'wpbforwpbakery' )
            ),

            array(
                'id'    => 'wpbforwpbakery_woo_template_tabs',
                'title' => esc_html__( 'WooCommerce Template', 'wpbforwpbakery' )
            ),

            array(
                'id'    => 'wpbforwpbakery_elements_tabs',
                'title' => esc_html__( 'Elements', 'wpbforwpbakery' )
            ),

            array(
                'id'    => 'wpbforwpbakery_buy_pro_tabs',
                'title' => esc_html__( 'Buy Pro', 'wpbforwpbakery' )
            ),

        );
        return $sections;
    }

    // Options page field register
    protected function wpbforwpbakery_admin_fields_settings() {

        $settings_fields = array(

            'wpbforwpbakery_general_tabs' => array(),

            'wpbforwpbakery_woo_template_tabs' => array(

                array(
                    'name'  => 'enablecustomlayout',
                    'label'  => __( 'Enable / Disable Template Builder', 'wpbforwpbakery' ),
                    'desc'  => __( 'Enable', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                ),

                array(
                    'name'    => 'content_width',
                    'label'   => __( 'Content Width', 'wpbforwpbakery' ),
                    'desc'    => __( 'Sets the default width of the content area. e.g: 1170px', 'wpbforwpbakery' ),
                    'type'    => 'text',
                    'default' => '1170px',
                    'options' => wpbforwpbakery_post_list_arr('wpbfwpb_template')
                ),

                array(
                    'name'    => 'singleproductpage',
                    'label'   => __( 'Single Product Template', 'wpbforwpbakery' ),
                    'desc'    => __( 'You can select Custom Product details layout', 'wpbforwpbakery' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => wpbforwpbakery_post_list_arr('wpbfwpb_template')
                ),

                array(
                    'name'    => 'productarchivepage',
                    'label'   => __( 'Product Archive Page Template', 'wpbforwpbakery' ),
                    'desc'    => __( 'You can select Custom Product Shop page layout', 'wpbforwpbakery' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => wpbforwpbakery_post_list_arr('wpbfwpb_template')
                ),

                array(
                    'name'    => 'productcartpagep',
                    'label'   => __( 'Cart Page Template', 'wpbforwpbakery' ),
                    'desc'    => __( 'You can select Custom cart page layout <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement',
                ),

                array(
                    'name'    => 'productcheckoutpagep',
                    'label'   => __( 'Checkout Page Template', 'wpbforwpbakery' ),
                    'desc'    => __( 'You can select Custom checkout page layout <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement',
                ),

                array(
                    'name'    => 'productthankyoupagep',
                    'label'   => __( 'Thank You Page Template', 'wpbforwpbakery' ),
                    'desc'    => __( 'You can select Custom thank you page layout <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement',
                ),

                array(
                    'name'    => 'productmyaccountpagep',
                    'label'   => __( 'My Account Page Template', 'wpbforwpbakery' ),
                    'desc'    => __( 'You can select Custom my account page layout <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement',
                ),

                array(
                    'name'    => 'productmyaccountloginpagep',
                    'label'   => __( 'My Account Login page Template', 'wpbforwpbakery' ),
                    'desc'    => __( 'You can select Custom my account login page layout <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement',
                ),

            ),

            'wpbforwpbakery_elements_tabs' => array(

                array(
                    'name'  => 'wpb_product_data_tab',
                    'label'  => __( 'Product Tab', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_archive_product',
                    'label'  => __( 'Product Archive', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_title',
                    'label'  => __( 'Product Title', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_related',
                    'label'  => __( 'Related Product', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_add_to_cart',
                    'label'  => __( 'Add To Cart Button', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_additional_information',
                    'label'  => __( 'Additional Information', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_data_tab',
                    'label'  => __( 'Product data Tab', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_description',
                    'label'  => __( 'Product Description', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_short_description',
                    'label'  => __( 'Product Short Description', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_price',
                    'label'  => __( 'Product Price', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_rating',
                    'label'  => __( 'Product Rating', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_reviews',
                    'label'  => __( 'Product Reviews', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_image',
                    'label'  => __( 'Product Image', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_upsell',
                    'label'  => __( 'Product Upsell', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_stock',
                    'label'  => __( 'Product Stock Status', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_product_meta',
                    'label'  => __( 'Product Meta Info', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'wpbforwpbakery_table_row',
                ),

                array(
                    'name'  => 'wpb_custom_archive_layoutp',
                    'label'  => __( 'Product Archive Layout <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_cart_tablep',
                    'label'  => __( 'Product Cart Table <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_cart_totalp',
                    'label'  => __( 'Product Cart Total <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_cross_sellp',
                    'label'  => __( 'Product Cross Sell <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_checkout_additional_formp',
                    'label'  => __( 'Checkout Additional.. <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_checkout_billingp',
                    'label'  => __( 'Checkout Billing Form <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_checkout_shipping_formp',
                    'label'  => __( 'Checkout Shipping Form <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_checkout_paymentp',
                    'label'  => __( 'Checkout Payment <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_order_reviewp',
                    'label'  => __( 'Checkout Order Review <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_dashboardp',
                    'label'  => __( 'Myaccount Dashboard <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_downloadp',
                    'label'  => __( 'Myaccount Download <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_edit_accountp',
                    'label'  => __( 'My Account <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_addressp',
                    'label'  => __( 'Myaccount Address <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_login_formp',
                    'label'  => __( 'Login Form <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_register_formp',
                    'label'  => __( 'Register Form <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_logoutp',
                    'label'  => __( 'Myaccount Logout <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_myaccount_orderp',
                    'label'  => __( 'Myaccount Order <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_thankyou_orderp',
                    'label'  => __( 'Thankyou Order <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_thankyou_customer_address_detailsp',
                    'label'  => __( 'Thankyou Cus.. Address <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_thankyou_order_detailsp',
                    'label'  => __( 'Thankyou Order Details <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_product_advance_thumbnailsp',
                    'label'  => __( 'Advance Product Image <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

                array(
                    'name'  => 'wpb_social_sherep',
                    'label'  => __( 'Product Social Share <span class="proelement">( Pro )</span>', 'wpbforwpbakery' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'wpbforwpbakery_table_row pro',
                ),

            ),

            'wpbforwpbakery_themes_library_tabs' => array(),
            'wpbforwpbakery_template_library_tabs' => array(),
            'wpbforwpbakery_buy_pro_tabs' => array(),

        );
        
        return array_merge( $settings_fields );
    }


    function plugin_page() {

        echo '<div class="wrap">';
            echo '<h2>'.esc_html__( 'WooCommerce Page Builder Settings','wpbforwpbakery' ).'</h2>';
            $this->save_message();
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';

    }

    function save_message() {
        if( isset($_GET['settings-updated']) ) { ?>
            <div class="updated notice is-dismissible"> 
                <p><strong><?php esc_html_e('Successfully Settings Saved.', 'wpbforwpbakery') ?></strong></p>
            </div>
            <?php
        }
    }

    // General tab
    function wpbforwpbakery_html_general_tabs(){
        ob_start();
        ?>
            <div class="wpbforwpbakery-general-tabs">

                <div class="wpbforwpbakery-document-section">
                    <div class="wpbforwpbakery-column">
                        <a href="https://hasthemes.com/" target="_blank">
                            <img src="<?php echo WPBFORWPBAKERY_ADDONS_PL_URL; ?>/includes/admin/assets/images/video-tutorial.jpg" alt="<?php esc_attr_e( 'Video Tutorial', 'wpbforwpbakery' ); ?>">
                        </a>
                    </div>
                    <div class="wpbforwpbakery-column">
                        <a href="https://hasthemes.com" target="_blank">
                            <img src="<?php echo WPBFORWPBAKERY_ADDONS_PL_URL; ?>/includes/admin/assets/images/online-documentation.jpg" alt="<?php esc_attr_e( 'Online Documentation', 'wpbforwpbakery' ); ?>">
                        </a>
                    </div>
                    <div class="wpbforwpbakery-column">
                        <a href="https://hasthemes.com/contact-us/" target="_blank">
                            <img src="<?php echo WPBFORWPBAKERY_ADDONS_PL_URL; ?>/includes/admin/assets/images/genral-contact-us.jpg" alt="<?php esc_attr_e( 'Contact Us', 'wpbforwpbakery' ); ?>">
                        </a>
                    </div>
                </div>

                <div class="different-pro-free">
                    <h3 class="wpbforwpbakery-section-title"><?php echo esc_html__( 'WC Builder Free VS WC Builder Pro.', 'wpbforwpbakery' ); ?></h3>

                    <div class="wpbforwpbakery-admin-row">
                        <div class="features-list-area">
                            <h3><?php echo esc_html__( 'WC Builder Free', 'wpbforwpbakery' ); ?></h3>
                            <ul>
                                <li><?php echo esc_html__( '16 Elements', 'wpbforwpbakery' ); ?></li>
                                <li class=""><?php echo esc_html__( 'Shop Page Builder', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Single Product Template Builder', 'wpbforwpbakery' ); ?></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Single Product Individual Layout', 'wpbforwpbakery' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Product Archive Category Wise Individual layout', 'wpbforwpbakery' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Cart Page Builder', 'wpbforwpbakery' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Checkout Page Builder', 'wpbforwpbakery' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Thank You Page Builder', 'wpbforwpbakery' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'My Account Page Builder', 'wpbforwpbakery' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'My Account Login page Builder', 'wpbforwpbakery' ); ?></del></li>
                            </ul>
                            <a class="button button-primary" href="https://hasthemes.com/" target="_blank"><?php echo esc_html__( 'Learn More', 'woolenror' ); ?></a>
                        </div>
                        <div class="features-list-area">
                            <h3><?php echo esc_html__( 'WC Builder Pro', 'wpbforwpbakery' ); ?></h3>
                            <ul>
                                <li><?php echo esc_html__( '35 Elements', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Shop Page Builder', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Single Product Template Builder', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Single Product Individual Layout', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Product Archive Category Wise Individual layout', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Cart Page Builder', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Checkout Page Builder', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'Thank You Page Builder', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'My Account Page Builder', 'wpbforwpbakery' ); ?></li>
                                <li><?php echo esc_html__( 'My Account Login page Builder', 'wpbforwpbakery' ); ?></li>
                            </ul>
                            <a class="button button-primary" href="https://hasthemes.com/" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                        </div>
                    </div>

                </div>

            </div>
        <?php
        echo ob_get_clean();
    }

    // Pop up Box
    function wpbforwpbakery_html_popup_box(){
        ob_start();
        ?>
            <div id="wpbforwpbakery-dialog" title="<?php esc_html_e( 'Go Premium', 'wpbforwpbakery' ); ?>" style="display: none;">
                <div class="wldialog-content">
                    <span><i class="dashicons dashicons-warning"></i></span>
                    <p>
                        <?php
                            echo __('Purchase our','wpbforwpbakery').' <strong><a href="'.esc_url( 'https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing' ).'" target="_blank" rel="nofollow">'.__( 'premium version', 'wpbforwpbakery' ).'</a></strong> '.__('to unlock these pro elements!','wpbforwpbakery');
                        ?>
                    </p>
                </div>
            </div>

            <script>
                ( function( $ ) {
                    
                    $(function() {
                        $( '.wpbforwpbakery_table_row.pro,.proelement label,span.proelement' ).click(function() {
                            $( "#wpbforwpbakery-dialog" ).dialog({
                                modal: true,
                                minWidth: 500,
                                buttons: {
                                    Ok: function() {
                                      $( this ).dialog( "close" );
                                    }
                                }
                            });
                        });
                        $(".wpbforwpbakery_table_row.pro input[type='checkbox'],.proelement select").attr("disabled", true);
                    });

                } )( jQuery );
            </script>
        <?php
        echo ob_get_clean();
    }

    // Buy Pro
    function wpbforwpbakery_html_buy_pro_tabs(){
        ob_start();
        ?>
            <div class="wpbforwpbakery-admin-tab-area">
                <ul class="wpbforwpbakery-admin-tabs">
                    <li><a href="#oneyear" class="wlactive"><?php echo esc_html__( 'One Year', 'wpbforwpbakery' ); ?></a></li>
                    <li><a href="#lifetime"><?php echo esc_html__( 'Life Time', 'wpbforwpbakery' ); ?></a></li>
                    <li><a href="#themeseller"><?php echo esc_html__( 'WP Bundle', 'wpbforwpbakery' ); ?></a></li>
                </ul>
            </div>
            
            <div id="oneyear" class="wpbforwpbakery-admin-tab-pane wlactive">
                <div class="wpbforwpbakery-admin-row">

                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( 'Personal', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$19 / Yearly', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( '1 Website', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '1 Year Update', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '1 Year Support', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>

                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( '3 Websites', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$29 / Yearly', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( '3 Websites', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '1 Year Update', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '1 Year Support', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>

                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( 'Developer / Agency', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$39 / Yearly', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( 'Unlimited Websites', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '1 Year Update', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '1 Year Support', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>

                </div>
            </div>

            <div id="lifetime" class="wpbforwpbakery-admin-tab-pane">
                
                <div class="wpbforwpbakery-admin-row">
                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( 'Personal', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$39 / Lifetime', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( '1 Website', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Update', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Support', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>
                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( '3 Websites', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$49 / Lifetime', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( '3 Websites', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Update', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Support', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>
                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( 'Developer / Agency', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$59 / Lifetime', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( 'Unlimited Websites', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Update', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Support', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>
                </div>

            </div>

            <div id="themeseller" class="wpbforwpbakery-admin-tab-pane">
                <div class="wpbforwpbakery-admin-row">
                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( 'Personal', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$99 / Lifetime', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( 'For 1 Website', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Update & Support', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '4 Premium WordPress Plugins are included', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '28 WordPress Themes are included', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '12 WooCommerce Themes included', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>
                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( '5 Websites', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$179 / Lifetime', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( 'For 5 Website', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Update & Support', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '4 Premium WordPress Plugins are included', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '28 WordPress Themes are included', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '12 WooCommerce Themes included', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>
                    <div class="wpbforwpbakery-price-plan">
                        <h3><?php echo esc_html__( 'Developer / Agency', 'wpbforwpbakery' ); ?></h3>
                        <div class="wpbforwpbakery-price">
                            <span class="sell-price"><?php echo esc_html__( '$249 / Lifetime', 'wpbforwpbakery' ); ?></span>
                        </div>
                        <ul>
                            <li><?php echo esc_html__( 'For Unlimited Websites', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( 'Lifetime Update & Support', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '4 Premium WordPress Plugins are included', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '28 WordPress Themes are included', 'wpbforwpbakery' ); ?></li>
                            <li><?php echo esc_html__( '12 WooCommerce Themes included', 'wpbforwpbakery' ); ?></li>
                        </ul>
                        <a class="button button-primary" href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/#pricing" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                    </div>
                </div>
            </div>
        <?php
        echo ob_get_clean();
    }
    

}

new WPBForWPbakery_Admin_Settings();