<?php
	if( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
	
	
	add_action('admin_menu', 'yic_settings_submenu');
	function yic_settings_submenu(){	
	   add_submenu_page( 'edit.php?post_type=yic_idea', 'Shortcodes', 'Shortcodes', 'manage_options', 'idea-shortcodes', 'idea_shortcodes_menu_callback' );	
	   add_submenu_page( 'edit.php?post_type=yic_idea', 'Upgrade', 'Upgrade', 'manage_options', 'idea-upgrade', 'idea_upgrade_menu_callback' );
	   
	}
	
	function idea_shortcodes_menu_callback(){
	   include_once('pages/yic_settings.php');
	}
	
	function idea_upgrade_menu_callback(){
		include_once('pages/yic_upgrade.php');
	}
	
?>