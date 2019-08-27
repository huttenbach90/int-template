<?php

// Register Community-Given Solutions post type
if ( ! function_exists('external_post_type') ) {
    function external_post_type() {
        $labels = array(
            'name'                  => _x( 'C-G Solutions', 'Post Type General Name', 'integromat' ),
            'singular_name'         => _x( 'C-G Solution', 'Post Type Singular Name', 'integromat' ),
            'menu_name'             => __( 'C-G Solutions', 'integromat' ),
            'name_admin_bar'        => __( 'C-G Solutions', 'integromat' ),
            'archives'              => __( 'C-G Solution Archives', 'integromat' ),
            'attributes'            => __( 'C-G Solution Attributes', 'integromat' ),
            'parent_item_colon'     => __( 'Parent C-G Solution:', 'integromat' ),
            'all_items'             => __( 'All C-G Solutions', 'integromat' ),
            'add_new_item'          => __( 'Add New C-G Solution', 'integromat' ),
            'add_new'               => __( 'Add New', 'integromat' ),
            'new_item'              => __( 'New C-G Solution', 'integromat' ),
            'edit_item'             => __( 'Edit C-G Solution', 'integromat' ),
            'update_item'           => __( 'Update C-G Solution', 'integromat' ),
            'view_item'             => __( 'View C-G Solution', 'integromat' ),
            'view_items'            => __( 'View C-G Solutions', 'integromat' ),
            'search_items'          => __( 'Search C-G Solution', 'integromat' ),
            'not_found'             => __( 'Not found', 'integromat' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'integromat' ),
            'featured_image'        => __( 'Featured Image', 'integromat' ),
            'set_featured_image'    => __( 'Set featured image', 'integromat' ),
            'remove_featured_image' => __( 'Remove featured image', 'integromat' ),
            'use_featured_image'    => __( 'Use as featured image', 'integromat' ),
            'insert_into_item'      => __( 'Insert into course', 'integromat' ),
            'uploaded_to_this_item' => __( 'Uploaded to this course', 'integromat' ),
            'items_list'            => __( 'C-G Solutions list', 'integromat' ),
            'items_list_navigation' => __( 'C-G Solutions list navigation', 'integromat' ),
            'filter_items_list'     => __( 'Filter courses list', 'integromat' ),
        );
        $rewrite = array(
            'slug'                  => 'ext',
            'with_front'            => false,
        );
        $args = array(
            'label'                 => __( 'C-G Solutions', 'integromat' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'author' ),
            'show_in_rest'          => true,
            'taxonomies'            => array( 'post_tag' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-groups',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'external',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'external', $args );
    }
    add_action( 'init', 'external_post_type', 0 );
}

// Register Tutorials post type
if ( ! function_exists('tutorial_post_type') ) {
    function tutorial_post_type() {
        $labels = array(
            'name'                  => _x( 'Tutorials', 'Post Type General Name', 'integromat' ),
            'singular_name'         => _x( 'Tutorial', 'Post Type Singular Name', 'integromat' ),
            'menu_name'             => __( 'Tutorials', 'integromat' ),
            'name_admin_bar'        => __( 'Tutorials', 'integromat' ),
            'archives'              => __( 'Tutorial Archives', 'integromat' ),
            'attributes'            => __( 'Tutorial Attributes', 'integromat' ),
            'parent_item_colon'     => __( 'Parent Tutorial:', 'integromat' ),
            'all_items'             => __( 'All Tutorials', 'integromat' ),
            'add_new_item'          => __( 'Add New Tutorial', 'integromat' ),
            'add_new'               => __( 'Add New', 'integromat' ),
            'new_item'              => __( 'New Tutorial', 'integromat' ),
            'edit_item'             => __( 'Edit Tutorial', 'integromat' ),
            'update_item'           => __( 'Update Tutorial', 'integromat' ),
            'view_item'             => __( 'View Tutorial', 'integromat' ),
            'view_items'            => __( 'View Tutorials', 'integromat' ),
            'search_items'          => __( 'Search Tutorial', 'integromat' ),
            'not_found'             => __( 'Not found', 'integromat' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'integromat' ),
            'featured_image'        => __( 'Featured Image', 'integromat' ),
            'set_featured_image'    => __( 'Set featured image', 'integromat' ),
            'remove_featured_image' => __( 'Remove featured image', 'integromat' ),
            'use_featured_image'    => __( 'Use as featured image', 'integromat' ),
            'insert_into_item'      => __( 'Insert into course', 'integromat' ),
            'uploaded_to_this_item' => __( 'Uploaded to this course', 'integromat' ),
            'items_list'            => __( 'Tutorials list', 'integromat' ),
            'items_list_navigation' => __( 'Tutorials list navigation', 'integromat' ),
            'filter_items_list'     => __( 'Filter courses list', 'integromat' ),
        );
        $rewrite = array(
            'slug'                  => 'tutorial',
            'with_front'            => false,
        );
        $args = array(
            'label'                 => __( 'Tutorials', 'integromat' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
            'show_in_rest'          => true,
            'taxonomies'            => array( 'post_tag' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-welcome-learn-more',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'tutorial',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'tutorial', $args );
    }
    add_action( 'init', 'tutorial_post_type', 0 );
}

?>