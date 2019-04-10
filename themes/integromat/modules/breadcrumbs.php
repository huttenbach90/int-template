<?php
// Breadcrumbs
function custom_breadcrumbs() {
    // Settings
    $separator          = ' <i class="fal fa-angle-right mx-2"></i> ';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';

    $custom_taxonomy    = 'doc';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<div id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<a class="" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a>';
        echo $separator;

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            echo '<span class="current">' . post_type_archive_title($prefix, false) . '</span>';
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a>';
                echo $separator;
            }
            $custom_tax_name = get_queried_object()->name;
            echo '<a href="' . home_url() . '/documentation/">Documentation</a> ' . $separator . ' <span class="current">' . $custom_tax_name . '</span>';
        } else if ( is_single() ) {
            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a>';
                echo $separator;
            }
            // Get post category info
            $category = get_the_category();
            if(!empty($category)) {
                // Get last category post is in
                $last_category = end(array_values($category));
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= $separator;
                }
            }
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
            }
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span>';
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                echo '<a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a>';
                echo $separator;
                echo '<span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span>';
            } else {
                echo '<span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span>';
            }
        } else if ( is_category() ) {
            // Category page
            echo '<span class="bread-current bread-cat">' . single_cat_title('', false) . '</span>';
        } else if ( is_page() ) {
            // Standard page
            if( $post->post_parent ){
                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );
                // Get parents in the right order
                $anc = array_reverse($anc);
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a>';
                    $parents .= $separator;
                }
                // Display parent pages
                echo $parents;
                // Current page
                echo '<span title="' . get_the_title() . '"> ' . get_the_title() . '</span>';
            } else {
                // Just display current page if not parents
                echo '<span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span>';
            }
        } else if ( is_tag() ) {
            // Tag page
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
            // Display the tag name
            echo '<span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span>';
        } elseif ( is_day() ) {
            // Day archive
            // Year link
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a>';
            echo $separator;
            // Month link
            echo '<a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a>';
            echo $separator;
            // Day display
            echo '<span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</span>';
        } else if ( is_month() ) {
            // Month Archive
            // Year link
            echo '<a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a>';
            echo $separator;
            // Month display
            echo '<span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</span>';
        } else if ( is_year() ) {
            // Display year archive
            echo '<span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</span>';
        } else if ( is_author() ) {
            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
            // Display author name
            echo '<span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</span>';
        } else if ( get_query_var('paged') ) {
            // Paginated archives
            echo '<span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span>';
        } else if ( is_search() ) {
            // Search results page
            echo '<span class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</span>';
        } elseif ( is_404() ) {
            // 404 page
            echo 'Error 404';
        }
        echo '</div>';
    }
}