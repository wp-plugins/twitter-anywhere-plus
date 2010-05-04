<?php

/*

Plugin Name: Twitter @Anywhere Plus
Plugin URI: http://www.ngeeks.com/proyectos/twitter-anywhere-plus/
Description: This plugin allows you to easily add Twitter @Anywhere to your blog, enabling the @Anywhere features.
Version: 1.5
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
		
		if(isset($_POST['linkifyUsers'])) { update_option('tap_linkifyUsers', 'yes'); } else { update_option('tap_linkifyUsers', 'no'); }
		
		if(isset($_POST['hovercards'])) { update_option('tap_hovercards', 'yes'); } else { update_option('tap_hovercards', 'no'); }
		
		if(isset($_POST['followButton'])) { update_option('tap_followButton', 'yes'); } else { update_option('tap_followButton', 'no'); }
		
		update_option('tap_followButton_dom', $_POST['followButton_dom']);
		update_option('tap_followButton_user', $_POST['followButton_user']);
		
		if(isset($_POST['tweetBox'])) { update_option('tap_tweetBox', 'yes'); } else { update_option('tap_tweetBox', 'no'); }
		
		$tBwidth = (((int) $_POST['tweetBox_width']) == 0) ? '' : (int) $_POST['tweetBox_width'];
		$tBheight = (((int) $_POST['tweetBox_height']) == 0) ? '' : (int) $_POST['tweetBox_height'];
		
		update_option('tap_tweetBox_width', $tBwidth);
		update_option('tap_tweetBox_height', $tBheight);
		update_option('tap_tweetBox_label', $_POST['tweetBox_label']);
		update_option('tap_tweetBox_content', $_POST['tweetBox_content']);
		if(isset($_POST['tweetBox_ts'])) { update_option('tap_tweetBox_ts', 'yes'); } else { update_option('tap_tweetBox_ts', 'no'); }
		
		if(isset($_POST['retweet'])) { update_option('tap_retweet', 'yes'); } else { update_option('tap_retweet', 'no'); }
		
		update_option('tap_retweet_label', $_POST['retweet_label']);
		update_option('tap_retweet_content', $_POST['retweet_content']);
		if(isset($_POST['retweet_ts'])) { update_option('tap_retweet_ts', 'yes'); } else { update_option('tap_retweet_ts', 'no'); }
		update_option('tap_retweet_bird', $_POST['retweet_bird']);
		
		echo '<div class="updated"><p><strong>'.__("Options saved.","tap").'</strong></p></div>';
	}
	
	$tap_api_key = get_option('tap_api_key');
	
	$tap_linkifyUsers = get_option('tap_linkifyUsers');
	$tap_hovercards = get_option('tap_hovercards');
	
	$tap_followButton = get_option('tap_followButton');
	$tap_followButton_dom = get_option('tap_followButton_dom');
	$tap_followButton_user = get_option('tap_followButton_user');
	
	$tap_tweetBox = get_option('tap_tweetBox');
	$tap_tweetBox_width = get_option('tap_tweetBox_width');
	$tap_tweetBox_height = get_option('tap_tweetBox_height');
	$tap_tweetBox_label = get_option('tap_tweetBox_label');
	$tap_tweetBox_content = get_option('tap_tweetBox_content');
	$tap_tweetBox_ts = get_option('tap_tweetBox_ts');
	
	$tap_retweet = get_option('tap_retweet');
	$tap_retweet_label = get_option('tap_retweet_label');
	$tap_retweet_content = get_option('tap_retweet_content');
	$tap_retweet_ts = get_option('tap_retweet_ts');
	$tap_retweet_bird = get_option('tap_retweet_bird');
	
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

<p><label><input type="checkbox" name="tweetBox" <?php if($tap_tweetBox == 'yes') { echo 'checked="checked"'; } ?> /> <strong><?php _e('Tweet Box','tap'); ?></strong></label></p>
<p><small><?php _e('Show a tweet box below your posts.','tap'); ?></small></p>
<table border="0">
  <tr>
    <td><?php _e("Width:","tap"); ?></td>
    <td><input type="text" name="tweetBox_width" value="<?php echo $tap_tweetBox_width; ?>" size="20"> <small><?php _e("Default:","tap"); ?> 515 (px)</small></td>
  </tr>
  <tr>
    <td><?php _e("Height:","tap"); ?></td>
    <td><input type="text" name="tweetBox_height" value="<?php echo $tap_tweetBox_height; ?>" size="20"> <small><?php _e("Default:","tap"); ?> 65 (px)</small></td>
  </tr>
  <tr>
    <td><?php _e("Label:","tap"); ?></td>
    <td><input type="text" name="tweetBox_label" value="<?php echo $tap_tweetBox_label; ?>" size="20"> <small><?php _e("Default:","tap"); ?> What's happening?</small></td>
  </tr>
  <tr>
    <td><?php _e("Content:","tap"); ?></td>
    <td><input type="text" name="tweetBox_content" value="<?php echo $tap_tweetBox_content; ?>" size="50"></td>
  </tr>
  <tr>
    <td colspan="2"><input type="checkbox" name="tweetBox_ts" <?php if($tap_tweetBox_ts == 'yes') { echo 'checked="checked"'; } ?> /> <small><?php _e("Show post title and short URL instead of a custom text.","tap"); ?></small></td>
    </tr>
</table>

<p><label><input type="checkbox" name="retweet" <?php if($tap_retweet == 'yes') { echo 'checked="checked"'; } ?> /> <strong><?php _e('Retweet button','tap'); ?></strong></label></p>
<p><small><?php _e('Show a "Retweet" button on the top right corner of your posts.<br />(Clicking the button will launch a Tweet Box with a Lightbox effect.)','tap'); ?></small></p>
<table border="0">
  <tr>
    <td><?php _e("Label:","tap"); ?></td>
    <td><input type="text" name="retweet_label" value="<?php echo $tap_retweet_label; ?>" size="20"> <small><?php _e("Default:","tap"); ?> <?php _e("What's happening?","tap"); ?></small></td>
  </tr>
  <tr>
    <td><?php _e("Content:","tap"); ?></td>
    <td><input type="text" name="retweet_content" value="<?php echo $tap_retweet_content; ?>" size="50"></td>
  </tr>
  <tr>
    <td colspan="2"><input type="checkbox" name="retweet_ts" <?php if($tap_retweet_ts == 'yes') { echo 'checked="checked"'; } ?> /> <small><?php _e("Show post title and short URL instead of a custom text.","tap"); ?></small></td>
  </tr>
  <tr>
    <td colspan="2"><?php _e("Twitter bird:","tap"); ?> &nbsp;<label><input name="retweet_bird" type="radio" value="1" <?php if(($tap_retweet_bird == '1') || ($tap_retweet_bird == '')) { echo 'checked="checked"'; } ?> /> <img src="<?php echo plugins_url("/lightdiv/twitter1.png", __FILE__); ?>"  border="0" align="absmiddle" /></label> &nbsp;&nbsp;<label><input name="retweet_bird" type="radio" value="2" <?php if($tap_retweet_bird == '2') { echo 'checked="checked"'; } ?> /><img src="<?php echo plugins_url("/lightdiv/twitter2.png", __FILE__); ?>"  border="0" align="absmiddle" /></label> &nbsp;&nbsp;<label><input name="retweet_bird" type="radio" value="none" <?php if($tap_retweet_bird == 'none') { echo 'checked="checked"'; } ?> /><small> <?php _e("None","tap"); ?></small></label></td>
  </tr>
</table>

<hr />
<p class="submit"><input type="submit" class="button-primary" name="submit" value="<?php _e('Save changes','tap'); ?>" /></p>
</form>

<p><?php _e('This plugin has been developed by <strong>GeekRMX</strong>.','tap'); ?></p>
<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=paypal%40ngeeks%2ecom&lc=ES&item_name=Twitter%20%40Anywhere%20Plus&item_number=WordPress%20Plugin&cn=Your%20name%20and%20website%3f&no_shipping=1&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted" target="_blank"><img src="<?php echo WP_PLUGIN_URL.'/'.dirname(plugin_basename( __FILE__ )).'/images/paypal.gif'; ?>" alt="Donate"  border="0" /></a></p>
<p><strong><?php _e('Website:','tap'); ?></strong> <a href="http://www.ngeeks.com" target="_blank">nGeeks.com</a></p>
</div>

<?php
}

// ADD TWITTER @ANYWHERE PLUS

add_action('wp_head','TwitterAnywherePlus');
add_filter('the_content','tweetBoxDiv');
add_filter('the_content','retweetButton');
add_filter('the_posts', 'retweetFiles');

function retweetFiles($posts) {
	if ( !is_admin() && (get_option('tap_retweet') == 'yes') && (get_option('tap_api_key') != '') && is_single() ) {
		wp_enqueue_style("lightdiv", plugins_url("/lightdiv/lightdiv.css", __FILE__));
		wp_enqueue_script("lightdiv", plugins_url("/lightdiv/lightdiv.js", __FILE__), array('jquery'));
	}
	
	return $posts;
}

function titleShortUrl() {
	global $post;
	
	// $url = get_permalink($post->ID);
	// $id = url_to_postid($url);
	$short = get_bloginfo('url').'/?p='.$post->ID;
	
	$title = str_replace("\\", "\\\\", $post->post_title);
	$title = str_replace('"', '\"', $title);
	
	return $title.' - '.$short;
}

function TwitterAnywherePlus($post_id) {
	
	$tap_api_key = get_option('tap_api_key');
	
	if($tap_api_key != '') {
		$version = '1';
		$output = '
<!-- Twitter @Anywhere Plus v1.4 by GeekRMX - http://www.ngeeks.com -->
<script src="http://platform.twitter.com/anywhere.js?id='.$tap_api_key.'&v='.$version.'" type="text/javascript"></script>
<script type="text/javascript">
twttr.anywhere(function (T) {
// configure the @anywhere environment
'.anywhereOptions().'});
</script>'.jsOptions().cssOptions().'
<!-- /Twitter @Anywhere Plus -->
';
		
		echo $output;
	}
}

function anywhereOptions() {
	
	$selected_options = '';
	
	if(get_option('tap_linkifyUsers') == 'yes') {
		$selected_options .= 'T.linkifyUsers();'."\n";
	}
	
	if(get_option('tap_hovercards') == 'yes') {
		$selected_options .= 'T.hovercards();'."\n";
	}
	
	$tap_followButton_dom = get_option('tap_followButton_dom');
	$tap_followButton_user = get_option('tap_followButton_user');
	
	if( (get_option('tap_followButton') == 'yes') && ($tap_followButton_dom != '') && ($tap_followButton_user != '') ) {
		$selected_options .= 'T("'.$tap_followButton_dom.'").followButton("'.$tap_followButton_user.'");'."\n";
	}
	
	$tap_tweetBox_height = get_option('tap_tweetBox_height');
	$tap_tweetBox_width = get_option('tap_tweetBox_width');
	$tap_tweetBox_label = get_option('tap_tweetBox_label');
	$tap_tweetBox_content = get_option('tap_tweetBox_content');
	$tap_tweetBox_ts = get_option('tap_tweetBox_ts');
	
	if( (get_option('tap_tweetBox') == 'yes') && is_single() ) {
		
		$selected_options .= 'T("#tweetBox").tweetBox({'."\n";
		if($tap_tweetBox_height != '') $selected_options .= 'height: '.$tap_tweetBox_height.','."\n";
		if($tap_tweetBox_width != '') $selected_options .= 'width: '.$tap_tweetBox_width.','."\n";
		if($tap_tweetBox_label != '') $selected_options .= 'label: "'.$tap_tweetBox_label.'",'."\n";
		if( ($tap_tweetBox_content != '') && ($tap_tweetBox_ts != 'yes') ) {
			$selected_options .= 'defaultContent: "'.$tap_tweetBox_content.'",'."\n";
		}
		elseif($tap_tweetBox_ts == 'yes')
		{
			$selected_options .= 'defaultContent: "'.titleShortUrl().'",'."\n";
		}
		$selected_options .= '});'."\n";
	}
	
	return $selected_options;
}

function jsOptions() {
	
	$options = '';
	
	if( (get_option('tap_retweet') == 'yes') && is_single() ) {
		$rtLabel = (get_option('tap_retweet_label') == '') ? __("What's happening?","tap") : get_option('tap_retweet_label');
		$rtContent = (get_option('tap_retweet_ts') == 'yes') ? titleShortUrl() : get_option('tap_retweet_content');
		
		$options .= '
<script type="text/javascript">
/* <![CDATA[ */
var TwitterAnywherePlus = {
	rtLabel: "'.$rtLabel.'",
	rtContent: "'.$rtContent.'"
};
/* ]]> */
</script>';
	}
	
	return $options;
}

function cssOptions() {
	
	$options = '';
	
	if( (get_option('tap_retweet') == 'yes') && is_single() && (get_option('tap_retweet_bird') != 'none') ) {
		$bird = (get_option('tap_retweet_bird') == '2') ? '2' : '1';
		
		$options .= '
<style type="text/css">
<!--
#lightdiv .twitter-bird {
	background-image: url('.plugins_url("/lightdiv/twitter".$bird.".png", __FILE__).');
}
-->
</style>';
	}
	
	return $options;
}

function tweetBoxDiv($content) {
	if( (get_option('tap_tweetBox') == 'yes') && (get_option('tap_api_key') != '') && is_single() ) {
		return $content.'<div id="tweetBox"></div>';
	}
	else
	{
		return $content;
	}
}

function retweetButton($content) {
	if( (get_option('tap_retweet') == 'yes') && (get_option('tap_api_key') != '') && is_single() ) {
		return '<div id="lightdiv-button-div"><a href="#retweet"><img id="lightdiv-button" src="'.plugins_url("/images/retweet.png", __FILE__).'" border="0"></a></div>'."\n".$content;
	}
	else
	{
		return $content;
	}
}

?>