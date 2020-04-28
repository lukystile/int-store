<?php
/**
 * single-portfolio.php
 *
 * The template for displaying single portfolio.
 */
get_header();
while( have_posts() ) : the_post(); ?>
<!-- Container Starts -->
<div class="container-fluid padding-zero">
    <div class="port-content"><?php the_content(); ?></div>
</div>
<!-- Container Ends -->
<?php endwhile;
get_footer();
