<?php
/* ---------------------------------------------------------------------------
 * Create new post type: Scroll Lock
 * --------------------------------------------------------------------------- */
add_action( 'init', 'juster_scroll_lock', 1 );

function juster_scroll_lock() {

    $labels = array(
        'name' => __( 'Scroll Section', 'juster' ),
        'singular_name' => __( 'Scroll Section', 'juster' ),
        'add_new' => __( 'Add Scroll Section', 'juster' ),
        'add_new_item' => __( 'Add New Item', 'juster' ),
        'edit_item' => __( 'Edit Item', 'juster' ),
        'new_item' => __( 'New Scroll Section', 'juster' ),
        'view_item' => __( 'View Scroll Section', 'juster' ),
        'search_items' => __( 'Search in Scroll Section', 'juster' ),
        'not_found' => __( 'No Scroll Section', 'juster' ),
        'not_found_in_trash' => __( 'No Items found in Trash', 'juster' ),
        'parent_item_colon' => __( 'Parent Scroll Section', 'juster' ),
        'menu_name' => __( 'Scroll Section', 'juster' ),
    );

    $args = array(
        'menu_icon' => 'dashicons-images-alt',
        'labels' => $labels,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'page-attributes'),
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
        'rewrite' => array('slug' => 'scroll-section'),
        'capability_type' => 'post',
    );

    register_post_type( 'scroll_lock', $args );
}

// Register custom taxonomie
add_action( 'init', 'juster_create_scroll_lock_taxonomies', 0 );

function juster_create_scroll_lock_taxonomies()
{
// Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => __( 'Category', 'juster' ),
    'singular_name' => __( 'Category', 'juster' ),
    'search_items' =>  __( 'Search Categories', 'juster' ),
    'all_items' => __( 'All Categories', 'juster' ),
    'parent_item' => __( 'Parent Category', 'juster' ),
    'parent_item_colon' => __( 'Parent Category:', 'juster' ),
    'edit_item' => __( 'Edit Category', 'juster' ),
    'update_item' => __( 'Update Category', 'juster' ),
    'add_new_item' => __( 'Add New Category', 'juster' ),
    'new_item_name' => __( 'New Category Name', 'juster' ),
    'menu_name' => __( 'Categories', 'juster' ),
  );

  register_taxonomy('scroll_lock_category',array('scroll_lock'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    ));
}

/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */
function juster_scroll_lock_edit_columns($columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = __('Title', 'juster' );
    $new_columns['scroll_lock_category'] = __('Categories', 'juster' );
    $new_columns['scroll_lock_order'] = __('Order', 'juster' );
    $new_columns['date'] = __('Date', 'juster' );

    return $new_columns;
}
add_filter("manage_edit-scroll_lock_columns", "juster_scroll_lock_edit_columns");

/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function juster_manage_scroll_lock_columns( $column_name ) {
    global $post;

    switch ($column_name) {

        /* If displaying the 'Categories' column. */
        case 'scroll_lock_category' :

        $terms = get_the_terms( $post->ID, 'scroll_lock_category' );

        if ( !empty( $terms ) ) {

            $out = array();
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a href="%s">%s</a>',
                    esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'scroll_lock_category' => $term->slug ), 'edit.php' ) ),
                    esc_attr( sanitize_term_field( 'name', $term->name, $term->term_id, 'scroll_lock_category', 'display' ) )
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

        case "scroll_lock_order":
            echo $post->menu_order;
        break;

        /* Just break out of the switch statement for everything else. */
        default :
            break;
        break;

    }
}

// Add filter for scroll_lock custom column view
add_action('manage_scroll_lock_posts_custom_column', 'juster_manage_scroll_lock_columns', 10, 2);

// Help Tab
function scroll_lock_help_tab() {
    global $post_ID;
    $screen = get_current_screen();

    if( isset($_GET['post_type']) ) $post_type = $_GET['post_type'];
    else $post_type = get_post_type( $post_ID );

    if( $post_type == 'scroll_lock' ) :

        $screen->add_help_tab( array(
            'id' => 'how_it_works_slock', // unique id for the tab
            'title' => __('How to Work?', 'juster'), // unique visible title for the second tab
            'content' => __('<h3>How to Work?</h3><p>To Create a Scroll Section Page, please create a page with <strong>Page Template : Scroll Sections</strong>. If you select that page template then you can get some extra related options of listing that each section. You can see that related options are under main content area of meta boxes.</p>', 'juster'), //actual help text
        ));

        $screen->add_help_tab( array(
            'id' => 'jt_slock_custom_class', // unique id for the second tab
            'title' => __('Custom Class', 'juster'), // unique visible title for the second tab
            'content' => '<h3>Custom Classes : </h3><p>Please read carefully for better understanding of, How Section Classes are Works?</p>
            <h4>First Step :</h4>
            <ol>
                <li><strong>margin-bottom-zero</strong> : This class will remove all bottom space in row & inside column shortcodes. <strong>Please use this class in Row Extra Class field.</strong></li>
            </ol>

            <h4>Second Step (Images Alignment) : <strong>Please use following classes in Page Builder\'s - Single Image Shortcode - Extra Class field.</strong></h4>
            <ol>
                <li><strong>jt-img-btm-fit</strong> : This class is for align image at bottom, without no spaces.</li>
                <li><strong>jt-img-top-fit</strong> : This class is for align image at top, without no spaces.</li>
                <li><strong>jt-img-left-space</strong> : This class is for align image at left, with less space.</li>
                <li><strong>jt-img-left-space-large</strong> : This class is for align image at left, with large space.</li>
                <li><strong>jt-img-right-space</strong> : This class is for align image at right, with less space.</li>
                <li><strong>jt-img-right-space-large</strong> : This class is for align image at right, with large space.</li>
            </ol>

            <h4>Third Step (Content Alignment) : <strong>Please use following classes in Column Extra Class field.</strong></h4>
            <ol>
                <li><strong>jt-scrl-cnt-space-left</strong> : This class is for align contents inside that columns, with top and left spaces(Recommended : Small Content).</li>
                <li><strong>jt-scrl-cnt-space-left-two</strong> : This class is for align contents inside that columns, with top and left spaces(Recommended : Large Content).</li>
                <li><strong>jt-scrl-cnt-space-left-three</strong> : This class is for align contents inside that columns, with top and left spaces(Recommended : Medium Content).</li>
                <li><strong>jt-scrl-cnt-space-right</strong> : This class is for align contents inside that columns, with top and right spaces(Recommended : Medium Content).</li>
                <li><strong>jt-scrl-cnt-space-right-two</strong> : This class is for align contents inside that columns, with top and right spaces(Recommended : Small Content).</li>
            </ol>', //actual help text
        ));

    endif;

}

add_action('admin_head', 'scroll_lock_help_tab');
