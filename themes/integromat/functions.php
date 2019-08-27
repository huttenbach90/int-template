<?php
define( 'INTEGROMAT_VERSION', 1.0 );

// Handle language
load_theme_textdomain('integromat', get_template_directory() . '/languages');

// Custom navwalker
require_once(get_template_directory() . '/modules/bs4navwalker.php');
require_once(get_template_directory() . '/modules/breadcrumbs.php');
// require_once(get_template_directory() . '/modules/query-network.php');

// Custom post types, custom fields and settings
require_once(get_template_directory() . '/includes/post-types.php');
require_once(get_template_directory() . '/includes/custom-taxonomy.php');
require_once(get_stylesheet_directory() . '/includes/custom-fields.php');

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

	// wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), INTEGROMAT_VERSION, true);
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), INTEGROMAT_VERSION, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), INTEGROMAT_VERSION, true );
	wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/js/theme.min.js' );

	if (is_page_template('page-solution-public.php')) {
		wp_enqueue_style( 'tinymce', get_template_directory_uri() . '/modules/tinymce/tinymce.min.css');
		wp_enqueue_script( 'tinymce', get_template_directory_uri() . '/modules/tinymce/tinymce.min.js');
	}
	if (is_page_template('page-solution.php') || is_page_template('page-solution-public.php')) {
		wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/modules/bootstrap-tokenfield/jquery-ui.min.css');
		wp_enqueue_style('tokenfield', get_template_directory_uri() . '/modules/bootstrap-tokenfield/bootstrap-tokenfield.min.css');
		wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/modules/bootstrap-tokenfield/jquery-ui.min.js');
		wp_enqueue_script('tokenfield', get_template_directory_uri() . '/modules/bootstrap-tokenfield/bootstrap-tokenfield.js');
	}
}
add_action( 'wp_enqueue_scripts', 'integromat_scripts' );

// Attach style into admin
function custom_admin_style(){
    wp_register_style( 'custom_admin_style', get_template_directory_uri() . '/assets/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_admin_style' );
}
add_action('admin_enqueue_scripts', 'custom_admin_style');

// Excerpt lenght
function excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 40;
}
add_filter( 'excerpt_length', 'excerpt_length', 999 );

// Excerpt end
function excerpt_change_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '&hellip;';
 }
 add_filter( 'excerpt_more', 'excerpt_change_more', 999 );

// Change search url
function new_query_var() {
    global $wp;
    $wp->add_query_var('msite');
}

add_filter('init', 'new_query_var');

// pagination
function misha_pagination( $query ) {  
	$args = array(
		'total' => $query->max_num_pages, 
		'current' => ( ( $query->query_vars['paged'] ) ? $query->query_vars['paged'] : 1 ), 
		'show_all' => false,
		'mid_size' => 1, 
		'end_size' => 1, 
		'prev_next' => true, 
		'prev_text' => '«', 
		'next_text' => '»' 
	);
 
	if( $args['total'] <= 1 ) 
		return;
 
	return '<div class="navigation">
		<span class="pages">Page ' . $args['current'] . ' of ' . $args['total'] . '</span>'
		. paginate_links( $args ) .  
		'</div>';   
}

add_filter( 'the_author_posts_link', function( $link ) {
    return str_replace( 'rel="author"', 'rel="author" class="no-decoration"', $link );
});