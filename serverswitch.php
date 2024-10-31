<?php
/*
Plugin Name: ServerSwitch
Plugin URI: N/A
Description: Set of easy transitional switches for launch day. Based on the onextrapixel.com article "13 Useful WordPress SQL Queries You Wish You Knew Earlier."
Author: Derek Montgomery
Version: 1.0
Author URI: N/A

Copyright 2011  Derek Montgomery  (email : montgomerygraphics at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110, USA

*/

if(!current_user_can('manage_database')) {
	die('Sorry, you can\'t manage the database');
}


/*
variables
*/
	$current_domain_url	=	get_site_url();
	$new_url			=	serverswitch_get_specified_new_url();
	$old_url			=	serverswitch_get_specified_old_url();
	$admin_username		=	serverswitch_get_specified_admin_username();

/*
initiate
*/
function serverswitch_init(){
	register_setting('serverswitch_options', 'serverswitch_new_url');
	register_setting('serverswitch_options', 'serverswitch_old_url');
	register_setting('serverswitch_options', 'serverswitch_admin_username');
}
add_action('admin_init','serverswitch_init');

/*
create plugin menu
*/
function serverswitch_plugin_menu(){
	add_options_page('ServerSwitch Settings','ServerSwitch','manage_options', 'serverswitch-plugin','serverswitch_option_page');
}

add_action('admin_menu','serverswitch_plugin_menu');

/*
general functions
*/
function serverswitch_get_specified_new_url(){
	
	global $current_domain_url;
	$new_url	=	get_option('serverswitch_new_url');

	if (!empty($new_url) && $new_url != ''){
		$specified_new_url	=	$new_url;
	} else {
		$specified_new_url	=	$current_domain_url;
	}
		
	return $specified_new_url;
}

function serverswitch_get_specified_old_url(){

	global $current_domain_url;
	
	$old_url	=	get_option('serverswitch_old_url');

	if (!empty($old_url) && $old_url != ''){
		$specified_old_url	=	$old_url;
	} else {
		$specified_old_url	=	$current_domain_url;
	}
	
	return $specified_old_url;
}

function serverswitch_get_specified_admin_username(){
	
	$admin_username	=	get_option('serverswitch_admin_username');

	if (!empty($admin_username) && $admin_username != ''){
		$specified_admin_username	=	$admin_username;
	} else {
		$specified_admin_username	=	'Admin';
	}
		
	return $specified_admin_username;
}

/*
sql queries
*/

function serverswitch_change_guid(){

	global $wpdb;
	global $old_url;
	global $new_url;
	
	$sql	=	'UPDATE '.$wpdb->posts.' SET guid = REPLACE(guid, "'.$old_url.'", "'.$new_url.'")';
	
	$wpdb->query($sql);

}

function serverswitch_revert_guid(){

	global $wpdb;
	global $old_url;
	global $new_url;
	
	$sql	=	'UPDATE '.$wpdb->posts.' SET guid = REPLACE(guid, "'.$new_url.'", "'.$old_url.'")';
	
	$wpdb->query($sql);

}

function serverswitch_change_url_in_content(){

	global $wpdb;
	global $old_url;
	global $new_url;
	
	$sql	=	'UPDATE '.$wpdb->posts.' SET post_content = REPLACE(post_content, "'.$old_url.'", "'.$new_url.'")';
	
	$wpdb->query($sql);

}

function serverswitch_revert_url_in_content(){

	global $wpdb;
	global $old_url;
	global $new_url;
	
	$sql	=	'UPDATE '.$wpdb->posts.' SET post_content = REPLACE(post_content, "'.$new_url.'", "'.$old_url.'")';
	
	$wpdb->query($sql);

}

function serverswitch_update_post_meta(){

	global $wpdb;
	global $old_url;
	global $new_url;
	
	$sql	=	'UPDATE '.$wpdb->postmeta.' SET meta_value = REPLACE(meta_value, "'.$new_url.'", "'.$old_url.'")';
	
	$wpdb->query($sql);

}

function serverswitch_revert_post_meta(){

	global $wpdb;
	global $old_url;
	global $new_url;
	
	$sql	=	'UPDATE '.$wpdb->postmeta.' SET meta_value = REPLACE(meta_value, "'.$old_url.'", "'.$new_url.'")';
	
	$wpdb->query($sql);

}


add_action('wp_ajax_serverswitch_change_guid','serverswitch_change_guid');
add_action('wp_ajax_serverswitch_revert_guid','serverswitch_revert_guid');
add_action('wp_ajax_serverswitch_change_url_in_content','serverswitch_change_url_in_content');
add_action('wp_ajax_serverswitch_revert_url_in_content','serverswitch_revert_url_in_content');
add_action('wp_ajax_serverswitch_change_url_in_content','serverswitch_update_post_meta');
add_action('wp_ajax_serverswitch_revert_url_in_content','serverswitch_revert_post_meta');
add_action('admin_print_scripts','serverswitch_serverswitch_scripts');

function serverswitch_serverswitch_scripts(){
	wp_enqueue_script("serverswitch_scripts",plugins_url()."/serverswitch/serverswitch_scripts.js", array('jquery'));

}

function serverswitch_option_page(){
	
	global $wpdb;
	global $new_url;
	global $old_url;
	global $admin_username;
	
	?>
	
	<style type="text/css">
	
	.wrap{
		width:550px;
	}
	
	.ss_red{
		color:#ff0000;
	}
	
	.ss_green{
		color:#33aa33;
	}
	
	.ss_blue{
		color:#0000ff;
	}
	
	.ss_gray{
		color:#999;
	}
	
	.ss_button_group{
		float:left;
		margin-right:10px;
	}
	
	.ss_status{
		
	}
	
	.ss_button{
		width:125px;
	}
	
	</style>	
	
	
	<div class="wrap">
	<?php screen_icon(); ?>
	<h2>ServerSwitch Options</h2>

	<h3>Welcome to the ServerSwitch Plugin.</h3>
	<p><em>Here you can perform common tasks that occur on site transition.</em></p>
	<p>
	 <strong>Important Notes:</strong>You may want to delete the plugin when you're done, as this isn't necessarily something you want to put in the hands of clients.
	 <br /><br />
	 It's very important to back up your database, as this plugin WILL OVERWRITE entries inside of it. I recommend WP-DBManager. <span class="ss_red"><strong>DO NOT PROCEED WITHOUT BACKING UP YOUR DATABASE.</strong></span></p>
	<hr>
	<h3>Change the default admin username:</h3>
	<form action="options.php" method="post" id="server-switch-admin">
	<?php settings_fields('serverswitch_options'); ?>
	<input type="text" id="serverswitch_admin_username" name="serverswitch_admin_username" value="<?php echo esc_attr($admin_username); ?>" />
	<input type="submit" name="submit" value="Save Default Admin" />
	</form>
	<br />
	<hr>	
	</strong>
	<br />What's the URL (including WordPress's root directory, if applicable) of the new site you're transitioning to? Please be sure to include http://www. or anything else that might apply. <strong>Please keep trailing slashes consistent.</strong>
	</p>
	
	<form action="options.php" method="post" id="server-switch-options-form">
	<?php settings_fields('serverswitch_options'); ?>
		<h3><label for="serverswitch_old_url">Old Site URL: </label><input class="ss_gray" type="text" id="serverswitch_old_url" name="serverswitch_old_url" value="<?php echo esc_attr($old_url); ?>" /></h3>
	
		<h3><label for="serverswitch_new_url">New Site URL: </label>
		<input class="ss_green" type="text" id="serverswitch_new_url" name="serverswitch_new_url" value="<?php echo esc_attr($new_url); ?>" /><input type="submit" name="submit" value="Save URLs" /></h3>

	</form>
	<br />

	<hr>

	<p>
	<div class="ss_button_group">
		<button class="ss_button" name="serverswitch_change_guid" />Change GUID to <span class="ss_green">New URL</span></button>
		<br />
		<button class="ss_button" name="serverswitch_revert_guid" />Revert GUID to <span class="ss_gray">Old URL</span></button>
		</p>
	</div>
	
	
	<div class="ss_button_group">
		<button class="ss_button" name="serverswitch_change_url_in_content" />Change URL in content to <span class="ss_green">New URL</span></button>
		<br />
		<button class="ss_button" name="serverswitch_revert_url_in_content" />Revert URL in content to <span class="ss_gray">Old URL</span></button>
		</p>
	</div>
	
	
	<div class="ss_button_group">
		<button class="ss_button" name="serverswitch_update_post_meta" />Change post meta to <span class="ss_green">New URL</span></button>
		<br />
		<button class="ss_button" name="serverswitch_revert_post_meta" />Revert post meta to <span class="ss_gray">Old URL</span></button>
		</p>
	</div>
	
	
	<div id="ss_status">
		<h4></h4>
	</div>
	
</div>
<?php
}
?>