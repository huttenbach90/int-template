<?php
/**
 * Plugin Name: Remove junk from headers
 * Version: 1.0
 * Network: true
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Removes the WordPress version number, shortlink, wlwmanifest link, emoticons etc. in header section automatically generated in template.
 */

 // Remove WP number
 function remove_wp_number() {
	return '';
}
add_filter('the_generator', 'remove_wp_number');

// Remove api.w.org link
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// Remove shortlink
remove_action( 'wp_head', 'wp_shortlink_wp_head');

// Remove wlwmanifest link
remove_action( 'wp_head', 'wlwmanifest_link');

// Remove emoji support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove comments feed
remove_action('wp_head', 'feed_links_extra', 3 );

// Remove meta generator
remove_action('wp_head', 'wp_generator');