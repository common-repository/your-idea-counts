<?php

if ( ! defined( 'ABSPATH' ) ){

	exit; // Exit if accessed directly.

}



/////////////// Start Enqueue script for frontend /////////////////////

//te_yic_load_scripts('aa');

function te_yic_load_scripts($hook) {

 

	///////////// Start enqueue Style //////////////////

	$style 					= YIC_IDEA_PLUGIN_URL.'css/style.css';

	$font_awesome_min 		= YIC_IDEA_PLUGIN_URL.'css/font-awesome.min.css';

	$yic_autocomplete 		= YIC_IDEA_PLUGIN_URL.'css/yic_autocomplete.css';

	$sumoselect				= YIC_IDEA_PLUGIN_URL.'css/sumoselect.min.css';

	$jquery_flexdatalist	= YIC_IDEA_PLUGIN_URL.'css/multi-select-tag-css/jquery.flexdatalist.css';

	

	//// Start For create idea editor ////	

	$content_inline_min			= YIC_IDEA_PLUGIN_URL.'css/wp-editor-css/content.inline.min.css';

	$content_min				= YIC_IDEA_PLUGIN_URL.'css/wp-editor-css/content.min.css';

	$skin_ie7_min				= YIC_IDEA_PLUGIN_URL.'css/wp-editor-css/skin.ie7.min.css';

	$skin_min					= YIC_IDEA_PLUGIN_URL.'css/wp-editor-css/skin.min.css';

	$admin_toolbar_bar_icons	= YIC_IDEA_PLUGIN_URL.'css/admin-toolbar-bar-icons.css';	

	//// End For create idea editor ////

	

	

	

	

	wp_enqueue_style( 'yic-style', $style, false, '1.0.0' );

	wp_enqueue_style( 'yic-font-awesome-min', $font_awesome_min, false, '1.0.0' );

	wp_enqueue_style( 'yic-autocomplete', $yic_autocomplete, false, '1.0.0' );

	wp_enqueue_style( 'yic-sumoselect', $sumoselect, false, '1.0.0' );

	wp_enqueue_style( 'yic-jquery-flexdatalist', $jquery_flexdatalist, false, '1.0.0' );

	

	

	/////// Start For create idea editor ////////

	wp_enqueue_style( 'yic-content-inline-min', $content_inline_min, false, '1.0.0' );

	wp_enqueue_style( 'yic-content-min', $content_min, false, '1.0.0' );

	wp_enqueue_style( 'yic-skin-ie7-min', $skin_ie7_min, false, '1.0.0' );

	wp_enqueue_style( 'yic-skin-min', $skin_min, false, '1.0.0' );

	wp_enqueue_style( 'yic-admin-toolbar-bar-icons', $admin_toolbar_bar_icons, false, '1.0.0' );	

	/////// End For create idea editor ////////

	

	

	

	

	///////////// End enqueue Style //////////////////

	

	

	

	//////////// Start Javascript enqueue////////////////////////////

	$sumoselect_min_js 		= YIC_IDEA_PLUGIN_URL.'js/jquery.sumoselect.min.js';

	$jquery_flexdatalist_js	= YIC_IDEA_PLUGIN_URL.'js/multi-select-tag-js/jquery.flexdatalist.js';

	$function_js 			= YIC_IDEA_PLUGIN_URL.'js/function.js';

	

	

    wp_enqueue_script( 'yic-sumoselect-min-js', $sumoselect_min_js, array(), '1.0.0', true );

    wp_enqueue_script( 'yic-jquery-flexdatalist-js', $jquery_flexdatalist_js, array(), '1.0.0', true );

    wp_enqueue_script( 'yic-functions-js', $function_js, array(), '1.0.0', true );		

	//////////// End Javascript enqueue////////////////////////////

 

}

add_action('wp_enqueue_scripts', 'te_yic_load_scripts', 100);

/////////////// End Enqueue script for frontend /////////////////////









/////////////// Start Enqueue script for backend admin panel /////////////////////

function te_yic_add_script_to_menu_page(){

    // $pagenow, is a global variable referring to the filename of the current page, 

    // such as ‘admin.php’, ‘post-new.php’

    global $pagenow;

 	

	

	//////////// Css and js only use for shortcodes list and upgrade page ////////////////

	$current_page = isset($_GET['page']) ? $_GET['page'] : '';	

	if ($current_page != 'idea-shortcodes' && $current_page != 'idea-upgrade') {

        return;

    }

	

	

	///////////// Start enqueue Style //////////////////

	$yic_bootstrap 		= YIC_IDEA_PLUGIN_URL.'css/bootstrap.min.css';

	$yic_admin_style 	= YIC_IDEA_PLUGIN_URL.'css/admin_style.css';

	$yic_style 			= YIC_IDEA_PLUGIN_URL.'css/style.css';

	//$yic_sumoselect		= YIC_IDEA_PLUGIN_URL.'css/sumoselect.min.css';

	

    // loading css

    wp_enqueue_style('yic-bootstrap-css', $yic_bootstrap, false, '1.0.0');    

    wp_enqueue_style('yic-admin-style-css', $yic_admin_style, false, '1.0.0');  

    wp_enqueue_style('yic-style-css', $yic_style, false, '1.0.0');   

	//wp_enqueue_style( 'yic-sumoselect-css', $yic_sumoselect, false, '1.0.0' );  

	///////////// End enqueue Style //////////////////

	

	

    // loading js

    //wp_register_script( 'some-js', get_template_directory_uri().'/js/some.js', array('jquery-core'), false, true );

    //wp_enqueue_script( 'some-js' );

}

 

add_action( 'admin_enqueue_scripts', 'te_yic_add_script_to_menu_page', 100 );

/////////////// End Enqueue script for backend admin panel /////////////////////







//////////// admin footer ///////////



add_action('admin_footer', 'te_yic_admin_footer_callback');



function te_yic_admin_footer_callback() {



	include_once(YIC_IDEA_PLUGIN_DIR.'/includes/footer-admin.php');



}







////////// Admin Header  ////////////



function te_yic_admin_header_callback() {



	include_once(YIC_IDEA_PLUGIN_DIR.'/includes/header-admin.php');



}

add_action( 'admin_head', 'te_yic_admin_header_callback' );









///////// frontend footer /////////////



function te_yic_footer_callback() {



   include_once(YIC_IDEA_PLUGIN_DIR.'/includes/footer.php');



}



add_action( 'wp_footer', 'te_yic_footer_callback' );







///////// frontend header /////////////



function te_yic_header_callback() {



   include_once(YIC_IDEA_PLUGIN_DIR.'/includes/header.php');



}



add_action( 'wp_head', 'te_yic_header_callback' );







function yic_new_excerpt_more($more) {



  global $post;



  remove_filter('excerpt_more', 'new_excerpt_more'); 



  return '... <a class="read_more" href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>';



  //return '...';



}



add_filter('excerpt_more','yic_new_excerpt_more',90);







//yic_idea











/**



* Filter the single_template with our custom function



*/



add_filter('single_template', 'yic_single_template');



 



/**



* Single template function which will choose our template



*/



function yic_single_template($single) {



	global $wp_query, $post;



	



	if ( is_singular( 'yic_idea' ) ) {



		if(is_user_logged_in() && isset($_GET['edit']) && $_GET['edit']=='true'){



			//$single = YIC_IDEA_PLUGIN_DIR. 'app/sql/page-single-ideas.php';



			$single = YIC_IDEA_PLUGIN_DIR. '/templates/template-single-ideas.php';



		}else{			



			$single = YIC_IDEA_PLUGIN_DIR. '/templates/template-single-ideas-for-guist.php';



		}



	}



	return $single;



}



















////////// Modify Comment Form ///////////////



add_filter('comment_form_defaults', 'yic_comment_form_modify_callback', 90);



function yic_comment_form_modify_callback( $defaults ){



  $defaults['title_reply'] = '<span class="yic-comment-title">'.__('Leave your thoughts').'</span>';



  return $defaults;



}











////// Start Add menu item on plugin list section////////////



//Register a callback for our specific plugin's actions



add_filter( 'plugin_action_links_' . YIC_IDEA_PLUGIN_BASENAME, 'yic_my_plugin_action_links' );



function yic_my_plugin_action_links( $links ){



    $links[] = '<a href="'. 'edit.php?post_type=yic_idea&page=idea-upgrade' .'">Upgrade</a>';



    return $links;



}



////// End Add menu item on plugin list section////////////









add_action( 'dashboard_glance_items', 'yic_cpad_at_glance_content_table_end' );



function yic_cpad_at_glance_content_table_end() {



   	



	$count_yic_ideas 	= wp_count_posts('yic_idea');



	$total_yic_idea 	= $count_yic_ideas->publish;



	$num 				= number_format_i18n( $total_yic_idea );



	$text				= ($total_yic_idea > 1) ? 'Ideas' : 'Idea';



	$output 			= '';



	if ( current_user_can( 'edit_posts' ) ) {



		$output = '<a href="edit.php?post_type=yic_idea">' . $num . ' ' . $text . '</a>';



	}else{



		$output =  $num . ' ' . $text ;



	}



	echo '<li class="post-count yic_idea-count">' . $output . '</li>';



	



}















add_action( 'comment_post', 'yic_show_message_function_callback', 10, 2 );



function yic_show_message_function_callback( $comment_ID, $comment_approved ) {



	



	/*if( 1 === $comment_approved ){



		//function logic goes here



	}*/



		



	yic_send_mail_after_comment_post($comment_ID);



	



	$comment_data 		= get_comment( $comment_ID ); 



	$comment_post_ID 	= $comment_data->comment_post_ID;



	$post_type 			= get_post_type( $comment_post_ID );



	if($post_type ==  'yic_idea'){



		$post_id 		= $comment_post_ID;



		$user_id		= get_current_user_id();



		yic_last_update($post_id,$user_id,$last_activity = "Commented" ,$activity_type='Comment');



	}



}



////////////// Start Overwrite view template ////////////////////////

/*add_filter( 'page_template', 'yic_custom_page_template' );

function yic_custom_page_template( $page_template ){

	$idea_template_id = get_option('yic_idea_template_id');

	if(!empty($idea_template_id)){

		if ( is_page( $idea_template_id ) ) {

			$page_template = YIC_IDEA_PLUGIN_DIR . '/templates/view_idea_template.php';

		}

	}

    return $page_template;

}*/

////////////// End Overwrite view template ////////////////////////





/////////// Use for open wp_editor on visual mode //////////////////

/*add_filter( 'wp_default_editor', 'force_default_editor' );

function force_default_editor() {

    //allowed: tinymce, html, test

    return 'tinymce';

}*/





////////////// Start Allow / Disallow Comment for view idea template ///////////////////

function yic_filter_media_comment_status( $open, $post_id ) {

	//$post = get_post( $post_id );

	$yic_idea_template_id = get_option('yic_idea_template_id');

	if( $post_id == $yic_idea_template_id ) {

		return false;

	}

	return $open;

}

add_filter( 'comments_open', 'yic_filter_media_comment_status', 10 , 2 );

////////////// End Allow / Disallow Comment for view idea template ///////////////////











///////////////// Start Add Exta icon to wp-editor ///////////////////////////////////////



function yic_my_mce_before_init_insert_formats( $init_array ) {  

 

// Define the style_formats array

 

    $style_formats = array(  

/*

* Each array child is a format with it's own settings

* Notice that each array has title, block, classes, and wrapper arguments

* Title is the label which will be visible in Formats menu

* Block defines whether it is a span, div, selector, or inline style

* Classes allows you to define CSS classes

* Wrapper whether or not to add a new block-level element around any selected elements

*/

        array(  

            'title' => 'View Template',  

            'block' => 'span',  

            'classes' => 'yic_view_template',

            'wrapper' => true,

             

        ),  

        array(  

            'title' => 'Use Template',  

            'block' => 'span',  

            'classes' => 'yic_use_emplate',

            'wrapper' => true,

        ),

        array(  

            'title' => 'Insert Template',  

            'block' => 'span',  

            'classes' => 'yic_insert_template',

            'wrapper' => true,

        ),

    );  

    // Insert the array, JSON ENCODED, into 'style_formats'

    $init_array['style_formats'] = json_encode( $style_formats );  

     

    return $init_array;  

   

} 

add_filter( 'tiny_mce_before_init', 'yic_my_mce_before_init_insert_formats' ); 

///////////////// End Add Exta icon to wp-editor ///////////////////////////////////////



















///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////// The hooks to create custom columns and their associated data for a custom post type are manage_{$post_type}_posts_columns and manage_{$post_type}_posts_custom_column respectively, where {$post_type} is the name of the custom post type. /////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





// Add the custom columns to the yic_idea post type:

add_filter( 'manage_yic_idea_posts_columns', 'yic_set_custom_edit_yic_idea_columns_callback' );

function yic_set_custom_edit_yic_idea_columns_callback($columns) {

    unset( $columns['author'] );

    $columns['idea_status'] = __( 'Idea Status');



    return $columns;

}



// Add the data to the custom columns for the book post type:

add_action( 'manage_yic_idea_posts_custom_column' , 'yic_custom_yic_idea_column_callback', 10, 2 );

function yic_custom_yic_idea_column_callback( $column, $post_id ) {

    switch ( $column ) {



        case 'idea_status' :

			$alloted_status_data	= yic_get_idea_status_id($post_id);

			/*echo '<pre>';

				print_r($alloted_status_data);

			echo '</pre>';*/

			$qry_status_result 		= yic_get_all_status();

			

			$status_style	 		= '';

			$alloted_status	 		= '';

			

			if(!empty($alloted_status_data)){

				$alloted_status	 = $alloted_status_data->status_title;

				$status_style	 = '';

				$font_color		 = $alloted_status_data->font_color;

				$back_color 	 = $alloted_status_data->back_color;

				$status_style 	.= (!empty($font_color)) ? ' color:'.$font_color.'; ' : '' ;

				$status_style 	.= (!empty($back_color)) ? ' background:'.$back_color.'; ' : '' ;

			}

            

			?>

            	<ul id="yic-status-<?php echo $post_id;?>" class="yic_change_status">

                	<li class="yic_view_status_sec" >

                    	<span class="yic_status_title" style=" <?php //echo $status_style ;?>"> <?php echo $alloted_status;?></span>

                        <a href="javascript:;" class="yic_edit_status_btn" post-id="<?php echo $post_id;?>">

                        	<i class="dashicons dashicons-edit" aria-hidden="true"></i>

                        </a>

                    </li>

                    <li class="yic_edit_status_sec" style="display:none;">

                        <select class="form-control yic_idea_status" post-id="<?php echo $post_id;?>">

                            <?php 

                                foreach($qry_status_result as $allstatus){                    

                                    $selected = ($alloted_status == $allstatus->status_title) ? 'selected="selected"' : ''; 

                                    echo '<option value="'.$allstatus->id.'" '.$selected.'>'.$allstatus->status_title.'</option>';

                                }                    

                            ?>                    

                        </select>  

                        

                        <!-- Start Save Button  --> 

                        <a href="javascript:;" class="yic_save_status_btn" post-id="<?php echo $post_id;?>">

                        	<i class="dashicons dashicons-yes" aria-hidden="true"></i>

                        </a> 

                        <!-- End Save Button  --> 

                        

                        <!-- Start Cross Button  -->                        

                        <a href="javascript:;" class="yic_cancle_status_btn" post-id="<?php echo $post_id;?>">

                        	<i class="dashicons dashicons-no-alt" aria-hidden="true"></i>   

                        </a>  

                        <!-- End Cross Button  -->  

                         

                        <!-- Start loader  -->               

                        <span class="spinner yic_change_status_loader"></span>

                        <!-- End loader  -->                                

                    </li>

                </ul>

			<?php

			

			

            break;



    }

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//////////// Start Manage excerpt limit /////////////////////////

function yic_custom_excerpt_length( $length ) {

	return 30;

}

add_filter( 'excerpt_length', 'yic_custom_excerpt_length', 99999999 );



//////////// End Manage excerpt limit /////////////////////////





////////////// Start Save status for idea ////////////////////

/**

 * Save post metadata when a post is saved.

 *

 * @param int $post_id The post ID.

 * @param post $post The post object.

 * @param bool $update Whether this is an existing post being updated or not.

 */

function yic_save_idea_data_callback( $post_id, $post, $update ) {

	

	//update_option('yic_save_idea', $post->post_status);

	

    /*

     * In production code, $slug should be set only once in the plugin,

     * preferably as a class property, rather than in each function that needs it.

     */

    $post_type = get_post_type($post_id);



    // If this isn't a 'book' post, don't update it.

    if ( "yic_idea" != $post_type ) return;

	

	

	//if ( wp_is_post_revision( $post ) ) return;

	

	if(wp_is_post_autosave($post_id)) {

		return false;

	}

		

	$current_user_id	= get_current_user_id();

	

	//$last_activity 		= get_post_meta($post_id, 'yic_last_activity', true);

	

	//if ( wp_is_post_revision( $post_id ) )

	//return;

	

	/*if(empty($last_activity)){

		//////// create ///////

		yic_last_update($post_id,$current_user_id,$last_activity = "Created" ,$activity_type='create');

	}*/

	

	/*if(wp_is_post_revision( $post_id )){

	//if(!empty($idea_status)){

		//////// update ///////

		yic_last_update($post_id,$current_user_id,$last_activity = "Edited" ,$activity_type='edit');

	}else{

		yic_last_update($post_id,$current_user_id,$last_activity = "Created" ,$activity_type='create');

		

	}*/

	

	

	

	$idea_status 		= yic_get_idea_status_id($post_id);

	$param 				= array();

	$param['user_id'] 	= $current_user_id;		

	$param['post_id'] 	= $post_id;	

	$param['status_id'] = (!empty($idea_status)) ? $idea_status->id :1;

	$update_status 		= yic_update_yic_idea_status($param);

	

	if($post->post_status === 'publish'){

		

		$last_activity 		= get_post_meta($post_id, 'yic_last_activity', true);

		

		if(!empty($last_activity)){

			yic_last_update($post_id,$current_user_id,$last_activity = "Edited" ,$activity_type='edit');

		}else{

			yic_last_update($post_id,$current_user_id,$last_activity = "Created" ,$activity_type='create');	

		}
		
		
        $yic_view_post=get_post_meta( $post_id,'yic_view_post',true);
	if($yic_view_post==''){
	$yic_view_post=0;	
	}
	update_post_meta( $post_id,'yic_view_post',$yic_view_post);
	
	
	}

	

	

}

add_action( 'save_post', 'yic_save_idea_data_callback', 10, 3 );

////////////// End Save status for idea ////////////////////





////////////// Start ob and session start ///////////////////

function yic_start_session_callback() {

	ob_start();

	if( session_status() === PHP_SESSION_NONE ){ // if session status is none then start the session		

		session_start();

	}

}

add_action('wp_loaded','yic_start_session_callback');

////////////// End ob and session start ///////////////////