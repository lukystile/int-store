<?php
/**
 * init.php
 */

/* CSS And JS */
require_once( FRAMEWORK . '/add_scripts.php' );

/* Widgets */
require_once( FRAMEWORK . '/widgets/widget-dribbble.php' );
require_once( FRAMEWORK . '/widgets/widget-flickr.php' );
require_once( FRAMEWORK . '/widgets/wp-instagram-widget.php' );
require_once( FRAMEWORK . '/widgets/widgets-keep-in-touch.php' );
require_once( FRAMEWORK . '/widgets/widgets-juster-text.php' );
require_once( FRAMEWORK . '/widgets/widget-recent-posts.php' );

/* Plugins */
require_once( FRAMEWORK . '/plugins/aq_resizer.php' );

/* Plugin Activation */
require_once( FRAMEWORK . '/plugins/notify/activation.php' );

/* Scroll Lock */
require_once( FRAMEWORK . '/juster-scroll-lock.php' );

/* Breadcrumb Plugin */
require_once( FRAMEWORK . '/plugins/breadcrumb-trail.php' );

/* Theme Options */
require_once( FRAMEWORK . '/theme-options/option-tree/ot-loader.php' );
require_once( FRAMEWORK . '/theme-options/theme-options.php' );
require_once( FRAMEWORK . '/theme-options/meta-box.php' );
require_once( FRAMEWORK . '/theme-options/import-export.php' );
require_once( FRAMEWORK . '/theme-options/google-fonts.php' );

/* Visual Composer */
require_once( FRAMEWORK . '/plugins/visual-composer/shortcodes/init.php' );

/* Custom Simple Shortcodes */
require_once( FRAMEWORK . '/custom-shortcodes.php' );

/* Bootstrap Navwalker */
require_once( FRAMEWORK . '/wp_bootstrap_navwalker.php' );
