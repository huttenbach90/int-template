<?php

// Rename Posts to Tutorials
function posts_to_tutorials() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Tutorials';
    $submenu['edit.php'][5][0] = 'Tutorials';
    $submenu['edit.php'][10][0] = 'Add Tutorial';
    $submenu['edit.php'][16][0] = 'Tags';
}
function posts_to_tutorials_lang() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Tutorials';
    $labels->singular_name = 'Tutorial';
    $labels->add_new = 'Add Tutorial';
    $labels->add_new_item = 'Add Tutorial';
    $labels->edit_item = 'Edit Tutorial';
    $labels->new_item = 'Tutorial';
    $labels->view_item = 'View Tutorial';
    $labels->search_items = 'Search Tutorials';
    $labels->not_found = 'No Tutorial found';
    $labels->not_found_in_trash = 'No Tutorial found in Trash';
    $labels->all_items = 'All Tutorials';
    $labels->menu_name = 'Tutorials';
    $labels->name_admin_bar = 'Tutorials';
}
add_action( 'admin_menu', 'posts_to_tutorials' );
add_action( 'init', 'posts_to_tutorials_lang' );

// Move "above" type metabox above editor
function move_metabox() {
	global $post, $wp_meta_boxes;
	do_meta_boxes( get_current_screen(), 'above', $post );
	unset($wp_meta_boxes['post']['above']);
}
add_action('edit_form_after_title', 'move_metabox');