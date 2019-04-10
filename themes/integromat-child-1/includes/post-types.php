<?php
if ( ! function_exists('course_post_type') ) {

    // Register Custom Post Type
    function course_post_type() {

        $labels = array(
            'name'                  => _x( 'Courses', 'Post Type General Name', 'integromat' ),
            'singular_name'         => _x( 'Course', 'Post Type Singular Name', 'integromat' ),
            'menu_name'             => __( 'Courses', 'integromat' ),
            'name_admin_bar'        => __( 'Courses', 'integromat' ),
            'archives'              => __( 'Course Archives', 'integromat' ),
            'attributes'            => __( 'Course Attributes', 'integromat' ),
            'parent_item_colon'     => __( 'Parent Course:', 'integromat' ),
            'all_items'             => __( 'All courses', 'integromat' ),
            'add_new_item'          => __( 'Add New Course', 'integromat' ),
            'add_new'               => __( 'Add New', 'integromat' ),
            'new_item'              => __( 'New Course', 'integromat' ),
            'edit_item'             => __( 'Edit Course', 'integromat' ),
            'update_item'           => __( 'Update Course', 'integromat' ),
            'view_item'             => __( 'View Course', 'integromat' ),
            'view_items'            => __( 'View Courses', 'integromat' ),
            'search_items'          => __( 'Search Course', 'integromat' ),
            'not_found'             => __( 'Not found', 'integromat' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'integromat' ),
            'featured_image'        => __( 'Featured Image', 'integromat' ),
            'set_featured_image'    => __( 'Set featured image', 'integromat' ),
            'remove_featured_image' => __( 'Remove featured image', 'integromat' ),
            'use_featured_image'    => __( 'Use as featured image', 'integromat' ),
            'insert_into_item'      => __( 'Insert into course', 'integromat' ),
            'uploaded_to_this_item' => __( 'Uploaded to this course', 'integromat' ),
            'items_list'            => __( 'Courses list', 'integromat' ),
            'items_list_navigation' => __( 'Courses list navigation', 'integromat' ),
            'filter_items_list'     => __( 'Filter courses list', 'integromat' ),
        );
        $rewrite = array(
            'slug'                  => 'course',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $args = array(
            'label'                 => __( 'Course', 'integromat' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ),
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
            'has_archive'           => 'course',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
        );
        register_post_type( 'course', $args );

    }
    add_action( 'init', 'course_post_type', 0 );

}
?>