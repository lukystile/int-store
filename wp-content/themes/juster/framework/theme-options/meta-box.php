<?php
/**
 * Meta Box
 */
/*
  admin-styles.css
    1. ot-bottom-space // Bottom Spaces
    2. border-bottom // Bottom Border
 */
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', 'jt_custom_menu_selection' );

function jt_custom_menu_selection() {

  $page_custom_menu = array(
      'id'          => 'page_custom_menu',
      'title'       => __('Select Menu for This Page', 'juster'),
      'desc'        => '',
      'pages'       => array( 'page', 'portfolio', 'post', 'product' ),
      'context'     => 'side',
      'priority'    => '',
      'fields'      => array(
        array(
          'id'          => 'choose_menu',
          'label'       => __('Choose Menu', 'juster'),
          'desc'        => '',
          'std'         => 'main-menu',
          'type'        => 'menu-select',
          'section'     => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
        ),
    )
  );

  ot_register_meta_box( $page_custom_menu );

}

add_action( 'admin_init', 'gallery_meta_box' );

function gallery_meta_box() {

  $gallery_meta_box = array(
    'id'        => 'gallery_meta_box',
    'title'     => __('Blog Styles', 'juster'),
    'desc'      => '',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'id'          => 'default_message',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __('There is no extra option for this post format!', 'juster'),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => '',
        'class'       => 'ot-label-hide',
      ),

      array(
        'id'          => 'gallery_content',
        'label'       => __( 'Gallery Content', 'juster' ),
        'desc'        => __( 'Add Your Gallery.', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => '',
        'rows'        => '8',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array(
            array(
                'id'          => 'select_img_vid',
                'label'       => __( 'Select', 'juster' ),
                'desc'        => __('Choose your select box', 'juster'),
                'std'         => '',
                'type'        => 'select',
                'section'     => '',
                'class'       => '',
                'choices'     => array(
                                array(
                                  'value'       => 'select_img',
                                  'label'       => __('Image', 'juster')
                                ),
                                array(
                                  'value'       => 'select_vid',
                                  'label'       => __('Video', 'juster')
                                )
                              )
                   ),
            array(
                'id'          => 'image',
                'label'       => __( 'Image', 'juster' ),
                'type'        => 'upload',
                'condition'   => 'select_img_vid:is(select_img)',
            ),
            array(
                'id'          => 'video',
                'label'       => __( 'Video', 'juster' ),
                'type'        => 'textarea',
                'rows'        => '6',
                'condition'   => 'select_img_vid:is(select_vid)',
            )
        ),
      ),

      array(
        'id'          => 'link_content',
        'label'       => __( 'Link', 'juster' ),
        'desc'        => __('Enter Your Link', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'class'       => '',
      ),

      array(
        'id'          => 'quote_author_name',
        'label'       => __( 'Author Name', 'juster' ),
        'desc'        => __('Enter Author Name', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'class'       => '',
      ),
      array(
        'id'          => 'quote_author_link',
        'label'       => __( 'Author Link', 'juster' ),
        'desc'        => __('Enter Author Link', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'class'       => '',
      ),
      array(
        'id'          => 'quote_author_quote',
        'label'       => __( 'Author Quote', 'juster' ),
        'desc'        => __('Enter Author Quote', 'juster'),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '',
        'class'       => '',
      ),
      array(
        'id'          => 'video_content',
        'label'       => __( 'Video Embed Code', 'juster' ),
        'desc'        => __('Enter your video URL.', 'juster'),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '',
        'class'       => '',
      ),
      array(
        'id'          => 'audio_content',
        'label'       => __( 'Audio Embed Code', 'juster' ),
        'desc'        => __('Enter your audio iframe embed code for single blog page', 'juster'),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '',
        'class'       => '',
      ),

    )
  );

  ot_register_meta_box( $gallery_meta_box );

}

add_action( 'admin_init', 'advanced_meta_box' );

function advanced_meta_box() {

  $advanced_meta = array(
    'id'        => 'ot_advaced_options',
    'title'     => __('Advanced Options', 'juster'),
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'enable_new_page_title',
        'label'       => __('Page Title', 'juster'),
        'desc'        => __('Default page title will display.<br>If you need new page title, please ON here.', 'juster'),
        'std'         => 'off',
        'type'        => 'on-off',
        'class'       => '',
      ),
      array(
        'id'          => 'new_page_title',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __('Enter new page title for this page.', 'juster'),
        'type'        => 'text',
        'std'         => '',
        'class'       => 'ot-label-hide',
        'operator'    => 'and',
        'condition'   => 'enable_new_page_title:is(on)',
      ),
      array(
        'id'          => 'page_subheading',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __('Enter sub-heading for this page.', 'juster'),
        'type'        => 'text',
        'std'         => '',
        'class'       => 'ot-label-hide'
      ),
      array(
        'id'            => 'header_banner_title_img',
        'label'         => __('Testing Label', 'juster'),
        'desc'          => __('Upload your title image. This will show on the header banner image.', 'juster'),
        'type'          => 'upload',
        'std'           => '',
        'class'         => 'ot-label-hide border-bottom',
      ),
      array(
        'id'          => 'page_model',
        'label'       => __('Page Model', 'juster'),
        'desc'        => __('Select your page model.<br>(Note: This page model is not suitable for \'Header Top Boxed Design\'. (i.e) Appearance > Header > Header Top Boxed Design.)', 'juster'),
        'type'        => 'radio-image',
        'std'         => '',
        'class'       => 'border-bottom',
        'choices'     => array(
                         array(
                           'label'  => __('Left Sidebar','juster'),
                           'value'  => 'left_sidebar',
                           'src'    => IMAGES . '/framework/left_sidebar.jpg'
                         ),
                         array(
                           'label'  => __('Right Sidebar','juster'),
                           'value'  => 'right_sidebar',
                           'src'    => IMAGES . '/framework/right_sidebar.jpg'
                         ),
                         array(
                           'label'  => __('Full Width','juster'),
                           'value'  => 'full_width',
                           'src'    => IMAGES . '/framework/full_width.jpg'
                         ),
                         array(
                           'label'  => __('Extra Width', 'juster'),
                           'value'  => 'extra_width',
                           'src'    => IMAGES . '/framework/extra_width.jpg'
                         )
                      )
      ),
      array(
        'id'             => 'select_custom_sidebar',
        'label'          => __('Testing Label', ''),
        'desc'           => __('Select sidebar to show this page, Only for Left & Right Sidebar.', 'juster'),
        'type'           => 'sidebar-select',
        'default'        => __('Custom Sidebar', 'juster'),
        'std'            => 'sidebar-1',
        'operator'       => 'or',
        'class'          => 'ot-bottom-space ot-label-hide',
        'condition'      => 'page_model:is(left_sidebar),page_model:is(right_sidebar)',
      ),
      array(
       'id'           => 'content_inside_container_mt',
       'label'        => __('Testing Label', 'juster'),
       'desc'         => __('Check this, if you need to display main content inside the container.', 'juster'),
       'std'          => '',
       'type'         => 'checkbox',
       'section'      => 'ot_general',
       'class'        => 'ot-label-hide',
       'condition'    => 'page_model:is(extra_width)',
       'choices'      => array(
                            array(
                                'value' => 'yes',
                                'label' => __('Make Contents in Center', 'juster')
                            ),
                        ),
      ),
      array(
        'id'            => 'bg_mt',
        'label'         => __('Testing Label', 'juster'),
        'desc'          => __('Select background styles for this page. <br>NOTE: Background styles applied will not be show on 100% width layout.','juster' ),
        'std'           => '',
        'type'          => 'background',
        'class'         => 'ot-bottom-space ot-label-hide'
      ),
      array(
        'id'          => 'content_area_padding_mt',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __('Enter your main content area padding here. ( Eg: 20px 0px 20px 0px ). <br> Note: Padding values Eg: (Top Right Bottom Left)', 'juster'),
        'std'         => '',
        'type'        => 'text',
        'class'       => 'ot-bottom-space ot-label-hide'
      ),
      array(
        'id'          => 'banner_type_mt',
        'label'       => __( 'Banner Type', 'juster' ),
        'desc'        => __( 'Select Banner Type. (Note : If you select your header as Blog Header, Then Image Banner Type Only Works)', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'img_ban',
                          'label'       => __('Image', 'juster')
                        ),
                        array(
                          'value'       => 'spc_ban',
                          'label'       => __('Special Banner Type', 'juster')
                        ),
                        array(
                          'value'       => 'vid_ban',
                          'label'       => __('Video', 'juster')
                        ),
                        array(
                          'value'       => 'sld_ban',
                          'label'       => __('Revolution Slider', 'juster')
                        ),
                        array(
                          'value'       => 'shortcode_ban',
                          'label'       => __('Extra Shortcode', 'juster')
                        ),
                        array(
                          'value'       => 'jt_hide_ban',
                          'label'       => __('Hide Banner', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'banner_color_mt',
        'label'       => __( 'Testing Label', 'juster' ),
        'desc'        => __( 'Pick your banner color here.', 'juster' ),
        'std'         => '',
        'type'        => 'colorpicker-opacity',
        'class'       => 'ot-label-hide',
      ),
      array(
        'id'          => 'banner_image_mt',
        'label'       => __( 'Testing Label', 'juster' ),
        'desc'        => __( 'Add your page banner image here.', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'class'       => 'ot-label-hide',
        'condition'   => 'banner_type_mt:is(img_ban)',
        'settings'    =>  array(
                             array(
                               'id' => 'ban_img_mt',
                               'label' => __('Image', 'juster'),
                               'type'  => 'upload',
                               'desc'  => __('Upload your banner image here. <br> NOTE: Recommended image size is 1600x900', 'juster'),
                             ),
                          )
      ),
      array(
        'id'          => 'banner_type_spl_mt',
        'label'       => __( 'Tesing Label', 'juster' ),
        'desc'        => __( 'Select special banner type.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'condition'   => 'banner_type_mt:is(spc_ban)',
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
        'id'          => 'special_banner_image_mt',
        'label'       => __( 'Tesing Label', 'juster' ),
        'desc'        => __( 'Add your special banner image.', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'class'       => 'ot-label-hide',
        'condition'   => 'banner_type_mt:is(spc_ban)',
        'settings'    =>  array(
                             array(
                               'id' => 'spc_ban_img',
                               'label' => __('Image', 'juster'),
                               'type'  => 'upload',
                               'desc'  => __('Upload your special banner image here.', 'juster'),
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
         'id'           => 'banner_video_mt',
         'label'        => __('Tesing Label', 'juster'),
         'desc'         => __('Enter your YouTube Video URL here.', 'juster'),
         'type'         => 'text',
         'class'        => 'ot-label-hide',
         'condition'    => 'banner_type_mt:is(vid_ban)',
      ),
      array(
         'id'           => 'vid_ban_adv_opt',
         'label'        => __('Tesing Label', 'juster'),
         'desc'         => __('If need advanced options, please ON here. Otherwise OFF.', 'juster'),
         'std'          => 'off',
         'type'         => 'on-off',
         'class'        => 'ot-label-hide',
         'condition'    => 'banner_type_mt:is(vid_ban)',
      ),
      array(
        'id'            => 'vid_ban_control',
        'label'         => __('Tesing Label', 'juster'),
        'desc'          => __('If need controls of this video, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => 'ot-label-hide',
        'operator'      => 'and',
        'condition'     => 'banner_type_mt:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_auto_play',
        'label'         => __('Tesing Label', 'juster'),
        'desc'          => __('If need auto-play of this video, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => 'ot-label-hide',
        'operator'      => 'and',
        'condition'     => 'banner_type_mt:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_vid_loop',
        'label'         => __('Tesing Label', 'juster'),
        'desc'          => __('If need to play video as loop mode, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => 'ot-label-hide',
        'operator'      => 'and',
        'condition'     => 'banner_type_mt:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_aud_mute',
        'label'         => __('Tesing Label', 'juster'),
        'desc'          => __('If need to play video as mute mode, check this.', 'juster'),
        'std'           => '',
        'type'          => 'checkbox',
        'class'         => 'ot-label-hide',
        'operator'      => 'and',
        'condition'     => 'banner_type_mt:is(vid_ban),vid_ban_adv_opt:is(on)',
        'choices'       => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
        'id'            => 'vid_ban_start_time',
        'label'         => __('Tesing Label', 'juster'),
        'desc'          => __('You can change video start time here. In Seconds [Eg : 60]', 'juster'),
        'std'           => '',
        'type'          => 'text',
        'class'         => 'ot-label-hide',
        'operator'      => 'and',
        'condition'     => 'banner_type_mt:is(vid_ban),vid_ban_adv_opt:is(on)',
      ),
      array(
        'id'            => 'vid_ban_vid_qty',
        'label'         => __('Tesing Label', 'juster'),
        'desc'          => __('Enter video quality. Values are : hd720, large, medium, small', 'juster'),
        'std'           => '',
        'type'          => 'text',
        'class'         => 'ot-label-hide',
        'operator'      => 'and',
        'condition'     => 'banner_type_mt:is(vid_ban),vid_ban_adv_opt:is(on)',
      ),
      array(
         'id'           => 'banner_slide_mt',
         'label'        => __('Tesing Label', 'juster'),
         'desc'         => __('Enter your revolution slider shortcode here.', 'juster'),
         'type'         => 'textarea-simple',
         'class'        => 'ot-label-hide',
         'condition'    => 'banner_type_mt:is(sld_ban)',
         'rows'         => 5,
      ),
      array(
         'id'           => 'banner_shortcode_mt',
         'label'        => __('Tesing Label', 'juster'),
         'desc'         => __('Enter your shortcode here.', 'juster'),
         'type'         => 'textarea-simple',
         'class'        => 'ot-label-hide',
         'condition'    => 'banner_type_mt:is(shortcode_ban)',
         'rows'         => 5,
      ),
      array(
        'id'          => 'special_banner_typetext',
        'label'       => __( 'Testing Label', 'juster' ),
        'desc'        => __( 'Enter typing text here.', 'juster' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'class'       => 'ot-label-hide',
        'rows'        => 4,
      ),
      array(
         'id'           => 'port_limit',
         'label'        => __('Photography Style', 'juster'),
         'type'         => 'text',
         'desc'         => __('Enter your portfolios items limit per page.', 'juster'),
      ),
      array(
        'id'          => 'port_column',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select portfolio Columns.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select Columns', 'juster')
                        ),
                        array(
                          'value'       => 'jt-port-col-2',
                          'label'       => __('Two Columns', 'juster')
                        ),
                        array(
                          'value'       => 'jt-port-col-3',
                          'label'       => __('Three Columns', 'juster')
                        ),
                        array(
                          'value'       => 'jt-port-col-4',
                          'label'       => __('Four Columns', 'juster')
                        )
                      )
      ),
      array(
       'id'           => 'enable_cat_filter',
       'type'         => 'checkbox',
       'label'        => __('Testing Label', 'juster'),
       'desc'         => __('If you want category filter then check this.', 'juster'),
       'class'        => 'ot-label-hide',
       'choices'      => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
       'id'           => 'filter_title',
       'label'        => __('Testing Label', 'juster'),
       'type'         => 'text',
       'class'        => 'ot-label-hide',
       'desc'         => __('Enter your fliter title.', 'juster')
      ),
      array(
       'id'           => 'filter_text_color',
       'type'         => 'colorpicker',
       'label'        => __('Testing Label', 'juster'),
       'desc'         => __('Pick your fliter text color.', 'juster'),
       'class'        => 'ot-label-hide',
      ),
      array(
       'id'          => 'filter_bg',
       'label'       => __('Testing Label', 'juster'),
       'type'        => 'colorpicker',
       'desc'        => __('Pick your fliter bg color.', 'juster'),
       'class'       => 'ot-label-hide',
      ),
      array(
        'id'          => 'port_click_effect',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select portfolio click effect.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select Click Effect', 'juster')
                        ),
                        array(
                          'value'       => 'pop_up_effect',
                          'label'       => __('Popup', 'juster')
                        ),
                        array(
                          'value'       => 'link_effect',
                          'label'       => __('Link', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'port_order',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select portfolio order.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select Order', 'juster')
                        ),
                        array(
                          'value'       => 'ASC',
                          'label'       => __('Ascending', 'juster')
                        ),
                        array(
                          'value'       => 'DESC',
                          'label'       => __('Descending', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'port_order_by',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select portfolio orderby.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select OrderBy', 'juster')
                        ),
                        array(
                          'value'       => 'ID',
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
                          'label'       => __('Rand', 'juster')
                        )
                      )
      ),
      array(
       'id'          => 'offset_port',
       'label'       => __('Testing Label', 'juster'),
       'type'        => 'text',
       'desc'        => __('Enter a number to offset portfolio items.', 'juster'),
       'class'       => 'ot-label-hide',
      ),
      array(
       'id'          => 'show_port_cat',
       'label'       => __('Testing Label', 'juster'),
       'type'        => 'text',
       'desc'        => __('Enter category SLUGS (comma separated) you want to display.', 'juster'),
       'class'       => 'ot-label-hide',
      ),
       array(
       'id'          => 'port_pageination',
       'label'       => __('Testing Label', 'juster'),
       'type'        => 'checkbox',
       'desc'        => __('If you want pagination please check this.', 'juster'),
       'class'       => 'ot-label-hide',
       'choices'     => array(
                         array(
                           'label'  => __('Yes, please', 'juster'),
                           'value'  => 'yes'
                         )
                      )
      ),
      array(
       'id'          => 'one_page_arch',
       'label'       => __('One Page Architecture', 'juster'),
       'desc'        => __('Choose background types for one page architecture', 'juster'),
       'type'        => 'background',
       'class'       => 'ot-bottom-space',
      ),
      array(
       'id'          => 'one_page_arch_limit',
       'label'       => __('Testing Label', 'juster'),
       'desc'        => __('Enter your portfolio items limit per page.', 'juster'),
       'type'        => 'text',
       'class'       => 'ot-label-hide',
      ),
      array(
        'id'          => 'one_page_arch_order',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select portfolio order.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select Order', 'juster')
                        ),
                        array(
                          'value'       => 'ASC',
                          'label'       => __('Ascending', 'juster')
                        ),
                        array(
                          'value'       => 'DESC',
                          'label'       => __('Descending', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'one_page_arch_orderby',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select portfolio orderby.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select OrderBy', 'juster')
                        ),
                        array(
                          'value'       => 'ID',
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
                          'label'       => __('Rand', 'juster')
                        )
                      )
      ),
      array(
       'id'          => 'one_page_arch_offset',
       'label'       => __('Testing Label', 'juster'),
       'type'        => 'text',
       'desc'        => __('Enter a number to offset portfolio items.', 'juster'),
       'class'       => 'ot-label-hide',
      ),
      array(
       'id'          => 'one_page_arch_cat_slug',
       'label'       => __('Testing Label', 'juster'),
       'type'        => 'text',
       'desc'        => __('Enter category SLUGS (comma separated) you want to display.', 'juster'),
       'class'       => 'ot-label-hide',
      ),

      // Scroll Lock
      array(
         'id'           => 'sl_limits',
         'label'        => __('Listing Optons', 'juster'),
         'type'         => 'text',
         'desc'         => __('Enter your section limits. [Eg : 5]', 'juster'),
      ),
      array(
        'id'          => 'sl_order',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select section order.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select Order', 'juster')
                        ),
                        array(
                          'value'       => 'ASC',
                          'label'       => __('Ascending', 'juster')
                        ),
                        array(
                          'value'       => 'DESC',
                          'label'       => __('Descending', 'juster')
                        )
                      )
      ),
      array(
        'id'          => 'sl_orderby',
        'label'       => __('Testing Label', 'juster'),
        'desc'        => __( 'Select section orderby.', 'juster' ),
        'type'        => 'select',
        'class'       => 'ot-label-hide',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select OrderBy', 'juster')
                        ),
                        array(
                          'value'       => 'ID',
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
                          'label'       => __('Rand', 'juster')
                        )
                      )
      ),
      array(
       'id'          => 'sl_category',
       'label'       => __('Testing Label', 'juster'),
       'type'        => 'text',
       'desc'        => __('Enter category SLUGS (comma separated) you want to display.', 'juster'),
       'class'       => 'ot-label-hide',
      ),

    ),
   );
  ot_register_meta_box( $advanced_meta );
}

add_action( 'admin_init', 'team_meta' );

function team_meta() {

  $team_metabox = array(
    'id'        => 'teams',
    'title'     => __('Advanced Options', 'juster'),
    'desc'      => '',
    'pages'     => array( 'team' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
       'id'           => 'group_member_profession',
       'label'        => __('Profession', 'juster'),
       'type'         => 'text',
       'desc'         => __('Enter your profession.', 'juster'),
      ),
      array(
        'id'          => 'group_members',
        'label'       => __( 'Social Icons', 'juster' ),
        'desc'        => __('Enter your team members details', 'juster' ),
        'std'         => '',
        'type'        => 'list-item',
        'class'       => '',
        'settings'    =>  array(
                             array(
                               'id' => 'icon',
                               'label' => __('Icon', 'juster'),
                               'type'  => 'text',
                               'desc'  => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
                             ),
                             array(
                               'id' => 'icon_link',
                               'label' => __('Icon One Link', 'juster'),
                               'type'  => 'text',
                               'desc'  => __('Enter your icon one link.', 'juster'),
                             )
                          )
      )
    ),
  );
  ot_register_meta_box( $team_metabox );
}

add_action( 'admin_init', 'teastimonial_style' );

function teastimonial_style() {

  $testimonial_metabox = array(
    'id'        => 'testimonial_meta',
    'title'     => __('Profession', 'juster'),
    'desc'      => '',
    'pages'     => array( 'testimonial' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
       'id'         => 'testimonial_profession',
       'label'      => __('Profession', 'juster'),
       'type'       => 'text',
       'desc'       => __('Enter your profession.', 'juster'),
      ),
      array(
       'id'         => 'testimonial_star',
       'label'      => __('Rating', 'juster'),
       'type'       => 'numeric_slider',
       'std'        => '',
       'desc'       => __('Drag your rating count.', 'juster'),
       'min_max_step'=> '1,5,1'
      )
    ),
  );
  ot_register_meta_box( $testimonial_metabox );
}

add_action( 'admin_init', 'portfolio_meta' );

function portfolio_meta() {

  $portfolio_metabox = array(
    'id'        => 'portfolio_meta',
    'title'     => __('Portfolio Options', 'juster'),
    'desc'      => '',
    'pages'     => array( 'portfolio' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'id'          => 'select_portfolio_masonry_type',
        'label'       => __( 'Select Masonry Image Size', 'juster' ),
        'desc'        => __( 'Compare to portfolio page and select which one is right fit for there. This size will only work for portfolio <strong>Even Grid</strong> type. <br /> Default : <strong>Height 3</strong>.', 'juster' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => '',
        'class'       => '',
        'choices'     => array(
                        array(
                          'value'       => '',
                          'label'       => __('Select', 'juster')
                        ),
                        array(
                          'value'       => 'height-2',
                          'label'       => __('Height 2', 'juster')
                        ),
                        array(
                          'value'       => 'height-3',
                          'label'       => __('Height 3', 'juster')
                        ),
                        array(
                          'value'       => 'height-4',
                          'label'       => __('Height 4', 'juster')
                        )
                      )
      ),

      array(
        'id'         => 'port_single_img',
        'label'      => __('Gallery', 'juster'),
        'desc'       => __('Add your single portfolio images here.', 'juster'),
        'type'       => 'list-item',
        'std'        => '',
        'settings'   => array(
                           array(
                             'id'    => 'port_img',
                             'label' => __('Image', 'juster'),
                             'type'  => 'upload',
                             'desc'  => __('Upload your gallery image.', 'juster'),
                           ),
                           array(
                             'id'    => 'port_cat',
                             'label' => __('Category', 'juster'),
                             'type'  => 'textarea',
                             'desc'  => __('Enter your portfolio category here.', 'juster'),
                             'rows'  => 4,
                           ),
                           array(
                             'id'    => 'port_tit_cat_enable',
                             'label' => __('Show Title & Category', 'juster'),
                             'std'   => 'on',
                             'type'  => 'on-off',
                             'desc'  => __('If need to display title and category in single portfolio page, please ON here.', 'juster'),
                           )
                        )
      )

    ),
  );
  ot_register_meta_box( $portfolio_metabox );
}

/**
 * Scroll lock meta boxes.
 */
add_action( 'admin_init', 'scroll_lock_metabox' );

function scroll_lock_metabox() {

  $scroll_lock_metabox = array(
    'id'        => 'scroll_lock_metabox',
    'title'     => __('Scroll Section Options', 'juster'),
    'desc'      => '',
    'pages'     => array( 'scroll_lock' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'id'          => 'scroll_section_bg',
        'label'       => __( 'Section Background', 'juster' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'section'     => '',
        'class'       => '',
      ),

    )
  );

  ot_register_meta_box( $scroll_lock_metabox );

}
