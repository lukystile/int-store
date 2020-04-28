<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */

get_header();
$blog_sidebar_single = ot_get_option('blog_sidebar_single');
if($blog_sidebar_single === 'left') {
	$single_blog_widget = ot_get_option('single_blog_widget');
	if($single_blog_widget) {
		echo '<div class="col-md-4 col-sm-5 padding-left-zero">';
		echo '<div class="sidebar sidebar-left">';
		dynamic_sidebar( $single_blog_widget );
		echo '</div>';
		echo '</div>';
	} else {
		get_sidebar();
	}
}

if ($blog_sidebar_single == 'hide') {
	$blog_sidebar_single = 'col-md-12';
} else {
	$blog_sidebar_single = 'col-md-8 col-sm-7';
}
?>
	<div class="main-content <?php echo esc_attr($blog_sidebar_single); ?>">
		<?php
			while( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
				comments_template();
			endwhile;
		?>
	</div>
<?php
//echo juster_single_next_prev_posts();
$blog_sidebar_single = ot_get_option('blog_sidebar_single');
if($blog_sidebar_single === 'right') {
	$single_blog_widget = ot_get_option('single_blog_widget');
	if($single_blog_widget) {
		echo '<div class="col-md-4 col-sm-5 padding-right-zero">';
		echo '<div class="sidebar">';
		dynamic_sidebar( $single_blog_widget );
		echo '</div>';
		echo '</div>';
	} else {
		get_sidebar();
	}
} elseif($blog_sidebar_single == 'hide') {
} else {
	get_sidebar();
}
get_footer();
