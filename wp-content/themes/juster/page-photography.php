<?php
/**
Template Name: Grid Gallery
**/

get_header();

$page_model		= get_post_meta( $post->ID, 'page_model', true );
$sidebar_select	= get_post_meta( $post->ID, 'select_custom_sidebar', true );

if ($page_model === 'left_sidebar') {
	if (!$sidebar_select) {
		get_sidebar();
	} else {
		echo '<div class="col-md-4 col-sm-5 padding-left-zero">';
		echo '<div class="sidebar sidebar-left">';
		dynamic_sidebar($sidebar_select);
		echo '</div>';
		echo '</div>';
	}
}

	$layout_model = get_post_meta( $post->ID, 'page_model', true );
	if( $layout_model === 'full_width' ) {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	} elseif( $layout_model === 'extra_width' ) {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	} elseif( class_exists( 'WooCommerce' ) && (is_checkout() || is_cart()) ) {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	} elseif( is_page('wishlist') ) {
		$layout_structure = 'main-content col-lg-9 padding-zero';
	} elseif( $layout_model === 'left_sidebar' || $layout_model === 'right_sidebar' ) {
		$layout_structure = 'main-content col-lg-8 padding-zero';
	} else {
		$layout_structure = 'main-content col-lg-12 padding-zero';
	}
	?>
	<div class="<?php echo esc_attr($layout_structure); ?>">
		<?php while( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content();
				$port_limit = get_post_meta( $post->ID, 'port_limit', true );
				if($port_limit) {
					$port_limit = $port_limit;
				} else {
					$port_limit = '';
				}
				$port_column = get_post_meta( $post->ID, 'port_column', true );
				if($port_column) {
					$port_column = $port_column;
				} else {
					$port_column = 'jt-port-col-4';
				}
				$enable_cat_filter = get_post_meta( $post->ID, 'enable_cat_filter', true );
				if($enable_cat_filter) {
					$enable_cat_filter = $enable_cat_filter;
				} else {
					$enable_cat_filter = '';
				}
				$filter_title = get_post_meta( $post->ID, 'filter_title', true );
				if ($filter_title) {
			      $filter_title = $filter_title;
			    } else {
			      $filter_title = 'Filter';
			    }
			    $filter_text_color = get_post_meta( $post->ID, 'filter_text_color', true );
				if ($filter_text_color) {
			       $filter_text_color = 'color:'. $filter_text_color .';';
			    } else {
			       $filter_text_color ='';
			    }
				$filter_bg = get_post_meta( $post->ID, 'filter_bg', true );
				if ($filter_bg) {
			      $filter_bg = 'background-color:'. $filter_bg .';';
			    } else {
			      $filter_bg = '';
			    }
			    $port_click_effect = get_post_meta( $post->ID, 'port_click_effect', true );
			    if($port_click_effect) {
					$port_click_effect = $port_click_effect;
				} else {
					$port_click_effect = '';
				}
				$port_order = get_post_meta( $post->ID, 'port_order', true );
				if($port_order) {
					$port_order = $port_order;
				} else {
					$port_order = '';
				}
				$port_order_by = get_post_meta( $post->ID, 'port_order_by', true );
				if($port_order_by) {
					$port_order_by = $port_order_by;
				} else {
					$port_order_by = '';
				}
				$offset_port = get_post_meta( $post->ID, 'offset_port', true );
				if($offset_port) {
					$offset_port = $offset_port;
				} else {
					$offset_port = '';
				}
				$show_port_cat = get_post_meta( $post->ID, 'show_port_cat', true );
				if($show_port_cat) {
					$show_port_cat = $show_port_cat;
				} else {
					$show_port_cat = '';
				}
				$port_pageination = get_post_meta( $post->ID, 'port_pageination', true );
				if($port_pageination) {
					$port_pageination = $port_pageination;
				} else {
					$port_pageination = '';
				}

			    $global_model = ot_get_option('fullwidth_boxed');
			    $content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );

		        if ($enable_cat_filter) {
		            if ($show_port_cat){
		                  $pf_item_slugs = str_replace(', ', ',', $show_port_cat);
		                  $pf_item_slugs = rtrim($pf_item_slugs, ',');
		                  $pf_item_slugs =  explode(",", $pf_item_slugs);

		                  foreach ($pf_item_slugs as $pf_item_slug) {
		                    $pf_show_only[] ='.catfilter li a.'. $pf_item_slug;
		                  }
		                  $pf_show_only = implode(', ', $pf_show_only);
		                  echo '<style>.catfilter li a{display:none;} .catfilter li a.all, ' . $pf_show_only . '{display:inline !important;}</style>';
		          }
      			?>
                <div class="jt-photo-filter">
                    <div class="jt-photo-list-wrap" style="<?php echo esc_attr($filter_bg); ?>">
                        <a href="#0" class="jt-filter-tit">
                            <img src="<?php echo IMAGES; ?>/icons/photo-filter.png" alt="">
                            <p class="jt-filter" style="<?php echo esc_attr($filter_text_color); ?>"><?php echo esc_attr($filter_title); ?></p>
                        </a>
                        <ul id="filters" class="jt-photo-filter-list">
			              <li><a data-filter="*" class="filter" href="#0">All</a></li>
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
                    </div>
                </div>
                <!-- Filter -->
                <?php } ?>
				<div id="grid-gallery" class="isotope jt-portfolio-wrapper <?php echo esc_attr($port_column); ?>">
                    <section class="grid-wrap">
                        <ul class="grid">
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
				              'posts_per_page' => (int)$port_limit,
				              'portfolio_category' => $show_port_cat,
				              'offset' => (!(int)$offset_port ? "" : (int)$offset_port),
				              'orderby' => $port_order_by,
				              'order' => $port_order
				            );

				            $wpbp = new WP_Query( $args );

			                  if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
			                    if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
			                        $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
			                        $large_image = $large_image[0];
			                        if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
			                        	if ($port_column == 'jt-port-col-2') {
				                          $portfolio_img = aq_resize( $large_image, '590', '380', true );
				                          if($portfolio_img) {
				                            $portfolio_img=$portfolio_img;
				                          } else {
				                            $portfolio_img= IMAGES .'/dummy/590x380.jpg';
				                          }
				                        } elseif ($port_column == 'jt-port-col-3') {
				                          $portfolio_img = aq_resize( $large_image, '390', '320', true );
				                           if($portfolio_img) {
				                            $portfolio_img = $portfolio_img;
				                          } else {
				                            $portfolio_img = IMAGES .'/dummy/390x320.jpg';
				                          }
				                        } elseif ($port_column == 'jt-port-col-4') {
				                          $portfolio_img = aq_resize( $large_image, '300', '250', true );
				                           if($portfolio_img) {
				                            $portfolio_img=$portfolio_img;
				                          } else {
				                            $portfolio_img= IMAGES .'/dummy/300x250.jpg';
				                          }
				                        }
				                    } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
				                    	if ($port_column == 'jt-port-col-2') {
					                          $portfolio_img = aq_resize( $large_image, '960', '550', true );
					                           if($portfolio_img) {
					                            $portfolio_img=$portfolio_img;
					                          } else {
					                            $portfolio_img= IMAGES .'/dummy/960x550.jpg';
					                          }
					                        } elseif ($port_column == 'jt-port-col-3') {
					                          $portfolio_img = aq_resize( $large_image, '650', '450', true );
					                          if($portfolio_img) {
					                            $portfolio_img=$portfolio_img;
					                          } else {
					                            $portfolio_img= IMAGES .'/dummy/640x450.jpg';
					                          }
					                        } elseif ($port_column == 'jt-port-col-4') {
					                          $portfolio_img = aq_resize( $large_image, '480', '350', true );
					                          if($portfolio_img) {
					                            $portfolio_img=$portfolio_img;
					                          } else {
					                            $portfolio_img= IMAGES .'/dummy/480x350.jpg';
					                          }
					                        }
				                    } else {
				                    	if ($port_column == 'jt-port-col-2') {
					                          $portfolio_img = aq_resize( $large_image, '960', '550', true );
					                           if($portfolio_img) {
					                            $portfolio_img=$portfolio_img;
					                          } else {
					                            $portfolio_img= IMAGES .'/dummy/960x550.jpg';
					                          }
					                        } elseif ($port_column == 'jt-port-col-3') {
					                          $portfolio_img = aq_resize( $large_image, '650', '450', true );
					                          if($portfolio_img) {
					                            $portfolio_img=$portfolio_img;
					                          } else {
					                            $portfolio_img= IMAGES .'/dummy/640x450.jpg';
					                          }
					                        } elseif ($port_column == 'jt-port-col-4') {
					                          $portfolio_img = aq_resize( $large_image, '480', '350', true );
					                          if($portfolio_img) {
					                            $portfolio_img=$portfolio_img;
					                          } else {
					                            $portfolio_img= IMAGES .'/dummy/480x350.jpg';
					                          }
					                        }
				                    }
				                } else {
				                	if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
					                    if ($port_column === 'jt-port-col-2') {
					                      $portfolio_img = IMAGES .'/dummy/590x380.jpg';
					                    } elseif ($port_column === 'jt-port-col-3') {
					                      $portfolio_img = IMAGES .'/dummy/390x320.jpg';
					                    } elseif ($port_column === 'jt-port-col-4') {
					                      $portfolio_img = IMAGES .'/dummy/300x250.jpg';
					                    } else {
					                       $portfolio_img = IMAGES .'/dummy/300x250.jpg';
					                    }
					                } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
					                     if ($port_column === 'jt-port-col-2') {
					                      $portfolio_img = IMAGES .'/dummy/960x550.jpg';
					                    } elseif ($port_column === 'jt-port-col-3') {
					                      $portfolio_img= IMAGES .'/dummy/640x450.jpg';
					                    } elseif ($port_column === 'jt-port-col-4') {
					                      $portfolio_img = IMAGES .'/dummy/480x350.jpg';
					                    } else {
					                      $portfolio_img = IMAGES .'/dummy/480x350.jpg';
					                    }
					                } else {
					                    if ($port_column === 'jt-port-col-2') {
					                      $portfolio_img = IMAGES .'/dummy/960x550.jpg';
					                    } elseif ($port_column === 'jt-port-col-3') {
					                      $portfolio_img= IMAGES .'/dummy/640x450.jpg';
					                    } elseif ($port_column === 'jt-port-col-4') {
					                      $portfolio_img = IMAGES .'/dummy/480x350.jpg';
					                    } else {
					                      $portfolio_img = IMAGES .'/dummy/480x350.jpg';
					                    }
		                           }
				                }

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
			                  ?>
			                   	<li class="jt-able-filter jt-portfolio-item <?php echo esc_attr($cat_class); ?>">
	                               <div class="jt-port-image">
	                               	  <?php if($port_click_effect == 'link_effect') { ?>
	                                  <a href="<?php esc_url(the_permalink()); ?>" class="jt-port-page-link"><img src="<?php echo esc_attr($portfolio_img); ?>" alt="<?php esc_attr(the_title()); ?>"></a>
	                                  <?php } else { ?>
	                                   <img src="<?php echo esc_attr($portfolio_img) ;?>" alt="<?php esc_attr(the_title()); ?>">
	                                  <?php } ?>
	                               </div>
                            	</li>
			                <?php
			                endwhile; endif; ?>
                  	</ul>
                </section><!-- // grid-wrap -->

                <section class="slideshow slide-top-zero">
                  	<ul>
                  	 <?php if($port_click_effect == 'pop_up_effect' || $port_click_effect =='') { ?>
                  	<?php
                  	if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                	  if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                        $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
	                        $large_image = $large_image[0];
			                  ?>
                  			<li>
                                <span><em><?php the_title(); ?></em></span>
                                <img src="<?php echo esc_attr($large_image); ?>"  alt="<?php esc_attr(the_title()); ?>">
                            </li>
                    <?php }
			        endwhile; endif;
			        } ?>
       				</ul>
       				 <!-- Navigation -->
                    <nav>
                        <span class="icon nav-prev"><img src="<?php echo IMAGES ;?>/icons/pop-arrrow-left.png" alt=""></span>
                        <span class="icon nav-close"><img src="<?php echo  IMAGES ;?>/icons/pop-filter.png" alt=""></span>
                        <span class="icon nav-next"><img src="<?php echo IMAGES ;?>/icons/pop-arrrow-right.png" alt=""></span>
                    </nav>
                    <!-- Navigation -->
                </section><!-- // Slideshow -->

            </div><!-- // Grid-gallery -->

					<?php wp_link_pages(); ?>
				</div>
			</article>

			<?php
			$page_comments = ot_get_option('page_comments');
			if($page_comments == 'on') {
				comments_template();
			} else { }
			endwhile; ?>
	</div> <!-- end main-content -->

<?php
if ($page_model === 'right_sidebar') {
	if (!$sidebar_select) {
		get_sidebar();
	} else {
		echo '<div class="col-md-4 col-sm-5 padding-right-zero">';
		echo '<div class="sidebar">';
		dynamic_sidebar($sidebar_select);
		echo '</div>';
		echo '</div>';
	}
}
get_footer();
