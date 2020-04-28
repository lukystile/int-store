<?php
/**
 * tag.php
 *
 * The template for displaying tag pages.
 */

get_header();
$blog_sidebar = ot_get_option('blog_sidebar');
if ($blog_sidebar === 'left') {
	get_sidebar();
}

$blog_order 	= ot_get_option('blog_order');
$blog_orderby 	= ot_get_option('blog_orderby');
$blog_offset 	= ot_get_option('blog_offset');

if(!is_singular()) {
	// Pagination Issue Fixed
	global $post;
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
	  'paged' => esc_attr($my_page),
	  'order' => $blog_order,
	  'orderby' => $blog_orderby,
	  'offset' => (!(int)$blog_offset ? "" : (int)$blog_offset)
	);
	$wpbp = new WP_Query( $args );
}

$blog_style_ot = ot_get_option('blog_style_ot');
if ($blog_sidebar == 'hide') {
	$blog_sidebar_class = 'col-md-12';
} else {
	$blog_sidebar_class = 'col-md-8 col-sm-7';
}
$masonry_blog_columns = ot_get_option('blog_style_ot_5_style');
if ($blog_style_ot == 'blog_style_ot_5') {
	$blog_style_ot_class = 'isotope-blog blog-masonary-style ' . $masonry_blog_columns;
} else {
	$blog_style_ot_class = '';
}

?>
	<div class="<?php echo esc_attr($blog_sidebar_class); ?> jt-post-wrapper padding-zero <?php echo esc_attr($blog_style_ot . ' ' . $blog_style_ot_class); ?>">
		<?php

		if(!is_singular()) {
			if (have_posts()) :
				if ($blog_style_ot != 'blog_style_ot_5') { ?>
					<h1>
						<?php
							printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) );
						?>
					</h1>
					<?php
				}
				while (have_posts()) : the_post();
				get_template_part( 'content', get_post_format() );
				endwhile;

				if($blog_style_ot == 'blog_style_ot_5') { ?>
					<div class="pagination-masonry-style">
						<?php echo juster_paging_nav(); ?>
					</div>
				<?php } else {
					echo juster_paging_nav();
				}
			else :
				 ?>
				<h1>
					<?php
						printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) );
					?>
				</h1>
				<?php
			endif;
		} else {
			if ( have_posts() ) : while( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
				endwhile;

				if($blog_style_ot == 'blog_style_ot_5') { ?>
					<div class="pagination-masonry-style">
						<?php echo juster_paging_nav(); ?>
					</div>
				<?php } else {
					echo juster_paging_nav();
				}
			else :
				get_template_part( 'content', 'none' );
			endif;
		}
		?>
	</div>
<?php
if ($blog_sidebar === 'right') {
	get_sidebar();
} elseif($blog_sidebar === 'hide') {} else {
	get_sidebar();
}
	get_footer();
