<?php
$metaboxes = array(
    'link_url' => array(
        'title' => __('Link information', 'integromat'),
        'applicableto' => 'external',
        'location' => 'side',
        'priority' => 'low',
        'fields' => array(
            'l_url' => array(
                'title' => __('URL:', 'integromat'),
                'type' => 'text',
                'description' => '',
                'size' => 34
            )
        )
    ),
);

add_action( 'admin_init', 'add_post_format_metabox' );
function add_post_format_metabox() {
    global $metaboxes;

    if ( ! empty( $metaboxes ) ) {
        foreach ( $metaboxes as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}

function show_metaboxes( $post, $args ) {
    global $metaboxes;

    $custom = get_post_custom( $post->ID );
    $fields = $tabs = $metaboxes[$args['id']]['fields'];

    /** Nonce **/
    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

    if ( sizeof( $fields ) ) {
        foreach ( $fields as $id => $field ) {
            switch ( $field['type'] ) {
                default:
                case "text":

                    $output .= '<label for="' . $id . '">' . $field['title'] . '</label><input id="' . $id . '" type="text" name="' . $id . '" value="' . $custom[$id][0] . '" size="' . $field['size'] . '" />';

                    break;
            }
        }
    }
    echo $output;
}

add_action( 'save_post', 'save_metaboxes' );
function save_metaboxes( $post_id ) {
    global $metaboxes;

    if ( ! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $post_type = get_post_type();

    foreach ( $metaboxes as $id => $metabox ) {
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $metaboxes[$id]['fields'];

            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                $new = $_POST[$id];

                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }
                elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }
            }
        }
    }
}

add_action( 'admin_print_scripts', 'display_metaboxes', 1000 );