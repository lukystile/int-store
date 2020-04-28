<?php
/**
 * sidebar-shop.php
 *
 * The shop sidebar.
 */
if( !is_single() ) {
	echo '<div class="col-lg-3 col-md-3 col-sm-12 sidebar-shop">';
		dynamic_sidebar( 'shop-widget' );
	echo '</div>';
}
