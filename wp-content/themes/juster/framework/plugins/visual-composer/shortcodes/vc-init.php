<?php
/**
 * Visual Composer
 */

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if(function_exists('vc_set_as_theme')) vc_set_as_theme();

// Remove VC Teaser metabox
if ( is_admin() ) {
  if ( ! function_exists('wpex_remove_vc_boxes') ) {
    function wpex_remove_vc_boxes(){
      $post_types = get_post_types( '', 'names' );
      foreach ( $post_types as $post_type ) {
        remove_meta_box('vc_teaser',  $post_type, 'side');
      }
    } // End function
  } // End if
add_action('do_meta_boxes', 'wpex_remove_vc_boxes');
}

// Disable Front-End Editor
function juster_vc_frontend_editor() {
  $enable_vc_frontend = ot_get_option('enable_vc_frontend');
  if ($enable_vc_frontend == 'off') {
    if (function_exists('vc_set_as_theme') ) {
      vc_disable_frontend();
    }
  }
}
add_action( 'after_setup_theme', 'juster_vc_frontend_editor' );

// Set VC Editor as Default in Portfolio
$list = array(
    'page',
    'portfolio',
    'scroll_lock'
);
vc_set_default_editor_post_types( $list );

/* Pre-Defined VC Templates */
require_once( FRAMEWORK . '/plugins/visual-composer/shortcodes/pre-templates/templates-init.php' );
