<?php
class tweet_fader_widget extends WP_Widget 
{

	// constructor
	function tweet_fader_widget() 
	{
		parent::WP_Widget(false, $name = __('Tweet Fader', 'tweet_fader_widget') );
	}

	// widget form creation
	function form($instance) 
	{	
		include('tweet-fader_widget_form.php');
	}

	// widget update
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		// Fields
		$instance['screen_header'] = strip_tags($new_instance['screen_header']);
		$instance['num_tweets'] = strip_tags($new_instance['num_tweets']);
		$instance['intv_tweets'] = strip_tags($new_instance['intv_tweets']);
		$instance['time_tweets'] = strip_tags($new_instance['time_tweets']);
		$instance['link_tweets'] = strip_tags($new_instance['link_tweets']);
			  
		return $instance;
	}

	// widget display
	function widget($args, $instance) 
	{
		include('tweet-fader_widget_main.php');
	}
}
?>