<?php
/* ---------------------------------------------------------------------------
 * Create new post type: Team
 * --------------------------------------------------------------------------- */
function juster_team_post_type()
{
    $team_item_slug = 'team-slug';
    $labels = array(
        'name'                  => __('Team','juster-core'),
        'singular_name'         => __('Team','juster-core'),
        'add_new'               => __('Add New','juster-core'),
        'add_new_item'          => __('Add New Team','juster-core'),
        'edit_item'             => __('Edit Team','juster-core'),
        'new_item'              => __('New Team','juster-core'),
        'view_item'             => __('View Team','juster-core'),
        'search_items'          => __('Search Team','juster-core'),
        'not_found'             => __('No team found','juster-core'),
        'not_found_in_trash'    => __('No team found in Trash','juster-core'),
        'parent_item_colon'     => ''
      );

    $args = array(
        'labels'                => $labels,
        'menu_icon'             => 'dashicons-businessman',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'query_var'             => true,
        'capability_type'       => 'post',
        'hierarchical'          => true,
        'menu_position'         => 20,
        'rewrite'               => array( 'slug' => $team_item_slug, 'with_front'=>true ),
        'supports'              => array( 'title','editor','thumbnail', 'page-attributes' ),
    );

    register_post_type( 'team', $args );

    register_taxonomy( 'team_category', 'team', array(
        'hierarchical'          => true,
        'label'                 =>  __('Team Categories','juster-core'),
        'singular_label'        =>  __('Team Category','juster-core'),
        'rewrite'               => true,
        'query_var'             => true
    ));
}
add_action( 'init', 'juster_team_post_type', 1 );


/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */
function juster_team_edit_columns($columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = __('Title', 'juster-core' );
    $new_columns['thumbnail'] = __('Image', 'juster-core' );
    $new_columns['team_category'] = __('Categories', 'juster-core' );
    $new_columns['team_order'] = __('Order', 'juster-core' );
    $new_columns['date'] = __('Date', 'juster-core' );

    return $new_columns;
}
add_filter("manage_edit-team_columns", "juster_team_edit_columns");


/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function juster_manage_team_columns( $column_name ) {
    global $post;

    switch ($column_name) {

        /* If displaying the 'Image' column. */
        case 'thumbnail':
            echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
        break;

        /* If displaying the 'Categories' column. */
        case 'team_category' :

            $terms = get_the_terms( $post->ID, 'team_category' );

            if ( !empty( $terms ) ) {

                $out = array();
                foreach ( $terms as $term ) {
                    $out[] = sprintf( '<a href="%s">%s</a>',
                        esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'team_category' => $term->slug ), 'edit.php' ) ),
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'team_category', 'display' ) )
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

            case "team_order":
                echo $post->menu_order;
            break;

        /* Just break out of the switch statement for everything else. */
        default :
            break;
        break;

    }
}

// Add filter for team custom column view
add_action('manage_team_posts_custom_column', 'juster_manage_team_columns', 10, 2);
?>