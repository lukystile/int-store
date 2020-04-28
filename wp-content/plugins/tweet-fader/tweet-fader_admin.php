<?php
/* Include the config file */
require_once('config.php');
include('tweet-fader_token.php');
include('tweet-fader_handler.php');

// Title section
include('tweet-fader_admin_text.php');


// Create new token instance
$tokenAdmin = new token_admin();

// Collect current urldecode
$url = $tokenAdmin -> collectCallbackUrl();

// Collect existing settings
$sessionTokens = $tokenAdmin -> loadToken($token_file);

// Collect return tokens for callback action
$returnToken = $tokenAdmin -> collectReturnUrl($url);

// Check if logout is called
$logout = $tokenAdmin -> collectLogoutUrl($url);

// Load token config to check if configuration is done
$tokenConfig = json_decode(file_get_contents($token_config, true), true);

if (isset($logout['logout']) && $logout['logout'] == 'true')
{
	// remove tokens
	$tokenAdmin -> destoryToken($token_file, $token_config);
	
	echo "<h4>" . __( 'Successfully logged out', 'tf_trdom' ) . "</h4>";
	
	// reload tokens for current session
	$sessionTokens = $tokenAdmin -> loadToken($token_file);
	$tokenConfig = json_decode(file_get_contents($token_config, true), true);
	
}
// Callback actions if return tokens are set
elseif (isset($returnToken['oauth_token']) && $tokenConfig['configuration'] == 'false')
{
	$request_token = [];
	$request_token['oauth_token'] = $sessionTokens['oauth_token'];
	$request_token['oauth_token_secret'] = $sessionTokens['oauth_token_secret'];
	
	if (isset($returnToken['oauth_token']) && $request_token['oauth_token'] !== $returnToken['oauth_token']) 
	{
		// Abort! Something is wrong.
		echo('Oops, something went wrong');
	}
	
	$tokenAdmin -> authenticate($consumer_key, $consumer_secret, $sessionTokens, $returnToken, $token_file, $token_config);
	
	// Reload token file to display user settings
	$sessionTokens = $tokenAdmin -> loadToken($token_file);
	$tokenConfig = json_decode(file_get_contents($token_config, true), true);
	
}
// Request autorize url and provide signin button
elseif (!isset($sessionTokens['oauth_token']) || $tokenConfig['configuration'] == 'false') 
{
	// Notify Tweet Fader is not authorized
	echo "<h4>" . __( 'Tweet Fader is not yet authorized', 'tf_trdom' ) . "</h4>";
	
	// Collect the and token url
	$tokenUrl = $tokenAdmin ->collectTokenUrl($consumer_key, $consumer_secret, $url, $sessionTokens, $token_file, $token_config);
	
	// Provide button to authorize
	echo '<br>';
	echo '<a class="button button-primary" href="'.$tokenUrl.'" >Sign in with Twitter</a>';
	echo '<br>';
	
}

if (isset($sessionTokens['oauth_token']) &&  $tokenConfig['configuration'] == 'true') 
{	
	// Create new tweet handler instance
	$tweetHandler = new tweet_handler();
	$userProfileInformation = $tweetHandler ->collectUserData($consumer_key, $consumer_secret, $sessionTokens);
	$username = $userProfileInformation->screen_name;
	echo "<h4>" . __( 'You are signed in as: ' .$username. '', 'tf_trdom' ) . "</h4>";

	
	$imageUrl = $userProfileInformation->profile_image_url;
	$imageUrl = str_replace("normal", "bigger", $imageUrl);

	echo('<img src="'.$imageUrl.'" alt="Profile Picture" style="width:72px;height:72px;">');
	echo '<br>';
	echo '<br>';
	echo '<a class="button button-primary" href="'.$url.'&logout=true">Logout from Twitter</a></p>';

}

?>
