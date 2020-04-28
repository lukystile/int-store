<?php
/*
*	---------------------------------------------------------------------
*	Woocommerce functions
*	---------------------------------------------------------------------
*/

if ( class_exists( 'Woocommerce' ) ) {

	// Add Support
	add_theme_support( 'woocommerce' );

	// Single Product Single/Gallery Script
	add_action( 'after_setup_theme', 'juster_single_product_gallery_image' );
	function juster_single_product_gallery_image() {
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	// Disable WooCommerce styles
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}

	// Remove sale badge from product page
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	// Remove sale badge from single product page
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

	// Wish list
	if( function_exists( 'YITH_WCWL' ) ) {
		add_action('woocommerce_after_add_to_cart_button', 'juster_yith_wishlist', 10, 0 );
		function juster_yith_wishlist() {
			if ( ! defined( 'YITH_WCWL_DIR' ) ) {
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
			}
		}
	}

	// Define Wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_after_add_to_cart_button','juster_woocommerce_after_add_to_cart_button');
	function juster_woocommerce_after_add_to_cart_button() {
		if( class_exists( 'YITH_Woocompare' ) ) { ?>
			<div class="jt-compare-prd">
				<?php echo do_shortcode('[yith_compare_button]'); ?>
			</div>
		<?php } 
	}

// Product Styles
function woo_ot_function() {
	if ( class_exists( 'OT_Loader' ) ) {
		global $woocommerce;

		function juster_loop_shop_per_page( $cols ) {
		  // $cols contains the current number of products per page based on the value stored on Options -> Reading
		  // Return the number of products you wanna show per page.
		  $woo_products_limit = ot_get_option('woo_products_limit');
		  $cols = 9;
			if ($woo_products_limit) {
				$cols = $woo_products_limit ? $woo_products_limit : $cols;
			}
		  return $cols;
		}
		// Display 24 products per page. Goes in functions.php
		add_filter( 'loop_shop_per_page', 'juster_loop_shop_per_page', 20 );

		$woo_product_design = ot_get_option('woo_product_design');

		// Product Orderby - Random Getting from : WooCommerce > Settings > Products > Display
		add_filter( 'woocommerce_get_catalog_ordering_args', 'juster_woocommerce_get_catalog_ordering_args' );
		function juster_woocommerce_get_catalog_ordering_args( $args ) {
	    $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

	    if ( 'random_list' == $orderby_value ) {
        $args['orderby'] = 'rand';
        $args['order'] = '';
        $args['meta_key'] = '';
	    }
	    return $args;
		}

		// Product Orderby - Random Added in : WooCommerce > Settings > Products > Display
		add_filter( 'woocommerce_default_catalog_orderby_options', 'juster_woocommerce_catalog_orderby' );
		add_filter( 'woocommerce_catalog_orderby', 'juster_woocommerce_catalog_orderby' );
		function juster_woocommerce_catalog_orderby( $sortby ) {
	    $sortby['random_list'] = 'Random';
	    return $sortby;
		}

		if($woo_product_design == 'product_style_two') { // Product Style - 2

			// Theme Wrapper
			add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
			add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

			/* WooCommerce Shop page layout Settings in Theme Options */
			function my_theme_wrapper_start() {
				$fullwidth_boxed = ot_get_option('fullwidth_boxed');
				if($fullwidth_boxed == 'full-width') {
					$ot_layout = 'product-full-width';
				} elseif($fullwidth_boxed == 'extra-width') {
					$ot_layout = 'product-extra-width';
				} else {
					$ot_layout = '';
				}
				if(is_product()) {
					$content_holder = 'col-lg-12 col-lg-12';
				} else {
					$content_holder = 'col-lg-9 col-md-9';
				}
				$custom_column = '3';

				echo '<div class="shop-template product-style-2 '. $ot_layout .' '. $content_holder .' product-col-'. $custom_column .'"><div class="product-column-3">';
			}

			// Item Wrapper
			add_action('woocommerce_before_shop_loop_item', 'juster_item_before', 10);
			add_action('woocommerce_after_shop_loop_item', 'juster_item_after', 10);

			function juster_item_before() {
			  echo '<div class="jt-trend-item">';
			}

			function woocommerce_template_loop_product_thumbnail() {
				global $product;

				if (get_post_meta( get_the_ID(), '_badge_texts', true )) {
					$bg_color = get_post_meta( get_the_ID(), '_badge_bg_color', true );
					$badge_color = get_post_meta( get_the_ID(), '_badge_color', true );
					if ($bg_color) {$bg_color = 'background-color:'. $bg_color .';';} else { $bg_color = ''; }
					if ($badge_color) {$badge_color = 'color:'. $badge_color .';';} else { $badge_color = ''; }
					$woo_badge = '<span class="product-tag" style="'. $bg_color . $badge_color .'">'. get_post_meta( get_the_ID(), '_badge_texts', true ) .'</span>';
				} else {
					$woo_badge = '';
				}

				echo '<div class="jt-trend-item-img">' . $woo_badge;
				echo woocommerce_get_product_thumbnail();
				echo '</div>';
			}

			// Add the inner div in product loop
			add_action( 'woocommerce_before_shop_loop_item_title', 'artificer_product_inner_open', 10);
			add_action( 'woocommerce_after_shop_loop_item_title', 'artificer_product_inner_close', 10);
			function artificer_product_inner_open() {
				echo '<div class="jt-trend-item-desc">';
			}
			function artificer_product_inner_close() {
				echo '</div>';
			}

			function juster_item_after() {
			  echo '</div>';
			}

			function my_theme_wrapper_end() {
			  echo '</div></div>';
			}

			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );

		} else { // Product Style - 1

			// Theme Wrapper
			add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
			add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

			/* WooCommerce Shop page layout Settings in Theme Options */
			function my_theme_wrapper_start() {
				$fullwidth_boxed = ot_get_option('fullwidth_boxed');
				if($fullwidth_boxed == 'full-width') {
					$ot_layout = 'product-full-width';
				} elseif($fullwidth_boxed == 'extra-width') {
					$ot_layout = 'product-extra-width';
				} else {
					$ot_layout = '';
				}
				if(is_product()) {
					$content_holder = 'col-lg-12 col-lg-12';
				} else {
					$content_holder = 'col-lg-9 col-md-9';
				}
				$custom_column = '3';

				echo '<div class="shop-template product-style-1 '. $ot_layout .' '. $content_holder .' product-col-'. $custom_column .'"><div class="product-column-3">';
			}

			// Item Wrapper
			add_action('woocommerce_before_shop_loop_item', 'juster_item_before', 10);
			add_action('woocommerce_after_shop_loop_item', 'juster_item_after', 10);

			function juster_item_before() {
			  echo '<div class="jt-woo-product">';
			}

			function woocommerce_template_loop_product_thumbnail() {
				global $product;

				if (get_post_meta( get_the_ID(), '_badge_texts', true )) {
					$bg_color = get_post_meta( get_the_ID(), '_badge_bg_color', true );
					$badge_color = get_post_meta( get_the_ID(), '_badge_color', true );
					if ($bg_color) {$bg_color = 'background-color:'. $bg_color .';';} else { $bg_color = ''; }
					if ($badge_color) {$badge_color = 'color:'. $badge_color .';';} else { $badge_color = ''; }
					$woo_badge = '<span class="product-tag" style="'. $bg_color . $badge_color .'">'. get_post_meta( get_the_ID(), '_badge_texts', true ) .'</span>';
				} else {
					$woo_badge = '';
				}

				echo '<div class="jt-product-image">' . $woo_badge;
				echo woocommerce_get_product_thumbnail();
				echo '</div>';
			}

			// Add the inner div in product loop
			add_action( 'woocommerce_before_shop_loop_item_title', 'juster_listing_product_inner_open', 10);
			add_action( 'woocommerce_after_shop_loop_item_title', 'juster_listing_product_inner_close', 10);
			function juster_listing_product_inner_open() {
				echo '<div class="jt-product-cnt">';
			}
			function juster_listing_product_inner_close() {
				echo '</div>';
			}

			function juster_item_after() {
			  echo '</div>';
			}

			function my_theme_wrapper_end() {
			  echo '</div></div>';
			}

		} // Product Styles

		// Remove Breadcrumbs
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

	} // Class OT_Loader
} // Function OT
add_action( 'after_setup_theme', 'woo_ot_function' );

function add_to_cart_text_change() {
	if ( class_exists( 'OT_Loader' ) ) {

		// Add To Cart Change Text
		add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
		function woo_custom_cart_button_text() {
			$woo_cart_text = ot_get_option('woo_cart_text');
			if ($woo_cart_text) {
				$woo_cart = $woo_cart_text;
			} else {
				$woo_cart = __('Add To Bag', 'juster');
			}
			return $woo_cart;
		}

		add_filter( 'woocommerce_product_add_to_cart_text' , 'jstr_woocommerce_product_add_to_cart_text' );
		function jstr_woocommerce_product_add_to_cart_text() {
			$woo_cart_text = ot_get_option('woo_cart_text');
			if ($woo_cart_text) {
				$woo_cart = $woo_cart_text;
			} else {
				$woo_cart = __('Add To Bag', 'juster');
			}
			global $product;
			$external = $product->is_type( 'external' );
			$grouped = $product->is_type( 'grouped' );
			$variable = $product->is_type( 'variable' );
			if ($external) {
				$button_text = esc_html__( 'Buy', 'juster' );
			} elseif ($grouped) {
				$button_text = esc_html__( 'View', 'juster' );
			} elseif ($variable) {
				$button_text = esc_html__( 'Select', 'juster' );
			} else {
				$button_text = $woo_cart;
			}
			return $button_text;

		}

	} // Class OT_Loader
} // Function OT
add_action( 'after_setup_theme', 'add_to_cart_text_change' );

function woo_product_share_function() {
	if ( class_exists( 'OT_Loader' ) ) {
		global $woocommerce;
		$woo_share_option = ot_get_option('woo_share_option');
		if(isset($woo_share_option[0])) {
			// Single Product Share Option
			add_action( 'woocommerce_after_single_product_summary', 'jt_share_prd', 10 );
			function jt_share_prd() {
				$page_url = get_permalink();
				$title = get_the_title();
				echo '<div class="jt-single-prd-share">';
				echo '<h2>';
				echo __('Share This On', 'juster');
				echo '</h2>';
				echo '<div class="h2-divider"><div class="h2-center"></div></div>';
				echo '<ul class="social-share">';
				echo '<li><a href="http://www.facebook.com/sharer/sharer.php?u='.$page_url.'&amp;t='.$title.'" class="icon-fa-facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>';
				echo '<li><a href="https://plus.google.com/share?url='.$page_url.'" class="icon-fa-google-plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
				echo '<li><a href="http://twitter.com/home?status='.$title.'+'.$page_url.'" class="icon-fa-twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>';
				echo '<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$page_url.'&amp;title='.$title.'" class="icon-fa-linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
				echo '<li><a href="https://pinterest.com/pin/create/button/?url='.$page_url.'&amp;media=&amp;description='.$title.'"><i class="fa fa-pinterest"></a></i></li>';
				echo '</ul>';
				echo '<div class="leftover"></div>';
				echo '<div class="rightover"></div>';
				echo '</div>';
			}
		}
	} // Class OT_Loader
} // Function OT
add_action( 'after_setup_theme', 'woo_product_share_function' );

function woo_product_relatedprd_function() {
	if ( class_exists( 'OT_Loader' ) ) {
		global $woocommerce;
		$woo_related_product = ot_get_option('woo_related_product');
		if(isset($woo_related_product[0])) {
			function woocommerce_output_related_products() {
				$fullwidth_boxed = ot_get_option('fullwidth_boxed');
				$content_inside_container_ot = ot_get_option('content_inside_container_ot');
				if($fullwidth_boxed == 'full-width') {
					$rel_prd = 4;
				} elseif($fullwidth_boxed == 'extra-width' && !isset($content_inside_container_ot[0])) {
					$rel_prd = 4;
				} elseif($fullwidth_boxed == 'extra-width' && isset($content_inside_container_ot[0])) {
					$rel_prd = 6;
				} else {
					$rel_prd = 4;
				}
				$args = array(
					'posts_per_page' => $rel_prd,
					'columns' => $rel_prd,
					'orderby' => 'rand'
				);
				woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
			}
		} else {
			function wc_remove_related_products( $args ) {
				return array();
			}
			add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);
		}
	} // Class OT_Loader
} // Function OT
add_action( 'after_setup_theme', 'woo_product_relatedprd_function' );

function woo_product_also_like_function() {
	if ( class_exists( 'OT_Loader' ) ) {
		global $woocommerce;
		global $product;
		if ( ! $product ) {
			return;
		}
		$woo_also_like_product = ot_get_option('woo_also_like_product');
		if(isset($woo_also_like_product[0])) {
			function woocommerce_upsell_display() {
				$layout = ot_get_option('woo_layout');
				$custom_class = '';
				if ($layout === 'full_width') {
					$custom_column = '4';
				} elseif ($layout === 'right_sidebar') {
					$custom_column = '3';
				} elseif ($layout === 'left_sidebar') {
					$custom_column = '3';
				} else {
					$custom_column = '3';
				}
				$args = '';

				// Get visible upsells then sort them at random, then limit result set.
				$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
				$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;

				wc_get_template( 'single-product/up-sells.php', array(
					'posts_per_page' => $custom_column,
					'upsells'        => $upsells,
					'orderby' => 'rand',
					'columns' => $custom_column
				) );
			}
		} else { }
	} // Class OT_Loader
} // Function OT
add_action( 'after_setup_theme', 'woo_product_also_like_function' );

	// Exclude Category From WooCoomerce Products
	add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
	function custom_pre_get_posts_query( $q ) {

		$woo_exclude_category = ot_get_option('woo_exclude_category');
		$woo_exclude_category = explode(" ", $woo_exclude_category);
		$woo_exclude_category = array_map('trim', $woo_exclude_category);

		if ( ! $q->is_main_query() ) return;
		if ( ! $q->is_post_type_archive() ) return;
		if ( ! is_admin() && is_shop() ) {
			$q->set(
				'tax_query',
				array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'slug',
						'terms' => $woo_exclude_category, // Don't display products in the knives category on the shop page
						'operator' => 'NOT IN'
					)
				)
			);

		}
		remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
	}

	// Remove WooCommerce prettyPhoto
	global $woocommerce;
	if($woocommerce) {
		function removeWooPrettyPhoto() {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'prettyPhoto' );
		}
	add_action( 'wp_enqueue_scripts', 'removeWooPrettyPhoto', 99 );
	}

	// Change rating position
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	// Sidebar based on woocommerce page layout
	if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {
		function woocommerce_get_sidebar() {
			if(ot_get_option('woo_layout') === 'full_width'){
				// no sidebars
				get_sidebar('shop');
			} else {
				// Display the sidebar if full width option is disabled on archives
				get_sidebar('shop');
			}

			echo '<div class="clear"></div>';
		}
	}

// Displays the cart content
function woocommerce_cart_widget() {
	global $woocommerce;
	if ( ! is_cart() && ! is_checkout() ) {
		echo '<div class="header_cart_widget">';
			the_widget( 'WC_Widget_Cart', 'title=' );
		echo '</div>';
	} else {
		$woo_cart_org_text = ot_get_option('woo_cart_org_text');
		if ($woo_cart_org_text) {
			$woo_cart_org_text = $woo_cart_org_text;
		} else {
			$woo_cart_org_text = __('Cart', 'juster');
		}
		$woo_checkout_text = ot_get_option('woo_checkout_text');
		if ($woo_checkout_text) {
			$woo_checkout_text = $woo_checkout_text;
		} else {
			$woo_checkout_text = __('Checkout', 'juster');
		}
		if (is_cart()) {
			$replace_text = $woo_cart_org_text;
		} elseif (is_checkout()) {
			$replace_text = $woo_checkout_text;
		} else {
			$replace_text = '';
		}
		echo '<div class="header_cart_widget jt-in-cart">';
			$woo_in_woo_page = ot_get_option('woo_in_woo_page');
			if ($woo_in_woo_page) {
				$woo_in_woo_page = $woo_in_woo_page;
			} else {
				$woo_in_woo_page = __('You\'re in WooCommerce Page', 'juster');
			}
			echo esc_attr($woo_in_woo_page);
		echo '</div>';
	}
}

// The cart fragment (ensures the cart button updates via AJAX)
add_filter('add_to_cart_fragments', 'woocommerce_cart_button_fragment');

function woocommerce_cart_button_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	woocommerce_cart_button();
	$fragments['.jt-top-cart-trigger'] = ob_get_clean();
	return $fragments;
}

// Displays the cart number of items on icon
function woocommerce_cart_button() {
	global $woocommerce;

	$menu_position = ot_get_option('menu_position');
	$search_cart_icon_type = ot_get_option('search_cart_icon_type');
	$front_cus_enable = ot_get_option('front_cus_enable');
	$front_page_menu_icon_type = ot_get_option('front_page_menu_icon_type');

	if(is_front_page() && $front_cus_enable == 'on') {
		if((is_front_page() && $front_page_menu_icon_type == 'normal' && $menu_position != 'menu_pos_top_shop')) {
			$front_cart_icon = IMAGES .'/icons/woo-cart.png';
		} elseif((is_front_page() && $front_page_menu_icon_type == 'dark' && $menu_position != 'menu_pos_top_shop')) {
			$front_cart_icon = IMAGES .'/icons/woo-cart-black.png';
		} elseif((is_front_page() && ($front_page_menu_icon_type == 'normal' || $front_page_menu_icon_type == 'dark') && $menu_position == 'menu_pos_top_shop')) {
			$front_cart_icon = IMAGES .'/icons/shop-cart.png';
		} elseif((is_front_page())) {
			$front_cart_icon = IMAGES .'/icons/woo-cart.png';
		}
	} elseif(is_front_page() && $front_cus_enable == 'off') {
		if(is_front_page() && $search_cart_icon_type == 'normal' && $menu_position != 'menu_pos_top_shop') {
			$front_cart_icon = IMAGES .'/icons/woo-cart.png';
		} elseif((is_front_page() && $search_cart_icon_type == 'dark' && $menu_position != 'menu_pos_top_shop')) {
			$front_cart_icon = IMAGES .'/icons/woo-cart-black.png';
		} elseif((is_front_page() && ($search_cart_icon_type == 'normal' || $search_cart_icon_type == 'dark') && $menu_position == 'menu_pos_top_shop')) {
			$front_cart_icon = IMAGES .'/icons/shop-cart.png';
		} elseif((is_front_page())) {
			$front_cart_icon = IMAGES .'/icons/woo-cart.png';
		}
	} else {
		$front_cart_icon = IMAGES .'/icons/woo-cart.png';
	}

	if(!is_front_page() && $search_cart_icon_type == 'normal' && $menu_position != 'menu_pos_top_shop') {
		$cart_icon = IMAGES .'/icons/woo-cart.png';
	} elseif(!is_front_page() && $search_cart_icon_type == 'dark' && $menu_position != 'menu_pos_top_shop') {
		$cart_icon = IMAGES .'/icons/woo-cart-black.png';
	} elseif(!is_front_page() && ($search_cart_icon_type == 'normal' || $search_cart_icon_type == 'dark') && $menu_position == 'menu_pos_top_shop') {
		$cart_icon = IMAGES .'/icons/shop-cart.png';
	} elseif(!is_front_page()) {
		$cart_icon = IMAGES .'/icons/woo-cart.png';
	}
	if (is_page_template( 'template-scroll-lock.php' )) {
		if($search_cart_icon_type == 'normal') {
			$cart_icon = IMAGES .'/icons/woo-cart.png';
		} else {
			$cart_icon = IMAGES .'/icons/woo-cart-black.png';
		}
	}

	$woo_cart_org_text = ot_get_option('woo_cart_org_text');
	if ($woo_cart_org_text) {
		$woo_cart_org_text = $woo_cart_org_text;
	} else {
		$woo_cart_org_text = __('Cart', 'juster');
	}
	?>
	<a href="#0" id="jt-top-cart-trigger">
		<?php if(is_front_page()) { ?>
			<img src="<?php echo esc_attr($front_cart_icon); ?>" alt="">
		<?php } else { ?>
        	<img src="<?php echo esc_attr($cart_icon); ?>" alt="">
        <?php }
        if ( $woocommerce->cart->get_cart_contents_count() != '0') {
			echo '<span class="jt-cart-num">'. $woocommerce->cart->get_cart_contents_count() .'</span>';
		}
		if($menu_position == 'menu_pos_top_shop') {
			echo '<span>'. $woo_cart_org_text .'</span>';
		}
		?>
    </a>
	<?php
}

// Slim menu cart button
function woocommerce_cart_button_slim() {
	global $woocommerce;

	$menu_position = ot_get_option('menu_position');
	$search_cart_icon_type = ot_get_option('search_cart_icon_type');
	if($search_cart_icon_type == 'normal' && $menu_position != 'menu_pos_top_shop') {
		$cart_icon = IMAGES .'/icons/woo-cart.png';
	} elseif($search_cart_icon_type == 'dark' && $menu_position != 'menu_pos_top_shop') {
		$cart_icon = IMAGES .'/icons/woo-cart-black.png';
	} elseif(($search_cart_icon_type == 'normal' || $search_cart_icon_type == 'dark') && $menu_position == 'menu_pos_top_shop') {
		$cart_icon = IMAGES .'/icons/shop-cart.png';
	} else {
		$cart_icon = IMAGES .'/icons/woo-cart.png';
	}
	$woo_cart_org_text = ot_get_option('woo_cart_org_text');
	if ($woo_cart_org_text) {
		$woo_cart_org_text = $woo_cart_org_text;
	} else {
		$woo_cart_org_text = __('Cart', 'juster');
	}
	?>
	<a href="#0" id="jt-top-cart-trigger-slim">
        <img src="<?php echo esc_attr($cart_icon); ?>" alt="">
        <?php if ( $woocommerce->cart->get_cart_contents_count() != '0') {
			echo '<span class="jt-cart-num">'. $woocommerce->cart->get_cart_contents_count() .'</span>';
		}
		if($menu_position == 'menu_pos_top_shop') {
			echo '<span>'. $woo_cart_org_text .'</span>';
		}
		?>
    </a>
	<?php
}

/**
* Hook in on activation
*/
// add_image_size( 'small_shop_catelog', 270, 270 ); // Hard crop left top
// $shop_catalog	= wc_get_image_size( 'small_shop_catelog' );
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'juster_woocommerce_image_dimensions', 1 );

	// Define image sizes
	add_theme_support( 'woocommerce', array(
	  'thumbnail_image_width' => 260,
	  'single_image_width' => 546,
	) );

	update_option( 'woocommerce_thumbnail_cropping', 'custom' );
	update_option( 'woocommerce_thumbnail_cropping_custom_width', '4' );
	update_option( 'woocommerce_thumbnail_cropping_custom_height', '5' );

/**
 * New Cart Look
 */
function cart_shipping_calc() {
	// Move this code to ~/woocommerce/cart/shipping-calculator.php and move the hook call accordingly.

	global $woocommerce;

	if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() ) {
		return;
	}
	?>

	<div class="col-lg-6 padding-left-zero">

		<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

		<div class="shipping_calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

			<h2><?php echo __( 'Shipping Calculator', 'juster' ); ?></h2>

			<div class="juster-shipping-calculator-form">

			<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
				<p class="form-row form-row-wide">
					<label for=""><?php echo __('Country', 'juster') ?></label>
					<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state"
					        rel="calc_shipping_state">
						<option value=""><?php _e( 'Select a country&hellip;', 'juster' ); ?></option>
						<?php
							foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
								echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_attr( $value ) . '</option>';
							}
						?>
					</select>
				</p>
				<?php endif; ?>

				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
				<div class="jt-layout-column jt-one-half jt-spacing-yes">
					<label for=""><?php echo __('State/Province', 'juster'); ?></label>
					<?php
						$current_cc = WC()->customer->get_shipping_country();
						$current_r  = WC()->customer->get_shipping_state();
						$states     = WC()->countries->get_states( $current_cc );

						// Hidden Input
						if ( is_array( $states ) && empty( $states ) ) {

							?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state"
							         placeholder="<?php _e( 'State / county', 'juster' ); ?>" /><?php

							// Dropdown Input
						} elseif ( is_array( $states ) ) {

							?><span>
							<select name="calc_shipping_state" id="calc_shipping_state"
							        placeholder="<?php _e( 'State / county', 'juster' ); ?>">
								<option value=""><?php _e( 'Select a state&hellip;', 'juster' ); ?></option>
								<?php
									foreach ( $states as $ckey => $cvalue ) {
										echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_attr( $cvalue ) . '</option>';
									}
								?>
							</select>
							</span><?php

							// Standard Input
						} else {

							?><input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>"
							         placeholder="<?php _e( 'State / county', 'juster' ); ?>"
							         name="calc_shipping_state" id="calc_shipping_state" /><?php

						}
					?>
				</div>
				<?php endif; ?>

				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>

					<p class="form-row form-row-wide">
						<input type="text" class="input-text"
						       value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>"
						       placeholder="<?php _e( 'City', 'juster' ); ?>" name="calc_shipping_city"
						       id="calc_shipping_city"/>
					</p>

				<?php endif; ?>

				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

					<div class="form-row form-row-wide jt-layout-column jt-one-half jt-spacing-yes jt-column-last">
						<label for="">Zip/Postal Code</label>
						<input type="text" class="input-text"
						       value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>"
						       name="calc_shipping_postcode" id="calc_shipping_postcode"/>
					</div>

				<?php endif;
					$woo_get_quote = ot_get_option('woo_get_quote');
					if ($woo_get_quote) {
						$woo_get_quote = $woo_get_quote;
					} else {
						$woo_get_quote = __( 'Get a Quote', 'juster' );
					}
				?>

				<p>
					<button type="submit" name="calc_shipping" value="1" class="jt-button button-default button-small button default small"><?php echo $woo_get_quote; ?></button>
				</p>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</div>
		</div>
		<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
	</div>
<?php
}

} // WooCommerce if class exist close
