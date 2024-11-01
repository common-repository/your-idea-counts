<?php
if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly.
}


if( isset( $_POST['yic_create_idea'] ) && wp_verify_nonce( $_POST['yic_create_idea'], 'yic_create_idea_action' ) ){		     
	
	$current_user_id	= get_current_user_id();
	
	if(!empty($_POST['yic_title']) && !empty($_POST['yic_new_content'])){
	
		$yic_title			= sanitize_text_field($_POST['yic_title']);
		$yic_new_content	= wp_kses_post($_POST['yic_new_content']); 
		$tags				= sanitize_text_field($_POST['tags']);
		$publishnow			= sanitize_text_field($_POST['publishnow']);
		
		
		//echo '<pre>';
		//	print_r($_POST);
		//echo '</pre>';
		//die();
		
		//$_POST				= array();
		
	//			unset($_POST['yic_title']);
	//			unset($_POST['yic_new_content']);
	//			unset($_POST['tags']);
	//			unset($_POST['publishnow']);
	
		//$content_real		= addslashes($yic_new_content);
	
		$tags_real			= str_replace('\"','',$tags);
	
		$left_replace_tag	= ltrim($tags_real,'['); 
	
		$right_replace_tag	= rtrim($left_replace_tag,']'); 
	
		$tags_array			= (!empty($right_replace_tag)) ? explode(",",$right_replace_tag) : array();
	
		//print_r($tags_array); 
	
		
	
		/*echo '<pre>';
	
			print_r($_POST);
	
			print_r($tags_array); 
	
		echo '</pre>';*/
	
		
	
		//$taglength=sizeof($tags_array);
	
		//$slug=strtolower(str_replace(" ","-",$title));
	
		////////// insert post ////////////
	
		$post_data = array(
	
			'post_title' 	=> $yic_title,
	
			'post_content' 	=> $yic_new_content,
	
			'post_type' 	=> 'yic_idea',
	
			'post_status'   => 'publish', //$publishnow,
	
			'post_author' 	=> $current_user_id
	
			
	
		);
		
		//remove_all_actions( 'wp_insert_post', 80 );
		//remove_all_actions( 'save_post', 80 );
		//remove_all_actions( 'publish_post', 80 );
		
		$post_id = wp_insert_post( $post_data );
		
		
		//$post_id = te_create_idea();
		
		if(!is_wp_error($post_id)){
	
		  //the post is valid
	
		  $msg['status']	= 'success';
	
		  $msg['message'] 	= "Your idea successfully posted";
	
			//wp_update_post(array(
	//					'ID'    		=>  $post_id,
	//					'post_status'   =>  'publish'
	//				));
	
		
		  
	
		  update_post_meta( $post_id, 'yic_post_net_vote', '' );
	
		  
			$param = array();
			$param['user_id'] 	= $current_user_id;		
			$param['post_id'] 	= $post_id;	
			$param['status_id'] = 1;
			$update_status 		= yic_update_yic_idea_status($param);
	
		 //update_post_meta( $post_id, '_'.$table_prefix.'page_template', $template );
	
		   
	
		  update_post_meta( $post_id, 'yic_edit_last', $current_user_id );
	
		  update_post_meta( $post_id, 'yic_last_activity', '' ); 
	
		  update_post_meta( $post_id, 'yic_activity_who', '' ); 
	
		  update_post_meta( $post_id, 'yic_activity_type', '' );
	
		  update_post_meta( $post_id, 'yic_post_views', '0' );
	
		  update_post_meta( $post_id, 'yic_activity_date', '0' );
	
		  
		  
		  
		  
	
		  if(!empty($tags_array)){
	
			  //$tag = array( 5 ); // Correct. This will add the tag with the id 5.
	
			  $taxonomy = 'yic_tag';
	
			  wp_set_post_terms( $post_id, $tags_array, $taxonomy );
	
		  }
	
		  
	
		  $defaule_category_for_create_idea = te_yic_get_defaule_category_for_create_idea();
	
		  if(!empty($defaule_category_for_create_idea)){
	
			  $taxonomy = 'yic_category';
	
			  wp_set_post_terms( $post_id, $defaule_category_for_create_idea, $taxonomy );
	
		  }
		  
		  
		  ///////////// Start Set Default status //////////////
			$idea_default_status	= 1 ;
			$param['post_id'] 		= $post_id;	
			$param['status_id'] 	= $idea_default_status;			
			$update_status 			= yic_update_yic_idea_status($param);	
		  ///////////// End Set Default status //////////////
		  
			////////// Save last update ///////////////
			yic_last_update($post_id,$current_user_id,$last_activity = "Created" ,$activity_type='create');
			
			yic_update_comment_allow_status($post_id, 'open');
			
		 	
			
			$_SESSION['yic']['insert_idea_msg'] = $msg;
			$redirect_url = get_permalink($post_id);
			wp_safe_redirect($redirect_url);
			die();
	
		}else{
	
		  //there was an error in the post insertion, 
	
		 // $msg['status']	= 'error';
	
		  //$msg['message'] 		= $post_id->get_error_message();
		  
		  $_SESSION['yic']['insert_idea_error_msg'] = $post_id->get_error_message();
	
		}
		
	}else{
		
		$_SESSION['yic']['insert_idea_error_msg'] = 'A blank idea is probably not a good idea since it says nothing. Please add some wording to the idea before publishing it.';
		
	}

	

}
?>