<?php
/**
 * content-link.php
 *
 * The default template for displaying posts with the Link post format.
 */
$blog_style_ot = ot_get_option('blog_style_ot');
if(!is_singular() && $blog_style_ot != '') {
    if($blog_style_ot == 'blog_style_ot_1') {
?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        if ( has_post_thumbnail() && ! post_password_required() ) {
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
            $url = $thumb['0'];
            $blog_image = aq_resize( $url, '200', '130', true );
        } else {
            $blog_image = IMAGES.'/dummy/200x130.png';
        }
        ?>
        <div class="jt-blog-lists">
            <div class="jt-thumb-hv">
                <a href="<?php esc_url(the_permalink()); ?>" class="jt-post-thumb">
                    <img src="<?php echo esc_attr($blog_image); ?>" alt="<?php esc_attr(the_title()); ?>">
                </a>
            </div>
            <div class="jt-content-hv">
                <div class="jt-post-contents">
                    <div class="jt-list-cat">
                        <?php echo juster_post_meta_cat(); ?>
                    </div>
                    <a href="<?php esc_url(the_permalink()); ?>" class="jt-post-title">
                        <?php the_title(); ?>
                    </a>
                    <?php echo juster_post_meta(); ?>
                </div>
            </div>
            <div class="jt-read-more-hv">
                <a href="<?php esc_url(the_permalink()); ?>" class="jt-list-read-more">
                    <span><?php echo __('Read More','juster'); ?></span>
                    <span class="arrow-right"><img src="<?php echo IMAGES ?>/arrows/box-arrow-right.png" alt=""></span>
                </a>
            </div>
        </div>
    </div>
<?php } elseif($blog_style_ot == 'blog_style_ot_2') { ?>
    <?php
    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $global_model = ot_get_option('fullwidth_boxed');
    $content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );
    if ( has_post_thumbnail() && ! post_password_required() ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
        $url = $image['0'];
        if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
            $blog_image = aq_resize( $url, '510', '460', true );
            if($blog_image) {
              $blog_image=$blog_image;
            } else {
              $blog_image= IMAGES .'/dummy/510x460.jpg';
            }
        } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
            $blog_image = aq_resize( $url, '640', '450', true );
            if($blog_image) {
              $blog_image = $blog_image;
            } else {
              $blog_image= IMAGES .'/dummy/640x450.jpg';
            }
        } else {
            $blog_image = aq_resize( $url, '640', '450', true );
            if($blog_image) {
              $blog_image = $blog_image;
            } else {
              $blog_image= IMAGES .'/dummy/640x450.jpg';
            }
        }
    } else {
          if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
            $blog_image = IMAGES .'/dummy/510x460.jpg';
           } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
            $blog_image = IMAGES .'/dummy/640x450.jpg';
          } else {
            $blog_image = IMAGES .'/dummy/640x450.jpg';
          }
    }
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('jt-blog-two'); ?>>
        <div class="jt-blog-two-image">
            <img src="<?php echo esc_attr($blog_image); ?>" alt=""/>
        </div>
        <div class="jt-blog-two-content">
            <div class="jt-post-contents">
                <div class="jt-list-cat">
                    <?php echo juster_post_meta_cat(); ?>
                </div>
                <a href="<?php esc_url(the_permalink()); ?>" class="jt-post-title">
                    <?php the_title(); ?>
                </a>
                <?php echo juster_post_meta(); ?>
            </div>
        </div>
    </div>
<?php } elseif($blog_style_ot == 'blog_style_ot_3') {
    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $global_model = ot_get_option('fullwidth_boxed');
    if ( has_post_thumbnail() && ! post_password_required() ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
        $large_img = $image['0'];
        $blog_img = aq_resize( $large_img, '630', '460', true );
        if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
            $blog_img = aq_resize( $large_img, '370', '260', true );
            if($blog_img) {
                $blog_img = $blog_img;
            } else {
                $blog_img = IMAGES.'/dummy/370x260.jpg';
            }
        } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
            $blog_img = aq_resize( $large_img, '640', '450', true );
            if($blog_img) {
                $blog_img = $blog_img;
            } else {
                $blog_img = IMAGES.'/dummy/640x450.jpg';
            }
        } else {
            $blog_img = aq_resize( $large_img, '640', '450', true );
            if($blog_img) {
                $blog_img = $blog_img;
            } else {
                $blog_img = IMAGES.'/dummy/640x450.jpg';
            }
        }
    } else {
        if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
            $blog_img = IMAGES.'/dummy/370x260.jpg';
        } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
            $blog_img = IMAGES.'/dummy/640x450.jpg';
        } else {
            $blog_img = IMAGES.'/dummy/640x450.jpg';
        }
    }
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('jt-blog-slide jt-style-three-blog jt-normal-view'); ?>>
        <img src="<?php echo esc_attr($blog_img); ?>" alt="<?php esc_attr(the_title()); ?>">
        <div class="jt-slide-cont">
            <div class="jt-post-cat">
                <?php echo juster_post_meta_cat(); ?>
            </div>
            <a href="<?php esc_url(the_permalink()); ?>" class="jt-sub-tit">
                <?php the_title(); ?>
            </a>
        </div>
    </div>
    </div>
<?php } elseif($blog_style_ot == 'blog_style_ot_4') { ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('jt-each-post'); ?>>
        <div class="jt-post-content">
            <div class="jt-format-link-icon">
                <i class="pe-7s-link"></i>
            </div>
            <h3 class="jt-post-title"><?php the_title(); ?></h3>
            <div class="jt-format-link">
                <?php
                $link_cont = get_post_meta( $post->ID, 'link_content', true );
                if($link_cont) { ?>
                    <a href="<?php echo esc_url($link_cont); ?>" target="_blank">
                        <?php echo esc_attr($link_cont); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php if(is_single()) { ?>
        <div class="jt-post-bottom-metas">
            <?php
            $blog_share_option = ot_get_option('blog_share_option');
            if($blog_share_option == 'on') {
            ?>
            <div class="jt-social-share">
                <a href=".modal-dialog" class="jt-share-link">
                    <i class="pe-7s-share"></i>
                    <span><?php echo __('Share Post', 'juster'); ?></span>
                </a>
                <div class="modal-dialog modal-sm mfp-hide">
                    <div class="blog-share-popup">
                        <div class="col-sm-12">
                            <div class="jt-share-popup-cnt">
                                <i class="pe-7s-share"></i>
                                <p><?php echo __('Share this blog with everyone', 'juster'); ?></p>
                                <?php
                                    $page_url = get_permalink($post->ID );
                                    $title = $post->post_title;
                                ?>
                                <ul>
                                    <li>
                                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="icon-fa-facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="http://twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="icon-fa-twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" class="icon-fa-linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/share?url=<?php print(urlencode($page_url)); ?>" class="icon-fa-google-plus" target="_blank"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            $tag_list = get_the_tags();
            if($tag_list) {
                echo '<div class="jt-post-tags">';
                echo the_tags( '<span>', '', '</span>' );
                echo '</div>';
            }
            ?>
        </div>
        <?php
            echo juster_author_info();
        } ?>
    </article>
<?php } elseif($blog_style_ot == 'blog_style_ot_5') { ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-main-wrap blog-width'); ?>>
  <?php
      if ( has_post_thumbnail() && ! post_password_required() ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
        $blog_image = $thumb['0'];
      } else {
        $blog_image = IMAGES.'/dummy/blog.png';
      }
      ?>
      <div class="blog-img">
          <img src="<?php echo esc_attr($blog_image); ?>"  alt="<?php esc_attr(the_title()); ?>">
      </div>
      <div class="blog-content">
          <div class="jt-post-cat">
            <?php echo juster_post_meta_cat(); ?>
          </div>
          <a href="<?php esc_url(the_permalink()); ?>"><h2><?php the_title(); ?></h2></a>
          <?php the_excerpt(); ?>
          <a href="<?php esc_url(the_permalink()); ?>" class="blog-read-txt"><?php echo __('Read More', 'juster'); ?></a>
      </div>

</div>
<?php } elseif($blog_style_ot == 'blog_style_ot_6') {
    $page_model = get_post_meta( $post->ID, 'page_model', true );
    $vintage_blog_columns = ot_get_option('blog_style_ot_6_style');
    if ( has_post_thumbnail() && ! post_password_required() ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
        $url = $thumb['0'];
        if($page_model =='full_width') {
                if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                  $blog_image = aq_resize( $url, '590', '380', true );
                  if($blog_image) {
                    $blog_image=$blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/590x380.jpg';
                  }
                } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                  $blog_image = aq_resize( $url, '390', '320', true );
                   if($blog_image) {
                    $blog_image = $blog_image;
                  } else {
                    $blog_image = IMAGES .'/dummy/390x320.jpg';
                  }
                } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                  $blog_image = aq_resize( $url, '290', '250', true );
                   if($blog_image) {
                    $blog_image=$blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/290x250.jpg';
                  }
                } else {
                  $blog_image = aq_resize( $url, '390', '320', true );
                   if($blog_image) {
                    $blog_image = $blog_image;
                  } else {
                    $blog_image = IMAGES .'/dummy/390x320.jpg';
                  }
                }
    } elseif($page_model == 'extra_width') {
                if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                  $blog_image = aq_resize( $url, '960', '550', true );
                   if($blog_image) {
                    $blog_image=$blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/960x550.jpg';
                  }
                } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                  $blog_image = aq_resize( $url, '640', '450', true );
                  if($blog_image) {
                    $blog_image = $blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/640x450.jpg';
                  }
                } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                  $blog_image = aq_resize( $url, '480', '350', true );
                  if($blog_image) {
                    $blog_image=$blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/480x350.jpg';
                  }
                } else {
                  $blog_image = aq_resize( $url, '640', '450', true );
                  if($blog_image) {
                    $blog_image = $blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/640x450.jpg';
                  }
                }
      } else {
                if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                  $blog_image = aq_resize( $url, '960', '550', true );
                   if($blog_image) {
                    $blog_image=$blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/960x550.jpg';
                  }
                } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                  $blog_image = aq_resize( $url, '640', '450', true );
                  if($blog_image) {
                    $blog_image = $blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/640x450.jpg';
                  }
                } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                  $blog_image = aq_resize( $url, '480', '350', true );
                  if($blog_image) {
                    $blog_image=$blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/480x350.jpg';
                  }
                } else {
                  $blog_image = aq_resize( $url, '640', '450', true );
                  if($blog_image) {
                    $blog_image = $blog_image;
                  } else {
                    $blog_image= IMAGES .'/dummy/640x450.jpg';
                  }
                }
    }
    } else {
        if($page_model == 'full_width') {
            if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
              $blog_image = IMAGES .'/dummy/590x380.jpg';
            } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
              $blog_image = IMAGES .'/dummy/390x320.jpg';
            } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
              $blog_image = IMAGES .'/dummy/290x250.jpg';
            } else {
              $blog_image = IMAGES .'/dummy/390x320.jpg';
            }
        } elseif ($page_model == 'extra_width') {
            if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
              $blog_image = IMAGES .'/dummy/960x550.jpg';
            } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
              $blog_image = IMAGES .'/dummy/640x450.jpg';
            } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
              $blog_image = IMAGES .'/dummy/480x350.jpg';
            } else {
              $blog_image = IMAGES .'/dummy/640x450.jpg';
            }
        } else {
            if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
              $blog_image = IMAGES .'/dummy/960x550.jpg';
            } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
              $blog_image = IMAGES .'/dummy/640x450.jpg';
            } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
              $blog_image = IMAGES .'/dummy/480x350.jpg';
            } else {
              $blog_image = IMAGES .'/dummy/640x450.jpg';
            }
        }
    }
?>
    <div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($vintage_blog_columns); ?>">
        <div class="jt-vint-blog">
            <img src="<?php echo esc_attr($blog_image); ?>"  alt="<?php esc_attr(the_title()); ?>">
            <a href="<?php esc_url(the_permalink()); ?>"><h3><?php the_title(); ?></h3></a>
            <div class="jt-post-list-metas">
                <?php echo juster_post_meta(); ?>
            </div>
            <div class="jt-post-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <a href="<?php esc_url(the_permalink()); ?>" class="jt-vint-read"><?php echo __('Read More', 'juster'); ?></a>
        </div>
    </div>
<?php } elseif($blog_style_ot == 'blog_style_ot_7') {
    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $global_model = ot_get_option('fullwidth_boxed');
    if ( has_post_thumbnail() && ! post_password_required() ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
        $large_img = $image['0'];
        $blog_img = aq_resize( $large_img, '630', '460', true );
        if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
            $blog_img = aq_resize( $large_img, '340', '250', true );
            if($blog_img) {
                $blog_img = $blog_img;
            } else {
                $blog_img = IMAGES.'/dummy/340x250.jpg';
            }
        } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
            $blog_img = aq_resize( $large_img, '630', '460', true );
            if($blog_img) {
                $blog_img=$blog_img;
            } else {
                $blog_img = IMAGES.'/dummy/630x460.jpg';
            }
        } else {
            $blog_img = aq_resize( $large_img, '630', '460', true );
            if($blog_img) {
                $blog_img=$blog_img;
            } else {
                $blog_img = IMAGES.'/dummy/630x460.jpg';
            }
        }
    } else {
        if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
            $blog_img = IMAGES.'/dummy/340x250.jpg';
        } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
            $blog_img = IMAGES.'/dummy/630x460.jpg';
        } else {
            $blog_img = IMAGES.'/dummy/630x460.jpg';
        }
    }
?>
    <div id="post-<?php the_ID(); ?>" class="jt-vint-blog jt-box-blog col-sm-4">
        <img src="<?php echo esc_attr($blog_img); ?>" alt="<?php esc_attr(the_title()); ?>">
        <div class="jt-box-post-meta">
            <span><?php echo get_the_date(); ?></span>
            <a href="#0"><?php echo get_the_category_list( ', ' );?></a>
        </div>
        <a href="<?php esc_url(the_permalink()); ?>"><h3><?php the_title(); ?></h3></a>
        <?php the_excerpt(); ?>
        <a href="<?php esc_url(the_permalink()); ?>" class="jt-vint-read">
            <?php echo __('Read More', 'juster'); ?>
        </a>
    </div>
<?php } // style-7
} else { // else condition
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('jt-each-post'); ?>>
      <div class="single-link-content">
        <div class="jt-post-content">
            <div class="jt-format-link-icon">
                <i class="pe-7s-link"></i>
            </div>
            <h3 class="jt-post-title"><?php the_title(); ?></h3>
            <div class="jt-format-link">
                <?php
                $link_cont = get_post_meta( $post->ID, 'link_content', true );
                if($link_cont) { ?>
                    <a href="<?php echo esc_url($link_cont); ?>" target="_blank">
                        <?php echo esc_attr($link_cont); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
      </div>
        <?php if(is_single()) { ?>
        <div class="jt-post-bottom-metas">
            <?php
            $blog_share_option = ot_get_option('blog_share_option');
            if($blog_share_option == 'on') {
            ?>
            <div class="jt-social-share">
                <a href=".modal-dialog" class="jt-share-link">
                    <i class="pe-7s-share"></i>
                    <span><?php echo __('Share Post', 'juster'); ?></span>
                </a>
                <div class="modal-dialog modal-sm mfp-hide">
                    <div class="blog-share-popup">
                        <div class="col-sm-12">
                            <div class="jt-share-popup-cnt">
                                <i class="pe-7s-share"></i>
                                <p><?php echo __('Share this blog with everyone', 'juster'); ?></p>
                                <?php
                                    $page_url = get_permalink($post->ID );
                                    $title = $post->post_title;
                                ?>
                                <ul>
                                    <li>
                                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="icon-fa-facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="http://twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="icon-fa-twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php print(urlencode($page_url)); ?>&amp;title=<?php print(urlencode($title)); ?>" class="icon-fa-linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/share?url=<?php print(urlencode($page_url)); ?>" class="icon-fa-google-plus" target="_blank"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            $tag_list = get_the_tags();
            if($tag_list) {
                echo '<div class="jt-post-tags">';
                echo the_tags( '<span>', '', '</span>' );
                echo '</div>';
            }
            ?>
        </div>
        <?php
            echo juster_author_info();
        } ?>
    </article>
<?php }
