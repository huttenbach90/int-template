<?php
define( 'INTEGROMAT_VERSION', 1.0 );

// Handle language
load_theme_textdomain('integromat', get_template_directory() . '/languages');

// Custom navwalker
require_once(get_template_directory() . '/modules/bs4navwalker.php');
require_once(get_template_directory() . '/modules/breadcrumbs.php');
// require_once(get_template_directory() . '/modules/query-network.php');

// Custom post types, custom fields and settings
require_once(get_stylesheet_directory() . '/includes/post-types.php');
require_once(get_stylesheet_directory() . '/includes/custom-fields.php');
require_once(get_stylesheet_directory() . '/includes/custom-taxonomy.php');

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
		'name' => 'Sidebar in posts',
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
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . "/assets/css/bootstrap.min.css");
    wp_enqueue_style( 'all-min-style', get_template_directory_uri() . "/assets/css/all.min.css");
	wp_enqueue_style( 'public-style', get_template_directory_uri() . "/assets/css/public.v2.css");
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . "/assets/css/themes.v2.css" );
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . "/assets/css/custom.css");
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'responsive-style', get_template_directory_uri() . "/assets/css/responsive.css");
    wp_enqueue_style( 'print-style', get_template_directory_uri() . '/assets/css/print.css', array(), INTEGROMAT_VERSION, 'print' );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), INTEGROMAT_VERSION, true);
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), INTEGROMAT_VERSION, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), INTEGROMAT_VERSION, true );
	wp_enqueue_script( 'integromat', get_template_directory_uri() . '/assets/js/theme.min.js', array(), INTEGROMAT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'integromat_scripts' );

// Excerpt
function excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 40;
}
add_filter( 'excerpt_length', 'excerpt_length', 999 );

function wpshout_change_and_link_excerpt( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '&hellip;';
 }
 add_filter( 'excerpt_more', 'wpshout_change_and_link_excerpt', 999 );