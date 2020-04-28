<?php
/**
Template Name: One Page Architecture
**/
get_header();
$menu_pos = ot_get_option('menu_position');
if($menu_pos == 'menu_pos_top_arch') {
	echo menu_pos_top_arch();
}
?>
<div id="header" class="jt-architecture-header">
	<button class="slider-switch"><?php echo __('Switch view', 'juster'); ?></button>
</div>
<!-- Drag Slide -->
<div id="slideshow" class="dragslider">
	<section class="img-dragger img-dragger-large dragdealer">
		<div class="handle">
			<?php
			$portfolio_limit        = get_post_meta( $post->ID, 'one_page_arch_limit', 'true' );
			$portfolio_order        = get_post_meta( $post->ID, 'one_page_arch_order', 'true' );
			$portfolio_orderby      = get_post_meta( $post->ID, 'one_page_arch_orderby', 'true' );
			$portfolio_offset       = get_post_meta( $post->ID, 'one_page_arch_offset', 'true' );
			$portfolio_cat_slug     = get_post_meta( $post->ID, 'one_page_arch_cat_slug', 'true' );
			$one_page_arch    		= get_post_meta( $post->ID, 'one_page_arch', 'true' );
		    global $post;
		    // Pagination Issue Fixed
		    global $paged;
		    if( get_query_var( 'paged' ) )
		        $my_page = get_query_var( 'paged' );
		    else {
		        if( get_query_var( 'page' ) )
		           $my_page = get_query_var( 'page' );
		        else
		            $my_page = 1;
		            set_query_var( 'paged', $my_page );
		            $paged = $my_page;
		    }
		    // default loop here, if applicable, followed by wp_reset_query();
		    $args = array(
		      // other query params here,
		      'paged' =>$my_page,
		      'post_type' => 'portfolio',
		      'posts_per_page' => (int)$portfolio_limit,
		      'portfolio_category' => $portfolio_cat_slug,
		      'offset' => (!(int)$portfolio_offset ? "" : (int)$portfolio_offset),
		      'orderby' => $portfolio_orderby,
		      'order' => $portfolio_order
		    );
		    $wpbp = new WP_Query( $args );
		    if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); ?>
				<div class="slide" data-content="content-<?php echo get_the_ID(); ?>">
					<div class="img-wrap">
						<?php
						if ( has_post_thumbnail() && ! post_password_required() ) {
							echo the_post_thumbnail();
						} else { ?>
							<img src="<?php echo IMAGES; ?>/dummy/portfolio/1920x1050.png" alt="">
						<?php } ?>
					</div>
					<h2>
						<button class="test-switch"><?php echo the_title(); ?></button>
						<!-- <a href="<?php esc_url(the_permalink()); ?>"></a> -->
						<span><?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', ''); ?></span>
					</h2>
					<button class="content-switch"></button>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</section>
	<?php
	if($one_page_arch) {
		$one_page_arch_color	= $one_page_arch['background-color'];
		$one_page_arch_repeat	= $one_page_arch['background-repeat'];
		$one_page_arch_attach	= $one_page_arch['background-attachment'];
		$one_page_arch_pos		= $one_page_arch['background-position'];
		$one_page_arch_size		= $one_page_arch['background-size'];
		$one_page_arch_img		= $one_page_arch['background-image'];
		if($one_page_arch_img) {
			$one_page_arch_img = 'background: url('.esc_url($one_page_arch_img).');';
		} else {
			$one_page_arch_img = '';
		}
		if($one_page_arch_color) {
			$one_page_arch_color = 'background-color: '.$one_page_arch_color.';';
		} else {
			$one_page_arch_color = '';
		}
		if($one_page_arch_repeat) {
			$one_page_arch_repeat = 'background-repeat: '.$one_page_arch_repeat.';';
		} else {
			$one_page_arch_repeat = '';
		}
		if($one_page_arch_attach) {
			$one_page_arch_attach = 'background-attachment: '.$one_page_arch_attach.';';
		} else {
			$one_page_arch_attach = '';
		}
		if($one_page_arch_pos) {
			$one_page_arch_pos = 'background-position: '.$one_page_arch_pos.';';
		} else {
			$one_page_arch_pos = '';
		}
		if($one_page_arch_size) {
			$one_page_arch_size = 'background-size: '.$one_page_arch_size.';';
		} else {
			$one_page_arch_size = '';
		}
	} else {
		$one_page_arch_img = '';
		$one_page_arch_color = '';
		$one_page_arch_repeat = '';
		$one_page_arch_attach = '';
		$one_page_arch_pos = '';
		$one_page_arch_size = '';
	}
	?>
	<style>
		.have-js .dragslider:after {
			<?php
				echo esc_attr($one_page_arch_img);
				echo esc_attr($one_page_arch_color);
				echo esc_attr($one_page_arch_repeat);
				echo esc_attr($one_page_arch_attach);
				echo esc_attr($one_page_arch_pos);
				echo esc_attr($one_page_arch_size);
			?>
		}
		.have-js .dragslider {
			<?php echo esc_attr($one_page_arch_color); ?>
		}
	</style>
	<section class="pages jt-arch-pages">
		<?php
		if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
		?>
		<div class="content container" data-content="content-<?php echo get_the_ID(); ?>">
			<?php echo the_content(); ?>
		</div>
		<?php endwhile; endif; ?>
	</section>
</div>
<?php get_footer();
