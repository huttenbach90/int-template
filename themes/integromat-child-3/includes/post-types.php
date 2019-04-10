<?php
if ( ! function_exists('external_post_type') ) {

    // Register Community-Given Solutions post type
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
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
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

    // Register FAQ post type
    function faq_post_type() {

        $labels = array(
            'name'                  => _x( 'FAQs', 'Post Type General Name', 'integromat' ),
            'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'integromat' ),
            'menu_name'             => __( 'FAQs', 'integromat' ),
            'name_admin_bar'        => __( 'FAQs', 'integromat' ),
            'archives'              => __( 'FAQ Archives', 'integromat' ),
            'attributes'            => __( 'FAQ Attributes', 'integromat' ),
            'parent_item_colon'     => __( 'Parent FAQ:', 'integromat' ),
            'all_items'             => __( 'All FAQs', 'integromat' ),
            'add_new_item'          => __( 'Add New FAQ', 'integromat' ),
            'add_new'               => __( 'Add New', 'integromat' ),
            'new_item'              => __( 'New FAQ', 'integromat' ),
            'edit_item'             => __( 'Edit FAQ', 'integromat' ),
            'update_item'           => __( 'Update FAQ', 'integromat' ),
            'view_item'             => __( 'View FAQ', 'integromat' ),
            'view_items'            => __( 'View FAQs', 'integromat' ),
            'search_items'          => __( 'Search FAQ', 'integromat' ),
            'not_found'             => __( 'Not found', 'integromat' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'integromat' ),
            'featured_image'        => __( 'Featured Image', 'integromat' ),
            'set_featured_image'    => __( 'Set featured image', 'integromat' ),
            'remove_featured_image' => __( 'Remove featured image', 'integromat' ),
            'use_featured_image'    => __( 'Use as featured image', 'integromat' ),
            'insert_into_item'      => __( 'Insert into course', 'integromat' ),
            'uploaded_to_this_item' => __( 'Uploaded to this course', 'integromat' ),
            'items_list'            => __( 'FAQs list', 'integromat' ),
            'items_list_navigation' => __( 'FAQs list navigation', 'integromat' ),
            'filter_items_list'     => __( 'Filter courses list', 'integromat' ),
        );
        $rewrite = array(
            'slug'                  => 'faq',
            'with_front'            => false,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'FAQ', 'integromat' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'revisions' ),
            'show_in_rest'          => true,
            'taxonomies'            => array( 'post_tag' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-editor-help',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'faq',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'faq', $args );

    }
    add_action( 'init', 'faq_post_type', 0 );

}
?>