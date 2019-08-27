<?php
// Register Sidebars
function help_register_sidebars() {
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
		'id' => 'archive-header',
		'name' => 'Archive header',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h1 class="display-3">',
		'after_title' => '</h1>',
		'empty_title'=> '',
	));
	register_sidebar(array(
		'id' => 'sidebar-primary',
		'name' => 'Primary sidebar',
		'description' => __("Is on homepage", "integromat"),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empty_title'=> '',
	));
}
add_action( 'widgets_init', 'help_register_sidebars' );

// Register navigation menu
add_action( 'after_setup_theme', 'register_category_menu' );
function register_category_menu() {
  register_nav_menu( 'catnav', __( 'Category Menu', 'integromat' ) );
}

// Unset menu pages
function remove_menus() {
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=doc' );
	remove_menu_page('edit.php?post_type=tutorial');
	remove_menu_page('edit.php?post_type=external');
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