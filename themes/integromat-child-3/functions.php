<?php

// Rename Posts to Docs
function post_to_docs() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Docs';
    $submenu['edit.php'][5][0] = 'Docs';
    $submenu['edit.php'][10][0] = 'Add Doc';
}
function post_to_docs_lang() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Docs';
    $labels->singular_name = 'Doc';
    $labels->add_new = 'Add Doc';
    $labels->add_new_item = 'Add Doc';
    $labels->edit_item = 'Edit Doc';
    $labels->new_item = 'Doc';
    $labels->view_item = 'View Doc';
    $labels->search_items = 'Search Docs';
    $labels->not_found = 'No Doc found';
    $labels->not_found_in_trash = 'No Doc found in Trash';
    $labels->all_items = 'All Docs';
    $labels->menu_name = 'Docs';
    $labels->name_admin_bar = 'Docs';
}
add_action( 'admin_menu', 'post_to_docs' );
add_action( 'init', 'post_to_docs_lang' );

// Get rid of post (docs) categories
function disable_categories() {
    unregister_taxonomy_for_object_type( 'category', 'post' );
}
add_action( 'init', 'disable_categories' );

// Register Sidebars
function help_register_sidebars() {
	register_sidebar(array(
		'id' => 'homepage-content',
		'name' => 'Homepage Content',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> '',
	));
	register_sidebar(array(
		'id' => 'homepage-aside',
		'name' => 'Homepage Aside',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> '',
  ));
  register_sidebar(array(
		'id' => 'contact-stripe',
		'name' => 'Contact stripe',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> '',
  ));
  register_sidebar(array(
		'id' => 'bottom',
		'name' => 'Bottom',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> '',
	));
	register_sidebar(array(
		'id' => 'archive-external',
		'name' => 'Archive external header',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h1 class="display-3">',
		'after_title' => '</h1>',
		'empty_title'=> '',
	));
}
add_action( 'widgets_init', 'help_register_sidebars' );

// Unset menu pages
function remove_menus() {
	remove_menu_page('edit.php?post_type=tutorial');
	remove_menu_page('edit.php?post_type=sfwd-courses');
}
add_action( 'admin_menu', 'remove_menus' );

// Get rid of LearnDash LMS
add_action('admin_head', 'remove_learndash_lms');
function remove_learndash_lms() {
  echo '<style>
		#toplevel_page_learndash-lms {
			display: none;
		}
  </style>';
}