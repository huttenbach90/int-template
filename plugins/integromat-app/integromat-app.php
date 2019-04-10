<?php
/**
 * Plugin Name: Integromat App Advertising
 * Version: 1.0
 * Network: false
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Advertise the Integromat app.
 */

 // Register and load the widget
function integromat_app_load_widget() {
    register_widget( 'integromat_app_widget' );
}
add_action( 'widgets_init', 'integromat_app_load_widget' );

// Creating the widget
class integromat_app_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

            // Base ID of your widget
            'integromat_app_widget',

            // Widget name will appear in UI
            __('Integromat App Advertising', 'widget_integromat_app'),

            // Widget description
            array( 'description' => __( '', 'widget_integromat_app' ), )
        );
    }

    // Creating widget front-end
    public function widget( $args, $instance ) {
        $lead = apply_filters( 'widget_lead', $instance['lead'] );
        $url_img = apply_filters( 'widget_url_img', $instance['url_img'] );
        $button_text = apply_filters( 'widget_button_text', $instance['button_text']);
        $ios = apply_filters( 'widget_ios', $instance['ios']);
        $android = apply_filters( 'widget_android', $instance['android']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        // This is where you run the code and display the output
        echo "<div class='col-12 col-md-4 py-5'>";
        echo "<p class='display-5'>" . $lead . "</p>";
        echo "</div><div class='d-none d-md-block col-md-4 text-center pt-4'>";
        echo "<img src='" . $url_img . "'>";
        echo "</div><div class='col-12 col-md-4 py-5'>";
        echo "<p>" . $button_text . "</p>";
        echo "<a class='btn btn-ios mr-3' href='" . $ios . "'></a>";
        echo "<a class='btn btn-android' href='" . $android . "'></a>";
        echo "</div>";
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'url_img' ] ) ) {
            $url_img = $instance[ 'url_img' ];
        }
        if ( isset( $instance[ 'lead' ] ) ) {
            $lead = $instance[ 'lead' ];
        }
        if ( isset( $instance[ 'button_text' ] ) ) {
            $button_text = $instance[ 'button_text' ];
        }
        if ( isset( $instance[ 'ios' ] ) ) {
            $ios = $instance[ 'ios' ];
        }
        if ( isset( $instance[ 'android' ] ) ) {
            $android = $instance[ 'android' ];
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'lead' ); ?>"><?php _e( 'Lead text:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'lead' ); ?>" name="<?php echo $this->get_field_name( 'lead' ); ?>" type="text" value="<?php echo esc_attr( $lead ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'url_img' ); ?>"><?php _e( 'Image URL:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'url_img' ); ?>" name="<?php echo $this->get_field_name( 'url_img' ); ?>" type="text" value="<?php echo esc_attr( $url_img ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Text before buttons:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>"><?php echo esc_attr( $button_text ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'ios' ); ?>"><?php _e( 'URL iOS app' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'ios' ); ?>" name="<?php echo $this->get_field_name( 'ios' ); ?>" type="url" value="<?php echo esc_attr( $ios ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'android' ); ?>"><?php _e( 'URL Android app:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'android' ); ?>" name="<?php echo $this->get_field_name( 'android' ); ?>" type="url" value="<?php echo esc_attr( $android ); ?>" />
        </p>
    <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['url_img'] = ( ! empty( $new_instance['url_img'] ) ) ? strip_tags( $new_instance['url_img'] ) : '';
        $instance['lead'] = ( ! empty( $new_instance['lead'] ) ) ? strip_tags( $new_instance['lead'] ) : '';
        $instance['button_text'] = ( ! empty( $new_instance['button_text'] ) ) ? strip_tags( $new_instance['button_text'] ) : '';
        $instance['ios'] = ( ! empty( $new_instance['ios'] ) ) ? strip_tags( $new_instance['ios'] ) : '';
        $instance['android'] = ( ! empty( $new_instance['android'] ) ) ? strip_tags( $new_instance['android'] ) : '';
        return $instance;
    }
}