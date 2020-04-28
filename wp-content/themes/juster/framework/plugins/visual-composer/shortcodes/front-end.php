<?php
/**
 * 1. Headings
 * 2. Button
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
 * 30. Under Construction
 */

/* ==========================================================
    1. Headings
=========================================================== */
if ( !function_exists('heading_styles')) {
  function heading_styles( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'heading_text'  => '',
      'heading_tag'  => '',
      'sub_heading_text'  => '',
      'need_seperate'  => '',
      'sep_height'  => '',
      'sep_width'  => '',
      'seperator_color'  => '',
      'seperator_style'  => '',
      'need_icon'  => '',
      'heading_icon'  => '',
      'icon_border_styles'  => '',
      'class'  => '',

      // Color
      'heading_color'  => '',
      'sub_heading_color'  => '',
      'icon_color'  => '',
      'icon_border_color'  => '',

      // Sizes
      'heading_size'  => '',
      'sub_heading_size'  => '',
      'line_height'  => '',
      'icon_size'  => '',
      'icon_outer_space' =>'',
      'letter_spacing'  => '',
      'heading_text_transform'  => '',
      'heading_weight'  => '',
      'text_align'  => '',
    ), $atts));

    // Color
    if ($heading_color) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ($sub_heading_color) {
      $sub_heading_color = 'color:'. $sub_heading_color .';';
    } else {
      $sub_heading_color ='';
    }
    if ($icon_color) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color ='';
    }
    if ($icon_border_color) {
      $icon_border_color = 'border-color:'. $icon_border_color .';';
    } else {
      $icon_border_color ='';
    }

    // Sizes
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
       $heading_size ='';
    }
    if ($line_height) {
      $line_height = 'line-height:'. esc_attr($line_height) .';';
    } else {
      $line_height ='';
    }
    if ($sub_heading_size) {
      $sub_heading_size = 'font-size:'. esc_attr($sub_heading_size) .';';
    } else {
      $sub_heading_size ='';
    }
    if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }
    if ($icon_outer_space) {
      $icon_outer_space = 'padding:'. esc_attr($icon_outer_space) .';';
    } else {
      $icon_outer_space ='';
    }
    if ($heading_text_transform) {
      $heading_text_transform = 'text-transform:'. $heading_text_transform .';';
    } else {
      $heading_text_transform = '';
    }
    if ($sep_width) {
      $sep_width = 'width:'. esc_attr($sep_width) .';';
    } else {
      $sep_width ='';
    }
    if ($sep_height) {
      $sep_height = 'height:'. esc_attr($sep_height) .';';
    } else {
      $sep_height ='';
    }
    if ($seperator_color) {
      $seperator_color = 'background-color:'. $seperator_color .';';
    } else {
      $seperator_color ='';
    }
    if ($heading_weight) {
      $heading_weight = 'font-weight:'. $heading_weight .';';
    } else {
      $heading_weight ='';
    }
    if ($letter_spacing) {
      $letter_spacing = 'letter-spacing:'. $letter_spacing .';';
    } else {
      $letter_spacing ='';
    }

    if ($need_seperate) {
     if($seperator_style == 'style-1') {
        if ($text_align == 'right') {
        $need_seperate = '<div class="jt-sep-two-right"></div>';
         } elseif ($text_align == 'left') {
        $need_seperate = '<div class="jt-sep-two"></div>';
         } else {
        $need_seperate = '<div class="jt-sep"></div>';
         }
      } elseif($seperator_style == 'style-2') {
        if ($text_align == 'right') {
        $need_seperate = '<div class="jt-leaf-right jt-leaf"></div>';
         } elseif ($text_align == 'left') {
        $need_seperate = '<div class="jt-leaf-left jt-leaf"></div>';
         } else {
        $need_seperate = '<div class="jt-leaf-center jt-leaf"></div>';
         }
      } else {
        if ($text_align == 'right') {
        $need_seperate='<div class="jt-boxslide-sep-right" style="'. $sep_width . $sep_height . $seperator_color .'"></div>';
         } elseif ($text_align == 'left') {
        $need_seperate='<div class="jt-boxslide-sep-left" style="'. $sep_width . $sep_height . $seperator_color .'"></div>';
         } else {
       $need_seperate='<div class="jt-boxslide-sep" style="'. $sep_width . $sep_height . $seperator_color .'"></div>';
         }
      }
    }

    if ($text_align) {
      $text_align = 'text-align:'. $text_align .';';
    } else {
       $text_align ='';
    }

    if ($sub_heading_text) {
      $need_sub_heading = '<h4 class="sub-heading" style="'. $sub_heading_color . $sub_heading_size . $line_height .'">'. $sub_heading_text .'</h4>';
    } else {
      $need_sub_heading = '';
    }

    if ($icon_border_styles =='square') {
      $icon_border_styles = 'jt-heading-icon-square';
    } elseif ($icon_border_styles =='circle') {
      $icon_border_styles = 'jt-heading-icon-circle';
    } else {
      $icon_border_styles ='jt-heading-icon-border-none';
    }

    if ($need_icon) {
      $need_icon = '<div class="'. $icon_border_styles .'" style="'. $icon_border_color . $icon_outer_space .'"><i class="'. esc_attr($heading_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>';
    } else {
      $need_icon ='';
    }

    if ($heading_tag) {
      $heading_tag = $heading_tag;
    } else {
      $heading_tag ='h2';
    }

    // Output
    if ($heading_text) {
      $output = '<div class="jt-heading '. esc_attr($class) .'" style="'. $text_align .'">'. $need_icon .'<'. $heading_tag .' class="jt-main-head" style="'. $heading_color . $heading_size . $heading_text_transform . $heading_weight . $letter_spacing .'">'. esc_attr($heading_text) .'</'. $heading_tag .'>'. $need_seperate .''. $need_sub_heading .'</div>';
    } else {
      $output = "";
    }

    return $output;

  }
}
add_shortcode( 'jt_heading', 'heading_styles' );

/* ==========================================================
   2. Buttons
=========================================================== */
if ( !function_exists('juster_button_styles')) {
  function juster_button_styles( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'button_text'  => '',
      'button_type'  => '',
      'button_style'  => '',
      'button_link'  => '',
      'open_link'  => '',
      'class'  => '',

      // Color
      'button_text_color'  => '',
      'button_bg_color'  => '',
      'button_border_color'  => '',

      // Sizes
      'button_text_size'  => '',
      'button_letter_space'  => '',
      'button_text_transform'  => '',

      // Margin
      'button_margin_top'  => '',
      'button_margin_bottom'  => '',
      'button_margin_left'  => '',
      'button_margin_right'  => '',

      //Padding
      'btn_padding_top'  => '',
      'btn_padding_bottom'  => '',
      'btn_padding_left'  => '',
      'btn_padding_right'  => '',
    ), $atts));

    // Color
    if ($button_text_color) {
      $button_text_color = 'color:'. $button_text_color .';';
    } else {
      $button_text_color ='';
    }
    if ($button_bg_color) {
      $button_bg_color = 'background-color:'. $button_bg_color .';border-color:'. $button_bg_color .';';
    } else {
      $button_bg_color = '';
    }
    if ($button_border_color) {
      $button_border_color = 'border-color:'. $button_border_color .';';
    } else {
      $button_border_color ='';
    }

    // Sizes
    if ($button_text_size) {
      $button_text_size = 'font-size:'. esc_attr($button_text_size) .';';
    } else {
      $button_text_size ='';
    }
    if ($button_letter_space) {
      $button_letter_space = 'letter-spacing:'. esc_attr($button_letter_space) .';';
    } else {
      $button_letter_space ='';
    }
    if ($button_text_transform) {
      $button_text_transform = 'text-transform:'. $button_text_transform .';';
    } else {
      $button_text_transform ='';
    }

    // Margin
    if ($button_margin_top) {
      $button_margin_top = 'margin-top:'. esc_attr($button_margin_top) .';';
    } else {
      $button_margin_top ='';
    }
    if ($button_margin_right) {
      $button_margin_right = 'margin-right:'. esc_attr($button_margin_right) .';';
    } else {
      $button_margin_right ='';
    }
    if ($button_margin_bottom) {
      $button_margin_bottom = 'margin-bottom:'. esc_attr($button_margin_bottom) .';';
    } else {
      $button_margin_bottom ='';
    }
    if ($button_margin_left) {
      $button_margin_left = 'margin-left:'. esc_attr($button_margin_left) .';';
    } else {
      $button_margin_left ='';
    }

    $margin = $button_margin_top . $button_margin_right . $button_margin_bottom . $button_margin_left ;

    // Padding
    if ($btn_padding_top) {
      $btn_padding_top = 'padding-top:'. esc_attr($btn_padding_top) .';';
    } else {
      $btn_padding_top ='';
    }
    if ($btn_padding_right) {
      $btn_padding_right = 'padding-right:'. esc_attr($btn_padding_right) .';';
    } else {
      $btn_padding_right ='';
    }
    if ($btn_padding_bottom) {
      $btn_padding_bottom = 'padding-bottom:'. esc_attr($btn_padding_bottom) .';';
    } else {
      $btn_padding_bottom ='';
    }
    if ($btn_padding_left) {
      $btn_padding_left = 'padding-left:'. esc_attr($btn_padding_left) .';';
    } else {
      $btn_padding_left ='';
    }

    $padding = $btn_padding_top . $btn_padding_right . $btn_padding_bottom . $btn_padding_left ;

    if ($open_link == 'yes') {
      $open_link = 'target="_blank"';
    } else {
      $open_link ='';
    }

    if ($button_style == 'bg-empty') {
      $button_style = 'bg-empty';
    } else {
      $button_style = 'bg-filled';
    }

    // Output
    if ($button_text) {
      $output = '<a href="'. esc_url($button_link) .'" class="btn-primary btn-black '. $button_type .' '. $button_style .' '. esc_attr($class) .'" style="'. $button_text_color . $button_text_size . $button_letter_space . $button_text_transform . $button_bg_color . $button_border_color . $margin . $padding .'" '. $open_link .'>'. esc_attr($button_text) .'</a>';
    } else { $output=""; }
    return $output;
  }
}
add_shortcode( 'jt_button', 'juster_button_styles' );

/* ==========================================================
  3. Counter
=========================================================== */
if ( !function_exists('juster_counter')) {
  function juster_counter( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'counter_style'  => '',
      'counter_icon'  => '',
      'counter_number'  => '',
      'counter_title'  => '',
      'counter_value_in'  => '',
      'counter_seperator'  => '',
      'number_color'   => '',
      'icon_color'   => '',
      'text_color'   => '',
      'bg_color'   => '',
      'number_size'   => '',
      'icon_size'   => '',
      'text_size'   => '',
      'padding_top'   => '',
      'padding_bottom'   => '',
      'text_transform'  => '',
      'class'  => ''
    ), $atts));

    wp_register_script( 'counterup', SCRIPTS . '/jquery.counterup.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'counterup' );

    // Color
    if ( $number_color ) {
      $number_color = 'color:'. $number_color .';';
    } else {
      $number_color = '';
    }
    if ( $icon_color ) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color = '';
    }
    if ( $text_color ) {
      $text_color = 'color:'. $text_color .';';
    } else {
      $text_color ='';
    }
    if ( $bg_color ) {
      $bg_color = 'background-color:'. $bg_color .';';
    } else {
      $bg_color ='';
    }

    // Sizes
    if ($number_size) {
      $number_size = 'font-size:'. esc_attr($number_size) .';';
    } else {
      $number_size ='';
    }
    if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
    } else {
      $text_size ='';
    }
    if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }

    // Padding
    if ($padding_top) {
      $padding_top = 'padding-top:'. esc_attr($padding_top) .';';
    } else {
      $padding_top ='';
    }
    if ($padding_bottom) {
      $padding_bottom = 'padding-bottom:'. esc_attr($padding_bottom) .';';
    } else {
       $padding_bottom ='';
    }
    if ($text_transform) {
      $text_transform = 'text-transform:'. $text_transform .';';
    } else {
      $text_transform ='';
    }

    if ($counter_value_in) {
      $counter_value_in = $counter_value_in;
    } else {
      $counter_value_in = '';
    }

    if($counter_seperator == 'yes') {
      $counter_seperator ='<div class="jt-count-sep"></div>';
    } else {
      $counter_seperator ='';
    }

    if ($counter_style == 'style-2') {
      $output = '<div class="jt-counter jt-corp-count '. esc_attr($class) .'" style="'. $bg_color . $padding_top . $padding_bottom .'"><i class="'. esc_attr($counter_icon) .'" style="'. $icon_color . $icon_size .'"></i><div class="jt-num" style="'. $number_color . $number_size .'"><span>'. esc_attr($counter_number) .'</span>'. esc_attr($counter_value_in) .'</div><div class="jt-coun-content" style="'. $text_color . $text_size . $text_transform .'">'. esc_attr($counter_title) .'</div></div>';
    } elseif($counter_style == 'style-3') {
      $output = '<div class="jt-counter jt-counter-three '. esc_attr($class) .'" style="'. $bg_color . $padding_top . $padding_bottom .'"><div class="jt-num" style="'. $number_color . $number_size .'"><span>'. esc_attr($counter_number) .'</span><em>'. esc_attr($counter_value_in) .'</em></div><div class="jt-coun-content" style="'. $text_color . $text_size . $text_transform .'">'. esc_attr($counter_title) .'</div></div>';
    } else {
      $output = '<div class="jt-counter '. esc_attr($class) .'" style="'. $bg_color . $padding_top . $padding_bottom .'"><div class="jt-num" style="'. $number_color . $number_size .'"><span>'. esc_attr($counter_number) .'</span>'. esc_attr($counter_value_in) .'</div>'. $counter_seperator .'<div class="jt-coun-content" style="'. $text_color . $text_size . $text_transform .'">'. esc_attr($counter_title) .'</div></div>';
    }
    return $output;
  }
}
add_shortcode( 'jt_counter', 'juster_counter' );

/* ==========================================================
   4. Skillbar
=========================================================== */
if ( !function_exists('juster_skillbar')) {
  function juster_skillbar( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'skillbar_title'  => '',
      'skillbar_percentage'  => '',
      'class'  => '',

      'title_color'   => '',
      'percentage_color'   => '',
      'skillbar_color'   => '',

      'title_size'   => '',
      'percentage_size'   => '',
      'text_transform'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'skill-boxed';
    } else {
      $page_model_class = 'skill-extrawidth';
    }

    // Color
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $percentage_color ) {
      $percentage_color = 'color:'. $percentage_color .';';
    } else {
      $percentage_color ='';
    }
    if ( $skillbar_color ) {
      $skillbar_color = 'background-color:'. $skillbar_color .';';
    } else {
      $skillbar_color ='';
    }

    // Sizes
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($percentage_size) {
      $percentage_size = 'font-size:'. esc_attr($percentage_size) .';';
    } else {
      $percentage_size ='';
    }
    if ($text_transform) {
      $text_transform = 'text-transform:'. $text_transform .';';
    } else {
      $text_transform ='';
    }

    if ($skillbar_title) {
    $output = '<div class="jt-skill '. $page_model_class .' '. esc_attr($class) .'" data-percent="'. esc_attr($skillbar_percentage) .'%"><div class="skillbar-title" style="'. $title_color . $title_size . $text_transform .'"><span>'. esc_attr($skillbar_title) .'</span><span class="percentage-text" style="'. $percentage_color . $percentage_size .'">'. esc_attr($skillbar_percentage) .'%</span></div><div class="jt-full-bar"><img class="skill-arrow" src="'. IMAGES .'/arrows/skillbar.png" alt="skillbar"><div class="jt-skillbar" style="'. $skillbar_color .'"></div></div></div>';
    }  else { $output=""; }
    return $output;
  }
}
add_shortcode( 'jt_skillbar', 'juster_skillbar' );

/* ==========================================================
  5.Pricing
=========================================================== */
if ( !function_exists('pricing_styles')) {
  function pricing_styles( $atts, $content = true ) {

    extract(shortcode_atts(array(
      'pricing_style'  => '',
      'heading'  => '',
      'price'  => '',
      'period'  => '',
      'pricing_bg_image'  => '',
      'button_text'  => '',
      'button_link'  => '',
      'open_link'  => '',
      'class'  => '',

      // Color
      'heading_color'  => '',
      'price_color'  => '',
      'period_color'  => '',
      'button_text_color'  => '',
      'button_border_color'  => '',

      // Sizes
      'heading_size'  => '',
      'price_size'  => '',
      'period_size'  => '',
      'button_text_size'  => '',
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class1 = 'jt-pricing-one-boxed';
      $page_model_class2 = 'jt-pricing-two-boxed';
      $page_model_class3 = 'jt-pricing-three-boxed';
    } else {
      $page_model_class1 = 'jt-pricing-one-wide';
      $page_model_class2 = 'jt-pricing-two-wide';
      $page_model_class3 = 'jt-pricing-three-wide';
    }

    // Color
    if ($heading_color) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ($price_color) {
      $price_color = 'color:'. $price_color .';';
    } else {
      $price_color ='';
    }
    if ($period_color) {
      $period_color = 'color:'. $period_color .';';
    } else {
      $period_color ='';
    }
    if ($button_text_color) {
      $button_text_color = 'color:'. $button_text_color .';';
    } else {
      $button_text_color ='';
    }
    if ($button_border_color) {
      $button_border_color = 'border-color:'. $button_border_color .';';
    } else {
      $button_border_color ='';
    }

    // Sizes
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($price_size) {
      $price_size = 'font-size:'. esc_attr($price_size) .';';
    } else {
      $price_size ='';
    }
    if ($period_size) {
      $period_size = 'font-size:'. esc_attr($period_size) .';';
    } else {
      $period_size ='';
    }
    if ($button_text_size) {
      $button_text_size = 'font-size:'. esc_attr($button_text_size) .';';
    } else {
      $button_text_size ='';
    }
    if ($open_link == 'yes') {
      $open_link = 'target="_blank"';
    } else {
      $open_link ='';
    }

    if ($pricing_bg_image) {
      $image_url = wp_get_attachment_url( $pricing_bg_image );
      $pricing_bg_image = 'style="background-image:url('. $image_url .');"';
    } else {
      $pricing_bg_image ='';
    }

    $content = wpb_js_remove_wpautop($content, true);

    // Output
    if ($pricing_style == 'style-1') {
      $output ='<div class="jt-pricing-box '. $page_model_class1 .' '. esc_attr($class) .'"><div class="pricing-head" '. $pricing_bg_image .'><div class="jt-pricing-overlay"></div></div><div class="jt-pricing-main-content"><div class="pricing-state" style="'. $heading_color . $heading_size .'">'. esc_attr($heading) .'</div><div class="jt-pricing-circle"><div class="jt-pricing-inner-circle"><div class="jt-prices" style="'. $price_color . $price_size .'">'. esc_attr($price) .'</div><div class="jt-period" style="'. $period_color . $period_size .'">'. esc_attr($period) .'</div></div></div><div class="jt-price-features">'. $content .'</div><a href="'. esc_url($button_link) .'" class="jt-pricing-btn" style="'. $button_text_color . $button_text_size .  $button_border_color .'" '. $open_link .'>'. esc_attr($button_text) .'</a></div></div>';
    } elseif ($pricing_style == 'style-2') {
      $output='<div class="jt-pricing-box jt-pricing-style-two '. $page_model_class2 .' '. esc_attr($class) .'"><div class="pricing-head"></div><div class="jt-pricing-content-details"><div class="pricing-state" style="'. $heading_color . $heading_size .'">'. esc_attr($heading) .'</div><div class="jt-pricing-circle"><div class="jt-pricing-inner-circle"><div class="jt-prices" style="'. $price_color . $price_size .'">'. esc_attr($price) .'</div><div class="jt-period" style="'. $period_color . $period_size .'">'. esc_attr($period) .'</div></div></div><div class="jt-price-features">'. $content .'</div><a href="'. esc_url($button_link) .'" class="jt-pricing-btn" style="'. $button_text_color . $button_text_size .  $button_border_color .'" '. $open_link .'>'. esc_attr($button_text) .'</a></div></div>';
    } else {
      $output='<div class="jt-pricing-box jt-corp-pricing '. $page_model_class3 .' '. esc_attr($class) .'"><div class="pricing-head"></div><div class="jt-pricing-main-content"><div class="pricing-state" style="'. $heading_color . $heading_size .'">'. esc_attr($heading) .'</div><div class="jt-pricing-circle"><div class="jt-pricing-inner-circle"><div class="jt-prices" style="'. $price_color . $price_size .'">'. esc_attr($price) .'</div><div class="jt-period" style="'. $period_color . $period_size .'">'. esc_attr($period) .'</div></div></div><div class="jt-price-features">'. $content .'</div><a href="'. esc_url($button_link) .'" class="jt-pricing-btn" style="'. $button_text_color . $button_text_size .  $button_border_color .'" '. $open_link .'>'. esc_attr($button_text) .'</a></div></div>';
    }
    return $output;
  }
}
add_shortcode( 'jt_pricing', 'pricing_styles' );

/* ==========================================================
    6. Clients Slider
=========================================================== */
if ( !function_exists('juster_clients')) {
  function juster_clients( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'clients_style'  => '',
      'client_columns'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-client-carousel-boxed';
    } else {
      $page_model_class = 'jt-client-carousel-wide';
    }

    // Turn output buffer on
    ob_start();

    $clients_slider = ot_get_option('client_slider');
    if($clients_style == 'style-1') { ?>
       <div class="jt-client-carousel <?php echo $page_model_class; ?> <?php echo esc_attr($class); ?>">
             <?php
             if ($clients_slider) {
              foreach($clients_slider as $clients) {
                  echo '<a href="'. esc_url($clients['client_link']) .'" class="jt-client-logo"><img src="'. esc_attr($clients['client_image']) .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a>';
                }
              }
            ?>
       </div>
  <?php } elseif($clients_style == 'style-2') { ?>
        <div class="jt-client-static <?php echo $page_model_class; ?> <?php echo esc_attr($class); ?>">
            <?php
               if ($clients_slider) {
              foreach($clients_slider as $clients) {
                  echo '<a href="'. esc_url($clients['client_link']) .'" class="jt-client-logo"><img src="'. esc_attr($clients['client_image']) .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a>';
                }
              }
            ?>
        </div>
 <?php } elseif($clients_style == 'style-3') {
               if ($clients_slider) {
              foreach($clients_slider as $clients) {
                  echo '<div class="'. $page_model_class .' '. $client_columns .' '. esc_attr($class) .'"><div class="jt-vint-clients"><a href="'. esc_url($clients['client_link']) .'"><img src="'. esc_attr($clients['client_image']) .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a> </div></div>';
                }
              }

 } else {
          if ($clients_slider) {
            foreach($clients_slider as $clients) {
                echo '<div class="'. $page_model_class .' '. $client_columns .' '. esc_attr($class) .'"><div class="jt-normal-clients"><a href="'. esc_url($clients['client_link']) .'"><img src="'. esc_attr($clients['client_image']) .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a> </div></div>';
            }
          }
 }

  // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_clients', 'juster_clients' );

/* ==========================================================
    7. Call To Action
=========================================================== */
if ( !function_exists('juster_calltoaction')) {
  function juster_calltoaction( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'title'  => '',
      'call_content'  => '',
      'icon'   => '',
      'button1_text'   => '',
      'button1_link'   => '',
      'need_button'   => '',
      'button2_text'   => '',
      'button2_link'  => '',
      'title_color'  => '',
      'content_color'  => '',
      'icon_color'   => '',
      'icon_border_color'   => '',
      'icon_bg_color'   => '',
      'arrow_icon_color'   => '',
      'button1_color'   => '',
      'button2_color'   => '',
      'button1_border_color'   => '',
      'button2_border_color'   => '',
      'title_size'  => '',
      'content_size'   => '',
      'icon_size'   => '',
      'button1_size'   => '',
      'button2_size'   => '',
      'class'  => ''
    ), $atts));
    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-call-action-boxed';
    } else {
      $page_model_class = 'jt-call-action-extrawidth';
    }

    // Color
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $icon_color ) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color ='';
    }
    if ( $icon_border_color ) {
      $icon_border_color = 'border-color:'. $icon_border_color .';';
    } else {
      $icon_border_color ='';
    }
    if ( $icon_bg_color ) {
      $icon_bg_color = 'background-color:'. $icon_bg_color .';';
    } else {
      $icon_bg_color ='';
    }
    if ($arrow_icon_color == 'box-arrow-right-white') {
      $arrow_icon_color = '<img src="'. IMAGES .'/arrows/box-arrow-right-white.png" alt="white">';
    } else {
      $arrow_icon_color = '<img src="'. IMAGES .'/arrows/box-arrow-right.png" alt="black">';
    }
    if ( $button1_color ) {
      $button1_color = 'color:'. $button1_color .';';
    } else {
      $button1_color ='';
    }
    if ( $button2_color ) {
      $button2_color = 'color:'. $button2_color .';';
    } else {
      $button2_color ='';
    }
    if ( $button1_border_color ) {
      $button1_border_color = 'border-color:'. $button1_border_color .';';
    } else {
      $button1_border_color ='';
    }
    if ( $button2_border_color ) {
      $button2_border_color = 'border-color:'. $button2_border_color .';';
    } else {
      $button2_border_color ='';
    }

    // Sizes
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }
    if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }
    if ($button1_size) {
      $button1_size = 'font-size:'. esc_attr($button1_size) .';';
    } else {
      $button1_size ='';
    }
    if ($button2_size) {
      $button2_size = 'font-size:'. esc_attr($button2_size) .';';
    } else {
      $button2_size ='';
    }
    if($need_button){
      $need_button ='<a href="'. esc_url($button2_link) .'" class="btn-primary jt-btn-call-action" style="'. $button2_color . $button2_size . $button2_border_color .'">'. esc_attr($button2_text) .'</a>';
    } else {
      $need_button ='';
    }

    if ($title) {
    $output = '<div class="jt-call-action '. esc_attr($page_model_class) .' '. esc_attr($class) .'"><div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 jt-icon-box-width"><div class="jt-call-icon-box" style="'. $icon_border_color .'"><i class="'. esc_attr($icon) .'" style="'. $icon_color . $icon_size .'"></i><span class="arrow-right" style="'. $icon_bg_color .'">'. $arrow_icon_color .'</span></div><div class="jt-call-action-content"><h2 style="'. $title_color . $title_size . '">'. esc_attr($title) .'</h2><p style="'. $content_color . $content_size . '">'. $call_content .'</p></div></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 jt-call-btns"><a href="'. esc_url($button1_link) .'" class="btn-primary jt-btn-call-action" style="'. $button1_color . $button1_size . $button1_border_color .'">'. esc_attr($button1_text) .'</a>'. $need_button .'</div></div>';
     }  else { $output=""; }
  return $output;
  }
}
add_shortcode( 'jt_call_to_action', 'juster_calltoaction' );

/* ==========================================================
    8. Dragslide
=========================================================== */
if ( !function_exists('juster_dragslide')) {
  function juster_dragslide( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'slide_images'  => '',
      'class'  => ''
    ), $atts));

    // Turn output buffer on
    ob_start();

    // Get Attachments
    $attachments = explode(",",$slide_images);
    //$attachments = array_combine($attachments,$attachments);
    ?>

    <div class="jt-stack <?php echo esc_attr($class); ?>">
      <?php if ($attachments) { ?>
        <ul id="jt-dragslide" class="stack_images">
        <?php
          wp_enqueue_script( 'elastiStack', SCRIPTS . '/dragcarousel/elastiStack.js', array( 'jquery' ), false, true );
          wp_enqueue_script( 'draggabilly', SCRIPTS . '/dragcarousel/draggabilly.pkgd.min.js', array( 'jquery' ), false, true );
          foreach ( $attachments as $attachment ) :

            if ( $attachment ) {
              $attachment_img = wp_get_attachment_url( $attachment );
            ?>
            <li><img src="<?php echo esc_attr($attachment_img); ?>" alt="" /></li>
           <?php } endforeach; ?>
        </ul>
      <?php } else { ?>
        <ul id="jt-dragslide" class="stack_images">
          <li><img src="<?php echo IMAGES .'/dummy/470x500.jpg'; ?>" alt="" /></li>
          <li><img src="<?php echo IMAGES .'/dummy/470x500.jpg'; ?>" alt="" /></li>
          <li><img src="<?php echo IMAGES .'/dummy/470x500.jpg'; ?>" alt="" /></li>
        </ul>
        <?php } ?>
    </div>

  <?php
    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'jt_dragslide_images', 'juster_dragslide' );

/* ==========================================================
   9. Timeline
=========================================================== */
if ( !function_exists('juster_timeline')) {
  function juster_timeline( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'timeline_year'  => '',
      'title_color'  => '',
      'content_color'  => '',
      'year_color'  => '',
      'date_color'  => '',
      'title_size'  => '',
      'content_size'  => '',
      'year_text_size'  => '',
      'date_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $timeline_style = ot_get_option('timeline_style');

    // Color
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $date_color ) {
      $date_color = 'color:'. $date_color .';';
    } else {
      $date_color ='';
    }
    if ( $year_color ) {
      $year_color = 'color:'. $year_color .';';
    } else {
      $year_color ='';
    }
    // Sizes
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }
    if ($date_size) {
      $date_size = 'font-size:'. esc_attr($date_size) .';';
    } else {
      $date_size ='';
    }
    if ($year_text_size) {
      $year_text_size = 'font-size:'. esc_attr($year_text_size) .';';
    } else {
      $year_text_size ='';
    }

    if ($page_model == 'full_width') {
      $page_model_class = 'jt-timeline-box';
    } else {
      $page_model_class = 'jt-timeline-wide';
    }

    // Turn output buffer on
    ob_start();
    ?>
    <div class="jt-timeline-wrapper <?php echo esc_attr($class); ?> <?php echo $page_model_class; ?>">

        <div class="jt-center-line"></div>
          <div class="jt-year-start" style="<?php echo $year_color;  ?><?php echo $year_text_size;  ?>"><?php echo esc_attr($timeline_year);  ?></div>
            <div class="jt-tym-content">
                <?php
                  if ($timeline_style) {
                  foreach($timeline_style as $time_line) {
                        echo '<div><div class="jt-round-connect"></div>
                            <div class="jt-box-header"><div class="jt-time-date" style="'. $date_color . $date_size . '">'. $time_line['timeline_date'] .'</div><div class="jt-time-title" style="'. $title_color . $title_size . '">'. esc_attr($time_line['title']) .'</div></div><div class="jt-time-content jt-popup-image" style="'. $content_color . $content_size . '">'. $time_line['timeline_content'] .'</div></div>';
                    }
                  } else { echo '';}
               ?>
            </div>
          <div class="jt-year-end"><img src="<?php echo IMAGES ?>/icons/time-icon-plus.png" alt="Endyear">
         </div>
    </div>
  <?php
    // Return outbut buffer
    return ob_get_clean();
    }
}
add_shortcode( 'jt_timeline', 'juster_timeline' );

/* ==========================================================
    10. Team Members
=========================================================== */
if ( !function_exists('juster_team_members')) {
  function juster_team_members( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'team_style'  => '',
      'column_type'  => '',
      'show_category'  => '',
      'team_limit'  => '',
      'need_content'  => '',
      'team_arrow_disable'  => '',
      'team_dots_disable'  => '',
      'disable_slide'  => '',
      'show_id'  => '',
      'team_order'  => '',
      'team_order_by'  => '',
      'need_vertical_image'  => '',
      'team_offset'  => '',
      'team_pagination'  => '',
      'class'  => '',

      'name_color'  => '',
      'profession_color'  => '',
      'icon_color'  => '',
      'content_color'  => '',
      'team_slide_color'  => '',
      'team_img_bg_color'  => '',

      'name_text_size'  => '',
      'profession_text_size'  => '',
      'icon_size'  => '',
      'content_size'  => '',

    ), $atts));

     // Color
    if ( $name_color ) {
      $name_color = 'color:'. $name_color .';';
    } else {
      $name_color ='';
    }
    if ( $profession_color ) {
      $profession_color = 'color:'. $profession_color .';';
    } else {
      $profession_color ='';
    }
    if ( $icon_color ) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $team_slide_color ) {
      $team_slide_color = 'background-color:'. $team_slide_color .';';
    } else {
      $team_slide_color ='';
    }
    if ( $team_img_bg_color ) {
      $team_img_bg_color = 'background-color:'. $team_img_bg_color .';';
    } else {
      $team_img_bg_color ='';
    }

    // Sizes
    if ($name_text_size) {
      $name_text_size = 'font-size:'. esc_attr($name_text_size) .';';
    } else {
      $name_text_size ='';
    }
    if ($profession_text_size) {
      $profession_text_size = 'font-size:'. esc_attr($profession_text_size) .';';
    } else {
      $profession_text_size ='';
    }
    if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }

    if ($column_type =='style-1') {
      $column_type = 'col-md-6 wpb_column team-hover-col-two';
    } else {
      $column_type = 'col-md-4 wpb_column team-hover-col-three';
    }

    if ($team_arrow_disable == 'yes') {
      $team_arrow_disable = 'jt-team-not-have-arrows';
    } else {
      $team_arrow_disable = 'jt-team-have-arrows';
    }

    if ($team_dots_disable == 'yes') {
      $team_dots_disable = 'jt-team-not-have-dots';
    } else {
      $team_dots_disable = 'jt-team-have-dots';
    }

    if ($disable_slide == 'yes') {
      $disable_slide = 'jt-team-members-single';
    } else {
      $disable_slide = 'jt-team-members-two';
    }

    if($need_vertical_image) {
        $vertical_img='wide-vertical-team';
    } else {
       $vertical_img='';
    }
    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );

    if($page_model == 'full_width') {
      $page_model_class1 ='jt-team-one-boxed';
      $page_model_class2 ='jt-team-two-boxed';
      $page_model_class3 ='jt-team-three-boxed';
      $page_model_class4 ='jt-team-four-boxed';
      $page_model_class5 ='jt-team-five-boxed';
    } else {
      $page_model_class1 ='jt-team-one-wide';
      $page_model_class2 ='jt-team-two-wide';
      $page_model_class3 ='jt-team-three-wide';
      $page_model_class4 ='jt-team-four-wide';
      $page_model_class5 ='jt-team-five-wide ';
    }

    wp_register_script( 'ellipsis', SCRIPTS . '/ellipsis.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'ellipsis' );

    // Turn output buffer on
    ob_start();

    if($team_style == 'style-1') {
    ?>
    <!-- Team Members Carousel -->
    <div class="jt-team-members jt-team-member-group-slide <?php echo $page_model_class1; ?> <?php echo $team_arrow_disable; ?> <?php echo $team_dots_disable; ?> <?php echo $vertical_img; ?> <?php echo esc_attr($class); ?>">
                <!-- Each Team Member -->
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
            if ($show_id) {
              $show_id = explode(',',$show_id);
            } else {
              $show_id = '';
            }

            if ($show_category) {
               $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'posts_per_page'  => (int)$team_limit,
                  'post_type' => 'team',
                  'tax_query'       => array(
                    array(
                      'taxonomy' => 'team_category',
                      'field' => 'slug',
                      'terms' => explode(',',$show_category),
                    ),
                  ),
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            } else {
                   $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'post_type' => 'team',
                  'posts_per_page'  => (int)$team_limit,
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            }

            $wpbp = new WP_Query( $args );
           // query_posts("post_type=Homepage&post='$show_id'");
            if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
            $group_members = get_post_meta($post->ID,'group_members',TRUE);
            $group_member_profession = get_post_meta($post->ID,'group_member_profession',true);

            if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                    $large_image = $large_image[0];

                    if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || $need_vertical_image) {
                        $member_img = aq_resize( $large_image, '370', '450', true );
                        if($member_img) {
                          $member_img = $member_img;
                        } else {
                          $member_img = IMAGES .'/dummy/370x450.jpg';
                        }
                    } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        $member_img = aq_resize( $large_image, '640', '450', true );
                        if($member_img) {
                          $member_img = $member_img;
                        } else {
                          $member_img = IMAGES .'/dummy/640x450.jpg';
                        }

                    } else {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                        if($member_img) {
                          $member_img = $member_img;
                        } else {
                          $member_img = IMAGES .'/dummy/640x450.jpg';
                        }
                    }
                    if ($need_vertical_image == 'yes') {
                       $member_img = aq_resize( $large_image, '370', '450', true );
                        if($member_img) {
                          $member_img = $member_img;
                        } else {
                          $member_img = IMAGES .'/dummy/370x450.jpg';
                        }
                    }
              } else {
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || $need_vertical_image) {
                        $member_img = IMAGES .'/dummy/370x450.jpg';
                    } else {
                       $member_img = IMAGES .'/dummy/640x450.jpg';
                    }
              }
              ?>
                 <div class="jt-each-team">
                    <div class="jt-team-normal">
                        <?php
                          echo '<img src="'. esc_attr($member_img) .'" alt="'. esc_attr(get_the_title()) .'"/>';
                        ?>
                    </div>
                    <div class="jt-team-over">
                          <h4 style="<?php echo $name_color;  ?><?php echo $name_text_size;  ?>"><?php esc_attr(the_title()); ?></h4>
                          <div class="jt-sep-two"></div>
                          <span class="team-profession" style="<?php echo $profession_color;  ?><?php echo $profession_text_size;  ?>"><?php echo esc_attr($group_member_profession); ?></span>
                          <?php if($need_content =='yes') { ?>
                            <div class="team-cont-details">
                             <p style="<?php echo $content_color;  ?><?php echo $content_size;  ?>"><?php echo $post->post_content; ?></p>
                            </div>
                          <?php } ?>
                        <ul class="social-icons">
                             <?php
                               if ($group_members) {
                               foreach($group_members as $group) {
                                    echo '<li><a href="'. esc_url($group['icon_link']) .'" target="_blank"><i class="'. esc_attr($group['icon']) .'" style="'. $icon_color . $icon_size . '"></i></a></li>';
                                   }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
          <?php endwhile; endif; ?>
        </div>
        <?php
        if ($team_pagination) {
          if ( function_exists('wp_pagenavi')) {
            wp_pagenavi(array( 'query' => $wpbp ) );
            wp_reset_postdata();  // avoid errors further down the page
          }
        } else {
          wp_reset_postdata();
        }
        ?>
        <!-- Team Members Carousel -->
 <?php } elseif($team_style == 'style-2') { ?>

       <div class="jt-team-member-single-slide <?php echo $page_model_class2; ?> <?php echo $disable_slide; ?> <?php echo esc_attr($class); ?>">
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
            if ($show_id) {
              $show_id = explode(',',$show_id);
            } else {
              $show_id = '';
            }

            if ($show_category) {
               $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'posts_per_page'  => (int)$team_limit,
                  'post_type' => 'team',
                  'tax_query'       => array(
                    array(
                      'taxonomy' => 'team_category',
                      'field' => 'slug',
                      'terms' => explode(',',$show_category),
                    ),
                  ),
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            } else {
                   $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'post_type' => 'team',
                  'posts_per_page'  => (int)$team_limit,
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            }

            $wpbp = new WP_Query( $args );

            if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
            $group_members = get_post_meta($post->ID,'group_members',TRUE);
            $group_member_profession = get_post_meta($post->ID,'group_member_profession',TRUE);
            if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                  $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                  $large_image = $large_image[0];
                  if ($disable_slide == 'jt-team-members-single') {
                        $member_img = $large_image;
                        if($member_img) {
                          $member_img = $member_img;
                        } else {
                          $member_img = IMAGES .'/dummy/1140x700.jpg';
                        }
                  } else {
                    $member_img = aq_resize( $large_image, '1140', '700', true );
                        if($member_img) {
                          $member_img = $member_img;
                        } else {
                          $member_img = IMAGES .'/dummy/1140x700.jpg';
                        }
                  }
              } else {
                $member_img = IMAGES .'/dummy/1140x700.jpg';
              }
         ?>
             <div class="jt-each-team">
                    <div class="jt-team-normal">
                        <?php
                          echo '<img src="'. esc_attr($member_img) .'" alt="'. esc_attr(get_the_title()) .'"/>';
                        ?>
                    </div>
                    <div class="jt-team-over">
                        <h4 style="<?php echo $name_color;  ?><?php echo $name_text_size;  ?>"> <?php esc_attr(the_title()); ?></h4>
                        <div class="jt-sep-two"></div>
                        <span class="team-profession" style="<?php echo $profession_color;  ?><?php echo $profession_text_size;  ?>"><?php echo esc_attr($group_member_profession); ?></span>
                        <ul class="social-icons">
                             <?php
                               if ($group_members) {
                               foreach($group_members as $group) {
                                    echo '<li><a href="'. esc_url($group['icon_link']) .'" target="_blank"><i class="'. esc_attr($group['icon']) .'" style="'. $icon_color . $icon_size . '"></i></a></li>';
                                   }
                                }
                            ?>
                        </ul>
                    </div>
                </div>

          <?php  endwhile; endif; ?>
    </div>
    <?php
    if ($team_pagination) {
      if ( function_exists('wp_pagenavi')) {
        wp_pagenavi(array( 'query' => $wpbp ) );
        wp_reset_postdata();  // avoid errors further down the page
      }
    } else {
      wp_reset_postdata();
    }
    ?>
 <?php  } elseif($team_style == 'style-3') { ?>
      <div class="jt-team-member-style-three <?php echo $page_model_class3; ?> <?php echo $vertical_img; ?> <?php echo esc_attr($class); ?>">
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
            if ($show_id) {
              $show_id = explode(',',$show_id);
            } else {
              $show_id = '';
            }

            if ($show_category) {
               $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'posts_per_page'  => (int)$team_limit,
                  'post_type' => 'team',
                  'tax_query'       => array(
                    array(
                      'taxonomy' => 'team_category',
                      'field' => 'slug',
                      'terms' => explode(',',$show_category),
                    ),
                  ),
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            } else {
                   $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'post_type' => 'team',
                  'posts_per_page'  => (int)$team_limit,
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            }

            $wpbp = new WP_Query( $args );

            if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
            $group_members = get_post_meta($post->ID,'group_members',TRUE);
            $group_member_profession = get_post_meta($post->ID,'group_member_profession',TRUE);

            if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                    $large_image = $large_image[0];
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt)) {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '570', '380', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/570x380.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '390', '400', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/390x400.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '390', '400', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/390x400.jpg';
                      }
                    }
            } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '960', '550', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/960x550.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    }
            } else {
                   if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '960', '550', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/960x550.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    }
          }
        } else {
              if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt)) {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/570x380.jpg';
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/390x400.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/390x400.jpg';
                    }
                } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    }
                } else {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    }
                }
          }
          $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
          $large_image = $large_image[0];
          if($need_vertical_image && $page_model == 'extra_width' || $need_vertical_image && $page_model == 'full_width'){
             if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                $member_img = aq_resize( $large_image, '590', '600', true );
                 if($member_img) {
                  $member_img=$member_img;
                } else {
                  $member_img= IMAGES .'/dummy/590x600.jpg';
                }
              } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                $member_img = aq_resize( $large_image, '390', '400', true );
                if($member_img) {
                  $member_img=$member_img;
                } else {
                  $member_img= IMAGES .'/dummy/390x400.jpg';
                }
              } else {
                $member_img = aq_resize( $large_image, '390', '350', true );
                if($member_img) {
                  $member_img=$member_img;
                } else {
                  $member_img= IMAGES .'/dummy/390x400.jpg';
                }
              }
          }
         ?>
         <div class="<?php echo $column_type; ?>">
            <div class="jt-each-team jt-team-style-two jt-group-normal">
                <div class="jt-team-normal">
                <?php
                    echo '<img src="'. esc_attr($member_img) .'" alt="'. esc_attr(get_the_title()) .'"/>';
                ?>
                </div>
                <div class="jt-team-over">
                    <div class="jt-team-position">
                        <h4 style="<?php echo $name_color;  ?><?php echo $name_text_size;  ?>"><?php esc_attr(the_title()); ?></h4>
                        <div class="jt-sep-two"></div>
                        <span class="team-profession" style="<?php echo $profession_color;  ?><?php echo $profession_text_size;  ?>"><?php echo esc_attr($group_member_profession); ?></span>
                         <?php if($need_content =='yes') { ?>
                              <p class="jt-team-cont-style" style="<?php echo $content_color;  ?><?php echo $content_size;  ?>"><?php echo $post->post_content; ?></p>
                            <?php } ?>
                        <ul class="social-icons">
                            <?php
                               if ($group_members) {
                               foreach($group_members as $group) {
                                    echo '<li><a href="'. esc_url($group['icon_link']) .'" target="_blank"><i class="'. esc_attr($group['icon']) .'" style="'. $icon_color . $icon_size . '"></i></a></li>';
                                   }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
          </div>
      <?php endwhile; endif; ?>
    </div>
    <?php
    if ($team_pagination) {
      if ( function_exists('wp_pagenavi')) {
        wp_pagenavi(array( 'query' => $wpbp ) );
        wp_reset_postdata();  // avoid errors further down the page
      }
    } else {
      wp_reset_postdata();
    }
    ?>
    <?php } elseif($team_style == 'style-4') { ?>
    <div class="jt-team-member-style-four <?php echo $page_model_class4; ?> <?php echo $vertical_img; ?> <?php echo esc_attr($class); ?>">
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
            if ($show_id) {
              $show_id = explode(',',$show_id);
            } else {
              $show_id = '';
            }

            if ($show_category) {
               $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'posts_per_page'  => (int)$team_limit,
                  'post_type' => 'team',
                  'tax_query'       => array(
                    array(
                      'taxonomy' => 'team_category',
                      'field' => 'slug',
                      'terms' => explode(',',$show_category),
                    ),
                  ),
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            } else {
                   $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'post_type' => 'team',
                  'posts_per_page'  => (int)$team_limit,
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            }

            $wpbp = new WP_Query( $args );

            if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
            $group_members = get_post_meta($post->ID,'group_members',TRUE);
            $group_member_profession = get_post_meta($post->ID,'group_member_profession',TRUE);

           if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                    $large_image = $large_image[0];
                    if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt =='yes')) {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '530', '530', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/530x530.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '350', '350', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/350x350.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '350', '350', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/350x350.jpg';
                      }
                    }
            } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '910', '910', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/910x910.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '600', '600', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/600x600.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '600', '600', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/600x600.jpg';
                      }
                    }
            } else {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '530', '530', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/530x530.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '350', '350', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/350x350.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '350', '350', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/350x350.jpg';
                      }
                    }
          }
        } else {
              if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt =='yes')) {
                    if ($column_type === 'wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/530x530.jpg';
                    } elseif ($column_type === 'wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/350x350.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/350x350.jpg';
                    }
                } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                    if ($column_type === 'wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/910x910.jpg';
                    } elseif ($column_type === 'wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/600x600.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/600x600.jpg';
                    }
                } else {
                    if ($column_type === 'wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/910x910.jpg';
                    } elseif ($column_type === 'wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/600x600.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/600x600.jpg';
                    }
                }
          }
          $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
          $large_image = $large_image[0];
          if($need_vertical_image) {
                $member_img = aq_resize( $large_image, '350', '350', true );
                if($member_img) {
                  $member_img=$member_img;
                } else {
                  $member_img= IMAGES .'/dummy/350x350.jpg';
                }
          }
         ?>
          <div class="<?php echo $column_type; ?>">
            <div class="jt-vint-team-wrap">
                <div class="jt-vint-team">
                  <div class="jt-vint-img">
                    <?php
                        echo '<img src="'. esc_attr($member_img) .'" alt="'. esc_attr(get_the_title()) .'"/>';
                    ?>
                    </div>
                    <div class="jt-vint-team-overlay">
                        <div class="jt-vint-team-hover-cont">
                            <?php if($need_content =='yes') { ?>
                            <p style="<?php echo $content_color;  ?><?php echo $content_size;  ?>"><?php echo $post->post_content; ?></p>
                            <?php } ?>
                            <ul class="jt-social-two">
                                <?php
                                   if ($group_members) {
                                   foreach($group_members as $group) {
                                        echo '<li><a href="'. esc_url($group['icon_link']) .'" target="_blank"><i class="'. esc_attr($group['icon']) .'" style="'. $icon_color . $icon_size . '"></i></a></li>';
                                       }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="jt-vint-team-detail">
                    <h3 style="<?php echo $name_color;  ?><?php echo $name_text_size;  ?>"><?php esc_attr(the_title()); ?></h3>
                    <span class="jt-vint-sep"></span>
                    <p style="<?php echo $profession_color;  ?><?php echo $profession_text_size;  ?>"><?php echo esc_attr($group_member_profession); ?></p>
                </div>
            </div>
          </div>
         <?php endwhile; endif; ?>
    </div>
    <?php
    if ($team_pagination) {
      if ( function_exists('wp_pagenavi')) {
        wp_pagenavi(array( 'query' => $wpbp ) );
        wp_reset_postdata();  // avoid errors further down the page
      }
    } else {
      wp_reset_postdata();
    }
    ?>
    <?php } elseif($team_style == 'style-5') { ?>
    <div class="jt-team-member-style-five <?php echo $page_model_class5; ?> <?php echo $vertical_img; ?> <?php echo esc_attr($class); ?>">
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
            if ($show_id) {
              $show_id = explode(',',$show_id);
            } else {
              $show_id = '';
            }

            if ($show_category) {
               $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'posts_per_page'  => (int)$team_limit,
                  'post_type' => 'team',
                  'tax_query'       => array(
                    array(
                      'taxonomy' => 'team_category',
                      'field' => 'slug',
                      'terms' => explode(',',$show_category),
                    ),
                  ),
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            } else {
                   $args = array(
                  // other query params here,
                  'paged' =>$my_page,
                  'post_type' => 'team',
                  'posts_per_page'  => (int)$team_limit,
                  'post__in' => $show_id,
                  'offset' => (!(int)$team_offset ? "" : (int)$team_offset),
                  'orderby' => $team_order_by,
                  'order' => $team_order
                );
            }

            $wpbp = new WP_Query( $args );

            if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
            $group_members = get_post_meta($post->ID,'group_members',TRUE);
            $group_member_profession = get_post_meta($post->ID,'group_member_profession',TRUE);

           if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                $large_image = $large_image[0];
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt)) {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '570', '380', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/570x380.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '390', '400', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/390x400.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '390', '400', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/390x400.jpg';
                      }
                    }
            } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '960', '550', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/960x550.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    }
            } else {
                   if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = aq_resize( $large_image, '960', '550', true );
                       if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/960x550.jpg';
                      }
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    } else {
                      $member_img = aq_resize( $large_image, '640', '450', true );
                      if($member_img) {
                        $member_img=$member_img;
                      } else {
                        $member_img= IMAGES .'/dummy/640x450.jpg';
                      }
                    }
          }
        } else {
              if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt)) {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/590x380.jpg';
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/390x400.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/390x400.jpg';
                    }
                } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    }
                } else {
                    if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                      $member_img = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    } else {
                      $member_img = IMAGES .'/dummy/640x450.jpg';
                    }
                }
          }
          $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
          $large_image = $large_image[0];
          if($need_vertical_image && $page_model == 'extra_width' || $need_vertical_image && $page_model == 'full_width'){
             if ($column_type === 'col-md-6 wpb_column team-hover-col-two') {
                $member_img = aq_resize( $large_image, '590', '600', true );
                 if($member_img) {
                  $member_img=$member_img;
                } else {
                  $member_img= IMAGES .'/dummy/590x600.jpg';
                }
              } elseif ($column_type === 'col-md-4 wpb_column team-hover-col-three') {
                $member_img = aq_resize( $large_image, '390', '470', true );
                if($member_img) {
                  $member_img=$member_img;
                } else {
                  $member_img= IMAGES .'/dummy/390x470.jpg';
                }
              } else {
                $member_img = aq_resize( $large_image, '390', '370', true );
                if($member_img) {
                  $member_img=$member_img;
                } else {
                  $member_img= IMAGES .'/dummy/390x470.jpg';
                }
              }
          }
         ?>
            <div class="<?php echo $column_type; ?>">
              <div class="jt-corp-team-wrapper">
                <div class="jt-corp-team" style="<?php echo $team_img_bg_color;  ?>">
                    <div class="jt-corp-team-member">
                        <?php
                            echo '<img src="'. esc_attr($member_img) .'" alt="'. esc_attr(get_the_title()) .'"/>';
                        ?>
                    </div>
                    <div class="jt-corp-team-cont-wrap" style="<?php echo $team_slide_color;  ?>">
                        <div class="jt-corp-team-cont">
                            <?php if($need_content =='yes') { ?>
                              <p style="<?php echo $content_color;  ?><?php echo $content_size;  ?>"><?php echo $post->post_content; ?></p>
                            <?php } ?>
                            <ul class="jt-corp-social">
                              <?php
                                 if ($group_members) {
                                 foreach($group_members as $group) {
                                      echo '<li><a href="'. esc_url($group['icon_link']) .'" target="_blank"><i class="'. esc_attr($group['icon']) .'" style="'. $icon_color . $icon_size . '"></i></a></li>';
                                     }
                                  }
                              ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="jt-corp-designation">
                     <h3 style="<?php echo $name_color;  ?><?php echo $name_text_size;  ?>"><?php esc_attr(the_title()); ?></h3>
                     <p style="<?php echo $profession_color;  ?><?php echo $profession_text_size;  ?>"><?php echo esc_attr($group_member_profession); ?></p>
                </div>
              </div>
            </div>
         <?php endwhile; endif; ?>
    </div>
    <?php
    if ($team_pagination) {
      if ( function_exists('wp_pagenavi')) {
        wp_pagenavi(array( 'query' => $wpbp ) );
        wp_reset_postdata();  // avoid errors further down the page
      }
    } else {
      wp_reset_postdata();
    }
    ?>
    <?php } else {}
    // Return outbut buffer
    return ob_get_clean();
 }
}
add_shortcode( 'jt_team_members', 'juster_team_members' );

/* ==========================================================
    11. Process Styles
=========================================================== */
if ( !function_exists('juster_process')) {
  function juster_process( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'process_style'  => '',
      'number_style1'  => '',
      'number1'  => '',
      'number_image1'  => '',
      'process_img_one'  => '',
      'title1'  => '',
      'content1'  => '',
      'icon1'   => '',
      'right_sep_one'  => '',

      'number_style2'  => '',
      'number2'  => '',
      'number_image2'  => '',
      'process_img_two'  => '',
      'title2'   => '',
      'content2'   => '',
      'icon2'   => '',
      'right_sep_two'  => '',

      'number_style3'  => '',
      'number3'  => '',
      'number_image3'  => '',
      'process_img_three'  => '',
      'title3'   => '',
      'content3'  => '',
      'icon3'  => '',
      'right_sep_three'  => '',

      'number_style4'  => '',
      'number4'  => '',
      'number_image4'  => '',
      'process_img_four'  => '',
      'title4'  => '',
      'content4'   => '',
      'icon4'   => '',

      'center_text'   => '',
      'number_color'  => '',
      'title_color'   => '',
      'content_color'   => '',
      'icon_color'  => '',
      'center_text_color'   => '',
      'number_size'  => '',
      'title_size'   => '',
      'title_size'   => '',
      'content_size'  => '',
      'icon_size'   => '',
      'center_text_size'   => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );

    // Color
    if ( $number_color ) {
      $number_color = 'color:'. $number_color .';';
    } else {
      $number_color ='';
    }
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $icon_color ) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color ='';
    }
    if ( $center_text_color ) {
      $center_text_color = 'color:'. $center_text_color .';';
    } else {
      $center_text_color ='';
    }

    // Sizes
    if ($number_size) {
      $number_size = 'font-size:'. esc_attr($number_size) .';';
    } else {
      $number_size ='';
    }
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }
    if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }
    if ($center_text_size) {
      $center_text_size = 'font-size:'. esc_attr($center_text_size) .';';
    } else {
      $center_text_size ='';
    }

    if ($process_img_one) {
      $process_image1 = wp_get_attachment_url( $process_img_one );
      $process_img_one = '<img src="'. esc_attr($process_image1) .'" alt="">';
    } else {
      $process_img_one = '';
    }

    if ($process_img_two) {
      $process_image2 = wp_get_attachment_url( $process_img_two );
      $process_img_two = '<img src="'. esc_attr($process_image2) .'" alt="">';
    } else {
       $process_img_two ='';
    }

    if ($process_img_three) {
      $process_image3 = wp_get_attachment_url( $process_img_three );
      $process_img_three = '<img src="'. esc_attr($process_image3) .'" alt="">';
    } else {
      $process_img_three ='';
    }

    if ($process_img_four) {
      $process_image4 = wp_get_attachment_url( $process_img_four );
      $process_img_four = '<img src="'. esc_attr($process_image4) .'" alt="">';
    } else {
      $process_img_four ='';
    }

    if ($right_sep_one == 'yes' || $right_sep_two == 'yes' || $right_sep_three == 'yes') {
      $right_sep = 'jt-corp-process-sep';
    } else {
      $right_sep = '';
    }

    if ($number_image1) {
      $image_url1 = wp_get_attachment_url( $number_image1 );
      $number_image1 = '<img src="'. $image_url1 .'" alt="">';
    } else {
      $number_image1 ='';
    }
    if ($number_style1 == 'style-1') {
      $number_style1 = esc_attr($number1);
    } else {
      $number_style1 = $number_image1;
    }

    if ($number_image2) {
      $image_url2 = wp_get_attachment_url( $number_image2 );
      $number_image2 = '<img src="'. $image_url2 .'" alt="">';
    } else {
      $number_image2 = '';
    }
    if ($number_style2 == 'style-1') {
      $number_style2 = esc_attr($number2);
    } else {
       $number_style2 = $number_image2;
    }

    if ($number_image3) {
      $image_url3 = wp_get_attachment_url( $number_image3 );
      $number_image3 = '<img src="'. $image_url3 .'" alt="">';
    } else {
      $number_image3 = '';
    }
    if ($number_style3 == 'style-1') {
      $number_style3 = esc_attr($number3);
    } else {
       $number_style3 = $number_image3;
    }

    if ($number_image4) {
      $image_url4 = wp_get_attachment_url( $number_image4 );
      $number_image4 = '<img src="'. $image_url4 .'" alt="">';
    } else {
      $number_image4 = '';
    }
    if ($number_style4 == 'style-1') {
      $number_style4 = esc_attr($number4);
    } else {
       $number_style4 = $number_image4;
    }

    if ($page_model == 'full_width') {
      $page_model_class = ' jt-process-boxed';
    } else {
      $page_model_class = ' jt-process-extrawidth';
    }

    if($process_style == 'style-1') {
    $output = '<div class="jt-process-wrapper '. esc_attr($class) . $page_model_class .'">
                <ul class="jt-process-cnt">
                    <li>
                        <div class="jt-process-content">
                            <div class="jt-cnt-icon"><i class="'. esc_attr($icon1) .'" style="'. $icon_color . $icon_size .'"></i></div>
                            <div class="jt-cnt-num" style="'. $number_color . $number_size .'">'. $number_style1 .'</div>
                            <div class="jt-cnt-heading" style="'. $title_color . $title_size .'">'. esc_attr($title1) .'</div>
                            <p style="'. $content_color . $content_size .'">'. esc_attr($content1) .'</p>
                        </div>
                    </li>
                    <li>
                        <div class="jt-process-content">
                            <div class="jt-cnt-icon"><i class="'. esc_attr($icon2) .'" style="'. $icon_color . $icon_size .'"></i></div>
                            <div class="jt-cnt-num" style="'. $number_color . $number_size .'">'. $number_style2 .'</div>
                            <div class="jt-cnt-heading" style="'. $title_color . $title_size .'">'. esc_attr($title2) .'</div>
                            <p style="'. $content_color . $content_size .'">'. esc_attr($content2) .'</p>
                        </div>
                    </li>
                    <li>
                        <div class="jt-process-content">
                            <div class="jt-cnt-icon"><i class="'. esc_attr($icon3) .'" style="'. $icon_color . $icon_size .'"></i></div>
                            <div class="jt-cnt-num" style="'. $number_color . $number_size .'">'. $number_style3 .'</div>
                            <div class="jt-cnt-heading" style="'. $title_color . $title_size .'">'. esc_attr($title3) .'</div>
                            <p style="'. $content_color . $content_size .'">'. esc_attr($content3) .'</p>
                        </div>
                    </li>
                    <li>
                        <div class="jt-process-content">
                            <div class="jt-cnt-icon"><i class="'. esc_attr($icon4) .'" style="'. $icon_color . $icon_size .'"></i></div>
                            <div class="jt-cnt-num" style="'. $number_color . $number_size .'">'. $number_style4 .'</div>
                            <div class="jt-cnt-heading" style="'. $title_color . $title_size .'">'. esc_attr($title4) .'</div>
                            <p style="'. $content_color . $content_size .'">'. esc_attr($content4) .'</p>
                        </div>
                    </li>
                </ul>
                <div class="jt-process-round-wrapper">
                    <div class="jt-process-round"></div>
                    <h4 style="'. $center_text_color . $center_text_size .'">'. esc_attr($center_text) .'</h4>
                </div>
            </div>';
    } elseif($process_style =='style-2') {
      $output='<div class="'. esc_attr($class) . $page_model_class .'">
            <div class="col-sm-3">
                <div class="jt-corp-process '. $right_sep .'">
                    <span>'. $process_img_one .'</span>
                    <h3 style="'. $title_color . $title_size .'">'. esc_attr($title1) .'</h3>
                    <p style="'. $content_color . $content_size .'">'. esc_attr($content1) .'</p>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="jt-corp-process '. $right_sep .'">
                    <span>'. $process_img_two .'</span>
                    <h3 style="'. $title_color . $title_size .'">'. esc_attr($title2) .'</h3>
                    <p style="'. $content_color . $content_size .'">'. esc_attr($content2) .'</p>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="jt-corp-process '. $right_sep .'">
                    <span>'. $process_img_three .'</span>
                    <h3 style="'. $title_color . $title_size .'">'. esc_attr($title3) .'</h3>
                    <p style="'. $content_color . $content_size .'">'. esc_attr($content3) .'</p>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="jt-corp-process">
                    '. $process_img_four .'
                    <h3 style="'. $title_color . $title_size .'">'. esc_attr($title4) .'</h3>
                    <p style="'. $content_color . $content_size .'">'. esc_attr($content4) .'</p>
                </div>
            </div>
        </div>';
    } else { $output='';}
    return $output;
  }
}
add_shortcode( 'jt_process', 'juster_process' );

/* ==========================================================
    12. Portfolio
=========================================================== */
if ( !function_exists('juster_portfolio')) {
  function juster_portfolio( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'portfolio_style' => '',
      'portfolio_columns'  => '',
      'need_left_design'  => '',
      'hover_style'  => '',
      'portfolio_limit'  => '8',
      'enable_cat_filter'  => '',
      'enable_cat_backtext'  => '',
      'portfolio_order'  => '',
      'portfolio_order_by'  => '',
      'port_offset'  => '',
      'show_category'  => '',
      'enable_pagination'  => '',
      'extra_class'  => '',

      'filter_type'  => '',
      'heading_alignment'  => '',
      'main_heading_text'  => '',
      'main_heading_color'  => '',
      'main_heading_size'  => '',
      'heading_bottom_space'  => '',
      'studio_heading'  => '',
      'studio_sub_heading'  => '',
      'studio_content'  => '',
      'heading_color'  => '',
      'sub_heading_color'  => '',
      'content_color'  => '',
      'heading_size'  => '',
      'sub_heading_size'  => '',
      'content_size'  => '',

      'title_color'  => '',
      'category_color'  => '',

      'title_size'  => '',
      'category_size'  => '',

    ), $atts));

    if($portfolio_style) {
      $portfolio_style = $portfolio_style;
    } else {
      $portfolio_style = 'style-1';
    }

  if($portfolio_style == 'style-1' || $portfolio_style == 'style-2') {
    if($hover_style) {
      $hover_style = $hover_style;
    } else {
      $hover_style = 'style-one';
    }
  } else {
    $portfolio_columns = '';
  }

  if($portfolio_style == 'style-1' || $portfolio_style == 'style-2') {
    if($portfolio_columns) {
      $portfolio_columns = $portfolio_columns;
    } else {
      $portfolio_columns = 'jt-port-col-4';
    }
  } else {
    $portfolio_columns = '';
  }

    // Color
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $category_color ) {
      $category_color = 'color:'. $category_color .';';
    } else {
      $category_color ='';
    }
    if ( $main_heading_color ) {
      $main_heading_color = 'color:'. $main_heading_color .';';
    } else {
      $main_heading_color ='';
    }
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $sub_heading_color ) {
      $sub_heading_color = 'color:'. $sub_heading_color .';';
    } else {
      $sub_heading_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }

    // Sizes
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($category_size) {
      $category_size = 'font-size:'. esc_attr($category_size) .';';
    } else {
      $category_size ='';
    }
    if ($main_heading_size) {
      $main_heading_size = 'font-size:'. esc_attr($main_heading_size) .';';
    } else {
      $main_heading_size ='';
    }
    if ($heading_bottom_space) {
      $heading_bottom_space = 'padding-bottom:'. esc_attr($heading_bottom_space) .';';
    } else {
      $heading_bottom_space ='';
    }
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($sub_heading_size) {
      $sub_heading_size = 'font-size:'. esc_attr($sub_heading_size) .';';
    } else {
      $sub_heading_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }

    if ($need_left_design =='yes') {
      $need_left_content = 'jt-have-left-content';
    } else {
      $need_left_content ='';
    }

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $global_model = ot_get_option('fullwidth_boxed');
    $content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );

    // Turn output buffer on
    ob_start(); ?>
    <div class="jt-portfolio-part <?php echo esc_attr($extra_class); ?>">
    <?php
    if ($enable_cat_filter) {
      if ($filter_type == 'filter-1') {
        if ($show_category){
                  $pf_item_slugs = str_replace(', ', ',', $show_category);
                  $pf_item_slugs = rtrim($pf_item_slugs, ',');
                  $pf_item_slugs =  explode(",", $pf_item_slugs);

                  foreach ($pf_item_slugs as $pf_item_slug) {
                    $pf_show_only[] ='.catfilter li a.'. $pf_item_slug;
                  }
                  $pf_show_only = implode(', ', $pf_show_only);
                  echo '<style>.catfilter li a{display:none;} .catfilter li a.all, ' . $pf_show_only . '{display:inline !important;}</style>';
          }
        /* Category Filter */
          if($heading_alignment =='left') { ?>
          <div class="container">
          <div class="jt-filter-wrapper jt-filter-right sep-hover-control" style="<?php echo $heading_bottom_space; ?>">
            <div class="col-lg-6">
          <?php  if($main_heading_text) { ?>
              <div class="jt-heading">
                  <h2 style="<?php echo $main_heading_color;  ?><?php echo $main_heading_size;  ?>"><?php echo esc_attr($main_heading_text); ?></h2>
                  <div class="jt-sep-two"></div>
              </div>
          <?php  } ?>
            </div>

            <div class="col-lg-6 filter-right-bg">
                  <!-- Portfolio Filter -->
                  <ul id="filters" class="jt-filter">
                  <?php if ($enable_cat_backtext =='yes') { ?>
                  <li class="back-text"><?php echo __('All', 'juster'); ?></li>
                  <?php } ?>
                  <li><a data-filter="*" class="filter" href="#0"><?php echo __('All', 'juster'); ?></a></li>
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
                  <!-- Portfolio Filter -->
            </div>
           </div>
          </div>
          <?php } elseif($heading_alignment =='right') { ?>
          <div class="container">
          <div class="jt-filter-wrapper jt-filter-left sep-hover-control" style="<?php echo $heading_bottom_space; ?>">
                <div class="col-lg-6 filter-left-bg">
                  <ul id="filters" class="jt-filter">
                  <?php if ($enable_cat_backtext =='yes') { ?>
                  <li class="back-text"><?php echo __('All', 'juster'); ?></li>
                  <?php } ?>
                  <li><a data-filter="*" class="filter" href="#0"><?php echo __('All', 'juster'); ?></a></li>
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

                <div class="col-lg-6">
                <?php  if($main_heading_text) { ?>
                      <div class="jt-heading">
                          <h2 style="<?php echo $main_heading_color;  ?><?php echo $main_heading_size;  ?>"><?php echo esc_attr($main_heading_text); ?></h2>
                          <div class="jt-sep-two"></div>
                      </div>
                <?php  } ?>
                </div>
          </div>
          </div>
          <?php } else { ?>
          <div class="container">
          <div class="jt-filter-wrapper jt-filter-center sep-hover-control" style="<?php echo $heading_bottom_space; ?>">

                <div class="col-lg-12">
                <?php  if($main_heading_text) { ?>
                    <div class="jt-heading">
                        <h2 style="<?php echo $main_heading_color;  ?><?php echo $main_heading_size;  ?>"><?php echo esc_attr($main_heading_text); ?></h2>
                        <div class="jt-sep"></div>
                    </div>
                <?php  } ?>
                </div>

                <!-- Portfolio Filter -->
                <div class="col-lg-12">
                  <ul id="filters" class="jt-filter">
                  <?php if ($enable_cat_backtext =='yes') { ?>
                  <li class="back-text"><?php echo __('All', 'juster'); ?></li>
                  <?php } ?>
                  <li><a data-filter="*" class="filter" href="#0"><?php echo __('All', 'juster'); ?></a></li>
                        <?php
                        if ($show_category) {
                          $cat_name = explode(',', $show_category);
                          $terms = $cat_name;
                          $count = count($terms);
                          if ($count > 0) {
                            foreach ($terms as $term) {
                              echo '<li class="cat-'. preg_replace('/\s+/', "", strtolower($term)) .'"><a href="#0" class="filter cat-'. preg_replace('/\s+/', "", strtolower($term)) .'" data-filter=".cat-'. preg_replace('/\s+/', "", strtolower($term)) .'" title="' . str_replace('-', " ", strtolower($term)) . '">' . str_replace('-', " ", strtolower($term)) . '</a></li>';
                             }
                          }
                        } else {
                          $terms = get_terms('portfolio_category');
                          $count = count($terms);
                          $i=0;
                          $term_list = '';
                          if ($count > 0) {
                            foreach ($terms as $term) {
                              $i++;
                              $term_list .= '<li class="cat-'. $term->slug .'"><a href="#0" class="filter cat-'. $term->slug .'" data-filter=".cat-'. $term->slug .'" title="' . esc_attr($term->name) . '">' . $term->name . '</a></li>';
                              if ($count != $i) {
                                $term_list .= '';
                              } else {
                                $term_list .= '';
                              }
                            }
                            echo $term_list;
                          }
                        }
                        ?>
                  </ul>
                </div>
                <!-- Portfolio Filter -->
          </div>
          </div>
          <?php }  ?>
          <div class="clearfix"></div>
      <?php } elseif ($filter_type == 'filter-2') { ?>
          <div class="jt-port-filter-style-three">
              <div class="jt-hamburger">
                  <div class="jt-ham-nav">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
              </div>
              <ul id="filters" class="jt-slide-filter-list">
                  <li><a data-filter="*" class="filter active" href="#0"><?php echo __('All', 'juster'); ?></a></li>
                 <?php
                  if ($show_category) {
                    $cat_name = explode(',', $show_category);
                    $terms = $cat_name;
                    $count = count($terms);
                    if ($count > 0) {
                      foreach ($terms as $term) {
                        echo '<li class="cat-'. preg_replace('/\s+/', "", strtolower($term)) .'"><a href="#0" class="filter cat-'. preg_replace('/\s+/', "", strtolower($term)) .'" data-filter=".cat-'. preg_replace('/\s+/', "", strtolower($term)) .'" title="' . str_replace('-', " ", strtolower($term)) . '">' . str_replace('-', " ", strtolower($term)) . '</a></li>';
                       }
                    }
                  } else {
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
                  }
                ?>
              </ul>
          </div>
      <?php } else { ?>
      <div class="jt-filter-wrapper jt-filter-right sep-hover-control jt-filter-wrapper-three">
          <!-- Portfolio Filter -->
          <ul id="filters" class="jt-filter">
              <li><a data-filter="*" class="filter active" href="#0"><?php echo __('All', 'juster'); ?></a></li>
              <?php
              if ($show_category) {
                $cat_name = explode(',', $show_category);
                $terms = $cat_name;
                $count = count($terms);
                if ($count > 0) {
                  foreach ($terms as $term) {
                    echo '<li class="cat-'. preg_replace('/\s+/', "", strtolower($term)) .'"><a href="#0" class="filter cat-'. preg_replace('/\s+/', "", strtolower($term)) .'" data-filter=".cat-'. preg_replace('/\s+/', "", strtolower($term)) .'" title="' . str_replace('-', " ", strtolower($term)) . '">' . str_replace('-', " ", strtolower($term)) . '</a></li>';
                   }
                }
              } else {
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
              }
              ?>
          </ul>
      </div>
      <?php } }
     global $post;

     if (($page_model == 'full_width') || (!$page_model == 'extra_width' && $global_model == 'full-width')) {
      $isotop_layout_class = 'isotope-layout-boxed';
     } else {
      $isotop_layout_class = 'isotope-layout-extrawidth';
     }

     if($hover_style == 'style-three') {
         if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') {
            $grid_style_three = 'jt-business-port grid-hover-style-three';
         } else {
         $grid_style_three = 'jt-able-filter jt-business-port grid-hover-style-three';
         }
         $hover_class_one = 'jt-port-img';
         $hover_class_shadow = 'left-part-design';
     } elseif($hover_style == 'style-one') {
         if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') {
            $grid_style_three = 'jt-portfolio-item vertical-hover-style-one';
         } else {
            $grid_style_three = 'jt-able-filter jt-portfolio-item vertical-hover-style-one';
         }
         $hover_class_one = 'jt-port-image';
         $hover_class_shadow = 'jt-white-hover';
      } elseif($hover_style == 'style-two') {
         if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') {
            $grid_style_three = 'jt-portfolio-item vertical-hover-style-two';
         } else {
         $grid_style_three = 'jt-able-filter jt-portfolio-item vertical-hover-style-two';
         }
         $hover_class_one = 'jt-port-image jt-arch-port-img';
         $hover_class_shadow = 'jt-hover-shadow';
      } elseif($hover_style == 'style-four') {
         if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') {
            $grid_style_three = 'jt-portfolio-item jt-studio-port';
         } else {
         $grid_style_three = 'jt-able-filter jt-portfolio-item jt-studio-port';
         }
         $hover_class_one = 'jt-port-image';
         $hover_class_shadow = 'jt-studio-hover';
      } elseif($hover_style == 'style-five') {
         if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') {
            $grid_style_three = 'jt-portfolio-item';
         } else {
         $grid_style_three = 'jt-able-filter jt-portfolio-item';
         }
         $hover_class_one = 'jt-port-image jt-arch-port-img';
         $hover_class_shadow = 'jt-vint-port';
      } elseif($hover_style == 'style-six') {
         if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') {
            $grid_style_three = 'jt-portfolio-item';
         } else {
         $grid_style_three = 'jt-able-filter jt-portfolio-item';
         }
         $hover_class_one = 'jt-port-image jt-arch-port-img';
         $hover_class_shadow = 'jt-corp-port have-gutter-space';
      } elseif($hover_style == 'style-seven') {
         if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') {
            $grid_style_three = 'jt-portfolio-item';
         } else {
         $grid_style_three = 'jt-able-filter jt-portfolio-item';
         }
         $hover_class_one = 'jt-port-image jt-arch-port-img';
         $hover_class_shadow = 'jt-boxed-port have-gutter-space';
      } else {
         $hover_class_one = '';
         $hover_class_shadow = '';
      }

      if($portfolio_style == 'style-2' && $hover_style == 'style-five') {
        $vintage_port_space = 'have-gutter-space';
       }  else {
        $vintage_port_space = '';
       }

      if($portfolio_style == 'style-1') {
        $portfolio_style_classes = ' portfolio-style-grid ';
      } elseif($portfolio_style == 'style-2') {
        $portfolio_style_classes = ' portfolio-style-masonry ';
      } elseif($portfolio_style == 'style-3') {
        $portfolio_style_classes = ' portfolio-style-parallax ';
      } else {
        $portfolio_style_classes = ' portfolio-style-nothing ';
      }
     ?>
    <?php if($portfolio_style == 'style-3') {
      wp_register_script( 'parallax-port', SCRIPTS . '/parallax-port/parallax.js', array( 'jquery' ), false, true );
      wp_enqueue_script( 'parallax-port' );
    ?>
    <div style="" id="scene" class="scene container unselectable" data-friction-x="0.1" data-friction-y="0.1" data-scalar-x="25" data-scalar-y="2">
          <div class="layer" data-depth="0.60">
    <?php } ?>
    <div class="isotope jt-portfolio-wrapper <?php echo $portfolio_style_classes .' '. $portfolio_columns .' '. $need_left_content .' '. $isotop_layout_class .' '. $vintage_port_space .' '. $hover_class_shadow; ?>">

       <?php if(($hover_style == 'style-six') || ($hover_style == 'style-seven') || ($hover_style == 'style-five') ) { ?>
        <div class="jt-gutter-sizer"></div>
       <?php
        if ($portfolio_columns == 'jt-port-col-2') { ?>
          <div class="jt-grid-sizer-2"></div>
        <?php } elseif ($portfolio_columns == 'jt-port-col-3') { ?>
          <div class="jt-grid-sizer-3"></div>
        <?php } elseif ($portfolio_columns == 'jt-port-col-4') { ?>
          <div class="jt-grid-sizer-4"></div>
        <?php } elseif ($portfolio_columns == 'jt-port-col-5') { ?>
          <div class="jt-grid-sizer-5"></div>
        <?php } ?>
      <?php } ?>

      <?php if($portfolio_style == 'style-2' && $hover_style == 'style-five') { ?>
        <div class="jt-gutter-sizer"></div>
       <?php
        if ($portfolio_columns == 'jt-port-col-2') { ?>
          <div class="jt-grid-sizer-2"></div>
        <?php } elseif ($portfolio_columns == 'jt-port-col-3') { ?>
          <div class="jt-grid-sizer-3"></div>
        <?php } elseif ($portfolio_columns == 'jt-port-col-4') { ?>
          <div class="jt-grid-sizer-4"></div>
        <?php } elseif ($portfolio_columns == 'jt-port-col-5') { ?>
          <div class="jt-grid-sizer-5"></div>
        <?php } ?>
      <?php } ?>

       <?php if ($portfolio_columns == 'jt-port-col-4' && $need_left_design == 'yes') { ?>
        <div class="col-sm-6 padding-zero jt-left-side-part">
            <div class="jt-studio-port-cont sep-hover-control">
              <?php if ($studio_sub_heading) { ?>
              <h3 style="<?php echo $sub_heading_color;  ?><?php echo $sub_heading_size; ?>"><?php echo esc_attr($studio_sub_heading); ?></h3>
              <div class="jt-sep-two"></div>
              <?php } ?>
              <h2 style="<?php echo $heading_color; ?><?php echo $heading_size; ?>"><?php echo esc_attr($studio_heading); ?></h2>
              <p style="<?php echo $content_color;  ?><?php echo $content_size; ?>"><?php echo esc_attr($studio_content); ?></p>
            </div>
        </div>
        <?php }
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
              'posts_per_page' => (int)$portfolio_limit,
              'portfolio_category' => esc_attr($show_category),
              'offset' => (!(int)$port_offset ? "" : (int)$port_offset),
              'orderby' => $portfolio_order_by,
              'order' => $portfolio_order
            );

            $wpbp = new WP_Query( $args );

            if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();

            $terms = wp_get_post_terms($post->ID, 'portfolio_category');
            $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
            $large_image = $large_image[0];

            if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
            if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
               if($portfolio_style == 'style-1') {
                  if ($portfolio_columns === 'jt-port-col-2') {
                    $portfolio_img = aq_resize( $large_image, '570', '380', true );
                    if($portfolio_img) {
                      $portfolio_img = $portfolio_img;
                    } else {
                      $portfolio_img= IMAGES .'/dummy/570x380.jpg';
                    }
                  } elseif ($portfolio_columns === 'jt-port-col-3') {
                    $portfolio_img = aq_resize( $large_image, '390', '320', true );
                     if($portfolio_img) {
                      $portfolio_img = $portfolio_img;
                    } else {
                      $portfolio_img = IMAGES .'/dummy/390x320.jpg';
                    }
                  } elseif ($portfolio_columns === 'jt-port-col-4') {
                    $portfolio_img = aq_resize( $large_image, '290', '250', true );
                     if($portfolio_img) {
                      $portfolio_img = $portfolio_img;
                    } else {
                      $portfolio_img= IMAGES .'/dummy/290x250.jpg';
                    }
                  } else {
                    $portfolio_img = aq_resize( $large_image, '250', '180', true );
                     if($portfolio_img) {
                      $portfolio_img = $portfolio_img;
                    } else {
                      $portfolio_img= IMAGES .'/dummy/250x180.jpg';
                    }
                  }
              } elseif($portfolio_style == 'style-2') {
                if ($portfolio_columns === 'jt-port-col-2') {
                  $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                  if ($select_portfolio_masonry_type == 'height-2') {
                    $portfolio_img = aq_resize( $large_image, '570', '190', true );
                  } elseif ($select_portfolio_masonry_type == 'height-3') {
                    $portfolio_img = aq_resize( $large_image, '570', '380', true );
                  } elseif ($select_portfolio_masonry_type == 'height-4') {
                    $portfolio_img = aq_resize( $large_image, '570', '570', true );
                  } else {
                    $portfolio_img = $large_image;
                  }
                  if($portfolio_img) {
                    $portfolio_img = $portfolio_img;
                  } else {
                    $portfolio_img= IMAGES .'/dummy/570x570.jpg';
                  }
                } elseif ($portfolio_columns === 'jt-port-col-3') {
                  $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                  if ($select_portfolio_masonry_type == 'height-2') {
                    $portfolio_img = aq_resize( $large_image, '570', '190', true );
                  } elseif ($select_portfolio_masonry_type == 'height-3') {
                    $portfolio_img = aq_resize( $large_image, '570', '380', true );
                  } elseif ($select_portfolio_masonry_type == 'height-4') {
                    $portfolio_img = aq_resize( $large_image, '570', '570', true );
                  } else {
                    $portfolio_img = $large_image;
                  }
                  if($portfolio_img) {
                    $portfolio_img = $portfolio_img;
                  } else {
                    $portfolio_img = IMAGES .'/dummy/570x570.jpg';
                  }
                } elseif ($portfolio_columns === 'jt-port-col-4') {
                  $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                  if ($select_portfolio_masonry_type == 'height-2') {
                    $portfolio_img = aq_resize( $large_image, '300', '265', true );
                  } elseif ($select_portfolio_masonry_type == 'height-3') {
                    $portfolio_img = aq_resize( $large_image, '300', '397', true );
                  } elseif ($select_portfolio_masonry_type == 'height-4') {
                    $portfolio_img = aq_resize( $large_image, '300', '530', true );
                  } else {
                    $portfolio_img = $large_image;
                  }
                  if($portfolio_img) {
                    $portfolio_img = $portfolio_img;
                  } else {
                    $portfolio_img= IMAGES .'/dummy/300x530.jpg';
                  }
                } else {
                  $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                  if ($select_portfolio_masonry_type == 'height-2') {
                    $portfolio_img = aq_resize( $large_image, '230', '200', true );
                  } elseif ($select_portfolio_masonry_type == 'height-3') {
                    $portfolio_img = aq_resize( $large_image, '230', '300', true );
                  } elseif ($select_portfolio_masonry_type == 'height-4') {
                    $portfolio_img = aq_resize( $large_image, '230', '400', true );
                  } else {
                    $portfolio_img = $large_image;
                  }
                  if($portfolio_img) {
                    $portfolio_img = $portfolio_img;
                  } else {
                    $portfolio_img= IMAGES .'/dummy/230x400.jpg';
                  }
                }
              } else {
                $portfolio_img = $large_image;
              }
            } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                  if($portfolio_style == 'style-1') {
                        if ($portfolio_columns === 'jt-port-col-2') {
                          $portfolio_img = aq_resize( $large_image, '960', '550', true );
                           if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/960x550.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-3') {
                          $portfolio_img = aq_resize( $large_image, '640', '450', true );
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/640x450.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-4') {
                          $portfolio_img = aq_resize( $large_image, '480', '400', true );
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/480x400.jpg';
                          }
                        } else {
                          $portfolio_img = aq_resize( $large_image, '385', '350', true );
                           if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/385x350.jpg';
                          }
                        }
              } elseif($portfolio_style == 'style-2') {
                        if ($portfolio_columns === 'jt-port-col-2') {
                          $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                          if ($select_portfolio_masonry_type == 'height-2') {
                            $portfolio_img = aq_resize( $large_image, '960', '350', true );
                          } elseif ($select_portfolio_masonry_type == 'height-3') {
                            $portfolio_img = aq_resize( $large_image, '960', '525', true );
                          } elseif ($select_portfolio_masonry_type == 'height-4') {
                            $portfolio_img = aq_resize( $large_image, '960', '700', true );
                          } else {
                            $portfolio_img = $large_image;
                          }
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/960x700.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-3') {
                          $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                          if ($select_portfolio_masonry_type == 'height-2') {
                            $portfolio_img = aq_resize( $large_image, '640', '350', true );
                          } elseif ($select_portfolio_masonry_type == 'height-3') {
                            $portfolio_img = aq_resize( $large_image, '640', '525', true );
                          } elseif ($select_portfolio_masonry_type == 'height-4') {
                            $portfolio_img = aq_resize( $large_image, '640', '700', true );
                          } else {
                            $portfolio_img = $large_image;
                          }
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/640x700.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-4') {
                          $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                          if ($select_portfolio_masonry_type == 'height-2') {
                            $portfolio_img = aq_resize( $large_image, '480', '400', true );
                          } elseif ($select_portfolio_masonry_type == 'height-3') {
                            $portfolio_img = aq_resize( $large_image, '480', '525', true );
                          } elseif ($select_portfolio_masonry_type == 'height-4') {
                            $portfolio_img = aq_resize( $large_image, '480', '700', true );
                          } else {
                            $portfolio_img = $large_image;
                          }
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/480x700.jpg';
                          }
                        } else {
                          $select_portfolio_masonry_type = get_post_meta( $post->ID, 'select_portfolio_masonry_type', true );
                          if ($select_portfolio_masonry_type == 'height-2') {
                            $portfolio_img = aq_resize( $large_image, '385', '350', true );
                          } elseif ($select_portfolio_masonry_type == 'height-3') {
                            $portfolio_img = aq_resize( $large_image, '385', '525', true );
                          } elseif ($select_portfolio_masonry_type == 'height-4') {
                            $portfolio_img = aq_resize( $large_image, '385', '700', true );
                          } else {
                            $portfolio_img = $large_image;
                          }
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/385x700.jpg';
                          }
                        }
              } else {
                      $portfolio_img = $large_image;
              }
            } else {
               if($portfolio_style == 'style-1') {
                        if ($portfolio_columns === 'jt-port-col-2') {
                          $portfolio_img = aq_resize( $large_image, '960', '550', true );
                           if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/960x550.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-3') {
                          $portfolio_img = aq_resize( $large_image, '640', '450', true );
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/640x450.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-4') {
                          $portfolio_img = aq_resize( $large_image, '480', '400', true );
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/480x400.jpg';
                          }
                        } else {
                          $portfolio_img = aq_resize( $large_image, '380', '350', true );
                           if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/380x350.jpg';
                          }
                        }
              } else {
                      $portfolio_img = $large_image;
              }
            }
          } else {
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                    if ($portfolio_columns === 'jt-port-col-2') {
                      $portfolio_img = IMAGES .'/dummy/590x380.jpg';
                    } elseif ($portfolio_columns === 'jt-port-col-3') {
                      $portfolio_img = IMAGES .'/dummy/390x320.jpg';
                    } elseif ($portfolio_columns === 'jt-port-col-4') {
                      $portfolio_img = IMAGES .'/dummy/290x250.jpg';
                    } else {
                      $portfolio_img = IMAGES .'/dummy/230x150.jpg';
                    }
                } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                     if ($portfolio_columns === 'jt-port-col-2') {
                      $portfolio_img = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($portfolio_columns === 'jt-port-col-3') {
                      $portfolio_img = IMAGES .'/dummy/640x450.jpg';
                    } elseif ($portfolio_columns === 'jt-port-col-4') {
                      $portfolio_img = IMAGES .'/dummy/480x400.jpg';
                    } else {
                      $portfolio_img = IMAGES .'/dummy/380x270.jpg';
                    }
                } else {
                   if ($portfolio_columns === 'jt-port-col-2') {
                      $portfolio_img = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($portfolio_columns === 'jt-port-col-3') {
                      $portfolio_img = IMAGES .'/dummy/640x450.jpg';
                    } elseif ($portfolio_columns === 'jt-port-col-4') {
                      $portfolio_img = IMAGES .'/dummy/480x350.jpg';
                    } else {
                      $portfolio_img = IMAGES .'/dummy/380x270.jpg';
                    }
                }
            }

        if($portfolio_style =='style-3') {
              $count_posts = $wpbp->current_post + 1;
              if( $count_posts == 1 || $count_posts == 11 || $count_posts == 21 || $count_posts == 31 || $count_posts == 41 || $count_posts == 51){
                $portfolio_img = aq_resize( $large_image, '511', '406', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/520x410.jpg';
                }
              } elseif($count_posts == 2 || $count_posts == 12 || $count_posts == 22 || $count_posts == 32 || $count_posts == 42 || $count_posts == 52) {
                $portfolio_img = aq_resize( $large_image, '511', '372', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/520x380.jpg';
                }
              } elseif($count_posts == 3 || $count_posts == 13 || $count_posts == 23 || $count_posts == 33 || $count_posts == 43 || $count_posts == 53) {
                $portfolio_img = aq_resize( $large_image, '511', '356', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/520x360.jpg';
                }
              } elseif($count_posts == 4 || $count_posts == 14 || $count_posts == 24 || $count_posts == 34 || $count_posts == 44 || $count_posts == 54) {
                $portfolio_img = aq_resize( $large_image, '511', '356', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/520x360.jpg';
                }
              } elseif($count_posts == 5 || $count_posts == 15 || $count_posts == 25 || $count_posts == 35 || $count_posts == 45 || $count_posts == 55) {
                $portfolio_img = aq_resize( $large_image, '462', '496', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/470x500.jpg';
                }
              } elseif($count_posts == 6 || $count_posts == 16 || $count_posts == 26 || $count_posts == 36 || $count_posts == 46 || $count_posts == 56) {
                $portfolio_img = aq_resize( $large_image, '511', '356', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/520x360.jpg';
                }
              } elseif($count_posts == 7 || $count_posts == 17 || $count_posts == 27 || $count_posts == 37 || $count_posts == 47 || $count_posts == 57) {
                $portfolio_img = aq_resize( $large_image, '531', '451', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/540x460.jpg';
                }
              } elseif($count_posts == 8 || $count_posts == 18 || $count_posts == 28 || $count_posts == 38 || $count_posts == 48 || $count_posts == 58) {
                $portfolio_img = aq_resize( $large_image, '507', '301', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/510x310.jpg';
                }
              } elseif($count_posts == 9 || $count_posts == 19 || $count_posts == 29 || $count_posts == 39 || $count_posts == 49 || $count_posts == 59) {
                $portfolio_img = aq_resize( $large_image, '551', '351', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/560x360.jpg';
                }
              } elseif($count_posts == 10 || $count_posts == 20 || $count_posts == 30 || $count_posts == 40 || $count_posts == 50 || $count_posts == 60) {
                $portfolio_img = aq_resize( $large_image, '488', '451', true );
                if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/490x460.jpg';
                }
              } else {
                $portfolio_img = aq_resize( $large_image, '511', '406', true );
                 if($portfolio_img) {
                  $portfolio_img = $portfolio_img;
                } else {
                  $portfolio_img= IMAGES .'/dummy/520x410.jpg';
                }
              }
          }

        if($hover_style =='style-three') {
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                  if($portfolio_style == 'style-1') {
                     if ($portfolio_columns === 'jt-port-col-2') {
                          $portfolio_img = aq_resize( $large_image, '590', '600', true );
                           if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/590x600.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-3') {
                          $portfolio_img = aq_resize( $large_image, '390', '400', true );
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/390x400.jpg';
                          }
                        } elseif ($portfolio_columns === 'jt-port-col-4') {
                          $portfolio_img = aq_resize( $large_image, '290', '300', true );
                          if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/290x300.jpg';
                          }
                        } else {
                          $portfolio_img = aq_resize( $large_image, '250', '260', true );
                           if($portfolio_img) {
                            $portfolio_img = $portfolio_img;
                          } else {
                            $portfolio_img= IMAGES .'/dummy/250x260.jpg';
                          }
                        }
                    } else {
                      $portfolio_img = $large_image;
                }
                } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                      if($portfolio_style == 'style-1') {
                        if ($portfolio_columns === 'jt-port-col-2') {
                            $portfolio_img = aq_resize( $large_image, '960', '700', true );
                             if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/960x700.jpg';
                            }
                          } elseif ($portfolio_columns === 'jt-port-col-3') {
                            $portfolio_img = aq_resize( $large_image, '640', '650', true );
                            if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/640x650.jpg';
                            }
                          } elseif ($portfolio_columns === 'jt-port-col-4') {
                            $portfolio_img = aq_resize( $large_image, '480', '490', true );
                            if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/480x490.jpg';
                            }
                          } else {
                            $portfolio_img = aq_resize( $large_image, '380', '390', true );
                             if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/380x390.jpg';
                            }
                          }
                      } else {
                        $portfolio_img = $large_image;
                      }
                } else {
                     if($portfolio_style == 'style-1') {
                        if ($portfolio_columns === 'jt-port-col-2') {
                            $portfolio_img = aq_resize( $large_image, '960', '700', true );
                             if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/960x700.jpg';
                            }
                          } elseif ($portfolio_columns === 'jt-port-col-3') {
                            $portfolio_img = aq_resize( $large_image, '640', '650', true );
                            if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/640x650.jpg';
                            }
                          } elseif ($portfolio_columns === 'jt-port-col-4') {
                            $portfolio_img = aq_resize( $large_image, '480', '490', true );
                            if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/480x490.jpg';
                            }
                          } else {
                            $portfolio_img = aq_resize( $large_image, '380', '390', true );
                             if($portfolio_img) {
                              $portfolio_img = $portfolio_img;
                            } else {
                              $portfolio_img= IMAGES .'/dummy/380x390.jpg';
                            }
                          }
                      } else {
                        $portfolio_img = $large_image;
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

       if($portfolio_style == 'style-1' || $portfolio_style == 'style-2') {
        ?>
        <div class="<?php echo $grid_style_three; ?> <?php echo $cat_class; ?> ">
                <div class="<?php echo $hover_class_one; ?>">
                    <img src="<?php echo esc_attr($portfolio_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    <?php if($hover_style == 'style-three') { ?>
                     <a href="<?php echo $portfolio_img; ?>" class="jt-port-hover-overlay">
                        <img src="<?php echo IMAGES ?>/icons/port-plus.png" alt="Plus Icon">
                     </a>
                    <?php } ?>
                </div>
        <?php } else { ?>
        <div class="jt-able-filter jt-portfolio-item jt-agency-item <?php echo $cat_class; ?> ">
            <div class="jt-port-image jt-arch-port-img jt-port-agency-img">
                <img src="<?php echo esc_attr($portfolio_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
            </div>
            <div class="jt-port-overlay jt-port-border">
                <div class="jt-agency-hover-content">
                    <a href="<?php esc_url(the_permalink()); ?>" class="jt-agency-top"><?php esc_attr(the_title()); ?></a>
                    <div class="jt-agency-sep"></div>
                     <?php
                      $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                      $i=1;
                      foreach ($category_list as $term) {
                        $term_link = get_term_link( $term );
                        echo '<a href="'. esc_url($term_link) .'" class="jt-parallax-cat" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                        if($i++==2) break;
                      }
                    ?>
                </div>
            </div>
            <?php }

                if($hover_style == 'style-one') { ?>
                    <div class="jt-port-overlay">
                        <div class="jt-port-content">
                            <div class="jt-port-heading">
                                <a href="<?php esc_url(the_permalink()); ?>" style="<?php echo $title_color;  ?><?php echo $title_size;  ?>"><?php esc_attr(the_title()); ?></a>
                            </div>
                            <div class="jt-port-sep"></div>
                            <div class="jt-port-cat">
                            <?php
                                $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                                $i=1;
                                foreach ($category_list as $term) {
                                  $term_link = get_term_link( $term );
                                  echo '<a href="'. esc_url($term_link) .'" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                                  if($i++==2) break;
                                }
                              ?>
                            </div>
                        </div>
                    </div>
                <?php } elseif($hover_style =='style-two') { ?>
                    <div class="jt-arch-overlay">
                      <div class="jt-arch-prt-content">
                            <div class="jt-port-heading">
                                <a href="<?php esc_url(the_permalink()); ?>" style="<?php echo $title_color;  ?><?php echo $title_size;  ?>"><?php esc_attr(the_title()); ?></a>
                            </div>
                            <div class="jt-port-cat">
                            <?php
                               $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                               $i=1;
                               foreach ($category_list as $term) {
                                 $term_link = get_term_link( $term );
                                 echo '<a href="'. esc_url($term_link) .'" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                                 if($i++==2) break;
                               }
                            ?>
                            </div>
                        </div>
                    </div>
                <?php }  elseif($hover_style =='style-three') { ?>
                     <div class="jt-business-port-cont">
                          <a href="<?php esc_url(the_permalink()); ?>" class="jt-port-title" style="<?php echo $title_color;  ?><?php echo $title_size;  ?>"><?php esc_attr(the_title()); ?></a>
                          <div class="jt-port-category">
                             <?php
                                $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                                $i=1;
                                foreach ($category_list as $term) {
                                  $term_link = get_term_link( $term );
                                  echo '<a href="'. esc_url($term_link) .'" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                                  if($i++==2) break;
                                }
                              ?>
                          </div>
                      </div>
                      <span class="jt-port-sep"></span>
              <?php } elseif($hover_style =='style-four') {  ?>
              <div class="jt-port-overlay">
                    <div class="jt-port-content">
                        <div class="jt-port-heading">
                            <a href="<?php esc_url(the_permalink()); ?>"><?php esc_attr(the_title()); ?></a>
                        </div>
                        <div class="jt-port-sep"></div>
                        <div class="jt-port-cat">
                            <?php
                               $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                               $i=1;
                               foreach ($category_list as $term) {
                                 $term_link = get_term_link( $term );
                                 echo '<a href="'. esc_url($term_link) .'" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                                 if($i++==2) break;
                               }
                            ?>
                        </div>
                    </div>
                </div>
              <?php } elseif($hover_style =='style-five') { ?>
                <div class="jt-port-overlay">
                    <div class="jt-port-content">
                        <div class="jt-port-heading">
                            <a href="<?php esc_url(the_permalink()); ?>"><?php esc_attr(the_title()); ?></a>
                        </div>
                        <div class="jt-port-sep"></div>
                        <div class="jt-port-cat">
                            <?php
                               $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                               $i=1;
                               foreach ($category_list as $term) {
                                 $term_link = get_term_link( $term );
                                 echo '<a href="'. esc_url($term_link) .'" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                                 if($i++==2) break;
                               }
                            ?>
                        </div>
                    </div>
                </div>
              <?php } elseif($hover_style =='style-six') { ?>
                <div class="jt-corp-port-overlay">
                  <div class="jt-corp-port-cont">
                      <div class="jt-cat-div">
                        <?php
                           $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                           $i=1;
                           foreach ($category_list as $term) {
                             $term_link = get_term_link( $term );
                             echo '<a href="'. esc_url($term_link) .'" class="jt-corp-cat" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                             if($i++==2) break;
                           }
                        ?>
                        </div>
                      <a href="<?php esc_url(the_permalink()); ?>" class="jt-corp-product"><?php esc_attr(the_title()); ?></a>
                      <a href="<?php esc_url(the_permalink()); ?>"><img src="<?php echo IMAGES; ?>/icons/vint-ban-right.png" alt="Arrow"></a>
                  </div>
              </div>
              <?php } elseif($hover_style =='style-seven') { ?>
                <div class="jt-corp-port-overlay">
                    <div class="jt-box-arrow">
                        <a href="<?php esc_url(the_permalink()); ?>"><img src="<?php echo IMAGES; ?>/icons/vint-ban-right.png" alt="Arrow"></a>
                    </div>
                    <div class="jt-corp-port-cont">
                      <div class="jt-cat-div">
                        <?php
                           $category_list = wp_get_post_terms($post->ID, 'portfolio_category');
                           $i=1;
                           foreach ($category_list as $term) {
                             $term_link = get_term_link( $term );
                             echo '<a href="'. esc_url($term_link) .'" class="jt-box-cat" style="'. $category_color . $category_size .'">'. $term->name .'</a> ';
                             if($i++==2) break;
                           }
                        ?>
                        </div>
                        <a href="<?php esc_url(the_permalink()); ?>" class="jt-box-product"><?php esc_attr(the_title()); ?></a>
                    </div>
                </div>
              <?php } else {} ?>
        </div>
          <?php
          endwhile;
          endif;
          wp_reset_postdata(); ?>
        </div>
    <?php if($portfolio_style == 'style-3') { ?>
      </div>
    </div>
    <?php } ?>
    <!-- Portfolio -->
    <!-- Paged navigation -->
    <?php if ($enable_pagination) {
        if ( function_exists('wp_pagenavi')) {
            wp_pagenavi(array( 'query' => $wpbp ) );
            wp_reset_postdata();  // avoid errors further down the page
        }
       } ?>
    </div>
    <?php

    // Return outbut buffer
    return ob_get_clean();

  }
}
add_shortcode( 'jt_portfolio', 'juster_portfolio' );

/* ==========================================================
   13. Gmap
=========================================================== */
if ( !function_exists('juster_gmap')) {
  function juster_gmap( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'gmap_style'  => '',
      'map_height'  => '',
      'class'  => '',
     ), $atts));

    if ( $map_height ) {
      $map_height = 'style="height:'. esc_attr($map_height) .'"';
    } else {
      $map_height = 'style="height:430px;"';
    }

    $pl_control = ot_get_option('gmap_plusminus_control');
    if($pl_control == 'on') {
      $pl_control = '<div class="mm-zoom mm-zoom-in"></div><div class="mm-zoom mm-zoom-out"></div>';
    } else {
      $pl_control = '';
    }

    $output = '<div class="mm-google-map '. esc_attr($class) .'"><div class="map" id="map" '. $map_height .'></div>'. $pl_control .'</div>';

    // Gmap Script
    ob_start();
    $maps = ot_get_option('mapsetone');
    if ($maps) {
      wp_enqueue_script( 'gmap-js', '//maps.google.com/maps/api/js?sensor=false', array( 'jquery' ), false, true );
      wp_enqueue_script( 'custom-gmap',  SCRIPTS . '/custom-gmap.js', array('jquery'), '', true);
    }
    ob_end_flush();
    if ($maps) {
   ?>
    <script type="text/javascript">
        var labVcMaps = labVcMaps || [];
        labVcMaps.push({
          id: 'map',
          locations: [
          <?php foreach($maps as $map) { ?>
          {
            <?php if($map['map_marker']) { ?>
              "marker_image":"<?php echo esc_js($map['map_marker']); ?>",
            <?php } else {
              if ($gmap_style == 'style-3') { ?>
              "marker_image":"<?php echo IMAGES; ?>/icons/map/map-marker-3.png",
            <?php } elseif ($gmap_style == 'style-2') { ?>
              "marker_image":"<?php echo IMAGES; ?>/icons/map/map-marker-2.png",
            <?php } else { ?>
              "marker_image":"<?php echo IMAGES; ?>/icons/map/map-marker-1.png",
            <?php }
            } ?>
            "retina_marker":"",
            "latitude":"<?php echo esc_js($map['latitude']); ?>",
            "longitude":"<?php echo esc_js($map['longitude']); ?>",
            "marker_title":"<?php echo esc_js($map['title']); ?>",
            "marker_description":"<p><?php echo esc_js($map['popup_content']); ?></p>"
          },
          <?php } ?>
          ],

          <?php
          $zoom_value = ot_get_option('gmap_zoom_value');
          if($zoom_value) {
            $zoom_value = esc_attr($zoom_value);
          } else {
            $zoom_value = '10';
          }

          $scroll_wheel = ot_get_option('gmap_scroll_wheel');
          if($scroll_wheel=='on') {
            $scroll_wheel = 'true';
          } else {
            $scroll_wheel = 'false';
          }

          $pan_control = ot_get_option('gmap_pan_control');
          if($pan_control=='on') {
            $pan_control = 'true';
          } else {
            $pan_control = 'false';
          }

          $zoom_control = ot_get_option('gmap_zoom_control');
          if($zoom_control=='on') {
            $zoom_control = 'true';
          } else {
            $zoom_control = 'false';
          }

          $maptype_control = ot_get_option('gmap_maptype_control');
          if($maptype_control=='on') {
            $maptype_control = 'true';
          } else {
            $maptype_control = 'false';
          }

          $scale_control = ot_get_option('gmap_scale_control');
          if($scale_control=='on') {
            $scale_control = 'true';
          } else {
            $scale_control = 'false';
          }

          $street_view_control = ot_get_option('gmap_street_control');
          if($street_view_control=='on') {
            $street_view_control = 'true';
          } else {
            $street_view_control = 'false';
          }

          $overview_map_control = ot_get_option('gmap_overview_map_control');
          if($overview_map_control=='on') {
            $overview_map_control = 'true';
          } else {
            $overview_map_control = 'false';
          }

          $plusminus_control = ot_get_option('gmap_plusminus_control');
          if($plusminus_control=='on') {
            $plusminus_control = 'true';
          } else {
            $plusminus_control = 'false';
          }

          $gmap_type = ot_get_option('gmap_type');
          if($gmap_type == 'roadmap') {
            $gmap_type = $gmap_type;
          } elseif($gmap_type == 'satellite') {
            $gmap_type = $gmap_type;
          } elseif($gmap_type == 'hybrid') {
            $gmap_type = $gmap_type;
          } elseif($gmap_type == 'terrain') {
            $gmap_type = $gmap_type;
          }
          ?>
          zoom: <?php echo esc_js($zoom_value); ?>,
          scrollwheel: <?php echo esc_js($scroll_wheel); ?>,
          dropPins: true,
          panBy: [0,0],
          tilt: 0,
          heading: 0,

          mapType: '<?php echo esc_attr($gmap_type); ?>',

          panControl: <?php echo esc_js($pan_control); ?>,
          zoomControl: <?php echo esc_js($zoom_control); ?>,
          mapTypeControl: <?php echo esc_js($maptype_control); ?>,
          scaleControl: <?php echo esc_js($scale_control); ?>,
          streetViewControl: <?php echo esc_js($street_view_control); ?>,
          overviewMapControl: <?php echo esc_js($overview_map_control); ?>,
          plusMinusZoom: <?php echo esc_js($plusminus_control); ?>,

          styles: [ {
            <?php if ($gmap_style == 'style-3') { ?>
              stylers: [ { "saturation":-100 }, { "lightness": 0 }, { "gamma": 0.5 }, { "invert_lightness": true }]
            <?php } else {} if ($gmap_style == 'style-2') { ?>
              stylers: [ { "saturation":-100 }, { "lightness": -10 }]
            <?php } else {} ?>
        },
          ],});
    </script>

<?php
    } // if $maps
  return $output;
  }
}
add_shortcode( 'jt_gmap', 'juster_gmap' );

/* ==========================================================
   14. Intro
=========================================================== */
if ( !function_exists('juster_intro')) {
  function juster_intro( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'intro_text'  => '',
      'heading'  => '',
      'attach_type'  => '',
      'intro_content'  => '',
      'intro_images'  => '',
      'intro_single' => '',
      'link_text'  => '',
      'link'  => '',
      'open_link'  => '',
      'intro_text_color'  => '',
      'heading_color'  => '',
      'content_color'  => '',
      'link_text_color'  => '',
      'intro_text_size' => '',
      'heading_size'  => '',
      'content_size'  => '',
      'link_text_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-intro-wrapper-boxed';
    } else {
      $page_model_class = 'jt-intro-wrapper-extrawidth';
    }

    // Color
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $intro_text_color ) {
      $intro_text_color = 'color:'. $intro_text_color .';';
    } else {
      $intro_text_color ='';
    }
    if ( $link_text_color ) {
      $link_text_color = 'color:'. $link_text_color .';';
    } else {
      $link_text_color ='';
    }

    // Sizes
    if ($intro_text_size) {
      $intro_text_size = 'font-size:'. esc_attr($intro_text_size) .';';
    } else {
      $intro_text_size ='';
    }
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }
    if ($link_text_size) {
      $link_text_size = 'font-size:'. esc_attr($link_text_size) .';';
    } else {
      $link_text_size ='';
    }

    if ($open_link == 'yes') {
      $open_link = 'target="_blank"';
    } else {
      $open_link ='';
    }

    if ($intro_single) {
      $intro_single_img = wp_get_attachment_url($intro_single);
    } else {
      $intro_single_img='';
    }

     // Turn output buffer on
    ob_start();

    // Get Attachments
    $attachments = explode(",",$intro_images);
    //$attachments = array_combine($attachments,$attachments);
    ?>

     <div class="jt-intro-wrapper <?php echo $page_model_class; ?> <?php echo esc_attr($class); ?>">

        <!-- Intro Image Carousel -->
        <?php if($attach_type == 'style-2')  { ?>
        <div class="jt-intro-carousel jt-popup-image">
            <?php
             foreach ( $attachments as $attachment ) :
             if ( $attachment ) {
                $attachment_img = wp_get_attachment_url( $attachment );
              ?>
              <a href="<?php echo esc_url($attachment_img); ?>">
                <img src="<?php echo $attachment_img; ?>" alt="" />
              </a>
             <?php } endforeach; ?>

        </div>
        <?php } else { ?>
        <div class="jt-single-image jt-popup-image">
              <a href="<?php echo esc_url($intro_single_img); ?>">
                <img src="<?php echo esc_attr($intro_single_img); ?>" alt="" />
              </a>
        </div>
        <?php } ?>
                <!-- Intro Image Carousel -->

                <!-- Intro Content -->
                <div class="jt-intro-content sep-hover-control">
                    <div class="jt-intro-text">
                        <h2 style="<?php echo $intro_text_color;  ?><?php echo $intro_text_size;  ?>"><?php echo esc_attr($intro_text); ?></h2>
                        <div class="jt-sep-two"></div>
                    </div>
                    <h3 style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($heading); ?></h3>
                    <div class="jt-intro-inner">
                        <p style="<?php echo $content_color; ?><?php echo $content_size;  ?>"><?php echo esc_attr($intro_content); ?></p>
                        <a href="<?php echo esc_url($link); ?>" class="jt-intro-learn-more right-animate-icon" style="<?php echo $link_text_color;  ?><?php echo $link_text_size;  ?>"  <?php echo $open_link; ?> >
                            <?php echo esc_attr($link_text); ?>
                            <img src="<?php echo IMAGES ?>/arrows/box-arrow-right.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- Intro Content -->

            </div>
            <!-- Intro Main Content -->
  <?php
    // Return outbut buffer
    return ob_get_clean();
    }
}
add_shortcode( 'jt_intro', 'juster_intro' );

/* ==========================================================
   15. Carousal Slider
=========================================================== */
if ( !function_exists('juster_carousal')) {
  function juster_carousal( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'special_text_color'  => '',
      'heading_color'  => '',
      'content_color'  => '',
      'special_text_size'  => '',
      'heading_size'  => '',
      'content_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-cnt-carousel-wrapper-boxed';
    } else {
      $page_model_class = 'jt-cnt-carousel-wrapper-extrawidth';
    }

    // Color
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $special_text_color ) {
      $special_text_color = 'color:'. $special_text_color .';';
    } else {
      $special_text_color ='';
    }

    // Sizes
    if ($special_text_size) {
      $special_text_size = 'font-size:'. esc_attr($special_text_size) .';';
    } else {
      $special_text_size ='';
    }
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }

     // Turn output buffer on
    ob_start();

    $carousal_slider = ot_get_option('carousal_slider');
    ?>

    <div class="jt-cnt-carousel-wrapper <?php echo $page_model_class; ?> <?php echo esc_attr($class); ?>">

        <!-- Each Carousel -->
        <?php
           if ($carousal_slider) {
            foreach($carousal_slider as $carousal) {
                echo '<div class="jt-each-carousel"><span class="jt-special-txt" style="'. $special_text_color . $special_text_size . '">'. esc_attr($carousal['special_text']) .'</span><h3 class="jt-carousel-heading" style="'. $heading_color . $heading_size . '">'. esc_attr($carousal['carousal_heading']) .'</h3><p style="'. $content_color . $content_size . '">'. esc_attr($carousal['carousal_content']) .'</p></div>';
              }
            }
          ?>
        <!-- Each Carousel -->
    </div>

 <?php
  // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'jt_carousal', 'juster_carousal' );

/* ==========================================================
   16. Featured Slide
=========================================================== */
if ( !function_exists('juster_featured_slide')) {
  function juster_featured_slide( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'small_title'  => '',
      'heading'  => '',
      'bg_image'  => '',
      'need_overlay'  => '',
      'small_title_color'  => '',
      'heading_color'  => '',
      'title_color' => '',
      'small_title_size'  => '',
      'heading_size'  => '',
      'title_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-fetures-tabs-wrapper-boxed';
    } else {
      $page_model_class = 'jt-fetures-tabs-wrapper-extrawidth';
    }

    // Color
    if ( $small_title_color ) {
      $small_title_color = 'color:'. $small_title_color .';';
    } else {
      $small_title_color ='';
    }
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }

    // Sizes
    if ($small_title_size) {
      $small_title_size = 'font-size:'. esc_attr($small_title_size) .';';
    } else {
      $small_title_size ='';
    }
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }

    if ($bg_image) {
      $image_url = wp_get_attachment_url( $bg_image );
      $bg_image = 'style="background-image:url('. $image_url .');"';
    } else {
      $bg_image ='';
    }

    $featured_slider = ot_get_option('featured_slider');

    wp_enqueue_style( 'swiper-css', THEMEROOT . '/css/swiper.min.css' );
    wp_register_script( 'jquery.responsiveTabs.min', SCRIPTS . '/jquery.responsiveTabs.min.js', array( 'jquery' ), false, true );
    wp_register_script( 'swiper', SCRIPTS . '/swiper.jquery.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'jquery.responsiveTabs.min' );
    wp_enqueue_script( 'swiper' );

    // Turn output buffer on
    ob_start();
?>
  <div class="jt-fetures-tabs-wrapper <?php echo $page_model_class;  ?> <?php echo esc_attr($class);  ?>">
          <div class="col-lg-6 padding-zero">
                <div class="swiper-container">
                  <div class="swiper-wrapper">
                     <?php
                      if ($featured_slider) {
                         foreach($featured_slider as $slider) {
                          echo '<div class="jt-tabs-main-content swiper-slide">
                            <div class="jt-main-cnt-div">
                                <h2 style="'. $title_color . $title_size .'">'. esc_attr($slider['title']) .'</h2>
                                <div class="jt-sep-two"></div>
                                <div class="tabs-cat">
                                    '. $slider['featured_category'] .'
                                </div>
                                '. $slider['featured_content'] .'
                            </div>
                            <div class="jt-tabs-image">
                                <img src="'. esc_attr($slider['center_image']) .'" alt="'. esc_attr($slider['title']) .'">
                            </div>
                        </div>';
                        }
                      }
                    ?>
                    </div>
                    <div class="jt-tabs-nav">
                        <a href="#0" class="jt-tab-prev"><i class="fa fa-long-arrow-left"></i></a>
                        <a href="#0" class="jt-tab-next"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-6 padding-zero jt-right-box">
                  <div class="jt-tabs-right-area" <?php echo $bg_image;  ?>>
                      <?php if($need_overlay) { ?>
                          <div class="jt-box-overlay"></div>
                      <?php } ?>
                      <div class="jt-tabs-feature-box">
                          <h5 class="jt-small-title" style="<?php echo $small_title_color;  ?><?php echo $small_title_size;  ?>"><?php echo esc_attr($small_title); ?></h5>
                          <div class="jt-heading">
                              <h2 class="jt-large-heading" style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($heading); ?></h2>
                              <div class="jt-sep"></div>
                          </div>
                          <div class="jt-tabs-num"></div>
                      </div>
                  </div>
              </div>
        </div>
 <?php
    // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_featured_slide', 'juster_featured_slide' );

/* ==========================================================
   17. Featured Tabs
=========================================================== */
if ( !function_exists('juster_features_tabs')) {
  function juster_features_tabs( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'heading'  => '',
      'tab_image'  => '',
      'need_hover'  => '',
      'heading_color'  => '',
      'title_color' => '',
      'icon_color'  => '',
      'short_content_color'  => '',
      'long_content_color'  => '',
      'button_text_color'  => '',
      'button_border_color'  => '',
      'heading_size'  => '',
      'title_size'  => '',
      'icon_size'  => '',
      'short_content_size'  => '',
      'long_content_size'  => '',
      'button_text_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );

    if ($need_hover === 'yes') {
      wp_register_script( 'tiltfx-js', SCRIPTS . '/tiltfx.js', array( 'jquery' ), false, true );
      wp_enqueue_script( 'tiltfx-js' );
    }

    // Color
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $icon_color ) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color ='';
    }
    if ( $short_content_color ) {
      $short_content_color = 'color:'. $short_content_color .';';
    } else {
      $short_content_color ='';
    }
    if ( $long_content_color ) {
      $long_content_color = 'color:'. $long_content_color .';';
    } else {
      $long_content_color ='';
    }
    if ( $button_text_color ) {
      $button_text_color = 'color:'. $button_text_color .';';
    } else {
      $button_text_color ='';
    }
    if ( $button_border_color ) {
      $button_border_color = 'border-color:'. $button_border_color .';';
    } else {
      $button_border_color = '';
    }

    // Sizes
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }
    if ($short_content_size) {
      $short_content_size = 'font-size:'. esc_attr($short_content_size) .';';
    } else {
      $short_content_size ='';
    }
    if ($long_content_size) {
      $long_content_size = 'font-size:'. esc_attr($long_content_size) .';';
    } else {
      $long_content_size = '';
    }
    if ($button_text_size) {
      $button_text_size = 'font-size:'. esc_attr($button_text_size) .';';
    } else {
      $button_text_size ='';
    }

    if ($tab_image) {
      $image_url = wp_get_attachment_url( $tab_image );
      $tab_image = '<img src="'. esc_attr($image_url) .'" class="tilt-effect" alt="" />';
    } else {
      $tab_image = '<img src="'. IMAGES .'/dummy/960x700.jpg" class="tilt-effect" alt="" />';
    }

    if ($page_model == 'full_width') {
      $page_model_class = 'jt-featured-box';
    } else {
      $page_model_class = 'jt-featured-wide';
    }

    $jt_features_tabs = ot_get_option('jt_features_tabs');
    // Turn output buffer on
    ob_start();
?>
      <!-- What We Do -->
        <div class="jt-wwd-tabs <?php echo esc_attr($class); ?> <?php echo $page_model_class; ?>">

            <div class="col-lg-6 padding-zero">
                <!-- jt-wwd-image-bg -->
                <div class="jt-wwd-image-bg">
                    <div class="jt-tilt-effect">
                        <div class="jt-wwd-img">
                            <?php echo $tab_image; ?>
                        </div>
                    </div>
                    <?php
                        if ($jt_features_tabs) {
                          $i=1;
                          foreach($jt_features_tabs as $jt_tabs) {
                            echo '<div id="jt-wwd-'.$i.'" class="wwd-tab-box"><div class="wwd-tab-icon"><i class="'. esc_attr($jt_tabs['features_tab_icon']) .'" style="'. $icon_color . $icon_size .'"></i></div><h3 style="'. $title_color . $title_size .'">'. esc_attr($jt_tabs['title']) .'</h3><p style="'. $long_content_color . $long_content_size .'">'. $jt_tabs['long_tab_content'] .'</p><a href="'. $jt_tabs['tabs_button_link'] .'" class="btn-primary learn-more" style="'. $button_text_color . $button_text_size . $button_border_color .'">'. $jt_tabs['tabs_button_text'] .'</a></div>';
                            $i++;
                          }
                        }
                    ?>
                </div>
                <!-- jt-wwd-image-bg -->
            </div>
            <div class="col-lg-6 padding-zero">
                <div class="jt-wwd-tab-links">
                    <div class="jt-wwd-headings">
                        <h2 class="jt-large-heading" style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($heading); ?></h2>
                        <div class="jt-sep-two"></div>
                    </div>
                    <?php
                      if ($jt_features_tabs) {
                         $i=1;
                         foreach($jt_features_tabs as $jt_tabs1) {
                            echo '<a href="#jt-wwd-'.$i.'" class="tab-each-link"><i class="'. esc_attr($jt_tabs1['features_tab_icon']) .'" style="'. $icon_color . $icon_size .'"></i><h4 style="'. $title_color . $title_size .'">'. esc_attr($jt_tabs1['title']) .'</h4><p style="'. $short_content_color . $short_content_size .'">'. esc_attr($jt_tabs1['short_tab_content']) .'</p><span class="close-icon"></span></a>';
                             $i++;
                         }
                      }
                  ?>
                </div>
            </div>
        </div>
        <!-- What We Do -->
    <?php
    // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_features_tabs', 'juster_features_tabs' );

/* ==============================================
   18. Blog
=============================================== */
if ( !function_exists('juster_blog')) {
  function juster_blog( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'blog_style'  => '',
      'blog_type'  => '',
      'blog_column_type'  => '',
      'masonry_blog_columns'  => '',
      'vintage_blog_columns'  => '',
      'blog_style_one'  => '',
      'link_text'  => '',
      'blog_link'  => '',
      'blog_limit'  => '',
      'blog_order'  => '',
      'blog_order_by'  => '',
      'blog_offset'  => '',
      'show_category'  => '',
      'blog_pagination'  => '',
      'blog_pagination_two'  => '',
      'blog_pagination_three'  => '',
      'class'  => '',
    ), $atts));

    if($blog_column_type) {
      $blog_column_type = $blog_column_type;
    } else {
      $blog_column_type = 'jt-blog-col-3';
    }

    if($blog_column_type) {
      $blog_column_type = $blog_column_type;
    } else {
      $blog_column_type = 'jt-blog-col-3';
    }

    if($vintage_blog_columns) {
      $vintage_blog_columns = $vintage_blog_columns;
    } else {
      $vintage_blog_columns = 'jt-vint-blog-column-three';
    }

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $global_model = ot_get_option('fullwidth_boxed');
    $content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );

    if ($page_model == 'full_width') {
      $page_model_class1 = 'blog-style-one-boxed';
      $page_model_class2 = 'blog-style-two-boxed';
      $page_model_class3 = 'blog-style-three-boxed';
      $page_model_class4 = 'blog-style-four-boxed';
      $page_model_class5 = 'blog-style-five-boxed';
      $page_model_class6 = 'blog-style-six-boxed';
      $page_model_class7 = 'blog-style-seven-boxed';
      $page_model_class8 = 'blog-style-two-slider-boxed';
      $page_model_class9 = 'blog-style-three-slider-boxed';
      $page_model_class10 = 'blog-style-seven-slider-boxed';
    } else {
      $page_model_class1 = 'blog-style-one-wide';
      $page_model_class2 = 'blog-style-two-wide';
      $page_model_class3 = 'blog-style-three-wide';
      $page_model_class4 = 'blog-style-four-wide';
      $page_model_class5 = 'blog-style-five-wide';
      $page_model_class6 = 'blog-style-six-wide';
      $page_model_class7 = 'blog-style-seven-wide';
      $page_model_class8 = 'blog-style-two-slider-wide';
      $page_model_class9 = 'blog-style-three-slider-wide';
      $page_model_class10 = 'blog-style-seven-slider-wide';
    }
    // Turn output buffer on
    ob_start();
    ?>

      <?php
        global $post;
        // $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        // $wpbp = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $blog_limit, 'category_name' => $show_category, 'paged' => $paged, 'offset' => $port_offset, 'orderby' => $blog_order_by, 'order' => $blog_order));
        //
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
          'paged' => esc_attr($my_page),
          'post_type' => 'post',
          'posts_per_page'  => (int)$blog_limit,
          'category_name' => esc_attr($show_category),
          'offset' => (!(int)$blog_offset ? "" : (int)$blog_offset),
          'orderby' => $blog_order_by,
          'order' => $blog_order
        );

      $wpbp = new WP_Query( $args );

      if ($blog_style == 'style-1') { ?>

      <div class="blog-style-one <?php echo $page_model_class1; ?> <?php echo esc_attr($class); ?>">
          <?php
            if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
              if ( has_post_thumbnail() && ! post_password_required() ) {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
                $url = $thumb['0'];
                $blog_image = aq_resize( $url, '200', '130', true );
                if($blog_image) {
                  $blog_image =$blog_image;
                } else {
                  $blog_image = IMAGES.'/dummy/200x130.png';
                }
              } else {
                $blog_image = IMAGES.'/dummy/200x130.png';
              }
              ?>
              <div <?php post_class('jt-blog-lists'); ?>>
                  <div class="jt-thumb-hv">
                      <a href="<?php esc_url(the_permalink()); ?>" class="jt-post-thumb">
                          <img src="<?php echo esc_attr($blog_image); ?>" alt="<?php esc_attr(the_title()); ?>">
                      </a>
                  </div>
                  <div class="jt-content-hv">
                      <div class="jt-post-contents">
                          <div class="jt-list-cat">
                              <?php echo juster_post_meta_cat(); ?></div>
                          <a href="<?php esc_url(the_permalink()); ?>" class="jt-post-title">
                              <?php esc_attr(the_title()); ?>
                          </a>
                          <?php echo juster_post_meta(); ?>
                      </div>
                  </div>
                  <div class="jt-read-more-hv">
                      <a href="<?php esc_url(the_permalink()); ?>" class="jt-list-read-more">
                          <span><?php echo __('Read More','juster'); ?></span>
                          <span class="arrow-right"><img src="<?php echo IMAGES ?>/arrows/box-arrow-right.png" alt=""></span>
                      </a>
                  </div>
              </div>
              <?php endwhile;
              if($blog_style_one == 'page_text') {
                if ($link_text) {
              ?>
                <a href="<?php echo esc_url($blog_link); ?>" class="read-more-blog" target="_blank">
                    <?php echo esc_attr($link_text); ?>
                    <img src="<?php echo IMAGES ?>/arrows/box-arrow-right.png" alt="">
                </a>
              <?php
                }
              }
              if($blog_style_one == 'page_numbers') {
                if ($blog_pagination_three) {
                  if ( function_exists('wp_pagenavi')) {
                    wp_pagenavi(array( 'query' => $wpbp ) );
                    wp_reset_postdata();  // avoid errors further down the page
                  }
                } // blog pagination three
              } // page numbers
            endif; ?>
      </div>
      <?php } ?>
      <?php if ($blog_style == 'style-4') {
      if ($blog_pagination_two) { $pagination_hav_class = "jt-have-pagination"; } else { $pagination_hav_class = ""; } ?>
      <div class="jt-post-wrapper jt-blog-shortcode <?php echo esc_attr($pagination_hav_class); ?>">
      <?php
        if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
          get_template_part( 'content', get_post_format() );
          endwhile;
            if ($blog_pagination_two) {
              if ( function_exists('wp_pagenavi')) {
                wp_pagenavi(array( 'query' => $wpbp ) );
                wp_reset_postdata();  // avoid errors further down the page
              }
            }
          endif; ?>
      </div>
      <?php } ?>
      <!---Style Five -->
      <?php if ($blog_style == 'style-5') { ?>
      <div class="isotope-blog blog-masonary-style <?php echo $page_model_class5; ?> <?php echo $masonry_blog_columns; ?> <?php echo esc_attr($class); ?>">
          <?php  if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
              if ( has_post_thumbnail() && ! post_password_required() ) {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
                $url = $thumb['0'];
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                        if ($masonry_blog_columns == 'jt-blog-column-two') {
                          $blog_image = aq_resize( $url, '590', '', true );
                          if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/590x380.jpg';
                          }
                        } else {
                          $blog_image = aq_resize( $url, '390', '', true );
                           if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image = IMAGES .'/dummy/390x320.jpg';
                          }
                        }
                  } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        if ($masonry_blog_columns == 'jt-blog-column-two') {
                          $blog_image = aq_resize( $url, '960', '', true );
                           if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/960x550.jpg';
                          }
                        } else {
                          $blog_image = aq_resize( $url, '640', '', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                        }
                  } else {
                      if ($masonry_blog_columns == 'jt-blog-column-two') {
                          $blog_image = aq_resize( $url, '960', '', true );
                           if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/960x550.jpg';
                          }
                        } else {
                          $blog_image = aq_resize( $url, '640', '', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                    }
               }
            } else {
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                    if ($masonry_blog_columns == 'jt-blog-column-two') {
                      $blog_image= IMAGES .'/dummy/590x380.jpg';
                    } else {
                      $blog_image = IMAGES .'/dummy/390x320.jpg';
                    }
                } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                   if ($masonry_blog_columns == 'jt-blog-column-two') {
                     $blog_image= IMAGES .'/dummy/960x550.jpg';
                    } else {
                     $blog_image= IMAGES .'/dummy/640x450.jpg';
                    }
                } else {
                    if ($masonry_blog_columns == 'jt-blog-column-two') {
                     $blog_image= IMAGES .'/dummy/960x550.jpg';
                    } else {
                     $blog_image= IMAGES .'/dummy/640x450.jpg';
                    }
                }
            }
              ?>
                <div class="blog-main-wrap blog-width">
                      <div class="blog-img">
                          <img src="<?php echo $blog_image; ?>"  alt="<?php esc_attr(the_title()); ?>">
                      </div>
                      <div class="blog-content">
                          <div class="jt-post-cat">
                            <?php echo juster_post_meta_cat(); ?>
                          </div>
                          <h2><?php esc_attr(the_title()); ?></h2>
                          <?php the_excerpt(); ?>
                          <a href="<?php esc_url(the_permalink()); ?>" class="blog-read-txt"><?php echo __('Read More', 'juster'); ?></a>
                      </div>
                </div>
                <?php
              endwhile;
          endif; ?>
    </div>
              <?php if ($blog_pagination_two) { ?>
                <div class="masonry-pagei-class">
                   <?php
                    if ( function_exists('wp_pagenavi')) {
                      wp_pagenavi(array( 'query' => $wpbp ) );
                      wp_reset_postdata();  // avoid errors further down the page
                    } ?>
                </div>
              <?php } ?>
      <?php } ?>
      <!---Style Six -->
      <?php if ($blog_style == 'style-6') { ?>
        <div class="blog-style-six <?php echo $page_model_class6; ?> <?php echo $vintage_blog_columns; ?> <?php echo esc_attr($class); ?>">
              <?php  if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                if ( has_post_thumbnail() && ! post_password_required() ) {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
                $url = $thumb['0'];
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                        if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                          $blog_image = aq_resize( $url, '590', '380', true );
                          if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/590x380.jpg';
                          }
                        } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                          $blog_image = aq_resize( $url, '390', '320', true );
                           if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image = IMAGES .'/dummy/390x320.jpg';
                          }
                        } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                          $blog_image = aq_resize( $url, '290', '250', true );
                           if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/290x250.jpg';
                          }
                        } else {
                          $blog_image = aq_resize( $url, '390', '320', true );
                           if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image = IMAGES .'/dummy/390x320.jpg';
                          }
                        }
            } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                          $blog_image = aq_resize( $url, '960', '550', true );
                           if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/960x550.jpg';
                          }
                        } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                          $blog_image = aq_resize( $url, '640', '450', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                        } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                          $blog_image = aq_resize( $url, '480', '350', true );
                          if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/480x350.jpg';
                          }
                        } else {
                          $blog_image = aq_resize( $url, '640', '450', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                        }
              } else {
                        if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                          $blog_image = aq_resize( $url, '960', '550', true );
                           if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/960x550.jpg';
                          }
                        } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                          $blog_image = aq_resize( $url, '640', '450', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                        } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                          $blog_image = aq_resize( $url, '480', '350', true );
                          if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/480x350.jpg';
                          }
                        } else {
                          $blog_image = aq_resize( $url, '640', '450', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                        }
            }
          } else {
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                    if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                      $blog_image = IMAGES .'/dummy/590x380.jpg';
                    } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                      $blog_image = IMAGES .'/dummy/390x320.jpg';
                    } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                      $blog_image = IMAGES .'/dummy/290x250.jpg';
                    } else {
                      $blog_image = IMAGES .'/dummy/390x320.jpg';
                    }
                } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                    if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                      $blog_image = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                      $blog_image = IMAGES .'/dummy/640x450.jpg';
                    } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                      $blog_image = IMAGES .'/dummy/480x350.jpg';
                    } else {
                      $blog_image = IMAGES .'/dummy/640x450.jpg';
                    }
                } else {
                    if ($vintage_blog_columns == 'jt-vint-blog-column-two') {
                      $blog_image = IMAGES .'/dummy/960x550.jpg';
                    } elseif ($vintage_blog_columns == 'jt-vint-blog-column-three') {
                      $blog_image = IMAGES .'/dummy/640x450.jpg';
                    } elseif ($vintage_blog_columns == 'jt-vint-blog-column-four') {
                      $blog_image = IMAGES .'/dummy/480x350.jpg';
                    } else {
                      $blog_image = IMAGES .'/dummy/640x450.jpg';
                    }
                }
            }
                ?>
                    <div class="jt-vint-blog">
                        <img src="<?php echo esc_attr($blog_image); ?>"  alt="<?php esc_attr(the_title()); ?>">
                        <h3><?php esc_attr(the_title()); ?></h3>
                        <div class="jt-post-list-metas">
                        <?php echo juster_post_meta(); ?>
                        </div>
                        <div class="jt-post-excerpt">
                             <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php esc_url(the_permalink()); ?>" class="jt-vint-read"><?php echo __('Read More', 'juster'); ?></a>
                    </div>
         <?php
              endwhile;
              if($blog_pagination_two) {
                if ( function_exists('wp_pagenavi')) {
                  wp_pagenavi(array( 'query' => $wpbp ) );
                  wp_reset_postdata();  // avoid errors further down the page
                }
              }
          endif; ?>
    </div>
      <?php }
      /* Style Type */
      if ($blog_type == 'style-1') {
          /* Style One */
          if ($blog_style == 'style-2') { ?>
           <div class="jt-style-two-blog <?php echo $page_model_class2; ?> normal-blog-style-two <?php echo esc_attr($class); ?>">
          <?php if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                    if ( has_post_thumbnail() && ! post_password_required() ) {
                      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
                      $url = $image['0'];
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                          $blog_image = aq_resize( $url, '510', '460', true );
                          if($blog_image) {
                            $blog_image=$blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/510x460.jpg';
                          }
                      } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                          $blog_image = aq_resize( $url, '640', '450', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                      } else {
                          $blog_image = aq_resize( $url, '640', '450', true );
                          if($blog_image) {
                            $blog_image = $blog_image;
                          } else {
                            $blog_image= IMAGES .'/dummy/640x450.jpg';
                          }
                      }
              } else {
                    if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                      $blog_image = IMAGES .'/dummy/510x460.jpg';
                     } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                      $blog_image = IMAGES .'/dummy/640x450.jpg';
                    } else {
                      $blog_image = IMAGES .'/dummy/640x450.jpg';
                    }
              }

              ?>

              <!-- Each Blog -->
                <div class="jt-blog-two">
                    <div class="jt-blog-two-image">
                        <img src="<?php echo esc_attr($blog_image); ?>" alt="<?php esc_attr(the_title()); ?>"/>
                    </div>
                    <div class="jt-blog-two-content">
                        <div class="jt-post-contents">
                            <div class="jt-list-cat">
                                <?php echo juster_post_meta_cat(); ?>
                            </div>
                            <a href="<?php esc_url(the_permalink()); ?>" class="jt-post-title">
                                <?php esc_attr(the_title()); ?>
                            </a>
                            <?php echo juster_post_meta(); ?>
                        </div>
                    </div>
                </div>
                <!-- Each Blog -->
                <?php
                 endwhile;
                  if ($blog_pagination) {
                    if ( function_exists('wp_pagenavi')) {
                    wp_pagenavi(array( 'query' => $wpbp ) );
                    wp_reset_postdata();  // avoid errors further down the page
                    }
                  }
                endif; ?>
          </div>
          <?php } elseif ($blog_style == 'style-3') { ?>
          <div class="<?php echo $page_model_class3; ?> <?php echo esc_attr($class); ?>">
            <?php
              if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                if ( has_post_thumbnail() && ! post_password_required() ) {
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
                  $large_img = $image['0'];
                  if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                         $blog_img = aq_resize( $large_img, '370', '260', true );
                           if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/370x260.jpg';
                          }
                      } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                          $blog_img = aq_resize( $large_img, '630', '460', true );
                          if($blog_img) {
                            $blog_img=$blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/630x460.jpg';
                          }
                      } else {
                          $blog_img = aq_resize( $large_img, '630', '460', true );
                          if($blog_img) {
                            $blog_img=$blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/630x460.jpg';
                          }
                      }
                    } else {
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                        $blog_img = IMAGES.'/dummy/370x260.jpg';
                       } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        $blog_img = IMAGES.'/dummy/630x460.jpg';
                      } else {
                        $blog_img = IMAGES.'/dummy/630x460.jpg';
                      }
                    }
              ?>
                  <div class="jt-blog-slide jt-style-three-blog jt-normal-view">
                      <img src="<?php echo esc_attr($blog_img); ?>" alt="<?php esc_attr(the_title()); ?>">
                      <div class="jt-slide-cont">
                          <div class="jt-post-cat">
                            <?php echo juster_post_meta_cat(); ?>
                          </div>
                          <a href="<?php esc_url(the_permalink()); ?>" class="jt-sub-tit"><?php esc_attr(the_title()); ?></a>
                      </div>
                  </div>
                <?php
                 endwhile;
                  if ($blog_pagination) {
                    if ( function_exists('wp_pagenavi')) {
                    wp_pagenavi(array( 'query' => $wpbp ) );
                    wp_reset_postdata();  // avoid errors further down the page
                    }
                  }
                endif; ?>
          </div>
      <?php }  elseif($blog_style == 'style-7') { ?>
        <div class="<?php echo $page_model_class7; ?> <?php echo esc_attr($class); ?>">
          <?php
          if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                    if ( has_post_thumbnail() && ! post_password_required() ) {
                      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
                      $large_img = $image['0'];
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                         $blog_img = aq_resize( $large_img, '340', '250', true );
                           if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/340x250.jpg';
                          }
                      } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                          $blog_img = aq_resize( $large_img, '630', '460', true );
                          if($blog_img) {
                            $blog_img=$blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/630x460.jpg';
                          }
                      } else {
                          $blog_img = aq_resize( $large_img, '630', '460', true );
                          if($blog_img) {
                            $blog_img=$blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/630x460.jpg';
                          }
                      }
                    } else {
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                        $blog_img = IMAGES.'/dummy/340x250.jpg';
                       } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        $blog_img = IMAGES.'/dummy/630x460.jpg';
                      } else {
                        $blog_img = IMAGES.'/dummy/630x460.jpg';
                      }
                    }
              ?>
                <div class="jt-vint-blog jt-box-blog col-sm-4">
                    <img src="<?php echo esc_attr($blog_img); ?>" alt="<?php esc_attr(the_title()); ?>">
                    <div class="jt-box-post-meta">
                        <span><?php echo get_the_date(); ?></span>
                       <?php echo get_the_category_list( ', ' );?>
                    </div>
                    <h3><?php esc_attr(the_title()); ?></h3>
                     <?php the_excerpt(); ?>
                     <a href="<?php esc_url(the_permalink()); ?>" class="jt-vint-read"><?php echo __('Read More', 'juster'); ?></a>
               </div>
                <?php
                 endwhile;
                  if ($blog_pagination) {
                    if ( function_exists('wp_pagenavi')) {
                    wp_pagenavi(array( 'query' => $wpbp ) );
                    wp_reset_postdata();  // avoid errors further down the page
                    }
                  }
                endif; ?>
          </div>
     <?php } } else {
      if ($blog_style == 'style-2') { ?>
      <div class="jt-blog-carousel-two <?php echo $page_model_class8; ?> <?php echo esc_attr($class); ?>">
      <?php
      if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                    if ( has_post_thumbnail() && ! post_password_required() ) {
                      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
                      $large_img = $image['0'];
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                           $blog_img = aq_resize( $large_img, '320', '310', true );
                           if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/320x310.jpg';
                          }
                      } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {

                          $blog_img = aq_resize( $large_img, '490', '460', true );
                          if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                            $blog_img= IMAGES .'/dummy/490x460.jpg';
                          }
                      } else {
                          $blog_img = aq_resize( $large_img, '490', '460', true );
                          if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                            $blog_img= IMAGES .'/dummy/490x460.jpg';
                          }
                      }
                    } else {
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                        $blog_img = IMAGES.'/dummy/320x310.jpg';
                       } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        $blog_img = IMAGES.'/dummy/490x460.jpg';
                      } else {
                        $blog_img = IMAGES.'/dummy/490x460.jpg';
                      }
                    }
          ?>

                <div class="jt-blog-two">
                    <div class="jt-blog-two-image">
                        <img src="<?php echo esc_attr($blog_img); ?>" alt="<?php esc_attr(the_title()); ?>"/>
                    </div>
                    <div class="jt-blog-two-content">
                        <div class="jt-post-contents">
                            <div class="jt-list-cat">
                                <?php echo juster_post_meta_cat(); ?>
                            </div>
                            <a href="<?php esc_url(the_permalink()); ?>" class="jt-post-title">
                                <?php esc_attr(the_title()); ?>
                            </a>
                            <?php echo juster_post_meta(); ?>
                        </div>
                    </div>
                </div>
            <?php
             endwhile;
             endif;
             ?>
      </div>
      <?php
      } elseif ($blog_style == 'style-3') { ?>
      <div id="jt-slide-wrap" class="<?php echo $page_model_class9; ?> <?php echo esc_attr($class); ?>">
      <?php
      if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                if ( has_post_thumbnail() && ! post_password_required() ) {
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
                  $large_img = $image['0'];
                  if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                           $blog_img = aq_resize( $large_img, '370', '260', true );
                           if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/370x260.jpg';
                          }
                      } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {

                          $blog_img = aq_resize( $large_img, '640', '450', true );
                          if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                             $blog_img = IMAGES.'/dummy/640x450.jpg';
                          }
                      } else {
                          $blog_img = aq_resize( $large_img, '640', '450', true );
                          if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                             $blog_img = IMAGES.'/dummy/640x450.jpg';
                          }
                      }
                    } else {
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                        $blog_img = IMAGES.'/dummy/370x260.jpg';
                       } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        $blog_img = IMAGES.'/dummy/640x450.jpg';
                      } else {
                        $blog_img = IMAGES.'/dummy/640x450.jpg';
                      }
                    }

          ?>
                    <div class="jt-blog-slide">
                      <img src="<?php echo esc_attr($blog_img); ?>" alt="<?php esc_attr(the_title()); ?>">
                        <div class="jt-slide-cont">
                            <div class="jt-post-cat">
                              <?php echo juster_post_meta_cat(); ?>
                            </div>
                            <a href="<?php esc_url(the_permalink()); ?>" class="jt-sub-tit"><?php the_title(); ?></a>
                        </div>
                    </div>
            <?php
             endwhile;
            endif; ?>
      </div>
      <?php
      } elseif($blog_style == 'style-7') { ?>
        <div class="jt-box-blog-slide <?php echo $page_model_class10; ?> <?php echo esc_attr($class); ?>">
          <?php
          if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
              if ( has_post_thumbnail() && ! post_password_required() ) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail_size' );
                $large_img = $image['0'];
                if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                         $blog_img = aq_resize( $large_img, '340', '250', true );
                           if($blog_img) {
                            $blog_img = $blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/340x250.jpg';
                          }
                      } elseif($page_model == 'extra_width' && $content_inside_container_mt == '') {
                          $blog_img = aq_resize( $large_img, '630', '460', true );
                          if($blog_img) {
                            $blog_img=$blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/630x460.jpg';
                          }
                      } else {
                          $blog_img = aq_resize( $large_img, '630', '460', true );
                          if($blog_img) {
                            $blog_img=$blog_img;
                          } else {
                            $blog_img = IMAGES.'/dummy/630x460.jpg';
                          }
                      }
                    } else {
                      if(($page_model == 'full_width') || ($page_model == 'extra_width' && $content_inside_container_mt) || ($global_model == 'full-width')) {
                        $blog_img = IMAGES.'/dummy/340x250.jpg';
                       } elseif ($page_model == 'extra_width' && $content_inside_container_mt == '') {
                        $blog_img = IMAGES.'/dummy/630x460.jpg';
                      } else {
                        $blog_img = IMAGES.'/dummy/630x460.jpg';
                      }
                    }
          ?>
            <div class="jt-vint-blog jt-box-blog">
                <img src="<?php echo esc_attr($blog_img); ?>" alt="<?php esc_attr(the_title()); ?>">
                <div class="jt-box-post-meta">
                    <span><?php echo get_the_date(); ?></span>
                    <?php echo get_the_category_list( ', ' );?>
                </div>
                <h3><?php esc_attr(the_title()); ?></h3>
                 <?php the_excerpt(); ?>
                 <a href="<?php esc_url(the_permalink()); ?>" class="jt-vint-read"><?php echo __('Read More', 'juster'); ?></a>
           </div>
            <?php
             endwhile;
            endif; ?>
      </div>
     <?php
      } }
      wp_reset_postdata();
    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'jt_blog', 'juster_blog' );

/* ==========================================================
    19.Service Box
=========================================================== */
if ( !function_exists('juster_services')) {
  function juster_services( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'service_style'  => '',
      'service_heading'  => '',
      'service_sub_heading'  => '',
      'service_icon'  => '',
      'icon_type'  => '',
      'icon_border_style'  => '',
      'service_icon_border'  => '',
      'service_icon_image' =>'',
      'need_right_seperate' =>'',
      'service_image'  => '',
      'service_bg_image'  => '',
      'service_border_bottom'  => '',
      'service_border_right'  => '',
      'need_learn_more'  => '',
      'learn_more_text'  => '',
      'learn_more_link'  => '',
      'icon_position'  => '',
      'need_seperate'  => '',
      'need_icon_border'  => '',
      'need_hover'  => '',
      'need_hover_plus'  => '',
      'hover_plus_icon_link'  => '',
      'class'  => '',

      // Color
      'heading_color'  => '',
      'sub_heading_color'  => '',
      'icon_color'  => '',
      'icon_border_color'  => '',
      'service_bg_color'  => '',
      'learn_more_color'  => '',

      // Sizes
      'heading_size'  => '',
      'sub_heading_size'  => '',
      'service_content_height'  => '',
      'icon_size'  => '',
      'learn_more_size'  => '',

      // Link
      'services_link'  => '',
      'open_link'  => '',
    ), $atts));

    $content = wpb_js_remove_wpautop($content, true);

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'extra_width') {
      $page_model_class1 = 'services-style-one-extrawidth';
      $page_model_class2 = 'services-style-two-extrawidth';
      $page_model_class3 = 'services-style-three-extrawidth';
      $page_model_class4 = 'services-style-four-extrawidth';
      $page_model_class5 = 'services-style-five-extrawidth';
      $page_model_class6 = 'services-style-six-extrawidth';
      $page_model_class7 = 'services-style-seven-extrawidth';
      $page_model_class8 = 'services-style-eight-extrawidth';
      $page_model_class9 = 'jt-boxed-service-extrawidth';
      $page_model_class10 = 'jt-vint-service-extrawidth';
    } else {
      $page_model_class1 = 'services-style-one-boxed';
      $page_model_class2 = 'services-style-two-boxed';
      $page_model_class3 = 'services-style-three-boxed';
      $page_model_class4 = 'services-style-four-boxed';
      $page_model_class5 = 'services-style-five-boxed';
      $page_model_class6 = 'services-style-six-boxed';
      $page_model_class7 = 'services-style-seven-boxed';
      $page_model_class8 = 'services-style-eight-boxed';
      $page_model_class9 = 'jt-boxed-service-boxed';
      $page_model_class10 = 'jt-vint-service-boxed';
    }
    // Color
    if ($heading_color) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ($sub_heading_color) {
      $sub_heading_color = 'color:'. $sub_heading_color .';';
    } else {
      $sub_heading_color ='';
    }

    if ($icon_color) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color ='';
    }
    if ($learn_more_color) {
      $learn_more_color = 'color:'. $learn_more_color .';';
    } else {
      $learn_more_color ='';
    }
    if ($icon_border_color) {
      $icon_border_color = 'border-color:'. $icon_border_color .';';
    } else {
      $icon_border_color ='';
    }
    if ($service_bg_color) {
      $service_bg_color = 'background-color:'. $service_bg_color .';';
    } else {
      $service_bg_color ='';
    }

    // Sizes
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($sub_heading_size) {
      $sub_heading_size = 'font-size:'. esc_attr($sub_heading_size) .';';
    } else {
      $sub_heading_size ='';
    }

    if ($service_content_height) {
      $service_content_height = 'height:'. esc_attr($service_content_height) .';';
    } else {
      $service_content_height ='';
    }
    if ($learn_more_size) {
      $learn_more_size = 'font-size:'. esc_attr($learn_more_size) .';';
    } else {
      $learn_more_size ='';
    }

    if ($icon_type == 'large') {
      $icon_type ='jt-icon-big';
    } elseif($icon_type == 'small') {
      $icon_type ='jt-icon-small';
    } else {
      $icon_type ='';
    }

    if ($icon_border_style =='circle') {
      $icon_border_style ='services-cirle';
    } elseif($icon_border_style =='square') {
      $icon_border_style ='services-square';
    } else {
      $icon_border_style ='';
    }

    if ($service_icon_border =='square') {
      $service_icon_border ='services-icon serv-square-border';
    } elseif($service_icon_border =='none') {
      $service_icon_border ='services-icon serv-none-border';
    } else {
      $service_icon_border ='services-icon';
    }

    if ($service_bg_image) {
      $image_url = wp_get_attachment_url( $service_bg_image );
      $service_bg_image = 'style="background-image:url('. esc_attr($image_url) .');"';
    } else {
      $service_bg_image ='';
    }

    if ($service_icon_image) {
      $image_url = wp_get_attachment_url( $service_icon_image );
      $service_icon_image = '<img src="'. esc_attr($image_url) .'" alt="">';
    } else {
      $service_icon_image = '<img src="'. IMAGES .'/dummy/services-demo.png" alt="">';
    }

    if ($service_image) {
      $image_url = wp_get_attachment_url( $service_image );
      $service_image = '<img src="'. esc_attr($image_url) .'" alt="">';
    } else {
      $service_image = '<img src="'. IMAGES .'/dummy/350x350.jpg" alt="">';
    }

    if($icon_position == 'right') {
      $icon_place = 'text-right';
    } else {
      $icon_place = 'text-left';
    }

    if ($need_right_seperate == 'yes') {
      $need_right_seperate ='<div class="jt-shop-sep"></div>';
    } else {
      $need_right_seperate ='';
    }

    if ($need_seperate == 'yes') {
      if ($service_style == 'style-5' || $service_style == 'style-11') {
        if ($icon_position == 'right') {
          $need_seperate = '<div class="jt-sep-two-right"></div>';
        } else { $need_seperate = '<div class="jt-sep-two"></div>'; }
      } else { $need_seperate = '<div class="jt-sep-two"></div>'; }
    } else {
      $need_seperate ='';
    }

     if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }

    if ($need_learn_more == 'yes') {
      $need_learn_more ='have-learn-more';
    } else {
      $need_learn_more ='none-learn-more';
    }

    if ($need_icon_border) {
      $need_icon_border ='serv-have-border';
    } else {
      $need_icon_border ='';
    }

    if ($need_hover) {
      $need_hover ='sep-hover-control';
    } else {
      $need_hover ='';
    }

    if ($service_border_bottom =='yes') {
      $service_border_bottom ='service-sep-bottom';
    } else {
      $service_border_bottom ='';
    }

    if ($service_border_right =='yes') {
      $service_border_right ='service-sep-right';
    } else {
      $service_border_right ='';
    }

    if ($open_link == 'yes') {
      $open_link = 'target="_blank"';
    } else {
      $open_link = '';
    }

    // Link
    if ($services_link) {
      $a_open = '<a href="'. $services_link .'" '. $open_link .' style="'. $heading_color . $heading_size . '">';
      $a_close = '</a>';
    } else {
      $a_open = '';
      $a_close = '';
    }

    // Output
    if ($service_style == 'style-1') {
      $output ='<div class="services-style-one '. $page_model_class1 .' '. esc_attr($class) .'">
                    <div class="services-icon">
                        <i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i>
                    </div>
                    <div class="services-content">
                        <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                        '. $content .'
                    </div>
                </div>';
    } elseif($service_style == 'style-2') {
      $output ='<div class="services-style-two sep-hover-control '. $page_model_class2 .' '. esc_attr($class) .'">
                    <div class="services-icon"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>
                    <div class="services-content">
                        <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                        <div class="jt-sep-two"></div>
                        '. $content .'
                    </div>
                </div>';
    } elseif($service_style == 'style-3') {
      $output ='<div class="services-style-three sep-hover-control '. $page_model_class3 .' '. esc_attr($class) .'" '.$service_bg_image .'>
                    <div class="jt-ser-three-overlay"></div>
                    <div class="services-icon" style="'. $icon_border_color .'"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . $icon_border_color . '"></i></div>
                    <div class="services-content">
                        <h3 style="'. $heading_color . $heading_size . '">'. esc_attr($service_heading) .'</h3>
                        <div class="jt-sep-two"></div>
                        '. $content .'
                        <a href="'. esc_url($learn_more_link) .'" class="ser-learn-more" style="'. $learn_more_color . $learn_more_size .'">'. esc_attr($learn_more_text) .'<i>+</i></a>
                    </div>
                </div>';
    } elseif($service_style == 'style-4') {
      $output ='<div class="services-style-four '. $page_model_class4 .' '. esc_attr($class) .'">
                    <div class="services-icon"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>
                    <div class="services-content">
                      <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                    </div>
                </div>';
    } elseif($service_style == 'style-5') {
      $output ='<div class="services-style-five sep-hover-control '. $page_model_class5 .' '. $need_hover .' '. $icon_place .' '. esc_attr($class) .'">
                    <div class="services-icon"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>
                    <div class="services-content">
                        <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                        '. $need_seperate . $content .'
                    </div>
                </div>';
    } elseif($service_style == 'style-6') {
      $output ='<div class="services-style-six '. $page_model_class6 .' '. esc_attr($class) .'">
                        <div class="services-icon"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>
                        <div class="services-content">
                            <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                          '. $content .'
                        </div>
                    </div>';
    } elseif($service_style == 'style-7') {
      if($learn_more_text) {
        $learn_more_text ='<a href="'. esc_url($learn_more_link) .'" class="jt-serv-learnmore" style="'. $learn_more_color . $learn_more_size .'">'. esc_attr($learn_more_text) .'</a>';
      } else {
        $learn_more_text ='';
      }
      $output ='<div class="services-style-one '. $need_learn_more .' '. $need_icon_border .' '. $icon_type .' '. $need_hover .' '. $page_model_class1 .' '. esc_attr($class) .'">
                  <div class="services-icon '. $icon_border_style .'" style="'. $icon_border_color .'"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>
                  <div class="services-content">
                      <h3 style="'. $heading_color . $heading_size . '">'. esc_attr($service_heading) .'</h3>
                      '. $need_seperate . $content . $learn_more_text .'
                  </div>
              </div>';
    } elseif($service_style == 'style-8') {
      if($learn_more_text) {
        $learn_more_text ='<a href="'. esc_url($learn_more_link) .'" class="jt-serv-learn-more" style="'. $learn_more_color . $learn_more_size .'">'. esc_attr($learn_more_text) .'</a>';
      } else {
        $learn_more_text ='';
      }
      $output ='<div class="services-style-seven '. $page_model_class7 .' '. esc_attr($class) .'">
                    <div class="jt-serv-content" style="'. $service_content_height .'">
                        <i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i>
                        <h3 style="'. $heading_color . $heading_size . '">'. esc_attr($service_heading) .'</h3>
                        <div class="jt-serv-sub">
                            <p class="jt-serv-cont-1" style="'. $sub_heading_color . $sub_heading_size . '">'. esc_attr($service_sub_heading) .'</p>
                            <div class="jt-serv-cont-2">
                               '. $content . $learn_more_text .'
                            </div>
                        </div>
                    </div>
                </div>';
    } elseif($service_style == 'style-9') {
      $output='<div class="jt-vint-team-wrap jt-vint-service '. $page_model_class10 .' '. esc_attr($class) .'">
                    <div class="jt-vint-service-img">'. $a_open . $service_image . $a_close .'</div>
                    <div class="jt-vint-team-detail">
                        <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                        <span class="jt-vint-sep"></span>
                        '. $content .'
                    </div>
                </div>';
    } elseif($service_style == 'style-10') {
      if($learn_more_text) {
        $learn_more_text ='<a href="'. esc_url($learn_more_link) .'" style="'. $learn_more_color . $learn_more_size .'">'. esc_attr($learn_more_text) .'</a>';
      } else {
        $learn_more_text ='';
      }
      $output='<div class="services-style-two sep-hover-control services-style-eight jt-have-border '. $page_model_class8 .' '. esc_attr($class) .'">
                <div class="'. $service_icon_border .'"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>
                <div class="services-content">
                    <h3 style="'. $heading_color . $heading_size . '">'. esc_attr($service_heading) .'</h3>
                    '. $content . $learn_more_text .'
                </div>
            </div>';
    } elseif($service_style == 'style-11') {
      $output='<div class="services-style-two sep-hover-control sevices-no-round '. $page_model_class2 .' '. $service_border_right .' '. $icon_place .' '. $service_border_bottom .' '. esc_attr($class) .'">
               <div class="services-icon"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i></div>
                <div class="services-content">
                    <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                    '. $need_seperate . $content .'
                </div>
            </div>';
    } elseif($service_style == 'style-12') {
       if($need_hover_plus =='yes') {
        $need_hover_plus ='<a href="'. esc_url($hover_plus_icon_link) .'" class="jt-boxed-hover-plus"><img src="'. IMAGES .'/icons/hover-plus.png" alt="Plus Icon"> </a>';
      } else {
        $need_hover_plus ='';
      }
       $output='<div class="jt-boxed-service '. $page_model_class9 .' '. esc_attr($class) .'" style="'. $service_bg_color .'"><i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i><h3 style="'. $heading_color . $heading_size . '">'. esc_attr($service_heading) .'</h3>'. $content . $need_hover_plus .'</div>';
    } elseif($service_style == 'style-13') {
      $output='<div class="services-style-one jt-shop-service '. esc_attr($class) .'">
              '. $need_right_seperate .'
                <div class="services-icon">'. $service_icon_image .'
                </div>
                <div class="services-content">
                    <h3 style="'. $heading_color . $heading_size . '">'. $a_open . esc_attr($service_heading) . $a_close .'</h3>
                    '. $content .'
                </div>
            </div>';
    } else {
      $output='<div class="services-style-one '. esc_attr($class) .'">
                    <div class="services-icon">
                        <i class="'. esc_attr($service_icon) .'" style="'. $icon_color . $icon_size . '"></i>
                    </div>
                    <div class="services-content">
                        <h3 style="'. $heading_color . $heading_size . '">'. esc_attr($service_heading) .'</h3>
                        '. $content .'
                    </div>
                </div>';
    }
    return $output;
  }
}
add_shortcode( 'jt_service', 'juster_services' );

/* ==========================================================
    20.Testimonials
=========================================================== */
if ( !function_exists('juster_testimonial')) {
  function juster_testimonial( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'testimonial_limit'  => '',
      'testimonial_style'  => '',
      'rating_type'  => '',
      'short_title'  => '',
      'short_title_link'  => '',
      'testimonial_heading'  => '',
      'open_link'  => '',
      'class'  => '',

      // Color
      'short_title_color'  => '',
      'heading_color'  => '',
      'content_color'  => '',
      'name_color'  => '',
      'rate_icon_color'  => '',
      'profession_color'  => '',

      // Sizes
      'short_title_size'  => '',
      'heading_size'  => '',
      'name_size'  => '',
      'profession_size'  => '',
      'rate_icon_size'  => '',
      'content_size'  => '',
      'content_line_height'  => '',
    ), $atts));

    // Turn output buffer on
    ob_start();

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class1 = 'jt-testimonial-carousel-boxed';
      $page_model_class2 = 'jt-test-carousel-two-boxed';
      $page_model_class3 = 'flnce-abt-slide-boxed';
      $page_model_class4 = 'studio-testi-slide-boxed';
      $page_model_class5 = 'jt-vint-test-slide-boxed';
      $page_model_class6 = 'jt-box-test-slide-boxed';
    } else {
      $page_model_class1 = 'jt-testimonial-carousel-extrawidth';
      $page_model_class2 = 'jt-test-carousel-two-extrawidth';
      $page_model_class3 = 'flnce-abt-slide-extrawidth';
      $page_model_class4 = 'studio-testi-slide-extrawidth';
      $page_model_class5 = 'jt-vint-test-slide-extrawidth';
      $page_model_class6 = 'jt-box-test-slide-extrawidth';
    }

    // Color
    if ($short_title_color) {
      $short_title_color = 'color:'. $short_title_color .';';
    } else {
      $short_title_color ='';
    }
    if ($heading_color) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ($content_color) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ($name_color) {
      $name_color = 'color:'. $name_color .';';
    } else {
      $name_color ='';
    }
    if ($rate_icon_color) {
      $rate_icon_color = 'color:'. $rate_icon_color .';';
    } else {
      $rate_icon_color ='';
    }
    if ($profession_color) {
      $profession_color = 'color:'. $profession_color .';';
    } else {
      $profession_color ='';
    }

    // Sizes
    if ($short_title_size) {
      $short_title_size = 'font-size:'. esc_attr($short_title_size) .';';
    } else {
      $short_title_size ='';
    }
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }
    if ($name_size) {
      $name_size = 'font-size:'. esc_attr($name_size) .';';
    } else {
      $name_size ='';
    }
    if ($profession_size) {
      $profession_size = 'font-size:'. esc_attr($profession_size) .';';
    } else {
      $profession_size ='';
    }
    if ($rate_icon_size) {
      $rate_icon_size = 'font-size:'. esc_attr($rate_icon_size) .';';
    } else {
      $rate_icon_size ='';
    }
    if ($content_line_height) {
      $content_line_height = 'line-height:'. esc_attr($content_line_height) .';';
    } else {
      $content_line_height = '';
    }

    if ($open_link == 'yes') {
      $open_link = 'target="_blank"';
    } else {
      $open_link = '';
    }

    $global_model = ot_get_option('fullwidth_boxed');
    $content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );

    wp_register_script( 'ellipsis', SCRIPTS . '/ellipsis.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'ellipsis' );

    global $post;

    $args = array(
      // other query params here,
      'post_type' => 'testimonial',
      'posts_per_page'  => (int)$testimonial_limit,
    );
    $victorthemes_wpdb = new WP_Query( $args );

    if($testimonial_style == 'style1') { ?>
     <div class="jt-testimonial-carousel sep-hover-control <?php echo $page_model_class1; ?> <?php echo esc_attr($class); ?>">
      <?php
      if ($victorthemes_wpdb->have_posts()) : while ($victorthemes_wpdb->have_posts()) : $victorthemes_wpdb->the_post();
            if ( has_post_thumbnail() && ! post_password_required() ) {
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
                  $large_img = $image['0'];
                  $testimonial_image = aq_resize( $large_img, '550', '580', true );
                   if($testimonial_image) {
                      $testimonial_image=$testimonial_image;
                   } else {
                      $testimonial_image = IMAGES.'/dummy/550x580.jpg';
                   }
                } else {
                   $testimonial_image = IMAGES.'/dummy/550x580.jpg';
                }

               $testimonial_profession = get_post_meta( get_the_ID(), 'testimonial_profession', true );
               if($testimonial_profession) {
                  $testimonial_profession='( '.esc_attr($testimonial_profession) .' )';
               } else {
                  $testimonial_profession='';
               }
               $testimonial_star = get_post_meta( get_the_ID(), 'testimonial_star', true );
    ?>

          <div class="each-jt-test">
                <div class="jt-test-img">
                    <img src="<?php echo esc_attr($testimonial_image); ?>" alt="<?php esc_attr(the_title()); ?>">
                </div>
                <div class="jt-test-content">
                    <a href="<?php echo esc_url($short_title_link);  ?>" class="testimonial-link" style="<?php echo $short_title_color;  ?><?php echo $short_title_size;  ?>" <?php echo $open_link;  ?>><?php echo esc_attr($short_title);  ?></a>
                    <?php if ($testimonial_heading) { ?>
                    <h3 style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($testimonial_heading); ?></h3>
                    <div class="jt-sep-two"></div>
                    <?php } ?>
                    <p style="<?php echo $content_color;  ?><?php echo $content_size;  ?><?php echo $content_line_height;  ?>"><?php echo $post->post_content; ?></p>
                    <div class="jt-test-metas">
                         <?php
                         if($rating_type == 'star') {
                          $rate_icon = 'jt-test-stars';
                         } elseif($rating_type == 'heart') {
                          $rate_icon = 'jt-heart-list';
                         } else{
                          $rate_icon = '';
                         }
                        ?>
                        <ul class="<?php echo $rate_icon; ?>">
                             <?php
                          if($rating_type == 'star') {
                               if($testimonial_star) {
                                  for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li class="normal-star"><i class="fa fa-star-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="star-inactive"><i class="fa fa-star-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } elseif($rating_type == 'heart') {
                              if($testimonial_star) {
                                for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li><i class="fa fa-heart-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="jt-rating-inactive"><i class="fa fa-heart-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } else {} ?>
                        </ul>
                        <div class="jt-test-name" style="<?php echo $name_color;  ?><?php echo $name_size;  ?>">
                            <?php esc_attr(the_title()); ?>
                            <span style="<?php echo $profession_color;  ?><?php echo $profession_size;  ?>"><?php echo $testimonial_profession; ?></span>
                        </div>
                    </div>
                </div>
          </div>
            <?php
               endwhile;
            endif; ?>
    </div>
    <?php } elseif($testimonial_style == 'style2') { ?>
  <div class="<?php echo $page_model_class2; ?> <?php echo esc_attr($class); ?>">
   <div class="jt-heading jt-head-large">
        <span class="jt-short-title" style="<?php echo $short_title_color;  ?><?php echo $short_title_size;  ?>"><?php echo esc_attr($short_title); ?></span>
          <?php if ($testimonial_heading) { ?>
          <h2 style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($testimonial_heading); ?></h2>
          <div class="jt-sep"></div>
          <?php } ?>
    </div>

    <div class="jt-test-carousel-two">
    <?php
      if ($victorthemes_wpdb->have_posts()) : while ($victorthemes_wpdb->have_posts()) : $victorthemes_wpdb->the_post();

      $testimonial_profession = get_post_meta( get_the_ID(), 'testimonial_profession', true );
      if($testimonial_profession) {
          $testimonial_profession='( '.esc_attr($testimonial_profession) .' )';
       } else {
          $testimonial_profession='';
       }
      $testimonial_star = get_post_meta( get_the_ID(), 'testimonial_star', true );
    ?>
      <!-- Each Carousel -->
        <div class="jt-test-each-carousel">
           <p style="<?php echo $content_color;  ?><?php echo $content_size;  ?><?php echo $content_line_height;  ?>">
           <?php echo $post->post_content; ?>
           </p>
            <div class="jt-test-metas">
                <?php
                 if($rating_type == 'star') {
                  $rate_icon = 'jt-test-stars';
                 } elseif($rating_type == 'heart') {
                  $rate_icon = 'jt-heart-list';
                 } else{
                  $rate_icon = '';
                 }
                ?>
                <ul class="<?php echo $rate_icon; ?>">
                       <?php
                  if($rating_type == 'star') {
                       if($testimonial_star) {
                          for( $i=1;$i<= $testimonial_star; $i++) {?>
                            <li class="normal-star"><i class="fa fa-star-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                            <?php  }
                       }
                        $inactive_star = 5 - $testimonial_star;
                        if($inactive_star) {
                          for( $i=1;$i<= $inactive_star; $i++) { ?>
                            <li class="star-inactive"><i class="fa fa-star-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                            <?php  }
                        }
                  } elseif($rating_type == 'heart') {
                      if($testimonial_star) {
                        for( $i=1;$i<= $testimonial_star; $i++) {?>
                            <li><i class="fa fa-heart-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                            <?php  }
                       }
                        $inactive_star = 5 - $testimonial_star;
                        if($inactive_star) {
                          for( $i=1;$i<= $inactive_star; $i++) { ?>
                            <li class="jt-rating-inactive"><i class="fa fa-heart-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                            <?php  }
                        }
                  } else {} ?>
                </ul>
                <div class="jt-test-name" style="<?php echo $name_color;  ?><?php echo $name_size;  ?>">
                    <?php esc_attr(the_title()); ?>
                    <span style="<?php echo $profession_color;  ?><?php echo $profession_size;  ?>"><?php echo $testimonial_profession; ?></span>
                </div>
            </div>
        </div>
        <!-- Each Carousel -->
         <?php
       endwhile;
    endif; ?>
    </div>
  </div>
    <?php } elseif($testimonial_style == 'style3') { ?>
    <div class="flnce-abt-slide <?php echo $page_model_class3; ?> <?php echo esc_attr($class); ?>">
        <div class="container">
            <div class="jt-heading jt-testi-head">
                <p class="jt-slide-tit" style="<?php echo $short_title_color;  ?><?php echo $short_title_size;  ?>"><?php echo $short_title; ?></p>
                 <?php if ($testimonial_heading) { ?>
                  <h2 style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo $testimonial_heading; ?></h2>
                  <div class="jt-sep"></div>
                  <?php } ?>
            </div>
            <div id="jt-testimonial-slide" class="jt-testimonials-style-three have-number-nav">
            <?php
              if ($victorthemes_wpdb->have_posts()) : while ($victorthemes_wpdb->have_posts()) : $victorthemes_wpdb->the_post();

              $testimonial_profession = get_post_meta( get_the_ID(), 'testimonial_profession', true );
              if($testimonial_profession) {
                  $testimonial_profession='( '.esc_attr($testimonial_profession) .' )';
              } else {
                  $testimonial_profession='';
              }
              $testimonial_star = get_post_meta( get_the_ID(), 'testimonial_star', true );
            ?>
                <div class="flnce-slide-cont sep-hover-control">
                    <p class="slide-cont" style="<?php echo $content_color;  ?><?php echo $content_size; ?><?php echo $content_line_height; ?>"><?php echo $post->post_content; ?></p>
                      <?php
                         if($rating_type == 'star') {
                          $rate_icon = 'jt-test-stars';
                         } elseif($rating_type == 'heart') {
                          $rate_icon = 'jt-heart-list';
                         } else{
                          $rate_icon = '';
                         }
                        if ($rating_type) {
                        ?>
                        <ul class="<?php echo $rate_icon; ?>">
                          <?php
                          if($rating_type == 'star') {
                               if($testimonial_star) {
                                  for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li class="normal-star"><i class="fa fa-star-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="jt-rating-inactive"><i class="fa fa-star-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } elseif($rating_type == 'heart') {
                              if($testimonial_star) {
                                for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li><i class="fa fa-heart-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="jt-rating-inactive"><i class="fa fa-heart-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } else {} ?>
                    </ul>
                    <?php } ?>
                    <div class="testi-name" style="<?php echo $name_color;  ?><?php echo $name_size;  ?>">
                        <?php esc_attr(the_title()); ?>
                        <span class="testi-desg" style="<?php echo $profession_color;  ?><?php echo $profession_size;  ?>"><?php echo $testimonial_profession; ?></span>
                    </div>
              </div>
            <?php
            endwhile;
            endif; ?>
          </div>
        </div>
    </div>
    <?php } elseif($testimonial_style == 'style4') { ?>
    <div class="flnce-abt-slide studio-testi-slide <?php echo $page_model_class4; ?> <?php echo esc_attr($class); ?>">
        <div class="container">
            <div id="jt-testimonial-slide" class="jt-studio-testimonials have-number-nav">
            <?php
              if ($victorthemes_wpdb->have_posts()) : while ($victorthemes_wpdb->have_posts()) : $victorthemes_wpdb->the_post();

                if ( has_post_thumbnail() && ! post_password_required() ) {
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
                  $large_img = $image['0'];
                  $testimonial_img = aq_resize( $large_img, '100', '100', true );
                  if($testimonial_img) {
                    $testimonial_img=$testimonial_img;
                  } else {
                    $testimonial_img = IMAGES.'/dummy/100x100.png';
                  }
                } else {
                  $testimonial_img = IMAGES.'/dummy/100x100.png';
                }

              $testimonial_profession = get_post_meta( get_the_ID(), 'testimonial_profession', true );
              if($testimonial_profession) {
                  $testimonial_profession='( '.esc_attr($testimonial_profession) .' )';
              } else {
                  $testimonial_profession='';
              }
               $testimonial_star = get_post_meta( get_the_ID(), 'testimonial_star', true );
            ?>
                <!-- Each Slide -->
                <div class="flnce-slide-cont sep-hover-control">
                    <div class="jt-studio-test-img">
                        <img src="<?php echo esc_url($testimonial_img); ?>" alt="<?php the_title(); ?>">
                    </div>
                    <p class="slide-cont" style="<?php echo $content_color;  ?><?php echo $content_size; ?><?php echo $content_line_height;  ?>"><?php echo $post->post_content; ?></p>
                    <?php
                         if($rating_type == 'star') {
                          $rate_icon = 'jt-test-stars';
                         } elseif($rating_type == 'heart') {
                          $rate_icon = 'jt-heart-list';
                         } else{
                          $rate_icon = '';
                         }
                        ?>
                        <ul class="<?php echo $rate_icon; ?>">
                          <?php
                          if($rating_type == 'star') {
                               if($testimonial_star) {
                                  for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li class="normal-star"><i class="fa fa-star-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="jt-rating-inactive"><i class="fa fa-star-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } elseif($rating_type == 'heart') {
                              if($testimonial_star) {
                                for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li><i class="fa fa-heart-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="jt-rating-inactive"><i class="fa fa-heart-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } else {} ?>
                    </ul>
                    <div class="testi-name" style="<?php echo $name_color;  ?><?php echo $name_size;  ?>">
                        <?php esc_attr(the_title()); ?>
                        <span class="testi-desg" style="<?php echo $profession_color;  ?><?php echo $profession_size;  ?>"><?php echo $testimonial_profession; ?></span>
                    </div>
                </div>
                <!-- Each Slide -->
            <?php endwhile;endif; ?>
            </div>
            <!-- Nav Arrow -->
        </div> <!-- Container -->
    </div>
    <?php } elseif($testimonial_style == 'style5')  { ?>
        <div class="flnce-abt-slide jt-vint-test-slide <?php echo $page_model_class5; ?> <?php echo esc_attr($class); ?>">
          <div class="container">
              <div class="jt-heading jt-testi-head">
                  <p class="jt-slide-tit" style="<?php echo $short_title_color;  ?><?php echo $short_title_size;  ?>"><?php echo esc_attr($short_title); ?></p>
                  <?php if ($testimonial_heading) { ?>
                    <div class="jt-vint-title jt-leaf-center jt-leaf">
                    <h2 style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($testimonial_heading); ?></h2>
                   </div>
                 <?php } ?>
              </div>
              <div id="jt-testimonial-slide" class="jt-vintage-testimonials">
                <?php
                  if ($victorthemes_wpdb->have_posts()) : while ($victorthemes_wpdb->have_posts()) : $victorthemes_wpdb->the_post();

                  $testimonial_profession = get_post_meta( get_the_ID(), 'testimonial_profession', true );
                  if($testimonial_profession) {
                    $testimonial_profession='( '.esc_attr($testimonial_profession) .' )';
                  } else {
                    $testimonial_profession='';
                  }
                  $testimonial_star = get_post_meta( get_the_ID(), 'testimonial_star', true );
                ?>

                  <!-- Each Slide -->
                  <div class="flnce-slide-cont sep-hover-control">
                      <p class="slide-cont" style="<?php echo $content_color;  ?><?php echo $content_size; ?><?php echo $content_line_height;  ?>"><?php echo $post->post_content; ?></p>
                      <?php
                         if($rating_type == 'star') {
                          $rate_icon = 'jt-test-stars';
                         } elseif($rating_type == 'heart') {
                          $rate_icon = 'jt-heart-list';
                         } else{
                          $rate_icon = '';
                         }
                        ?>
                        <ul class="<?php echo $rate_icon; ?>">
                          <?php
                          if($rating_type == 'star') {
                               if($testimonial_star) {
                                  for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li class="normal-star"><i class="fa fa-star-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="star-inactive"><i class="fa fa-star-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } elseif($rating_type == 'heart') {
                              if($testimonial_star) {
                                for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li><i class="fa fa-heart-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="jt-rating-inactive"><i class="fa fa-heart-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } else {} ?>
                      </ul>
                      <div class="testi-name" style="<?php echo $name_color;  ?><?php echo $name_size;  ?>">
                          <?php esc_attr(the_title()); ?>
                          <span class="testi-desg" style="<?php echo $profession_color;  ?><?php echo $profession_size;  ?>"><?php echo $testimonial_profession; ?></span>
                      </div>
                  </div>
                  <!-- Each Slide -->
               <?php
                endwhile;
                endif; ?>
              </div>
            <!-- Nav Arrow -->
        </div> <!-- Container -->
    </div>
    <?php } else { ?>
      <div class="flnce-abt-slide jt-box-test-slide <?php echo $page_model_class6; ?> <?php echo esc_attr($class); ?>">
          <div class="container">
            <div class="jt-heading jt-testi-head">
                 <p class="jt-slide-tit" style="<?php echo $short_title_color;  ?><?php echo $short_title_size;  ?>"><?php echo esc_attr($short_title); ?></p>
                 <?php if ($testimonial_heading) { ?>
                  <div class="jt-vint-title jt-leaf-center">
                  <h2 style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($testimonial_heading); ?></h2>
                  <div class="jt-boxslide-sep"></div>
                  </div>
                  <?php } ?>
              </div>
              <div id="jt-testimonial-slide" class="jt-testimonial-style-six">
                <?php
                  if ($victorthemes_wpdb->have_posts()) : while ($victorthemes_wpdb->have_posts()) : $victorthemes_wpdb->the_post();

                  $testimonial_profession = get_post_meta( get_the_ID(), 'testimonial_profession', true );
                  if($testimonial_profession) {
                    $testimonial_profession='( '.esc_attr($testimonial_profession) .' )';
                  } else {
                    $testimonial_profession='';
                  }
                  $testimonial_star = get_post_meta( get_the_ID(), 'testimonial_star', true );
                ?>
                <!-- Each Slide -->
                <div class="flnce-slide-cont sep-hover-control">
                    <p class="slide-cont" style="<?php echo $content_color;  ?><?php echo $content_size; ?><?php echo $content_line_height;  ?>"><?php echo $post->post_content; ?></p>
                    <?php
                     if($rating_type == 'star') {
                      $rate_icon = 'jt-test-stars';
                     } elseif($rating_type == 'heart') {
                      $rate_icon = 'jt-heart-list';
                     } else{
                      $rate_icon = '';
                     }
                    ?>
                    <ul class="<?php echo $rate_icon; ?>">
                          <?php
                          if($rating_type == 'star') {
                               if($testimonial_star) {
                                  for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li class="normal-star"><i class="fa fa-star-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="star-inactive"><i class="fa fa-star-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } elseif($rating_type == 'heart') {
                              if($testimonial_star) {
                                for( $i=1;$i<= $testimonial_star; $i++) {?>
                                    <li><i class="fa fa-heart-o" style="<?php echo $rate_icon_color;  ?><?php echo $rate_icon_size; ?>"></i></li>
                                <?php  }
                               }
                                $inactive_star = 5 - $testimonial_star;
                                if($inactive_star) {
                                  for( $i=1;$i<= $inactive_star; $i++) { ?>
                                    <li class="jt-rating-inactive"><i class="fa fa-heart-o" style="<?php echo $rate_icon_size; ?>"></i></li>
                                    <?php  }
                                }
                          } else {} ?>
                    </ul>
                    <div class="testi-name" style="<?php echo $name_color;  ?><?php echo $name_size;  ?>">
                          <?php esc_attr(the_title()); ?>
                          <span class="testi-desg" style="<?php echo $profession_color;  ?><?php echo $profession_size;  ?>"><?php echo $testimonial_profession; ?></span>
                    </div>
                </div>
                <!-- Each Slide -->
                <?php
                endwhile;
                endif; ?>
            </div>
          </div>
      </div>
    <?php }
    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'jt_testimonials', 'juster_testimonial' );

/* ==========================================================
    21. Alert Message
=========================================================== */
if ( !function_exists('alert_styles')) {
  function alert_styles( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'alert_type'  => '',
      'alert_strong_text'  => '',
      'alert_text'  => '',
      'alert_icon'  => '',
      'class'  => '',
      'need_bg'  => '',
      'need_close_icon'  => '',
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'alert-boxed';
    } else {
      $page_model_class = 'alert-extrawidth';
    }

    if($need_close_icon =='yes') {
      $need_close_icon ='<a class="toggle-alert" href="#"><i class="pe-7s-close"></i></a>';
    } else {
      $need_close_icon ='';
    }

    if($need_bg =='yes') {
      $need_bg ='alert';
    } else {
      $need_bg ='alert alert-bg';
    }

    // Output
    if ($alert_text) {
    $output = '<div class="'. $need_bg .' '. $page_model_class .' '. $alert_type .' '. esc_attr($class) .'"><span class="alert-icon"><i class="'. esc_attr($alert_icon) .'"></i></span><span class="alert-msg"><strong>'. esc_attr($alert_strong_text) .'</strong>'. esc_attr($alert_text) .'</span>'. $need_close_icon .'</div>';
    } else { $output="";}
    return $output;
  }
}
add_shortcode( 'jt_alert', 'alert_styles' );

/* ==========================================================
    22.Tables
=========================================================== */
if ( !function_exists('juster_table')) {
  function juster_table( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'table_style'  => '',
      'row_title'  => '',
      'table_data'  => '',
      'class'  => '',

      // Color
      'title_color'  => '',
      'data_color'  => '',

      // Sizes
      'title_size'  => '',
      'data_size'  => '',
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'table-boxed';
    } else {
      $page_model_class = 'table-extrawidth';
    }

    // Color
    if ($title_color) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ($data_color) {
      $data_color = 'color:'. $data_color .';';
    } else {
      $data_color ='';
    }

    // Sizes
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($data_size) {
      $data_size = 'font-size:'. esc_attr($data_size) .';';
    } else {
      $data_size ='';
    }

    // Output
    if ($row_title) {
      $output = '<table class="table table-bordered table-extrawidth '. $table_style .' '. esc_attr($class) .'"><tbody><tr><th style="'. $title_color . $title_size .'">'. str_replace(array("\n", "|"), array("</th><th style=\"$title_color$title_size\">", "</th><th style=\"$title_color$title_size\">"), trim($row_title,"")) .'</th></tr><tr><td style="'. $data_color . $data_size .'">'. str_replace(array("\n", "|"), array("</td></tr><tr><td style=\"$data_color$data_size\">", "</td><td style=\"$data_color$data_size\">"), trim($table_data,"")) .'</td></tr></tbody></table>';
    } else { $output=""; }
    return $output;
  }
}
add_shortcode('jt_table', 'juster_table' );

/* ==========================================================
    23.Progress Bar
=========================================================== */
if ( !function_exists('juster_progressbar')) {
  function juster_progressbar( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'title'  => '',
      'chart_size'  => '',
      'percentage'  => '',
      'extra_class'  => '',

      // Color
      'title_color'  => '',
      'percentage_color'  => '',
      'percentage_bg_color'  => '',

      // Sizes
      'title_size'  => '',
      'percentage_size'  => '',
      'text_transform'  => '',
    ), $atts));

    wp_register_script( 'progressbar', SCRIPTS . '/jquery.easypiechart.js', array('jquery'), '', true);
    wp_enqueue_script( 'progressbar' );

    // Color
    if ($title_color) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ($percentage_color) {
      $percentage_color = 'color:'. $percentage_color .';';
    } else {
      $percentage_color ='';
    }
    if ($percentage_bg_color) {
      $percentage_bg_color = 'background-color:'. $percentage_bg_color .';';
    } else {
      $percentage_bg_color ='';
    }

    // Sizes
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size = '';
    }
    if ($percentage_size) {
      $percentage_size = 'font-size:'. esc_attr($percentage_size) .';';
    } else {
      $percentage_size = '';
    }
    if ($text_transform) {
      $text_transform = 'text-transform:'. $text_transform .';';
    } else {
      $text_transform = '';
    }

    if ($chart_size) {
      $chart_size = $chart_size;
    } else { $chart_size = 'medium'; }

    // Output
    if ($title) {
    $output ='<div class="piechart-value '. esc_attr($extra_class) .'"><section class="skills-pie-script jt-chart-size-'. $chart_size .'"><div class="skills-pie"><div class="text-center"><div class="chart width-170" data-percent="'. esc_attr($percentage) .'"><span class="wv-percent percent-onepage" style="'. $percentage_color . $percentage_size . $percentage_bg_color .'">'. esc_attr($percentage) .'</span></div><h2 class="text-center pie-text" style="'. $title_color . $title_size .  $text_transform .'">'. esc_attr($title) .'</h2></div></div></section></div>';
    } else { $output=""; }
     return $output;
  }
}
add_shortcode( 'jt_progress_bar', 'juster_progressbar' );

/* ==========================================================
    24.Feature Box
=========================================================== */
if ( !function_exists('juster_feature_box')) {
  function juster_feature_box( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'feature_box_title'  => '',
      'feature_box_content'  => '',
      'bg_image'  => '',
      'bg_image_effect'  => '',
      'class'  => '',

      // Color
      'title_color'  => '',
      'content_color'  => '',
      'title_size'  => '',
      'content_size'  => '',

      // Sizes
      'inner_top'  => '',
      'inner_padding'  => '',
    ), $atts));

    wp_register_script( 'tiltfx-js', SCRIPTS . '/tiltfx.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'tiltfx-js' );

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-featured-box-boxed';
    } else {
      $page_model_class = 'jt-featured-box-wide';
    }

    // Design
    if ($title_color) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color = '';
    }
    if ($content_color) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color = '';
    }
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size = '';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size = '';
    }

    // Spacing
    if ($inner_top) {
      $inner_top = 'top:'. esc_attr($inner_top) .';';
    } else {
      $inner_top = '';
    }

    if ($inner_padding) {
      $inner_padding = 'padding:'. esc_attr($inner_padding) .';';
    } else {
      $inner_padding = '';
    }

    if ($bg_image) {
      $image_url = wp_get_attachment_url( $bg_image );
      if ($bg_image_effect == 'yes') {
        $bg_image = '<img src="'. esc_attr($image_url) .'" class="tilt-effect" alt="grid02"/>';
      }
   }

    // Output
    if ($feature_box_title) {
    $output ='<div class="jt-featured-box-wrapper '. $page_model_class .' '. esc_attr($class) .'"><div class="jt-tilt-effect"><div class="jt-wwd-img">'. $bg_image .'</div></div><div class="jt-featured-box sep-hover-control" style="'. $inner_top . $inner_padding .'"><div class="jt-heading"><h2 style="'. $title_color . $title_size .'">'. esc_attr($feature_box_title) .'</h2><div class="jt-sep"></div></div><p style="'. $content_color . $content_size .'">'. esc_attr($feature_box_content) .'</p></div></div>';
    } else { $output=""; }
     return $output;
  }
}
add_shortcode( 'jt_feature_box', 'juster_feature_box' );

/* ==========================================================
    25. Icon Tabs
=========================================================== */
if ( !function_exists('juster_icon_tabs')) {
  function juster_icon_tabs( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'class'  => ''
    ), $atts));

    $image_tabs = ot_get_option('image_tabs');

    wp_enqueue_style( 'jquery-pwstabs-min', THEMEROOT . '/css/jquery.pwstabs.min.css' );
    wp_register_script( 'pwstabs-js', SCRIPTS . '/jquery.pwstabs.min.js', array('jquery'), '', true);
    wp_enqueue_script( 'pwstabs-js' );

    // Turn output buffer on
    ob_start();
    ?>
    <div class="jt-tab-image-wrapper jt-studio-service-right <?php echo esc_attr($class); ?>">
        <div class="jt-tab-image">
            <?php
            if ($image_tabs) {
            foreach($image_tabs as $images) {
                if($images['icon_details'] =='on' && $images['tab_icon_content'] != '' && $images['tab_icon_button_link'] !='' && $images['tab_icon_button_text'] !=''){
                  $icon_details='<div class="jt-heading jt-studio-heading">
                                <h2>'. esc_attr($images['title']) .'</h2>
                                <div class="jt-sep"></div>
                            </div>
                            <div class="jt-studio-serv-cont">
                                <p>'. $images['tab_icon_content'] .'</p>
                                <a href="'. esc_url($images['tab_icon_button_link']) .'">'. esc_attr($images['tab_icon_button_text']) .'</a>
                            </div>';
                } else {
                  $icon_details='<img src="'. esc_attr($images['tab_image']) .'" alt="'. esc_attr($images['title']) .'">';
                }
                echo '<div data-pws-tab="'. esc_attr($images['title']) .'" data-pws-tab-name="'. esc_attr($images['title']) .'" data-pws-tab-icon="'. esc_attr($images['tab_icon']) .'">'. $icon_details .'</div>';
                  }
              }
            ?>
            </div><!-- jt-tab-image -->
    </div><!-- jt-tab-image-wrapper -->
    <?php
    // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_icon_tabs', 'juster_icon_tabs' );

/* ==========================================================
    26.Awards
=========================================================== */
if ( !function_exists('juster_awards_style')) {
  function juster_awards_style( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'award_title'  => '',
      'award_image'  => '',
      'award_link'  => '',
      'class'  => '',

      // Color
      'title_color'  => '',
      'title_size'  => '',
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'awards-boxed';
    } else {
      $page_model_class = 'awards-wide';
    }

    // Design
    if ($title_color) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color = '';
    }
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size = '';
    }

    if ($award_image) {
      $image_url = wp_get_attachment_url( $award_image );
      $award_image = '<img src="'. esc_attr($image_url) .'" alt="'. esc_attr($award_title) .'" />';
    } else {
      $award_image = '';
    }

    // Output
    if ($award_title) {
    $output ='<div class="flnce-awards '. $page_model_class .' '. esc_attr($class) .'"><div class="col-sm-3 padding-zero"><a href="'. esc_url($award_link) .'" class="award-img">'. $award_image . '</a></div><div class="col-sm-9 padding-zero"><p class="award-det" style="'. $title_color . $title_size .'">'. esc_attr($award_title) .'</p></div></div>';
    } else { $output=""; }
     return $output;
  }
}
add_shortcode( 'jt_awards', 'juster_awards_style' );

/* ==========================================================
    27. Simple slider
=========================================================== */
if ( !function_exists('juster_simpleslide')) {
  function juster_simpleslide( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'slider_style'  => '',
      'simple_slide_img'  => '',
      'class'  => ''
    ), $atts));

    // Turn output buffer on
    ob_start();

    // Get Attachments
    $attachments = explode(",",$simple_slide_img);
    //$attachments = array_combine($attachments,$attachments);
    if($slider_style =='style-one') { ?>

     <div class="jt-simple-slider-one <?php echo esc_attr($class); ?>">
           <?php
          if ($attachments) {
            foreach ( $attachments as $attachment ) :
              if ( $attachment ) {
                $attachment_img = wp_get_attachment_url( $attachment );
              ?>
             <div class="jt-slider-item"><img src="<?php echo esc_attr($attachment_img); ?>" alt="" /> </div>
             <?php } endforeach; } ?>
    </div>
    <?php } elseif($slider_style =='style-two') { ?>
    <div class="jt-simple-slider-two <?php echo esc_attr($class); ?>">
           <?php
          if ($attachments) {
            foreach ( $attachments as $attachment ) :
              if ( $attachment ) {
                $attachment_img = wp_get_attachment_url( $attachment );
              ?>
             <div class="jt-slider-item"><img src="<?php echo esc_attr($attachment_img); ?>" alt="" /> </div>
             <?php } endforeach; } ?>
    </div>
    <?php } else { ?>
    <div class="jt-studio-small-slide <?php echo esc_attr($class); ?>">
           <?php
          if ($attachments) {
            foreach ( $attachments as $attachment ) :
              if ( $attachment ) {
                $attachment_img = wp_get_attachment_url( $attachment );
              ?>
             <div class="jt-studio-small-image"><img src="<?php echo esc_attr($attachment_img); ?>" alt="" /> </div>
             <?php } endforeach; } ?>
    </div>
    <?php }
    // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'jt_simple_slide', 'juster_simpleslide' );

/* ==========================================================
   28. Products
=========================================================== */
if ( !function_exists('juster_woo_products')) {
  function juster_woo_products( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'jt_product_type'  => '',
      'jt_products_limit'  => '',
      'jt_products_order'  => '',
      'jt_products_order_by'  => '',
      'port_offset'  => '',
      'show_category'  => '',
      'enable_pagination'  => '',
      'extra_class'  => '',
    ), $atts));

    // Turn output buffer on
    ob_start();
    // global $woocommerce;
    global $product;

    $product_design = ot_get_option('woo_product_design');
    if($product_design == 'product_style_two') {
      $product_style='jt-product-style-two';
    } else {
      $product_style='jt-product-style-one';
    }

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-product-boxed';
    } else {
      $page_model_class = 'jt-product-wide';
    }
    ?>

    <!-- Products -->
    <div class="vc-products <?php echo $product_style; ?> vc-products-<?php echo $jt_product_type; ?> <?php echo $page_model_class; ?> <?php echo esc_attr($extra_class); ?>">
        <ul class="products">

        <?php if ($jt_product_type == 'type-2') { ?>
          <!-- Portfolio Filter -->
          <li class="jt-cat-tab">
            <?php  if($show_category) { ?>
            <ul id="jt-filter" class="jt-trend-filter">
              <?php
                $cat_name = explode(',', $show_category);
                $terms = $cat_name;
                $count = count($terms);
                if ($count > 0) {
                  foreach ($terms as $term) {
                    echo '<li><a href="#0" class="filter '. preg_replace('/[^a-z]/', "", strtolower($term)) .'-cat-jt-product" data-filter=".'. preg_replace('/[^a-z]/', "", strtolower($term)) .'-cat-jt-product" title="' . esc_attr($term) . '">' . $term . '</a></li>';
                   }
                }
              ?>
            </ul>
            <?php } else { ?>
            <ul id="jt-filter" class="jt-trend-filter">
              <?php
                $terms = get_terms('product_cat');
                $count = count($terms);
                $i=0;
                $term_list = '';
                if ($count > 0) {
                  foreach ($terms as $term) {
                    $i++;
                    $term_list .= '<li><a href="#0" class="filter '. lcfirst($term->slug) .'-cat-jt-product" data-filter=".'. lcfirst($term->slug) .'-cat-jt-product" title="' . esc_attr($term->name) . '">' . $term->name . '</a></li>';
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
            <?php } ?>
          </li>
          <!-- Portfolio Filter -->
        <?php } ?>

  <?php
  if($jt_product_type =='type-2') {
  ?>
  <li class="isotope jt-trendy-item-wrap">
  <?php

            if($show_category) {
              $show_category_slugs = str_replace(', ', ',', $show_category);
              $show_category_slugs = rtrim($show_category_slugs, ',');
              $show_category_slugs_id = explode(",", $show_category_slugs);
              $terms = $show_category_slugs_id;
            } else {
              $terms = get_terms('product_cat');
            }
            foreach ($terms as $term) {
              if($show_category) {
                $cat_class = $term .'-cat-jt-product';
                $term_name = $term;
              } else {
                $cat_class = $term->slug .'-cat-jt-product';
                $term_name = $term->slug;
              }
              // $mentioned_cat = $term;
              $each_cat = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby' => esc_attr($jt_products_order_by),
                'order' => esc_attr($jt_products_order),
                'posts_per_page'  => (int)$jt_products_limit,
                'offset'  => (!(int)$port_offset ? "" : (int)$port_offset),
                'tax_query' => array(
                  array(
                    'taxonomy'  => 'product_cat',
                    'terms' => esc_attr($term_name),
                    'field' => 'slug',
                    'operator'  => 'IN'
                  )
                )
              );
            $sep_cat = new WP_Query( $each_cat ); ?>

            <div class="jt-trend-group <?php echo $cat_class; ?>">
              <?php
              /* Normal jt_products */
              if ($sep_cat->have_posts()) : while ($sep_cat->have_posts()) : $sep_cat->the_post();

              // Featured Image
              $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
              $large_image = $large_image[0];
                if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                  $product_img = aq_resize( $large_image, '260', '330', true );
                } else {
                  $product_img = IMAGES .'/dummy/260x330.jpg';
                }

                 if($product_design =='product_style_two') { ?>
                    <div class="jt-trend-item">
                      <a href="<?php esc_url(the_permalink()); ?>">
                        <div class="jt-trend-item-img">
                          <?php
                          if (get_post_meta( get_the_ID(), '_badge_texts', true )) {
                            $bg_color = get_post_meta( get_the_ID(), '_badge_bg_color', true );
                            $badge_color = get_post_meta( get_the_ID(), '_badge_color', true );
                            if ($bg_color) {$bg_color = 'background-color:'. $bg_color .';';} else { $bg_color = ''; }
                            if ($badge_color) {$badge_color = 'color:'. $badge_color .';';} else { $badge_color = ''; }
                            echo '<span class="product-tag" style="'. $bg_color . $badge_color .'">'. get_post_meta( get_the_ID(), '_badge_texts', true ) .'</span>';
                          }
                          ?>
                          <img src="<?php echo $product_img; ?>" class="attachment-shop_catalog wp-post-image" alt="<?php echo the_title();?>">
                        </div>
                        <div class="jt-trend-item-desc">
                          <h3><?php echo the_title();?></h3>
                          <span class="price"><?php echo woocommerce_get_template( 'loop/price.php' ); ?></span>
                        </div>
                        <?php woocommerce_get_template( 'loop/rating.php' ); ?>
                      </a>
                     <?php woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
                  </div>
                  <?php } else { ?>
                  <div class="jt-woo-product product-normal-style">
                    <a href="<?php esc_url(the_permalink()); ?>">
                      <div class="jt-product-image">
                        <?php
                        if (get_post_meta( get_the_ID(), '_badge_texts', true )) {
                          $bg_color = get_post_meta( get_the_ID(), '_badge_bg_color', true );
                          $badge_color = get_post_meta( get_the_ID(), '_badge_color', true );
                          if ($bg_color) {$bg_color = 'background-color:'. $bg_color .';';} else { $bg_color = ''; }
                          if ($badge_color) {$badge_color = 'color:'. $badge_color .';';} else { $badge_color = ''; }
                          echo '<span class="product-tag" style="'. $bg_color . $badge_color .'">'. get_post_meta( get_the_ID(), '_badge_texts', true ) .'</span>';
                        }
                        ?>
                        <img src="<?php echo $product_img; ?>" class="attachment-shop_catalog wp-post-image" alt="<?php echo the_title();?>">
                      </div>
                      <div class="jt-product-cnt">
                        <h3><?php echo the_title();?></h3>
                        <span class="price"><?php echo woocommerce_get_template( 'loop/price.php' ); ?></span>
                      </div>
                    </a>
                   <?php woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
                </div>
                <?php }
                endwhile;
                wp_reset_postdata();
                else :
                  get_template_part( 'content', 'none' );
                endif; ?>
            </div>
         <?php   } // foreach category
      } elseif($jt_product_type =='type-3') {
        ?>
      <div class="jt-new-prod jt-shop-small-slide-wrap">
           <?php

            if($show_category) {
              $each_cat = array(
                'post_type'       => 'product',
                'post_status'       => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'         => esc_attr($jt_products_order_by),
                'order'         => esc_attr($jt_products_order),
                'posts_per_page'    => (int)$jt_products_limit,
                'offset' => (!(int)$port_offset ? "" : (int)$port_offset),
                'tax_query'       => array(
                  array(
                    'taxonomy'    => 'product_cat',
                    'terms'     => esc_attr($show_category),
                    'field'     => 'slug',
                    'operator'    => 'IN'
                  )
                )
              );
            } else {
              $each_cat = array(
                'post_type'       => 'product',
                'post_status'       => 'publish',
                'ignore_sticky_posts' => 1,
                'offset'          => (!(int)$port_offset ? "" : (int)$port_offset),
                'orderby'         => esc_attr($jt_products_order_by),
                'order'         => esc_attr($jt_products_order),
                'posts_per_page'    => (int)$jt_products_limit,
              );
            }

            $sep_cat = new WP_Query( $each_cat );

                  /* Normal jt_products */
                  if ($sep_cat->have_posts()) : while ($sep_cat->have_posts()) : $sep_cat->the_post();

                  // Featured Image
                  $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                  $large_image = $large_image[0];
                  if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                    $product_img = aq_resize( $large_image, '260', '330', true );
                  } else {
                    $product_img = IMAGES .'/dummy/260x330.jpg';
                  }

                  if($product_design =='product_style_two') { ?>
                    <div class="jt-trend-item">
                      <a href="<?php esc_url(the_permalink()); ?>">
                        <div class="jt-trend-item-img">
                          <?php
                          if (get_post_meta( get_the_ID(), '_badge_texts', true )) {
                            $bg_color = get_post_meta( get_the_ID(), '_badge_bg_color', true );
                            $badge_color = get_post_meta( get_the_ID(), '_badge_color', true );
                            if ($bg_color) {$bg_color = 'background-color:'. $bg_color .';';} else { $bg_color = ''; }
                            if ($badge_color) {$badge_color = 'color:'. $badge_color .';';} else { $badge_color = ''; }
                            echo '<span class="product-tag" style="'. $bg_color . $badge_color .'">'. get_post_meta( get_the_ID(), '_badge_texts', true ) .'</span>';
                          }
                          ?>
                          <img src="<?php echo $product_img; ?>" class="attachment-shop_catalog wp-post-image" alt="<?php echo the_title();?>">
                        </div>
                        <div class="jt-trend-item-desc">
                          <h3><?php echo the_title();?></h3>
                          <span class="price"><?php echo woocommerce_get_template( 'loop/price.php' ); ?></span>
                        </div>
                        <?php woocommerce_get_template( 'loop/rating.php' ); ?>
                      </a>
                     <?php woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
                  </div>
                  <?php } else { ?>
                  <div class="jt-woo-product product-normal-style">
                    <a href="<?php esc_url(the_permalink()); ?>">
                      <div class="jt-product-image">
                        <?php
                        if (get_post_meta( get_the_ID(), '_badge_texts', true )) {
                          $bg_color = get_post_meta( get_the_ID(), '_badge_bg_color', true );
                          $badge_color = get_post_meta( get_the_ID(), '_badge_color', true );
                          if ($bg_color) {$bg_color = 'background-color:'. $bg_color .';';} else { $bg_color = ''; }
                          if ($badge_color) {$badge_color = 'color:'. $badge_color .';';} else { $badge_color = ''; }
                          echo '<span class="product-tag" style="'. $bg_color . $badge_color .'">'. get_post_meta( get_the_ID(), '_badge_texts', true ) .'</span>';
                        }
                        ?>
                        <img src="<?php echo $product_img; ?>" class="attachment-shop_catalog wp-post-image" alt="<?php echo the_title();?>">
                      </div>
                      <div class="jt-product-cnt">
                        <h3><?php echo the_title();?></h3>
                        <span class="price"><?php echo woocommerce_get_template( 'loop/price.php' ); ?></span>
                      </div>
                    </a>
                   <?php woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
                </div>
                  <?php }
                  endwhile;
                  wp_reset_postdata();
                  else :
                  get_template_part( 'content', 'none' );
                  endif;
           ?>
            </div>
    </li>
          <?php } else {

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

              if($show_category) {
                $show_category_slugs = str_replace(', ', ',', $show_category);
                $show_category_slugs = rtrim($show_category_slugs, ',');
                $show_category_slugs_id = explode(",", $show_category_slugs);
                $terms = $show_category_slugs_id;
              } else {
                $terms = get_terms('product_cat');
              }
              foreach ($terms as $term) {
                if($show_category) {
                  $term_name = $term;
                } else {
                  $term_name = $term->slug;
                }

              if($show_category) {
                $args = array(
                  'paged' => esc_attr($my_page),
                  'post_type'       => 'product',
                  'post_status'       => 'publish',
                  'ignore_sticky_posts' => 1,
                  'orderby'         => esc_attr($jt_products_order_by),
                  'order'         => esc_attr($jt_products_order),
                  'posts_per_page'    => (int)$jt_products_limit,
                  'offset' => (!(int)$port_offset ? "" : (int)$port_offset),
                  'tax_query'       => array(
                    array(
                      'taxonomy'    => 'product_cat',
                      'terms'     => esc_attr($term_name),
                      'field'     => 'slug',
                      'operator'    => 'IN'
                    )
                  )
                );
              } else {
                $args = array(
                  'paged' => esc_attr($my_page),
                  'post_type'       => 'product',
                  'post_status'       => 'publish',
                  'ignore_sticky_posts' => 1,
                  'offset'          => (!(int)$port_offset ? "" : (int)$port_offset),
                  'orderby'         => esc_attr($jt_products_order_by),
                  'order'         => esc_attr($jt_products_order),
                  'posts_per_page'    => (int)$jt_products_limit,
                );
              }
            }

              $wpbp = new WP_Query( $args );

                /* Normal jt_products */
                if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                  get_template_part( 'woocommerce/content', 'product' );
                endwhile;
                  wp_reset_postdata();
                else :
                  get_template_part( 'content', 'none' );
                endif;

                if ($enable_pagination) {
                  if ( function_exists('wp_pagenavi')) {
                    wp_pagenavi(array( 'query' => $wpbp ) );
                    wp_reset_postdata();  // avoid errors further down the page
                  }
                }

         }  ?>

    </ul>
  </div>

    <?php
    // Return outbut buffer
    return ob_get_clean();

  }
}
add_shortcode( 'jt_products', 'juster_woo_products' );

/* ==========================================================
  29.Shop Offers
=========================================================== */
if ( !function_exists('shop_offer_styles')) {
  function shop_offer_styles( $atts, $content = NUll ) {

    extract(shortcode_atts(array(
      'jt_offer_styles'  => '',
      'shop_offer_bg_image'  => '',
      'jt_offer_title'  => '',
      'jt_offer_sub_title'  => '',
      'jt_offer_image'  => '',
      'jt_offer_text'  => '',
      'jt_offer_link'  => '',
      'jt_offer_special_text'  => '',
      'jt_offer_special_link'  => '',
      'jt_button_one_text'  => '',
      'jt_button_one_link'  => '',
      'jt_button_two_text'  => '',
      'jt_button_two_link'  => '',
      'extra_class'  => '',
    ), $atts));
    if ($shop_offer_bg_image) {
      $image_url = wp_get_attachment_url( $shop_offer_bg_image );
      $shop_offer_bg_image = '<img src="'. esc_attr($image_url) .'" alt="">';
    } else {
      $shop_offer_bg_image = '<img src="'. IMAGES .'/dummy/370x260.jpg" alt="">';
    }

    if ($jt_offer_image) {
      $image_url = wp_get_attachment_url( $jt_offer_image );
      $jt_offer_image = '<img src="'. esc_attr($image_url) .'" alt="">';
    } else {
      $jt_offer_image ='';
    }

    // Output
    if($jt_offer_styles == 'style-1') {
        $output ='<div class="jt-offer-wrap '. esc_attr($extra_class) .'"><div class="jt-shop-offer">'. $shop_offer_bg_image .'</div>
                <div class="jt-shop-offer-cont jt-promo-one">
                    <p class="jt-offer-tit">'. esc_attr($jt_offer_title) .'<span>'. esc_attr($jt_offer_sub_title) .'</span></p>
                    <a href="'. esc_url($jt_offer_link) .'">
                        '. $jt_offer_image .'
                        <p class="jt-offer">'. esc_attr($jt_offer_text) .'</p>
                    </a>
                </div>
            </div>';
    } elseif($jt_offer_styles == 'style-2') {
        $output ='<div class="jt-offer-wrap '. esc_attr($extra_class) .'"><div class="jt-shop-offer">'. $shop_offer_bg_image .'</div>
                <div class="jt-shop-offer-cont jt-promo-two">
                    <div class="jt-shop-branch">
                        <a href="'. esc_url($jt_button_one_link) .'">'. esc_attr($jt_button_one_text) .'</a>
                    </div>
                    <div class="jt-shop-cat">
                        <a href="'. esc_url($jt_button_two_link) .'">
                            <span>'. esc_attr($jt_button_two_text) .'</span>
                            <i class="fa fa-angle-double-right "></i>
                        </a>
                    </div>
                </div>
            </div>';
    } else {
        $output ='<div class="jt-offer-wrap '. esc_attr($extra_class) .'"><div class="jt-shop-offer">'. $shop_offer_bg_image .'</div>
                  <div class="jt-shop-offer-cont jt-promo-three">
                      <p class="jt-offer-tit">'. esc_attr($jt_offer_title) .' <span>'. esc_attr($jt_offer_sub_title) .'</span></p>
                      <a href="'. esc_url($jt_offer_special_link) .'" class="jt-shop-cat">'. esc_attr($jt_offer_special_text) .'</a>
                      <a href="'. esc_url($jt_offer_link) .'" class="jt-offer-perc">'. esc_attr($jt_offer_text) .'</a>
                </div>
          </div>';
    }
    return $output;
  }
}
add_shortcode( 'jt_shop_offer', 'shop_offer_styles' );

/* ==========================================================
  30. Under Construction
=========================================================== */
if ( !function_exists('uc_construction_styles')) {
  function uc_construction_styles( $atts, $content = NUll ) {

    extract(shortcode_atts(array(
      'jt_uc_date'  => '',
      'jt_values_format'  => '',
      'jt_week_text'  => '',
      'jt_day_text'  => '',
      'jt_hour_text'  => '',
      'jt_minute_text'  => '',
      'jt_seconds_text'  => '',
      'extra_class'  => '',

      // Notification
      'jt_notify_heading'  => '',
      'jt_sub_content'  => '',
      'jt_btn_txt'  => '',
      'jt_link_type'  => '',
      'jt_btn_link'  => '',

      // Switchover Content
      'jt_switch_heading'  => '',
      'jt_switch_content'  => '',
      'jt_subscribe_shortcode'  => '',
      'jt_switch_link_txt'  => '',
    ), $atts));

    // Turn output buffer on
    ob_start();

    if ($jt_notify_heading) {
      $jt_notify_heading = '<h1 class="jt-main-head">'. $jt_notify_heading .'</h1>';
    } else {
      $jt_notify_heading = '';
    }
    if ($jt_sub_content) {
      $jt_sub_content = '<h4 class="sub-heading">'. $jt_sub_content .'</h4>';
    } else {
      $jt_sub_content = '';
    }
    if ($jt_btn_txt) {
      if ($jt_link_type == "direct_link") {
        $jt_btn_txt = '<a href="'. $jt_btn_link .'" class="btn-primary btn-black btn-large bg-empty">'. $jt_btn_txt .'</a>';
      } else {
        $jt_btn_txt = '<a href="#0" class="btn-primary btn-black btn-large bg-empty uc-btn">'. $jt_btn_txt .'</a>';
      }
    }

    // Switchover Content
    if ($jt_switch_heading) {
      $jt_switch_heading = '<h1 class="jt-main-head">'. $jt_switch_heading .'</h1>';
    } else {
      $jt_switch_heading = '';
    }
    if ($jt_switch_content) {
      $jt_switch_content = '<h4 class="sub-heading">'. $jt_switch_content .'</h4>';
    } else {
      $jt_switch_content = '';
    }
    if ($jt_switch_link_txt) {
      $jt_switch_link_txt = '<a href="#0" class="uc-subs-btn" target="_blank"><img src="'. IMAGES .'/arrows/box-arrow-left.png" alt="">'. $jt_switch_link_txt .'</a>';
    } else {$jt_switch_link_txt = '';}
    if ($jt_subscribe_shortcode == 'yes') {
      $jt_subscribe_shortcode = '[mc4wp_form]';
    } else { $jt_subscribe_shortcode = ''; }
    if ($jt_values_format) {
      $jt_values_format = $jt_values_format;
    } else {
      $jt_values_format = 'jt-week-day-hour';
    }
  ?>

  <div class="container text-center <?php echo $extra_class; ?> uc-vc-class">

    <div class="jt-uc-content-section">

      <div class="notify-section">
        <div class="jt-heading">
          <?php echo $jt_notify_heading; echo $jt_sub_content; ?>
        </div>
        <?php echo $jt_btn_txt; ?>
      </div>

      <div class="subscribe-section">
        <div class="jt-heading">
          <?php echo $jt_switch_heading; echo $jt_switch_content; ?>
        </div>
        <?php echo do_shortcode($jt_subscribe_shortcode); echo $jt_switch_link_txt; ?>
      </div>

    </div>

    <div class="uc-counter-wrap <?php echo $jt_values_format; ?>">
      <div class="uc-counter animate-plus" data-animations="fadeIn"
          data-animation-delay="1800ms"
          data-animation-when-visible="true"
          data-animation-reset-offscreen="true"></div>
      <script type="text/javascript">
        jQuery(document).ready(function($){

          $('.uc-counter').dsCountDown({
          endDate: new Date("<?php echo $jt_uc_date; ?>"),
          <?php if($jt_week_text) { ?>
          titleWeeks: '<?php echo esc_js($jt_week_text); ?>',
          <?php } if($jt_day_text) { ?>
          titleDays: '<?php echo esc_js($jt_day_text); ?>',
          <?php } if($jt_hour_text) { ?>
          titleHours: '<?php echo esc_js($jt_hour_text); ?>',
          <?php } if($jt_minute_text) { ?>
          titleMinutes: '<?php echo esc_js($jt_minute_text); ?>',
          <?php } if($jt_seconds_text) { ?>
          titleSeconds: '<?php echo esc_js($jt_seconds_text); ?>',
          <?php } ?>
          });

          $( ".jt-week-day-hour .ds-element-seconds, .jt-week-day-hour .ds-element-minutes" ).remove();
          $( ".jt-day-hour-minute .ds-element-weeks, .jt-day-hour-minute .ds-element-seconds" ).remove();
          $( ".jt-hour-minute-sec .ds-element-weeks, .jt-hour-minute-sec .ds-element-days" ).remove();

          $(".uc-btn").on('click', function() {
              $(this).parents(".jt-uc-content-section").addClass('jt-notify-deactive');
              $(this).parents(".jt-uc-content-section").removeClass('jt-notify-active');
              return false;
          });
          $(".uc-subs-btn").on('click', function() {
              $(this).parents(".jt-uc-content-section").addClass('jt-notify-active');
              $(this).parents(".jt-uc-content-section").removeClass('jt-notify-deactive');
              return false;
          });

        });
      </script>
      <img src="<?php echo IMAGES; ?>/page_template/uc-person-one.png" class="uc-person-one animate-plus" alt=""
          data-animations="fadeInUp"
          data-animation-delay="1000ms"
          data-animation-when-visible="true"
          data-animation-reset-offscreen="true">
      <img src="<?php echo IMAGES; ?>/page_template/uc-person-two.png" class="uc-person-two animate-plus" alt=""
          data-animations="fadeInUp"
          data-animation-delay="1100ms"
          data-animation-when-visible="true"
          data-animation-reset-offscreen="true">
      <img src="<?php echo IMAGES; ?>/page_template/uc-person-three.png" class="uc-person-three animate-plus" alt=""
          data-animations="fadeInUp"
          data-animation-delay="1200ms"
          data-animation-when-visible="true"
          data-animation-reset-offscreen="true">
    </div> <!-- uc-counter-wrap -->

  </div> <!-- Container -->

  <?php
    // Coundown Script
    wp_enqueue_script('coundown-scripts', SCRIPTS . '/dscountdown.min.js', array('jquery'), '', true);

    // Return outbut buffer
    return ob_get_clean();

  }
}
add_shortcode( 'jt_underconstruction', 'uc_construction_styles' );

/* ==========================================================
  31. Gmap From 2
=========================================================== */
if ( !function_exists('jstr_gmap_function')) {
  function jstr_gmap_function( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'gmap_api'  => '',
      'gmap_type'  => '',
      'gmap_style'  => '',
      'gmap_height'  => '',
      'gmap_common_marker'  => '',
      'gmap_zoom'  => '',
      'gmap_scroll_wheel'  => '',
      'gmap_street_view'  => '',
      'gmap_maptype_control'  => '',
      'class'  => '',
      'locations'  => '',
      'css'  => '',
    ), $atts));

    // Design Tab
    $custom_css = ( function_exists( 'vc_shortcode_custom_css_class' ) ) ? vc_shortcode_custom_css_class( $css, ' ' ) : '';

    // Atts
    $class = $class ? ' '. $class : '';
    $gmap_api = $gmap_api ? '?key='. $gmap_api : '';
    $gmap_type = $gmap_type ? $gmap_type : 'ROADMAP';
    $gmap_scroll_wheel = $gmap_scroll_wheel ? 'true' : 'false';
    $gmap_street_view = $gmap_street_view ? 'true' : 'false';
    $gmap_maptype_control = $gmap_maptype_control ? 'true' : 'false';
    if ($gmap_style === 'mid-night') {
      $gmap_style_actual = "[{featureType:'water',stylers:[{color:'#021019'}]},{featureType:'landscape',stylers:[{color:'#08304b'}]},{featureType:'poi',elementType:'geometry',stylers:[{color:'#0c4152'},{lightness:5}]},{featureType:'road.highway',elementType:'geometry.fill',stylers:[{color:'#000000'}]},{featureType:'road.highway',elementType:'geometry.stroke',stylers:[{color:'#0b434f'},{lightness:25}]},{featureType:'road.arterial',elementType:'geometry.fill',stylers:[{color:'#000000'}]},{featureType:'road.arterial',elementType:'geometry.stroke',stylers:[{color:'#0b3d51'},{lightness:16}]},{featureType:'road.local',elementType:'geometry',stylers:[{color:'#000000'}]},{elementType:'labels.text.fill',stylers:[{color:'#ffffff'}]},{elementType:'labels.text.stroke',stylers:[{color:'#000000'},{lightness:13}]},{featureType:'transit',stylers:[{color:'#146474'}]},{featureType:'administrative',elementType:'geometry.fill',stylers:[{color:'#000000'}]},{featureType:'administrative',elementType:'geometry.stroke',stylers:[{color:'#144b53'},{lightness:14},{weight:1.4}]}]";
    } elseif ($gmap_style === 'blue-water') {
      $gmap_style_actual = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]';
    } elseif ($gmap_style === 'light-dream') {
      $gmap_style_actual = '[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]';
    } elseif ($gmap_style === 'pale-dawn') {
      $gmap_style_actual = '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2e5d4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]}]';
    } elseif ($gmap_style === 'apple-maps') {
      $gmap_style_actual = '[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]';
    } elseif ($gmap_style === 'blue-essence') {
      $gmap_style_actual = '[{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}]';
    } elseif ($gmap_style === 'unsaturated-browns') {
      $gmap_style_actual = '[{"elementType":"geometry","stylers":[{"hue":"#ff4400"},{"saturation":-68},{"lightness":-4},{"gamma":0.72}]},{"featureType":"road","elementType":"labels.icon"},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"hue":"#0077ff"},{"gamma":3.1}]},{"featureType":"water","stylers":[{"hue":"#00ccff"},{"gamma":0.44},{"saturation":-33}]},{"featureType":"poi.park","stylers":[{"hue":"#44ff00"},{"saturation":-23}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"hue":"#007fff"},{"gamma":0.77},{"saturation":65},{"lightness":99}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"gamma":0.11},{"weight":5.6},{"saturation":99},{"hue":"#0091ff"},{"lightness":-86}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"lightness":-48},{"hue":"#ff5e00"},{"gamma":1.2},{"saturation":-23}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"saturation":-64},{"hue":"#ff9100"},{"lightness":16},{"gamma":0.47},{"weight":2.7}]}]';
    } elseif ($gmap_style === 'paper') {
      $gmap_style_actual = '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"off"},{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]}]';
    } elseif ($gmap_style === 'midnight-commander') {
      $gmap_style_actual = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#146474"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#021019"}]}]';
    } elseif ($gmap_style === 'light-monochrome') {
      $gmap_style_actual = '[{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]}]';
    } elseif ($gmap_style === 'flat-map') {
      $gmap_style_actual = '[{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#f3f4f4"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"weight":0.9},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#83cead"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"},{"color":"#fee379"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#7fc8ed"}]}]';
    } elseif ($gmap_style === 'retro') {
      $gmap_style_actual = '[{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-17},{"gamma":0.36}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#3f518c"}]}]';
    } elseif ($gmap_style === 'becomeadinosaur') {
      $gmap_style_actual = '[{"elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#f5f5f2"},{"visibility":"on"}]},{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#ffffff"},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"visibility":"simplified"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"color":"#ffffff"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#71c8d4"}]},{"featureType":"landscape","stylers":[{"color":"#e5e8e7"}]},{"featureType":"poi.park","stylers":[{"color":"#8ba129"}]},{"featureType":"road","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.sports_complex","elementType":"geometry","stylers":[{"color":"#c7c7c7"},{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#a0d3d3"}]},{"featureType":"poi.park","stylers":[{"color":"#91b65d"}]},{"featureType":"poi.park","stylers":[{"gamma":1.51}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.government","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","stylers":[{"visibility":"simplified"}]},{"featureType":"road"},{"featureType":"road"},{},{"featureType":"road.highway"}]';
    } elseif ($gmap_style === 'neutral-blue') {
      $gmap_style_actual = '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#29768a"},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]}]';
    } elseif ($gmap_style === 'subtle-grayscale') {
      $gmap_style_actual = '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]';
    } elseif ($gmap_style === 'ultra-light-labels') {
      $gmap_style_actual = '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]';
    } elseif ($gmap_style === 'shades-grey') {
      $gmap_style_actual = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]';
    } elseif ($gmap_style === 'gray-scale') {
      $gmap_style_actual = "[{featureType:'all',elementType:'all',stylers:[{saturation: -100}]}]";
    } else {
      $gmap_style_actual = "[]";
    }
    if ($gmap_common_marker) {
      $common_marker = wp_get_attachment_url( $gmap_common_marker );
      $common_marker = $common_marker;
    } else {
      $common_marker = IMAGES . '/icons/map/map-marker-1.png';
    }
    // Zoom
    $gmap_zoom = $gmap_zoom ? $gmap_zoom : '18';

    // Group Field
    $locations = (array) vc_param_group_parse_atts( $locations );
    $get_locations = array();
    foreach ( $locations as $location ) {
      $location = $location;
      $location['latitude'] = isset( $location['latitude'] ) ? $location['latitude'] : '';
      $location['longitude'] = isset( $location['longitude'] ) ? $location['longitude'] : '';
      $location['custom_marker'] = isset( $location['custom_marker'] ) ? $location['custom_marker'] : '';
      $location['location_text'] = isset( $location['location_text'] ) ? $location['location_text'] : '';
      $location['location_heading'] = isset( $location['location_heading'] ) ? $location['location_heading'] : '';
      $get_locations[] = $location;
    }

    // Shortcode Style CSS
    $e_uniqid        = uniqid();

    wp_enqueue_script( 'redel-googlemap', SCRIPTS . '/jquery.googlemap.js', array( 'jquery' ), '1.5.0', true );
    wp_enqueue_script( 'redel-map-api', '//maps.googleapis.com/maps/api/js'. $gmap_api .'', array( 'jquery' ), '', true );

    // Turn output buffer on
    ob_start();

    echo '<div id="map-'. $e_uniqid .'" class="jstr-google-map '. $custom_css . $class .'" style="height: '. $gmap_height .';"></div>';
?>
    <script type="text/javascript">
    // Custom Map Script
    jQuery(document).ready(function($) {
      $("#<?php echo esc_js('map-'. $e_uniqid); ?>").googleMap({
        zoom: <?php echo esc_js($gmap_zoom); ?>,
        type: "<?php echo esc_js($gmap_type); ?>",
        styles: <?php echo $gmap_style_actual; ?>,
        streetViewControl: <?php echo esc_js($gmap_street_view); ?>,
        scrollwheel: <?php echo esc_js($gmap_scroll_wheel); ?>,
        mapTypeControl: <?php echo esc_js($gmap_maptype_control); ?>,
        <?php
        $first = true;
        foreach ( $locations as $location ) {
          if ( $first ) {
            $first = false;
            $latitude = $location['latitude'];
            $longitude = $location['longitude'];
            ?>
            coords: [<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>],
            <?php
          } else {
          }
        }
        ?>
      });
      <?php foreach ( $locations as $location ) {
        $latitude = $location['latitude'];
        $longitude = $location['longitude'];
        $marker_url = isset( $location['custom_marker'] ) ? wp_get_attachment_url( $location['custom_marker'] ) : '';
        $marker = isset( $location['custom_marker'] ) ? $marker_url : $common_marker;
        $heading = $location['location_heading'] ? 'title: "'. $location['location_heading'] .'"' : '';
        $text = $location['location_text'] ? 'text: "'. $location['location_text'] .'"' : '';
      ?>
      $("#<?php echo esc_js('map-'. $e_uniqid); ?>").addMarker({
        coords: [<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>],
        icon: '<?php echo esc_url($marker); ?>',
        <?php echo $heading; ?>,
        <?php echo $text; ?>,
      });
      <?php } ?>
    });
    </script>
<?php
    // Return outbut buffer
    return ob_get_clean();

  }
}
add_shortcode( 'jstr_gmap', 'jstr_gmap_function' );

/* ==========================================================
  32. Clients Slider 2
=========================================================== */
if ( !function_exists('juster_clients_latest')) {
  function juster_clients_latest( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'clients_style'  => '',
      'client_columns'  => '',
      'clients_slider'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-client-carousel-boxed';
    } else {
      $page_model_class = 'jt-client-carousel-wide';
    }

    // Turn output buffer on
    ob_start();

    $clients_slider = (array) vc_param_group_parse_atts( $clients_slider );

    if($clients_style == 'style-1') { ?>
       <div class="jt-client-carousel <?php echo $page_model_class; ?> <?php echo esc_attr($class); ?>">
             <?php
             if ($clients_slider) {
              foreach($clients_slider as $clients) {
                $client_image = wp_get_attachment_url( $clients['client_image'] );
                  echo '<a href="'. esc_url($clients['client_link']) .'" class="jt-client-logo"><img src="'. $client_image .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a>';
                }
              }
            ?>
       </div>
  <?php } elseif($clients_style == 'style-2') { ?>
        <div class="jt-client-static <?php echo $page_model_class; ?> <?php echo esc_attr($class); ?>">
            <?php
               if ($clients_slider) {
              foreach($clients_slider as $clients) {
                $client_image = wp_get_attachment_url( $clients['client_image'] );
                  echo '<a href="'. esc_url($clients['client_link']) .'" class="jt-client-logo"><img src="'. $client_image .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a>';
                }
              }
            ?>
        </div>
 <?php } elseif($clients_style == 'style-3') {
               if ($clients_slider) {
              foreach($clients_slider as $clients) {
                $client_image = wp_get_attachment_url( $clients['client_image'] );
                  echo '<div class="'. $page_model_class .' '. $client_columns .' '. esc_attr($class) .'"><div class="jt-vint-clients"><a href="'. esc_url($clients['client_link']) .'"><img src="'. $client_image .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a> </div></div>';
                }
              }

 } else {
          if ($clients_slider) {
            foreach($clients_slider as $clients) {
              $client_image = wp_get_attachment_url( $clients['client_image'] );
                echo '<div class="'. $page_model_class .' '. $client_columns .' '. esc_attr($class) .'"><div class="jt-normal-clients"><a href="'. esc_url($clients['client_link']) .'"><img src="'. $client_image .'" alt="'. esc_attr($clients['title']) .'" style="top:'. esc_attr($clients['client_img_top_value']) .'"></a> </div></div>';
            }
          }
 }

  // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_clients_latest', 'juster_clients_latest' );

/* ==========================================================
   33. Timeline 2
=========================================================== */
if ( !function_exists('juster_timeline_latest')) {
  function juster_timeline_latest( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'timeline_year'  => '',
      'timeline_style' => '',
      'title_color'  => '',
      'content_color'  => '',
      'year_color'  => '',
      'date_color'  => '',
      'title_size'  => '',
      'content_size'  => '',
      'year_text_size'  => '',
      'date_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    $timeline_style = (array) vc_param_group_parse_atts( $timeline_style );

    // Color
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $date_color ) {
      $date_color = 'color:'. $date_color .';';
    } else {
      $date_color ='';
    }
    if ( $year_color ) {
      $year_color = 'color:'. $year_color .';';
    } else {
      $year_color ='';
    }
    // Sizes
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }
    if ($date_size) {
      $date_size = 'font-size:'. esc_attr($date_size) .';';
    } else {
      $date_size ='';
    }
    if ($year_text_size) {
      $year_text_size = 'font-size:'. esc_attr($year_text_size) .';';
    } else {
      $year_text_size ='';
    }

    if ($page_model == 'full_width') {
      $page_model_class = 'jt-timeline-box';
    } else {
      $page_model_class = 'jt-timeline-wide';
    }

    // Turn output buffer on
    ob_start();
    ?>
    <div class="jt-timeline-wrapper <?php echo esc_attr($class); ?> <?php echo $page_model_class; ?>">

        <div class="jt-center-line"></div>
          <div class="jt-year-start" style="<?php echo $year_color;  ?><?php echo $year_text_size;  ?>"><?php echo esc_attr($timeline_year);  ?></div>
            <div class="jt-tym-content">
                <?php
                  if ($timeline_style) {
                  foreach($timeline_style as $time_line) {
                        echo '<div><div class="jt-round-connect"></div>
                            <div class="jt-box-header"><div class="jt-time-date" style="'. $date_color . $date_size . '">'. $time_line['timeline_date'] .'</div><div class="jt-time-title" style="'. $title_color . $title_size . '">'. esc_attr($time_line['title']) .'</div></div><div class="jt-time-content jt-popup-image" style="'. $content_color . $content_size . '">'. $time_line['timeline_content'] .'</div></div>';
                    }
                  } else { echo '';}
               ?>
            </div>
          <div class="jt-year-end"><img src="<?php echo IMAGES ?>/icons/time-icon-plus.png" alt="Endyear">
         </div>
    </div>
  <?php
    // Return outbut buffer
    return ob_get_clean();
    }
}
add_shortcode( 'jt_timeline_latest', 'juster_timeline_latest' );

/* ==========================================================
  34. Carousal Slider 2
=========================================================== */
if ( !function_exists('juster_carousal_latest')) {
  function juster_carousal_latest( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'carousal_slider' =>'',
      'special_text_color'  => '',
      'heading_color'  => '',
      'content_color'  => '',
      'special_text_size'  => '',
      'heading_size'  => '',
      'content_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-cnt-carousel-wrapper-boxed';
    } else {
      $page_model_class = 'jt-cnt-carousel-wrapper-extrawidth';
    }

    // Color
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $content_color ) {
      $content_color = 'color:'. $content_color .';';
    } else {
      $content_color ='';
    }
    if ( $special_text_color ) {
      $special_text_color = 'color:'. $special_text_color .';';
    } else {
      $special_text_color ='';
    }

    // Sizes
    if ($special_text_size) {
      $special_text_size = 'font-size:'. esc_attr($special_text_size) .';';
    } else {
      $special_text_size ='';
    }
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }

     // Turn output buffer on
    ob_start();

    $carousal_slider = (array) vc_param_group_parse_atts( $carousal_slider );
    // $carousal_slider = ot_get_option('carousal_slider');
    ?>

                <div class="jt-cnt-carousel-wrapper <?php echo $page_model_class; ?> <?php echo esc_attr($class); ?>">

                    <!-- Each Carousel -->
                    <?php
                       if ($carousal_slider) {
                        foreach($carousal_slider as $carousal) {
                            echo '<div class="jt-each-carousel"><span class="jt-special-txt" style="'. $special_text_color . $special_text_size . '">'. esc_attr($carousal['special_text']) .'</span><h3 class="jt-carousel-heading" style="'. $heading_color . $heading_size . '">'. esc_attr($carousal['carousal_heading']) .'</h3><p style="'. $content_color . $content_size . '">'. esc_attr($carousal['carousal_content']) .'</p></div>';
                          }
                        }
                      ?>
                    <!-- Each Carousel -->
                </div>

 <?php
  // Return outbut buffer
    return ob_get_clean();
  }
}
add_shortcode( 'jt_carousal_latest', 'juster_carousal_latest' );

/* ==========================================================
   35. Featured Slide 2
=========================================================== */
if ( !function_exists('juster_featured_slide_latest')) {
  function juster_featured_slide_latest( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'small_title'  => '',
      'heading'  => '',
      'bg_image'  => '',
      'need_overlay'  => '',
      'small_title_color'  => '',
      'heading_color'  => '',
      'title_color' => '',
      'small_title_size'  => '',
      'heading_size'  => '',
      'title_size'  => '',
      'featured_slider' => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );
    if ($page_model == 'full_width') {
      $page_model_class = 'jt-fetures-tabs-wrapper-boxed';
    } else {
      $page_model_class = 'jt-fetures-tabs-wrapper-extrawidth';
    }

    // Color
    if ( $small_title_color ) {
      $small_title_color = 'color:'. $small_title_color .';';
    } else {
      $small_title_color ='';
    }
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }

    // Sizes
    if ($small_title_size) {
      $small_title_size = 'font-size:'. esc_attr($small_title_size) .';';
    } else {
      $small_title_size ='';
    }
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }

    if ($bg_image) {
      $image_url = wp_get_attachment_url( $bg_image );
      $bg_image = 'style="background-image:url('. $image_url .');"';
    } else {
      $bg_image ='';
    }

    $featured_slider = (array) vc_param_group_parse_atts( $featured_slider );

    wp_enqueue_style( 'swiper-css', THEMEROOT . '/css/swiper.min.css' );
    wp_register_script( 'jquery.responsiveTabs.min', SCRIPTS . '/jquery.responsiveTabs.min.js', array( 'jquery' ), false, true );
    wp_register_script( 'swiper', SCRIPTS . '/swiper.jquery.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'jquery.responsiveTabs.min' );
    wp_enqueue_script( 'swiper' );

    // Turn output buffer on
    ob_start();
?>
  <div class="jt-fetures-tabs-wrapper <?php echo $page_model_class;  ?> <?php echo esc_attr($class);  ?>">
          <div class="col-lg-6 padding-zero">
                <div class="swiper-container">
                  <div class="swiper-wrapper">
                     <?php
                      if ($featured_slider) {
                         foreach($featured_slider as $slider) {
                          $center_image = wp_get_attachment_url( $slider['center_image'] );
                          echo '<div class="jt-tabs-main-content swiper-slide">
                            <div class="jt-main-cnt-div">
                                <h2 style="'. $title_color . $title_size .'">'. esc_attr($slider['title']) .'</h2>
                                <div class="jt-sep-two"></div>
                                <div class="tabs-cat">
                                    '. $slider['featured_category'] .'
                                </div>
                                '. $slider['featured_content'] .'
                            </div>
                            <div class="jt-tabs-image">
                                <img src="'. $center_image .'" alt="'. esc_attr($slider['title']) .'">
                            </div>
                        </div>';
                        }
                      }
                    ?>
                    </div>
                    <div class="jt-tabs-nav">
                        <a href="#0" class="jt-tab-prev"><i class="fa fa-long-arrow-left"></i></a>
                        <a href="#0" class="jt-tab-next"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-6 padding-zero jt-right-box">
                  <div class="jt-tabs-right-area" <?php echo $bg_image;  ?>>
                      <?php if($need_overlay) { ?>
                          <div class="jt-box-overlay"></div>
                      <?php } ?>
                      <div class="jt-tabs-feature-box">
                          <h5 class="jt-small-title" style="<?php echo $small_title_color;  ?><?php echo $small_title_size;  ?>"><?php echo esc_attr($small_title); ?></h5>
                          <div class="jt-heading">
                              <h2 class="jt-large-heading" style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($heading); ?></h2>
                              <div class="jt-sep"></div>
                          </div>
                          <div class="jt-tabs-num"></div>
                      </div>
                  </div>
              </div>
        </div>
 <?php
    // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_featured_slide_latest', 'juster_featured_slide_latest' );

/* ==========================================================
  36. Featured Tabs
=========================================================== */
if ( !function_exists('juster_features_tabs_latest')) {
  function juster_features_tabs_latest( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'heading'  => '',
      'tab_image'  => '',
      'need_hover'  => '',
      'jt_features_tabs' => '',
      'heading_color'  => '',
      'title_color' => '',
      'icon_color'  => '',
      'short_content_color'  => '',
      'long_content_color'  => '',
      'button_text_color'  => '',
      'button_border_color'  => '',
      'heading_size'  => '',
      'title_size'  => '',
      'icon_size'  => '',
      'short_content_size'  => '',
      'long_content_size'  => '',
      'button_text_size'  => '',
      'class'  => ''
    ), $atts));

    $page_model = get_post_meta( get_the_ID(), 'page_model', true );

    if ($need_hover === 'yes') {
      wp_register_script( 'tiltfx-js', SCRIPTS . '/tiltfx.js', array( 'jquery' ), false, true );
      wp_enqueue_script( 'tiltfx-js' );
    }

    // Color
    if ( $heading_color ) {
      $heading_color = 'color:'. $heading_color .';';
    } else {
      $heading_color ='';
    }
    if ( $title_color ) {
      $title_color = 'color:'. $title_color .';';
    } else {
      $title_color ='';
    }
    if ( $icon_color ) {
      $icon_color = 'color:'. $icon_color .';';
    } else {
      $icon_color ='';
    }
    if ( $short_content_color ) {
      $short_content_color = 'color:'. $short_content_color .';';
    } else {
      $short_content_color ='';
    }
    if ( $long_content_color ) {
      $long_content_color = 'color:'. $long_content_color .';';
    } else {
      $long_content_color ='';
    }
    if ( $button_text_color ) {
      $button_text_color = 'color:'. $button_text_color .';';
    } else {
      $button_text_color ='';
    }
    if ( $button_border_color ) {
      $button_border_color = 'border-color:'. $button_border_color .';';
    } else {
      $button_border_color = '';
    }

    // Sizes
    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
    } else {
      $title_size ='';
    }
    if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
    } else {
      $icon_size ='';
    }
    if ($short_content_size) {
      $short_content_size = 'font-size:'. esc_attr($short_content_size) .';';
    } else {
      $short_content_size ='';
    }
    if ($long_content_size) {
      $long_content_size = 'font-size:'. esc_attr($long_content_size) .';';
    } else {
      $long_content_size = '';
    }
    if ($button_text_size) {
      $button_text_size = 'font-size:'. esc_attr($button_text_size) .';';
    } else {
      $button_text_size ='';
    }

    if ($tab_image) {
      $image_url = wp_get_attachment_url( $tab_image );
      $tab_image = '<img src="'. esc_attr($image_url) .'" class="tilt-effect" alt="" />';
    } else {
      $tab_image = '<img src="'. IMAGES .'/dummy/960x700.jpg" class="tilt-effect" alt="" />';
    }

    if ($page_model == 'full_width') {
      $page_model_class = 'jt-featured-box';
    } else {
      $page_model_class = 'jt-featured-wide';
    }

    $jt_features_tabs = (array) vc_param_group_parse_atts( $jt_features_tabs );

    // Turn output buffer on
    ob_start();
?>
      <!-- What We Do -->
        <div class="jt-wwd-tabs <?php echo esc_attr($class); ?> <?php echo $page_model_class; ?>">

            <div class="col-lg-6 padding-zero">
                <!-- jt-wwd-image-bg -->
                <div class="jt-wwd-image-bg">
                    <div class="jt-tilt-effect">
                        <div class="jt-wwd-img">
                            <?php echo $tab_image; ?>
                        </div>
                    </div>
                    <?php
                        if ($jt_features_tabs) {
                          $i=1;
                          foreach($jt_features_tabs as $jt_tabs) {
                            echo '<div id="jt-wwd-'.$i.'" class="wwd-tab-box"><div class="wwd-tab-icon"><i class="'. esc_attr($jt_tabs['features_tab_icon']) .'" style="'. $icon_color . $icon_size .'"></i></div><h3 style="'. $title_color . $title_size .'">'. esc_attr($jt_tabs['title']) .'</h3><p style="'. $long_content_color . $long_content_size .'">'. $jt_tabs['long_tab_content'] .'</p><a href="'. $jt_tabs['tabs_button_link'] .'" class="btn-primary learn-more" style="'. $button_text_color . $button_text_size . $button_border_color .'">'. esc_attr($jt_tabs['tabs_button_text']) .'</a></div>';
                            $i++;
                          }
                        }
                    ?>
                </div>
                <!-- jt-wwd-image-bg -->
            </div>
            <div class="col-lg-6 padding-zero">
                <div class="jt-wwd-tab-links">
                    <div class="jt-wwd-headings">
                        <h2 class="jt-large-heading" style="<?php echo $heading_color;  ?><?php echo $heading_size;  ?>"><?php echo esc_attr($heading); ?></h2>
                        <div class="jt-sep-two"></div>
                    </div>
                    <?php
                      if ($jt_features_tabs) {
                         $i=1;
                         foreach($jt_features_tabs as $jt_tabs1) {
                            echo '<a href="#jt-wwd-'.$i.'" class="tab-each-link"><i class="'. esc_attr($jt_tabs1['features_tab_icon']) .'" style="'. $icon_color . $icon_size .'"></i><h4 style="'. $title_color . $title_size .'">'. esc_attr($jt_tabs1['title']) .'</h4><p style="'. $short_content_color . $short_content_size .'">'. esc_attr($jt_tabs1['short_tab_content']) .'</p><span class="close-icon"></span></a>';
                             $i++;
                         }
                      }
                  ?>
                </div>
            </div>
        </div>
        <!-- What We Do -->
    <?php
    // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_features_tabs_latest', 'juster_features_tabs_latest' );

/* ==========================================================
  37. Icon Tabs
=========================================================== */
if ( !function_exists('juster_icon_tabs_latest')) {
  function juster_icon_tabs_latest( $atts, $content = NULL ) {

    extract(shortcode_atts(array(
      'image_tabs' => '',
      'class'  => ''
    ), $atts));

    $image_tabs = (array) vc_param_group_parse_atts( $image_tabs );

    wp_enqueue_style( 'jquery-pwstabs-min', THEMEROOT . '/css/jquery.pwstabs.min.css' );
    wp_register_script( 'pwstabs-js', SCRIPTS . '/jquery.pwstabs.min.js', array('jquery'), '', true);
    wp_enqueue_script( 'pwstabs-js' );

    // Turn output buffer on
    ob_start();
    ?>
    <div class="jt-tab-image-wrapper jt-studio-service-right <?php echo esc_attr($class); ?>">
        <div class="jt-tab-image">
            <?php
            if ($image_tabs) {
            foreach($image_tabs as $images) {
                if($images['icon_details'] =='icon' && $images['tab_icon_content'] != '' && $images['tab_icon_button_link'] !='' && $images['tab_icon_button_text'] !=''){
                  $icon_details='<div class="jt-heading jt-studio-heading">
                                <h2>'. esc_attr($images['title']) .'</h2>
                                <div class="jt-sep"></div>
                            </div>
                            <div class="jt-studio-serv-cont">
                                <p>'. $images['tab_icon_content'] .'</p>
                                <a href="'. esc_url($images['tab_icon_button_link']) .'">'. esc_attr($images['tab_icon_button_text']) .'</a>
                            </div>';
                } else {
                  $icon_details='<img src="'. wp_get_attachment_url( $images['tab_image'] ) .'" alt="'. esc_attr($images['title']) .'">';
                }
                echo '<div data-pws-tab="'. esc_attr($images['title']) .'" data-pws-tab-name="'. esc_attr($images['title']) .'" data-pws-tab-icon="'. esc_attr($images['tab_icon']) .'">'. $icon_details .'</div>';
                  }
              }
            ?>
            </div><!-- jt-tab-image -->
    </div><!-- jt-tab-image-wrapper -->
    <?php
    // Return outbut buffer
    return ob_get_clean();
   }
}
add_shortcode( 'jt_icon_tabs_latest', 'juster_icon_tabs_latest' );
