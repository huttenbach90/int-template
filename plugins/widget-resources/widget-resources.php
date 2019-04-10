<?php
/**
 * Plugin Name: Widget resources
 * Version: 1.0
 * Network: false
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Add resources into aside of your help center homepage.
 */

 // Register and load the widget
function resources_load_widget() {
    register_widget( 'resources_widget' );
}
add_action( 'widgets_init', 'resources_load_widget' );

// Creating the widget
class resources_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

            // Base ID of your widget
            'resources_widget',

            // Widget name will appear in UI
            __('Resource', 'widget_resources'),

            // Widget description
            array( 'description' => __( '', 'widget_resources' ), )
        );
    }

    // Creating widget front-end
    public function widget( $args, $instance ) {
        $icon = apply_filters( 'widget_icon', $instance['icon'] );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $description = apply_filters( 'widget_description', $instance['description']);
        $permalink = apply_filters( 'widget_url', $instance['url']);
        $button = apply_filters( 'widget_button', $instance['button']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        // This is where you run the code and display the output
        echo "<div class='col-12 resource'>";
        echo "<a href='" . $permalink . "' class='position-relative no-decoration'>";
        echo "<i class='" . $icon . " text-primary'></i><h3>" . $title . "</h3>" ;
        echo "</a>";
        echo "<p>" . $description . "</p>";
        if ($button != "") {
            echo "<a href='" . $url . "' class='btn btn-primary btn-sm mb-4'>" . $button . "</a>";
        }
        echo "</a></div>";
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
        if ( isset( $instance[ 'button' ] ) ) {
            $button = $instance[ 'button' ];
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
            <label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'Button (if any):' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>" />
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
        $instance['button'] = ( ! empty( $new_instance['button'] ) ) ? strip_tags( $new_instance['button'] ) : '';
        return $instance;
    }
}