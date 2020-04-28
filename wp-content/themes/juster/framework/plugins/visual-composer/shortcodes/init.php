<?php
if (class_exists('WPBakeryVisualComposerAbstract')) {
	$dir = FRAMEWORK . '/plugins/visual-composer/templates';
	vc_set_shortcodes_templates_dir( $dir );
	$path = FRAMEWORK . '/plugins/visual-composer/shortcodes';
	$files = glob($path . '/*.php');
	foreach($files as $file)
		if( __FILE__ != basename($file) )
			include_once $file;
}
