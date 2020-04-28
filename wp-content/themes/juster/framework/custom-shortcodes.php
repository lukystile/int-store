<?php
/**
 * 1. Highlight
 * 2. Dropcaps
 * 3. Tooltip
 * 4. Spacer
 * 5. Lists
 * 6. Special Heading
 * 7. Special text
 * 8. Blockquote
 * 9. Social Icons
 * 10. H4
 * 11. Address
 * 12. Social Share
 * 13. Steps
 * 14. Custom Button
 * 15. Special Content Block
 * 16. Intro Text
 * 17. Portfolio Meta Custom Shortcode
 * 18. About List
 * 19. Contact Details
 * 20. Agency Header | Typing Text
 * 21. Separator
 * 22. Subscribe
 * 23. Language
 * 24. Text Icon
 * 25. Dropdown Language
 * 26. Footer Content
 * 27. Back Text
 * 28. Link Text
 * 29. Social Count
 * 30. Product Carousel
 * 31. Single Image
 */
/* ==============================================
   Custom Simple Shortcodes
=============================================== */
/* Highlight */
function highlight_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "style"=> '',
      "text_color" => '',
      "bg_color" => '',
      "text_size" => '',
      "class" => ''
   ), $atts));

   if ($style === 'style-one') {
      if ($bg_color) {
         $bg_color = 'background:'. esc_attr($bg_color) .';';
      } else {
         $bg_color ='';
      }
   }
   if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }
   if ($text_color) {
      $text_color = 'color:'. esc_attr($text_color) .';';
   } else {
      $text_color ='';
   }

   if ($style === 'style-one') {
      $result = '<span class="highlight '. esc_attr($class) .'" style="'. $bg_color . $text_size . $text_color .'">'. esc_attr($text) .'</span>';
   } elseif ($style === 'style-two') {
      $result = '<span class="highlight-underline '. esc_attr($class) .'" style="'. $text_size . $text_color .'">'. esc_attr($text) .'</span>';
   } elseif ($style === 'style-three') {
      $result = '<span class="highlight-bold '. esc_attr($class) .'" style="'. $text_size . $text_color .'">'. esc_attr($text) .'</span>';
   } elseif ($style === 'style-four') {
      $result = '<span class="highlight-italic '. esc_attr($class) .'" style="'. $text_size . $text_color .'">'. esc_attr($text) .'</span>';
   } else {
      $result = '<span class="highlight-bold '. esc_attr($class) .'" style="'. $text_size . $text_color .'">'. esc_attr($text) .'</span>';
   }
   return $result;

}
add_shortcode("jt_highlight", "highlight_function");

/* Dropcaps */
function dropcaps_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "style" => '',
      "bg_color" => '',
      "border_color" => '',
      "border_bottom_color" => '',
      "text_color" => '',
      "text_size" => '',
      "class" => ''
   ), $atts));

   if ($style === 'style-one') {
       if ($bg_color) {
          $bg_color = 'background:'. esc_attr($bg_color) .';';
       }
   }
   if ($border_color) {
      $border_color = 'border-color:'. esc_attr($border_color) .';';
   } else {
      $border_color ='';
   }
   if ($style === 'style-three') {
     if ($border_bottom_color) {
        $border_bottom_color = 'border-bottom-color:'. esc_attr($border_bottom_color) .';';
     } else {
        $border_bottom_color ='';
     }
   }
   if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }
   if ($text_color) {
      $text_color = 'color:'. esc_attr($text_color) .';';
   } else {
      $text_color ='';
   }

   if ($style === 'style-one') {
      $output = '<span class="dropcaps dc-style-1 '. esc_attr($class) .'" style="'. $bg_color . $text_color . $text_size . $border_color .'">'. esc_attr($text) .'</span>';
   } elseif ($style === 'style-two') {
      $output = '<span class="dropcaps dc-style-2 '. esc_attr($class) .'" style="'. $text_color . $text_size . $border_color .'">'. esc_attr($text) .'</span>';
   } elseif ($style === 'style-three') {
      $output = '<span class="dropcaps dc-style-3 '. esc_attr($class) .'" style="'. $text_color . $text_size . $border_bottom_color .'">'. esc_attr($text) .'</span>';
   } else {
     $output = '<span class="dropcaps dc-style-1 '. esc_attr($class) .'" style="'. $bg_color . $text_color . $text_size . $border_color .'">'. esc_attr($text) .'</span>';
   }
   return $output;
}
add_shortcode("jt_dropcaps", "dropcaps_function");

/* Tooltip */
function tooltip_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "tooltip_title" => '',
      "text_color" => '',
      "text_size" => '',
      "class" => ''
   ), $atts));

   if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }
   if ($text_color) {
      $text_color = 'color:'. esc_attr($text_color) .';';
   } else {
      $text_color ='';
   }

   return '<a href="#" class="'. esc_attr($class) .' juster-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="'. esc_attr($tooltip_title) .'" style="'. $text_color . $text_size .'">'. esc_attr($text) .'</a>';

}
add_shortcode("jt_tooltip", "tooltip_function");

/* Spacer */
function spacer_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "height" => '',
      "class" => ''
   ), $atts));

   if ($height) {
      $height = 'height:'. esc_attr($height) .';';
   } else {
      $height ='';
   }

   return '<div class="'. esc_attr($class) .'" style="'. $height .'"></div>';
}
add_shortcode("jt_spacer", "spacer_function");

/* Lists - jt_list */
function list_style($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "icon" => '',
      "link" => '',
      "target" => '',
      "color"=> '',
      "size" => '',
      "icon_color"=> '',
      "icon_size" => '',
   ), $atts));

   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color = '';
   }
   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size = '';
   }
   if ($icon_color) {
      $icon_color = 'color:'. esc_attr($icon_color) .';';
   } else {
      $icon_color = '';
   }
   if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
   } else {
      $icon_size = '';
   }
   if ($target == 'yes') {
      $target = 'target="_blank"';
   } else {
      $target = 'target="_self"';
   }
   if ($icon) {
     $icon = '<i class="'. esc_attr($icon) .'" style="'. $icon_color . $icon_size .'"></i>';
   } else {
    $icon = '';
   }
   if ($link) {
     $link_before = '<a href="'. $link .'" '. $target .'>';
     $link_after = '</a>';
   } else {
      $link_before = '';
      $link_after = '';
   }

   if ($text) {
      $list = '<li>'. $icon . $link_before .'<h5 class="list-head" style="'. $color . $size .'">'. esc_attr($text) .'</h5>'. $link_after .'</li>';
   } else {
      $list = '';
   }
      return $list;
}
add_shortcode("jt_list", "list_style");

/* Lists - jt_lists */
function list_head($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => ''
   ), $atts));

   return '<ul class="jt-lists '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
}
add_shortcode("jt_lists", "list_head");

/* Special Heading */
function special_heading_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "tag" => '',
      "color" => '',
      "size" => '',
      "text_transform" => '',
      "class" =>'',
      "style" => '',
   ), $atts));

   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
     $size = '';
   }
   if ($color) {
     $color = 'color:'. esc_attr($color) .';';
   } else {
     $color = '';
   }
   if ($text_transform) {
      $text_transform = 'text-transform:'. esc_attr($text_transform) .';';
   } else {
     $text_transform = '';
   }

    if ($style == 'style-one') {
      $heading = '<'. $tag .' class="jt-special '. esc_attr($class) .'" style="'. $color . $size . $text_transform .'">'. $text .'</'. $tag .'>';
   } elseif($style == 'style-two') {
      $heading = '<'. $tag .' class="jt-arch-title-h1-auto '. esc_attr($class) .'" style="'. $color . $size . $text_transform .'">'. $text .'</'. $tag .'>';
   } elseif($style == 'style-three') {
    $heading = '<'. $tag .' class="'. esc_attr($class) .'" style="'. $color . $size . $text_transform .'">'. $text .'</'. $tag .'>';
   } elseif($style == 'style-four') {
    $heading = '<div class="jt-vint-title vint-title-only '. esc_attr($class) .'"><'. $tag .'  style="'. $color . $size . $text_transform .'">'. $text .'</'. $tag .'></div>';
   } else {
    $heading = '<h2 class="jt-special '. esc_attr($class) .'" style="'. $color . $size . $text_transform .'">'. $text .'</h2>';
   }
      return $heading;

}
add_shortcode("jt_special_heading", "special_heading_function");

/* Special text */
function special_text_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "color" => '',
      "size" => '',
      "line_height" => '',
      "class" =>'',
   ), $atts));

   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size ='';
   }
   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color ='';
   }
   if ($line_height) {
      $line_height = 'line-height:'. $line_height .';';
   } else {
      $line_height = '';
   }
   if ($text) {
      $output = '<div class="jt-special '. esc_attr($class) .'" style="'. $color . $size . $line_height . '">'. $text .'</div>';
   } else {
      $output = '';
   }
  return $output;

}
add_shortcode("jt_special_text", "special_text_function");

/* Blockquote */
function blockquote_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "style" => '',
      "content" => '',
      "content_size" => '',
      "content_color" => '',
      "link" => '',
      "text_color" => '',
      "text_size" => '',
      "line_height" => '',
      "text" => '',
      "class" =>'',
   ), $atts));

   if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
   } else {
      $content_size ='';
   }
   if ($content_color) {
      $content_color = 'color:'. esc_attr($content_color) .';';
   } else {
      $content_color ='';
   }
   if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }
   if ($line_height) {
      $line_height = 'line-height:'. esc_attr($line_height) .';';
   } else {
      $line_height ='';
   }
   if ($text_color) {
      $text_color = 'color:'. esc_attr($text_color) .';';
   } else {
      $text_color ='';
   }
   if($style == 'style-one') {
      if ($link) {
         $link = esc_url($link);
      } else {
         $link ='';
      }
   }
    if ($style == 'style-one') {
      $output = '<div class="jt-blockquote jt-block-style-1 '. esc_attr($class) .'" style="'. $content_color . $content_size . $line_height . '"><p>'. $content .'</p><a href="'. $link .'" style="'. $text_color . $text_size . '">'. esc_attr($text) .'</a></div>';
   } elseif($style == 'style-two') {
      $output = '<div class="jt-single-quote '. esc_attr($class) .'">
                <p class="jt-quote-msg" style="'. $content_color . $content_size . $line_height . '">'. $content .'</p>
                <p class="jt-quote-auth" style="'. $text_color . $text_size . '">- '. esc_attr($text) .'</p>
            </div>';
   } elseif($style == 'style-three') {
      $output ='<div class="jt-block-quote '. esc_attr($class) .'"><blockquote  style="'. $content_color . $content_size . $line_height . '">'. $content .'<span style="'. $text_color . $text_size . '"> - '. esc_attr($text) .'</span></blockquote></div>';
   } else {
    $output = '<div class="jt-blockquote jt-block-style-1 '. esc_attr($class) .'" style="'. $content_color . $content_size . $line_height . '"><p>'. $content .'</p><a href="'. $link .'"  style="'. $text_color . $text_size . '">'. esc_attr($text) .'</a></div>';
   }
   return $output;

}
add_shortcode("jt_blockquote", "blockquote_function");

/* Social Icons - jt_social_icons */
function social_icon_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "style" => '',
      "heading" => '',
      "class" => ''
   ), $atts));

   if ($style == 'style-one') {
    $output='<ul class="jt-social-one '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-two') {
    $output='<ul class="jt-social-two '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-three') {
    $output='<ul class="jt-social-three '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-four') {
    $output='<ul class="jt-social-four '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-five') {
    $output='<ul class="jt-social-five '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-six') {
    $output='<div class="jt-social-six '. esc_attr($class) .'"><h4>'. $heading .'</h4><div class="jt-sep-two have_control_sep"></div><ul class="jt-social-three">'. do_shortcode($content) .'</ul></div>';
  } elseif ($style == 'style-seven') {
    wp_register_script( 'juster-chaffle', SCRIPTS . '/chaffle.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'juster-chaffle' );
    $output='<ul class="jt-studio-social-list '. esc_attr($class) .'" >'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-eight') {
    $output='<ul class="jt-social-one jt-footer-social '. esc_attr($class) .'" >'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-nine') {
    $output='<ul class="jt-social-three jt-social-six '. esc_attr($class) .'" >'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-ten') {
    $output='<ul class="jt-header-social '. esc_attr($class) .'" >'. do_shortcode($content) .'</ul>';
  } elseif ($style == 'style-eleven') {
    $output='<ul class="jt-arch-share-list '. esc_attr($class) .'" >'. do_shortcode($content) .'</ul>';
  } else {
    $output='<ul class="jt-social-one '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
  }
  return $output;
}
add_shortcode("jt_social_icons", "social_icon_function");

/* Social Icons - jt_social */
function social_styles($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "icon" => '',
      "size" => '',
      "link" => '',
      "color" => '',
      "icon_size" => '',
      "icon_color" => '',
      "icon_border_color" => ''
   ), $atts));

   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size = '';
   }
   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color ='';
   }
   if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
   } else {
      $icon_size ='';
   }
   if ($icon_color) {
      $icon_color = 'color:'. esc_attr($icon_color) .';';
   } else {
      $icon_color ='';
   }
   if ($icon_border_color) {
      $icon_border_color = 'border-color:'. esc_attr($icon_border_color) .';';
   } else {
      $icon_border_color ='';
   }

   if ($text) {
      $output = '<li><a href="'. esc_url($link) .'" target="_blank" style="'. $color . $size . '">'. $text .'</a></li>';
   } else {
      $output = '<li><a href="'. esc_url($link) .'" target="_blank"><i class="'. $icon .'" style="'. $icon_color . $icon_size . $icon_border_color .'"></i></a></li>';
   }
   return $output;
}
add_shortcode("jt_social", "social_styles");

/* H4 */
function address_styles($atts, $content = null) {
   extract(shortcode_atts(array(
      "title" => '',
      "color" => '',
      "size" => '',
      "class" => '',
   ), $atts));

   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size = '';
   }
   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color ='';
   }

   if ($title) {
      $output = '<h4 class="'. esc_attr($class) .'" style="'. $color . $size . '">'. esc_attr($title) .'</h4>';
   } else {
      $output = '';
   }
      return $output;
}
add_shortcode("jt_h4", "address_styles");

/* Address - jt_addresses */
function addresses_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => ''
   ), $atts));

   return '<ul class="jt-contact-addresses '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
}
add_shortcode("jt_addresses", "addresses_function");

/* Address - jt_address */
function address_function($atts, $content = true) {
   extract(shortcode_atts(array(
   ), $atts));

   return '<li>'. do_shortcode($content) .'</li>';
}
add_shortcode("jt_address", "address_function");

/* Social Share - jt_icons */
function social_share_styles($atts, $content = null) {
   extract(shortcode_atts(array(
      "twitter" => '',
      "facebook" => '',
      "google_plus" => '',
      "linkedin" => '',
      "icon_size" => '',
      "icon_color" => '',
   ), $atts));

   if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
   } else {
      $icon_size = '';
   }
   if ($icon_color) {
      $icon_color = 'color:'. esc_attr($icon_color) .';';
   } else {
      $icon_color = '';
   }
   global $post;

   if ($twitter == 'yes') {
      $output ='<li><a href="http://twitter.com/home?status='. urlencode(get_the_title($post->ID)) .'+'. urlencode(get_permalink($post->ID)) .'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
   }
   if ($facebook == 'yes') {
      $output .= '<li><a href="http://www.facebook.com/sharer/sharer.php?u='. urlencode(get_permalink($post->ID)) .'&amp;t='. urlencode(get_the_title($post->ID)) .'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
   }
   if ($linkedin == 'yes') {
      $output .= '<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='. urlencode( get_permalink($post->ID )) .'&amp;title='. urlencode(get_the_title($post->ID)) .'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
   }
   if ($google_plus == 'yes') {
      $output .= '<li><a href="https://plus.google.com/share?url='. urlencode(get_permalink($post->ID )) .'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
   }
   return $output;
}
add_shortcode("jt_icons", "social_share_styles");

/* Social Share - jt_social_share */
function share_icons_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => '',
      "style" => '',
      "text" => ''
   ), $atts));

  if ($style =='style-one') {
   return ' <ul class="jt-share-one '. esc_attr($class) .'"><li>'. esc_attr($text) .'</li>'. do_shortcode($content) .'</ul>';
  } elseif($style =='style-two') {
    return ' <ul class="jt-share-one jt-share-border-none '. esc_attr($class) .'"><li>'. esc_attr($text) .'</li>'. do_shortcode($content) .'</ul>';
  } else {
   return ' <ul class="jt-share-one '. esc_attr($class) .'"><li>'. esc_attr($text) .'</li>'. do_shortcode($content) .'</ul>';
  }
}
add_shortcode("jt_social_share", "share_icons_function");

/* Steps */
function steps_styles($atts, $content = null) {
   extract(shortcode_atts(array(
      "heading" => '',
      "icon" => '',
      "heading_color" => '',
      "heading_size" => '',
      "icon_color" => '',
      "icon_size" => '',
      "step_type" => '',
      "class" =>'',
   ), $atts));

   if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
   } else {
      $heading_size = '';
   }
   if ($heading_color) {
      $heading_color = 'color:'. esc_attr($heading_color) .';';
   } else {
      $heading_color = '';
   }
   if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
   } else {
      $icon_size = '';
   }
   if ($icon_color) {
      $icon_color = 'color:'. esc_attr($icon_color) .';';
   } else {
      $icon_color = '';
   }

   if($step_type == 'equal') {
      $step_type = 'cs-have-equal';
   } elseif($step_type == 'plus') {
      $step_type = 'cs-have-plus';
   } elseif($step_type == 'none') {
      $step_type = '';
   } else { $step_type = ''; }

    if ($heading) {
      $output = '<div class="col-sm-3 '. esc_attr($class) .'"><div class="cs-services-heading '. $step_type .'"><div class="cs-services-icon"><i class="'. esc_attr($icon) .'" style="'. $heading_color . $heading_size . '"></i></div><h5 style="'. $icon_color . $icon_size . '">'. esc_attr($heading) .'</h5></div></div>';
   } else {
      $output = '';
   }
      return $output;

}
add_shortcode("jt_steps", "steps_styles");

/* Custom Button */
function custom_button_function( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'button_text' => '',
        'link' => '',
        'size' => '',
        'color' => '',
        'target' => '',
        'class' => ''
    ), $atts));

     if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
     } else {
        $size = '';
     }
     if ($color) {
        $color = 'color:'. esc_attr($color) .';';
     } else {
        $color ='';
     }
    if ($target == 'yes') {
      $target = "_blank";
    } else {
      $target = "_self";
    }
    return '<a href="'. esc_url($link) .'" target="'. esc_attr($target) .'" class="jt-custom-btn jt-btn-space '. esc_attr($class) .'" style="'. $size . $color .'">'. esc_attr($button_text) .'</a>';
}
add_shortcode( 'jt_custom_button', 'custom_button_function' );

/* Special Content Block */
function special_content_block($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => '',
      "heading" =>'',
      "heading_color" =>'',
      "heading_size" =>'',
      "content_color" =>'',
      "content_size" =>'',
      "style" => ''
   ), $atts));

    if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
    } else {
      $heading_size ='';
    }
    if ($heading_color) {
      $heading_color = 'color:'. esc_attr($heading_color) .';';
    } else {
      $heading_color ='';
    }
    if ($content_size) {
      $content_size = 'font-size:'. esc_attr($content_size) .';';
    } else {
      $content_size ='';
    }
    if ($content_color) {
      $content_color = 'color:'. esc_attr($content_color) .';';
    } else {
      $content_color ='';
    }

  if($style =="style-one") {
    $output= '<div class="special-content '. esc_attr($class) .'"><h5 style="'. $heading_color . $heading_size . '">'. esc_attr($heading) .'</h5><p style="'. $content_color . $content_size . '">'. do_shortcode($content) .'</p></div>';
  } elseif($style =='style-two'){
    $output= '<div class="jt-port-about-tit '. esc_attr($class) .'"><h3 style="'. $heading_color . $heading_size . '">'. esc_attr($heading) .'</h3></div><div class="jt-port-about-sub"><p style="'. $content_color . $content_size . '">'. do_shortcode($content) .'</p></div>';
  } elseif($style =='style-three'){
    $output= '<div class="jt-arch-title '. esc_attr($class) .'">'. do_shortcode($content) .'</div>';
  } else {
    $output= '<div class="special-content '. esc_attr($class) .'"><h5>'. esc_attr($heading) .'</h5><p>'. do_shortcode($content) .'</p></div>';
  }
  return $output;
}
add_shortcode("jt_special_content", "special_content_block");

/* Intro Text */
function intro_double_text( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'text' => '',
        'bold_text' => '',
        'color' => '',
        'size' => '',
        'class' => ''
    ), $atts));

     if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
     } else {
        $size = '';
     }
     if ($color) {
        $color = 'color:'. esc_attr($color) .';';
     } else {
        $color ='';
     }

    return '<div class="double-line-one '. esc_attr($class) .'" style="'. $color . $size . '">'. esc_attr($text) .'<b>'. esc_attr($bold_text) .'</b></div>';
}
add_shortcode( 'jt_intro_text', 'intro_double_text' );

/* Portfolio Meta Custom Shortcode - jt_portfolio_custom_meta */
function portfolio_custom_meta_block($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => '',
      "style"=> ''
   ), $atts));

   if ($style === 'style-one') {
      return '<div class="jt-single-meta-one '. esc_attr($class) .'"><ul class="jt-port-single-list">'. do_shortcode($content) .'</ul></div>';
   } elseif ($style === 'style-two') {
      return '<div class="jt-single-meta-two '. esc_attr($class) .'"><ul class="jt-single-service-list">'. do_shortcode($content) .'</ul></div>';
   } elseif ($style === 'style-three') {
      return ' <div class="jt-single-meta-three '. esc_attr($class) .'"><ul class="jt-pjt-cat">'. do_shortcode($content) .'</ul></div>';
   } elseif ($style === 'style-four') {
     return '<div class="jt-single-meta-four sep-hover-control '. esc_attr($class) .'"><ul class="jt-meta-list">'. do_shortcode($content) .'</ul></div>';
   } elseif ($style === 'style-five') {
     return '<div class="jt-single-content '. esc_attr($class) .'"><ul class="jt-single-cont-list">'. do_shortcode($content) .'</ul></div>';
  } else {
    return '<div class="jt-single-meta-one '. esc_attr($class) .'"><ul class="jt-port-single-list">'. do_shortcode($content) .'</ul></div>';
  }
}
add_shortcode("jt_portfolio_custom_meta", "portfolio_custom_meta_block");

/* Portfolio Meta Custom Shortcode - jt_portfolio_meta */
function portfolio_meta_shortcode($atts, $content = null) {
   extract(shortcode_atts(array(
      "title" => '',
      "text" => '',
      "link" => '',
      "target" => '',
      "title_color" => '',
      "title_size" => '',
      "text_color" => '',
      "text_size" => ''
   ), $atts));

   // Atts
   $target = ($target === 'yes') ? '_blank' : '_self';
   if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
   } else {
      $title_size ='';
   }
   if ($title_color) {
      $title_color = 'color:'. esc_attr($title_color) .';';
   } else {
      $title_color = '';
   }
   if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }
   if ($text_color) {
      $text_color = 'color:'. esc_attr($text_color) .';';
   } else {
      $text_color='';
   }

   $result = '<li><span style="'. $title_size . $title_color .'">'. $title .':</span><a href="'. esc_url($link) .'" style="'. $text_size . $text_color .'">'. esc_attr($text) .'</a></li>';

   return $result;

}
add_shortcode("jt_portfolio_meta", "portfolio_meta_shortcode");

/* About List  */
function about_list_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "heading" => '',
      "text" => '',
      "heading_color" => '',
      "heading_size" => '',
      "color" => '',
      "size" => '',
      "class" =>'',
   ), $atts));

   if ($heading_color) {
      $heading_color = 'color:'. esc_attr($heading_color) .';';
   } else {
      $heading_color ='';
   }

   if ($heading_size) {
      $heading_size = 'font-size:'. esc_attr($heading_size) .';';
   } else {
      $heading_size ='';
   }

   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color ='';
   }

   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size='';
   }

   if ($heading) {
      $output = '<div class="jt-about-wrap '. esc_attr($class) .'"><h4 style="'. $heading_color . $heading_size .'">'. esc_attr($heading) .'</h4><p style="'. $color . $size .'">'. $text .'</p></div>';
   } else {
      $output = '';
   }
      return $output;

}
add_shortcode("jt_about_list", "about_list_function");

/* Contact Details */
function contact_details_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "icon" => '',
      "text" => '',
      "image_url" => '',
      "icon_color" => '',
      "icon_size" => '',
      "color" => '',
      "size" => '',
      "class" =>'',
   ), $atts));

   if ($icon_color) {
      $icon_color = 'color:'. esc_attr($icon_color) .';';
   } else {
      $icon_color = '';
   }
   if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
   } else {
      $icon_size ='';
   }
   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color ='';
   }
   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size ='';
   }

  if($image_url) {
  $output = '<div class="cont-details '. esc_attr($class) .'"><img src="'. esc_attr($image_url) .'" alt="Skype"><p class="cont-info" style="'. $color . $size .'">'. esc_attr($text) .'</p></div>';
  } else {
    $output = '<div class="cont-details '. esc_attr($class) .'"><i class="'. esc_attr($icon) .'" style="'. $icon_color . $icon_size .'"></i><p style="'. $color . $size .'">'. esc_attr($text) .'</p></div>';
  }
      return $output;

}
add_shortcode("jt_contact_details", "contact_details_function");

/* Agency Header | Typing Text */
function agency_banner_text($atts, $content = null) {
  extract(shortcode_atts(array(
    "text_tag" => '',
    "normal_text" => '',
    "animation_text" => '',
    "type_speed" => '',
    "back_delay" => '',
    "loop" => '',
    "cursor" => '',
    "class" => ''
  ), $atts));

  if($animation_text) {
    $anims = str_replace(', ', ',', $animation_text);
    $anims = explode(",", $anims);
  } else {
    $anims = '';
  }
  if ($text_tag) {
    $text_tag = $text_tag;
  } else {
    $text_tag = 'h1';
  }

  if ($normal_text) {
    $output  = '<'. $text_tag .' class="jt-main-title '. esc_attr($class) .'">';
    $output .= $normal_text;
    $output .= '<span id="typed" style="white-space:pre;">';
    // $output .= $anims[0];
    $output .= '</span>';
    $output .= '</'. $text_tag .'>';
  } else {
    $output = 'null';
  }

  wp_enqueue_script( 'typed-js', SCRIPTS . '/typed.js', array( 'jquery' ), false, true );

?>
  <script type="text/javascript">
    jQuery(document).ready(function($){
    "use strict";

      $("#typed").typed({
        strings: [<?php foreach( $anims as $anim ) { echo '"'.$anim.'", '; } ?>],
        typeSpeed: <?php echo esc_attr($type_speed); ?>,
        backDelay: <?php echo esc_attr($back_delay); ?>,
        loop: <?php echo esc_attr($loop); ?>,
        contentType: 'html', // or text
        startDelay: 0,// backspacing speed
        backSpeed: 0,// shuffle the strings
        shuffle: false,// time before backspacing
        loopCount: false,// show cursor
        showCursor: true,// character for cursor
        cursorChar: "<?php echo esc_attr($cursor); ?>",// attribute to type (null == text)
        attr: null,// either html or text
      });

      $(".reset").click(function(){
          $("#typed").typed('reset');
      });

    });
  </script>
<?php

  return $output;
}
add_shortcode("jt_typing_text", "agency_banner_text");

/* Separator */
function separator_styles($atts, $content = null) {
   extract(shortcode_atts(array(
      "type" => '',
      "title" => '',
      "sep_width" => '',
      "sep_height" => '',
      "separator_color" => '',
      "title_color" => '',
      "title_size" => '',
      "align" => '',
   ), $atts));

    if($type == 'type-three') {
      if ($sep_width) {
        $sep_width = 'width:'. esc_attr($sep_width) .';';
      } else {
        $sep_width = '';
      }
      if ($sep_height) {
        $sep_height = 'height:'. esc_attr($sep_height) .';';
      } else {
        $sep_height ='';
      }
      if ($separator_color) {
        $separator_color = 'background-color:'. esc_attr($separator_color) .';';
      } else {
        $separator_color ='';
      }
    } else {
      $sep_width = '';
      $sep_height ='';
      $separator_color ='';
    }

    if ($title_color) {
      $title_color = 'color:'. esc_attr($title_color) .';';
   } else {
      $title_color ='';
   }
   if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
   } else {
      $title_size ='';
   }

    if ($title) {
      $title='<h2 style="'. $title_color . $title_size .'">'. esc_attr($title) .'</h2>';
    } else {
      $title='';
    }

    if($type == 'type-one') {
      if ($align == 'left') {
        $output = '<div class="jt-sep-two have_control_sep"></div>';
      } elseif ($align == 'right') {
        $output = '<div class="jt-sep-two-right have_control_sep"></div>';
      } else {
        $output = '<div class="jt-sep have_control_sep"></div>';
      }
    } elseif($type == 'type-two')  {
      if ($align == 'left') {
        $output = '<div class="jt-vint-title  jt-leaf-left">'. $title .'<div class="jt-leaf"></div></div>';
      } elseif ($align == 'right') {
        $output = '<div class="jt-vint-title jt-leaf-right">'. $title .'<div class="jt-leaf"></div></div>';
      } else {
        $output = '<div class="jt-vint-title jt-leaf-center">'. $title .'<div class="jt-leaf"></div></div>';
      }
    } elseif($type == 'type-three')  {
      if ($align == 'left') {
        $output = '<div class="jt-boxslide-sep-left" style="'. $sep_width . $sep_height . $separator_color .'"></div>';
      } elseif ($align == 'right') {
        $output = '<div class="jt-boxslide-sep-right" style="'. $sep_width . $sep_height . $separator_color .'"></div>';
      } else {
        $output = '<div class="jt-boxslide-sep" style="'. $sep_width . $sep_height . $separator_color .'"></div>';
      }
    } else {
      if ($align == 'left') {
        $output = '<div class="jt-sep-two have_control_sep"></div>';
      } elseif ($align == 'right') {
        $output = '<div class="jt-sep-two-right have_control_sep"></div>';
      } else {
        $output = '<div class="jt-sep have_control_sep"></div>';
      }
    }
    return $output;
}
add_shortcode("jt_separator", "separator_styles");

/* Subscribe */
function subscribe_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => '',
      "text" => '',
      "text_color" => '',
      "text_size" => '',
   ), $atts));

   if ($text_color) {
      $text_color = 'color:'. esc_attr($text_color) .';';
   } else {
      $text_color ='';
   }
   if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }

  $output='<div class="jt-corp-news-letter '. esc_attr($class) .'"><a href="#0" style="'. $text_color . $text_size .'">'. esc_attr($text) .'</a><div class="jt-box-slide-content">'. do_shortcode($content) .'</div></div>';
  return $output;
}
add_shortcode("jt_subscribe", "subscribe_function");

/* Language - jt_language */
function language_style($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "link" => '',
      "color"=> '',
      "size" => '',
   ), $atts));

   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color ='';
   }
   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size = '';
   }

   if ($text) {
      $list = '<li><a href="'. esc_url($link) .'" style="'. $color . $size .'">'. esc_attr($text) .'</a></li>';
   } else {
      $list = '';
   }
      return $list;
}
add_shortcode("jt_language", "language_style");

/* Language - jt_language_select */
function language_main_head($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => ''
   ), $atts));

   return '<ul class="footer-lang '. esc_attr($class) .'">'. do_shortcode($content) .'</ul>';
}
add_shortcode("jt_language_select", "language_main_head");

/* Text Icon */
function text_icon_style($atts, $content = null) {
   extract(shortcode_atts(array(
      "title" => '',
      "style" => '',
      "text" => '',
      "image_url" => '',
      "icon" => '',
      "link" => '',
      "link_class" => '',
      "icon_color"=> '',
      "icon_size" => '',
      "title_color"=> '',
      "title_size" => '',
      "text_color"=> '',
      "text_size" => '',
      "class" => '',
   ), $atts));

   if ($icon_color) {
      $icon_color = 'color:'. esc_attr($icon_color) .';';
   } else {
      $icon_color ='';
   }
   if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
   } else {
      $icon_size ='';
   }
   if ($title_color) {
      $title_color = 'color:'. esc_attr($title_color) .';';
   } else {
      $title_color ='';
   }
   if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
   } else {
      $title_size ='';
   }
   if ($text_color) {
      $text_color = 'color:'. esc_attr($text_color) .';';
   } else {
      $text_color ='';
   }
   if ($text_size) {
      $text_size = 'font-size:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }

   if ($style == 'style-one') {
      $output = '<ul class="jt-top-contact '. esc_attr($class) .'"><li><i class="'. esc_attr($icon) .'" style="'. $icon_color . $icon_size .'"></i></li><li><p class="jt-cont-tit" style="'. $title_color . $title_size .'">'. esc_attr($title).' </p></li><li><a href="'. esc_attr($link) .'" class="jt-cont-detail" style="'. $text_color . $text_size .'"> '. esc_attr($text) .'</a></li></ul>';
   } elseif ($style == 'style-two') {
      $output = '<ul class="jt-top-contact '. esc_attr($class) .'"><li><i class="'. esc_attr($icon) .'" style="'. $icon_color . $icon_size .'"></i></li><li><a href="'. esc_attr($link) .'" class="jt-txt-link '. esc_attr($link_class) .'" style="'. $title_color . $title_size .'">'. esc_attr($title) .'</a></li></ul>';
   } else {
      $output = '<div class="jt-free-ship '. esc_attr($class) .'"><img src="'. esc_attr($image_url) .'" alt="'. esc_attr($text) .'"><span style="'. $text_color . $text_size .'">'. esc_attr($text) .'</span></div>';
   }
      return $output;
}
add_shortcode("jt_text_icon", "text_icon_style");

/* Dropdown Language - jt_dropdown_menu */
function dropdown_language($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "link" => '',
      "image_url" => '',
      "color"=> '',
      "size" => '',
      "target" => '',
   ), $atts));

   if ($color) {
      $color = 'color:'. esc_attr($color) .';';
   } else {
      $color = '';
   }
   if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
   } else {
      $size = '';
   }
   if ($target == 'yes') {
      $target = 'target="_blank"';
   } else {
      $target = 'target="_self"';
   }

   if ($image_url) {
      $image_url = '<img src="'. esc_attr($image_url) .'" alt="'. esc_attr($text) .'">';
   } else {
      $image_url = '';
   }

   if ($text) {
      $list = '<li class="dropdown"><a href="'. $link .'" '. $target .'>'. $image_url .'<span style="'. $color . $size .'">'. esc_attr($text) .'</span></a></li>';
   } else {
      $list = '';
   }
      return $list;
}
add_shortcode("jt_dropdown_menu", "dropdown_language");

/* Dropdown Language - jt_topbar_dropdown */
function language_parts($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => '',
      "title" => '',
      "title_link" => '',
      "title_color" => '',
      "title_size" =>'',
      "target" =>''
   ), $atts));

   if ($title_color) {
      $title_color = 'color:'. esc_attr($title_color) .';';
   } else {
      $title_color ='';
   }
   if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
   } else {
      $title_size ='';
   }
   if ($target == 'yes') {
      $target = 'target="_blank"';
   } else {
      $target = 'target="_self"';
   }

   return '<ul class="nav navbar-nav navbar-right jt-main-nav '. $class .'"><li class="menu-item-has-children menu-item-9 dropdown"><a href="'. esc_url($title_link) .'" '. $target .' data-toggle="dropdown" class="dropdown-toggle" style="'. $title_color . $title_size .'">'. esc_attr($title) .'<span class="caret"></span></a><ul class=" dropdown-menu jt-top-width-three">'. do_shortcode($content) .'</ul></li></ul>';
}
add_shortcode("jt_topbar_dropdown", "language_parts");

/* Footer Content */
function footer_content_styles($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" =>'',
      "style" =>''
   ), $atts));

    if ($style =='style-one') {
      $output = '<div class="jt-address-detail '. esc_attr($class) .'">'. do_shortcode($content) .'</div>';
    } elseif ($style =='style-two') {
      $output = '<div class="jt-contact '. esc_attr($class) .'">'. do_shortcode($content) .'</div>';
    } else {
      $output = '<div class="jt-address-detail '. esc_attr($class) .'">'. do_shortcode($content) .'</div>';
    }
    return $output;

}
add_shortcode("jt_footer_content", "footer_content_styles");

/* Back Text */
function back_text_style($atts, $content = null) {
   extract(shortcode_atts(array(
      "text" => '',
      "front_text_color"=> '',
      "back_text_color" => '',
      "class" => '',
   ), $atts));

   if ($front_text_color) {
      $front_text_color = 'color:'. esc_attr($front_text_color) .';';
   } else {
      $front_text_color ='';
   }

   if ($back_text_color) {
      $back_text_color = 'color:'. esc_attr($back_text_color) .';';
   } else {
      $back_text_color ='';
   }

   if ($text) {
      $output = '<div class="jt-single-meta-one '. esc_attr($class) .'"><h1 class="jt-port-bg-tit" style="'. $back_text_color .'">'. esc_attr($text) .'<span class="jt-port-single-tit" style="'. $front_text_color .'">'. esc_attr($text) .'</span></h1></div>';
   } else {
      $output = '';
   }
      return $output;
}
add_shortcode("jt_back_text", "back_text_style");

/* Link Text */
function link_function( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'style' => '',
        'text' => '',
        'link' => '',
        'size' => '',
        'color' => '',
        'class' => ''
    ), $atts));

    if ($color) {
      $color = 'color:'. esc_attr($color) .';';
    } else {
      $color ='';
    }

    if ($size) {
      $size = 'font-size:'. esc_attr($size) .';';
    } else {
      $size ='';
    }

   if($style == 'style-one') {
    $output='<a href="'. esc_url($link) .'" target="_blank" class="jt-link-style-one '. esc_attr($class) .'" style="'. $size . $color .'">'. esc_attr($text) .'</a>';
   } elseif($style == 'style-two'){
    $output='<a href="'. esc_url($link) .'" class="read-more-blog '. esc_attr($class) .'" style="'. $size . $color .'">'. esc_attr($text) .'<img src="'. IMAGES .'/arrows/box-arrow-right.png" alt=""></a>';
   } else {
    $output='<a href="'. esc_url($link) .'" target="_blank" class="jt-link-style-one '. esc_attr($class) .'" style="'. $size . $color .'">'. esc_attr($text) .'</a>';
  }
   return $output;
}
add_shortcode( 'jt_link_text', 'link_function' );

/* Social Count - jt_social_counter */
function social_count_function($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => '',
   ), $atts));

   return '<div class="jt-social-counter '. esc_attr($class) .'"><ul>'. do_shortcode($content) .'</ul></div>';
  }
add_shortcode("jt_social_counter", "social_count_function");

/* Social Count - jt_social_like_count */
function social_likes_count_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "number" => '',
      "text" => '',
      "icon" => '',
      "link" => '',
      "text_color" => '',
      "text_size" => '',
      "number_color" => '',
      "number_size" => '',
      "icon_size" => '',
      "icon_color" => '',
      "target" => '',
      "icon_border_color" => ''
   ), $atts));

   if ($text_color) {
      $text_color = 'font-size:'. esc_attr($text_color) .';';
   } else {
      $text_color = '';
   }
   if ($text_size) {
      $text_size = 'color:'. esc_attr($text_size) .';';
   } else {
      $text_size ='';
   }
   if ($number_size) {
      $number_size = 'font-size:'. esc_attr($number_size) .';';
   } else {
      $number_size = '';
   }
   if ($number_color) {
      $number_color = 'color:'. esc_attr($number_color) .';';
   } else {
      $number_color ='';
   }
   if ($icon_size) {
      $icon_size = 'font-size:'. esc_attr($icon_size) .';';
   } else {
      $icon_size ='';
   }
   if ($icon_color) {
      $icon_color = 'color:'. esc_attr($icon_color) .';';
   } else {
      $icon_color ='';
   }
   if ($icon_border_color) {
      $icon_border_color = 'border-color:'. esc_attr($icon_border_color) .';';
   } else {
      $icon_border_color ='';
   }

   if ($target == 'yes') {
      $target = 'target="_blank"';
   } else {
      $target = 'target="_self"';
   }

   if ($number) {
      $output = '<li><a href="'. esc_url($link) .'" '. esc_attr($target) .'><i class="'. esc_attr($icon) .'" style="'. $icon_color . $icon_size . $icon_border_color .'"></i><span style="'. $text_color . $text_size . '">'. $text .'</span><p style="'. $number_color . $number_size . '">'. esc_attr($number) .'</p></a></li>';
   } else {
      $output = '';
   }
   return $output;
}
add_shortcode("jt_social_like_count", "social_likes_count_function");

/* Product Carousel - jt_product_carousel */
function product_carousal_main($atts, $content = true) {
   extract(shortcode_atts(array(
      "class" => '',
      "title" =>'',
      "carousel_bg_color" =>'',
      "title_color" =>'',
      "title_size" =>'',
   ), $atts));

   if ($title_color) {
      $title_color = 'color:'. esc_attr($title_color) .';';
   } else {
      $title_color ='';
   }
   if ($title_size) {
      $title_size = 'font-size:'. esc_attr($title_size) .';';
   } else {
      $title_size ='';
   }
   if ($carousel_bg_color) {
      $carousel_bg_color = 'background-color:'. esc_attr($carousel_bg_color) .';';
   } else {
      $carousel_bg_color ='';
   }

   return '<div class="'. esc_attr($class) .'"><div class="jt-small-slide-tit"><h3 style="'. $title_color . $title_size . '">'. esc_attr($title) .'</h3></div><div class="jt-shop-small-slide-wrap jt-shop-small-carousel" style="'. $carousel_bg_color . '">'. do_shortcode($content) .'</div></div>';
}
add_shortcode("jt_product_carousel", "product_carousal_main");

/* Product Carousel - jt_slide_set */
function product_carousal_slide_set($atts, $content = true) {
   extract(shortcode_atts(array(
   ), $atts));

   return '<div class="jt-shop-small-slide">'. do_shortcode($content) .'</div>';
  }
add_shortcode("jt_slide_set", "product_carousal_slide_set");

/* Product Carousel - jt_carousel_products */
function jt_carousal_item($atts, $content = null) {
   extract(shortcode_atts(array(
      "limit" => '',
      "id" => '',
      "order" => '',
      "orderby" => '',
   ), $atts));

    // global $product;
    global $post, $product, $woocommerce_loop, $the_product;

     if ($orderby =='rating') {
        $orderby = 'comment_count';
     } elseif($orderby =='date') {
        $orderby ='date';
     } else {
        $orderby ='';
     }
    // Turn output buffer on
    ob_start();

      if ($id) {
        $product_id = explode(',',$id);
      } else {
        $product_id = '';
      }

      if($id) {
        $each_cat = array(
          'post_type'       => 'product',
          'post_status'       => 'publish',
          'ignore_sticky_posts' => 1,
          'orderby'         => esc_attr($orderby),
          'order'         => esc_attr($order),
          'posts_per_page'    => (int)$limit,
          'post__in'      => $product_id
        );
      } else {
        $each_cat = array(
          'post_type'       => 'product',
          'post_status'       => 'publish',
          'ignore_sticky_posts' => 1,
          'orderby'         => esc_attr($orderby),
          'order'         => esc_attr($order),
          'posts_per_page'    => (int)$limit,
        );
      }

    $jt_carousel = new WP_Query( $each_cat );

    /* Normal jt_products */
    if ($jt_carousel->have_posts()) : while ($jt_carousel->have_posts()) : $jt_carousel->the_post();

    // Featured Image
    $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
    $large_image = $large_image[0];
      if ( $large_image ) {
        $product_img_url = aq_resize( $large_image, '90', '90', true );
        $product_img = $product_img_url;
      } else {
        $product_img = IMAGES .'/dummy/90x90.jpg';
      }

      $currency = get_woocommerce_currency_symbol();

      if ( empty( $the_product ) || $the_product->id != $post->ID ) {
        $the_product = wc_get_product( $post );
      }

      if ( 'variable' == $the_product->product_type ) {
        $reg_price = get_post_meta( get_the_ID(), 'variable_regular_price', true);
        $sale_price = get_post_meta( get_the_ID(), 'variable_sale_price', true);
        $price = '<a href="'.get_permalink().'">'. __( "View Price", 'juster') . '</a>';
      } else {
        $reg_price = get_post_meta( get_the_ID(), '_regular_price', true);
        $sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
        if($sale_price) {
        $price ='<span>'. $currency . $sale_price .'</span><span class="jt-trend-strike">'. $currency . $reg_price .'</span>';
        } else {
        $price ='<span>'. $currency . $reg_price .'</span>';
        }
      }

      echo '<div class="jt-small-slde-element">
              <a href="'.get_permalink().'"><img src="'. esc_attr($product_img) .'" alt=""></a>
              <div class="jt-trend-item-desc">
                  <a href="'.get_permalink().'">' . get_the_title() . '</a>
                  <p class="jt-trend-item-price">
                   '. $price .'
                  </p>
              </div>
            </div>';

      endwhile;
      wp_reset_postdata();
      else :
        get_template_part( 'content', 'none' );
      endif;

    // Return outbut buffer
    return ob_get_clean();
    // return $output;
  }
add_shortcode("jt_carousel_products", "jt_carousal_item");

/* Single Image */
function jt_single_image_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "title" => '',
      "image_url"=> '',
      "link" => '',
      "class" => ''
   ), $atts));

   if ($link == 'yes') {
      $link_class = 'jt-popup-image ';
      $links_open = '<a href="'. $image_url .'">';
      $links_close = '</a>';
   } else {
      $link_class = '';
      $links_open = '';
      $links_close = '';
   }
   if ($title) {
      $title = '<span><em>'. $title .'</em></span>';
   } else {
      $title = '';
   }

  $result = '<div class="jt-fig-cont '. $link_class . $class .'"><figure>'. $links_open .'<img src="'. $image_url .'" class="vc_single_image-img attachment-full" alt="">'. $links_close .'</figure>'. $title .'</div>';
  return $result;

}
add_shortcode("jt_single_image", "jt_single_image_function");
