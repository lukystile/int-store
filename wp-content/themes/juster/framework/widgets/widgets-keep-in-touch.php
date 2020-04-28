<?php
/**
 * widget-keep-in-touch.php
 *
 * Plugin Name: Juster Keep in Touch Widget
 * Plugin URI: http://www.victorthemes.com
 * Description: A widget that displays addresses.
 * Version: 1.0
 * Author: VictorThemes
 * Author URI: http://www.victorthemes.com
*/

class juster_Widget_touch extends WP_Widget {

	/**
	 * Specifies the widget name, description, class name and instatiates it
	 */
	public function __construct() {
		parent::__construct(
			'widget-keep-in-touch',
			__( 'Juster: Keep in Touch', 'juster' ),
			array(
				'classname'   => 'widget-custom',
				'description' => __( 'A custom widget that displays address.', 'juster' )
			)
		);
	}

	/**
	 * Generates the back-end layout for the widget
	 */
	public function form( $instance ) {
		// Default widget settings
		$defaults = array(
			'title'               => '',
			'address'   		  => '',
			'phone'   		  => '',
			'email'   		  => '',
			'fax'   		  => ''

		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		// The widget content ?>
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<!-- Address -->
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php echo __( 'Address:', 'juster' ); ?></label>
			<textarea cols="30" rows="3" class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"><?php echo esc_textarea( $instance['address'] ); ?></textarea>
		</p>

		<!-- Phone -->
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php echo __( 'Phone:', 'juster' ); ?></label>
			<textarea cols="30" rows="3" class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>"><?php echo esc_textarea( $instance['phone'] ); ?></textarea>
		</p>

		<!-- Email -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php echo __( 'Email:', 'juster' ); ?></label>
			<textarea cols="30" rows="3" class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>"><?php echo esc_textarea( $instance['email'] ); ?></textarea>
		</p>

		<!-- Fax -->
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php echo __( 'Fax:', 'juster' ); ?></label>
			<textarea cols="30" rows="3" class="widefat" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>"><?php echo esc_textarea( $instance['fax'] ); ?></textarea>
		</p> <?php
	}

	/**
	 * Processes the widget's values
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// Update values
		$instance['title']               = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['address']   = strip_tags( stripslashes( $new_instance['address'] ) );
		$instance['phone'] = strip_tags( stripslashes( $new_instance['phone'] ) );
		$instance['email']      = strip_tags( stripslashes( $new_instance['email'] ) );
		$instance['fax']        = strip_tags( stripslashes( $new_instance['fax'] ) );
		return $instance;
	}

	/**
	 * Output the contents of the widget
	 */
	public function widget( $args, $instance ) {
		// Extract the arguments
		extract( $args );
		$title               = apply_filters( 'widget_title', $instance['title'] );
		$address   = $instance['address'];
		$phone = $instance['phone'];
		$email      = $instance['email'];
		$fax        = $instance['fax'];
		// Display the markup before the widget (as defined in functions.php)
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo '<ul class="jt-widget-address">';

		if ( $address ) : ?>
			<li class="jt-add-icon jt-add-li">
			  <i class="pe-7s-map-2"></i>
				<span><?php echo esc_attr($address); ?></span>
			</li>
		<?php endif;

		if ( $phone ) : ?>
	        <li class="jt-add-icon jt-phone-li">
              <i class="pe-7s-call"></i>
				<span><?php echo esc_attr($phone); ?></span>
			</li>
		<?php endif;

		if ( $email ) : ?>
		    <li class="jt-add-icon jt-mail-li">
              <i class="pe-7s-mail"></i>
				<span><?php echo esc_attr($email); ?></span>
			</li>
		<?php endif;

		if ( $fax ) : ?>
			<li class="jt-add-icon jt-fax-li">
              <i class="pe-7s-print"></i>
				<span><?php echo esc_attr($fax); ?></span>
			</li>
		<?php endif;

		echo '</ul>';

		// Display the markup after the widget (as defined in functions.php)
		echo $after_widget;
	}
}

// Register the widget using an annonymous function
function juster_Widget_touch_function() {
  register_widget( "juster_Widget_touch" );
}
add_action( 'widgets_init', 'juster_Widget_touch_function' );
