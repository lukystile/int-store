<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" class="search-new" >
	<div>
		<label class="screen-reader-text" for="s"></label>
		<input type="text" name="s" id="s" placeholder="<?php echo __('Search Here','juster'); ?>" />
		<input type="submit" id="searchsubmit" value="" />
	</div>
</form><?php
