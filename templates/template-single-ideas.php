<?php
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
?>


<style>
	.mce-container, .mce-container *, .mce-widget, .mce-widget *, .mce-reset{ text-transform: none; letter-spacing:0;}
	button:hover, .button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover{ background: none !important; color: #333 !important;}
	button, .button, input[type="button"], input[type="reset"], input[type="submit"]{ letter-spacing:0;}
</style>
<?php 

	global $post, $wpdb;
	
	$post_author 		= $post->post_author;
	
	if(is_user_logged_in()){
	
		$user_detail 		= wp_get_current_user(); 	
		$role 				= ( array ) $user_detail->roles;	
		$current_user_id	= $user_detail->ID;	
		$user_role 			= $user_detail->roles;
	
		if($post_author != $current_user_id && !in_array("moderator", $role) && !in_array("administrator", $role) ){	
			echo '<p>Sorry, you are not allowed to edit this idea.</p>';	
			wp_die();	
		}	
		
	}else{	
		echo '<p>Sorry, you are not allowed to edit this idea.</p>';	
		wp_die();	
	}
	
	
	
	if(session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	

	get_header(); 
	
	$post_id	 		= get_the_id();

	$idea_id 			= $post_id ;

	$post_author 		= $post->post_author;

	$idea_last_activity	= get_post_meta( $idea_id, 'yic_activity_type', true );

	$total_vote 		= yic_get_total_vote_of_an_idea($post_id);

	$alloted_status 	= yic_assign_status($post_id);

	$idea_cats 			= yic_get_all_category_names_of_an_idea($post_id);

	$idea_tags 			= yic_get_all_tag_names_of_an_idea($post_id);

	

	$is_votable 		= yic_idea_is_votable($idea_id);

		

	$show_edit_btn 		= false;
	$current_user_id	= get_current_user_id();
	//$current_user_id	= '';

	if(is_user_logged_in()){

		$user_detail 		= wp_get_current_user(); 

		$role 				= ( array ) $user_detail->roles;

		$current_user_id	= $user_detail->ID;

		$user_role 			= $user_detail->roles;

		

		if($post_author == $current_user_id || in_array("moderator", $role) || in_array("administrator", $role) ){

			$show_edit_btn 		= true;

		}

		

	}

	

	

	$param 				= array();

	$param['post_id']	= $post_id;

	$param['user_id']	= $current_user_id;

	$vote_status 		= yic_get_user_vote_status( $param );	

	

	$alloted_status_data	= yic_get_idea_status_id($post_id);	
	$status_style 			= ' color:#FFFFFF; background:#006600; ';	

	if(!empty($alloted_status_data)){
		$status_style	 = '';
		$font_color		 = $alloted_status_data->font_color;
		$back_color 	 = $alloted_status_data->back_color;
		$status_style 	.= (!empty($font_color)) ? ' color:'.$font_color.'; ' : '' ;
		$status_style 	.= (!empty($back_color)) ? ' background:'.$back_color.'; ' : '' ;
	}



	$display_msg = '';
	
	if(isset($_SESSION['yic']['insert_idea_msg'])){

		$msg			= $_SESSION['yic']['insert_idea_msg'];
		unset($_SESSION['yic']['insert_idea_msg']);
		$display_msg 	= yic_show_response_meaasge($msg);

	}

		

	///////// Start Make view this post ////////////////

	yic_view_post($post_id);

	///////// End Make view this post ////////////////

	
?>


<div class="yic_main yic-edit-mode">
    <div class="yic-container">
        <div class="yic-row">
            <div class="yic-col yic-col-9">
                <div class="yic_well yic-clearfix yic-idea-filter">

					<!-- Start Vote Section -->

                   <?php //include_once(YIC_IDEA_PLUGIN_DIR. 'app/sql/single-idea/idea-vote.php');?>
                     
					<div class="">
						<ul class="yic-vote">
							<div id="votebutt">
								<li class="yic-relative">  					
									<?php 					
										if($is_votable){
											$total_vote = ($total_vote=='')? 0 : $total_vote ;					
											$vote_cls = ($total_vote >= 0)  ? 'yic-green' : 'yic-red' ;					
											?>
												<div class="post_vote_section">		
													<span class="yic-vote-total">
                                                    	Vote : <strong class="<?php echo $vote_cls;?>"><?php  echo $total_vote;?></strong>
                                                    </span>					
												</div>		
					
											<?php 					
										}else{
											?>
												<div class="post_vote_section">
													<!--<span class="yic-vote-not-allow">Voting not allowed</span>-->
                                                    <span class="yic-vote-total">
                                                    	Vote : <strong class="<?php //echo $vote_cls;?>"><?php  echo $total_vote;?></strong>
                                                    </span>	
												</div>
											<?php
										}
					
									?>					
								</li>
								<div class="yic_vote_resp yic-vote-resp"></div> 					
							</div>					
						</ul>					
					</div>
                   
                   <!-- end Vote Section -->                    


					<!-- Start status Section -->  
                   <?php //include_once(YIC_IDEA_PLUGIN_DIR. 'app/sql/single-idea/idea-status.php');?>  
                    <ul>
                        <li> 
                        	<label>Status is : </label>                        
                        </li>
                        <li>
                        
                            <?php 
                            
                            $qry_status_result = yic_get_all_status();
                            
                            $status_arr = array();
                            foreach($qry_status_result as $allstatus){                    
                                $status_arr[$allstatus->id] = $allstatus->is_votable;                    
                            }
                            
                            
                            if(!empty($alloted_status_data)){ 
                            
                                $status_style	 = '';                         
                                $font_color		 = $alloted_status_data->font_color;                     
                                $back_color 	 = $alloted_status_data->back_color;                    
                                $status_style 	.= (!empty($font_color)) ? ' color:'.$font_color.'; ' : '' ;                    
                                $status_style 	.= (!empty($back_color)) ? ' background:'.$back_color.'; ' : '' ;                    
                            
                            }                    
                            
                            if(is_user_logged_in()){
                                $user_detail = wp_get_current_user(); 
                                $role = ( array ) $user_detail->roles;
                                
                                
                                if(in_array("moderator", $role) || in_array("administrator", $role) ){		                    
                                
                                    ?>
                                        <select class="form-control yic_idea_status">
                                            <?php 
                                                foreach($qry_status_result as $allstatus){                    
                                                    $selected = ($alloted_status == $allstatus->status_title) ? 'selected="selected"' : ''; 
                                                    echo '<option value="'.$allstatus->id.'" '.$selected.'>'.$allstatus->status_title.'</option>';
                                                }                    
                                            ?>                    
                                        </select>                    
                                        <!--<input type="button" name="updatestats" class="yic_update_idea_status_btn" value="Update">-->
                                        <div id="new_select"></div>                       
                                    <?php  
                                
                                }else{
                                    echo '<span class="active_txt" style=" '.$status_style .'"> '.$alloted_status.'</span>' ;                    
                                }                    
                            }else{
                                echo '<span class="active_txt" style=" '.$status_style .'"> '.$alloted_status.'</span>' ;   
                            }
                            
                            ?> 
                        </li>
                        <li class="yic-pull-right">
                            <div class="followbutt" id="followbutt">   
									<?php
                                        
                                        $param				= array();                                
                                        $param['user_id'] 	= $current_user_id;                    
                                        $param['post_id'] 	= $idea_id;   
                                        $is_followed		= yic_is_user_followed_the_idea($param);                    
                                        $btn_value			= 'UnFollow';                    
                                        
                                        if(!$is_followed){   
                                            $btn_value	= 'Follow';                    
                                        }                         
                                    ?>                   
                                    <input type="button" value="<?php echo $btn_value;?>" class="btn yic-btn-link pull-right follow_btn yic_follow_btn" />
                            
                            </div>
                        </li>                    
                    </ul>
                   
					<!-- End status Section --> 


                </div>

                <!-- Start Idea Detais Section --> 
                
                <?php //include_once(YIC_IDEA_PLUGIN_DIR. 'app/sql/single-idea/idea-detail.php'); ?>
                <?php 

			
				if(isset($_POST['editidea']) && $_POST['editidea']=='Update'){		
						
					$update_post_data 		= array();				
					$update_post_data['ID'] = $idea_id;			
			
					if(isset($_POST['post_title'])){			
						$update_post_data['post_title'] 	= sanitize_text_field($_POST['post_title']);			
			
					}
						
					if(isset($_POST['yic_new_content'])){	
						$update_post_data['post_content'] 	= wp_kses_post($_POST['yic_new_content']);			
					}				
			
			
					// Update the post into the database
			
			
			
					wp_update_post( $update_post_data );
			
					//$user_id = $current_user_id;
			
					update_post_meta($idea_id, 'yic_edit_last', $current_user_id);	
			
			
					yic_last_update($idea_id,$current_user_id,$last_activity='Edited',$activity_type='edit');		
			
			
					/*echo '<script>window.location.href="'.$pageurl.'"</script>';*/	
			
				
					
					
					$msg['status']	= 'success';			
					$msg['message']	= "Your idea successfully updated";	
					$_SESSION['yic']['insert_idea_msg'] = $msg;
			
					wp_safe_redirect(get_permalink());			
			
				}
			
			
				global $wpdb;
			
				$table_prefix		= $wpdb->prefix;	
				$actual_link 		= get_permalink(); //'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$idea_last_activity = get_post_meta( $idea_id, 'yic_activity_type', true );
						
				?>					
				<form action="" method="post" >				
					<div class="yic-row">
						<div class="yic-col yic-col-100">			
							<h3 class="yic_edit_title">
							<!--<i class="fa fa-lightbulb-o" aria-hidden="true"></i> -->
								<?php 
									$post_author 	= $post->post_author;
									$temp_title 	= $post->post_title;
									$user_detail 	= wp_get_current_user(); 			
									$role 			= ( array ) $user_detail->roles;
									
									if(($post_author == $current_user_id) || in_array("moderator", $role) || in_array("administrator", $role) ){			
										echo '<input type="text" name="post_title" class="yic-textbox-100" value="'.$temp_title.'" />';	
									}else{					
										echo $temp_title;
									} 
								?>
							</h3>
							<div class="yic-clearfix"></div>                    
								<div class="flex-container yic-post-last-update-sec">			
								  <div style="flex-grow: 1;">
									<div style="flex-grow: 1">
									Created on <?php echo get_the_date(YIC_DATE_FORMAT);?> by <span class="yic_gray"><?php echo  get_the_author_meta('display_name',$post_author );?></span>
									</div>			
								  </div>			
								  <?php 
							
									if(!empty($idea_last_activity) && $idea_last_activity != 'idea create'){
										
										$yic_last_activity 	= get_post_meta( $idea_id, 'yic_last_activity', true );
										$yic_activity_date 	= get_post_meta( $idea_id, 'yic_activity_date', true );
										$yic_activity_date 	= date_i18n(YIC_DATE_FORMAT, strtotime($yic_activity_date)); 				
										$yic_activity_who 	= get_post_meta( $idea_id, 'yic_activity_who', true );
										$activity_user_name = '';
									
										if(!empty($yic_activity_who)){		
									
											$user_id				= $yic_activity_who;
											$user_info 				= get_userdata($user_id);	
											$activity_user_name 	= ($user_info) ? $user_info->display_name : '' ;
															
										}
										
										
											?>				
											<div style="flex-grow: 1; text-align:center;">
												<div style="flex-grow: 1">
													<!--<div class="" style="width:1px; height:50px; background:#ccc; margin:0 auto;"></div>-->
												</div>
											</div>	
										
											<div style="flex-grow: 1;">
												<div style="flex-grow: 1; text-align:right;">
                                                	<?php if($yic_last_activity == 'Commented'){
														?>
                                                        	Last <?php echo $yic_last_activity;?> On <?php echo $yic_activity_date;?> by <span class="yic_gray"><?php echo $activity_user_name;?></span>
                                                        <?php 
													}else{
														?>
															No Comments
														<?php
													}
													?>
												</div>
											</div>		
									
										  <?php 
										
									}
								?>			
							</div>
						</div>
					</div>
                    
                    <?php $idea_template = YIC_IDEA_PLUGIN_URL.'uploads/template-pdf/idea-template.pdf';?>
					
					<div class="yic-row">			
						<div class="yic-col yic-col-100">
							<!--<div class="yic-form-group yic_default_right">-->
							<div class="yic-form-group yic_front_edit_idea">
								<label class="yic-view-template-edit-idea">			
									<a class=""  target="_blank" href="<?php echo $idea_template;?>">View Template</a> <br />			
									<!--<span>Reuse or Copy sections you need from the template.</span>	-->		
								</label>		
							</div>			
						</div>			
					</div>
								
					
					<div class="yic-row">			
						<div class="yic-col yic-col-100">
							<div class="yic-form-group">			
								<?php 
									$content = $post->post_content;//$idea_query_row->post_content;
									//var_dump($content);
									$editor_id = 'yic_new_content';	
									$settings = array( 'quicktags' => true );		
									wp_editor( $content, $editor_id, $settings );                
								?>
						
								<input type="hidden" id="idea_id" name="idea_id" value="<?php echo $idea_id;?>" />				
								<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>" />		
								<input type="hidden" name="pageurl" value="<?php echo $actual_link;?>" />
							</div>			
						</div>	
					</div>
					
					 <div class="yic-row">	
						<div class="yic-col yic-col-100">			
							<div class="yic-form-group">
								<?php $idea_tags = yic_get_all_tag_names_of_an_idea($idea_id); ?>
								<div class="yic-pull-left">
									<span class="yic_grn"><strong>Tags:</strong></span> <span class="yic_idea_tags_section"><?php echo $idea_tags;?></span> 		
								</div>			
								<?php  $idea_cats = yic_get_all_category_names_of_an_idea($idea_id); ?>	
								<div class="yic-pull-right"><span class="yic_grn"><strong>Categories:</strong></span> <span class="yic_idea_cats_section"><?php echo $idea_cats;?></span></div>
							</div>
						</div>
					</div>			
					<?php 				
						if(($post_author == $current_user_id) || in_array("moderator", $role) || in_array("administrator", $role) ){			
							?>			
								<div class="yic-row"> 
									<div class="yic-col yic-col-100"> 
										<div class="yic-form-group">   
											<input type="submit" name="editidea" class="yic-btn-gen" value="Update" />

                                            <input type="reset" class="yic-btn-cancel" name="Cancle" value="Cancel" />
										</div>
									</div>
								</div>
							<?php
						}
					?> 	
				</form>
					
                <!-- End Idea Detais Section --> 
                
               <!-- Start Idea Comment Section --> 
               <?php $comment_display_style = '';//( !yic_is_allow_comment($idea_id) ) ? ' display: none; ' : ''; ?>
               <div class="yic_comment_area" style=" <?php echo $comment_display_style; ?>">  
               		<?php comments_template(); ?>
               </div>
               <!-- End Idea Comment Section --> 
               
               
            </div>
            <?php include_once(YIC_IDEA_PLUGIN_DIR. '/includes/side-bar.php'); ?>
        </div>
    </div>
</div>

<?php get_footer();?>

<script>
	
	var ajaxUrl = '<?php echo admin_url('admin-ajax.php');?>';
	jQuery(document).ready(function($){
		
		setTimeout(function(){ 
			////////// Start For open editor with visual mode /////////////
			$("#wp-yic_new_content-wrap .wp-editor-tabs").show();
			$("#yic_new_content-tmce").trigger( "click" );//.click();
			$("#wp-yic_new_content-wrap .wp-editor-tabs").hide();
			///////////// End For open editor with visual mode /////////////
		}, 500);
		
		
		
		if(document.querySelector(".yic_comment_area .says")){		
			$('.yic_comment_area .says').html('says on:');
		}

		
		///////// Start for voting functionality /////////////
        $(document).on('click', '.yic_vote_btn', function(){
			
			var btn_activity = $(this).attr('btn-activity');
			var data = {
				'action'		: 'yic_idea_voting_action',
				'btn_activity'	: btn_activity,
				'post_id'		: <?php echo $idea_id;?>
			};


			$.post(ajaxUrl, data, function(response) {
				console.log(response);
				if(response && response != ''){
					var obj = JSON.parse(response); 
					$('.yic_vote_resp').html(obj.message);
					$('#yic_votecount').val(obj.total_vote);
				}
			});

		});
		///////// Start for voting functionality /////////////

		
		///////// Start for Status functionality /////////////
        $(document).on('click','.yic_update_idea_status_btn', function(){
			var idea_status = $('.yic_idea_status').val();
			var post_id 	= <?php echo $idea_id;?>;
			
			var data = {
				'action'		: 'yic_update_idea_status_action',
				'idea_status'	: idea_status,
				'post_id'		: post_id
			};
			
			console.log(data);


			$.post(ajaxUrl, data, function(response) {
				
				$('#new_select').html(response);

			});		

		});



		var statusStr = '<?php echo json_encode($status_arr);?>';
		var statusArr = JSON.parse(statusStr); 
		console.log(statusArr);
		$(document).on('change','.yic_idea_status', function(){

			var activith_status = $(this).val();
			var isVotable 		= statusArr[activith_status];
			//var voteHtml 		= '<span class="yic-vote-not-allow">Voting not allowed</span>';
			var voteHtml = '<span class="yic-vote-total">Vote : <strong class=""><?php  echo $total_vote;?></strong></span>';
			
			if(isVotable == 'Y'){
				voteHtml = '';
				voteHtml = '<span class="yic-vote-total">Vote : <strong class="<?php  echo $vote_cls;?>"><?php  echo $total_vote;?></strong></span>';
			}

			$('.post_vote_section').html(voteHtml);
			$('.yic_vote_resp').html('');

			////// Call ajax for update status /////////////

			var idea_status = activith_status;//$('.yic_idea_status').val();
			var post_id 	= <?php echo $idea_id;?>;

			var data = {
				'action'		: 'yic_update_idea_status_action',
				'idea_status'	: idea_status,
				'post_id'		: post_id
			};
			
			console.log(data);

			$.post(ajaxUrl, data, function(response) {

				$('#new_select').html(response);
			});
			
			////// Call ajax for update status /////////////

		});
		
		///////// End for Status functionality /////////////
		
		
		
		///////// Start for idea details functionality /////////////

		$(document).on('click', '.yic_follow_btn', function(){
			var btn_val 	= $(this).val();

			var replace_val = (btn_val == 'Follow') ? 'UnFollow' : 'Follow' ;
			
			$(this).val(replace_val);

			var data = {
				'action'	: 'yic_idea_follow_action',
				'post_id'	: <?php echo $idea_id; ?>
			};
			
			$.post(ajaxUrl, data, function(response) {
				console.log(response);
			});
		});    
    
		///////// End for idea details functionality /////////////

		$('.yic_comment_area .says').html('says on:');



		////////////// Start After click on Reset button tag field must be empty ////////////
		$(document).on('click', '.yic-btn-cancel', function(){
			//$('.text-tags').html('');
			//$('input[name="tags"]').val('[]');	
			history.back(1);		
		});
		////////////// End After click on Reset button tag field must be empty ////////////




    });

</script>