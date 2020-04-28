<?php
/**
 * Remove elements and params from the default Visual Composer
 *
 * @package WordPress
 * @subpackage Juster
 * @since Juster 1.0
 */

// Remove composer elements
if ( function_exists('vc_remove_element') ) {
	if ( !function_exists( 'juster_vc_modules_remove' )) {
		function juster_vc_modules_remove() {
			vc_remove_element('vc_button');
			vc_remove_element('vc_cta_button');
			vc_remove_element('vc_cta_button2');
		} // End function
	} // End if
	add_action( 'init', 'juster_vc_modules_remove' );
} // End if

// remove certain composer params
if ( function_exists('vc_remove_param') ) {

	// Tabs & Accordion
	vc_remove_param( 'vc_tta_tabs', 'color' );
	vc_remove_param( 'vc_tta_tabs', 'shape' );
	vc_remove_param( 'vc_tta_accordion', 'color' );

	// Columns
	vc_remove_param( 'vc_column', 'css' );
	vc_remove_param( 'vc_column', 'font_color' );

}

// Remove teaser metabox
if ( is_admin() ) {
	function wpex_remove_meta_boxes() {
		if( !current_user_can('manage_options') ) {
			remove_meta_box('linktargetdiv', 'link', 'normal');
		} // End privalages check
	} // End function
	add_action( 'admin_menu', 'wpex_remove_meta_boxes' );
} // Is admin check
