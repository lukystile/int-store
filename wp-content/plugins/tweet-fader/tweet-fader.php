<?php
/*
Plugin Name: Tweet Fader
Plugin URI: http://www.logitblog.com/tooling/tweet-fader/
Description: Tweet Fader is the WordPress plugin to show your latest tweets on your WordPress site.
Author: Ryan Bijkerk
Version: 2.0.2
Author URI: http://www.logitblog.com/about/


    Copyright 2016  Ryan Bijkerk  (ryan@logitblog.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include('tweet-fader_widget.php');

function tweet_fader_admin() 
{
    include('tweet-fader_admin.php');
}
 
function tweet_fader_admin_actions() 
{
    add_options_page("Tweet Fader", "Tweet Fader", 1, "Tweet-Fader", "tweet_fader_admin");
}

add_action('admin_menu', 'tweet_fader_admin_actions');
add_action('widgets_init', create_function('', 'return register_widget("tweet_fader_widget");'));

?>