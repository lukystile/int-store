<?php
/**
Template Name: Vintage Home
**/
get_header();
	while( have_posts() ) : the_post();
		the_content();
		wp_link_pages();

		$page_comments = ot_get_option('page_comments');
		if($page_comments=='on') {
			comments_template();
		} else { }
	endwhile;
get_footer();
