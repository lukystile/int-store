<?php

require_once('config.php');
include('tweet-fader_token.php');
include('tweet-fader_handler.php');


echo $args['before_widget'];
$screenHeader = $instance['screen_header'];
echo '<h3 class="widget-title">'.$screenHeader.'</h3>';

// Collect existing settings
$tokenAdmin = new token_admin();
$sessionTokens = $tokenAdmin -> loadToken($token_file_widget);

// Load token config to check if configuration is done
$tokenConfig = json_decode(file_get_contents($token_config_widget, true), true);

if (!isset($tokenConfig['configuration']) || $tokenConfig['configuration'] == 'false')
{
	echo 'Looks like Tweet Fader is not authenticated yet.';
	echo '<br>';
	echo '<br>';
	echo 'Please go to the Tweet Fader settings page.';
}
else
{
	$tweetHandler = new tweet_handler();
	$tweetsTimeline = $tweetHandler ->collectTimeline($consumer_key, $consumer_secret, $sessionTokens, $instance['num_tweets']);
	
	//set the random id length 
	$random_id_length = 4; 

	//generate a random id encrypt it and store it in $rnd_id 
	$rnd_id = crypt(uniqid(rand(),1)); 

	//to remove any slashes that might have come 
	$rnd_id = strip_tags(stripslashes($rnd_id)); 

	//Removing any . or / and reversing the string 
	$rnd_id = str_replace(".","",$rnd_id); 
	$rnd_id = strrev(str_replace("/","",$rnd_id)); 

	//finally I take the first 10 characters from the $rnd_id 
	$rnd_id = substr($rnd_id,0,$random_id_length); 
	$tweet = "tweet_";
	$rnd_id = $tweet . $rnd_id;

	
	$rnd_id_time = $rnd_id . _time;
	
	$interval_basic = $instance['intv_tweets'];
	$def_time = "000";
	if (isset($interval_basic)) 
	{ 
		$interval_basic = $interval_basic . $def_time;
	} 
	else
	{ 
		$interval_basic = "10000"; 
	}
	
	?>
		<html>
			<style>
				#tweets {
				position: relative;
				height: 110px;
				}

				.<?php echo $rnd_id ?>{
				display: none;
				position: absolute; 
				}
		</style>
		<script type="text/javascript">
			
			jQuery(document).ready(function() {
				var InfiniteRotator =
				{
				init: function()
				{
					//initial fade-in time (in milliseconds)
					var initialFadeIn = 1000;
 
					//interval between items (in milliseconds)
					var itemInterval = <?php echo $interval_basic; ?>
 
					//cross-fade time (in milliseconds)
					var fadeTime = 1000;
 
					//count number of items
					var numberOfItems = jQuery('.<?php echo $rnd_id ?>').length;
 
					//set current item
					var currentItem = 0;
 
					//show first item
					jQuery('.<?php echo $rnd_id ?>').eq(currentItem).delay(1000).fadeTo(initialFadeIn, 1);
 
					//loop through the items
					var infiniteLoop = setInterval(function(){
						jQuery('.<?php echo $rnd_id ?>').eq(currentItem).delay(1000).delay(1000).fadeOut(fadeTime);
						
						if(currentItem == numberOfItems -1){
							currentItem = 0;
						}else{
							currentItem++;
						}

						jQuery('.<?php echo $rnd_id ?>').eq(currentItem).delay(1000).fadeTo(fadeTime, 1);
 
					}, itemInterval);
				}
			};
 
			InfiniteRotator.init();
		});
		</script>
		<script src="<?php bloginfo('url'); ?>/wp-content/plugins/tweet-fader/lib/Moment.js"></script>
		<script src="<?php bloginfo('url'); ?>/wp-content/plugins/tweet-fader/lib/Livestamp.js"></script>
		
		<div id=tweets>
		<?php if( $instance['link_tweets'] == 'on' ) 
		{ ?>
			<script type="text/javascript">
			jQuery(document).ready(function() {
			jQuery(".<?php echo $rnd_id ?> a").attr("target","_blank");
			});
			</script>
		<?php
		};

		foreach ($tweetsTimeline as &$tweet) 
		{
			echo '<p class='.$rnd_id.'>';
			echo $tweet['text'];
			echo '<br>';
			
			if( $instance['time_tweets'] == 'on' ) 
			{
				echo '<span data-livestamp='.$tweet['date'].' ></span>';
			}
			echo '</p>';
		}

		?>
		</div>
		</html>
		<?php
}

echo $args['after_widget'];
	
	
?>