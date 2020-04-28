=== Plugin Name ===
Contributors: RBijkerk
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7WFMQMNFFN3WS
Tags: twitter, tweets, tweet-fader, fadein, fadeout, jquery, tweet fader, timestamp, api v1.1
Tested up to: 4.9.6
Stable tag: 2.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Tweet Fader is the Twitter plugin that shows your latest tweets on your WordPress site.

== Description ==

Tweet Fader is a WordPress plugin to show your latest tweets on your WordPress site.
By the Tweet Fader widget you can position the exact location to show your tweet.

This empsise focus on the tweets signle tweets are displayed with a nice transition effect to the next tweets.
It is a clean and simple look integrated nativly in your WordPress theme.

== Installation ==

You can install Tweet Fader using the built in WordPress plugin installer. 
Use the add `Upload` option to select the Tweet Fader zip file. 
If you download Tweet Fader manually, make sure it is uploaded to `/wp-content/plugins/tweet-fader/`.

Activate Tweet Fader in the `Plugins` admin panel using the `Activate` link.

Now the Tweet Fader is ready to be configured.

Open the `Settings\Tweet Fader` admin panel to authorize Tweet Fader to access your Twitter.
Click the `Sign in with Twitter` button to sign in.
After you succesfully signed in Twitter the admin panel will show `You are signed in as: [twitter name]`

Go to the `Appearance\Widgets` admin panel and add the Tweet Fader widget to the `Sidebar` or `Footer Area`.

With the current version the following settings can be set:

Widget header (optional):
The header text display above the widget.

Number of tweets (required):
The total amount of tweets that will be displayed.

Interval between tweets in seconds (optional):
The amount of seconds until the next tweet will be displayed. When the option is not set it will be 10 seconds.

Show timestamp at tweet:
Check the checkbox to enable the timestamp at each tweet.

Open link in a new window/tab:
Check the checkbox to open each link in a new window or tab.

== Requirements ==

Your theme must support widgets in order to use the Tweet Fader widget.

JQuery must be enabled in your theme. 
When all required Tweet Fader settings are configured and the tweets are not displayed, JQuery is probably not enabled in your theme. 
In order to enable JQuery try to add the following line in the `header.php` under the tag `<head>`:

`<?php wp_enqueue_script('jquery'); ?>`

== Screenshots ==

1. The Tweet Fader settings page.
2. The Tweet Fader widget settings.
3. Tweet Fader on the WordPress site.

== Changelog ==

= 0.1.0 =
* Beta Release

= 1.0 =
* Twitter API updated

= 1.1.1 =
* Improved the character support.

= 1.1.2 =
* Fixed bug with the character &.

= 1.2.0 =
* Added timestamp function
* Added link option

= 1.2.1 =
* Link bug fixed

= 1.3.0 =
* Moved to API 1.1

= 2.0.0 =
* Rebuild of Tweet Fader with TwitterOauth support to sign in Twitter
* Settings page added to authorize with Twitter

= 2.0.1 =
* Removed cut-off urls from the tweet

= 2.0.2 =
* Resolved bug: cannot retrieve config and token