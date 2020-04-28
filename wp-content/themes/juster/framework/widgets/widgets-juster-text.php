<?php
/**
 * widget-juster-text.php
 *
 * Plugin Name: Juster Simple Widget
 * Plugin URI: http://www.victorthemes.com
 * Description: A widget that displays business hours.
 * Version: 1.0
 * Author: VictorThemes
 * Author URI: http://www.victorthemes.com
*/

class Juster_Widget_Text extends WP_Widget {

	/**
	 * Specifies the widget name, description, class name and instatiates it
	 */
	public function __construct() {
		parent::__construct(
			'widget-juster-text',
			__( 'Juster: Text', 'juster' ),
			array(
				'classname'   => 'widget-juster-text',
				'description' => __( 'A custom widget for simple textarea.', 'juster' )
			)
		);
	}

	/**
	 * Generates the back-end layout for the widget
	 */
	public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'main_content' => '', 'custom_class' => '' ) );
			$title = strip_tags($instance['title']);
			$main_content = esc_textarea($instance['main_content']);
			$custom_class = esc_textarea($instance['custom_class']);
	?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', 'juster'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('main_content'); ?>" name="<?php echo $this->get_field_name('main_content'); ?>"><?php echo $main_content; ?></textarea>

			<!-- Custom Class -->
			<p>
				<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php echo __( 'Custom Class :', 'juster' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" value="<?php echo esc_attr( $instance['custom_class'] ); ?>">
			</p>
	<?php
	}

	/**
	 * Processes the widget's values
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['main_content'] =  $new_instance['main_content'];
		else
			$instance['main_content'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['main_content']) ) ); // wp_filter_post_kses() expects slashed
		$instance['custom_class'] = strip_tags( stripslashes( $new_instance['custom_class'] ) );
		return $instance;
	}

	/**
	 * Output the contents of the widget
	 */
	public function widget( $args, $instance ) {
		// Extract the arguments
		extract( $args );

		$title               = apply_filters( 'widget_title', $instance['title'] );
		$main_content   = $instance['main_content'];
		$custom_class = $instance['custom_class'];

		// Display the markup before the widget (as defined in functions.php)
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		if ($custom_class) {
			$custom_class = $custom_class;
		} else {
			$custom_class = '';
		}

		echo '<div class="jt-widget-text '. $custom_class .'">';
			if ($main_content) {
				echo do_shortcode($main_content);
			} else {}
		echo '</div>';

		// Display the markup after the widget (as defined in functions.php)
		echo $after_widget;
	}
}

// Register the widget using an annonymous function
function Juster_Widget_Text_function() {
  register_widget( "Juster_Widget_Text" );
}
add_action( 'widgets_init', 'Juster_Widget_Text_function' );
