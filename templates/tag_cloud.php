<?php
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
?>


<?php $items_per_page = (!empty($items_per_page)) ? $items_per_page : 25 ;?>
  
<div class="yic-widget-row">
    <div class="yic-col yic-col-12">    
        <div class="yic_panel yic-panel-default yic-margin-top-50 yic-border-none" style=" <?php echo $style;?>">
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
            <div class="yic-tag-cloud-container">           	
                <!--<div><span class="active_txt" style=" color:#333333 ; background:#EEEEEE; ">All</span> A B C ........... X Y Z</div>-->
                <div>
                	<div id="" class="filters yic-filters tag-cloud-button-group button-group"> 
                        <!--<span class="active_txt" style=" color:#333333 ; background:#EEEEEE; ">All</span> -->
                        <button class="button is-checked" data-filter="*">All</button>
                        <button class="button" data-filter=".tag-number">#</button>
                        <button class="button" data-filter=".tag-special-character">*</button>
                        <?php
                            foreach (range('A', 'Z') as $column){
                                //echo "<td> $column </td>";
								echo '<button class="button" data-filter=".tag-'.strtolower($column).'">'.$column.'</button>';
                            } 
                        ?>
                    </div>
                </div>
                <?php	
					
//					$page = 30;//( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1;	
//					
//					$offset = ( $page-1 ) * $posts_per_page;
//					
//					$arg	= array( 
//								'taxonomy' 	=> 'yic_tag',
//								'orderby'	=> 'name',
//								'order'		=> 'ASC',
//								'format'	=> 'array',//'list',	'flat'		
//								'number' 	=> $posts_per_page, 
//								'offset' 	=> $offset 				
//							);
					
						
//                	$tag_arr = wp_tag_cloud($arg);
					
					$total_items 	= count(te_yic_get_all_idea_tag_cloud_tags());
					$total_pages	= ($items_per_page != -1) ? ceil($total_items / $items_per_page ) : 1;
					//var_dump($total_pages);
					$paged			= 1;
					$param = array(
								'paged' 			=> $paged,
								'items_per_page' 	=> $items_per_page								
							);
					$tag_arr = yic_get_tags_from_tag_cloud($param);
					
				 	/*echo '<pre>';
						var_dump($tag_arr);
					echo '</pre>';*/	
					
					?>
					<div class="grid yic-tag-cloud">
                    
                    	<?php
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
						?>
                        
                        
                    </div>
					<?php
                    	if($total_pages > 1){
							?>
								<div class="yic-pull-right yic-btn-link">
                                	<a href="javascript:;" class="yic_load_more_tags" >
                                	<i class="fa fa-spinner fa-spin yic_tag_cloud_loader" style="display:none;" ></i>  Load More</a>
                                </div>
							<?php
						}
					?>
                    
                
            </div>
        </div>
    </div>
</div>
<script>

$=jQuery.noConflict();

var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';
$(document).ready(function(){
	function yic_set_data_category_for_isotop(){
		$('.yic-tag-cloud a.tag-cloud-link').each(function(){
			
			var ideaTag 		= $(this).attr('aria-label');
			var firstCharector 	= ideaTag.charAt(0).toLowerCase(); /// get first charector of the string
			var cls 			= "tag-" + firstCharector;
			
			//////////// Start Check number ////////////
			if (!isNaN(parseInt(firstCharector, 10))) {
				// Is a number
				cls 			= "tag-number";
			}
			//////////// End Check number ////////////
			
			//////////// Start Check special charecter ////////////
			var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
			
			if (format.test(firstCharector)) {
				// Is a special charecter
				cls 			= "tag-special-character";
			}
			//////////// End Check special charecter  ////////////
			
			
			
			//console.log(cls);
			$(this).closest(".element-item").addClass(cls);
			$(this).closest(".element-item").attr('data-category', cls);
			//element-item data-category
		});
	}
	yic_set_data_category_for_isotop();
	
	var currentPage = <?php echo $paged;?>;
		currentPage	= 0+currentPage;
	var totalPages	= +<?php echo $total_pages;?>;
	$(document).on('click', '.yic_load_more_tags', function(){
		
		$('.yic_tag_cloud_loader').show();
		
		var items_per_page = <?php echo $items_per_page;?>;	
		currentPage++;
		var data = {
			'action'		: 'yic_load_more_tags_action',
			'items_per_page': items_per_page,
			'currentPage'	: currentPage
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			//alert('Got this from the server: ' + response);
			$('.yic_tag_cloud_loader').hide();
			$('.element-item').last().after(response);
			$('.grid').attr('style', '');
			$('.element-item').attr('style', '');
			yic_set_data_category_for_isotop();
			
			console.log('currentPage: '+currentPage+' totalPages: '+totalPages);
			if(currentPage >= totalPages){
				$('.yic_load_more_tags').hide();
			}
		});
			
		
	});
	
	
	$(document).on('click','.button-group button', function(){
		$('.button-group button').removeClass('is-checked');
		$(this).addClass('is-checked');
		var showingCls = $(this).attr('data-filter');
		if(showingCls == '*'){
			$('.element-item').show();
			
			if(currentPage >= totalPages){
				$('.yic_load_more_tags').hide();
			}else{
				$('.yic_load_more_tags').show();
			}
			
		}else{	
			$('.yic_load_more_tags').hide();		
			$('.element-item').hide();
							
			if(document.querySelector(showingCls)){
				$(showingCls).show();
			}
		}
	});
	
	
});
</script>