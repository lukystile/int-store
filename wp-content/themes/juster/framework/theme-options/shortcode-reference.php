<?php
/**
 * This file provides a complete
 * Reference to our shortcodes and
 * how to use theme.
 *
 * @since  1.0
 */
?>
<h1>
	<?php echo __('Shortcode Reference', 'juster'); ?>
</h1>
<h3 class="ref-description">
	<?php echo __('All juster Custom Shortcodes* are listed here. So if you forget on how to implement the shortcode, you can reference here. Other shortcodes that generated by a 3rd party plugin are unfortunately not displayed here. Have fun!', 'juster'); ?>
</h3>
<div class="shortcode-context">
<h3 class="shortcode-ref-title">1.) Highlight</h3>
<p><code>Usage: [jt_highlight text="Hello" text_color="#fff" bg_color="#497bb8" text_size="22px" class="custom-class" style="style-one" ]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>text</em></td>
		<td>Text for the highlight</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Color for the highlight text.</td>
		<td>White</td>
	</tr>
	<tr>
		<td><em>bg_color</em></td>
		<td>Background Color for the highlight text.</td>
		<td>Primary Color</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Font size for the highlight text.</td>
		<td>Based on content size.</td>
	</tr>
	<tr>
		<td><em>style</em></td>
		<td>Different style option. Options are : style-one, style-two, style-three,style-four.</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">2.) Dropcaps</h3>
<p><code>Usage: [jt_dropcaps style="style-one" text="Hello" text_color="#fff" text_size="22px" bg_color="#497bb8" border_color="#ffffff" border_bottom_color="#ffffff" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>style</em></td>
		<td>Different style option. Options are : style-one, style-two,style-three.</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td><em>text</em></td>
		<td>Text for the dropcaps</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Color for the dropcaps text.</td>
		<td>Based on Style</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Font size for the dropcaps text.</td>
		<td>Based on content size.</td>
	</tr>
	<tr>
		<td><em>bg_color</em></td>
		<td>Background Color for the dropcaps text.</td>
		<td>Based on Style</td>
	</tr>
	<tr>
		<td><em>border_color</em></td>
		<td>Border Color for the dropcaps text.</td>
		<td>Based on Style</td>
	</tr>
	<tr>
		<td><em>border_bottom__color</em></td>
		<td>Border Bottom Color for the dropcaps text.</td>
		<td>Based on Style</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">3.) Tooltip</h3>
<p><code>Usage: [jt_tooltip tooltip_title="Tooltip Text" text="Hello" text_size="22px" text_color="#fff" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>tooltip_title</em></td>
		<td>Tooltip title.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text</em></td>
		<td>Text for the tooltip</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Font size for the tooltip text.</td>
		<td>Based on content size.</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Color for the tooltip text.</td>
		<td>White</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">4.) Spacer</h3>
<p><code>Usage: [jt_spacer height="10px" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>height</em></td>
		<td>Space height.(Eg:10px)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">5.) Lists </h3>
<p><code>Usage:[jt_lists class="custom-class"][jt_list text="Hello" icon="fa fa-heart" link="http://www.google.com" color="#000" size="22px" icon_color="#000" icon_size="22px" target="yes"][jt_list text="Hello" icon="fa fa-heart" link="http://www.google.com" color="#000" size="22px" icon_color="#000" icon_size="22px" target="yes"][/jt_lists]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>text</em></td>
		<td>Text for the list</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>link</em></td>
		<td>Link for the lists</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the list text.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Font size for text box text.</td>
		<td>18px</td>
	</tr>
	<tr>
		<td><em>icon_color</em></td>
		<td>Color for the list icon.</td>
		<td>#888</td>
	</tr>
	<tr>
		<td><em>icon_size</em></td>
		<td>Size for the list icon.</td>
		<td>18px</td>
	</tr>
	<tr>
		<td><em>target</em></td>
		<td>Open new window.(Ex:yes,no)</td>
		<td>yes</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">6.) Special Heading</h3>
<p><code>Usage: [jt_special_heading style="style-one" text="Hello" tag="h2" color="#000" size="22px" text_transform="" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>style</em></td>
		<td>Different style option. Options are : style-one, style-two,style-three,style-four.</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td><em>Tag</em></td>
		<td>Tag for special heading(Ex:h1,h2,h3,h4,h5,h6)</td>
		<td>h2</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for special heading</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the special heading.</td>
		<td>#232323</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Font size for special heading.</td>
		<td>28px</td>
	</tr>
	<tr>
		<td><em>text_transform</em></td>
		<td>Text transform for the Special heading.(Ex:uppercase,lowercase,capitalize)</td>
		<td>uppercase</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">7.) Special Text</h3>
<p><code>Usage: [jt_special_text text="Hello" color="#000" size="22px" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for special text</td>
		<td>Name</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the special text.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Font size for special text.</td>
		<td>16px</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">8.) Blockquote </h3>
<p><code>Usage: [jt_blockquote style="style-one" content_color="#000" content_size="13px" content="YOUR CONTENT HERE..." link="#0" line_height="20px" text="David Ward" text_color="#000" text_size="22px" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>style</em></td>
		<td>Different style option. Options are : style-one, style-two,style-three</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td>content</td>
		<td>content for blockquote</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>content_color</em></td>
		<td>Color for the blockquote content.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>content_size</em></td>
		<td>Size for the blockquote content.</td>
		<td>17px</td>
	</tr>
	<tr>
		<td><em>link</em></td>
		<td>Link for blockquote</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Text size for the blockquote.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Color for the blockquote.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>line_height</em></td>
		<td>Line height for the content</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">9.) Social Icons </h3>
<p><code>Usage Text: [jt_social_icons style="style-one" heading="Social Icons" class="custom-class"][social text="Facebook" link="http://www.facebook.com" color="#000" size="22px"][jt_social style="style-one" text="Linkedin" link="http://www.linkedin.com" color="#000" size="22px" ][/jt_social_icons]</code></p>
</br>
<p><code>Usage Icon: [jt_social_icons style="style-two" class=""][jt_social  icon="fa fa-facebook" link=""http://www.facebook.com" icon_color="#000" icon_size="18px"][jt_social style="style-two" icon="fa fa-twitter" link="http://www.twitter.com" icon_color="#000" icon_size="18px"][/jt_social_icons]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>style</em></td>
		<td>Different style option. Options are : style-one, style-two,style-three,style-four,style-five,style-six,style-seven,style-eight,style-nine,style-ten,style-eleven</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td>heading</td>
		<td>Heading for social icons</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for social icons</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>icon</td>
		<td>Icon for social icons</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the social icon text.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Size for the social icon text.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>link</em></td>
		<td>Link for blockquote</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>icon_size</em></td>
		<td>Icon size for social icons.</td>
		<td>#888</td>
	</tr>
	<tr>
		<td><em>icon_color</em></td>
		<td>Icon color for the social icons.</td>
		<td>12px</td>
	</tr>
	<tr>
		<td><em>icon_border_color</em></td>
		<td>Border color for the social icons.</td>
		<td>Based on Style</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">10.) H4 </h3>
<p><code>Usage: [jt_h4 title="Hello" color="#000" size="12px" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>title</td>
		<td>title for h4</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the h4.</td>
		<td>#000</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Size for the h4.</td>
		<td>18px</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">11.) Address </h3>
<p><code>Usage: [jt_addresses][jt_address][h4 title="Address" color="" size="" ][jt_special_text text="44 New Design Street, Melbourne 005" color="" size=""][/jt_address][jt_address][h4 title="Social Shares" color="" size="" ][jt_social_icons style="style-two" class=""][jt_social  icon="fa fa-facebook" link="#0" icon_color="" icon_size=""][jt_social style="style-two" icon="fa fa-linkedin" link="#0" icon_color="" icon_size=""][jt_social style="style-two" icon="fa fa-twitter" link="#0" icon_color="" icon_size=""][/jt_social_icons][/jt_address][/jt_addresses]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">12.) Social Share </h3>
<p><code>Usage: [jt_social_share style="style-one" class="custom-class" text="Share"][jt_icons facebook="yes" twitter="yes" linkedin="yes" google_plus="yes" icon_color="" icon_size=""][/jt_social_share]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>style</td>
		<td>Different style option. Options are :style-one,style-two</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td>twitter</td>
		<td>twitter for social share(Eg:yes,no)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>facebook</td>
		<td>facebook for social share(Eg:yes,no)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>google_plus</td>
		<td>google_plus for social share(Eg:yes,no)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>linkedin</td>
		<td>linkedin for social share(Eg:yes,no)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for social share</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>icon_color</em></td>
		<td>Color for the social share.</td>
		<td>#232323</td>
	</tr>
	<tr>
		<td><em>icon_size</em></td>
		<td>Size for the social share.</td>
		<td>13px</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">13.) Steps </h3>
<p><code>Usage: [jt_steps heading="Creative Concept" icon="pe-7s-loop" heading_color="" icon_color="" heading_size="" icon_size="" step_type="plus" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>step_type</td>
		<td>step_type for steps(Eg:plus,equal)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>heading</td>
		<td>heading for steps</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>icon</td>
		<td>icon for steps</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>heading_color</em></td>
		<td>Heading color for the steps.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>heading_size</em></td>
		<td>Heading size for the steps.</td>
		<td>12px</td>
	</tr>
	<tr>
		<td><em>icon_color</em></td>
		<td>Icon color for the steps.</td>
		<td>#000</td>
	</tr>
	<tr>
		<td><em>icon_size</em></td>
		<td>Icon size for the steps.</td>
		<td>32px</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">14.) Custom Button</h3>
<p><code>Usage: [jt_custom_button button_text="Hello" link="http://www.google.com" target="yes" size="20px" color="#DD3533" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td><em>button_text</em></td>
		<td>Text for the custom button</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>link</em></td>
		<td>Custom button Link</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>target</em></td>
		<td>Custom button Link Target. Options : yes,no.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Font size for the custom button text.</td>
		<td>12px</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the custom button text.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">15.) Special Content </h3>
<p><code>Usage: [jt_special_content style="style-one" class="custom-class" heading="Lorem ipsum" heading_color="" heading_size="" content_color="" content_size=""]YOUR CONTENT HERE...[/jt_special_content]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>style</td>
		<td>Different style option. Options are :style-one,style-two,style-three</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td><em>heading</em></td>
		<td>Heading for the special heading</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>heading_color</em></td>
		<td>Heading color for the special heading.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>heading_size</em></td>
		<td>Heading size for the special heading.</td>
		<td>14px</td>
	</tr>
	<tr>
		<td><em>content_color</em></td>
		<td>Content color for the special heading.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>content_size</em></td>
		<td>Content size for the special heading.</td>
		<td>15px</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">16.) Intro Text </h3>
<p><code>Usage: [jt_intro_text text="Hello" bold_text="Welcome" color="" size="" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for intro text</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>blod_text</td>
		<td>Bold text for intro text</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Font size for the intro text.</td>
		<td>35px</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the intro text.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">17.) Portfolio Custom Meta </h3>
<p><code>Usage: [jt_portfolio_custom_meta style="style-one" class="custom-class"][jt_portfolio_meta title="Client" text="Loren Hanson" title_color="" title_size="" text_size="" text_color="" link="#0" target="yes"][jt_portfolio_meta title="Type" text="Commercial" title_color="" title_size="" text_size="" text_color="" link="#0" target="yes"][/jt_portfolio_custom_meta]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>style</td>
		<td>Different style option. Options are :style-one,style-two,style-three,style-four,style-five</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td>title</td>
		<td>Title for portfolio custom meta</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for portfolio custom meta</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>title_size</em></td>
		<td>Title size for the portfolio custom meta.</td>
		<td>12px</td>
	</tr>
	<tr>
		<td><em>title_color</em></td>
		<td>Title color for the portfolio custom meta.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Text size for the portfolio custom meta.</td>
		<td>16px</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Text color for the portfolio custom meta.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">18.) About List </h3>
<p><code>Usage: [jt_about_list heading="Master Degree of design" text="University of Design - 2012" heading_color="" heading_size="" color="" size="" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>heading</td>
		<td>Heading for about list</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for about list</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>heading_size</em></td>
		<td>Heading size for the about list.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>heading_color</em></td>
		<td>Heading color for the about list.</td>
		<td>#333</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Text size for the about list.</td>
		<td>16px</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Text color for the about list.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">19.) Contact Details </h3>
<p><code>Usage: [jt_contact_details icon="pe-7s-call" text="+1 (123) 456-7890-321" icon_color="#888" icon_size="15px" color="#000" size="16px" class=""]</code></p>
</br>
<p><code>Usage: [jt_contact_details image_url="YOUR IMAGE URL" text="+1 (123) 456-7890-321" color="#000" size="16px" class=""]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for link text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>icon</td>
		<td>Icon for contact details.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>image_url</td>
		<td>image url for contact details.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>icon_size</em></td>
		<td>Icon size for the contact details.</td>
		<td>25px</td>
	</tr>
	<tr>
		<td><em>icon_color</em></td>
		<td>Icon color for the contact details.</td>
		<td>#333</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Size for the contact details text.</td>
		<td>16px</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the contact details text.</td>
		<td>#1A1A1A</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">20.) Typing Text </h3>
<p><code>Usage: [jt_typing_text normal_text="Handcrafted designs &amp; " animation_text="Experiences, Innovation, Excellence" type_speed="30" back_delay="500" loop="true" cursor="|"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>normal_text</td>
		<td>Normal Text for typing text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>animation_text</td>
		<td>Animation Text for typing text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>type_speed</td>
		<td>Speed for typing text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>back_delay</td>
		<td>Erasing time for typing text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>loop</td>
		<td>Loop count for typing text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>cursor</td>
		<td>Cursor for typing text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">21.) Separator </h3>
<p><code>Usage: [jt_separator type="type-one" align="center" class="custom-class"]</code></p>
</br>
<p><code>Usage: [jt_separator type="type-two" title="" align="center" class="custom-class"]</code></p>
</br>
<p><code>Usage: [jt_separator type="type-three" align="center" sep_width="50px" sep_height="5px" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>type</td>
		<td>Different style option. Options are :type-one,type-two,type-three.</td>
		<td>type-one</td>
	</tr>
	<tr>
		<td>align</td>
		<td>Different style option. Options are :center,left,right.</td>
		<td>center</td>
	</tr>
	<tr>
		<td>title</td>
		<td>Title for the separator</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>sep_width</em></td>
		<td>Width for the separator</td>
		<td>20px</td>
	</tr>
	<tr>
		<td><em>separator_color</em></td>
		<td>Color for the separator.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">22.) Subscribe </h3>
<p><code>Usage: [jt_subscribe class="custom-class" text="Newsletter Subscribe" text_color="#000" text_size="18px"]abcdesdgtdfhg[/subscribe]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for subscribe</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Text size for the subscribe.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Text color for the subscribe.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">23.) Language </h3>
<p><code>Usage: [jt_language_select class="custom-class"][jt_language text="en" link="http://www.google.com" color="#000" size="15px"][jt_language text="de" link="http://www.google.com" color="#000" size="15px"][/jt_language_select]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for language</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>link</em></td>
		<td>Language text link</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Text size for the language.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Text color for the language.</td>
		<td>#AAA</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">24.) Text Icon </h3>
<p><code>Usage Icon: [jt_text_icon style="style-one" icon="pe-7s-call" title="Call" text="+(61) 123 456 7890" icon_color="" icon_size="" title_color="" title_size="" text_color="" text_size="" class="custom-class"]</code></p>
<br>
<p><code>Usage Icon: [jt_text_icon style="style-two" icon="pe-7s-call" title="Call" text="+(61) 123 456 7890" link="" icon_color="" icon_size="" title_color="" title_size="" class="custom-class"]</code></p>
<br>
<p><code>Usage Image: [jt_text_icon style="style-three" image_url="YOUR IMAGE URL" text="Hello" text_color="" text_size="" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>style</td>
		<td>Different style option. Options are :style-one,style-two,style-three.</td>
		<td>style-three</td>
	</tr>
	<tr>
		<td>title</td>
		<td>Title for text icon.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for text icon.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>icon</td>
		<td>Icon for text icon.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>image_url</td>
		<td>Image url for text icon.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>link</td>
		<td>Link for text icon.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>title_size</em></td>
		<td>Title size for text icon.</td>
		<td>16px</td>
	</tr>
	<tr>
		<td><em>title_color</em></td>
		<td>Title color for text icon.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>target</em></td>
		<td>Open new window.(Ex:yes,no)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Text size for the text icon.</td>
		<td>16px</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Text color for the text icon.</td>
		<td>#D0D0D0</td>
	</tr>
	<tr>
		<td><em>icon_size</em></td>
		<td>Icon size for the text icon.</td>
		<td>20px</td>
	</tr>
	<tr>
		<td><em>icon_color</em></td>
		<td>Icon color for the text icon.</td>
		<td>#333</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">25.) Dropdown Menu </h3>
<p><code>Usage Without Image: [jt_topbar_dropdown title="My Account" class="" title_color="" title_size="" title_link="#0" target="yes"][jt_dropdown_menu text="Login" size="" link="" target="yes"][jt_dropdown_menu text="Sign up" color="" size="" link="" target="yes"][/jt_topbar_dropdown]</code></p>
<br>
<p><code>Usage With Image: [jt_topbar_dropdown title="EN" class="" title_color="" title_size="" title_link="#0" target="yes"][jt_dropdown_menu image_url="YOUR IMAGE URL" text="english" color="" size="" link="" target="yes"][jt_dropdown_menu image_url="YOUR IMAGE URL" text="Japanese" color="" size="" link="" target="yes"][/jt_topbar_dropdown]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>title</td>
		<td>Title for dropdown menu.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>title_link</td>
		<td>Title link for dropdown menu.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>title_size</em></td>
		<td>Title size for the dropdown menu.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>title_color</em></td>
		<td>Title color for the dropdown menu.</td>
		<td>#D0D0D0</td>
	</tr>
	<tr>
		<td><em>target</em></td>
		<td>Open new window.(Ex:yes,no)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for dropdown menu item.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>text_link</td>
		<td>Text link for dropdown menu item.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>image_url</td>
		<td>Image url for dropdown menu item.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Size for the dropdown menu item.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the dropdown menu item.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">26.) Footer Content </h3>
<p><code>Usage: [jt_footer_content style="style-one" class="custom-class"]YOUR CONTENT HERE...[/jt_footer_content]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>style</td>
		<td>Different style option. Options are :style-one,style-two.</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">27.) Back Text </h3>
<p><code>Usage: [jt_back_text  text="VINTOX" front_text_color="#000" back_text_color="#999" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for backtext.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>front_text_color</td>
		<td>Front text color</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td>back_text_color</td>
		<td>Back text color </td>
		<td>#F5F5F5</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">28.) Link Text </h3>
<p><code>Usage: [jt_link_text style="style-one" text="View More Works" link="http://www.google.com" color="#000" size="16px" class="custom-class"]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>type</td>
		<td>Different style option. Options are :style-one, style-two.</td>
		<td>style-one</td>
	</tr>
	<tr>
		<td>text</td>
		<td>Text for link text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>link</td>
		<td>Link for link text.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>size</em></td>
		<td>Size for the link text.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>color</em></td>
		<td>Color for the link text.</td>
		<td>#35373E</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">29.) Social Counter </h3>
<p><code>Usage: [jt_social_counter class=""][jt_social_like_count icon="fa fa-twitter" text="Twitter" number="25 758" link="" icon_color="" icon_size="" icon_border_color="" text_color="" text_size="" number_color="" number_size="" ][jt_social_like_count icon="fa fa-linkedin" text="Linkedin" link="" number="7 854" icon_color="" icon_size="" icon_border_color="" text_color="" text_size="" number_color="" number_size="" ][/jt_social_counter]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>text</td>
		<td>text for social counter.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>link</td>
		<td>link for social counter.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>text_size</em></td>
		<td>Text size for social counter.</td>
		<td>11px</td>
	</tr>
	<tr>
		<td><em>text_color</em></td>
		<td>Text color for social counter.</td>
		<td>#CCC</td>
	</tr>
	<tr>
		<td>icon</td>
		<td>Icon for social counter</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>icon_color</em></td>
		<td>Icon color for the social counter.</td>
		<td>#F7F8F9</td>
	</tr>
	<tr>
		<td><em>icon_size</em></td>
		<td>Icon size for the social counter.</td>
		<td>14px</td>
	</tr>
	<tr>
		<td><em>icon_border_color</em></td>
		<td>Icon Border color for the social counter.</td>
		<td>#CCC</td>
	</tr>
	<tr>
		<td>Number</td>
		<td>Number for social counter</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>number_color</em></td>
		<td>Number color for the social counter.</td>
		<td>#999</td>
	</tr>
	<tr>
		<td><em>number_size</em></td>
		<td>Number size for the social counter.</td>
		<td>14px</td>
	</tr>
	<tr>
		<td><em>target</em></td>
		<td>Open new window.(Ex:yes,no)</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>

<h3 class="shortcode-ref-title">30.) Product Carousel </h3>
<p><code>Usage: [jt_product_carousel title="Top Rated"][jt_slide_set carousel_bg_color=""][jt_carousel_products limit="3" id="99,96,93" order="" orderby="rating"][/jt_slide_set][jt_slide_set][jt_carousel_products limit="3" id="73,76,79" order="" orderby="date"][/jt_slide_set][jt_slide_set][jt_carousel_products limit="4" id="" order="ASC" orderby=""][/jt_slide_set][jt_slide_set][jt_carousel_products limit="4" id="" order="DESC" orderby=""][/jt_slide_set][/jt_product_carousel]</code></p>
<h5>Shortcode Options:</h5>
<table class="wp-list-table widefat fixed posts">
	<tr>
		<th>ID</th>
		<th>Description</th>
		<th>Default Value</th>
	</tr>
	<tr>
		<td>title</td>
		<td>Title for product carousel.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>bg_color</td>
		<td>Background color for product carousel.</td>
		<td>#fff</td>
	</tr>
	<tr>
		<td>limit</td>
		<td>Number of products display per slider.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>order</td>
		<td>Products display assending or dissending.</td>
		<td>Null</td>
	</tr>
	<tr>
		<td>order_by</td>
		<td>Products display order by date or comment rating .</td>
		<td>Null</td>
	</tr>
	<tr>
		<td><em>class</em></td>
		<td>You can edit this shortcode style by using class name.</td>
		<td>Null</td>
	</tr>
</table><p></p>
</div><?php
