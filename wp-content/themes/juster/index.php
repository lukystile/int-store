<?php
/**
 * index.php
 *
 * The main template file.
 */

get_header();
$blog_sidebar = ot_get_option('blog_sidebar');
if ($blog_sidebar === 'left') {
	get_sidebar();
}

$blog_order 	= ot_get_option('blog_order');
$blog_orderby 	= ot_get_option('blog_orderby');
$blog_offset 	= ot_get_option('blog_offset');
if ($blog_order) {
	$blog_order = $blog_order;
} else {
	$blog_order = 'asc';
}
if ($blog_orderby) {
	$blog_orderby = $blog_orderby;
} else {
	$blog_orderby = 'date';
}

if(!is_singular()) {
	// Pagination Issue Fixed
	global $post, $paged;
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
  'post_type' => 'post',
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
			if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
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
