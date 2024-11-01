<?php
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}

?>
<script>
	jQuery(document).ready(function($){
        $(document).on('click', '.yic_edit_status_btn', function(){
			
			var post_id 		= $(this).attr('post-id');
			var container_id 	= '#yic-status-'+post_id;
			
			
			$(container_id + ' .yic_view_status_sec').slideToggle('fast');
			$(container_id + ' .yic_edit_status_sec').slideToggle('fast');
			//console.log();
		});
		
		
        $(document).on('click', '.yic_cancle_status_btn', function(){
			
			var post_id 		= $(this).attr('post-id');
			var container_id 	= '#yic-status-'+post_id;
			
			
			$(container_id + ' .yic_view_status_sec').slideToggle('fast');
			$(container_id + ' .yic_edit_status_sec').slideToggle('fast');
			//console.log();
		});
		
		
        $(document).on('click', '.yic_save_status_btn', function(){
			
			var post_id 		= $(this).attr('post-id');
			var container_id 	= '#yic-status-'+post_id;
			var status_id 		= $(container_id + ' .yic_idea_status').val();
			var status_title 	= $(container_id + ' .yic_idea_status option[value="'+status_id+'"]').text();
			//console.log(status_title);
			
			 
			$(container_id + ' .yic_cancle_status_btn').hide();
			$(container_id + ' .yic_save_status_btn').hide();			
			$(container_id + ' .yic_change_status_loader').addClass('is-active');
			
			$(container_id + ' .yic_status_title').text(status_title);
			
			var data = {
				'action'		: 'yic_update_idea_status_action',
				'idea_status'	: status_id,
				'post_id'		: post_id
			};
			
			//console.log(data);

			$.post(ajaxurl, data, function(response) {
				
				$(container_id + ' .yic_view_status_sec').slideToggle('fast');
				$(container_id + ' .yic_edit_status_sec').slideToggle('fast');
				
				$(container_id + ' .yic_cancle_status_btn').show();
				$(container_id + ' .yic_save_status_btn').show();
				$(container_id + ' .yic_change_status_loader').removeClass('is-active');
				//console.log(response);
				
			});			
			
		}); 
		
		
		
    });
</script>