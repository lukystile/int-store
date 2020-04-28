<?php
if (class_exists('WPBakeryVisualComposerAbstract')) {
	$path = FRAMEWORK . '/plugins/visual-composer/shortcodes/pre-templates';
	$files = glob($path . '/*.php');
	foreach($files as $file)
		if( __FILE__ != basename($file) )
			include_once $file;
}
