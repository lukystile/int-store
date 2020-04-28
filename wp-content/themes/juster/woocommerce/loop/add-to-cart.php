<?php
/**
 * VictorThemes Changes are mentioned by "Custom Changes"
 */

/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$woo_product_design = ot_get_option('woo_product_design');
if($woo_product_design == 'product_style_two' && !is_page('wishlist')) {
?>
	<div class="jt-trend-hover">
		<ul>
			<li class="img_view">
				<?php
				$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
				$large_image = $large_image[0];
				?>
				<a href="<?php echo esc_url($large_image); ?>" class="format-image-popup jt-featured-img"><i class='fa fa-search'></i></a>
			</li>
			<?php
			if ( defined( 'YITH_WCWL_DIR' ) ) {
				echo '<li class="wishlist_view">';
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
				echo '</li>';
			}

			echo '<li class="cart_view">';
			// Custom Changes - Following code copied from original file. With some modification
			echo apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s">%s</a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( $product->get_id() ),
							esc_attr( $product->get_sku() ),
							esc_attr( isset( $quantity ) ? $quantity : 1 ),
							esc_attr( isset( $class ) ? $class : 'add_to_cart_button' ),
							esc_attr( $product->add_to_cart_text() )
			),
			$product );
			echo '</li>';
		?>
		</ul>
	</div>
<?php } else {
	// Custom Changes - Following code copied from original file. With some modification
	echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( $product->get_id() ),
					esc_attr( $product->get_sku() ),
					esc_attr( isset( $quantity ) ? $quantity : 1 ),
					esc_attr( isset( $class ) ? $class : 'add_to_cart_button' ),
					esc_attr( $product->add_to_cart_text() )
		),
	$product );
}
