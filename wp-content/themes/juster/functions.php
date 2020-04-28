<?php
/**
 * functions.php
 *
 * The theme's functions and definitions.
 */

/**
 * ----------------------------------------------------------------------------------------
 * 1.0 - Define constants.
 * ----------------------------------------------------------------------------------------
 */
define( 'THEMEROOT', get_template_directory_uri() );
define( 'IMAGES', THEMEROOT . '/images' );
define( 'SCRIPTS', THEMEROOT . '/js' );
define( 'FRAMEWORK', get_template_directory() . '/framework' );
define( 'WOO_SHOP', THEMEROOT . '/woocommerce');

/**
 * ----------------------------------------------------------------------------------------
 * 2.0 - Load the framework.
 * ----------------------------------------------------------------------------------------
 */
require_once( FRAMEWORK . '/init.php' );
require_once( FRAMEWORK . '/plugins/import/init.php' );

/* WooCommerce */
include_once(FRAMEWORK . '/plugins/woocommerce/index.php');
include_once(FRAMEWORK . '/plugins/woocommerce/custom-fields.php');

if ( ! function_exists( 'juster_my_admin_theme_style' ) ) {
	function juster_my_admin_theme_style() {
	  wp_enqueue_style('my-admin-theme', THEMEROOT . '/css/admin-styles.css', __FILE__);
	}
	add_action('admin_enqueue_scripts', 'juster_my_admin_theme_style');
}

// OptionTree Extend
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * This will change the default text of Send to OptionTree.
 */
if ( ! function_exists( 'juster_option_tree_upload_text' ) ) {
	function juster_option_tree_upload_text() {
		return __( 'Set Image', 'juster' );
	}
	add_filter( 'ot_upload_text', 'juster_option_tree_upload_text' );
}

// Theme Option WordPress Logo.
if ( ! function_exists( 'juster_head_logo' ) ) {
	function juster_head_logo() {
		return '<div class="dashicons dashicons-wordpress" style="font-size:22px; padding:4px 8px 0px 8px"></div>';
	}
	add_filter( 'ot_header_logo_link', 'juster_head_logo', 10, 2 );
}

// Theme Option - Brand and Version Number
if ( ! function_exists( 'juster_version' ) ) {
	function juster_version() {
		$jt_template = wp_get_theme()->get( 'Template' );
		$jt_version = wp_get_theme($jt_template);
		return 'Juster - v'. $jt_version->get( 'Version' );
	}
	add_filter( 'ot_header_version_text', 'juster_version', 10, 2 );
}

/* Redirect to "One Click Import" after activation */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	wp_redirect( admin_url( 'themes.php?page=one-click-install' ) );
}

/* Helper Menu in Nav Menus, Back-End. */
if ( ! function_exists( 'jt_mega_menu_helper' ) ) {
	function jt_mega_menu_helper( $contextual_help, $screen_id, $screen ) {

	    if ( 'nav-menus' == $screen->id ) {

	        $screen->add_help_tab( array(
	            'id'	=> 'jt_mega_menu',
	            'title' => __('Mega Menu', 'juster'),
	            'content' => '<p><strong>Juster Mega Menu</strong> have some tricks of using following classes : </p><ol><li><strong>megamenu</strong> : This is a core class. You must add this class in main parent of that mega menu.</li><li><strong>menu-column-two, menu-column-three, menu-column-four</strong> : Mega menu have 2 to 4 columns. You need to mention this column classes in same class field.</li><li><strong>mega-left-align, mega-right-align</strong> : By default mega menu loads center of header. But for your comfortable you can access that alignment using these classes.</li><li><strong>mega-menu-extend</strong> : Use this class, if you want to extend mega menu. It\'ll work based on your columns.</li><li><strong>menu-hide-title</strong> : This class will hide mega menu each section title.</li></ol><h3>My class field is not showing, how to enable that?</h3><img class="helper-img-border" src="'. IMAGES .'/framework/mega-menu-class-enable.jpg" alt="Menu Classes" /><h3>How to use these classes?</h3><img class="helper-img-border" src="'. IMAGES .'/framework/mega-menu-added.jpg" alt="Menu Added" /><br /><p><strong>NOTE : Mega Menu Will Not Comfortable for Agency, Portfolio (Left and Right), Photography (Left and Right) Headers.</strong></p>',
	        ));

	    }
	}
	add_action( 'contextual_help', 'jt_mega_menu_helper', 10, 3 );
}

/* Extend wp_title */
if ( ! function_exists( 'juster_wp_title' ) ) {
	function juster_wp_title( $title, $sep ) {
	 global $paged, $page;

	 if ( is_feed() )
	  return $title;

	 // Add the site name.
	 $site_name = get_bloginfo( 'name' );

	 // Add the site description for the home/front page.
	 $site_description = get_bloginfo( 'description', 'display' );
	 if ( $site_description && ( is_front_page() ) )
	  $title = "$site_name $sep $site_description";

	 // Add a page number if necessary.
	 if ( $paged >= 2 || $page >= 2 )
	  $title = "$site_name $sep" . sprintf( __( ' Page %s', 'juster' ), max( $paged, $page ) );

	 return $title;
	}
	add_filter( 'wp_title', 'juster_wp_title', 10, 2 );
}

/**
 * ----------------------------------------------------------------------------------------
 * 3.0 - Set up the content width value based on the theme's design.
 * ----------------------------------------------------------------------------------------
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * ----------------------------------------------------------------------------------------
 * 4.0 - Set up theme default and register various supported features.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'juster_setup' ) ) {
	function juster_setup() {
		/**
		 * Make the theme available for translation.
		 */
		load_theme_textdomain( 'juster', get_template_directory() . '/languages' );

    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";

    if ( is_readable( $locale_file ) ) {
        require_once( $locale_file );
    }

		/**
		 * Add support for post formats.
		 */
		add_theme_support( 'post-formats',
			array(
				'image',
				'gallery',
				'link',
				'quote',
				'audio',
				'video'
			)
		);

		/**
		 * Add support for automatic feed links.
		 */
		add_theme_support( 'automatic-feed-links' );

		/* HTML5 */
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );

		/**
		 * Add support for post thumbnails.
		 */
		add_theme_support( 'post-thumbnails' );

		/* Footer Widgets Shortcode */
		add_filter('widget_text', 'do_shortcode');
		add_filter('the_excerpt', 'do_shortcode');

		/**
		 * Add support for Breadcrumb Trail.
		 */
		add_theme_support( 'breadcrumb-trail' );

		/**
		 * Add support for Title Tag.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'juster' )
			)
		);
	}

	add_action( 'after_setup_theme', 'juster_setup' );
}

/**
 * ----------------------------------------------------------------------------------------
 * 5.0 - Display meta information for a specific post.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'juster_post_meta_cat' ) ) {
	function juster_post_meta_cat() {
		if ( get_post_type() === 'post' ) {
			$hide_meta = ot_get_option('hide_meta');
			if(!isset($hide_meta[2])) {
				$category_list = get_the_category_list( ' ' );
				if ( $category_list ) {
					echo $category_list;
				}
			}
		}
	}
}
if ( ! function_exists( 'juster_post_meta' ) ) {
	function juster_post_meta() {
		echo '<ul class="jt-post-list-metas">';
		if ( get_post_type() === 'post' ) {
			// If the post is sticky, mark it.
			if ( is_sticky() ) {
				echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i> ' . __( 'Sticky', 'juster' ) . ' </li>';
			}
			$hide_meta = ot_get_option('hide_meta');
			if(!isset($hide_meta[1])) {
				echo '<li><img src="'. IMAGES .'/icons/clock.png" height="16" width="16" alt="">'. get_the_date() .'</li>';
			}
			if(!isset($hide_meta[3])) {
				if ( comments_open() ) {
					echo ' <li><img src="'. IMAGES .'/icons/comments.png" alt="">';
					comments_popup_link( __( 'Leave a comment', 'juster' ), __( 'One comment so far', 'juster' ), __( '% comments', 'juster' ) );
					echo '</li>';
				}
			}
			if(!isset($hide_meta[0])) {
				printf(
					'<li><img src="'. IMAGES .'/icons/user.png" alt="">
					'. __('By','juster') .'
						<a href="%1$s" rel="author">%2$s</a>
					</li>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			}
			echo '</ul>';
		}
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * 6.0 - Display Blog Navigation / Blog Pagination
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'juster_paging_nav' ) ) {
	function juster_paging_nav() {
		$blog_pagination_type = ot_get_option('blog_pagination_type');
		if($blog_pagination_type == 'numbers') {
			global $wp_query;
			$big = 999999999;
			if($wp_query->max_num_pages == '1' ) {
			} else {
				echo "";
			}
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'prev_text' => __( 'OLDER POSTS', 'juster' ),
	    		'next_text' => __( 'NEWER POSTS', 'juster' ),
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'type' => 'list'
			));
			if($wp_query->max_num_pages == '1' ) {
			} else {
				echo "";
			}
		} else { ?>
			<div class="page-next-prev">
				<ul class="hey-there">
					<?php
						if ( get_previous_posts_link() ) { ?>
						<li class="next">
							<?php previous_posts_link( __( 'NEWER POSTS', 'juster' ) ); ?>
						</li>
						<?php }
						if ( get_next_posts_link() ) { ?>
						<li class="previous">
							<?php next_posts_link( __( 'OLDER POSTS', 'juster' ) ); ?>
						</li>
						<?php }
					?>
				</ul>
			</div>
		<?php
	    }
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - Register the widget areas.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'juster_widget_init' ) ) {
	function juster_widget_init() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name' => __( 'Main Widget Area', 'juster' ),
					'id' => 'sidebar-1',
					'description' => __( 'Appears on posts and pages.', 'juster' ),
					'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3><div class="jt-sep-two"></div>',
				)
			);
			$lang_enable 		= ot_get_option('lang_enable');
			$menu_position 		= ot_get_option('menu_position');
			if( $lang_enable == 'on' ) {
				if($menu_position != 'menu_pos_top_shop') {
					register_sidebar(
						array(
							'name' => __( 'Language Widget', 'juster' ),
							'id' => 'lang_widget',
							'description' => __( 'Appears on the header menu.', 'juster' ),
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget' => '</div> <!-- end widget -->',
							'before_title' => '<h3 class="widget-title">',
							'after_title' => '</h3>',
						)
					);
				}
			}
			$footer_widget 		= ot_get_option('footer_widget');
			$footer_widget_cols	= ot_get_option('footer_widget_cols');
			if( $footer_widget == 'on' && ($footer_widget_cols == 'footer_widget_one' || $footer_widget_cols == 'footer_widget_two' || $footer_widget_cols == 'footer_widget_three' || $footer_widget_cols == 'footer_widget_four' ) ) {
				register_sidebar(
					array(
						'name' => __( 'Footer One', 'juster' ),
						'id' => 'footer-1',
						'description' => __( 'Appears on the footer.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>',
					)
				);
			}
			if( $footer_widget == 'on' && ($footer_widget_cols == 'footer_widget_two' || $footer_widget_cols == 'footer_widget_three' || $footer_widget_cols == 'footer_widget_four') ) {
				register_sidebar(
					array(
						'name' => __( 'Footer Two', 'juster' ),
						'id' => 'footer-2',
						'description' => __( 'Appears on the footer.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget  %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>',
					)
				);
			}
			if( $footer_widget == 'on' && ($footer_widget_cols == 'footer_widget_three' || $footer_widget_cols == 'footer_widget_four') ) {
				register_sidebar(
					array(
						'name' => __( 'Footer Three', 'juster' ),
						'id' => 'footer-3',
						'description' => __( 'Appears on the footer.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>',
					)
				);
			}
			if( $footer_widget == 'on' && $footer_widget_cols == 'footer_widget_four' ) {
				register_sidebar(
					array(
						'name' => __( 'Footer Four', 'juster' ),
						'id' => 'footer-4',
						'description' => __( 'Appears on the footer.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>',
					)
				);
			}
			if ( class_exists( 'Woocommerce' ) ) {
				register_sidebar(
					array(
						'name' => __( 'Shop Widget', 'juster' ),
						'id' => 'shop-widget',
						'description' => __( 'Appears on shop page.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$menu_pos_left = ot_get_option('menu_position');
			if($menu_pos_left == 'menu_pos_left') {
				register_sidebar(
					array(
						'name' => __( 'Portfolio Left Menu | Widget', 'juster' ),
						'id' => 'leftside-menu',
						'description' => __( 'Appears on portfolio left menu', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$menu_pos_right = ot_get_option('menu_position');
			if($menu_pos_right == 'menu_pos_right') {
				register_sidebar(
					array(
						'name' => __( 'Portfolio Right Menu | Widget', 'juster' ),
						'id' => 'rightside-menu',
						'description' => __( 'Appears on portfolio right menu', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$top_menu_social = ot_get_option('menu_position');
			if($top_menu_social == 'header_logo_with_banner') {
				register_sidebar(
					array(
						'name' => __( 'Blog Header | Social Widget', 'juster' ),
						'id' => 'top_menu_social_widget',
						'description' => __( 'Appears on blog header top | Social widgets.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$top_menu_social = ot_get_option('menu_position');
			if($top_menu_social == 'menu_pos_left_margin') {
				register_sidebar(
					array(
						'name' => __( 'Photography Header | Left Menu Widget', 'juster' ),
						'id' => 'menu_pos_left_margin_wid',
						'description' => __( 'Appears on photography header left side.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$top_menu_social_right_margin = ot_get_option('menu_position');
			if($top_menu_social_right_margin == 'menu_pos_right_margin') {
				register_sidebar(
					array(
						'name' => __( 'Photography Header | Right Menu Widget', 'juster' ),
						'id' => 'menu_pos_right_margin_wid',
						'description' => __( 'Appears on photography header right side.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$header_with_topbar = ot_get_option('menu_position');
			if($header_with_topbar == 'header_with_topbar') {
				register_sidebar(
					array(
						'name' => __( 'Business Header Top | Left Widget', 'juster' ),
						'id' => 'topleft-widget',
						'description' => __( 'Appears on business header top | left side.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Business Header Top | Right Widget', 'juster' ),
						'id' => 'topright-widget',
						'description' => __( 'Appears on business header top | right side', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$header_top_arch = ot_get_option('menu_position');
			if($header_top_arch == 'menu_pos_top_arch') {
				register_sidebar(
					array(
						'name' => __( 'Header | Top Widget', 'juster' ),
						'id' => 'menu_pos_top_arch_top_widget',
						'description' => __( 'Appears on architecture header top widget.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Footer | Left Widget', 'juster' ),
						'id' => 'arch-footer-left-widget',
						'description' => __( 'Appears on architecture header | footer | left side.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Footer | Right Widget', 'juster' ),
						'id' => 'arch-footer-right-widget',
						'description' => __( 'Appears on architecture header | footer | right side', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$footer_copyright_type = ot_get_option('footer_copyright_type');
			if($footer_copyright_type == 'footer_copy_two' || $footer_copyright_type == 'footer_copy_three') {
				register_sidebar(
					array(
						'name' => __( 'Footer Copyright Bar | Widget', 'juster' ),
						'id' => 'footer-copy-style-wid',
						'description' => __( 'Appears on footer copyright bar.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$vintage_left_menu = ot_get_option('menu_position');
			if($vintage_left_menu == 'menu_pos_left_vintage') {
				register_sidebar(
					array(
						'name' => __( 'Vintage Header Left Menu | Widget', 'juster' ),
						'id' => 'menu_pos_left_vintage_wid',
						'description' => __( 'Appears on vintage header left menu bottom.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$vintage_right_menu = ot_get_option('menu_position');
			if($vintage_right_menu == 'menu_pos_right_vintage') {
				register_sidebar(
					array(
						'name' => __( 'Vintage Header Right Menu | Widget', 'juster' ),
						'id' => 'menu_pos_right_vintage_wid',
						'description' => __( 'Appears on vintage header right menu bottom.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$menu_pos_top_boxed = ot_get_option('menu_position');
			if($menu_pos_top_boxed == 'menu_pos_top_boxed') {
				register_sidebar(
					array(
						'name' => __( 'Boxed Layout Header | Widget', 'juster' ),
						'id' => 'menu_pos_top_boxed',
						'description' => __( 'Appears on boxed layout header | right side.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			$menu_pos_top_shop = ot_get_option('menu_position');
			if($menu_pos_top_shop == 'menu_pos_top_shop') {
				register_sidebar(
					array(
						'name' => __( 'Shop Header | Left Widget', 'juster' ),
						'id' => 'topleft-widget-shop',
						'description' => __( 'Appears on shop header top | left side.', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Shop Header | Right Widget', 'juster' ),
						'id' => 'topright-widget-shop',
						'description' => __( 'Appears on shop header top | right side', 'juster' ),
						'before_widget' => '<div id="%1$s" class="widget sep-hover-control %2$s">',
						'after_widget' => '</div> <!-- end widget -->',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3><div class="jt-sep-two"></div>',
					)
				);
			}
			/* Custom Sidebar */
			$custom_sidebars = ot_get_option('custom_sidebars');
			if ($custom_sidebars) {
				foreach($custom_sidebars as $custom_sidebar) :
				$heading = $custom_sidebar['title'];
				$own_id = preg_replace('/[^a-z]/', "-", strtolower($heading));
				$need_sep_widget = $custom_sidebar['need_sep_widget'];
				if ($need_sep_widget == 'on') {
					$need_sep_widget_div = '<div class="jt-sep-two"></div>';
					$need_sep_widget_class = 'sep-hover-control';
				} else {
					$need_sep_widget_div = '';
					$need_sep_widget_class = '';
				}

				register_sidebar( array(
					'name' => esc_attr($heading),
					'id' => $own_id,
					'description' => esc_attr($custom_sidebar['custom_description']),
					'before_widget' => '<div id="%1$s" class="widget '. $need_sep_widget_class .' %2$s">',
					'after_widget' => '</div> <!-- end widget -->',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>' . $need_sep_widget_div,
				) );
				endforeach;
			}
			/* Custom Sidebar */
		}
	}

	add_action( 'widgets_init', 'juster_widget_init' );
}

/**
 * ----------------------------------------------------------------------------------------
 * 8.0 - Function that validates a field's length.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'juster_validate_length' ) ) {
	function juster_validate_length( $fieldValue, $minLength ) {
		// First, remove trailing and leading whitespace
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}

/* Meta Box OnSelect - Plugin */
if ( ! function_exists( 'juster_metabox_select_js' ) ) {
	function juster_metabox_select_js() {
    wp_enqueue_script('metabox-select', THEMEROOT . '/framework/plugins/metabox-on-select.js', __FILE__);
	}
	add_action('admin_enqueue_scripts', 'juster_metabox_select_js');
}

/* ==============================================
   Custom Comment Area Modification
=============================================== */
if ( ! function_exists( 'juster_comment_modification' ) ) {
	function juster_comment_modification($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		$comment_class = empty( $args['has_children'] ) ? '' : 'parent';
	?>

	<<?php echo esc_attr($tag); ?> <?php comment_class('item ' . $comment_class .' ' ); ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="">
		<?php endif; ?>
		<div class="comment-theme">
		    <div class="comment-image">
		    	<?php if ( $args['avatar_size'] != 0 ) {
		    		echo get_avatar( $comment, 112 );
		    	} ?>
		    </div>
		</div>
		<div class="comment-main-area">
			<div class="jt-comments-meta">
				<h4><?php printf( '%s', get_comment_author() ); ?></h4>
				<div class="comments-meta">
				    <span class="comments-date">
				    	<?php echo get_comment_date('d M Y'); echo ' - '; ?>
				    	<span class="caps"><?php echo get_comment_time(); ?></span>
				    </span>
				</div>
				<div class="comments-reply">
				<?php
					comment_reply_link( array_merge( $args, array(
					'reply_text' => '<span class="comment-reply-link">'. __('Reply','juster') .'</span>',
					'before' => '',
					'class'  => '',
					'depth' => $depth,
					'max_depth' => $args['max_depth']
					) ) );
				?>
				</div>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php echo __( 'Your comment is awaiting moderation.', 'juster' ); ?></em>
			<?php endif; ?>
			<div class="comment-area">
				<?php comment_text(); ?>
			</div>
		</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif;
	}
}

/*================================================================
	Comment Validation
=================================================================*/
if ( ! function_exists( 'juster_comment_validation_init' ) ) {
	function juster_comment_validation_init() {
		$page_comments = ot_get_option('page_comments');
		if(is_single() || $page_comments == 'on') {
	?>
		<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#commentform').validate({
					rules: {
					  author: {
					    required: true,
					    minlength: 2
					  },
					  email: {
					    required: true,
					    email: true
					  },
					  comment: {
					    required: true,
					    minlength: 20
					  }
					},
					messages: {
					  author: "<?php echo __('Please fill the required field.', 'juster'); ?>",
					  email: "<?php echo __('Please enter a valid email address.', 'juster'); ?>",
					  comment: "<?php echo __('Please fill the required field.', 'juster'); ?>"
					},
					errorElement: "div",
					errorPlacement: function(error, element) {
					  element.after(error);
					}
				});
			});
		</script>
	<?php
		}
	}
	add_action('wp_footer', 'juster_comment_validation_init');
}

/*=================================================================
	Single Blog Page Next / Previous Posts
==================================================================*/
if ( ! function_exists( 'juster_single_next_prev_posts' ) ) {
	function juster_single_next_prev_posts() {
		if ( is_single() ) { ?>
			<div class="jt-nxt-pre-posts">
				<?php $prevpage = get_previous_post();
				if($prevpage) {
					$prevpageid=$prevpage->ID;
					$prev_post_url = get_permalink($prevpageid);
					if( class_exists( 'WooCommerce') && is_product() ) { ?>
						<a href="<?php echo esc_url($prev_post_url); ?>" class="jt-prev-post"><?php echo __('Prev Product', 'juster'); ?></a>
					<?php
					} else { ?>
						<a href="<?php echo esc_url($prev_post_url); ?>" class="jt-prev-post"><?php echo __('Prev Post', 'juster'); ?></a>
					<?php
					}
				}
				$nextpage = get_next_post();
				if($nextpage) {
					$nextpageid=$nextpage->ID;
					$next_post_url = get_permalink($nextpageid);
					if( class_exists( 'WooCommerce') && is_product() ) { ?>
						<a href="<?php echo esc_url($next_post_url); ?>" class="jt-next-post"><?php echo __('Next Product', 'juster'); ?></a>
					<?php
					} else { ?>
						<a href="<?php echo esc_url($next_post_url); ?>" class="jt-next-post"><?php echo __('Next Post', 'juster'); ?></a>
					<?php
					}
				} ?>
			</div>
			<?php
		}
	}
}

/*=================================================================
	Single Portfolio Page Next / Previous Posts
==================================================================*/
if ( ! function_exists( 'juster_portfolio_anim_pagination' ) ) {
	function juster_portfolio_anim_pagination() {
		if ( is_single() ) {
			?>
			<div class="jt-single-port-pagination">
	            <div class="col-sm-4 col-xs-4">
				<?php $prevpage = get_previous_post();
				if($prevpage) {
					$prevpageid=$prevpage->ID;
					$prev_post_url = get_permalink($prevpageid);
				?>
                    <div class="jt-single-nav jt-single-nav-left">
                        <a href="<?php echo esc_url($prev_post_url); ?>">
                            <span><?php echo __('Prev', 'juster'); ?></span>
                       </a>
                    </div>
				<?php } ?>
	            </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="jt-single-nav-img">
                    	<?php
                    	$portfolio_loading_link =  ot_get_option('portfolio_loading_link');
                    	if($portfolio_loading_link) {
                    	?>
	                        <a href="<?php echo esc_url($portfolio_loading_link); ?>" class="cell">
		                        <span class="dots-loader"><?php echo __('Loading', 'juster'); ?><span class="dot-no">…</span></span>
	                    	</a>
                    	<?php } ?>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4">
                	<?php $nextpage = get_next_post();
                	if($nextpage) {
                		$nextpageid=$nextpage->ID;
                		$next_post_url = get_permalink($nextpageid);
                	?>
	                    <div class="jt-single-nav jt-single-nav-right">
	                        <a href="<?php echo esc_url($next_post_url); ?>">
	                            <span><?php echo __('Next', 'juster'); ?></span>
	                       </a>
	                    </div>
                	<?php } ?>
                </div>
            </div>
			<?php
		}
	}
}

/*==========================================================
	Woocommerce - YITH Wishlist
==========================================================*/
/* Yith Wishlist Browse Wishlist Text as Empty */
if ( ! function_exists( 'juster_yith_added_text' ) ) {
	add_filter( 'yith-wcwl-browse-wishlist-label', 'juster_yith_added_text' );
	function juster_yith_added_text() {
		return '';
	}
}

/* Yith Wishlist Add To Wishlist Text as Empty */
if ( ! function_exists( 'juster_yith_add_wishlist_text' ) ) {
	add_filter( 'yith_wcwl_button_label', 'juster_yith_add_wishlist_text' );
	function juster_yith_add_wishlist_text() {
		return '';
	}
}

/* Yith Wishlist Add To Wishlist Text as Empty */
if ( ! function_exists( 'juster_yith_my_wishlist_text' ) ) {
	add_filter( 'yith_wcwl_wishlist_title', 'juster_yith_my_wishlist_text' );
	function juster_yith_my_wishlist_text() {
		return '';
	}
}

if ( ! function_exists( 'juster_yith_added_comp_text' ) ) {
	add_filter( 'yith_woocompare_compare_button_in_product_page', 'juster_yith_added_comp_text' );
	function juster_yith_added_comp_text() {
		return __( 'new', 'juster' );
	}
}

/* ==============================================
    Custom WordPress Login Logo
=============================================== */
if ( ! function_exists( 'juster_custom_login_head' ) ) {
	function juster_custom_login_head() {
	  $login_logo = ot_get_option('login_logo');
	  if($login_logo) {
	    $login_logo_url = esc_url($login_logo);
	  } else {
	    $login_logo_url = IMAGES . '/logo.png';
	  }
	  if($login_logo) {
	  echo "
	    <style>
		    body.login #login h1 a {
		    background: url('$login_logo_url') no-repeat scroll center bottom transparent;
		    height: 100px;
		    width: 100%;
		    margin-bottom:0px;
		    }
	    </style>";
	  }
	}
	add_action('login_head', 'juster_custom_login_head');
}

/* ==============================================
    Custom WordPress Login Logo Link
=============================================== */
if ( ! function_exists( 'juster_custom_login_url' ) ) {
	function juster_custom_login_url() {
	  return site_url();
	}
	add_filter( 'login_headerurl', 'juster_custom_login_url', 10, 4 );
}

/* ==============================================
    Custom WordPress Login Logo Title
=============================================== */
if ( ! function_exists( 'juster_custom_login_title' ) ) {
	function juster_custom_login_title() {
		return get_bloginfo('name');
	}
	add_filter('login_headertext', 'juster_custom_login_title');
}

/* ==============================================
    Exclude category from blog
=============================================== */
if ( ! function_exists( 'excludeCat' ) ) {
	function excludeCat($query) {
		if ( $query->is_home ) {
			$exclude_cat_ids = ot_get_option('exclude_categories');
			if($exclude_cat_ids) {
				foreach( $exclude_cat_ids as $exclude_cat_id ) {
					$exclude_from_blog[] = '-'. $exclude_cat_id;
				}
				$query->set('cat', implode(',', $exclude_from_blog));
			}
		}
		return $query;
	}
	add_filter('pre_get_posts', 'excludeCat');
}

/* ==============================================
	Excerpt Length Change
=============================================== */
if ( ! function_exists( 'juster_custom_excerpt_length' ) ) {
	function juster_custom_excerpt_length( $length ) {
	  $excerpt_length = ot_get_option('blog_excerpt_length');
	  if($excerpt_length) {
	    $excerpt_length = $excerpt_length;
	  } else {
	    $excerpt_length = '20';
	  }
	  return $excerpt_length;
	}
	add_filter( 'excerpt_length', 'juster_custom_excerpt_length', 999 );
}

if ( ! function_exists( 'juster_new_excerpt_more' ) ) {
	function juster_new_excerpt_more( $more ) {
	  return '.';
	}
	add_filter('excerpt_more', 'juster_new_excerpt_more');
}

/**********************************************
	ADD & REMOVE NEW SOCIAL FIELD IN USER PROFILE
***********************************************/
if ( ! function_exists( 'juster_add_twitter_facebook' ) ) {
	function juster_add_twitter_facebook( $contactmethods ) {
	    $contactmethods['facebook'] 	= 'Facebook';
	    $contactmethods['twitter'] 		= 'Twitter';
	    $contactmethods['google_plus'] 	= 'Google Plus';
	    $contactmethods['linkedin'] 	= 'Linkedin';
	    return $contactmethods;
	}
	add_filter('user_contactmethods','juster_add_twitter_facebook',10,1);
}

/***************************************************
	AUTHOR INFO
***************************************************/
if ( ! function_exists( 'juster_author_info' ) ) {
	function juster_author_info() {
		$author_info = ot_get_option('author_info');
		if($author_info == 'on') {
?>
	<div class="sep-hover-control">
		<h2 class="author-title"><?php echo __('Author Info', 'juster'); ?>
			<span class="jt-sep-two"></span>
		</h2>
	</div>
	<div class="author-info">
		<div class="author-avatar">
			<a href="<?php echo esc_url(get_the_author_meta( 'user_url' )); ?>" target="_blank">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 112 ); ?>
			</a>
		</div>
		<div class="author-desc">
			<h6><?php echo get_the_author_meta('first_name').' '.get_the_author_meta('last_name'); ?></h6>
			<p><?php echo get_the_author_meta( 'description' ); ?></p>
			<a href="<?php echo esc_url(get_the_author_meta( 'user_url' )); ?>" target="_blank"><?php echo get_the_author_meta( 'user_url' ); ?></a>
			<div class="author-social">
				<ul>
					<?php
					$author_facebook = get_the_author_meta( 'facebook' );
					if($author_facebook) { ?>
						<li><a href="<?php echo esc_url($author_facebook); ?>" class="icon-facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<?php }
					$author_twitter = get_the_author_meta( 'twitter' );
					if($author_twitter) { ?>
						<li><a href="<?php echo esc_url($author_twitter); ?>" class="icon-twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<?php }
					$author_google_plus = get_the_author_meta( 'google_plus' );
					if($author_google_plus) { ?>
						<li><a href="<?php echo esc_url($author_google_plus); ?>" class="icon-google-plus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
					<?php }
					$author_linkedin = get_the_author_meta( 'linkedin' );
					if($author_linkedin) { ?>
						<li><a href="<?php echo esc_url($author_linkedin); ?>" class="icon-linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
<?php
		}
	}
}

/*==============================================================
	Script Functions

	Vintage Banner Image Slider Scripts
==============================================================*/
if ( ! function_exists( 'juster_vintage_banner_script' ) ) {
	function juster_vintage_banner_script() {
		global $post;
		$menu_position = ot_get_option('menu_position');

		$banner_type_ot = ot_get_option('banner_type');
		$banner_image_ot = ot_get_option('banner_image_ot');
		$banner_type_spl_ot = ot_get_option('banner_type_spl');
		$special_banner_image_ot = ot_get_option('special_banner_image');

	if (is_page()) {
		$banner_type_mt = get_post_meta( $post->ID, 'banner_type_mt', true );
		$banner_image_mt = get_post_meta( $post->ID, 'banner_image_mt', true );
        $banner_type_spl_mt = get_post_meta( $post->ID, 'banner_type_spl_mt', true );
        $special_banner_image_mt = get_post_meta( $post->ID, 'special_banner_image_mt', true );
    }
		if( ($menu_position == 'menu_pos_left_vintage' || $menu_position == 'menu_pos_right_vintage') && !is_page_template( 'template-vintage-home.php' )) {
			if(is_page() && $banner_type_mt == 'img_ban' && $banner_image_mt != '') {
				$i=0;
				foreach($banner_image_mt as $ban_img_mt) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#slider-vint").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif(is_page() && $banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
				$i=0;
				foreach($special_banner_image_mt as $ban_img_mt) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#large-header").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script><?php
				}
			} elseif($banner_type_ot == 'img_ban' && $banner_image_ot != '') {
				$i=0;
				foreach($banner_image_ot as $ban_img_ot) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#slider-vint").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
				$i=0;
				foreach($special_banner_image_ot as $ban_img_ot) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#large-header").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			}
		} // Menu loop && !template-vintage-home

		if( ($menu_position == 'menu_pos_left_vintage' || $menu_position == 'menu_pos_right_vintage') && is_page_template( 'template-vintage-home.php' )) {
			if($banner_type_mt == 'img_ban' && $banner_image_mt != '') {
				$i=0;
				foreach($banner_image_mt as $ban_img_mt) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#slider-vint-home").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
				$i=0;
				foreach($special_banner_image_mt as $ban_img_mt) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#large-header").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif($banner_type_ot == 'img_ban' && $banner_image_ot != '') {
				$i=0;
				foreach($banner_image_ot as $ban_img_ot) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#slider-vint-home").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
				$i=0;
				foreach($special_banner_image_ot as $ban_img_ot) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#large-header").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			}
			 // Menu loop && template-vintage-home
		} elseif( $menu_position != '' && is_page_template('template-vintage-home.php') ) {
			if($banner_type_mt == 'img_ban' && $banner_image_mt != '') {
				$i=0;
				foreach($banner_image_mt as $ban_img_mt) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#slider-vint").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
				$i=0;
				foreach($special_banner_image_mt as $ban_img_mt) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#large-header").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif($banner_type_ot == 'img_ban' && $banner_image_ot != '') {
				$i=0;
				foreach($banner_image_ot as $ban_img_ot) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#slider-vint").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
				$i=0;
				foreach($special_banner_image_ot as $ban_img_ot) {
					$i++;
				}
				if( $i >= 2 ) { ?>
					<script>
						jQuery(document).ready(function($){
						    "use strict";

						    // Vintage Page Banner
						    $("#large-header").blissSlider({
						    auto: 1,
						    transitionTime: 500,
						    timeBetweenSlides: 4000
						    });

						});
					</script> <?php
				}
			}
		} // else is page template vintage

	}
}

/*==============================================================
	Main Banner Image Slider Scripts
==============================================================*/
if ( ! function_exists( 'juster_banner_script_main_blog_portfolio' ) ) {
	function juster_banner_script_main_blog_portfolio() {
		global $post;
		$menu_position = ot_get_option('menu_position');

		$banner_type_ot = ot_get_option('banner_type');
		$banner_image_ot = ot_get_option('banner_image_ot');
		$banner_type_spl_ot = ot_get_option('banner_type_spl');
		$special_banner_image_ot = ot_get_option('special_banner_image');

	if (is_page()) {
		$banner_type_mt = get_post_meta( $post->ID, 'banner_type_mt', true );
		$banner_image_mt = get_post_meta( $post->ID, 'banner_image_mt', true );
		$banner_type_spl_mt = get_post_meta( $post->ID, 'banner_type_spl_mt', true );
		$special_banner_image_mt = get_post_meta( $post->ID, 'special_banner_image_mt', true );
	}
		if( ($menu_position == 'header_top_logo_left' || $menu_position == 'header_logo_with_banner' || $menu_position == 'menu_pos_left' || $menu_position == 'menu_pos_right' || $menu_position == 'header_outer_space' || $menu_position == 'header_with_topbar' || $menu_position == 'menu_pos_left_margin' || $menu_position == 'menu_pos_right_margin' || $menu_position == 'menu_pos_top_arch' || $menu_position == 'menu_pos_top_agency' || $menu_position == 'menu_pos_top_studio' || $menu_position == 'menu_pos_top_boxed' || $menu_position == 'menu_pos_top_shop') && !is_page_template( 'template-vintage-home.php' )) {
		    if(is_page() && $banner_type_mt == 'img_ban' && $banner_image_mt != '') {
		        $i=0;
		        foreach($banner_image_mt as $ban_img_mt) {
		            $i++;
		        }
		        if( $i >= 2 ) { ?>
				    <script>
				        jQuery(document).ready(function($){
				            "use strict";

				            // Vintage Page Banner
				            $("#slider-vint").blissSlider({
				            auto: 1,
				            transitionTime: 500,
				            timeBetweenSlides: 4000
				            });

				        });
				    </script> <?php
		        }
		    } elseif(is_page() && $banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
		        $i=0;
		        foreach($special_banner_image_mt as $ban_img_mt) {
		            $i++;
		        }
		        if( $i >= 2 ) { ?>
				    <script>
				        jQuery(document).ready(function($){
				            "use strict";

				            // Vintage Page Banner
				            $("#large-header").blissSlider({
				            auto: 1,
				            transitionTime: 500,
				            timeBetweenSlides: 4000
				            });

				        });
				    </script> <?php
		        }
		    } elseif($banner_type_ot == 'img_ban' && $banner_image_ot != '') {
		        $i=0;
		        foreach($banner_image_ot as $ban_img_ot) {
		            $i++;
		        }
		        if( $i >= 2 ) { ?>
				    <script>
				        jQuery(document).ready(function($){
				            "use strict";

				            // Vintage Page Banner
				            $("#slider-vint").blissSlider({
				            auto: 1,
				            transitionTime: 500,
				            timeBetweenSlides: 4000
				            });

				        });
				    </script> <?php
		        }
		    } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
		        $i=0;
		        foreach($special_banner_image_ot as $ban_img_ot) {
		            $i++;
		        }
		        if( $i >= 2 ) { ?>
				    <script>
				        jQuery(document).ready(function($){
				            "use strict";

				            // Vintage Page Banner
				            $("#large-header").blissSlider({
				            auto: 1,
				            transitionTime: 500,
				            timeBetweenSlides: 4000
				            });

				        });
				    </script> <?php
		        }
		    }
		} // Menu loop && !template-vintage-home
	}
}

/*==============================================================
	Header Templates

	Header Sticky - is-sticky Enable Function
===============================================================*/
if ( ! function_exists( 'juster_is_sticky_enable_fun' ) ) {
	function juster_is_sticky_enable_fun() {
		$menu_position  = ot_get_option('menu_position');
		$sticky_header  = ot_get_option('sticky_header');
		if( $sticky_header == 'on' && ($menu_position == 'header_top_logo_left' || $menu_position == 'header_logo_with_banner' || $menu_position == 'header_outer_space' || $menu_position == 'header_with_topbar' || $menu_position == 'menu_pos_top_arch' || $menu_position == 'menu_pos_top_agency' || $menu_position == 'menu_pos_top_studio' || $menu_position == 'menu_pos_top_boxed' || $menu_position == 'menu_pos_top_shop' ) ) {
		?>
		    <script type="text/javascript">
		        jQuery(document).ready(function($) {
		            "use strict";
		            // Sticky Navbar
		            $(".sticky-nav").sticky({topSpacing:0});
		        });
		    </script>
		<?php }
	}
}

/*==============================================================
	Header - Main Header / Top Header With Logo Left
===============================================================*/
if ( ! function_exists( 'header_top_logo_left' ) ) {
	function header_top_logo_left() {
	global $post;
	$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
    $sticky_header = ot_get_option('sticky_header');
    if($sticky_header == 'on' && $banner_type_mt != 'sld_ban') {
        $sticky_header  = 'sticky-nav';
    } elseif($sticky_header == 'on' && $banner_type_mt == 'sld_ban') {
        $sticky_header = ' sticky-nav sticky-rev';
    } else {
    	$sticky_header = '';
    }
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt !='' ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container-fluid';
        }
    }
    $single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
    if(is_singular('portfolio')) {
    	if($single_port_gallery != '') {
    		$single_port_header_height = '';
    	} elseif($single_port_gallery == '') {
    		$single_port_header_height = 'style="min-height: 110px;"';
    	} else {
    		$single_port_header_height = '';
    	}
    } else {
    	$single_port_header_height = '';
    }
    if (is_page_template( 'template-scroll-lock.php' )) {
    	$page_banner_class = '';
    } else {
    	$page_banner_class = 'jt-page-header ';
    }
    $banner_type_ot = ot_get_option('banner_type');
    $banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
    if (is_page()) {
    	if ($banner_type_mt == 'jt_hide_ban') {
    		$page_hav_banner = 'page_hav_banner ';
    	} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
    		$page_hav_banner = 'page_hav_banner ';
    	} else {
    		$page_hav_banner = '';
    	}
    } elseif(!is_page()) {
    	if ($banner_type_ot == 'jt_hide_ban') {
    		$page_hav_banner = 'page_hav_banner ';
    	} else {
    		$page_hav_banner = '';
    	}
    }
?>
<div class="<?php echo esc_attr($layout_structure); ?> padding-zero jt-main-banner-holder">
	<div id="jt-first-section" class="<?php echo $page_banner_class; echo $page_hav_banner; ?> jt-blog-page" <?php echo esc_attr($single_port_header_height); ?>>
		<?php
		if( !is_page_template( 'template-one-page-architecture.php' ) && !is_page_template( 'template-scroll-lock.php' ) ) {
			$banner_type_ot = ot_get_option('banner_type');
			$banner_color_ot = ot_get_option('banner_color_ot');
			$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
			$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );
			if($banner_type_mt != '' && $banner_color_mt != '') {
				$banner_color = $banner_color_mt;
			} elseif($banner_type_ot != '' && $banner_color_ot != '') {
				$banner_color = $banner_color_ot;
			} else {
				$banner_color = '';
			}
		?>
			<div class="jt-banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
		<?php } ?>
		<header class="<?php echo esc_attr($sticky_header); ?>">
		    <nav class="navbar navbar-default navbar-static-top">
		        <div class="">
		            <div class="navbar-header">
		                <?php
		                $retina_logo = ot_get_option('retina_logo_upload');
		                $default_logo = ot_get_option('logo_upload');
		                $front_cus_enable = ot_get_option('front_cus_enable');
		                $front_logo_upload = ot_get_option('front_logo_upload');
		                $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');
		                $retina_logo_width = ot_get_option('retina_logo_width');
		                $retina_logo_height = ot_get_option('retina_logo_height');
						if((is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') || is_page_template( 'template-scroll-lock.php' )) {
							if($front_retina_logo_upload != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif((is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') || is_page_template( 'template-scroll-lock.php' )) {
							if($front_retina_logo_upload != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif((is_front_page() && $front_cus_enable == 'off' && $default_logo != '') || is_page_template( 'template-scroll-lock.php' )) {
							if($retina_logo != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page() || is_page_template( 'template-scroll-lock.php' )) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php }
						if(!is_front_page() && $default_logo != '' && !is_page_template( 'template-scroll-lock.php' )) {
							if($retina_logo) { ?>
							    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
							        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							    </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
							  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							</a>
						<?php } elseif(!is_front_page() && $default_logo =='' && !is_page_template( 'template-scroll-lock.php' )) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
							  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							</a>
						<?php } ?>
		            </div>
		            <?php
		            $head_search = ot_get_option('search_enable');
		            $head_cart = ot_get_option('cart_enable');
		            $head_lang = ot_get_option('lang_enable');
		            if( $head_search == 'on' || $head_cart == 'on' || $head_lang == 'on' ) {
		            ?>
		            <div class="menu-metas navbar-default navbar-right">
		                <ul class="navbar-nav">
		                <?php if( $head_search == 'on' ) { ?>
		                    <li id="top-search" class="jt-menu-search">
		                        <a href="#0" id="top-search-trigger">
		                            <i class="fa fa-search"></i>
		                            <i class="pe-7s-close"></i>
		                        </a>
		                        <form class="container search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" >
		                            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
		                        </form>
		                    </li>
		                <?php } else { }
		                if( $head_lang == 'on' ) {
		                	dynamic_sidebar( 'lang_widget' );
		            	}
		                if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
		                    <li id="jt-top-cart" class="jt-menu-cart">
		                        <?php woocommerce_cart_button(); ?>
		                        <div class="top-cart-content">
		                            <?php woocommerce_cart_widget(); ?>
		                        </div>
		                    </li>
		                <?php } else { } ?>
		                </ul>
		            </div>
		            <?php }
		            global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
		            wp_nav_menu(
		                array(
		                    'walker'            => new wp_bootstrap_navwalker(),
		                    'theme_location'    => 'main-menu',
		                    'menu'    			=> $jt_choose_menu,
		                    'menu_class'        => 'nav navbar-nav navbar-right jt-main-nav',
		                    'menu_id'           => 'menu-create-menu',
		                    'container_class'   =>'collapse navbar-collapse menu-main-menu-container',
		                    'container_id'      =>'main-nav',
		                    'fallback_cb'       => false,
		                )
		            );
		            ?>
		        </div>
		    </nav>
		    <!-- Slim Menu -->
		    <div class="hidden-big-screen ">
		        <div class="<?php echo esc_attr($sticky_header); ?> jt-slim-top">
	                <?php
	                $retina_logo = ot_get_option('retina_logo_upload');
	                $default_logo = ot_get_option('logo_upload');
					$front_cus_enable = ot_get_option('front_cus_enable');
	                $front_logo_upload = ot_get_option('front_logo_upload');
	                $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');
					if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
						<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
							if($front_retina_logo_upload != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
						if($retina_logo != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }
					if(!is_front_page() && $default_logo != '') {
						if($retina_logo) { ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page() && $default_logo =='') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
						  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }
					global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
		            wp_nav_menu(
		                array(
		                    'walker'            => new wp_bootstrap_navwalker(),
		                    'theme_location'    => 'main-menu',
		                    'menu'    			=> $jt_choose_menu,
		                    'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
		                    'menu_id'           => 'menu-main-menu',
		                    'container_class'   => 'menu-main-menu-container',
		                    'fallback_cb'       => false,
		                    'sub_menu' 			=> true,
		                )
		            );
		            $head_search = ot_get_option('search_enable');
		            $head_cart = ot_get_option('cart_enable');
		            $head_lang = ot_get_option('lang_enable');
		            if( $head_search == 'on' || $head_cart == 'on' || $head_lang == 'on' ) {
		            ?>
		            <div class="menu-metas navbar-default navbar-right jt-slim-meta">
		                <?php if( $head_lang == 'on' ) {
		                	dynamic_sidebar( 'lang_widget' );
		            	} ?>
		            	<ul class="navbar-nav">
		            	<?php if( $head_search == 'on' ) { ?>
		            	    <li id="top-search-slim" class="jt-menu-search">
		            	        <a href="#0" id="top-search-trigger-slim">
		            	            <i class="fa fa-search"></i>
		            	            <i class="pe-7s-close"></i>
		            	        </a>
		            	        <form class="container search-new" method="get" action="<?php echo esc_url(home_url('/')); ?>" >
		            	            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
		            	        </form>
		            	    </li>
		            	<?php } else { }
		            	if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
		            	    <li id="jt-top-cart-slim" class="jt-menu-cart-slim">
		            	        <?php woocommerce_cart_button_slim(); ?>
		            	        <div class="top-cart-content">
		            	            <?php woocommerce_cart_widget(); ?>
		            	        </div>
		            	    </li>
		            	<?php } else { } ?>
		            	</ul>
		            </div>
		            <?php } ?>
				</div>
			</div>
		    <!-- /Slim Menu -->
		</header>
<?php
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );

if( ($banner_type_mt == 'img_ban' && $banner_image_mt) || ($banner_type_ot == 'img_ban' && $banner_image_ot)) {
    $slide_id = 'slider-vint';
} elseif( ($banner_type_mt == 'spc_ban' && $special_banner_image_mt) || $banner_type_ot == 'spc_ban' && $special_banner_image_ot ) {
    $slide_id = 'large-header';
} else {
    $slide_id = 'videoid';
}

// Hide Banner if Page is Hide Banner
if (is_page()) {
	if ($banner_type_mt == 'jt_hide_ban') {
		$jt_banner_cover = 'jt_banner_cover ';
	} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
		$jt_banner_cover = 'jt_banner_cover ';
	} else {
		$jt_banner_cover = '';
	}
} elseif(!is_page()) {
	if ($banner_type_ot == 'jt_hide_ban') {
		$jt_banner_cover = 'jt_banner_cover ';
	} else {
		$jt_banner_cover = '';
	}
}

if(!is_singular('portfolio')) {
	if(!is_page_template( 'template-one-page-architecture.php' ) && !is_page_template( 'template-scroll-lock.php' )) {
		if($banner_type_mt == 'img_ban' && $banner_image_mt) {
			$img=0;
			foreach($banner_image_mt as $ban_img_mt) {
				$img++;
			}
			if($img <= 1) {
				foreach($banner_image_mt as $vint_ban_mt) {
			?>
				<div class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
				</div>
			<?php }
			} elseif($img >= 2) { ?>
				<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
					<ul class="slider jt-animated-hand">
					    <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					            </div>
					        </li>
					    <?php } ?>
					</ul>
				</div>
		<?php }
		} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
			$spc=0;
			foreach($special_banner_image_mt as $ban_spc_mt) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
			        <?php }
			        if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
		<?php }
		} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
		        $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
		        $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
		        $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
		        $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
		        $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
		        $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
		        $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
		<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
				echo do_shortcode($banner_slide_mt);
			} elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
		        echo do_shortcode($banner_shortcode_mt);
		    } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) {
		    	$img=0;
				foreach($banner_image_ot as $ban_img_ot) {
					$img++;
				}
		    	if($img <= 1) {
		    		foreach($banner_image_ot as $vint_ban_ot) {
		    	?>
			    	<div class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
			        </div>
		    	<?php }
		    	} elseif($img >= 2) { ?>
			    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
				        <ul class="slider jt-animated-hand">
				            <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
				                <li class="slide">
				                    <div class="slide-bg">
				                        <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
				                    </div>
				                </li>
				            <?php } ?>
				        </ul>
			        </div>
		<?php }
		} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
			$spc=0;
			foreach($special_banner_image_ot as $ban_spc_ot) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
					<?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
			        <?php }
			        if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
		<?php }
		} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
		        $vid_ban_control = ot_get_option('vid_ban_control');
		        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
		        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
		        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
		        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
		        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
		<?php
		} elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
		    echo '<div class="'. $jt_banner_cover .'">' . do_shortcode($banner_slide_ot) . '</div>';
		} else {}
	} // !template-one-page-architecture
} elseif(is_singular('portfolio')) { // single portfolio slider on header
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
	if($single_port_gallery != '') { ?>
		<div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($single_port_gallery as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
}

if( !is_page_template( 'template-one-page-architecture.php' ) && !is_page_template( 'template-scroll-lock.php' ) ) {
	$breadcrumbs = ot_get_option('breadcrumbs');
    $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', 'true' );
    $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', 'true' );
    $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', 'true' );
    $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', 'true' );

	if($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-1null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-2null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-3null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-4null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-5null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-6null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-7null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-8null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-9null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-10null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-11null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-12null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-13null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-14null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-15null';
	} else {
		$ban_text = '';
	}
	if(!is_singular('portfolio')) {
?>
	    <?php
	    $page_title = ot_get_option('page_title');
	    $banner_type_ot = ot_get_option('banner_type');
	    $banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
	    if(is_page() && $banner_type_mt != 'sld_ban') {
	    	// Hide Banner Title If Banner is Hide
	    	if ($banner_type_mt == 'jt_hide_ban') {
	    		$page_hide_title = 'page_hide_title ';
	    	} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
	    		$page_hide_title = 'page_hide_title ';
	    	} else {
	    		$page_hide_title = '';
	    	}
	    ?>
			<div class="jt-page-banner <?php echo esc_attr($page_hide_title); echo esc_attr($ban_text); ?>">
				<?php if ($page_title != 'off' && $enable_new_page_title == 'off') {
					if(is_front_page()) { ?>
			    		<h2 class="page_heading"><?php bloginfo(''); ?></h2>
			    	<?php } else { ?>
			    		<h2 class="page_heading"><?php the_title(); ?></h2>
			    	<?php }
				} elseif($enable_new_page_title == 'on') {
					if($new_page_title != '') { ?>
						<h2 class="page_heading"><?php echo esc_attr($new_page_title); ?></h2>
					<?php } elseif($new_page_title == '') { ?>
						<h2 class="page_heading"><?php echo the_title(); ?></h2>
					<?php } elseif($page_title == 'off' && $new_page_title == '') {}
				} // Page Title Hide
				if($page_subheading) {
		        	echo '<h3 class="page_sub_heading">'.esc_attr($page_subheading).'</h3>';
		        }
		        $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', 'true' );
		        if($header_banner_title_img !='') {
		        	echo '<div class="jt-main-ban-tit">';
		        	echo '<img src="'. esc_attr($header_banner_title_img) .'" alt="">';
		        	echo '</div>';
		        } ?>
			    <div class="jt-breadcrumbs">
			    	<?php
			        $breadcrumbs = ot_get_option('breadcrumbs');
			        if($breadcrumbs == 'on') {
			            echo breadcrumb_trail();
			        }
			        ?>
			    </div>
			</div>
		<?php } elseif(!is_page() && $banner_type_ot != 'jt_hide_ban' && $banner_type_ot != 'sld_ban') {
	    ?>
			<div class="jt-page-banner <?php echo esc_attr($ban_text); ?>">
				<?php
				if ($page_title != 'off') {
					if(is_front_page()) { ?>
				    	<h2 class="page_heading"><?php bloginfo(''); ?></h2>
				    <?php } elseif (is_author()) { ?>
						<h2 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h2>
					<?php
						} elseif (is_archive()) { ?>
	                        <h2 class="page_heading"><?php if ( is_day() ) {
	                                printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
	                            } elseif ( is_month() ) {
	                                printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
	                            } elseif ( is_year() ) {
	                                printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
	                            } else {
	                                echo __( 'Archives', 'juster' );
	                            } ?></h2>
	                    <?php
	                    } elseif (is_search()) { ?>
						<h2 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h2>
					<?php
						} elseif (is_category()) { ?>
							<h2 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h2>
					<?php
						} elseif (is_tag()) { ?>
							<h2 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h2>
					<?php
						} elseif(is_home()) { ?>
							<h2 class="page_heading"><?php bloginfo(''); ?></h2>
					<?php
						} else { ?>
							<h2 class="page_heading"><?php the_title(); ?></h2>
					<?php
						}
				} // Hide Page Title ?>
			    <div class="jt-breadcrumbs">
			    	<?php
			        $breadcrumbs = ot_get_option('breadcrumbs');
			        if($breadcrumbs == 'on') {
			            echo breadcrumb_trail();
			        }
			        ?>
			    </div>
			</div>
		<?php }

		if( (is_page() && $banner_type_mt != 'sld_ban') || (!is_page() && $banner_type_ot != 'sld_ban') ) {
			echo juster_banner_anim();
		}

	} // !is-single-portfolio
} // !template-one-page-architecture
?>
	</div>
</div>
<?php
	}
}

/*==============================================================
	Header - Blog Header / Banner With Logo
===============================================================*/
if ( ! function_exists( 'header_logo_with_banner' ) ) {
	function header_logo_with_banner() {
		global $post;
		$layout_model_ot = ot_get_option('fullwidth_boxed');
		$layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
		if( is_page() ) {
		    if( $layout_model_mt ) {
		        if( $layout_model_mt === 'full_width' ) {
		            $layout_structure = 'container';
		        } elseif( $layout_model_mt === 'extra_width' ) {
		            $layout_structure = 'container-fluid';
		        } elseif( $layout_model_ot === 'full-width' ) {
		            $layout_structure = 'container';
		        } elseif( $layout_model_ot === 'extra-width' ) {
		            $layout_structure = 'container-fluid padding-zero';
		        } else {
		            $layout_structure = 'container';
		        }
		    } elseif( $layout_model_ot ) {
		        if( $layout_model_ot === 'full-width' ) {
		            $layout_structure = 'container';
		        } elseif( $layout_model_ot === 'extra-width' ) {
		            $layout_structure = 'container-fluid';
		        } else {
		            $layout_structure = 'container';
		        }
		    } else {
		        $layout_structure = 'container';
		    }
		} elseif ( !is_page() ) {
		    if( $layout_model_ot ) {
		        if( $layout_model_ot === 'full-width' ) {
		            $layout_structure = 'container';
		        } elseif( $layout_model_ot === 'extra-width' ) {
		            $layout_structure = 'container-fluid';
		        } else {
		            $layout_structure = 'container';
		        }
		    } else {
		        $layout_structure = 'container';
		    }
		}
?>
<div class="<?php echo esc_attr($layout_structure); ?> padding-zero jt_blog_header_content">
	<div class="jt-blog-header">
		<?php
		$menu_position = ot_get_option('menu_position');
		$sticky_header = ot_get_option('sticky_header');
		if($sticky_header == 'on' && $menu_position == 'header_logo_with_banner') {
		    $sticky_header  = 'sticky-nav';
		} else {
		    $sticky_header = '';
		}
		?>
	    <header id="<?php echo esc_attr($sticky_header); ?>" class="sticky-nav logo-center">
	        <nav class="navbar navbar-default navbar-static-top">
	            <div class="container">
	                <?php
	                global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
	                wp_nav_menu(
	                    array(
	                        'walker'            => new wp_bootstrap_navwalker(),
	                        'theme_location'    => 'main-menu',
	                        'menu'    			=> $jt_choose_menu,
	                        'menu_class'        => 'nav navbar-nav navbar-left jt-main-nav',
	                        'menu_id'           => 'menu-create-menu',
	                        'container_class'   => 'menu-main-menu-container',
	                        'fallback_cb'       => false,
	                    )
	                );
	                ?>
	                <div id="main-nav" class="collapse navbar-collapse">
	                    <div class="jt-header-social">
							<?php
							$menu_position = ot_get_option('menu_position');
							if($menu_position == 'header_logo_with_banner') {
								dynamic_sidebar( 'top_menu_social_widget' );
							}
							?>
	                    </div>
						<?php
						$head_search = ot_get_option('search_enable');
						$head_cart = ot_get_option('cart_enable');
						$head_lang = ot_get_option('lang_enable');
						if( $head_search == 'on' || $head_cart == 'on' || $head_lang == 'on' ) {
						?>
	                    <div class="menu-metas navbar-default navbar-right">
	                        <ul class="navbar-nav">
	                        	<?php if( $head_search == 'on' ) { ?>
	                            <li id="top-search" class="jt-search">
	                                <a href="#0" id="top-search-trigger">
	                                    <i class="fa fa-search"></i>
	                                    <i class="pe-7s-close"></i>
	                                </a>
	                                <form class="container" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" method="get">
	                                    <input type="text" name="s" class="form-control" value="" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
	                                </form>
	                            </li>
	                            <?php } else { }
				                if( $head_lang == 'on' ) {
				                	dynamic_sidebar( 'lang_widget' );
				            	}
	                            if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
	                            <li id="jt-top-cart" class="jt-menu-cart">
	                                <?php woocommerce_cart_button(); ?>
	                                <div class="top-cart-content">
	                                	<?php woocommerce_cart_widget(); ?>
	                                </div>
	                            </li>
	                            <?php } else { } ?>
	                        </ul>
	                    </div>
	                    <?php } ?>
	                </div>
	                <!-- Main Nav -->
	            </div><!-- /.container -->
	        </nav>

			<!-- Slim Menu -->
	        <div class="hidden-big-screen ">
				<div class="<?php echo esc_attr($sticky_header); ?> jt-slim-top">
					<div class="jt-slim-meta">
	                    <div class="jt-header-social">
							<?php
							$menu_position = ot_get_option('menu_position');
							if($menu_position == 'header_logo_with_banner') {
								dynamic_sidebar( 'top_menu_social_widget' );
							}
							?>
	                    </div>
						<?php
						$head_search = ot_get_option('search_enable');
						$head_cart = ot_get_option('cart_enable');
						$head_lang = ot_get_option('lang_enable');
						if( $head_search == 'on' || $head_cart == 'on' || $head_lang == 'on' ) {
						?>
						<div class="menu-metas navbar-default navbar-right">
							 <?php if( $head_lang == 'on' ) {
			                	dynamic_sidebar( 'lang_widget' );
			            	} ?>
						    <ul class="navbar-nav">
						    	<?php if( $head_search == 'on' ) { ?>
						        <li id="top-search-slim" class="top-search jt-search">
						            <a href="#0" id="top-search-trigger-slim">
						                <i class="fa fa-search"></i>
						                <i class="pe-7s-close"></i>
						            </a>
						            <form class="container" action="<?php echo esc_url(home_url('/')); ?>" method="get">
						                <input type="text" name="s" class="form-control" value="" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
						            </form>
						        </li>
						        <?php } else { }
						        if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
						        <li id="jt-top-cart-slim" class="jt-menu-cart-slim jt-top-cart">
						            <?php woocommerce_cart_button_slim(); ?>
						            <div class="top-cart-content">
						            	<?php woocommerce_cart_widget(); ?>
						            </div>
						        </li>
						        <?php } else { } ?>
						    </ul>
						</div>
						<?php } ?>
					</div>
					<?php
					global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
	                wp_nav_menu(
	                    array(
	                        'walker'            => new wp_bootstrap_navwalker(),
	                        'theme_location'    => 'main-menu',
	                        'menu'    			=> $jt_choose_menu,
	                        'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
	                        'container_class'   => 'menu-main-menu-container',
	                        'menu_id'           => 'menu-main-menu',
	                        'fallback_cb'       => false,
	                        'sub_menu'			=> true,
	                        'depth'				=> 5
	                    )
	                );
	                ?>
				</div>
            </div>
            <!-- /Slim Menu -->
	    </header>
	    <!-- Header Logo and Menus -->
	</div> <!-- /Header -->
</div>
<?php
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );

$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
if(!is_singular('portfolio')) {
	if(is_page() && $banner_type_mt == 'sld_ban') {
		$slide_class = 'blog_rev_slide';
	} elseif(!is_page() && $banner_type_ot == 'sld_ban') {
		$slide_class = 'blog_rev_slide';
	} else {
		$slide_class = '';
	}
?>
	<div class="<?php echo esc_attr($layout_structure); ?> padding-zero">
	    <div class="jt-logo-caption <?php echo esc_attr($slide_class); ?>">
	    	<?php
	    	if(is_page() && $banner_type_mt != '' && $banner_color_mt != '') {
	    		$banner_color = $banner_color_mt;
	    	} elseif(!is_page() && $banner_type_ot != '' && $banner_color_ot != '') {
	    		$banner_color = $banner_color_ot;
	    	} else {
	    		$banner_color = '';
	    	}
			?>
	    	<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			<?php
			if(!is_page_template( 'template-one-page-architecture.php' )) {
				if($banner_type_mt == 'img_ban' && $banner_image_mt) {
					$img=0;
					foreach($banner_image_mt as $ban_img_mt) {
						$img++;
					}
					if($img <= 1) {
						foreach($banner_image_mt as $vint_ban_mt) {
					?>
						<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
						</div>
					<?php }
					} elseif($img >= 2) { ?>
						<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
							<ul class="slider jt-animated-hand">
							    <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
							        <li class="slide">
							            <div class="slide-bg">
							                <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
							            </div>
							        </li>
							    <?php } ?>
							</ul>
						</div>
				<?php }
				} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
					$spc=0;
					foreach($special_banner_image_mt as $ban_spc_mt) {
						$spc++;
					}
					if($spc <= 1) { ?>
						<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
					        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
					        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
					        </div>
					        <?php }
					        if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
					            <canvas id="juster-canvas-one"></canvas>
					        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
					            <canvas id="juster-canvas-two"></canvas>
					        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
					            <canvas id="juster-canvas-three"></canvas>
					        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
					            <canvas id="juster-canvas-four"></canvas>
					        <?php } ?>
						</div>
					<?php } elseif($spc >= 2) { ?>
						<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
					        <ul class="slider jt-animated-hand">
					            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
					                <li class="slide">
					                    <div class="slide-bg">
					                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					                    </div>
					                </li>
					            <?php } ?>
					        </ul>
					        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
					            <canvas id="juster-canvas-one"></canvas>
					        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
					            <canvas id="juster-canvas-two"></canvas>
					        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
					            <canvas id="juster-canvas-three"></canvas>
					        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
					            <canvas id="juster-canvas-four"></canvas>
					        <?php } ?>
						</div>
				<?php }
				} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
				        $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
				        $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
				        $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
				        $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
				        $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
				        $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
				        $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
				        if($vid_ban_control) {
				            $vid_ban_control = 'true';
				        } else {
				            $vid_ban_control = 'false';
				        }
				        if($vid_ban_auto_play) {
				            $vid_ban_auto_play = 'true';
				        } else {
				            $vid_ban_auto_play = 'false';
				        }
				        if($vid_ban_vid_loop) {
				            $vid_ban_vid_loop = 'true';
				        } else {
				            $vid_ban_vid_loop = 'false';
				        }
				        if($vid_ban_aud_mute) {
				            $vid_ban_aud_mute = 'true';
				        } else {
				            $vid_ban_aud_mute = 'false';
				        }
				        if($vid_ban_start_time) {
				            $vid_ban_start_time = $vid_ban_start_time;
				        } else {
				            $vid_ban_start_time = '0';
				        }
				        if($vid_ban_vid_qty) {
				            $vid_ban_vid_qty = $vid_ban_vid_qty;
				        } else {
				            $vid_ban_vid_qty = 'default';
				        }
				    ?>
				    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
				        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
				        </a>
					</div>
				<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') { ?>
					<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner">
					    <ul class="slider jt-animated-hand">
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo IMAGES; ?>/patterns/home-blog-pat.jpg" alt="">
					            </div>
					        </li>
					    </ul>
				    </div>
				<?php } elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
				        echo do_shortcode($banner_shortcode_mt);
				    } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) {
		    	    	$img=0;
		    			foreach($banner_image_ot as $ban_img_ot) {
		    				$img++;
		    			}
		    			if($img <= 1) {
				    		foreach($banner_image_ot as $vint_ban_ot) {
				    	?>
					    	<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
					        </div>
				    	<?php }
				    	} elseif($img >= 2) { ?>
					    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
						        <ul class="slider jt-animated-hand">
						            <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
						                <li class="slide">
						                    <div class="slide-bg">
						                        <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
						                    </div>
						                </li>
						            <?php } ?>
						        </ul>
					        </div>
				<?php }
				} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
					$spc=0;
					foreach($special_banner_image_ot as $ban_spc_ot) {
						$spc++;
					}
					if($spc <= 1) { ?>
						<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
						    <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
					        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
					        </div>
					        <?php }
					        if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
						        <canvas id="juster-canvas-one"></canvas>
						    <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
						        <canvas id="juster-canvas-two"></canvas>
						    <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
						        <canvas id="juster-canvas-three"></canvas>
						    <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
						        <canvas id="juster-canvas-four"></canvas>
						    <?php } ?>
						</div>
					<?php } elseif($spc >= 2) { ?>
						<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
					        <ul class="slider jt-animated-hand">
					            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
					                <li class="slide">
					                    <div class="slide-bg">
					                        <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					                    </div>
					                </li>
					            <?php } ?>
					        </ul>
					        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
					            <canvas id="juster-canvas-one"></canvas>
					        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
					            <canvas id="juster-canvas-two"></canvas>
					        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
					            <canvas id="juster-canvas-three"></canvas>
					        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
					            <canvas id="juster-canvas-four"></canvas>
					        <?php } ?>
						</div>
				<?php }
				} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
				        $vid_ban_control = ot_get_option('vid_ban_control');
				        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
				        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
				        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
				        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
				        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
				        if($vid_ban_control) {
				            $vid_ban_control = 'true';
				        } else {
				            $vid_ban_control = 'false';
				        }
				        if($vid_ban_auto_play) {
				            $vid_ban_auto_play = 'true';
				        } else {
				            $vid_ban_auto_play = 'false';
				        }
				        if($vid_ban_vid_loop) {
				            $vid_ban_vid_loop = 'true';
				        } else {
				            $vid_ban_vid_loop = 'false';
				        }
				        if($vid_ban_aud_mute) {
				            $vid_ban_aud_mute = 'true';
				        } else {
				            $vid_ban_aud_mute = 'false';
				        }
				        if($vid_ban_start_time) {
				            $vid_ban_start_time = $vid_ban_start_time;
				        } else {
				            $vid_ban_start_time = '0';
				        }
				        if($vid_ban_vid_qty) {
				            $vid_ban_vid_qty = $vid_ban_vid_qty;
				        } else {
				            $vid_ban_vid_qty = 'default';
				        }
				    ?>
				    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
				        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
				        </a>
					</div>
				<?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') { ?>
					<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner">
					    <ul class="slider jt-animated-hand">
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo IMAGES; ?>/patterns/home-blog-pat.jpg" alt="">
					            </div>
					        </li>
					    </ul>
				    </div>
				<?php } else { ?>
					<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner">
					    <ul class="slider jt-animated-hand">
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo IMAGES; ?>/patterns/home-blog-pat.jpg" alt="">
					            </div>
					        </li>
					    </ul>
				    </div>
				<?php } ?>
			    <div class="jt-blog-logo">
			    	<?php
			        $retina_logo = ot_get_option('retina_logo_upload');
			        $default_logo = ot_get_option('logo_upload');
			        $front_cus_enable = ot_get_option('front_cus_enable');
	                $front_logo_upload = ot_get_option('front_logo_upload');
	                $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');
					if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_attr($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
						if($retina_logo != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }
					if(!is_front_page() && $default_logo != '') {
						if($retina_logo) { ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page() && $default_logo =='') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
						  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } ?>
			    </div>
			<?php } // !template-one-page-architecture ?>
	    </div>
	    <div class="jt_blog_rev_slider">
		    <?php
		    if(!is_page_template('template-one-page-architecture.php')) {
		    	if(is_page() && $banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
				    echo do_shortcode($banner_slide_mt);
				} elseif(!is_page() && $banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
				    echo do_shortcode($banner_slide_ot);
				}
	    	}
		    ?>
	    </div>
	</div>
<?php } elseif(is_singular('portfolio')) { // single portfolio slider on header
		$single_port_featured_img = ot_get_option('single_port_featured_img');
		$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
		if($single_port_gallery != '') { ?>
			<div id="jt-agency-slide" class="owl-carousel owl-theme">
			    <?php foreach ($single_port_gallery as $port_gallery) { ?>
					<div class="item">
						<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
						<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
							<div class="single-portfolio-banner-content">
								<?php if( $port_gallery['port_cat'] ) {
	                                echo '<p>'.$port_gallery['port_cat'].'</p>';
	                            }
	                            if( $port_gallery['title'] ) {
	                                echo '<h1>'.$port_gallery['title'].'</h1>';
	                            } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
			<div class="single-portfolio-header-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php }
	} // single portfolio
	}
}

/*==========================================================================
	Header - Portfolio Header / Left Side Menu / Right Side Menu
==========================================================================*/
if ( ! function_exists( 'leftside_menu' ) ) {
	function leftside_menu() {
		global $post;
	    $menu_position = ot_get_option('menu_position');
	    $banner_type = ot_get_option('banner_type');
	    $menu_left_bg = ot_get_option('menu_left_bg');
	    $menu_right_bg = ot_get_option('menu_right_bg');
	    if( $menu_position == 'menu_pos_left' && $menu_left_bg!='' ) {
	    	$menu_left_bg_color    = $menu_left_bg['background-color'];
	    	$menu_left_bg_img      = $menu_left_bg['background-image'];
	    	$menu_left_bg_repeat   = $menu_left_bg['background-repeat'];
	    	$menu_left_bg_attach   = $menu_left_bg['background-attachment'];
	    	$menu_left_bg_pos      = $menu_left_bg['background-position'];
	    	$menu_left_bg_size     = $menu_left_bg['background-size'];
	        if($menu_left_bg_color) {
	            $menu_left_bg_color = 'background-color: '.$menu_left_bg_color.';';
	        } else { $menu_left_bg_color = ''; }
	        if($menu_left_bg_img) {
	            $menu_left_bg_img = 'background-image:url('.$menu_left_bg_img.');';
	        } else { $menu_left_bg_img = ''; }
	        if($menu_left_bg_repeat) {
	            $menu_left_bg_repeat = 'background-repeat: '.$menu_left_bg_repeat.';';
	        } else { $menu_left_bg_repeat = ''; }
	        if($menu_left_bg_attach) {
	            $menu_left_bg_attach = 'background-attachment: '.$menu_left_bg_attach.';';
	        } else { $menu_left_bg_attach = ''; }
	        if($menu_left_bg_pos) {
	            $menu_left_bg_pos = 'background-position: '.$menu_left_bg_pos.';';
	        } else { $menu_left_bg_pos = ''; }
	        if($menu_left_bg_size) {
	            $menu_left_bg_size = 'background-size: '.$menu_left_bg_size.';';
	        } else { $menu_left_bg_size = ''; }
	    } elseif( $menu_position == 'menu_pos_right' && $menu_right_bg!='' ) {
	    	$menu_left_bg_color    = $menu_right_bg['background-color'];
	    	$menu_left_bg_img      = $menu_right_bg['background-image'];
	    	$menu_left_bg_repeat   = $menu_right_bg['background-repeat'];
	    	$menu_left_bg_attach   = $menu_right_bg['background-attachment'];
	    	$menu_left_bg_pos      = $menu_right_bg['background-position'];
	    	$menu_left_bg_size     = $menu_right_bg['background-size'];
	        if($menu_left_bg_color) {
	            $menu_left_bg_color = 'background-color: '.$menu_left_bg_color.';';
	        } else { $menu_left_bg_color = ''; }
	        if($menu_left_bg_img) {
	            $menu_left_bg_img = 'background-image:url('.$menu_left_bg_img.');';
	        } else { $menu_left_bg_img = ''; }
	        if($menu_left_bg_repeat) {
	            $menu_left_bg_repeat = 'background-repeat: '.$menu_left_bg_repeat.';';
	        } else { $menu_left_bg_repeat = ''; }
	        if($menu_left_bg_attach) {
	            $menu_left_bg_attach = 'background-attachment: '.$menu_left_bg_attach.';';
	        } else { $menu_left_bg_attach = ''; }
	        if($menu_left_bg_pos) {
	            $menu_left_bg_pos = 'background-position: '.$menu_left_bg_pos.';';
	        } else { $menu_left_bg_pos = ''; }
	        if($menu_left_bg_size) {
	            $menu_left_bg_size = 'background-size: '.$menu_left_bg_size.';';
	        } else { $menu_left_bg_size = ''; }
	    } else {
	    	$menu_left_bg_color    = '';
	    	$menu_left_bg_img      = '';
	    	$menu_left_bg_repeat   = '';
	    	$menu_left_bg_attach   = '';
	    	$menu_left_bg_pos      = '';
	    	$menu_left_bg_size     = '';
	    }
	    // Left and Right Classes
	    if ($menu_position == 'menu_pos_right') {
	    	$menu_position_class = 'right-menu-wrap menu-right';
	    } elseif($menu_position == 'menu_pos_left') {
	    	$menu_position_class = 'left-menu-wrap';
	    }
?>
<div class="<?php echo esc_attr($menu_position_class); ?>" style="<?php echo esc_attr($menu_left_bg_color).esc_attr($menu_left_bg_img).esc_attr($menu_left_bg_repeat).esc_attr($menu_left_bg_attach).esc_attr($menu_left_bg_pos).esc_attr($menu_left_bg_size); ?>">
    <div class="port-logo">
    	<?php
        $retina_logo = ot_get_option('retina_logo_upload');
        $default_logo = ot_get_option('logo_upload');
		$front_cus_enable = ot_get_option('front_cus_enable');
        $front_logo_upload = ot_get_option('front_logo_upload');
        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');
		if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
			if($retina_logo != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }
		if(!is_front_page() && $default_logo != '') {
			if($retina_logo) { ?>
			    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page() && $default_logo =='') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } ?>
    </div>
	<div class="left-menu-list">
	<?php
	$menu_position = ot_get_option('menu_position');
	$which_page_is_portfolio = ot_get_option('which_page_is_portfolio');
	if( ($menu_position == 'menu_pos_left' || $menu_position == 'menu_pos_right') ) {
		if ($which_page_is_portfolio) {
			$portfolio_name = ot_get_option('portfolio_name');
			if($portfolio_name) {
				$portfolio_name = $portfolio_name;
			} else {
				$portfolio_name = __('Portfolio', 'juster');
			}
	?>
	<ul class="left-menu port-filter-menu">
		<li class="menu-item menu-item-type-custom menu-item-object-custom">
		    <?php
	    	if (is_page($which_page_is_portfolio)) {
		    ?>
			<span class="jt-cross-over"><?php echo esc_attr($portfolio_name); ?></span>
			<ul id="filters" class="port-filter">
				<li>
					<a data-filter="*" class="filter" href="#0"><?php echo __('All', 'juster'); ?> [<span class="jt_cat_count_port"></span>]</a>
				</li>
				<?php
				    $terms = get_terms('portfolio_category');
				    $count = count($terms);
				    $i=0;
				    $term_list = '';
				    if ($count > 0) {
				        foreach ($terms as $term) {
				            $i++;
				            $term_list .= '<li><a href="#0" class="filter cat-'. $term->slug .'" data-filter=".cat-'. $term->slug .'" title="' . esc_attr($term->name) . '">' . $term->name . ' [<span class="jt_cat_count_port">'. $term->count .'</span>]</a></li>';
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
		    <?php } // if is that selected portfolio page.
		    else { ?>
		    	<a href="<?php echo esc_url( get_permalink($which_page_is_portfolio) ); ?>"><?php echo esc_attr($portfolio_name); ?></a>
		    <?php } // if this page is not a selected portfolio page. ?>
		</li>
	</ul>
	<?php } // Which Page is Portfolio?
	} // Menu Position
	global $post;
    if (is_page()) {
    	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
        if ($choose_menu) {
        	$jt_choose_menu = $choose_menu;
        } else {
        	$jt_choose_menu = '';
        }
    } else {
    	$jt_choose_menu = '';
    }
    wp_nav_menu(
        array(
            'walker'            => new wp_bootstrap_navwalker(),
            'theme_location'    => 'main-menu',
            'menu'    			=> $jt_choose_menu,
            'menu_class'        => 'left-menu',
            'container_class'   => 'menu-main-menu-container',
            'fallback_cb'       => false,
            'sub_menu'			=> true,
            'depth'				=> 0
        )
    );
    ?>
    </div>
    <div class="contact-wrap">
        <div class="widget">
            <?php
            $menu_position = ot_get_option('menu_position');
            if( $menu_position == 'menu_pos_left' ) {
            	dynamic_sidebar( 'leftside-menu' );
            } elseif( $menu_position == 'menu_pos_right' ) {
            	dynamic_sidebar( 'rightside-menu' );
            }
            ?>
        </div>
    </div>
</div>
<!-- Slim Menu -->
<div class="hidden-side-big-screen">
	<div class="sticky-nav jt-top-white">
    	<?php
        $retina_logo = ot_get_option('retina_logo_upload');
        $default_logo = ot_get_option('logo_upload');
		$front_cus_enable = ot_get_option('front_cus_enable');
        $front_logo_upload = ot_get_option('front_logo_upload');
        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');
		if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
			if($retina_logo != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }
		if(!is_front_page() && $default_logo != '') {
			if($retina_logo) { ?>
			    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page() && $default_logo =='') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } ?>
		<ul id="menu-main-menu" class="nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-side-menu">
			<?php
			$menu_position = ot_get_option('menu_position');
			$which_page_is_portfolio = ot_get_option('which_page_is_portfolio');
			if( ($menu_position == 'menu_pos_left' || $menu_position == 'menu_pos_right') ) {
				if ($which_page_is_portfolio) {
					$portfolio_name = ot_get_option('portfolio_name');
					if($portfolio_name) {
						$portfolio_name = $portfolio_name;
					} else {
						$portfolio_name = __('Portfolio', 'juster');
					}
			?>
			<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  dropdown">
			    <?php
		    	if (is_page($which_page_is_portfolio)) {
			    ?>
			    <a href="#" data-toggle="dropdown" class="dropdown-toggle sub-collapser"><?php echo esc_attr($portfolio_name); ?> <b class="caret"></b><b class="caret"></b></a>
			     <ul id="filters-slim" class="port-filter dropdown-menu">
			        <li class="menu-item menu-item-type-custom menu-item-object-custom"><a data-filter="*" class="filter" href="#0"><?php echo __('All', 'juster'); ?></a></li>
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
			    <?php } // if is that selected portfolio page.
			    else { ?>
			    	<a href="<?php echo esc_url( get_permalink($which_page_is_portfolio) ); ?>"><?php echo esc_attr($portfolio_name); ?></a>
			    <?php } // if this page is not a selected portfolio page. ?>
			</li>
			<?php } // Which Page is Portfolio?
			} // Menu Position
			global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
	        wp_nav_menu(
	            array(
	                'walker'            => new wp_bootstrap_navwalker(),
	                'theme_location'    => 'main-menu',
	                'menu'    			=> $jt_choose_menu,
		            'menu_class'        => '',
	                'container'  		=> false,
	                'fallback_cb'       => false,
	                'sub_menu'			=> true,
	                'depth'				=> 5
	            )
	        );
	        ?>
		</ul>
	</div>
</div>
<!-- /Slim Menu -->
<?php
	}
}

/*==============================================================
	Header - Freelancer Header / Header With Outer Space
===============================================================*/
if ( ! function_exists( 'header_outer_space' ) ) {
	function header_outer_space() {
	global $post;
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }

$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );

if($banner_type_mt != '' && $banner_color_mt != '') {
	$banner_color = $banner_color_mt;
} elseif($banner_type_ot != '' && $banner_color_ot != '') {
	$banner_color = $banner_color_ot;
} else {
	$banner_color = '';
}
if(is_singular('portfolio')) {
	if($single_port_gallery != '') {
		$single_port_header_height = '';
	} elseif($single_port_gallery == '') {
		$single_port_header_height = 'style="min-height: 110px;"';
	} else {
		$single_port_header_height = '';
	}
} else {
	$single_port_header_height = '';
}
	$banner_type_ot = ot_get_option('banner_type');
    $banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
    if (is_page()) {
    	if ($banner_type_mt == 'jt_hide_ban') {
    		$page_hav_banner = 'page_hav_banner ';
    	} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
    		$page_hav_banner = 'page_hav_banner ';
    	} else {
    		$page_hav_banner = '';
    	}
    } elseif(!is_page()) {
    	if ($banner_type_ot == 'jt_hide_ban') {
    		$page_hav_banner = 'page_hav_banner ';
    	} else {
    		$page_hav_banner = '';
    	}
    }
?>
<div class="<?php echo esc_attr($layout_structure); ?> padding-zero">
    <div class="jt-page-header jt-blog-page jt-freelance-head <?php echo $page_hav_banner; ?>" <?php echo esc_attr($single_port_header_height); ?>>
        <div class="jt-blog-logo">
        <?php if( !is_page_template( 'template-one-page-architecture.php' ) ) { ?>
        <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
        <?php }

		$sticky_header = ot_get_option('sticky_header');
		if($sticky_header == 'on') {
		    $sticky_header  = 'sticky-nav';
		} else {
		    $sticky_header = '';
		}
		?>
        <!-- Header Logo and Menus -->
        <header id="<?php echo esc_attr($sticky_header); ?>" class="sticky-nav">
            <nav class="navbar navbar-default navbar-static-top">
                <!-- Brand and toggle get grouped for better mobile display -->
	            <div class="navbar-header">
	                <?php
	                $retina_logo = ot_get_option('retina_logo_upload');
	                $default_logo = ot_get_option('logo_upload');
					$front_cus_enable = ot_get_option('front_cus_enable');
	                $front_logo_upload = ot_get_option('front_logo_upload');
	                $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

					if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_attr($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_attr($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
						if($retina_logo != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }

					if(!is_front_page() && $default_logo != '') {
						if($retina_logo) { ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page() && $default_logo =='') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
						  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } ?>
	    		</div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="main-nav" class="collapse navbar-collapse">
					<?php
					$head_search = ot_get_option('search_enable');
					$head_cart = ot_get_option('cart_enable');
					$head_lang = ot_get_option('lang_enable');
					if( $head_search == 'on' || $head_cart == 'on' || $head_lang == 'on' ) {
					?>
					<div class="menu-metas navbar-default navbar-right">
					    <ul class="navbar-nav">
					    	<?php if( $head_search == 'on' ) { ?>
					        <li id="top-search" class="jt-menu-search">
					            <a href="#0" id="top-search-trigger">
					                <i class="fa fa-search"></i>
					                <i class="pe-7s-close"></i>
					            </a>
					            <form class="container" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" method="get">
					                <input type="text" name="s" class="form-control" value="" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
					            </form>
					        </li>
					        <?php } else { }
					        if( $head_lang == 'on' ) {
			                	dynamic_sidebar( 'lang_widget' );
			            	}
					        if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
					        <li id="jt-top-cart" class="jt-menu-cart">
					            <?php woocommerce_cart_button(); ?>
					            <div class="top-cart-content">
					            	<?php woocommerce_cart_widget(); ?>
					            </div>
					        </li>
					        <?php } else { } ?>
					    </ul>
					</div>
					<?php }
					global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
					wp_nav_menu(
					    array(
					        'walker'            => new wp_bootstrap_navwalker(),
					        'theme_location'    => 'main-menu',
					        'menu'    			=> $jt_choose_menu,
					        'menu_class'        => 'nav navbar-nav navbar-right jt-main-nav',
					        'menu_id'           => 'menu-create-menu',
					        'container_class'   => 'collapse navbar-collapse menu-main-menu-container',
					        'container_id'      => 'main-nav',
					        'fallback_cb'       => false,
					    )
					);
					?>
                </div>
                <!-- Main Nav -->
            </nav>
		    <!-- Slim Menu -->
		    <div class="hidden-big-screen">
		        <div class="jt-slim-top">
	                <?php
	                $retina_logo = ot_get_option('retina_logo_upload');
	                $default_logo = ot_get_option('logo_upload');
					$front_cus_enable = ot_get_option('front_cus_enable');
	                $front_logo_upload = ot_get_option('front_logo_upload');
	                $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

					if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
						if($retina_logo != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }

					if(!is_front_page() && $default_logo != '') {
						if($retina_logo) { ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page() && $default_logo =='') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
						  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }
					global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
		            wp_nav_menu(
		                array(
		                    'walker'            => new wp_bootstrap_navwalker(),
		                    'theme_location'    => 'main-menu',
		                    'menu'    			=> $jt_choose_menu,
		                    'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
		                    'menu_id'           => 'menu-main-menu',
		                    'container_class'   => 'menu-main-menu-container',
		                    'fallback_cb'       => false,
		                    'sub_menu' 			=> true,
                            'depth' 			=> 5
		                )
		            );
		            $head_search = ot_get_option('search_enable');
		            $head_cart = ot_get_option('cart_enable');
		            $head_lang = ot_get_option('lang_enable');
		            if( $head_search == 'on' || $head_cart == 'on' || $head_lang == 'on' ) {
		            ?>
		            <div class="menu-metas navbar-default navbar-right jt-slim-meta">
		            	<ul class="navbar-nav">
		            	<?php if( $head_search == 'on' ) { ?>
		            	    <li id="top-search-slim" class="jt-menu-search">
		            	        <a href="#0" id="top-search-trigger-slim">
		            	            <i class="fa fa-search"></i>
		            	            <i class="pe-7s-close"></i>
		            	        </a>
		            	        <form class="container search-new" method="get" action="<?php echo esc_url(home_url('/')); ?>" >
		            	            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
		            	        </form>
		            	    </li>
		            	<?php } else { }
		            	if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
		            	    <li id="jt-top-cart-slim" class="jt-menu-cart-slim">
		            	        <?php woocommerce_cart_button_slim(); ?>
		            	        <div class="top-cart-content">
		            	            <?php woocommerce_cart_widget(); ?>
		            	        </div>
		            	    </li>
		            	<?php } else { } ?>
		            	</ul>
		            </div>
		            <?php } ?>
				</div>
			</div>
		    <!-- /Slim Menu -->
        </header>
        <!-- Header Logo and Menus -->
        <!-- Banner -->

<?php
// Hide Banner if Page is Hide Banner
if (is_page()) {
	if ($banner_type_mt == 'jt_hide_ban') {
		$jt_banner_cover = 'jt_banner_cover ';
	} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
		$jt_banner_cover = 'jt_banner_cover ';
	} else {
		$jt_banner_cover = '';
	}
} elseif(!is_page()) {
	if ($banner_type_ot == 'jt_hide_ban') {
		$jt_banner_cover = 'jt_banner_cover ';
	} else {
		$jt_banner_cover = '';
	}
}
if(!is_singular('portfolio')) {
	if( !is_page_template( 'template-one-page-architecture.php' ) ) {

		if($banner_type_mt == 'img_ban' && $banner_image_mt) {
			$img=0;
			foreach($banner_image_mt as $ban_img_mt) {
				$img++;
			}
			if($img <= 1) {
				foreach($banner_image_mt as $vint_ban_mt) {
			?>
				<div class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
				</div>
			<?php }
			} elseif($img >= 2) { ?>
				<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
					<ul class="slider jt-animated-hand">
					    <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					            </div>
					        </li>
					    <?php } ?>
					</ul>
				</div>
		<?php }
		} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
			$spc=0;
			foreach($special_banner_image_mt as $ban_spc_mt) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
			        <?php } ?>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
		<?php }
		} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
		        $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
		        $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
		        $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
		        $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
		        $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
		        $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
		        $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
		<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
				echo do_shortcode($banner_slide_mt);
			} elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
		        echo do_shortcode($banner_shortcode_mt);
		    } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) {
    	    	$img=0;
    			foreach($banner_image_ot as $ban_img_ot) {
    				$img++;
    			}
    			if($img <= 1) {
		    		foreach($banner_image_ot as $vint_ban_ot) {
		    	?>
			    	<div class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
			        </div>
		    	<?php }
		    	} elseif($img >= 2) { ?>
		    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
		        </div>
		<?php }
		} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
			$spc=0;
			foreach($special_banner_image_ot as $ban_spc_ot) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
			        <?php } ?>
			        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
		<?php }
		} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
		        $vid_ban_control = ot_get_option('vid_ban_control');
		        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
		        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
		        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
		        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
		        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
		<?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
		    echo do_shortcode($banner_slide_ot);
			} else {
				if($layout_structure == 'container') {
		?>
				<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
				    <ul class="slider jt-animated-hand">
				        <li class="slide">
				            <div class="slide-bg">
				                <img src="<?php echo IMAGES; ?>/dummy/freelancer-banner-center.jpg" alt="">
				            </div>
				        </li>
				    </ul>
			    </div>
		<?php } elseif($layout_structure == 'container-fluid') { ?>
				<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo $jt_banner_cover; ?>">
				    <ul class="slider jt-animated-hand">
				        <li class="slide">
				            <div class="slide-bg">
				                <img src="<?php echo IMAGES; ?>/dummy/freelancer-banner.jpg" alt="">
				            </div>
				        </li>
				    </ul>
			    </div>
			<?php }
			}

		$breadcrumbs = ot_get_option('breadcrumbs');
	    $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', 'true' );
	    $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', 'true' );
	    $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', 'true' );
	    $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', 'true' );

		if($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-1null';
		} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-2null';
		} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-3null';
		} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-4null';
		} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-5null';
		} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-6null';
		} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-7null';
		} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-8null';
		} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-9null';
		} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-10null';
		} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-11null';
		} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-12null';
		} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-13null';
		} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-14null';
		} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
			$ban_text = 'jt-main-bantext-15null';
		} else {
			$ban_text = '';
		}

	    $page_title = ot_get_option('page_title');
	    $banner_type_ot = ot_get_option('banner_type');
	    $banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
	    if(is_page() && $banner_type_mt != 'sld_ban') {
	    	// Hide Banner Title If Banner is Hide
	    	if ($banner_type_mt == 'jt_hide_ban') {
	    		$page_hide_title = 'page_hide_title ';
	    	} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
	    		$page_hide_title = 'page_hide_title ';
	    	} else {
	    		$page_hide_title = '';
	    	}
	    ?>
	    	<div class="jt-page-banner <?php echo esc_attr($page_hide_title); echo esc_attr($ban_text); ?>">
				<?php if ($page_title != 'off' && $enable_new_page_title == 'off') {
					if(is_front_page()) { ?>
			    		<h2 class="page_heading"><?php bloginfo(''); ?></h2>
			    	<?php } else { ?>
			    		<h2 class="page_heading"><?php the_title(); ?></h2>
			    	<?php }
				} elseif($enable_new_page_title == 'on') {
					if($new_page_title != '') { ?>
						<h2 class="page_heading"><?php echo esc_attr($new_page_title); ?></h2>
					<?php } elseif($new_page_title == '') { ?>
						<h2 class="page_heading"><?php echo the_title(); ?></h2>
					<?php } elseif($page_title == 'off' && $new_page_title == '') {}
				} // Page Title Hide
				if($page_subheading) {
		        	echo '<h3 class="page_sub_heading">'.esc_attr($page_subheading).'</h3>';
		        }
		        $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', 'true' );
		        if($header_banner_title_img !='') {
		        	echo '<div class="jt-main-ban-tit">';
		        	echo '<img src="'. esc_attr($header_banner_title_img) .'" alt="">';
		        	echo '</div>';
		        } ?>
			    <div class="jt-breadcrumbs">
			    	<?php
			        $breadcrumbs = ot_get_option('breadcrumbs');
			        if($breadcrumbs == 'on') {
			            echo breadcrumb_trail();
			        }
			        ?>
			    </div>
			</div>
	    <?php } elseif(!is_page() && $banner_type_ot != 'jt_hide_ban' && $banner_type_ot != 'sld_ban') {
	    ?>
	    	<div class="jt-page-banner <?php echo esc_attr($ban_text); ?>">
				<?php
				if ($page_title != 'off') {
					if(is_front_page()) { ?>
				    	<h2 class="page_heading"><?php bloginfo(''); ?></h2>
				    <?php } elseif (is_author()) { ?>
						<h2 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h2>
					<?php
						} elseif (is_search()) { ?>
						<h2 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h2>
					<?php
						} elseif (is_archive()) { ?>
	                        <h2 class="page_heading"><?php if ( is_day() ) {
	                                printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
	                            } elseif ( is_month() ) {
	                                printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
	                            } elseif ( is_year() ) {
	                                printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
	                            } else {
	                                echo __( 'Archives', 'juster' );
	                            } ?></h2>
	                    <?php
	                    } elseif (is_category()) { ?>
							<h2 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h2>
					<?php
						} elseif (is_tag()) { ?>
							<h2 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h2>
					<?php
						} elseif(is_home()) { ?>
							<h2 class="page_heading"><?php bloginfo(''); ?></h2>
					<?php
						} else { ?>
							<h2 class="page_heading"><?php the_title(); ?></h2>
					<?php
						}
				} // Hide Page Title ?>
			    <div class="jt-breadcrumbs">
			    	<?php
			        $breadcrumbs = ot_get_option('breadcrumbs');
			        if($breadcrumbs == 'on') {
			            echo breadcrumb_trail();
			        }
			        ?>
			    </div>
			</div>
	    <?php }

		if( (is_page() && $banner_type_mt != 'sld_ban') || (!is_page() && $banner_type_ot != 'sld_ban') ) {
			echo juster_banner_anim();
		}

	} // !template-one-page-architecture
} elseif(is_singular('portfolio')) { // single portfolio slider on header
	$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	if($single_port_gallery != '') { ?>
		<div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($single_port_gallery as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
} // single-portfolio
?>
	    </div>
	</div>
</div>
<?php
	}
}

/*==============================================================
	Header - Business Header / Header With Top Bar
===============================================================*/
if ( ! function_exists( 'header_with_topbar' ) ) {
	function header_with_topbar() {
	global $post;
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }
    $menu_position = ot_get_option('menu_position');
	$sticky_header = ot_get_option('sticky_header');
	if($sticky_header == 'on' && $menu_position == 'header_with_topbar') {
	    $sticky_header  = 'sticky-nav';
	} else {
	    $sticky_header = '';
	}
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );

$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );

if($banner_type_mt != '' && $banner_color_mt != '') {
	$banner_color = $banner_color_mt;
} elseif($banner_type_ot != '' && $banner_color_ot != '') {
	$banner_color = $banner_color_ot;
} else {
	$banner_color = '';
}
if(is_singular('portfolio')) {
	if($single_port_gallery != '') {
		$single_port_header_height = '';
	} elseif($single_port_gallery == '') {
		$single_port_header_height = 'style="min-height: 140px;"';
	} else {
		$single_port_header_height = '';
	}
} else {
	$single_port_header_height = '';
}
?>
<div class="<?php echo esc_attr($layout_structure); ?> padding-zero jt-bussiness-head-cont">
    <div class="jt-page-header jt-header-three jt-blog-page" <?php echo esc_attr($single_port_header_height); ?>>
        <!-- Header Logo and Menus -->
        <header id="<?php echo esc_attr($sticky_header); ?>" class="sticky-nav">
            <div class="widget jt-top-header">
                <div class="container">
                    <div class="jt-top-left-bar">
                        <div class="jt-each-top-left">
                            <?php dynamic_sidebar( 'topleft-widget' ); ?>
                        </div>
                    </div>
                    <div class="jt-top-right-bar">
                        <div class="jt-each-top-right">
                            <?php dynamic_sidebar( 'topright-widget' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <?php
                        $retina_logo = ot_get_option('retina_logo_upload');
                        $default_logo = ot_get_option('logo_upload');
						$front_cus_enable = ot_get_option('front_cus_enable');
		                $front_logo_upload = ot_get_option('front_logo_upload');
		                $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

						if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
							if($front_retina_logo_upload != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
							if($front_retina_logo_upload != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
							if($retina_logo != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page()) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php }

						if(!is_front_page() && $default_logo != '') {
							if($retina_logo) { ?>
							    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
							        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							    </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
							  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							</a>
						<?php } elseif(!is_front_page() && $default_logo =='') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
							  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							</a>
						<?php } elseif(!is_front_page()) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
                    </div>
                    <div id="main-nav" class="collapse navbar-collapse">
						<?php
						global $post;
			            if (is_page()) {
			            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
				            if ($choose_menu) {
				            	$jt_choose_menu = $choose_menu;
				            } else {
				            	$jt_choose_menu = '';
				            }
			            } else {
			            	$jt_choose_menu = '';
			            }
                        wp_nav_menu(
                            array(
                                'walker'            => new wp_bootstrap_navwalker(),
                                'theme_location'    => 'main-menu',
                                'menu'    			=> $jt_choose_menu,
                                'menu_class'        => 'nav navbar-nav navbar-left jt-main-nav',
                                'menu_id'           => 'menu-create-menu',
		                    	'container_class'   =>'collapse navbar-collapse navbar-left menu-main-menu-container',
                                'fallback_cb'       => false,
                            )
                        );
						$head_search = ot_get_option('search_enable');
						$head_cart = ot_get_option('cart_enable');
						$head_lang = ot_get_option('lang_enable');
						if( $head_search == 'on' || $head_cart == 'on' || $head_lang == 'on' ) {
						?>
                        <div class="menu-metas navbar-default navbar-right">
                            <ul class="navbar-nav">
								<?php if( $head_search == 'on' ) { ?>
								    <li id="top-search" class="jt-menu-search">
								        <a href="#0" id="top-search-trigger">
								            <i class="fa fa-search"></i>
								            <i class="pe-7s-close"></i>
								        </a>
								        <form class="container search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" >
								            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
								        </form>
								    </li>
								<?php } else { }
								if( $head_lang == 'on' ) {
				                	dynamic_sidebar( 'lang_widget' );
				            	}
								if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
				                    <li id="jt-top-cart" class="jt-menu-cart">
				                        <?php woocommerce_cart_button(); ?>
				                        <div class="top-cart-content">
				                            <?php woocommerce_cart_widget(); ?>
				                        </div>
				                    </li>
				                <?php } else { } ?>
                            </ul>
                        </div>
		            	<?php } ?>
                    </div>
                    <!-- Main Nav -->
                </div><!-- /.container -->
            </nav>
        </header>
        <!-- Header Logo and Menus -->

<!-- Added for Slimmenu -->
<div class="hidden-big-screen ">
    <div class="sticky-nav jt-slim-top">
        <div class="widget jt-top-header">
            <div class="container jt-slim-top-header">
                <div class="jt-top-left-bar">
                    <div class="jt-each-top-left">
						<?php dynamic_sidebar( 'topleft-widget' ); ?>
                    </div>
                </div>
                <div class="jt-top-right-bar">
                    <div class="jt-each-top-right">
                    	<?php dynamic_sidebar( 'topright-widget' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $retina_logo = ot_get_option('retina_logo_upload');
        $default_logo = ot_get_option('logo_upload');
		$front_cus_enable = ot_get_option('front_cus_enable');
        $front_logo_upload = ot_get_option('front_logo_upload');
        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

		if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
			if($retina_logo != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }

		if(!is_front_page() && $default_logo != '') {
			if($retina_logo) { ?>
			    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page() && $default_logo =='') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }
		global $post;
        if (is_page()) {
        	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
            if ($choose_menu) {
            	$jt_choose_menu = $choose_menu;
            } else {
            	$jt_choose_menu = '';
            }
        } else {
        	$jt_choose_menu = '';
        }
        wp_nav_menu(
            array(
                'walker'            => new wp_bootstrap_navwalker(),
                'theme_location'    => 'main-menu',
                'menu'    			=> $jt_choose_menu,
                'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
                'menu_id'           => 'menu-main-menu',
                'container_class'   => 'menu-main-menu-container',
                'fallback_cb'       => false,
                'sub_menu' 			=> true,
                'depth' 			=> 5
            )
        );
        ?>
        <!-- Cart and search icon for slim menu new class(jt-slim-meta) -->
        <div class="menu-metas navbar-default navbar-right jt-slim-meta">
        	<?php if( $head_lang == 'on' ) {
            	dynamic_sidebar( 'lang_widget' );
        	} ?>
			<ul class="navbar-nav">
				<?php if( $head_search == 'on' ) { ?>
				    <li id="top-search-slim" class="jt-menu-search">
				        <a href="#0" id="top-search-trigger-slim">
				            <i class="fa fa-search"></i>
				            <i class="pe-7s-close"></i>
				        </a>
				        <form class="container search-new" method="get" action="<?php echo esc_url(home_url('/')); ?>" >
				            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
				        </form>
				    </li>
				<?php } else { }
				if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
			        <li id="jt-top-cart-slim" class="jt-menu-cart-slim">
			            <?php woocommerce_cart_button_slim(); ?>
			            <div class="top-cart-content">
			                <?php woocommerce_cart_widget(); ?>
			            </div>
			        </li>
			    <?php } else { } ?>
			</ul>
        </div>
    </div>
</div>
<!-- Added for Slimmenu -->

<?php
if(!is_singular('portfolio')) {
	if(!is_page_template('template-one-page-architecture.php')) {
		if($banner_type_mt == 'img_ban' && $banner_type_mt != 'jt_hide_ban' && $banner_image_mt) {
			$img=0;
			foreach($banner_image_mt as $ban_img_mt) {
				$img++;
			}
			if($img <= 1) { ?>
				<div class="slider-container jt-vintage-banner jt-vint-small-banner">
					<?php foreach($banner_image_mt as $vint_ban_mt) { ?>
					<div class="jt-animated-hand" style="background: url('<?php echo $vint_ban_mt['ban_img_mt'] ?>'); background-size: cover;">
					</div>
					<?php } ?>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
				</div>
			<?php } elseif($img >= 2) { ?>
				<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
					<ul class="slider jt-animated-hand">
					    <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="">
					            </div>
					        </li>
					    <?php } ?>
					</ul>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
				</div>
		<?php }
		} elseif($banner_type_mt == 'spc_ban' && $banner_type_mt != 'jt_hide_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
			$spc=0;
			foreach($special_banner_image_mt as $ban_spc_mt) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
			        <?php } ?>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
				</div>
		<?php }
		} elseif($banner_type_mt == 'vid_ban' && $banner_type_mt != 'jt_hide_ban' && $banner_video_mt != '') {
	        $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
	        $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
	        $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
	        $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
	        $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
	        $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
	        $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
	        if($vid_ban_control) {
	            $vid_ban_control = 'true';
	        } else {
	            $vid_ban_control = 'false';
	        }
	        if($vid_ban_auto_play) {
	            $vid_ban_auto_play = 'true';
	        } else {
	            $vid_ban_auto_play = 'false';
	        }
	        if($vid_ban_vid_loop) {
	            $vid_ban_vid_loop = 'true';
	        } else {
	            $vid_ban_vid_loop = 'false';
	        }
	        if($vid_ban_aud_mute) {
	            $vid_ban_aud_mute = 'true';
	        } else {
	            $vid_ban_aud_mute = 'false';
	        }
	        if($vid_ban_start_time) {
	            $vid_ban_start_time = $vid_ban_start_time;
	        } else {
	            $vid_ban_start_time = '0';
	        }
	        if($vid_ban_vid_qty) {
	            $vid_ban_vid_qty = $vid_ban_vid_qty;
	        } else {
	            $vid_ban_vid_qty = 'default';
	        }
	    ?>
	    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
	        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
	        </a>
			<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
		</div>
		<?php } elseif($banner_type_mt == 'sld_ban' && $banner_type_mt != 'jt_hide_ban' && $banner_slide_mt != '') { ?>
			<div class="slider-container jt-vintage-banner jt-vint-small-banner banner-rev-slide">
				<?php echo do_shortcode($banner_slide_mt); ?>
				<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			</div>
		<?php } elseif($banner_type_mt == 'shortcode_ban' && $banner_type_mt != 'jt_hide_ban' && $banner_shortcode_mt != '') { ?>
			<div class="slider-container jt-vintage-banner jt-vint-small-banner">
				<?php echo do_shortcode($banner_shortcode_mt); ?>
				<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			</div>

	    <?php } elseif( $banner_type_mt != 'jt_hide_ban' && $banner_type_ot == 'img_ban') {
	    	$img=0;
			foreach($banner_image_ot as $ban_img_ot) {
				$img++;
			}
			if($img <= 1) { ?>
		    	<div class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
			        </div>
			        <?php } ?>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
		        </div>
	    	<?php } elseif($img >= 2) { ?>
		    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
		        </div>
		<?php }
		} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
			$spc=0;
			foreach($special_banner_image_ot as $ban_spc_ot) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
			        <?php } ?>
			        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
					<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
				</div>
		<?php }
		} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
		    $vid_ban_control = ot_get_option('vid_ban_control');
		    $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
		    $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
		    $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
		    $vid_ban_start_time = ot_get_option('vid_ban_start_time');
		    $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
		    if($vid_ban_control) {
		        $vid_ban_control = 'true';
		    } else {
		        $vid_ban_control = 'false';
		    }
		    if($vid_ban_auto_play) {
		        $vid_ban_auto_play = 'true';
		    } else {
		        $vid_ban_auto_play = 'false';
		    }
		    if($vid_ban_vid_loop) {
		        $vid_ban_vid_loop = 'true';
		    } else {
		        $vid_ban_vid_loop = 'false';
		    }
		    if($vid_ban_aud_mute) {
		        $vid_ban_aud_mute = 'true';
		    } else {
		        $vid_ban_aud_mute = 'false';
		    }
		    if($vid_ban_start_time) {
		        $vid_ban_start_time = $vid_ban_start_time;
		    } else {
		        $vid_ban_start_time = '0';
		    }
		    if($vid_ban_vid_qty) {
		        $vid_ban_vid_qty = $vid_ban_vid_qty;
		    } else {
		        $vid_ban_vid_qty = 'default';
		    }
		?>
		<div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		    <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		    </a>
			<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
		</div>
		<?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') { ?>
			<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner banner-rev-slide">
				<?php echo do_shortcode($banner_slide_ot); ?>
				<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			</div>
		<?php } else {}

	} // !template-one-page-architecture

	$breadcrumbs = ot_get_option('breadcrumbs');
    $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', 'true' );
    $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', 'true' );
    $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', 'true' );
    $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', 'true' );

	if($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-1null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-2null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-3null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-4null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-5null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-6null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-7null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-8null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-9null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-10null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
		$ban_text = 'jt-main-bantext-11null';
	} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-12null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-13null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-14null';
	} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
		$ban_text = 'jt-main-bantext-15null';
	} else {
		$ban_text = '';
	}
	if(!is_page_template('template-one-page-architecture.php')) {
		$page_title = ot_get_option('page_title');
		if(is_page() && $banner_type_mt != 'sld_ban') {
			if(is_front_page() && $enable_new_page_title == 'off') {
				$front_class = 'front ';
			} else {
				$front_class = '';
			}
			// Hide Banner Title If Banner is Hide
			if ($banner_type_mt == 'jt_hide_ban') {
				$page_hide_title = 'page_hide_title';
			} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
				$page_hide_title = 'page_hide_title';
			} else {
				$page_hide_title = '';
			}
	if ($page_hide_title != 'page_hide_title') {
	?>
		<div class="jt-business-banner-content <?php echo esc_attr($front_class); echo esc_attr($ban_text); ?>">
			<?php if ($page_title != 'off' && $enable_new_page_title == 'off') {
					if(is_front_page()) { ?>
			    		<h1 class="page_heading"><?php bloginfo(''); ?></h1>
			    	<?php } else { ?>
			    		<h1 class="page_heading"><?php the_title(); ?></h1>
			    	<?php }
				} elseif($enable_new_page_title == 'on') {
					if($new_page_title != '') { ?>
						<h1 class="page_heading"><?php echo esc_attr($new_page_title); ?></h1>
					<?php } elseif($new_page_title == '') { ?>
						<h1 class="page_heading"><?php echo the_title(); ?></h1>
					<?php } elseif($page_title == 'off' && $new_page_title == '') {}
				} // Page Title Hide
			if($page_subheading) {
				echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
			}
			$header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', 'true' );
			if($header_banner_title_img !='') {
				echo '<img src="'. esc_attr($header_banner_title_img) .'" alt="">';
			} ?>
			<div class="jt-breadcrumbs">
				<?php
			    $breadcrumbs = ot_get_option('breadcrumbs');
			    if($breadcrumbs == 'on') {
			        echo breadcrumb_trail();
			    }
			    ?>
			</div>
		</div>
	<?php }
	} elseif(!is_page() && $banner_type_ot != 'sld_ban' && $banner_type_ot != 'jt_hide_ban') { ?>
		<div class="jt-business-banner-content not-page">
			<?php
			if ($page_title != 'off') {
				if(is_front_page()) { ?>
			    	<h1 class="page_heading"><?php bloginfo(''); ?></h1>
			    <?php } elseif (is_author()) { ?>
					<h1 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
				<?php
					} elseif (is_archive()) { ?>
					<h1 class="page_heading"><?php if ( is_day() ) {
							printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
						} else {
							echo __( 'Archives', 'juster' );
						} ?></h1>
				<?php
					} elseif (is_search()) { ?>
					<h1 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h1>
				<?php
					} elseif (is_category()) { ?>
						<h1 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
				<?php
					} elseif (is_tag()) { ?>
						<h1 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
				<?php
					} elseif(is_home()) { ?>
						<h1 class="page_heading"><?php bloginfo(''); ?></h1>
				<?php
					} else { ?>
						<h1 class="page_heading"><?php the_title(); ?></h1>
				<?php
					}
			} // Hide Page Title ?>
        	<div class="jt-breadcrumbs">
        		<?php
        	    $breadcrumbs = ot_get_option('breadcrumbs');
        	    if($breadcrumbs == 'on') {
        	        echo breadcrumb_trail();
        	    }
        	    ?>
        	</div>
		</div>
	<?php
		}
	} // !tempalte-one-page-architecture
}  elseif(is_singular('portfolio')) { // single portfolio slider on header
	$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	if($single_port_gallery != '') { ?>
		<div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($single_port_gallery as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
} // single-portoflio

if(!is_singular('portfolio')) {
	if(!is_page_template('template-one-page-architecture.php')) {
		if( (is_page() && $banner_type_mt != 'sld_ban') || (!is_page() && $banner_type_ot != 'sld_ban') ) {
			echo juster_banner_anim();
		}
	} // !single-portfolio
} // !template-one-page-architecture
?>
    </div>
</div>
	<?php
	}
}

/*==============================================================
	Header - Photography Header / Header With Outer Margin
===============================================================*/
if ( ! function_exists( 'menu_pos_left_margin' ) ) {
	function menu_pos_left_margin() {
	global $post;
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }
    $menu_position = ot_get_option('menu_position');
    $menu_left_bg = ot_get_option('menu_left_bg');
    $menu_right_bg = ot_get_option('menu_right_bg');
    if( $menu_position == 'menu_pos_left_margin' && $menu_left_bg!='' ) {
    	$menu_left_bg_color    = $menu_left_bg['background-color'];
    	$menu_left_bg_img      = $menu_left_bg['background-image'];
    	$menu_left_bg_repeat   = $menu_left_bg['background-repeat'];
    	$menu_left_bg_attach   = $menu_left_bg['background-attachment'];
    	$menu_left_bg_pos      = $menu_left_bg['background-position'];
    	$menu_left_bg_size     = $menu_left_bg['background-size'];
        if($menu_left_bg_color) {
            $menu_left_bg_color = 'background-color: '.$menu_left_bg_color.';';
        } else { $menu_left_bg_color = ''; }
        if($menu_left_bg_img) {
            $menu_left_bg_img = 'background-image:url('.$menu_left_bg_img.');';
        } else { $menu_left_bg_img = ''; }
        if($menu_left_bg_repeat) {
            $menu_left_bg_repeat = 'background-repeat: '.$menu_left_bg_repeat.';';
        } else { $menu_left_bg_repeat = ''; }
        if($menu_left_bg_attach) {
            $menu_left_bg_attach = 'background-attachment: '.$menu_left_bg_attach.';';
        } else { $menu_left_bg_attach = ''; }
        if($menu_left_bg_pos) {
            $menu_left_bg_pos = 'background-position: '.$menu_left_bg_pos.';';
        } else { $menu_left_bg_pos = ''; }
        if($menu_left_bg_size) {
            $menu_left_bg_size = 'background-size: '.$menu_left_bg_size.';';
        } else { $menu_left_bg_size = ''; }
    } elseif( $menu_position == 'menu_pos_right_margin' && $menu_right_bg!='' ) {
    	$menu_left_bg_color    = $menu_right_bg['background-color'];
    	$menu_left_bg_img      = $menu_right_bg['background-image'];
    	$menu_left_bg_repeat   = $menu_right_bg['background-repeat'];
    	$menu_left_bg_attach   = $menu_right_bg['background-attachment'];
    	$menu_left_bg_pos      = $menu_right_bg['background-position'];
    	$menu_left_bg_size     = $menu_right_bg['background-size'];
        if($menu_left_bg_color) {
            $menu_left_bg_color = 'background-color: '.$menu_left_bg_color.';';
        } else { $menu_left_bg_color = ''; }
        if($menu_left_bg_img) {
            $menu_left_bg_img = 'background-image:url('.$menu_left_bg_img.');';
        } else { $menu_left_bg_img = ''; }
        if($menu_left_bg_repeat) {
            $menu_left_bg_repeat = 'background-repeat: '.$menu_left_bg_repeat.';';
        } else { $menu_left_bg_repeat = ''; }
        if($menu_left_bg_attach) {
            $menu_left_bg_attach = 'background-attachment: '.$menu_left_bg_attach.';';
        } else { $menu_left_bg_attach = ''; }
        if($menu_left_bg_pos) {
            $menu_left_bg_pos = 'background-position: '.$menu_left_bg_pos.';';
        } else { $menu_left_bg_pos = ''; }
        if($menu_left_bg_size) {
            $menu_left_bg_size = 'background-size: '.$menu_left_bg_size.';';
        } else { $menu_left_bg_size = ''; }
    } else {
    	$menu_left_bg_color    = '';
    	$menu_left_bg_img      = '';
    	$menu_left_bg_repeat   = '';
    	$menu_left_bg_attach   = '';
    	$menu_left_bg_pos      = '';
    	$menu_left_bg_size     = '';
    }
    // Left and Right Classes
    $menu_position = ot_get_option('menu_position');
    if ($menu_position == 'menu_pos_left_margin') {
    	$menu_position_class = 'left-menu-wrap';
    } else {
    	$menu_position_class = 'photography-rightmenu';
    }
?>
<div class="<?php echo esc_attr($menu_position_class); ?> jt-dark-bg" style="<?php echo esc_attr($menu_left_bg_color).esc_attr($menu_left_bg_img).esc_attr($menu_left_bg_repeat).esc_attr($menu_left_bg_attach).esc_attr($menu_left_bg_pos).esc_attr($menu_left_bg_size); ?>">
    <!-- Logo -->
    <div class="port-logo">
    <?php
    $retina_logo = ot_get_option('retina_logo_upload');
    $default_logo = ot_get_option('logo_upload');
	$front_cus_enable = ot_get_option('front_cus_enable');
    $front_logo_upload = ot_get_option('front_logo_upload');
    $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

	if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
		if($front_retina_logo_upload != '') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
	            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	        </a>
		<?php } ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
	        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	    </a>
	<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
		if($front_retina_logo_upload != '') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
	            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	        </a>
		<?php } ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
	        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	    </a>
	<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
		if($retina_logo != '') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
	            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	        </a>
		<?php } ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
	        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	    </a>
	<?php } elseif(is_front_page()) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
	        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	    </a>
	<?php }

	if(!is_front_page() && $default_logo != '') {
		if($retina_logo) { ?>
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		</a>
	<?php } elseif(!is_front_page() && $default_logo =='') { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
		  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		</a>
	<?php } elseif(!is_front_page()) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
	        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	    </a>
	<?php } ?>
    </div>
    <?php
    global $post;
    if (is_page()) {
    	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
        if ($choose_menu) {
        	$jt_choose_menu = $choose_menu;
        } else {
        	$jt_choose_menu = '';
        }
    } else {
    	$jt_choose_menu = '';
    }
    wp_nav_menu(
        array(
            'walker'            => new wp_bootstrap_navwalker(),
            'theme_location'    => 'main-menu',
            'menu'    			=> $jt_choose_menu,
            'menu_class'        => 'left-menu',
            'menu_id'        	=> '',
            'container_class'   => 'left-menu-list menu-main-menu-container',
            'fallback_cb'       => false,
            'sub_menu'			=> true,
            'depth'				=> 0,
        )
    );
    ?>
    <!-- Menu list -->
    <div class="contact-wrap">
        <div class="widget">
            <?php
            $menu_position = ot_get_option('menu_position');
            if( $menu_position == 'menu_pos_left_margin' ) {
            	dynamic_sidebar( 'menu_pos_left_margin_wid' );
            } else {
            	dynamic_sidebar( 'menu_pos_right_margin_wid' );
            }
            ?>
        </div>
        <div class="jt-copy-right jt-dark-version">
            <?php
            $menu_position = ot_get_option('menu_position'); // Photography
            $copyright_text = ot_get_option('copyright_text');
            if( $menu_position == 'menu_pos_left_margin' || $menu_position == 'menu_pos_right_margin' ) {
            	echo do_shortcode($copyright_text);
            }
            ?>
        </div>
    </div>
</div>
<!-- Slim Menu -->
<div class="hidden-side-big-screen">
    <div class="sticky-nav jt-top-white">
	    <?php
	    $retina_logo = ot_get_option('retina_logo_upload');
	    $default_logo = ot_get_option('logo_upload');
		$front_cus_enable = ot_get_option('front_cus_enable');
        $front_logo_upload = ot_get_option('front_logo_upload');
        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

		if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
			if($retina_logo != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }

		if(!is_front_page() && $default_logo != '') {
			if($retina_logo) { ?>
			    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page() && $default_logo =='') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }
		global $post;
        if (is_page()) {
        	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
            if ($choose_menu) {
            	$jt_choose_menu = $choose_menu;
            } else {
            	$jt_choose_menu = '';
            }
        } else {
        	$jt_choose_menu = '';
        }
        wp_nav_menu(
            array(
                'walker'            => new wp_bootstrap_navwalker(),
                'theme_location'    => 'main-menu',
                'menu'    			=> $jt_choose_menu,
                'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-side-menu menu-main-menu-container',
                'menu_id'           => 'menu-main-menu',
                'fallback_cb'       => false,
            )
        );
        ?>
	</div>
</div>
<!-- /Slim Menu -->
	<?php
	}
}

/*==============================================================
	Header - Architecture Header /
===============================================================*/
if ( ! function_exists( 'menu_pos_top_arch' ) ) {
	function menu_pos_top_arch() {
	global $post;
	$menu_position = ot_get_option('menu_position');
	$sticky_header = ot_get_option('sticky_header');
	if($sticky_header == 'on' && $menu_position == 'menu_pos_top_arch') {
	    $sticky_header  = 'sticky-nav';
	} else {
	    $sticky_header = '';
	}
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt !='' ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid padding-zero';
            } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }
?>
<div class="<?php echo esc_attr($layout_structure); ?> padding-zero jt-arch-head-content">
<header id="<?php echo esc_attr($sticky_header); ?>" class="jt-arch-header jt-header-three sticky-nav">
	<nav class="navbar navbar-default navbar-static-top">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<?php
			$retina_logo = ot_get_option('retina_logo_upload');
			$default_logo = ot_get_option('logo_upload');
			$front_cus_enable = ot_get_option('front_cus_enable');
	        $front_logo_upload = ot_get_option('front_logo_upload');
	        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

			if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
				if($retina_logo != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }

			if(!is_front_page() && $default_logo != '') {
				if($retina_logo) { ?>
				    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page() && $default_logo =='') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
				  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div id="main-nav" class="collapse navbar-collapse">
			<?php
			global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
            wp_nav_menu(
                array(
                    'walker'            => new wp_bootstrap_navwalker(),
                    'theme_location'    => 'main-menu',
                    'menu'    			=> $jt_choose_menu,
                    'menu_class'        => 'nav navbar-nav navbar-right jt-main-nav',
                    'menu_id'           => 'menu-create-menu',
                    'container_class'   => 'navbar-left menu-main-menu-container',
                    'fallback_cb'       => false,
                )
            );
            $head_search = ot_get_option('search_enable');
            $head_cart = ot_get_option('cart_enable');
            $head_lang = ot_get_option('lang_enable');
            ?>
			<!-- Menu Metas -->
			<div class="menu-metas navbar-default navbar-right">
				<ul class="navbar-nav">
					<?php if( $head_search == 'on' ) { ?>
						<li id="top-search" class="jt-menu-search">
							<a href="#0" id="top-search-trigger">
								<i class="fa fa-search"></i>
								<i class="pe-7s-close"></i>
							</a>
							<form class="container search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
								<input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
							</form>
						</li>
					<?php }
				    if( $head_lang == 'on' ) {
				    	dynamic_sidebar( 'lang_widget' );
					}
					?>
					<li class="jt-arch-share">
						<a href="#0" id="jt-top-share">
							<i class="pe-7s-share"></i>
							<i class="pe-7s-close"></i>
						</a>
						<?php
						if($menu_position == 'menu_pos_top_arch') {
							dynamic_sidebar('menu_pos_top_arch_top_widget');
						}
						?>
					</li>
				</ul>
			</div>
			<!-- Menu Metas -->
		</div>
		<!-- Main Nav -->
	</nav>
	<!-- Slim Menu -->
	<div class="hidden-big-screen">
		<div class="">
			<?php
			$retina_logo = ot_get_option('retina_logo_upload');
			$default_logo = ot_get_option('logo_upload');
			$front_cus_enable = ot_get_option('front_cus_enable');
	        $front_logo_upload = ot_get_option('front_logo_upload');
	        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

			if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_attr($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
				if($retina_logo != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }

			if(!is_front_page() && $default_logo != '') {
				if($retina_logo) { ?>
				    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page() && $default_logo =='') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
				  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }
			global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
            wp_nav_menu(
                array(
                    'walker'            => new wp_bootstrap_navwalker(),
                    'theme_location'    => 'main-menu',
                    'menu'    			=> $jt_choose_menu,
                    'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
                    'menu_id'           => 'menu-main-menu',
                    'container_class'   => 'menu-main-menu-container',
                    'fallback_cb'       => false,
                    'sub_menu' 			=> true,
                    'depth'				=> 5
                )
            );
            ?>
            <!-- Menu Metas -->
            <div class="menu-metas navbar-default navbar-right jt-slim-meta">
        	    <?php if( $head_lang == 'on' ) {
        	    	dynamic_sidebar( 'lang_widget' );
        		} ?>
            	<ul class="navbar-nav">
            		<?php if( $head_search == 'on' ) { ?>
	            		<li id="top-search-slim" class="jt-menu-search">
	            			<a href="#0" id="top-search-trigger-slim">
	            				<i class="fa fa-search"></i>
	            				<i class="pe-7s-close"></i>
	            			</a>
	            			<form class="container search-new" method="get" action="<?php echo esc_url(home_url('/')); ?>">
	            				<input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
	            			</form>
	            		</li>
            		<?php } else { } ?>
            		<li class="jt-arch-share">
            			<a href="#0" id="jt-top-share-slim">
            				<i class="pe-7s-share"></i>
            				<i class="pe-7s-close"></i>
            			</a>
            			<div class="arch-social">
	            			<?php
	            			if($menu_position == 'menu_pos_top_arch') {
	            				dynamic_sidebar('menu_pos_top_arch_top_widget');
	            			}
	            			?>
            			</div>
            		</li>
            	</ul>
            </div>
            <!-- Menu Metas -->
		</div>
	</div>
	<!-- /Slim Menu -->
</header>
</div>
<?php
global $post;
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );
$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );

if(is_page() && $banner_type_mt != '' && $banner_color_mt != '') {
	$banner_color = $banner_color_mt;
} elseif(!is_page() && $banner_type_ot != '' && $banner_color_ot != '') {
	$banner_color = $banner_color_ot;
} else {
	$banner_color = '';
}
if(is_page() && $banner_type_mt == 'sld_ban') {
	$banner_class = 'jt-rev-banner';
} elseif(!is_page() && $banner_type_ot == 'sld_ban') {
	$banner_class = 'jt-rev-banner';
} else {
	$banner_class = '';
}
if (is_page()) {
    if ($banner_type_mt == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } else {
        $page_hav_banner = '';
    }
} elseif(!is_page()) {
    if ($banner_type_ot == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } else {
        $page_hav_banner = '';
    }
}
if(!is_singular('portfolio') && $page_hav_banner != 'page_hav_banner') {
	if(!is_page_template('template-one-page-architecture.php')) { ?>
	<div class="<?php echo esc_attr($layout_structure); ?> padding-zero">
	    <div class="jt-blog-bg <?php echo esc_attr($banner_class); ?>">
	<?php
		if(is_page() && $banner_type_mt != '') {
			if($banner_type_mt == 'img_ban' && $banner_image_mt) {
	        	$img=0;
	        	foreach($banner_image_mt as $ban_img_mt) {
	        		$img++;
	        	}
	        	if($img <= 1) { ?>
			        <div class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
				            <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
				            </div>
			            <?php } ?>
			            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			        </div>
	        	<?php } elseif($img >= 2) { ?>
			        <div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <ul class="slider jt-animated-hand">
			                <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
			                    <li class="slide">
			                        <div class="slide-bg">
			                            <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                        </div>
			                    </li>
			                <?php } ?>
			                <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			            </ul>
			        </div>
		        <?php }
	        } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
	        	$spc=0;
	        	foreach($special_banner_image_mt as $ban_spc_mt) {
	        		$spc++;
	        	}
	        	if($spc <= 1) { ?>
			        <div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
				            <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
				            </div>
			            <?php }
			            if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			                <canvas id="juster-canvas-one"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			                <canvas id="juster-canvas-two"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			                <canvas id="juster-canvas-three"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			                <canvas id="juster-canvas-four"></canvas>
			            <?php } ?>
			            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			        </div>
	        	<?php } elseif($spc >= 2) { ?>
			        <div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <ul class="slider jt-animated-hand">
			                <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                    <li class="slide">
			                        <div class="slide-bg">
			                            <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="">
			                        </div>
			                    </li>
			                <?php } ?>
			            </ul>
			            <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			                <canvas id="juster-canvas-one"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			                <canvas id="juster-canvas-two"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			                <canvas id="juster-canvas-three"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			                <canvas id="juster-canvas-four"></canvas>
			            <?php } ?>
			            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			        </div>
			    	<?php }
	    	} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
	            $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
	            $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
	            $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
	            $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
	            $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
	            $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
	            $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
	            if($vid_ban_control) {
	                $vid_ban_control = 'true';
	            } else {
	                $vid_ban_control = 'false';
	            }
	            if($vid_ban_auto_play) {
	                $vid_ban_auto_play = 'true';
	            } else {
	                $vid_ban_auto_play = 'false';
	            }
	            if($vid_ban_vid_loop) {
	                $vid_ban_vid_loop = 'true';
	            } else {
	                $vid_ban_vid_loop = 'false';
	            }
	            if($vid_ban_aud_mute) {
	                $vid_ban_aud_mute = 'true';
	            } else {
	                $vid_ban_aud_mute = 'false';
	            }
	            if($vid_ban_start_time) {
	                $vid_ban_start_time = $vid_ban_start_time;
	            } else {
	                $vid_ban_start_time = '0';
	            }
	            if($vid_ban_vid_qty) {
	                $vid_ban_vid_qty = $vid_ban_vid_qty;
	            } else {
	                $vid_ban_vid_qty = 'default';
	            }
	        ?>
		        <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		            <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		            </a>
		            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
		        </div>
	    	<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') { ?>
	    		<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner">
	            	<?php echo do_shortcode($banner_slide_mt); ?>
	            	<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
	            </div>
	        <?php } elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') { ?>
	    		<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner">
	            	<?php echo do_shortcode($banner_shortcode_mt); ?>
	            	<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
	            </div>
	        <?php } ?>
	<?php } elseif($banner_type_ot != 'jt_hide_ban') { ?>
	        <?php if($banner_type_ot == 'img_ban' && $banner_image_ot) {
    	    	$img=0;
    			foreach($banner_image_ot as $ban_img_ot) {
    				$img++;
    			}
    			if($img <= 1) { ?>
    				<div class="slider-container jt-vintage-banner jt-vint-small-banner">
    				    <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
        				    <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
        				    </div>
    				    <?php } ?>
    				    <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
    				</div>
    			<?php } elseif($img >= 2) { ?>
			        <div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <ul class="slider jt-animated-hand">
			                <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
			                    <li class="slide">
			                        <div class="slide-bg">
			                            <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="">
			                        </div>
			                    </li>
			                <?php } ?>
			            </ul>
			            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			        </div>
			        <?php }
	        } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
	        	$spc=0;
	        	foreach($special_banner_image_ot as $ban_spc_ot) {
	        		$spc++;
	        	}
	        	if($spc <= 1) { ?>
			        <div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
				            <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
				            </div>
			            <?php }
			            if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			                <canvas id="juster-canvas-one"></canvas>
			            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			                <canvas id="juster-canvas-two"></canvas>
			            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			                <canvas id="juster-canvas-three"></canvas>
			            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			                <canvas id="juster-canvas-four"></canvas>
			            <?php } ?>
			            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			        </div>
	        	<?php } elseif($spc >= 2) { ?>
			        <div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <ul class="slider jt-animated-hand">
			                <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			                    <li class="slide">
			                        <div class="slide-bg">
			                            <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="
			                            ">
			                        </div>
			                    </li>
			                <?php } ?>
			            </ul>
			            <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			                <canvas id="juster-canvas-one"></canvas>
			            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			                <canvas id="juster-canvas-two"></canvas>
			            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			                <canvas id="juster-canvas-three"></canvas>
			            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			                <canvas id="juster-canvas-four"></canvas>
			            <?php } ?>
			            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
			        </div>
			    <?php }
	    	} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
	            $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
	            $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
	            $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
	            $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
	            $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
	            $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
	            $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
	            if($vid_ban_control) {
	                $vid_ban_control = 'true';
	            } else {
	                $vid_ban_control = 'false';
	            }
	            if($vid_ban_auto_play) {
	                $vid_ban_auto_play = 'true';
	            } else {
	                $vid_ban_auto_play = 'false';
	            }
	            if($vid_ban_vid_loop) {
	                $vid_ban_vid_loop = 'true';
	            } else {
	                $vid_ban_vid_loop = 'false';
	            }
	            if($vid_ban_aud_mute) {
	                $vid_ban_aud_mute = 'true';
	            } else {
	                $vid_ban_aud_mute = 'false';
	            }
	            if($vid_ban_start_time) {
	                $vid_ban_start_time = $vid_ban_start_time;
	            } else {
	                $vid_ban_start_time = '0';
	            }
	            if($vid_ban_vid_qty) {
	                $vid_ban_vid_qty = $vid_ban_vid_qty;
	            } else {
	                $vid_ban_vid_qty = 'default';
	            }
	        ?>
		        <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		            <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		            </a>
		            <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
		        </div>
	    	<?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') { ?>
	    		<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner">
	            	<?php echo do_shortcode($banner_slide_ot); ?>
	            	<div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
	            </div>
	        <?php }
		} // Banner Finished
		// Page Title Starts
		if (is_page()) {
		    $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
		    $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
		    $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
		    $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
		    $page_title = ot_get_option('page_title');
		    ?>
		    <div class="jt-arch-title jt-arch-not-page-ban-tit">
		        <?php
		        if($page_subheading) {
		            echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
		        }
		        if ($page_title != 'off' && $enable_new_page_title == 'off') {
		            if(is_front_page()) { ?>
		                <h1 class="page_heading"><?php bloginfo(''); ?></h1>
		            <?php } else { ?>
		                <h1 class="page_heading"><?php the_title(); ?></h1>
		            <?php }
		        } elseif($enable_new_page_title == 'on') {
		            if($new_page_title != '') { ?>
		                <h1 class="page_heading"><?php echo esc_attr($new_page_title); ?></h1>
		            <?php } elseif($new_page_title == '') { ?>
		                <h1 class="page_heading"><?php echo the_title(); ?></h1>
		            <?php } elseif($page_title == 'off' && $new_page_title == '') {}
		        } // Page Title Hide
		        if($header_banner_title_img !='') {
		            echo '<img src="'.esc_attr($header_banner_title_img).'" class="left-right-menu-tit-img" alt="">';
		        } ?>
		    </div>
		<?php
		} else {
		    $page_title = ot_get_option('page_title');
		?>
		    <div class="jt-arch-title jt-arch-not-page-ban-tit">
		        <?php if ($page_title != 'off') {
		            if(is_front_page()) { ?>
		                <h1 class="page_heading"><?php bloginfo(''); ?></h1>
		            <?php } elseif (is_author()) { ?>
		                <h1 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
		            <?php
		                } elseif (is_archive()) { ?>
		                    <h1 class="page_heading"><?php if ( is_day() ) {
		                            printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
		                        } elseif ( is_month() ) {
		                            printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
		                        } elseif ( is_year() ) {
		                            printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
		                        } else {
		                            echo __( 'Archives', 'juster' );
		                        } ?></h1>
		                <?php
		                } elseif (is_search()) { ?>
		                <h1 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h1>
		            <?php
		                } elseif (is_category()) { ?>
		                    <h1 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
		            <?php
		                } elseif (is_tag()) { ?>
		                    <h1 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
		            <?php
		                } elseif(is_home()) { ?>
		                    <h1 class="page_heading"><?php bloginfo(''); ?></h1>
		            <?php
		                } else { ?>
		                    <h1 class="page_heading"><?php the_title(); ?></h1>
		            <?php
		                }
		        } // Hide Page Title
		        ?>
		    </div>
		    <?php
		} // Is not page - Page Title
		?>
		</div> <!-- jt-blog-bg -->
	</div> <!-- Layout Structure -->
<?php
	}// !template-one-page-architecture
} elseif(is_singular('portfolio')) { // single portfolio slider on header
	$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	if($single_port_gallery != '') { ?>
		<div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($single_port_gallery as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
} // !single-portoflio

	}
}

/*==============================================================
	Header - Agency Header /
===============================================================*/
if ( ! function_exists( 'menu_pos_top_agency' ) ) {
	function menu_pos_top_agency() {
	global $post;
	$menu_position = ot_get_option('menu_position');
	$sticky_header = ot_get_option('sticky_header');
	if($sticky_header == 'on' && $menu_position == 'menu_pos_top_agency') {
	    $sticky_header  = 'sticky-nav';
	} else {
	    $sticky_header = '';
	}
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt !='' ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }

$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );
if(is_page() && $banner_type_mt == 'sld_ban') {
	$slider_class = 'banner-rev-slide';
} elseif(!is_page() && $banner_type_ot == 'sld_ban') {
	$slider_class = 'banner-rev-slide';
} else {
	$slider_class = '';
}
if (is_page()) {
    if ($banner_type_mt == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } else {
        $page_hav_banner = '';
    }
} elseif(!is_page()) {
    if ($banner_type_ot == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } else {
        $page_hav_banner = '';
    }
}
?>
<header class="jt-agency <?php echo esc_attr($layout_structure); ?>">
<?php
if(!is_singular('portfolio')) {
?>
<div class="jt-agency-header <?php echo esc_attr($slider_class); echo esc_attr($page_hav_banner); ?>">
    <div class="content">
        <div id="sub-page-spl-banner" class="jt-agency-header-two large-header">
        	<?php if(!is_page_template('template-one-page-architecture.php') && $page_hav_banner != 'page_hav_banner') { ?>
			<div class="jt-agency-header-image">
			<?php if($banner_type_mt == 'img_ban' && $banner_image_mt) {
				$img=0;
				foreach($banner_image_mt as $ban_img_mt) {
					$img++;
				}
				if($img <= 1) {
					foreach($banner_image_mt as $vint_ban_mt) {
				?>
					<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
					</div>
				<?php }
				} elseif($img >= 2) { ?>
			        <div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <ul class="slider jt-animated-hand">
			                <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
			                    <li class="slide">
			                        <div class="slide-bg">
			                            <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                        </div>
			                    </li>
			                <?php } ?>
			            </ul>
			        </div>
			        <?php }
	        } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
	        	$spc=0;
	        	foreach($special_banner_image_mt as $ban_spc_mt) {
	        		$spc++;
	        	}
	        	if($spc <= 1) { ?>
	        		<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
	        		    <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
					        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
					        </div>
				        <?php }
				        if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
	        		        <canvas id="juster-canvas-one"></canvas>
	        		    <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
	        		        <canvas id="juster-canvas-two"></canvas>
	        		    <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
	        		        <canvas id="juster-canvas-three"></canvas>
	        		    <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
	        		        <canvas id="juster-canvas-four"></canvas>
	        		    <?php } ?>
	        		</div>
	        	<?php } elseif($spc >= 2) { ?>
			        <div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <ul class="slider jt-animated-hand">
			                <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                    <li class="slide">
			                        <div class="slide-bg">
			                            <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                        </div>
			                    </li>
			                <?php } ?>
			            </ul>
			            <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			                <canvas id="juster-canvas-one"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			                <canvas id="juster-canvas-two"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			                <canvas id="juster-canvas-three"></canvas>
			            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			                <canvas id="juster-canvas-four"></canvas>
			            <?php } ?>
			        </div>
			    <?php }
		    } elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
	            $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
	            $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
	            $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
	            $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
	            $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
	            $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
	            $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
	            if($vid_ban_control) {
	                $vid_ban_control = 'true';
	            } else {
	                $vid_ban_control = 'false';
	            }
	            if($vid_ban_auto_play) {
	                $vid_ban_auto_play = 'true';
	            } else {
	                $vid_ban_auto_play = 'false';
	            }
	            if($vid_ban_vid_loop) {
	                $vid_ban_vid_loop = 'true';
	            } else {
	                $vid_ban_vid_loop = 'false';
	            }
	            if($vid_ban_aud_mute) {
	                $vid_ban_aud_mute = 'true';
	            } else {
	                $vid_ban_aud_mute = 'false';
	            }
	            if($vid_ban_start_time) {
	                $vid_ban_start_time = $vid_ban_start_time;
	            } else {
	                $vid_ban_start_time = '0';
	            }
	            if($vid_ban_vid_qty) {
	                $vid_ban_vid_qty = $vid_ban_vid_qty;
	            } else {
	                $vid_ban_vid_qty = 'default';
	            }
	        ?>
		        <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		            <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		            </a>
		        </div>
	    	<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
		            echo do_shortcode($banner_slide_mt);
		        } elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
		            echo do_shortcode($banner_shortcode_mt);
		        } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) {
        	    	$img=0;
        			foreach($banner_image_ot as $ban_img_ot) {
        				$img++;
        			}
        			if($img <= 1) {
			    		foreach($banner_image_ot as $vint_ban_ot) {
			    	?>
				    	<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
				        </div>
			    	<?php }
			    	} elseif($img >= 2) { ?>
				        <div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
				            <ul class="slider jt-animated-hand">
				                <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
				                    <li class="slide">
				                        <div class="slide-bg">
				                            <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
				                        </div>
				                    </li>
				                <?php } ?>
				            </ul>
				        </div>
			        <?php }
		        } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
		        	$spc=0;
		        	foreach($special_banner_image_ot as $ban_spc_ot) {
		        		$spc++;
		        	}
		        	if($spc <= 1) { ?>
		        		<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        		    <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
						        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
						        </div>
					        <?php }
					        if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
		        		        <canvas id="juster-canvas-one"></canvas>
		        		    <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
		        		        <canvas id="juster-canvas-two"></canvas>
		        		    <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
		        		        <canvas id="juster-canvas-three"></canvas>
		        		    <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
		        		        <canvas id="juster-canvas-four"></canvas>
		        		    <?php } ?>
		        		</div>
		        	<?php } elseif($spc >= 2) { ?>
				        <div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
				            <ul class="slider jt-animated-hand">
				                <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
				                    <li class="slide">
				                        <div class="slide-bg">
				                            <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
				                        </div>
				                    </li>
				                <?php } ?>
				            </ul>
				            <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
				                <canvas id="juster-canvas-one"></canvas>
				            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
				                <canvas id="juster-canvas-two"></canvas>
				            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
				                <canvas id="juster-canvas-three"></canvas>
				            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
				                <canvas id="juster-canvas-four"></canvas>
				            <?php } ?>
				        </div>
				    <?php }
			    } elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
			            $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
			            $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
			            $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
			            $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
			            $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
			            $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
			            $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
			            if($vid_ban_control) {
			                $vid_ban_control = 'true';
			            } else {
			                $vid_ban_control = 'false';
			            }
			            if($vid_ban_auto_play) {
			                $vid_ban_auto_play = 'true';
			            } else {
			                $vid_ban_auto_play = 'false';
			            }
			            if($vid_ban_vid_loop) {
			                $vid_ban_vid_loop = 'true';
			            } else {
			                $vid_ban_vid_loop = 'false';
			            }
			            if($vid_ban_aud_mute) {
			                $vid_ban_aud_mute = 'true';
			            } else {
			                $vid_ban_aud_mute = 'false';
			            }
			            if($vid_ban_start_time) {
			                $vid_ban_start_time = $vid_ban_start_time;
			            } else {
			                $vid_ban_start_time = '0';
			            }
			            if($vid_ban_vid_qty) {
			                $vid_ban_vid_qty = $vid_ban_vid_qty;
			            } else {
			                $vid_ban_vid_qty = 'default';
			            }
			        ?>
			        <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
			            </a>
			        </div>
			    <?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
			            echo do_shortcode($banner_slide_ot);
			        } // Banner Finished
		        if($banner_color_mt != '') {
	        	?>
			        <style>
			        .jt_agency_content .banner-overlay {
			        	background: <?php echo esc_attr($banner_color_mt); ?>;
			        }
			        </style>
	        	<?php } elseif($banner_color_ot != '') { ?>
			        <style>
			        .jt_agency_content .banner-overlay {
			        	background: <?php echo esc_attr($banner_color_ot); ?>;
			        }
			        </style>
	        	<?php } ?>
	        <div class="banner-overlay"></div>
			</div>
			<?php } ?>
			<nav class="navbar navbar-default navbar-static-top <?php echo esc_attr($sticky_header); ?>">
	            <div class="jt-agency-head-bar jt-on-slide">
	                <div class="col-sm-4 padding-zero">
	                    <?php
	                    $retina_logo = ot_get_option('retina_logo_upload');
	                    $default_logo = ot_get_option('logo_upload');
						$front_cus_enable = ot_get_option('front_cus_enable');
				        $front_logo_upload = ot_get_option('front_logo_upload');
				        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

						if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
							if($front_retina_logo_upload != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
							if($front_retina_logo_upload != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
							if($retina_logo != '') { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						        </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } elseif(is_front_page()) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php }

						if(!is_front_page() && $default_logo != '') {
							if($retina_logo) { ?>
							    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
							        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							    </a>
							<?php } ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
							  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							</a>
						<?php } elseif(!is_front_page() && $default_logo =='') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
							  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							</a>
						<?php } elseif(!is_front_page()) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
	                </div>
	                <div class="col-sm-8 padding-zero">
	                    <div class="jt-agency-menu">
	                        <a href="#0" class="jt-whole-menu">
	                            <h3><?php echo __('Menu', 'juster'); ?></h3>
	                            <div class="jt-agency-hamburger">
	                                <div class="jt-ham-nav">
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                </div>
	                            </div>
	                        </a>
	                        <?php
	                        global $post;
				            if (is_page()) {
				            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
					            if ($choose_menu) {
					            	$jt_choose_menu = $choose_menu;
					            } else {
					            	$jt_choose_menu = '';
					            }
				            } else {
				            	$jt_choose_menu = '';
				            }
	                        wp_nav_menu(
	                            array(
	                                'walker'            => new wp_bootstrap_navwalker(),
	                                'theme_location'    => 'main-menu',
	                                'menu'    			=> $jt_choose_menu,
	                                'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list',
	                                'container_class'   => 'menu-main-menu-container',
	                                'fallback_cb'       => false,
	                                'sub_menu'			=> true,
	                                'depth'				=> 0,
	                            )
	                        );
	                        ?>
	                    </div>
	                </div>
	            </div>
            </nav>
            <!-- Slim Menu -->
            <div class="hidden-big-screen">
                <div class="sticky-nav jt-slim-top">
                    <?php
                    $retina_logo = ot_get_option('retina_logo_upload');
                    $default_logo = ot_get_option('logo_upload');
					$front_cus_enable = ot_get_option('front_cus_enable');
			        $front_logo_upload = ot_get_option('front_logo_upload');
			        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

					if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
						if($retina_logo != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }

					if(!is_front_page() && $default_logo != '') {
						if($retina_logo) { ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page() && $default_logo =='') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
						  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }
					global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
					wp_nav_menu(
					    array(
					        'walker'            => new wp_bootstrap_navwalker(),
					        'theme_location'    => 'main-menu',
					        'menu'    			=> $jt_choose_menu,
					        'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
					        'menu_id'			=> 'menu-main-menu',
					        'container_class'   => 'menu-main-menu-container',
					        'fallback_cb'       => false,
					        'sub_menu'			=> true,
					        'depth'				=> 5,
					    )
					);
					?>
                </div>
			</div>
            <!-- /Slim Menu -->
            <?php
		    $page_title = ot_get_option('page_title');
            if(!is_page_template('template-one-page-architecture.php')) {
            	if(is_page() && $banner_type_mt != 'sld_ban') { // is_page | banner-on-text
            		$enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
            		$new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
            		$page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
            		$header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
            		if( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading !='' ) {
            		    $ban_text = 'jt-arch-bantext-1null';
            		} elseif( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading =='' ) {
            		    $ban_text = 'jt-arch-bantext-2null';
            		} elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading !='' ) {
            		    $ban_text = 'jt-arch-bantext-3null';
            		} elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading =='' ) {
            		    $ban_text = 'jt-arch-bantext-4null';
            		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading !='' ) {
            		    $ban_text = 'jt-arch-bantext-5null';
            		} elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading !='' ) {
            		    $ban_text = 'jt-arch-bantext-6null';
            		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img == '' && $page_subheading !='' ) {
            		    $ban_text = 'jt-arch-bantext-7null';
            		} elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img == '' && $page_subheading !='' ) {
            		    $ban_text = 'jt-arch-bantext-8null';
            		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading =='' ) {
            		    $ban_text = 'jt-arch-bantext-9null';
            		} elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading =='' ) {
            		    $ban_text = 'jt-arch-bantext-10null';
            		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img == '' && $page_subheading =='' ) {
            		    $ban_text = 'jt-arch-bantext-11null';
            		} else {
            		    $ban_text = '';
            		}
            ?>
            <div class="jt-agency-banner-content <?php echo esc_attr($ban_text); ?>">
            	<?php if($page_subheading) {
		        	echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
		        }
		        if ($page_title != 'off' && $enable_new_page_title == 'off') {
	    			if(is_front_page()) { ?>
	    	    		<h1 class="page_heading"><?php bloginfo(''); ?></h1>
	    	    	<?php } else { ?>
	    	    		<h1 class="page_heading"><?php the_title(); ?></h1>
	    	    	<?php }
	    		} elseif($enable_new_page_title == 'on') {
	    			if($new_page_title != '') { ?>
	    				<h1 class="page_heading"><?php echo esc_attr($new_page_title); ?></h1>
	    			<?php } elseif($new_page_title == '') { ?>
	    				<h1 class="page_heading"><?php echo the_title(); ?></h1>
	    			<?php } elseif($page_title == 'off' && $new_page_title == '') {}
	    		} // Page Title Hide
            	if($header_banner_title_img !='') {
                	echo '<div class="jt-agency-ban-tit">';
                	echo '<img src="'. esc_attr($header_banner_title_img) .'" alt="">';
                	echo '</div>';
            	} ?>
            </div>
            <?php } elseif(!is_page() && $banner_type_ot != 'sld_ban') { ?>
            <div class="jt-agency-banner-content not-page">
            	<?php
            	if ($page_title != 'off') {
                    if(is_front_page()) { ?>
                    	<p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                        <h1 class="page_heading"><?php bloginfo(''); ?></h1>
                    <?php } elseif (is_author()) { ?>
                    	<p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                        <h1 class="page_heading jt-agency-blog-title"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
                    <?php
                        } elseif (is_archive()) { ?>
                        	<p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading jt-agency-blog-title"><?php if ( is_day() ) {
                                    printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
                                } elseif ( is_month() ) {
                                    printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
                                } elseif ( is_year() ) {
                                    printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
                                } else {
                                    echo __( 'Archives', 'juster' );
                                } ?></h1>
                        <?php
                        } elseif (is_search()) { ?>
                        <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                        <h1 class="page_heading jt-agency-blog-title"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h1>
                    <?php
                        } elseif (is_category()) { ?>
                        	<p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading jt-agency-blog-title"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
                    <?php
                        } elseif (is_tag()) { ?>
                        	<p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading jt-agency-blog-title"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
                    <?php
                        } elseif(is_home()) { ?>
                        	<p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading jt-agency-blog-title"><?php bloginfo(''); ?></h1>
                    <?php
                        } else { ?>
                            <h1 class="page_heading jt-agency-blog-title"><?php the_title(); ?></h1>
                    <?php
                        }
                } // Hide Page Title ?>
            </div>
        	<?php }
        	} // !template-one-page-architecture ?>
        </div>
    </div>
</div>
<?php } elseif(is_singular('portfolio')) { ?>
<div class="port-slider-wrapper portfolio-detail">
	<?php
	while( have_posts() ) : the_post();
	$port_gallerys = get_post_meta( get_the_ID(), 'port_single_img', 'true' );
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	if($port_gallerys) {
	?>
	    <div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($port_gallerys as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
	    </div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
	endwhile; ?>
    <div class="jt-agency-head-bar jt-on-slide">
	    <nav class="navbar navbar-default navbar-static-top <?php echo esc_attr($sticky_header); ?>">
	        <div class="col-sm-4 padding-zero">
	            <?php
	            $retina_logo = ot_get_option('retina_logo_upload');
	            $default_logo = ot_get_option('logo_upload');
	              if($default_logo) {
	                if($retina_logo) {
	                    $retina_logo = $retina_logo;
	                } else {
	                    $retina_logo = '';
	                }
	            ?>
	            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
	                <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	            </a>
	            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
	              <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	            </a>
	            <?php } else { ?>
	              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
	                  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	              </a>
	            <?php } ?>
	        </div>
	        <div class="col-sm-8 padding-zero">
	            <div class="jt-agency-menu">
                    <a href="#0" class="jt-whole-menu">
                        <h3><?php echo __('Menu', 'juster'); ?></h3>
                        <div class="jt-agency-hamburger">
                            <div class="jt-ham-nav">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </a>
	                <?php
	                global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
	                wp_nav_menu(
	                    array(
	                        'walker'            => new wp_bootstrap_navwalker(),
	                        'theme_location'    => 'main-menu',
	                        'menu'    			=> $jt_choose_menu,
	                        'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list',
	                        'container_class'   => 'menu-main-menu-container',
	                        'fallback_cb'       => false,
	                        'sub_menu'			=> true,
	                        'depth'				=> 0,
	                    )
	                );
	                ?>
	            </div>
	        </div>
	    </nav>
	</div>
    <!-- Slim Menu -->
    <div class="hidden-big-screen ">
        <div class="sticky-nav jt-slim-top">
            <?php
            $retina_logo = ot_get_option('retina_logo_upload');
            $default_logo = ot_get_option('logo_upload');
			if($default_logo) {
				if($retina_logo) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
                        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
                    </a>
				<?php } ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
                  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
                </a>
            <?php } else { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
				  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
            <?php }
            global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
			wp_nav_menu(
			    array(
			        'walker'            => new wp_bootstrap_navwalker(),
			        'theme_location'    => 'main-menu',
			        'menu'    			=> $jt_choose_menu,
			        'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
			        'menu_id'			=> 'menu-main-menu',
			        'container_class'   => 'menu-main-menu-container',
			        'fallback_cb'       => false,
			        'sub_menu'			=> true,
			        'depth'				=> 5,
			    )
			);
			?>
        </div>
	</div>
    <!-- /Slim Menu -->
</div>
<?php } ?>
</header>
<?php
	}
}

/*==============================================================
	Header - Agency Header / Home Template
===============================================================*/
if ( ! function_exists( 'menu_pos_top_agency_home' ) ) {
	function menu_pos_top_agency_home() {
	global $post;
	$menu_position = ot_get_option('menu_position');
	$sticky_header = ot_get_option('sticky_header');
	if($sticky_header == 'on' && $menu_position == 'menu_pos_top_agency') {
	    $sticky_header  = 'sticky-nav';
	} else {
	    $sticky_header = '';
	}
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt !='' ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }
?>
<header class="jt-agency <?php echo esc_attr($layout_structure); ?>">
<div class="jt-agency-header">
    <div class="content">
        <div id="large-header" class="slider-container large-header">
			<?php
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );

				if( $banner_type_mt == 'spc_ban' && $banner_type_spl_mt !='') {
					$i=0;
					foreach($special_banner_image_mt as $special_banner_image) {
						$i++;
					}
					if( $i == 1 ) {
					?>
			            <div class="jt-animated-hand animated <?php foreach($special_banner_image_mt as $special_banner_image) { echo esc_attr($special_banner_image['spc_ban_img_anim']); } ?>">
			            	<?php
			            	foreach($special_banner_image_mt as $special_banner_image) { ?>
			            		<img src="<?php echo esc_attr($special_banner_image['spc_ban_img']); ?>" alt="" class="">
			            	<?php } ?>
			            </div>
					<?php } elseif( $i >=2 ) { ?>
	                    <div id="slider">
		                    <ul class="slider jt-animated-hand">
		                    	<?php
		                    	foreach($special_banner_image_mt as $qwe) { ?>
			                        <li class="slide">
				                        <img src="<?php echo esc_attr($qwe['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                        </li>
		                        <?php } ?>
		                    </ul>
	                    </div>
					<?php }
				} elseif( $banner_type_mt == 'img_ban' && $banner_image_mt !='') {
				?>
				<style>
					.large-header .jt-animated-hand.animate img.img_ban {
						width: 100%;
					}
				</style>
				<?php
					$i=0;
					foreach($banner_image_mt as $banner_image) {
						$i++;
					}
					if( $i == 1 ) {
						foreach($banner_image_mt as $banner_image) {
					?>
			            <div class="jt-animated-hand animate" style="background: url('<?php echo $banner_image['ban_img_mt']; ?>'); background-size: cover;" >
			            </div>
			        <?php }
			        } elseif( $i >=2 ) { ?>
	                    <div id="slider">
		                    <ul class="slider jt-animated-hand">
		                    	<?php
		                    	foreach($banner_image_mt as $qwe) { ?>
			                        <li class="slide">
				                        <img src="<?php echo esc_attr($qwe['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>" class="img_ban">
			                        </li>
		                        <?php } ?>
		                    </ul>
	                    </div>
					<?php }
				} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
		            $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
		            $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
		            $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
		            $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
		            $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
		            $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
		            $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
		            if($vid_ban_control) {
		                $vid_ban_control = 'true';
		            } else {
		                $vid_ban_control = 'false';
		            }
		            if($vid_ban_auto_play) {
		                $vid_ban_auto_play = 'true';
		            } else {
		                $vid_ban_auto_play = 'false';
		            }
		            if($vid_ban_vid_loop) {
		                $vid_ban_vid_loop = 'true';
		            } else {
		                $vid_ban_vid_loop = 'false';
		            }
		            if($vid_ban_aud_mute) {
		                $vid_ban_aud_mute = 'true';
		            } else {
		                $vid_ban_aud_mute = 'false';
		            }
		            if($vid_ban_start_time) {
		                $vid_ban_start_time = $vid_ban_start_time;
		            } else {
		                $vid_ban_start_time = '0';
		            }
		            if($vid_ban_vid_qty) {
		                $vid_ban_vid_qty = $vid_ban_vid_qty;
		            } else {
		                $vid_ban_vid_qty = 'default';
		            }
		        ?>
			        <div id="videoid" class="slider-container jt-vintage-banner">
			            <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
			            </a>
			        </div>
			    <?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
			            echo do_shortcode($banner_slide_mt);
			    } elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
			            echo do_shortcode($banner_shortcode_mt);
			    } elseif( $banner_type_ot == 'spc_ban' && $banner_type_spl_ot !='') {
			    ?>
			    <style>
			    	.large-header .jt-animated-hand img.img_ban {
						width: 100%;
			    	}
			    </style>
			    <?php
					$i=0;
					foreach($special_banner_image_ot as $special_banner_image) {
						$i++;
					}
					if( $i == 1 ) {
					?>
			            <div class="jt-animated-hand animated <?php foreach($special_banner_image_ot as $special_banner_image) { echo esc_attr($special_banner_image['spc_ban_img_anim']); } ?>">
			            	<?php
			            	foreach($special_banner_image_ot as $special_banner_image) { ?>
			            		<img src="<?php echo esc_attr($special_banner_image['spc_ban_img']); ?>" alt="" class="img_ban">
			            	<?php } ?>
			            </div>
					<?php } elseif( $i >=2 ) { ?>
	                    <div id="slider">
		                    <ul class="slider jt-animated-hand">
		                    	<?php
		                    	foreach($special_banner_image_ot as $qwe) { ?>
			                        <li class="slide">
				                        <img src="<?php echo esc_attr($qwe['spc_ban_img']); ?>" alt="" class="img_ban">
			                        </li>
		                        <?php } ?>
		                    </ul>
	                    </div>
					<?php }
				} elseif( $banner_type_ot == 'img_ban' && $banner_image_ot !='') {
				?>
				<style>
					.large-header .slider.jt-animated-hand img.img_ban {
						width: 100%;
					}
				</style>
				<?php
					$i=0;
					foreach($banner_image_ot as $banner_image) {
						$i++;
					}
					if( $i == 1 ) {
					?>
			            <div class="jt-animated-hand animate">
			            	<?php
			            	foreach($banner_image_ot as $banner_image) { ?>
			            		<img src="<?php echo esc_attr($banner_image['ban_img_ot']); ?>" alt="" class="img_ban">
			            	<?php } ?>
			            </div>
					<?php } elseif( $i >=2 ) { ?>
	                    <div id="slider">
		                    <ul class="slider jt-animated-hand">
		                    	<?php
		                    	foreach($banner_image_ot as $qwe) { ?>
			                        <li class="slide">
				                        <img src="<?php echo esc_attr($qwe['ban_img_ot']); ?>" alt="" class="img_ban">
			                        </li>
		                        <?php } ?>
		                    </ul>
	                    </div>
					<?php }
				} elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
		            echo do_shortcode($banner_slide_ot);
		        }

				$menu_position = ot_get_option('menu_position');
				$sticky_header = ot_get_option('sticky_header');
				if($sticky_header == 'on' && $menu_position == 'menu_pos_top_agency') {
				    $sticky_header  = 'sticky-nav';
				} else {
				    $sticky_header = '';
				}
	    	?>
			<nav class="navbar navbar-default navbar-static-top <?php echo esc_attr($sticky_header); ?>">
	            <div class="jt-agency-head-bar">
	                <div class="col-sm-4 padding-zero">
	                    <?php
	                    $retina_logo = ot_get_option('retina_logo_upload');
	                    $default_logo = ot_get_option('logo_upload');
						if($default_logo) {
							if($retina_logo) { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
								    <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
								</a>
							<?php } ?>
		                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
		                      <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		                    </a>
	                    <?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
							  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
							</a>
	                    <?php } ?>
	                </div>
	                <div class="col-sm-8 padding-zero">
	                    <div class="jt-agency-menu">
	                        <a href="#0" class="jt-whole-menu">
	                            <h3><?php echo __('Menu', 'juster'); ?></h3>
	                            <div class="jt-agency-hamburger">
	                                <div class="jt-ham-nav">
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                </div>
	                            </div>
	                        </a>
	                        <?php
	                        global $post;
				            if (is_page()) {
				            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
					            if ($choose_menu) {
					            	$jt_choose_menu = $choose_menu;
					            } else {
					            	$jt_choose_menu = '';
					            }
				            } else {
				            	$jt_choose_menu = '';
				            }
	                        wp_nav_menu(
	                            array(
	                                'walker'            => new wp_bootstrap_navwalker(),
	                                'theme_location'    => 'main-menu',
	                                'menu'    			=> $jt_choose_menu,
	                                'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list',
	                                'container_class'   => 'menu-main-menu-container',
	                                'fallback_cb'       => false,
	                                'sub_menu'			=> true,
	                                'depth'				=> 0,
	                            )
	                        );
	                        ?>
	                    </div>
	                </div>
	            </div>
            </nav>

            <!-- Slim Menu -->
            <div class="hidden-big-screen ">
                <div class="sticky-nav jt-slim-top">
                    <?php
                    $retina_logo = ot_get_option('retina_logo_upload');
                    $default_logo = ot_get_option('logo_upload');
					if($default_logo) {
						if($retina_logo) { ?>
		                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		                        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		                    </a>
						<?php } ?>
	                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
	                      <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	                    </a>
                    <?php } else { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="jt-agency-logo default navbar-logo">
						  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
                    <?php }
                    global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
					wp_nav_menu(
					    array(
					        'walker'            => new wp_bootstrap_navwalker(),
					        'theme_location'    => 'main-menu',
					        'menu'    			=> $jt_choose_menu,
					        'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
					        'menu_id'			=> 'menu-main-menu',
					        'container_class'   => 'menu-main-menu-container',
					        'fallback_cb'       => false,
					        'sub_menu'			=> true,
					        'depth'				=> 5,
					    )
					);
					?>
                </div>
			</div>
            <!-- /Slim Menu -->
            <?php
	            if($banner_type_mt == 'spc_ban' && $banner_type_spl_mt == 'spc_ban_type_one') {
	            	$canvas_type = 'juster-canvas-one';
	            } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt == 'spc_ban_type_two') {
	            	$canvas_type = 'juster-canvas-two';
	            } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt == 'spc_ban_type_three') {
	            	$canvas_type = 'juster-canvas-three';
	            } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt == 'spc_ban_type_four') {
	            	$canvas_type = 'juster-canvas-four';
	            } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot == 'spc_ban_type_one') {
	            	$canvas_type = 'juster-canvas-one';
	            } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot == 'spc_ban_type_two') {
	            	$canvas_type = 'juster-canvas-two';
	            } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot == 'spc_ban_type_three') {
	            	$canvas_type = 'juster-canvas-three';
	            } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot == 'spc_ban_type_four') {
	            	$canvas_type = 'juster-canvas-four';
	            } else {
	            	$canvas_type = '';
	            }
            ?>
            <canvas id="<?php echo esc_attr($canvas_type); ?>"></canvas>
            <?php
        		$special_banner_typetext = get_post_meta( $post->ID, 'special_banner_typetext', true );
        		if($special_banner_typetext) {
        			echo do_shortcode( $special_banner_typetext );
        		}
            ?>
        </div>
    </div>
    <!-- Related demos -->
</div>
</header>
<?php
	}
}

/*==============================================================
	Header - Studio Header
===============================================================*/
if ( ! function_exists( 'menu_pos_top_studio' ) ) {
	function menu_pos_top_studio() {
	global $post;
	$menu_position = ot_get_option('menu_position');
	$sticky_header = ot_get_option('sticky_header');
	if($sticky_header == 'on' && $menu_position == 'menu_pos_top_studio') {
	    $sticky_header  = 'sticky-nav';
	} else {
	    $sticky_header = '';
	}
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt !='' ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }
    if(!is_front_page()) {
    	$not_frontpage = 'not-front-studio';
    } else {
    	$not_frontpage = '';
    }
?>
<div class="jt-head-studio <?php echo esc_attr($not_frontpage).' '.esc_attr($layout_structure).' padding-zero'; ?>">
<?php
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );
$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );

if( is_front_page() ) {
	if($banner_color_ot != '') {
		$banner_color_ot = $banner_color_ot;
	} else {
		$banner_color_ot = '';
	}
	$banner_type_ot = ot_get_option('banner_type');
	if (is_page()) {
		$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
	    if ($banner_type_mt == 'jt_hide_ban') {
	        $page_hav_banner = 'page_hav_banner';
	    } elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
	        $page_hav_banner = 'page_hav_banner';
	    } else {
	        $page_hav_banner = '';
	    }
	} elseif(!is_page()) {
	    if ($banner_type_ot == 'jt_hide_ban') {
	        $page_hav_banner = 'page_hav_banner';
	    } else {
	        $page_hav_banner = '';
	    }
	}
?>
<div class="jt-studio-banner-wrap" style="background: <?php echo esc_attr($banner_color_ot); ?>;">
<?php if ($page_hav_banner != 'page_hav_banner') { ?>
	<div class="jt-studio-banner">
		<?php
		if($banner_type_mt == 'img_ban' && $banner_image_mt) {
			$img=0;
			foreach($banner_image_mt as $vint_ban_mt) {
				$img++;
			}
			if($img <= 1) {
	    		foreach($banner_image_mt as $vint_ban_mt) {
	    	?>
		    	<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
		        </div>
	    	<?php }
	    	} elseif($img >= 2) { ?>
		    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
		        </div>
			<?php }
		} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
			$spc=0;
			foreach($special_banner_image_mt as $ban_spc_mt) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
				        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
				        </div>
			        <?php }
			        if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php }
		} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
		        $vid_ban_control = ot_get_option('vid_ban_control');
		        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
		        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
		        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
		        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
		        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
			<?php
		} elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
		    echo do_shortcode($banner_slide_mt);
		} elseif($banner_type_ot == 'img_ban' && $banner_image_ot) {
			$img=0;
			foreach($banner_image_ot as $vint_ban_ot) {
				$img++;
			}
			if($img <= 1) {
	    		foreach($banner_image_ot as $vint_ban_ot) {
	    	?>
		    	<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
		        </div>
	    	<?php }
	    	} elseif($img >= 2) { ?>
		    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
		        </div>
			<?php }
		} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
			$spc=0;
			foreach($special_banner_image_ot as $ban_spc_ot) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
				        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
				        </div>
			        <?php }
			        if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php }
		} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
		        $vid_ban_control = ot_get_option('vid_ban_control');
		        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
		        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
		        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
		        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
		        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
			<?php
		} elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
		    echo do_shortcode($banner_slide_ot);
		} else { ?>
			<div id="homeid" class="slider-container jt-vintage-banner jt-vint-small-banner">
			    <ul class="slider jt-animated-hand">
			        <li class="slide">
			            <div class="slide-bg" style="background: #ddd;"></div>
			        </li>
			    </ul>
		    </div>
		<?php }
		?>
	</div>
<?php } ?>
	<header class="jt-studio jt-studio-header sticky-nav">
	    <nav class="navbar navbar-default navbar-static-top">
	        <div class="navbar-header">
	            <?php
                $retina_logo = ot_get_option('retina_logo_upload');
                $default_logo = ot_get_option('logo_upload');
				$front_cus_enable = ot_get_option('front_cus_enable');
		        $front_logo_upload = ot_get_option('front_logo_upload');
		        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

				if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
					if($front_retina_logo_upload != '') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				        </a>
					<?php } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
					if($front_retina_logo_upload != '') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				        </a>
					<?php } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
					if($retina_logo != '') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				        </a>
					<?php } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } elseif(is_front_page()) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php }

				if(!is_front_page() && $default_logo != '') {
					if($retina_logo) { ?>
					    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					</a>
				<?php } elseif(!is_front_page() && $default_logo =='') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
					  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					</a>
				<?php } elseif(!is_front_page()) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } ?>
	        </div>
	        <div id="main-nav" class="collapse navbar-collapse">
	            <?php
	            global $post;
	            if (is_page()) {
	            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
		            if ($choose_menu) {
		            	$jt_choose_menu = $choose_menu;
		            } else {
		            	$jt_choose_menu = '';
		            }
	            } else {
	            	$jt_choose_menu = '';
	            }
	            wp_nav_menu(
                    array(
                        'walker'            => new wp_bootstrap_navwalker(),
                        'theme_location'    => 'main-menu',
                        'menu'    			=> $jt_choose_menu,
                        'menu_class'        => 'nav navbar-nav navbar-right jt-main-nav',
                        'menu_id'           => 'menu-create-menu',
                        'container_class'   => 'navbar-left menu-main-menu-container',
                        'fallback_cb'       => false,
                    )
                );
                $head_search = ot_get_option('search_enable');
                $head_lang = ot_get_option('lang_enable');
                if( $head_search == 'on' || $head_lang == 'on' ) {
	            ?>
	            <div class="menu-metas navbar-default navbar-right">
	                <ul class="navbar-nav">
	                	<?php if( $head_search == 'on' ) { ?>
	                    <li id="top-search" class="jt-menu-search">
	                        <a href="#0" id="top-search-trigger">
	                            <i class="fa fa-search"></i>
	                            <i class="pe-7s-close"></i>
	                        </a>
	                        <form class="container search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
								<input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
							</form>
	                    </li>
	                    <?php } else { } ?>
	                </ul>
	                <?php if( $head_lang == 'on' ) {
            	    	dynamic_sidebar( 'lang_widget' );
            		} ?>
	            </div>
	            <?php } ?>
	        </div>
	    </nav>
	</header>
    <!-- Slim Menu -->
    <div class="hidden-big-screen ">
        <div class="sticky-nav">
            <?php
            $retina_logo = ot_get_option('retina_logo_upload');
            $default_logo = ot_get_option('logo_upload');
			$front_cus_enable = ot_get_option('front_cus_enable');
	        $front_logo_upload = ot_get_option('front_logo_upload');
	        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

			if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
				if($retina_logo != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }

			if(!is_front_page() && $default_logo != '') {
				if($retina_logo) { ?>
				    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page() && $default_logo =='') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
				  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }
			global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
            wp_nav_menu(
                array(
                    'walker'            => new wp_bootstrap_navwalker(),
                    'theme_location'    => 'main-menu',
                    'menu'    			=> $jt_choose_menu,
                    'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
                    'menu_id'           => 'menu-main-menu',
                    'container_class'   => 'menu-main-menu-container',
                    'fallback_cb'       => false,
                    'sub_menu'			=> true,
                    'depth'				=> 5
                )
            );
            $head_search = ot_get_option('search_enable');
            $head_lang = ot_get_option('lang_enable');
            ?>
            <div class="menu-metas navbar-default navbar-right jt-slim-meta">
        	    <?php if( $head_lang == 'on' ) {
        	    	dynamic_sidebar( 'lang_widget' );
        		} ?>
        		<ul class="navbar-nav">
	        		<?php if( $head_search == 'on' ) { ?>
	        		    <li id="top-search-slim" class="jt-menu-search">
	        		        <a href="#0" id="top-search-trigger-slim">
	        		            <i class="fa fa-search"></i>
	        		            <i class="pe-7s-close"></i>
	        		        </a>
	        		        <form class="container search-new" method="get" action="<?php echo esc_url(home_url('/')); ?>" >
	        		            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
	        		        </form>
	        		    </li>
	        		<?php } else { } ?>
        		</ul>
            </div>
        </div>
    </div>
    <?php if($banner_type_mt == '') {
    $page_title = ot_get_option('page_title');
	?>
	    <!-- /Slim Menu -->
		<div class="jt-studio-head">
			<?php
			if($banner_type_ot != 'sld_ban') {
				if ($page_title != 'off') {
					if(is_front_page() || is_home() || is_post_type_archive() || is_tax()) { ?>
						<div class="jt-small-content">
			        		<div class="jt-studio-sub">
				        		<h3 class="page_sub_heading"><?php echo bloginfo('description'); ?></h3>
				            	<h1 class="page_heading"><?php echo bloginfo(''); ?></h1>
			        		</div>
			        	</div>
				    <?php } else { ?>
						<div class="jt-small-content">
			        		<div class="jt-studio-sub">
				            	<h1 class="page_heading"><?php echo the_title(); ?></h1>
				            	<h3 class="page_sub_heading"><?php echo bloginfo(''); ?></h3>
			        		</div>
			        	</div>
				    <?php
					}
				} // Hide Page Title
			}
		    ?>
		</div>
	<?php } ?>
</div>
<?php } else { // Not Front Page ?>
<header class="jt-studio jt-studio-header jt-studio-black <?php echo esc_attr($sticky_header); ?>">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <?php
            $retina_logo = ot_get_option('retina_logo_upload');
            $default_logo = ot_get_option('logo_upload');
              if($default_logo) {
				if($retina_logo) { ?>
		            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		                <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		            </a>
				<?php } ?>
	            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
	              <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
	            </a>
            <?php } else { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
				  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
            <?php } ?>
        </div>
        <div id="main-nav" class="collapse navbar-collapse">
            <?php
            global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
            wp_nav_menu(
                array(
                    'walker'            => new wp_bootstrap_navwalker(),
                    'theme_location'    => 'main-menu',
                    'menu'    			=> $jt_choose_menu,
                    'menu_class'        => 'nav navbar-nav navbar-right jt-main-nav',
                    'menu_id'           => 'menu-create-menu',
                    'container_class'   => 'navbar-left menu-main-menu-container',
                    'fallback_cb'       => false,
                )
            );
            $head_search = ot_get_option('search_enable');
            $head_lang = ot_get_option('lang_enable');
            if( $head_search == 'on' || $head_lang == 'on' ) {
            ?>
	            <div class="menu-metas navbar-default navbar-right">
	        	    <?php
	        		if( $head_search == 'on' ) { ?>
	                <ul class="navbar-nav">
	                    <li id="top-search" class="jt-menu-search">
	                        <a href="#0" id="top-search-trigger">
	                            <i class="fa fa-search"></i>
	                            <i class="pe-7s-close"></i>
	                        </a>
	                        <form class="container search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
								<input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
							</form>
	                    </li>
	                </ul>
	                <?php }
	                if( $head_lang == 'on' ) {
	        	    	dynamic_sidebar( 'lang_widget' );
	        		}?>
	            </div>
            <?php } ?>
        </div>
    </nav>
</header>
<!-- Slim Menu -->
<div class="hidden-big-screen">
    <div class="sticky-nav">
        <?php
        $retina_logo = ot_get_option('retina_logo_upload');
        $default_logo = ot_get_option('logo_upload');
		if($default_logo) {
			if($retina_logo) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
                    <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
                </a>
			<?php } ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
              <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
            </a>
        <?php } else { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
        <?php }
        global $post;
        if (is_page()) {
        	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
            if ($choose_menu) {
            	$jt_choose_menu = $choose_menu;
            } else {
            	$jt_choose_menu = '';
            }
        } else {
        	$jt_choose_menu = '';
        }
        wp_nav_menu(
            array(
                'walker'            => new wp_bootstrap_navwalker(),
                'theme_location'    => 'main-menu',
                'menu'    			=> $jt_choose_menu,
                'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
                'menu_id'           => 'menu-main-menu',
                'container_class'   => 'menu-main-menu-container',
                'fallback_cb'       => false,
                'sub_menu'			=> true,
                'depth'				=> 5
            )
        );
		$head_search = ot_get_option('search_enable');
		$head_lang = ot_get_option('lang_enable');
		if( $head_search == 'on' || $head_lang == 'on' ) {
		?>
		<div class="menu-metas navbar-default navbar-right jt-slim-meta">
		    <?php if( $head_lang == 'on' ) {
		    	dynamic_sidebar( 'lang_widget' );
			} ?>
			<ul class="navbar-nav">
			<?php if( $head_search == 'on' ) { ?>
			    <li id="top-search-slim" class="jt-menu-search">
			        <a href="#0" id="top-search-trigger-slim">
			            <i class="fa fa-search"></i>
			            <i class="pe-7s-close"></i>
			        </a>
			        <form class="container search-new" method="get" action="<?php echo esc_url(home_url('/')); ?>" >
			            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
			        </form>
			    </li>
			<?php } else { } ?>
			</ul>
		</div>
		<?php } ?>
    </div>
</div>
<!-- /Slim Menu -->
<?php
if(is_page()) {
	if($banner_type_mt != '' && $banner_color_mt != '') { ?>
		<style>
			.jt-studio-banner-small {
				background: <?php echo esc_attr($banner_color_mt); ?>;
			}
		</style>
	<?php } elseif($banner_type_mt == '' && $banner_color_mt == '' && $banner_color_ot != '') { ?>
		<style>
			.jt-studio-banner-small {
				background: <?php echo esc_attr($banner_color_ot); ?>;
			}
		</style>
	<?php }
} else {
	if($banner_color_ot != '') {
	?>
		<style>
			.jt-studio-banner-small {
				background: <?php echo esc_attr($banner_color_ot); ?>;
			}
		</style>
	<?php }
}
if(!is_page_template( 'template-one-page-architecture.php' )) {
	if (is_page()) {
	    if ($banner_type_mt == 'jt_hide_ban') {
	        $page_hav_banner = 'page_hav_banner';
	    } elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
	        $page_hav_banner = 'page_hav_banner';
	    } else {
	        $page_hav_banner = '';
	    }
	} elseif(!is_page()) {
	    if ($banner_type_ot == 'jt_hide_ban') {
	        $page_hav_banner = 'page_hav_banner';
	    } else {
	        $page_hav_banner = '';
	    }
	}
if ($page_hav_banner != 'page_hav_banner') {
?>
	<div class="jt-studio-banner-small jt-small-studio">
	<?php
		if($banner_type_mt == 'img_ban' && $banner_image_mt) {
			$img=0;
			foreach($banner_image_mt as $ban_img_mt) {
				$img++;
			}
			if($img <= 1) {
				foreach($banner_image_mt as $vint_ban_mt) {
			?>
				<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;"></div>
			<?php }
			} elseif($img >= 2) { ?>
				<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
					<ul class="slider jt-animated-hand">
					    <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					            </div>
					        </li>
					    <?php } ?>
					</ul>
				</div>
			<?php }
		} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
			$spc=0;
			foreach($special_banner_image_mt as $ban_spc_mt) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
				        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
				        </div>
			        <?php }
			        if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php } ?>
				</div>
			<?php }
		} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
		        $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
		        $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
		        $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
		        $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
		        $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
		        $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
		        $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
		<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
				echo do_shortcode($banner_slide_mt);
			} elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
		        echo do_shortcode($banner_shortcode_mt);
		    } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) { $img=0;
				foreach($banner_image_ot as $ban_img_ot) {
					$img++;
				}
				if($img <= 1) {
					foreach($banner_image_ot as $vint_ban_ot) {
				?>
					<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
					</div>
				<?php }
				} elseif($img >= 2) { ?>
					<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
						<ul class="slider jt-animated-hand">
						    <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
						        <li class="slide">
						            <div class="slide-bg">
						                <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
						            </div>
						        </li>
						    <?php } ?>
						</ul>
					</div>
				<?php }
			} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
	            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
	                <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
	            <?php } ?>
		        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
		            <canvas id="juster-canvas-one"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
		            <canvas id="juster-canvas-two"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
		            <canvas id="juster-canvas-three"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
		            <canvas id="juster-canvas-four"></canvas>
		        <?php } ?>
				</div>
		<?php } elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
		        $vid_ban_control = ot_get_option('vid_ban_control');
		        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
		        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
		        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
		        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
		        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
			</div>
		<?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
			    echo do_shortcode($banner_slide_ot);
			}

	    $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
	    $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
	    $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
	    $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
	    if( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading !='' ) {
	        $ban_text = 'jt-arch-bantext-1null';
	    } elseif( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading =='' ) {
	        $ban_text = 'jt-arch-bantext-2null';
	    } elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading !='' ) {
	        $ban_text = 'jt-arch-bantext-3null';
	    } elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading =='' ) {
	        $ban_text = 'jt-arch-bantext-4null';
	    } elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading !='' ) {
	        $ban_text = 'jt-arch-bantext-5null';
	    } elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading !='' ) {
	        $ban_text = 'jt-arch-bantext-6null';
	    } elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img == '' && $page_subheading !='' ) {
	        $ban_text = 'jt-arch-bantext-7null';
	    } elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img == '' && $page_subheading !='' ) {
	        $ban_text = 'jt-arch-bantext-8null';
	    } elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading =='' ) {
	        $ban_text = 'jt-arch-bantext-9null';
	    } elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading =='' ) {
	        $ban_text = 'jt-arch-bantext-10null';
	    } elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img == '' && $page_subheading =='' ) {
	        $ban_text = 'jt-arch-bantext-11null';
	    } else {
	        $ban_text = '';
	    }
	    $page_title = ot_get_option('page_title');
	    if(is_page() && $banner_type_mt != 'sld_ban') {
		?>
	    <div class="jt-small-content <?php echo esc_attr($ban_text); ?>">
	        <div class="jt-studio-sub">
		        <?php if($page_subheading) {
		        	echo '<h3 class="page_sub_heading">'.esc_attr($page_subheading).'</h3>';
		        }
		        if ($page_title != 'off' && $enable_new_page_title == 'off') {
					if(is_front_page()) { ?>
			    		<h2 class="page_heading"><?php bloginfo(''); ?></h2>
			    	<?php } else { ?>
			    		<h2 class="page_heading"><?php the_title(); ?></h2>
			    	<?php }
				} elseif($enable_new_page_title == 'on') {
					if($new_page_title != '') { ?>
						<h2 class="page_heading"><?php echo esc_attr($new_page_title); ?></h2>
					<?php } elseif($new_page_title == '') { ?>
						<h2 class="page_heading"><?php echo the_title(); ?></h2>
					<?php } elseif($page_title == 'off' && $new_page_title == '') {}
				} // Page Title Hide ?>
	        </div>
	        <?php
		        $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
		        if($header_banner_title_img) {
			?>
	        	<img src="<?php echo esc_attr($header_banner_title_img); ?>" alt="">
	        <?php } ?>
	    </div>
	    <?php }

	    if(!is_front_page() && !is_page() && $banner_type_ot != 'sld_ban') { ?>
		    <div class="jt-small-content not-page">
		        <div class="jt-studio-sub">
		        	<?php
		        	if ($page_title != 'off') {
						if(is_front_page()) { ?>
					    	<h1 class="page_heading"><?php bloginfo(''); ?></h1>
					    <?php } elseif (is_author()) { ?>
							<h1 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
						<?php
							} elseif (is_archive()) { ?>
							<h1 class="page_heading"><?php if ( is_day() ) {
									printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
								} elseif ( is_month() ) {
									printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
								} elseif ( is_year() ) {
									printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
								} else {
									echo __( 'Archives', 'juster' );
								} ?></h1>
						<?php
							} elseif (is_search()) { ?>
							<h1 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h1>
						<?php
							} elseif (is_category()) { ?>
								<h1 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
						<?php
							} elseif (is_tag()) { ?>
								<h1 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
						<?php
							} elseif(is_home()) { ?>
								<h1 class="page_heading"><?php bloginfo(''); ?></h1>
						<?php
							} else { ?>
								<h1 class="page_heading"><?php the_title(); ?></h1>
						<?php
							}
					} // Hide Page Title ?>
		        </div>
		    </div>
	    <?php }
	    if($banner_type_mt != '' && $banner_color_mt != '') {
	    	$banner_color = $banner_color_mt;
	    } elseif($banner_type_ot != '' && $banner_color_ot != '') {
	    	$banner_color = $banner_color_ot;
	    } else {
	    	$banner_color = '';
	    }
	    ?>
	    <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
	</div>
<?php }
} else { // !template-one-page-architecture
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	if($single_port_gallery != '') { ?>
		<div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($single_port_gallery as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
} // single-portfolio

} // !front-page ?>
</div>
<?php
	}
}

/*==========================================================================
	Header - Vintage Header / Left Side Menu / Right Side Menu
==========================================================================*/
if ( ! function_exists( 'menu_pos_vintage' ) ) {
	function menu_pos_vintage() {
?>
<div class="left-menu-wrap jt-dark-bg jt-vint-left-menu">
    <!-- Logo -->
    <div class="port-logo">
        <?php
        $retina_logo = ot_get_option('retina_logo_upload');
        $default_logo = ot_get_option('logo_upload');
		$front_cus_enable = ot_get_option('front_cus_enable');
        $front_logo_upload = ot_get_option('front_logo_upload');
        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

		if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
			if($retina_logo != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }

		if(!is_front_page() && $default_logo != '') {
			if($retina_logo) { ?>
			    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page() && $default_logo =='') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } ?>
    </div>
    <!-- Menu list -->
    <div class="left-menu-list">
        <nav class="navbar navbar-default navbar-static-top" >
                <div><!-- /.container -->
                    <div id="main-nav" class="collapse navbar-collapse">
                    	<?php
                    	global $post;
			            if (is_page()) {
			            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
				            if ($choose_menu) {
				            	$jt_choose_menu = $choose_menu;
				            } else {
				            	$jt_choose_menu = '';
				            }
			            } else {
			            	$jt_choose_menu = '';
			            }
                    	wp_nav_menu(
                    	    array(
                    	        'walker'            => new wp_bootstrap_navwalker(),
                    	        'theme_location'    => 'main-menu',
                    	        'menu'    			=> $jt_choose_menu,
                    	        'menu_class'        => 'nav navbar-nav navbar-right jt-main-nav',
                    	        'menu_id'           => 'menu-create-menu',
                    	        'container_class'   => 'menu-main-menu-container',
                    	        'fallback_cb'       => false,
                    	    )
                    	);
                    	?>
                    </div>
                </div><!-- /.container -->
            </nav>
    </div>
    <!-- Menu list -->

    <div class="contact-wrap">
        <?php
        $menu_position = ot_get_option('menu_position');
        $copyright_text = ot_get_option('copyright_text');
        if($menu_position == 'menu_pos_left_vintage') { ?>
	        <div class="jt-copy-right jt-dark-version">
	            <?php dynamic_sidebar( 'menu_pos_left_vintage_wid' ); ?>
	        </div>
        <?php } elseif($menu_position == 'menu_pos_right_vintage') { ?>
	        <div class="jt-copy-right jt-dark-version">
	            <?php dynamic_sidebar( 'menu_pos_right_vintage_wid' ); ?>
	        </div>
        <?php } ?>
    </div>
</div>
<!-- Slim Menu -->
<div class="hidden-side-big-screen ">
    <div class="sticky-nav jt-top-white">
        <?php
        $retina_logo = ot_get_option('retina_logo_upload');
        $default_logo = ot_get_option('logo_upload');
		$front_cus_enable = ot_get_option('front_cus_enable');
        $front_logo_upload = ot_get_option('front_logo_upload');
        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

		if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
			if($retina_logo != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }

		if(!is_front_page() && $default_logo != '') {
			if($retina_logo) { ?>
			    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page() && $default_logo =='') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }
		global $post;
        if (is_page()) {
        	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
            if ($choose_menu) {
            	$jt_choose_menu = $choose_menu;
            } else {
            	$jt_choose_menu = '';
            }
        } else {
        	$jt_choose_menu = '';
        }
		wp_nav_menu(
		    array(
		        'walker'            => new wp_bootstrap_navwalker(),
		        'theme_location'    => 'main-menu',
		        'menu'    			=> $jt_choose_menu,
		        'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-side-menu',
		        'menu_id'           => 'menu-main-menu',
		        'container_class'   => 'menu-main-menu-container',
		        'fallback_cb'       => false,
		        'sub_menu'  		=> true,
		        'depth' 			=> 5
		    )
		);
		?>
    </div>
</div>
<!-- /Slim Menu -->
<?php
	}
}

/*==========================================================================
	Header - Boxed Header
==========================================================================*/
if ( ! function_exists( 'menu_pos_boxed' ) ) {
	function menu_pos_boxed() {
    $sticky_header = ot_get_option('sticky_header');
    if($sticky_header == 'on') {
        $sticky_header = 'sticky-nav';
    } else {
        $sticky_header = '';
    }
?>
<div class="jt_box_header_content">
<header class="jt-box-top-header <?php echo esc_attr($sticky_header); ?>">
    <nav class="navbar navbar-default navbar-static-top">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <?php
            $retina_logo = ot_get_option('retina_logo_upload');
            $default_logo = ot_get_option('logo_upload');
			$front_cus_enable = ot_get_option('front_cus_enable');
	        $front_logo_upload = ot_get_option('front_logo_upload');
	        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

			if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
				if($retina_logo != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }

			if(!is_front_page() && $default_logo != '') {
				if($retina_logo) { ?>
				    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page() && $default_logo =='') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
				  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
        </div>
        <div id="main-nav" class="collapse navbar-collapse">
            <?php
            global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
            wp_nav_menu(
                array(
                    'walker'            => new wp_bootstrap_navwalker(),
                    'theme_location'    => 'main-menu',
                    'menu'    			=> $jt_choose_menu,
                    'menu_class'        => 'nav navbar-nav navbar-left jt-main-nav',
                    'menu_id'           => 'menu-create-menu',
                    'container_class'   => 'menu-main-menu-container',
                    'fallback_cb'       => false,
                )
            );
            ?>
            <!-- Menu Metas -->
            <?php
            $head_search = ot_get_option('search_enable');
            $head_cart = ot_get_option('cart_enable');
            $head_lang = ot_get_option('lang_enable');
            if( $head_search == 'on') {
            ?>
            <div class="menu-metas navbar-default navbar-right">
                <ul class="navbar-nav">
                    <li id="top-search" class="jt-menu-search">
                        <a href="#0" id="top-search-trigger">
                            <i class="fa fa-search"></i>
                            <i class="pe-7s-close"></i>
                        </a>
                        <form class="container search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" >
                            <input type="text" name="s" class="form-control" value="" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
                        </form>
                    </li>
                </ul>
            </div> <!-- Menu Metas -->
            <?php }
            if( $head_lang == 'on' ) {
            	dynamic_sidebar( 'menu_pos_top_boxed' );
        	}

            $head_search = ot_get_option('search_enable');
            $head_cart = ot_get_option('cart_enable');
            if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) {
            ?>
            <div class="menu-metas navbar-default navbar-right">
                <ul class="navbar-nav">
                    <li id="jt-top-cart" class="jt-menu-cart">
	                    <?php woocommerce_cart_button(); ?>
	                    <div class="top-cart-content">
	                        <?php woocommerce_cart_widget(); ?>
	                    </div>
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </nav>
    <!-- Slim Menu -->
    <div class="hidden-big-screen ">
        <div class="sticky-nav jt-slim-top">
            <?php
            $retina_logo = ot_get_option('retina_logo_upload');
            $default_logo = ot_get_option('logo_upload');
			$front_cus_enable = ot_get_option('front_cus_enable');
	        $front_logo_upload = ot_get_option('front_logo_upload');
	        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

			if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
				if($front_retina_logo_upload != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
				if($retina_logo != '') { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			        </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } elseif(is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }

			if(!is_front_page() && $default_logo != '') {
				if($retina_logo) { ?>
				    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
				        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				    </a>
				<?php } ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
				  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page() && $default_logo =='') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
				  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
				</a>
			<?php } elseif(!is_front_page()) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php }
			global $post;
            if (is_page()) {
            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
	            if ($choose_menu) {
	            	$jt_choose_menu = $choose_menu;
	            } else {
	            	$jt_choose_menu = '';
	            }
            } else {
            	$jt_choose_menu = '';
            }
            wp_nav_menu(
                array(
                    'walker'            => new wp_bootstrap_navwalker(),
                    'theme_location'    => 'main-menu',
                    'menu'    			=> $jt_choose_menu,
                    'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-top-slimmenu',
                    'menu_id'           => 'menu-main-menu',
                    'container_class'   => 'menu-main-menu-container',
                    'fallback_cb'       => false,
                    'sub_menu' 			=> true,
                    'depth' 			=> 5
                )
            );
            ?>
			<div class="menu-metas navbar-default navbar-right jt-slim-meta">
				<?php
		            $head_search = ot_get_option('search_enable');
		            $head_cart = ot_get_option('cart_enable');
		            if( $head_search == 'on') {
		            ?>
	                <ul class="navbar-nav">
	                    <li id="top-search-slim" class="jt-menu-search">
	                        <a href="#0" id="top-search-trigger-slim">
	                            <i class="fa fa-search"></i>
	                            <i class="pe-7s-close"></i>
	                        </a>
	                        <form class="container search-new" method="get" action="<?php echo esc_url(home_url('/')); ?>" >
	                            <input type="text" name="s" class="form-control" value="" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
	                        </form>
	                    </li>
	                </ul>
		            <?php } ?>
		            <div class="dropdown jt-slim-drop">
						<?php dynamic_sidebar('menu_pos_top_boxed'); ?>
					</div>
					<?php
                    $head_search = ot_get_option('search_enable');
                    $head_cart = ot_get_option('cart_enable');
                    if($head_cart == 'on' && class_exists( 'WooCommerce' ) ) {
                    ?>
                    <ul class="navbar-nav">
                        <li id="jt-top-cart-slim" class="jt-menu-cart-slim">
    	                    <?php woocommerce_cart_button_slim(); ?>
    	                    <div class="top-cart-content">
    	                        <?php woocommerce_cart_widget(); ?>
    	                    </div>
                        </li>
                    </ul>
                    <?php }
                ?>
			</div>

        </div>
    </div>
    <!-- /Slim Menu -->
</header>
<?php
global $post;
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );

if(is_home() || is_post_type_archive() || is_tax()) {
	$cus_class = ' cus_boxed_banner_content';
} else {
	$cus_class = '';
}

if(!is_singular('portfolio')) {
	if(!is_page_template( 'template-one-page-architecture.php' )) {
		if($banner_type_mt == 'img_ban' && $banner_image_mt) {
			$img=0;
			foreach($banner_image_mt as $ban_img_mt) {
				$img++;
			}
			if($img <= 1) { ?>
				<div class="slider-container jt-vintage-banner jt-vint-small-banner">
					<?php foreach($banner_image_mt as $vint_ban_mt) { ?>
						<div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
						</div>
					<?php }
					if($banner_color_mt != '') {
						$banner_color_mt = 'background: '.$banner_color_mt.';';
					} else {
						$banner_color_mt = '';
					}
					$page_title = ot_get_option('page_title');
					?>
					<div class="banner-overlay" style="<?php echo esc_attr($banner_color_mt); ?>"></div>
					<?php echo juster_boxed_title(); ?>
				</div>
			<?php } elseif($img >= 2) { ?>
				<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
					<ul class="slider jt-animated-hand">
					    <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
					        <li class="slide">
					            <div class="slide-bg">
					                <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					            </div>
					        </li>
					    <?php } ?>
					</ul>
					<?php
					if($banner_color_mt != '') {
						$banner_color_mt = 'background: '.$banner_color_mt.';';
					} else {
						$banner_color_mt = '';
					}
					?>
					<div class="banner-overlay" style="<?php echo esc_attr($banner_color_mt); ?>"></div>
					<?php echo juster_boxed_title(); ?>
				</div>
			<?php }
		} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
			$spc=0;
			foreach($special_banner_image_mt as $ban_spc_mt) {
				$spc++;
			}
			if($spc <= 1) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
				        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
				        </div>
			        <?php }
			        if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php }
					if($banner_color_mt != '') {
						$banner_color_mt = 'background: '.$banner_color_mt.';';
					} else {
						$banner_color_mt = '';
					}
					?>
					<div class="banner-overlay" style="<?php echo esc_attr($banner_color_mt); ?>"></div>
				</div>
			<?php } elseif($spc >= 2) { ?>
				<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <ul class="slider jt-animated-hand">
			            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
			                <li class="slide">
			                    <div class="slide-bg">
			                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                    </div>
			                </li>
			            <?php } ?>
			        </ul>
			        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
			            <canvas id="juster-canvas-one"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
			            <canvas id="juster-canvas-two"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
			            <canvas id="juster-canvas-three"></canvas>
			        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
			            <canvas id="juster-canvas-four"></canvas>
			        <?php }
					if($banner_color_mt != '') {
						$banner_color_mt = 'background: '.$banner_color_mt.';';
					} else {
						$banner_color_mt = '';
					}
					?>
					<div class="banner-overlay" style="<?php echo esc_attr($banner_color_mt); ?>"></div>
				</div>
			<?php }
		} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
		        $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
		        $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
		        $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
		        $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
		        $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
		        $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
		        $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
		        if($vid_ban_control) {
		            $vid_ban_control = 'true';
		        } else {
		            $vid_ban_control = 'false';
		        }
		        if($vid_ban_auto_play) {
		            $vid_ban_auto_play = 'true';
		        } else {
		            $vid_ban_auto_play = 'false';
		        }
		        if($vid_ban_vid_loop) {
		            $vid_ban_vid_loop = 'true';
		        } else {
		            $vid_ban_vid_loop = 'false';
		        }
		        if($vid_ban_aud_mute) {
		            $vid_ban_aud_mute = 'true';
		        } else {
		            $vid_ban_aud_mute = 'false';
		        }
		        if($vid_ban_start_time) {
		            $vid_ban_start_time = $vid_ban_start_time;
		        } else {
		            $vid_ban_start_time = '0';
		        }
		        if($vid_ban_vid_qty) {
		            $vid_ban_vid_qty = $vid_ban_vid_qty;
		        } else {
		            $vid_ban_vid_qty = 'default';
		        }
		    ?>
		    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
		        </a>
		        <?php
		        if($banner_color_mt != '') {
					$banner_color_mt = 'background: '.$banner_color_mt.';';
				} else {
					$banner_color_mt = '';
				}
				?>
				<div class="banner-overlay" style="<?php echo esc_attr($banner_color_mt); ?>"></div>
				<?php echo juster_boxed_title(); ?>
			</div>
		<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') { ?>
				<div class="slider-container jt-vintage-banner jt-vint-small-banner banner-rev-slide">
					<?php
					if($banner_color_mt != '') {
						$banner_color_mt = 'background: '.$banner_color_mt.';';
					} else {
						$banner_color_mt = '';
					}
					echo do_shortcode($banner_slide_mt);
					?>
					<div class="banner-overlay" style="<?php echo esc_attr($banner_color_mt); ?>"></div>
				</div>
		<?php } elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') { ?>
				<div class="slider-container jt-vintage-banner jt-vint-small-banner">
					<?php
					if($banner_color_mt != '') {
						$banner_color_mt = 'background: '.$banner_color_mt.';';
					} else {
						$banner_color_mt = '';
					}
					echo do_shortcode($banner_shortcode_mt);
					?>
					<div class="banner-overlay" style="<?php echo esc_attr($banner_color_mt); ?>"></div>
				</div>
		<?php } elseif($banner_type_ot == 'img_ban' && $banner_type_mt != 'jt_hide_ban' && $banner_image_ot) {
    	$img=0;
		foreach($banner_image_ot as $ban_img_ot) {
			$img++;
		}
		if($img <= 1) { ?>
	    	<div class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
			        </div>
		        <?php }
		        if($banner_color_ot != '') {
					$banner_color_ot = 'background: '.$banner_color_ot.';';
				} else {
					$banner_color_ot = '';
				}
				$page_title = ot_get_option('page_title');
				?>
				<div class="banner-overlay" style="<?php echo esc_attr($banner_color_ot); ?>"></div>
				<?php echo juster_boxed_title(); ?>
	        </div>
		<?php } elseif($img >= 2) { ?>
	    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <ul class="slider jt-animated-hand">
		            <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
		                <li class="slide">
		                    <div class="slide-bg">
		                        <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
		                    </div>
		                </li>
		            <?php } ?>
		        </ul>
		        <?php
		        if($banner_color_ot != '') {
					$banner_color_ot = 'background: '.$banner_color_ot.';';
				} else {
					$banner_color_ot = '';
				}
				?>
				<div class="banner-overlay" style="<?php echo esc_attr($banner_color_ot); ?>"></div>
				<?php echo juster_boxed_title(); ?>
	        </div>
		<?php }
	} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
		$spc=0;
		foreach($special_banner_image_ot as $ban_spc_ot) {
			$spc++;
		}
		if($spc <= 1) { ?>
			<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
			        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
			        </div>
		        <?php }
		        if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
		            <canvas id="juster-canvas-one"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
		            <canvas id="juster-canvas-two"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
		            <canvas id="juster-canvas-three"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
		            <canvas id="juster-canvas-four"></canvas>
		        <?php }
		        if($banner_color_ot != '') {
					$banner_color_ot = 'background: '.$banner_color_ot.';';
				} else {
					$banner_color_ot = '';
				}
				?>
				<div class="banner-overlay" style="<?php echo esc_attr($banner_color_ot); ?>"></div>
				<?php echo juster_boxed_title(); ?>
			</div>
		<?php } elseif($spc >= 2) { ?>
			<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
		        <ul class="slider jt-animated-hand">
		            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
		                <li class="slide">
		                    <div class="slide-bg">
		                        <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
		                    </div>
		                </li>
		            <?php } ?>
		        </ul>
		        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
		            <canvas id="juster-canvas-one"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
		            <canvas id="juster-canvas-two"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
		            <canvas id="juster-canvas-three"></canvas>
		        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
		            <canvas id="juster-canvas-four"></canvas>
		        <?php }
		        if($banner_color_ot != '') {
					$banner_color_ot = 'background: '.$banner_color_ot.';';
				} else {
					$banner_color_ot = '';
				}
				?>
				<div class="banner-overlay" style="<?php echo esc_attr($banner_color_ot); ?>"></div>
				<?php echo juster_boxed_title(); ?>
			</div>
		<?php }
	} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
	        $vid_ban_control = ot_get_option('vid_ban_control');
	        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
	        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
	        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
	        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
	        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
	        if($vid_ban_control) {
	            $vid_ban_control = 'true';
	        } else {
	            $vid_ban_control = 'false';
	        }
	        if($vid_ban_auto_play) {
	            $vid_ban_auto_play = 'true';
	        } else {
	            $vid_ban_auto_play = 'false';
	        }
	        if($vid_ban_vid_loop) {
	            $vid_ban_vid_loop = 'true';
	        } else {
	            $vid_ban_vid_loop = 'false';
	        }
	        if($vid_ban_aud_mute) {
	            $vid_ban_aud_mute = 'true';
	        } else {
	            $vid_ban_aud_mute = 'false';
	        }
	        if($vid_ban_start_time) {
	            $vid_ban_start_time = $vid_ban_start_time;
	        } else {
	            $vid_ban_start_time = '0';
	        }
	        if($vid_ban_vid_qty) {
	            $vid_ban_vid_qty = $vid_ban_vid_qty;
	        } else {
	            $vid_ban_vid_qty = 'default';
	        }
	    ?>
	    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
	        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
	        </a>
	       	<?php
	       	if($banner_color_ot != '') {
				$banner_color_ot = 'background: '.$banner_color_ot.';';
			} else {
				$banner_color_ot = '';
			}
			?>
			<div class="banner-overlay" style="<?php echo esc_attr($banner_color_ot); ?>"></div>
			<?php echo juster_boxed_title(); ?>
		</div>
	<?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') { ?>
		<div class="slider-container jt-vintage-banner jt-vint-small-banner banner-rev-slide">
			<?php
			if($banner_color_ot != '') {
				$banner_color_ot = 'background: '.$banner_color_ot.';';
			} else {
				$banner_color_ot = '';
			}
			echo do_shortcode($banner_slide_ot);
			?>
			<div class="banner-overlay" style="<?php echo esc_attr($banner_color_ot); ?>"></div>
			<?php echo juster_boxed_title(); ?>
		</div>
	<?php } // Banner done.
	} // !template-one-page-architecture
} elseif(is_singular('portfolio')) { // single portfolio slider on header
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
	if($single_port_gallery != '') { ?>
		<div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($single_port_gallery as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
} // single-portfolio
?>
</div>
<?php
	}
}

/*==========================================================================
	Header - Shop Header
==========================================================================*/
if ( ! function_exists( 'menu_pos_shop' ) ) {
	function menu_pos_shop() {
	global $post;
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid';
            } elseif( $layout_model_ot === 'full-width' ) {
	            $layout_structure = 'container';
	        } elseif( $layout_model_ot === 'extra-width' ) {
	            $layout_structure = 'container-fluid padding-zero';
	        } else {
                $layout_structure = 'container';
            }
        } elseif( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    } elseif ( !is_page() ) {
        if( $layout_model_ot ) {
            if( $layout_model_ot === 'full-width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_ot === 'extra-width' ) {
                $layout_structure = 'container-fluid';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }

?>
<div class="<?php echo esc_attr($layout_structure); ?> padding-zero jt-shop-header">
<div class="jt-shop-top-head-wrap">
	<div class="jt-shop-top-header jt-box-top-header">
		<div class="container">
			<nav class="navbar navbar-default navbar-static-top">
	    		<div class="col-lg-8 col-md-7 col-sm-6 padding-zero">
	    			<div class="jt-free-ship">
		    			<?php dynamic_sidebar( 'topleft-widget-shop' ); ?>
	    			</div>
	    		</div>
	    		<div class="col-lg-4 col-md-5 col-sm-6 padding-zero">
					<?php dynamic_sidebar( 'topright-widget-shop' ); ?>
	    		</div>
			</nav>
		</div> <!-- /Container -->
	</div> <!-- /Top Menu Bar -->
	<!-- Logo and Cart -->
	<div class="container">
		<div class="jt-shop-cart">
			<div class="col-lg-6 col-md-6 col-sm-6 padding-zero">
				<div class="jt-shop-logo">
	    			<?php
		            $retina_logo = ot_get_option('retina_logo_upload');
		            $default_logo = ot_get_option('logo_upload');
					$front_cus_enable = ot_get_option('front_cus_enable');
			        $front_logo_upload = ot_get_option('front_logo_upload');
			        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

					if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
						if($front_retina_logo_upload != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
						if($retina_logo != '') { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					        </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } elseif(is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php }

					if(!is_front_page() && $default_logo != '') {
						if($retina_logo) { ?>
						    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
						        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						    </a>
						<?php } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
						  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page() && $default_logo =='') { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
						  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
						</a>
					<?php } elseif(!is_front_page()) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
					        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
					    </a>
					<?php } ?>
	    		</div>
			</div>
			<?php
			$head_wish = ot_get_option('wishlist_enable');
			$head_cart = ot_get_option('cart_enable');
			$head_wish_text = ot_get_option('wishlist_enable_text');
	            if( $head_cart == 'on' || $head_wish == 'on') {
			?>
			<div class="col-lg-6 col-md-6 col-sm-6 padding-zero">
				<div class="menu-metas navbar-default navbar-right">
					<ul class="navbar-nav">
						<?php if($head_wish == 'on') { ?>
						<li>
							<?php
	                    	if( function_exists('YITH_WCWL') ) {
	                    		$wishlist_url = YITH_WCWL()->get_wishlist_url();
	                    	} else {
	                    		$wishlist_url = '';
	                    	}
							?>
	                        <a href="<?php echo esc_url($wishlist_url); ?>">
	                        	<i class="fa fa-heart-o fa-hover-hidden fa-fw"></i>
	                        	<i class="fa fa-heart fa-hover-show fa-fw"></i>
	                        	<?php
	                        	if($head_wish_text != '') {
	                        		$head_wish_text = $head_wish_text;
	                        	} else {
	                        		$head_wish_text = __('Wishlist', 'juster');
	                        	}
	                        	?>
	                            <span><?php echo esc_attr($head_wish_text); ?></span>
	                        </a>
	                    </li>
	                    <?php }
	                    if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
	                    <li id="jt-top-cart" class="jt-menu-cart">
	                            <?php woocommerce_cart_button(); ?>
	                        <div class="top-cart-content">
	                            <?php woocommerce_cart_widget(); ?>
	                        </div>
	                    </li>
	                    <?php } ?>
	                </ul>
	            </div> <!-- /Nav Bar -->
			</div> <!-- /Column -->
			<?php } ?>
		</div> <!-- /Shop Cart -->
	</div> <!-- /Container -->
	<?php
	$sticky_header = ot_get_option('sticky_header');
	if($sticky_header == 'on') {
		$sticky_header = 'sticky-nav';
	} else {
		$sticky_header = '';
	}
	?>
	<div class="jt-shop-menu-wrap jt-box-top-header <?php echo esc_attr($sticky_header); ?>">
		<div class="container padding-zero">
			<nav class="navbar navbar-default navbar-static-top">
				<div id="main-nav" class="collapse navbar-collapse">
	                <?php
	                global $post;
		            if (is_page()) {
		            	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
			            if ($choose_menu) {
			            	$jt_choose_menu = $choose_menu;
			            } else {
			            	$jt_choose_menu = '';
			            }
		            } else {
		            	$jt_choose_menu = '';
		            }
	                wp_nav_menu(
		                array(
		                    'walker'            => new wp_bootstrap_navwalker(),
		                    'theme_location'    => 'main-menu',
		                    'menu'    			=> $jt_choose_menu,
		                    'menu_class'        => 'nav navbar-nav navbar-left jt-main-nav',
		                    'menu_id'           => 'menu-create-menu',
		                    'container_class'   => 'menu-main-menu-container',
		                    'fallback_cb'       => false,
		                )
		            );
		            $head_search = ot_get_option('search_enable');
		            if( $head_search == 'on' ) {
		            ?>
	                <div class="menu-metas navbar-default navbar-right jt-shop-search">
						<ul class="navbar-nav">
							<li id="top-search" class="jt-menu-search">
								<a href="#0" id="top-search-trigger">
									<img src="<?php echo IMAGES; ?>/icons/search-shop.png" alt="<?php echo __('Search', 'juster'); ?>">
									<i class="pe-7s-close"></i>
								</a>
								<form class="container search-new" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" >
		                            <input type="text" name="s" class="form-control" placeholder="<?php echo __('Type & Hit Enter..', 'juster'); ?>">
		                        </form>
							</li>
						</ul>
					</div>
					<?php } ?>
				</div>
			</nav>
		</div>
	</div> <!-- /Menu List -->
</div>
<!-- Slim Menu -->
<div class="hidden-big-screen ">
    <div class="jt-shop-top-header jt-box-top-header">
    	<div class="container">
			<nav class="navbar navbar-default navbar-static-top">
	    		<div class="col-lg-8 col-md-7 col-sm-6 padding-zero">
	    			<div class="jt-free-ship">
		    			<?php dynamic_sidebar( 'topleft-widget-shop' ); ?>
	    			</div>
	    		</div>
	    		<div class="col-lg-4 col-md-5 col-sm-6 padding-zero">
					<?php dynamic_sidebar( 'topright-widget-shop' ); ?>
	    		</div>
			</nav>
    	</div>
    </div>
    <div class="menu-metas navbar-default navbar-right jt-slim-meta jt-slim-icons">
		<ul class="navbar-nav">
			<?php if($head_wish == 'on') { ?>
			<li>
				<?php
            	if( function_exists('YITH_WCWL') ) {
            		$wishlist_url = YITH_WCWL()->get_wishlist_url();
            	} else {
            		$wishlist_url = '';
            	}
				?>
                <a href="<?php echo esc_url($wishlist_url); ?>">
                	<i class="fa fa-heart-o fa-hover-hidden fa-fw"></i>
                	<i class="fa fa-heart fa-hover-show fa-fw"></i>
                	<?php
                	if($head_wish_text != '') {
                		$head_wish_text = $head_wish_text;
                	} else {
                		$head_wish_text = __('Wishlist', 'juster');
                	}
                	?>
                    <span><?php echo esc_attr($head_wish_text); ?></span>
                </a>
            </li>
            <?php }
            if( $head_cart == 'on' && class_exists( 'WooCommerce' ) ) { ?>
            <li id="jt-top-cart-slim" class="jt-menu-cart-slim">
                    <?php woocommerce_cart_button_slim(); ?>
                <div class="top-cart-content">
                    <?php woocommerce_cart_widget(); ?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="sticky-nav jt-slim-top">
		<?php
        $retina_logo = ot_get_option('retina_logo_upload');
        $default_logo = ot_get_option('logo_upload');
		$front_cus_enable = ot_get_option('front_cus_enable');
        $front_logo_upload = ot_get_option('front_logo_upload');
        $front_retina_logo_upload = ot_get_option('front_retina_logo_upload');

		if(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($front_logo_upload); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'on' && $front_logo_upload == '' && $default_logo != '') {
			if($front_retina_logo_upload != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($front_retina_logo_upload); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page() && $front_cus_enable == 'off' && $default_logo != '') {
			if($retina_logo != '') { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		            <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		        </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php } elseif(is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }

		if(!is_front_page() && $default_logo != '') {
			if($retina_logo) { ?>
			    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
			        <img src="<?php echo esc_url($retina_logo); ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			    </a>
			<?php } ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo default-logo">
			  <img src="<?php echo esc_url($default_logo); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page() && $default_logo =='') { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo">
			  <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
			</a>
		<?php } elseif(!is_front_page()) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="default navbar-logo retina-logo">
		        <img src="<?php echo IMAGES.'/logo.png'; ?>" width="<?php echo esc_attr(str_replace( "px", "", $retina_logo_width )); ?>" height="<?php echo esc_attr(str_replace( "px", "", $retina_logo_height )); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>" />
		    </a>
		<?php }
		global $post;
        if (is_page()) {
        	$choose_menu = get_post_meta( $post->ID, 'choose_menu', true );
            if ($choose_menu) {
            	$jt_choose_menu = $choose_menu;
            } else {
            	$jt_choose_menu = '';
            }
        } else {
        	$jt_choose_menu = '';
        }
        wp_nav_menu(
            array(
                'walker'            => new wp_bootstrap_navwalker(),
                'theme_location'    => 'main-menu',
                'menu'    			=> $jt_choose_menu,
                'menu_class'        => 'nav navbar-nav navbar-right jt-agency-menu-list slimmenu jt-slimmenu jt-top-slimmenu',
                'menu_id'           => 'menu-main-menu',
                'container_class'   => 'menu-main-menu-container',
                'fallback_cb'       => false,
                'sub_menu' 			=> true,
                'depth' 			=> 5
            )
        );
        ?>
    </div>
</div>
<!-- /Slim Menu -->
<?php
if(!is_page_template('template-one-page-architecture.php')) {

global $post;
$banner_type_ot = ot_get_option('banner_type');
$banner_image_ot = ot_get_option('banner_image_ot');
$banner_type_spl_ot = ot_get_option('banner_type_spl');
$special_banner_image_ot = ot_get_option('special_banner_image');
$banner_video_ot = ot_get_option('video_banner');
$banner_slide_ot = ot_get_option('slider_banner');
$banner_color_ot = ot_get_option('banner_color_ot');

$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
$banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
$special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
$banner_video_mt = get_post_meta( get_the_ID(), 'banner_video_mt', true );
$banner_slide_mt = get_post_meta( get_the_ID(), 'banner_slide_mt', true );
$banner_shortcode_mt = get_post_meta( get_the_ID(), 'banner_shortcode_mt', true );
$banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );
$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );

if (is_page()) {
    if ($banner_type_mt == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } else {
        $page_hav_banner = '';
    }
} elseif(!is_page()) {
    if ($banner_type_ot == 'jt_hide_ban') {
        $page_hav_banner = 'page_hav_banner';
    } else {
        $page_hav_banner = '';
    }
}

if(!is_singular('portfolio') && $page_hav_banner != 'page_hav_banner') {
	if(is_page() && $banner_type_mt != '') {
	?>
	<div class="<?php echo esc_attr($layout_structure); ?> padding-zero">
	    <div class="jt-blog-bg">
	    	<?php if($banner_type_mt == 'img_ban' && $banner_image_mt) {
	    		$img=0;
	    		foreach($banner_image_mt as $ban_img_mt) {
	    			$img++;
	    		}
	    		if($img <= 1) {
					foreach($banner_image_mt as $vint_ban_mt) {
				?>
					<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_mt['ban_img_mt']); ?>'); background-size: cover;">
					</div>
				<?php }
				} elseif($img >= 2) { ?>
			        <div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
			            <ul class="slider jt-animated-hand">
			                <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
			                    <li class="slide">
			                        <div class="slide-bg">
			                            <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
			                        </div>
			                    </li>
			                <?php } ?>
			            </ul>
			        </div>
		        <?php }
	        } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
	        	$spc=0;
	        	foreach($special_banner_image_mt as $ban_spc_mt) {
	        		$spc++;
	        	}
	        	if($spc <= 1) { ?>
        			<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
        		        <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
	        		        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_mt['spc_ban_img']); ?>'); background-size: cover;">
	        		        </div>
        		        <?php }
        		        if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
        		            <canvas id="juster-canvas-one"></canvas>
        		        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
        		            <canvas id="juster-canvas-two"></canvas>
        		        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
        		            <canvas id="juster-canvas-three"></canvas>
        		        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
        		            <canvas id="juster-canvas-four"></canvas>
        		        <?php } ?>
        			</div>
	        	<?php } elseif($spc >= 2) { ?>
					<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
				        <ul class="slider jt-animated-hand">
				            <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
				                <li class="slide">
				                    <div class="slide-bg">
				                        <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
				                    </div>
				                </li>
				            <?php } ?>
				        </ul>
				        <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
				            <canvas id="juster-canvas-one"></canvas>
				        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
				            <canvas id="juster-canvas-two"></canvas>
				        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
				            <canvas id="juster-canvas-three"></canvas>
				        <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
				            <canvas id="juster-canvas-four"></canvas>
				        <?php } ?>
					</div>
				<?php }
			} elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
			        $vid_ban_adv_opt = get_post_meta( get_the_ID(), 'vid_ban_adv_opt', true );
			        $vid_ban_control = get_post_meta( get_the_ID(), 'vid_ban_control', true );
			        $vid_ban_auto_play = get_post_meta( get_the_ID(), 'vid_ban_auto_play', true );
			        $vid_ban_vid_loop = get_post_meta( get_the_ID(), 'vid_ban_vid_loop', true );
			        $vid_ban_aud_mute = get_post_meta( get_the_ID(), 'vid_ban_aud_mute', true );
			        $vid_ban_start_time = get_post_meta( get_the_ID(), 'vid_ban_start_time', true );
			        $vid_ban_vid_qty = get_post_meta( get_the_ID(), 'vid_ban_vid_qty', true );
			        if($vid_ban_control) {
			            $vid_ban_control = 'true';
			        } else {
			            $vid_ban_control = 'false';
			        }
			        if($vid_ban_auto_play) {
			            $vid_ban_auto_play = 'true';
			        } else {
			            $vid_ban_auto_play = 'false';
			        }
			        if($vid_ban_vid_loop) {
			            $vid_ban_vid_loop = 'true';
			        } else {
			            $vid_ban_vid_loop = 'false';
			        }
			        if($vid_ban_aud_mute) {
			            $vid_ban_aud_mute = 'true';
			        } else {
			            $vid_ban_aud_mute = 'false';
			        }
			        if($vid_ban_start_time) {
			            $vid_ban_start_time = $vid_ban_start_time;
			        } else {
			            $vid_ban_start_time = '0';
			        }
			        if($vid_ban_vid_qty) {
			            $vid_ban_vid_qty = $vid_ban_vid_qty;
			        } else {
			            $vid_ban_vid_qty = 'default';
			        }
			    ?>
			    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
			        </a>
				</div>
			<?php } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
					echo do_shortcode($banner_slide_mt);
				} elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
			        echo do_shortcode($banner_shortcode_mt);
			    }

	        if($banner_type_mt != '' && $banner_color_mt != '') { ?>
	        <style>
	        	.banner-overlay {
	        		background: <?php echo esc_attr($banner_color_mt) ?>;
	        	}
	        </style>
	        <?php }

	    if ($banner_type_mt != 'sld_ban') {
		    $breadcrumbs = ot_get_option('breadcrumbs');
		    $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', 'true' );
		    $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', 'true' );
		    $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', 'true' );
		    $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', 'true' );
		    if($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img == '') {
			$ban_text = 'jt-main-bantext-1null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-2null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-3null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-4null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-5null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-6null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-7null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-8null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-9null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-10null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-11null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-12null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-13null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-14null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-15null';
			} else {
				$ban_text = '';
			}

			// Page Title
			$page_title = ot_get_option('page_title');
			?>
			<div class="jt-page-banner shop-banner-content <?php echo esc_attr($ban_text); ?>">
			<?php

			if ($page_title != 'off' && $enable_new_page_title == 'off') {
			    if(is_front_page()) { ?>
			        <h1 class="page_heading"><?php bloginfo(''); ?></h1>
			    <?php } else { ?>
			        <h1 class="page_heading"><?php the_title(); ?></h1>
			    <?php }
			} elseif($enable_new_page_title == 'on') {
			    if($new_page_title != '') { ?>
			        <h1 class="page_heading"><?php echo esc_attr($new_page_title); ?></h1>
			    <?php } elseif($new_page_title == '') { ?>
			        <h1 class="page_heading"><?php echo the_title(); ?></h1>
			    <?php } elseif($page_title == 'off' && $new_page_title == '') {}
			} elseif($page_title != 'off') {
				if (is_search()) { ?>
			    <h1 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ) ?></h1>
			<?php
				} elseif (is_archive()) { ?>
                    <h1 class="page_heading"><?php if ( is_day() ) {
                            printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
                        } elseif ( is_month() ) {
                            printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
                        } elseif ( is_year() ) {
                            printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
                        } else {
                            echo __( 'Archives', 'juster' );
                        } ?></h1>
                <?php
                } elseif (is_author()) { ?>
					<h1 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
			<?php
				} elseif (is_category()) { ?>
					<h1 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
			<?php
				} elseif (is_tag()) { ?>
					<h1 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
			<?php
				} elseif(is_home()) { ?>
					<h1 class="page_heading"><?php bloginfo(''); ?></h1>
			<?php
				} else { ?>
					<h1 class="page_heading"><?php the_title(); ?></h1>
			<?php
				}
			} // Page Title Hide
			if($page_subheading) {
		    	echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
		    }
		    if($header_banner_title_img) {
			?>
		    	<span class="jt-ban-img"><img src="<?php echo esc_attr($header_banner_title_img); ?>" alt=""></span>
		    <?php } ?>
			    <div class="jt-breadcrumbs">
			    	<?php
			        $breadcrumbs = ot_get_option('breadcrumbs');
			        if($breadcrumbs == 'on') {
			            echo breadcrumb_trail();
			        }
			        ?>
			    </div>
		    </div>
	        <div class="banner-overlay"></div>
	    <?php } ?>
	    </div>
	</div>
	<?php } elseif($banner_type_ot != '' ) { ?>
	<div class="<?php echo esc_attr($layout_structure); ?> padding-zero">
	    <div class="jt-blog-bg">
	    	<?php
	    	if($banner_type_ot == 'img_ban' && $banner_image_ot) {
		    	$img=0;
				foreach($banner_image_ot as $ban_img_ot) {
					$img++;
				}
				if($img <= 1) {
		    		foreach($banner_image_ot as $vint_ban_ot) {
		    	?>
			    	<div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>'); background-size: cover;">
			        </div>
		    	<?php }
		    	} elseif($img >= 2) { ?>
			    	<div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
				        <ul class="slider jt-animated-hand">
				            <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
				                <li class="slide">
				                    <div class="slide-bg">
				                        <img src="<?php echo esc_url($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
				                    </div>
				                </li>
				            <?php } ?>
				        </ul>
			        </div>
				<?php }
			} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
				$spc=0;
				foreach($special_banner_image_ot as $ban_spc_ot) {
					$spc++;
				}
				if($spc <= 1) { ?>
					<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
				        <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
					        <div class="jt-animated-hand" style="background: url('<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>'); background-size: cover;">
					        </div>
				        <?php }
				        if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
				            <canvas id="juster-canvas-one"></canvas>
				        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
				            <canvas id="juster-canvas-two"></canvas>
				        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
				            <canvas id="juster-canvas-three"></canvas>
				        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
				            <canvas id="juster-canvas-four"></canvas>
				        <?php } ?>
					</div>
				<?php } elseif($spc >= 2) { ?>
					<div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
				        <ul class="slider jt-animated-hand">
				            <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
				                <li class="slide">
				                    <div class="slide-bg">
				                        <img src="<?php echo esc_url($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
				                    </div>
				                </li>
				            <?php } ?>
				        </ul>
				        <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
				            <canvas id="juster-canvas-one"></canvas>
				        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
				            <canvas id="juster-canvas-two"></canvas>
				        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
				            <canvas id="juster-canvas-three"></canvas>
				        <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
				            <canvas id="juster-canvas-four"></canvas>
				        <?php } ?>
					</div>
				<?php }
			} elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
			        $vid_ban_control = ot_get_option('vid_ban_control');
			        $vid_ban_auto_play = ot_get_option('vid_ban_auto_play');
			        $vid_ban_vid_loop = ot_get_option('vid_ban_vid_loop');
			        $vid_ban_aud_mute = ot_get_option('vid_ban_aud_mute');
			        $vid_ban_start_time = ot_get_option('vid_ban_start_time');
			        $vid_ban_vid_qty = ot_get_option('vid_ban_vid_qty');
			        if($vid_ban_control) {
			            $vid_ban_control = 'true';
			        } else {
			            $vid_ban_control = 'false';
			        }
			        if($vid_ban_auto_play) {
			            $vid_ban_auto_play = 'true';
			        } else {
			            $vid_ban_auto_play = 'false';
			        }
			        if($vid_ban_vid_loop) {
			            $vid_ban_vid_loop = 'true';
			        } else {
			            $vid_ban_vid_loop = 'false';
			        }
			        if($vid_ban_aud_mute) {
			            $vid_ban_aud_mute = 'true';
			        } else {
			            $vid_ban_aud_mute = 'false';
			        }
			        if($vid_ban_start_time) {
			            $vid_ban_start_time = $vid_ban_start_time;
			        } else {
			            $vid_ban_start_time = '0';
			        }
			        if($vid_ban_vid_qty) {
			            $vid_ban_vid_qty = $vid_ban_vid_qty;
			        } else {
			            $vid_ban_vid_qty = 'default';
			        }
			    ?>
			    <div id="videoid" class="slider-container jt-vintage-banner jt-vint-small-banner">
			        <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
			        </a>
				</div>
			<?php } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
				    echo do_shortcode($banner_slide_ot);
				}

	        if($banner_type_ot != '' && $banner_color_ot != '') { ?>
	        <style>
	        	.banner-overlay {
	        		background: <?php echo esc_attr($banner_color_ot) ?>;
	        	}
	        </style>
	        <?php }

	    if ($banner_type_ot != 'sld_ban') {
            $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
            $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
            $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
            $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
            $breadcrumbs = ot_get_option('breadcrumbs');

            // Page Title
    		$page_title = ot_get_option('page_title');
	        if($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-1null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-2null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-3null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-4null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-5null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-6null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-7null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-8null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-9null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-10null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img == '') {
				$ban_text = 'jt-main-bantext-11null';
			} elseif($breadcrumbs == 'off' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-12null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading == '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-13null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'off' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-14null';
			} elseif($breadcrumbs == 'on' && $enable_new_page_title == 'on' && $page_subheading != '' && $header_banner_title_img != '') {
				$ban_text = 'jt-main-bantext-15null';
			} else {
				$ban_text = 'jt-main-bantext-2null';
			}
			?>
			<div class="jt-page-banner shop-banner-content <?php echo esc_attr($ban_text); ?>">
			<?php

			if ($page_title != 'off' && $enable_new_page_title == 'off') {
			    if(is_front_page()) { ?>
			        <h1 class="page_heading"><?php bloginfo(''); ?></h1>
			    <?php } else { ?>
			        <h1 class="page_heading"><?php the_title(); ?></h1>
			    <?php }
			} elseif($enable_new_page_title == 'on') {
			    if($new_page_title != '') { ?>
			        <h1 class="page_heading"><?php echo esc_attr($new_page_title); ?></h1>
			    <?php } elseif($new_page_title == '') { ?>
			        <h1 class="page_heading"><?php echo the_title(); ?></h1>
			    <?php } elseif($page_title == 'off' && $new_page_title == '') {}
			} elseif($page_title != 'off') {
				if (is_search()) { ?>
			    <h1 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ) ?></h1>
			<?php
				} elseif (is_archive()) { ?>
                    <h1 class="page_heading"><?php if ( is_day() ) {
                            printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
                        } elseif ( is_month() ) {
                            printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
                        } elseif ( is_year() ) {
                            printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
                        } else {
                            echo __( 'Archives', 'juster' );
                        } ?></h1>
                <?php
                } elseif (is_author()) { ?>
					<h1 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
			<?php
				} elseif (is_category()) { ?>
					<h1 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
			<?php
				} elseif (is_tag()) { ?>
					<h1 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
			<?php
				} elseif(is_home()) { ?>
					<h1 class="page_heading"><?php bloginfo(''); ?></h1>
			<?php
				} else { ?>
					<h1 class="page_heading"><?php the_title(); ?></h1>
			<?php
				}
			} // Page Title Hide
			if($page_subheading) {
		    	echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
		    }
		    if($header_banner_title_img) {
			?>
		    	<span class="jt-ban-img"><img src="<?php echo esc_attr($header_banner_title_img); ?>" alt=""></span>
		    <?php } ?>
			    <div class="jt-breadcrumbs">
			    	<?php
			        $breadcrumbs = ot_get_option('breadcrumbs');
			        if($breadcrumbs == 'on') {
			            echo breadcrumb_trail();
			        }
			        ?>
			    </div>
		    </div>
	        <div class="banner-overlay"></div>
	    <?php } ?>
		</div>
	</div>
	<?php
	} // !is_page
} elseif(is_singular('portfolio')) { // single portfolio slider on header
	$single_port_featured_img = ot_get_option('single_port_featured_img');
	$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );
	if($single_port_gallery != '') { ?>
		<div id="jt-agency-slide" class="owl-carousel owl-theme">
		    <?php foreach ($single_port_gallery as $port_gallery) { ?>
				<div class="item">
					<img src="<?php echo esc_attr($port_gallery['port_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
					<?php if($port_gallery['port_tit_cat_enable'] == 'on') { ?>
						<div class="single-portfolio-banner-content">
							<?php if( $port_gallery['port_cat'] ) {
                                echo '<p>'.$port_gallery['port_cat'].'</p>';
                            }
                            if( $port_gallery['title'] ) {
                                echo '<h1>'.$port_gallery['title'].'</h1>';
                            } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($single_port_featured_img == 'on' && has_post_thumbnail()) { ?>
		<div class="single-portfolio-header-image">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php }
} // single-portfolio

} // !template-one-page-architecture
?>
</div> <!-- Layout -->
<?php
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Custom Shortcode With Tinymce Editor
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'jt_custom_shortcode' ) ) {
	function jt_custom_shortcode() {
	 // check user permissions
	 if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
	  return;
	 }
	 // check if WYSIWYG is enabled
	 if ( 'true' == get_user_option( 'rich_editing' ) ) {
	  add_filter( 'mce_external_plugins', 'jt_custom_code_script' );
	  add_filter( 'mce_buttons', 'jt_csregister_script' );
	 }
	}
	add_action('admin_head', 'jt_custom_shortcode');
}

// Declare script for new button
if ( ! function_exists( 'jt_custom_code_script' ) ) {
	function jt_custom_code_script( $plugin_array ) {
	 $plugin_array['jt_custom_btn'] = get_template_directory_uri() .'/framework/plugins/tinymce-editor.js';
	 return $plugin_array;
	}
}

// Register new button in the editor
if ( ! function_exists( 'jt_csregister_script' ) ) {
	function jt_csregister_script( $buttons ) {
	 array_push( $buttons, 'jt_custom_btn' );
	 return $buttons;
	}
}

// Enable font size & font family selects in the editor
if ( ! function_exists( 'juster_tinymce_btns_font' ) ) {
	function juster_tinymce_btns_font( $buttons ) {
		array_unshift( $buttons, 'fontselect' ); // Add Font Select
		array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'juster_tinymce_btns_font' );

// Customize mce editor font sizes
if ( ! function_exists( 'juster_tinymce_sizes' ) ) {
	function juster_tinymce_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'juster_tinymce_sizes' );

// Customize mce editor font family
if ( ! function_exists( 'juster_tinmymce_family' ) ) {
	function juster_tinmymce_family( $initArray ) {
	    $initArray['font_formats'] = 'Amiri=Amiri,serif;Montserrat=Montserrat,sans-serif;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
            return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'juster_tinmymce_family' );

// Boxed Header Title
if ( ! function_exists( 'juster_boxed_title' ) ) {
	function juster_boxed_title() {

		$enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
		$new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
		$page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
		$header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
		$single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );

		if( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading !='' ) {
		    $ban_text = 'jt-arch-bantext-1null';
		} elseif( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading =='' ) {
		    $ban_text = 'jt-arch-bantext-2null';
		} elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading !='' ) {
		    $ban_text = 'jt-arch-bantext-3null';
		} elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading =='' ) {
		    $ban_text = 'jt-arch-bantext-4null';
		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading !='' ) {
		    $ban_text = 'jt-arch-bantext-5null';
		} elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading !='' ) {
		    $ban_text = 'jt-arch-bantext-6null';
		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img == '' && $page_subheading !='' ) {
		    $ban_text = 'jt-arch-bantext-7null';
		} elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img == '' && $page_subheading !='' ) {
		    $ban_text = 'jt-arch-bantext-8null';
		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading =='' ) {
		    $ban_text = 'jt-arch-bantext-9null';
		} elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading =='' ) {
		    $ban_text = 'jt-arch-bantext-10null';
		} elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img == '' && $page_subheading =='' ) {
		    $ban_text = 'jt-arch-bantext-11null';
		} else {
		    $ban_text = '';
		}

		// Page Title
		$page_title = ot_get_option('page_title');
		?>
		<div class="box-banner-content <?php echo esc_attr($ban_text); ?>">
		<?php

		if ($page_title != 'off' && $enable_new_page_title == 'off') {
		    if(is_front_page()) { ?>
		        <h1 class="page_heading"><?php bloginfo(''); ?></h1>
		    <?php } else { ?>
		        <h1 class="page_heading"><?php the_title(); ?></h1>
		    <?php }
		} elseif($enable_new_page_title == 'on') {
		    if($new_page_title != '') { ?>
		        <h1 class="page_heading"><?php echo esc_attr($new_page_title); ?></h1>
		    <?php } elseif($new_page_title == '') { ?>
		        <h1 class="page_heading"><?php echo the_title(); ?></h1>
		    <?php } elseif($page_title == 'off' && $new_page_title == '') {}
		} elseif($page_title != 'off') {
			if (is_search()) { ?>
		    <h1 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ) ?></h1>
		<?php
			} elseif (is_author()) { ?>
				<h1 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
		<?php
			} elseif (is_archive()) { ?>
	            <h1 class="page_heading"><?php if ( is_day() ) {
	                    printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
	                } elseif ( is_month() ) {
	                    printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
	                } elseif ( is_year() ) {
	                    printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
	                } else {
	                    echo __( 'Archives', 'juster' );
	                } ?></h1>
	        <?php
	        }  elseif (is_category()) { ?>
				<h1 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
		<?php
			} elseif (is_tag()) { ?>
				<h1 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
		<?php
			} elseif(is_home()) { ?>
				<h1 class="page_heading"><?php bloginfo(''); ?></h1>
		<?php
			} else { ?>
				<h1 class="page_heading"><?php the_title(); ?></h1>
		<?php
			}
		} // Page Title Hide
		if($page_subheading) {
	    	echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
	    }
	    if($header_banner_title_img) {
		?>
	    	<img src="<?php echo esc_attr($header_banner_title_img); ?>" alt="">
	    <?php } ?>
	    </div>
	    <?php

	}
}

// Juster Banner
if ( ! function_exists( 'juster_banner_anim' ) ) {
	function juster_banner_anim() {
		global $post;
		$banner_marker = ot_get_option('banner_marker');
		if (is_page()) {
			$banner_type_mt = get_post_meta( $post->ID, 'banner_type_mt', true );
		} else {
			$banner_type_mt = '';
		}
		$banner_type_ot = ot_get_option('banner_type');

		// Hide Banner Title If Banner is Hide
		if ($banner_type_mt == 'jt_hide_ban') {
			$jt_hide_marker = 'jt_hide_marker';
		} elseif ($banner_type_mt == '' && $banner_type_ot == 'jt_hide_ban') {
			$jt_hide_marker = 'jt_hide_marker';
		} else {
			$jt_hide_marker = '';
		}
		if( $banner_marker === 'animation_marker' ) {
		if ($jt_hide_marker != 'jt_hide_marker') {
		?>
		<div class="jt-banner-graphic">
		    <div class="jt-ban-icon faa-burst animated fa-fast"></div>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="1200ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="1100ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="1s"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="900ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="800ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="700ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="600ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="500ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="400ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="300ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		    <span class="animate-plus"
		        data-animations="fadeIn"
		        data-animation-delay="200ms"
		        data-animation-when-visible="true"
		        data-animation-reset-offscreen="true"></span>
		</div>
		<?php
		}
	} elseif( $banner_marker === 'simple_marker' && $jt_hide_marker != 'jt_hide_marker' ) { ?>
		<div class="jt-banner-graphic animation-disable">
		    <div class="jt-ban-icon"></div>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
		</div>
		<?php
		} elseif( $banner_marker === 'custom_marker' && $jt_hide_marker != 'jt_hide_marker' ) {
		    $banner_marker_custom = ot_get_option('banner_marker_custom');
		    if($banner_marker_custom) { ?>
		        <div class="banner_marker_custom">
		            <img src="<?php echo esc_attr($banner_marker_custom); ?>" alt="">
		        </div>
		    <?php }
		}
	}
}

/* ==============================================
   HEX to RGB
=============================================== */
if ( ! function_exists( 'hex2rgb' ) ) {
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }

	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb);
	}
}

/* ==============================================
  Flush Rewirte Rules
=============================================== */
if ( ! function_exists( 'jt_flush_rewrite_rules' ) ) {
	function jt_flush_rewrite_rules() {
    flush_rewrite_rules();
	}
	add_action( 'after_switch_theme', 'jt_flush_rewrite_rules' );
}
