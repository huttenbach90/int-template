<?php
// Register Level Taxonomy
function level() {
	$labels = array(
		'name'                       => _x( 'Levels', 'Taxonomy General Name', 'integromat' ),
		'singular_name'              => _x( 'Level', 'Taxonomy Singular Name', 'integromat' ),
		'menu_name'                  => __( 'Levels', 'integromat' ),
		'all_items'                  => __( 'All Levels', 'integromat' ),
		'parent_item'                => __( 'Parent Level', 'integromat' ),
		'parent_item_colon'          => __( 'Parent Level:', 'integromat' ),
		'new_item_name'              => __( 'New Level Name', 'integromat' ),
		'add_new_item'               => __( 'Add New Level', 'integromat' ),
		'edit_item'                  => __( 'Edit Level', 'integromat' ),
		'update_item'                => __( 'Update Level', 'integromat' ),
		'view_item'                  => __( 'View Level', 'integromat' ),
		'separate_items_with_commas' => __( 'Separate levels with commas', 'integromat' ),
		'add_or_remove_items'        => __( 'Add or remove levels', 'integromat' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'integromat' ),
		'popular_items'              => __( 'Popular Levels', 'integromat' ),
		'search_items'               => __( 'Search Levels', 'integromat' ),
		'not_found'                  => __( 'Not Found', 'integromat' ),
		'no_terms'                   => __( 'No levels', 'integromat' ),
		'items_list'                 => __( 'Levels list', 'integromat' ),
		'items_list_navigation'      => __( 'Levels list navigation', 'integromat' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
	);
	register_taxonomy( 'level', array( 'course' ), $args );
}
add_action( 'init', 'level', 0 );