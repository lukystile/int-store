<?php

/* include the twitter OAuth library files */
require("lib/twitterOAuth/autoload.php"); 
use Abraham\TwitterOAuth\TwitterOAuth;

class token_admin
{
	
	public $token_session = array();
	
	function loadToken($file)
	{	
		$tokenData = json_decode(file_get_contents($file, true), true);
	
		$sessionTokens['oauth_token_secret'] = $tokenData['oauth_token_secret'];
		$sessionTokens['oauth_token'] = $tokenData['oauth_token'];	
		
		return $sessionTokens;
	}
	
	function destoryToken($token_file, $token_config)
	{	
		$empty = [];
		
		file_put_contents($token_file, json_encode($empty, true));
		file_put_contents($token_config, json_encode($empty, true));	
	}
	
	function collectTokenUrl($consumer_key, $consumer_secret ,$callbackUrl, $sessionTokens, $file, $configFile)
	{
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$content = $connection->get("account/verify_credentials");

		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $callbackUrl));

		$sessionTokens['oauth_token'] = $request_token['oauth_token'];
		$sessionTokens['oauth_token_secret'] = $request_token['oauth_token_secret'];

		// Save the tokens
		file_put_contents($file, json_encode($sessionTokens, true));	
		
		// Mark the configuration as false
		$tokenConfig = [];
		$tokenConfig['configuration'] = 'false';
		
		file_put_contents($configFile, json_encode($tokenConfig, true));

		$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		return $url;	
	}
	
	function collectReturnUrl($url)
	{

		preg_match('/oauth_token=([^&]*)/i', $url, $matches);
		$oauth_token = $matches[1];
		
		preg_match('/oauth_verifier=([^&]*)/i', $url, $matches);
		$oauth_verifier = $matches[1];		
		
		$return_token = [];
		
		if (isset($oauth_token))
		{
			$return_token['oauth_token'] = $oauth_token;
		}
		
		if (isset($oauth_verifier))
		{
			$return_token['oauth_verifier'] = $oauth_verifier;
		}
			
		return $return_token;
	}
	
		function collectLogoutUrl($url)
	{

		preg_match('/logout=([^&]*)/i', $url, $matches);
		$logout = $matches[1];
		
		$return_logout = [];
		
		if (isset($logout))
		{
			$return_logout['logout'] = $logout;
		}

		return $return_logout;
	}
	
	
	function collectCallbackUrl()
	{
		$pageURL = 'http';
	
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
	
		if ($_SERVER["SERVER_PORT"] != "80") 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
	
	function authenticate($consumer_key, $consumer_secret, $sessionTokens, $returnToken, $file, $configFile)
	{			
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $sessionTokens['oauth_token'], $sessionTokens['oauth_token_secret']);
		$access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $returnToken['oauth_verifier']]);
		
		$sessionTokens['access_token'] = $access_token;
		
		file_put_contents($file, json_encode($sessionTokens['access_token'], true));
		
		// Mark the configuration as true
		$tokenConfig = [];
		$tokenConfig['configuration'] = 'true';
		
		file_put_contents($configFile, json_encode($tokenConfig, true));
	}	
}

?>