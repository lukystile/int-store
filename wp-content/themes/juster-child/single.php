<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */

get_header();?>

    <style>
        .jt-main-banner-holder .jt-banner-overlay,
        .jt-main-banner-holder .slider-container,
        .jt-main-banner-holder .jt-page-banner,
        .jt-main-banner-holder .jt-banner-graphic
        {
            display: none !important;
        }

        .jt-page-header {
            min-height: 70px !important;
        }
    </style>

	<div class="main-content col-sm-10 col-sm-offset-1">
		<?php
			while( have_posts() ) : the_post();
				?>

                <article id="post-<?php echo get_the_ID()?>" class="news-article">
                    <div class="news-heading">
                        <h2><?php the_title()?></h2>
                        <h3>
                            <?php $category = get_the_category();?>
                            <?php if (isset($category[0]) && $category[0]) :?>
                                <a href="<?php echo get_term_link($category[0]->term_id)?>" class="category"><?php echo $category[0]->name?></a>
                            <?php endif;?>
                            <span class="date"><?php echo get_the_date('d.m.Y', get_the_ID())?></span>
                        </h3>

	                    <?php if ($post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full' )) :?>
                            <img src="<?php echo $post_thumbnail?>" alt="" class="img-responsive">
	                    <?php endif;?>
                    </div>

                    <div class="entry-content">
                        <?php the_content();?>
                    </div>
                    <div class="social">
                        <ul>
                            <li class="share-text"><?php echo __('Share', 'aesti')?></li>
                            <li>
                                <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&amp;t=<?php print(urlencode(get_the_title())); ?>" class="icon-fa-facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="http://twitter.com/home?status=<?php print(urlencode(get_the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-fa-twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode(get_permalink())); ?>&amp;title=<?php print(urlencode(get_the_title())); ?>" class="icon-fa-linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/share?url=<?php print(urlencode(get_permalink())); ?>" class="icon-fa-google-plus" target="_blank"><i class="fa fa-google-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>

                <?php
			endwhile;
		?>
	</div>
<?php

get_footer();
