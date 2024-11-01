<?php
if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly.
}

// hook into the init action and call create_book_taxonomies when it fires

add_action( 'init', 'create_yic_idea_taxonomies', 0 );



// create two taxonomies, genres and writers for the post type "book"

function create_yic_idea_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)

	$labels = array(

		'name'              => _x( 'Idea Categories', 'taxonomy general name', 'textdomain' ),

		'singular_name'     => _x( 'Idea Category', 'taxonomy singular name', 'textdomain' ),

		'search_items'      => __( 'Search Idea Categories', 'textdomain' ),

		'all_items'         => __( 'All Idea Categories', 'textdomain' ),

		'parent_item'       => __( 'Parent Idea Category', 'textdomain' ),

		'parent_item_colon' => __( 'Parent Idea Category:', 'textdomain' ),

		'edit_item'         => __( 'Edit Idea Category', 'textdomain' ),

		'update_item'       => __( 'Update Idea Category', 'textdomain' ),

		'add_new_item'      => __( 'Add New Idea Category', 'textdomain' ),

		'new_item_name'     => __( 'New Idea Category Name', 'textdomain' ),

		'menu_name'         => __( 'Idea Categories', 'textdomain' ),

	);



	$args = array(

		'hierarchical'      => true,
		
		//'hierarchical' 		=> false,
		
		//'parent_item'  		=> null,
		
		//'parent_item_colon' => null,

		'labels'            => $labels,

		'show_ui'           => true,

		'show_admin_column' => true,

		'query_var'         => true,

		'rewrite'           => array( 'slug' => 'yic-category' ),

	);



	register_taxonomy( 'yic_category', array( 'yic_idea' ), $args );

	



	// Add new taxonomy, NOT hierarchical (like tags)

	$labels = array(

		'name'                       => _x( 'Idea Tags', 'taxonomy general name', 'textdomain' ),

		'singular_name'              => _x( 'Idea Tag', 'taxonomy singular name', 'textdomain' ),

		'search_items'               => __( 'Search Idea Tags', 'textdomain' ),

		'popular_items'              => __( 'Popular Idea Tags', 'textdomain' ),

		'all_items'                  => __( 'All Idea Tags', 'textdomain' ),

		'parent_item'                => null,

		'parent_item_colon'          => null,

		'edit_item'                  => __( 'Edit Idea Tag', 'textdomain' ),

		'update_item'                => __( 'Update Idea Tag', 'textdomain' ),

		'add_new_item'               => __( 'Add New Idea Tag', 'textdomain' ),

		'new_item_name'              => __( 'New Idea Tag Name', 'textdomain' ),

		'separate_items_with_commas' => __( 'Separate tags with commas', 'textdomain' ),

		'add_or_remove_items'        => __( 'Add or remove tags', 'textdomain' ),

		'choose_from_most_used'      => __( 'Choose from the most used tags', 'textdomain' ),

		'not_found'                  => __( 'No tags found.', 'textdomain' ),

		'menu_name'                  => __( 'Idea Tags', 'textdomain' ),

	);



	$args = array(

		'hierarchical'          => false,

		'labels'                => $labels,

		'show_ui'               => true,

		'show_admin_column'     => true,

		'update_count_callback' => '_update_post_term_count',

		'query_var'             => true,

		'rewrite'               => array( 'slug' => 'yic-tag' ),

	);



	register_taxonomy( 'yic_tag', 'yic_idea', $args );

}