<?php 
	if( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}

	global $post;
	$current_user_id 	= get_current_user_id(); 
	$post_id		 	= get_the_id();
	$author_id 	 		= $post->post_author;
	//var_dump($author_id);
?>



<div class="yic-col yic-col-3 yic-sidebar-widget-row yic-margin-left-right-0">

<div class="yic_sidebar_panel yic-sidebar-panel-default yic-margin-top-50">

    <div class="yic-sidebar-panel-heading">

        <h3 class="yic-sidebar-panel-title">Voting</h3>

    </div>

    

    <div class="yic_siderbar_voting_list">

		<?php

            $voting = yic_get_voting_list($idea_id);

            echo $voting ;

        ?>

    </div>

    

</div>

<?php 

$user_detail = wp_get_current_user(); 

$role = ( array ) $user_detail->roles;

//$user_role = $role[0]; 

$user_role = $user_detail->roles;

//$user_role = $user_role[0];



//$user_role = 'moderator';

//if($user_role == 'moderator'){

if( isset($_GET['edit']) && $_GET['edit']=='true' && (in_array("moderator", $role) || in_array("administrator", $role))){

	?>

    <div class="yic_sidebar_panel yic-sidebar-panel-default">
    
        <div class="yic-sidebar-panel-heading">
    
            <h3 class="yic-sidebar-panel-title">Moderator Options</h3>
    
        </div>
    
        <ul class="yic-sidebar-list-group">
    
            <!--<li class="yic-sidebar-list-group-item" id="view_category">Change Categories</li>-->
    
            <li class="yic-sidebar-list-group-item yic_change_category yic-cursor-pointer yic-up-down-arrow">Change Categories</li>
    
            <!--<ul class="allcat" id="allcat">-->
    
            <ul class="yic_modify_allcat" style="display:none;">
    
                <?php
    
                    $all_selected_cat_id = yic_get_all_term_ids_of_an_idea($idea_id);
    
                    //print_r($all_selected_cat_id);
    
                    
                    $all_idea_cats = te_yic_get_all_idea_category();
    
                    if(!empty($all_idea_cats)){
    
                        
    
                        foreach($all_idea_cats as $idea_cat){
    
                            $term_id = $idea_cat->term_id;
    
                            $checked = (!empty($all_selected_cat_id) && in_array($term_id, $all_selected_cat_id)) ? 'checked="checked"' : '';
    
                            ?>
    
                                <li>
    
                                    <input <?php echo $checked;?> value="<?php echo $term_id;?>" class="yic_edit_cat_checkbox" type="checkbox"> 
    
                                    <?php echo $idea_cat->name;?> 
    
                                </li>
    
                            <?php
    
                        }
    
                        ?>
    
                            <input class="yic_cat_update_btn yic-btn-gen"  value="Update" type="button">
    
                            <div class="yic_update_cat_resp"></div>
    
                        <?php
    
                    }else{
    
                        echo 'Category not available.';
    
                    }
    
                ?>
    
            </ul>
    
            <?php //if($successcat!=''){ '<div class="">Update successfully</div>';}?>
    
            <?php        	
                $idea_tags 	= yic_get_all_tag_names_of_an_idea($post_id);
                $idea_tags	= ($idea_tags == 'No tag assigned') ? '' : $idea_tags;
                
                $all_idea_tags = te_yic_get_all_idea_tag();
                
            ?>
    
            <li class="yic-sidebar-list-group-item yic_change_tag yic-cursor-pointer yic-up-down-arrow">Change Tags</li>
            <ul class="yic_modify_alltags yic-tag-ul" style="display:none;"> 
                <li>
                    <input type='text'
                       placeholder='Please enter your tag'
                       class='flexdatalist form-control yic_edit_tags'
                       data-min-length='1'
                       data-searchContain='true'
                       multiple='multiple'
                       list='skills'
                       name='skill'
                       value="<?php //echo $idea_tags; ?>">
                       
                    <datalist id="skills">
                        <?php 
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
                    <div class="yic_ideas_saved_tags" style="display:none"><?php echo $idea_tags; ?></div>
                </li>
                <li>
                    <p class="text-primary"><i>After you enter each tag, Press the &lt; Return &gt; key</i></p>
                    <input class="yic_tag_update_btn yic-btn-gen"  value="Update" type="button">
                    <div class="yic_update_tag_resp"></div>
                </li>
            </ul>
    
            
    
            <li class="yic-sidebar-list-group-item yic_change_comment yic-up-down-arrow cursor_pointer " id="change_comment">
                <div class="yic-allow-disallow-label">Comments</div>
            </li>
            
            <ul class="yic_change_comment_allow_disallow_container  yic_change_comment_allow_disallow_holder" style="display:none;">
                <li>
                    <div class="commentstatus yic-btn-commentstatus" id="commentstatus">
    
                        <?php 
                            $comment_allow_val 	= 'Allow';
                
                            $allow_data			= 1;
                            
                            if( yic_is_allow_comment($idea_id)){				
                
                                $comment_allow_val 	= 'Not Allow';
                
                                $allow_data			= 0;
                
                            }	
                            $btn_cls = 'yic_comment_allow_btn';
                
                            echo '<input type="button" value="'.$comment_allow_val.'" allow-data="'.$allow_data.'" class="yic-btn-gen pull-right follow_btn yic_comment_allow_link '.$btn_cls.'" />';	  
                
                          ?>
                          
                            <div class="yic_allow_comment_loader yic-comment-loader" style="display:none;">
                                <img src="<?php echo YIC_IDEA_PLUGIN_URL;?>images/ajax-loader-progress.gif" />
                            </div>
                          </div>
                </li>
    
            </ul>
    
            
    
        </ul>
    
        <input type="hidden" name="" id="idea_id" value="<?php echo $idea_id;?>" />
    
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" /> 
    
    </div>
    
    <?php 
}elseif( isset($_GET['edit']) && $_GET['edit']=='true' && $author_id == $current_user_id ){
	
	?>

    <div class="yic_sidebar_panel yic-sidebar-panel-default">
    
        <div class="yic-sidebar-panel-heading">
    
            <h3 class="yic-sidebar-panel-title">Author Options</h3>
    
        </div>
    
        <ul class="yic-sidebar-list-group">
    
            <?php        	
                $idea_tags 	= yic_get_all_tag_names_of_an_idea($post_id);
                $idea_tags	= ($idea_tags == 'No tag assigned') ? '' : $idea_tags;
                
                $all_idea_tags = te_yic_get_all_idea_tag();
                
            ?>
    
            <li class="yic-sidebar-list-group-item yic_change_tag yic-cursor-pointer yic-up-down-arrow">Change Tags</li>
            <ul class="yic_modify_alltags yic-tag-ul" style="display:none;"> 
                <li>
                    <input type='text'
                       placeholder='Please enter your tag'
                       class='flexdatalist form-control yic_edit_tags'
                       data-min-length='1'
                       data-searchContain='true'
                       multiple='multiple'
                       list='skills'
                       name='skill'
                       value="<?php //echo $idea_tags; ?>">
                       
                    <datalist id="skills">
                        <?php 
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
                    <div class="yic_ideas_saved_tags" style="display:none"><?php echo $idea_tags; ?></div>
                </li>
                <li>
                    <p class="text-primary"><i>After you enter each tag, Press the &lt; Return &gt; key</i></p>
                    <input class="yic_tag_update_btn yic-btn-gen"  value="Update" type="button">
                    <div class="yic_update_tag_resp"></div>
                </li>
            </ul>
    
                
        </ul>
    
        <input type="hidden" name="" id="idea_id" value="<?php echo $idea_id;?>" />
    
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" /> 
    
    </div>
    
    <?php
	
}

?>

</div>

<script>

	jQuery(document).ready(function($){

		var ajaxUrl = '<?php echo admin_url('admin-ajax.php');?>';
		
		

        $(document).on('click','.yic_change_category', function(){

			$('.yic_modify_allcat').slideToggle();
			$(this).toggleClass('yic-up-arrow');

		});
		  
        $(document).on('click','.yic_change_tag', function(){

			$('.yic_modify_alltags').slideToggle();
			$(this).toggleClass('yic-up-arrow');

		});
		
		

        $(document).on('click','.yic_change_comment', function(){

			$('.yic_change_comment_allow_disallow_container').slideToggle();
			$(this).toggleClass('yic-up-arrow');

		});

		

		

		//////////// Start Update Category /////////////////

		$(document).on('click','.yic_cat_update_btn', function(){

			var checkCats = [];

			$('.yic_edit_cat_checkbox').each(function(index, element) {

                if($(this).prop('checked')){

					checkCats.push($(this).val());

				}

            });

			

			

			var data = {

				'action'	: 'yic_update_category_action',

				'checkCats'	: checkCats,

				'post_id'	: <?php echo $idea_id; ?>

			};

	

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

			$.post(ajaxUrl, data, function(response) {

				//alert('Got this from the server: ' + response);

				console.log(response);

				if(response != ''){

					

					var obj 		= JSON.parse(response); 

					var msg 		= obj.message;

					var status 		= obj.status;

					var idea_cats	= obj.idea_cats;

					

					$('.yic_update_cat_resp').html(msg);

					$('.yic_idea_cats_section').html(idea_cats);

					

				}

			});

			

		});

		

		//////////// End Update Category /////////////////
		
				

		//////////// Start Update Tag /////////////////

		$(document).on('click','.yic_tag_update_btn', function(){

			var all_tags = $('.yic_edit_tags').val().trim();
			
			console.log(all_tags);

			

			var data = {

				'action'	: 'yic_update_tag_action',

				'all_tags'	: all_tags,

				'post_id'	: <?php echo $idea_id; ?>

			};
	

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

			$.post(ajaxUrl, data, function(response) {

				//alert('Got this from the server: ' + response);

				console.log(response);

				if(response != ''){
					

					var obj 		= JSON.parse(response); 

					var msg 		= obj.message;

					var status 		= obj.status;

					var idea_tag	= obj.idea_tag;
					

					$('.yic_update_tag_resp').html(msg);

					$('.yic_idea_tags_section').html(idea_tag);
					

				}

			});			

		});
		

		//////////// End Update Tag /////////////////	
		


		//////////// Start Comment allow ////////////////////

		$(document).on('click','.yic_comment_allow_btn', function(){

			var allow_data = $(this).attr('allow-data');
			
			$(this).hide();
			$('.yic_allow_comment_loader').show();
			
			if(allow_data == 1){

				$(this).attr('allow-data',0);

				//$(this).val('Disallow');

				$('.yic_comment_area').slideDown();

			}else{

				$(this).attr('allow-data',1);

				//$(this).val('Allow');				

				$('.yic_comment_area').slideUp();

			}

					

			

			var data = {

				'action'		: 'yic_allow_disallow_comment_action',

				'allow_data'	: allow_data,

				'post_id'		: <?php echo $idea_id; ?>

			};

	

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

			$.post(ajaxUrl, data, function(response) {

				//alert('Got this from the server: ' + response);

				console.log(response);
				
				//location.reload(false); //loads from browser's cache 	
				location.reload(true); //loads from server	

			});

						

		});		

		//////////// End Comment allow ////////////////////

		
    });

</script>