<?php
/**
 * Plugin Name: Disable REST API
 * Version: 1.0
 * Network: true
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Disable REST API for non-logged users.
 */

// Disable REST API for non-logged users
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
});