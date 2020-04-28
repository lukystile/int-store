<?php
/**
 * archive.php
 *
 * The template for displaying archive posts.
 */

get_header();
$blog_sidebar = ot_get_option('blog_sidebar');
if ($blog_sidebar === 'left') {
	get_sidebar();
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
	<div class="main-content jt-post-wrapper <?php echo esc_attr($blog_sidebar_class . ' ' . $blog_style_ot . ' ' . $blog_style_ot_class); ?>">
		<?php if ( have_posts() ) :
			if ($blog_style_ot != 'blog_style_ot_5') { ?>
				<h1>
					<?php
						if ( is_day() ) {
							printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
						} else {
							echo __( 'Archives', 'juster' );
						}
					?>
				</h1>
				<?php
			}
				while( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;

				juster_paging_nav();
		else :
			get_template_part( 'content', 'none' );
		endif; ?>
	</div> <!-- end main-content -->
<?php
if ($blog_sidebar === 'right') {
	get_sidebar();
} elseif($blog_sidebar === 'hide') {} else {
	get_sidebar();
}

get_footer();
