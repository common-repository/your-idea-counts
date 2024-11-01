<?php
if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly.
}



add_action( 'wp_ajax_yic_idea_follow_action', 'yic_idea_follow_action_callback' );
function yic_idea_follow_action_callback(){

	$post_id 	= intval($_POST['post_id']);
	$user_id	= get_current_user_id();
	if(!empty($user_id) && !empty($post_id)){
		$param = array();
		$param['user_id'] = $user_id;		
		$param['post_id'] = $post_id;
		$follow = yic_update_follow_unfollow_status($param);
		echo json_encode(array($follow));
	}else{
		echo "user not loged in Or post id is missing";
	}

	wp_die();
}


add_action( 'wp_ajax_yic_update_idea_status_action', 'yic_update_idea_status_action_callback' );
function yic_update_idea_status_action_callback(){

	$post_id 		= intval($_POST['post_id']);	
	$idea_status	= sanitize_text_field($_POST['idea_status']);
	$user_id		= get_current_user_id();
	$msg 			= array();

	if(!empty($user_id) && !empty($post_id)){
		$param = array();
		$param['user_id'] 	= $user_id;		
		$param['post_id'] 	= $post_id;	
		$param['status_id'] = $idea_status;
		$update_status 		= yic_update_yic_idea_status($param);	
		$msg['status'] 		= 'success';
		$msg['message'] 	= "The status was updated successfully.";
		echo yic_show_response_meaasge($msg);	
		yic_last_update($post_id,$user_id,$last_activity='Status Changed',$activity_type='status');

	}else{

		$msg['status'] 		= 'erroe';
		$msg['message'] 	= "User not loged in Or post id is  missing";	

		echo yic_show_response_meaasge($msg);

	}

	wp_die();
}


add_action( 'wp_ajax_yic_idea_voting_action', 'yic_idea_voting_action_callback' );
function yic_idea_voting_action_callback(){

	$user_id		= get_current_user_id();
	$post_id 		= intval($_POST['post_id']);	
	$btn_activity	= sanitize_text_field($_POST['btn_activity']);
	
	if(!empty($user_id) && !empty($post_id)){
		$param 						= array();
		$param['user_id'] 			= $user_id;		
		$param['post_id'] 			= $post_id;	
		$param['vote_activity']		= ($btn_activity == 'downvote') ? 'down' : 'up' ;
		$make_vote 					= yic_make_vote($param);
		$make_vote['message'] 		= yic_show_response_meaasge($make_vote);
		$make_vote['total_vote']	= yic_get_total_vote_of_an_idea($post_id);
		$make_vote['voting_list']	= yic_get_voting_list($post_id);


		echo json_encode($make_vote);

	}else{
		
		$msg				= array();

		$msg['status'] 		= 'erroe';
		$msg['message'] 	= 'User not loged in Or post id is  missing';
		$msg['message'] 	= yic_show_response_meaasge($msg);
		$msg['total_vote']	= yic_get_total_vote_of_an_idea($post_id);
		$msg['voting_list']	= yic_get_voting_list($post_id);
		
		echo json_encode($msg);

	}

	wp_die();

}


////////////////////////////////
add_action( 'wp_ajax_yic_update_category_action', 'yic_update_category_action_callback' );
function yic_update_category_action_callback(){

	$user_id			= get_current_user_id();
	$post_id			= intval($_POST['post_id']);	
	//$checkCats_arr	= $_POST['checkCats']; /// This is a array
	$checkCats_arr		= array_map( 'sanitize_text_field', wp_unslash( $_POST['checkCats'] ) );
	
	
	
	$checkCats		= array();
	if(!empty($checkCats_arr)){
		foreach($checkCats_arr as $key=>$cat_id){
			$checkCats[$key] = intval($cat_id);
		}
	}
	

	$msg		= array();

	if(!empty($post_id)){
		$taxonomy = 'yic_category';


		
		$all_selected_cat_id = yic_get_all_term_ids_of_an_idea($post_id);



		if(!empty($all_selected_cat_id)){
			wp_remove_object_terms( $post_id, $all_selected_cat_id, $taxonomy );
		}


		if(!empty($checkCats)){



			wp_set_post_terms( $post_id, $checkCats, $taxonomy );



		}



		



		$msg['status'] 		= 'success';



		$msg['message'] 	= 'Update Successfull';



		$msg['message'] 	= yic_show_response_meaasge($msg);



		$msg['idea_cats'] 	= yic_get_all_category_names_of_an_idea($post_id);	



	}else{



		$msg['status'] 		= 'erroe';



		$msg['message'] 	= 'Post id is missing';	



		$msg['message'] 	= yic_show_response_meaasge($msg);	



		$msg['idea_cats'] 	= yic_get_all_category_names_of_an_idea($post_id);		



	}
	echo json_encode($msg);

	wp_die();



}


add_action( 'wp_ajax_yic_update_tag_action', 'yic_update_tag_action_callback' );
function yic_update_tag_action_callback(){

	$user_id	= get_current_user_id();
	$post_id	= intval($_POST['post_id']);	
	$all_tags	= sanitize_text_field($_POST['all_tags']);

	$msg		= array();

	if(!empty($post_id)){
		$taxonomy = 'yic_tag';

		//wp_set_post_tags( 42, 'meaning,life', true );
		
		$exists_tags = yic_get_all_tags_of_an_idea($post_id);
		if(!empty($exists_tags)){
			foreach($exists_tags as $tag){
				$slug			= $tag->slug;		
				wp_remove_object_terms( $post_id, $slug, $taxonomy);
			}
		}

		if(!empty($all_tags)){	
			wp_set_post_terms( $post_id, $all_tags, $taxonomy );
		}
		



		$msg['status'] 		= 'success';
		$msg['message'] 	= 'Update Successfull';
		$msg['message'] 	= yic_show_response_meaasge($msg);
		$msg['idea_tag'] 	= yic_get_all_tag_names_of_an_idea($post_id);	



	}else{


		$msg['status'] 		= 'erroe';
		$msg['message'] 	= 'Post id is missing';	
		$msg['message'] 	= yic_show_response_meaasge($msg);
		$msg['idea_tag'] 	= yic_get_all_tag_names_of_an_idea($post_id);	
		
	}


	echo json_encode($msg);

	wp_die();

}



add_action( 'wp_ajax_yic_get_browse_report_action', 'yic_get_browse_report_action_callback' );
add_action( 'wp_ajax_nopriv_yic_get_browse_report_action', 'yic_get_browse_report_action_callback' );
function yic_get_browse_report_action_callback(){

	//echo json_encode($_POST);

	

	$yic_idea_status		= array_map( 'intval', wp_unslash( $_POST['yic_idea_status'] ) );
	/*$yic_idea_status_arr	= $_POST['yic_idea_status'];	
	$yic_idea_status		= array();
	if(!empty($yic_idea_status_arr)){
		foreach($yic_idea_status_arr as $status_key => $status_id){
			$yic_idea_status[$status_key] = intval($status_id);
		}
	}*/
	

	$yic_idea_author		= array_map( 'intval', wp_unslash( $_POST['yic_idea_author'] ) );
	/*$yic_idea_author_arr	= $_POST['yic_idea_author'];
	$yic_idea_author		= array();
	if(!empty($yic_idea_author_arr)){
		foreach($yic_idea_author_arr as $key => $idea_author_id){
			$yic_idea_author[$key] = intval($idea_author_id);
		}
	}*/
	
	$yic_idea_cat		= array_map( 'sanitize_text_field', wp_unslash( $_POST['yic_idea_cat'] ) );
	/*$yic_idea_cat_arr	= $_POST['yic_idea_cat'];	
	$yic_idea_cat		= array();
	if(!empty($yic_idea_cat_arr)){
		foreach($yic_idea_cat_arr as $key => $idea_cat){
			$yic_idea_cat[$key] = sanitize_text_field($idea_cat);
		}
	}*/
	
	$yic_idea_tag		= array_map( 'sanitize_text_field', wp_unslash( $_POST['yic_idea_tag'] ) );
	/*$yic_idea_tag_arr	= $_POST['yic_idea_tag'];	
	$yic_idea_tag		= array();
	if(!empty($yic_idea_tag_arr)){
		foreach($yic_idea_tag_arr as $key => $idea_tag){
			$yic_idea_tag[$key] = sanitize_text_field($idea_tag);
		}
	}*/
	

	$yic_idea_title		= sanitize_text_field($_POST['yic_idea_title']);

	$posts_per_page		= intval($_POST['posts_per_page']);

	$paged				= intval($_POST['paged']);
	
	$yic_orderby		= sanitize_text_field($_POST['yic_order_by']);//'title';//'comment_count';
	$yic_order			= sanitize_text_field($_POST['yic_order']);//'ASC';//'DESC';

	

	

//	$args = array(

//		'post_type' => 'yic_idea',

//		'post_status' => array( 'publish'),

//		'posts_per_page' => $posts_per_page,

//		'paged' => $paged ,

//		's' => 'keyword',

//		'author__in' => array( 2, 6 ),

//		'post__in' => array( 2, 5, 12, 14, 20 ),

//		'tax_query' => array(

//			'relation' => 'AND',

//			array(

//				'taxonomy' => 'movie_genre',

//				'field'    => 'slug',

//				'terms'    => array( 'action', 'comedy' ),

//			),

//			array(

//				'taxonomy' => 'actor',

//				'field'    => 'term_id',

//				'terms'    => array( 103, 115, 206 ),

//				'operator' => 'NOT IN',

//			),

//		),

//	);



	//$posts_per_page = -1;

	$args = array(

		'post_type' 		=> 'yic_idea',

		'post_status' 		=> array( 'publish'),

		'posts_per_page'	=> $posts_per_page,

		'paged' 			=> $paged 

	);

	//// Define sort icon class name for each sortable column  ///////
	/*$title_sort_class				= 'fa-caret-up';
	$yic_activity_date_sort_class	= 'fa-caret-up';
	$yic_last_activity_sort_class	= 'fa-caret-up';
	$yic_view_post_sort_class		= 'fa-caret-up';
	$comment_count_sort_class		= 'fa-caret-up';
	$yic_activity_who_sort_class    = 'fa-caret-up';
	$yic_status_sort_class          = 'fa-caret-up';
	$yic_vote_sort_class            = 'fa-caret-up';*/
	
	
	$title_sort_class				= '';
	$yic_activity_date_sort_class	= '';
	$yic_last_activity_sort_class	= '';
	$yic_view_post_sort_class		= '';
	$comment_count_sort_class		= '';
	$yic_activity_who_sort_class    = '';
	$yic_status_sort_class          = '';
	$yic_vote_sort_class            = '';
	
	//// Define sort display css for each second sortable column  ///////
	$title_sort_css                 = '';
	$status_sort_css                = '';
	$vote_sort_css                  = '';
	$activity_date_sort_css         = ''; 
	$activity_who_sort_css          =''; 
	$last_activity_sort_css         = ''; 
	$view_sort_css                  = ''; 
	$comment_count_sort_css         = ''; 


	
	/*$title_sort_class				= '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	$yic_activity_date_sort_class	= '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	$yic_last_activity_sort_class	= '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	$yic_view_post_sort_class		= '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	$comment_count_sort_class		= '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	$yic_activity_who_sort_class    = '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	$yic_status_sort_class          = '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	$yic_vote_sort_class            = '<i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>';
	*/
	
	
	///////// Defind sorting order for each sortable column ////////
	$title_order					    = '';
	$yic_activity_date_order		    = '';
	$yic_last_activity_order		    = '';
	$yic_view_post_order			    = '';
	$comment_count_order			    = '';
	$yic_activity_who_order    		    = '';
	$yic_status_order          		    ='';
	$yic_vote_order            		    ='';
	
	$all_post_id_after_yic_vote_sorting = array();
	
	
	////////// start for set sorting argument /////////////////////
	switch ($yic_orderby) {
		case "title":
		
			$title_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$title_sort_css     = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			//$title_order		= $yic_order;
			
			/// set argument //////////
			$args['orderby'] 	= $yic_orderby;
			$args['order'] 		= $yic_order;
			
			break;
		case "yic_activity_date":
				
			//$yic_activity_date_sort_class 	= ($yic_order == 'ASC') ?  'fa-sort-up' : 'fa-sort-down';
			//$activity_date_sort_css         ='none'; 
			
			$yic_activity_date_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$activity_date_sort_css     = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			
			//$yic_activity_date_order		= $yic_order;
			
			/// set argument //////////
			$args['orderby'] 	= 'meta_value_datetime';
			$args['order'] 		= $yic_order;
			$args['meta_key'] 	= $yic_orderby;
			
			break;
		case "yic_last_activity":
		
			//$yic_last_activity_sort_class 	= ($yic_order == 'ASC') ?  'fa-sort-up' : 'fa-sort-down';
			//$last_activity_sort_css         = 'none'; 
			
			$yic_last_activity_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$last_activity_sort_css         = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			
			//$yic_last_activity_order		= $yic_order;
			
			/// set argument //////////
			$args['orderby'] 	= 'meta_value';
			$args['order'] 		= $yic_order;
			$args['meta_key'] 	= $yic_orderby;
						
			break;
		case "yic_view_post":
		
			//$yic_view_post_sort_class 	= ($yic_order == 'ASC') ?  'fa-sort-up' : 'fa-sort-down';
			//$view_sort_css              ='none'; 
			
			$yic_view_post_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$view_sort_css              = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			
			//$yic_view_post_order		= $yic_order;
			
			/// set argument //////////
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= $yic_order;
			$args['meta_key'] 	= $yic_orderby;
			
			break;
		case "comment_count":
		
			//$comment_count_sort_class 	= ($yic_order == 'ASC') ?  'fa-sort-up' : 'fa-sort-down';
			//$comment_count_sort_css     ='none';
			
			$comment_count_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$comment_count_sort_css     = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			
			//$comment_count_order		= $yic_order;
			
			
			/// set argument //////////
			$args['orderby'] 	= $yic_orderby;
			$args['order'] 		= $yic_order;
			
			break;
			
		case "yic_activity_who":
		
			//$yic_activity_who_sort_class 	= ($yic_order == 'ASC') ?  'fa-sort-up' : 'fa-sort-down';
			//$activity_who_sort_css          ='none';
			
			$yic_activity_who_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$activity_who_sort_css          = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			
			//$yic_activity_who_order		    = $yic_order;
			
			
			/// set argument //////////
			$args['orderby'] 	= 'meta_value';
			$args['order'] 		= $yic_order;
			$args['meta_key'] 	= $yic_orderby;
			
			break;
			
	   case "yic_status":
		
			//$yic_status_sort_class 	= ($yic_order == 'ASC') ?  'fa-sort-up' : 'fa-sort-down';
			//$yic_status_order       = $yic_order;
			
			
			$yic_status_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$status_sort_css        = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			
			//$yic_status_order       = $yic_order;
			
		    add_filter('posts_join','edit_posts_join_paged');

			function edit_posts_join_paged($query) {
		     global $wpdb;
             $query .= "LEFT JOIN ".YIC_IDEA_POST_STATUS." ON ".$wpdb->prefix."posts.ID = ".YIC_IDEA_POST_STATUS.".post_id
				                LEFT JOIN ".YIC_IDEA_STATUS." ON ".YIC_IDEA_STATUS.".id = ".YIC_IDEA_POST_STATUS.".idea_status";
				
				
				return $query;	
			}
			
		   add_filter( 'posts_orderby', 'filter_query' );

           if($yic_order=='DESC'){
			   function filter_query( $query) {
			     
				    $query = ''.YIC_IDEA_STATUS.'.status_title DESC';
					return $query;
			   }
		   }else{
			   function filter_query( $query) {

		          $query = ''.YIC_IDEA_STATUS.'.status_title ASC';
					return $query;
			   }
		   }

			break;				
				
	   case "yic_vote":
		
			//$yic_vote_sort_class 	= ($yic_order == 'ASC') ?  'fa-sort-up' : 'fa-sort-down';
			//$vote_sort_css          ='none';
			
			$yic_vote_sort_class 	= ($yic_order == 'ASC') ?  'yic-sort-active' : '';
			$vote_sort_css          = ($yic_order == 'DESC') ?  'yic-sort-active' : ''; 
			
			//$yic_vote_order         = $yic_order;

		  /*  add_filter('posts_join','edit_posts_join_paged');

			function edit_posts_join_paged($query) {
			    global $wpdb;
		         $query .= "LEFT JOIN ".YIC_VOTE_IDEA." ON ".$wpdb->prefix."posts.ID = ".YIC_VOTE_IDEA.".post_id";
				
				return $query;	
			}
			
		   add_filter( 'posts_orderby', 'filter_query' );

           if($yic_order=='DESC'){
			   function filter_query( $query) {
				   // $query = 'sum('.YIC_VOTE_IDEA.'.vote_status) DESC';
				    $query = YIC_VOTE_IDEA.'.vote_status DESC';
					return $query;
			   }
		   }else{
			   function filter_query( $query) {
				   // $query = 'sum('.YIC_VOTE_IDEA.'.vote_status) ASC';
				    $query = YIC_VOTE_IDEA.'.vote_status ASC';
					return $query;
			   }
		   }*/
		   $yic_order;
           $all_post_id_after_yic_vote_sorting	= yic_get_all_post_ids_by_sorting_of_vote_status($yic_order);
		   
		   
			break;	
			
		default:
		// Nothing default here
	}
	////////// end for set sorting argument /////////////////////
	

	if(!empty($yic_idea_status)){		

		$status_id		= implode(",",$yic_idea_status);
		$all_post_id	= yic_get_all_post_ids_by_status($status_id);		

		/*if(!empty($all_post_id)){

			$args['post__in'] =	$all_post_id ;

		}else{

			$args['post__in'] =	array(0);

		}*/

	}
	/*------------------------Array merge for post id (array of all post ids by staus and sorting array of vote staus)---------------------*/
	$all_fetch_post_id = array();
	echo '<pre>';
//print_r($all_post_id_after_yic_vote_sorting);
echo '</pre>';
    if(!empty($all_post_id_after_yic_vote_sorting)){

			$all_fetch_post_id = array_merge($all_post_id_after_yic_vote_sorting,$all_post_id);
			
			if(!empty($all_post_id)){

				foreach($all_post_id as $row ){
	
					array_push($all_post_id_after_yic_vote_sorting, $row);
	
				}

		    }
			
		   array_unique($all_post_id_after_yic_vote_sorting);
		   
           $all_fetch_post_id = $all_post_id_after_yic_vote_sorting;
		   
	}else{//either only set array of all post ids by staus
			$all_fetch_post_id = $all_post_id;
    }
	
	
	/*----------------Post Id assigned to "post__in"----------------------*/
    if(!empty($all_fetch_post_id)){
		
	      if(!empty($all_post_id_after_yic_vote_sorting)){//order by 'post__in' when sorting
            $args['orderby'] 	= 'post__in';
		  }
		  
		  $args['post__in'] =	$all_fetch_post_id ;

	}else{

			$args['post__in'] =	array(0);

    }

	/*----------------------------------------------------------------------*/

	if(!empty($yic_idea_title)){

		$args['s'] =	$yic_idea_title ;

	}

	

	if(!empty($yic_idea_author)){

		$args['author__in'] =	$yic_idea_author ;

	}

	

//	if(!empty($yic_idea_cat)){
//
//		$tax_qre_cat	= array(
//
//				'taxonomy' => 'yic_category',
//
//				'field'    => 'term_id',
//
//				'terms'    => $yic_idea_cat
//
//			);
//
//		$args['tax_query'][] =	$tax_qre_cat ;
//
//	}	


////////////// Start query fot categories or non categories idea //////////////////////////////
	if(!empty($yic_idea_cat)){

		$tax_qre_cat_none 	= array();

		$tax_qre_cat		= array();

		if(in_array('no_cat', $yic_idea_cat)){

			

			$all_cat		= te_yic_get_all_idea_category();

			$all_not_in_cat	= array();

			if(!empty($all_cat)){

				foreach($all_cat as $cat){

					$term_id	= $cat->term_id;

					array_push($all_not_in_cat,$term_id);

				}

			}

			

			if(!empty($all_not_in_cat))	{	

				$tax_qre_cat_none	= array(

						'taxonomy' => 'yic_category',

						'field'    => 'term_id',

						'terms'    => $all_not_in_cat,

						'operator' => 'NOT IN',

					);

				//$args['tax_query'][] =	$tax_qre_cat ;

			}

			

			$remove_key = array_search('no_cat', $yic_idea_cat);

			if( $remove_key !== false){

				unset($yic_idea_cat[$remove_key]);

			}

		}	

		

		if(!empty($yic_idea_cat)){

			$tax_qre_cat	= array(

					'taxonomy' => 'yic_category',

					'field'    => 'term_id',

					'terms'    => $yic_idea_cat

				);

			//$args['tax_query'][] =	$tax_qre_cat ;

		}

		

		if(!empty($tax_qre_cat_none) && !empty($tax_qre_cat)){

			

			$args['tax_query'][] = array(

				'relation'	=> 'OR', $tax_qre_cat_none, $tax_qre_cat

			);

			

		}elseif(!empty($tax_qre_cat_none)){

			

			$args['tax_query'][] =	$tax_qre_cat_none ;

			

		}elseif(!empty($tax_qre_cat)){

			

			$args['tax_query'][] =	$tax_qre_cat ;

		}

	}
////////////// End query fot categories or non categories idea //////////////////////////////


////////////// Start query fot tag or non tag idea //////////////////////////////		

	if(!empty($yic_idea_tag)){

		$tax_qre_tag_none 	= array();

		$tax_qre_tag		= array();

		if(in_array('no_tag', $yic_idea_tag)){

			

			$all_tag		= te_yic_get_all_idea_tag();

			$all_not_in_tag	= array();

			if(!empty($all_tag)){

				foreach($all_tag as $tag){

					$term_id	= $tag->term_id;

					array_push($all_not_in_tag,$term_id);

				}

			}

			

			if(!empty($all_not_in_tag))	{	

				$tax_qre_tag_none	= array(

						'taxonomy' => 'yic_tag',

						'field'    => 'term_id',

						'terms'    => $all_not_in_tag,

						'operator' => 'NOT IN',

					);

				//$args['tax_query'][] =	$tax_qre_tag ;

			}

			

			$remove_key = array_search('no_tag', $yic_idea_tag);

			if( $remove_key !== false){

				unset($yic_idea_tag[$remove_key]);

			}

		}	

		

		if(!empty($yic_idea_tag)){

			$tax_qre_tag	= array(

					'taxonomy' => 'yic_tag',

					'field'    => 'term_id',

					'terms'    => $yic_idea_tag

				);

			//$args['tax_query'][] =	$tax_qre_tag ;

		}

		

		if(!empty($tax_qre_tag_none) && !empty($tax_qre_tag)){

			

			$args['tax_query'][] = array(

				'relation'	=> 'OR', $tax_qre_tag_none, $tax_qre_tag

			);

			

		}elseif(!empty($tax_qre_tag_none)){

			

			$args['tax_query'][] =	$tax_qre_tag_none ;

			

		}elseif(!empty($tax_qre_tag)){

			

			$args['tax_query'][] =	$tax_qre_tag ;

		}

	}


////////////// End query fot tag or non tag idea //////////////////////////////	


	if(isset($args['tax_query']) && count($args['tax_query']) > 1){

		$args['tax_query']['relation'] = 'AND';

	}			
			
	$the_query = new WP_Query( $args );


	ob_start();

	

		if ( $the_query->have_posts() ) {

			

			$follow_css	= (!is_user_logged_in()) ? ' display:none; ' : '';

			

			?>
         
  <table class="yic_custom_table" id="yic_browse_report_tbl">

                    <thead>
                        <tr>
                            <th width="21%" class="yic-relative-cell">
                            	Title 
                            	<a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $title_sort_class;?> yic_sort_up" aria-hidden="true" yic-order-by="title"></i><i class="fa fa-caret-down <?php echo $title_sort_css;?> yic_sort_down" aria-hidden="true" yic-order-by="title"></i>
                                </a>
							</th>
                            <th width="10%" class="yic-relative-cell">Status
                             <a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $yic_status_sort_class;?> yic_sort_up" aria-hidden="true"  yic-order-by="yic_status"></i><i class="fa fa-caret-down <?php echo $status_sort_css;?> yic_sort_down" aria-hidden="true"  yic-order-by="yic_status"></i>
  
                                </a>
                            
                            </th>
                            <th width="7%" class="yic-relative-cell">
                            	<!--Votes--><i class="fa fa-thumbs-o-up" title="Votes"></i>
                                <a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $yic_vote_sort_class;?> yic_sort_up" aria-hidden="true" yic-order-by="yic_vote"></i><i class="fa fa-caret-down <?php echo $vote_sort_css;?> yic_sort_down" aria-hidden="true" yic-order-by="yic_vote"></i>
                                </a>
                            </th>
                            <th width="18%" class="yic-relative-cell">Last Activity
                            	<a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $yic_activity_date_sort_class;?> yic_sort_up" aria-hidden="true" yic-order-by="yic_activity_date" ></i><i class="fa fa-caret-down <?php echo $activity_date_sort_css;?> yic_sort_down" aria-hidden="true" yic-order-by="yic_activity_date"></i>
                                </a>
							</th>
                            <th width="14%" class="yic-relative-cell">
                               Who
                               <a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $yic_activity_who_sort_class;?> yic_sort_up" aria-hidden="true" yic-order-by="yic_activity_who"></i><i class="fa fa-caret-down <?php echo $activity_who_sort_css;?> yic_sort_down" aria-hidden="true" yic-order-by="yic_activity_who"></i>
                              </a>
                            </th>
                            <th width="10%" class="yic-relative-cell">What
                            	<a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $yic_last_activity_sort_class;?> yic_sort_up" aria-hidden="true" yic-order-by="yic_last_activity"></i><i class="fa fa-caret-down <?php echo $last_activity_sort_css;?> yic_sort_down" aria-hidden="true" yic-order-by="yic_last_activity"></i>
                                </i></a>
							</th>
                            <th width="7%" class="yic-relative-cell">
                            	<!--Views--><i class="fa fa-eye" title="Views"></i>
                            	<a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $yic_view_post_sort_class;?> yic_sort_up" aria-hidden="true" yic-order-by="yic_view_post"></i><i class="fa fa-caret-down <?php echo $view_sort_css;?> yic_sort_down" aria-hidden="true" yic-order-by="yic_view_post"></i>
                                
                                </a>
							</th>
                            <th width="7%" class="yic-relative-cell">
                            	<!--Comments--> <i class="fa fa-comment" title="Comments"></i>
                            	<a href="javascript:;" class="yic_sort_column yic-sort-icon">
                                	<i class="fa fa-caret-up <?php echo $comment_count_sort_class;?> yic_sort_up" aria-hidden="true" yic-order-by="comment_count"></i><i class="fa fa-caret-down <?php echo $comment_count_sort_css;?> yic_sort_down" aria-hidden="true" yic-order-by="comment_count"></i>
                                </a>
							</th>
                            <th width="7%" style=" <?php echo $follow_css;?> text-align:center;"><!--Follow--> <i class="fa fa-check-square-o" title="Following"></i></th>
                        </tr>
                     </thead> 

                     <tbody>
			

                     	<?php

                        	while ( $the_query->have_posts() ) {

								$the_query->the_post();

								

								$post_id			= get_the_id();

								$alloted_status 	= yic_assign_status($post_id);

								$total_vote 		= yic_get_total_vote_of_an_idea($post_id);

								$total_vote 		= ($total_vote=='')? 0 : $total_vote ;

								$vote_cls 			= ($total_vote >= 0) ? 'yic-green' : 'yic-red' ;

																

								$yic_last_activity 	= get_post_meta( $post_id, 'yic_last_activity', true );

								$_yic_activity_date	= get_post_meta( $post_id, 'yic_activity_date', true );

								$yic_activity_date 	= (!empty($_yic_activity_date))?date_i18n(YIC_DATE_FORMAT, strtotime($_yic_activity_date)):''; 								

								$yic_activity_time 	= (!empty($_yic_activity_date))?date_i18n(YIC_TIME_FORMAT, strtotime($_yic_activity_date)):''; 

								$yic_activity_who 	= get_post_meta( $post_id, 'yic_activity_who', true );

								$activity_user_name = '<span class="yic-empty">-</span>';

								$total_view			= yic_get_post_view_count($post_id);

								

								if(!empty($yic_activity_who)){

									$user_id				= $yic_activity_who;
									$user_info 				= get_userdata($user_id);	
									$activity_user_name 	= ($user_info) ? $user_info->display_name : '<span class="yic-empty">-</span>' ;									

								}

								

								$num_comments 		= get_comments_number(); 		
								$param				= array();
								$param['user_id'] 	= get_current_user_id();
								$param['post_id'] 	= $post_id;
								$is_followed		= yic_is_user_followed_the_idea($param);
								$follow_cls			= ($is_followed) ? 'fa-check-square-o' : 'fa-square-o';
								$follow_checked		= ($is_followed) ? ' checked="checked" ' : '';

								$idea_cats 			= yic_get_all_category_names_of_an_idea($post_id);
								$idea_cats 			= ($idea_cats == "No category assigned") ? '<span class="yic-none">None</span>' : $idea_cats;
								
								$idea_tags 			= yic_get_all_tag_names_of_an_idea($post_id);
								$idea_tags			= ($idea_tags == "No tag assigned")	? '<span class="yic-none">None</span>' : $idea_tags;		

								?>

									<tr>

                                        <td>

                                            <i class="fa fa-lightbulb-o"></i> 

                                            <a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a>
                                            <div class="browse-cat"><strong>Categories:</strong> <?php echo $idea_cats;?></div>
                                            <div class="browse-cat"><strong>Tags:</strong> <?php echo $idea_tags;?></div>

                                        </td>

                                        <td><span class="active_style"><?php echo $alloted_status;?></span></td>

                                        <td style="text-align:center;"><span class="<?php echo $vote_cls;?>"><?php echo $total_vote;?></span></td>

                                        <td>

                                        	<?php 

												if(!empty( $yic_activity_date)){ 

													echo $yic_activity_date;?>

													<!--<br />-->

													<?php echo $yic_activity_time;

												}else{

													echo '<span class="yic-empty">-</span>';

												}?>   

                                        </td>

                                        <td><?php echo $activity_user_name;?></td>

                                        <td><?php echo (!empty($yic_last_activity)) ? ucwords($yic_last_activity) : '<span class="yic-empty">-</span>';?></td>

                                        <td style="text-align:center;"><?php echo $total_view;?></td>

                                        <td style="text-align:center;"><?php echo $num_comments;?></td>                                       

										<?php
                                        	if(!is_user_logged_in()){
												?>
													<td style="text-align:center; <?php echo $follow_css;?> "><i class="fa <?php echo $follow_cls;?>"></i></td>                 
												<?php 
											}else{
												?>												
                                                    <td style="text-align:center; <?php echo $follow_css;?> ">
                                                        <input type="checkbox" class="yic_browse_follow" value="1" <?php echo $follow_checked;?> post_id = "<?php echo $post_id;?>" >
                                                    </td>
												 <?php 
										 	}
										 ?>

                                    </tr>

									

								<?php

							}

						?>

                        

                     </tbody>

				</table>

                

                <?php

                	$total_post_found = $the_query->found_posts;

					if($total_post_found > $posts_per_page){

						$total_pages = ceil( $total_post_found / $posts_per_page );

						?>

							<ul class="yic-pagination">

                            	<?php 

									if($paged != 1){

										?>

											<li>

                                            	<a href="javascript:;" class="yic_brows_report_paginate" paged="<?php echo $paged-1;?>">&laquo;</a>

                                            </li>

										<?php

									}

									

									$max_show_page_limit	= 8 ;

									

									$page_start				= 1;

									$page_end				= $max_show_page_limit + 1;

									

									if($total_pages <= $max_show_page_limit){

										

										$page_start			= 1;

										$page_end			= $total_pages;

										

									}else{

										

										$half_limit	= ($max_show_page_limit / 2);

										if( $paged > $half_limit ){

											$page_end			= ($total_pages >= ($paged + $half_limit) ) ? $paged + $half_limit : $total_pages ;

											$page_start			=  $page_end - $max_show_page_limit;

										}

										

									}

									

									//$max_show_page_limit = $total_pages ;

									//$page_start				= 1;

									//if( $paged > ($max_show_page_limit/2))

									

									if($page_start > 1){

										

										$active_class 	= '' ;

										$paginate_class	= 'yic_brows_report_paginate' ;

										?>

                                        	<li class="<?php echo $active_class;?>">

                                            	<a href="javascript:;" class="<?php echo $paginate_class;?>" paged="<?php echo 1;?>">

													<?php echo 1;?>

                                                </a>

                                            </li>

											<li><a href="javascript:;">...</a></li>

										<?php

									}

									

									

                                    for($page_num = $page_start; $page_num <= $page_end; $page_num++){

										$active_class 	= ( $paged == $page_num ) ? 'active' : '';

										$paginate_class	= ( $paged != $page_num ) ? 'yic_brows_report_paginate' : '';

                                        ?>

                                            <li class="<?php echo $active_class;?>">

                                            	<a href="javascript:;" class="<?php echo $paginate_class;?>" paged="<?php echo $page_num;?>">

													<?php echo $page_num;?>

                                                </a>

                                            </li>

                                        <?php

                                    }

									

									

									if($total_pages > $page_end){

										$active_class 	= '' ;

										$paginate_class	= 'yic_brows_report_paginate' ;

										?>

                                        	<li><a href="javascript:;">...</a></li>

                                            <li class="<?php echo $active_class;?>">

                                            	<a href="javascript:;" class="<?php echo $paginate_class;?>" paged="<?php echo $total_pages;?>">

													<?php echo $total_pages;?>

                                                </a>

                                            </li>

                                        <?php

										

									}

									

									

									if($paged != $total_pages){

										?>

											<li>

                                            	<a href="javascript:;" class="yic_brows_report_paginate" paged="<?php echo $paged+1;?>">&raquo;</a>

                                            </li>

										<?php

									}

                                    ?>

								

                            </ul>

						<?php

						/*?>

							<!--Custom Pagination-->

                            <ul class="yic-pagination">

                                <li><a href="#">&laquo;</a></li>

                                <li><a href="#">1</a></li>

                                <li class="active"><a href="#">2</a></li>

                                <li><a href="#">3</a></li>

                                <li><a href="#">4</a></li>

                                <li><a href="#">...</a></li>

                                <li><a href="#">5</a></li>

                                <li><a href="#">&raquo;</a></li>

                            </ul>

                           <!--Custom Pagination-->

                            

						<?php*/

					}

				?>

                

			<?php			

			

			wp_reset_postdata();

		} else {

			// no posts found

			?>

				<div class="yic-no-result"><h3>No Ideas Found</h3></div>

			<?php

		}

	

	

	echo ob_get_clean();



	wp_die();

}

//array_map( 'sanitize_text_field', wp_unslash( $_POST['yic_idea_status'] ) );
///////////////////////////
add_action( 'wp_ajax_yic_allow_disallow_comment_action', 'yic_allow_disallow_comment_action_callback' );
function yic_allow_disallow_comment_action_callback(){
	$allow_data	= intval($_POST['allow_data']);
	$post_id	= intval($_POST['post_id']);
	
	if(!empty($allow_data)){
		yic_allow_comment($post_id);
		echo 'Comment Allow done';
	}else{
		yic_disallow_comment($post_id);
		echo 'Comment Disallow done';
	}
	
	//$update 	= update_post_meta($post_id, 'yic_is_comment_allow',$allow_data );
	//echo (!empty($update))? 'Status Updated' : 'Status Not Updated';
	
	wp_die();
}



add_action( 'wp_ajax_yic_load_more_tags_action', 'yic_load_more_tags_action_callback' );
add_action( 'wp_ajax_nopriv_yic_load_more_tags_action', 'yic_load_more_tags_action_callback' );
function yic_load_more_tags_action_callback(){
	$items_per_page = intval($_POST['items_per_page']);
	$paged 			= intval($_POST['currentPage']);
	
	$param = array(
				'paged' 			=> $paged,
				'items_per_page' 	=> $items_per_page,
				
			);
	$tag_arr = yic_get_tags_from_tag_cloud($param);
	
	ob_start();
	if(!empty($tag_arr)){
									
		foreach($tag_arr as $tag){
			?>
				<span class="element-item" data-category="">
					<?php
						echo $tag;
					?>
				</span>
			<?php
		}
		
	}
	echo ob_get_clean();
	wp_die();
}



add_action( 'wp_ajax_yic_load_more_recent_ideas_action', 'yic_load_more_recent_ideas_action_callback' );
add_action( 'wp_ajax_nopriv_yic_load_more_recent_ideas_action', 'yic_load_more_recent_ideas_action_callback' );
function yic_load_more_recent_ideas_action_callback(){
	$currentPage 	= intval($_POST['currentPage']);
	$items_per_page = intval($_POST['items_per_page']);
	
	$params 					= array();
	$params['posts_per_page']	= $items_per_page;
	$params['paged']			= $currentPage;
	$recent_ideas_data 			= yic_get_recent_idea_list($params);
	
	echo json_encode($recent_ideas_data);
	wp_die();
}