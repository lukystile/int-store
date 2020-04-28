<?php
/*
* ---------------------------------------------------------------------
* Defatch Dynamic Style
* ---------------------------------------------------------------------
*/

header("Content-type: text/css;");
$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $absolute_path[0] . 'wp-load.php';
require_once($wp_load);

$retina_logo_upload = ot_get_option('retina_logo_upload');
$front_retina_logo_upload = ot_get_option('front_retina_logo_upload');
$retina_logo_width = ot_get_option('retina_logo_width');
$retina_logo_height = ot_get_option('retina_logo_height');
if ($front_retina_logo_upload) { ?>
	/*---------------------------------------------------------------*/
	/* Retina Front Page */
	/*---------------------------------------------------------------*/
	@media
	only screen and (-webkit-min-device-pixel-ratio: 2),
	only screen and (   min-moz-device-pixel-ratio: 2),
	only screen and (     -o-min-device-pixel-ratio: 2/1),
	only screen and (        min-device-pixel-ratio: 2),
	only screen and (                min-resolution: 192dpi),
	only screen and (                min-resolution: 2dppx) {
		.is_front_page .default-logo {display:none !important;}
		.is_front_page .retina-logo {display:inline-block !important;}
		.is_front_page .retina-logo img {width: <?php echo $retina_logo_width; ?>; height: <?php echo $retina_logo_height; ?>;}
	}
<?php
}
if ($retina_logo_upload || $front_retina_logo_upload != '') { ?>
	/*---------------------------------------------------------------*/
	/* Retina */
	/*---------------------------------------------------------------*/
	@media
	only screen and (-webkit-min-device-pixel-ratio: 2),
	only screen and (   min-moz-device-pixel-ratio: 2),
	only screen and (     -o-min-device-pixel-ratio: 2/1),
	only screen and (        min-device-pixel-ratio: 2),
	only screen and (                min-resolution: 192dpi),
	only screen and (                min-resolution: 2dppx) {
		.default-logo {display:none !important;}
		.retina-logo {display:inline-block !important;}
		.jt_left_content .retina-logo,
		.jt_right_content .retina-logo {display:block !important;}
		.retina-logo img {width: <?php echo $retina_logo_width; ?>; height: <?php echo $retina_logo_height; ?>;}
	}
<?php
}

$logo_outter_space = ot_get_option('logo_outter_space');
if ($logo_outter_space) { ?>
@media (max-width: 767px) {
	.jt_main_content .jt-main-banner-holder .hidden-big-screen a.default.navbar-logo,
	.jt_freelance_content .jt-freelance-head .hidden-big-screen a.navbar-logo,
	.navbar-logo,
	.jt_business_content .jt-bussiness-head-cont .hidden-big-screen a.default.navbar-logo,
	.jt_arch_content .jt-arch-head-content .hidden-big-screen a.default.navbar-logo,
	.jt_studio_content.is_front_page .jt-head-studio .hidden-big-screen a.default.navbar-logo,
	.jt_studio_content .jt-head-studio.not-front-studio .hidden-big-screen a.default.navbar-logo,
	.jt-photo-wrap.jt_vintage_content .hidden-side-big-screen a.default.navbar-logo,
	.jt-box-layout-bg .jt-boxed-layout .hidden-big-screen a.default.navbar-logo {
		padding: <?php echo $logo_outter_space; ?>;
	}
}
@media (max-width: 992px) {
	.jt_left_content .hidden-side-big-screen a.default.navbar-logo,
	.jt_right_content .hidden-side-big-screen a.default.navbar-logo,
	.jt-photo-wrap.jt_photography_content .hidden-side-big-screen a.default.navbar-logo.default-logo,
	.jt-photo-wrap.jt_photography_content .hidden-side-big-screen a.default.navbar-logo,
	.jt-photo-wrap.jt_vintage_content .hidden-side-big-screen a.default.navbar-logo {
		padding: <?php echo $logo_outter_space; ?> !important;
	}
}
<?php }

/* Breadcrumbs Link color */
$breadcrumbs_link_color = ot_get_option('breadcrumbs_link_color');
$banner_heading_color = ot_get_option('banner_heading_color');
$banner_sub_heading_color = ot_get_option('banner_sub_heading_color');
if($breadcrumbs_link_color) { ?>
.jt-page-banner .jt-breadcrumbs span a,
.jt-page-banner .jt-breadcrumbs a,
.jt-page-banner .jt-breadcrumbs span,
.jt_business_content .jt-business-banner-content .jt-breadcrumbs span a,
.jt_business_content .jt-business-banner-content .jt-breadcrumbs span,
.jt_business_content .jt-business-banner-content .jt-breadcrumbs a,
.jt_shop_content .jt-shop-header .jt-breadcrumbs span a,
.jt_shop_content .jt-shop-header .jt-breadcrumbs span,
.jt_shop_content .jt-shop-header .jt-breadcrumbs a {
	color: <?php echo esc_attr($breadcrumbs_link_color); ?>;
}
<?php }
if($banner_heading_color) { ?>
.jt-page-banner h1.page_heading,
.jt-page-banner h2.page_heading,
.jt_left_content .jt-blog-bg .jt-header-content h4.page_heading,
.jt_right_content .jt-blog-bg .jt-header-content h4.page_heading,
.jt_business_content .jt-business-banner-content h1.page_heading,
.jt-photo-wrap .jt-header-content h4.page_heading,
.jt-photo-wrap .jt-header-content p.page_sub_heading,
.jt_arch_content .jt-arch-title h1.page_heading,
.jt_agency_content .jt-agency-banner-content h1.page_heading,
.jt_studio_content.is_front_page .jt-studio-head .jt-studio-sub h1.page_heading,
.jt_studio_content .jt-head-studio .jt-studio-banner-small.jt-small-studio .jt-small-content h1.page_heading,
.jt_vintage_content .jt-vintage-banner-content h1.page_heading,
.jt-box-layout-bg .jt-boxed-layout .jt_box_header_content .box-banner-content h1.page_heading,
.jt_shop_content .jt-shop-header .jt-blog-bg .shop-banner-content h1.page_heading {
	color: <?php echo esc_attr($banner_heading_color); ?>;
}
<?php }
if($banner_sub_heading_color) { ?>
.jt-page-banner h3.page_sub_heading,
.jt_left_content .jt-blog-bg .jt-header-content p.page_sub_heading,
.jt_right_content .jt-blog-bg .jt-header-content p.page_sub_heading,
.jt_business_content .jt-business-banner-content p.page_sub_heading,
.jt-photo-wrap .jt-header-content p.page_sub_heading,
.jt_arch_content .jt-arch-title p.page_sub_heading,
.jt_agency_content .jt-agency-banner-content p.page_sub_heading,
.jt_studio_content .jt-small-content h3.page_sub_heading,
.jt_studio_content .jt-studio-sub h3.page_sub_heading,
.jt_vintage_content .jt-vintage-banner-content p.page_sub_heading,
.jt-box-layout-bg .jt-boxed-layout .jt_box_header_content .box-banner-content p.page_sub_heading,
.jt_shop_content .jt-shop-header .jt-blog-bg .shop-banner-content p.page_sub_heading {
	color: <?php echo esc_attr($banner_sub_heading_color); ?>;
}
<?php }

/*
 * COLOR - MENU
 */
$front_cus_enable 			= ot_get_option('front_cus_enable');
$front_menu_color 			= ot_get_option('front_menu_color');
$front_sub_menu_color 		= ot_get_option('front_sub_menu_color');
$front_sub_menu_bg_color 	= ot_get_option('front_sub_menu_bg_color');

$menu_color 		= ot_get_option('menu_color');
$sub_menu_color 	= ot_get_option('sub_menu_color');
$sub_menu_bg_color 	= ot_get_option('sub_menu_bg_color');

if(($front_cus_enable == 'on' && $front_menu_color != '') || is_page_template( 'template-scroll-lock.php' )) { ?>
.is_front_page .collapse.navbar-collapse ul.nav.navbar-nav > li > a,
.is_front_page .menu-main-menu-container ul.nav.navbar-nav > li.menu-item > a,
.is_front_page .left-menu-wrap .menu-main-menu-container ul.left-menu li a,
.is_front_page .left-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over,
.is_front_page .right-menu-wrap .menu-main-menu-container ul.left-menu li a,
.is_front_page .right-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over,
.is_front_page .hidden-side-big-screen .menu-main-menu-container ul.menu li a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.menu-item span.jt-cross-over,
.is_front_page.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li a,
.is_front_page.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li a,
.is_front_page.jt_studio_content .collapse.navbar-collapse ul.nav.navbar-nav a,
.is_front_page.jt_studio_content .menu-main-menu-container ul.nav.navbar-nav li.menu-item a,
.is_front_page header .navbar-default .navbar-nav > li > a,
.is_front_page header .navbar.navbar-default ul.nav.navbar-nav > li > a,
.page-template-template-scroll-lock header .navbar-default .navbar-nav > li > a,
.page-template-template-scroll-lock header .navbar.navbar-default ul.nav.navbar-nav > li > a {
	color: <?php echo $front_menu_color[0]; ?>;
}
.is_front_page .collapse.navbar-collapse ul.nav.navbar-nav li.menu-item a:hover,
.is_front_page .menu-main-menu-container ul.nav.navbar-nav li.menu-item a:hover,
.is_front_page .left-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item a:hover,
.is_front_page .left-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over:hover,
.is_front_page .right-menu-wrap .menu-main-menu-container ul.left-menu li a:hover,
.is_front_page .right-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over:hover,
.is_front_page .hidden-side-big-screen ul.slimmenu.collapsed .menu-main-menu-container ul.menu li.menu-item a:hover,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.menu-item span.jt-cross-over:hover,
.is_front_page .hidden-side-big-screen ul.left-menu.port-filter-menu li span.jt-cross-over:hover,
.is_front_page.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li a:hover,
.is_front_page.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li a:hover,
.is_front_page.jt-box-layout-bg .jt-boxed-layout .jt_box_header_content .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav li a:hover,

.page-template-template-scroll-lock header .navbar.navbar-default ul.nav.navbar-nav a:hover {
	color: <?php echo $front_menu_color[2]; ?>;
}
.is_front_page .collapse.navbar-collapse ul.nav.navbar-nav li.active a,
.is_front_page .menu-main-menu-container ul.nav.navbar-nav li.active a,
.is_front_page .left-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item.active a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.active a,
.is_front_page .right-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item.active a,
.is_front_page.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li.active a,
.is_front_page.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li.active a,
.is_front_page .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav li.active a,

.page-template-template-scroll-lock .collapse.navbar-collapse ul.nav.navbar-nav li.active a {
	color: <?php echo $front_menu_color[1]; ?>;
}
.is_front_page.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li.active a:after,
.is_front_page.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li.active a:after {
	background: <?php echo $front_menu_color[1]; ?>;
}
.is_front_page .left-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item a:after,
.is_front_page .left-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over:after,
.is_front_page .right-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item a:after,
.is_front_page .jt_right_content .right-menu-wrap.menu-right ul.left-menu.port-filter-menu li span.jt-cross-over:after,
.is_front_page.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li a:after,
.is_front_page.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li a:after,
.is_front_page.jt_agency_content .jt-agency-header .menu-main-menu-container ul.nav.navbar-nav li a:after,
.is_front_page.jt_studio_content .collapse.navbar-collapse ul.nav.navbar-nav a:after,
.is_front_page.jt_studio_content .menu-main-menu-container ul.nav.navbar-nav li.menu-item a:after {
	background: <?php echo $front_menu_color[0]; ?>;
}
<?php } //front page menu color

if($menu_color[0] != '') { ?>
.collapse.navbar-collapse ul.nav.navbar-nav a,
.menu-main-menu-container ul.nav.navbar-nav li.menu-item a,
.left-menu-wrap .menu-main-menu-container ul.left-menu li a,
.left-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over,
.right-menu-wrap .menu-main-menu-container ul.left-menu li a,
.right-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over,
.hidden-side-big-screen .menu-main-menu-container ul.menu li a,
.hidden-side-big-screen ul.nav.navbar-nav li.menu-item span.jt-cross-over,
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li a,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li a,
.jt_studio_content .collapse.navbar-collapse ul.nav.navbar-nav a,
.jt_studio_content .menu-main-menu-container ul.nav.navbar-nav li.menu-item a,
header .navbar.navbar-default ul.nav.navbar-nav a,
.navbar.navbar-default ul.nav.navbar-nav a,
.left-menu-list ul.left-menu li a,
.left-menu-list ul.nav.navbar-nav li a,
ul.slimmenu.collapsed li a,
.left-menu-list .left-menu > li,
.left-menu-list .left-menu .port-filter li a,
.left-menu-list .left-menu .sub-menu li a,
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > li > a,
.navbar-nav > ul > li > span.dropdown-toggle a,
.jt-agency-menu h3 {
	color: <?php echo $menu_color[0]; ?>;
}
<?php }
if($menu_color[2] != '') { ?>
.collapse.navbar-collapse ul.nav.navbar-nav li.menu-item a:hover,
.menu-main-menu-container ul.nav.navbar-nav li.menu-item a:hover,
.left-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item a:hover,
.left-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over:hover,
.right-menu-wrap .menu-main-menu-container ul.left-menu li a:hover,
.right-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over:hover,
.hidden-side-big-screen ul.slimmenu.collapsed .menu-main-menu-container ul.menu li.menu-item a:hover,
.hidden-side-big-screen ul.nav.navbar-nav li.menu-item span.jt-cross-over:hover,
.hidden-side-big-screen ul.left-menu.port-filter-menu li span.jt-cross-over:hover,
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li a:hover,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li a:hover,
.jt-box-layout-bg .jt-boxed-layout .jt_box_header_content .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav li a:hover {
	color: <?php echo $menu_color[2]; ?>;
}
<?php }
if($menu_color[1] != '') { ?>
.collapse.navbar-collapse ul.nav.navbar-nav li.active a,
.menu-main-menu-container ul.nav.navbar-nav li.active a,
.left-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item.active a,
.hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.active a,
.right-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item.active a,
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li.active a,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li.active a,
.hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav li.active a {
	color: <?php echo $menu_color[1]; ?>;
}
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li.active a:after,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li.active a:after {
	background: <?php echo $menu_color[1]; ?>;
}
<?php }
if($menu_color[2] != '') { ?>
.left-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item a:after,
.left-menu-wrap ul.left-menu.port-filter-menu li span.jt-cross-over:after,
.right-menu-wrap .menu-main-menu-container ul.left-menu li.menu-item a:after,
.jt_right_content .right-menu-wrap.menu-right ul.left-menu.port-filter-menu li span.jt-cross-over:after,
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu li a:after,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu li a:after,
.jt_agency_content .jt-agency-header .menu-main-menu-container ul.nav.navbar-nav li a:after,
.jt_studio_content .collapse.navbar-collapse ul.nav.navbar-nav a:after,
.jt_studio_content .menu-main-menu-container ul.nav.navbar-nav li.menu-item a:after {
	background: <?php echo $menu_color[2]; ?>;
}
<?php }

/*
 *  COLOR - SUB MENU
 */
if(($front_cus_enable == 'on' && $front_sub_menu_color != '') || is_page_template( 'template-scroll-lock.php' )) { ?>
.is_front_page .collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu a,
.is_front_page .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.menu-item a,
.is_front_page.jt_main_content.have_rev_slider .jt-page-header.jt-blog-page .is-sticky header .navbar.navbar-default ul.nav.navbar-nav li ul.dropdown-menu li a,
.is_front_page .left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item a,
.is_front_page .left-menu-wrap ul.left-menu.port-filter-menu li ul.port-filter li a,
.is_front_page .right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item a,
.is_front_page .right-menu-wrap ul.left-menu.port-filter-menu li ul.port-filter li a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a,
.is_front_page .jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a,
.is_front_page .jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a,
.is_front_page .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a,
.is_front_page .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a,

.page-template-template-scroll-lock .collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu a,
.page-template-template-scroll-lock .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.menu-item a,
.page-template-template-scroll-lock.jt_main_content.have_rev_slider .jt-page-header.jt-blog-page .is-sticky header .navbar.navbar-default ul.nav.navbar-nav li ul.dropdown-menu li a,
.page-template-template-scroll-lock .left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item a,
.page-template-template-scroll-lock .left-menu-wrap ul.left-menu.port-filter-menu li ul.port-filter li a,
.page-template-template-scroll-lock .right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item a,
.page-template-template-scroll-lock .right-menu-wrap ul.left-menu.port-filter-menu li ul.port-filter li a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a,
.page-template-template-scroll-lock .jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a,
.page-template-template-scroll-lock .jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a,
.page-template-template-scroll-lock .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a,
.page-template-template-scroll-lock .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a {
	color: <?php echo $front_sub_menu_color[0]; ?>;
}
.is_front_page .collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu a:hover,
.is_front_page .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.menu-item a:hover,
.is_front_page.jt_main_content.have_rev_slider .jt-page-header.jt-blog-page .is-sticky header .navbar.navbar-default ul.nav.navbar-nav li ul.dropdown-menu li a:hover,
.is_front_page .left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li a:hover,
.is_front_page .left-menu-wrap ul.left-menu.port-filter-menu ul.port-filter li a:hover,
.is_front_page .right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li a:hover,
.is_front_page .right-menu-wrap ul.left-menu.port-filter-menu ul.port-filter li a:hover,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li a:hover,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a:hover,
.is_front_page .jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a:hover,
.is_front_page .jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a:hover,
.is_front_page .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a:hover,
.is_front_page .jt-box-layout-bg .jt-boxed-layout .jt_box_header_content .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li a:hover,
.is_front_page .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a:hover,

.page-template-template-scroll-lock .collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu a:hover,
.page-template-template-scroll-lock .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.menu-item a:hover,
.page-template-template-scroll-lock.jt_main_content.have_rev_slider .jt-page-header.jt-blog-page .is-sticky header .navbar.navbar-default ul.nav.navbar-nav li ul.dropdown-menu li a:hover,
.page-template-template-scroll-lock .left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li a:hover,
.page-template-template-scroll-lock .left-menu-wrap ul.left-menu.port-filter-menu ul.port-filter li a:hover,
.page-template-template-scroll-lock .right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li a:hover,
.page-template-template-scroll-lock .right-menu-wrap ul.left-menu.port-filter-menu ul.port-filter li a:hover,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li a:hover,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a:hover,
.page-template-template-scroll-lock .jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a:hover,
.page-template-template-scroll-lock .jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a:hover,
.page-template-template-scroll-lock .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a:hover,
.page-template-template-scroll-lock .jt-box-layout-bg .jt-boxed-layout .jt_box_header_content .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li a:hover,
.page-template-template-scroll-lock .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a:hover {
	color: <?php echo $front_sub_menu_color[2]; ?>;
}
.is_front_page .collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu li.active a,
.is_front_page .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.active a,
.is_front_page.jt_main_content.have_rev_slider .jt-page-header.jt-blog-page .is-sticky header .navbar.navbar-default ul.nav.navbar-nav li ul.dropdown-menu li.active a,
.is_front_page .left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item.active a,
.is_front_page .right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item.active a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li.active a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li.active a,
.is_front_page .jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li.active a,
.is_front_page .jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li.active a,
.is_front_page .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li.active a,
.is_front_page .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li.active a,

.page-template-template-scroll-lock .collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu li.active a,
.page-template-template-scroll-lock .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.active a,
.page-template-template-scroll-lock.jt_main_content.have_rev_slider .jt-page-header.jt-blog-page .is-sticky header .navbar.navbar-default ul.nav.navbar-nav li ul.dropdown-menu li.active a,
.page-template-template-scroll-lock .left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item.active a,
.page-template-template-scroll-lock .right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item.active a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li.active a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li.active a,
.page-template-template-scroll-lock .jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li.active a,
.page-template-template-scroll-lock .jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li.active a,
.page-template-template-scroll-lock .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li.active a,
.page-template-template-scroll-lock .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li.active a {
	color: <?php echo $front_sub_menu_color[1]; ?>;
}
<?php } // front page sub menu color

if($sub_menu_color != '') { ?>
.collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu a,
.menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.menu-item a,
.left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item a,
.left-menu-wrap ul.left-menu.port-filter-menu li ul.port-filter li a,
.right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item a,
.right-menu-wrap ul.left-menu.port-filter-menu li ul.port-filter li a,
.hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li a,
.hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a,
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a,
.jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a,
.jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a {
	color: <?php echo $sub_menu_color[0]; ?>;
}
.collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu a:hover,
.menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.menu-item a:hover,
.left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li a:hover,
.left-menu-wrap ul.left-menu.port-filter-menu ul.port-filter li a:hover,
.right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li a:hover,
.right-menu-wrap ul.left-menu.port-filter-menu ul.port-filter li a:hover,
.hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li a:hover,
.hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a:hover,
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a:hover,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li a:hover,
.jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a:hover,
.jt-box-layout-bg .jt-boxed-layout .jt_box_header_content .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li a:hover,
.jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a:hover {
	color: <?php echo $sub_menu_color[2]; ?>;
}
.collapse.navbar-collapse ul.nav.navbar-nav ul.dropdown-menu li.active a,
.menu-main-menu-container ul.nav.navbar-nav ul.dropdown-menu li.active a,
.left-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item.active a,
.right-menu-wrap .menu-main-menu-container ul.left-menu ul.sub-menu li.menu-item.active a,
.hidden-side-big-screen ul.nav.navbar-nav .menu-main-menu-container ul.menu li.menu-item.dropdown ul.dropdown-menu li.active a,
.hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li.active a,
.jt-photo-wrap .left-menu-wrap.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li.active a,
.jt-photo-wrap .photography-rightmenu.jt-dark-bg .left-menu-list ul.left-menu ul.sub-menu li.active a,
.jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li.active a,
.jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li.active a {
	color: <?php echo $sub_menu_color[1]; ?>;
}
<?php }

/*
 * SUB MENU - BACKGROUND COLOR
 */
if(($front_cus_enable == 'on' && $front_sub_menu_bg_color != '') || is_page_template( 'template-scroll-lock.php' )) { ?>
.is_front_page .collapse.navbar-collapse ul.nav.navbar-nav li.dropdown ul.dropdown-menu,
.is_front_page .menu-main-menu-container ul.nav.navbar-nav.navbar-left.jt-main-nav li.dropdown ul.dropdown-menu,
.is_front_page .jt_agency_content .jt-agency-header ul.nav.navbar-nav li.dropdown ul.dropdown-menu,

.page-template-template-scroll-lock .collapse.navbar-collapse ul.nav.navbar-nav li.dropdown ul.dropdown-menu,
.page-template-template-scroll-lock .menu-main-menu-container ul.nav.navbar-nav.navbar-left.jt-main-nav li.dropdown ul.dropdown-menu,
.page-template-template-scroll-lock .jt_agency_content .jt-agency-header ul.nav.navbar-nav li.dropdown ul.dropdown-menu {
	background: <?php echo $front_sub_menu_bg_color; ?>;
}
.is_front_page .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav li.menu-item a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.menu-item span.jt-cross-over,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li a:hover,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a,
.is_front_page .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a:hover,
.is_front_page .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li a,
.is_front_page .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li a:hover,
.is_front_page .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav ul.dropdown-menu ul.dropdown-menu li a,
.is_front_page .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav ul.dropdown-menu ul.dropdown-menu li a:hover,
.is_front_page .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a,

.page-template-template-scroll-lock .hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav li.menu-item a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li.menu-item span.jt-cross-over,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li a:hover,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a,
.page-template-template-scroll-lock .hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a:hover,
.page-template-template-scroll-lock .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li a,
.page-template-template-scroll-lock .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li a:hover,
.page-template-template-scroll-lock .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav ul.dropdown-menu ul.dropdown-menu li a,
.page-template-template-scroll-lock .jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav ul.dropdown-menu ul.dropdown-menu li a:hover,
.page-template-template-scroll-lock .jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a {
	background: <?php echo $front_sub_menu_bg_color; ?>;
}
<?php }

if($sub_menu_bg_color != '') { ?>
.collapse.navbar-collapse ul.nav.navbar-nav li.dropdown ul.dropdown-menu,
.menu-main-menu-container ul.nav.navbar-nav.navbar-left.jt-main-nav li.dropdown ul.dropdown-menu,
.jt_agency_content .jt-agency-header ul.nav.navbar-nav li.dropdown ul.dropdown-menu {
	background: <?php echo $sub_menu_bg_color; ?>;
}
.hidden-big-screen .menu-main-menu-container ul.nav.navbar-nav li.menu-item a,
.hidden-side-big-screen ul.nav.navbar-nav li.menu-item span.jt-cross-over,
.hidden-side-big-screen ul.nav.navbar-nav li.menu-item ul.port-filter li a,
.hidden-side-big-screen ul.nav.navbar-nav li a,
.hidden-side-big-screen ul.nav.navbar-nav li a:hover,
.hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a,
.hidden-side-big-screen ul.nav.navbar-nav li.dropdown ul.dropdown-menu li a:hover,
.jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li a,
.jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav li a:hover,
.jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav ul.dropdown-menu ul.dropdown-menu li a,
.jt-photo-wrap .hidden-side-big-screen ul.nav.navbar-nav ul.dropdown-menu ul.dropdown-menu li a:hover,
.jt_shop_content .hidden-big-screen .menu-main-menu-container ul.slimmenu.collapsed li ul.dropdown-menu li a {
	background: <?php echo $sub_menu_bg_color; ?>;
}
<?php }

/* Primary Color */
/* Primary Color - Color */
$primary_color = ot_get_option('primary_color');
if($primary_color != '') { ?>
.wp-link-pages > span,
.page-numbers a.prev:hover,
.page-numbers a.prev:focus,
.page-numbers a.next:hover,
.page-numbers a.next:focus,
.page-numbers li a:hover,
.page-numbers li a:focus,
.page-numbers span.current,
.author-desc a,
.author-social li a,
.jt_row_class .vc_tta-tabs.vc_tta-style-classic .vc_tta-tabs-list,
.jt_row_class .vc_tta-tour .vc_tta-tabs-list .vc_tta-tab a,
.jt_row_class .vc_tta-tour .vc_tta-tabs-list .vc_tta-tab.vc_active a,
.page-next-prev ul li a:hover,
.jt-nxt-pre-posts a,
.jt-social-share .jt-share-link i,
.jt-share-link span,
.single-post .modal-sm,
.jt-post-tags a,
.jt-comments-meta > .comments-reply a,
.sidebar .widget ul li a:hover,
.sidebar .widget ul li a:focus,
.sidebar .widget.recent-post .jt-recent-title,
.sidebar .widget.top-tags ul li,
.jt-social-counter ul li a:hover i,
.entry-content p strong,
.table th,
.btn-black,
.bg-filled:hover,
.jt-large-heading,
.jt-tabs-nav a,
.tab-each-link,
.tab-each-link.wwd-active-link.wwd-deactive-link,
.tab-each-link:hover,
.tab-each-link.wwd-active-link,
.tab-each-link.wwd-active-link.wwd-deactive-link:hover,
.tab-each-link:hover i,
.tab-each-link.wwd-active-link i,
.tab-each-link.wwd-active-link.wwd-deactive-link:hover i,
.tab-each-link.wwd-active-link.wwd-deactive-link:focus i,
.jt-call-icon-box,
.jt-btn-call-action,
.jt-team-members .owl-nav > div i:hover,
.services-style-one .services-icon,
.services-style-two:hover .services-icon,
.services-style-three:hover .services-icon,
.services-style-three .ser-learn-more,
.services-style-four .services-icon,
.services-style-five .services-icon,
.services-style-six .services-icon,
.jt-pricing-btn,
a.jt-pricing-btn:hover,
.pricing-state,
.jt-test-content a.testimonial-link:hover,
.jt-test-metas .jt-test-stars li,
.jt-test-name,
.jt-list-read-more,
.jt-list-read-more:hover,
.jt-list-read-more:focus,
.jt-list-cat a,
.jt-post-cat a,
.jt-post-list-metas i,
.read-more-blog,
.read-more-blog:hover,
.read-more-blog:focus,
.jt-counter .jt-num,
.jt-counter-three.jt-counter .jt-num,
.jt-portfolio-item .jt-port-cat a,
.jt-portfolio-item .jt-port-heading a,
.jt-portfolio-item .jt-port-heading a:hover,
.jt-portfolio-item .jt-port-heading a:focus,
.jt-portfolio-item .jt-port-cat a,
.jt-portfolio-item .jt-port-cat a:hover,
.jt-portfolio-item .jt-port-cat a:focus,
.list-item-one li i,
.jt-tab-image-wrapper .pws_tabs_container ul.pws_tabs_controll li a.pws_tab_active,
.jt-tab-image-wrapper .pws_tabs_container ul.pws_tabs_controll li a.pws_tab_active i,
.jt-tab-image-wrapper .pws_tabs_container ul.pws_tabs_controll li a:hover,
.jt-tab-image-wrapper .pws_tabs_container ul.pws_tabs_controll li a:hover i,
.jt-cnt-icon,
.skillbar-title,
.jt-year-start,
.jt-year-end,
.jt-box-header,
.wpcf7 input:focus,
.wpcf7 textarea:focus,
.social-links a:hover i,
.jt-cnt-carousel-wrapper .jt-carousel-heading,
.jt-intro-inner a,
.jt-woo-product .jt-product-cnt a:hover,
.jt-woo-product .jt-product-cnt span.price,
.woocommerce .woocommerce-result-count,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce-page .widget_price_filter .price_slider_amount .button,
.jt-social-two a:hover i,
.jt-social-three li a:hover,
.jt-social-five > li > a:hover,
.jt-social-five > li > a:active,
.jt-social-five > li > a:focus,
.menu-collapser,
ul.jt-share-one li:first-child,
.jt_agency_content .navbar-nav > ul > li > span.dropdown-toggle a,
.jt_left_content ul.slimmenu.collapsed li a,
.jt_left_content ul.slimmenu.collapsed li a:focus,
.jt_left_content ul.slimmenu.collapsed li a:active,
.jt_blog_content .jt-slim-meta .top-search-trigger,
.jt_blog_content .navbar-nav > ul > li > span.dropdown-toggle a,
.jt-box-layout-bg .jt-slim-drop > a,
.jt_photography_content.jt-photo-wrap ul.slimmenu.collapsed li a,
.jt_shop_content ul.slimmenu.collapsed li a,
.jt_left_content ul.slimmenu.collapsed li a,
.jt_right_content ul.slimmenu.collapsed li a,
.jt_left_content .hidden-side-big-screen span.jt-cross-over,
.jt_right_content .hidden-side-big-screen span.jt-cross-over,
.jt_shop_content .jt-slim-meta.navbar-default.menu-metas ul.navbar-nav li.jt-menu-search > a,
body.jt_shop_content.top-search-open #top-search form input,
body.jt_shop_content.top-search-open #top-search-slim form input,
.jt_shop_content .jt-slim-meta.jt-slim-icons ul.navbar-nav > li a i,
.jt_shop_content .jt-slim-meta.jt-slim-icons ul.navbar-nav > li a,
.jt-box-layout-bg .jt-boxed-layout .hidden-big-screen .menu-metas ul.navbar-nav li#top-search a:hover,
.jt-box-layout-bg .jt-boxed-layout .hidden-big-screen .menu-metas ul.navbar-nav li#top-search-slim a:hover,
.wv-percent,
.port-main-heading,
.jt-custom-btn,
a.jt-custom-btn:hover,
.double-line-one,
.jt_row_class .wp-pagenavi span.current,
.jt_row_class .wp-pagenavi a:hover,
.jt_row_class .wp-pagenavi a:focus,
.jt-portfolio-item .jt-business-port-cont a.jt-port-title,
.jt-business-port.vertical-hover-style-one .jt-port-heading a,
.jt-business-port.vertical-hover-style-one .jt-port-heading a:hover,
.jt-business-port.vertical-hover-style-one .jt-port-heading a:focus,
.jt-business-port.vertical-hover-style-one .jt-port-cat a,
.jt-business-port.vertical-hover-style-one .jt-port-cat a:hover,
.jt-business-port.vertical-hover-style-one .jt-port-cat a:focus,
.jt-business-port.vertical-hover-style-one .jt-port-cat a,
.jt-business-port.vertical-hover-style-two .jt-port-heading a,
.jt-business-port.vertical-hover-style-two .jt-port-heading a:hover,
.jt-business-port.vertical-hover-style-two .jt-port-heading a:focus,
.jt-business-port.vertical-hover-style-two .jt-port-cat a,
.jt-business-port.vertical-hover-style-two .jt-port-cat a:hover,
.jt-business-port.vertical-hover-style-two .jt-port-cat a:focus,
.jt-business-port.vertical-hover-style-two .jt-port-cat a,
.jt-testimonials-style-three .flnce-slide-cont .jt-test-stars > li > i,
.jt-box-test-slide .jt-test-stars > li > i,
.jt-social-one.jt-footer-social li a:hover,
.jt-link-style-one:hover, .jt-link-style-one:focus, .jt-link-style-one:active,
.jt-link-style-one,
.jt-lists .list-head,
.error-msg,
.jt-header-social li a,
.jt-header-social li a:focus,
.jt-instagram-tit a:focus,
.jt-abt-text > strong,
.jt-header-content > p,
.left-menu-list .left-menu > li,
.left-menu-list .left-menu > li > a,
.left-menu-list .left-menu > li > a,
.left-menu-list .left-menu > li > a:hover,
.left-menu-list .left-menu > li > a:focus,
.left-menu-list .left-menu > li > a.active,
.blog-cat,
.blog-content a,
.blog-content a:hover,
.blog-content a:focus,
.blog-content a:active,
.blog-content .blog-read-txt,
.blog-content a.blog-read-txt,
.blog-content a:hover.blog-read-txt,
.blog-content a:active.blog-read-txt,
.blog-content a:focus.blog-read-txt,
.jt-block-quote blockquote,
.jt-header-three .navbar-default .navbar-nav > li > a,
.jt-header-three .navbar-default .navbar-nav > li > a:hover,
.jt-header-three .navbar-default .navbar-nav > li > a:active,
.jt-header-three .navbar-default .navbar-nav > li > a:focus,
.jt-port-about-sub > p,
.jt-header-three #top-search form input,
.jt-header-three #top-search form input::-webkit-input-placeholder,
.jt-header-three #top-search form input:-moz-placeholder,
.jt-header-three #top-search form input::-moz-placeholder,
.jt-header-three #top-search form input:-ms-input-placeholder,
.jt-header-three #top-search-slim form input,
.jt-header-three #top-search-slim form input::-webkit-input-placeholder,
.jt-header-three #top-search-slim form input:-moz-placeholder,
.jt-header-three #top-search-slim form input::-moz-placeholder,
.jt-header-three #top-search-slim form input:-ms-input-placeholder,
.services-style-one:hover  .services-content > a.jt-serv-learnmore,
.jt-business-port .jt-business-port-cont a.jt-port-title,
.services-style-seven .jt-serv-content i,
.services-style-seven .jt-serv-content .jt-serv-sub  .jt-serv-learn-more,
.jt-single-meta-one .jt-port-single-tit,
.jt-single-meta-one .jt-port-single-list > li,
.jt-single-meta-one .jt-port-single-list > li > a,
.jt-single-meta-one .jt-port-single-list > li > a:hover,
.jt-single-meta-one .jt-port-single-list > li > a:active,
.jt-single-meta-one .jt-port-single-list > li > a:focus,
.jt-single-meta-two .jt-single-service-list > li,
.jt-single-meta-two .jt-single-service-list > li > a,
.jt-single-meta-two .jt-single-service-list > li > a:hover,
.jt-single-meta-two .jt-single-service-list > li > a:active,
.jt-single-meta-two .jt-single-service-list > li > a:focus,
.jt-single-port-pagination .jt-single-nav > a,
.jt-single-meta-three .jt-pjt-cat > li,
.jt-single-meta-three > .jt-pjt-cat > li > a,
.jt-single-meta-three > .jt-pjt-cat > li > a:hover,
.jt-single-meta-three > .jt-pjt-cat > li > a:active,
.jt-single-meta-three > .jt-pjt-cat > li > a:focus,
.jt-single-meta-four .jt-meta-list > li > span,
.jt-single-content .jt-single-cont-list > li > span,
.jt-single-content .jt-single-cont-list > li > a,
.jt-single-social-share  p,
.jt-single-social-share .jt-single-social-list > li > a:hover,
.jt-photo-filter .jt-photo-list-wrap .jt-filter,
.jt-photo-filter .jt-photo-list-wrap .jt-photo-filter-list > li > a,
li.jt-arch-share > a i,
.jt-header-three .navbar-default.menu-metas ul.jt-arch-share-list li > a,
.jt-social-one.jt-footer-social li a,
.jt-footer-style-seven .jt-footer-contact p,
.jt-slide-filter-list li a,
.jt-agency-header .jt-main-title,
a:active.jt-whole-menu,
.jt-agency-menu-list li a,
.jt-agency-hover-content a,
.jt-agency-social.jt-social-four li a,
.jt-footer-style-eight .jt-copyright-area p,
.jt-footer-author-details a,
.jt-agency-banner-content p,
.jt-studio-service-right.jt-tab-image-wrapper .pws_tabs_container ul.pws_tabs_controll li a,
.jt-studio-serivice-list i,
.jt-studio-serivice-list a,
.jt-studio-serv-cont a,
.jt-studio-header.jt-studio-black .navbar-default .navbar-nav > li.menu-item > a,
.jt-studio-header.jt-studio-black .navbar-default.menu-metas ul.navbar-nav li.jt-menu-search > a,
.jt-studio-header.jt-studio-black  #top-search form input,
.jt-studio-header.jt-studio-black  #top-search form input::-webkit-input-placeholder,
.jt-studio-header.jt-studio-black  #top-search form input:-moz-placeholder,
.jt-studio-header.jt-studio-black  #top-search form input::-moz-placeholder,
.jt-studio-header.jt-studio-black  #top-search form input:-ms-input-placeholder,
.jt-studio-header.jt-studio-black  #top-search-slim form input,
.jt-studio-header.jt-studio-black  #top-search-slim form input::-webkit-input-placeholder,
.jt-studio-header.jt-studio-black  #top-search-slim form input:-moz-placeholder,
.jt-studio-header.jt-studio-black  #top-search-slim form input::-moz-placeholder,
.jt-studio-header.jt-studio-black  #top-search-slim form input:-ms-input-placeholder,
.jt-studio-social a,
.jt-footer-style-ten .widget h3.widget-title,
ul.jt-social-three.jt-vint-social li a,
.jt-footer-style-ten .jt-copyright-area p,
.services-style-eight .services-content a,
.services-style-two.sevices-no-round .services-icon,
.jt-corp-count .jt-num,
.jt-corp-count .jt-coun-content,
.jt-corp-count i,
.jt-corp-pricing .pricing-state,
.jt-filter-wrapper.jt-filter-wrapper-three .jt-filter li a,
.jt-box-test-slide .jt-heart-list > li > i,
.jt-box-test-slide .jt-heading .jt-slide-tit,
.jt-corp-news-letter a,
.jt-shop-offer-cont.jt-promo-two .jt-shop-cat a,
.jt-shop-offer-cont.jt-promo-three .jt-shop-cat,
.jt-box-top-header #top-search form input,
.jt-box-top-header #top-search form input::-webkit-input-placeholder,
.jt-box-top-header #top-search form input:-moz-placeholder,
.jt-box-top-header #top-search form input::-moz-placeholder,
.jt-box-top-header #top-search form input:-ms-input-placeholder,
.jt-box-top-header #top-search-slim form input,
.jt-box-top-header #top-search-slim form input::-webkit-input-placeholder,
.jt-box-top-header #top-search-slim form input:-moz-placeholder,
.jt-box-top-header #top-search-slim form input::-moz-placeholder,
.jt-box-top-header #top-search-slim form input:-ms-input-placeholder,
.jt-shop-cart .navbar-default.menu-metas ul.navbar-nav li > a,
.jt-shop-menu-wrap .navbar-default .navbar-nav > li > a,
.navbar-nav > ul > li > span.dropdown-toggle a,
.navbar-nav > ul > li > span.dropdown-toggle a,
body.top-search-open .jt-shop-menu-wrap .navbar-default.menu-metas li.jt-menu-search > a,
body.top-search-open .jt-shop-menu-wrap .navbar-default.menu-metas li.jt-menu-search > a:hover,
body.top-search-open .jt-shop-menu-wrap .navbar-default.menu-metas li.jt-menu-search > a:active,
body.top-search-open .jt-shop-menu-wrap .navbar-default.menu-metas li.jt-menu-search > a:focus,
.jt-shop-cart .navbar-default.menu-metas ul.navbar-nav li > a i,
.jt-shop-cart .navbar-default.menu-metas ul.navbar-nav li > a i.fa-heart,
.wv-percent,
.port-main-heading,
.jt-custom-btn,
a.jt-custom-btn:hover,
.double-line-one,
.jt_row_class .wp-pagenavi span.current,
.jt_row_class .wp-pagenavi a:hover,
.jt_row_class .wp-pagenavi a:focus,
.jt-portfolio-item .jt-business-port-cont a.jt-port-title,
.jt-business-port.vertical-hover-style-one .jt-port-heading a,
.jt-business-port.vertical-hover-style-one .jt-port-heading a:hover,
.jt-business-port.vertical-hover-style-one .jt-port-heading a:focus,
.jt-business-port.vertical-hover-style-one .jt-port-cat a,
.jt-business-port.vertical-hover-style-one .jt-port-cat a:hover,
.jt-business-port.vertical-hover-style-one .jt-port-cat a:focus,
.jt-business-port.vertical-hover-style-one .jt-port-cat a,
.jt-business-port.vertical-hover-style-two .jt-port-heading a,
.jt-business-port.vertical-hover-style-two .jt-port-heading a:hover,
.jt-business-port.vertical-hover-style-two .jt-port-heading a:focus,
.jt-business-port.vertical-hover-style-two .jt-port-cat a,
.jt-business-port.vertical-hover-style-two .jt-port-cat a:hover,
.jt-business-port.vertical-hover-style-two .jt-port-cat a:focus,
.jt-business-port.vertical-hover-style-two .jt-port-cat a,
.jt-testimonials-style-three .flnce-slide-cont .jt-test-stars > li > i,
.jt-box-test-slide .jt-test-stars > li > i,
.jt-social-one.jt-footer-social li a:hover,
.jt-link-style-one:hover,
.jt-link-style-one:focus,
.jt-link-style-one:active,
.jt-link-style-one,
.jt-lists .list-head,
.type-post .jt-post-content .jt-post-excerpt h1,
.type-post .jt-post-content .jt-post-excerpt h2,
.type-post .jt-post-content .jt-post-excerpt h3,
.type-post .jt-post-content .jt-post-excerpt h4,
.type-post .jt-post-content .jt-post-excerpt h5,
.type-post .jt-post-content .jt-post-excerpt h6,
h2.author-title,
.author-desc h6,
.jt-comment-form h2,
.jt-comments h1,
.jt-comments h2,
.jt-comments h3,
.jt-comments h4,
.jt-comments h5,
.jt-comments h6,
.jt-comments-meta > h4,
.jt-tabs-main-content h2,
.services-style-six .services-content h3,
.cs-services-heading h5,
.jt-test-content h3,
.special-content h5,
.jt-intro-content h3,
.jt-follow-box h4,
.services-style-four .services-content h3,
.services-style-five .services-content h3,
.jt-studio-super-text h4,
.jt_row_class .vc_tta.vc_tta-accordion .vc_tta-panel-heading h4.vc_tta-panel-title a,
.jt-header-content > h4,
.blog-content h2,
.jt-about-title h3.widget-title,
.jt-port-about-tit > h3,
.jt-header-three .jt-banner-content > h1,
.services-style-seven .jt-serv-content h3,
.jt-fig-cont span em,
.jt-arch-title h1,
.jt-arch-title h1:after,
.jt-agency-menu h3,
.jt-agency-banner-content h1,
.jt-studio-port-cont h3,
.jt-studio-port-cont h2,
.jt-vint-title h2,
.jt-vint-team-detail h3,
.jt-vint-blog h3,
.jt-vint-blog .jt-vint-read,
.services-style-eight .services-content h3,
.jt-corp-process h3,
.jt-corp-designation h3,
.jt-boxed-service h3,
.jt-small-slide-tit h3,
.jt-studio-super-text h4,
.wc-tab-content a,
.woocommerce div.product span.price,
.woocommerce div.product p.price,
.woocommerce #content div.product span.price,
.woocommerce #content div.product p.price,
.woocommerce-page div.product span.price,
.woocommerce-page div.product p.price,
.woocommerce-page #content div.product span.price,
.woocommerce-page #content div.product p.price,
.woocommerce div.product .stock,
.woocommerce #content div.product .stock,
.woocommerce-page div.product .stock,
.woocommerce-page #content div.product .stock,
.woocommerce .img-wrap:hover a.add_to_cart_button.button,
.woocommerce .img-wrap:hover .link-like .zilla-likes:hover .zilla-likes-count,
.woocommerce-page .img-wrap:hover .link-like .zilla-likes:hover .zilla-likes-count,
.woocommerce-page .img-wrap:hover .button.product_type_simple,
.woocommerce .img-wrap:hover .link-like .zilla-likes:hover .zilla-likes-count em,
.woocommerce-page .img-wrap:hover .link-like .zilla-likes:hover .zilla-likes-count em,
.woocommerce-page .img-wrap:hover .woocommerce-page .img-wrap:hover,
.woocommerce .img-wrap:hover .link-like li a,
.woocommerce-page .img-wrap:hover .link-like li a,
.yith-wcwl-add-to-wishlist .show a:hover,
.yith-wcwl-add-to-wishlist .show a:hover:before,
.nany-product-details:hover,
.nany-product-details:hover:before,
.woocommerce .cart-collaterals .cart_totals .discount td,
.woocommerce-page .cart-collaterals .cart_totals .discount td,
.woocommerce ul.digital-downloads li a:hover,
.woocommerce-page ul.digital-downloads li a:hover,
.widget-ajax-cart a:hover,
.widget-ajax-cart i {
	color: <?php echo $primary_color ?>;
}
<!-- Primary Color - Background -->
.jt-post-content .jt-post-excerpt input[type="submit"],
.form-submit input[type="submit"],
.jt_row_class .vc_tta.vc_tta-accordion.vc_tta-style-flat .vc_tta-panel.vc_active .vc_tta-panel-heading h4.vc_tta-panel-title a,
.jt_row_class .vc_tta.vc_tta-tabs.vc_tta-style-flat .vc_tta-tab.vc_active > a,
.jt_row_class .vc_tta-tour .vc_tta-tabs.vc_tta-style-flat .vc_tta-tabs-list .vc_tta-tab.vc_active a,
.jt-comment-form input.jt-com-submit,
.jt-post-main-cnt ul.special-li li:before,
.jt-social-share .jt-share-link:hover i,
.dc-style-1,
.jt-blockquote a:before,
.btn-primary:hover,
.btn-primary:active,
.btn-primary:focus,
.bg-filled,
.jt-tabs-nav a:hover,
.jt-team-members .owl-dot,
.jt-testimonial-carousel .owl-dot,
.jt-test-carousel-two .owl-dot,
.jt-portfolio-item .jt-port-sep,
.jt-tab-image-wrapper .pws_tabs_container.pws_tabs_responsive .pws_responsive_small_menu,
.jt-tab-image-wrapper .pws_tabs_container.pws_tabs_responsive .pws_responsive_small_menu a:hover,
.jt-process-cnt li:hover .jt-cnt-icon,
.jt-skillbar,
.percentage-text:before,
.wpcf7 input[type="submit"],
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
.jt_blog_content .collapse-button .icon-bar,
.jt-box-layout-bg .collapse-button .icon-bar,
.jt-portfolio-item.grid-hover-style-three::after,
.jt-business-port.vertical-hover-style-one .jt-port-sep,
.jt-simple-slider-two .owl-dot,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one:hover,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one:active,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one:focus,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two,
.jt-filter-style-one .jt-filter li a:hover,
.jt-filter-style-one .jt-filter li a.active,
.jt-filter-style-two .jt-filter li a:hover,
.jt-filter-style-two .jt-filter li a.active,
.left-menu-list .left-menu > li.current_page_item > a:after,
.left-menu-list .left-menu > li.current-menu-parent > a:after,
.left-menu-list .left-menu > li.active > a:after,
.left-menu-list .left-menu > li > a:after,
.jt-testimonials-style-three .owl-dot,
.jt-studio-testimonials .owl-dot,
.jt-vintage-testimonials .owl-dot,
.jt-testimonial-style-six .owl-dot,
.jt-social-share-hover:hover,
.jt-social-share-hover .jt-social-list li,
.jt-business-port:after,
.jt-single-content .wpcf7-submit,
.have-js .dragslider,
.jt-filter-wrapper-two .jt-filter li a:hover,
.jt-filter-wrapper-two .jt-filter li a.active,
.jt-footer-social li a:hover:after,
.jt-slide-filter-list li a:after,
.jt-agency-menu-list li a:after,
.jt-agency-sep,
.jt-agency-banner-content p:before,
.jt-agency-banner-content p:after,
.jt-studio-serv-cont a:hover,
.jt-studio-header.jt-studio-black .navbar-default .navbar-nav > li.menu-item > a::after,
.jt-vint-sep,
.jt-vint-blog:hover a.jt-vint-read:after,
.jt-shop-offer-cont.jt-promo-two .jt-shop-branch a,
.jt-shop-top-header,
.jt-small-slide-tit h3:after,
.jt-portfolio-item.grid-hover-style-three::after,
.jt-business-port.vertical-hover-style-one .jt-port-sep,
.jt-simple-slider-two .owl-dot,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one:hover,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one:active,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one:focus,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two,
.jt-filter-style-one .jt-filter li a:hover,
.jt-filter-style-one .jt-filter li a.active,
.jt-filter-style-two .jt-filter li a:hover,
.jt-filter-style-two .jt-filter li a.active {
	background: <?php echo $primary_color; ?>;
}

.wc-edit,
.wc-edit:hover,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit,
.woocommerce #content input.button,
.woocommerce-page a.button,
.woocommerce-page button.button,
.woocommerce-page input.button,
.woocommerce-page #respond input#submit,
.woocommerce-page #content input.button,
#woo-slider .owl-controls .owl-buttons div,
.img-wrap:hover .product-inner,
.woocommerce a.add_to_cart_button.button,
.woocommerce a.product_type_variable.button,
.woocommerce a.product_type_grouped.button,
#woo-slider .owl-controls .owl-buttons div,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce #respond input#submit.alt,
.woocommerce #content input.button.alt,
.woocommerce-page a.button.alt,
.woocommerce-page button.button.alt,
.woocommerce-page input.button.alt,
.woocommerce-page #respond input#submit.alt,
.woocommerce-page #content input.button.alt,
.woocommerce .link-like .zilla-likes:hover .zilla-likes-count,
.woocommerce-page .link-like .zilla-likes:hover .zilla-likes-count,
.woocommerce .link-like .zilla-likes.active,
.woocommerce-page .link-like .zilla-likes.active,
.woocommerce .quantity .plus,
.woocommerce-page .quantity .plus,
.woocommerce .quantity .minus,
.woocommerce-page .quantity .minus,
.woocommerce .widget_layered_nav ul li.chosen a,
.woocommerce-page .widget_layered_nav ul li.chosen a,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range {
	background-color: <?php echo $primary_color; ?>;
}

<!-- Primary Color - Border All -->
.comments-area .comment-respond textarea:focus,
.jt_row_class .vc_tta-tour .vc_tta.vc_tta-style-modern.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list .vc_tta-tab.vc_active a,
.jt_row_class .vc_tta-tour .vc_tta.vc_tta-style-modern.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list .vc_tta-tab.vc_active a,
.jt-comment-form input:focus,
.jt-comment-form textarea:focus,
.jt-social-share .jt-share-link:hover i,
.author-social li a,
.sidebar .widget.top-tags ul li a:hover,
.dc-style-2,
.btn-primary:hover,
.btn-primary:active,
.btn-primary:focus,
.btn-black,
.bg-filled:hover,
.jt-tabs-nav a:hover,
.tab-each-link:hover,
.tab-each-link.wwd-active-link,
.tab-each-link.wwd-active-link.wwd-deactive-link:hover,
.jt-call-icon-box,
.jt-btn-call-action,
.jt-team-members .owl-dot.active,
a.jt-pricing-btn:hover,
.jt-testimonial-carousel .owl-dot.active,
.jt-test-carousel-two .owl-dot.active,
.jt-list-read-more,
.jt-list-cat a,
.jt-post-cat a,
.jt-process-cnt li:hover .jt-cnt-icon,
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce-page .widget_price_filter .price_slider_amount .button,
a.jt-custom-btn:hover,
.jt-simple-slider-two .owl-dot.active,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two:hover,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two:active,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two:focus,
.sidebar .widget_calendar table tfoot tr td,
.sidebar .widget_tag_cloud a:hover, .sidebar .widget_tag_cloud a:focus,
.jt-testimonials-style-three .owl-dot.active,
.jt-studio-testimonials .owl-dot.active,
.jt-vintage-testimonials .owl-dot.active,
.jt-testimonial-style-six .owl-dot.active,
.jt-social-share-hover:hover,
.services-style-one.serv-have-border .services-icon,
.services-style-one.serv-have-border:hover  .services-icon,
.jt-studio-serv-cont a,
.services-style-eight:hover .services-content a,
.jt-corp-pricing:hover,
.jt-corp-pricing :hover .jt-pricing-btn,
.jt-filter-wrapper.jt-filter-wrapper-three .jt-filter li a.active,
.jt-filter-wrapper.jt-filter-wrapper-three .jt-filter li a:hover,
.jt-box-test-slide #jt-testimonial-slide .owl-dot.active,
a.jt-custom-btn:hover,
.jt-simple-slider-two .owl-dot.active,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-one,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two:hover,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two:active,
.wpcf7 .wpcf7-form input[type="submit"].cf7-btn-two:focus,
.sidebar .widget_calendar table tfoot tr td,
.sidebar .widget_tag_cloud a:hover,
.sidebar .widget_tag_cloud a:focus,
.shop-template .product-inner,
.woocommerce .product-inner,
.woocommerce-message,
.woocommerce-info,
.woocommerce-info:before,
.woocommerce .link-like .zilla-likes.active,
.woocommerce-page .link-like .zilla-likes.active,
.woocommerce div.product form.cart div.quantity,
.woocommerce-page div.product form.cart div.quantity,
.quantity,
.woocommerce ul.digital-downloads li a:hover,
.woocommerce-page ul.digital-downloads li a:hover,
.woocommerce .widget_layered_nav ul li.chosen a,
.woocommerce-page .widget_layered_nav ul li.chosen a,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
	border-color: <?php echo $primary_color; ?>;
}
<!-- Primary Color - Border Top -->
.jt_row_class .vc_tta.vc_tta-accordion.vc_tta-style-modern .vc_tta-panel.vc_active h4.vc_tta-panel-title a,
.jt_row_class .vc_tta-tabs.vc_tta-style-flat.vc_tta-tabs-position-bottom .vc_tta-tabs-list .vc_tta-tab.vc_active,
.jt_row_class .vc_tta-tour .vc_tta-tabs.vc_tta-style-flat .vc_tta-tabs-list .vc_tta-tab.vc_active a,
.jt-blockquote a,
.sidebar .widget_calendar table thead tr th,
.sidebar .widget_calendar table thead tr th {
	border-top-color: <?php echo $primary_color; ?>;
}
<!-- Primary Color - Border Right -->
.jt_row_class .vc_tta-tour .vc_tta.vc_tta-style-modern.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list .vc_tta-tab.vc_active a:before {
	border-right-color: <?php echo $primary_color; ?>;
}
<!-- Primary Color - Border Bottom -->
.dc-style-3,
.jt-blockquote a,
.services-style-four .services-icon i,
.sidebar .widget_calendar table thead tr th,
.jt-social-share-hover .jt-social-list:before,
.sidebar .widget_calendar table thead tr th {
	border-bottom-color: <?php echo $primary_color; ?>;
}
<!-- Primary Color - Border Left -->
.jt_row_class .vc_tta-tour .vc_tta.vc_tta-style-modern.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list .vc_tta-tab.vc_active a:before {
	border-left-color: <?php echo $primary_color; ?>;
}
<?php }

/* Search And Cart Widget Color */
$search_cart_icon_type = ot_get_option('search_cart_icon_type');
if($search_cart_icon_type == 'normal') { ?>
.menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.fa.fa-search,
.menu-metas.navbar-default ul.navbar-nav li#top-search.jt-menu-search form input,
.menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-menu-search form input,
.menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.pe-7s-close,
.menu-metas.navbar-default ul.navbar-nav li.jt-search a i.fa.fa-search,
.menu-metas.navbar-default ul.navbar-nav li#top-search.jt-search form input,
.menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-search form input,
.menu-metas.navbar-default ul.navbar-nav li.jt-search a i.pe-7s-close,
.menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.jt_business_content .collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.jt_arch_content .collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.jt_studio_content nav.navbar.navbar-default .collapse.navbar-collapse .menu-metas.navbar-default .widget.widget_text ul li a.dropdown-toggle,
.menu-metas.navbar-default ul.navbar-nav li.jt-arch-share a i,
.jt-box-layout-bg .collapse.navbar-collapse .widget.widget_text ul li a.dropdown-toggle {
	color: #fff;
}
<?php } elseif($search_cart_icon_type == 'dark') { ?>
.menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.fa.fa-search,
.menu-metas.navbar-default ul.navbar-nav li#top-search.jt-menu-search form input,
.menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-menu-search form input,
.menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.pe-7s-close,
.menu-metas.navbar-default ul.navbar-nav li.jt-search a i.fa.fa-search,
.menu-metas.navbar-default ul.navbar-nav li#top-search.jt-search form input,
.menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-search form input,
.menu-metas.navbar-default ul.navbar-nav li.jt-search a i.pe-7s-close,
.menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.jt_business_content .collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.jt_arch_content .collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
.jt_studio_content nav.navbar.navbar-default .collapse.navbar-collapse .menu-metas.navbar-default .widget.widget_text ul li a.dropdown-toggle,
.menu-metas.navbar-default ul.navbar-nav li.jt-arch-share a i,
.jt-box-layout-bg .collapse.navbar-collapse .widget.widget_text ul li a.dropdown-toggle {
	color: #35373e;
}
<?php }

/* Menu Background Color Default */
$menu_position	= ot_get_option('menu_position');
$menu_bg_normal_state	= ot_get_option('menu_bg_normal_state');
if($menu_position == 'header_top_logo_left' && $menu_bg_normal_state!='') { ?>
.jt-page-header header {
	background-color: <?php echo esc_attr($menu_bg_normal_state); ?>;
}
<?php }
if($menu_position == 'header_outer_space' && $menu_bg_normal_state!='') { ?>
.jt_freelance_content .jt-freelance-head header {
	background-color: <?php echo esc_attr($menu_bg_normal_state); ?>;
}
<?php }

/* Menu Background Color - Sticky State */
$menu_position  		= ot_get_option('menu_position');
$sticky_header  		= ot_get_option('sticky_header');
$menu_bg_sticky_state	= ot_get_option('menu_bg_sticky_state');
$banner_type_mt 		= get_post_meta( get_the_ID(), 'banner_type_mt', true );
if($menu_position == 'header_top_logo_left' && $sticky_header == 'on' && $menu_bg_sticky_state!='') { ?>
.jt-page-header .is-sticky header {
	background-color: <?php echo esc_attr($menu_bg_sticky_state); ?>;
}
<?php }

$menu_bg_sticky_state_freelance	= ot_get_option('menu_bg_sticky_state_freelance');
if($menu_position == 'header_outer_space' && $sticky_header == 'on' && $menu_bg_sticky_state_freelance!='') { ?>
.jt_freelance_content .jt-freelance-head .is-sticky header {
	background-color: <?php echo esc_attr($menu_bg_sticky_state_freelance); ?>;
}
<?php }

$front_cus_enable 			= ot_get_option('front_cus_enable');
$front_page_menu_bg 		= ot_get_option('front_page_menu_bg');
$front_page_menu_shadow 	= ot_get_option('front_page_menu_shadow');
$front_page_menu_icon_type 	= ot_get_option('front_page_menu_icon_type');

if(($front_cus_enable == 'on') || is_page_template( 'template-scroll-lock.php' )) { ?>
	.is_front_page .jt-page-header header {
		background: transparent;
	}

	<?php
	if($front_page_menu_bg != '' || $front_page_menu_shadow != '') { ?>
		.is_front_page .jt-page-header .is-sticky header,
		.is_front_page.jt_main_content.have_rev_slider .jt-page-header.jt-blog-page .is-sticky header,
		.is_front_page.jt_freelance_content.have_rev_slider .jt-freelance-head .is-sticky header,
		.is_front_page.have_rev_slider .jt-page-header .is-sticky header,
		.is_front_page .jt-blog-header .is-sticky header,
		.is_front_page .jt-arch-head-content .is-sticky header,
		.is_front_page .jt-agency-header .is-sticky .jt-agency-head-bar.jt-on-slide,
		.is_front_page .jt-agency-header .is-sticky .jt-agency-head-bar,
		.is_front_page .jt-studio-banner-wrap .is-sticky header,
		.jt_studio_content.is_front_page .is-sticky header.jt-studio.jt-studio-header,
		.is_front_page .jt-boxed-layout .jt_box_header_content .is-sticky header.jt-box-top-header.sticky-nav,
		.is_front_page.have_rev_slider .jt-boxed-layout .jt_box_header_content .is-sticky header.jt-box-top-header.sticky-nav,
		.is_front_page .jt-shop-top-head-wrap .is-sticky .jt-shop-menu-wrap,
		.is_front_page.have_rev_slider .jt-shop-top-head-wrap .is-sticky .jt-shop-menu-wrap {
			background: <?php echo $front_page_menu_bg; ?>;
			<?php
			if($front_page_menu_shadow != '') {
				if( isset($front_page_menu_shadow[0]) ) {
					$inset = $inset.' ';
				} else {
					$inset = '';
				}
				if($front_page_menu_shadow['color']) {
					$color 	 	= $front_page_menu_shadow['color'];
					$color_rgb	= hex2rgb($color);
					$color_rgba	= 'rgba('.$color_rgb.', 0.1)';
				} else {
					$color_rgba = '';
				}
			?>
			-webkit-box-shadow: <?php echo $inset; ?><?php echo $front_page_menu_shadow['offset-x'].' '; ?><?php echo $front_page_menu_shadow['offset-y'].' '; ?><?php echo $front_page_menu_shadow['blur-radius'].' '; ?><?php echo $front_page_menu_shadow['spread-radius'].' '; ?><?php echo $color_rgba; ?>;
			box-shadow: <?php echo $inset; ?><?php echo $front_page_menu_shadow['offset-x'].' '; ?><?php echo $front_page_menu_shadow['offset-y'].' '; ?><?php echo $front_page_menu_shadow['blur-radius'].' '; ?><?php echo $front_page_menu_shadow['spread-radius'].' '; ?><?php echo $color_rgba; ?>;
			<?php } ?>
		}
	<?php }

	/* Front Page - Search And Cart Widget Color */
	$front_page_menu_icon_type = ot_get_option('front_page_menu_icon_type');
	if($front_page_menu_icon_type == 'normal') { ?>
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.fa.fa-search,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search.jt-menu-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-menu-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.pe-7s-close,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-search a i.fa.fa-search,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search.jt-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-search a i.pe-7s-close,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
	.is_front_page .collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
	.is_front_page nav.navbar.navbar-default .collapse.navbar-collapse .menu-metas.navbar-default .widget.widget_text ul li a.dropdown-toggle,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-arch-share a i,
	.is_front_page .collapse.navbar-collapse .widget.widget_text ul li a.dropdown-toggle,

	.page-template-template-scroll-lock .menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i {
		color: #fff;
	}
	<?php } elseif($front_page_menu_icon_type == 'dark') { ?>
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.fa.fa-search,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search.jt-menu-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-menu-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.pe-7s-close,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-search a i.fa.fa-search,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search.jt-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li#top-search-slim.jt-search form input,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-search a i.pe-7s-close,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
	.is_front_page .collapse.navbar-collapse .menu-metas.navbar-default ul.navbar-nav .widget.widget_text ul li a.dropdown-toggle,
	.is_front_page nav.navbar.navbar-default .collapse.navbar-collapse .menu-metas.navbar-default .widget.widget_text ul li a.dropdown-toggle,
	.is_front_page .menu-metas.navbar-default ul.navbar-nav li.jt-arch-share a i,
	.is_front_page .collapse.navbar-collapse .widget.widget_text ul li a.dropdown-toggle,

	.page-template-template-scroll-lock .menu-metas.navbar-default ul.navbar-nav li.jt-menu-search a i.fa.fa-search {
		color: #35373e;
	}
	<?php }

}

/* Footer Background */
$menu_position = ot_get_option('menu_position');
$footer_enable = ot_get_option('footer_enable');
$footer_bg	= ot_get_option('footer_bg');
if( $footer_enable == 'on' && $footer_bg && $menu_position !='menu_pos_top_studio' ) {
	$footer_bg_color	= $footer_bg['background-color'];
	$footer_bg_repeat	= $footer_bg['background-repeat'];
	$footer_bg_attach	= $footer_bg['background-attachment'];
	$footer_bg_pos		= $footer_bg['background-position'];
	$footer_bg_size		= $footer_bg['background-size'];
	$footer_bg_img		= $footer_bg['background-image'];
?>
footer.jt-footer-style-two,
footer > div,
footer.jt-footer-style-two > div {
	<?php if($footer_bg_img!='') { ?>
		background-image: url('<?php echo esc_attr($footer_bg_img); ?>');
	<?php }
	if($footer_bg_color!='') { ?>
		background-color: <?php echo esc_attr($footer_bg_color); ?>;
	<?php }
	if($footer_bg_repeat!='') { ?>
		background-repeat: <?php echo esc_attr($footer_bg_repeat); ?>;
	<?php }
	if($footer_bg_attach!='') { ?>
		background-repeat: <?php echo esc_attr($footer_bg_attach); ?>;
	<?php }
	if($footer_bg_pos!='') { ?>
		background-position: <?php echo esc_attr($footer_bg_pos); ?>;
	<?php }
	if($footer_bg_size!='') { ?>
		background-size: <?php echo esc_attr($footer_bg_size); ?>;
	<?php } ?>
}
<?php }
if( $footer_enable == 'on' && $footer_bg && $menu_position =='menu_pos_top_studio' ) {
	$footer_bg_color	= $footer_bg['background-color'];
	$footer_bg_repeat	= $footer_bg['background-repeat'];
	$footer_bg_attach	= $footer_bg['background-attachment'];
	$footer_bg_pos		= $footer_bg['background-position'];
	$footer_bg_size		= $footer_bg['background-size'];
	$footer_bg_img		= $footer_bg['background-image'];
?>
.jt-footer-style-nine:after {
	<?php if($footer_bg_img!='') { ?>
		background-image: url('<?php echo esc_attr($footer_bg_img); ?>');
	<?php }
	if($footer_bg_repeat!='') { ?>
		background-repeat: <?php echo esc_attr($footer_bg_repeat); ?>;
	<?php }
	if($footer_bg_attach!='') { ?>
		background-repeat: <?php echo esc_attr($footer_bg_attach); ?>;
	<?php }
	if($footer_bg_pos!='') { ?>
		background-position: <?php echo esc_attr($footer_bg_pos); ?>;
	<?php }
	if($footer_bg_size!='') { ?>
		background-size: <?php echo esc_attr($footer_bg_size); ?>;
	<?php } ?>
}
.jt-footer-style-nine {
	<?php if($footer_bg_color!='') { ?>
		background-color: <?php echo esc_attr($footer_bg_color); ?>;
	<?php } ?>
}
<?php }
/* Footer Copyright Color */
$copyright_bg_color = ot_get_option('copyright_bg_color');
if($copyright_bg_color) {
?>
footer.jt-footer-style-two .jt-copyright-area,
footer .jt-copyright-area {
	background-color: <?php echo esc_attr($copyright_bg_color); ?>;
}
<?php }

/* Footer Copyright Font Size */
$copyright_font_size = ot_get_option('copyright_font_size');
if($copyright_font_size) {
?>
footer.jt-footer-style-two .jt-copyright-area,
footer .jt-copyright-area p {
	font-size: <?php echo esc_attr($copyright_font_size); ?>;
}
<?php }

/* Footer Copyright Font Color */
$copyright_font_color = ot_get_option('copyright_font_color');
if($copyright_font_color) {
?>
footer.jt-footer-style-two .jt-copyright-area,
footer .jt-copyright-area p {
	color: <?php echo esc_attr($copyright_font_color); ?>;
}
<?php }

/* Footer Enable */
$footer_enable = ot_get_option('footer_enable');
if($footer_enable == 'off') { ?>
footer {
	padding: 0px !important;
	min-height: auto !important;
}
footer .text-widget-holder {
	padding: 0px !important;
}
<?php }

/* Menu Position - Architecture */
$menu_position = ot_get_option('menu_position');
if($menu_position == 'menu_pos_top_arch') { ?>
footer {
	min-height: auto !important;
}
<?php }

/* 404 Background Image */
$page_404_bg = ot_get_option('404_page_bg');
if($page_404_bg) {
	$page_404_color		= $page_404_bg['background-color'];
	$page_404_repeat	= $page_404_bg['background-repeat'];
	$page_404_attach	= $page_404_bg['background-attachment'];
	$page_404_pos		= $page_404_bg['background-position'];
	$page_404_size		= $page_404_bg['background-size'];
	$page_404_img		= $page_404_bg['background-image'];
?>
.error404 {
	<?php if($page_404_img!='') { ?>
		background-image: url('<?php echo esc_attr($page_404_img); ?>');
	<?php }
	if($page_404_color!='') { ?>
		background: <?php echo esc_attr($page_404_color); ?>;
	<?php }
	if($page_404_repeat!='') { ?>
		background-repeat: <?php echo esc_attr($page_404_repeat); ?>;
	<?php }
	if($page_404_attach!='') { ?>
		background-repeat: <?php echo esc_attr($page_404_attach); ?>;
	<?php }
	if($page_404_pos!='') { ?>
		background-position: <?php echo esc_attr($page_404_pos); ?>;
	<?php }
	if($page_404_size!='') { ?>
		background-size: <?php echo esc_attr($page_404_size); ?>;
	<?php } ?>
}
<?php }

/* 404 Page Content color */
$page_404_text_color = ot_get_option('404_page_text_color');
if($page_404_text_color) { ?>
.error404 .error-content p.error-info {
	color: <?php echo esc_attr($page_404_text_color); ?>;
}
<?php }

$footer_style = ot_get_option('footer_style');
if( $footer_style == 'footer_style2' ) {
?>
footer > div, footer.jt-footer-style-two > div {
	padding: 0px;
}
footer .jt-copyright-area {
	border: 0px;
}
<?php
}

$menu_position = ot_get_option('menu_position');
$footer_enable = ot_get_option('footer_enable');
$footer_top_style = ot_get_option('footer_top_style');
$footer_widget = ot_get_option('footer_widget');
if($footer_enable == 'off' || $menu_position == 'menu_pos_left_margin' || $footer_top_style == '' || $footer_widget == '') {
?>
footer > div {
	<!-- padding-top: 0px !important; -->
}
footer.jt-footer-style-two .jt-copyright-area {
	margin-top: 0;
}
<?php }

if($footer_enable == 'on' && $footer_widget!='' && $footer_top_style!='') {
?>
footer.jt-footer-style-two .jt-copyright-area {
	<!-- margin-top: 50px; -->
}
<?php }

$menu_position = ot_get_option('menu_position');
$footer_enable = ot_get_option('footer_enable');
if($menu_position == 'menu_pos_top_arch' && $footer_enable == 'on') {
?>
footer > div,
footer.jt-footer-style-two > div {
	<!-- padding-top: 70px; -->
}
<?php }

if( is_page_template( 'template-one-page-architecture.php' ) ) {
?>
.jt-arch-body .page-container {
	padding-top: 0px;
}
<?php }

/* Vintage - Left Menu */
$menu_position = ot_get_option('menu_position');
$menu_pos_left_vintage_bg = ot_get_option('menu_pos_left_vintage_bg');
if($menu_position == 'menu_pos_left_vintage' && $menu_pos_left_vintage_bg) {
	$bg_color = $menu_pos_left_vintage_bg['background-color'];
	$bg_img = $menu_pos_left_vintage_bg['background-image'];
	$bg_repeat = $menu_pos_left_vintage_bg['background-repeat'];
	$bg_attach = $menu_pos_left_vintage_bg['background-attachment'];
	$bg_pos = $menu_pos_left_vintage_bg['background-position'];
	$bg_size = $menu_pos_left_vintage_bg['background-size'];
?>
.jt-photo-wrap.jt_vintage_content .left-menu-wrap.jt-dark-bg,
.jt-photo-wrap.jt_vintage_content .dropdown-menu {
	<?php if($bg_img!='') { ?>
		background-image: url('<?php echo esc_attr($bg_img); ?>');
	<?php }
	if($bg_color!='') { ?>
		background-color: <?php echo esc_attr($bg_color); ?>;
	<?php }
	if($bg_repeat!='') { ?>
		background-repeat: <?php echo esc_attr($bg_repeat); ?>;
	<?php }
	if($bg_attach!='') { ?>
		background-repeat: <?php echo esc_attr($bg_attach); ?>;
	<?php }
	if($bg_pos!='') { ?>
		background-position: <?php echo esc_attr($bg_pos); ?>;
	<?php }
	if($bg_size!='') { ?>
		background-size: <?php echo esc_attr($bg_size); ?>;
	<?php } ?>
}
<?php }

/* Vintage - Left Menu */
$menu_position = ot_get_option('menu_position');
$menu_pos_right_vintage_bg = ot_get_option('menu_pos_right_vintage_bg');
if($menu_position == 'menu_pos_right_vintage' && $menu_pos_right_vintage_bg) {
	$bg_color = $menu_pos_right_vintage_bg['background-color'];
	$bg_img = $menu_pos_right_vintage_bg['background-image'];
	$bg_repeat = $menu_pos_right_vintage_bg['background-repeat'];
	$bg_attach = $menu_pos_right_vintage_bg['background-attachment'];
	$bg_pos = $menu_pos_right_vintage_bg['background-position'];
	$bg_size = $menu_pos_right_vintage_bg['background-size'];
?>
.jt-photo-wrap.jt_vintage_content .left-menu-wrap.jt-dark-bg,
.jt-photo-wrap.jt_vintage_content .dropdown-menu {
	<?php if($bg_img!='') { ?>
		background-image: url('<?php echo esc_attr($bg_img); ?>');
	<?php }
	if($bg_color!='') { ?>
		background-color: <?php echo esc_attr($bg_color); ?>;
	<?php }
	if($bg_repeat!='') { ?>
		background-repeat: <?php echo esc_attr($bg_repeat); ?>;
	<?php }
	if($bg_attach!='') { ?>
		background-repeat: <?php echo esc_attr($bg_attach); ?>;
	<?php }
	if($bg_pos!='') { ?>
		background-position: <?php echo esc_attr($bg_pos); ?>;
	<?php }
	if($bg_size!='') { ?>
		background-size: <?php echo esc_attr($bg_size); ?>;
	<?php } ?>
}
<?php }

/* Main Content Area Padding */
$content_padding_ot = ot_get_option('content_area_padding');
$single_port_pad = ot_get_option('single_port_pad');
$pages = get_pages();
foreach ( $pages as $page ) {
	$content_padding_mt = get_post_meta( $page->ID, 'content_area_padding_mt', true );
	if ($content_padding_mt) {
	?>
		.page-id-<?php echo $page->ID; ?> .page-container.content-ctrl {
   			padding: <?php echo esc_attr($content_padding_mt); ?>;
   		}
	<?php }
} // foreach
if($content_padding_ot) { ?>
	.page-container.content-ctrl {
		padding: <?php echo esc_attr($content_padding_ot); ?>;
	}
<?php }
if($single_port_pad) { ?>
	.single-portfolio .page-container.content-ctrl {
		padding: <?php echo esc_attr($single_port_pad); ?>;
	}
<?php }

/* Footer Content Area Padding */
$footer_content_padding = ot_get_option('footer_content_padding');
if($footer_content_padding != '') {
?>
.foot-ctrl footer .text-widget-holder {
	padding: <?php echo esc_attr($footer_content_padding); ?>;
}
<?php }

// WooCommerce Sidebar Position : Left / Right
$woo_sidebar = ot_get_option('woo_sidebar');
if($woo_sidebar == 'sidebar_left') { ?>
.woocommerce .jt_content_holder .shop-template {
	float: right;
}
<?php } else { }

$pages = get_pages();
foreach ( $pages as $page ) {
	$page_arch = get_post_meta( $page->ID, 'one_page_arch', true );
	if ($page_arch) {
		// One Page Architecture
		$one_page_arch_color	= $page_arch['background-color'];
		$one_page_arch_repeat	= $page_arch['background-repeat'];
		$one_page_arch_attach	= $page_arch['background-attachment'];
		$one_page_arch_pos		= $page_arch['background-position'];
		$one_page_arch_size		= $page_arch['background-size'];
		$one_page_arch_img		= $page_arch['background-image'];
		if($one_page_arch_img) {
			$one_page_arch_img = 'background: url('.esc_url($one_page_arch_img).');';
		} else {
			$one_page_arch_img = '';
		}
		if($one_page_arch_color) {
			$one_page_arch_color = 'background-color: '.$one_page_arch_color.';';
		} else {
			$one_page_arch_color = '';
		}
		if($one_page_arch_repeat) {
			$one_page_arch_repeat = 'background-repeat: '.$one_page_arch_repeat.';';
		} else {
			$one_page_arch_repeat = '';
		}
		if($one_page_arch_attach) {
			$one_page_arch_attach = 'background-attachment: '.$one_page_arch_attach.';';
		} else {
			$one_page_arch_attach = '';
		}
		if($one_page_arch_pos) {
			$one_page_arch_pos = 'background-position: '.$one_page_arch_pos.';';
		} else {
			$one_page_arch_pos = '';
		}
		if($one_page_arch_size) {
			$one_page_arch_size = 'background-size: '.$one_page_arch_size.';';
		} else {
			$one_page_arch_size = '';
		}
		?>
		.page-id-<?php echo $page->ID; ?> .have-js .dragslider:after {
			<?php
				echo esc_attr($one_page_arch_img);
				echo esc_attr($one_page_arch_color);
				echo esc_attr($one_page_arch_repeat);
				echo esc_attr($one_page_arch_attach);
				echo esc_attr($one_page_arch_pos);
				echo esc_attr($one_page_arch_size);
			?>
		}
		.page-id-<?php echo $page->ID; ?> .have-js .dragslider {
			<?php echo esc_attr($one_page_arch_color); ?>
		}
		<?php
	}
} // foreach

/**
 * Theme Typography
 */
/* Body & Content P */
$body_font = ot_get_option('body_font');
if( $body_font != '' ) {
	$body_font_family = $body_font['font-family'];
	$body_font_family = str_replace("+", " ", $body_font_family);
?>
.entry-content p,
.entry-content.page-container p,
.entry-content .jt-post-excerpt,
.jt-post-excerpt ul, .entry-content .jt-post-excerpt ul,
.jt-comments table th, .jt-comments table td, .entry-content dl dd, .jt-comments ul.comments li,
.entry-content table th, .entry-content table td,
.entry-content dl dt,
.entry-content dl,
.entry-content ul,
.entry-content address,
.jt-heading .sub-heading,
.entry-content .jt-heading h4.sub-heading,
.entry-content.page-container .jt-heading h4.sub-heading,
.jt-team-over .team-profession,
.jt-test-name span,
.jt-counter-three.jt-counter .jt-num,
.jt-comments-meta > .comments-meta,
.comments-area .comment-respond textarea,
form.comment-form .error,
.comments-area .comment-respond input[type="text"],
.jt-time-content,
.jt-page-banner .jt-breadcrumbs,
.jt-page-banner .jt-breadcrumbs a,
.jt-price-features li,
.jt-pricing-circle .jt-period,
.entry-content .jt-lists h1.list-head, .entry-content.page-container .jt-lists h1.list-head,
.entry-content .jt-lists h2.list-head, .entry-content.page-container .jt-lists h2.list-head,
.entry-content .jt-lists h3.list-head, .entry-content.page-container .jt-lists h3.list-head,
.entry-content .jt-lists h4.list-head, .entry-content.page-container .jt-lists h4.list-head,
.entry-content .jt-lists h5.list-head, .entry-content.page-container .jt-lists h5.list-head,
.entry-content .jt-lists h6.list-head, .entry-content.page-container .jt-lists h6.list-head,
.double-line-one,
table.table,
.jt_row_class .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-body p,
.jt_row_class .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-body ul > li,
.jt_row_class .vc_tta.vc_tta-tabs .vc_tta-panel.vc_active .vc_tta-panel-body p,
.jt_row_class .vc_tta-tabs.vc_tta-style-modern .vc_tta-panel.vc_active .vc_tta-panel-body,
.jt_row_class .vc_tta-tabs.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-body,
.jt_row_class .vc_tta-tabs.vc_tta-style-flat .vc_tta-panel.vc_active .vc_tta-panel-body,
.jt_row_class .vc_tta-tabs.vc_tta-style-outline .vc_tta-panel.vc_active .vc_tta-panel-body,
.alert,
.alert-bg,
.jt-block-quote blockquote,
div.jt-special,
.jt-heading .jt-short-title,
.jt-related-works em,
.jt-tabs-main-content,
div.wpcf7-response-output,
.jt-cnt-carousel-wrapper,
.jt-header-content > p,
.flnce-slide-cont .testi-name .testi-desg,
.slider-no-prev, .slider-no-next,
span.wpcf7-not-valid-tip,
.business-testimonials-cont .flnce-slide-cont .slide-cont,
.jt_business_content .jt-business-banner-content .jt-breadcrumbs,
.jt-arch-service ul li,
.jt-agency-hover-content .jt-agency-top,
.jt-agency-hover-content a,
.jt-studio-sub h3,
.jt-italic-heading .jt-heading .sub-heading,
.jt-vintage-banner-content p,
.woocommerce .widget_shopping_cart ul,
.single-product.woocommerce #reviews #review_form .comment-form-rating label,
.single-product.woocommerce .shop-template .entry-summary p.stock.in-stock,
.jt-single-quote > .jt-quote-msg,
.wpb_text_column p,
.format-link .jt-post-content .jt-post-title,
.format-quote .jt-post-content .jt-post-title,
.jt-footer-title,
.jt-boxed-footer-contact p,
.jt-shop-offer-cont.jt-promo-two .jt-shop-branch a,
.woocommerce-cart .cart-collaterals .cart_totals table,
.woocommerce-cart .cart-collaterals .cart_totals table tbody tr th,
.woocommerce-cart .cart-collaterals .cart_totals table tbody tr td,
.woocommerce-checkout form.woocommerce-checkout #customer_details .your-order .woocommerce-checkout-review-order .woocommerce-checkout-payment ul.payment_methods li .payment_box.payment_method_bacs p,
.woocommerce-checkout .your-order table.woocommerce-checkout-review-order-table tbody td,
.woocommerce-checkout .your-order table.woocommerce-checkout-review-order-table tfoot,
.woocommerce-checkout .your-order table.woocommerce-checkout-review-order-table tfoot th,
.woocommerce-checkout .your-order table.woocommerce-checkout-review-order-table tfoot td,
.woocommerce-checkout .woocommerce-info,
.woocommerce .widget_products ul.product_list_widget li a,
.woocommerce .widget_products ul.product_list_widget,
.top-cart-content .widget_shopping_cart.woocommerce ul.cart_list li .quantity,
.top-cart-content .widget_shopping_cart.woocommerce ul.cart_list li .quantity .amount,
.woocommerce .orderby,
.woocommerce-checkout form.woocommerce-checkout .woocommerce-billing-fields input,
.woocommerce-checkout form.woocommerce-checkout .woocommerce-billing-fields .select2-choice,
.woocommerce form .form-row input.input-text,
.woocommerce form .form-row textarea, .woocommerce-page form .form-row input.input-text, .woocommerce-page form .form-row textarea,
.woocommerce-checkout form.woocommerce-checkout .woocommerce-billing-fields input,
.woocommerce-checkout form.woocommerce-checkout .woocommerce-billing-fields .select2-choice,
.jt-blog-header header.logo-center #top-search form input,
.jt-blog-header header.logo-center #top-search-slim form input,
.woocommerce-cart .shipping-coupon .shipping_calculator .juster-shipping-calculator-form .jt-layout-column span select#calc_shipping_state,
.woocommerce-cart .shipping-coupon .shipping_calculator .juster-shipping-calculator-form p select {
	<?php
	if($body_font['font-family']) { ?>
		font-family: <?php echo $body_font_family; ?>, sans-serif;
	<?php }
	if($body_font['font-color']) { ?>
		color: <?php echo $body_font['font-color']; ?>;
	<?php }
	if($body_font['font-size']) { ?>
		font-size: <?php echo $body_font['font-size']; ?>;
	<?php }
	if($body_font['font-style']) { ?>
		font-style: <?php echo $body_font['font-style']; ?>;
	<?php }
	if($body_font['font-variant']) { ?>
		font-variant: <?php echo $body_font['font-variant']; ?>;
	<?php }
	if($body_font['font-weight']) { ?>
		font-weight: <?php echo $body_font['font-weight']; ?>;
	<?php }
	if($body_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $body_font['letter-spacing']; ?>;
	<?php }
	if($body_font['line-height']) { ?>
		line-height: <?php echo $body_font['line-height']; ?>;
	<?php }
	if($body_font['text-decoration']) { ?>
		text-decoration: <?php echo $body_font['text-decoration']; ?>;
	<?php }
	if($body_font['text-transform']) { ?>
		text-transform: <?php echo $body_font['text-transform']; ?>;
	<?php } ?>
}
::-webkit-input-placeholder {
	<?php
	if($body_font['font-family']) { ?>
		font-family: <?php echo $body_font_family; ?>, sans-serif;
	<?php }
	if($body_font['font-color']) { ?>
		color: <?php echo $body_font['font-color']; ?>;
	<?php }
	if($body_font['font-size']) { ?>
		font-size: <?php echo $body_font['font-size']; ?>;
	<?php }
	if($body_font['font-style']) { ?>
		font-style: <?php echo $body_font['font-style']; ?>;
	<?php }
	if($body_font['font-variant']) { ?>
		font-variant: <?php echo $body_font['font-variant']; ?>;
	<?php }
	if($body_font['font-weight']) { ?>
		font-weight: <?php echo $body_font['font-weight']; ?>;
	<?php }
	if($body_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $body_font['letter-spacing']; ?>;
	<?php }
	if($body_font['line-height']) { ?>
		line-height: <?php echo $body_font['line-height']; ?>;
	<?php }
	if($body_font['text-decoration']) { ?>
		text-decoration: <?php echo $body_font['text-decoration']; ?>;
	<?php }
	if($body_font['text-transform']) { ?>
		text-transform: <?php echo $body_font['text-transform']; ?>;
	<?php } ?>
}
:-moz-placeholder {
	<?php
	if($body_font['font-family']) { ?>
		font-family: <?php echo $body_font_family; ?>, sans-serif;
	<?php }
	if($body_font['font-color']) { ?>
		color: <?php echo $body_font['font-color']; ?>;
	<?php }
	if($body_font['font-size']) { ?>
		font-size: <?php echo $body_font['font-size']; ?>;
	<?php }
	if($body_font['font-style']) { ?>
		font-style: <?php echo $body_font['font-style']; ?>;
	<?php }
	if($body_font['font-variant']) { ?>
		font-variant: <?php echo $body_font['font-variant']; ?>;
	<?php }
	if($body_font['font-weight']) { ?>
		font-weight: <?php echo $body_font['font-weight']; ?>;
	<?php }
	if($body_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $body_font['letter-spacing']; ?>;
	<?php }
	if($body_font['line-height']) { ?>
		line-height: <?php echo $body_font['line-height']; ?>;
	<?php }
	if($body_font['text-decoration']) { ?>
		text-decoration: <?php echo $body_font['text-decoration']; ?>;
	<?php }
	if($body_font['text-transform']) { ?>
		text-transform: <?php echo $body_font['text-transform']; ?>;
	<?php } ?>
}
::-moz-placeholder {
	<?php
	if($body_font['font-family']) { ?>
		font-family: <?php echo $body_font_family; ?>, sans-serif;
	<?php }
	if($body_font['font-color']) { ?>
		color: <?php echo $body_font['font-color']; ?>;
	<?php }
	if($body_font['font-size']) { ?>
		font-size: <?php echo $body_font['font-size']; ?>;
	<?php }
	if($body_font['font-style']) { ?>
		font-style: <?php echo $body_font['font-style']; ?>;
	<?php }
	if($body_font['font-variant']) { ?>
		font-variant: <?php echo $body_font['font-variant']; ?>;
	<?php }
	if($body_font['font-weight']) { ?>
		font-weight: <?php echo $body_font['font-weight']; ?>;
	<?php }
	if($body_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $body_font['letter-spacing']; ?>;
	<?php }
	if($body_font['line-height']) { ?>
		line-height: <?php echo $body_font['line-height']; ?>;
	<?php }
	if($body_font['text-decoration']) { ?>
		text-decoration: <?php echo $body_font['text-decoration']; ?>;
	<?php }
	if($body_font['text-transform']) { ?>
		text-transform: <?php echo $body_font['text-transform']; ?>;
	<?php } ?>
}
:-ms-input-placeholder {
	<?php
	if($body_font['font-family']) { ?>
		font-family: <?php echo $body_font_family; ?>, sans-serif;
	<?php }
	if($body_font['font-color']) { ?>
		color: <?php echo $body_font['font-color']; ?>;
	<?php }
	if($body_font['font-size']) { ?>
		font-size: <?php echo $body_font['font-size']; ?>;
	<?php }
	if($body_font['font-style']) { ?>
		font-style: <?php echo $body_font['font-style']; ?>;
	<?php }
	if($body_font['font-variant']) { ?>
		font-variant: <?php echo $body_font['font-variant']; ?>;
	<?php }
	if($body_font['font-weight']) { ?>
		font-weight: <?php echo $body_font['font-weight']; ?>;
	<?php }
	if($body_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $body_font['letter-spacing']; ?>;
	<?php }
	if($body_font['line-height']) { ?>
		line-height: <?php echo $body_font['line-height']; ?>;
	<?php }
	if($body_font['text-decoration']) { ?>
		text-decoration: <?php echo $body_font['text-decoration']; ?>;
	<?php }
	if($body_font['text-transform']) { ?>
		text-transform: <?php echo $body_font['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Body a */
$body_font_link = ot_get_option('body_font_link');
if( $body_font_link != '' ) {
	$body_font_a = $body_font_link['font-family'];
	$body_font_a = str_replace("+", " ", $body_font_a);
?>
a,
body .entry-content a,
.jt-portfolio-item .jt-port-cat a,
.jt-post-list-metas,
.jt-share-link span,
.page-numbers a.prev,
.page-numbers a.next,
.page-numbers span,
.jt-comments-meta > .comments-reply a,
.blog-content .blog-read-txt,
.jt-business-port .jt-business-port-cont .jt-port-category a,
.jt_row_class .wp-pagenavi a,
.jt_row_class .wp-pagenavi span,
.jt-corp-port-cont .jt-corp-cat,
.jt-boxed-port .jt-corp-port-overlay .jt-corp-port-cont .jt-box-cat,
.single-product.woocommerce .product_meta span.posted_in a,
.single-product.woocommerce .product_meta span.tagged_as a {
	<?php
	if($body_font_link['font-family']) { ?>
		font-family: <?php echo $body_font_a; ?>, sans-serif;
	<?php }
	if($body_font_link['font-color']) { ?>
		color: <?php echo $body_font_link['font-color']; ?>;
	<?php }
	if($body_font_link['font-size']) { ?>
		font-size: <?php echo $body_font_link['font-size']; ?>;
	<?php }
	if($body_font_link['font-style']) { ?>
		font-style: <?php echo $body_font_link['font-style']; ?>;
	<?php }
	if($body_font_link['font-variant']) { ?>
		font-variant: <?php echo $body_font_link['font-variant']; ?>;
	<?php }
	if($body_font_link['font-weight']) { ?>
		font-weight: <?php echo $body_font_link['font-weight']; ?>;
	<?php }
	if($body_font_link['letter-spacing']) { ?>
		letter-spacing: <?php echo $body_font_link['letter-spacing']; ?>;
	<?php }
	if($body_font_link['line-height']) { ?>
		line-height: <?php echo $body_font_link['line-height']; ?>;
	<?php }
	if($body_font_link['text-decoration']) { ?>
		text-decoration: <?php echo $body_font_link['text-decoration']; ?>;
	<?php }
	if($body_font_link['text-transform']) { ?>
		text-transform: <?php echo $body_font_link['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Sidebar p */
$sidebar_p_tag = ot_get_option('sidebar_p_tag');
if( $sidebar_p_tag != '' ) {
	$sidebar_p_tag_font = $sidebar_p_tag['font-family'];
	$sidebar_p_tag_font = str_replace("+", " ", $sidebar_p_tag_font);
?>
.sidebar p,
.sidebar .widget.widget_search input,
.sidebar .widget ul li a,
.sidebar .widget_tag_cloud a,
.sidebar .widget select,
.sidebar .widget_calendar table,
.sidebar .widget ul li,
.sidebar .jt-widget-text {
	<?php
	if($sidebar_p_tag['font-family']) { ?>
		font-family: <?php echo $sidebar_p_tag_font; ?>, sans-serif;
	<?php }
	if($sidebar_p_tag['font-color']) { ?>
		color: <?php echo $sidebar_p_tag['font-color']; ?>;
	<?php }
	if($sidebar_p_tag['font-size']) { ?>
		font-size: <?php echo $sidebar_p_tag['font-size']; ?>;
	<?php }
	if($sidebar_p_tag['font-style']) { ?>
		font-style: <?php echo $sidebar_p_tag['font-style']; ?>;
	<?php }
	if($sidebar_p_tag['font-variant']) { ?>
		font-variant: <?php echo $sidebar_p_tag['font-variant']; ?>;
	<?php }
	if($sidebar_p_tag['font-weight']) { ?>
		font-weight: <?php echo $sidebar_p_tag['font-weight']; ?>;
	<?php }
	if($sidebar_p_tag['letter-spacing']) { ?>
		letter-spacing: <?php echo $sidebar_p_tag['letter-spacing']; ?>;
	<?php }
	if($sidebar_p_tag['line-height']) { ?>
		line-height: <?php echo $sidebar_p_tag['line-height']; ?>;
	<?php }
	if($sidebar_p_tag['text-decoration']) { ?>
		text-decoration: <?php echo $sidebar_p_tag['text-decoration']; ?>;
	<?php }
	if($sidebar_p_tag['text-transform']) { ?>
		text-transform: <?php echo $sidebar_p_tag['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Footer p */
$footer_p_tag = ot_get_option('footer_p_tag');
if( $footer_p_tag != '' ) {
	$footer_p_tag_font = $footer_p_tag['font-family'];
	$footer_p_tag_font = str_replace("+", " ", $footer_p_tag_font);
?>
footer p,
footer a,
footer ul li a,
.foot-ctrl footer ul li a,
footer ul li,
.jt-social-counter ul li a p,
footer .widget.widget_text .jt-social-counter ul li a p,
footer .widget select,
footer .widget_calendar table,
footer .widget.widget_text p,
footer .widget_tag_cloud a,
footer .jt-widget-text,
.widget_tweet_fader_widget p,
.jt-footer-author-details p {
	<?php
	if($footer_p_tag['font-family']) { ?>
		font-family: <?php echo $footer_p_tag_font; ?>, sans-serif;
	<?php }
	if($footer_p_tag['font-color']) { ?>
		color: <?php echo $footer_p_tag['font-color']; ?>;
	<?php }
	if($footer_p_tag['font-size']) { ?>
		font-size: <?php echo $footer_p_tag['font-size']; ?>;
	<?php }
	if($footer_p_tag['font-style']) { ?>
		font-style: <?php echo $footer_p_tag['font-style']; ?>;
	<?php }
	if($footer_p_tag['font-variant']) { ?>
		font-variant: <?php echo $footer_p_tag['font-variant']; ?>;
	<?php }
	if($footer_p_tag['font-weight']) { ?>
		font-weight: <?php echo $footer_p_tag['font-weight']; ?>;
	<?php }
	if($footer_p_tag['letter-spacing']) { ?>
		letter-spacing: <?php echo $footer_p_tag['letter-spacing']; ?>;
	<?php }
	if($footer_p_tag['line-height']) { ?>
		line-height: <?php echo $footer_p_tag['line-height']; ?>;
	<?php }
	if($footer_p_tag['text-decoration']) { ?>
		text-decoration: <?php echo $footer_p_tag['text-decoration']; ?>;
	<?php }
	if($footer_p_tag['text-transform']) { ?>
		text-transform: <?php echo $footer_p_tag['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Menu Font */
$menu_font = ot_get_option('menu_font');
if( $menu_font != '' ) {
	$menu_font_exact = $menu_font['font-family'];
	$menu_font_exact = str_replace("+", " ", $menu_font_exact);
?>
header .navbar.navbar-default ul.nav.navbar-nav a,
.navbar.navbar-default ul.nav.navbar-nav a,
.left-menu-list ul.left-menu li a,
.left-menu-list ul.nav.navbar-nav li a,
ul.slimmenu.collapsed li a,
.left-menu-list .left-menu > li,
.left-menu-list .left-menu .port-filter li a,
.left-menu-list .left-menu .sub-menu li a,
.jt-agency-menu h3 {
	<?php
	if($menu_font['font-family']) { ?>
		font-family: <?php echo $menu_font_exact; ?>, sans-serif;
	<?php }
	if($menu_font['font-size']) { ?>
		font-size: <?php echo $menu_font['font-size']; ?>;
	<?php }
	if($menu_font['font-style']) { ?>
		font-style: <?php echo $menu_font['font-style']; ?>;
	<?php }
	if($menu_font['font-variant']) { ?>
		font-variant: <?php echo $menu_font['font-variant']; ?>;
	<?php }
	if($menu_font['font-weight']) { ?>
		font-weight: <?php echo $menu_font['font-weight']; ?>;
	<?php }
	if($menu_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $menu_font['letter-spacing']; ?>;
	<?php }
	if($menu_font['line-height']) { ?>
		line-height: <?php echo $menu_font['line-height']; ?>;
	<?php }
	if($menu_font['text-decoration']) { ?>
		text-decoration: <?php echo $menu_font['text-decoration']; ?>;
	<?php }
	if($menu_font['text-transform']) { ?>
		text-transform: <?php echo $menu_font['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Content Heading Font */
$content_heading_font = ot_get_option('content_heading_font');
if( $content_heading_font != '' ) {
	$heading_font_exact = $content_heading_font['font-family'];
	$heading_font_exact = str_replace("+", " ", $heading_font_exact);
?>
h1, .entry-content h1,
.entry-content.page-container h1,
h2, .entry-content h2,
.entry-content.page-container h2,
h3, .entry-content h3,
.entry-content.page-container h3,
h4, .entry-content h4,
.entry-content.page-container h4,
h5, .entry-content h5,
.entry-content.page-container h5,
h6, .entry-content h6,
.entry-content.page-container h6,
.entry-content .flnce-awards p.award-det,
.entry-content.page-container .flnce-awards p.award-det,
.jt-tab-image-wrapper .pws_tabs_container ul.pws_tabs_controll li a,
.jt-coun-content,
.jt-counter .jt-num,
.jt-portfolio-item .jt-port-heading a,
.entry-content .jt-watch-video p,
.jt-test-name,
.jt-post-contents a.jt-post-title,
.jt-list-read-more span,
.blog-style-one .read-more-blog,
body .entry-content a.jt-btn-call-action,
.jt-page-banner h2,
body .entry-content a.btn-primary,
body .entry-content a.jt-pricing-btn,
.skillbar-title,
.jt-year-start, .jt-year-end,
.jt-box-header,
.jt-process-content .jt-cnt-heading,
.dropcaps,
.table th,
.jt_row_class .vc_tta.vc_tta-accordion .vc_tta-panel-heading h4.vc_tta-panel-title a,
.jt_row_class .vc_tta-tabs.vc_tta.vc_tta-style-modern .vc_tta-tab > a,
.wv-percent,
.pricing-state,
.jt-pricing-circle .jt-prices,
.vc_tta.vc_general .vc_tta-tab > a,
.jt_row_class .vc_tta.vc_tta-tabs.vc_tta-style-flat .vc_tta-tab > a,
.jt_row_class .vc_tta.vc_tta-tabs.vc_tta-style-flat .vc_tta-tab.vc_active > a,
.jt_row_class .vc_tta.vc_tta-style-outline .vc_tta-tab > a,
.jt-single-meta-two .jt-single-service-list > li > span,
.jt-fig-cont span em,
.jt-single-port-pagination .jt-single-nav > a,
ul.jt-share-one li:first-child,
.single-portfolio-banner-content h1,
.jt-post-read-more,
body .entry-content a.jt-post-read-more,
body .entry-content .jt-list-cat a,
body .entry-content .jt-post-cat a,
.jt-tabs-num .swiper-pagination-bullet,
.jt-filter li.back-text,
.wpcf7 input[type="submit"],
.jt-nxt-pre-posts a,
.services-style-three .ser-learn-more,
.jt-cnt-carousel-wrapper .jt-carousel-heading,
a.btn-primary,
.jt-header-content > h4,
.services-style-one .services-content > .jt-serv-learnmore,
.form-submit input[type="submit"],
.flnce-slide-cont .testi-name,
.jt_freelance_content .jt-page-banner h2,
.jt-business-port .jt-business-port-cont a.jt-port-title,
.jt_business_content .jt-bussiness-head-cont .jt-business-banner-content h1,
.error-msg,
.services-style-seven .jt-serv-content .jt-serv-sub .jt-serv-learn-more,
.jt-top-contact > li > .jt-cont-tit, .jt-top-contact > li > .jt-cont-detail,
.jt-photo-filter .jt-photo-list-wrap .jt-filter,
.jt-photo-filter .jt-photo-list-wrap .jt-photo-filter-list > li > a,
.jt-share-popup-cnt > p,
.jt-header-three .navbar-default.menu-metas ul.jt-arch-share-list li > a,
.dragslider button.test-switch,
.jt-agency-header .jt-main-title,
.jt-slide-filter-list li a,
.jt-agency-banner-content h1,
.jt-agency-banner-content p,
.footer-lang li a,
.jt_studio_content.is_front_page .jt-head-studio .jt-small-content h1,
.jt_studio_content .jt-head-studio.not-front-studio .jt-studio-banner-small .jt-small-content h1,
.jt-top-contact > li > .jt-txt-link,
.jt-corp-port-cont .jt-corp-product,
.jt-footer-style-nine .jt-address-detail p,
.jt-footer-style-nine .jt-contact p,
.jt-footer-style-nine .jt-contact a,
.jt-vintage-banner-content h1,
.services-style-two.services-style-eight .services-content a,
.jt-boxed-port .jt-corp-port-overlay .jt-corp-port-cont .jt-box-product,
.jt-free-ship span, .jt-shop-top-header .navbar-default .navbar-nav > li > a,
.jt_shop_content .jt-shop-cart li.jt-menu-cart span,
.jt-shop-cart .navbar-default.menu-metas ul.navbar-nav li > a,
.jt-shop-offer-cont.jt-promo-one .jt-offer-tit,
.jt-shop-offer-cont.jt-promo-one .jt-offer,
.jt-shop-offer-cont.jt-promo-two .jt-shop-cat a,
.jt-shop-offer-cont.jt-promo-three .jt-offer-tit,
.jt-shop-offer-cont.jt-promo-three .jt-shop-cat,
.jt-shop-offer-cont .jt-offer-perc,
.jt-cat-tab .jt-trend-filter li a,
.woocommerce a.add_to_cart_button.button, .woocommerce a.product_type_simple.button,
.woocommerce .jt-product-style-one .product-normal-style h3,
.woocommerce .jt-product-style-one .product-normal-style .jt-product-cnt span.price,
.woocommerce .jt-product-style-two .product-normal-style h3,
.woocommerce .jt-product-style-two .product-normal-style .jt-product-cnt span.price,
.woocommerce .shop-template .jt-woo-product .jt-product-cnt,
.woocommerce-cart .woocommerce .jt-woo-product .jt-product-cnt,
.woocommerce .shop-template .jt-woo-product .jt-product-cnt h2,
.woocommerce-cart .woocommerce .jt-woo-product .jt-product-cnt h3,
.single-product.woocommerce h1.product_title,
.single-product.woocommerce .price .amount,
.single-product.woocommerce form.cart button.single_add_to_cart_button,
.prd-qty-text,
.single-product.woocommerce .product_meta span.posted_in h6,
.single-product.woocommerce .product_meta span.tagged_as h6,
.single-product.woocommerce .woocommerce-tabs #tab-description h2,
.single-product.woocommerce #reviews #comments h2,
.single-product.woocommerce #reviews #review_form h3#reply-title,
.woocommerce #review_form #respond .form-submit input[type="submit"],
.woocommerce div.product .woocommerce-tabs ul.tabs li a,
.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
body .entry-content a.jt-sub-tit,
.contact-wrap,
body .entry-content a.read-more-blog,
.slideshow span em, .slides span a,
body .entry-content a.jt-custom-btn,
a.jt-custom-btn,
body .entry-content .jt-studio-social a,
.jt-studio-social a,
body .entry-content .jt-corp-news-letter a,
.jt-corp-news-letter a,
body .entry-content .jt-call-out-section p,
.jt-call-out-section p,
body .entry-content h3.jt-post-title a,
.jt-intro-inner a,
body .entry-content .jt-intro-inner a,
.jt-trend-item-desc a,
body .entry-content .jt-trend-item-desc a,
.widget-juster-recent-posts .recent-title,
body .entry-content .jt-studio-serv-cont a,
.blog-content a.blog-read-txt,
.woocommerce .product-style-1 a.added_to_cart,
.woocommerce-page .product-style-1 a.added_to_cart,
.jt-vint-blog .jt-vint-read,
.jt-box-blog .jt-box-post-meta,
.jt-filter-wrapper.jt-filter-wrapper-three .jt-filter li a,
.jt-box-blog .jt-box-post-meta a,
.woocommerce .shop-template ul.products li.product span.product-tag,
.jt-product-image span.product-tag,
.jt-trend-item-img span.product-tag,
.my-msg-cart,
.services-style-one .services-content h3 a,
.services-style-two .services-content h3 a,
.services-style-four .services-content h3 a,
.services-style-five .services-content h3 a,
.services-style-six .services-content h3 a,
.jt-vint-team-detail h3 a {
	<?php
	if($content_heading_font['font-family']) { ?>
		font-family: <?php echo $heading_font_exact; ?>, sans-serif;
	<?php }
	if($content_heading_font['font-color']) { ?>
		color: <?php echo $content_heading_font['font-color']; ?>;
	<?php }
	if($content_heading_font['font-size']) { ?>
		font-size: <?php echo $content_heading_font['font-size']; ?>;
	<?php }
	if($content_heading_font['font-style']) { ?>
		font-style: <?php echo $content_heading_font['font-style']; ?>;
	<?php }
	if($content_heading_font['font-variant']) { ?>
		font-variant: <?php echo $content_heading_font['font-variant']; ?>;
	<?php }
	if($content_heading_font['font-weight']) { ?>
		font-weight: <?php echo $content_heading_font['font-weight']; ?>;
	<?php }
	if($content_heading_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $content_heading_font['letter-spacing']; ?>;
	<?php }
	if($content_heading_font['line-height']) { ?>
		line-height: <?php echo $content_heading_font['line-height']; ?>;
	<?php }
	if($content_heading_font['text-decoration']) { ?>
		text-decoration: <?php echo $content_heading_font['text-decoration']; ?>;
	<?php }
	if($content_heading_font['text-transform']) { ?>
		text-transform: <?php echo $content_heading_font['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Sidebar Heading */
$sidebar_heading_font = ot_get_option('sidebar_heading_font');
if( $sidebar_heading_font != '' ) {
	$sidebar_heading_font_exact = $sidebar_heading_font['font-family'];
	$sidebar_heading_font_exact = str_replace("+", " ", $sidebar_heading_font_exact);
?>
.sidebar h1,
.sidebar h2,
.sidebar h3,
.sidebar h4,
.sidebar h5,
.sidebar h6,
.entry-content .sidebar h1, .entry-content.page-container .sidebar h1,
.entry-content .sidebar h2, .entry-content.page-container .sidebar h2,
.entry-content .sidebar h3, .entry-content.page-container .sidebar h3,
.entry-content .sidebar h4, .entry-content.page-container .sidebar h4,
.entry-content .sidebar h5, .entry-content.page-container .sidebar h5,
.entry-content .sidebar h6, .entry-content.page-container .sidebar h6,
.entry-content .widget h3.widget-title,
.woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce-page .widget_price_filter .price_slider_amount .button,
.woocommerce .widget_price_filter .price_slider_amount .price_label, .woocommerce-page .widget_price_filter .price_slider_amount .price_label {
	<?php
	if($sidebar_heading_font['font-family']) { ?>
		font-family: <?php echo $sidebar_heading_font_exact; ?>, sans-serif;
	<?php }
	if($sidebar_heading_font['font-color']) { ?>
		color: <?php echo $sidebar_heading_font['font-color']; ?>;
	<?php }
	if($sidebar_heading_font['font-size']) { ?>
		font-size: <?php echo $sidebar_heading_font['font-size']; ?>;
	<?php }
	if($sidebar_heading_font['font-style']) { ?>
		font-style: <?php echo $sidebar_heading_font['font-style']; ?>;
	<?php }
	if($sidebar_heading_font['font-variant']) { ?>
		font-variant: <?php echo $sidebar_heading_font['font-variant']; ?>;
	<?php }
	if($sidebar_heading_font['font-weight']) { ?>
		font-weight: <?php echo $sidebar_heading_font['font-weight']; ?>;
	<?php }
	if($sidebar_heading_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $sidebar_heading_font['letter-spacing']; ?>;
	<?php }
	if($sidebar_heading_font['line-height']) { ?>
		line-height: <?php echo $sidebar_heading_font['line-height']; ?>;
	<?php }
	if($sidebar_heading_font['text-decoration']) { ?>
		text-decoration: <?php echo $sidebar_heading_font['text-decoration']; ?>;
	<?php }
	if($sidebar_heading_font['text-transform']) { ?>
		text-transform: <?php echo $sidebar_heading_font['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Footer Heading */
$footer_heading_font = ot_get_option('footer_heading_font');
if( $footer_heading_font != '' ) {
	$footer_heading_font_exact = $footer_heading_font['font-family'];
	$footer_heading_font_exact = str_replace("+", " ", $footer_heading_font_exact);
?>
.foot-ctrl footer h1,
.foot-ctrl footer h2,
.foot-ctrl footer h3,
.foot-ctrl footer h4,
.foot-ctrl footer h5,
.foot-ctrl footer h6,
.foot-ctrl footer .widget h1,
.foot-ctrl footer .widget h2,
.foot-ctrl footer .widget h3,
.foot-ctrl footer .widget h4,
.foot-ctrl footer .widget h5,
.foot-ctrl footer .widget h6,
footer.jt-footer-style-two .jt-copyright-area,
footer.jt-footer-style-seven .jt-footer-contact, footer.jt-footer-style-seven .jt-footer-contact p, footer.jt-footer-style-seven .jt-footer-contact span,
.jt-agency-copyright p,
.jt-footer-author-details a,
.jt-footer-style-nine .jt-copyright-area p,
footer .jt-copyright-area p,
footer ul.jt-social-one li a,
footer ul.footer-lang li a,
footer .jt-social-counter ul li a {
	<?php
	if($footer_heading_font['font-family']) { ?>
		font-family: <?php echo $footer_heading_font_exact; ?>, sans-serif;
	<?php }
	if($footer_heading_font['font-color']) { ?>
		color: <?php echo $footer_heading_font['font-color']; ?>;
	<?php }
	if($footer_heading_font['font-size']) { ?>
		font-size: <?php echo $footer_heading_font['font-size']; ?>;
	<?php }
	if($footer_heading_font['font-style']) { ?>
		font-style: <?php echo $footer_heading_font['font-style']; ?>;
	<?php }
	if($footer_heading_font['font-variant']) { ?>
		font-variant: <?php echo $footer_heading_font['font-variant']; ?>;
	<?php }
	if($footer_heading_font['font-weight']) { ?>
		font-weight: <?php echo $footer_heading_font['font-weight']; ?>;
	<?php }
	if($footer_heading_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $footer_heading_font['letter-spacing']; ?>;
	<?php }
	if($footer_heading_font['line-height']) { ?>
		line-height: <?php echo $footer_heading_font['line-height']; ?>;
	<?php }
	if($footer_heading_font['text-decoration']) { ?>
		text-decoration: <?php echo $footer_heading_font['text-decoration']; ?>;
	<?php }
	if($footer_heading_font['text-transform']) { ?>
		text-transform: <?php echo $footer_heading_font['text-transform']; ?>;
	<?php } ?>
}
<?php }

/* Custom Font */
$custom_font = ot_get_option('custom_font');
if( $custom_font != '' ) {
	$custom_font_exact = $custom_font['font-family'];
	$custom_font_exact = str_replace("+", " ", $custom_font_exact);
?>
.custom-font {
	<?php
	if($custom_font['font-family']) { ?>
		font-family: <?php echo $custom_font_exact; ?>, sans-serif;
	<?php }
	if($custom_font['font-color']) { ?>
		color: <?php echo $custom_font['font-color']; ?>;
	<?php }
	if($custom_font['font-size']) { ?>
		font-size: <?php echo $custom_font['font-size']; ?>;
	<?php }
	if($custom_font['font-style']) { ?>
		font-style: <?php echo $custom_font['font-style']; ?>;
	<?php }
	if($custom_font['font-variant']) { ?>
		font-variant: <?php echo $custom_font['font-variant']; ?>;
	<?php }
	if($custom_font['font-weight']) { ?>
		font-weight: <?php echo $custom_font['font-weight']; ?>;
	<?php }
	if($custom_font['letter-spacing']) { ?>
		letter-spacing: <?php echo $custom_font['letter-spacing']; ?>;
	<?php }
	if($custom_font['line-height']) { ?>
		line-height: <?php echo $custom_font['line-height']; ?>;
	<?php }
	if($custom_font['text-decoration']) { ?>
		text-decoration: <?php echo $custom_font['text-decoration']; ?>;
	<?php }
	if($custom_font['text-transform']) { ?>
		text-transform: <?php echo $custom_font['text-transform']; ?>;
	<?php } ?>
}
<?php }

// Custom CSS
$custom_css = ot_get_option('custom_css');
echo $custom_css;
