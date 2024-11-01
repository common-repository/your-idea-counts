<?php 
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
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

	$current_user_id	= '';

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

<!--Yic Main Div Starts Here-->

    <div class="yic_main yic-view-mode">

    

      <!--Yic Container Starts Here-->

      <div class="yic-container"> 

      		<?php echo $display_msg;?>

         <!--Title Starts Here-->

            <h2><i class="fa fa-lightbulb-o" aria-hidden="true"></i> <?php the_title();?></h2>

            <!--Title Ends Here-->

        <!--Yic Row Starts Here-->

        <div class="yic-row">

          <div class="yic-col yic-col-9">

          

          	

           

    

            <!--Vote and Status Starts Here-->

            <div class="yic_well yic-idea-filter">

              <!--<ul>

                <li class="yic-status-align">Vote : <strong>123456</strong></li>

                <li class="yic-status-align">|</li>

                <li class="yic-status-align">Status : <strong>Active</strong></li>

              </ul>-->

              <ul>

                <li class="yic-status-align">

                	<?php /*?>Vote : <strong><?php echo $total_vote;?></strong> <?php */?>

                    <?php 

						//if($is_votable == 'Y'){

						if($is_votable){

							$total_vote 		= ($total_vote=='')? 0 : $total_vote ;

							

							$up_active_cls 		= ($vote_status == 1) ? 'active' : '';

							$down_active_cls 	= ($vote_status == -1) ? 'active' : '';

							

							//if ( is_user_logged_in() && !in_array("moderator", $role) && !in_array("administrator", $role)  ) {
							if ( is_user_logged_in() ) {

								?>  

									<div class="post_vote_section">

										<div class="yic-vote-allow">

											<input type="button" btn-activity="upvote" class="yic-btn-upvote yic_vote_btn <?php echo $up_active_cls;?>" >

											<input type="text" readonly value="<?php  echo $total_vote;?>" id="yic_votecount" class="form-control vote_txtbox">

											<input type="button" btn-activity="downvote" class="yic-btn-downvote yic_vote_btn <?php echo $down_active_cls;?>" >  

										</div>  

									</div> 

													  

								<?php

							}else{

								$vote_cls = ($total_vote >= 0)  ? 'yic-green' : 'yic-red' ;

								?>

									<div class="post_vote_section">

										<span class="yic-vote-total">Vote : <strong class="<?php echo $vote_cls;?>"><?php  echo $total_vote;?></strong></span>

									</div>

								<?php                   

								

							}

						 

						}else{

							?>

								<div class="post_vote_section">

									<!--<span class="yic-vote-not-allow">Voting not allowed</span>-->
                                    <span class="yic-vote-total">Vote : <strong class=""><?php  echo $total_vote;?></strong></span>

								</div>

							<?php

						}

					?>

                </li>

                

                <li class="yic-status-align">|</li>

                <li class="yic-status-align">Status : 

                <span class="active_txt" style=" <?php echo $status_style ;?>"> <?php echo $alloted_status;?></span>

                </li>
                
				<li class="yic-status-align">|</li>
                <?php

                	if(is_user_logged_in()){

						?>
							
							<li class="yic-status-align yic-pull-right">

								<div class="followbutt" id="followbutt">

									<?php

									$param				= array();

									$param['user_id'] 	= get_current_user_id();

									$param['post_id'] 	= $idea_id;

									$is_followed		= yic_is_user_followed_the_idea($param);

									$btn_value			= 'UnFollow';

									

									if(!$is_followed){

										 $btn_value	= 'Follow';

									}

									

									?>

									<input type="button" value="<?php echo $btn_value;?>" class="btn pull-right yic-btn-link follow_btn yic_follow_btn" />

								</div>

							</li>

						<?php 

					}else{

						?>

							<li class="yic-status-align yic-pull-right">

								<div class="followbutt yic-tooltip" id="followbutt">									

									<input type="button" value="Follow" class="btn pull-right yic-btn-link follow_btn yic_follow_btn_login" />

                                    <span class="yic-tooltiptext">Please <a href="<?php echo wp_login_url( get_permalink() ); ?>" >Login first</a></span>

								</div>

							</li>

						<?php

					}

				?>
                

                <?php

                	if($show_edit_btn){

						?>

							<li class="yic-status-align">|</li>

                            <li class="yic-status-align"><a href="<?php echo get_permalink().'?edit=true';?>">Edit</a></li>

						<?php

					}

				?>

              </ul>

            </div>

            <!--Vote and Status Ends Here-->

    

    

            <!--Comment Starts Here-->

            <div class="yic-form-group yic-post-last-update-sec yic-pad-lr-10">

              <!--<h5>Created February 15, 2018 by <span class="yic_grn">BiswanathSub HalderSub</span></h5>-->

                <div class="yic-row">

                <div class="yic-col-5 yic-text-left">

                Created on <?php echo get_the_date(YIC_DATE_FORMAT);?> by <span class="yic_gray"><?php echo  get_the_author_meta('display_name',$post_author );?></span>

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
						
						<div class="yic-col-1">
							&nbsp;
							<!--<div class="" style="width:1px; height:50px; background:#ccc; margin:0 auto;"></div>-->
		
						</div>
		
						
		
						<div class="yic-col-6 yic-text-right">
                        
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
		
						<?php 
                	}

                ?>

                </div>

              

            </div>

    		<!--<hr class="yic-clearfix">-->

            <!--Comment Ends Here-->

            <div class="yic_content_area yic-dynamic-content">

            	<?php echo  apply_filters('the_content', $post->post_content);?>

            </div>

            

            <hr>

            <div class="yic-col-100">

              <div class="yic-form-group">

                <div class="yic-pull-left">

                	<span class="yic_grn"><strong>Tags:</strong></span> 

                    <?php echo $idea_tags;?>

                </div>

                <div class="yic-pull-right">

                	<span class="yic_grn"><strong>Categories:</strong></span> 

                    <span class="yic_idea_cats_section"><?php echo $idea_cats;?></span>

                </div>

              </div>

            </div>

            <!--Comment Section Starts Here-->

            <div class="yic-clearfix"></div>

            <?php

            	//if( yic_is_allow_comment($idea_id) ){

					?>

                        <div class="yic_well yic_comment_area">

                         	<?php comments_template (); ?>

                        </div>

						

					<?php

				//}

			?>

            <!--Comment Section Ends Here-->

          </div>

		  <?php include_once(YIC_IDEA_PLUGIN_DIR. '/includes/side-bar.php'); ?>

          

          <!--<div class="yic-col yic-col-4">          	

          </div>-->

        </div>

        <!--Yic Row Ends Here--> 

        

      </div>

      <!--Yic Container Ends Here--> 

      

    </div>

<!--Yic Main Div Ends Here--> 

<script>

	jQuery(document).ready(function($){
		
		if(document.querySelector(".yic_comment_area .says")){		
			$('.yic_comment_area .says').html('says on:');
		}

		var ajaxUrl = '<?php echo admin_url('admin-ajax.php');?>';

		

		//////////// Start Follow Functionality ////////////

		$(document).on('click', '.yic_follow_btn', function(){

			

			var btn_val 	= $(this).val();

			var replace_val = (btn_val == 'Follow') ? 'UnFollow' : 'Follow' ;

			

			$(this).val(replace_val);

			

			var data = {

				'action'	: 'yic_idea_follow_action',

				'post_id'	: <?php echo $idea_id; ?>

			};

	

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

			$.post(ajaxUrl, data, function(response) {

				//alert('Got this from the server: ' + response);

				console.log(response);

			});

			

		});  

		//////////// End Follow Functionality ////////////

		

		

		///////////////// Start Vote functionality //////////////////

		

        $(document).on('click', '.yic_vote_btn', function(){

			

			var btn_activity = $(this).attr('btn-activity');

			

			$('.yic_vote_btn').removeClass('active');

			$(this).addClass('active');

			

			var data = {

				'action'		: 'yic_idea_voting_action',

				'btn_activity'	: btn_activity,

				'post_id'		: <?php echo $idea_id;?>

			};

	

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

			$.post(ajaxUrl, data, function(response) {

				//alert('Got this from the server: ' + response);

				console.log(response);

				if(response && response != ''){

					var obj = JSON.parse(response); 

					//$('.yic_vote_resp').html(obj.message);

					$('#yic_votecount').val(obj.total_vote);

					$('.yic_siderbar_voting_list').html(obj.voting_list);

					

				}

			});

		});		

		

		

        $(document).on('click', '.yic_follow_btn_login', function(){

			

		});

		

		///////////////// End Vote functionality //////////////////

		

    });

</script>

<?php get_footer();?>