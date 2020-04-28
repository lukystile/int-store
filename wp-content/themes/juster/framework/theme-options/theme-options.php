<?php
/**
 * Theme Options
 */

/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'juster_theme_option', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function juster_theme_option() {

  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;

  /**
   * The shortcode instruction file
   * @var text
  */
  ob_start();
  include_once FRAMEWORK . '/theme-options/shortcode-reference.php';
  $shortcode_reference_context_html = ob_get_clean();
  $shortcode_reference_context = $shortcode_reference_context_html;

  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( 'option_tree_settings', array() );

  /**
   * Custom settings array that will eventually be
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( // Custom Settings
    'sections'        => array(
      array(
        'id'          => 'ot_general',
        'title'       => __('General','juster'),
      ),
      array(
        'id'          => 'ot_color',
        'title'       =>  __('Color','juster'),
      ),
      array(
        'id'          => 'ot_typography',
        'title'       =>  __('Typography','juster'),
      ),
      array(
        'id'          => 'ot_header',
        'title'       =>  __('Header','juster'),
      ),
      array(
        'id'          => 'ot_portfolio',
        'title'       =>  __('Portfolio','juster'),
      ),
      array(
        'id'          => 'ot_blog',
        'title'       =>  __('Blog','juster'),
      ),
      array(
        'id'          => 'ot_woocommerce',
        'title'       =>  __('WooCommerce','juster'),
      ),
      array(
        'id'          => 'ot_footer',
        'title'       =>  __('Footer','juster'),
      ),
      array(
        'id'          => 'ot_404_page',
        'title'       =>  __('404 Page','juster'),
      ),
      array(
        'id'          => 'ot_custom_sidebar',
        'title'       =>  __('Custom Sidebar','juster'),
      ),
      array(
        'id'          => 'ot_code',
        'title'       =>  __('Custom CSS / JS', 'juster'),
      ),
      array(
        'id'          => 'ot_shortcode',
        'title'       =>  __('Shortcode','juster'),
      ),
      array(
        'id'          => 'ot_shortcode_reference',
        'title'       =>  __('Shortcode Reference','juster'),
      )
    ),
    'settings'        => array( // Settings

      /* OT General */
      array(
        'id'          => 'layout_tab',
        'label'       => __('Layout & Content','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'responsive_site_layout',
        'label'       => __('Responsive Layout','juster'),
        'desc'        => __('Choose Your Responsive Layout ON/OFF','juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'fullwidth_boxed',
        'label'       => __('Full Width And Extra Width','juster'),
        'desc'        => __('Choose Your Layout Structure.','juster'),
        'std'         => 'extra-width',
        'type'        => 'radio-image',
        'section'     => 'ot_general',
        'class'       => '',
        'choices'     => array(
                         array(
                           'label'  => __('Full Width','juster'),
                           'value'  => 'full-width',
                           'src'    => IMAGES . '/framework/full_width.jpg'
                         ),
                         array(
                           'label'  => __('Extra Width','juster'),
                           'value'  => 'extra-width',
                           'src'    => IMAGES . '/framework/extra_width.jpg'
                         )
                      )
      ),
      array(
       'id'           => 'content_inside_container_ot',
       'label'        => __('Testing Label', 'juster'),
       'desc'         => __('Check this, if you need to display main content as wide view.', 'juster'),
       'std'          => '',
       'type'         => 'checkbox',
       'section'      => 'ot_general',
       'class'        => 'ot-label-hide',
       'condition'    => 'fullwidth_boxed:is(extra-width)',
       'choices'      => array(
                            array(
                                'value' => 'yes',
                                'label' => __('Make Contents in Wide Layout', 'juster')
                            ),
                        ),
      ),
      array(
        'id'          => 'bg_ot',
        'label'       => __('Background Style', 'juster'),
        'desc'        => __('Choose your page background styles.', 'juster'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'content_area_padding',
        'label'       => __('Main Content Area Padding', 'juster'),
        'desc'        => __('Enter your main content area padding here. ( Eg: 20px 0px 20px 0px ). <br> Note: Padding values Eg: (Top Right Bottom Left)', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'page_comments',
        'label'       => __('Page Comments', 'juster'),
        'desc'        => __('Choose Your ON / OFF','juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'fav_icon_tab',
        'label'       => __('Fav Icons', 'juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'favicon',
        'label'       => __( 'Favicon', 'juster' ),
        'desc'        => __( 'Upload your site fav icon, size should be 16x16', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'iphone_icon',
        'label'       => __( 'Apple iPhone icon', 'juster' ),
        'desc'        => __( 'Icon for Apple iPhone (57px x 57px). This icon is used for Bookmark on Home screen.', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'iphone_retina_icon',
        'label'       => __( 'Apple iPhone retina icon', 'juster' ),
        'desc'        => __( 'Icon for Apple iPhone retina (114px x114px). This icon is used for Bookmark on Home screen.', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'ipad_icon',
        'label'       => __( 'Apple iPad icon', 'juster' ),
        'desc'        => __( 'Icon for Apple iPad (72px x 72px). This icon is used for Bookmark on Home screen.', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'ipad_retina_icon',
        'label'       => __( 'Apple iPad retina icon', 'juster' ),
        'desc'        => __( 'Icon for Apple iPad retina (144px x 144px). This icon is used for Bookmark on Home screen.', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'logos_tab',
        'label'       => __( 'Logos', 'juster' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'logo_upload',
        'label'       => __( 'Logo', 'juster' ),
        'desc'        => __( 'Click Upload button to insert the image.', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'logo_outter_space',
        'label'       => __( 'Logo Outer Space | Responsive Mode', 'juster' ),
        'desc'        => __( 'Enter your logo outer space in pixels. [Eg : 10px 12px 10px 12px] Which means, top - right - bottom - left values.', 'juster' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'retina_logo_upload',
        'label'       => __( 'Retina Logo Upload', 'juster' ),
        'desc'        => __( 'Retina logo should be 2x the size of default logo keeping the aspect ratio!', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'retina_logo_width',
        'label'       => __( 'Retina Logo Width', 'juster' ),
        'desc'        => __( 'Enter retina logo width in px.', 'juster' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'retina_logo_height',
        'label'       => __( 'Retina Logo Height', 'juster' ),
        'desc'        => __( 'Enter retina logo height in px.', 'juster' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'login_logo',
        'label'       => __( 'WP Admin Login Logo', 'juster' ),
        'desc'        => __('Upload a custom logo for Wordpress login page','juster'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'front_cus_enable',
        'label'       => __( 'Front Page Customization', 'juster' ),
        'desc'        => __( 'ON this, if need front page seperate logo, retina logo, menu color, sub menu color and sub menu background color.', 'juster' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'front_logo_upload',
        'label'       => __( 'Front Page | Logo', 'juster' ),
        'desc'        => __( 'Click Upload button to insert the logo for front page.', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)'
      ),
      array(
        'id'          => 'front_retina_logo_upload',
        'label'       => __( 'Front Page | Retina Logo Upload', 'juster' ),
        'desc'        => __( 'Retina logo should be 2x the size of default logo keeping the aspect ratio for front page!', 'juster' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_general',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)'
      ),
      array(
        'id'          => 'seo_tab',
        'label'       => __('SEO','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'custom_desc_metas',
        'label'       => __( 'Need Same Description and Keywords in all pages?', 'juster' ),
        'desc'        => __( 'If you want same description and keywords in all pages turn it ON. If you\'ve separate plugin like Yoast, then turn this off.', 'juster' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'meta_keywords',
        'label'       => __( 'Site Keywords', 'juster' ),
        'desc'        =>__( 'This will improve your site listing in search results. Each one sholud different with comma. Eg : wordpress, themes', 'juster' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'ot_general',
        'class'       => '',
        'rows'        => '6',
        'condition'   => 'custom_desc_metas:is(on)'
      ),
      array(
        'id'          => 'meta_descriptions',
        'label'       => __( 'Site Description', 'juster' ),
        'desc'        => __( 'This will improve your site listing in search results', 'juster' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'ot_general',
        'class'       => '',
        'rows'        => '6',
        'condition'   => 'custom_desc_metas:is(on)'
      ),
      array(
        'id'          => 'advanced_tab',
        'label'       => __('Advanced','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'enable_vc_frontend',
        'label'       => __( 'Enable Front End Editor?', 'juster' ),
        'desc'        => __( 'If you want to enable front end editor, please turn this ON.', 'juster' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_general',
        'class'       => '',
      ),
      array(
        'id'          => 'hide_custom_post_type',
        'label'       => __('Custom Post Type | Hide', 'juster'),
        'desc'        => __('Check this custom post types, if you don\'t want to show.', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_general',
        'choices'     => array(
                         array(
                           'label'  => __('Portfolio', 'juster' ),
                           'value'  => 'portfolio_hide'
                         ),
                         array(
                           'label'  => __('Testimonial', 'juster' ),
                           'value'  => 'testimonial_hide'
                         ),
                         array(
                           'label'  => __('Team', 'juster' ),
                           'value'  => 'team_hide'
                         )
                      )
      ),
      array(
        'id'          => 'g_analytics',
        'label'       => __( 'Analytics', 'juster' ),
        'desc'        => __( 'Add analytics coed here.', 'juster' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'ot_general',
        'class'       => '',
        'rows'        => '6',
      ),
      array(
        'id'          => 'primary_color',
        'label'       => __( 'Theme Primary Color', 'juster' ),
        'desc'        => __( 'Select theme primary color', 'juster' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_color',
        'class'       => '',
      ),
      array(
        'id'          => 'menu_color',
        'label'       => __( 'Menu Color', 'juster' ),
        'desc'        => __( 'Select menu font color', 'juster' ),
        'std'         => '',
        'type'        => 'link-color',
        'section'     => 'ot_color',
        'class'       => '',
      ),
      array(
        'id'          => 'sub_menu_color',
        'label'       => __( 'Sub Menu Color', 'juster' ),
        'desc'        => __( 'Select sub menu font color', 'juster' ),
        'std'         => '',
        'type'        => 'link-color',
        'section'     => 'ot_color',
        'class'       => '',
      ),
      array(
        'id'          => 'sub_menu_bg_color',
        'label'       => __( 'Sub Menu Background Color', 'juster' ),
        'desc'        => __( 'Select sub menu background color', 'juster' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_color',
        'class'       => '',
      ),
      array(
        'id'          => 'front_menu_color',
        'label'       => __( 'Front Page | Menu Color', 'juster' ),
        'desc'        => __( 'Select menu font color for front page.', 'juster' ),
        'std'         => '',
        'type'        => 'link-color',
        'section'     => 'ot_color',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)'
      ),
      array(
        'id'          => 'front_sub_menu_color',
        'label'       => __( 'Front Page | Sub Menu Color', 'juster' ),
        'desc'        => __( 'Select sub menu font color for front page', 'juster' ),
        'std'         => '',
        'type'        => 'link-color',
        'section'     => 'ot_color',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)'
      ),
      array(
        'id'          => 'front_sub_menu_bg_color',
        'label'       => __( 'Front Page | Sub Menu Background Color', 'juster' ),
        'desc'        => __( 'Select sub menu background color for front page', 'juster' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_color',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)'
      ),
      array(
        'id'          => 'color_info',
        'label'       => __( 'Testing Label', 'juster' ),
        'desc'        => __( 'Other heading colors are in Typography.', 'juster' ),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_color',
        'class'       => 'ot-label-hide',
      ),
      array(
        'id'          => 'body_font_tab',
        'label'       => __( 'General', 'juster' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'        => 'body_font',
        'label'     => __( 'Body & Content p', 'juster' ),
        'desc'      => __('Select properties for body font and content p tags.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'        => 'body_font_link',
        'label'     => __( 'Body a', 'juster' ),
        'desc'      => __('Select properties for body a tags.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'        => 'sidebar_p_tag',
        'label'     => __( 'Sidebar p | Sidebar Content', 'juster' ),
        'desc'      => __('Select properties for sidebar p tag/contents.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'        => 'footer_p_tag',
        'label'     => __( 'Footer p | Footer Content', 'juster' ),
        'desc'      => __('Select properties for footer p tag/contents.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'menu_font_tab',
        'label'       => __( 'Menu Font', 'juster' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'menu_font',
        'label'       => __( ' Menu Font Styles', 'juster' ),
        'desc'        => __('Select properties for menu font.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'heading_font_tab',
        'label'       => __( 'Heading Font', 'juster' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'content_heading_font',
        'label'       => __( 'Content Headings', 'juster' ),
        'desc'        => __('Select properties for content heading font.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'sidebar_heading_font',
        'label'       => __( 'Sidebar Headings', 'juster' ),
        'desc'        => __('Select properties for sidebar heading font.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'footer_heading_font',
        'label'       => __( 'Footer Headings', 'juster' ),
        'desc'        => __('Select properties for footer heading font.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'custom_font_tab',
        'label'       => __( 'Custom Font', 'juster' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'custom_font',
        'label'       => __( ' Custom Font Styles', 'juster' ),
        'desc'        => __('Select properties for custom font. Use ".custom-font" <br /> If you need apart from other font settings, you can select these properties. Then, use this by mentioning <b>custom-font</b> class. To that element class field.', 'juster'),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'ot_typography',
        'class'       => '',
      ),
      array(
        'id'          => 'menu_tab',
        'label'       => __( 'Menu', 'juster' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_header',
        'class'       => '',
      ),
      array(
        'id'          => 'menu_position',
        'label'       => __( 'Menu Bar Position', 'juster' ),
        'desc'        => __( 'Select Menu Bar Position.', 'juster' ),
        'std'         => 'header_top_logo_left',
        'type'        => 'radio-image',
        'section'     => 'ot_header',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => 'header_top_logo_left',
                          'label'       => __('Main Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-one.jpg'
                        ),
                        array(
                          'value'       => 'header_logo_with_banner',
                          'label'       => __('Blog Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-two.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_left',
                          'label'       => __('Portfolio Left Menu', 'juster'),
                          'src'         => IMAGES . '/framework/header-three.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_right',
                          'label'       => __('Portfolio Right Menu', 'juster'),
                          'src'         => IMAGES . '/framework/header-four.jpg'
                        ),
                        array(
                          'value'       => 'header_outer_space',
                          'label'       => __('Freelancer Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-five.jpg'
                        ),
                        array(
                          'value'       => 'header_with_topbar',
                          'label'       => __('Business Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-six.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_left_margin',
                          'label'       => __('Photography Left Menu', 'juster'),
                          'src'         => IMAGES . '/framework/header-seven.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_right_margin',
                          'label'       => __('Photography Right Menu', 'juster'),
                          'src'         => IMAGES . '/framework/header-seven-one.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_top_arch',
                          'label'       => __('Architecture Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-eight.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_top_agency',
                          'label'       => __('Agency Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-nine.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_top_studio',
                          'label'       => __('Studio Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-ten.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_left_vintage',
                          'label'       => __('Vintage Left Menu', 'juster'),
                          'src'         => IMAGES . '/framework/header-eleven.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_right_vintage',
                          'label'       => __('Vintage Right Menu', 'juster'),
                          'src'         => IMAGES . '/framework/header-twelve.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_top_boxed',
                          'label'       => __('Boxed Layout Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-thirteen.jpg'
                        ),
                        array(
                          'value'       => 'menu_pos_top_shop',
                          'label'       => __('Shop Header', 'juster'),
                          'src'         => IMAGES . '/framework/header-fourteen.jpg'
                        )
                      )
      ),
      array(
        'id'          => 'menu_pos_top_shop_wid',
        'label'       => '',
        'desc'        => __('Widgets added for - Shop Header. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Shop Header | Left Widget</b> and <b>Shop Header | Right Widget</b>', 'juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_top_shop)',
      ),
      array(
        'id'          => 'menu_pos_top_arch_wid',
        'label'       => '',
        'desc'        => __('Widgets added for - Architecture Header. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Header | Top Widget</b> and <b>Footer | Left Widget</b> and <b>Footer | Right Widget</b>', 'juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_top_arch)',
      ),
      array(
        'id'          => 'menu_pos_left_wid',
        'label'       => '',
        'desc'       => __('Widgets added for - Portfolio Left Menu. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Portfolio Left Menu | Widget</b>','juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_left)',
      ),
      array(
        'id'          => 'menu_pos_right_wid',
        'label'       => '',
        'desc'       => __('Widgets added for - Portfolio Right Menu. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Portfolio Right Menu | Widget</b>','juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_right)',
      ),
      array(
        'id'          => 'header_logo_with_banner_wid',
        'label'       => '',
        'desc'       => __('Widgets added for - Blog Header. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Blog Header | Social Widget</b>','juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(header_logo_with_banner)',
      ),
      array(
        'id'          => 'header_with_topbar_wid',
        'label'       => '',
        'desc'       => __('Widgets added for - Business Header. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Business Header Top | Left Widget</b> and <b>Business Header Top | Right Widget</b>','juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(header_with_topbar)',
      ),
      array(
        'id'          => 'menu_pos_left_margin_wid',
        'label'       => '',
        'desc'       => __('Widgets added for - Photography Header Left Menu. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Photography Header | Left Menu</b>','juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_left_margin)',
      ),
      array(
        'id'          => 'menu_pos_right_margin_wid',
        'label'       => '',
        'desc'       => __('Widgets added for - Photography Header Right Menu. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Photography Header | Right Menu </b>','juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_right_margin)',
      ),
      array(
        'id'          => 'menu_pos_left_vintage_wid',
        'label'       => '',
        'desc'        => __('Widgets added for - Vintage Header Left Menu. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Vintage Left Menu | Widget</b>', 'juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_left_vintage)',
      ),
      array(
        'id'          => 'menu_pos_right_vintage_wid',
        'label'       => '',
        'desc'        => __('Widgets added for - Vintage Header Right Menu. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Vintage Right Menu | Widget</b>', 'juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_right_vintage)',
      ),
      array(
        'id'          => 'menu_pos_top_boxed_wid',
        'label'       => '',
        'desc'        => __('Widgets added for - Boxed Layout Header. Please check <b>Appearance</b> > <b>Widgets</b> > <b>Boxed Layout Header | Widget</b>', 'juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_top_boxed)',
      ),
      array(
        'id'          => 'menu_bg_normal_state',
        'label'       => __('Menu Top Background Color','juster'),
        'desc'        => __('Choose menu top background color','juster'),
        'std'         => '',
        'type'        => 'colorpicker-opacity',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(header_top_logo_left),menu_position:is(header_outer_space)',
      ),
      array(
        'id'          => 'sticky_header',
        'label'       => __('Sticky Header','juster'),
        'desc'        => __('Choose Your Sticky Header ON/OFF','juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(header_top_logo_left),menu_position:is(header_logo_with_banner),menu_position:is(header_outer_space),menu_position:is(header_with_topbar),menu_position:is(menu_pos_top_arch),menu_position:is(menu_pos_top_agency),menu_position:is(menu_pos_top_studio),menu_position:is(menu_pos_top_boxed),menu_position:is(menu_pos_top_shop)',
      ),
      array(
        'id'          => 'menu_bg_sticky_state',
        'label'       => __('Menu Top Background Color | Sticky State','juster'),
        'desc'        => __('Choose menu background color in sticky state','juster'),
        'std'         => '',
        'type'        => 'colorpicker-opacity',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'and',
        'condition'   => 'sticky_header:is(on),menu_position:is(header_top_logo_left)',
      ),
      array(
        'id'          => 'menu_bg_sticky_state_freelance',
        'label'       => __('Menu Top Background Color | Sticky State','juster'),
        'desc'        => __('Choose menu background color in sticky state','juster'),
        'std'         => '',
        'type'        => 'colorpicker-opacity',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'and',
        'condition'   => 'sticky_header:is(on),menu_position:is(header_outer_space)',
      ),
      array(
        'id'          => 'menu_left_bg',
        'label'       => __('Background | Left Menu','juster'),
        'desc'        => __('Choose your left menu background','juster'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_left),menu_position:is(menu_pos_left_margin)',
      ),
      array(
        'id'          => 'menu_right_bg',
        'label'       => __('Menu Right Background','juster'),
        'desc'        => __('Choose right menu background','juster'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_right),menu_position:is(menu_pos_right_margin)',
      ),
      array(
        'id'          => 'menu_pos_left_vintage_bg',
        'label'       => __('Background | Left Menu','juster'),
        'desc'        => __('Choose your left menu background','juster'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_left_vintage)',
      ),
      array(
        'id'          => 'menu_pos_right_vintage_bg',
        'label'       => __('Background | Right Menu','juster'),
        'desc'        => __('Choose your right menu background','juster'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_right_vintage)',
      ),
      array(
        'id'          => 'lang_enable',
        'label'       => __('Language Widget','juster'),
        'desc'        => __('ON if need language widget in header','juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_left),menu_position:not(menu_pos_right),menu_position:not(menu_pos_left_margin),menu_position:not(menu_pos_right_margin),menu_position:not(menu_pos_left_vintage),menu_position:not(menu_pos_right_vintage)',
      ),
      array(
        'id'          => 'search_enable',
        'label'       => __('Search Icon','juster'),
        'desc'        => __('ON if need search icon in header','juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_left),menu_position:not(menu_pos_right),menu_position:not(menu_pos_left_margin),menu_position:not(menu_pos_right_margin),menu_position:not(menu_pos_left_vintage),menu_position:not(menu_pos_right_vintage)',
      ),
      array(
        'id'          => 'cart_enable',
        'label'       => __('Cart Widget','juster'),
        'desc'        => __('ON if need cart widget widget in header','juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_left),menu_position:not(menu_pos_right),menu_position:not(menu_pos_left_margin),menu_position:not(menu_pos_right_margin),menu_position:not(menu_pos_left_vintage),menu_position:not(menu_pos_right_vintage),menu_position:not(menu_pos_top_studio),menu_position:not(menu_pos_top_arch)',
      ),
      array(
        'id'          => 'search_cart_icon_type',
        'label'       => __( 'Select Icon Type', 'juster' ),
        'desc'        => __( 'Select icon type for search and cart icon.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'search_enable:is(on),cart_enable:is(on)',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'normal',
                          'label'       => __('Light', 'juster')
                        ),
                        array(
                          'value'       => 'dark',
                          'label'       => __('Dark', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'front_page_menu_bg',
        'label'       => __( 'Front Page | Menu Background Color', 'juster' ),
        'desc'        => __( 'Pick color for front page menu background color.', 'juster' ),
        'std'         => '',
        'type'        => 'colorpicker-opacity',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)',
      ),
      array(
        'id'          => 'front_page_menu_shadow',
        'label'       => __( 'Front Page | Menu Shadow', 'juster' ),
        'desc'        => __( 'Enter shadow for menu background.', 'juster' ),
        'std'         => '',
        'type'        => 'box-shadow',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)',
      ),
      array(
        'id'          => 'front_page_menu_icon_type',
        'label'       => __( 'Front Page | Cart Icon Type', 'juster' ),
        'desc'        => __( 'Select front page search and cart icon type color.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'front_cus_enable:is(on)',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'normal',
                          'label'       => __('Light', 'juster')
                        ),
                        array(
                          'value'       => 'dark',
                          'label'       => __('Dark', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'wishlist_enable',
        'label'       => __('Wishlist Link','juster'),
        'desc'        => __('ON if need wishlist link in header','juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_top_shop)',
      ),
      array(
        'id'          => 'wishlist_enable_text',
        'label'       => __('Wishlist Text','juster'),
        'desc'        => __('Choose wishlist text in header','juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_top_shop),wishlist_enable:is(on)',
      ),
      array(
        'id'          => 'banner_tab',
        'label'       => __( 'Banner', 'juster' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_header',
        'class'       => '',
      ),
      array(
        'id'          => 'banner_type',
        'label'       => __( 'Banner Type', 'juster' ),
        'desc'        => __( 'Select Banner Type. (Note : If you select your header as Blog Header, Then Image Banner Type Only Works)', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_header',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => 'jt_hide_ban',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'img_ban',
                          'label'       => __('Image', 'juster')
                        ),
                        array(
                          'value'       => 'spc_ban',
                          'label'       => __('Special Banner', 'juster')
                        ),
                        array(
                          'value'       => 'vid_ban',
                          'label'       => __('Video', 'juster')
                        ),
                        array(
                          'value'       => 'sld_ban',
                          'label'       => __('Revolution Slider', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'banner_color_ot',
        'label'       => __( 'Banner Color', 'juster' ),
        'desc'        => __( 'Pick your banner color here.', 'juster' ),
        'std'         => '',
        'type'        => 'colorpicker-opacity',
        'section'     => 'ot_header',
        'class'       => '',
      ),
      array(
        'id'          => 'banner_image_ot',
        'label'       => __( 'Banner Type | Image', 'juster' ),
        'desc'        => __( 'Add your page banner image here.', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'banner_type:is(img_ban)',
        'settings'    =>  array(
                             array(
                               'id' => 'ban_img_ot',
                               'label' => __('Image', 'juster'),
                               'type'  => 'upload',
                               'desc'  => __('Upload your banner image here.<br>NOTE: Recommended image size is 1600x900', 'juster'),
                             ),
                          )
      ),
      array(
        'id'          => 'banner_type_spl',
        'label'       => __( 'Banner Type | Special Banner', 'juster' ),
        'desc'        => __( 'Select special banner type. Note: Special banner os recommended for extra width layout only.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'banner_type:is(spc_ban)',
        'choices'     => array(
                        array(
                          'value'       => 'spc_ban_type_one',
                          'label'       => __('Special Banner Type 1', 'juster')
                        ),
                        array(
                          'value'       => 'spc_ban_type_two',
                          'label'       => __('Special Banner Type 2', 'juster')
                        ),
                        array(
                          'value'       => 'spc_ban_type_three',
                          'label'       => __('Special Banner Type 3', 'juster')
                        ),
                        array(
                          'value'       => 'spc_ban_type_four',
                          'label'       => __('Special Banner Type 4', 'juster')
                        ),
                      )
      ),
      array(
        'id'          => 'special_banner_image',
        'label'       => __( 'Banner Type | Special Banner | Image', 'juster' ),
        'desc'        => __( 'Add your special banner image.', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'banner_type:is(spc_ban)',
        'settings'    =>  array(
                             array(
                               'id' => 'spc_ban_img',
                               'label' => __('Image', 'juster'),
                               'type'  => 'upload',
                               'desc'  => __('Upload your special banner image here.<br>NOTE: Recommended image size is 1600x900', 'juster'),
                             ),
                             array(
                               'id' => 'spc_ban_img_anim',
                               'label' => __('Animation Effect', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your animation effect here. Choose your animation: <a href="http://daneden.github.io/animate.css/" target="_blank">Animation</a>.', 'juster'),
                             )
                          )
      ),
      array(
        'id'          => 'video_banner',
        'label'       => __( 'Banner Type | Video', 'juster' ),
        'desc'        => __( 'Enter your YouTube Video URL here.', 'juster' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'banner_type:is(vid_ban)',
      ),
      array(
        'id'           => 'vid_ban_adv_opt',
        'label'        => __('Video Advanced Options', 'juster'),
        'desc'         => __('If need advanced options, please ON here. Otherwise OFF.', 'juster'),
        'std'          => 'off',
        'type'         => 'on-off',
        'section'      => 'ot_header',
        'class'        => '',
        'condition'    => 'banner_type:is(vid_ban)',
      ),
      array(
        'id'            => 'vid_ban_control',
        'label'         => __('Video Control', 'juster'),
        'desc'          => __('If need controls of this video, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => '',
        'section'       => 'ot_header',
        'operator'      => 'and',
        'condition'     => 'banner_type:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_auto_play',
        'label'         => __('Video Auto-play', 'juster'),
        'desc'          => __('If need auto-play of this video, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => '',
        'section'       => 'ot_header',
        'operator'      => 'and',
        'condition'     => 'banner_type:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_vid_loop',
        'label'         => __('Video Loop', 'juster'),
        'desc'          => __('If need to play video as loop mode, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => '',
        'section'       => 'ot_header',
        'operator'      => 'and',
        'condition'     => 'banner_type:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_aud_mute',
        'label'         => __('Video | Audio', 'juster'),
        'desc'          => __('If need to play video as mute mode, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => '',
        'section'       => 'ot_header',
        'operator'      => 'and',
        'condition'     => 'banner_type:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_start_time',
        'label'         => __('Video Start Time', 'juster'),
        'desc'          => __('You can change video start time here. In Seconds [Eg : 60]', 'juster'),
        'std'           => '',
        'type'          => 'text',
        'class'         => '',
        'section'       => 'ot_header',
        'operator'      => 'and',
        'condition'     => 'banner_type:is(vid_ban),vid_ban_adv_opt:is(on)',
      ),
      array(
        'id'            => 'vid_ban_vid_qty',
        'label'         => __('Video Quality', 'juster'),
        'desc'          => __('Enter video quality. Values are : hd720, large, medium, small', 'juster'),
        'std'           => '',
        'type'          => 'text',
        'class'         => '',
        'section'       => 'ot_header',
        'operator'      => 'and',
        'condition'     => 'banner_type:is(vid_ban),vid_ban_adv_opt:is(on)',
      ),
      array(
        'id'          => 'slider_banner',
        'label'       => __( 'Banner Type | Revolution Slider', 'juster' ),
        'desc'        => __( 'Enter revolution slider shortcode here.', 'juster' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'ot_header',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'banner_type:is(sld_ban)',
        'rows'        => 4,
      ),
      array(
        'id'          => 'page_title',
        'label'       => __( 'Page Title', 'juster' ),
        'desc'        => __( 'ON, if need page title on banner', 'juster' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(header_logo_with_banner),banner_type:not(sld_ban)',
      ),
      array(
        'id'          => 'breadcrumbs',
        'label'       => __( 'Breadcrumbs', 'juster' ),
        'desc'        => __( 'ON, if need breadcrumbs on banner', 'juster' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(header_logo_with_banner),menu_position:not(menu_pos_left),menu_position:not(menu_pos_right),menu_position:not(menu_pos_right_margin),menu_position:not(menu_pos_left_margin),menu_position:not(menu_pos_top_arch),menu_position:not(menu_pos_top_agency),menu_position:not(menu_pos_top_studio),menu_position:not(menu_pos_left_vintage),menu_position:not(menu_pos_right_vintage),menu_position:not(menu_pos_top_boxed),banner_type:not(sld_ban)',
      ),
      array(
        'id'          => 'breadcrumbs_link_color',
        'label'       => __('Breadcrumbs Color', 'juster'),
        'desc'        => __('Pick breadcrumbs page name link color.', 'juster'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'breadcrumbs:is(on),menu_position:not(header_logo_with_banner),menu_position:not(menu_pos_left),menu_position:not(menu_pos_right),menu_position:not(menu_pos_right_margin),menu_position:not(menu_pos_left_margin),menu_position:not(menu_pos_top_arch),menu_position:not(menu_pos_top_agency),menu_position:not(menu_pos_top_studio),menu_position:not(menu_pos_left_vintage),menu_position:not(menu_pos_right_vintage),menu_position:not(menu_pos_top_boxed),banner_type:not(sld_ban)',
      ),
      array(
        'id'          => 'banner_heading_color',
        'label'       => __('Page Heading Color', 'juster'),
        'desc'        => __('Pick page heading color.', 'juster'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(header_logo_with_banner)',
      ),
      array(
        'id'          => 'banner_sub_heading_color',
        'label'       => __('Page Sub-Heading Color', 'juster'),
        'desc'        => __('Pick page sub-heading color.', 'juster'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(header_logo_with_banner)',
      ),
      array(
        'id'          => 'banner_marker',
        'label'       => __( 'Banner Marker', 'juster' ),
        'desc'        => __( 'Select banner marker type', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   => 'menu_position:not(header_logo_with_banner),menu_position:not(menu_pos_left),menu_position:not(menu_pos_right),menu_position:not(menu_pos_top_agency)',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'animation_marker',
                          'label'       => __('Animation Marker', 'juster')
                        ),
                        array(
                          'value'       => 'simple_marker',
                          'label'       => __('Simple Marker', 'juster')
                        ),
                        array(
                          'value'       => 'custom_marker',
                          'label'       => __('Custom Marker', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'banner_marker_custom',
        'label'       => __('Custom Marker | Upload Marker', 'juster'),
        'desc'        => __('Upload your custom marker image here', 'juster'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_header',
        'class'       => '',
        'condition'   =>'banner_marker:is(custom_marker)'
      ),
      array(
        'id'          => 'port_general_tab',
        'label'       => __('General','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),      array(
        'id'          => 'portfolio_name',
        'label'       => __( 'Portfolio Name', 'juster' ),
        'desc'        => __( 'Enter your portfolio name here. Eg : Portfolio Item', 'juster' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'portfolio_slug',
        'label'       => __( 'Portfolio Slug', 'juster' ),
        'desc'        => __('Its based on portfolio name small case with hiphens for a space. Eg : portfolio-item', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'which_page_is_portfolio',
        'label'       => __('Which Page is Portfolio? | Need Portfolio Filter in Left Menu?','juster'),
        'desc'        => __('If you select that exact portfolio page, then this menu will perform like a category filter in that page. Other pages will perform like a  portfolio menu link to selected page without any filter function.','juster'),
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_left),menu_position:is(menu_pos_right)',
      ),
      array(
        'id'          => 'portfolio_to_left_menu_margin',
        'label'       => __( 'Add Portfolio and Category Filter | Leftside Menu', 'juster' ),
        'desc'        => __( 'Add portfolio name and category filter into menu. Its only based on leftside menu.', 'juster' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'operator'    => 'or',
        'condition'   => 'menu_position:is(menu_pos_left_margin)',
      ),
      array(
        'id'          => 'portfolio_style',
        'label'       => __( 'Portfolio View Style', 'juster' ),
        'desc'        => __( 'Select portfolio view style', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'portfolio_column',
                          'label'       => __('Columns', 'juster')
                        ),
                        array(
                          'value'       => 'portfolio_masonry',
                          'label'       => __('Masonry', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'portfolio_col_type',
        'label'       => __( 'Portfolio Column Type', 'juster' ),
        'desc'        => __( 'Select portfolio columns type', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'portfolio_column_two',
                          'label'       => __('Two Columns', 'juster')
                        ),
                        array(
                          'value'       => 'portfolio_column_three',
                          'label'       => __('Three Columns', 'juster')
                        ),
                        array(
                          'value'       => 'portfolio_column_four',
                          'label'       => __('Four Columns', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'portfolio_limit',
        'label'       => __('Portfolio Limit','juster'),
        'desc'        => __('Enter portfolios items limit per page. ','juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'portfolio_cate_filter',
        'label'       => __('Enable Category Filter', 'juster'),
        'desc'        => __('If need category filter option, check this', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'choices'     => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'          => 'portfolio_cate_filter_back_text',
        'label'       => __('Enable Category Filter Back Text', 'juster'),
        'desc'        => __('If need category filter back text option, check this', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'choices'     => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'          => 'portfolio_pagination_enable',
        'label'       => __('Enable Pagination', 'juster'),
        'desc'        => __('If need pagination option, please ON this', 'juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'port_list_tab',
        'label'       => __('Listing','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'portfolio_order',
        'label'       => __('Portfolio Order', 'juster'),
        'desc'        => __('Select portfolio order', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'asc',
                          'label'       => __('Ascending', 'juster')
                        ),
                        array(
                          'value'       => 'desc',
                          'label'       => __('Decending', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'portfolio_orderby',
        'label'       => __('Portfolio Orderby', 'juster'),
        'desc'        => __('Select portfolio orderby', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'none',
                          'label'       => __('None', 'juster')
                        ),
                        array(
                          'value'       => 'id',
                          'label'       => __('ID', 'juster')
                        ),
                        array(
                          'value'       => 'author',
                          'label'       => __('Author', 'juster')
                        ),
                        array(
                          'value'       => 'title',
                          'label'       => __('Title', 'juster')
                        ),
                        array(
                          'value'       => 'name',
                          'label'       => __('Name', 'juster')
                        ),
                        array(
                          'value'       => 'type',
                          'label'       => __('Type', 'juster')
                        ),
                        array(
                          'value'       => 'date',
                          'label'       => __('Date', 'juster')
                        ),
                        array(
                          'value'       => 'modified',
                          'label'       => __('Modified', 'juster')
                        ),
                        array(
                          'value'       => 'rand',
                          'label'       => __('Random', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'portfolio_offset',
        'label'       => __('Offset', 'juster'),
        'desc'        => __('Enter a number to offset portfolio items', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'single_port_tab',
        'label'       => __('Single Portfolio','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'portfolio_loading_link',
        'label'       => __('Portfolio Center Block Link | Single Portfolio', 'juster'),
        'desc'        => __('Enter your portoflio pagination link', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'condition'   => 'portfolio_pagination_enable:is(on)',
      ),
      array(
        'id'          => 'single_port_pad',
        'label'       => __('Padding | Single Portfolio Page', 'juster'),
        'desc'        => __('Enter single portfolio page main content padding here. Eg: 10px 0px 10px 0px [NOTE: Padding values denotes - Top Right Bottom Left ]', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_portfolio',
        'class'       => '',
        'condition'   => 'portfolio_pagination_enable:is(on)',
      ),
      array(
        'id'          => 'single_port_featured_img',
        'label'       => __('Featured Image | Single Portfolio Page', 'juster'),
        'desc'        => __('If need to display featured image in single portfolio page, please ON here.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_portfolio',
        'class'       => '',
      ),
      array(
        'id'          => 'blog_tab',
        'label'       => __('General','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'blog_style_ot',
        'label'       => __( 'Blog Listing Style', 'juster' ),
        'desc'        => __( 'Select blog listing style here.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __( '--Select--', 'juster' )
                        ),
                        array(
                          'value'       => 'blog_style_ot_1',
                          'label'       => __( 'List Style', 'juster' )
                        ),
                        array(
                          'value'       => 'blog_style_ot_2',
                          'label'       => __( 'Image Style', 'juster' )
                        ),
                        array(
                          'value'       => 'blog_style_ot_3',
                          'label'       => __( 'Grid Style', 'juster' )
                        ),
                        array(
                          'value'       => 'blog_style_ot_4',
                          'label'       => __( 'Default Style', 'juster' )
                        ),
                        array(
                          'value'       => 'blog_style_ot_5',
                          'label'       => __( 'Masonry Style', 'juster' )
                        ),
                        array(
                          'value'       => 'blog_style_ot_6',
                          'label'       => __( 'Grid Content', 'juster' )
                        ),
                        array(
                          'value'       => 'blog_style_ot_7',
                          'label'       => __( 'Grid Content + Metas', 'juster' )
                        ),
                      )
      ),
      array(
        'id'          => 'blog_style_ot_4_style',
        'label'       => __( 'Blog Columns', 'juster' ),
        'desc'        => __( 'Select blog columns here.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'condition'   => 'blog_style_ot:is(blog_style_ot_4)',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __( '--Select--', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-blog-col-1',
                          'label'       => __( 'One Column', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-blog-col-2',
                          'label'       => __( 'Two Columns', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-blog-col-3',
                          'label'       => __( 'Three Columns', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-blog-col-4',
                          'label'       => __( 'Four Columns', 'juster' )
                        ),
                      )
      ),
      array(
        'id'          => 'blog_style_ot_5_style',
        'label'       => __( 'Blog Column Type', 'juster' ),
        'desc'        => __( 'Select blog columns here.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'condition'   => 'blog_style_ot:is(blog_style_ot_5)',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __( '--Select--', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-blog-column-two',
                          'label'       => __( 'Two Columns', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-blog-column-three',
                          'label'       => __( 'Three Columns', 'juster' )
                        ),
                      )
      ),
      array(
        'id'          => 'blog_style_ot_6_style',
        'label'       => __( 'Blog Column Type', 'juster' ),
        'desc'        => __( 'Select blog columns here.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'condition'   => 'blog_style_ot:is(blog_style_ot_6)',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __( '--Select--', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-vint-blog-column-two',
                          'label'       => __( 'Two Columns', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-vint-blog-column-three',
                          'label'       => __( 'Three Columns', 'juster' )
                        ),
                        array(
                          'value'       => 'jt-vint-blog-column-four',
                          'label'       => __( 'Four Columns', 'juster' )
                        ),
                      )
      ),
      array(
        'id'          => 'blog_sidebar',
        'label'       => __( 'Sidebar Position', 'juster' ),
        'desc'        => __( 'Select sidebar position for your blog page.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'right',
                          'label'       => __('Right', 'juster')
                        ),
                        array(
                          'value'       => 'left',
                          'label'       => __('Left', 'juster')
                        ),
                        array(
                          'value'       => 'hide',
                          'label'       => __('Hide', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'exclude_categories',
        'label'       => __( 'Exclude Categories', 'juster' ),
        'desc'        => __('Select categories you want to exclude from blog page.', 'juster'),
        'std'         => '',
        'type'        => 'category-checkbox',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'blog_excerpt_length',
        'label'       => __('Excerpt Length', 'juster'),
        'desc'        => __('Blog short content length, in blog listing pages.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'hide_meta',
        'label'       => __('Meta\'s to hide', 'juster'),
        'desc'        => __('Check items you want to hide from blog/post meta field.', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_blog',
        'class'       => 'checkbox-inline',
        'choices'     => array(
                         array(
                           'label'  => __('Author', 'juster' ),
                           'value'  => 'yes'
                         ),
                         array(
                           'label'  => __('Date', 'juster' ),
                           'value'  => 'yes'
                         ),
                         array(
                           'label'  => __('Category', 'juster' ),
                           'value'  => 'yes'
                         ),
                         array(
                           'label'  => __('Comments', 'juster' ),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'          => 'blog_order',
        'label'       => __('Blog Posts Order', 'juster'),
        'desc'        => __('Select blog posts order', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'asc',
                          'label'       => __('Ascending', 'juster')
                        ),
                        array(
                          'value'       => 'desc',
                          'label'       => __('Decending', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'blog_orderby',
        'label'       => __('Blog Posts Orderby', 'juster'),
        'desc'        => __('Select blog posts orderby', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => 'none',
                          'label'       => __('None', 'juster')
                        ),
                        array(
                          'value'       => 'id',
                          'label'       => __('ID', 'juster')
                        ),
                        array(
                          'value'       => 'author',
                          'label'       => __('Author', 'juster')
                        ),
                        array(
                          'value'       => 'title',
                          'label'       => __('Title', 'juster')
                        ),
                        array(
                          'value'       => 'name',
                          'label'       => __('Name', 'juster')
                        ),
                        array(
                          'value'       => 'type',
                          'label'       => __('Type', 'juster')
                        ),
                        array(
                          'value'       => 'date',
                          'label'       => __('Date', 'juster')
                        ),
                        array(
                          'value'       => 'modified',
                          'label'       => __('Modified', 'juster')
                        ),
                        array(
                          'value'       => 'rand',
                          'label'       => __('Random', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'blog_offset',
        'label'       => __('Blog Posts Offset', 'juster'),
        'desc'        => __('Enter offset for blog posts', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'blog_pagination_type',
        'label'       => __( 'Pagination Type', 'juster' ),
        'desc'        => __( 'Select blog pagination for your blog page.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => 'numbers',
                          'label'       => __( 'Numbers', 'juster' )
                        ),
                        array(
                          'value'       => 'next_prev',
                          'label'       => __( 'Next / Prev', 'juster' )
                        )
                      )
      ),
      array(
        'id'          => 'blog_single_tab',
        'label'       => __('Single','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'author_info',
        'label'       => __('Author Info?', 'juster'),
        'desc'        => __('If need author info on single blog page please ON, otherwise please OFF', 'juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'blog_share_option',
        'label'       => __('Share Option?', 'juster'),
        'desc'        => __('If need share option on single blog page please ON, otherwise please OFF', 'juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'single_blog_next_prev',
        'label'       => __('Single Blog | Next / Prev', 'juster'),
        'desc'        => __('If need single blog page Next/Prev navigation please check this.', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_blog',
        'class'       => '',
        'choices'     => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                        )
      ),
      array(
        'id'          => 'blog_sidebar_single',
        'label'       => __( 'Sidebar Position', 'juster' ),
        'desc'        => __( 'Select sidebar position for your single blog page.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_blog',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'right',
                          'label'       => __('Right', 'juster')
                        ),
                        array(
                          'value'       => 'left',
                          'label'       => __('Left', 'juster')
                        ),
                        array(
                          'value'       => 'hide',
                          'label'       => __('Hide', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'single_blog_widget',
        'label'       => __('Single Blog Widget', 'juster'),
        'desc'        => __('Select widget to show in single blog page.', 'juster'),
        'std'         => '',
        'type'        => 'sidebar-select',
        'section'     => 'ot_blog',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_general_tab',
        'label'       => __('General','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_product_design',
        'label'       => __('Product Design', 'juster'),
        'desc'        => __('Select product list hover design', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_woocommerce',
        'class'       => '',
        'condition'   => '',
        'choices'     => array(
                  array(
                    'value'       => '',
                    'label'       => __('Select Style', 'juster')
                  ),
                  array(
                    'value'       => 'product_style_one',
                    'label'       => __('Style One', 'juster')
                  ),
                  array(
                    'value'       => 'product_style_two',
                    'label'       => __('Style Two', 'juster')
                  ),
                )
      ),
      array(
        'id'          => 'woo_sidebar',
        'label'       => __('Sidebar', 'juster'),
        'desc'        => __('Select sidebar view', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_woocommerce',
        'class'       => '',
        'condition'   => '',
        'choices'     => array(
                  array(
                    'value'       => '',
                    'label'       => __('Select Style', 'juster')
                  ),
                  array(
                    'value'       => 'sidebar_left',
                    'label'       => __('Left', 'juster')
                  ),
                  array(
                    'value'       => 'sidebar_right',
                    'label'       => __('Right', 'juster')
                  ),
                )
      ),
      array(
        'id'          => 'woo_products_limit',
        'label'       => __('Shop Page Product Limit', 'juster'),
        'desc'        => __('Enter numeric value for products limit in shop page.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_cart_text',
        'label'       => __('Add to Cart | Text', 'juster'),
        'desc'        => __('Enter your custom text for add to cart button.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_get_quote',
        'label'       => __('Get a Quote | Text', 'juster'),
        'desc'        => __('Enter your custom text for get a quote button.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_cart_org_text',
        'label'       => __('Cart | Text', 'juster'),
        'desc'        => __('Enter your custom text for cart.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_checkout_text',
        'label'       => __('Checkout | Text', 'juster'),
        'desc'        => __('Enter your custom text for checkout.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_in_woo_page',
        'label'       => __('You\'re in WooCommerce Page | Text', 'juster'),
        'desc'        => __('Enter your custom text.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_single_tab',
        'label'       => __('Single Product','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_woocommerce',
        'class'       => '',
      ),
      array(
        'id'          => 'woo_share_option',
        'label'       => __('Share Option', 'juster'),
        'desc'        => __('If need share options in single product page, please check this', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_woocommerce',
        'class'       => '',
        'choices'     => array(
                         array(
                           'label'  => __('Yes, Please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'          => 'woo_also_like_product',
        'label'       => __('You May Also Like', 'juster'),
        'desc'        => __('If need \'You May Also Like\' products in single product page, please check this', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_woocommerce',
        'class'       => '',
        'choices'     => array(
                         array(
                           'label'  => __('Yes, Please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'          => 'woo_related_product',
        'label'       => __('Related Products', 'juster'),
        'desc'        => __('If need related products in single product page, please check this', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_woocommerce',
        'class'       => '',
        'choices'     => array(
                         array(
                           'label'  => __('Yes, Please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'          => 'footer_general_tab',
        'label'       => __('General','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_footer',
        'class'       => '',
      ),
      array(
        'id'          => 'footer_enable',
        'label'       => __('Enable Footer', 'juster'),
        'desc'        => __('Enable footer. ON/OFF', 'juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_footer',
        'class'       => '',
        'condition'   => '',
      ),
      array(
        'id'          => 'fixed_footer',
        'label'       => __('Enable Fixed Footer', 'juster'),
        'desc'        => __('If need fixed footer, check this', 'juster'),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'ot_footer',
        'class'       => '',
        'operator'    => 'and',
        'condition'   => 'footer_enable:is(on)',
        'choices'     => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'          => 'footer_bg',
        'label'       => __('Background', 'juster'),
        'desc'        => __('Choose footer background options', 'juster'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'ot_footer',
        'class'       => '',
        'operator'    => 'and',
        'condition'   => 'footer_enable:is(on)',
      ),
      array(
        'id'          => 'footer_top_style',
        'label'       => __('Footer Top Styles', 'juster'),
        'desc'        => __('Design your footer top styles', 'juster'),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'ot_footer',
        'class'       => '',
        'rows'		    => '6',
        'operator'    => 'and',
        'condition'   => 'footer_enable:is(on)',
      ),
      array(
        'id'          => 'footer_widget',
        'label'       => __('Footer Widgets', 'juster'),
        'desc'        => __('Choose footer widgets ON/OFF', 'juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_footer',
        'class'       => '',
        'operator'    => 'and',
        'condition'   => 'footer_enable:is(on)',
      ),
      array(
        'id'          => 'footer_widget_cols',
        'label'       => __('Footer Widgets Columns','juster'),
        'desc'        => __('Choose footer widgets columns.<br>After select footer widget columns, please add widgets in <b>Appearance > Widgets > Footer</b>','juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_footer',
        'class'       => '',
        'operator'    => 'and',
        'condition'   => 'footer_enable:is(on),footer_widget:is(on)',
        'choices'     => array(
                  array(
                    'value'       => '',
                    'label'       => __('Select Columns', 'juster')
                  ),
                  array(
                    'value'       => 'footer_widget_one',
                    'label'       => __('One Column', 'juster')
                  ),
                  array(
                    'value'       => 'footer_widget_two',
                    'label'       => __('Two Columns', 'juster')
                  ),
                  array(
                    'value'       => 'footer_widget_three',
                    'label'       => __('Three Columns', 'juster')
                  ),
                  array(
                    'value'       => 'footer_widget_four',
                    'label'       => __('Four Columns', 'juster')
                  )
                )
      ),
      array(
        'id'          => 'footer_widget_extra_class',
        'label'       => __('Footer Widgets | Extra Class', 'juster'),
        'desc'        => __('Enter footer widgets extra class name here.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_footer',
        'class'       => '',
      ),
      array(
        'id'          => 'footer_extra_class',
        'label'       => __('Footer | Extra Class', 'juster'),
        'desc'        => __('Enter footer extra class name here. Use this class, if need footer widget title style and content align center.', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_footer',
        'class'       => '',
      ),
      array(
        'id'          => 'footer_content_padding',
        'label'       => __('Footer Padding', 'juster'),
        'desc'        => __('Enter your footer content padding here. ( Eg: 50px 0px 50px 0px ). <br>Note: Padding values Eg: (Top Right Bottom Left)', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_footer',
        'class'       => '',
      ),
      array(
        'id'          => 'footer_copyright_tab',
        'label'       => __('Copyright','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_footer',
        'class'       => '',
      ),
      array(
        'id'          => 'menu_pos_top_arch_none',
        'label'       => '',
        'desc'        => __('No more options for Menu Position - Top Menu Architecture Design', 'juster'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'ot_footer',
        'class'       => '',
        'condition'   => 'menu_position:is(menu_pos_top_arch)',
      ),
      array(
        'id'          => 'copyright_text',
        'label'       => __('Copyright Text', 'juster'),
        'desc'        => __('Enter your copyright text here.', 'juster'),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'ot_footer',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_top_arch)',
        'rows'        => 6,
      ),
      array(
        'id'          => 'copyright_bg_color',
        'label'       => __('Copyright Background Color', 'juster'),
        'desc'        => __('Pick footer copyright background color', 'juster'),
        'std'         => '',
        'type'        => 'colorpicker-opacity',
        'section'     => 'ot_footer',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_left_margin),menu_position:not(menu_pos_top_arch)',
      ),
      array(
        'id'          => 'copyright_font_size',
        'label'       => __('Copyright Font Size', 'juster'),
        'desc'        => __('Enter your copyright font size here. Eg: 14px', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_footer',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_top_arch)',
      ),
      array(
        'id'          => 'copyright_font_color',
        'label'       => __('Copyright Font Color', 'juster'),
        'desc'        => __('Pick footer copyright font color', 'juster'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_footer',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_top_arch)',
      ),
      array(
        'id'          => 'footer_copyright_type',
        'label'       => __('Copyright Style', 'juster'),
        'desc'        => __('Choose footer copyright style', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_footer',
        'class'       => '',
        'condition'   => 'menu_position:not(menu_pos_left_margin),menu_position:not(menu_pos_top_arch)',
        'choices'     => array(
                  array(
                    'value'       => '',
                    'label'       => __('Select', 'juster')
                  ),
                  array(
                    'value'       => 'footer_copy_one',
                    'label'       => __('Text Center', 'juster')
                  ),
                  array(
                    'value'       => 'footer_copy_two',
                    'label'       => __('Text Right With Widget Left', 'juster')
                  ),
                  array(
                    'value'       => 'footer_copy_three',
                    'label'       => __('Text Left With Widget Right', 'juster')
                  )
                )
      ),
      array(
        'id'          => '404_page_heading',
        'label'       => __( '404 Page Heading', 'juster' ),
        'desc'        => __('Enter 404 page heading', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_404_page',
        'class'       => '',
      ),
      array(
        'id'          => '404_page_content',
        'label'       => __( '404 Page Content', 'juster' ),
        'desc'        => __('Enter 404 page content', 'juster'),
        'std'         => '',
        'type'        => 'textarea_simple',
        'section'     => 'ot_404_page',
        'class'       => '',
        'rows'		  => '6',
      ),
      array(
        'id'          => '404_page_image',
        'label'       => __('404 Image', 'juster'),
        'desc'        => __('Choose 404 image', 'juster'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'ot_404_page',
        'class'       => '',
      ),
      array(
        'id'          => '404_page_search_box',
        'label'       => __('Need Search Box', 'juster'),
        'desc'        => __('If need search box in 404 page, please ON', 'juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_404_page',
        'class'       => '',
      ),
      array(
        'id'          => '404_page_bg',
        'label'       => __('404 Page Background', 'juster'),
        'desc'        => __('Choose 404 page background styles', 'juster'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'ot_404_page',
        'class'       => '',
      ),
      array(
        'id'          => '404_page_text_color',
        'label'       => __('404 Text Color', 'juster'),
        'desc'        => __('Pick 404 page text color here', 'juster'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'ot_404_page',
        'class'       => '',
      ),
      array(
        'id'          => 'custom_sidebars',
        'label'       => __( 'Custom Sidebar', 'juster' ),
        'desc'        => __('Enter your custom sidebar details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_custom_sidebar',
        'class'       => '',
        'settings'    =>  array(
                             array(
                               'id' => 'custom_description',
                               'label' => __('Description', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter custom description.', 'juster'),
                             ),
                            array(
                                'id'          => 'need_sep_widget',
                                'label'       => __('Need Separator?','juster'),
                                'desc'        => __('If you need title separator in this sidebar widgets, set to On.','juster'),
                                'std'         => 'off',
                                'type'        => 'on-off',
                            ),
                        ),
      ),
      array(
        'id'          => 'custom_css',
        'label'       => __( 'Custom CSS', 'juster' ),
        'desc'        => __( 'Enter custom css to overwrite our theme code.', 'juster' ),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'ot_code',
        'class'       => '',
      ),
      array(
        'id'          => 'custom_js',
        'label'       => __( 'Custom JS', 'juster' ),
        'desc'        => __( 'Enter custom jQuery.', 'juster' ),
        'std'         => '',
        'type'        => 'javascript',
        'section'     => 'ot_code',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_tab',
        'label'       => __('Gmap','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
	  array(
	    'id'          => 'mapsetone',
	    'label'       => __( 'Map Set One', 'juster' ),
	    'desc'        => __('Enter your map set one details, <b>More than one Map pins should be nearest place of other pins. Otherwise map will not show properly.</b>', 'juster' ),
	    'std'         => '',
	    'type'        => 'list-item',
	    'section'     => 'ot_shortcode',
	    'class'       => '',
	    'settings'    =>  array(
	                        array(
	                           'id' => 'latitude',
	                           'label'  => __('Latitude', 'juster'),
	                           'type'  => 'text',
	                           'desc'  => __('Enter your address latitude. Find your place latitude on : <a href="http://latlong.net" target="_blank">latlong.net</a>', 'juster'),
	                         ),
	                        array(
	                           'id' => 'longitude',
	                           'label'  => __('Longitude', 'juster'),
	                           'type'  => 'text',
	                           'desc'  => __('Enter your address longitude. Find your place longitude on : <a href="http://latlong.net" target="_blank">latlong.net</a>', 'juster'),
	                         ),
	                        array(
	                            'id'          => 'popup_content',
	                            'label'       => __( 'Popup Content', 'juster' ),
	                            'desc'        => __( 'Enter popup content.', 'juster' ),
	                            'type'        => 'textarea',
	                       ),
	                      array(
	                            'id'          => 'map_marker',
	                            'label'       => __('Upload Map Marker', 'juster'),
	                            'desc'        => __('Upload map marker icon for this address. Recommented size:58x58.', 'juster'),
	                            'type'        => 'upload',
	                          ),
	                      )
      ),
      array(
        'id'          => 'gmap_scroll_wheel',
        'label'       => __('Scroll Wheel Option', 'juster'),
        'desc'        => __('If you need Scroll Wheel option on Gmap mouseover, Please On.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_pan_control',
        'label'       => __('Pan Control Option', 'juster'),
        'desc'        => __('If you need Pan Control option on Gmap, Please On.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_zoom_control',
        'label'       => __('Zoom Control Option', 'juster'),
        'desc'        => __('If you need Zoom Control option on Gmap, Please On.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_maptype_control',
        'label'       => __('Map Type Control Option', 'juster'),
        'desc'        => __('If you need Map Type Control option on Gmap, Please On.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_scale_control',
        'label'       => __('Scale Control Option', 'juster'),
        'desc'        => __('If you need Scale Control option on Gmap, Please On.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_street_control',
        'label'       => __('Street View Control Option', 'juster'),
        'desc'        => __('If you need Street View Control option on Gmap, Please On.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_overview_map_control',
        'label'       => __('Overview Map Control Option', 'juster'),
        'desc'        => __('If you need Overview Map Control option on Gmap, Please On.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_plusminus_control',
        'label'       => __('Plus/Minus Zoom Control Option', 'juster'),
        'desc'        => __('If you need Plus/Minus Zoom Control option on Gmap, Please On.', 'juster'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_zoom_value',
        'label'       => __('Map Zoom Value', 'juster'),
        'desc'        => __('Enter Your Zooming Value Here. Eg: 13 ( This value show your place as default zoom in/out value in google map. )', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'gmap_type',
        'label'       => __('Gmap Type', 'juster'),
        'desc'        => __('Choose your Gmap type to show.', 'juster'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'ot_shortcode',
        'class'       => '',
        'choices'     => array(
                  array(
                    'value'       => 'roadmap',
                    'label'       => __('Road Map', 'juster')
                  ),
                  array(
                    'value'       => 'satellite',
                    'label'       => __('Satellite', 'juster')
                  ),
                  array(
                    'value'       => 'hybrid',
                    'label'       => __('Hybrid', 'juster')
                  ),
                  array(
                    'value'       => 'terrain',
                    'label'       => __('Terrain', 'juster')
                  )
                )
      ),
      array(
        'id'          => 'client_details',
        'label'       => __('Client Slider','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'client_slider',
        'label'       => __( 'Client Slider', 'juster' ),
        'desc'        => __('Enter your custom sidebar details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_shortcode',
        'class'       => '',
        'settings'    =>  array(
                             array(
                               'id' => 'client_link',
                               'label' => __('Client Link', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your client link.', 'juster'),
                             ),
                             array(
                               'id' => 'client_image',
                               'label' => __('Client Image', 'juster'),
                               'type'  => 'upload',
                               'desc'  => __('Upload your clients image.', 'juster'),
                             ),
                            array(
                              'id'         => 'client_img_top_value',
                              'label'      => __('Top Align Value', 'juster'),
                              'type'       => 'text',
                              'desc'       => __('Values are in px [Eg : 30px].', 'juster'),
                             )
                          )
      ),
      array(
        'id'          => 'timeline_details',
        'label'       => __('TimeLine','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'timeline_style',
        'label'       => __( 'TimeLine', 'juster' ),
        'desc'        => __('Enter your timeline details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_shortcode',
        'class'       => '',
        'settings'    =>  array(
                             array(
                               'id' => 'timeline_date',
                               'label' => __('Date', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter timeline date .', 'juster'),
                             ),
                             array(
                               'id' => 'timeline_content',
                               'label' => __('Content', 'juster'),
                               'type'  => 'textarea',
                               'desc'  => __('Enter your content.', 'juster'),
                             )
                          )
      ),

      array(
        'id'          => 'carousal_juster',
        'label'       => __('Carousal','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'carousal_slider',
        'label'       => __( 'Carousal Slider', 'juster' ),
        'desc'        => __('Enter your carousal slider details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_shortcode',
        'class'       => '',
        'settings'    =>  array(
                             array(
                               'id' => 'special_text',
                               'label' => __('Special Text', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter special text .', 'juster'),
                             ),
                             array(
                               'id' => 'carousal_heading',
                               'label' => __('Carousal Heading', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter carousal heading .', 'juster'),
                             ),
                             array(
                               'id' => 'carousal_content',
                               'label' => __('Content', 'juster'),
                               'type'  => 'textarea',
                               'desc'  => __('Enter your content.', 'juster'),
                             )
                          )
      ),
      array(
        'id'          => 'featured_style1',
        'label'       => __('Featured Slider','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'featured_slider',
        'label'       => __('Featured Slider','juster'),
        'desc'        => __('Enter your featured slider details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_shortcode',
        'class'       => '',
        'settings'    =>  array(
                             array(
                               'id' => 'featured_category',
                               'label' => __('Category', 'juster'),
                               'type'  => 'textarea',
                               'desc'  => __('Enter your category.', 'juster'),
                             ),
                             array(
                               'id' => 'featured_content',
                               'label' => __('Content', 'juster'),
                               'type'  => 'textarea',
                               'desc'  => __('Enter your content .', 'juster'),
                             ),
                             array(
                               'id' => 'center_image',
                               'label' => __('Center Image', 'juster'),
                               'type'  => 'upload',
                               'desc'  => __('Upload your center image.', 'juster'),
                             )
                          )
      ),
      array(
        'id'          => 'features_style2',
        'label'       => __('Featured Tabs','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'jt_features_tabs',
        'label'       => __('Featured Tabs','juster'),
        'desc'        => __('Enter your features tabs details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_shortcode',
        'class'       => '',
        'settings'    =>  array(
                             array(
                               'id' => 'features_tab_icon',
                               'label' => __('Icon', 'juster'),
                               'type'  => 'text',
                               'desc'  => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
                             ),
                             array(
                               'id' => 'short_tab_content',
                               'label' => __('Sub Title', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your short content.', 'juster'),
                             ),
                             array(
                               'id' => 'long_tab_content',
                               'label' => __('Tab Content', 'juster'),
                               'type'  => 'textarea',
                               'desc'  => __('Enter your long content .', 'juster'),
                             ),
                             array(
                               'id' => 'tabs_button_text',
                               'label' => __('Button Text', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your button text .', 'juster'),
                             ),
                             array(
                               'id' => 'tabs_button_link',
                               'label' => __('Button Link', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your button link.', 'juster'),
                             )
                           )
      ),
      array(
        'id'          => 'image_tabs_styles',
        'label'       => __('Icon Tabs','juster'),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'ot_shortcode',
        'class'       => '',
      ),
      array(
        'id'          => 'image_tabs',
        'label'       => __('Image Tabs','juster'),
        'desc'        => __('Enter your image tabs details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'ot_shortcode',
        'class'       => '',
        'settings'    =>  array(
                            array(
                               'id' => 'tab_icon',
                               'label' => __('Tab Icon', 'juster'),
                               'type'  => 'text',
                               'desc'  => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
                             ),
                            array(
                                'id'          => 'icon_details',
                                'label'       => __('Need Icon Image?','juster'),
                                'desc'        => __('If you want icon image, OFF this ','juster'),
                                'std'         => 'on',
                                'type'        => 'on-off',
                            ),
                            array(
                               'id' => 'tab_icon_content',
                               'label' => __('Content', 'juster'),
                               'type'  => 'textarea',
                               'desc'  => __('Enter your icon name .', 'juster'),
                               'condition'   => 'icon_details:is(on)',
                            ),
                            array(
                               'id' => 'tab_icon_button_text',
                               'label' => __('Button Text', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your tab name .', 'juster'),
                               'condition'   => 'icon_details:is(on)',
                            ),
                            array(
                               'id' => 'tab_icon_button_link',
                               'label' => __('Button Link', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your tab name .', 'juster'),
                               'condition'   => 'icon_details:is(on)',
                            ),
                             array(
                               'id' => 'tab_image',
                               'label' => __('Tab Image', 'juster'),
                               'type'  => 'upload',
                               'desc'  => __('Upload your tab image.', 'juster'),
                               'condition'   => 'icon_details:is(off)',
                             )
                          )
      ),

      array(
        'id'          => 'shortcode-reference-context',
        'label'       => '',
        'desc'        => $shortcode_reference_context,
        'type'        => 'textblock',
        'section'     => 'ot_shortcode_reference',
        'std'         => ''
      ),

    ) // Settings
  ); // Custom Settings

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings );
  }

  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_juster_theme_option;
  $ot_has_juster_theme_option = true;

}
