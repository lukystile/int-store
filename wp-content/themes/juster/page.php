<?php
/**
 * page.php
 *
 * The template for displaying all pages.
 */

get_header();

$page_model		= get_post_meta( $post->ID, 'page_model', true );
$sidebar_select	= get_post_meta( $post->ID, 'select_custom_sidebar', true );

if ($page_model === 'left_sidebar') {
	if (!$sidebar_select) {
		get_sidebar();
	} else {
		if( function_exists( 'YITH_WCWL' ) && is_page('wishlist') ) {
			echo '<div class="col-lg-3 col-md-3 col-sm-12 sidebar-shop">';
				dynamic_sidebar($sidebar_select);
			echo '</div>';
		} else {
			echo '<div class="col-md-4 col-sm-5 padding-left-zero">';
			echo '<div class="sidebar sidebar-left">';
				dynamic_sidebar($sidebar_select);
			echo '</div>';
			echo '</div>';
		}
	}
}

	$layout_model = get_post_meta( $post->ID, 'page_model', true );
	if( $layout_model === 'full_width' ) {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	} elseif( $layout_model === 'extra_width' ) {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	} elseif( class_exists( 'WooCommerce' ) && (is_checkout() || is_cart()) ) {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	} elseif( function_exists( 'YITH_WCWL' ) && is_page('wishlist') ) {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	} elseif( $layout_model === 'left_sidebar' || $layout_model === 'right_sidebar' ) {
		$layout_structure = 'main-content col-lg-8 col-sm-7 padding-zero';
	} else {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	}
	?>
	<div class="<?php echo esc_attr($layout_structure); ?>">
		<?php while( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php
						the_content();
						wp_link_pages();
					?>
				</div>
			</article>

			<?php
			$page_comments = ot_get_option('page_comments');
			if($page_comments == 'on') {
				comments_template();
			} else { }

		endwhile; ?>
	</div> <!-- end main-content -->

<?php
if ($page_model === 'right_sidebar') {
	if (!$sidebar_select) {
		get_sidebar();
	} else {
		if( function_exists( 'YITH_WCWL' ) && is_page('wishlist') ) {
			echo '<div class="col-lg-3 col-md-3 col-sm-12 sidebar-shop">';
				dynamic_sidebar($sidebar_select);
			echo '</div>';
		} else {
			echo '<div class="col-md-4 col-sm-5 padding-right-zero">';
			echo '<div class="sidebar">';
				dynamic_sidebar($sidebar_select);
			echo '</div>';
			echo '</div>';
		}
	}
}
get_footer();
