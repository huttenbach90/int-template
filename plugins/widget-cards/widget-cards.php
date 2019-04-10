<?php
/**
 * Plugin Name: Widget cards
 * Version: 1.0
 * Network: false
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Create cards and easily with this widget.
 */

 // Register and load the widget
function cards_load_widget() {
    register_widget( 'cards_widget' );
}
add_action( 'widgets_init', 'cards_load_widget' );

// Creating the widget
class cards_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

            // Base ID of your widget
            'cards_widget',

            // Widget name will appear in UI
            __('Card', 'widget_cards'),

            // Widget description
            array( 'description' => __( '', 'widget_cards' ), )
        );
    }

    // Creating widget front-end
    public function widget( $args, $instance ) {
        $icon = apply_filters( 'widget_icon', $instance['icon'] );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $description = apply_filters( 'widget_description', $instance['description']);
        $permalink = apply_filters( 'widget_url', $instance['url']);
        $type = apply_filters( 'widget_type', $instance['type']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        // This is where you run the code and display the output
        echo "<div class='col-12 col-md-6 mb-4 mt-2 pr-3 pl-3'>";
        echo "<a href='" . $permalink . "' class='card card-shadow hover-scale i-40 h-100 text-center'>";
        echo "<div class='card-body'>";
        echo "<i class='" . $icon . "'></i>";
        echo "<h2 class='card-title mt-2'>" . $title . "</h2>";
        echo "<p class='card-text'>" . $description . "</p>";
        echo "</div></a></div>";
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( isset( $instance[ 'icon' ] ) ) {
            $icon = $instance[ 'icon' ];
        }
        if ( isset( $instance[ 'description' ] ) ) {
            $description = $instance[ 'description' ];
        }
        if ( isset( $instance[ 'url' ] ) ) {
            $url = $instance[ 'url' ];
        }
        if ( isset( $instance[ 'type' ] ) ) {
            $type = $instance[ 'type' ];
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?></label> 
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="url" value="<?php echo esc_attr( $url ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Type (homepage/aside):' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" type="type" value="<?php echo esc_attr( $type ); ?>" />
        </p>
    <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
        $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
        $instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : '';
        return $instance;
    }
}