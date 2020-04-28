<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 */

if ( is_singular( 'portfolio' ) ) {
	$portfolio_pagination_enable = ot_get_option( 'portfolio_pagination_enable' );
	if ( $portfolio_pagination_enable == 'on' ) {
		echo juster_portfolio_anim_pagination();
	}
}

if ( ! is_404() && ! is_page_template( 'template-blank-page.php' ) && ! is_page_template( 'template-scroll-lock.php' ) ) { // !404 Page
global $post;
$menu_position               = ot_get_option( 'menu_position' );
$layout_model_ot             = ot_get_option( 'fullwidth_boxed' );
$layout_model_mt             = get_post_meta( get_the_ID(), 'page_model', true );
$content_inside_container_ot = ot_get_option( 'content_inside_container_ot' );
$content_inside_container_mt = get_post_meta( get_the_ID(), 'content_inside_container_mt', true );
if ( is_page() && ! is_page_template( 'template-one-page-architecture.php' ) ) {
	if ( $layout_model_mt === 'extra_width' && isset( $content_inside_container_mt[0] ) ) {
		echo '</div>';
	} elseif ( $layout_model_mt === 'extra_width' && ! isset( $content_inside_container_ot[0] ) ) {
		echo '';
	} elseif ( $layout_model_ot === 'extra-width' && ! isset( $content_inside_container_ot[0] ) ) {
		echo '</div>';
	} else {
	}
} elseif ( ! is_page() && ! is_post_type_archive( 'product' ) && ! is_product_category() ) {
	if ( $layout_model_ot === 'extra-width' && ! isset( $content_inside_container_ot[0] ) ) {
		echo '</div>';
	} else {
	}
}

if ( $menu_position == 'menu_pos_top_boxed' ) {
	echo '</div>'; // Boxed container class
}
if ( ! is_page_template( 'template-one-page-architecture.php' ) && $menu_position != 'menu_pos_top_boxed' ) {
	?>
    </div> <!-- End Container -->
<?php }
if ( ! is_page_template( 'template-one-page-architecture.php' ) && ! is_page_template( 'template-agency-home.php' ) ) {
	?>
    </div>
    </div> <!-- End Main Container -->
<?php }

global $post;
$layout_model_ot = ot_get_option( 'fullwidth_boxed' );
$layout_model_mt = get_post_meta( get_the_ID(), 'page_model', true );
if ( is_page() ) {
	if ( $layout_model_mt ) {
		if ( $layout_model_mt === 'full_width' ) {
			$layout_structure = 'container';
		} elseif ( $layout_model_mt === 'extra_width' ) {
			$layout_structure = 'container-fluid';
		} elseif ( $layout_model_ot === 'full-width' ) {
			$layout_structure = 'container';
		} elseif ( $layout_model_ot === 'extra-width' ) {
			$layout_structure = 'container-fluid padding-zero';
		} else {
			$layout_structure = 'container';
		}
	} elseif ( $layout_model_ot ) {
		if ( $layout_model_ot === 'full-width' ) {
			$layout_structure = 'container';
		} elseif ( $layout_model_ot === 'extra-width' ) {
			$layout_structure = 'container-fluid';
		} else {
			$layout_structure = 'container';
		}
	} else {
		$layout_structure = 'container';
	}
} elseif ( ! is_page() ) {
	if ( $layout_model_ot ) {
		if ( $layout_model_ot === 'full-width' ) {
			$layout_structure = 'container';
		} elseif ( $layout_model_ot === 'extra-width' ) {
			$layout_structure = 'container-fluid';
		} else {
			$layout_structure = 'container';
		}
	} else {
		$layout_structure = 'container-fluid';
	}
}

if ( $menu_position == 'menu_pos_left' ) {
	echo '</div>';
}
if ( is_single() && ! is_singular( 'portfolio' ) && ! is_singular( 'post' ) ) {
	echo juster_single_next_prev_posts();
}

$menu_position = ot_get_option( 'menu_position' );
if ( $menu_position == 'menu_pos_top_arch' ) {
	$footer_class = 'jt-footer-style-seven';
} elseif ( $menu_position == 'menu_pos_top_agency' ) {
	$footer_class = 'jt-footer-style-eight';
} elseif ( $menu_position == 'menu_pos_top_studio' ) {
	$footer_class = 'jt-footer-style-nine';
} elseif ( $menu_position == 'menu_pos_left_vintage' || $menu_position == 'menu_pos_right_vintage' ) {
	$footer_class = 'jt-footer-style-ten';
} elseif ( $menu_position == 'menu_pos_top_boxed' ) {
	$footer_class = '';
} else {
	$footer_class = '';
}

$footer_widget_extra_class = ot_get_option( 'footer_widget_extra_class' );
if ( $footer_widget_extra_class != '' ) {
	$footer_widget_extra_class = $footer_widget_extra_class;
} else {
	$footer_widget_extra_class = '';
}
$footer_extra_class = ot_get_option( 'footer_extra_class' );
if ( $footer_extra_class != '' ) {
	$footer_extra_class = $footer_extra_class;
} else {
	$footer_extra_class = '';
}

if ( ! is_page_template( 'template-one-page-architecture.php' ) ) { // ! Template One Page Architecture

if ( $menu_position == 'menu_pos_top_boxed' ) {
?>
<div class="container-fluid padding-zero foot-ctrl">
	<?php } elseif ( $menu_position == 'menu_pos_left_margin' ) { ?>
    <div class="foot-ctrl">
		<?php } elseif ( $menu_position == 'menu_pos_left' ) { ?>
        <div class="foot-ctrl right-cont-wrap">
			<?php } else { ?>
            <div class="<?php echo esc_attr( $layout_structure ); ?> padding-zero foot-ctrl">
				<?php } ?>
                <footer class="jt-footer-style-two <?php echo esc_attr( $footer_class ) . ' ' . esc_attr( $footer_widget_extra_class ) . ' ' . esc_attr( $footer_extra_class ); ?>">

                    <div class="<?php echo esc_attr( $layout_structure ); ?> padding-zero text-widget-holder">
                        <!-- Footer Widgets -->
						<?php
						$footer_enable = ot_get_option( 'footer_enable' );
						$menu_position = ot_get_option( 'menu_position' );
						if ( $footer_enable == 'on' && $menu_position != 'menu_pos_top_arch' ) {
							$footer_top_style = ot_get_option( 'footer_top_style' );
							if ( $footer_top_style != '' ) {
								echo '<div class="container padding-zero">';
								echo do_shortcode( $footer_top_style );
								echo '</div>';
							}

							$footer_widget = ot_get_option( 'footer_widget' );
							if ( $footer_widget == 'on' ) {
								$footer_widget_cols = ot_get_option( 'footer_widget_cols' );
								if ( $footer_widget_cols == 'footer_widget_one' ) {
									$footer_widget_main = 'jt_widget_count_one';
								} elseif ( $footer_widget_cols == 'footer_widget_two' ) {
									$footer_widget_main = 'jt_widget_count_two';
								} elseif ( $footer_widget_cols == 'footer_widget_three' ) {
									$footer_widget_main = 'jt_widget_count_three';
								} elseif ( $footer_widget_cols == 'footer_widget_four' ) {
									$footer_widget_main = 'jt_widget_count_four';
								} else {
									$footer_widget_main = '';
								}
								?>
                                <div class="container padding-zero">
                                    <div class="jt-widgets-area <?php echo $footer_widget_main; ?>">
										<?php
										$footer_widget_cols = ot_get_option( 'footer_widget_cols' );
										if ( $footer_widget_cols == 'footer_widget_one' ) {
											$footer_widget_cols = '1';
											$foot_cols          = '12';
										} elseif ( $footer_widget_cols == 'footer_widget_two' ) {
											$footer_widget_cols = '2';
											$foot_cols          = '6';
										} elseif ( $footer_widget_cols == 'footer_widget_three' ) {
											$footer_widget_cols = '3';
											$foot_cols          = '4';
										} elseif ( $footer_widget_cols == 'footer_widget_four' ) {
											$footer_widget_cols = '4';
											$foot_cols          = '3';
										}

										for ( $i = 1; $i <= $footer_widget_cols; $i ++ ) {
											?>
                                            <div class="col-lg-<?php echo esc_attr( $foot_cols ); ?> col-md-<?php echo esc_attr( $foot_cols ); ?> col-sm-<?php echo esc_attr( $foot_cols ); ?> <?php echo esc_attr( $footer_widget_extra_class ); ?>">
                                                <div class="widget">
                                                    <div class="jt-widget-content">
														<?php dynamic_sidebar( 'footer-' . $i ); ?>
                                                    </div>
                                                </div>
                                            </div>
										<?php } ?>

                                    </div>
                                </div>
							<?php }
						}
						// <!-- Footer Widgets -->
						// <!-- Footer Copyrights -->

						if ( ! is_page_template( 'template-one-page-architecture.php' ) ) {
							$footer_enable = ot_get_option( 'footer_enable' );
							$menu_position = ot_get_option( 'menu_position' );
							if ( $footer_enable == 'on' && $menu_position == 'menu_pos_top_arch' ) {
								?>
                                <div class="container padding-zero">
                                    <div class="col-sm-2 col-xs-12 padding-zero">
                                        <div class="jt-footer-contact">
											<?php dynamic_sidebar( 'arch-footer-left-widget' ); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-xs-12 padding-zero" style="min-height: 0px;">
										<?php
										$footer_enable    = ot_get_option( 'footer_enable' );
										$footer_top_style = ot_get_option( 'footer_top_style' );
										if ( $footer_enable == 'on' && $footer_top_style != '' && $menu_position == 'menu_pos_top_arch' ) {
											echo do_shortcode( $footer_top_style );
										}
										?>
                                    </div>
                                    <div class="col-sm-2 col-xs-12 padding-zero">
                                        <div class="jt-footer-contact  jt-align-right">
											<?php dynamic_sidebar( 'arch-footer-right-widget' ); ?>
                                        </div>
                                    </div>
                                </div>
							<?php }
						} ?>

                    </div>
                    <!-- Copyright Widget Area -->
					<?php
					$menu_position         = ot_get_option( 'menu_position' );
					$footer_copyright_type = ot_get_option( 'footer_copyright_type' );
					if ( $footer_copyright_type == 'footer_copy_one' && $menu_position != 'menu_pos_left_margin' && $menu_position != 'menu_pos_right_margin' && $menu_position != 'menu_pos_top_arch' ) {
						?>
						<?php
						$copyright_text = ot_get_option( 'copyright_text' );
						if ( $copyright_text ) { ?>
                            <div class="jt-copyright-area">
                                <div class="container">
									<?php echo do_shortcode( $copyright_text ); ?>
                                    <p><?php echo date( "Y" ); ?> AESTI SKINCARE OÜ</p>
                                </div>
                            </div>
						<?php }
					} elseif ( $footer_copyright_type == 'footer_copy_two' && $menu_position != 'menu_pos_left_margin' && $menu_position != 'menu_pos_right_margin' && $menu_position != 'menu_pos_top_arch' ) { ?>
                        <div class="jt-copyright-area text-right">
                            <div class="container">
                                <div class="col-lg-8 col-md-8 col-sm-8 padding-zero">
                                    <div class="jt-copy-widget">
										<?php dynamic_sidebar( 'footer-copy-style-wid' ); ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 padding-zero">
                                    <div class="jt-copyright-text">
										<?php
										$copyright_text = ot_get_option( 'copyright_text' );
										if ( $copyright_text ) {
											echo do_shortcode( $copyright_text );
										} ?>
                                        <p><?php echo date( "Y" ); ?> AESTI SKINCARE OÜ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php } elseif ( $footer_copyright_type == 'footer_copy_three' && $menu_position != 'menu_pos_left_margin' && $menu_position != 'menu_pos_right_margin' && $menu_position != 'menu_pos_top_arch' ) { ?>
                        <div class="jt-copyright-area text-left">
                            <div class="container">
                                <div class="col-lg-8 col-md-8 col-sm-8 padding-zero">
                                    <div class="jt-copyright-text">
										<?php
										$copyright_text = ot_get_option( 'copyright_text' );
										if ( $copyright_text ) {
											echo do_shortcode( $copyright_text );
										}
										?>
                                        <p>&copy; <?php echo date( "Y" ); ?> AESTI SKINCARE OÜ</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 padding-zero">
                                    <div class="jt-copy-widget">
										<?php dynamic_sidebar( 'footer-copy-style-wid' ); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php } ?>
                    <!-- Footer Copyrights -->
                </footer>
            </div>
			<?php
			} // ! Template One Page Architecture

			$menu_position = ot_get_option( 'menu_position' );
			if ( $menu_position == 'menu_pos_left_margin' || $menu_position == 'menu_pos_right_margin' ) {
				echo '</div>';
			}
			if ( $menu_position == 'menu_pos_left_vintage' || $menu_position == 'menu_pos_right_vintage' ) {
				echo '</div>';
			}
			if ( $menu_position == 'menu_pos_top_boxed' ) {
				echo '</div>'; // Boxed Wrapper
			}
			if ( $menu_position != 'menu_pos_left' || $menu_position != 'menu_pos_right' || $menu_position != 'menu_pos_left_margin' || $menu_position != 'menu_pos_right_margin' || $menu_position != 'menu_pos_top_boxed' ) {
				echo '</div>'; // End Wrapper
			}

			/* is-sticky Function */
			echo juster_is_sticky_enable_fun();
			/* Vintage Banner Image Slider */
			echo juster_vintage_banner_script();
			/* Main And Blog Banner Image Slisder */
			echo juster_banner_script_main_blog_portfolio();

			} // !404 Page

			wp_footer(); ?>
<script>
    (function($) {
        $(document).ready(() => {
            const bannerHeight = $('.slider-container').height();
            if (bannerHeight && bannerHeight <= 100) {
                $('#jt-first-section').css('padding-bottom', '100px');
            }
        });
    })(jQuery)
</script>
            </body>
            </html>
