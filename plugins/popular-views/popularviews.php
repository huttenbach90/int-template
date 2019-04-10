<?php
/**
 * Plugin Name: Popular Views
 * Version: 1.0
 * Network: true
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Get and show the number of views.
 */

// show views number
function showViews($postID){
    $number_key = 'post_views';
    $number = get_post_meta($postID, $number_key, true);
    if($number==''){
        delete_post_meta($postID, $number_key);
        add_post_meta($postID, $number_key, '0');
        return "0 View";
    }
    return $number.' Views';
}

// get views
function setPostViews($postID) {
    $number_key = 'post_views';
    $number = get_post_meta($postID, $number_key, true);
    if($number==''){
        $number = 0;
        delete_post_meta($postID, $number_key);
        add_post_meta($postID, $number_key, '0');
    }else{
        $number++;
        update_post_meta($postID, $number_key, $number);
    }
}

// add a column into admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
 if($column_name === 'post_views'){
        echo showViews(get_the_ID());
    }
}