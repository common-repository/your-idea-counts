<?php
/**
 * Plugin Name: Your Idea Counts!
 * Plugin URI: https://www.yourideacounts.com
 * Description: An idea exchange where customers or users can help your business succeed.
 * Version: 1.0.3
 */
  
/**
This is the free version of Your Idea Counts! (your-idea-counts) WordPress plugin by Shapiro Cloud.
You can find out more about the Your Idea Counts plugin at https://www.yourideacounts.com/comparison-and-pricing/#free-versus-premium
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Copyright © 2018 Shapiro Cloud, LLC
*/

if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly.
}


/////////// Start Define URL /////////
define("YIC_IDEA_PLUGIN_URL", plugin_dir_url( __FILE__ ));
define("YIC_IDEA_PLUGIN_DIR", plugin_dir_path( __FILE__ ));
define("YIC_IDEA_PLUGIN_BASENAME", plugin_basename( __FILE__ ));
/////////// End Define URL /////////

/////////// Start define lisence url //////////////
define("YIC_IDEA_PURCHASE_PACKAGE_URL", 'https://www.yourideacounts.com/comparison-and-pricing/#pricing');
//define("YIC_IDEA_PURCHASE_PACKAGE_URL", '#');
/////////// End define lisence url //////////////


global $wpdb;

////////// Start Define Tables ///////////////
define("YIC_IDEA_STATUS", $wpdb->prefix .'yic_idea_status');

//define("YIC_IDEA_STATUS_ACTIVITY", 'yic_idea_status_activity');
define("YIC_IDEA_POST_STATUS", $wpdb->prefix .'yic_idea_post_status');


//define("YIC_USER_IDEA_ACTIVITY",  'yic_user_idea_activity');

define("YIC_FOLLOW_IDEA", $wpdb->prefix .'yic_follow_idea');
define("YIC_VOTE_IDEA",   $wpdb->prefix .'yic_vote_idea');
//define("YIC_ALLOW_COMMENT",	$wpdb->prefix .'yic_allow_comment');


define("YIC_IDEA_TEMPLATE", $wpdb->prefix .'yic_idea_template');
////////// End Define Tables ///////////////

////////// Start Set date/time format for whole plugin /////////////
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
define('YIC_DATE_FORMAT', $date_format);
define('YIC_TIME_FORMAT', $time_format);
////////// End Set date/time format for whole plugin /////////////


if(!function_exists('wp_get_current_user')) {
   include(ABSPATH . "wp-includes/pluggable.php");
}


/////////// Start  Plugin activate code //////////////
register_activation_hook( __FILE__, 'activate_yic_plugin_callback' );
function activate_yic_plugin_callback(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
	$sql = "CREATE TABLE IF NOT EXISTS ".YIC_FOLLOW_IDEA." (
			  follow_id bigint(20) NOT NULL AUTO_INCREMENT,
			  user_id bigint(20) NOT NULL,
			  post_id bigint(20) NOT NULL,	
			  follow_status tinyint(1) NOT NULL,			  
			  follow_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (follow_id)			
			) $charset_collate;";
	dbDelta( $sql );
	
	$sql = "CREATE TABLE IF NOT EXISTS ".YIC_VOTE_IDEA." (
			  vote_id bigint(20) NOT NULL AUTO_INCREMENT,
			  user_id bigint(20) NOT NULL,
			  post_id bigint(20) NOT NULL,	
			  vote_status int(1) NOT NULL,			  
			  vote_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (vote_id)			
			) $charset_collate;";
	dbDelta( $sql );
	
	/*$sql = "CREATE TABLE IF NOT EXISTS ".YIC_ALLOW_COMMENT." (
			  allow_id bigint(20) NOT NULL AUTO_INCREMENT,
			  user_id bigint(20) NOT NULL,
			  post_id bigint(20) NOT NULL,	
			  allow_status enum('Y','N') NOT NULL DEFAULT 'Y',			  
			  allow_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (allow_id)			
			) $charset_collate;";
	dbDelta( $sql );*/
	
	
	$sql = "CREATE TABLE IF NOT EXISTS ".YIC_IDEA_POST_STATUS." (
			  id bigint(20) NOT NULL AUTO_INCREMENT,
			  post_id bigint(20) NOT NULL,
			  idea_status int(11) NOT NULL,
			  status_update_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (id)			
			) $charset_collate;";
	dbDelta( $sql );		
	
	
	$sql =  "CREATE TABLE IF NOT EXISTS ".YIC_IDEA_TEMPLATE." (
			  id int(11) NOT NULL AUTO_INCREMENT,			
			  template_name varchar(255) NOT NULL,
			  content longtext NOT NULL,			
			  status enum('Y','N') NOT NULL DEFAULT 'Y',			
			  PRIMARY KEY (id)			
			) $charset_collate;";	
	
	$create_template = $wpdb->query($sql);
	if($create_template){
		$content_temp	= yic_get_template_default_content();
			
			
		$wpdb->insert( 
			YIC_IDEA_TEMPLATE, 
			array( 
				'template_name' => 'Template Name', 
				'content' => $content_temp 
			)
		);
		
	}
	
	$sql = "CREATE TABLE IF NOT EXISTS  ".YIC_IDEA_STATUS." (
			id int(11) NOT NULL AUTO_INCREMENT,
			status_title varchar(255) NOT NULL,	
			is_votable enum('Y','N') NOT NULL DEFAULT 'Y',		
			font_color varchar(7) NOT NULL DEFAULT '#333333',
			back_color varchar(7) NOT NULL DEFAULT '#EEEEEE',
			PRIMARY KEY (id)
		) $charset_collate;" ;	
	
	$create = $wpdb->query($sql);
	
	if(!$create){
		
		$wpdb->query("TRUNCATE TABLE ".YIC_IDEA_STATUS);
		
		$insert_into_status =
		"INSERT INTO ".YIC_IDEA_STATUS." (status_title, is_votable, font_color, back_color ) 
		VALUES 
		('Active', 'Y', '#FFFFFF', '#006600'), 
		('Already Available', 'N', '#333333', '#EEEEEE'),
		('Committed', 'N', '#333333', '#EEEEEE'),
		('Duplicate', 'N', '#333333', '#EEEEEE'),
		('For Future Consideration', 'Y', '#333333', '#EEEEEE'),
		('Fully Delivered!', 'N', '#333333', '#EEEEEE'),
		('In Progress', 'N', '#333333', '#EEEEEE'),
		('In Review', 'N', '#333333', '#EEEEEE'),
		('Need More Information ', 'Y', '#333333', '#EEEEEE'), 
		('Not Considering', 'N', '#333333', '#EEEEEE'),
		('Not Enough Interest', 'Y', '#333333', '#EEEEEE'),
		('Partially Delivered!', 'N', '#333333', '#EEEEEE');";
		
		$wpdb->query($insert_into_status);
	}
	
	$develivered_status_str = '6,12';
	update_option('yic_top_ideator_delivered_status',$develivered_status_str );
	
	//dbDelta( $sql );
	
	
	add_role('moderator', __('Moderator'),
    	array(
			'read'              => true, // Allows a user to read
			'create_posts'      => true, // Allows user to create new posts
			'edit_posts'        => true, // Allows user to edit their own posts
			'edit_others_posts' => true, // Allows user to edit others posts too
			'publish_posts'     => true, // Allows the user to publish posts
			'manage_categories' => true, // Allows user to manage post categories
        )
	);
	
	add_role('newbie', __('Newbie'),
		array(
			'read' => true, // Allows a user to read
			'create_posts' => true, // Allows user to create new posts
			'edit_posts' => true, // Allows user to edit their own posts
		)
	);	
	
	
	yic_register_custom_post_type_init();
	
	create_yic_idea_taxonomies();
	
	//////////////// Start auto create category /////////////////////
	$taxonomy = 'yic_category';
	$term_name = 'Uncategorized';
	$term = term_exists( $term_name, $taxonomy );
	//if( 0 !== $term && null !== $term ){
	if(empty($term)){
		//wp_insert_term( $term_name, $taxonomy); 		
		
		$term = wp_insert_term(
				  $term_name, // the term 
				  $taxonomy // the taxonomy
				);
		
		if(!is_wp_error($term)){
			$yic_default_cat = $term['term_id'];
			update_option('defaule_category_for_create_idea',$yic_default_cat );
		}
		
	}
	//////////////// End auto create category /////////////////////
	
	
	yic_free_initial_example_ideas_import();
	
	
	
}
/////////// End  Plugin activate code //////////////



///////////Start  Plugin deactivate code //////////////
register_deactivation_hook( __FILE__, 'deactivate_yic_plugin_callback' );
function deactivate_yic_plugin_callback(){
	
}
/////////// End  Plugin deactivate code //////////////






////////// Star include files //////////////////

require_once( YIC_IDEA_PLUGIN_DIR . '/functions/functions.php');
include_once( YIC_IDEA_PLUGIN_DIR . '/functions/custom_post.php');
include_once( YIC_IDEA_PLUGIN_DIR . '/functions/custom_taxonomy.php');
include_once( YIC_IDEA_PLUGIN_DIR . '/functions/actions.php');
include_once( YIC_IDEA_PLUGIN_DIR . '/functions/ajax.php');
include_once( YIC_IDEA_PLUGIN_DIR . '/functions/shotcode.php');
include_once( YIC_IDEA_PLUGIN_DIR . '/functions/create_widget.php');


include_once( YIC_IDEA_PLUGIN_DIR . '/admin/add_admin_menu.php');

///////// End include files //////////////////

?>