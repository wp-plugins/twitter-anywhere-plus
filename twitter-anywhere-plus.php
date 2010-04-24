<?php

/*

Plugin Name: Twitter @Anywhere Plus
Plugin URI: http://www.ngeeks.com/proyectos/twitter-anywhere-plus/
Description: This plugin allows you to easily add Twitter @Anywhere to your blog, enabling the @Anywhere features.
Version: 1.2
Author: GeekRMX
Author URI: http://www.ngeeks.com/
License: GPLv3

*************************************************************************

Copyright (C) 2010 nGeeks.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*************************************************************************

*/

load_plugin_textdomain('tap', false, dirname(plugin_basename( __FILE__ )).'/languages/');

// ADMIN MENU

add_action('admin_menu', 'twitter_anywhere_plus_menu');

function twitter_anywhere_plus_menu() {
	add_options_page('Twitter @Anywhere Plus', 'Twitter @Anywhere Plus', 'administrator', 'twitter-anywhere-plus', 'twitter_anywhere_plus_options');
}

function twitter_anywhere_plus_options() {
	
	if(isset($_POST['submit'])) {
		$api_key = $_POST['tap_api_key'];
		update_option('tap_api_key', $api_key);
		
		if(isset($_POST['linkifyUsers'])) {
			update_option('tap_linkifyUsers', 'yes');
		}
		else
		{
			update_option('tap_linkifyUsers', 'no');
		}
		
		if(isset($_POST['hovercards'])) {
			update_option('tap_hovercards', 'yes');
		}
		else
		{
			update_option('tap_hovercards', 'no');
		}
		
		if(isset($_POST['followButton'])) {
			update_option('tap_followButton', 'yes');
		}
		else
		{
			update_option('tap_followButton', 'no');
		}
		
		update_option('tap_followButton_dom', $_POST['followButton_dom']);
		update_option('tap_followButton_user', $_POST['followButton_user']);
		
		echo '<div class="updated"><p><strong>'.__("Options saved.","tap").'</strong></p></div>';
	}
	
	$tap_api_key = get_option('tap_api_key');
	$tap_linkifyUsers = get_option('tap_linkifyUsers');
	$tap_hovercards = get_option('tap_hovercards');
	$tap_followButton = get_option('tap_followButton');
	$tap_followButton_dom = get_option('tap_followButton_dom');
	$tap_followButton_user = get_option('tap_followButton_user');
	$tap_twitter_id = get_option('tap_twitter_id');

?>

<div class="wrap">
<h2>Twitter @Anywhere Plus</h2>
<hr />
<form name="form1" method="post" action="">
<p><?php _e('In order to use @Anywhere, you must first register your blog for a free API key with Twitter.<br />You can do so at the following URL:','tap'); ?> <a href="http://dev.twitter.com/anywhere/apps/new" target="_blank">http://dev.twitter.com/anywhere/apps/new</a></p>
<p><?php _e("Your @Anywhere API key:","tap"); ?> <input type="text" name="tap_api_key" value="<?php echo $tap_api_key; ?>" size="30"></p>
<h3><?php _e('@Anywhere features','tap'); ?></h3>

<p><label><input type="checkbox" name="linkifyUsers" <?php if($tap_linkifyUsers == 'yes') { echo 'checked="checked"'; } ?> /> <strong><?php _e('Auto-linkification of @usernames','tap'); ?></strong></label></p>
<p><small><?php _e('Turn Twitter usernames into links.','tap'); ?></small></p>

<p><label><input type="checkbox" name="hovercards" <?php if($tap_hovercards == 'yes') { echo 'checked="checked"'; } ?> /> <strong><?php _e('Hovercards','tap'); ?></strong></label></p>
<p><small><?php _e('Show hovercard when you move the mouse over a Twitter username.','tap'); ?></small></p>

<p><label><input type="checkbox" name="followButton" <?php if($tap_followButton == 'yes') { echo 'checked="checked"'; } ?> /> <strong><?php _e('Follow button','tap'); ?></strong></label></p>
<p><small><?php _e('Show a follow button where you want it to be placed.','tap'); ?></small></p>
<table border="0">
  <tr>
    <td><?php _e("Twitter username:","tap"); ?></td>
    <td><input type="text" name="followButton_user" value="<?php echo $tap_followButton_user; ?>" size="30"></td>
  </tr>
  <tr>
    <td><?php _e("DOM element:","tap"); ?></td>
    <td><input type="text" name="followButton_dom" value="<?php echo $tap_followButton_dom; ?>" size="30"></td>
  </tr>
  <tr>
    <td colspan="2"><small><?php _e("The <em>id</em> or <em>class</em> of the element (div, p) where the button must be inserted.","tap"); ?></small><br />
    <small><u><?php _e("Example:","tap"); ?></u><br />
    <?php _e("You can create a Text widget with the following code inside:","tap"); ?><br />
    <code>&lt;div id="followButton"&gt;&lt;/div&gt;</code> (<?php _e("DOM element:","tap"); ?> <code>#followButton</code>)<br />
    <?php _e("You can also use classes:","tap"); ?><br />
    <code>&lt;p class="followButton"&gt;&lt;/p&gt;</code> (<?php _e("DOM element:","tap"); ?> <code>.followButton</code>)
    </td>
    </tr>
</table>

<hr />
<p class="submit"><input type="submit" class="button-primary" name="submit" value="<?php _e('Save changes','tap'); ?>" /></p>
</form>

<p><?php _e('This plugin has been developed by <strong>GeekRMX</strong>.','tap'); ?></p>
<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=contacto%40ngeeks%2ecom&lc=ES&item_name=Twitter%20%40Anywhere%20Plus&item_number=WordPress%20Plugin&cn=Your%20name%20and%20website%3f&no_shipping=1&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted" target="_blank"><img src="<?php echo WP_PLUGIN_URL.'/'.dirname(plugin_basename( __FILE__ )).'/paypal.gif'; ?>" alt="Donate"  border="0" /></a></p>
<p><strong><?php _e('Website:','tap'); ?></strong> <a href="http://www.ngeeks.com" target="_blank">nGeeks.com</a></p>
</div>

<?php
}
?>
<?php

// ADD TWITTER @ANYWHERE PLUS

add_action('wp_head','TwitterAnywherePlus');

function TwitterAnywherePlus($post_id) {
	
	$tap_api_key = get_option('tap_api_key');
	
	if($tap_api_key != '') {
		$version = '1';
		$output = '<!-- Twitter @Anywhere Plus 1.0 by GeekRMX - http://www.ngeeks.com -->
<script src="http://platform.twitter.com/anywhere.js?id='.$tap_api_key.'&v='.$version.'" type="text/javascript"></script>
<script type="text/javascript">
twttr.anywhere(onAnywhereLoad);
function onAnywhereLoad(twitter) {
// configure the @anywhere environment
'.anywhereOptions().'};
</script>
<!-- /Twitter @Anywhere Plus -->'."\n";
		
		echo $output;
	}
}

function anywhereOptions() {
	
	$selected_options = '';
	
	if(get_option('tap_linkifyUsers') == 'yes') {
		$selected_options .= 'twitter.linkifyUsers();'."\n";
	}
	
	if(get_option('tap_hovercards') == 'yes') {
		$selected_options .= 'twitter.hovercards();'."\n";
	}
	
	$tap_followButton_dom = get_option('tap_followButton_dom');
	$tap_followButton_user = get_option('tap_followButton_user');
	
	if( (get_option('tap_followButton') == 'yes') && ($tap_followButton_dom != '') && ($tap_followButton_user != '') ) {
		$selected_options .= 'twitter("'.$tap_followButton_dom.'").followButton("'.$tap_followButton_user.'");'."\n";
	}
	
	
	
	return $selected_options;
}

?>