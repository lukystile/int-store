<?php
/**
Template Name: Blank Page
**/
get_header();
?>
<div class="container-fluid">

	<?php while( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php
					the_content();
					wp_link_pages();
				?>
			</div>
		</article>

	<?php endwhile; ?>

</div>
<?php get_footer();
