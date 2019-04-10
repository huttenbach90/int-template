<?php
/**
 * Plugin Name: Terms Share
 * Version: 1.0
 * Network: true
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Share all terms global through the sites of multisite.
 */

 // Terms share
add_action( 'init', 'terms_share', 0 );
add_action( 'switch_blog', 'terms_share', 0 );

function terms_share(){
    global $wpdb;
    $wpdb->terms = $wpdb->base_prefix . 'terms';
    $wpdb->term_taxonomy = $wpdb->base_prefix . 'term_taxonomy';
}