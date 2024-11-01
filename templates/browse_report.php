<?php

	if ( ! defined( 'ABSPATH' ) ){

		exit; // Exit if accessed directly.

	}



	$posts_per_page = (!empty($posts_per_page)) ? $posts_per_page : 5 ;

/*

	$args = array();



	$args = array(



		'post_type'  		=> 'yic_idea',



		'post_status' 		=> array( 'publish' ),



		'posts_per_page' 	=> $posts_per_page



	);



	 



	$query1 = new WP_Query( $args );*/

	

	$all_status 	= yic_get_all_status();

	$all_author 	= yic_get_all_author();

	$all_tag		= te_yic_get_all_idea_tag();

	$all_category	= te_yic_get_all_idea_category();

	

?>



<div class="yic_loader_wrapper" style="display:none;">

    <div class="yic_white_tranparent"></div>

    <img src="<?php echo YIC_IDEA_PLUGIN_URL.'/images/loader.gif'; ?>" width="75" class="yic_loader" />

</div>





    <div class="yic_wrapper">

    

    <!--Custom Filter-->

    <div class="yic_alert yic_alert-info yic_alert_col">

    

        <div class="yic-row">

    

            <div class="yic-col-3 yic-form-group">

    			<label>Status</label>

               <!-- <select class="yic-form-control yic_idea_status">-->

                <select multiple="multiple" placeholder="Find with status(s)" class="SlectBox yic-form-control yic_idea_status yic_browse_status">

    

                    <!--<option value="">All Status</option>-->

    

                    <?php

					if(!empty($all_status)){

                    	foreach($all_status as $_status){

							?>

								<option value="<?php echo $_status->id;?>"><?php echo $_status->status_title;?></option>

							<?php

						}

					}

					?>

    

                </select>

    

            </div>

    

    

    

            <div class="yic-col-3 yic-form-group">

    

                <!--<input type="text" class="yic-form-control yic_idea_author" placeholder="Find with author(s)">-->

                <label>Author(s)</label>

                

                <select multiple="multiple" placeholder="Find with author(s)" class="SlectBox yic-form-control yic_idea_author search_text_author">

                    <!--<option value="volvo">Volvo</option>

                    <option value="saab">Saab</option>

                    <option value="mercedes">Mercedes</option>

                    <option value="audi">Audi</option>

                    <option value="bmw">BMW</option>-->

                    <?php

                    	if(!empty($all_author)){

							foreach($all_author as $author){

								$author_id		= $author->data->ID;

								$display_name	= $author->data->display_name;

								?>

									<option value="<?php echo $author_id;?>"><?php echo $display_name;?></option>

								<?php

							}

						}

					?>

                    

                </select>

    

            </div>

    

    

    

            <div class="yic-col-3 yic-form-group yic_idea_tag_container">

    

                <!--<input type="text" class="yic-form-control yic_idea_cat" placeholder="Find with category(s)">-->

                <label>Category(s)</label>

                <select multiple="multiple" placeholder="Find with category(s)" class="SlectBox yic-form-control yic_idea_cat search_text_cat">

                    <!--<option value="volvo">Volvo</option>

                    <option value="saab">Saab</option>

                    <option value="mercedes">Mercedes</option>

                    <option value="audi">Audi</option>

                    <option value="bmw">BMW</option>-->

                    <option value="no_cat">None</option>

                    <?php

                    	if(!empty($all_category)){

							foreach($all_category as $cat){

								$term_id	= $cat->term_id;

								$term_name	= $cat->name;

								?>

									<option value="<?php echo $term_id;?>"><?php echo $term_name;?></option>

								<?php

							}

						}

					?>

                </select>

                

            </div>

    

    

    

            <div class="yic-col-3 yic-form-group yic_idea_tag_container">

    

                <!--<input type="text" class="yic-form-control yic_idea_tag" placeholder="Find with tag(s)">-->

                <label>Tag(s)</label>

                <select multiple="multiple" placeholder="Find with tag(s)" class="SlectBox yic-form-control yic_idea_tag search_text_tag">

                   <!--<option value="volvo">Volvo</option>

                    <option value="saab">Saab</option>

                    <option value="mercedes">Mercedes</option>

                    <option value="audi">Audi</option>

                    <option value="bmw">BMW</option>-->

                    <option value="no_tag">None</option>

                    <?php

                    	if(!empty($all_tag)){

							foreach($all_tag as $tag){

								$term_id	= $tag->term_id;

								$term_name	= $tag->name;

								?>

									<option value="<?php echo $term_id;?>"><?php echo $term_name;?></option>

								<?php

							}

						}

					?>

                    

                </select>

    			

    

            </div>

    

    

    

            <div class="yic-col-8">    

                <input type="text" class="yic-form-control yic_idea_title" placeholder="Find with keyword(s)">    

            </div>

            

            <div class="yic-col-2">

                <button class="btn-search yic-btn-full yic_search_btn yic_search_filter_btn">Search &nbsp;<fa class="fa fa fa-long-arrow-right"></fa></button>   

            </div>

            

            

            <div class="yic-col-2">

            	<!--<a class="yic_reset_filter_btn yic_filter_rst_btn yic-btn-full" href="javascript:;">Reset Filter</a>--> 

                <a class="yic_reset_filter_btn yic_filter_clr_btn yic-btn-full" href="javascript:;">Clear Filter</a>   

            </div>

    

        </div>

    

    </div>

    <!--Custom Filter-->

    <div class="search_content_area" id="yic_search_content_print_area">

        <?php /*?>

		<!--Custom Table-->

        <table class="yic_custom_table">

        <thead>

            <tr>

                <th>Title</th>

                <th>Status</th>

                <th>Votes</th>

                <th>Last Activity</th>

                <th>Who</th>

                <th>What</th>

                <th>Views</th>

                <th>Comments</th>

                <th>Follow</th>

            </tr>

         </thead>

         

         <tbody>

            <tr>

                <td><i class="fa fa-lightbulb-o"></i> <a href="#">My Big Idea</a></td>

                <td><span class="active_style">Active</span></td>

                <td>955</td>

                <td>30-Aug-2017 5:40 PM</td>

                <td>Flying Dutchman</td>

                <td>Vote</td>

                <td>390</td>

                <td>56</td>

                <td><i class="fa fa-check-square-o"></i></td>

            </tr>

            

            <tr>

                <td><i class="fa fa-lightbulb-o"></i> <a href="#">My Big Idea</a></td>

                <td><span class="inactive_style">Inactive</span></td>

                <td>955</td>

                <td>30-Aug-2017 5:40 PM</td>

                <td>Flying Dutchman</td>

                <td>Vote</td>

                <td>390</td>

                <td>56</td>

                <td><i class="fa fa-check-square-o"></i></td>

            </tr>

            

            <tr>

                <td><i class="fa fa-lightbulb-o"></i> <a href="#">My Big Idea</a></td>

                <td><span class="active_style">Active</span></td>

                <td>955</td>

                <td>30-Aug-2017 5:40 PM</td>

                <td>Flying Dutchman</td>

                <td>Vote</td>

                <td>390</td>

                <td>56</td>

                <td><i class="fa fa-square-o"></i></td>

            </tr>

         </tbody>

        </table>

        <!--Custom Table-->

        

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

        

        <?php */?>

    </div>

    

    

</div>



<script type="text/javascript" >

var ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';

jQuery(document).ready(function($){

	yic_default_selection();

	var paged = 1;

	////// Start Reset Order query//////////

	yicOrderBy 	= '';

	yicOrder 	= ''; 

	////// End Reset Order query//////////

	yicGetBrowseReport(paged);

	

	$(document).on('click','.yic_search_btn', function(){

		paged	= 1;

		yicGetBrowseReport(paged);

	});

	

	$(document).on('click','.yic_brows_report_paginate', function(){

		paged	= $(this).attr('paged');

		yicGetBrowseReport(paged);

	});

	

	function yicGetBrowseReport(paged){

		

		var yic_idea_status = $('.yic_idea_status').val();		

		var yic_idea_author = $('.yic_idea_author').val();	

		var yic_idea_cat 	= $('.yic_idea_cat').val();	

		var yic_idea_tag 	= $('.yic_idea_tag').val();

		var yic_idea_title 	= $('.yic_idea_title').val().trim();

		

		var data = {

			'action'			: 'yic_get_browse_report_action',

			'yic_idea_status'	: yic_idea_status,

			'yic_idea_author'	: yic_idea_author,

			'yic_idea_cat'		: yic_idea_cat,

			'yic_idea_tag'		: yic_idea_tag,

			'yic_idea_title'	: yic_idea_title,

			'posts_per_page'	: <?php echo $posts_per_page;?>,

			'paged'				: paged,

			'yic_order_by'		: yicOrderBy,

			'yic_order'			: yicOrder

		};

		

		//console.log(data);

		$('.yic_loader_wrapper').fadeIn();

	

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php

		$.post(ajaxurl, data, function(response) {

			//alert('Got this from the server: ' + response);

			//console.log(response);

			$('.search_content_area').html(response);

			$('.yic_loader_wrapper').fadeOut();

			console.log(response);

		});

	}

	

	

	$(document).on('click','.yic_filter_rst_btn', function(){

		

		yic_default_selection();

		

		paged	= 1;

		yicGetBrowseReport(paged);

	});

	

	

	$(document).on('click','.yic_filter_clr_btn', function(){

		

		yic_clear_selection();

		

	});

	

	

	

	function yic_default_selection(){

		

		$('.yic_idea_title').val('');

		

		/*$('.yic_idea_status option:selected').each(function () {

			$('.yic_idea_status')[0].sumo.unSelectItem($(this).index());

		});*/

		

		$('.yic_idea_status option').each(function () {

			$('.yic_idea_status')[0].sumo.selectItem($(this).index());

		});

		

		$('.yic_idea_author option').each(function () {

			$('.yic_idea_author')[0].sumo.selectItem($(this).index());

		});

		

		$('.yic_idea_cat option').each(function () {

			$('.yic_idea_cat')[0].sumo.selectItem($(this).index());

		});

		

		$('.yic_idea_tag option').each(function () {

			$('.yic_idea_tag')[0].sumo.selectItem($(this).index());

		});

	}

	

	

	

	function yic_clear_selection(){

		

		$('.yic_idea_title').val('');

		

		$('.yic_idea_status option').each(function () {

			$('.yic_idea_status')[0].sumo.unSelectItem($(this).index());

		});

		

		$('.yic_idea_author option').each(function () {

			$('.yic_idea_author')[0].sumo.unSelectItem($(this).index());

		});

		

		$('.yic_idea_cat option').each(function () {

			$('.yic_idea_cat')[0].sumo.unSelectItem($(this).index());

		});

		

		$('.yic_idea_tag option').each(function () {

			$('.yic_idea_tag')[0].sumo.unSelectItem($(this).index());

		});

	}

	



	

	$(document).on('click','.yic_browse_follow', function(){

		

		

			var post_id		= $(this).attr('post_id');

			



			var data = {



				'action'	: 'yic_idea_follow_action',



				'post_id'	: post_id



			};



	



			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php



			$.post(ajaxurl, data, function(response) {



				//alert('Got this from the server: ' + response);



				console.log(response);



			});



		

	});

	

	//////////////// Start Sorting functionality /////////////////

	

	/*$(document).on("click", ".yic_sort_column", function(){

		

		yicOrderBy 		= $(this).attr('yic-order-by').trim();

		var yic_order 	= $(this).attr('yic-order').trim();

		yicOrder 		= (yic_order == 'ASC') ? 'DESC' : 'ASC';

		

		paged			= 1;

		yicGetBrowseReport(paged);

	});*/
	
	/*$(document).on("click", ".yic_sort_column", function(){

		

		yicOrderBy 		= $(this).attr('yic-order-by').trim();

		var yic_order 	= $(this).attr('yic-order').trim();

		yicOrder 		= (yic_order == 'ASC') ? 'DESC' : 'ASC';

		

		paged			= 1;

		yicGetBrowseReport(paged);

	});*/
	/*-------------Start sorting for ASC(modify code)-------------*/
	$(document).on("click", ".yic_sort_up", function(){

		

		yicOrderBy 		= $(this).attr('yic-order-by').trim();

		yicOrder 		= 'ASC';

		paged			= 1;

		yicGetBrowseReport(paged);

	});
	/*-------------Start sorting for DESC(modify code)-------------*/
	$(document).on("click", ".yic_sort_down", function(){

		

		yicOrderBy 		= $(this).attr('yic-order-by').trim();

		yicOrder 		=  'DESC' ;

		paged			= 1;

		yicGetBrowseReport(paged);

	});

	//////////////// End Sorting functionality /////////////////



	

});

</script>