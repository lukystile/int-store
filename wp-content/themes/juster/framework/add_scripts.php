<?php
/**
 * ----------------------------------------------------------------------------------------
 * 10.0 - Load the custom scripts for the theme.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'jt_scripts' ) ) {
	function jt_scripts() {
		// Adds support for pages with threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Register scripts
		wp_register_script( 'bootstrap.min', SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'owl.carousel.min', SCRIPTS . '/owl.carousel.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'animate-plus.min', SCRIPTS . '/animate-plus.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'jquery.magnific-popup.min', SCRIPTS . '/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'juster-scripts', SCRIPTS . '/scripts.js', array( 'jquery' ), false, true );
		wp_register_script( 'waypoints', SCRIPTS . '/waypoints.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'isotope-juster', SCRIPTS . '/isotope.pkgd.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'jquery.sticky', SCRIPTS . '/jquery.sticky.js', array( 'jquery' ), false, true );
	  wp_register_script( 'modernizr.custom', SCRIPTS . '/photography/gridgallery/modernizr.custom.js', array( 'jquery' ), false, true );
	  wp_register_script( 'imagesloaded.pkgd.min', SCRIPTS . '/photography/gridgallery/imagesloaded.pkgd.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'classie', SCRIPTS . '/photography/gridgallery/classie.js', array( 'jquery' ), false, true );
	  wp_register_script( 'masonry.pkgd.min', SCRIPTS . '/photography/gridgallery/masonry.pkgd.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'cbpGridGallery', SCRIPTS . '/photography/gridgallery/cbpGridGallery.js', array( 'jquery' ), false, true );
	  wp_register_script( 'kenburn', SCRIPTS . '/photography/kenburns/kenburn.js', array( 'jquery' ), false, true );
	  wp_register_script( 'flexslider', SCRIPTS . '/photography/slidegallery/flexslider.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'fitvids', SCRIPTS . '/photography/slidegallery/fitvids.js', array( 'jquery' ), false, true );
	  wp_register_script( 'slidegallery', SCRIPTS . '/photography/slidegallery/scripts.js', array( 'jquery' ), false, true );
	  wp_register_script( 'dragdealer', SCRIPTS . '/dragslide/dragdealer.js', array( 'jquery' ), false, true );
	  wp_register_script( 'dragslideshow', SCRIPTS . '/dragslide/dragslideshow.js', array( 'jquery' ), false, true );
	  wp_register_script( 'juster-banner-effect', SCRIPTS . '/juster-banner/juster-banner-effect.js', array( 'jquery' ), false, true );
	  wp_register_script( 'TweenLite.min', SCRIPTS . '/juster-banner/TweenLite.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'EasePack.min', SCRIPTS . '/juster-banner/EasePack.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'juster-banner-one', SCRIPTS . '/juster-banner/juster-banner-one.js', array( 'jquery' ), false, true );
	  wp_register_script( 'juster-banner-two', SCRIPTS . '/juster-banner/juster-banner-two.js', array( 'jquery' ), false, true );
	  wp_register_script( 'juster-banner-three', SCRIPTS . '/juster-banner/juster-banner-three.js', array( 'jquery' ), false, true );
	  wp_register_script( 'juster-banner-four', SCRIPTS . '/juster-banner/juster-banner-four.js', array( 'jquery' ), false, true );
	  wp_register_script( 'bliss-slider', SCRIPTS . '/fadeslide/bliss-slider.js', array( 'jquery' ), false, true );
	  wp_register_script( 'jquery.mb.YTPlayer', SCRIPTS . '/jquery.mb.YTPlayer.js', array( 'jquery' ), false, true );
	  wp_register_script( 'jquery.slimmenu.min', SCRIPTS . '/slimmenu/jquery.slimmenu.min.js', array( 'jquery' ), false, true );
	  wp_register_script( 'jquery.easing.min', SCRIPTS . '/slimmenu/jquery.easing.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'dynamic-js', THEMEROOT . '/dynamic-js.php', array( 'jquery' ), false, true );
		wp_register_script( 'jquery.fullPage', SCRIPTS . '/jquery.fullpage.min.js', array( 'jquery' ), false, true );

		// Load the custom scripts
		wp_enqueue_script( 'bootstrap.min' );
		wp_enqueue_script( 'owl.carousel.min' );
		$banner_marker = ot_get_option('banner_marker');
		if($banner_marker === 'animation_marker' || is_page_template( 'template-blank-page.php' )) {
			wp_enqueue_script( 'animate-plus.min' );
		}
		wp_enqueue_script( 'jquery.magnific-popup.min' );
		wp_enqueue_script( 'juster-scripts' );
		wp_enqueue_script( 'waypoints' );
		wp_enqueue_script( 'isotope-juster' );
		wp_enqueue_script( 'jquery.sticky' );
		wp_enqueue_script( 'modernizr.custom' );
		if ( is_page_template( 'page-kenburns-photography.php' ) ) {
			wp_enqueue_script( 'kenburn' );
		}
		if ( is_page_template( 'page-photography.php' ) || is_page_template( 'page-masonry-photography.php' )) {
			wp_enqueue_script( 'cbpGridGallery' );
			wp_enqueue_script( 'imagesloaded.pkgd.min' );
			wp_enqueue_script( 'classie' );
			wp_enqueue_script( 'masonry.pkgd.min' );
		}
		if ( is_page_template( 'page-slider-photography.php' ) ) {
			wp_enqueue_script( 'flexslider' );
			wp_enqueue_script( 'fitvids' );
			wp_enqueue_script( 'slidegallery' );
			wp_enqueue_script( 'imagesloaded.pkgd.min' );
			wp_enqueue_script( 'jquery.mb.YTPlayer' );
		}
		if( is_page_template( 'template-one-page-architecture.php' ) ) {
			wp_enqueue_script( 'dragdealer' );
			wp_enqueue_script( 'classie' );
			wp_enqueue_script( 'dragslideshow' );
		}
		wp_enqueue_script( 'juster-banner-effect' );

		$banner_type = ot_get_option('banner_type');
		$banner_type_spl = ot_get_option('banner_type_spl');
		$menu_position = ot_get_option('menu_position');
		$special_banner_images = ot_get_option('special_banner_image');
		if( $banner_type == 'spc_ban_type' && $banner_type_spl !='' && $special_banner_images != '' ) {
			wp_enqueue_script( 'bliss-slider' );
		}

		/* <vintage> */
		if(!is_404()) { // !404 Page
		global $post;
		$banner_type_ot = ot_get_option('banner_type');
		$banner_image_ot = ot_get_option('banner_image_ot');
		$banner_type_spl_ot = ot_get_option('banner_type_spl');
		$special_banner_image_ot = ot_get_option('special_banner_image');

		$banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
		$banner_image_mt = get_post_meta( get_the_ID(), 'banner_image_mt', true );
        $banner_type_spl_mt = get_post_meta( get_the_ID(), 'banner_type_spl_mt', true );
        $special_banner_image_mt = get_post_meta( get_the_ID(), 'special_banner_image_mt', true );
		if($menu_position == 'menu_pos_left_vintage' || $menu_position == 'menu_pos_right_vintage' || $menu_position == 'header_top_logo_left' || $menu_position == 'header_logo_with_banner' || $menu_position == 'menu_pos_left' || $menu_position == 'menu_pos_right' || $menu_position == 'header_outer_space' || $menu_position == 'header_with_topbar' || $menu_position == 'menu_pos_left_margin' || $menu_position == 'menu_pos_right_margin' || $menu_position == 'menu_pos_top_arch' || $menu_position == 'menu_pos_top_agency' || $menu_position == 'menu_pos_top_studio' || $menu_position == 'menu_pos_top_boxed' || $menu_position == 'menu_pos_top_shop') {
			if($banner_type_mt == 'img_ban' && $banner_image_mt != '') {
				wp_enqueue_script( 'bliss-slider' );
			} elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
				wp_enqueue_script( 'bliss-slider' );
				if($banner_type_spl_mt == 'spc_ban_type_one') {
					wp_enqueue_script( 'juster-banner-one' );
				}
				if($banner_type_spl_mt == 'spc_ban_type_two') {
					wp_enqueue_script( 'TweenLite.min' );
					wp_enqueue_script( 'EasePack.min' );
					wp_enqueue_script( 'juster-banner-two' );
				}
				if($banner_type_spl_mt == 'spc_ban_type_three') {
					wp_enqueue_script( 'TweenLite.min' );
					wp_enqueue_script( 'EasePack.min' );
					wp_enqueue_script( 'juster-banner-three' );
				}
				if($banner_type_spl_mt == 'spc_ban_type_four') {
					wp_enqueue_script( 'juster-banner-four' );
				}
			} elseif($banner_type_ot == 'img_ban' && $banner_image_ot != '') {
				wp_enqueue_script( 'bliss-slider' );
			} elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
				wp_enqueue_script( 'bliss-slider' );
				if($banner_type_spl_ot == 'spc_ban_type_one') {
					wp_enqueue_script( 'juster-banner-one' );
				}
				if($banner_type_spl_ot == 'spc_ban_type_two') {
					wp_enqueue_script( 'TweenLite.min' );
					wp_enqueue_script( 'EasePack.min' );
					wp_enqueue_script( 'juster-banner-two' );
				}
				if($banner_type_spl_ot == 'spc_ban_type_three') {
					wp_enqueue_script( 'TweenLite.min' );
					wp_enqueue_script( 'EasePack.min' );
					wp_enqueue_script( 'juster-banner-three' );
				}
				if($banner_type_spl_ot == 'spc_ban_type_four') {
					wp_enqueue_script( 'juster-banner-four' );
				}
			}
		}

		} // !404 Page
		/* </vintage> */
		if($menu_position == 'menu_pos_top_agency' && $banner_type == 'spc_ban_type' && $banner_type_spl == 'spc_ban_type_one') {
			wp_enqueue_script( 'juster-banner-one' );
		}
		if($menu_position == 'menu_pos_top_agency' && $banner_type == 'spc_ban_type' && $banner_type_spl == 'spc_ban_type_two') {
			wp_enqueue_script( 'TweenLite.min' );
			wp_enqueue_script( 'EasePack.min' );
			wp_enqueue_script( 'juster-banner-two' );
		}
		if($menu_position == 'menu_pos_top_agency' && $banner_type == 'spc_ban_type' && $banner_type_spl == 'spc_ban_type_three') {
			wp_enqueue_script( 'TweenLite.min' );
			wp_enqueue_script( 'EasePack.min' );
			wp_enqueue_script( 'juster-banner-three' );
		}
		if($menu_position == 'menu_pos_top_agency' && $banner_type == 'spc_ban_type' && $banner_type_spl == 'spc_ban_type_four') {
			wp_enqueue_script( 'juster-banner-four' );
		}

		wp_enqueue_script( 'jquery.slimmenu.min' );
		wp_enqueue_script( 'jquery.easing.min' );
		wp_enqueue_script( 'dynamic-js' );

		wp_register_style( 'jquery.fullPage-style', THEMEROOT . '/css/jquery.fullpage.min.css' );
		if( is_page_template( 'template-scroll-lock.php' ) ) {
			wp_enqueue_script( 'jquery.fullPage' );
			wp_enqueue_style( 'jquery.fullPage-style' );
		}

		// Load the stylesheets
		wp_enqueue_style( 'bootstrap.min', THEMEROOT . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'font-awesome.min', THEMEROOT . '/css/font-awesome.min.css' );
		wp_enqueue_style( 'font-awesome-animation.min', THEMEROOT . '/css/font-awesome-animation.min.css' );
		wp_enqueue_style( 'animate', THEMEROOT . '/css/animate.min.css' );
		wp_enqueue_style( 'pe-icon-7-stroke', THEMEROOT . '/css/pe-icon-7-stroke.css' );
		wp_enqueue_style( 'owl.carousel', THEMEROOT . '/css/owl.carousel.css' );
		wp_enqueue_style( 'magnific-popup', THEMEROOT . '/css/magnific-popup.css' );
		wp_enqueue_style( 'style', THEMEROOT . '/style.css' );
		wp_enqueue_style( 'jt-headers', THEMEROOT . '/css/jt-headers.css' );
		wp_enqueue_style( 'jt-footers', THEMEROOT . '/css/jt-footers.css' );
		wp_enqueue_style( 'jt-content-elements', THEMEROOT . '/css/jt-content-elements.css' );
		wp_enqueue_style( 'slim-menu', THEMEROOT . '/css/slim-menu.css' );
		wp_register_style( 'YTPlayer', THEMEROOT . '/css/YTPlayer.css' );

		global $post;
		if (is_page()) {
			$banner_type_mt = get_post_meta( $post->ID, 'banner_type_mt', true );
			if ($banner_type_mt == 'vid_ban') {
				wp_enqueue_script( 'jquery.mb.YTPlayer' );
				wp_enqueue_style( 'YTPlayer' );
			}
		}
		$banner_type_ot = ot_get_option('banner_type');
		if ($banner_type_ot == 'vid_ban') {
			wp_enqueue_script( 'jquery.mb.YTPlayer' );
			wp_enqueue_style( 'YTPlayer' );
		}

		/* Responsive Style Load */
		$viewport = ot_get_option('responsive_site_layout');
		if($viewport == 'on') {
			wp_enqueue_style( 'responsive', THEMEROOT . '/css/responsive.css' );
		}

		// Woocommerce style
		if (class_exists( 'Woocommerce' )){
			wp_enqueue_style( 'my-woocommerce', get_template_directory_uri() . '/framework/plugins/woocommerce/woocommerce.css', null, 1.0, 'all' );
		}
		// Dynamic style
		wp_enqueue_style('dynamic-style', THEMEROOT . '/dynamic-style.php');

		$body_font 				= ot_get_option('body_font');
		$body_font_link 		= ot_get_option('body_font_link');
		$sidebar_p_tag 			= ot_get_option('sidebar_p_tag');
		$footer_p_tag 			= ot_get_option('footer_p_tag');
		$menu_font 				= ot_get_option('menu_font');
		$sidebar_heading_font 	= ot_get_option('sidebar_heading_font');
		$footer_heading_font 	= ot_get_option('footer_heading_font');
		$content_heading_one 	= ot_get_option('content_heading_one');
		$content_heading_two 	= ot_get_option('content_heading_two');
		$content_heading_three 	= ot_get_option('content_heading_three');
		$content_heading_four 	= ot_get_option('content_heading_four');
		$content_heading_five 	= ot_get_option('content_heading_five');
		$content_heading_six 	= ot_get_option('content_heading_six');
		$custom_font 			= ot_get_option('custom_font');

		if($body_font == '' && $body_font_link == '' && $sidebar_p_tag == '' && $footer_p_tag == '' && $menu_font == '' && $sidebar_heading_font == '' && $footer_heading_font == '' && $content_heading_one == '' && $content_heading_two == '' && $content_heading_three == '' && $content_heading_four == '' && $content_heading_five == '' && $content_heading_six == '' && $custom_font == '') {

			$query_args = array(
				'family' => 'Montserrat|Amiri'
			);
			wp_register_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
			wp_enqueue_style( 'google-fonts' );
		} else { }
	}
	add_action( 'wp_enqueue_scripts', 'jt_scripts' );
}
