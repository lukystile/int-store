<?php
/* ---------------------------------------------------------------------------
 * Create new post type: Portfolio
 * --------------------------------------------------------------------------- */
add_action( 'init', 'juster_portfolio_type', 1);

function juster_portfolio_type() {

    if ( function_exists( 'ot_get_option' ) ) {
        $portfolio_name = ot_get_option('portfolio_name', 'Portfolio');
        $portfolio_slug = ot_get_option('portfolio_slug', 'portfolio');
    } else {
        $portfolio_name = 'Portfolio';
        $portfolio_slug = 'portfolio';
    }

    $labels = array(
        'name' => $portfolio_name,
        'singular_name' => $portfolio_name,
        'add_new' => __( 'Add New ', 'juster-core' ). $portfolio_name,
        'add_new_item' => __( 'Add New Item', 'juster-core' ),
        'edit_item' => __( 'Edit Item', 'juster-core' ),
        'new_item' => __( 'New '. $portfolio_name .' Item', 'juster-core' ),
        'view_item' => __( 'View '. $portfolio_name .' Item', 'juster-core' ),
        'search_items' => __( 'Search in '. $portfolio_name .'', 'juster-core' ),
        'not_found' => __( 'No '. $portfolio_name .' found', 'juster-core' ),
        'not_found_in_trash' => __( 'No Items found in Trash', 'juster-core' ),
        'parent_item_colon' => __( 'Parent '. $portfolio_name .':', 'juster-core' ),
        'menu_name' => $portfolio_name,
    );

    $args = array(
        'menu_icon' => 'dashicons-portfolio',
        'labels' => $labels,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
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
        'rewrite' => array('slug' => $portfolio_slug),
        'capability_type' => 'post',
    );

    register_post_type( 'portfolio', $args );
}

// Register custom taxonomie
add_action( 'init', 'juster_create_portfolio_taxonomies', 0 );

function juster_create_portfolio_taxonomies()
{
// Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => __( 'Category', 'juster-core' ),
    'singular_name' => __( 'Category', 'juster-core' ),
    'search_items' =>  __( 'Search Categories', 'juster-core' ),
    'all_items' => __( 'All Categories', 'juster-core' ),
    'parent_item' => __( 'Parent Category', 'juster-core' ),
    'parent_item_colon' => __( 'Parent Category:', 'juster-core' ),
    'edit_item' => __( 'Edit Category', 'juster-core' ),
    'update_item' => __( 'Update Category', 'juster-core' ),
    'add_new_item' => __( 'Add New Category', 'juster-core' ),
    'new_item_name' => __( 'New Category Name', 'juster-core' ),
    'menu_name' => __( 'Categories', 'juster-core' ),
  );

  register_taxonomy('portfolio_category',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    ));
}

/**
 * Template file for portfolio
 */
add_filter( 'template_include', 'juster_include_template_function', 1 );
function juster_include_template_function( $template_path ) {
    if ( get_post_type() == 'portfolio' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-portfolio.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-portfolio.php';
            }
        }
    }
    return $template_path;
}

/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */
function juster_portfolio_edit_columns($columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = __('Title', 'juster-core' );
    $new_columns['thumbnail'] = __('Image', 'juster-core' );
    $new_columns['portfolio_category'] = __('Categories', 'juster-core' );
    $new_columns['portfolio_order'] = __('Order', 'juster-core' );
    $new_columns['date'] = __('Date', 'juster-core' );

    return $new_columns;
}
add_filter("manage_edit-portfolio_columns", "juster_portfolio_edit_columns");


/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function juster_manage_portfolio_columns( $column_name ) {
    global $post;

    switch ($column_name) {

        /* If displaying the 'Image' column. */
        case 'thumbnail':
            echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
        break;

        /* If displaying the 'Categories' column. */
        case 'portfolio_category' :

            $terms = get_the_terms( $post->ID, 'portfolio_category' );

            if ( !empty( $terms ) ) {

                $out = array();
                foreach ( $terms as $term ) {
                    $out[] = sprintf( '<a href="%s">%s</a>',
                        esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'portfolio_category' => $term->slug ), 'edit.php' ) ),
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'portfolio_category', 'display' ) )
                    );
                }
                /* Join the terms, separating them with a comma. */
                echo join( ', ', $out );
            }

            /* If no terms were found, output a default message. */
            else {
                echo '&macr;';
            }

            break;

            case "portfolio_order":
                echo $post->menu_order;
            break;

        /* Just break out of the switch statement for everything else. */
        default :
            break;
        break;

    }
}

// Add filter for portfolio custom column view
add_action('manage_portfolio_posts_custom_column', 'juster_manage_portfolio_columns', 10, 2);
?>