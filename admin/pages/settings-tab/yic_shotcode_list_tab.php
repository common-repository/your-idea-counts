<?php
	if( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}


	$shotcode_arr 							= array();

	$shotcode_arr['Create An Idea']['title']= 'Create An Idea';

	//$shotcode_arr[0]['code']	= '[yic_show_widget class="yic_create_idea_widget" show_border="yes" border_color="006600" border_size="5" padding_top="10" padding_right="10" padding_bottom="5" padding_left="10" ]';
	$shotcode_arr['Create An Idea']['code']	= '<span class="yic_shortcode_bg">[create_idea]</span>
									
												<h4>Parameter values:</h4>
												
												<ul class="yic-shotcode-params">
													<li>
																									
														<ul>
															<li>Title:</li>             
															<li>Default: <strong><em>No default title</em></strong></li>
															<li><strong>title=</strong><code>string</code></li>
														</ul>
														
														<ul>
															<li>Show Border:</li>             
															<li>Default: <strong><em>No</em></strong></li>
															<li><strong>show_border=</strong><code>yes/no</code></li>
														</ul>
														<ul>
															<li>Border Color:</li>             
															<li> Default: <strong><em>bdbdbd</em></strong></li>
															<li><strong>border_color=</strong><code>hex value</code></li>
														</ul>
														
														
														<ul>
															<li>Border Size:</li>                         
															<li>Default: <strong><em>1</em></strong></li>
															<li><strong>border_size=</strong><code>pixels</code></li>
														</ul>
														
														<ul>
															<li>Top Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_top=</strong><code>pixels</code></li>
														</ul>											
														
													</li>
													
													<li>
														<ul>
															<li>Right Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_right=</strong><code>pixels</code></li>
														</ul>
														
														
														<ul>
															<li>Bottom Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_bottom=</strong><code>pixels</code></li>
														</ul>
														
														<ul>
															<li>Left Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_left=</strong><code>pixels</code></li>
														</ul>
														
														
													</li>
												 </ul>
												<div class="clearfix"></div>
												<div class="well">
													<ul>
														<li>Example:</li>
														<li>									
															<strong>[create_idea title="Create Idea" show_border="yes" border_color="006600" border_size="5" padding_top="10" padding_right="10" padding_bottom="5" padding_left="10" ]</strong>
														</li>
													</ul>
												</div>';

	

	$shotcode_arr['Recent Ideas']['title']	= 'Recent Ideas';

	$shotcode_arr['Recent Ideas']['code']	= '<span class="yic_shortcode_bg">[recent_ideas]</span>
									
												<h4>Parameter values:</h4>
												
												<ul class="yic-shotcode-params">
													<li>
																									
														<ul>
															<li>Title:</li>             
															<li>Default: <strong><em>Recent Ideas</em></strong></li>
															<li><strong>title=</strong><code>string</code></li>
														</ul>
														
																							
														<ul>
															<li>Ideas per-page:</li>             
															<li>Default: <strong><em>5</em></strong></li>
															<li><strong>show_items=</strong><code>integer</code></li>
														</ul>
														<ul>
															<li>Show Border:</li>             
															<li>Default: <strong><em>yes</em></strong></li>
															<li><strong>show_border=</strong><code>yes/no</code></li>
														</ul>
														<ul>
															<li>Border Color:</li>             
															<li> Default: <strong><em>bdbdbd</em></strong></li>
															<li><strong>border_color=</strong><code>hex value</code></li>
														</ul>
														
														
														<ul>
															<li>Border Size:</li>                         
															<li>Default: <strong><em>1</em></strong></li>
															<li><strong>border_size=</strong><code>pixels</code></li>
														</ul>										
														
													</li>
													
													<li>											
														<ul>
															<li>Top Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_top=</strong><code>pixels</code></li>
														</ul>	
														<ul>
															<li>Right Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_right=</strong><code>pixels</code></li>
														</ul>
														
														
														<ul>
															<li>Bottom Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_bottom=</strong><code>pixels</code></li>
														</ul>
														
														<ul>
															<li>Left Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_left=</strong><code>pixels</code></li>
														</ul>
														
														
													</li>
												 </ul>
												<div class="clearfix"></div>
												
												<div class="well">
													<ul>
														<li>Example:</li>
														<li>
															<strong>[recent_ideas title="Recent Ideas" show_items="5" show_border="yes" border_color="006600" border_size="5" padding_top="10" padding_right="10" padding_bottom="5" padding_left="10" ]</strong>
														</li>
													</ul>
												</div>';

	

	$shotcode_arr['Browse Ideas']['title']	= 'Browse Ideas';

	$shotcode_arr['Browse Ideas']['code']	= '<span class="yic_shortcode_bg">[browse_ideas]</span>
									
												<h4>Parameter values:</h4>
												
												<ul class="yic-shotcode-params">
													<li>
																									
														<ul>
															<li>Title:</li>             
															<li>Default: <strong><em>No default title</em></strong></li>
															<li><strong>title=</strong><code>string</code></li>
														</ul>
																							
														<ul>
															<li>Ideas per-page:</li>             
															<li>Default: <strong><em>25</em></strong></li>
															<li><strong>show_items=</strong><code>integer</code></li>
														</ul>
														<ul>
															<li>Show Border:</li>             
															<li>Default: <strong><em>No</em></strong></li>
															<li><strong>show_border=</strong><code>yes/no</code></li>
														</ul>
														<ul>
															<li>Border Color:</li>             
															<li> Default: <strong><em>bdbdbd</em></strong></li>
															<li><strong>border_color=</strong><code>hex value</code></li>
														</ul>
														
														
														<ul>
															<li>Border Size:</li>                         
															<li>Default: <strong><em>1</em></strong></li>
															<li><strong>border_size=</strong><code>pixels</code></li>
														</ul>										
														
													</li>
													
													<li>											
														<ul>
															<li>Top Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_top=</strong><code>pixels</code></li>
														</ul>	
														<ul>
															<li>Right Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_right=</strong><code>pixels</code></li>
														</ul>
														
														
														<ul>
															<li>Bottom Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_bottom=</strong><code>pixels</code></li>
														</ul>
														
														<ul>
															<li>Left Padding:</li>                         
															<li>Default: <strong><em>0</em></strong></li>
															<li><strong>padding_left=</strong><code>pixels</code></li>
														</ul>
														
														
													</li>
												 </ul>
												<div class="clearfix"></div>
												
												<div class="well">
													<ul>
														<li>Example:</li>
														<li>
															<strong>[browse_ideas  title="Browse Ideas" show_items="10" show_border="yes" border_color="006600" border_size="5" padding_top="10" padding_right="10" padding_bottom="5" padding_left="10" ]</strong>
														</li>
													</ul>
												</div>';

	

	

	$shotcode_arr['Tag Cloud']['title']	= 'Tag Cloud';

	$shotcode_arr['Tag Cloud']['code']	= '<span class="yic_shortcode_bg">[idea_tag_cloud]</span>
									
									<h4>Parameter values:</h4>
									
									<ul class="yic-shotcode-params">
										<li>
																						
											<ul>
												<li>Title:</li>             
												<li>Default: <strong><em>Tag Cloud</em></strong></li>
												<li><strong>title=</strong><code>string</code></li>
											</ul>
																						
											<ul>
												<li>Tags per-page:</li>             
												<li>Default: <strong><em>10</em></strong></li>
												<li><strong>items_per_page=</strong><code>integer</code></li>
											</ul>
													
											<ul>
												<li>Show Border:</li>             
												<li>Default: <strong><em>yes</em></strong></li>
												<li><strong>show_border=</strong><code>yes/no</code></li>
											</ul>
											<ul>
												<li>Border Color:</li>             
												<li> Default: <strong><em>bdbdbd</em></strong></li>
												<li><strong>border_color=</strong><code>hex value</code></li>
											</ul>		
											
											<ul>
												<li>Border Size:</li>                         
												<li>Default: <strong><em>1</em></strong></li>
												<li><strong>border_size=</strong><code>pixels</code></li>
											</ul>					
											
										</li>
										
										<li>		
																				
											<ul>
												<li>Top Padding:</li>                         
												<li>Default: <strong><em>0</em></strong></li>
												<li><strong>padding_top=</strong><code>pixels</code></li>
											</ul>	
														
											<ul>
												<li>Right Padding:</li>                         
												<li>Default: <strong><em>0</em></strong></li>
												<li><strong>padding_right=</strong><code>pixels</code></li>
											</ul>
											
											
											<ul>
												<li>Bottom Padding:</li>                         
												<li>Default: <strong><em>0</em></strong></li>
												<li><strong>padding_bottom=</strong><code>pixels</code></li>
											</ul>
											
											<ul>
												<li>Left Padding:</li>                         
												<li>Default: <strong><em>0</em></strong></li>
												<li><strong>padding_left=</strong><code>pixels</code></li>
											</ul>
											
											
										</li>
									 </ul>
									<div class="clearfix"></div>
									
									<div class="well">
										<ul>
											<li>Example:</li>
											<li>
												<strong>[idea_tag_cloud title="Tag Cloud" items_per_page="25" show_border="yes" border_color="006600" border_size="5" padding_top="10" padding_right="10" padding_bottom="5" padding_left="10" ]</strong>
											</li>
										</ul>
									</div>';

	


?>



<table class=" form-table wp-list-table widefat striped">

    <tbody> 

    	<?php
		
        	if(!empty($shotcode_arr)){
				
				ksort($shotcode_arr);
				
				foreach($shotcode_arr as $shotcode){

					$title	= $shotcode['title'];

					$code	= ($shotcode['code']);

					?>

						<tr>

                            <td class="manage-column column-cb check-column"></td>

                            <th>

                                <h2 class="title"><?php echo $title; ?></h2>        

                            </th>

                            <td>

                                <div class="yic_shortcode_desc"><?php echo $code; ?></div>

                            </td>

                        </tr>

					<?php

				}

			}

		?>

        <!--   

        <tr>

        	<td class="manage-column column-cb check-column"></td>

            <th>

            	<span class="importer-title">Create Idea </span>           

            </th>

            <td>

            	<span class="importer-desc">

                	[yic_show_widget class="yic_create_idea_widget" show_border="yes" border_color="006600" border_size="5" padding_top="10" padding_right="10" padding_bottom="5" padding_left="10" ]

                </span>

            </td>

        </tr>

    

        <tr>

                	

        	<td class="manage-column column-cb check-column"></td>

            

            <th>

            	<span class="importer-title">Recent Idea</span>            

            </th>

            <td>

            	<span class="importer-desc">

                	[yic_show_widget class="yic_recent_idea_widget" show_items="5" show_border="yes" border_color="006600" border_size="5" padding_top="10" padding_right="10" padding_bottom="5" padding_left="10"]

                </span>

            </td>

        </tr>

        -->

        

        

        <!--

        <tr class="importer-item">

        <td class="import-system">

        <span class="importer-title">Blogroll</span>

        <span class="importer-action"><a href="http://www.in1m.co/test/wp-admin/update.php?action=install-plugin&amp;plugin=opml-importer&amp;from=import&amp;_wpnonce=1da2ea6eec" class="install-now" data-slug="opml-importer" data-name="Blogroll" aria-label="Install Blogroll">Install Now</a> | <a href="http://www.in1m.co/test/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=opml-importer&amp;from=import&amp;TB_iframe=true&amp;width=772&amp;height=286" class="thickbox open-plugin-details-modal" aria-label="More information about Blogroll">Details</a></span>

        </td>

        <td class="desc">

        <span class="importer-desc">Import links in OPML format.</span>

        </td>

        </tr>

        <tr class="importer-item">

        <td class="import-system">

        <span class="importer-title">Categories and Tags Converter</span>

        <span class="importer-action"><a href="http://www.in1m.co/test/wp-admin/update.php?action=install-plugin&amp;plugin=wpcat2tag-importer&amp;from=import&amp;_wpnonce=e6d29acfe3" class="install-now" data-slug="wpcat2tag-importer" data-name="Categories and Tags Converter" aria-label="Install Categories and Tags Converter">Install Now</a> | <a href="http://www.in1m.co/test/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=wpcat2tag-importer&amp;from=import&amp;TB_iframe=true&amp;width=772&amp;height=286" class="thickbox open-plugin-details-modal" aria-label="More information about Categories and Tags Converter">Details</a></span>

        </td>

        <td class="desc">

        <span class="importer-desc">Convert existing categories to tags or tags to categories, selectively.</span>

        </td>

        </tr>

        <tr class="importer-item">

        <td class="import-system">

        <span class="importer-title">LiveJournal</span>

        <span class="importer-action"><a href="http://www.in1m.co/test/wp-admin/update.php?action=install-plugin&amp;plugin=livejournal-importer&amp;from=import&amp;_wpnonce=ae8491e3b6" class="install-now" data-slug="livejournal-importer" data-name="LiveJournal" aria-label="Install LiveJournal">Install Now</a> | <a href="http://www.in1m.co/test/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=livejournal-importer&amp;from=import&amp;TB_iframe=true&amp;width=772&amp;height=286" class="thickbox open-plugin-details-modal" aria-label="More information about LiveJournal">Details</a></span>

        </td>

        <td class="desc">

        <span class="importer-desc">Import posts from LiveJournal using their API.</span>

        </td>

        </tr>

        <tr class="importer-item">

        <td class="import-system">

        <span class="importer-title">Movable Type and TypePad</span>

        <span class="importer-action"><a href="http://www.in1m.co/test/wp-admin/update.php?action=install-plugin&amp;plugin=movabletype-importer&amp;from=import&amp;_wpnonce=568239c871" class="install-now" data-slug="movabletype-importer" data-name="Movable Type and TypePad" aria-label="Install Movable Type and TypePad">Install Now</a> | <a href="http://www.in1m.co/test/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=movabletype-importer&amp;from=import&amp;TB_iframe=true&amp;width=772&amp;height=286" class="thickbox open-plugin-details-modal" aria-label="More information about Movable Type and TypePad">Details</a></span>

        </td>

        <td class="desc">

        <span class="importer-desc">Import posts and comments from a Movable Type or TypePad blog.</span>

        </td>

        </tr>

        <tr class="importer-item">

        <td class="import-system">

        <span class="importer-title">RSS</span>

        <span class="importer-action"><a href="http://www.in1m.co/test/wp-admin/update.php?action=install-plugin&amp;plugin=rss-importer&amp;from=import&amp;_wpnonce=912bb111a7" class="install-now" data-slug="rss-importer" data-name="RSS" aria-label="Install RSS">Install Now</a> | <a href="http://www.in1m.co/test/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=rss-importer&amp;from=import&amp;TB_iframe=true&amp;width=772&amp;height=286" class="thickbox open-plugin-details-modal" aria-label="More information about RSS">Details</a></span>

        </td>

        <td class="desc">

        <span class="importer-desc">Import posts from an RSS feed.</span>

        </td>

        </tr>

        <tr class="importer-item">

        <td class="import-system">

        <span class="importer-title">Tumblr</span>

        <span class="importer-action"><a href="http://www.in1m.co/test/wp-admin/update.php?action=install-plugin&amp;plugin=tumblr-importer&amp;from=import&amp;_wpnonce=9e13508cbd" class="install-now" data-slug="tumblr-importer" data-name="Tumblr" aria-label="Install Tumblr">Install Now</a> | <a href="http://www.in1m.co/test/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=tumblr-importer&amp;from=import&amp;TB_iframe=true&amp;width=772&amp;height=286" class="thickbox open-plugin-details-modal" aria-label="More information about Tumblr">Details</a></span>

        </td>

        <td class="desc">

        <span class="importer-desc">Import posts &amp; media from Tumblr using their API.</span>

        </td>

        </tr>

        <tr class="importer-item">

        <td class="import-system">

        <span class="importer-title">WordPress</span>

        <span class="importer-action"><a href="http://www.in1m.co/test/wp-admin/update.php?action=install-plugin&amp;plugin=wordpress-importer&amp;from=import&amp;_wpnonce=e37d653d39" class="install-now" data-slug="wordpress-importer" data-name="WordPress" aria-label="Install WordPress">Install Now</a> | <a href="http://www.in1m.co/test/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=wordpress-importer&amp;from=import&amp;TB_iframe=true&amp;width=772&amp;height=286" class="thickbox open-plugin-details-modal" aria-label="More information about WordPress">Details</a></span>

        </td>

        <td class="desc">

        <span class="importer-desc">Import posts, pages, comments, custom fields, categories, and tags from a WordPress export file.</span>

        </td>

        </tr>

        -->

    </tbody>

</table>