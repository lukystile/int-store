<?php

/**
 * Adding Extra Params for Default VC Elements
 */

/* ==============================================
   Rows
=============================================== */
/* General */
vc_add_param( "vc_row", array(
    "type" => "checkbox",
    "heading" => __( "Center Row Content", 'juster' ),
    "param_name" => "center_row_content",
    'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
    "description" => __( "Check this if you want this row content are aligned in center.", 'juster')
) );
vc_add_param( "vc_row", array(
    "type" => "checkbox",
    "heading" => __( "Remove Column Left & Right Spaces", 'juster' ),
    "param_name" => "col_right_left_space",
    'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
    "description" => __( "Check this if you want to remove left and right column spaces.", 'juster')
) );
/* Design */
vc_add_param( "vc_row", array(
    "type" => "dropdown",
    "heading" => __( "Visibility", 'juster' ),
    "param_name" => "custom_row_visibility",
    "value" => array(
      "All"=>'',
      "Hidden On Phones"=>'hidden-sm',
      "Hidden On Tablets"=>'hidden-md',
      "Hidden On Desktop"=>'hidden-lg',
      "Visible On Desktop Only"=>'visible-lg',
      "Visible On Phones Only"=>'visible-md',
      "Visible On Tablets Only"=>'visible-sm'
    ),
    "description" => __( "Select which device you want and don't want, leave it for default settings.", 'juster'),
    "group" => __( "Design", 'juster')
) );
vc_add_param( "vc_row", array(
    "type" => "colorpicker",
    "heading" => __( "Text Color", 'juster' ),
    "param_name" => "row_text_color",
    'value'=> '',
    "description" => __( "Note : This only apply when inside elements are not have own color property.", 'juster'),
    "group" => __( "Design", 'juster')
) );

/* Design Tab -> Extra fields for parallax */
vc_add_param( "vc_row", array(
  "type"        => "checkbox",
  "heading"     => __( "Need Background Overlay?", 'juster' ),
  "param_name"  => "enable_background_overlay",
  "description" => __( "If you want background overlay, check this.", 'juster'),
  "group"       => __( "Design Options", 'juster'),
  "value"       => array(
                    __( 'Yes please.', 'juster' )   => 'yes'
                    ),
) );
vc_add_param( "vc_row", array(
    "type" => "dropdown",
    "heading" => __( "Overlay Style", 'juster' ),
    "param_name" => "overlay_styles",
    "value" => array(
      "---Select Overlay Style---"=>'',
      __("Dotted Image Overlay", 'juster')=>'dotted_image',
      __("Bg Color Overlay", 'juster')=>'bg_color',
    ),
    'dependency'  => array(
                'element' => "enable_background_overlay",
                'value'   => "yes"
                ),
    "group"       => __( "Design Options", 'juster'),
    "description" => __( "Select Overlay Effect.", 'juster'),
) );
vc_add_param( "vc_row", array(
    "type" => "colorpicker",
    "heading" => __( "Overlay Bg Color", 'juster' ),
    "param_name" => "overlay_color",
    "value" => '',
    'dependency'  => array(
                'element' => "overlay_styles",
                'value'   => "bg_color"
                ),
    "group"       => __( "Design Options", 'juster'),
    "description" => __( "Select Overlay BG Color.", 'juster'),
) );

/* ==============================================
    VC Column
=============================================== */
/* General */
$vc_column_attr = array(
  array(
    "type" => "dropdown",
    "heading" => __( "Text Align", 'juster' ),
    "param_name" => "text_alignment",
    "value" => array(
      "---Select Text Alignment---"=>'',
      __("Left",'juster')=>'left',
      __("Center",'juster')=>'center',
      __("Right",'juster')=>'right'
    ),
    "description" => __( "Select Your Text Align.", 'juster'),
  ),
  array(
      "type" => "colorpicker",
      "heading" => __( "Background Color", 'juster' ),
      "param_name" => "column_bg_color",
      'value'=> '',
      "description" => __( "Pick background color for this column.", 'juster'),
  ),
  array(
    "type" => "attach_image",
    "heading" => __( "Background Image", 'juster' ),
    "param_name" => "bg_column_image",
    'value'=> '',
    "description" => __( "Upload your background image here.", 'juster'),
  ),
  array(
    "type" => "dropdown",
    "heading" => __( "Background Type", 'juster' ),
    "param_name" => "bg_column_type",
    "value" => array(
      __("Theme Defaults", 'juster') => '',
      __("Cover",'juster') => 'cover',
      __("Contain",'juster') => 'contain',
      __("No Repeat",'juster') => 'no-repeat',
      __("Repeat",'juster') => 'repeat'
    ),
    "description" => __( "Select Your Background Type.", 'juster'),
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Custom Height", 'juster' ),
    "param_name" => "column_custom_height",
    'value'=> '',
    "description" => __( "Enter your custom height for this column. [Example : 400px]", 'juster'),
  ),
  /* Animation */
  array(
    "type" => "dropdown",
    "heading" => __( "Animation Style", 'juster' ),
    "param_name" => "column_animation",
    "value" => array(
      "none"=>'none',
      "fadeIn"=>'fadeIn wow',
      "fadeInDown"=>'fadeInDown wow',
      "fadeInDownBig"=>'fadeInDownBig wow',
      "fadeInLeft"=>'fadeInLeft wow',
      "fadeInLeftBig"=>'fadeInLeftBig wow',
      "fadeInRight"=>'fadeInRight wow',
      "fadeInRightBig"=>'fadeInRightBig wow',
      "fadeInUp"=>'fadeInUp wow',
      "fadeInUpBig"=>'fadeInUpBig wow',
      "fadeOut"=>'fadeOut wow',
      "fadeOutDown"=>'fadeOutDown wow',
      "fadeOutDownBig"=>'fadeOutDownBig wow',
      "fadeOutLeft"=>'fadeOutLeft wow',
      "fadeOutLeftBig"=>'fadeOutLeftBig wow',
      "fadeOutRight"=>'fadeOutRight wow',
      "fadeOutRightBig"=>'fadeOutRightBig wow',
      "fadeOutUp"=>'fadeOutUp wow',
      "fadeOutUpBig"=>'fadeOutUpBig wow',
      "flip"=>'flip wow',
      "flipInX"=>'flipInX wow',
      "flipInY"=>'flipInY wow',
      "flipOutX"=>'flipOutX wow',
      "flipOutY"=>'flipOutY wow',
      "bounce"=>'bounce wow',
      "flash"=>'flash wow',
      "pulse"=>'pulse wow',
      "rubberBand"=>'rubberBand wow',
      "shake"=>'shake wow',
      "swing"=>'swing wow',
      "tada"=>'tada wow',
      "wobble"=>'wobble wow',
      "bounceIn"=>'bounceIn wow',
      "bounceInDown"=>'bounceInDown wow',
      "bounceInLeft"=>'bounceInLeft wow',
      "bounceInRight"=>'bounceInRight wow',
      "bounceInUp"=>'bounceInUp wow',
      "bounceOut"=>'bounceOut wow',
      "bounceOutDown"=>'bounceOutDown wow',
      "bounceOutLeft"=>'bounceOutLeft wow',
      "bounceOutRight"=>'bounceOutRight wow',
      "bounceOutUp"=>'bounceOutUp wow',
      "lightSpeedIn"=>'lightSpeedIn wow',
      "lightSpeedOut"=>'lightSpeedOut wow',
      "rotateIn"=>'rotateIn wow',
      "rotateInDownLeft"=>'rotateInDownLeft wow',
      "rotateInDownRight"=>'rotateInDownRight wow',
      "rotateInUpLeft"=>'rotateInUpLeft wow',
      "rotateInUpRight"=>'rotateInUpRight wow',
      "rotateOut"=>'rotateOut wow',
      "rotateOutDownLeft"=>'rotateOutDownLeft wow',
      "rotateOutDownRight"=>'rotateOutDownRight wow',
      "rotateOutUpLeft"=>'rotateOutUpLeft wow',
      "rotateOutUpRight"=>'rotateOutUpRight wow',
      "hinge"=>'hinge wow',
      "rollIn"=>'rollIn wow',
      "rollOut"=>'rollOut wow',
      "zoomIn"=>'zoomIn wow',
      "zoomInDown"=>'zoomInDown wow',
      "zoomInLeft"=>'zoomInLeft wow',
      "zoomInRight"=>'zoomInRight wow',
      "zoomInUp"=>'zoomInUp wow',
      "zoomOut"=>'zoomOut wow',
      "zoomOutDown"=>'zoomOutDown wow',
      "zoomOutLeft"=>'zoomOutLeft wow',
      "zoomOutRight"=>'zoomOutRight wow',
      "zoomOutUp"=>'zoomOutU wowp'
    ),
    "description" => __( "Select animation type for this column. Live Action : <a href='http://daneden.github.io/animate.css/' target='_blank'>Animate.css</a>", 'juster'),
    "group" => __( "Animation", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Duration", 'juster' ),
    "param_name" => "animation_duration",
    'value'=> '',
    "description" => __( "Change the animation duration. Example : 1s", 'juster'),
    "group" => __( "Animation", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Delay", 'juster' ),
    "param_name" => "animation_delay",
    'value'=> '',
    "description" => __( "Delay before the animation starts. Example : 1s", 'juster'),
    "group" => __( "Animation", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Offset", 'juster' ),
    "param_name" => "animation_offset",
    'value'=> '',
    "description" => __( "Distance to start the animation (related to the browser bottom). Example : 10", 'juster'),
    "group" => __( "Animation", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Iteration", 'juster' ),
    "param_name" => "animation_iteration",
    'value'=> '',
    "description" => __( "Number of times the animation is repeated. Example : 10", 'juster'),
    "group" => __( "Animation", 'juster')
  ),
  /* Border */
  array(
    "type" => "dropdown",
    "heading" => __( "Border Style", 'juster' ),
    "param_name" => "column_border_style",
    "value" => array(
      "None"=>'none',
      "Solid"=>'solid',
      "Dotted"=>'dotted',
      "Dashed"=>'dashed'
    ),
    "description" => __( "Select border style.", 'juster'),
    "group" => __( "Border", 'juster')
  ),
  array(
    "type" => "colorpicker",
    "heading" => __( "Border Color", 'juster' ),
    "param_name" => "column_border_color",
    'value'=> '',
    "description" => __( "Pick border color for this column.", 'juster'),
    "group" => __( "Border", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Border Width", 'juster' ),
    "param_name" => "column_border_width",
    'value'=> '',
    "description" => __( "Your border width. Example: 1px 1px 1px 1px", 'juster'),
    "group" => __( "Border", 'juster')
  ),
  /* Margin */
  array(
    "type" => "textfield",
    "heading" => __( "Margin Top", 'juster' ),
    "param_name" => "column_margin_top",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Margin", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Margin Bottom", 'juster' ),
    "param_name" => "column_margin_bottom",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Margin", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Margin Left", 'juster' ),
    "param_name" => "column_margin_left",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Margin", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Margin Right", 'juster' ),
    "param_name" => "column_margin_right",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Margin", 'juster')
  ),
  /* Padding */
  array(
    "type" => "textfield",
    "heading" => __( "Padding Top", 'juster' ),
    "param_name" => "column_padding_top",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Padding", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Padding Bottom", 'juster' ),
    "param_name" => "column_padding_bottom",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Padding", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Padding Left", 'juster' ),
    "param_name" => "column_padding_left",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Padding", 'juster')
  ),
  array(
    "type" => "textfield",
    "heading" => __( "Padding Right", 'juster' ),
    "param_name" => "column_padding_right",
    'value'=> '',
    "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
    "group" => __( "Padding", 'juster')
  )
);
vc_add_params( 'vc_column', $vc_column_attr );
/* ==============================================
    VC Single Image
=============================================== */
/* General */
vc_add_param( "vc_single_image", array(
    "type" => "checkbox",
    "heading" => __( "Need Popup Option?", 'juster' ),
    "param_name" => "image_as_popup",
    'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
    'dependency'  => array(
                'element' => "img_link_large",
                'value'   => "yes"
                ),
    "description" => __( "Check this if you want open image as popup.", 'juster')
) );
vc_add_param( "vc_single_image", array(
    "type" => "checkbox",
    "heading" => __( "Add Title as Image Caption?", 'juster' ),
    "param_name" => "title_image_caption",
    'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
    "description" => __( "Check this if you want this title as a caption.", 'juster')
) );

/**
 * Custom Columns
 */
add_action( 'vc_after_init_base', 'add_more_custom_layouts' );
function add_more_custom_layouts() {
    global $vc_row_layouts;
    array_push( $vc_row_layouts, array(
      'cells' => '12_16_13',
      'mask' => '424',
      'title' => 'Custom 1/2 + 1/6 + 1/3',
      'icon_class' => '12_16_13' ));
    array_push( $vc_row_layouts, array(
      'cells' => '12_13_16',
      'mask' => '424',
      'title' => 'Custom 1/2 + 1/3 + 1/6',
      'icon_class' => '12_13_16' ));
}

/**
 * Custom Param - For Notification
 */
// Success
function custom_notification_success($settings, $value) {
   return '<div class="notification_success">'. $settings['description'] . '</div>'; // New button element
}
vc_add_shortcode_param('notification_success', 'custom_notification_success');

// Info
function custom_notification_info($settings, $value) {
   return '<div class="notification_info">'. $settings['description'] .'</div>'; // New button element
}
vc_add_shortcode_param('notification_info', 'custom_notification_info');

// Error
function custom_notification_error($settings, $value) {
   return '<div class="notification_error">'. $settings['description'] . '</div>'; // New button element
}
vc_add_shortcode_param('notification_error', 'custom_notification_error');

// Note
function custom_notification_note($settings, $value) {
   return '<div class="notification_note">'. $settings['description'] .'</div>'; // New button element
}
vc_add_shortcode_param('notification_note', 'custom_notification_note');
