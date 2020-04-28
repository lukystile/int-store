<?php
/**
 * single.php
 *
 * The template for displaying single posts.
 */
get_header();

while( have_posts() ) : the_post(); ?>
<!-- Container Starts -->
<div class="container-fluid padding-zero">

    <div class="col-lg-12 padding-zero">
        <div class="col-lg-6 padding-zero portfolio-image zoom-gallery">
            <?php
            $gallery_check = get_post_meta( $post->ID, 'port_gallery', true );
            if($gallery_check) {
                $port_gallerys = explode(',', get_post_meta( $post->ID, "port_gallery", true ));
                if($port_gallerys) {
                    foreach($port_gallerys as $port_gallery) {
                        $port_gal = wp_get_attachment_image_src( $port_gallery, 'fullsize', false, '' );
                        $port_gal = $port_gal[0];
                        echo '<a href="'. $port_gal .'" class="image-popup-fit-width">';
                        echo '<img src="'. esc_attr($port_gal) .'">';
                        echo '</a>';
                    }
                }
            } elseif( has_post_thumbnail() && ! post_password_required() ) {
                $port_img_url = wp_get_attachment_url( get_post_thumbnail_id() );
                echo '<a href="'. $port_img_url .'" class="image-popup-fit-width">';
                the_post_thumbnail();
                echo '</a>';
            } else {
                echo '<img src="'. IMAGES .'/dummy/1000x500.jpg">';
            }
            ?>
        </div>
        <div class="col-lg-6 portfolio-detail">
            <div class="port-cate"><i class="fa fa-bookmark-o"></i>
            <?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', ''); ?></div>
            <div class="port-name"><h2><?php echo the_title(); ?></h2></div>
            <div class="port-content"><p><?php the_content(); ?></p></div>
            <div class="port-date"><i class="fa fa-calendar"></i><?php the_date(); ?></div>
            <div class="port-extra-detail">
                <ul>
                    <?php
                        $port_lists = get_post_meta( $post->ID, 'port_list', true );
                        if($port_lists) {
                            foreach($port_lists as $port_list) {
                                $list_content = $port_list['port_list_content'];
                                $list_icon = $port_list['port_list_icon'];
                                ?>
                                <li>
                                    <i class="fa fa-<?php echo esc_attr($list_icon); ?>"></i>
                                    <?php echo $list_content; ?>
                                </li>
                                <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php echo next_prev_portfolio(); ?>
</div>
<!-- Container Ends -->
<?php endwhile;

get_footer();
?>