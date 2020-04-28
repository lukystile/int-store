<?php
	/**********************************************
	CUSTOM DRIBBBLE FEED WIDGET
	***********************************************/

	class project_Widget_Dribbble extends WP_Widget {

		/**
		 * Specifies the widget name, description, class name and instatiates it
		 */
		public function __construct() {
			parent::__construct(
				'widget-dribbble',
				__( 'Juster: Dribbble', 'juster' ),
				array(
					'classname'   => 'widget-dribbble',
					'description' => __( 'Custom widget for dribbble feed', 'juster' )
				)
			);
		}

		function widget($args, $instance) {
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			if (empty($title)) $title = false;
				$instance_dribbble_id = array();
				$instance_dribbble_limit = array();

				$dribbble_id = 'dribbble_id';
				$instance_dribbble_id = isset($instance[$dribbble_id]) ? $instance[$dribbble_id] : '';
				$dribbble_limit = 'dribbble_limit';
				$instance_dribbble_limit = isset($instance[$dribbble_limit]) ? $instance[$dribbble_limit] : '';

				echo ''.$before_widget.'';
					if ($title) {
						echo $before_title;
						echo $title;
						echo $after_title.'';
					}

				wp_register_script( 'dribbble', get_template_directory_uri() . '/js/jribbble.js', array(), '', true );
				wp_enqueue_script( 'dribbble' );

				?>

				<!--DRIBBBLE FEED-->
				<ul id="dribbble" class="dribbble-feed"></ul>

				<script type="text/javascript">
					(function($) {
					  	"use strict";
					  	$(document).ready(function () {
							$.jribbble.getShotsByPlayerId( '<?php echo $instance_dribbble_id; ?>', function (playerShots) {
							    var html = [];

							    $.each(playerShots.shots, function (i, shot) {
							        html.push('<li><a href="' + shot.url + '" target="_blank">');
							        html.push('<img src="' + shot.image_teaser_url + '" ');
							        html.push('alt="' + shot.title + '"></a></li>');
							    });

							    $('#dribbble').html(html.join(''));
							}, {page: 1, per_page: <?php echo $instance_dribbble_limit; ?> });

						});

					})(jQuery);
				</script>

				<?php
					echo $after_widget.'';
				}

				function update($new_instance, $old_instance) {
					$instance = $old_instance;
					$instance['title'] = strip_tags($new_instance['title']);
					$instance['dribbble_id'] = $new_instance['dribbble_id'];
					$instance['dribbble_limit'] = $new_instance['dribbble_limit'];
					return $instance;
				}

				function form($instance) {
					$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
					$instance_dribbble_id = array();
					$instance_dribbble_limit = array();

					$dribbble_id = 'dribbble_id';
					$instance_dribbble_id = isset($instance[$dribbble_id]) ? $instance[$dribbble_id] : '';
					$dribbble_limit = 'dribbble_limit';
					$instance_dribbble_limit = isset($instance[$dribbble_limit]) ? $instance[$dribbble_limit] : '';

				?>
					<p><label for="<?php echo $this -> get_field_id('title'); ?>"><?php echo __('Title:', 'juster'); ?></label>
					<input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
					<div>
						<div>
							<p><label for="<?php echo $this -> get_field_id($dribbble_id); ?>"><?php echo __('User ID:', 'juster'); ?></label>
							<input class="widefat" type="text" id="<?php echo $this -> get_field_id($dribbble_id); ?>" name="<?php echo $this -> get_field_name($dribbble_id); ?>" value="<?php echo esc_attr($instance_dribbble_id); ?>">
							</p>
							<p><label for="<?php echo $this -> get_field_id($dribbble_limit); ?>"><?php echo __('Limit:', 'juster'); ?></label>
							<input class="widefat" type="text" id="<?php echo $this -> get_field_id($dribbble_limit); ?>" name="<?php echo $this -> get_field_name($dribbble_limit); ?>" value="<?php echo esc_attr($instance_dribbble_limit); ?>">
							</p>
						</div>
					</div>
		<?php
				}
		}

		function project_Widget_dribbble() {
			register_widget('project_Widget_Dribbble');
		}
		add_action('widgets_init', 'project_Widget_dribbble');
