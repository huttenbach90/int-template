<?php
// Hide Posts
function remove_menus() {
	remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'remove_menus' );

// Get rid of Topics, Assignments, Groups (LearnDash)
add_action('admin_head', 'remove_post_types');
function remove_post_types() {
  echo '<style>
		#toplevel_page_learndash-lms .wp-submenu li:nth-child(4),
		#toplevel_page_learndash-lms .wp-submenu li:nth-child(5),
		#toplevel_page_learndash-lms .wp-submenu li:nth-child(6),
		#toplevel_page_learndash-lms .wp-submenu li:nth-child(8),
		#toplevel_page_learndash-lms .wp-submenu li:nth-child(9) {
			display: none;
		}
  </style>';
}

// Move "above" type metabox above editor
function move_metabox() {
	global $post, $wp_meta_boxes;
	do_meta_boxes( get_current_screen(), 'above', $post );
	unset($wp_meta_boxes['post']['above']);
}
add_action('edit_form_after_title', 'move_metabox');

// Get rid of C-G Solutions
function delete_post_type(){
    unregister_post_type( 'external' );
}
add_action('init','delete_post_type');

// Register Sidebars
function academy_register_sidebars() {
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
		'id' => 'archive-courses',
		'name' => 'Archive courses header',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h1 class="display-3">',
		'after_title' => '</h1>',
		'empty_title'=> '',
	));
	register_sidebar(array(
		'id' => 'lessons',
		'name' => 'Lessons',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		'empy_title' => '',
	));
}
add_action( 'widgets_init', 'academy_register_sidebars' );
?>