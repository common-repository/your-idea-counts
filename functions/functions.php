<?php

if ( ! defined( 'ABSPATH' ) ){

	exit; // Exit if accessed directly.

}

/*----------- Get all post ids by sorting of vote status------------------------*/

function yic_get_all_post_ids_by_sorting_of_vote_status($yic_order){
	    global $wpdb;
	
        $qre	= "SELECT ID, sum(IFNULL(".YIC_VOTE_IDEA.".vote_status, 0)) AS ASDF FROM ".$wpdb->prefix."posts LEFT JOIN ".YIC_VOTE_IDEA." ON ".$wpdb->prefix."posts.ID = ".YIC_VOTE_IDEA.".post_id group by ".$wpdb->prefix."posts.ID ORDER BY ASDF ".$yic_order."";

		$result	= $wpdb->get_results($qre);


		$all_post_ids = array();

		if(!empty($result)){

			foreach($result as $row ){

				array_push($all_post_ids, $row->ID);

			}

		}
	 return $all_post_ids;	
}
/*-----------------------End---------------------------------------*/




///////// Start Call Widget templates //////////

function yic_create_idea(){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/create_your_idea.php');

	return ob_get_clean();

}





function yic_get_recent_ideas($posts_per_page = 5, $title = '', $style = ''){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/recent_ideas.php');

	return ob_get_clean();

}



function yic_get_browse_report($posts_per_page = 25){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/browse_report.php');

	return ob_get_clean();

}





function yic_get_top_ideator($posts_per_page = 25, $title = '', $style = ''){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/top_ideator.php');

	return ob_get_clean();

}





function yic_get_top_thinkers( $posts_per_page = 25, $title = '', $style = ''){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/top_thinkers.php');

	return ob_get_clean();

}





function yic_show_tag_cloud($title = '',$items_per_page = 25, $style = ''){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/tag_cloud.php');

	return ob_get_clean();

}





function yic_show_top_commenters($posts_per_page = 25){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/top_commenters.php');

	return ob_get_clean();

}





function yic_show_most_vibrant($title = '', $posts_per_page = 25, $style = ''){

	ob_start();

		include(YIC_IDEA_PLUGIN_DIR.'/templates/most_vibrant.php');

	return ob_get_clean();

}

///////// End Call Widget templates //////////







function yic_get_template_default_content(){

	ob_start();

	?>

		<span style="text-decoration: underline;"><strong>Idea Details:</strong></span>

        [Elaborate or explain the idea in as full detail as possible]

        [Add screen shots, video and images to enhance the description]

        

        <span style="text-decoration: underline;"><strong>Version Or Release:</strong></span>

        [The version or release, if applicable]

        

        <span style="text-decoration: underline;"><strong>Process:</strong></span>

        [Describe the process, end to end]

        

        <span style="text-decoration: underline;"><strong>Gap:</strong></span>

        [How does this fill the gap in the process or outcome?]

        

        <span style="text-decoration: underline;"><strong>Benefits:</strong></span>

        [What are the benefits realized by implementing the idea?]

	<?php	

	return ob_get_clean();

}









function te_yic_get_all_idea_category(){

	$taxonomia = 'yic_category';

	$all_terms = get_terms( array(

		'taxonomy' => $taxonomia,

		'hide_empty' => false,

	) );



	return $all_terms ;

}



function te_yic_get_all_idea_tag(){



	$taxonomia = 'yic_tag';

	$all_terms = get_terms( array(

		'taxonomy' => $taxonomia,

		'hide_empty' => false,

	) );



	return $all_terms ;



}





function yic_get_tags_from_tag_cloud($param = array()){

	

	

	$arg	= array( 

				'taxonomy' 	=> 'yic_tag',

				'orderby'	=> 'name',

				'order'		=> 'ASC',

				'number' 	=> 10000000, 

				'format'	=> 'array',//'list', 'array', 'flat'				

			);

			

	if(!empty($param) && isset($param['items_per_page']) && $param['items_per_page'] != -1){

		

		$items_per_page = $param['items_per_page'];		

	

		$page 			= (isset($param['paged']) && !empty($param['paged'])) ? $param['paged'] : 1;	

		

		$offset 		= ( $page-1 ) * $items_per_page;

		

		$arg['number'] 	= $items_per_page;

		$arg['offset'] 	= $offset;

	}

	

		

	$tag_arr = wp_tag_cloud($arg);

	

	return $tag_arr;

}



function te_yic_get_all_idea_tag_cloud_tags(){

	$arg	= array( 

				'taxonomy' 	=> 'yic_tag',

				'orderby'	=> 'name',

				'order'		=> 'ASC',

				'number' 	=> 10000000, 

				'format'	=> 'array',//'list', 'array', 'flat'

				'number'	=> 0, //The number of actual tags to display in the cloud. (Use '0' to display all tags.) Default: 45			

			);

	$tag_arr = wp_tag_cloud($arg);

	

	return $tag_arr;

}







function yic_get_all_author(){



	$args	= array(

		'orderby' 	=> 'display_name',

		'order' 	=> 'ASC',

	);



	return get_users($args);



}



function te_yic_get_defaule_category_for_create_idea(){

	return get_option('defaule_category_for_create_idea');

}





function te_yic_get_top_ideator_delivered_status(){

	return get_option('yic_top_ideator_delivered_status');

}





function yic_show_response_meaasge($msg = array()){

	if(!empty($msg)){

		$status 	= $msg['status'];		

		$message 	= $msg['message'];

		ob_start();

		if($status != 'error'){

			//////// success ///////////

			?>

                <div class="yic-alert yic-alert-success">

                    <strong>Success!</strong> <?php echo $message;?>

                </div>

			<?php

		}else{

			//////// error ///////

			?>

                <div class="yic-alert yic-alert-danger">

                  <strong>Error!</strong> <?php echo $message;?>

                </div>

			<?php

		}

		return ob_get_clean();

	}else{

		return false;

	}



}







function yic_is_user_followed_the_idea($param = array()){



	if(isset($param['user_id']) && !empty($param['user_id']) && isset($param['post_id']) && !empty($param['post_id']) ){

		

		$user_id 	= $param['user_id'];

		$post_id 	= $param['post_id'];



		global $wpdb;



		$qre 		= "SELECT follow_status  FROM ".YIC_FOLLOW_IDEA." WHERE user_id = ".$user_id." AND post_id=".$post_id;

		$followed 	= $wpdb->get_var($qre);

		return ($followed)? true : false;

	}else{

		return false;

	}

}















function yic_get_all_tags_of_an_idea($post_id = ''){

	if(!empty($post_id)){

		return $term_list = wp_get_post_terms($post_id, 'yic_tag', array("fields" => "all"));

	}else{

		return false;

	}

}









function yic_get_all_category_of_an_idea($post_id = ''){

	if(!empty($post_id)){

		return $term_list = wp_get_post_terms($post_id, 'yic_category', array("fields" => "all"));

	}else{

		return false;

	}

}





function yic_update_follow_unfollow_status($param = array()){



	if(isset($param['user_id']) && !empty($param['user_id']) && isset($param['post_id']) && !empty($param['post_id']) ){



		$user_id 	= $param['user_id'];

		$post_id 	= $param['post_id'];



		global $wpdb;



		$qre 		= "SELECT * FROM ".YIC_FOLLOW_IDEA." WHERE user_id = ".$user_id." AND post_id=".$post_id;

		$follow_row	= $wpdb->get_row($qre);

		if($follow_row){

			/////// Update //////

			$follow_id			= $follow_row->follow_id;

			$follow_status 		= $follow_row->follow_status;

			$would_be_status 	= ($follow_status == 1) ? 0 : 1 ;

			$last_activity		= ($would_be_status) ? 'Followed' : 'Unfollowed';

			//$last_activity	= 'Follow';

			

			$update	=  $wpdb->update( 

							YIC_FOLLOW_IDEA, 

							array( 

								'follow_status' => $would_be_status,								

								'follow_date' => date_i18n('Y-m-d H:i:s'),

							), 

							array( 'follow_id' => $follow_id )



						);



			yic_last_update($post_id,$user_id,$last_activity,$activity_type='follow');









			return $update ;



		}else{







			////// Insert //////

			

			$ins = $wpdb->insert( 

						YIC_FOLLOW_IDEA, 

						array( 



							'post_id'		=> $post_id,

							'user_id'		=> $user_id,

							'follow_status'	=> 1, 

						) 

					);





			if($ins){	

				yic_last_update($post_id,$user_id,$last_activity='Followed',$activity_type='follow');

				return $wpdb->insert_id;

			}else{

				return $ins ; 

			}



		}



	}else{

		return false;

	}



}















function yic_get_all_status(){



	global $wpdb;

	$qry_status 		= "SELECT * FROM ".YIC_IDEA_STATUS ;

	$qry_status_result 	= $wpdb->get_results($qry_status);

	

	return $qry_status_result;

}





function yic_get_status_id_by_status_name($status_name = ''){



	global $wpdb;

	$qry_status	= "SELECT id FROM ".YIC_IDEA_STATUS." WHERE status_title = '$status_name'" ;

	$status_id	= $wpdb->get_var($qry_status);

	

	return $status_id;

}





function yic_get_status_name_by_status_id($status_id = ''){



	global $wpdb;

	$qry_status		= "SELECT status_title FROM ".YIC_IDEA_STATUS." WHERE id = '$status_id'" ;

	$status_name 	= $wpdb->get_var($qry_status);

	

	return $status_name;

}







function yic_update_yic_idea_status($param = array()){



	if(!empty($param)){

		//$user_id 	= $param['user_id'];

		$post_id 	= $param['post_id'];

		$status_id	= $param['status_id'];



		global $wpdb;

		$check_status_available	= "SELECT count(*) AS statusnum FROM ".YIC_IDEA_POST_STATUS." WHERE post_id=".$post_id; 

		$qry_status_available	= $wpdb->get_var($check_status_available);



		//print_r($qry_status_available);

		if($qry_status_available){

			$update	=  $wpdb->update( 



							YIC_IDEA_POST_STATUS, 

							array( 

								'idea_status' 			=> $status_id,

								'status_update_date'	=> date_i18n('Y-m-d H:i:s')

							), 

							array( 'post_id' => $post_id )

						);

			return $update ;



		}else{			





			////// Insert //////

			

			$ins = $wpdb->insert( 

						YIC_IDEA_POST_STATUS, 

						array( 

							'post_id' 		=> $post_id, 

							'idea_status' 	=> $status_id

						) 

					);

			if($ins){

				return $wpdb->insert_id;

			}else{

				return $ins ; 

			}			





		}		



	}else{		

		return false;		

	}

}















function yic_make_vote($param = array()){



	$msg 			= array();

	$msg['status'] 	= 'error';

	$msg['message'] = 'Argument missing';



	if(!empty($param)){





		$user_id		= $param['user_id'];

		$post_id		= $param['post_id'];

		$vote_activity	= $param['vote_activity'];			

		

		global $wpdb;

		$post_vote_qre	= "SELECT vote_status FROM ".YIC_VOTE_IDEA." WHERE post_id=".$post_id." AND user_id=".$user_id; 

		$post_vote		= $wpdb->get_var($post_vote_qre);

		$vote_val 		= ($vote_activity == 'down') ? -1 : 1 ;



		if($post_vote != NULL){

			////// Update





			if($vote_activity == 'down' && $post_vote == -1){

				

				$msg['status'] 	= 'error';

				$msg['message'] = 'You have already posted a down vote.';

				

			}elseif($vote_activity == 'up' && $post_vote == 1){

				$msg['status'] 	= 'error';

				$msg['message'] = 'You have already posted a up vote.';

			}else{			

				$update	=  $wpdb->update(

								YIC_VOTE_IDEA, 

								array( 

									'vote_status'	=> $vote_val,

									'vote_date'		=> date_i18n('Y-m-d H:i:s')

								), 

								array( 

									'post_id' => $post_id,

									'user_id' => $user_id	

								)

							);











				if($update){

					

					yic_last_update($post_id,$user_id,$last_activity = 'Voted '.$vote_activity,$activity_type='vote');



					$msg['status'] 	= 'success';

					$msg['message'] = 'You vote successfully posted.';



				}else{



					$msg['status'] 	= 'erroe';

					$msg['message'] = 'Something went wrong.'; 



				}



			}



		}else{			





			////// Insert //////



			$ins = $wpdb->insert( 

						YIC_VOTE_IDEA, 

						array( 

							'vote_status'	=> $vote_val,

							'post_id'		=> $post_id,

							'user_id'		=> $user_id

						) 

					);







			if($ins){

				yic_last_update($post_id,$user_id,$last_activity = 'Voted '.$vote_activity,$activity_type='vote');

				$msg['status'] 	= 'success';

				$msg['message'] = 'You vote successfully posted.';



			}else{



				$msg['status'] 	= 'erroe';

				$msg['message'] = 'Something went wrong.'; 



			}			

			

		}		



	}



	return $msg ;



}















function yic_get_total_vote_of_an_idea($post_id = ''){







	if(!empty($post_id)){



		global $wpdb;

		$total_votes_qre	= "SELECT SUM(vote_status) as total_votes FROM ".YIC_VOTE_IDEA." WHERE post_id=".$post_id; 

		$total_votes		= $wpdb->get_var($total_votes_qre);

		$total_votes		= (!empty($total_votes)) ? $total_votes : 0;



		return $total_votes;



	}else{

		return 0;

	}



}















function yic_idea_is_votable($post_id = ''){



	if(!empty($post_id)){



		global $wpdb;

		$idea_status_qry	= "SELECT idea_status FROM ".YIC_IDEA_POST_STATUS." WHERE post_id=".$post_id; 

		$idea_status		= $wpdb->get_var($idea_status_qry);



		$is_votable			= '';

		if(!empty($idea_status)){

			$is_votable_qry	= "SELECT is_votable FROM ".YIC_IDEA_STATUS." WHERE id=".$idea_status; 

			$is_votable		= $wpdb->get_var($is_votable_qry);

		}else{



			///////// get active status permission /////

			$is_votable_qry	= "SELECT is_votable FROM ".YIC_IDEA_STATUS." WHERE status_title='Active'"; 

			$is_votable		= $wpdb->get_var($is_votable_qry);

		}





		if(!empty($is_votable) && $is_votable == 'Y'){			

			return true;

		}else{

			return false;

		}	



	}else{

		return false;

	}



}















function yic_get_all_term_ids_of_an_idea($post_id = ''){







	if(!empty($post_id)){



		$all_selected_cat_id	= array();

		$all_selected_cats 		= yic_get_all_category_of_an_idea($post_id);

		if(!empty($all_selected_cats)){



			foreach($all_selected_cats as $selected_cat){

				array_push($all_selected_cat_id, $selected_cat->term_id);

			}

		}



		return $all_selected_cat_id;

	}else{



		return false;

	}



}







function yic_get_all_category_names_of_an_idea($post_id = ''){







	if(!empty($post_id)){



		$all_cats 	= yic_get_all_category_of_an_idea($post_id);		



		$idea_cats 	= 'No category assigned';		





		if(!empty($all_cats)){



			$idea_cats = '';



			foreach($all_cats as $cat){

				$idea_cats .= $cat->name.', ';			

			}



			$idea_cats = trim($idea_cats, ', ');



		}





		return $idea_cats ;



	}else{



		return false;



	}







}















function yic_is_allow_comment($post_id = ''){



	



	if(!empty($post_id)){





		//comments_open( $post_id );

		//$yic_is_comment_allow = get_post_meta($post_id,'yic_is_comment_allow', true);

		$yic_is_comment_allow = comments_open( $post_id );

		

		//if($yic_is_comment_allow === '0'){

		if(!$yic_is_comment_allow){



			return false;



		}else{

			return true;



		}

	}else{



		return false;



	}







}















function yic_allow_comment($post_id = ''){







	if(!empty($post_id)){







		update_post_meta($post_id, 'yic_is_comment_allow', '1');



		yic_update_comment_allow_status($post_id, 'open');



		return true;







	}else{







		return false;







	}	







}















function yic_disallow_comment($post_id = ''){







	if(!empty($post_id)){







		update_post_meta($post_id, 'yic_is_comment_allow', '0');

		

		yic_update_comment_allow_status($post_id, 'closed');



		return true;







	}else{







		return false;







	}	







}







function yic_update_comment_allow_status($post_id = 0, $status = 'open'){

	//open/closed

	if(!empty($post_id)){

		$status = ($status == 'open') ? $status : 'closed';

		

		global $wpdb;

		$wpdb->update( 

			$wpdb->posts, 

			array( 

				'comment_status' 	=> $status //'open'//'closed'

			), 

			array( 'ID' => $post_id )

		);

	}

}











function yic_get_all_tag_names_of_an_idea($post_id = ''){







	if(!empty($post_id)){



		$all_tags = yic_get_all_tags_of_an_idea($post_id);

		$idea_tags = 'No tag assigned';



		if(!empty($all_tags)){



			//echo '<pre>';

				//print_r($all_tags);

			//echo '</pre>';





			$idea_tags = '';







			foreach($all_tags as $tag){







				$idea_tags .= $tag->name.', ';					



			}



			$idea_tags = trim($idea_tags, ', ');



		}







		return $idea_tags ;







	}else{







		return false;







	}







}











function yic_get_all_voting_user_id_of_an_idea($post_id = ''){



	if(!empty($post_id)){



		global $wpdb;

		$user_votes_qre	= "SELECT user_id, vote_status FROM ".YIC_VOTE_IDEA." WHERE post_id=".$post_id." ORDER BY vote_date DESC"; 

		$user_results	= $wpdb->get_results($user_votes_qre);

		return $user_results ;	



	}else{

		return false;

	}



}















function yic_get_voting_list($post_id = ''){



	if(!empty($post_id)){	



		$all_voting_data = yic_get_all_voting_user_id_of_an_idea($post_id);



		ob_start();

		?>

			<ul class="yic-sidebar-list-group yic-mergin-top-zero">

				<?php

				if($all_voting_data){

					

					foreach($all_voting_data as $index=>$voting_data){

						

						$user_id 		= $voting_data->user_id;

						$post_vote 		= $voting_data->vote_status;

						$user_info 		= get_userdata($user_id);

						$display_name	= $user_info->display_name;

						$icon_cls 		= ($post_vote == -1) ? 'fa-arrow-circle-down' : 'fa-arrow-circle-up';

						

						echo '<li class="yic-sidebar-list-group-item"><i class="fa '.$icon_cls.'"></i> '.$display_name.'</li>';

						if($index >= 4){

							echo '<li class="yic-sidebar-list-group-item"><button class="yic-btn-success yic-btn-full">See All Voting</button></li>';

							break;

						}

					}



				}else{

					//echo '<li class="yic-list-group-item">No vote is available</li>';

					echo '<li class="yic-sidebar-list-group-item yic-grey-txt">Currently there are no votes</li>';



				}		

				?>

			</ul>

		<?Php

		return ob_get_clean();



	}else{

		return false;

	}

}















function yic_get_user_vote_status( $param = array()){

	

	if(!empty($param) && isset($param['user_id']) && isset($param['post_id']) && !empty($param['user_id']) && !empty($param['post_id'])){

		

		$post_id = $param['post_id'];

		$user_id = $param['user_id'];

		global $wpdb;



		$post_vote_qre	= "SELECT vote_status FROM ".YIC_VOTE_IDEA." WHERE post_id=".$post_id." AND user_id=".$user_id; 



		$post_vote		= $wpdb->get_var($post_vote_qre);

		return $post_vote;



	}else{

		return false;

	}





}















function yic_get_all_moderator_users(){







	$args = array (







		'role'       => 'moderator',







		'order'      => 'ASC',







		'orderby'    => 'email'//'display_name'







	);







	







	// Create the WP_User_Query object







	$wp_user_query = new WP_User_Query( $args );







	return $wp_user_query->get_results();







}















function yic_moderator_list(){





	$all_moderator = yic_get_all_moderator_users();





	ob_start();





	if(!empty($all_moderator)){







		foreach($all_moderator as $moderator){







			$user_email = $moderator->user_email;







			$user_id	= $moderator->ID;







			?>







				<li class="yic_moderator_li_<?php echo $user_id;?>">







                    <div class="pull-left"><?php echo $user_email;?></div>







                    <div class="pull-right">







                        <button class="remove yic_remove_moderator_btn" user_id="<?php echo $user_id;?>"><i class="fa fa-minus-circle"></i></button>







                    </div>







                </li>







			<?php







		}







	}else{







		?>







            <li><div class="pull-left">No moderators exist</div></li>







        <?php







	}







	







	return ob_get_clean();







}























function yic_get_idea_status_id($post_id = ''){



	if(!empty($post_id)){

		

		global $wpdb;

		$qry_idea_status 	= "SELECT idea_status FROM ".YIC_IDEA_POST_STATUS." WHERE post_id = ".$post_id;

		$idea_status_id		= $wpdb->get_var($qry_idea_status);

		if(!empty($idea_status_id)){

			$qry		= "SELECT * FROM ".YIC_IDEA_STATUS." WHERE id = ".$idea_status_id ;

			$status_row	= $wpdb->get_row($qry);

			if(!empty($status_row)){

				return $status_row;

			}else{

				return false;

			}

		}else{

			$qry		= "SELECT * FROM ".YIC_IDEA_STATUS." WHERE id = 1 ";

			$status_row	= $wpdb->get_row($qry);

			if(!empty($status_row)){

				return $status_row;

			}else{

				return false;

			}

		}

	}else{

		return false;

	}

}















function yic_assign_status($post_id = ''){

	$status = yic_get_idea_status_id($post_id);

	$assign_status = (!empty($status)) ? $status->status_title : 'Active';

	return $assign_status;

}







function yic_send_mail_after_comment_post($comment_id = 0){



	if(!empty($comment_id)){		



		$comment_data			= get_comment( $comment_id );



		$comment_post_ID		= $comment_data->comment_post_ID;



		$comment_parent			= $comment_data->comment_parent;		



		$comment_author			= $comment_data->comment_author;		



		$comment_author_email	= $comment_data->comment_author_email;



		$comment_content		= $comment_data->comment_content;



		$comment_date			= $comment_data->comment_date;



		$comment_link			= get_comment_link($comment_id);



		$recipient_emails_arr	= array();



		$recipient_name_arr		= array();



		



		$subject				= 'New Comment';



		if(!empty($comment_parent)){



			$subject				= 'Reply Comment';



			$parent_comment_data 	= get_comment( $comment_parent );



			$recipient_emails_arr[]	= $parent_comment_data->comment_author_email;



			$recipient_name_arr[]	= $parent_comment_data->comment_author;



			



		}else{



			$all_follower_ids 	= yic_get_all_follower_of_an_idea($comment_post_ID);

			if(!empty($all_follower_ids)){				



				foreach($all_follower_ids as $user_id){



					$user_info 				= array();		



					$user_info 				= get_userdata($user_id);



					$user_email 			= $user_info->user_email;



					$recipient_emails_arr[]	= $user_email ;



					$recipient_name_arr[]	= $user_info->display_name;



				}



			}



		}



		



		if(!empty($recipient_emails_arr)){



			$key = array_search( $comment_author_email ,$recipient_emails_arr);



			if ($key !== false) {



				unset($recipient_emails_arr[$key]);



				unset($recipient_name_arr[$key]);



			}



		}



		



		if(!empty($recipient_emails_arr)){



			foreach($recipient_emails_arr as $index => $to_email){



				$param							= array();



				$msg_param						= array();



				$msg_param['comment_content']	= $comment_content;



				$msg_param['from_name']			= $comment_author;



				$msg_param['from_email']		= $comment_author_email;



				$msg_param['recipient_name']	= $recipient_name_arr[$index];



				$msg_param['comment_link']		= $comment_link;



				



				$param['to']					= $to_email;



				$param['from_name']				= $comment_author;



				$param['from_email']			= get_option('admin_email');//$comment_author_email; //'admin@navkiraninfotech.com';



				$param['subject']				= $subject;



				$param['message']				= yic_get_comment_email_template($msg_param);



				//$param['all_email']			= implode(',',$recipient_emails_arr);



				



				yic_email_sent($param);



				



			}



		}



		



	}else{



		return false;



	}



}







function yic_get_all_follower_of_an_idea($post_id = 0){



	if(!empty($post_id)){



		global $wpdb;

		

		$qre 		= "SELECT user_id FROM ".YIC_FOLLOW_IDEA." WHERE post_id=".$post_id." AND follow_status = 1";



		$followers 	= $wpdb->get_results($qre);



		if(!empty($followers)){



			$all_user_id = array();



			foreach($followers as $single_follower){



				$all_user_id[] = $single_follower->user_id;



			}



			return $all_user_id;



		}else{



			return false;



		}



	}else{



		return false;



	}



}







function yic_email_sent($param = array()){



	



	if(!empty($param) && isset($param['to']) && isset($param['subject']) && isset($param['message']) ){





		 $to		= $param['to'];

		 $subject	= $param['subject'];

		 $message	= $param['message'];

		$headers 	= 'Content-Type: text/html; charset=UTF-8'. "\r\n";



		



		if(isset($param['from_email']) && isset($param['from_name'])){



			$from_name 	= $param['from_name'];

			$from_email = $param['from_email'];			



			$headers .=  'From: '.$from_name.' <'.$from_email.'>' . "\r\n";



		}	



		//update_option("yic_comment_email_param", $param);

		

		return wp_mail( $to, $subject, $message, $headers);







	}else{



		return false;



	}	



}







function yic_get_comment_email_template($param = array()){



	if(isset($param['comment_content']) && !empty($param['comment_content'])){



		$comment_content	= $param['comment_content'];



		$from_name			= $param['from_name'];



		$from_email			= $param['from_email'];



		$recipient_name		= $param['recipient_name'];



		$comment_link		= $param['comment_link'];



		



		$site_title 		= get_bloginfo( 'name' );



		$site_url 			= network_site_url( '/' );



		$site_description 	= get_bloginfo( 'description' );



		ob_start();



		?>



        <!doctype html>



        <html>



          <head>



            <meta name="viewport" content="width=device-width">



            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



            <title>Idea Comment</title>



            <style>



            /* -------------------------------------



                INLINED WITH htmlemail.io/inline



            ------------------------------------- */



            /* -------------------------------------



                RESPONSIVE AND MOBILE FRIENDLY STYLES



            ------------------------------------- */



            @media only screen and (max-width: 620px) {



              table[class=body] h1 {



                font-size: 28px !important;



                margin-bottom: 10px !important;



              }



              table[class=body] p,



                    table[class=body] ul,



                    table[class=body] ol,



                    table[class=body] td,



                    table[class=body] span,



                    table[class=body] a {



                font-size: 16px !important;



              }



              table[class=body] .wrapper,



                    table[class=body] .article {



                padding: 10px !important;



              }



              table[class=body] .content {



                padding: 0 !important;



              }



              table[class=body] .container {



                padding: 0 !important;



                width: 100% !important;



              }



              table[class=body] .main {



                border-left-width: 0 !important;



                border-radius: 0 !important;



                border-right-width: 0 !important;



              }



              table[class=body] .btn table {



                width: 100% !important;



              }



              table[class=body] .btn a {



                width: 100% !important;



              }



              table[class=body] .img-responsive {



                height: auto !important;



                max-width: 100% !important;



                width: auto !important;



              }



            }



        



            /* -------------------------------------



                PRESERVE THESE STYLES IN THE HEAD



            ------------------------------------- */



            @media all {



              .ExternalClass {



                width: 100%;



              }



              .ExternalClass,



                    .ExternalClass p,



                    .ExternalClass span,



                    .ExternalClass font,



                    .ExternalClass td,



                    .ExternalClass div {



                line-height: 100%;



              }



              .apple-link a {



                color: inherit !important;



                font-family: inherit !important;



                font-size: inherit !important;



                font-weight: inherit !important;



                line-height: inherit !important;



                text-decoration: none !important;



              }



              .btn-primary table td:hover {



                background-color: #34495e !important;



              }



              .btn-primary a:hover {



                background-color: #34495e !important;



                border-color: #34495e !important;



              }



            }



            </style>



          </head>



          <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">



            <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">



              <tr>



                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>



                <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">



                  <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">



        



                    <!-- START CENTERED WHITE CONTAINER -->



                    <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">



        



                      <!-- START MAIN CONTENT AREA -->



                      <tr>



                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">



                          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">



                            <tr>



                              <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">



                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi <?php echo $recipient_name;?>,</p>



                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">



                                	A comment has been posted by <?php echo $from_name.' [ '.$from_email.' ]';?>, On <?php echo '<a href="'.$site_url.'">'.$site_title.'</a>';?>. You can see the comment bellow-



                                </p>



                                <h2>Comment : </h2>



                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">



                                	<?php echo $comment_content ; ?>



                                </p>



                                



                                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">



                                	<a href="<?php echo $comment_link;?>">Click</a> to see the idea. 



                                </p>



                              </td>



                            </tr>



                          </table>



                        </td>



                      </tr>



        



                    <!-- END MAIN CONTENT AREA -->



                    </table>



        



                    <!-- START FOOTER -->



                    <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">



                    	



                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">



                        <!--<tr>



                          <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">



                            <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>



                            <br> Don't like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.



                          </td>



                        </tr>-->



                        <tr>



                          <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">



                            Powered by <a href="<?php echo $site_url;?>" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;"><?php echo $site_title;?></a>.



                          </td>



                        </tr>



                      </table>



                    </div>



                    <!-- END FOOTER -->



        



                  <!-- END CENTERED WHITE CONTAINER -->



                  </div>



                </td>



                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>



              </tr>



            </table>



          </body>



        </html>



        



		<?php 



		$template = ob_get_clean();



		return $template;



	}else{



		return false;



	}



}









function yic_get_all_post_ids_by_status($status_id = 0){



	



	if(!empty($status_id)){



		global $wpdb;



		$qre	= "SELECT post_id FROM ".YIC_IDEA_POST_STATUS." WHERE idea_status IN ( ".$status_id." )";



		$result	= $wpdb->get_results($qre);



		



		$all_post_ids = array();



		if(!empty($result)){



			foreach($result as $row ){



				array_push($all_post_ids, $row->post_id);



			}



		}



		



		return $all_post_ids ;



		



	}else{



		return false;



	}



	



}


function yic_view_post($post_id = 0){
	if(!empty($post_id)){
	    $current_user = wp_get_current_user();
	    $current_user_id=$current_user->ID;
	    $author_id = get_post_field ('post_author', $post_id);
	    
		$make_view = true ;
		
		if(isset($_SESSION['yic_view_post']) && in_array($post_id, $_SESSION['yic_view_post'])){
			$make_view = false ;
		}
		if(isset($current_user_id) && $current_user_id==$author_id){
		   $make_view = false ; 
		}
		if($make_view){		
			$total_view = yic_get_post_view_count($post_id);
			$total_view++;
			update_post_meta(  $post_id, 'yic_view_post', $total_view );			
			$_SESSION['yic_view_post'][] = $post_id;
		}
	}
}







function yic_get_post_view_count($post_id = 0){	



	$view		= 0;



	if(!empty($post_id)){



		$view 	= get_post_meta( $post_id, 'yic_view_post', true );	



	}



	$total_view		= (!empty($view)) ? $view : 0 ;



	



	return $total_view ;



}



function yic_get_idea_template(){

	global $wpdb;

	$qry_template_content	= "SELECT * FROM ".YIC_IDEA_TEMPLATE; 

	$temp					= $wpdb->get_row($qry_template_content);

	

	return $temp;

}



function yic_last_update($idea_id, $user_id, $last_activity, $activity_type, $activity_date = ''){





	$activity_date 	= (!empty($activity_date)) ? date_i18n('Y-m-d H:i:s', strtotime($activity_date)) : date_i18n('Y-m-d H:i:s'); //date('Y-m-d H:i:s');



	update_post_meta($idea_id, 'yic_last_activity', $last_activity);



	update_post_meta($idea_id, 'yic_activity_who', $user_id);



	update_post_meta($idea_id, 'yic_activity_type', $activity_type);



	update_post_meta($idea_id, 'yic_activity_date', $activity_date);





}





function yic_get_default_template_content(){



	global $wpdb;

	

	$qry_for_template_content = "SELECT content FROM ".YIC_IDEA_TEMPLATE." WHERE id=1"; 

	

	$template_content_result = $wpdb->get_var($qry_for_template_content);

		

	return  stripslashes($template_content_result);



}





function yic_get_created_ideas_by_date_range($param = array()){

	if(!empty($param)){

		$return_data = array();

		$from_date 	= $param['from_date'];

		$from_date	= date_i18n('Y-m-d', strtotime($from_date));

		$to_date 	= $param['to_date'];

		$to_date 	= date_i18n('Y-m-d', strtotime($to_date));

		

		$args = array(

			'post_type'			=> 'yic_idea',

			'post_status'      	=> 'publish',

			'posts_per_page'	=> -1,

			'orderby'			=> 'date',

			'order'				=> 'asc',

			'date_query' 		=> array(

										array(

											'after' => $from_date, //'August 31st, 2014',

											'before' => $to_date, //'September 1st, 2015',

											'inclusive' => true,

										)

									)

		);

		

		$postslist = get_posts( $args );

		$return_data['all_posts'] = $postslist;

		

		if(!empty($postslist)){

				//echo '<pre>';

				//	print_r($postslist);

				//echo '</pre>';

			

			$chart_data = array();

			$count_data	= array();

			foreach($postslist as $post){

				$month = date_i18n('M-Y', strtotime($post->post_date));

				$count_data[$month][] = $post->post_date;

			}

			

			$c = 0;

			foreach($count_data as $m => $dates ){

				$idea_counts = count($dates);

				$chart_data[$c]['label'] = $m;

				$chart_data[$c]['y'] = $idea_counts;

				$chart_data[$c]['z'] = ($idea_counts > 1) ? 'Ideas' : 'Idea';

				$c++;

			}

			$return_data['chart_data'] = $chart_data;			

		}

		

		return $return_data;

		

	}else{

		return false;

	}

}





function yic_get_ideas_comment_by_date_range($param = array()){

	if(!empty($param)){

		$return_data = array();

		$from_date 	= $param['from_date'];

		$from_date	= date_i18n('Y-m-d', strtotime($from_date));

		$to_date 	= $param['to_date'];

		$to_date 	= date_i18n('Y-m-d', strtotime($to_date));

		

		global $wpdb;

		$post_type = 'yic_idea';

		$all_comments = $wpdb->get_results("

			SELECT * FROM $wpdb->comments

			WHERE comment_post_ID in (

				SELECT ID 

				FROM $wpdb->posts 

				WHERE post_type = '$post_type' 

				AND post_status = 'publish'

			)

			AND comment_approved = '1'

			AND comment_date >= '$from_date'

			AND comment_date <= '$to_date'

		");

		

		$return_data['all_comments'] = $all_comments;

		

		if(!empty($all_comments)){

				//echo '<pre>';

				//	print_r($postslist);

				//echo '</pre>';

			

			$chart_data = array();

			$count_data	= array();

			foreach($all_comments as $comment){

				$month = date_i18n('M-Y', strtotime($comment->comment_date));

				$count_data[$month][] = $comment->comment_date;

			}

			

			$c = 0;

			foreach($count_data as $m => $dates ){

				$idea_counts = count($dates);

				$chart_data[$c]['label'] = $m;

				$chart_data[$c]['y'] = $idea_counts;

				$chart_data[$c]['z'] = ($idea_counts > 1) ? 'Comments' : 'Comment';

				$c++;

			}

			$return_data['chart_data'] = $chart_data;	

				

		}

		

		return $return_data;

	}else{

		return false;

	}

}



function yic_get_status_title_by_status_id($status_id = 0){

	if(!empty($status_id )){

		global $wpdb;		

		$status_tbl			= YIC_IDEA_STATUS;

		$status_title = $wpdb->get_var("SELECT status_title FROM $status_tbl WHERE id=$status_id");

		return $status_title;

	}else{

		return false;

	}

}



function yic_get_color_code_by_status_id($status_id = 0){

	$color = "#5cb85c";

	switch ($status_id) {

		case 1:

			$color = "#ff0000";

			break;

		case 2:

			$color = "#ff9c00";

			break;

		case 3:

			$color = "#84ff00";

			break;

		case 4:

			$color = "#007eff";

			break;

		case 5:

			$color = "#7800ff";

			break;

		case 6:

			$color = "#ea00ff";

			break;

		case 7:

			$color = "#b5b5b5";

			break;

		case 8:

			$color = "#6c0000";

			break;

		case 9:

			$color = "#6c751d";

			break;

		case 10:

			$color = "#1d5975";

			break;

		case 11:

			$color = "#531d75";

			break;

		case 12:

			$color = "#1d3275";

			break;

		default:

			$color = "#5cb85c";

	}

	

	return $color;

}



function yic_get_idea_status_report_by_date_range($param = array()){

	if(!empty($param)){

		$return_data = array();

		$from_date 	= $param['from_date'];

		$from_date	= date_i18n('Y-m-d', strtotime($from_date));

		$to_date 	= $param['to_date'];

		$to_date 	= date_i18n('Y-m-d', strtotime($to_date));

		$status_ids	= (isset($param['status_ids']) && !empty($param['status_ids'])) ? implode(',', $param['status_ids']) : '';

		

		global $wpdb;

		$post_type = 'yic_idea';

		

		$post_status_tbl	= YIC_IDEA_POST_STATUS;

		$post_tbl			= $wpdb->posts;

		

		$qre	= "

					SELECT * FROM $post_tbl, $post_status_tbl 

					WHERE 

					$post_tbl.ID = $post_status_tbl.post_id 							

					AND status_update_date >= '$from_date'

					AND status_update_date <= '$to_date'

					AND $post_tbl.post_status = 'publish'					

				";

		

		if(!empty($status_ids)){

			$qre	.= " AND $post_status_tbl.idea_status IN ($status_ids)";

		}

				

		$all_post_status 	= $wpdb->get_results($qre);

		$return_data['all_post_status'] = $all_post_status;

		

		if(!empty($all_post_status)){

				//echo '<pre>';

				//	print_r($postslist);

				//echo '</pre>';

			

			$chart_data = array();

			$count_data	= array();

			foreach($all_post_status as $status){

				$month = date_i18n('M-Y', strtotime($status->status_update_date));

				$count_data[$status->idea_status][$month][] = $status->status_update_date;

			}

			

			//$c = 0;

			foreach($count_data as $status_id => $datas ){

				$c = 0;

				foreach($datas as $m => $dates){

					$idea_counts = count($dates);

					$chart_data[$status_id][$c]['label'] = $m;

					$chart_data[$status_id][$c]['y'] = $idea_counts;

					$chart_data[$status_id][$c]['z'] = ($idea_counts > 1) ? 'Ideas' : 'Idea';

					$c++;

				}

			}

			

			

			$all_chart_data = array();

			if(!empty($chart_data)){

				$i=0;

				foreach($chart_data as $status_id=>$c_data){

					

					$color 			= yic_get_color_code_by_status_id($status_id);					

					$status_title 	= yic_get_status_title_by_status_id($status_id) ;

					

					$all_chart_data[$i]['type'] 			= 'line';

					$all_chart_data[$i]['markerType'] 		= 'square';

					$all_chart_data[$i]['color'] 			= $color;

					$all_chart_data[$i]['toolTipContent'] 	= '{label}: {y} {z}';//array('label'=>'{label}', 'y' => '{y} {z}');

					$all_chart_data[$i]['showInLegend'] 	= true;

					$all_chart_data[$i]['name'] 			= $status_title;

					$all_chart_data[$i]['dataPoints'] 		= $c_data;					

					//$all_chart_data[$i]['yValueFormatString'] = "#,##0K";

					//$all_chart_data[$i]['lineDashType'] 	= 'dash';

									

					$i++;

				}

			}

			

			

			//echo '<pre>';

//				print_r($all_chart_data);

//			echo '</pre>';

//			

			

			$return_data['all_chart_data'] = $all_chart_data;	

				

		}

		

		return $return_data;

	}else{

		return false;

	}

}







function yic_get_total_follow_count_of_an_idea($post_id = 0){

	$total_follow_count = 0;

	if(!empty($post_id)){

		global $wpdb;

		//  

		$total_follow_count = $wpdb->get_var("SELECT COUNT(*) as total_count FROM ".YIC_FOLLOW_IDEA." WHERE post_id = $post_id AND follow_status = 1 ");

		

	}

	return $total_follow_count;

}







function yic_deleteDir($dirPath) {

    if (!is_dir($dirPath)) {

        return false;

    }

    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {

        $dirPath .= '/';

    }

    $files = glob($dirPath . '*', GLOB_MARK);

    foreach ($files as $file) {

        if(is_dir($file)) {

            yic_deleteDir($file);

        } else {

            unlink($file);

        }

    }

    rmdir($dirPath);

}



//yic_remove_all_data();

function yic_remove_all_data(){

	global $wpdb;

	

	$qre = "DELETE FROM $wpdb->postmeta WHERE post_id IN ( SELECT ID FROM $wpdb->posts WHERE post_type = 'yic_idea' )";

	$all_post_ids = $wpdb->query($qre);

	

	$qre = "DELETE FROM $wpdb->posts WHERE post_type = 'yic_idea'";

	$wpdb->query($qre);	

	

	

	

	

	///////////  Start Delete all category and tag //////////////////////

	$all_taxonomy = array( 'yic_category', 'yic_tag');

	foreach ( $all_taxonomy  as $taxonomy ) {

		// Prepare & excecute SQL

		$terms = $wpdb->get_results( $wpdb->prepare( "SELECT t.*, tt.* FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('%s') ORDER BY t.name ASC", $taxonomy ) );

	  

			// Delete Terms

		if ( $terms ) {

			foreach ( $terms as $term ) {

				$wpdb->delete( $wpdb->term_taxonomy, array( 'term_taxonomy_id' => $term->term_taxonomy_id ) );

				$wpdb->delete( $wpdb->terms, array( 'term_id' => $term->term_id ) );

				delete_option( 'prefix_' . $taxonomy->slug . '_option_name' );

			}

		}

		

		// Delete Taxonomy

		$wpdb->delete( $wpdb->term_taxonomy, array( 'taxonomy' => $taxonomy ), array( '%s' ) );

	}

	///////////  End Delete all category and tag //////////////////////

		

	

	///////////// Start Drop all yic table ////////////////

	$qre = 'DROP TABLE '.YIC_IDEA_STATUS;

	$wpdb->query($qre);	

		

	

	$qre = 'DROP TABLE '.YIC_IDEA_POST_STATUS;

	$wpdb->query($qre);	

		

	

	$qre = 'DROP TABLE '.YIC_FOLLOW_IDEA;

	$wpdb->query($qre);	

		

	

	$qre = 'DROP TABLE '.YIC_VOTE_IDEA;

	$wpdb->query($qre);	

		

	

	$qre = 'DROP TABLE '.YIC_IDEA_TEMPLATE;

	$wpdb->query($qre);		

	///////////// End Drop all yic table ////////////////

	

	

	//////////// Start Delete directory //////////////////

	

	$upload_dir		= wp_upload_dir();

	$basedir 		= $upload_dir['basedir']; //C:\path\to\wordpress\wp-content\uploads

	//$baseurl 		= $upload_dir['baseurl']; //http://example.com/wp-content/uploads

	

	$folder_name	= 'yic-csv';

	

	$dirPath = $basedir.'/'.$folder_name;

	//$chart_csv_url	= $baseurl.'/'.$folder_name;

	

	//$dirPath = '';

	yic_deleteDir($dirPath);

	//////////// End Delete directory //////////////////

	

	

}





function yic_get_default_cat_use_in_import_ideas(){

	$cat_name 		= 'Uncategorized';

	$cat_taxonomy	= 'yic_category';

	$term 			= get_term_by('name', $cat_name, $cat_taxonomy);

	

	return (!empty($term)) ? $term->term_id : false;

}







function yic_get_top_thinker_list($params = array()){

	$return 							= array();

	$return['list'] 					= '';

	$return['total_number_of_items'] 	= 0;

	$return['total_pages'] 				= 1;

	

	if(!empty($params)){

		

		$items_per_page	= $params['items_per_page'];

		$page 			= (isset($params['paged']) && !empty($params['paged'])) ? $params['paged'] : 1;	

		

		$offset 		= ( $page-1 ) * $items_per_page;

		

		global $wpdb;

		$post_tbl		= $wpdb->prefix."posts";

		$user_tbl		= $wpdb->prefix."users";

		

		//$sql 	= "SELECT post_author, count(ID) as post_count FROM ".$post_tbl." WHERE post_type = 'yic_idea' GROUP BY post_author ORDER BY count(ID) DESC";

		

		$sql_total_count 					= "SELECT ".$user_tbl.".*, count(".$post_tbl.".ID) as post_count FROM $post_tbl, $user_tbl WHERE $post_tbl.post_type = 'yic_idea' AND ".$post_tbl.".post_author = ".$user_tbl.".ID AND ".$post_tbl.".post_status = 'publish' GROUP BY ".$post_tbl.".post_author";

		

		$total_number_of_items_results		= $wpdb->get_results($sql_total_count);

		$total_number_of_items				= count($total_number_of_items_results);

		$return['total_number_of_items'] 	= $total_number_of_items;

		$return['total_pages'] 				= ceil( $total_number_of_items / $items_per_page) ;

		

		

		$sql 			= "SELECT ".$user_tbl.".*, count(".$post_tbl.".ID) as post_count FROM $post_tbl, $user_tbl WHERE $post_tbl.post_type = 'yic_idea' AND ".$post_tbl.".post_author = ".$user_tbl.".ID AND ".$post_tbl.".post_status = 'publish' GROUP BY ".$post_tbl.".post_author ORDER BY count(".$post_tbl.".ID) DESC LIMIT $offset , $items_per_page";

		

		$top_thinkrs 	= $wpdb->get_results($sql);

		

		ob_start();

		

			if(!empty($top_thinkrs)){

				foreach($top_thinkrs as $thinkr){

					?>

						<li class="yic-list-group-item">

							<?php

								echo '<div class="yic-avtar-container">';

									echo get_avatar( $thinkr->ID, 32 );

								echo '</div>';

								

								echo '<div class="yic-author-name">'; // yic-tooltip

									echo $thinkr->display_name;												

									echo ' <span class="yic_post_count">('.$thinkr->post_count.')</span>';

									//echo '<span class="yic-tooltiptext"> Email: <a href="mailto:'.$ideator->user_email.'">'.$ideator->user_email.'</a> </span>';

								echo '</div>';

							?>

						</li>

					<?php						

				}

			}else{

				?>

					<li class="yic-list-group-item">No thinker found</li>

				<?php

			}

		

		$list = ob_get_clean();

		

		$return['list'] = $list;

		

	}

	

	return $return;

}



function yic_get_top_ideator_list($params = array()){

	

	$return 							= array();

	$return['list'] 					= '';

	$return['total_number_of_items'] 	= 0;

	$return['total_pages'] 				= 1;

	

	if(!empty($params)){

		

		$items_per_page	= $params['items_per_page'];

		$page 			= (isset($params['paged']) && !empty($params['paged'])) ? $params['paged'] : 1;	

		

		$offset 		= ( $page-1 ) * $items_per_page;

		

		global $wpdb;

		$post_tbl	= $wpdb->prefix."posts";

		$user_tbl	= $wpdb->prefix."users";

		

		//$sql 	= "SELECT post_author, count(ID) as post_count FROM ".$post_tbl." WHERE post_type = 'yic_idea' GROUP BY post_author ORDER BY count(ID) DESC";

		

		

		$saved_status 	= te_yic_get_top_ideator_delivered_status();

		

		$sql			= "SELECT post_id FROM ".YIC_IDEA_POST_STATUS." WHERE idea_status IN( $saved_status )";

		$results 		= $wpdb->get_results($sql);

		

		$all_post_ids 	= array();

		if(!empty($results)){

			foreach($results as $result){

				$all_post_ids[] = $result->post_id;

			}

		}

		

		if(!empty($all_post_ids)){

			$post_ids		= implode(',',$all_post_ids);

			

			/////////////// Start Get total count ////////////////////			

		

			$sql_total_count 					= "SELECT ".$user_tbl.".*, count(".$post_tbl.".ID) as post_count FROM $post_tbl, $user_tbl WHERE $post_tbl.ID IN($post_ids) AND $post_tbl.post_type = 'yic_idea' AND ".$post_tbl.".post_author = ".$user_tbl.".ID AND ".$post_tbl.".post_status = 'publish' GROUP BY ".$post_tbl.".post_author ORDER BY count(".$post_tbl.".ID) DESC";

			

			$total_number_of_items_results		= $wpdb->get_results($sql_total_count);

			$total_number_of_items				= count($total_number_of_items_results);

			$return['total_number_of_items'] 	= $total_number_of_items;

			$return['total_pages'] 				= ceil( $total_number_of_items / $items_per_page) ;

			

			

			/////////////// End Get total count ////////////////////

			

			

			$sql 			= "SELECT ".$user_tbl.".*, count(".$post_tbl.".ID) as post_count FROM $post_tbl, $user_tbl WHERE $post_tbl.ID IN($post_ids) AND $post_tbl.post_type = 'yic_idea' AND ".$post_tbl.".post_author = ".$user_tbl.".ID AND ".$post_tbl.".post_status = 'publish' GROUP BY ".$post_tbl.".post_author ORDER BY count(".$post_tbl.".ID) DESC LIMIT $offset, $items_per_page";

			

			$top_ideators 	= $wpdb->get_results($sql);

		}else{

			$top_ideators	= false;

		}

		

		

		ob_start();

			if(!empty($top_ideators)){

				foreach($top_ideators as $ideator){

					?>

						<li class="yic-list-group-item">

							<?php

								echo '<div class="yic-avtar-container">';

									echo get_avatar( $ideator->ID, 32 );

								echo '</div>';

								

								echo '<div class="yic-author-name">'; // yic-tooltip

									echo $ideator->display_name;												

									echo ' <span class="yic_post_count">('.$ideator->post_count.')</span>';

									//echo '<span class="yic-tooltiptext"> Email: <a href="mailto:'.$ideator->user_email.'">'.$ideator->user_email.'</a> </span>';

								echo '</div>';

							?>

						</li>

					<?php						

				}

			}else{

				?>

					<li class="yic-list-group-item">No ideator found</li>

				<?php

			}

			

		$list = ob_get_clean();

			

		$return['list'] = $list;

		

	}	

	

	return $return;

	

}



function yic_get_recent_idea_list($params = array()){

	//$params['paged']

	//$params['posts_per_page']

	if(!empty($params) && isset($params['paged']) && isset($params['posts_per_page'])){

		

		$posts_per_page = $params['posts_per_page'];		

		$paged 			= $params['paged'];

		

		$return = array();

			

	

		$args = array(

			'post_type'  		=> 'yic_idea',

			'post_status' 		=> array( 'publish' ),

			'posts_per_page' 	=> $posts_per_page,

			'paged' 			=> $paged 

		);

	

	

		$query1 = new WP_Query( $args );

	

		ob_start();

			if ( $query1->have_posts() ) {

		

		

		

				// The Loop

		

		

				while ( $query1->have_posts() ) {			

		

		

		

					$query1->the_post();

		

		

		

					global $post;

		

		

		

					$author 				= get_the_author();

		

		

		

					$post_id 				= get_the_id();

		

		

		

					$idea_id 				= $post_id;

		

		

		

					$comments_count 		= wp_count_comments( $post_id );

		

		

		

					$total_comments 		= $comments_count->total_comments;

		

		

		

					$slug 					= $post->post_name;

		

		

		

					$edit_utl 				= get_permalink(); //home_url('/single-ideas/?idea-id='.$slug);

		

		

		

					

		

		

		

					$content 				= get_the_excerpt() ;//apply_filters('the_excerpt', get_the_excerpt());

		

		

		

								

		

		

		

					$idea_last_activity		= get_post_meta( $idea_id, 'yic_activity_type', true );

		

		

		

					$alloted_status 		= yic_assign_status($post_id);

		

		

		

					

		

		

		

					$alloted_status_data	= yic_get_idea_status_id($post_id);

		

		

		

					

		

		

		

					$status_style 			= ' color:#333333; background:#EEEEEE; ';			

		

		

		

					if(!empty($alloted_status_data)){

		

		

		

						$status_style	 = '';

		

		

		

						$font_color		 = $alloted_status_data->font_color;

		

		

		

						$back_color 	 = $alloted_status_data->back_color;

		

		

		

						$status_style 	.= (!empty($font_color)) ? ' color:'.$font_color.'; ' : '' ;

		

		

		

						$status_style 	.= (!empty($back_color)) ? ' background:'.$back_color.'; ' : '' ;

		

		

		

					}

		

					

		

					//var_dump($status_style );

		

		

		

					?>

					<div class="yic_row yic_recent_ideas_loop">

					  <div class="yic_col">

						<div class="yic_recent_ideas yic-trans-bg">

						  <div class="yic_row">

							<div class="yic_col">

							  <div class="yic_idea_details">

								<h3><a href="<?php echo $edit_utl; ?>"><?php echo get_the_title(); ?></a></h3>

								<span class="active_txt" style=" <?php echo $status_style ;?>"> <?php echo $alloted_status;?> </span>

								<?php /*?><h5>Created <?php echo get_the_date();?> by <span class="yic_grn"><?php echo $author;?></span> - Last update 25-Aug-2017 at 06:22PM by <span class="yic_grn">Big Thinker</span></h5><?php */?>

								<h5>Created on <?php echo get_the_date("j-M-Y");?> by <span class="yic_gray"><?php echo get_the_author(); //get_the_author_meta('display_name',$post_author );?></span>

								  <?php 

							

			

										if(!empty($idea_last_activity) && $idea_last_activity != 'idea create'){

			

			

			

										$yic_last_activity 	= get_post_meta( $idea_id, 'yic_last_activity', true );

			

			

			

										$yic_activity_date 	= get_post_meta( $idea_id, 'yic_activity_date', true );

			

			

			

										$yic_activity_date 	= date_i18n('j-M-Y', strtotime($yic_activity_date)); 

			

			

			

										$yic_activity_who 	= get_post_meta( $idea_id, 'yic_activity_who', true );

			

			

			

										$activity_user_name = '';

			

			

			

										

			

			

			

										if(!empty($yic_activity_who)){

			

			

			

											$user_id				= $yic_activity_who;

			

			

			

											$user_info 				= get_userdata($user_id);		

			

			

			

											//$activity_user_name 	= ($user_info) ? $user_info->user_login : '' ;

											$activity_user_name 	= ($user_info) ? $user_info->display_name : '' ;

			

			

			

										}

			

			

			

										

			

			

			

										?>

										- Last update <?php echo $yic_last_activity;?> On <?php echo $yic_activity_date;?> by <span class="yic_gray"><?php echo $activity_user_name;?></span><!-- Old Class "yic_grn"-->

										

										<?php 

			

			

			

										}

			

			

			

										?>

								</h5>

								<p><?php echo $content; ?></p>

								<div class="yic-pull-left"> <i class="fa fa-comments" aria-hidden="true"></i> <?php echo $total_comments;?> </div>

							  </div>

							</div>

						  </div>

						</div>

					  </div>

					</div>

					<?php

		

		

				}

		

				/* Restore original Post Data 

		

		

		

				 * NB: Because we are using new WP_Query we aren't stomping on the 

		

		

		

				 * original $wp_query and it does not need to be reset with 

		

		

		

				 * wp_reset_query(). We just need to set the post data back up with

		

		

		

				 * wp_reset_postdata().

		

		

		

				 */

		

		

		

				wp_reset_postdata();

		

				

		

			}else{

				?>

					<div class="yic-no-result">

					  <h3>No recent Ideas found.</h3>

					</div>

				<?php            

		

			}

		$html = ob_get_clean();			

		

		$total_post_found = $query1->found_posts;

		

		$return['html'] 			= $html;

		$return['total_post_found'] = $total_post_found;

		

		return $return;

		

	}else{

		return false;

	}

}







function yic_free_initial_example_ideas_import(){

		

	$initial_ideas_array = array();

	

	$author_id		= get_current_user_id();

	$post_type		= 'yic_idea';

	$post_status	= 'publish';

	$cat_name		= 'Uncategorized';

	$cat_taxonomy 	= 'yic_category';

	$term 			= get_term_by('name', $cat_name, $cat_taxonomy);	

	$cat_id			= (!empty($term)) ? $term->term_id : 0;

	

	

	$hasIdea = get_posts('post_type='.$post_type.'&post_status='.$post_status);

	

	if( empty($hasIdea)) {

		

		$initial_ideas_array[0]['post_title'] 	= 'Example Idea #1';

		$initial_ideas_array[0]['post_content'] = '<p>This example idea is <em><strong>Active </strong></em>and<strong> <span style="background-color: #008000; color: #ffffff;"> can </span> be voted on</strong>. The category is <strong>Uncategorized</strong>, there are no tags, the Author is the person who installed the plugin and the idea was created on the date the plugin was installed.</p>';

		$initial_ideas_array[0]['post_type'] 	= $post_type;

		$initial_ideas_array[0]['post_status'] 	= $post_status;

		$initial_ideas_array[0]['status_id'] 	= yic_get_status_id_by_status_name('Active');

		$initial_ideas_array[0]['cat_id'] 		= $cat_id;

		

		

		

		$initial_ideas_array[1]['post_title'] 	= 'Example Idea #2';

		$initial_ideas_array[1]['post_content'] = '<p>This example idea is <em><strong>Fully Delivered! </strong></em>and<strong> <span style="background-color: #ff5454; color: #ffffff;"> can\'t </span> be voted on</strong>. The category is <strong>Uncategorized</strong>, there are no tags, the Author is the person who installed the plugin and the idea was created on the date the plugin was installed.</p>';

		$initial_ideas_array[1]['post_type'] 	= $post_type;

		$initial_ideas_array[1]['post_status'] 	= $post_status;

		$initial_ideas_array[1]['status_id'] 	= yic_get_status_id_by_status_name('Fully Delivered!');

		$initial_ideas_array[1]['cat_id'] 		= $cat_id;

		

		

		

		$initial_ideas_array[2]['post_title'] 	= 'Example Idea #3';

		$initial_ideas_array[2]['post_content'] = '<p>This example idea is <em><strong>Not Enough Interest </strong></em>and<strong> <span style="background-color: #008000; color: #ffffff;"> can </span> be voted on</strong>. The category is <strong>Uncategorized</strong>, there are no tags, the Author is the person who installed the plugin and the idea was created on the date the plugin was installed.</p>';

		$initial_ideas_array[2]['post_type'] 	= $post_type;

		$initial_ideas_array[2]['post_status'] 	= $post_status;

		$initial_ideas_array[2]['status_id'] 	= yic_get_status_id_by_status_name('Not Enough Interest');

		$initial_ideas_array[2]['cat_id'] 		= $cat_id;

		

		

		$initial_ideas_array[3]['post_title'] 	= 'Example Idea #4';

		$initial_ideas_array[3]['post_content'] = '<p>This example idea is <em><strong>Not Considering </strong></em>and<strong> <span style="background-color: #ff5454; color: #ffffff;"> can\'t </span> be voted on</strong>. The category is <strong>Uncategorized</strong>, there are no tags, the Author is the person who installed the plugin and the idea was created on the date the plugin was installed.</p>';

		$initial_ideas_array[3]['post_type'] 	= $post_type;

		$initial_ideas_array[3]['post_status'] 	= $post_status;

		$initial_ideas_array[3]['status_id'] 	= yic_get_status_id_by_status_name('Not Considering');

		$initial_ideas_array[3]['cat_id'] 		= $cat_id;

		

		

		

		foreach($initial_ideas_array as $initial_idea){

			

			$post_title		= $initial_idea['post_title'];

			$post_content	= $initial_idea['post_content'];

			$post_type		= $initial_idea['post_type'];

			$post_status	= $initial_idea['post_status'];

			

			$status_id	= $initial_idea['status_id'];

			$cat_id		= $initial_idea['cat_id'];

			

			

			$post_data = array(

			

				'post_title' 	=> $post_title,

		

				'post_content' 	=> $post_content,

		

				'post_type' 	=> $post_type,

		

				'post_status'   => $post_status

		

			);

			$post_id = wp_insert_post( $post_data );

			

			if(!is_wp_error($post_id)){

			

				////////// Start Save last update ///////////////

				$activity_date = date_i18n('Y-m-d H:i:s');

				yic_last_update($post_id, $author_id, $last_activity = "Created" ,$activity_type='create', $activity_date);

				////////// End Save last update ///////////////

				

				/////////// Start set category //////////////////////

				if(!empty($cat_id)){

					wp_set_post_terms( $post_id, $cat_id, $cat_taxonomy );

				}

				/////////// End set category //////////////////////

			

			

				

				//////////////// Start Idea status //////////////////////

				$param				= array();		

				$param['post_id'] 	= $post_id;

				$param['status_id'] = $status_id;

				yic_update_yic_idea_status($param);

				//////////////// End Idea status //////////////////////

				

				

				////////////// Start Allow Comment////////////////

				yic_update_comment_allow_status($post_id, 'open');

				////////////// End Allow Comment////////////////

				

				

			}

			

		}

	}

	

}