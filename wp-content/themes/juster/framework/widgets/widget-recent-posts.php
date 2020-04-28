<?php
/**
 * widget-recent-posts.php
 *
 * Plugin Name: Juster_recent_posts
 * Plugin URI: http://www.themeforest.net/user/VictorThemes
 * Description: A widget that displays recent posts.
 * Version: 1.0
 * Author: VictorThemes
 * Author URI: http://www.themeforest.net/user/VictorThemes
*/

class Juster_recent_posts extends WP_Widget {

	/**
	 * Specifies the widget name, description, class name and instatiates it
	 */
	public function __construct() {
		parent::__construct(
			'widget-juster-recent-posts',
			__( 'Juster: Recent Posts', 'juster' ),
			array(
				'classname'   => 'widget-juster-recent-posts',
				'description' => __( 'A custom widget that displays recent posts.', 'juster' )
			)
		);
	}

	/**
	 * Generates the back-end layout for the widget
	 */
	public function form( $instance ) {
		// Default widget settings
		$defaults = array(
			'title'               => __('Recent Posts', 'juster'),
			'limit'               => '3',
			'post_type'           => 'post',
			'thumbnail'   		  => '',
			'display_date'        => '',
			'category'            => '',
			'order'               => '',
			'orderby'             => '',
			'custom_class'        => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		// The widget content ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php echo __( 'Limit:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php echo __( 'Post Type:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" value="<?php echo esc_attr( $instance['post_type'] ); ?>">
		</p>

		<!-- The input (checkbox) -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['thumbnail'], 'on'); ?> id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" />
            <label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php echo __( 'Display Thumbnail?', 'juster' ); ?></label>
		</p>

		<p>
            <input class="checkbox" type="checkbox" <?php checked($instance['display_date'], 'on'); ?> id="<?php echo $this->get_field_id('display_date'); ?>" name="<?php echo $this->get_field_name('display_date'); ?>" />
            <label for="<?php echo $this->get_field_id('display_date'); ?>"><?php echo __( 'Display Date?', 'juster' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php echo __( 'Category:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo esc_attr( $instance['category'] ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php echo __( 'Order:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" value="<?php echo esc_attr( $instance['order'] ); ?>">
			<p><?php echo __('Enter : ASC or DESC', 'juster') ?></p>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php echo __( 'Orderby:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" value="<?php echo esc_attr( $instance['orderby'] ); ?>">
			<p><?php echo __('Options Are : none, ID, author, title, name, type, date, modified, rand', 'juster') ?></p>
		</p>

		<!-- Custom Class -->
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php echo __( 'Custom Class:', 'juster' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" value="<?php echo esc_attr( $instance['custom_class'] ); ?>">
		</p> <?php
	}

	/**
	 * Processes the widget's values
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Update values
		$instance['title']        = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['limit']        = strip_tags( stripslashes( $new_instance['limit'] ) );
		$instance['post_type']    = strip_tags( stripslashes( $new_instance['post_type'] ) );
		$instance['thumbnail']    = strip_tags( stripslashes( $new_instance['thumbnail'] ) );
		$instance['display_date'] = strip_tags( stripslashes( $new_instance['display_date'] ) );
		$instance['category']     = strip_tags( stripslashes( $new_instance['category'] ) );
		$instance['order']        = strip_tags( stripslashes( $new_instance['order'] ) );
		$instance['orderby']      = strip_tags( stripslashes( $new_instance['orderby'] ) );
		$instance['custom_class'] = strip_tags( stripslashes( $new_instance['custom_class'] ) );

		return $instance;
	}

	/**
	 * Output the contents of the widget
	 */
	public function widget( $args, $instance ) {
		// Extract the arguments
		extract( $args );

		$title          = apply_filters( 'widget_title', $instance['title'] );
		$limit          = $instance['limit'];
		$post_type      = $instance['post_type'];
		$thumbnail      = $instance['thumbnail'];
		$display_date   = $instance['display_date'];
		$category       = $instance['category'];
		$order          = $instance['order'];
		$orderby        = $instance['orderby'];
		$custom_class   = $instance['custom_class'];

		$args = array(
	   	// other query params here,
	     'post_type' => esc_attr($post_type),
	     'posts_per_page' => (int)$limit,
	     'orderby' => esc_attr($orderby),
	     'order' => esc_attr($order),
	     'category_name' => esc_attr($category),
	   );

	   $jt_recent_post_widget = new WP_Query( $args );
	   global $post;

		// Display the markup before the widget (as defined in functions.php)
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if ($display_date) {
			$display_date_class = ' recent-date-checked';
		} else {
			$display_date_class = ' recent-date-notchecked';
		}
		if ($thumbnail) {
			$display_thumb_class = ' recent-thumb-checked';
		} else {
			$display_thumb_class = ' recent-thumb-notchecked';
		}

		echo '<ul class="juster-recent-widget '. $custom_class . $display_date_class . $display_thumb_class .'">';

		if ($jt_recent_post_widget->have_posts()) : while ($jt_recent_post_widget->have_posts()) : $jt_recent_post_widget->the_post();

		if ($display_date) {
			$display_date = '<div class="recent-date-full"><span class="recent-month">'. get_the_date('M') .', </span><span class="recent-date">'. get_the_date('d') .'th </span><span class="recent-year">'. get_the_date('Y') .'</span></div>';
		} else {
			$display_date = '';
		}

		if ( has_post_thumbnail() && ! post_password_required() ) {
			$have_thumb_class = 'recent-thumb-yes';
		} else {
			$have_thumb_class = 'recent-thumb-no';
		}

		?>

		<li class="<?php echo $have_thumb_class; ?>">
			<?php if ( $thumbnail ) { ?>
			<div class="widget-recent-inside">
			<?php }
			if ($thumbnail) {
				echo '<span class="recent-thumbnail">';
				// If the post has a thumbnail and it's not password protected
				// then display the thumbnail
				if ( has_post_thumbnail() && ! post_password_required() ) {
	                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
	                $url = $thumb['0'];
	                $blog_image_url = aq_resize( $url, '80', '70', true );
					$blog_image = '<img src="'. $blog_image_url .'" alt="" />';
					echo $blog_image;
				}
				echo '</span>';
			}
			?>
			<a href="<?php esc_url(the_permalink()) ?>" class="recent-title"><?php the_title(); ?></a><?php echo $display_date;
			if ( $thumbnail ) { ?>
			</div>
			<?php } ?>
		</li>

	<?php
	   endwhile; endif;

	   echo '</ul>';

	   wp_reset_postdata();

		// Display the markup after the widget (as defined in functions.php)
		echo $after_widget;
	}
}

// Register the widget using an annonymous function
function Juster_recent_posts_function() {
  register_widget( "Juster_recent_posts" );
}
add_action( 'widgets_init', 'Juster_recent_posts_function' );
