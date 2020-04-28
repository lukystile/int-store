<?php
/**
 * category-portfolio.php
 *
 * The template for displaying category portfolio.
 */

get_header();

$portfolio_style        = ot_get_option('portfolio_style');
$portfolio_col_type     = ot_get_option('portfolio_col_type');
$portfolio_limit        = ot_get_option('portfolio_limit');
$portfolio_cate_filter  = ot_get_option('portfolio_cate_filter');
$portfolio_cate_filter_back_text  = ot_get_option('portfolio_cate_filter_back_text');
$portfolio_order        = ot_get_option('portfolio_order');
$portfolio_orderby      = ot_get_option('portfolio_orderby');
$portfolio_offset       = ot_get_option('portfolio_offset');
$portfolio_pagination_enable   = ot_get_option('portfolio_pagination_enable');

if($portfolio_col_type) {
    if($portfolio_col_type == 'portfolio_column_two') {
        $portfolio_col_type = 'jt-port-col-2';
    } elseif($portfolio_col_type == 'portfolio_column_three') {
        $portfolio_col_type = 'jt-port-col-3';
    } elseif($portfolio_col_type == 'portfolio_column_four') {
        $portfolio_col_type = 'jt-port-col-4';
    }
} else {
  $portfolio_col_type = 'jt-port-col-4';
}
?>
    <div class="main-content col-lg-12 padding-zero">
        <?php if ( have_posts() ) :
        $portfolio_cate_filter = ot_get_option('portfolio_cate_filter');
        if($portfolio_cate_filter) {
        ?>
            <!-- Portfolio Filter -->
            <ul id="filters" class="jt-filter">
                <?php
                $portfolio_cate_filter_back_text = ot_get_option('portfolio_cate_filter_back_text');
                if($portfolio_cate_filter_back_text) {
                ?>
                <li class="back-text"><?php echo __('All', 'juster'); ?></li>
                <?php } ?>
                <li><a data-filter="*" class="filter" href="#0"><?php echo __('All', 'juster'); ?></a></li>
                <?php
                    $terms = get_terms('portfolio_category');
                    $count = count($terms);
                    $i=0;
                    $term_list = '';
                    if ($count > 0) {
                        foreach ($terms as $term) {
                            $i++;
                            $term_list .= '<li><a href="#0" class="filter cat-'. $term->slug .'" data-filter=".cat-'. $term->slug .'" title="' . esc_attr($term->name) . '">' . $term->name . '</a></li>';
                            if ($count != $i) {
                                $term_list .= '';
                            } else {
                                $term_list .= '';
                            }
                        }
                        echo $term_list;
                    }
                ?>
            </ul>
            <!-- Portfolio Filter -->
        <?php } ?>
            <!-- Portfolio -->
            <div class="isotope jt-portfolio-wrapper <?php echo esc_attr($portfolio_col_type); ?>">
            <?php
                global $post;
                // Pagination Issue Fixed
                global $paged;
                if( get_query_var( 'paged' ) )
                    $my_page = get_query_var( 'paged' );
                else {
                    if( get_query_var( 'page' ) )
                       $my_page = get_query_var( 'page' );
                    else
                        $my_page = 1;
                        set_query_var( 'paged', $my_page );
                        $paged = $my_page;
                }
                // default loop here, if applicable, followed by wp_reset_query();
                $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'post_type' => 'portfolio',
                  'posts_per_page' => (int)$portfolio_limit,
                  'offset' => (!(int)$portfolio_offset ? "" : (int)$portfolio_offset),
                  'orderby' => $portfolio_orderby,
                  'order' => $portfolio_order
                );

                $wpbp = new WP_Query( $args );

                if (have_posts()) : while (have_posts()) : the_post();

                $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                $large_image = $large_image[0];

                $terms = wp_get_post_terms($post->ID,'portfolio_category');
                foreach ($terms as $term) {
                  $cat_class = 'cat-' . $term->slug;
                }
                $count = count($terms);
                $i=0;
                $cat_class = '';
                if ($count > 0) {
                    foreach ($terms as $term) {
                        $i++;
                        $cat_class .= 'cat-'. $term->slug .' ';
                        if ($count != $i) {
                            $cat_class .= '';
                        } else {
                            $cat_class .= '';
                        }
                    }
                }
            if($portfolio_style == 'portfolio_masonry') {
                $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                $large_image = $large_image[0];

                $ot_layout = ot_get_option('fullwidth_boxed');
                if($ot_layout == 'extra-width') {
                    if($portfolio_col_type == 'jt-port-col-2') {
                        if($large_image) {
                            $portfolio_img = $large_image;
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/960x550.png';
                        }
                    }
                    if($portfolio_col_type == 'jt-port-col-3') {
                        if($large_image) {
                            $portfolio_img = $large_image;
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/960x550.png';
                        }
                    }
                    if($portfolio_col_type == 'jt-port-col-4') {
                        if($large_image) {
                            $portfolio_img = $large_image;
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/960x550.png';
                        }
                    }
                } else {
                    $portfolio_img = $large_image;
                }
            } elseif($portfolio_style == 'portfolio_column') {
                $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                $large_image = $large_image[0];

                $ot_layout = ot_get_option('fullwidth_boxed');
                if($ot_layout == 'extra-width') {
                    if($portfolio_col_type == 'jt-port-col-2') {
                        if($large_image) {
                            $portfolio_img = aq_resize( $large_image, '960', '550', true );
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/960x550.png';
                        }
                    } elseif($portfolio_col_type == 'jt-port-col-3') {
                        if($large_image) {
                            $portfolio_img = aq_resize( $large_image, '640', '450', true );
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/640x450.png';
                        }
                    } elseif($portfolio_col_type == 'jt-port-col-4') {
                        if($large_image) {
                            $portfolio_img = aq_resize( $large_image, '480', '400', true );
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/480x400.png';
                        }
                    } else {
                        $portfolio_img = $large_image;
                    }
                } elseif($ot_layout == 'full-width') {
                    if($portfolio_col_type == 'jt-port-col-2') {
                        if($large_image) {
                            $portfolio_img = aq_resize( $large_image, '590', '380', true );
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/590x380.png';
                        }
                    } elseif($portfolio_col_type == 'jt-port-col-3') {
                        if($large_image) {
                            $portfolio_img = aq_resize( $large_image, '390', '320', true );
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/390x320.png';
                        }
                    } elseif($portfolio_col_type == 'jt-port-col-4') {
                        if($large_image) {
                            $portfolio_img = aq_resize( $large_image, '290', '250', true );
                        } else {
                            $portfolio_img = IMAGES.'/dummy/portfolio/290x250.png';
                        }
                    } else {
                        $portfolio_img = $large_image;
                    }
                } else {
                    $portfolio_img = $large_image;
                }
            } else {
                $portfolio_img = $large_image;
            }
            ?>
                <div class="jt-portfolio-item jt-able-filter <?php echo esc_attr($cat_class); ?>">
                    <div class="jt-port-image">
                        <img src="<?php echo esc_attr($portfolio_img); ?>" alt="" />
                    </div>
                    <div class="jt-port-overlay">
                        <div class="jt-port-content">
                            <div class="jt-port-heading">
                                <a href="<?php esc_url(the_permalink()); ?>">
                                    <?php echo the_title(); ?>
                                </a>
                            </div>
                            <div class="jt-port-sep"></div>
                            <div class="jt-port-cat">
                            <?php
                                $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                                $i=1;
                                foreach ($category_list as $term) {
                                  $term_link = get_term_link( $term );
                                  echo '<a href="'. esc_url($term_link) .'">'. $term->name .'</a> ';
                                  if($i++==2) break;
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; endif; ?>
            </div>
            <!-- Portfolio -->
            <?php if($portfolio_pagination_enable == 'on') { ?>
                <div class="pagination-holder">
                    <?php echo juster_paging_nav(); ?>
                </div>
            <?php }
        endif; ?>
    </div>
<?php get_footer();
