<?php
/**
 * Plugin Name: Disable boxes on Dashboard
 * Version: 1.0
 * Network: true
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Disable unecessary boxes on dashboard for all users.
 */

 // Disable boxes on dashboard
function remove_wpnews() {
	remove_meta_box( 'dashboard_primary', get_current_screen(), 'side' );
}
add_action( 'wp_network_dashboard_setup', 'remove_wpnews', 20 );
add_action( 'wp_user_dashboard_setup',    'remove_wpnews', 20 );
add_action( 'wp_dashboard_setup',         'remove_wpnews', 20 );

remove_action( 'welcome_panel', 'wp_welcome_panel' );