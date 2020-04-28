<?php
/**
 * Plugin Name: WC Builder
 * Description: The WooCommerce elements library for WPBakery page builder plugin for WordPress.
 * Plugin URI: 	http://hasthemes.com
 * Version: 	1.0.5
 * Author: 		HasThemes
 * Author URI: 	http://hasthemes.com
 * License:  	GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wpbforwpbakery
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'WPBFORWPBAKERY_VERSION', '1.0.0' );
define( 'WPBFORWPBAKERY_ADDONS_PL_URL', plugins_url( '/', __FILE__ ) );
define( 'WPBFORWPBAKERY_ADDONS_PL_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPBFORWPBAKERY_ADDONS_PL_ROOT', __FILE__ );

// Required File
require_once WPBFORWPBAKERY_ADDONS_PL_PATH.'includes/activation-notice.php';
require_once WPBFORWPBAKERY_ADDONS_PL_PATH.'includes/custom-posts.php';
require_once WPBFORWPBAKERY_ADDONS_PL_PATH.'includes/helper-functions.php';
require_once WPBFORWPBAKERY_ADDONS_PL_PATH.'includes/admin/admin-init.php';
require_once WPBFORWPBAKERY_ADDONS_PL_PATH.'includes/metaboxes.php';

add_action('plugins_loaded', 'wpbforwpbakery_initialize_plugin');
function wpbforwpbakery_initialize_plugin(){
	require_once WPBFORWPBAKERY_ADDONS_PL_PATH.'init.php';
}

// enqueue scripts
add_action( 'wp_enqueue_scripts','wpbforwpbakery_enqueue_scripts');
function  wpbforwpbakery_enqueue_scripts(){
    // enqueue styles
    wp_enqueue_style( 'wpbforwpbakery-main', WPBFORWPBAKERY_ADDONS_PL_URL.'/assets/css/main.css');

   // dynamic style
   $site_width = wpbforwpbakery_get_option( 'content_width', 'wpbforwpbakery_woo_template_tabs', '1170' );
   $data = '';
   if($site_width){
   	   $data = "
  			.wpbforwpbakery_archive .vc_row.wpb_row.vc_row-fluid,
  			.wpbforwpbakery-single-product .vc_row.wpb_row.vc_row-fluid,
  			.wpbforwpbakery-page-template .vc_row.wpb_row.vc_row-fluid{
  				max-width: $site_width;
  				margin: 0 auto;
  			}
  			.wpbforwpbakery_archive .vc_row.wpb_row.vc_row-fluid[data-vc-full-width='true'],
  			.wpbforwpbakery-single-product .vc_row.wpb_row.vc_row-fluid[data-vc-full-width='true'],
  			.wpbforwpbakery-page-template .vc_row.wpb_row.vc_row-fluid[data-vc-full-width='true']{
				max-width:100%;
  			}
   	   ";
   }
   wp_add_inline_style( 'wpbforwpbakery-main', $data );
}


//Register a custom menu page.
add_action( 'admin_menu', 'wpbforwpbakery_register_menu_page' );
function wpbforwpbakery_register_menu_page() {
    add_menu_page(
        __( 'WC Page Builder', 'wpbforwpbakery' ),
        'WC Page Builder',
        'manage_options',
        'wpbforwpbakery_options',
        '',
        WPBFORWPBAKERY_ADDONS_PL_URL.'includes/admin/assets/images/menu-icon.png'
    );
}

// set vc editor to post type
add_action('plugins_loaded', 'wpbforwpbakery_fire_vc_before_init');
function wpbforwpbakery_fire_vc_before_init(){
	add_action('vc_before_init', 'wpbforwpbakery_set_post_type_to_vc_editor');
}

function wpbforwpbakery_set_post_type_to_vc_editor(){
	if (function_exists('vc_set_default_editor_post_types')) {
		vc_set_default_editor_post_types(array('page', 'post', 'wpbfwpb_template'));
	}
}
