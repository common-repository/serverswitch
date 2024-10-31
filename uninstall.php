<?php

	if( !defined('WP_UNINSTALL_PLUGIN') )
		exit();


	delete_option('serverswitch_old_url');
	delete_option('serverswitch_new_url');
	delete_option('serverswitch_admin_username');