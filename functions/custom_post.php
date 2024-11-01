<?php
if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly.
}

add_action( 'init', 'yic_register_custom_post_type_init' );


/**


 * Register a book post type.


 *


 * @link http://codex.wordpress.org/Function_Reference/register_post_type


 */


function yic_register_custom_post_type_init() {


	$labels = array(


		'name'               => _x( 'Ideas', 'post type general name', 'your-plugin-textdomain' ),


		'singular_name'      => _x( 'Idea', 'post type singular name', 'your-plugin-textdomain' ),


		'menu_name'          => _x( 'Ideas', 'admin menu', 'your-plugin-textdomain' ),


		'name_admin_bar'     => _x( 'Idea', 'add new on admin bar', 'your-plugin-textdomain' ),


		'add_new'            => _x( 'Add New', 'idea', 'your-plugin-textdomain' ),


		'add_new_item'       => __( 'Add New Idea', 'your-plugin-textdomain' ),


		'new_item'           => __( 'New Idea', 'your-plugin-textdomain' ),


		'edit_item'          => __( 'Edit Idea', 'your-plugin-textdomain' ),


		'view_item'          => __( 'View Idea', 'your-plugin-textdomain' ),


		'all_items'          => __( 'All Ideas', 'your-plugin-textdomain' ),


		'search_items'       => __( 'Search Ideas', 'your-plugin-textdomain' ),


		'parent_item_colon'  => __( 'Parent Ideas:', 'your-plugin-textdomain' ),


		'not_found'          => __( 'No ideas found.', 'your-plugin-textdomain' ),


		'not_found_in_trash' => __( 'No ideas found in Trash.', 'your-plugin-textdomain' )


	);





	$args = array(


		'labels'             => $labels,


        'description'        => __( 'Description.', 'your-plugin-textdomain' ),


		'public'             => true,


		'publicly_queryable' => true,


		'show_ui'            => true,


		'show_in_menu'       => true,


		'query_var'          => true,


		'rewrite'            => array( 'slug' => 'yic-idea' ),


		'capability_type'    => 'post',


		'has_archive'        => true,


		'hierarchical'       => false,


		'menu_position'      => null,
		
		'menu_icon'			 => "dashicons-lightbulb", // This is for lightbulb menu icon in admin panel


		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )


	);





	register_post_type( 'yic_idea', $args );


}