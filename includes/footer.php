<?php
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
?>
<div class="yic_popup_container yic_use_default_tepmlate_popup" style="display:none;">

    <div class="yic_tranparent"></div>

    <div class="yic_modal_pop">

        <div class="yic_popup_close">X</div>

        <p> You may loose your changes. Are you sure you want to continue ? </p>

        <div class="center">

            <button class="btn btn-default yic_continue_with_default_template">Yes</button><button class="btn btn-danger yic_popup_cancle_btn">No</button>

        </div>

    </div>

</div>

<script>

	function yic_hide_popup(){

		jQuery('.yic_popup_container').fadeOut();

	}

	

	

	jQuery(document).on('click', '.yic_tranparent, .yic_popup_close, .yic_popup_cancle_btn', function(){

		yic_hide_popup();

	});

	

	

	jQuery(document).ready(function($){

		

		/////// Start function for New line to break /////////
		function yicNl2br(str, is_xhtml) {   
			var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';   
			//breakTag = '';
			return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
		}
		/////// End function for New line to break /////////

		function yic_use_default_template(){
			
			//////////////// Check the text area is exist or not inside the page //////////////////////
			if(document.querySelector('.yic_default_template textarea')){

				var content = '';			
	
				//if( $('.yic_use_default_template').prop('checked') == true ){
	
					content1 = $('.yic_default_template textarea').val();			
					content = yicNl2br(content1);
					$('#wp-yic_new_content-editor-tools .switch-html').trigger( "click" );
	
				//}
	
				
	
				//$('#yic_new_content').val(content);
				$('#wp-yic_new_content-editor-container textarea').val('');
				$('#wp-yic_new_content-editor-container textarea').val(content);
	
				
	
				//var editorFrame = $('#wp-yic_new_content-editor-container iframe').contents().find('body');
				//editorFrame.html('');
				//editorFrame.html(content);
				
				/*setTimeout(function(){ 			
					var first_p = $('#wp-yic_new_content-editor-container iframe').contents().find('body p');
					first_p.attr('style', 'margin-top:0;');
					console.log(first_p);
				}, 500);*/
				
				
				 $('#wp-yic_new_content-editor-tools .switch-tmce').trigger( "click" );
	
				 
	
				//console.log(content);
			}

		}

		<?php
			/*$fource_user_to_use_template 	= get_option('fource_user_to_use_template');
			if($fource_user_to_use_template == 'yes'){
				?>
					yic_use_default_template();
					$('.yic_continue_with_default_template').click();
				<?php
			}*/
		?>

		

        $(document).on('click', '.yic_use_default_template', function(e){

			e.preventDefault();

			$('.yic_use_default_tepmlate_popup').fadeIn();	

		});

		

        $(document).on('click', '.yic_continue_with_default_template', function(){

			

			/*if( $('.yic_use_default_template').prop('checked') == true ){

				$('.yic_use_default_template').prop('checked', false);

			}else{

				$('.yic_use_default_template').prop('checked', true);

			}*/

			

			yic_hide_popup();

			

			yic_use_default_template();

			

		});

		

    });
	
	
	

</script>