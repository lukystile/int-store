<?php
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
$blog_sidebar = ot_get_option('blog_sidebar');
if($blog_sidebar == 'left') {
	$blog_sidebar_col_class = 'padding-left-zero';
	$blog_sidebar_class = 'sidebar-left';
} else {
	$blog_sidebar_col_class = 'padding-right-zero';
	$blog_sidebar_class = '';
}

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="col-md-4 col-sm-5 <?php echo esc_attr($blog_sidebar_col_class); ?>">
		<div class="sidebar <?php echo esc_attr($blog_sidebar_class); ?>">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>
<?php endif;
