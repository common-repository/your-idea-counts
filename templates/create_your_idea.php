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

	 global $wpdb; 

	 $table_prefix 		= $wpdb->prefix;

	 $user 				= wp_get_current_user();

	 $current_user_id	= get_current_user_id();

	 $user_id 			= $user->ID;

	 $today				= date_i18n('Y-m-d h:i:s a');

	 $createidea		= '';

	 $actual_link 		= get_permalink();//'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	 $msg 				= array();

	 //if(isset($_POST['publishnow']) && $_POST['publishnow']=='Publish'){
	
	
	//////////////// Save Idea code move to includes/header.php  /////////////////
	 


	//if($user_id=='' || $user_id==0){

	if( !is_user_logged_in() ){

		$redirect_to = urlencode($actual_link);
		//echo $permalink = get_the_permalink();
		
		?>

        <div class="yic-clearfix"></div><div class="yic_main yic-login-bg">

        <div class="yic_container">

            <div class="yic_row">

                <div class="yic_col">

                    <div class="yic_recent_ideas">

                        <!--<h2><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Create an Idea</h2>-->

                        <div class="yic_wrap yic_wrap_front">

                            <div class="yic_row">

                                <div class="yic_col"><div class="logerr yic-logerr">Please login first to post your idea</div>
                                <a href="<?php echo home_url('/wp-login.php?redirect_to='.$redirect_to); ?>">Login Here</a>

							</div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

 

    	<div class="clearfix"></div>
			<?php /*?>
            <form method="post" action="<?php echo home_url('/wp-login.php?redirect_to='.$redirect_to)?>" class="wp-user-form">
    
                <div class="username yic-username">
    
                    <label for="user_login">Username: </label>
    
                    <input type="text" name="log" value="" size="20" id="user_login" tabindex="11" />
    
                </div>
    
                <div class="password yic-password">
    
                    <label for="user_pass">Password:</label>
    
                    <input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
    
                </div>
    
                <div class="login_fields">
    
                    <div class="rememberme">
    
                        <label for="rememberme">
    
                            <input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me
    
                        </label>
    
                    </div>
    
                
    
                    <input type="submit" name="user-submit" value="Login" tabindex="14" class="user-submit" />
    
    
                    <input type="hidden" name="user-cookie" value="1" />
    
                </div>
    
            </form>
            <?php */?>
    
       </div>
   
      <?php

								

	}else{

		

	 /* query to fetch default template content */

	// $qry_for_template_content = "select * from yic_idea_template where id='1'"; 

  	 //$template_content_result = $wpdb->get_row($qry_for_template_content,OBJECT);

	 
		
		$fource_user_to_use_template 	= get_option('fource_user_to_use_template');
		//$fource_use_check_status		= ($fource_user_to_use_template == 'yes') ? 'checked="checked"  disabled="disabled"' : '';
		$fource_use_check_status		= ($fource_user_to_use_template == 'yes') ? ' checked="checked" ': '';
		$idea_template 					= YIC_IDEA_PLUGIN_URL.'uploads/template-pdf/idea-template.pdf';

        ?>

		<div class="yic_front">

        <div class="yic_container yic_col">

            <div class="yic_row">

                <div class="yic_col">
					<div class="yic_main">
                    <div class="yic_recent_ideas">

                        <!--<h2><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Create an Idea</h2>-->

                        <div class="yic_wrap yic_wrap_front">

                            <div class="yic_row">

                                <div class="yic_col">

                                

                                	<?php 
										
										if(isset($_SESSION['yic']['insert_idea_error_msg'])){
											$msg['status']	= 'error';
											$msg['message'] = $_SESSION['yic']['insert_idea_error_msg'];
																						
											unset($_SESSION['yic']['insert_idea_error_msg']);
										}
									
										echo yic_show_response_meaasge($msg); 
									?>

                                    

									<form action="" method="post">

                                        <div class="yic-form-group">

                                          <input type="text" class="yic-form-control" placeholder="Idea Title *" name="yic_title" required />

										  <input type="hidden" name="pageurl" value="<?php echo $actual_link;?>">

                                        </div>

                                        

                                        <?php /*?><div class="yic-form-group">

                                            <label>Template Name</label>

                                            <select class="yic-form-control" name="template">

                                                <option value="<?php echo $template_content_result->id;?>">

                                                <?php echo $template_content_result->template_name;?></option>

                                            </select>

                                    	</div><?php */?> 

                                        

                                        <div class="well_yic">

                                        <div class="yic-form-group yic_default_left">

                                          	<!--<label class="yic-radio-inline"><input type="radio" value="">Use Template</label>-->

											<label class="yic-use-template yic_use_default_template">
                                            	<?php /*?><input type="checkbox"  class="yic_use_default_template" <?php echo $fource_use_check_status;?> style="display:none;" /><?php */ ?>
                                                Use Template
                                            </label>
                                        
                                        </div>

                                        <div class="yic-form-group yic_default_right">
                                            
                                            <label class="yic-view-template">

                                            	<a target="_blank" href="<?php echo $idea_template; //echo home_url('/idea-template');?>">View Template</a>

                                            </label>
                                        </div>

                                        

                                        <div class="yic-form-group">

                                        	<?php								
												
												$content 		= yic_get_default_template_content(); //$template_content_result->content;
												$editor_id 		= 'yic_new_content';
												
												$editor_content = '';
												$editor_content = ($fource_user_to_use_template == 'yes') ? $content : '';
																								
												$settings = array( 'quicktags' => true );
												wp_editor( $editor_content, $editor_id, $settings);												

											?>

                                            <?php /*?><div class="text_editor">

                                                <table style="width:100%">

                                                <tr>

                                                    <td id="maintab" style="width:50%;vertical-align: top">

                                                        <div id="uniqbox" class="box">

                                                            <textarea id="editor1" name="content" style="height:230px"><?php echo $content;?></textarea>

                                                        </div>

                                                    </td>

                                                </tr>

                                                </table>

                                                </div>

                                               

                                            </div><?php */?>

                                        </div>

                                 

                                        <div class="yic-form-group yic-create-idea-tag-sec">

                                            <label>Tags</label>

                                            <div class="text-wrap" style="height: 34px;">


                                                <!--<textarea id="textarea" class="example yic-tagarea" rows="1" style="height:34px;" placeholder="Please enter your tag"></textarea>

                                                <div class="text-tags text-tags-on-top"></div>

                                                <div class="text-dropdown text-position-below" style="max-height: 100px; top: 22px;">

                                                <div class="text-list"></div>

                                                </div>

                                                <input type="hidden" name="" value="">-->
                                                
                                                <!------------------------- Start tag sec ------------------------->
                                                
                                                <input type='text'
                                                   placeholder='Please enter your tag'
                                                   class='flexdatalist form-control yic_edit_tags'
                                                   data-min-length='1'
                                                   data-searchContain='true'
                                                   multiple='multiple'
                                                   list='skills'
                                                   name='tags'
                                                   value="<?php //echo $idea_tags; ?>">
                                                   
                                                <datalist id="skills">
                                                    <?php 
														$all_idea_tags = te_yic_get_all_idea_tag();
														
                                                        if(!empty($all_idea_tags)){
                                                            foreach($all_idea_tags as $tag){
                                                                $tag_name = $tag->name;
                                                                ?>
                                                                    <option value="<?php echo $tag_name;?>"><?php echo $tag_name;?></option>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                    <!--
                                                    <option value="Node.js">Node.js</option>
                                                    <option value="Accessibility">Accessibility</option>
                                                    <option value="Wireframing">Wireframing</option>
                                                    <option value="HTML5">HTML5</option>
                                                    <option value="CSS3">CSS3</option>
                                                    <option value="DOM Manipulation">DOM Manipulation</option>
                                                    <option value="MVC">MVC</option>
                                                    <option value="MVVM">MVVM</option>
                                                    <option value="MV*">MV*</option>
                                                    <option value="Modules">Modules</option>
                                                    <option value="Microdata">Microdata</option>
                                                    <option value="JavaScript">JavaScript</option>
                                                    <option value="jQuery">jQuery</option>
                                                    <option value="ReactJS">ReactJS</option>
                                                    -->
                                                </datalist>
                                                <!------------------------- End tag sec ------------------------->
                                                
                                                
                                                
                                                

                                            </div>
                                            <?php //echo YIC_DATE_FORMAT;?>

                                        </div>
                                        
                                        <div class="yic-pull-left yic-full-width">
                                        	<p class="text-primary"><i>After you enter each tag, Press the < Return > key</i></p>
                                        </div>

										

                                        <div class="yic-pull-left">

                                            <input type="submit" class="yic-btn-gen" name="publishnow" value="Publish" />

                                            <input type="reset" class="yic-btn-cancel" name="Cancle" value="Cancel" />

                                        </div>

                                        </div>
                                        <?php wp_nonce_field( 'yic_create_idea_action', 'yic_create_idea' ); ?>

                                    </form>

								</div>

                            </div>

                        </div>

                    </div>
                    </div>

                </div>

            </div>

        </div>

    </div>    
    

    <div class="clearfix"></div>
	<div class="yic_default_template" style="display:none;">
    	<textarea><?php echo $content;?></textarea>
    </div>
    <!--<script>
    	$.noConflict();
    </script>-->
     

    <?php
	
   }

?>
<script>
	
	jQuery(document).ready(function($){
		//$('#astrid-style-css').remove();		
		
		////////// Start For open editor with visual mode /////////////
		//$('#wp-yic_new_content-editor-tools .switch-tmce').trigger( "click" );		
		///////////// End For open editor with visual mode /////////////
		
		setTimeout(function(){ 
			////////// Start For open editor with visual mode /////////////
			$("#wp-yic_new_content-wrap .wp-editor-tabs").show();
			$("#yic_new_content-tmce").trigger( "click" );//.click();
			$("#wp-yic_new_content-wrap .wp-editor-tabs").hide();
			///////////// End For open editor with visual mode /////////////
		}, 500);
		
		

		////////////// Start After click on Reset button tag field must be empty ////////////
		$(document).on('click', '.yic-btn-cancel', function(){
			//$('.text-tags').html('');
			//$('input[name="tags"]').val('[]');	
			history.back(1);		
		});
		////////////// End After click on Reset button tag field must be empty ////////////
		
		
	  $(window).keydown(function(event){
		if(event.keyCode == 13) {
		  event.preventDefault();
		  return false;
		}
	  });
    });
		
</script>