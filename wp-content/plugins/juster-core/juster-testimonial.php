<?php
/* ---------------------------------------------------------------------------
 * Create new post type: Testimonial
 * --------------------------------------------------------------------------- */
add_action( 'init', 'juster_testimonial_type', 1 );

function juster_testimonial_type() {

    $testimonial_name = 'Testimonial';
    $testimonial_slug = 'testimonial';


    $labels = array(
        'name' => __( $testimonial_name, 'juster-core' ),
        'singular_name' => __( $testimonial_name, 'juster-core' ),
        'add_new' => __( 'Add New '. $testimonial_name .'', 'juster-core' ),
        'add_new_item' => __( 'Add New Item', 'juster-core' ),
        'edit_item' => __( 'Edit Item', 'juster-core' ),
        'new_item' => __( 'New '. $testimonial_name .' Item', 'juster-core' ),
        'view_item' => __( 'View '. $testimonial_name .' Item', 'juster-core' ),
        'search_items' => __( 'Search in '. $testimonial_name .'', 'juster-core' ),
        'not_found' => __( 'No '. $testimonial_name .' found', 'juster-core' ),
        'not_found_in_trash' => __( 'No Items found in Trash', 'juster-core' ),
        'parent_item_colon' => __( 'Parent '. $testimonial_name .':', 'juster-core' ),
        'menu_name' => __( ''. $testimonial_name .'', 'juster-core' ),
    );

    $args = array(
        'menu_icon' => 'dashicons-format-status',
        'labels' => $labels,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor','thumbnail', 'page-attributes'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => $testimonial_slug),
        'capability_type' => 'post',
    );

    register_post_type( 'testimonial', $args );
}

/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */
function juster_testimonial_edit_columns($columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = __('Title', 'juster-core' );
    $new_columns['thumbnail'] = __('Image', 'juster-core' );
    $new_columns['testimonial_order'] = __('Order', 'juster-core' );
    $new_columns['date'] = __('Date', 'juster-core' );

    return $new_columns;
}
add_filter("manage_edit-testimonial_columns", "juster_testimonial_edit_columns");


/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function juster_manage_testimonial_columns( $column_name ) {
    global $post;

    switch ($column_name) {

        /* If displaying the 'Image' column. */
        case 'thumbnail':
            echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
        break;

        case "testimonial_order":
            echo $post->menu_order;
        break;

        /* Just break out of the switch statement for everything else. */
        default :
            break;
        break;

    }
}

// Add filter for testimonial custom column view
add_action('manage_testimonial_posts_custom_column', 'juster_manage_testimonial_columns', 10, 2);
?>