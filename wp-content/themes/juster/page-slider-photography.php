<?php
/**
Template Name: Slider Gallery
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
					$enable_cat_filter = get_post_meta( $post->ID, 'enable_cat_filter', true );
					if($enable_cat_filter) {
						$enable_cat_filter = $enable_cat_filter;
					} else {
						$enable_cat_filter = '';
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

					if ($show_port_cat) {
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
					<div class="jt-photo-whole-wrap">
                    <!-- Slide -->
                    <div class="main-container">
                        <div class="flexslider full-screen normal-nav">
                            <ul class="slides">
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
			                  ?>
		                  		<li style="background-image:url(<?php echo esc_attr($large_image); ?>);">
				                  <span><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></span>
				              	</li>
			                <?php }
			                 endwhile; endif; ?>
                            </ul>
				            <div class="nav">
				                <a href="#0" class="prev">
				                    <img src="<?php echo IMAGES; ?>/icons/pop-arrrow-left.png" alt="">
				                </a>
				                <a href="#0" class="next">
				                    <img src="<?php echo IMAGES; ?>/icons/pop-arrrow-right.png" alt="">
				                </a>
				            </div>
	                </div>
	            </div>
	        </div><!-- / Right Wrap -->
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
