<?php
/**
 * header.php
 *
 * The template for displaying the header.
 */
?>
<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<?php
    $custom_desc_metas = ot_get_option('custom_desc_metas');
    if ($custom_desc_metas === 'on') {
        $meta_keywords = ot_get_option('meta_keywords');
        $meta_descriptions = ot_get_option('meta_descriptions');
        if ($meta_descriptions) { ?>
            <meta name="description" content="<?php echo esc_attr($meta_descriptions); ?>">
        <?php } else { ?>
            <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <?php }
        if ($meta_keywords) { ?>
            <meta name="keywords" content="<?php echo esc_attr($meta_keywords); ?>"/>
        <?php }
    } // custom_desc_metas

    $viewport = ot_get_option('responsive_site_layout');
    if($viewport == 'on') { ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } else { }

    // if the `wp_site_icon` function does not exist (ie we're on < WP 4.3)
    if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {
        if (ot_get_option('favicon')) {
            echo '<link rel="shortcut icon" href="'. esc_url(ot_get_option('favicon')) .'" />';
        } else { ?>
            <link rel="shortcut icon" href="<?php echo IMAGES; ?>/icons/favicon.png" />
        <?php }
        if (ot_get_option('iphone_icon')){
            echo '<link rel="apple-touch-icon" sizes="57x57" href="'. esc_url(ot_get_option('iphone_icon')) .'" >';
        }
        if (ot_get_option('iphone_retina_icon')){
            echo '<link rel="apple-touch-icon" sizes="114x114" href="'. esc_url(ot_get_option('iphone_retina_icon')) .'" >';
        }
        if (ot_get_option('ipad_icon')){
            echo '<link rel="apple-touch-icon" sizes="72x72" href="'. esc_url(ot_get_option('ipad_icon')) .'" >';
        }
        if (ot_get_option('ipad_retina_icon')){
            echo '<link rel="apple-touch-icon" sizes="144x144" href="'. esc_url(ot_get_option('ipad_retina_icon')) .'" >';
        }
    }

    $g_analytics = ot_get_option('g_analytics');
    echo $g_analytics;
	wp_head();
?>
</head>
<?php
    // Fixed Footer Body Class
    $fixed_footer = ot_get_option('fixed_footer');
    if( $fixed_footer ) {
        $fixed_footer = ' jt-fixed-footer';
    } else {
        $fixed_footer = '';
    }
    if( function_exists( 'YITH_WCWL' ) && is_page('wishlist') ) {
        $wishlist = ' woocommerce-wishlist';
    } else {
        $wishlist = '';
    }
    if( is_404() ) {
        $is_404 = ' entry-content error404';
    } else {
        $is_404 = '';
    }
    /* For Photography */
    $menu_position = ot_get_option('menu_position');
    if($menu_position == 'menu_pos_left_margin' || $menu_position == 'menu_pos_right_margin' || $menu_position == 'menu_pos_left_vintage' || $menu_position == 'menu_pos_right_vintage') {
        $photo_body = ' jt-photo-wrap';
    } else {
        $photo_body = '';
    }

    $menu_position = ot_get_option('menu_position');
    $sticky_header = ot_get_option('sticky_header');
    if($menu_position == 'header_top_logo_left') {
        if($sticky_header == 'on') {
            $container_temp = ' jt_main_content';
        } else {
            $container_temp = ' jt_main_content not_sticky_header';
        }
    } elseif($menu_position == 'header_logo_with_banner') {
        $container_temp = ' jt_blog_content';
    } elseif($menu_position == 'menu_pos_left') {
        $container_temp = ' jt_left_content';
    } elseif($menu_position == 'menu_pos_right') {
        $container_temp = ' jt_right_content';
    } elseif($menu_position == 'header_outer_space') {
        if($sticky_header == 'on') {
            $container_temp = ' jt_freelance_content';
        } else{
            $container_temp = ' jt_freelance_content not_sticky_header';
        }
    } elseif($menu_position == 'header_with_topbar') {
        $container_temp = ' jt_business_content';
    } elseif($menu_position == 'menu_pos_left_margin') {
        $container_temp = ' jt_photography_content';
    } elseif($menu_position == 'menu_pos_right_margin') {
        $container_temp = ' jt_photography_content left-cont';
    } elseif($menu_position == 'menu_pos_top_arch') {
        $container_temp = ' jt_arch_content';
    } elseif($menu_position == 'menu_pos_top_agency') {
        $container_temp = ' jt_agency_content';
    } elseif($menu_position == 'menu_pos_top_studio') {
        $container_temp = ' jt_studio_content';
    } elseif($menu_position == 'menu_pos_left_vintage') {
        $container_temp = ' jt_vintage_content jt_vintage_left';
    } elseif($menu_position == 'menu_pos_right_vintage') {
        $container_temp = ' jt_vintage_content jt_vintage_right';
    } elseif($menu_position == 'menu_pos_top_boxed') {
        $container_temp = ' jt-box-layout-bg';
    } elseif($menu_position == 'menu_pos_top_shop') {
        $container_temp = ' jt_shop_content';
    } else {
        $container_temp = 'jt_main_content not_sticky_header';
    }
    if($menu_position == 'menu_pos_top_arch' && is_page_template( 'template-one-page-architecture.php' )) {
        $arch_home = ' jt-arch-body jt-front-page';
    } else {
        $arch_home ='';
    }

    if( is_page_template( 'template-one-page-architecture.php' ) ) {
        $arch_bodyid = 'id="archid"';
    } else {
        $arch_bodyid = '';
    }

    if(!is_404()) { // !404 Page
        $bg_ot = ot_get_option('bg_ot');
        if(is_page()) {
            $bg_mt = get_post_meta( $post->ID, 'bg_mt', true );
        } elseif(!is_page()) {
            $bg_ot = get_post_meta( get_the_ID(), 'bg_ot', true );
        }
        if($menu_position == 'menu_pos_top_boxed') {
            if(is_page()) {
                if($bg_mt != '') {
                    $bg_mt_color    = $bg_mt['background-color'];
                    $bg_mt_img      = $bg_mt['background-image'];
                    $bg_mt_repeat   = $bg_mt['background-repeat'];
                    $bg_mt_attach   = $bg_mt['background-attachment'];
                    $bg_mt_pos      = $bg_mt['background-position'];
                    $bg_mt_size     = $bg_mt['background-size'];
                    if($bg_mt_color) {
                        $bg_mt_color = 'background-color: '.$bg_mt_color.';';
                    } else { $bg_mt_color = ''; }
                    if($bg_mt_img) {
                        $bg_mt_img = 'background-image:url('.esc_attr($bg_mt_img).');';
                    } else { $bg_mt_img = ''; }
                    if($bg_mt_repeat) {
                        $bg_mt_repeat = 'background-repeat: '.$bg_mt_repeat.';';
                    } else { $bg_mt_repeat = ''; }
                    if($bg_mt_attach) {
                        $bg_mt_attach = 'background-attachment: '.$bg_mt_attach.';';
                    } else { $bg_mt_attach = ''; }
                    if($bg_mt_pos) {
                        $bg_mt_pos = 'background-position: '.$bg_mt_pos.';';
                    } else { $bg_mt_pos = ''; }
                    if($bg_mt_size) {
                        $bg_mt_size = 'background-size: '.$bg_mt_size.';';
                    } else { $bg_mt_size = ''; }
                    $box_bgs = 'style="'.$bg_mt_img.$bg_mt_color.$bg_mt_repeat.$bg_mt_attach.$bg_mt_pos.$bg_mt_size.'"';
                } elseif($bg_ot != '') {
                    $bg_ot_color    = $bg_ot['background-color'];
                    $bg_ot_img      = $bg_ot['background-image'];
                    $bg_ot_repeat   = $bg_ot['background-repeat'];
                    $bg_ot_attach   = $bg_ot['background-attachment'];
                    $bg_ot_pos      = $bg_ot['background-position'];
                    $bg_ot_size     = $bg_ot['background-size'];
                    if($bg_ot_color) {
                        $bg_ot_color = 'background-color: '.$bg_ot_color.';';
                    } else { $bg_ot_color = ''; }
                    if($bg_ot_img) {
                        $bg_ot_img = 'background-image:url('.esc_attr($bg_ot_img).');';
                    } else { $bg_ot_img = ''; }
                    if($bg_ot_repeat) {
                        $bg_ot_repeat = 'background-repeat: '.$bg_ot_repeat.';';
                    } else { $bg_ot_repeat = ''; }
                    if($bg_ot_attach) {
                        $bg_ot_attach = 'background-attachment: '.$bg_ot_attach.';';
                    } else { $bg_ot_attach = ''; }
                    if($bg_ot_pos) {
                        $bg_ot_pos = 'background-position: '.$bg_ot_pos.';';
                    } else { $bg_ot_pos = ''; }
                    if($bg_ot_size) {
                        $bg_ot_size = 'background-size: '.$bg_ot_size.';';
                    } else { $bg_ot_size = ''; }
                    $box_bgs = 'style="'.$bg_ot_img.$bg_ot_color.$bg_ot_repeat.$bg_ot_attach.$bg_ot_pos.$bg_ot_size.'"';
                } else {
                    $box_bgs = '';
                }
            } elseif(!is_page()) {
                if($bg_ot != '') {
                    $bg_ot_color    = $bg_ot['background-color'];
                    $bg_ot_img      = $bg_ot['background-image'];
                    $bg_ot_repeat   = $bg_ot['background-repeat'];
                    $bg_ot_attach   = $bg_ot['background-attachment'];
                    $bg_ot_pos      = $bg_ot['background-position'];
                    $bg_ot_size     = $bg_ot['background-size'];
                    if($bg_ot_color) {
                        $bg_ot_color = 'background-color: '.$bg_ot_color.';';
                    } else { $bg_ot_color = ''; }
                    if($bg_ot_img) {
                        $bg_ot_img = 'background-image:url('.esc_attr($bg_ot_img).');';
                    } else { $bg_ot_img = ''; }
                    if($bg_ot_repeat) {
                        $bg_ot_repeat = 'background-repeat: '.$bg_ot_repeat.';';
                    } else { $bg_ot_repeat = ''; }
                    if($bg_ot_attach) {
                        $bg_ot_attach = 'background-attachment: '.$bg_ot_attach.';';
                    } else { $bg_ot_attach = ''; }
                    if($bg_ot_pos) {
                        $bg_ot_pos = 'background-position: '.$bg_ot_pos.';';
                    } else { $bg_ot_pos = ''; }
                    if($bg_ot_size) {
                        $bg_ot_size = 'background-size: '.$bg_ot_size.';';
                    } else { $bg_ot_size = ''; }
                    $box_bgs = 'style="'.$bg_ot_img.$bg_ot_color.$bg_ot_repeat.$bg_ot_attach.$bg_ot_pos.$bg_ot_size.'"';
                } else {
                    $box_bgs = '';
                }
            } else {
                $box_bgs = '';
            }
        } else {
            $box_bgs = '';
        }
    } else { // !404 Page
        $box_bgs = '';
    } // !404 Page

    global $post;
    $banner_type_mt = get_post_meta( get_the_ID(), 'banner_type_mt', true );
    if( $banner_type_mt == 'sld_ban' ) {
        $have_rev_slider = ' have_rev_slider';
    } else {
        $have_rev_slider = '';
    }
    if(is_front_page()) {
        $front_page_class = ' is_front_page';
    } else {
        $front_page_class = '';
    }

?>
<body <?php echo $arch_bodyid; ?> <?php body_class($wishlist.$is_404.$fixed_footer.$photo_body.$container_temp.$arch_home.$have_rev_slider.$front_page_class); ?> <?php echo $box_bgs; ?>>
<?php
if(!is_404()) { // !404 Page
global $post;
$bg_mt = get_post_meta( get_the_ID(), 'bg_mt', "true" );
$bg_ot = ot_get_option('bg_ot');

if(is_page()) {
    if($bg_mt != '') {
        $bg_mt_color    = $bg_mt['background-color'];
        $bg_mt_img      = $bg_mt['background-image'];
        $bg_mt_repeat   = $bg_mt['background-repeat'];
        $bg_mt_attach   = $bg_mt['background-attachment'];
        $bg_mt_pos      = $bg_mt['background-position'];
        $bg_mt_size     = $bg_mt['background-size'];
        if($bg_mt_color) {
            $bg_mt_color = 'background-color: '.$bg_mt_color.';';
        } else { $bg_mt_color = ''; }
        if($bg_mt_img) {
            $bg_mt_img = 'background-image:url('.esc_attr($bg_mt_img).');';
        } else { $bg_mt_img = ''; }
        if($bg_mt_repeat) {
            $bg_mt_repeat = 'background-repeat: '.$bg_mt_repeat.';';
        } else { $bg_mt_repeat = ''; }
        if($bg_mt_attach) {
            $bg_mt_attach = 'background-attachment: '.$bg_mt_attach.';';
        } else { $bg_mt_attach = ''; }
        if($bg_mt_pos) {
            $bg_mt_pos = 'background-position: '.$bg_mt_pos.';';
        } else { $bg_mt_pos = ''; }
        if($bg_mt_size) {
            $bg_mt_size = 'background-size: '.$bg_mt_size.';';
        } else { $bg_mt_size = ''; }
        $wrap_bg = 'style="'.$bg_mt_img.$bg_mt_color.$bg_mt_repeat.$bg_mt_attach.$bg_mt_pos.$bg_mt_size.'"';
    } elseif($bg_ot != '') {
        $bg_ot_color    = $bg_ot['background-color'];
        $bg_ot_img      = $bg_ot['background-image'];
        $bg_ot_repeat   = $bg_ot['background-repeat'];
        $bg_ot_attach   = $bg_ot['background-attachment'];
        $bg_ot_pos      = $bg_ot['background-position'];
        $bg_ot_size     = $bg_ot['background-size'];
        if($bg_ot_color) {
            $bg_ot_color = 'background-color: '.$bg_ot_color.';';
        } else { $bg_ot_color = ''; }
        if($bg_ot_img) {
            $bg_ot_img = 'background-image:url('.esc_attr($bg_ot_img).');';
        } else { $bg_ot_img = ''; }
        if($bg_ot_repeat) {
            $bg_ot_repeat = 'background-repeat: '.$bg_ot_repeat.';';
        } else { $bg_ot_repeat = ''; }
        if($bg_ot_attach) {
            $bg_ot_attach = 'background-attachment: '.$bg_ot_attach.';';
        } else { $bg_ot_attach = ''; }
        if($bg_ot_pos) {
            $bg_ot_pos = 'background-position: '.$bg_ot_pos.';';
        } else { $bg_ot_pos = ''; }
        if($bg_ot_size) {
            $bg_ot_size = 'background-size: '.$bg_ot_size.';';
        } else { $bg_ot_size = ''; }
        $wrap_bg = 'style="'.$bg_ot_img.$bg_ot_color.$bg_ot_repeat.$bg_ot_attach.$bg_ot_pos.$bg_ot_size.'"';
    } else {
        $wrap_bg = '';
    }
} elseif(!is_page()) {
    if($bg_ot != '') {
        $bg_ot_color    = $bg_ot['background-color'];
        $bg_ot_img      = $bg_ot['background-image'];
        $bg_ot_repeat   = $bg_ot['background-repeat'];
        $bg_ot_attach   = $bg_ot['background-attachment'];
        $bg_ot_pos      = $bg_ot['background-position'];
        $bg_ot_size     = $bg_ot['background-size'];
        if($bg_ot_color) {
            $bg_ot_color = 'background-color: '.$bg_ot_color.';';
        } else { $bg_ot_color = ''; }
        if($bg_ot_img) {
            $bg_ot_img = 'background-image:url('.esc_attr($bg_ot_img).');';
        } else { $bg_ot_img = ''; }
        if($bg_ot_repeat) {
            $bg_ot_repeat = 'background-repeat: '.$bg_ot_repeat.';';
        } else { $bg_ot_repeat = ''; }
        if($bg_ot_attach) {
            $bg_ot_attach = 'background-attachment: '.$bg_ot_attach.';';
        } else { $bg_ot_attach = ''; }
        if($bg_ot_pos) {
            $bg_ot_pos = 'background-position: '.$bg_ot_pos.';';
        } else { $bg_ot_pos = ''; }
        if($bg_ot_size) {
            $bg_ot_size = 'background-size: '.$bg_ot_size.';';
        } else { $bg_ot_size = ''; }
        $wrap_bg = 'style="'.$bg_ot_img.$bg_ot_color.$bg_ot_repeat.$bg_ot_attach.$bg_ot_pos.$bg_ot_size.'"';
    } else {
        $wrap_bg = '';
    }
} else {
    $wrap_bg = '';
}

$menu_position = ot_get_option('menu_position');
if( $menu_position != 'menu_pos_left' || $menu_position != 'menu_pos_left_margin' || $menu_position != 'menu_pos_right_margin' || $menu_position != 'menu_pos_top_boxed' ) {
?>
<div class="wrapper" <?php echo $wrap_bg; ?>> <!-- Wrapper -->
<?php }
if ($menu_position == 'menu_pos_top_boxed') {
    echo '<div class="jt-boxed-layout">'; // Boxed Wrapper
}
    /* Header */
    if( !is_404() && !is_page_template( 'template-blank-page.php' ) && !is_page_template( 'template-scroll-lock.php' ) ) { //!404
        $menu_pos = ot_get_option('menu_position');
        if($menu_pos === 'header_top_logo_left') {
        	echo header_top_logo_left();
        } elseif($menu_pos === 'header_logo_with_banner') {
            echo header_logo_with_banner();
        } elseif($menu_pos === 'menu_pos_left' || $menu_pos === 'menu_pos_right') {
            echo leftside_menu();
        } elseif($menu_pos === 'header_outer_space') {
            echo header_outer_space();
        } elseif($menu_pos === 'header_with_topbar') {
            echo header_with_topbar();
        } elseif($menu_pos === 'menu_pos_left_margin' || $menu_pos === 'menu_pos_right_margin') {
            echo menu_pos_left_margin();
        } elseif($menu_pos === 'menu_pos_top_arch' && !is_page_template( 'template-one-page-architecture.php' ) ) {
            echo menu_pos_top_arch();
        } elseif($menu_pos === 'menu_pos_top_agency' && !is_page_template( 'template-agency-home.php' )) {
            echo menu_pos_top_agency();
        } elseif($menu_pos === 'menu_pos_top_agency' && is_page_template( 'template-agency-home.php' )) {
            echo menu_pos_top_agency_home();
        } elseif($menu_pos === 'menu_pos_top_studio') {
            echo menu_pos_top_studio();
        } elseif($menu_pos === 'menu_pos_left_vintage' || $menu_pos === 'menu_pos_right_vintage') {
            echo menu_pos_vintage();
        } elseif($menu_pos === 'menu_pos_top_boxed') {
            echo menu_pos_boxed();
        } elseif($menu_pos === 'menu_pos_top_shop') {
            echo menu_pos_shop();
        } else {
            if(!is_page_template( 'template-one-page-architecture.php')) {
                echo header_top_logo_left();
            }
        }
    } elseif(is_page_template( 'template-scroll-lock.php' )) {
        echo header_top_logo_left();
    } //!404
    /* Header */

/*=========================================================================
    Header - Portfolio Header / Left Side Menu / Right Side Menu
=========================================================================*/
    $menu_position = ot_get_option('menu_position');
    $banner_type = ot_get_option('banner_type');
    $image_banner = ot_get_option('image_banner');
    $header_banner = get_post_meta( get_the_ID(), 'header_banner', true );
    if( $menu_position == 'menu_pos_left' || $menu_position == 'menu_pos_right' ) {
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
                    $layout_structure = 'container-fluid';
                }
            } elseif( $layout_model_ot ) {
                if( $layout_model_ot === 'full-width' ) {
                    $layout_structure = 'container';
                } elseif( $layout_model_ot === 'extra-width' ) {
                    $layout_structure = 'container-fluid';
                } else {
                    $layout_structure = 'container-fluid';
                }
            } else {
                $layout_structure = 'container-fluid';
            }
        } elseif ( !is_page() ) {
            if( $layout_model_ot ) {
                if( $layout_model_ot === 'full-width' ) {
                    $layout_structure = 'container';
                } elseif( $layout_model_ot === 'extra-width' ) {
                    $layout_structure = 'container-fluid';
                } else {
                    $layout_structure = 'container-fluid';
                }
            } else {
                $layout_structure = 'container-fluid';
            }
        }
        global $post;

        $menu_position = ot_get_option('menu_position');
        $header_banner_ot = ot_get_option('banner_type');
        if($menu_position == 'menu_pos_left') {
            echo '<div class="right-cont-wrap">';
        } else {
            echo '<div class="left-cont-wrap right-menu-content">';
        }
        if( $menu_position == 'menu_pos_left' || $menu_position == 'menu_pos_right' ) {

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
    if(!is_page_template('template-one-page-architecture.php')) { ?>
    <div class="<?php echo esc_attr($layout_structure); ?> padding-zero">
        <div class="jt-blog-bg">
    <?php
        if($banner_type_mt != '') {
        ?>
            <?php if($banner_type_mt == 'img_ban' && $banner_image_mt) {
            $img=0;
            foreach($banner_image_mt as $ban_img_mt) {
                $img++;
            }
            if($img <= 1) {
                foreach($banner_image_mt as $vint_ban_mt) {
            ?>
                <div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo $vint_ban_mt['ban_img_mt']; ?>'); background-size: cover;">
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
                    <div class="jt-animated-hand" style="background: url('<?php echo $vint_agy_ban_mt['spc_ban_img'] ?>'); background-size: cover;">
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
    } elseif($banner_type_ot != '') {
        if($banner_type_ot == 'img_ban' && $banner_image_ot) {
        $img=0;
        foreach($banner_image_ot as $ban_img_ot) {
            $img++;
        }
        if($img <= 1) {
            foreach($banner_image_ot as $vint_ban_ot) {
        ?>
            <div class="slider-container jt-vintage-banner jt-vint-small-banner" style="background: url('<?php echo $vint_ban_ot['ban_img_ot']; ?>'); background-size: cover;">
            </div>
        <?php }
        } elseif($img >= 2) { ?>
            <div id="slider-vint" class="slider-container jt-vintage-banner jt-vint-small-banner">
                <ul class="slider jt-animated-hand">
                    <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
                        <li class="slide">
                            <div class="slide-bg">
                                <img src="<?php echo esc_attr($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
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
                <div class="jt-animated-hand" style="background: url('<?php echo $vint_agy_ban_ot['spc_ban_img']; ?>'); background-size: cover;">
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
            <div id="large-header" class="slider-container jt-vintage-banner jt-vint-small-banner">
                <ul class="slider jt-animated-hand">
                    <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
                        <li class="slide">
                            <div class="slide-bg">
                                <img src="<?php echo esc_attr($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
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
        }
    } // !is_page

    // Page Title Starts
    if (is_page()) {
        $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
        $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
        $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
        $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
        $page_title = ot_get_option('page_title');
        ?>
        <div class="jt-header-content">
            <?php
            if($page_subheading) {
                echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
            }
            if ($page_title != 'off' && $enable_new_page_title == 'off') {
                if(is_front_page()) { ?>
                    <h4 class="page_heading"><?php bloginfo(''); ?></h4>
                <?php } else { ?>
                    <h4 class="page_heading"><?php the_title(); ?></h4>
                <?php }
            } elseif($enable_new_page_title == 'on') {
                if($new_page_title != '') { ?>
                    <h4 class="page_heading"><?php echo esc_attr($new_page_title); ?></h4>
                <?php } elseif($new_page_title == '') { ?>
                    <h4 class="page_heading"><?php echo the_title(); ?></h4>
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
        <div class="jt-header-content">
            <?php if ($page_title != 'off') {
                if(is_front_page()) { ?>
                    <h4 class="page_heading"><?php bloginfo(''); ?></h4>
                <?php } elseif (is_author()) { ?>
                    <h4 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h4>
                <?php
                    } elseif (is_search()) { ?>
                    <h4 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h4>
                <?php
                    } elseif (is_archive()) { ?>
                        <h4 class="page_heading"><?php if ( is_day() ) {
                                printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
                            } elseif ( is_month() ) {
                                printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
                            } elseif ( is_year() ) {
                                printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
                            } else {
                                echo __( 'Archives', 'juster' );
                            } ?></h4>
                    <?php
                    } elseif (is_category()) { ?>
                        <h4 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h4>
                <?php
                    } elseif (is_tag()) { ?>
                        <h4 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h4>
                <?php
                    } elseif(is_home()) { ?>
                        <h4 class="page_heading"><?php bloginfo(''); ?></h4>
                <?php
                    } else { ?>
                        <h4 class="page_heading"><?php the_title(); ?></h4>
                <?php
                    }
            } // Hide Page Title
            ?>
        </div>
        <?php
    } // Is not page - Page Title
        if(is_page() && $banner_type_mt != '' && $banner_color_mt != '') {
            $banner_color = $banner_color_mt;
        } elseif(!is_page() && $banner_type_ot != '' && $banner_color_ot != '') {
            $banner_color = $banner_color_ot;
        } else {
            $banner_color = '';
        }
        ?>
        <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
    </div> <!-- Jt Blog BG -->
</div> <!-- Layout Structure -->
<?php
    } // !template-one-page-architecture
} elseif(is_singular('portfolio')) { // single portfolio slider on header
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
    }
}

/*=========================================================================
    Header - Photography Header / Left Side Menu / Right Side Menu - Margin
=========================================================================*/
if($menu_position == 'menu_pos_left_margin' || $menu_position == 'menu_pos_right_margin') {
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
            $layout_structure = 'container-fluid';
        }
    }

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
    if($banner_type_mt != '' && $banner_color_mt != '') {
        $banner_color = $banner_color_mt;
    } elseif($banner_type_ot != '' && $banner_color_ot != '') {
        $banner_color = $banner_color_ot;
    } else {
        $banner_color = 'none';
    }
    if(is_page() && $banner_type_mt == 'sld_ban') {
        $banner_slide_class = 'banner_rev_slide';
    } elseif(!is_page() && $banner_type_ot == 'sld_ban') {
        $banner_slide_class = 'banner_rev_slide';
    } else {
        $banner_slide_class = '';
    }
    if($menu_position == 'menu_pos_left_margin') {
        echo '<div class="right-cont-wrap">';
        echo '<div class="">';
    } elseif($menu_position == 'menu_pos_right_margin') {
        echo '<div class="photography-leftcontent">';
        echo '<div class="">';
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
                <div class="jt-blog-bg <?php echo esc_attr($banner_slide_class); ?>">
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
                            <div class="jt-animated-hand" style="background: url('<?php echo $vint_ban_mt['ban_img_mt']; ?>'); background-size: cover;">
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
                        </ul>
                        <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
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
                                <div class="jt-animated-hand" style="background: url('<?php echo $vint_agy_ban_mt['spc_ban_img']; ?>'); background-size: cover;">
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
                    <div class="slider-container jt-vintage-banner jt-vint-small-banner">
                        <?php echo do_shortcode($banner_slide_mt); ?>
                        <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
                    </div>
                <?php } elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') { ?>
                    <div class="slider-container jt-vintage-banner jt-vint-small-banner">
                        <?php echo do_shortcode($banner_shortcode_mt); ?>
                        <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
                    </div>
                <?php } // Metabox Finished
            } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) {
                $img=0;
                foreach($banner_image_ot as $ban_img_ot) {
                    $img++;
                }
                if($img <= 1) { ?>
                    <div class="slider-container jt-vintage-banner jt-vint-small-banner">
                        <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
                            <div class="jt-animated-hand" style="background: url('<?php echo $vint_ban_ot['ban_img_ot']; ?>'); background-size: cover;">
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
                                        <img src="<?php echo esc_attr($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
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
                                <div class="jt-animated-hand" style="background: url('<?php echo$vint_agy_ban_ot['spc_ban_img']; ?>'); background-size: cover;">
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
                                            <img src="<?php echo esc_attr($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
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
                    <div class="slider-container jt-vintage-banner jt-vint-small-banner">
                        <?php echo do_shortcode($banner_slide_ot); ?>
                        <div class="banner-overlay" style="background: <?php echo esc_attr($banner_color); ?>;"></div>
                    </div>
                <?php } // Banner Finished

            // Page Title Starts
            if (is_page()) {
                $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
                $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
                $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
                $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
                $page_title = ot_get_option('page_title');
                ?>
                <div class="jt-header-content">
                    <?php
                    if($page_subheading) {
                        echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
                    }
                    if ($page_title != 'off' && $enable_new_page_title == 'off') {
                        if(is_front_page()) { ?>
                            <h4 class="page_heading"><?php bloginfo(''); ?></h4>
                        <?php } else { ?>
                            <h4 class="page_heading"><?php the_title(); ?></h4>
                        <?php }
                    } elseif($enable_new_page_title == 'on') {
                        if($new_page_title != '') { ?>
                            <h4 class="page_heading"><?php echo esc_attr($new_page_title); ?></h4>
                        <?php } elseif($new_page_title == '') { ?>
                            <h4 class="page_heading"><?php echo the_title(); ?></h4>
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
                <div class="jt-header-content">
                    <?php if ($page_title != 'off') {
                        if(is_front_page()) { ?>
                            <h4 class="page_heading"><?php bloginfo(''); ?></h4>
                        <?php } elseif (is_author()) { ?>
                            <h4 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h4>
                        <?php
                            } elseif (is_archive()) { ?>
                                <h4 class="page_heading"><?php if ( is_day() ) {
                                        printf( __( 'Daily Archives for %s', 'juster' ), get_the_date() );
                                    } elseif ( is_month() ) {
                                        printf( __( 'Monthly Archives for %s', 'juster' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'juster' ) ) );
                                    } elseif ( is_year() ) {
                                        printf( __( 'Yearly Archives for %s', 'juster' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'juster' ) ) );
                                    } else {
                                        echo __( 'Archives', 'juster' );
                                    } ?></h4>
                            <?php
                            } elseif (is_search()) { ?>
                            <h4 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h4>
                        <?php
                            } elseif (is_category()) { ?>
                                <h4 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h4>
                        <?php
                            } elseif (is_tag()) { ?>
                                <h4 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h4>
                        <?php
                            } elseif(is_home()) { ?>
                                <h4 class="page_heading"><?php bloginfo(''); ?></h4>
                        <?php
                            } else { ?>
                                <h4 class="page_heading"><?php the_title(); ?></h4>
                        <?php
                            }
                    } // Hide Page Title
                    ?>
                </div>
                <?php
            } // Is not page - Page Title
            ?>
        </div> <!-- JT Blog BG -->
    </div> <!-- Layout Stucture -->
    <?php
        } // !template-one-page-architecture
    } elseif(is_singular('portfolio')) { // single portfolio slider on header
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
    } // !single-portfolio
}

/*=========================================================================
    Header - Vintage Header / Left Side Menu / Right Side Menu
=========================================================================*/
    if($menu_position == 'menu_pos_left_vintage' || $menu_position == 'menu_pos_right_vintage') {
        echo '<div class="jt-photo-whole-wrap right-cont-wrap jt-vint-right">';
        if(!is_page_template( 'template-vintage-home.php' )) {
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
            $banner_color_mt = get_post_meta( get_the_ID(), 'banner_color_mt', true );
            $single_port_gallery = get_post_meta( get_the_ID(), 'port_single_img', true );

            if($banner_type_mt == 'img_ban' && $banner_image_mt) {
                $slide_id = 'slider-vint';
            } elseif($banner_type_mt == 'spc_ban' && $special_banner_image_mt) {
                $slide_id = 'large-header';
            } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) {
                $slide_id = 'slider-vint';
            } elseif($banner_type_ot == 'spc_ban' && $special_banner_image_ot) {
                $slide_id = 'large-header';
            } else {
                $slide_id = 'videoid';
            }
            if($banner_type_mt == 'sld_ban') {
                $banner_slide_class = 'banner-rev-slide';
            } elseif($banner_type_ot == 'sld_ban') {
                $banner_slide_class = 'banner-rev-slide';
            } else {
                $banner_slide_class = '';
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
if ($page_hav_banner != 'page_hav_banner') {
    ?>
    <div class="<?php echo esc_attr($layout_structure); ?> padding-zero">
        <?php if(!is_singular('portfolio')) {
        if(!is_page_template( 'template-one-page-architecture.php' )) { ?>
        <div id="<?php echo esc_attr($slide_id); ?>" class="slider-container jt-vintage-banner jt-vint-small-banner <?php echo esc_attr($banner_slide_class); ?>">
            <?php if($banner_type_mt == 'img_ban' && $banner_image_mt) {
                $img=0;
                foreach($banner_image_mt as $ban_img_mt) {
                    $img++;
                }
                if($img <= 1) {
                    foreach($banner_image_mt as $vint_ban_mt) {
                ?>
                    <div class="jt-animated-hand" style="background: url('<?php echo $vint_ban_mt['ban_img_mt']; ?>'); background-size: cover;">
                    </div>
                <?php }
                } elseif($img >= 2) { ?>
                    <ul class="slider jt-animated-hand">
                        <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
                            <li class="slide">
                                <div class="slide-bg">
                                    <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php }
            } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') {
                $spc=0;
                foreach($special_banner_image_mt as $ban_spc_mt) {
                    $spc++;
                }
                if($spc <= 1) {
                    foreach($special_banner_image_mt as $vint_agy_ban_mt) {
                ?>
                        <div class="jt-animated-hand" style="background: url('<?php echo $vint_agy_ban_mt['spc_ban_img']; ?>'); background-size: cover;">
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
                } elseif($spc >= 2) { ?>
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
                }
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
                <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_mt); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
                </a>
            <?php
            } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
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
                    <div class="jt-animated-hand" style="background: url('<?php echo $vint_ban_ot['ban_img_ot']; ?>'); background-size: cover;">
                    </div>
                <?php }
                } elseif($img >= 2) { ?>
                    <ul class="slider jt-animated-hand">
                        <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
                            <li class="slide">
                                <div class="slide-bg">
                                    <img src="<?php echo esc_attr($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php }
            } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') {
                $spc=0;
                foreach($special_banner_image_ot as $ban_spc_ot) {
                    $spc++;
                }
                if($spc <= 1) { ?>
                    <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
                        <div class="jt-animated-hand" style="background: url('<?php echo $vint_agy_ban_ot['spc_ban_img']; ?>'); background-size: cover;">
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
                } elseif($spc >= 2) { ?>
                    <ul class="slider jt-animated-hand">
                        <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
                            <li class="slide">
                                <div class="slide-bg">
                                    <img src="<?php echo esc_attr($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
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
                }
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
                <a class="player mb_YTVPlayer isMuted" data-property="{videoURL:'<?php echo esc_url($banner_video_ot); ?>',containment:'#videoid', showControls:<?php echo esc_attr($vid_ban_control); ?>, autoPlay:<?php echo esc_attr($vid_ban_auto_play); ?>, loop:<?php echo esc_attr($vid_ban_vid_loop); ?>, mute:<?php echo esc_attr($vid_ban_aud_mute); ?>, startAt:<?php echo esc_attr($vid_ban_start_time); ?>, opacity:1, quality:'<?php echo esc_attr($vid_ban_vid_qty); ?>'}">
                </a>
            <?php
            } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
                echo do_shortcode($banner_slide_ot);
            } else {
                if($layout_structure == 'container') {
            ?>
                <ul class="slider jt-animated-hand">
                    <li class="slide">
                        <div class="slide-bg">
                            <img src="<?php echo IMAGES; ?>/dummy/vintage-banner-center.jpg" alt="">
                        </div>
                    </li>
                </ul>
            <?php } elseif($layout_structure == 'container-fluid') { ?>
                <ul class="slider jt-animated-hand">
                    <li class="slide">
                        <div class="slide-bg">
                            <img src="<?php echo IMAGES; ?>/dummy/vintage-banner-1.jpg" alt="">
                        </div>
                    </li>
                </ul>
            <?php }
            }  // Banner Finished
        // Page Title Starts
        if (is_page() && $banner_type_mt != 'sld_ban') {
            $enable_new_page_title = get_post_meta( get_the_ID(), 'enable_new_page_title', true );
            $new_page_title = get_post_meta( get_the_ID(), 'new_page_title', true );
            $page_subheading = get_post_meta( get_the_ID(), 'page_subheading', true );
            $header_banner_title_img = get_post_meta( get_the_ID(), 'header_banner_title_img', true );
            if( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading !='' ) {
                $ban_text = 'jt-vintage-bantext-1null';
            } elseif( $enable_new_page_title == 'off' && $header_banner_title_img != '' && $page_subheading =='' ) {
                $ban_text = 'jt-vintage-bantext-2null';
            } elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading !='' ) {
                $ban_text = 'jt-vintage-bantext-3null';
            } elseif( $enable_new_page_title == 'off' && $header_banner_title_img == '' && $page_subheading =='' ) {
                $ban_text = 'jt-vintage-bantext-4null';
            } elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading !='' ) {
                $ban_text = 'jt-vintage-bantext-5null';
            } elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading !='' ) {
                $ban_text = 'jt-vintage-bantext-6null';
            } elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img == '' && $page_subheading !='' ) {
                $ban_text = 'jt-vintage-bantext-7null';
            } elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img == '' && $page_subheading !='' ) {
                $ban_text = 'jt-vintage-bantext-8null';
            } elseif( $enable_new_page_title == 'on' && $new_page_title != '' && $header_banner_title_img != '' && $page_subheading =='' ) {
                $ban_text = 'jt-vintage-bantext-9null';
            } elseif( $enable_new_page_title == 'on' && $new_page_title == '' && $header_banner_title_img != '' && $page_subheading =='' ) {
                $ban_text = 'jt-vintage-bantext-10null';
            } else {
                $ban_text = '';
            }

            $page_title = ot_get_option('page_title');
            ?>
            <div class="jt-vintage-banner-content jt-vint-small-content <?php echo esc_attr($ban_text); ?>">
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
                } // Page Title Hide
                if($page_subheading) {
                    echo '<p class="page_sub_heading">'.esc_attr($page_subheading).'</p>';
                }
                if($header_banner_title_img !='') {
                    echo '<div class="jt-vintage-ban-tit">';
                    echo '<img src="'.esc_attr($header_banner_title_img).'" alt="">';
                    echo '</div>';
                } ?>
            </div>
        <?php
        } elseif(!is_page() && $banner_type_ot != 'sld_ban') {
            $page_title = ot_get_option('page_title');
        ?>
            <div class="jt-vintage-banner-content jt-vint-small-content">
                <?php if ($page_title != 'off') {
                    if(is_front_page()) { ?>
                        <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                        <h1 class="page_heading"><?php bloginfo(''); ?></h1>
                    <?php } elseif (is_author()) { ?>
                        <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                        <h1 class="page_heading"><?php printf( __( 'All posts by : %s', 'juster' ), get_the_author() ); ?></h1>
                    <?php
                        } elseif (is_archive()) { ?>
                            <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
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
                            <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                        <h1 class="page_heading"><?php printf( __( 'Search Results for : %s', 'juster' ), get_search_query() ); ?></h1>
                    <?php
                        } elseif (is_category()) { ?>
                            <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading"><?php printf( __( 'Category Archives for : %s', 'juster' ), single_cat_title( '', false ) ); ?></h1>
                    <?php
                        } elseif (is_tag()) { ?>
                            <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading"><?php printf( __( 'Tag Archives for : %s', 'juster' ), single_tag_title( '', false ) ); ?></h1>
                    <?php
                        } elseif(is_home()) { ?>
                            <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading"><?php bloginfo(''); ?></h1>
                    <?php
                        } else { ?>
                            <p class="page_sub_heading"><?php echo bloginfo(''); ?></p>
                            <h1 class="page_heading"><?php the_title(); ?></h1>
                    <?php
                        }
                } // Hide Page Title
                ?>
            </div>
            <?php
        } // Is not page - Page Title

        ?>
        </div>
        <?php } // !template-one-page-architecture
        } elseif(is_singular('portfolio')) { // single portfolio slider on header
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
        } // single portfolio
        ?>
    </div>
    <?php
}
    } elseif(is_page_template( 'template-vintage-home.php' )) { // Vintage Home Template
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
                $slide_id = 'slider-vint-home';
            } elseif( ($banner_type_mt == 'spc_ban' && $special_banner_image_mt) || $banner_type_ot == 'spc_ban' && $special_banner_image_ot ) {
                $slide_id = 'large-header';
            } else {
                $slide_id = '';
            }
        ?>
        <div id="<?php echo esc_attr($slide_id); ?>" class="slider-container jt-vintage-banner">
            <?php if($banner_type_mt == 'img_ban' && $banner_image_mt) { ?>
                <ul class="slider jt-animated-hand">
                    <?php foreach($banner_image_mt as $vint_ban_mt) { ?>
                        <li class="slide">
                            <div class="slide-bg">
                                <img src="<?php echo esc_attr($vint_ban_mt['ban_img_mt']); ?>" alt="">
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <div class="slider-controls">
                    <div class="slide-nav">
                        <a href="#" class="prev"><img src="<?php echo IMAGES; ?>/icons/vint-ban-left.png" alt=""></a>
                        <a href="#" class="next"><img src="<?php echo IMAGES; ?>/icons/vint-ban-right.png" alt=""></a>
                    </div>
                </div>
            <?php } elseif($banner_type_mt == 'spc_ban' && $banner_type_spl_mt != '' && $special_banner_image_mt != '') { ?>
            <ul class="slider jt-animated-hand">
                <?php foreach($special_banner_image_mt as $vint_agy_ban_mt) { ?>
                    <li class="slide">
                        <div class="slide-bg">
                            <img src="<?php echo esc_attr($vint_agy_ban_mt['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <div class="slider-controls">
                <div class="slide-nav">
                    <a href="#" class="prev"><img src="<?php echo IMAGES; ?>/icons/vint-ban-left.png" alt=""></a>
                    <a href="#" class="next"><img src="<?php echo IMAGES; ?>/icons/vint-ban-right.png" alt=""></a>
                </div>
            </div>
            <?php if($banner_type_spl_mt == 'spc_ban_type_one') { ?>
                <canvas id="juster-canvas-one"></canvas>
            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_two') { ?>
                <canvas id="juster-canvas-two"></canvas>
            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_three') { ?>
                <canvas id="juster-canvas-three"></canvas>
            <?php } elseif($banner_type_spl_mt == 'spc_ban_type_four') { ?>
                <canvas id="juster-canvas-four"></canvas>
            <?php }
            } elseif($banner_type_mt == 'vid_ban' && $banner_video_mt != '') {
                echo esc_url($banner_video_mt);
            } elseif($banner_type_mt == 'sld_ban' && $banner_slide_mt != '') {
                echo do_shortcode($banner_slide_mt);
            } elseif($banner_type_mt == 'shortcode_ban' && $banner_shortcode_mt != '') {
                echo do_shortcode($banner_shortcode_mt);
            } elseif($banner_type_ot == 'img_ban' && $banner_image_ot) { ?>
                <ul class="slider jt-animated-hand">
                    <?php foreach($banner_image_ot as $vint_ban_ot) { ?>
                        <li class="slide">
                            <div class="slide-bg">
                                <img src="<?php echo esc_attr($vint_ban_ot['ban_img_ot']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <div class="slider-controls">
                    <div class="slide-nav">
                        <a href="#" class="prev"><img src="<?php echo IMAGES; ?>/icons/vint-ban-left.png" alt=""></a>
                        <a href="#" class="next"><img src="<?php echo IMAGES; ?>/icons/vint-ban-right.png" alt=""></a>
                    </div>
                </div>
            <?php } elseif($banner_type_ot == 'spc_ban' && $banner_type_spl_ot != '' && $special_banner_image_ot != '') { ?>
            <ul class="slider jt-animated-hand">
                <?php foreach($special_banner_image_ot as $vint_agy_ban_ot) { ?>
                    <li class="slide">
                        <div class="slide-bg">
                            <img src="<?php echo esc_attr($vint_agy_ban_ot['spc_ban_img']); ?>" alt="<?php echo esc_attr(the_title()); ?>">
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <div class="slider-controls">
                <div class="slide-nav">
                    <a href="#" class="prev"><img src="<?php echo IMAGES; ?>/icons/vint-ban-left.png" alt=""></a>
                    <a href="#" class="next"><img src="<?php echo IMAGES; ?>/icons/vint-ban-right.png" alt=""></a>
                </div>
            </div>
            <?php if($banner_type_spl_ot == 'spc_ban_type_one') { ?>
                <canvas id="juster-canvas-one"></canvas>
            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_two') { ?>
                <canvas id="juster-canvas-two"></canvas>
            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_three') { ?>
                <canvas id="juster-canvas-three"></canvas>
            <?php } elseif($banner_type_spl_ot == 'spc_ban_type_four') { ?>
                <canvas id="juster-canvas-four"></canvas>
            <?php }
            } elseif($banner_type_ot == 'vid_ban' && $banner_video_ot != '') {
                echo esc_url($banner_video_ot);
            } elseif($banner_type_ot == 'sld_ban' && $banner_slide_ot != '') {
                echo do_shortcode($banner_slide_ot);
            } else { ?>
                <ul class="slider jt-animated-hand">
                    <li class="slide">
                        <div class="slide-bg">
                            <img src="<?php echo IMAGES; ?>/dummy/vintage-banner-1.jpg" alt="">
                        </div>
                    </li>
                </ul>
            <?php } ?>
        </div>
    <?php
        } // template-vintage-home
    }
    /* </Vintage Menu Banner> */

    global $post;
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $content_inside_container_ot = ot_get_option('content_inside_container_ot');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    if( is_page() ) {
        if( $layout_model_mt ) {
            if( $layout_model_mt === 'full_width' ) {
                $layout_structure = 'container';
            } elseif( $layout_model_mt === 'extra_width' ) {
                $layout_structure = 'container-fluid padding-zero';
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
            } elseif( $layout_model_ot === 'extra-width' && $content_inside_container_ot ) {
                $layout_structure = 'container-fluid padding-zero';
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
                $layout_structure = 'container-fluid padding-zero';
            } else {
                $layout_structure = 'container';
            }
        } else {
            $layout_structure = 'container';
        }
    }

    if( !is_page_template( 'template-one-page-architecture.php' ) && !is_page_template( 'template-scroll-lock.php' ) && !is_page_template( 'template-agency-home.php' ) ) {

        if($layout_structure == 'container') { // For Entry Content Holder
            $layout_above_entry_content = $layout_structure.' padding-zero';
        } else {
            $layout_above_entry_content = $layout_structure;
        }
    ?>
    <div class="<?php echo esc_attr($layout_above_entry_content); ?> jt_content_holder">
    <div class="entry-content page-container content-ctrl"> <!-- Main Container -->
    <?php }

    if( !is_page_template( 'template-one-page-architecture.php' ) && !is_page_template( 'template-scroll-lock.php' )  && $menu_position != 'menu_pos_top_boxed' ) {
    ?>
        <div class="<?php echo esc_attr($layout_structure); ?>"> <!-- Container -->
    <?php }
    if($menu_position == 'menu_pos_top_boxed') {
        echo '<div class="container">'; // Boxed container class
    }
    global $post;
    $layout_model_ot = ot_get_option('fullwidth_boxed');
    $layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
    $content_inside_container_ot = ot_get_option('content_inside_container_ot');
    $content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );
    if(is_page() && !is_page_template( 'template-scroll-lock.php' )) {
        if( $layout_model_mt === 'extra_width' && isset($content_inside_container_mt[0]) ) {
            echo '<div class="container main-content-center">';
        } elseif( $layout_model_mt === 'extra_width' && !isset($content_inside_container_ot[0]) ) {
            echo '';
        } elseif( $layout_model_ot === 'extra-width' && !isset($content_inside_container_ot[0]) ) {
            echo '<div class="container main-content-center">';
        } else { }
    } elseif(!is_page()) {
        if( $layout_model_ot === 'extra-width' && !isset($content_inside_container_ot[0]) ) {
            echo '<div class="container main-content-center">';
        } else { }
    }

} //!404 Page
