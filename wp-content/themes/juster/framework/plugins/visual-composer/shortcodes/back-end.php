<?php
/**
 * 1. Headings
 * 2. Buttons
 * 3. Counter
 * 4. Skill Bar
 * 5. Pricing
 * 6. Clients Slider
 * 7. Call To Action
 * 8. Dragslide
 * 9. Timeline
 * 10. Team Members
 * 11. Process styles
 * 12. Portfolio
 * 13. Gmap
 * 14. Intro
 * 15. Carousal slider
 * 16. Featured Slide
 * 17. Featured Tabs
 * 18. Blog
 * 19. Service Box
 * 20. Testimonials
 * 21. Alert Message
 * 22. Tables
 * 23. Progress Bar
 * 24. Feature Box
 * 25. Icon Tabs
 * 26. Awards
 * 27. Simple Slider
 * 28. Products
 * 29. Shop Offers
 * 30. Underconstruction
 */

/* ==========================================================
   1. Headings
=========================================================== */
add_action( 'init', 'heading_vc_map' );
if ( ! function_exists( 'heading_vc_map' ) ) {
  function heading_vc_map() {
    vc_map( array(
        "name" =>"Heading",
        "base" => "jt_heading",
        "description" => "Heading Styles",
        "icon" => "icon-vc-heading",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General
            array(
              "type"=>'textfield',
              "heading"=> __('Heading', 'juster'),
              "param_name"=> "heading_text",
              "value" => "",
              "admin_label" => true,
              "description" => __( "Enter your heading text.", 'juster')
            ),
            array(
              "type" => "dropdown",
              "heading" => __( "Heading Tag", 'juster' ),
              "param_name" => "heading_tag",
              "value" => array(
                "Select Tag" => '',
                "h1" => 'h1',
                "h2" => 'h2',
                "h3" => 'h3',
                "h4" => 'h4',
                "h5" => 'h5',
                "h6" => 'h6',
                "p" => 'p',
                "div" => 'div',
                "bold" => 'strong',
                "italic" => 'em'
              ),
              "description" => __( "Select heading tag.", 'juster'),
            ),
            array(
              "type"=>'textarea',
              "heading"=>__('Sub Heading', 'juster'),
              "param_name"=> "sub_heading_text",
              "value" => "",
              "description" => __( "Enter your sub heading.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Seperator?", 'juster' ),
                "param_name" => "need_seperate",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want seperator, check this.", 'juster'),
            ),
            array(
              "type" => "dropdown",
              "heading" => __( "Seperator Styles", 'juster' ),
              "param_name" => "seperator_style",
              "value" => array(
                __("Select Seperator Styles",'juster') => '',
                __("Line",'juster') => 'style-1',
                __("Leaf",'juster') => 'style-2',
                __("Single Line",'juster') => 'style-3'
              ),
              'dependency'  => array(
                'element' => "need_seperate",
                'value'   => "yes"
                ),
              "description" => __( "Select seperator styles.", 'juster'),
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Seperator Height", 'juster' ),
              "param_name" => "sep_height",
              'value' => '',
              "description" => __( "Enter your seperator height in px. (Eg : 16px)", 'juster'),
              'dependency'  => array(
                'element' => "seperator_style",
                'value'   => "style-3"
                ),
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Seperator Width", 'juster' ),
              "param_name" => "sep_width",
              'value' => '',
              "description" => __( "Enter your seperator height in px. (Eg : 16px)", 'juster'),
              'dependency'  => array(
                'element' => "seperator_style",
                'value'   => "style-3"
                ),
            ),
            array(
              "type" => "colorpicker",
              "heading" => __( "Seperator Color", 'juster' ),
              "param_name" => "seperator_color",
              'value' => '',
              "description" => __( "Pick your seperator color", 'juster'),
              'dependency'  => array(
                'element' => "seperator_style",
                'value'   => "style-3"
                ),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Icon?", 'juster' ),
                "param_name" => "need_icon",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __("If you want heading icon, check this.", 'juster'),
            ),

            array(
              "type"=>'textfield',
              "heading"=>__('Heading Icon', 'juster'),
              "param_name"=> "heading_icon",
              "value" => "",
              'dependency'  => array(
                'element' => "need_icon",
                'value'   => "yes"
                ),
              "description" => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg :<strong> pe-7s-notebook <strong>) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :<strong> fa fa-heart <strong>)", 'juster')
            ),
            array(
              "type" => "dropdown",
              "heading" => __( "Icon Border Styles", 'juster' ),
              "param_name" => "icon_border_styles",
              "value" => array(
                __("Select Border Styles",'juster') => '',
                __("Square",'juster') => 'square',
                __("Circle",'juster') => 'circle',
              ),
              'dependency'  => array(
                'element' => "need_icon",
                'value'   => "yes"
                ),
              "description" => __( "Select icon border styles.", 'juster'),
            ),
            array(
              "type" => "dropdown",
              "heading" => __( "Text Align", 'juster' ),
              "param_name" => "text_align",
              "value" => array(
                __('Select Text Align', 'juster')=>'',
                __('Left', 'juster')=>'left',
                __('Center', 'juster')=>'center',
                __('Right', 'juster')=>'right',
              ),
              "description" => __( "Select your text align .", 'juster'),
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Extra class name", 'juster' ),
              "param_name" => "class",
              'value' => '',
            ),

            // Color
            array(
              "type" => "colorpicker",
              "heading" => __( "Heading Color", 'juster' ),
              "param_name" => "heading_color",
              'value' => '',
              "description" => __( "Pick your heading color", 'juster'),
              "group" => __( "Color", 'juster')
            ),
            array(
              "type" => "colorpicker",
              "heading" => __( "Sub Heading Color", 'juster' ),
              "param_name" => "sub_heading_color",
              'value' => '',
              "description" => __( "Pick your sub heading color", 'juster'),
              "group" => __( "Color", 'juster')
            ),
            array(
              "type" => "colorpicker",
              "heading" => __( "Icon Color", 'juster' ),
              "param_name" => "icon_color",
              'value' => '',
              "description" => __( "Pick your icon color", 'juster'),
              'dependency'  => array(
                'element' => "need_icon",
                'value'   => "yes"
                ),
              "group" => __( "Color", 'juster')
            ),
            array(
              "type" => "colorpicker",
              "heading" => __( "Icon Border Color", 'juster' ),
              "param_name" => "icon_border_color",
              'value' => '',
              "description" => __( "Pick your icon border color", 'juster'),
              'dependency'  => array(
                'element' => "need_icon",
                'value'   => "yes"
                ),
              "group" => __( "Color", 'juster')
            ),

            // Size
            array(
              "type" => "textfield",
              "heading" => __( "Heading Size", 'juster' ),
              "param_name" => "heading_size",
              'value' => '',
              "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
              "group" => __( "Sizes", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Sub Heading Size", 'juster' ),
              "param_name" => "sub_heading_size",
              'value' => '',
              "description" => __( "Enter your sub heading size in px. (Eg : 16px)", 'juster'),
              "group" => __( "Sizes", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Sub Heading Line Height", 'juster' ),
              "param_name" => "line_height",
              'value' => '',
              "description" => __( "Enter your sub heading line height in px. (Eg : 16px)", 'juster'),
              "group" => __( "Sizes", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Icon Size", 'juster' ),
              "param_name" => "icon_size",
              'value' => '',
              "description" => __( "Enter your icon size in px. (Eg : 16px)", 'juster'),
              'dependency'  => array(
                'element' => "need_icon",
                'value'   => "yes"
                ),
              "group" => __( "Sizes", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Icon Outer Space", 'juster' ),
              "param_name" => "icon_outer_space",
              'value' => '',
              "description" => __( "Enter your icon outer space in px. Following example pixel values are : Top, Right, Bottom & Left. (Eg : 15px 10px 15px 10px)", 'juster'),
              'dependency'  => array(
                'element' => "need_icon",
                'value'   => "yes"
                ),
              "group" => __( "Sizes", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Letter Spacing", 'juster' ),
              "param_name" => "letter_spacing",
              'value' => '',
              "description" => __( "Enter your letter spacing value in px. (Eg : 2px)", 'juster'),
              "group" => __( "Sizes", 'juster')
            ),
            array(
              "type" => "dropdown",
              "heading" => __( "Heading Text Transform", 'juster' ),
              "param_name" => "heading_text_transform",
              "value" => array(
                __('Select Transform Text', 'juster')=>'',
                __('Uppercase', 'juster')=>'uppercase',
                __('Lowercase', 'juster')=>'lowercase',
                __('Capitalize', 'juster')=>'capitalize',
                __('None', 'juster')=>'none',
              ),
              "description" => __( "Select your text transform .", 'juster'),
              "group" => __( "Sizes", 'juster')
            ),
            array(
              "type" => "dropdown",
              "heading" => __( "Heading Weight", 'juster' ),
              "param_name" => "heading_weight",
              "value" => array(
                __('Select Font Weight', 'juster')=>'',
                '100'=>'100',
                '200'=>'200',
                '300'=>'300',
                '400'=>'400',
                '500'=>'500',
                '600'=>'600',
                '700'=>'700',
                '800'=>'800',
                '900'=>'900',
              ),
              "description" => __( "Select your heading font weight.", 'juster'),
              "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
  2. Buttons
=========================================================== */
add_action( 'init', 'button_vc_map' );

if ( ! function_exists( 'button_vc_map' ) ) {
  function button_vc_map() {
    vc_map( array(
        "name" => __('Button', 'juster'),
        "base" => "jt_button",
        "description" => "Button Styles",
        "icon" => "icon-vc-button",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General
            array(
                "type"=>'textfield',
                "heading"=>__('Button Text', 'juster'),
                "param_name"=> "button_text",
                "value" => "",
                "admin_label" => true,
                "description" => __( "Enter your button text.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Button Type", 'juster' ),
                "param_name" => "button_type",
                "admin_label" => true,
                "value" => array(
                  __('Select Button Type', 'juster') => '',
                  __('Small', 'juster') => 'btn-small',
                  __('Medium', 'juster') => 'btn-medium',
                  __('Large', 'juster') => 'btn-large',
                ),
                "description" => __( "Select button type", 'juster'),
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Button Style", 'juster' ),
                "param_name" => "button_style",
                "value" => array(
                  __('Select Button Style', 'juster') => '',
                  __('Style One', 'juster') => 'bg-empty',
                  __('Style Two', 'juster') => 'bg-filled',
                ),
                "admin_label" => true,
                "description" => __( "Select button style.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Link", 'juster' ),
                "param_name" => "button_link",
                'value' => '',
                "description" => __( "Enter your button link.", 'juster'),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Open New window?", 'juster' ),
                "param_name" => "open_link",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want to open new window, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color
             array(
                "type" => "colorpicker",
                "heading" => __( "Button Text Color", 'juster' ),
                "param_name" => "button_text_color",
                'value' => '',
                "description" => __( "Pick your button text color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Bg Color", 'juster' ),
                "param_name" => "button_bg_color",
                'value'=> '',
                "description" => __( "Pick your button bg color.", 'juster'),
                'dependency'  => array(
                      'element' => "button_style",
                      'value'   => "bg-filled"
                ),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Border Color", 'juster' ),
                "param_name" => "button_border_color",
                'value'=> '',
                "description" => __( "Pick your button border color.", 'juster'),
                'dependency'  => array(
                      'element' => "button_style",
                      'value'   => "bg-empty"
                ),
                "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Button Text Size", 'juster' ),
                "param_name" => "button_text_size",
                'value' => '',
                "description" => __( "Enter your button text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Letter Spacing", 'juster' ),
                "param_name" => "button_letter_space",
                'value' => '',
                "description" => __( "Enter your button text letter spacings in px. (Eg : 2px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Text Transform", 'juster' ),
                "param_name" => "button_text_transform",
                "value" => array(
                  __('Select Transform Text', 'juster')=>'',
                  __('Uppercase', 'juster')=>'uppercase',
                  __('Lowercase', 'juster')=>'lowercase',
                  __('Capitalize', 'juster')=>'capitalize',
                ),
                "description" => __( "Select your text transform .", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),

            // Margin
            array(
                "type" => "textfield",
                "heading" => __( "Margin Top", 'juster' ),
                "param_name" => "button_margin_top",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Margin", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Margin Bottom", 'juster' ),
                "param_name" => "button_margin_bottom",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Margin", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Margin Left", 'juster' ),
                "param_name" => "button_margin_left",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Margin", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Margin Right", 'juster' ),
                "param_name" => "button_margin_right",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Margin", 'juster')
            ),

            //Padding
            array(
                "type" => "textfield",
                "heading" => __( "Padding Top", 'juster' ),
                "param_name" => "btn_padding_top",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Padding", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Padding Right", 'juster' ),
                "param_name" => "btn_padding_right",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Padding", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Padding Bottom", 'juster' ),
                "param_name" => "btn_padding_bottom",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Padding", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Padding Left", 'juster' ),
                "param_name" => "btn_padding_left",
                'value'=> '',
                "description" => __( "Values in pixels. [Eg: 20px]", 'juster'),
                "group" => __( "Padding", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
    3. Counter
=========================================================== */
add_action( 'init', 'counter_vc_map' );
if ( ! function_exists( 'counter_vc_map' ) ) {
  function counter_vc_map() {
    vc_map( array(
        "name" =>"Counter",
        "base" => "jt_counter",
        "description" => "Counter Styles",
        "icon" => "icon-vc-counter",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Counter Style", 'juster' ),
                "param_name" => "counter_style",
                "value" => array(
                  __('Select counter Style', 'juster')=>'',
                  __('Style One', 'juster') => 'style-1',
                  __('Style Two', 'juster') => 'style-2',
                  __('Style Three', 'juster') => 'style-3'
                ),
                "admin_label" => true,
                "description" => __( "Select counter style", 'juster'),
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Counter Icon', 'juster'),
              "param_name"=> "counter_icon",
              "value" => "",
              'dependency'  => array(
                'element' => "counter_style",
                'value'   => "style-2"
              ),
              "description" => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg :<strong> pe-7s-notebook <strong>) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :<strong> fa fa-heart <strong>)", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Counter Number', 'juster'),
              "param_name"=> "counter_number",
              "value"=> "",
              "admin_label" => true,
              "description" => __( "This should only in numerics.", 'juster')
            ),

            array(
              "type"=>'textfield',
              "heading"=>__('Counter Title', 'juster'),
              "param_name"=> "counter_title",
              "admin_label" => true,
              "value"=> "",
              "description" => __( "Enter your counter title.", 'juster')
            ),

            array(
              "type"=>'textfield',
              "heading"=>__('Value In', 'juster'),
              "param_name"=> "counter_value_in",
              "value"=> "",
              "description" => __( "Enter your value in. [Eg : K]", 'juster')
            ),
             array(
                "type" => "checkbox",
                "heading" => __( "Need Seperator?", 'juster' ),
                "param_name" => "counter_seperator",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want seperator, check this.", 'juster'),
                'dependency'  => array(
                  'element' => "counter_style",
                  'value'   => "style-1"
                )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            /* Color */
            array(
              "type"=>'colorpicker',
              "heading"=>__('Number Color', 'juster'),
              "param_name"=> "number_color",
              "value"=>"",
              "description" => __( "Select number color for your counter.", 'juster'),
              "group" => __( "Color", 'juster')
            ),
            array(
              "type"=>'colorpicker',
              "heading"=>__('Icon Color', 'juster'),
              "param_name"=> "icon_color",
              "value"=>"",
              'dependency'  => array(
                'element' => "counter_style",
                'value'   => "style-2"
              ),
              "description" => __( "Select icon color for your counter.", 'juster'),
              "group" => __( "Color", 'juster')
            ),
            array(
              "type"=>'colorpicker',
              "heading"=>__('Title Color', 'juster'),
              "param_name"=> "text_color",
              "value"=>"",
              "description" => __( "Select title color for your counter.", 'juster'),
              "group" => __( "Color", 'juster')
            ),
            array(
              "type"=>'colorpicker',
              "heading"=>__('Bg Color', 'juster'),
              "param_name"=> "bg_color",
              "value"=>"",
              "description" => __( "Select bg color for your counter.", 'juster'),
              "group" => __( "Color", 'juster')
            ),
            /* Size */
            array(
                "type" => "textfield",
                "heading" => __( "Number Text Size", 'juster' ),
                "param_name" => "number_size",
                'value' => '',
                "description" => __( "Enter your counter number size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Icon Size", 'juster' ),
                "param_name" => "icon_size",
                'value' => '',
                'dependency'  => array(
                  'element' => "counter_style",
                  'value'   => "style-2"
                ),
                "description" => __( "Enter your counter icon size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "text_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Text Transform", 'juster' ),
                "param_name" => "text_transform",
                "value" => array(
                  __('Select Transform Text', 'juster')=>'',
                  __('Uppercase', 'juster')=>'uppercase',
                  __('Lowercase', 'juster')=>'lowercase',
                  __('Capitalize', 'juster')=>'capitalize',
                ),
                "description" => __( "Select your text transform .", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),

            /* Padding */
            array(
                "type" => "textfield",
                "heading" => __( "Padding Top", 'juster' ),
                "param_name" => "padding_top",
                'value' => '',
                "description" => __( "Enter your top space in px. (Eg : 16px)", 'juster'),
                "group" => __( "Padding", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Padding Bottom", 'juster' ),
                "param_name" => "padding_bottom",
                'value' => '',
                "description" => __( "Enter your botttom space in px. (Eg : 16px)", 'juster'),
                "group" => __( "Padding", 'juster')
            ),

          )
    ) );
  }
}

/* ==========================================================
    4. Skill Bar
=========================================================== */
add_action( 'init', 'skillbar_vc_map' );
if ( ! function_exists( 'skillbar_vc_map' ) ) {
  function skillbar_vc_map() {
    vc_map( array(
        "name" =>"Skill Bar",
        "base" => "jt_skillbar",
        "description" => "Skillbar Styles",
        "icon" => "icon-vc-skillbar",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
              "type"=>'textfield',
              "heading"=>__('Title', 'juster'),
              "param_name"=> "skillbar_title",
              "value"=> "",
              "admin_label"=> true,
              "description" => __( "Enter your title.", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Percentage', 'juster'),
              "param_name"=> "skillbar_percentage",
              "value"=> "",
              "description" => __( "Enter your percentage. [Eg : 95].", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __( "Percentage Color", 'juster' ),
                "param_name" => "percentage_color",
                'value'=> '',
                "description" => __( "Pick your percentage color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Skillbar Color", 'juster' ),
                "param_name" => "skillbar_color",
                'value'=> '',
                "description" => __( "Pick your skillbar color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Percentage Size", 'juster' ),
                "param_name" => "percentage_size",
                'value'=> '',
                "description" => __( "Enter your percentage size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Text Transform", 'juster' ),
                "param_name" => "text_transform",
                "value" => array(
                  __('Select Transform Text', 'juster')=>'',
                  __('Uppercase', 'juster')=>'uppercase',
                  __('Lowercase', 'juster')=>'lowercase',
                  __('Capitalize', 'juster')=>'capitalize',
                ),
                "description" => __( "Select your text transform .", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}
/* ==========================================================
    5. Pricing
=========================================================== */
add_action( 'init', 'pricing_vc_map' );

if ( ! function_exists( 'pricing_vc_map' ) ) {
  function pricing_vc_map() {
    vc_map( array(
        "name" =>"Pricing",
        "base" => "jt_pricing",
        "description" => __("Pricing Details",'juster'),
        "icon" => "icon-vc-pricing",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "dropdown",
                "heading" => __( "Pricing Style", 'juster' ),
                "param_name" => "pricing_style",
                "value" => array(
                  __('Select pricing Style', 'juster')=>'',
                  __('Style One', 'juster') => 'style-1',
                  __('Style Two', 'juster') => 'style-2',
                  __('Style Three', 'juster') => 'style-3'
                ),
                "admin_label" => true,
                "description" => __( "Select pricing style", 'juster'),
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Heading', 'juster'),
              "param_name"=> "heading",
              "value" => "",
              "admin_label" => true,
              "description" => __( "Enter your heading.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Price", 'juster' ),
                "param_name" => "price",
                'value' => '',
                "description" => __( " Enter your price. [Eg : $59]", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Period", 'juster' ),
                "param_name" => "period",
                'value' => '',
                "description" => __( "Enter your period.[ Eg:per month,per year ]", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Pricing Bg Image', 'juster'),
                "param_name"=> "pricing_bg_image",
                'value'=> '',
                'dependency'  => array(
                      'element' => "pricing_style",
                      'value'   => "style-1"
                ),
                "description" => __( "Select pricing bg image", 'juster'),
            ),
            array(
                "type" => "textarea_html",
                "heading" => __( "Lists", 'juster' ),
                "param_name" => "content",
                'value' => '',
                "description" => __( "Enter your lists.Use ul & li tags", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Text", 'juster' ),
                "param_name" => "button_text",
                'value' => '',
                "description" => __( "Enter your button text", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Link", 'juster' ),
                "param_name" => "button_link",
                'value' => '',
                "description" => __( "Enter your button link", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Open New window?", 'juster' ),
                "param_name" => "open_link",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want to open new window, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value' => '',
                "description" => __( "Pick your heading color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Price Color", 'juster' ),
                "param_name" => "price_color",
                'value' => '',
                "description" => __( "Pick your price color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Period Color", 'juster' ),
                "param_name" => "period_color",
                'value' => '',
                "description" => __( "Pick your period color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Text Color", 'juster' ),
                "param_name" => "button_text_color",
                'value' => '',
                "description" => __( "Pick your button text color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Border Color", 'juster' ),
                "param_name" => "button_border_color",
                'value' => '',
                "description" => __( "Pick your button border color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            // Sizes
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value' => '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Price Size", 'juster' ),
                "param_name" => "price_size",
                'value' => '',
                "description" => __( "Enter your price size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Period Size", 'juster' ),
                "param_name" => "period_size",
                'value' => '',
                "description" => __( "Enter your period size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Text Size", 'juster' ),
                "param_name" => "button_text_size",
                'value' => '',
                "description" => __( "Enter your button text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
    6. Clients Slider
=========================================================== */
add_action( 'init', 'clients_vc_map' );

if ( ! function_exists( 'clients_vc_map' ) ) {
  function clients_vc_map() {
    vc_map( array(
        "name" =>"Clients",
        "base" => "jt_clients",
        "description" => __( "Clients Styles",'juster'),
        "icon" => "icon-vc-gmap",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "notification_success",
                "heading" => '',
                "param_name" => "to_notify",
                'value' => '',
                "description" => __( "This shortcode is called from : <strong>Appearance > Theme Options > Shotcode > clients Slider </strong> <br /> If you need to work this shortcode please add them first on Theme Options.", 'juster'),
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Client Slider Style", 'juster' ),
                "param_name" => "clients_style",
                "value" => array(
                  __('Select Slider Style', 'juster')=>'',
                  __('Carousel Type', 'juster') => 'style-1',
                  __('Bordered', 'juster') => 'style-2',
                  __('Hover Animation', 'juster') => 'style-3',
                  __('Normal', 'juster') => 'style-4',
                ),
                "admin_label" => true,
                "description" => __( "Select clients slider style", 'juster'),
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Columns", 'juster' ),
                "param_name" => "client_columns",
                "admin_label" => true,
                "value" => array(
                  __('--Select Column Type---', 'juster') => '',
                  __('Column Three', 'juster') => 'col-sm-4',
                  __('Column Four', 'juster') => 'col-sm-3',
                  __('Column Five', 'juster') => 'col-clients-5',
                   __('Column Six', 'juster') => 'col-sm-2'
                ),
                'dependency'  => array(
                  'element' => "clients_style",
                  'value'   => array('style-3','style-4')
                ),
                "description" => __( "Select column.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),
          )
    ) );
  }
}

/* ==========================================================
   7. Call To Action
=========================================================== */
add_action( 'init', 'calltoaction_vc_map' );
if ( ! function_exists( 'calltoaction_vc_map' ) ) {
  function calltoaction_vc_map() {
    vc_map( array(
        "name" =>"Call To action",
        "base" => "jt_call_to_action",
        "description" => "Call To Action Styles",
        "icon" => "icon-vc-callout_box",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
              "type"=>'textfield',
              "heading"=>__('Title', 'juster'),
              "param_name"=> "title",
              "value"=> "",
              "admin_label"=> true,
              "description" => __( "Enter your  title.", 'juster')
            ),
            array(
              "type"=>'textarea',
              "heading"=>__('Content', 'juster'),
              "param_name"=> "call_content",
              "value"=> "",
              "description" => __( "Enter your content", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Icon', 'juster'),
              "param_name"=> "icon",
              "value"=> "",
               "description" => __( "Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Button One Text', 'juster'),
              "param_name"=> "button1_text",
              "value"=> "",
              "description" => __( "Enter your button one text", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Button One Link', 'juster'),
              "param_name"=> "button1_link",
              "value"=> "",
              "description" => __( "Enter your button one link", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Button Two?", 'juster' ),
                "param_name" => "need_button",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want button two, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Two Text", 'juster' ),
                "param_name" => "button2_text",
                'dependency'  => array(
                'element' => "need_button",
                'value'   => "yes"
                ),
                "description" => __( "Enter your button two text.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Two Link", 'juster' ),
                "param_name" => "button2_link",
                'dependency'  => array(
                'element' => "need_button",
                'value'   => "yes"
                ),
                "description" => __( "Enter your button two link.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Icon Color", 'juster' ),
                "param_name" => "icon_color",
                'value'=> '',
                "description" => __( "Pick your icon color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Icon Border Color", 'juster' ),
                "param_name" => "icon_border_color",
                'value'=> '',
                "description" => __( "Pick your icon border color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Arrow BG Color", 'juster' ),
                "param_name" => "icon_bg_color",
                'value'=> '',
                "description" => __( "Pick your icon background color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Arrow Icon", 'juster' ),
                "param_name" => "arrow_icon_color",
                "value" => array(
                  __( '---Select Arrow---','juster') =>'',
                  __('Dark Arrow', 'juster' ) =>'box-arrow-right',
                  __('White Arrow', 'juster' ) =>'box-arrow-right-white',
                ),
                "description" => __( "Select arrow color.", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button One Text Color", 'juster' ),
                "param_name" => "button1_color",
                'value'=> '',
                "description" => __( "Pick your button one text color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Two Text Color", 'juster' ),
                "param_name" => "button2_color",
                'value'=> '',
                'dependency'  => array(
                'element' => "need_button",
                'value'   => "yes"
                ),
                "description" => __( "Pick your button two text color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button One Border Color", 'juster' ),
                "param_name" => "button1_border_color",
                'value'=> '',
                "description" => __( "Pick your button one border color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Two Border Color", 'juster' ),
                "param_name" => "button2_border_color",
                'value'=> '',
                'dependency'  => array(
                'element' => "need_button",
                'value'   => "yes"
                ),
                "description" => __( "Pick your button two border color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Icon Size", 'juster' ),
                "param_name" => "icon_size",
                'value'=> '',
                "description" => __( "Enter your icon size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button One Text Size", 'juster' ),
                "param_name" => "button1_size",
                'value'=> '',
                "description" => __( "Enter your button one text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Two Text Size", 'juster' ),
                "param_name" => "button2_size",
                'value'=> '',
                'dependency'  => array(
                'element' => "need_button",
                'value'   => "yes"
                ),
                "description" => __( "Enter your button two text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),

          )
    ) );
  }
}

/* ==========================================================
    8. Dragslide
=========================================================== */
add_action( 'init', 'dragslide_vc_map' );
if ( ! function_exists( 'dragslide_vc_map' ) ) {
  function dragslide_vc_map() {
    vc_map( array(
        "name" =>"Dragslide",
        "base" => "jt_dragslide_images",
        "description" => "Dragslide Styles",
        "icon" => "icon-vc-dragslide",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
              "type"=>'attach_images',
              "heading"=>__('Slide Images', 'juster'),
              "param_name"=> "slide_images",
              "value"=> "",
              "description" => __( "Attach more than one images. <b>Recommedned Size : 400x420.</b>", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),
          )
    ) );
  }
}

/* ==========================================================
    9. Timeline
=========================================================== */
add_action( 'init', 'timeline_vc_map' );
if ( ! function_exists( 'timeline_vc_map' ) ) {
  function timeline_vc_map() {
    vc_map( array(
        "name" =>"Timeline",
        "base" => "jt_timeline",
        "description" => "Timeline Styles",
        "icon" => "icon-vc-timeline",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

          array(
                "type" => "notification_success",
                "heading" => '',
                "param_name" => "to_notify",
                'value' => '',
                "description" => __( "This shortcode is called from : <strong>Appearance > Theme Options > Shotcode > Timeline. </strong> <br /> If you need to work this shortcode please add them first on Theme Options.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Starting Year", 'juster' ),
                "param_name" => "timeline_year",
                'value'=> '',
                "admin_label"=> true,
                "description" => __( "Enter your stating year. [Eg:2010] ", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Date Color", 'juster' ),
                "param_name" => "date_color",
                'value'=> '',
                "description" => __( "Pick your date color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Starting Year Color", 'juster' ),
                "param_name" => "year_color",
                'value'=> '',
                "description" => __( "Pick your year color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Date Size", 'juster' ),
                "param_name" => "date_size",
                'value'=> '',
                "description" => __( "Enter your date size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Starting Year Text Size", 'juster' ),
                "param_name" => "year_text_size",
                'value'=> '',
                "description" => __( "Enter your starting year text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
    10. Team Members
=========================================================== */
add_action( 'init', 'team_mebers_vc_map' );
if ( ! function_exists( 'team_mebers_vc_map' ) ) {
  function team_mebers_vc_map() {
    vc_map( array(
        "name" =>"Team Members",
        "base" => "jt_team_members",
        "description" => "Team Members Styles",
        "icon" => "icon-vc-team_members",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

             array(
                "type" => "dropdown",
                "heading" => __( "Team Member Style", 'juster' ),
                "param_name" => "team_style",
                "value" => array(
                  __( '---Select Style---','juster') =>'',
                  __('Slide : Group', 'juster' ) =>'style-1',
                  __('Slide : Single', 'juster' ) =>'style-2',
                  __('Normal : Group', 'juster' ) =>'style-3',
                  __('Circle type', 'juster' ) =>'style-4',
                  __('Hover Move', 'juster' ) =>'style-5',
                ),
                "admin_label"=> true,
                "description" => __( "Select team member style.", 'juster')
            ),
             array(
                "type" => "dropdown",
                "heading" => __( "Column Type", 'juster' ),
                "param_name" => "column_type",
                "value" => array(
                  __( '---Select Column Type---','juster') =>'',
                  __('Two Column', 'juster' ) =>'style-1',
                  __('Three Column', 'juster' ) =>'style-2'
                ),
                'dependency'  => array(
                  'element' => "team_style",
                  'value'   =>  array('style-3','style-4','style-5')
                ),
                "admin_label"=> true,
                "description" => __( "Select column type.", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Limit', 'juster'),
              "param_name"=> "team_limit",
              "value"=>"8",
              "admin_label" => true,
              "description" => __( "Enter your team members limit per page.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Content?", 'juster' ),
                "param_name" => "need_content",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                'dependency'  => array(
                  'element' => "team_style",
                  'value'   =>  array('style-1','style-3','style-4','style-5')
                ),
                "description" => __( "If you want to content, check this.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Remove Left & Right Arrows', 'juster'),
              "param_name"=> "team_arrow_disable",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              'dependency'  => array(
                  'element' => "team_style",
                  'value'   => array('style-1')
              ),
              "description" => __( "If you disable left & right arrows then check this.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Remove Dots', 'juster'),
              "param_name"=> "team_dots_disable",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              'dependency'  => array(
                  'element' => "team_style",
                  'value'   =>  'style-1'
              ),
              "description" => __( "If you disable dots,left & right arrows then check this.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Disable Slide', 'juster'),
              "param_name"=> "disable_slide",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              'dependency'  => array(
                  'element' => "team_style",
                  'value'   => 'style-2'
              ),
              "description" => __( "If you disable slide then check this.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Need Vertical Image', 'juster'),
              "param_name"=> "need_vertical_image",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              'dependency'  => array(
                  'element' => "team_style",
                  'value'   =>  array('style-1','style-3','style-4','style-5')
                ),
              "description" => __( "If you want vertical image check this.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Show only certain categories?", 'juster' ),
                "param_name" => "show_category",
                'value'=>'',
                "description" => __( "Enter category SLUGS (comma separated) you want to display.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Show only certain ID?", 'juster' ),
                "param_name" => "show_id",
                'value'=>'',
                "description" => __( "Enter particular ID you want to display.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order", 'juster' ),
                "param_name" => "team_order",
                "value" => array(
                  __('Select Team Order', 'juster')=>'',
                  __( "Ascending", 'juster' )=>'ASC',
                  __("Descending", 'juster' )=>'DESC'
                ),
                "description" => __( "Select team order.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order By", 'juster' ),
                "param_name" => "team_order_by",
                "value" => array(
                            "none"=>'none',
                            "ID"=>'ID',
                            "Author"=>'author',
                            "Title"=>'title',
                            "Name"=>'name',
                            "Type"=>'type',
                            "Date"=>'date',
                            "Modified"=>'modified',
                            "Rand"=>'rand'
                          ),
                "description" => __( "Select team orderby.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Offset", 'juster' ),
                "param_name" => "team_offset",
                'value'=>'',
                "description" => __( "Enter a number to offset team members.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need pagination?", 'juster' ),
                "param_name" => "team_pagination",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                "description" => __( "If you want pagination, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Name Color", 'juster' ),
                "param_name" => "name_color",
                'value'=> '',
                "description" => __( "Pick your name color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Profession Color", 'juster' ),
                "param_name" => "profession_color",
                'value'=> '',
                "description" => __( "Pick your profession color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Icon Color", 'juster' ),
                "param_name" => "icon_color",
                'value'=> '',
                "description" => __( "Pick your icon color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color.", 'juster'),
                'dependency'  => array(
                  'element' => "team_style",
                  'value'   => array("style-3","style-1","style-4","style-5")
                ),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Team Slide Color", 'juster' ),
                "param_name" => "team_slide_color",
                'value'=> '',
                "description" => __( "Pick your team slide color.", 'juster'),
                'dependency'  => array(
                  'element' => "team_style",
                  'value'   =>'style-5'
                ),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Team Image Hover Bg Color", 'juster' ),
                "param_name" => "team_img_bg_color",
                'value'=> '',
                "description" => __( "Pick your team image hover bg color.", 'juster'),
                'dependency'  => array(
                  'element' => "team_style",
                  'value'   =>'style-5'
                ),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Name Size", 'juster' ),
                "param_name" => "name_text_size",
                'value'=> '',
                "description" => __( "Enter your name text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Profession Size", 'juster' ),
                "param_name" => "profession_text_size",
                'value'=> '',
                "description" => __( "Enter your profession text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Icon Size", 'juster' ),
                "param_name" => "icon_size",
                'value'=> '',
                "description" => __( "Enter your icon size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
               "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                  'element' => "team_style",
                  'value'   => array("style-3","style-1","style-4","style-5")
                ),
                 "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
    11. Process Styles
=========================================================== */
add_action( 'init', 'process_style_vc_map' );
if ( ! function_exists( 'process_style_vc_map' ) ) {
  function process_style_vc_map() {
    vc_map( array(
        "name" =>"Process",
        "base" => "jt_process",
        "description" => "Process Styles",
        "icon" => "icon-vc-process",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            //Process One
            array(
                "type" => "dropdown",
                "heading" => __( "Process Style", 'juster' ),
                "param_name" => "process_style",
                "value" => array(
                  __('Process style', 'juster')=>'',
                  __('Style One', 'juster' ) =>'style-1',
                  __('Style Two', 'juster' ) =>'style-2'
                ),
                "admin_label" => true,
                "description" => __("Select process style.", 'juster'),
                "group" => __( "Process One", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Number Style", 'juster' ),
                "param_name" => "number_style1",
                "value" => array(
                  __('Number style', 'juster')=>'',
                  __('Text', 'juster' ) =>'style-1',
                  __('Image', 'juster' ) =>'style-2'
                ),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "admin_label" => true,
                "description" => __( "Select number style.", 'juster'),
                "group" => __( "Process One", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Process Number', 'juster'),
              "param_name"=> "number1",
              "value"=> "",
              'dependency'  => array(
                    'element' => "number_style1",
                    'value'   => "style-1"
              ),
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process One", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Number Image', 'juster'),
                "param_name"=> "number_image1",
                'value'=> '',
                'dependency'  => array(
                    'element' => "number_style1",
                    'value'   => "style-2"
                ),
                "description" => __( "Select pricing bg image", 'juster'),
                "group" => __( "Process One", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Process One Image', 'juster'),
                "param_name"=> "process_img_one",
                'value'=> '',
                "description" => __( "Select process image one", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-2"
                ),
                "group" => __( "Process One", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Title', 'juster'),
              "param_name"=> "title1",
              "value"=> "",
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process One", 'juster')
            ),
            array(
              "type"=>'textarea',
              "heading"=>__('Content', 'juster'),
              "param_name"=> "content1",
              "value"=> "",
              "description" => __( "Enter your content", 'juster'),
              "group" => __( "Process One", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Icon', 'juster'),
              "param_name"=> "icon1",
              "value"=> "",
              "description" => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
              'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
              ),
              "group" => __( "Process One", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Right Side Seperator?", 'juster' ),
                "param_name" => "right_sep_one",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-2"
                ),
                "description" => __( "If you want right seperator, check this.", 'juster'),
                "group" => __( "Process One", 'juster')
            ),

            //Process Two
            array(
                "type" => "dropdown",
                "heading" => __( "Number Style", 'juster' ),
                "param_name" => "number_style2",
                "value" => array(
                            __('Number style', 'juster')=>'',
                            __('Text', 'juster' ) =>'style-1',
                            __('Image', 'juster' ) =>'style-2'
                          ),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "description" => __( "Select team member style.", 'juster'),
                "group" => __( "Process Two", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Process Number', 'juster'),
              "param_name"=> "number2",
              "value"=> "",
              'dependency'  => array(
                    'element' => "number_style2",
                    'value'   => "style-1"
                  ),
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process Two", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Number Image', 'juster'),
                "param_name"=> "number_image2",
                'value'=> '',
                'dependency'  => array(
                    'element' => "number_style2",
                    'value'   => "style-2"
                  ),
                "description" => __( "Select pricing bg image", 'juster'),
                "group" => __( "Process Two", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Process Two Image', 'juster'),
                "param_name"=> "process_img_two",
                'value'=> '',
                "description" => __( "Select process image two", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-2"
                ),
                "group" => __( "Process Two", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Title', 'juster'),
              "param_name"=> "title2",
              "value"=> "",
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process Two", 'juster')
            ),
            array(
              "type"=>'textarea',
              "heading"=>__('Content', 'juster'),
              "param_name"=> "content2",
              "value"=> "",
              "description" => __( "Enter your content", 'juster'),
              "group" => __( "Process Two", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Icon', 'juster'),
              "param_name"=> "icon2",
              "value"=> "",
              "description" => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
              'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
              ),
              "group" => __( "Process Two", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Right Side Seperator?", 'juster' ),
                "param_name" => "right_sep_two",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-2"
                ),
                "description" => __( "If you want right seperator, check this.", 'juster'),
                "group" => __( "Process Two", 'juster')
            ),

            //Process Three
            array(
                "type" => "dropdown",
                "heading" => __( "Number Style", 'juster' ),
                "param_name" => "number_style3",
                "value" => array(
                            __('Number style', 'juster')=>'',
                            __('Text', 'juster' ) =>'style-1',
                            __('Image', 'juster' ) =>'style-2'
                          ),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "description" => __( "Select team member style.", 'juster'),
                "group" => __( "Process Three", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Process Number', 'juster'),
              "param_name"=> "number3",
              "value"=> "",
              'dependency'  => array(
                    'element' => "number_style3",
                    'value'   => "style-1"
                  ),
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process Three", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Number Image', 'juster'),
                "param_name"=> "number_image3",
                'value'=> '',
                'dependency'  => array(
                    'element' => "number_style3",
                    'value'   => "style-2"
                  ),
                "description" => __( "Select pricing bg image", 'juster'),
                "group" => __( "Process Three", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Process Image Three', 'juster'),
                "param_name"=> "process_img_three",
                'value'=> '',
                "description" => __( "Select process image three", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-2"
                ),
                "group" => __( "Process Three", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Title', 'juster'),
              "param_name"=> "title3",
              "value"=> "",
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process Three", 'juster')
            ),
            array(
              "type"=>'textarea',
              "heading"=>__('Content', 'juster'),
              "param_name"=> "content3",
              "value"=> "",
              "description" => __( "Enter your content", 'juster'),
              "group" => __( "Process Three", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Icon', 'juster'),
              "param_name"=> "icon3",
              "value"=> "",
              "description" => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
              'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
              ),
              "group" => __( "Process Three", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Right Side Seperator?", 'juster' ),
                "param_name" => "right_sep_three",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-2"
                ),
                "description" => __( "If you want right seperator, check this.", 'juster'),
                "group" => __( "Process Three", 'juster')
            ),

            //Process Four
            array(
                "type" => "dropdown",
                "heading" => __( "Number Style", 'juster' ),
                "param_name" => "number_style4",
                "value" => array(
                            __('Number style', 'juster')=>'',
                            __('Text', 'juster' ) =>'style-1',
                            __('Image', 'juster' ) =>'style-2'
                          ),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "description" => __( "Select team member style.", 'juster'),
                "group" => __( "Process Four", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Process Number', 'juster'),
              "param_name"=> "number4",
              "value"=> "",
              'dependency'  => array(
                    'element' => "number_style4",
                    'value'   => "style-1"
                  ),
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process Four", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Number Image', 'juster'),
                "param_name"=> "number_image4",
                'value'=> '',
                'dependency'  => array(
                    'element' => "number_style4",
                    'value'   => "style-2"
                  ),
                "description" => __( "Select pricing bg image", 'juster'),
                "group" => __( "Process Four", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Process Image Four', 'juster'),
                "param_name"=> "process_img_four",
                'value'=> '',
                "description" => __( "Select process image four", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-2"
                ),
                "group" => __( "Process Four", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Title', 'juster'),
              "param_name"=> "title4",
              "value"=> "",
              "description" => __( "Enter your title.", 'juster'),
              "group" => __( "Process Four", 'juster')
            ),
            array(
              "type"=>'textarea',
              "heading"=>__('Content', 'juster'),
              "param_name"=> "content4",
              "value"=> "",
              "description" => __( "Enter your content", 'juster'),
              "group" => __( "Process Four", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Icon', 'juster'),
              "param_name"=> "icon4",
              "value"=> "",
              "description" => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
              'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
              ),
              "group" => __( "Process Four", 'juster')
            ),
            // Appearance
            array(
              "type"=>'textfield',
              "heading"=>__('Center Big Text', 'juster'),
              "param_name"=> "center_text",
              "value"=> "",
              "admin_label"=> true,
              "description" => __( "Enter your center text.", 'juster'),
              'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
              "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Number Color", 'juster' ),
                "param_name" => "number_color",
                'value' => '',
                "description" => __( "Pick your number color", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color .", 'juster'),
                 "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Icon Color", 'juster' ),
                "param_name" => "icon_color",
                'value'=> '',
                "description" => __( "Pick your icon color.", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                 "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Center Text Color", 'juster' ),
                "param_name" => "center_text_color",
                'value'=> '',
                "description" => __( "Pick your center text color.", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                 "group" => __( "Appearance", 'juster')
            ),

            //Size
            array(
                "type" => "textfield",
                "heading" => __( "Number Size", 'juster' ),
                "param_name" => "number_size",
                'value' => '',
                "description" => __( "Enter your number size in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Icon Size", 'juster' ),
                "param_name" => "icon_size",
                'value'=> '',
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "description" => __( "Enter your icon size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Center Text Size", 'juster' ),
                "param_name" => "center_text_size",
                'value'=> '',
                'dependency'  => array(
                    'element' => "process_style",
                    'value'   => "style-1"
                ),
                "description" => __( "Enter your center text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Appearance", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
                "group" => __( "Appearance", 'juster')
            ),

          )
    ) );
  }
}

/* ==========================================================
    12. Portfolio
=========================================================== */
add_action( 'init', 'juster_portfolio_vc_map' );
if ( ! function_exists( 'juster_portfolio_vc_map' ) ) {
  function juster_portfolio_vc_map() {
    vc_map( array(
        "name" =>"Portfolio",
        "base" => "jt_portfolio",
        "description" => "Portfolio Item Styles",
        "icon" => "icon-vc-portfolio",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
                "type" => "dropdown",
                "heading" => __( "Portfolio Type", 'juster' ),
                "param_name" => "portfolio_style",
                "value" => array(
                  __('Select Portfolio Style', 'juster')=>'',
                  __('Even Grid', 'juster') => 'style-1',
                  __('Masonry', 'juster') => 'style-2',
                  __('Parallax Style', 'juster') => 'style-3'
                ),
                "admin_label" => true,
                "description" => __( "Select portfolio type.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Columns", 'juster' ),
                "param_name" => "portfolio_columns",
                "admin_label" => true,
                "value" => array(
                  __('--Select Column Type---', 'juster') => '',
                  __('Column Two', 'juster') => 'jt-port-col-2',
                  __('Column Three', 'juster') => 'jt-port-col-3',
                  __('Column Four', 'juster') => 'jt-port-col-4',
                  __('Column Five', 'juster') => 'jt-port-col-5'
                ),
                'dependency'  => array(
                  'element' => "portfolio_style",
                  'value'   => array('style-1','style-2')
                ),
                "description" => __( "Select column.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Need Left Side Design?', 'juster'),
              "param_name"=> "need_left_design",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
              ),
              "description" => __( "If you want left side design then check this.<span class='jt-dependent-notify'> Only This Design Apply Portfolio Style->Even Grid & Columns->Column Four & Enable Category Filter ->Dont Check</span>", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Hover Style", 'juster' ),
                "param_name" => "hover_style",
                "value" => array(
                  __('Select Hover Style', 'juster') =>'',
                  __('Simple Light Hover', 'juster') => 'style-one',
                  __('Simple Dark Hover', 'juster') => 'style-five',
                  __('Slideup Hover', 'juster') => 'style-two',
                  __('Vertical Hover', 'juster') => 'style-three',
                  __('Light Outerspace Hover', 'juster') => 'style-four',
                  __('Dark Outerspace Hover', 'juster') => 'style-six',
                  __('Dark Text Outerspace', 'juster') => 'style-seven'
                ),
                'dependency'  => array(
                  'element' => "portfolio_style",
                  'value'   => array('style-1','style-2')
                ),
                "admin_label" => true,
                "description" => __( "Select hover style. <span class='jt-dependent-notify'>Following Combination will not comfortable, so don't use : <b>Portfolio Type : Masonry</b> + <b>Hover Style : Verticle Hover & Dark Text Outter Space</b></span>", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Limit', 'juster'),
              "param_name"=> "portfolio_limit",
              "value"=>"8",
              "admin_label" => true,
              "description" => __( "Enter your portfolios items limit per page.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Enable Category Filter', 'juster'),
              "param_name"=> "enable_cat_filter",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              "description" => __( "If you want category filter then check this.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Filter Type", 'juster' ),
                "param_name" => "filter_type",
                "value" => array(
                  __('Select Filter Type', 'juster')=>'',
                  __('Style One', 'juster') => 'filter-1',
                  __('Style Two', 'juster') => 'filter-2',
                  __('Style Three', 'juster') => 'filter-3'
                ),
                "description" => __( "Select filter type.", 'juster'),
                'dependency'  => array(
                  'element' => "enable_cat_filter",
                  'value'   => array('yes')
                ),
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Enable Category Back Text', 'juster'),
              "param_name"=> "enable_cat_backtext",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              'dependency'  => array(
                  'element' => "filter_type",
                  'value'   => array('filter-1')
              ),
              "description" => __( "If you want category back text then check this.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order", 'juster' ),
                "param_name" => "portfolio_order",
                "value" => array(
                            __('Select Portfolio Order', 'juster')=>'',
                            __("Ascending", 'juster' )=>'ASC',
                            __("Descending", 'juster' )=>'DESC'
                          ),
                "description" => __( "Select portfolio order.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order By", 'juster' ),
                "param_name" => "portfolio_order_by",
                "value" => array(
                            "none"=>'none',
                            "ID"=>'ID',
                            "Author"=>'author',
                            "Title"=>'title',
                            "Name"=>'name',
                            "Type"=>'type',
                            "Date"=>'date',
                            "Modified"=>'modified',
                            "Rand"=>'rand'
                          ),
                "description" => __( "Select portfolio orderby.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Offset", 'juster' ),
                "param_name" => "port_offset",
                'value'=>'',
                "description" => __( "Enter a number to offset portfolio items.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Show only certain categories?", 'juster' ),
                "param_name" => "show_category",
                'value'=>'',
                "description" => __( "Enter category SLUGS (comma separated) you want to display.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Enable Pagination', 'juster'),
              "param_name"=> "enable_pagination",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              "description" => __( "If you want pagination please check this.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "extra_class",
                'value'=>'',
            ),

            //Design
            array(
                "type" => "textfield",
                "heading" => __( "Main Heading Text", 'juster' ),
                "param_name" => "main_heading_text",
                'value' => '',
                "description" => __( "Enter your heading text.", 'juster'),
                'dependency'  => array(
                  'element' => "filter_type",
                  'value'   => array('filter-1')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Main Heading Color", 'juster' ),
                "param_name" => "main_heading_color",
                'value' => '',
                "description" => __( "Pick your main heading color", 'juster'),
                'dependency'  => array(
                  'element' => "filter_type",
                  'value'   => array('filter-1')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Main Heading Size", 'juster' ),
                "param_name" => "main_heading_size",
                'value' => '',
                "description" => __( "Enter your main heading size in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                  'element' => "filter_type",
                  'value'   => array('filter-1')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Main Heading Bottom Space", 'juster' ),
                "param_name" => "heading_bottom_space",
                'value' => '',
                "description" => __( "Enter your heading bottom space in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                  'element' => "filter_type",
                  'value'   => array('filter-1')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Heading Align", 'juster' ),
                "param_name" => "heading_alignment",
                "value" => array(
                            __('Select Heading Align', 'juster')=>'',
                            __( "Left", 'juster' )=>'left',
                            __("Right", 'juster' )=>'right',
                            __( "Center", 'juster' )=>'center'
                          ),
                'dependency'  => array(
                  'element' => "filter_type",
                  'value'   => array('filter-1')
                ),
                "description" => __( "Select Heading Alignment.", 'juster'),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading", 'juster' ),
                "param_name" => "studio_heading",
                'value' => '',
                "description" => __( "Enter your heading text.", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Sub Heading", 'juster' ),
                "param_name" => "studio_sub_heading",
                'value' => '',
                "description" => __( "Enter your sub heading text.", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Content", 'juster' ),
                "param_name" => "studio_content",
                'value' => '',
                "description" => __( "Enter your content text.", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value' => '',
                "description" => __( "Pick your heading color", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Sub Heading Color", 'juster' ),
                "param_name" => "sub_heading_color",
                'value' => '',
                "description" => __( "Pick your sub heading color", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value' => '',
                "description" => __( "Pick your content color", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value' => '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Sub Heading Size", 'juster' ),
                "param_name" => "sub_heading_size",
                'value' => '',
                "description" => __( "Enter your sub heading size in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value' => '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                  'element' => "portfolio_columns",
                  'value'   => array('jt-port-col-4')
                ),
                "group" => __( "Design", 'juster')
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __( "Category Color", 'juster' ),
                "param_name" => "category_color",
                'value'=> '',
                "description" => __( "Pick your category color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Category Size", 'juster' ),
                "param_name" => "category_size",
                'value'=> '',
                "description" => __( "Enter your category size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
   13. Gmap
=========================================================== */
add_action( 'init', 'gmap_vc_map' );

if ( ! function_exists( 'gmap_vc_map' ) ) {
  function gmap_vc_map() {
    vc_map( array(
        "name" =>"Gmap",
        "base" => "jt_gmap",
        "description" => __( "Google map Styles",'juster'),
        "icon" => "icon-vc-gmap",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "notification_success",
                "heading" => '',
                "param_name" => "to_notify",
                'value' => '',
                "description" => __( "This shortcode is called from : <strong>Appearance > Theme Options > Shortcodes > Gmap</strong> <br /> If you need to work this shortcode please add them first on Theme Options.", 'juster'),
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Style", 'juster' ),
                "param_name" => "gmap_style",
                "value" => array(
                  __('Select Map Style', 'juster')=>'',
                  __('Default Style', 'juster')=>'style-1',
                  __('Light Style', 'juster')=>'style-2',
                  __('Dark Style', 'juster')=>'style-3',
                ),
                "admin_label" => true,
                "description" => __( "Select your map style.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Height", 'juster' ),
                "param_name" => "map_height",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
                "admin_label" => true,
            ),
          )
    ) );
  }
}

/* ==========================================================
    14. Intro
=========================================================== */
add_action( 'init', 'intro_vc_map' );

if ( ! function_exists( 'intro_vc_map' ) ) {
  function intro_vc_map() {
    vc_map( array(
        "name" =>"Intro",
        "base" => "jt_intro",
        "description" => __( "Intro Styles",'juster'),
        "icon" => "icon-vc-intro",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "textfield",
                "heading" => __( "Intro Text", 'juster' ),
                "param_name" => "intro_text",
                'value' => '',
                "admin_label" => true,
                "description" => __( "Enter your intro text", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading", 'juster' ),
                "param_name" => "heading",
                'value' => '',
                "description" => __( "Enter your heading", 'juster')
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Content", 'juster' ),
                "param_name" => "intro_content",
                'value' => '',
                "description" => __( "Enter your content", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Attach Type", 'juster' ),
                "param_name" => "attach_type",
                "value" => array(
                  __('Select Attach Type', 'juster')=>'',
                  __('Single Image', 'juster')=>'style-1',
                  __('Slider Images', 'juster')=>'style-2',
                ),
                "description" => __( "Select your attach type .", 'juster'),
            ),
            array(
              "type"=>'attach_images',
              "heading"=>__('Slider Images', 'juster'),
              "param_name"=> "intro_images",
              "value"=> "",
              'dependency'  => Array(
                'element' => "attach_type",
                'value'   => "style-2"
                ),
              "description" => __( "Attach your slider images.", 'juster')
            ),
            array(
              "type"=>'attach_image',
              "heading"=>__('Single Image', 'juster'),
              "param_name"=> "intro_single",
              "value"=> "",
              'dependency'  => Array(
                'element' => "attach_type",
                'value'   => "style-1"
                ),
              "description" => __( "Attach your single image.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Link Text", 'juster' ),
                "param_name" => "link_text",
                'value' => '',
                "description" => __( "Enter your link text", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Link", 'juster' ),
                "param_name" => "link",
                'value' => '',
                "description" => __( "Enter your link", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Open New window?", 'juster' ),
                "param_name" => "open_link",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want to open new window, check this.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Intro Text Color", 'juster' ),
                "param_name" => "intro_text_color",
                'value' => '',
                "description" => __( "Pick your intro text color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value'=> '',
                "description" => __( "Pick your heading color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Link Text Color", 'juster' ),
                "param_name" => "link_text_color",
                'value'=> '',
                "description" => __( "Pick your link text color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Intro Text Size", 'juster' ),
                "param_name" => "intro_text_size",
                'value' => '',
                "description" => __( "Enter your intro text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value'=> '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Link Text Size", 'juster' ),
                "param_name" => "link_text_size",
                'value'=> '',
                "description" => __( "Enter your link text size in px. (Eg : 16px).", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
    15. Carousal Slider
=========================================================== */
add_action( 'init', 'carousal_vc_map' );

if ( ! function_exists( 'carousal_vc_map' ) ) {
  function carousal_vc_map() {
    vc_map( array(
        "name" =>"Carousal",
        "base" => "jt_carousal",
        "description" => __( "Clients Styles",'juster'),
        "icon" => "icon-vc-carousal",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "notification_success",
                "heading" => '',
                "param_name" => "to_notify",
                'value' => '',
                "description" => __( "This shortcode is called from : <strong>Appearance > Theme Options > Shotcode > Carousal </strong> <br /> If you need to work this shortcode please add them first on Theme Options.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
                "admin_label" => true,
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Special Text Color", 'juster' ),
                "param_name" => "special_text_color",
                'value' => '',
                "description" => __( "Pick your special text color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value'=> '',
                "description" => __( "Pick your heading color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Special Text Size", 'juster' ),
                "param_name" => "special_text_size",
                'value' => '',
                "description" => __( "Enter your special text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value'=> '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}
/* ==========================================================
    16. Featured Slide
=========================================================== */
add_action( 'init', 'featured_slider_vc_map' );

if ( ! function_exists( 'featured_slider_vc_map' ) ) {
  function featured_slider_vc_map() {
    vc_map( array(
        "name" =>"Featured slider",
        "base" => "jt_featured_slide",
        "description" => __( "Featured slider Styles",'juster'),
        "icon" => "icon-vc-featured-slider",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "notification_success",
                "heading" => '',
                "param_name" => "to_notify",
                'value' => '',
                "description" => __( "This shortcode is called from : <strong>Appearance > Theme Options > Shotcode > Featured Slider </strong> <br /> If you need to work this shortcode please add them first on Theme Options.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Small Title", 'juster' ),
                "param_name" => "small_title",
                'value' => '',
                "description" => __( "Enter your small title", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading", 'juster' ),
                "param_name" => "heading",
                'value'=> '',
                "admin_label"=> true,
                "description" => __( "Enter your heading", 'juster')
            ),
            array(
              "type"=>'attach_image',
              "heading"=>__('Background Image', 'juster'),
              "param_name"=> "bg_image",
              "value"=> "",
              "description" => __( "Attach your background image.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Overlay Image?", 'juster' ),
                "param_name" => "need_overlay",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want overlay image, check this.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Small Title Color", 'juster' ),
                "param_name" => "small_title_color",
                'value'=> '',
                "description" => __( "Pick your small title color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value'=> '',
                "description" => __( "Pick your heading color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value'=> '',
                "description" => __( "Pick your title color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Small Title Size", 'juster' ),
                "param_name" => "small_title_size",
                'value' => '',
                "description" => __( "Enter your small title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value'=> '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value'=> '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
    17. Featured Tabs
=========================================================== */
add_action( 'init', 'featured_tabs_vc_map' );

if ( ! function_exists( 'featured_tabs_vc_map' ) ) {
  function featured_tabs_vc_map() {
    vc_map( array(
        "name" =>"Featured Tabs",
        "base" => "jt_features_tabs",
        "description" => __( "Featured Tabs Styles",'juster'),
        "icon" => "icon-vc-feature-tabs",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "notification_success",
                "heading" => '',
                "param_name" => "to_notify",
                'value' => '',
                "description" => __( "This shortcode is called from : <strong>Appearance > Theme Options > Shotcode > Featured Tabs </strong> <br /> If you need to work this shortcode please add them first on Theme Options.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading", 'juster' ),
                "param_name" => "heading",
                'value'=> '',
                "admin_label"=> true,
                "description" => __( "Enter your heading", 'juster')
            ),
            array(
              "type"=>'attach_image',
              "heading"=>__('Image', 'juster'),
              "param_name"=> "tab_image",
              "value"=> "",
              "description" => __( "Attach your tab image.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Image Hover Effect?", 'juster' ),
                "param_name" => "need_hover",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want image hover effect, check this.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value'=> '',
                "description" => __( "Pick your heading color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value'=> '',
                "description" => __( "Pick your title color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Icon Color", 'juster' ),
                "param_name" => "icon_color",
                'value'=> '',
                "description" => __( "Pick your icon color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Sub Title Color", 'juster' ),
                "param_name" => "short_content_color",
                'value'=> '',
                "description" => __( "Pick your sub title color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Tab Content Color", 'juster' ),
                "param_name" => "long_content_color",
                'value'=> '',
                "description" => __( "Pick your tab content color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Text Color", 'juster' ),
                "param_name" => "button_text_color",
                'value'=> '',
                "description" => __( "Pick your button text color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Border Color", 'juster' ),
                "param_name" => "button_border_color",
                'value'=> '',
                "description" => __( "Pick your button border color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value'=> '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value'=> '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Icon Size", 'juster' ),
                "param_name" => "icon_size",
                'value' => '',
                "description" => __( "Enter your icon size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Sub Title Size", 'juster' ),
                "param_name" => "short_content_size",
                'value'=> '',
                "description" => __( "Enter your sub title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Tab Content Size", 'juster' ),
                "param_name" => "long_content_size",
                'value'=> '',
                "description" => __( "Enter your tab content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Text Size", 'juster' ),
                "param_name" => "button_text_size",
                'value'=> '',
                "description" => __( "Enter your button text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
    18. Blog
=========================================================== */
add_action( 'init', 'blog_vc_map' );

if ( ! function_exists( 'blog_vc_map' ) ) {
  function blog_vc_map() {
    vc_map( array(
        "name" =>"Blog",
        "base" => "jt_blog",
        "description" => __( "Blog Details",'juster'),
        "icon" => "icon-vc-blog",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
             array(
                "type" => "dropdown",
                "heading" => __( "Blog Style", 'juster' ),
                "param_name" => "blog_style",
                "admin_label" => true,
                "value" => array(
                        __('Select Blog Style', 'juster') => '',
                        __('List Style', 'juster') => 'style-1',
                        __('Image Style', 'juster') => 'style-2',
                        __('Grid Style', 'juster') => 'style-3',
                        __('Default Style', 'juster') => 'style-4',
                        __('Masonry Style', 'juster') => 'style-5',
                        __('Grid Content', 'juster') => 'style-6',
                        __('Grid Content + Metas', 'juster') => 'style-7'
                          ),
                "description" => __( "Select blog style.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Column Type", 'juster' ),
                "param_name" => "blog_column_type",
                "value" => array(
                __( '---Select Column Type---','juster') =>'',
                __('One Column', 'juster' ) =>'jt-blog-col-1',
                __('Two Column', 'juster' ) =>'jt-blog-col-2',
                __('Three Column', 'juster' ) =>'jt-blog-col-3',
                __('Four Column', 'juster' ) =>'jt-blog-col-4'
                ),
                'dependency'  => array(
                  'element' => "blog_style",
                  'value'   => "style-4"
                ),
                "admin_label"=> true,
                "description" => __( "Select column type.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Column Type", 'juster' ),
                "param_name" => "masonry_blog_columns",
                "value" => array(
                __( '---Select Column Type---','juster') =>'',
                __('Two Column', 'juster' ) =>'jt-blog-column-two',
                __('Three Column', 'juster' ) =>'jt-blog-column-three',
                ),
                'dependency'  => array(
                  'element' => "blog_style",
                  'value'   => array('style-5')
                ),
                "admin_label"=> true,
                "description" => __( "Select column type.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Column Type", 'juster' ),
                "param_name" => "vintage_blog_columns",
                "value" => array(
                __( '---Select Column Type---','juster') =>'',
                __('Two Column', 'juster' ) =>'jt-vint-blog-column-two',
                __('Three Column', 'juster' ) =>'jt-vint-blog-column-three',
                __('Four Column', 'juster' ) =>'jt-vint-blog-column-four',
                ),
                'dependency'  => array(
                  'element' => "blog_style",
                  'value'   => array('style-6')
                ),
                "admin_label"=> true,
                "description" => __( "Select column type.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Blog Type", 'juster' ),
                "param_name" => "blog_type",
                "admin_label" => true,
                "value" => array(
                        __('Select Blog Type', 'juster')=>'',
                        __('Normal Type', 'juster')=>'style-1',
                        __('Slider Type', 'juster')=>'style-2'
                          ),
                'dependency'  => array(
                  'element' => "blog_style",
                  'value'   => array('style-2','style-3','style-7')
                ),
                "description" => __( "Select blog type.", 'juster')
            ),
            array(
                  "type" => "textfield",
                  "heading" => __( "Blog Post Limit", 'juster' ),
                  "param_name" => "blog_limit",
                  "admin_label" => true,
                  'value' => '',
                  "description" => __( "Enter maximum blogs to show.", 'juster')
            ),
            array(
                  "type" => "textfield",
                  "heading" => __( "Category", 'juster' ),
                  "param_name" => "show_category",
                  'value' => '',
                  "description" => __( "Enter Particular Category To Show. Use Comma To Seperate Categories", 'juster')
            ),
            array(
                  "type" => "textfield",
                  "heading" => __( "Offset", 'juster' ),
                  "param_name" => "blog_offset",
                  'value' => '',
                  "description" => __( "Show Port Offset", 'juster')
            ),
            array(
                  "type" => "dropdown",
                  "heading" => __( "Orderby", 'juster' ),
                  "param_name" => "blog_order_by",
                  "description" => __( "Choose Blog Orderby.", 'juster'),
                  "value" => array(
                    __('None', 'juster') => 'none',
                    __('ID', 'juster') => 'ID',
                    __('Author', 'juster') => 'author',
                    __('Title', 'juster') => 'title',
                    __('Date', 'juster') => 'date',
                  )
            ),
            array(
                  "type" => "dropdown",
                  "heading" => __( "Order", 'juster' ),
                  "param_name" => "blog_order",
                  'value' => '',
                  "description" => __( "Choose Blog Order.", 'juster'),
                  "value" => array(
                    __('Select Blog Order', 'juster')=>'',
                    __('Asending', 'juster') => 'ASC',
                    __('Desending', 'juster') => 'DESC',
                  )
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need pagination?", 'juster' ),
                "param_name" => "blog_pagination",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                  'element' => "blog_type",
                  'value'   => "style-1"
                ),
                "description" => __( "If you want pagination, check this.", 'juster'),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need pagination?", 'juster' ),
                "param_name" => "blog_pagination_two",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                  'element' => "blog_style",
                  'value'   => array('style-4','style-5','style-6')
                ),
                "description" => __( "If you want pagination, check this.", 'juster'),
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Pagination Type?", 'juster' ),
                "param_name" => "blog_style_one",
                "value" => array(
                        __('Select Pagination Type', 'juster')=>'',
                        __('Text', 'juster')=> 'page_text',
                        __('Page Numbers', 'juster')=> 'page_numbers'
                          ),
                'dependency'  => array(
                  'element' => "blog_style",
                  'value'   => array('style-1')
                ),
                "description" => __( "Select blog type.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Link Text", 'juster' ),
                "param_name" => "link_text",
                'value' => '',
                'dependency'  => array(
                  'element' => "blog_style_one",
                  'value'   => array('page_text')
                ),
                "description" => __( "Enter your button text", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Link", 'juster' ),
                "param_name" => "blog_link",
                'value' => '',
                'dependency'  => array(
                  'element' => "blog_style_one",
                  'value'   => array('page_text')
                ),
                "description" => __( "Enter your link", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need pagination?", 'juster' ),
                "param_name" => "blog_pagination_three",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                  'element' => "blog_style_one",
                  'value'   => array('page_numbers')
                ),
                "description" => __( "If you want pagination, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            )
          )
    ) );
  }
}

/* ==========================================================
    19. Service Box
=========================================================== */
add_action( 'init', 'services_vc_map' );

if ( ! function_exists( 'services_vc_map' ) ) {
  function services_vc_map() {
    vc_map( array(
        "name" =>"Service",
        "base" => "jt_service",
        "description" => __( "Service Box Details",'juster'),
        "icon" => "icon-vc-service",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                  "type" => "dropdown",
                  "heading" => __( "Service Styles", 'juster' ),
                  "param_name" => "service_style",
                  'value' => '',
                  "admin_label" => true,
                  "description" => __( "Select your service style.", 'juster'),
                  "value" => array(
                    __('Select Service Style', 'juster') => '',
                    __('Left Icon + Heading + Content', 'juster') => 'style-1',
                    __('Left Circle Icon + Heading + Content', 'juster') => 'style-2',
                    __('Bg Image + Icon + Heading + Content', 'juster') => 'style-3',
                    __('Icon + Heading', 'juster') => 'style-4',
                    __('Icon + Heading + Text - L/R Positions', 'juster') => 'style-5',
                    __('Icon & Content Positions', 'juster') => 'style-6',
                    __('Icon Styling & Content Positions', 'juster') => 'style-7',
                    __('Header + Sub Header + Text on Hover', 'juster') => 'style-8',
                    __('Image Zoom + Heading + Text', 'juster') => 'style-9',
                    __('Heading + Text + Icon Style', 'juster') => 'style-10',
                    __('Heading + Text + Sep Right & Bottom', 'juster') => 'style-11',
                    __('Heading + Text + Plus Icon', 'juster') => 'style-12',
                    __('Image Icon + Heading + Content', 'juster') => 'style-13'
                  )
            ),
            array(
                  "type" => "dropdown",
                  "heading" => __( "Icon Position ", 'juster' ),
                  "param_name" => "icon_position",
                  'value' => '',
                  "description" => __( "Select your icon position.", 'juster'),
                  "value" => array(
                    __('Select Icon Position', 'juster')=>'',
                    __('Left', 'juster') => 'left',
                    __('Right', 'juster') => 'right'
                  ),
                  'dependency'  => array(
                      'element' => "service_style",
                     'value'   => array("style-5","style-11")
                  )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Service Heading", 'juster' ),
                "param_name" => "service_heading",
                'value' => '',
                "admin_label" => true,
                "description" => __( "Enter your service heading", 'juster')
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Service Sub Heading", 'juster' ),
                "param_name" => "service_sub_heading",
                'value' => '',
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-8"
                ),
                "description" => __( "Enter your services sub heading", 'juster')
            ),
            array(
                "type" => "textarea_html",
                "heading" => __( "Service Content", 'juster' ),
                "param_name" => "content",
                'value' => '',
                "description" => __( "Enter your service content", 'juster'),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => array("style-1","style-2","style-3","style-9","style-5","style-6","style-7","style-8","style-10","style-11","style-12","style-13")
                ),
            ),
            array(
                "type"=>'textfield',
                "heading"=>__(' Service Icon', 'juster'),
                "param_name"=> "service_icon",
                'value'=> '',
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => array("style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-10","style-11","style-12")
                ),
                "description" => __("Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
            ),
            array(
                  "type" => "dropdown",
                  "heading" => __( "Icon Type ", 'juster' ),
                  "param_name" => "icon_type",
                  'value' => '',
                  "description" => __( "Select your icon type.", 'juster'),
                  "value" => array(
                    __('Select Icon Type', 'juster')=>'',
                    __('Small', 'juster') => 'small',
                    __('Large', 'juster') => 'large'
                  ),
                  'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-7"
                  )
            ),
            array(
                  "type" => "dropdown",
                  "heading" => __( "Icon Border Style ", 'juster' ),
                  "param_name" => "icon_border_style",
                  'value' => '',
                  "description" => __( "Select your icon type.", 'juster'),
                  "value" => array(
                    __('Select Icon Border Style', 'juster')=>'',
                    __('Square', 'juster') => 'square',
                    __('Circle', 'juster') => 'circle'
                  ),
                  'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-7"
                  )
            ),
            array(
                  "type" => "dropdown",
                  "heading" => __( "Icon Border Style ", 'juster' ),
                  "param_name" => "service_icon_border",
                  'value' => '',
                  "description" => __( "Select your icon type.", 'juster'),
                  "value" => array(
                    __('Select Icon Border Style', 'juster')=>'',
                    __('None', 'juster') => 'none',
                    __('Circle', 'juster') => 'circle',
                    __('Square', 'juster') => 'square',
                  ),
                  'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-10"
                  )
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Seperator?", 'juster' ),
                "param_name" => "need_seperate",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => array("style-7","style-5","style-11"),
                ),
                "description" => __( "If you want seperator, check this.", 'juster'),
            ),
            array(
                  "type" => "checkbox",
                  "heading" => __( "Need Border Bottom?", 'juster' ),
                  "param_name" => "service_border_bottom",
                  'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                  ),
                  'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-11"
                  ),
                  "description" => __( "If you want service border bottom, check this.", 'juster'),
            ),
            array(
                  "type" => "checkbox",
                  "heading" => __( "Need Border Right?", 'juster' ),
                  "param_name" => "service_border_right",
                  'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                   ),
                  'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-11"
                  ),
                  "description" => __( "If you want service border right, check this.", 'juster'),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Learn More Text?", 'juster' ),
                "param_name" => "need_learn_more",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => array('style-3','style-7','style-8','style-10')
                ),
                "description" => __( "If you want learn more text, check this.", 'juster'),
            ),
            array(
                "type"=>'textfield',
                "heading"=>__('Learn More Text', 'juster'),
                "param_name"=> "learn_more_text",
                'value'=> '',
                "description" => __( "Enter your link text", 'juster'),
                'dependency'  => array(
                'element' => "need_learn_more",
                'value'   => 'yes'
                )
            ),
            array(
                "type"=>'textfield',
                "heading"=>__('Learn More Link', 'juster'),
                "param_name"=> "learn_more_link",
                'value'=> '',
                "description" => __( "Enter your link", 'juster'),
                'dependency'  => array(
                'element' => "need_learn_more",
                'value'   => 'yes'
                )
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Icon Border?", 'juster' ),
                "param_name" => "need_icon_border",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-7"
                ),
                "description" => __( "If you want icon border, check this.", 'juster'),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Icon Hover Effect", 'juster' ),
                "param_name" => "need_hover",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => array("style-7","style-5")
                ),
                "description" => __( "If you want hover icon effect, check this.", 'juster'),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Hover Plus Icon", 'juster' ),
                "param_name" => "need_hover_plus",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-12"
                ),
                "description" => __( "If you want hover plus icon, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Hover Plus Icon Link", 'juster' ),
                "param_name" => "hover_plus_icon_link",
                'value' => '',
                'dependency'  => array(
                      'element' => "need_hover_plus",
                     'value'   => "yes"
                ),
                "description" => __( "Enter your hover plus icon link", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Background Image', 'juster'),
                "param_name"=> "service_bg_image",
                'value'=> '',
                "description" => __( "Select service bg image", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => "style-3"
                )
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Icon Image', 'juster'),
                "param_name"=> "service_icon_image",
                'value'=> '',
                "description" => __( "Select service icon image", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => "style-13"
                )
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Right Seperator?", 'juster' ),
                "param_name" => "need_right_seperate",
                'value'     => array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                ),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-13"
                ),
                "description" => __( "If you want right seperator, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Service Content Height", 'juster' ),
                "param_name" => "service_content_height",
                'value' => '',
                "description" => __( "Enter your service content height in px. (Eg : 300px)", 'juster'),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => "style-8"
                )
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Service Image', 'juster'),
                "param_name"=> "service_image",
                'value'=> '',
                "description" => __( "Select service image", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => "style-9"
                )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color Tab
            array(
                "type" => "colorpicker",
                "heading" => __("Service Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value' => '',
                "description" => __( "Pick your service heading color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Service Sub Heading Color", 'juster' ),
                "param_name" => "sub_heading_color",
                'value' => '',
                "description" => __( "Pick your service sub heading color", 'juster'),
                'dependency'  => Array(
                      'element' => "service_style",
                     'value'   => "style-8"
                ),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Service Icon Color", 'juster' ),
                "param_name" => "icon_color",
                'value' => '',
                "description" => __( "Pick your service icon color", 'juster'),
                'dependency'  => array(
                      'element' => "service_style",
                      'value'   => array("style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-10","style-11","style-12")
                ),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Service Icon Border Color", 'juster' ),
                "param_name" => "icon_border_color",
                'value' => '',
                "description" => __( "Pick your service icon border color", 'juster'),
                "group" => __( "Color", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => array('style-3','style-7')
                )
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Service Background Color", 'juster' ),
                "param_name" => "service_bg_color",
                'value' => '',
                "description" => __( "Pick your service Bg border color", 'juster'),
                "group" => __( "Color", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => array('style-12')
                )
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Learn More Text Color", 'juster' ),
                "param_name" => "learn_more_color",
                'value' => '',
                "description" => __( "Pick your learn more text color", 'juster'),
                "group" => __( "Color", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => array('style-3','style-7','style-8','style-10')
                )
            ),

            // Sizes
            array(
                "type" => "textfield",
                "heading" => __( "Service Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value' => '',
                "description" => __( "Enter your service heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Service Sub Heading Size", 'juster' ),
                "param_name" => "sub_heading_size",
                'value' => '',
                "description" => __( "Enter your service sub heading size in px. (Eg : 16px)", 'juster'),
                'dependency'  => Array(
                      'element' => "service_style",
                     'value'   => "style-8"
                ),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Service Icon Size", 'juster' ),
                "param_name" => "icon_size",
                'value' => '',
                "description" => __( "Enter your service icon size in px. (Eg : 16px)", 'juster'),
                'dependency'  => array(
                      'element' => "service_style",
                     'value'   => array("style-1","style-2","style-3","style-4","style-5","style-6","style-7","style-8","style-10","style-11","style-12")
                ),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Learn More Text Size", 'juster' ),
                "param_name" => "learn_more_size",
                'value' => '',
                "description" => __( "Enter your learn more text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => array('style-3','style-7','style-8','style-10')
                )
            ),

            // Link
            array(
                "type" => "textfield",
                "heading" => __( "Service Heading", 'juster' ),
                "param_name" => "services_link",
                'value' => '',
                "description" => __( "Enter your link for this service. Mostly, link will aplied in that service heading.", 'juster'),
                "group" => __( "Link", 'juster'),
                'dependency'  => array(
                'element' => "service_style",
                'value'   => array('style-1','style-2','style-4','style-5','style-6','style-9','style-11','style-13')
                )
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Open New window?", 'juster' ),
                "param_name" => "open_link",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "group" => __( "Link", 'juster'),
                'dependency'  => array(
                  'element' => "service_style",
                'value'   => array('style-1','style-2','style-4','style-5','style-6','style-9','style-11','style-13')
                ),
                "description" => __( "If you want to open new window, check this.", 'juster'),
            ),

          )
    ) );
  }
}

/* ==========================================================
    20.Testimonials
=========================================================== */
add_action( 'init', 'testmonials_vc_map' );

if ( ! function_exists( 'testmonials_vc_map' ) ) {
  function testmonials_vc_map() {
    vc_map( array(
        "name" =>"Testmonials",
        "base" => "jt_testimonials",
        "description" => __( "Testimonial Details",'juster'),
        "icon" => "icon-vc-testimonials",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "textfield",
                "heading" => __( "Testimonial Limit", 'juster' ),
                "param_name" => "testimonial_limit",
                'value' => '',
                "admin_label" => true,
                "description" => __( "Enter testimonial limit", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Testimonial Style", 'juster' ),
                "param_name" => "testimonial_style",
                "admin_label" => true,
                "value" => array(
                  __('Select Testimonial Style', 'juster')=>'',
                  __('Fade Effect + Image + Right Content', 'juster') => 'style1',
                  __('No Arrow + Center Content', 'juster') => 'style2',
                  __('(Arrow + Numer) + Content', 'juster') => 'style3',
                  __('Arrow + Content', 'juster') => 'style4',
                  __('(Arrow + Numer) + Content + Vintage Style', 'juster') => 'style5',
                  __('Verticle Navigation', 'juster') => 'style6'
                ),
                "description" => __( "Select testimonial style.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Rating Type", 'juster' ),
                "param_name" => "rating_type",
                "admin_label" => true,
                "value" => array(
                  __('Select Rating Type', 'juster')=>'',
                  __('Star', 'juster') => 'star',
                  __('Heart', 'juster') => 'heart'
                ),
                "description" => __( "Select rating type.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Short Title", 'juster' ),
                "param_name" => "short_title",
                'value' => '',
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1','style2','style3','style5','style6')
                ),
                "description" => __( "Enter your testimonial short title.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Short Title Link", 'juster' ),
                "param_name" => "short_title_link",
                'value' => '',
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1','style2','style3','style5','style6')
                ),
                "description" => __( "Enter your testimonial short title link.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading", 'juster' ),
                "param_name" => "testimonial_heading",
                'value' => '',
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1','style2','style3','style5','style6')
                ),
                "description" => __( "Enter your testimonial heading.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Open New window?", 'juster' ),
                "param_name" => "open_link",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1')
                ),
                "description" => __( "If you want to open new window, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color Tab
            array(
                "type" => "colorpicker",
                "heading" => __("Short Title Color", 'juster' ),
                "param_name" => "short_title_color",
                'value' => '',
                "description" => __( "Pick your short title color", 'juster'),
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1','style2','style3','style5','style6')
                ),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value' => '',
                "description" => __( "Pick your heading color", 'juster'),
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1','style2','style3','style5','style6')
                ),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Content Color", 'juster' ),
                "param_name" => "content_color",
                'value' => '',
                "description" => __( "Pick your content color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Name Color", 'juster' ),
                "param_name" => "name_color",
                'value' => '',
                "description" => __( "Pick your name color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Profession Color", 'juster' ),
                "param_name" => "profession_color",
                'value' => '',
                "description" => __( "Pick your profession color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __("Rating Icon Color", 'juster' ),
                "param_name" => "rate_icon_color",
                'value' => '',
                "description" => __( "Pick your rate icon color", 'juster'),
                "group" => __( "Color", 'juster')
            ),

            // Sizes
            array(
                "type" => "textfield",
                "heading" => __( "Short Title Size", 'juster' ),
                "param_name" => "short_title_size",
                'value' => '',
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1','style2','style3','style5','style6')
                ),
                "description" => __( "Enter your short title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value' => '',
                'dependency'  => array(
                  'element' => "testimonial_style",
                  'value'   => array('style1','style2','style3','style5','style6')
                ),
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value' => '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Line Height", 'juster' ),
                "param_name" => "content_line_height",
                'value' => '',
                "description" => __( "Enter your content line height in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Name Size", 'juster' ),
                "param_name" => "name_size",
                'value' => '',
                "description" => __( "Enter your name size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Profession Size", 'juster' ),
                "param_name" => "profession_size",
                'value' => '',
                "description" => __( "Enter your profession text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Rating Icon Size", 'juster' ),
                "param_name" => "rate_icon_size",
                'value' => '',
                "description" => __( "Enter your rate icon size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
   21.Alert Message
=========================================================== */
add_action( 'init', 'alert_vc_map' );

if ( ! function_exists( 'alert_vc_map' ) ) {
  function alert_vc_map() {
    vc_map( array(
        "name" => __('Alert Message', 'juster'),
        "base" => "jt_alert",
        "description" => __('Alert Message', 'juster'),
        "icon" => "icon-vc-alert",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General
            array(
              "type" => "dropdown",
              "heading" => __( "Alert Type", 'juster' ),
              "param_name" => "alert_type",
              'value' => array(
                __('Select Alert Type', 'juster')=>'',
                __( 'Success','juster') =>'alert-success',
                __( 'Information','juster') =>'alert-information',
                __( 'Warning','juster') =>'alert-warning',
                __( 'Error','juster') =>'alert-error'
              ),
              "admin_label" => true,
              "description" => __( "Select your alert type.", 'juster'),
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Alert Strong Text', 'juster'),
              "param_name"=> "alert_strong_text",
              "value" => "",
              "description" => __( "Enter your alert strong text.", 'juster')
            ),
            array(
              "type"=>'textfield',
              "heading"=>__('Alert Text', 'juster'),
              "param_name"=> "alert_text",
              "value" => "",
              "description" => __( "Enter your alert text.", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Alert Icon", 'juster' ),
              "param_name" => "alert_icon",
              'value' => "",
              "description" => __( "Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Extra class name", 'juster' ),
              "param_name" => "class",
              'value' => '',
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Need Bg Filled?', 'juster'),
              "param_name"=> "need_bg",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              "description" => __( "If you want bg filled color check this.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Need Close Icon?', 'juster'),
              "param_name"=> "need_close_icon",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              "description" => __( "If you want close icon check this.", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
   22.Tables
=========================================================== */
add_action( 'init', 'tables_vc_map' );

if ( ! function_exists( 'tables_vc_map' ) ) {
  function tables_vc_map() {
    vc_map( array(
        "name" =>"Tables",
        "base" => "jt_table",
        "description" => "Table Details",
        "icon" => "icon-vc-table",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
             array(
                "type" => "dropdown",
                "heading" => __( "Table Style", 'juster' ),
                "param_name" => "table_style",
                "value" => array(
                  __('Select Table Style', 'juster')=>'',
                  __('Style One', 'juster') => 'table-normal',
                  __('Style Two', 'juster') => 'table-striped'
                ),
                "admin_label" => true,
                "description" => __( "Select table style", 'juster'),
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Table Row Title", 'juster' ),
                "param_name" => "row_title",
                'value' => '',
                "description" => __( "Enter your table row title.Each title seperated by [ | ] .", 'juster')
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Table Data", 'juster' ),
                "param_name" => "table_data",
                'value' => '',
                "description" => __( "Enter your table data.Each title seperated by [ | ] .", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color Tab
            array(
                "type" => "colorpicker",
                "heading" => __("Row Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Table Data Text Color", 'juster' ),
                "param_name" => "data_color",
                'value' => '',
                "description" => __( "Pick your table data color", 'juster'),
                "group" => __( "Color", 'juster')
            ),

            // Sizes
            array(
                "type" => "textfield",
                "heading" => __( "Row Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px.(Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Table Data Text Size", 'juster' ),
                "param_name" => "data_size",
                'value' => '',
                "description" => __( "Enter your table data text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
  23.Progress Bar
=========================================================== */
add_action( 'init', 'progress_bar_vc_map' );

if ( ! function_exists( 'progress_bar_vc_map' ) ) {
  function progress_bar_vc_map() {
    vc_map( array(
        "name" =>"Progress Bar",
        "base" => "jt_progress_bar",
        "description" => __( "Progress Bar Details",'juster'),
        "icon" => "icon-vc-piechart",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "textfield",
                "heading" => __( "Title", 'juster' ),
                "param_name" => "title",
                'value' => '',
                "admin_label" => true,
                "description" => __( "Enter your title.", 'juster')
            ),

            array(
                "type" => "dropdown",
                "heading" => __( "Size", 'juster' ),
                "param_name" => "chart_size",
                "value" => array(
                  __('Select Circle Size', 'juster')=>'',
                  __('Small', 'juster')=>'small',
                  __('Medium', 'juster')=>'medium',
                  __('Large', 'juster')=>'large',
                ),
                "description" => __( "Select your circle size. <br /><span class='jt-dependent-notify'><strong>Note : </strong>This size's will affect all progress bars in a page. So, you can able to choose different sizes in different pages only.</span>", 'juster')
            ),

            array(
                "type" => "textfield",
                "heading" => __( "Percentage", 'juster' ),
                "param_name" => "percentage",
                'value' => '',
                "description" => __( "Enter your percentage with % symbol", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "extra_class",
                'value' => '',
            ),

            // Color Tab
            array(
                "type" => "colorpicker",
                "heading" => __("Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Percentage Color", 'juster' ),
                "param_name" => "percentage_color",
                'value' => '',
                "description" => __( "Pick your percentage color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Percentage Bg Color", 'juster' ),
                "param_name" => "percentage_bg_color",
                'value' => '',
                "description" => __( "Pick your percentage bg color", 'juster'),
                "group" => __( "Color", 'juster')
            ),

            // Sizes
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Percentage Size", 'juster' ),
                "param_name" => "percentage_size",
                'value' => '',
                "description" => __( "Enter your percentage size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Text Transform", 'juster' ),
                "param_name" => "text_transform",
                "value" => array(
                  __('Select Text Transform', 'juster')=>'',
                  __('Uppercase', 'juster')=>'uppercase',
                  __('Lowercase', 'juster')=>'lowercase',
                  __('Capitalize', 'juster')=>'capitalize',
                ),
                "description" => __( "Select your text transform .", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
   24.Feature Box
=========================================================== */
add_action( 'init', 'feature_box_vc_map' );
if ( ! function_exists( 'feature_box_vc_map' ) ) {
  function feature_box_vc_map() {
    vc_map( array(
        "name" =>"Feature Box",
        "base" => "jt_feature_box",
        "description" => "Feature Box",
        "icon" => "icon-vc-feature-box",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
              "type"=>'textfield',
              "heading"=>__('Title', 'juster'),
              "param_name"=> "feature_box_title",
              "value"=> "",
              "admin_label"=> true,
              "description" => __( "Enter your title.", 'juster')
            ),
            array(
              "type"=>'textarea',
              "heading"=>__('Content', 'juster'),
              "param_name"=> "feature_box_content",
              "value"=> "",
              "description" => __( "Enter your content", 'juster')
            ),
             array(
                "type"=>'attach_image',
                "heading"=>__('Bg Image', 'juster'),
                "param_name"=> "bg_image",
                'value'=> '',
                "description" => __( "Select your bg image", 'juster'),
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Bg Image effect?", 'juster' ),
                "param_name" => "bg_image_effect",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want bg image effect, check this.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            // Design
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Design", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color .", 'juster'),
                 "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value' => '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Design", 'juster')
            ),

            // Spacing
            array(
                "type" => "textfield",
                "heading" => __( "Inner Box Top Value", 'juster' ),
                "param_name" => "inner_top",
                'value' => '',
                "description" => __( "Enter your top value in px. (Eg : 16px)", 'juster'),
                "group" => __( "Spacing", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Inner Padding Value", 'juster' ),
                "param_name" => "inner_padding",
                'value'=> '',
                "description" => __( "Enter your padding value in px. (Eg : 16px)", 'juster'),
                "group" => __( "Spacing", 'juster')
            )
          )
    ) );
  }
}

/* ==========================================================
    25. Icon Tabs
=========================================================== */
add_action( 'init', 'icon_tab_vc_map' );

if ( ! function_exists( 'icon_tab_vc_map' ) ) {
  function icon_tab_vc_map() {
    vc_map( array(
        "name" =>"Icon Tabs",
        "base" => "jt_icon_tabs",
        "description" => __( "Icon Tabs",'juster'),
        "icon" => "icon-vc-icon-tabs",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "notification_success",
                "heading" => '',
                "param_name" => "to_notify",
                'value' => '',
                "description" => __( "This shortcode is called from : <strong>Appearance > Theme Options > Shotcode > Icon Tabs </strong> <br /> If you need to work this shortcode please add them first on Theme Options.", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
                "admin_label"=> true,
            ),
          )
    ) );
  }
}

/* ==========================================================
   26.Awards
=========================================================== */
add_action( 'init', 'awards_vc_map' );
if ( ! function_exists( 'awards_vc_map' ) ) {
  function awards_vc_map() {
    vc_map( array(
        "name" =>"Awards",
        "base" => "jt_awards",
        "description" => "Awards Styles",
        "icon" => "icon-vc-awards",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
              "type"=>'textarea',
              "heading"=>__('Award Title', 'juster'),
              "param_name"=> "award_title",
              "value"=> "",
              "admin_label"=> true,
              "description" => __( "Enter your award title.", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Award Image', 'juster'),
                "param_name"=> "award_image",
                'value'=> '',
                "description" => __( "Select your award image", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Award Link", 'juster' ),
                "param_name" => "award_link",
                'value'=>'',
                "description" => __("Enter your award link.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            // Design
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Design", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Design", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
   27. Simple Slider
=========================================================== */
add_action( 'init', 'simpleslide_vc_map' );
if ( ! function_exists( 'simpleslide_vc_map' ) ) {
  function simpleslide_vc_map() {
    vc_map( array(
        "name" =>"Simple Slide",
        "base" => "jt_simple_slide",
        "description" => "Simple Slide Styles",
        "icon" => "icon-vc-simple-slide",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
                "type" => "dropdown",
                "heading" => __( "Slider Style", 'juster' ),
                "param_name" => "slider_style",
                "value" => array(
                  __('Select Slider Style', 'juster')=>'',
                  __('Style One', 'juster')=>'style-one',
                  __('Style Two', 'juster')=>'style-two',
                  __('Style Three', 'juster')=>'style-three'
                ),
                "admin_label"=> true,
                "description" => __( "Select your slider style .", 'juster')
            ),
            array(
              "type"=>'attach_images',
              "heading"=>__('Slide Images', 'juster'),
              "param_name"=> "simple_slide_img",
              "value"=> "",
              "description" => __( "Attach more than one images.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),
          )
    ) );
  }
}

/* ==========================================================
   28. Products
=========================================================== */
add_action( 'init', 'jt_products_vc_map' );
if ( ! function_exists( 'jt_products_vc_map' ) ) {
  function jt_products_vc_map() {
    vc_map( array(
        "name" => __('Products', 'juster'),
        "base" => "jt_products",
        "description" => "WooCommerce Products",
        "icon" => "icon-vc-product",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            array(
                "type" => "dropdown",
                "heading" => __( "Type", 'juster' ),
                "param_name" => "jt_product_type",
                "value" => array(
                            "Select Type"=>'',
                            "Default"=>'type-1',
                            "Group Carousal"=>'type-2',
                            "Normal Carousal"=>'type-3'
                          ),
                "admin_label" => true,
                "description" => __( "Select product type.", 'juster')
            ),
            array(
              "type" => 'textfield',
              "heading" => __('Limit', 'juster'),
              "param_name" => "jt_products_limit",
              "value" => "",
              "admin_label" => true,
              "description" => __( "Enter your productss limit per page.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order", 'juster' ),
                "param_name" => "jt_products_order",
                "value" => array(
                            "Select Order"=>'',
                            "Ascending"=>'ASC',
                            "Descending"=>'DESC'
                          ),
                "description" => __( "Select products order.", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Order By", 'juster' ),
                "param_name" => "jt_products_order_by",
                "value" => array(
                            "Select OrderBy"=>'',
                            "none"=>'none',
                            "ID"=>'ID',
                            "Author"=>'author',
                            "Title"=>'title',
                            "Name"=>'name',
                            "Type"=>'type',
                            "Date"=>'date',
                            "Modified"=>'modified',
                            "Rand"=>'rand'
                          ),
                "description" => __( "Select products orderby.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Offset", 'juster' ),
                "param_name" => "port_offset",
                'value'=>'',
                "description" => __( "Enter a number to offset products.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Show only certain categories?", 'juster' ),
                "param_name" => "show_category",
                'value'=>'',
                "description" => __( "Only one category must be enter.", 'juster')
            ),
            array(
              "type"=>'checkbox',
              "heading"=>__('Enable Pagination', 'juster'),
              "param_name"=> "enable_pagination",
              'value'     => Array(
                __( 'Yes please.', 'juster' ) => 'yes'
              ),
              'dependency'  => array(
                'element' => "jt_product_type",
                'value'   => "type-1"
              ),
              "description" => __( "If you want pagination please check this.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "extra_class",
                'value'=>'',
                "description" => __( "Custom styled class name", 'juster')
            ),

          )
    ) );
  }
}
/* ==========================================================
    29. Shop Offers
=========================================================== */
add_action( 'init', 'shop_offer_vc_map' );

if ( ! function_exists( 'shop_offer_vc_map' ) ) {
  function shop_offer_vc_map() {
    vc_map( array(
        "name" =>"Shop Offer",
        "base" => "jt_shop_offer",
        "description" => __("Shop Offer Details",'juster'),
        "icon" => "icon-vc-shop-offer",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "dropdown",
                "heading" => __( "Offer Styles", 'juster' ),
                "param_name" => "jt_offer_styles",
                "value" => array(
                      "Select Offer Style" =>'',
                      "Offer One" => 'style-1',
                      "Offer Two" => 'style-2',
                      "Offer Three" => 'style-3'
                ),
                "description" => __( "Select Offer Style.", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Shop Offer Bg Image', 'juster'),
                "param_name"=> "shop_offer_bg_image",
                'value'=> '',
                "description" => __( "Select shop offer bg image", 'juster'),
            ),
             array(
                "type" => "textfield",
                "heading" => __( "Title", 'juster' ),
                "param_name" => "jt_offer_title",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => array('style-1','style-3')
                ),
                "description" => __( "Enter your title.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Sub Title", 'juster' ),
                "param_name" => "jt_offer_sub_title",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => array('style-1','style-3')
                ),
                "description" => __( "Enter your subtitle .", 'juster')
            ),
            array(
                "type"=>'attach_image',
                "heading"=>__('Offer Image', 'juster'),
                "param_name"=> "jt_offer_image",
                'value'=> '',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => "style-1"
                ),
                "description" => __( "Select offer image", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Special Text", 'juster' ),
                "param_name" => "jt_offer_special_text",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => 'style-3'
                ),
                "description" => __( "Enter your special text .", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Special Text Link", 'juster' ),
                "param_name" => "jt_offer_special_link",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => 'style-3'
                ),
                "description" => __( "Enter your special text link.", 'juster')
            ),
             array(
                "type" => "textfield",
                "heading" => __( "Offer Text", 'juster' ),
                "param_name" => "jt_offer_text",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => array('style-1','style-3')
                ),
                "description" => __( "Enter your offer text.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Offer Link", 'juster' ),
                "param_name" => "jt_offer_link",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => array('style-1','style-3')
                ),
                "description" => __( "Enter your offer text or value.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button One Text", 'juster' ),
                "param_name" => "jt_button_one_text",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => 'style-2'
                ),
                "description" => __( "Enter your button one text.", 'juster')
            ),
             array(
                "type" => "textfield",
                "heading" => __( "Button One Link", 'juster' ),
                "param_name" => "jt_button_one_link",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => 'style-2'
                ),
                "description" => __( "Enter your button one link.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Two Text", 'juster' ),
                "param_name" => "jt_button_two_text",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => 'style-2'
                ),
                "description" => __( "Enter your button two text.", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Two Link", 'juster' ),
                "param_name" => "jt_button_two_link",
                'value'=>'',
                'dependency'  => array(
                  'element' => "jt_offer_styles",
                  'value'   => 'style-2'
                ),
                "description" => __( "Enter your button two link.", 'juster')
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Extra class name", 'juster' ),
              "param_name" => "extra_class",
              'value'=>'',
              "admin_label" => true,
              "description" => __( "Custom styled class name", 'juster')
          ),
          )
    ) );
  }
}

/* ==========================================================
    30. Under Construction
=========================================================== */
add_action( 'init', 'uc_vc_map' );

if ( ! function_exists( 'uc_vc_map' ) ) {
  function uc_vc_map() {
    vc_map( array(
        "name" =>"Under Construction",
        "base" => "jt_underconstruction",
        "description" => __("Under construction timer",'juster'),
        "icon" => "icon-vc-process",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "textfield",
                "heading" => __( "Set a date", 'juster' ),
                "param_name" => "jt_uc_date",
                'value'=>'',
                "description" => __( "Enter your site launch date. Example : October 30, 2015", 'juster')
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Values Format", 'juster' ),
                "param_name" => "jt_values_format",
                "value" => array(
                      "Select Values Format" =>'',
                      "Weeks + Days + Hours" => 'jt-week-day-hour',
                      "Days + Hours + Minutes" => 'jt-day-hour-minute',
                      "Hours + Minutes + Seconds" => 'jt-hour-minute-sec'
                ),
                "description" => __( "Select Values Format.", 'juster')
            ),
            // Texts
            array(
              "type" => "textfield",
              "heading" => __( "Week Text", 'juster' ),
              "param_name" => "jt_week_text",
              'value' => '',
              "description" => __( "Enter your week text.", 'juster'),
              'dependency'  => array(
                'element' => "jt_values_format",
                'value'   => 'jt-week-day-hour'
              ),
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Day Text", 'juster' ),
              "param_name" => "jt_day_text",
              'value' => '',
              "description" => __( "Enter your day text.", 'juster'),
              'dependency'  => array(
                'element' => "jt_values_format",
                'value'   => array('jt-week-day-hour','jt-day-hour-minute')
              ),
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Hour Text", 'juster' ),
              "param_name" => "jt_hour_text",
              'value' => '',
              "description" => __( "Enter your hour text.", 'juster'),
              'dependency'  => array(
                'element' => "jt_values_format",
                'value'   => array('jt-week-day-hour','jt-day-hour-minute','jt-hour-minute-sec')
              ),
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Minute Text", 'juster' ),
              "param_name" => "jt_minute_text",
              'value' => '',
              "description" => __( "Enter your minute text.", 'juster'),
              'dependency'  => array(
                'element' => "jt_values_format",
                'value'   => array('jt-day-hour-minute','jt-hour-minute-sec')
              ),
            ),
            array(
              "type" => "textfield",
              "heading" => __( "Seconds Text", 'juster' ),
              "param_name" => "jt_seconds_text",
              'value' => '',
              "description" => __( "Enter your seconds text.", 'juster'),
              'dependency'  => array(
                'element' => "jt_values_format",
                'value'   => 'jt-hour-minute-sec'
              ),
            ),
            // End Texts
            array(
              "type" => "textfield",
              "heading" => __( "Extra class name", 'juster' ),
              "param_name" => "extra_class",
              'value'=>'',
              "admin_label" => true,
              "description" => __( "Custom styled class name", 'juster')
          ),

          // Notification
          array(
            "type" => "textfield",
            "heading" => __( "Heading", 'juster' ),
            "param_name" => "jt_notify_heading",
            'value' => '',
            "description" => __( "Enter your heading", 'juster'),
            "group" => __( "Notification", 'juster')
          ),
          array(
            "type" => "textfield",
            "heading" => __( "Sub Content", 'juster' ),
            "param_name" => "jt_sub_content",
            'value' => '',
            "description" => __( "Enter sub content", 'juster'),
            "group" => __( "Notification", 'juster')
          ),
          array(
            "type" => "textfield",
            "heading" => __( "Button Text", 'juster' ),
            "param_name" => "jt_btn_txt",
            'value' => '',
            "description" => __( "Enter your button text", 'juster'),
            "group" => __( "Notification", 'juster')
          ),
          array(
            "type" => "dropdown",
            "heading" => __( "Button Link Type", 'juster' ),
            "param_name" => "jt_link_type",
            "value" => array(
              "Select link type" => '',
              "Direct Link" => 'direct_link',
              "Switchover Content" => 'switchover_content',
            ),
            "description" => __( "Select link type.", 'juster'),
            "group" => __( "Notification", 'juster')
          ),
          array(
            "type" => "textfield",
            "heading" => __( "Link", 'juster' ),
            "param_name" => "jt_btn_link",
            'value' => '',
            "description" => __( "Enter your button link", 'juster'),
            'dependency'  => array(
              'element' => "jt_link_type",
              'value'   => "direct_link"
            ),
            "group" => __( "Notification", 'juster')
          ),

          // Switchover Content
          array(
            "type" => "textfield",
            "heading" => __( "Heading", 'juster' ),
            "param_name" => "jt_switch_heading",
            'value' => '',
            "description" => __( "Enter your heading", 'juster'),
            'dependency'  => array(
              'element' => "jt_link_type",
              'value'   => "switchover_content"
            ),
            "group" => __( "Switchover", 'juster')
          ),
          array(
            "type" => "textfield",
            "heading" => __( "Sub Content", 'juster' ),
            "param_name" => "jt_switch_content",
            'value' => '',
            "description" => __( "Enter sub content", 'juster'),
            'dependency'  => array(
              'element' => "jt_link_type",
              'value'   => "switchover_content"
            ),
            "group" => __( "Switchover", 'juster')
          ),
          array(
                "type" => "checkbox",
                "heading" => __( "Need MailChimp Subscribe Form?", 'juster' ),
                "param_name" => "jt_subscribe_shortcode",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you need mailchimp subscribe form, check this.", 'juster'),
                'dependency'  => array(
                    'element' => "jt_link_type",
                    'value'   => "switchover_content"
                  ),
                  "group" => __( "Switchover", 'juster')
            ),
          array(
            "type" => "textfield",
            "heading" => __( "Back to link text", 'juster' ),
            "param_name" => "jt_switch_link_txt",
            'value' => '',
            "description" => __( "Enter your back to link text.", 'juster'),
            'dependency'  => array(
              'element' => "jt_link_type",
              'value'   => "switchover_content"
            ),
            "group" => __( "Switchover", 'juster')
          ),

        )

    ) );
  }
}

/**
 * Gmap - Shortcode Options - From 2
 */
add_action( 'init', 'jstr_gmap_vc_map' );
if ( ! function_exists( 'jstr_gmap_vc_map' ) ) {
  function jstr_gmap_vc_map() {
    vc_map( array(
      "name" => __( "Gmap 2", 'juster'),
      "base" => "jstr_gmap",
      "description" => __( "Google Map Styles", 'juster'),
      "icon" => "icon-vc-gmap",
      "category" => __( 'Juster', 'juster' ),
      "params" => array(

        array(
          "type"        => "notice",
          "heading"     => __( "API KEY", 'juster' ),
          "param_name"  => 'api_key',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Enter your Google Map API Key', 'juster'),
          "param_name"  => "gmap_api",
          "value"       => "",
          "description" => __( 'New Google Maps usage policy dictates that everyone using the maps should register for a free API key. <br />Please create a key for "Google Static Maps API" and "Google Maps Embed API" using the <a href="https://console.developers.google.com/project" target="_blank">Google Developers Console</a>.<br /> Or follow this step links : <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=maps_embed_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">1. Step One</a> <br /><a href="https://console.developers.google.com/flows/enableapi?apiid=static_maps_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">2. Step Two</a><br /> If you still receive errors, please check following link : <a href="https://churchthemes.com/2016/07/15/page-didnt-load-google-maps-correctly/" target="_blank">How to Fix?</a>', 'juster'),
        ),

        array(
          "type"        => "notice",
          "heading"     => __( "Map Settings", 'juster' ),
          "param_name"  => 'map_settings',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Google Map Type', 'juster' ),
          'value' => array(
            __( 'Select Type', 'juster' ) => '',
            __( 'ROADMAP', 'juster' ) => 'ROADMAP',
            __( 'SATELLITE', 'juster' ) => 'SATELLITE',
            __( 'HYBRID', 'juster' ) => 'HYBRID',
            __( 'TERRAIN', 'juster' ) => 'TERRAIN',
          ),
          'admin_label' => true,
          'param_name' => 'gmap_type',
          'description' => __( 'Select your google map type.', 'juster' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Google Map Style', 'juster' ),
          'value' => array(
            __( 'Select Style', 'juster' ) => '',
            __( 'Gray Scale', 'juster' ) => "gray-scale",
            __( 'Mid Night', 'juster' ) => "mid-night",
            __( 'Blue Water', 'juster' ) => 'blue-water',
            __( 'Light Dream', 'juster' ) => 'light-dream',
            __( 'Pale Dawn', 'juster' ) => 'pale-dawn',
            __( 'Apple Maps-esque', 'juster' ) => 'apple-maps',
            __( 'Blue Essence', 'juster' ) => 'blue-essence',
            __( 'Unsaturated Browns', 'juster' ) => 'unsaturated-browns',
            __( 'Paper', 'juster' ) => 'paper',
            __( 'Midnight Commander', 'juster' ) => 'midnight-commander',
            __( 'Light Monochrome', 'juster' ) => 'light-monochrome',
            __( 'Flat Map', 'juster' ) => 'flat-map',
            __( 'Retro', 'juster' ) => 'retro',
            __( 'becomeadinosaur', 'juster' ) => 'becomeadinosaur',
            __( 'Neutral Blue', 'juster' ) => 'neutral-blue',
            __( 'Subtle Grayscale', 'juster' ) => 'subtle-grayscale',
            __( 'Ultra Light with Labels', 'juster' ) => 'ultra-light-labels',
            __( 'Shades of Grey', 'juster' ) => 'shades-grey',
          ),
          'admin_label' => true,
          'param_name' => 'gmap_style',
          'description' => __( 'Select your google map style.', 'juster' ),
          'dependency' => array(
            'element' => 'gmap_type',
            'value' => 'ROADMAP',
          ),
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Height', 'juster'),
          "param_name"  => "gmap_height",
          "value"       => "",
          "description" => __( "Enter the px value for map height. Eg : 400px", 'juster'),
        ),
        array(
          "type"        =>'attach_image',
          "heading"     =>__('Common Marker', 'juster'),
          "param_name"  => "gmap_common_marker",
          "value"       => "",
          "description" => __( "Upload custom marker, if you want to change the default one.", 'juster'),
        ),
        array(
          "type"        =>'textfield',
          "heading"     =>__('Zoom', 'juster'),
          "param_name"  => "gmap_zoom",
          "value"       => "",
          "description" => __( "Enter zoom as numeric value. [Eg : 18]", 'juster'),
        ),

        array(
          "type"        => "notice",
          "heading"     => __( "Enable & Disable", 'juster' ),
          "param_name"  => 'enb_disb',
          'class'       => 'cs-info',
          'value'       => '',
        ),
        array(
          "type"        =>'checkbox',
          "heading"     =>__('Scroll Wheel', 'juster'),
          "param_name"  => "gmap_scroll_wheel",
          "value"     => Array(
            __( 'Yes, Please.', 'juster' ) => 'yes'
          ),
        ),
        array(
          "type"        =>'checkbox',
          "heading"     =>__('Street View Control', 'juster'),
          "param_name"  => "gmap_street_view",
          "value"     => Array(
            __( 'Yes, Please.', 'juster' ) => 'yes'
          ),
        ),
        array(
          "type"        =>'checkbox',
          "heading"     =>__('Map Type Control', 'juster'),
          "param_name"  => "gmap_maptype_control",
          "value"       => "",
          "value"     => Array(
            __( 'Yes, Please.', 'juster' ) => 'yes'
          ),
        ),

        // Map Markers
        array(
          'type' => 'param_group',
          'value' => '',
          'heading' => __( 'Map Locations', 'juster' ),
          'param_name' => 'locations',
          'params' => array(

            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Latitude', 'juster' ),
              'param_name' => 'latitude',
              'admin_label' => true,
              'description' => __( 'Find Latitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'juster' ),
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Longitude', 'juster' ),
              'param_name' => 'longitude',
              'admin_label' => true,
              'description' => __( 'Find Longitude : <a href="http://www.latlong.net/" target="_blank">latlong.net</a>', 'juster' ),
            ),
            array(
              'type' => 'attach_image',
              'value' => '',
              'heading' => __( 'Custom Marker', 'juster' ),
              'param_name' => 'custom_marker',
              "description" => __( "Upload your unique map marker if your want to differentiate from others.", 'juster'),
            ),
            array(
              'type' => 'textfield',
              'value' => '',
              'heading' => __( 'Heading', 'juster' ),
              'param_name' => 'location_heading',
              'admin_label' => true,
            ),
            array(
              'type' => 'textarea',
              'value' => '',
              'heading' => __( 'Content', 'juster' ),
              'param_name' => 'location_text',
            ),

          )
        ),
        array(
          "type" => "textfield",
          "heading" => __( "Extra class name", 'juster' ),
          "param_name" => "class",
          'value' => '',
        ),

        // Design Tab
        array(
          "type" => "css_editor",
          "heading" => __( "Text Size", 'juster' ),
          "param_name" => "css",
          "group" => __( "Design", 'juster'),
        ),

      )
    ) );
  }
}

/* ==========================================================
  Clients Slider - 2
=========================================================== */
add_action( 'init', 'clients_latest_vc_map' );

if ( ! function_exists( 'clients_latest_vc_map' ) ) {
  function clients_latest_vc_map() {
    vc_map( array(
        "name" =>"Clients 2",
        "base" => "jt_clients_latest",
        "description" => __( "Clients Styles",'juster'),
        "icon" => "icon-vc-gmap",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "dropdown",
                "heading" => __( "Client Slider Style", 'juster' ),
                "param_name" => "clients_style",
                "value" => array(
                  __('Select Slider Style', 'juster')=>'',
                  __('Carousel Type', 'juster') => 'style-1',
                  __('Bordered', 'juster') => 'style-2',
                  __('Hover Animation', 'juster') => 'style-3',
                  __('Normal', 'juster') => 'style-4',
                ),
                "admin_label" => true,
                "description" => __( "Select clients slider style", 'juster'),
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Columns", 'juster' ),
                "param_name" => "client_columns",
                "admin_label" => true,
                "value" => array(
                  __('--Select Column Type---', 'juster') => '',
                  __('Column Three', 'juster') => 'col-sm-4',
                  __('Column Four', 'juster') => 'col-sm-3',
                  __('Column Five', 'juster') => 'col-clients-5',
                   __('Column Six', 'juster') => 'col-sm-2'
                ),
                'dependency'  => array(
                  'element' => "clients_style",
                  'value'   => array('style-3','style-4')
                ),
                "description" => __( "Select column.", 'juster')
            ),
            array(
              'type' => 'param_group',
              'value' => '',
              'heading' => __( 'Client Slider', 'juster' ),
              'param_name' => 'clients_slider',
              // Note params is mapped inside param-group:
              'params' => array(
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Title', 'juster' ),
                  'param_name' => 'title',
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Client Llink', 'juster' ),
                  'param_name' => 'client_link',
                  "description" => __( "Enter your client link.", 'juster'),
                ),
                array(
                  'type' => 'attach_image',
                  'value' => '',
                  'heading' => __( 'Client Image', 'juster' ),
                  'param_name' => 'client_image',
                  "description" => __( "Upload your clients image.", 'juster'),
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Top Align Value', 'juster' ),
                  'param_name' => 'client_img_top_value',
                  "description" => __( "Values are in px [Eg : 30px].", 'juster'),
                ),
              )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),
          )
    ) );
  }
}

/* ==========================================================
  Timeline - 2
=========================================================== */
add_action( 'init', 'timeline_latest_vc_map' );
if ( ! function_exists( 'timeline_latest_vc_map' ) ) {
  function timeline_latest_vc_map() {
    vc_map( array(
        "name" =>"Timeline 2",
        "base" => "jt_timeline_latest",
        "description" => "Timeline Styles",
        "icon" => "icon-vc-timeline",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __( "Starting Year", 'juster' ),
                "param_name" => "timeline_year",
                'value'=> '',
                "admin_label"=> true,
                "description" => __( "Enter your stating year. [Eg:2010] ", 'juster'),
            ),
            array(
              'type' => 'param_group',
              'value' => '',
              'heading' => __( 'Timeline', 'juster' ),
              'param_name' => 'timeline_style',
              // Note params is mapped inside param-group:
              'params' => array(
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Title', 'juster' ),
                  'param_name' => 'title',
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Date', 'juster' ),
                  'param_name' => 'timeline_date',
                  "description" => __( "Enter timeline date .", 'juster'),
                ),
                array(
                  'type' => 'textarea',
                  'value' => '',
                  'heading' => __( 'Content', 'juster' ),
                  'param_name' => 'timeline_content',
                  "description" => __( "Enter your content .", 'juster'),
                ),
              )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value'=>'',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value' => '',
                "description" => __( "Pick your title color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Date Color", 'juster' ),
                "param_name" => "date_color",
                'value'=> '',
                "description" => __( "Pick your date color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Starting Year Color", 'juster' ),
                "param_name" => "year_color",
                'value'=> '',
                "description" => __( "Pick your year color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value' => '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Date Size", 'juster' ),
                "param_name" => "date_size",
                'value'=> '',
                "description" => __( "Enter your date size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Starting Year Text Size", 'juster' ),
                "param_name" => "year_text_size",
                'value'=> '',
                "description" => __( "Enter your starting year text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
  Carousal Slider - 2
=========================================================== */
add_action( 'init', 'carousal_latest_vc_map' );

if ( ! function_exists( 'carousal_latest_vc_map' ) ) {
  function carousal_latest_vc_map() {
    vc_map( array(
        "name" =>"Carousal 2",
        "base" => "jt_carousal_latest",
        "description" => __( "Clients Styles",'juster'),
        "icon" => "icon-vc-carousal",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
              'type' => 'param_group',
              'value' => '',
              'heading' => __( 'Carousal Slider', 'juster' ),
              'param_name' => 'carousal_slider',
              // Note params is mapped inside param-group:
              'params' => array(
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Title', 'juster' ),
                  'param_name' => 'title',
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Special Text', 'juster' ),
                  'param_name' => 'special_text',
                  "description" => __( "Enter special text.", 'juster'),
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Carousal Heading', 'juster' ),
                  'param_name' => 'carousal_heading',
                  "description" => __( "Enter carousal heading.", 'juster'),
                ),
                array(
                  'type' => 'textarea',
                  'value' => '',
                  'heading' => __( 'Carousal Content', 'juster' ),
                  'param_name' => 'carousal_content',
                  "description" => __( "Enter your content.", 'juster'),
                ),
              )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
                "admin_label" => true,
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Special Text Color", 'juster' ),
                "param_name" => "special_text_color",
                'value' => '',
                "description" => __( "Pick your special text color", 'juster'),
                "group" => __( "Color", 'juster')
            ),
             array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value'=> '',
                "description" => __( "Pick your heading color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Content Color", 'juster' ),
                "param_name" => "content_color",
                'value'=> '',
                "description" => __( "Pick your content color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Special Text Size", 'juster' ),
                "param_name" => "special_text_size",
                'value' => '',
                "description" => __( "Enter your special text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value'=> '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Content Size", 'juster' ),
                "param_name" => "content_size",
                'value'=> '',
                "description" => __( "Enter your content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
  Featured Slide
=========================================================== */
add_action( 'init', 'featured_slider_latest_vc_map' );

if ( ! function_exists( 'featured_slider_latest_vc_map' ) ) {
  function featured_slider_latest_vc_map() {
    vc_map( array(
        "name" =>"Featured slider 2",
        "base" => "jt_featured_slide_latest",
        "description" => __( "Featured slider Styles",'juster'),
        "icon" => "icon-vc-featured-slider",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "textfield",
                "heading" => __( "Small Title", 'juster' ),
                "param_name" => "small_title",
                'value' => '',
                "description" => __( "Enter your small title", 'juster'),
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading", 'juster' ),
                "param_name" => "heading",
                'value'=> '',
                "admin_label"=> true,
                "description" => __( "Enter your heading", 'juster')
            ),
            array(
              "type"=>'attach_image',
              "heading"=>__('Background Image', 'juster'),
              "param_name"=> "bg_image",
              "value"=> "",
              "description" => __( "Attach your background image.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Overlay Image?", 'juster' ),
                "param_name" => "need_overlay",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want overlay image, check this.", 'juster')
            ),
            array(
              'type' => 'param_group',
              'value' => '',
              'heading' => __( 'Featured Slider', 'juster' ),
              'param_name' => 'featured_slider',
              // Note params is mapped inside param-group:
              'params' => array(
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Title', 'juster' ),
                  'param_name' => 'title',
                ),
                array(
                  'type' => 'textarea',
                  'value' => '',
                  'heading' => __( 'Category', 'juster' ),
                  'param_name' => 'featured_category',
                  "description" => __( "Enter your category", 'juster'),
                ),
                array(
                  'type' => 'textarea',
                  'value' => '',
                  'heading' => __( 'Content', 'juster' ),
                  'param_name' => 'featured_content',
                  "description" => __( "Enter your content", 'juster'),
                ),
                array(
                  'type' => 'attach_image',
                  'value' => '',
                  'heading' => __( 'Center Image', 'juster' ),
                  'param_name' => 'center_image',
                  "description" => __( "Upload your center image", 'juster'),
                ),
              )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Small Title Color", 'juster' ),
                "param_name" => "small_title_color",
                'value'=> '',
                "description" => __( "Pick your small title color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value'=> '',
                "description" => __( "Pick your heading color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value'=> '',
                "description" => __( "Pick your title color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Small Title Size", 'juster' ),
                "param_name" => "small_title_size",
                'value' => '',
                "description" => __( "Enter your small title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value'=> '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value'=> '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
  Featured Tabs
=========================================================== */
add_action( 'init', 'featured_tabs_latest_vc_map' );

if ( ! function_exists( 'featured_tabs_latest_vc_map' ) ) {
  function featured_tabs_latest_vc_map() {
    vc_map( array(
        "name" =>"Featured Tabs 2",
        "base" => "jt_features_tabs_latest",
        "description" => __( "Featured Tabs Styles",'juster'),
        "icon" => "icon-vc-feature-tabs",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
                "type" => "textfield",
                "heading" => __( "Heading", 'juster' ),
                "param_name" => "heading",
                'value'=> '',
                "admin_label"=> true,
                "description" => __( "Enter your heading", 'juster')
            ),
            array(
              "type"=>'attach_image',
              "heading"=>__('Image', 'juster'),
              "param_name"=> "tab_image",
              "value"=> "",
              "description" => __( "Attach your tab image.", 'juster')
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Need Image Hover Effect?", 'juster' ),
                "param_name" => "need_hover",
                'value'     => Array(
                            __( 'Yes, Please.', 'juster' ) => 'yes'
                          ),
                "description" => __( "If you want image hover effect, check this.", 'juster')
            ),
            array(
              'type' => 'param_group',
              'value' => '',
              'heading' => __( 'Features Tabs', 'juster' ),
              'param_name' => 'jt_features_tabs',
              // Note params is mapped inside param-group:
              'params' => array(
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Title', 'juster' ),
                  'param_name' => 'title',
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Features Tab Icon', 'juster' ),
                  'param_name' => 'features_tab_icon',
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Sub Title', 'juster' ),
                  'param_name' => 'short_tab_content',
                  "description" => __( "Enter your short content.", 'juster'),
                ),
                array(
                  'type' => 'textarea',
                  'value' => '',
                  'heading' => __( 'Tab Content', 'juster' ),
                  'param_name' => 'long_tab_content',
                  "description" => __( "Enter your long content .", 'juster'),
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Button Text', 'juster' ),
                  'param_name' => 'tabs_button_text',
                  "description" => __( "Enter your button text .", 'juster'),
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Button Link', 'juster' ),
                  'param_name' => 'tabs_button_link',
                  "description" => __( "Enter your button link .", 'juster'),
                ),
              )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
            ),

            // Color
            array(
                "type" => "colorpicker",
                "heading" => __( "Heading Color", 'juster' ),
                "param_name" => "heading_color",
                'value'=> '',
                "description" => __( "Pick your heading color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Title Color", 'juster' ),
                "param_name" => "title_color",
                'value'=> '',
                "description" => __( "Pick your title color .", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Icon Color", 'juster' ),
                "param_name" => "icon_color",
                'value'=> '',
                "description" => __( "Pick your icon color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Sub Title Color", 'juster' ),
                "param_name" => "short_content_color",
                'value'=> '',
                "description" => __( "Pick your sub title color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Tab Content Color", 'juster' ),
                "param_name" => "long_content_color",
                'value'=> '',
                "description" => __( "Pick your tab content color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Text Color", 'juster' ),
                "param_name" => "button_text_color",
                'value'=> '',
                "description" => __( "Pick your button text color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),
            array(
                "type" => "colorpicker",
                "heading" => __( "Button Border Color", 'juster' ),
                "param_name" => "button_border_color",
                'value'=> '',
                "description" => __( "Pick your button border color.", 'juster'),
                 "group" => __( "Color", 'juster')
            ),

            // Size
            array(
                "type" => "textfield",
                "heading" => __( "Heading Size", 'juster' ),
                "param_name" => "heading_size",
                'value'=> '',
                "description" => __( "Enter your heading size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Title Size", 'juster' ),
                "param_name" => "title_size",
                'value'=> '',
                "description" => __( "Enter your title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Icon Size", 'juster' ),
                "param_name" => "icon_size",
                'value' => '',
                "description" => __( "Enter your icon size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Sub Title Size", 'juster' ),
                "param_name" => "short_content_size",
                'value'=> '',
                "description" => __( "Enter your sub title size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Tab Content Size", 'juster' ),
                "param_name" => "long_content_size",
                'value'=> '',
                "description" => __( "Enter your tab content size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Button Text Size", 'juster' ),
                "param_name" => "button_text_size",
                'value'=> '',
                "description" => __( "Enter your button text size in px. (Eg : 16px)", 'juster'),
                "group" => __( "Sizes", 'juster')
            ),
          )
    ) );
  }
}

/* ==========================================================
  Icon Tabs
=========================================================== */
add_action( 'init', 'icon_tab_latest_vc_map' );

if ( ! function_exists( 'icon_tab_latest_vc_map' ) ) {
  function icon_tab_latest_vc_map() {
    vc_map( array(
        "name" =>"Icon Tabs 2",
        "base" => "jt_icon_tabs_latest",
        "description" => __( "Icon Tabs",'juster'),
        "icon" => "icon-vc-icon-tabs",
        "category" => __( 'Juster', 'juster' ),
        "params" => array(

            // General Tab
            array(
              'type' => 'param_group',
              'value' => '',
              'heading' => __( 'Image Tabs', 'kroth-core' ),
              'param_name' => 'image_tabs',
              // Note params is mapped inside param-group:
              'params' => array(
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Title', 'kroth-core' ),
                  'param_name' => 'title',
                  "description" => __( "Enter your title.", 'juster'),
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Tab Icon', 'kroth-core' ),
                  'param_name' => 'tab_icon',
                  "description" => __( "Select icon from <a href='http://themes-pixeden.com/font-demos/7-stroke/index.html' target='_blank'>7-stroke</a> lib. (Eg : pe-7s-notebook) OR </br> Select icon from<a href='http://fortawesome.github.io/Font-Awesome/cheatsheet/' target='_blank'>FontAwesome</a> lib. (Eg :fa fa-heart)", 'juster'),
                ),
                array(
                  "type" => "dropdown",
                  "heading" => __( "Upload Type", 'juster' ),
                  "param_name" => "icon_details",
                  "value" => array(
                    "Icon" => 'icon',
                    "Image" => 'image',
                  ),
                  "description" => __( "Select upload type (icon or image).", 'juster'),
                ),
                array(
                  'type' => 'attach_image',
                  'value' => '',
                  'heading' => __( 'Tab Image', 'kroth-core' ),
                  'param_name' => 'tab_image',
                  'dependency'  => array(
                    'element' => "icon_details",
                    'value'   => "image"
                    ),
                  "description" => __( "Upload your tab image .", 'juster'),
                ),
                array(
                  'type' => 'textarea',
                  'value' => '',
                  'heading' => __( 'Content', 'kroth-core' ),
                  'param_name' => 'tab_icon_content',
                  'dependency'  => array(
                    'element' => "icon_details",
                    'value'   => "icon"
                    ),
                  "description" => __( "Enter your content .", 'juster'),
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Button Text', 'kroth-core' ),
                  'param_name' => 'tab_icon_button_text',
                  'dependency'  => array(
                    'element' => "icon_details",
                    'value'   => "icon"
                    ),
                  "description" => __( "Enter your tab name .", 'juster'),
                ),
                array(
                  'type' => 'textfield',
                  'value' => '',
                  'heading' => __( 'Button Link', 'kroth-core' ),
                  'param_name' => 'tab_icon_button_link',
                  'dependency'  => array(
                    'element' => "icon_details",
                    'value'   => "icon"
                    ),
                  "description" => __( "Enter your tab link .", 'juster'),
                ),
              )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", 'juster' ),
                "param_name" => "class",
                'value' => '',
                "admin_label"=> true,
            ),
          )
    ) );
  }
}
