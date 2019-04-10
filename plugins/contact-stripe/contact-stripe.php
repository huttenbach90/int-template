<?php
/**
 * Plugin Name: Contact stripe
 * Version: 1.0
 * Network: false
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Add contact information for a green stripe in the footer.
 */

 // Register and load the widget
function contact_load_widget() {
    register_widget( 'contact_widget' );
}
add_action( 'widgets_init', 'contact_load_widget' );

// Creating the widget
class contact_widget extends WP_Widget {

    function __construct() {
        parent::__construct(

            // Base ID of your widget
            'contact_widget',

            // Widget name will appear in UI
            __('Contact stripe', 'widget_contact'),

            // Widget description
            array( 'description' => __( '', 'widget_contact' ), )
        );
    }

    // Creating widget front-end
    public function widget( $args, $instance ) {
        $text = apply_filters( 'widget_text', $instance['text'] );
        $button = apply_filters( 'widget_button', $instance['button']);
        $permalink = apply_filters( 'widget_url', $instance['url']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        // This is where you run the code and display the output
        echo "<div class='col-12 pt-4 pb-4'>";
        echo "<span class='mr-md-5'>" . $text . "</span><a href='" . $permalink . "' class='btn bg-white text-green'>" . $button . "</a>";
        echo "</div>";
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'text' ] ) ) {
            $text = $instance[ 'text' ];
        }
        if ( isset( $instance[ 'button' ] ) ) {
            $button = $instance[ 'button' ];
        }
        if ( isset( $instance[ 'url' ] ) ) {
            $url = $instance[ 'url' ];
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'Button:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="url" value="<?php echo esc_attr( $url ); ?>" />
        </p>
    <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
        $instance['button'] = ( ! empty( $new_instance['button'] ) ) ? strip_tags( $new_instance['button'] ) : '';
        $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
        return $instance;
    }
}