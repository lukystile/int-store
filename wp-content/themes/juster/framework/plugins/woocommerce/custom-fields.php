<?php

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

  global $woocommerce, $post;

  echo '<div class="options_group">';

    // Badges for Product
    woocommerce_wp_text_input(
        array(
            'id'          => '_badge_texts',
            'label'       => __( 'Product Badge', 'juster' ),
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product badge.', 'juster' )
        )
    );

    // Badge Text Color
    woocommerce_wp_text_input(
        array(
            'id'          => '_badge_color',
            'label'       => __( 'Text Color', 'juster' ),
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Enter your text color code.', 'juster' )
        )
    );

    // Badge Background Color
    woocommerce_wp_text_input(
        array(
            'id'          => '_badge_bg_color',
            'label'       => __( 'Background Color', 'juster' ),
            'placeholder' => '',
            'desc_tip'    => 'true',
            'description' => __( 'Enter your background color code.', 'juster' )
        )
    );

  echo '</div>';

}

// Save Datas
function woo_add_custom_general_fields_save( $post_id ){

    // Badges for Product
    $woocommerce_badge_texts = $_POST['_badge_texts'];
    if( !empty( $woocommerce_badge_texts ) ) {
        update_post_meta( $post_id, '_badge_texts', esc_attr( $woocommerce_badge_texts ) );
    } else {
        update_post_meta( $post_id, '_badge_texts', esc_attr( $woocommerce_badge_texts ) );
    }

    // Badge Text Color
    $woocommerce_badge_color = $_POST['_badge_color'];
    if( !empty( $woocommerce_badge_color ) ) {
        update_post_meta( $post_id, '_badge_color', esc_attr( $woocommerce_badge_color ) );
    } else {
        update_post_meta( $post_id, '_badge_color', esc_attr( $woocommerce_badge_color ) );
    }

    // Badge Text Color
    $woocommerce_badge_bg_color = $_POST['_badge_bg_color'];
    if( !empty( $woocommerce_badge_bg_color ) ) {
        update_post_meta( $post_id, '_badge_bg_color', esc_attr( $woocommerce_badge_bg_color ) );
    } else {
        update_post_meta( $post_id, '_badge_bg_color', esc_attr( $woocommerce_badge_bg_color ) );
    }

}
