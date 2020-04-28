<?php
/*---------------------------------------------------------------------
* Defatch Dynamic Js
* -------------------------------------------------------------------*/

  header("Content-type: text/javascript;");
	$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
	$wp_load = $absolute_path[0] . 'wp-load.php';
	require_once($wp_load);

/* Custom JS */
$custom_js = ot_get_option('custom_js');
echo $custom_js;