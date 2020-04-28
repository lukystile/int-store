<?php

$screen_header = esc_attr( $instance['screen_header'] );

$num_tweets = esc_attr( $instance['num_tweets'] );
$intv_tweets = esc_attr( $instance['intv_tweets'] );
$time_tweets = esc_attr( $instance['time_tweets'] );
$link_tweets = esc_attr( $instance['link_tweets'] );

?>
<p>		
	<label for="<?php echo $this->get_field_id( 'screen_header' ); ?>">Widget header:</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'screen_header' ); ?>" name="<?php echo $this->get_field_name( 'screen_header' ); ?>" type="text" value="<?php echo $screen_header; ?>" />

	<label for="<?php echo $this->get_field_id( 'num_tweets' ); ?>">Number of tweets:</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'num_tweets' ); ?>" name="<?php echo $this->get_field_name( 'num_tweets' ); ?>" type="text" value="<?php echo $num_tweets; ?>" />

	<label for="<?php echo $this->get_field_id( 'intv_tweets' ); ?>">Interval between tweets in seconds:</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'intv_tweets' ); ?>"name="<?php echo $this->get_field_name( 'intv_tweets' ); ?>" type="text" value="<?php echo $intv_tweets; ?>" />
	<br>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['time_tweets'], true ); ?> id="<?php echo $this->get_field_id( 'time_tweets' ); ?>" name="<?php echo $this->get_field_name( 'time_tweets' ); ?>" / >
	<label for="<?php echo $this->get_field_id( 'time_tweets' ); ?>">Show timestamp at tweet</label>
	<br>
	<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['link_tweets'], true ); ?> id="<?php echo $this->get_field_id( 'link_tweets' ); ?>" name="<?php echo $this->get_field_name( 'link_tweets' ); ?>" / >
	<label for="<?php echo $this->get_field_id( 'link_tweets' ); ?>">Open link in a new window/tab</label>
	<br>
</p>
<?php

/* Save for later when you can assign twitter name:

$tweet_id = esc_attr( $instance['tweet_id'] );

<label for="<?php echo $this->get_field_id( 'tweet_id' ); ?>">Twitter name:</label>
<input class="widefat" id="<?php echo $this->get_field_id( 'tweet_id' ); ?>" name="<?php echo $this->get_field_name( 'tweet_id' ); ?>" type="text" value="<?php echo $tweet_id; ?>" />-->
*/

?>