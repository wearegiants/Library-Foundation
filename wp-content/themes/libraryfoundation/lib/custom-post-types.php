<?php

// Register Custom Post Type
function create_people() {

  $labels = array(
    'name'                => _x( 'People', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'People', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'People', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
    'all_items'           => __( 'All Items', 'text_domain' ),
    'view_item'           => __( 'View Item', 'text_domain' ),
    'add_new_item'        => __( 'Add New Person', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'edit_item'           => __( 'Edit Item', 'text_domain' ),
    'update_item'         => __( 'Update Item', 'text_domain' ),
    'search_items'        => __( 'Search Item', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'people', 'text_domain' ),
    'description'         => __( 'People involved with LFLA', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
    'taxonomies'          => array( 'category', 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'people', $args );

}

// Hook into the 'init' action
add_action( 'init', 'create_people', 0 );


function create_archive() {

    $labels = array(
        'name'                => _x( 'Archives', 'Post Type General Name', 'archives' ),
        'singular_name'       => _x( 'Archive', 'Post Type Singular Name', 'archives' ),
        'menu_name'           => __( 'Archive', 'archives' ),
        'parent_item_colon'   => __( 'Parent Item:', 'archives' ),
        'all_items'           => __( 'All Items', 'archives' ),
        'view_item'           => __( 'View Item', 'archives' ),
        'add_new_item'        => __( 'Add New Item', 'archives' ),
        'add_new'             => __( 'Add New', 'archives' ),
        'edit_item'           => __( 'Edit Item', 'archives' ),
        'update_item'         => __( 'Update Item', 'archives' ),
        'search_items'        => __( 'Search Item', 'archives' ),
        'not_found'           => __( 'Not found', 'archives' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'archives' ),
    );
    $args = array(
        'label'               => __( 'archive', 'archives' ),
        'description'         => __( 'Archive', 'archives' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'post-formats', ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'archive', $args );

}

// Hook into the 'init' action
add_action( 'init', 'create_archive', 0 );

add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video', 'audio' ) );

// functions.php

add_action( 'init', 'update_my_custom_type', 99 );

/**
 * update_my_custom_type
 *
 * @author  Joe Sexton <joe@webtipblog.com>
 */
function update_my_custom_type() {
    global $wp_post_types;

    if ( post_type_exists( 'product' ) ) {

        // exclude from search results
        $wp_post_types['product']->exclude_from_search = true;
    }
}


?>