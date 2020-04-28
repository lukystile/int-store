<?php
/**
Template Name: Scroll Sections
**/
get_header();

global $post;

$sl_limits = get_post_meta( $post->ID, 'sl_limits', true );
$sl_order = get_post_meta( $post->ID, 'sl_order', true );
$sl_orderby = get_post_meta( $post->ID, 'sl_orderby', true );
$sl_category = get_post_meta( $post->ID, 'sl_category', true );

// default loop here, if applicable, followed by wp_reset_query();
$args = array(
  // other query params here,
  'post_type' => 'scroll_lock',
  'posts_per_page' => (int)$sl_limits,
  'scroll_lock_category' => $sl_category,
  'orderby' => $sl_orderby,
  'order' => $sl_order
);

$scroll_lock_listing = new WP_Query( $args );

?>
<div id="fullpage" class="has_animation">
	<?php
		if ($scroll_lock_listing->have_posts()) : while ($scroll_lock_listing->have_posts()) : $scroll_lock_listing->the_post();
		$scroll_section_bg = get_post_meta( $post->ID, 'scroll_section_bg', true );
		if ($scroll_section_bg) {
			$scroll_bg_color = $scroll_section_bg['background-color'];
			$scroll_bg_repeat = $scroll_section_bg['background-repeat'];
			$scroll_bg_attachment = $scroll_section_bg['background-attachment'];
			$scroll_bg_position = $scroll_section_bg['background-position'];
			$scroll_bg_size = $scroll_section_bg['background-size'];
			$scroll_bg_image = $scroll_section_bg['background-image'];

			if ($scroll_bg_color) {
				$scroll_bg_color = 'background-color: '. $scroll_bg_color .';';
			} else {$scroll_bg_color = '';}
			if ($scroll_bg_repeat) {
				$scroll_bg_repeat = 'background-repeat: '. $scroll_bg_repeat .';';
			} else {$scroll_bg_repeat = '';}
			if ($scroll_bg_attachment) {
				$scroll_bg_attachment = 'background-attachment: '. $scroll_bg_attachment .';';
			} else {$scroll_bg_attachment = '';}
			if ($scroll_bg_position) {
				$scroll_bg_position = 'background-position: '. $scroll_bg_position .';';
			} else {$scroll_bg_position = '';}
			if ($scroll_bg_size) {
				$scroll_bg_size = '-webkit-background-size:'. $scroll_bg_size .';background-size: '. $scroll_bg_size .';';
			} else {$scroll_bg_size = '';}
			if ($scroll_bg_image) {
				$scroll_bg_image = 'background-image: url('. $scroll_bg_image .');';
			} else {$scroll_bg_image = '';}

			$all_bgs = $scroll_bg_color . $scroll_bg_repeat . $scroll_bg_attachment . $scroll_bg_position . $scroll_bg_size . $scroll_bg_image;
		}
	?>
 		<div class="section" id="p-<?php the_ID(); ?>" style="<?php echo $all_bgs; ?>">
			<?php the_content(); ?>
		</div>
	<?php endwhile; endif;
	wp_reset_postdata(); ?>

</div> <!-- end main-content -->
<?php
wp_enqueue_script( 'wow.min', SCRIPTS . '/wow.min.js', array( 'jquery' ), false, true );
get_footer();
