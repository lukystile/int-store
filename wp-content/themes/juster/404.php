<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found).
 */

get_header();
?>
<div class="container-fluid">
    <div class="col-lg-7">
        <div class="error-content">
            <div class="hang-text hang-1 animated fadeInDown">
            	<img src="<?php echo IMAGES; ?>/error/error-4.png" alt="<?php __('404', 'juster'); ?>" >
            </div>
            <div class="hang-text hang-2 animated fadeInDown">
            	<img src="<?php echo IMAGES; ?>/error/error-0.png" alt="<?php __('404', 'juster'); ?>" class="animated fadeInDown">
            </div>
            <div class="hang-text hang-3 animated fadeInDown">
            	<img src="<?php echo IMAGES; ?>/error/error-4.png" alt="<?php __('404', 'juster'); ?>" class="animated fadeInDown">
            </div>
            <?php
            $page_404_heading = ot_get_option('404_page_heading');
            $page_404_content = ot_get_option('404_page_content');
            if($page_404_heading) {
                $page_404_heading = $page_404_heading;
            } else {
                $page_404_heading = __('Sorry! The Page Not Found', 'juster');
            }
            if($page_404_content) {
                $page_404_content = $page_404_content;
            } else {
                $page_404_content = __('The Link You Followed Probably Broken, or the page has been removed.', 'juster');
            }
            ?>
            <h2 class="error-msg"><?php echo $page_404_heading; ?></h2>
            <p class="error-info"><?php echo $page_404_content; ?></p>
            <?php
            $page_404_search = ot_get_option('404_page_search_box');
            if($page_404_search == 'on') {
            ?>
            <div class="col-sm-4 search-center">
                <div class="error-search">
                    <form class="search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" >
                        <input type="text" name="s" id="s" class="form-control" placeholder="<?php echo __('Search again...', 'juster') ?>">
                    </form>
                </div>
            </div>
            <?php } ?>
		</div>
	</div>
    <div class="col-lg-4">
        <div class="error-image">
        <?php
        $page_404_img = ot_get_option('404_page_image');
        if($page_404_img) {
            $page_404_img = $page_404_img;
        } else {
            $page_404_img = IMAGES.'/error/404.png';
        }
        ?>
            <img src="<?php echo esc_url($page_404_img); ?>" alt="">
        </div>
    </div>
</div>
<?php get_footer();
