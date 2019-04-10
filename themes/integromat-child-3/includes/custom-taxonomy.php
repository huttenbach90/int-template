<?php
// Register Doc Category Taxonomy
function doc_category() {
	$labels = array(
		'name'                       => _x( 'Doc Categories', 'Taxonomy General Name', 'integromat' ),
		'singular_name'              => _x( 'Doc Category', 'Taxonomy Singular Name', 'integromat' ),
		'menu_name'                  => __( 'Doc Categories', 'integromat' ),
		'all_items'                  => __( 'All Doc Categories', 'integromat' ),
		'parent_item'                => __( 'Parent Doc Category', 'integromat' ),
		'parent_item_colon'          => __( 'Parent Doc Category:', 'integromat' ),
		'new_item_name'              => __( 'New Doc Category Name', 'integromat' ),
		'add_new_item'               => __( 'Add New Doc Category', 'integromat' ),
		'edit_item'                  => __( 'Edit Doc Category', 'integromat' ),
		'update_item'                => __( 'Update Doc Category', 'integromat' ),
		'view_item'                  => __( 'View Doc Category', 'integromat' ),
		'separate_items_with_commas' => __( 'Separate Doc Categories with commas', 'integromat' ),
		'add_or_remove_items'        => __( 'Add or remove Doc Categories', 'integromat' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'integromat' ),
		'popular_items'              => __( 'Popular Doc Categories', 'integromat' ),
		'search_items'               => __( 'Search Doc Categories', 'integromat' ),
		'not_found'                  => __( 'Not Found', 'integromat' ),
		'no_terms'                   => __( 'No Doc Categories', 'integromat' ),
		'items_list'                 => __( 'Doc Categories list', 'integromat' ),
		'items_list_navigation'      => __( 'Doc Categories list navigation', 'integromat' ),
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
		'rewrite'					 => array('slug' => 'docs', 'with_front' => false),
	);
	register_taxonomy( 'doc', array( 'post' ), $args );
}
add_action( 'init', 'doc_category', 0 );