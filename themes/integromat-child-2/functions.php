<?php
define( 'INTEGROMAT_VERSION', 1.0 );

// Handle language
load_theme_textdomain('zoner', get_template_directory() . '/languages');

// Custom navwalker
require_once('modules/bs4navwalker.php');

// Theme support
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

// Register menu
register_nav_menus(
	array(
		'primary'	=>	__( 'Primary Menu', 'integromat' ),
	)
);

// Register Sidebar
function integromat_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => 'Sidebar',
		'description' => 'Take it on the side...',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="side-title">',
		'after_title' => '</h3>',
		'empty_title'=> '',
	));
}
add_action( 'widgets_init', 'integromat_register_sidebars' );

// Attach styles and scripts
function integromat_scripts()  {
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/assets/css/print.css', array(), INTEGROMAT_VERSION, 'print' );
	wp_enqueue_script( 'popper', get_stylesheet_directory_uri() . '/assets/js/popper.min.js', array(), INTEGROMAT_VERSION, true );
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array(), INTEGROMAT_VERSION, true );
	wp_enqueue_script( 'integromat', get_template_directory_uri() . '/assets/js/theme.min.js', array(), INTEGROMAT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'integromat_scripts' );