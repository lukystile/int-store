<?php
/**
 * @var $this WPBakeryShortCode_VC_Column
 */
$output = $font_color = $el_class = $width = $offset = '';
extract( shortcode_atts( array(
	'column_bg_color'       => '',
	'bg_column_image'       => '',
	'bg_column_type'       => '',
	'text_alignment'       => '',
  'column_custom_height'  => '',

	/* Animation */
	'column_animation'      => '',
	'animation_duration'      => '',
	'animation_delay'      => '',
	'animation_offset'      => '',
	'animation_iteration'      => '',

	/* Border */
	'column_border_style'   => '',
	'column_border_color'   => '',
	'column_border_width'   => '',

	/* Margin */
	'column_margin_top'     => '',
	'column_margin_bottom'  => '',
	'column_margin_left'    => '',
	'column_margin_right'   => '',

	/* Padding */
	'column_padding_top'    => '',
	'column_padding_bottom' => '',
	'column_padding_left'   => '',
	'column_padding_right'  => '',

	'font_color' => '',
	'el_class' => '',
	'width' => '1/1',
	'css' => '',
	'offset' => ''
), $atts ) );

/* Animation */
if($column_animation === 'none') {
  $column_animation = '';
} else {
  $column_animation = ' '. $column_animation .' has_animation';
  wp_enqueue_style( 'animate' );
  wp_enqueue_script( 'wow.min', SCRIPTS . '/wow.min.js', array( 'jquery' ), false, true );

  if ($animation_duration) {
  	$animation_duration = ' data-wow-duration="' . $animation_duration .'"';
  }
  if ($animation_delay) {
  	$animation_delay = ' data-wow-delay="' . $animation_delay .'"';
  }
  if ($animation_offset) {
  	$animation_offset = ' data-wow-offset="' . $animation_offset .'"';
  }
  if ($animation_iteration) {
  	$animation_iteration = ' data-wow-iteration="' . $animation_iteration .'"';
  }

}

/* Border */
if($column_border_width) {
  $column_border_width = 'border-style:'. $column_border_style .';border-width:'. $column_border_width .';border-color:'. $column_border_color .';';
}

/* General Tab */
if ($column_bg_color) {
  $column_bg_color = 'background-color:'. $column_bg_color .';';
}
if ($bg_column_image) {
   $image_url = wp_get_attachment_url( $bg_column_image );
   $bg_column_image = 'background-image:url('. $image_url .');';
}
if ($bg_column_type === 'cover' && $bg_column_type === 'contain') {
  $bg_column_type_class = ' bg-cover ';
} elseif($bg_column_type === 'no-repeat' && $bg_column_type === 'repeat') {
	$bg_column_type_style = 'background-repeat:' . $bg_column_type . ';';
} else {
	$bg_column_type_class = '';
	$bg_column_type_style = '';
}
if ($text_alignment) {
  $text_alignment = ' text-'. $text_alignment;
}
if ($column_custom_height) {
  $column_custom_height = 'height:'. $column_custom_height .';';
}

/* Margins */
if($column_margin_top) {
  $column_margin_top = 'margin-top:'. $column_margin_top .';';
}
if($column_margin_bottom) {
  $column_margin_bottom = 'margin-bottom:'. $column_margin_bottom .';';
}
if($column_margin_left) {
  $column_margin_left = 'margin-left:'. $column_margin_left .';';
}
if($column_margin_right) {
  $column_margin_right = 'margin-right:'. $column_margin_right .';';
}

/* Paddings */
if($column_padding_top) {
  $column_padding_top = 'padding-top:'. $column_padding_top .';';
}
if($column_padding_bottom) {
  $column_padding_bottom = 'padding-bottom:'. $column_padding_bottom .';';
}
if($column_padding_left) {
  $column_padding_left = 'padding-left:'. $column_padding_left .';';
}
if($column_padding_right) {
  $column_padding_right = 'padding-right:'. $column_padding_right .';';
}

$el_class = $this->getExtraClass( $el_class );
$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );
$el_class .= ' wpb_column vc_column_container';

$style = $this->buildStyle( $font_color );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div class="'. $css_class . $column_animation .'" '. $animation_duration . $animation_delay . $animation_offset . $animation_iteration .'>';
$output .= "\n\t".'<div>';
$output .= '<div class="space-fix '. $text_alignment . $bg_column_type_class .'" style="'. $bg_column_image . $column_bg_color . $bg_column_type_style . $column_custom_height . $column_border_width . $column_margin_top . $column_margin_bottom . $column_margin_left . $column_margin_right . $column_padding_top . $column_padding_bottom . $column_padding_left . $column_padding_right .'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= '</div>';
$output .= '</div>';
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;
