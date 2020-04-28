<?php
/*
    Plugin Name: Juster Core
    Plugin URI: http://defatch-demo.com/themes/juster
    Description: This plugin is only for juster theme. Which have functions for custom post type - Portfolio, Testimonial, Team.
    Version: 1.0
    Author: VictorThemes
    Author URI: http://themeforest.net/user/VictorThemes/juster-core
    License: GNU General Public License version 3.0
    License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

function my_custom_function() {
	if ( class_exists( 'OT_Loader' ) ) {
        $hide = ot_get_option('hide_custom_post_type');
        if(!isset($hide[0])) {
            require_once( plugin_dir_path( __FILE__ ) . '/juster-portfolio.php' );
        }
        if(!isset($hide[1])) {
            require_once( plugin_dir_path( __FILE__ ) . '/juster-testimonial.php' );
        }
        if(!isset($hide[2])) {
            require_once( plugin_dir_path( __FILE__ ) . '/juster-team.php' );
        }
	}
}
add_action( 'after_setup_theme', 'my_custom_function' );
?>