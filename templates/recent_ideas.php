<?php     
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
	
	$posts_per_page = (!empty($posts_per_page)) ? $posts_per_page : 5 ;
	//$title		= $title;
	//$style		= $style;
	$args 			= array();
	
?>
<div class="yic-row yic-widget-row">
  <div class="yic-col yic-col-12">
    <div class="yic_panel yic-panel-default yic-margin-top-50 yic-border-none" style=" <?php echo $style;?> ">
      <?php
	  		$title = trim($title);
			if(!empty($title)){
				?>
				  <div class="yic-panel-heading">
					<h3 class="yic-panel-title"><?php echo $title;?></h3>
				  </div>
				<?php
			}
		?>
		
		  <!--<div class="yic_siderbar_voting_list">-->
        <div>
			<?php
				$params 					= array();
				$paged						= 1;
				$params['paged'] 			= $paged;
				$params['posts_per_page']	= $posts_per_page;
				
				$recent_ideas 				= yic_get_recent_idea_list($params);
				$html 						= $recent_ideas['html'];
				$total_post_found			= $recent_ideas['total_post_found'];
				$total_pages				= ceil($total_post_found / $posts_per_page);
				
				echo $html;
				if($total_pages > $paged){					
					?>
						<ul class="yic-list-group yic_recent_idea_load_more_container">
                            <li class="yic-list-group-item yic-loader-btn-link ">
                                <a href="javascript:;" class="top_recent_idea_load_more_btn">
                                    Load More      
                                    <i class="fa fa-spinner fa-spin yic_recent_idea_loader" style="display:none;" ></i>
                                </a>
                            </li> 
                        </ul>
					<?php
				}
            ?>
        </div>
    </div>
  </div>
</div>

<script>
	
$=jQuery.noConflict();

$(document).ready(function(){	

	var ajaxurl 					= '<?php echo admin_url('admin-ajax.php');?>';
	var recent_idea_current_page	= 0+<?php echo $paged;?>;
	var recent_idea_total_pages		= 0+<?php echo $total_pages;?>;
	
	$(document).on('click', '.top_recent_idea_load_more_btn', function(){
		
		$('.yic_recent_idea_loader').show();
		var items_per_page = 0+<?php echo $posts_per_page;?>;
		recent_idea_current_page++;		
		
		var data = {
			'action'		: 'yic_load_more_recent_ideas_action',
			'items_per_page': items_per_page,
			'currentPage'	: recent_idea_current_page
		};
		
		//console.log(data);
		
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			//alert('Got this from the server: ' + response);
			$('.yic_recent_idea_loader').hide();
			var obj = JSON.parse(response);
			var listHtml = obj.html;
						
			$('.yic_recent_idea_load_more_container').before(listHtml);
			
			if(recent_idea_current_page >= recent_idea_total_pages){
				$('.yic_recent_idea_load_more_container').hide();
			}
			
		});
			
	});
	
});
</script>