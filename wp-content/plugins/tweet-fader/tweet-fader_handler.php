<?php

/* include the twitter OAuth library files */
require("lib/twitterOAuth/autoload.php"); 
use Abraham\TwitterOAuth\TwitterOAuth;

class tweet_handler
{
	function collectTimeline($consumer_key, $consumer_secret, $sessionTokens ,$count)
	{			
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $sessionTokens['oauth_token'], $sessionTokens['oauth_token_secret']);
		$content =  $connection->get("statuses/user_timeline", ["count" => $count, "exclude_replies" => true]);
		
		foreach($content as $tweet)
		{
			$_TWEETS[] = array( 
				'id' => $tweet->id,
				'text' => processLinks($tweet->text),
				'date' => strtotime($tweet->created_at)
			);
		}

		return $_TWEETS;
	}

	function collectUserData($consumer_key, $consumer_secret, $sessionTokens)
	{
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $sessionTokens['oauth_token'], $sessionTokens['oauth_token_secret']);
		$user = $connection->get("account/verify_credentials");
		
		return $user;
	}
}

function processLinks($text) 
{
	$text = htmlspecialchars($text);	
	
	$text = preg_replace_callback(
		"/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/][…].?)/",
		function($matches) 
		{ 
			$ret =  "";
			return $ret;
		},
		$text
	);
	
	$text = preg_replace_callback(
		"/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/",
		function($matches) 
		{ 
			$ret =  "<a href=".$matches[1]." >".$matches[1]."</a>";

			return $ret;
		},
		$text
	);
	
	
	$text = preg_replace_callback(
		"/(@\w+)/",
		function($matches) 
		{ 
			$retSearch = str_replace("@","", $matches[1]);
			$ret = "<a href=\"https://twitter.com/".$retSearch."\">".$matches[1]."</a>";

			return $ret;
		},
		$text
	);
	
	$text = preg_replace_callback(
		"/(#\w+)/",
		function($matches) 
		{ 
			$retSearch = str_replace("#","%23", $matches[1]);
			$ret = "<a href=\"https://twitter.com/#!/search/".$retSearch."\">".$matches[1]."</a>";

			return $ret;
		},
		$text
	);
	
	
	$text = preg_replace_callback(
		"/&amp;/",
		function($matches) 
		{ 
			$ret = "&";

			return $ret;
		},
		$text
	);
		
	return $text;
}


?>