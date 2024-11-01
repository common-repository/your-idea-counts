<?php
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
	
	//get_header();
	$template_content_result = yic_get_idea_template();
?>

<?php /*?><h1 class="entry-title"><?php echo $template_content_result->template_name;?></h1><?php */?>
<div class="yic-container">
    <div class="text_editor">
    	<?php echo apply_filters('the_content', $template_content_result->content);?>
    </div>
</div>


    <?php /*?><div class="container">  
        <div id="primary" class="content-area fullwidth">
            <main id="main" class="site-main" role="main">             
                <article id="post-561" class="post-561 page type-page status-publish hentry clearfix">
                    <header class="entry-header">
                    	<h1 class="entry-title"><?php echo $template_content_result->template_name;?></h1>
                    </header><!-- .entry-header -->
                
                    <div class="entry-content">
                    <!-- .entry-content -->
                    	<?php echo apply_filters('the_content', $template_content_result->content);?>
                    </div>	
                
                </article>            
            </main><!-- #main -->
        <!-- #primary --> 
        </div>
    </div>
<?php */?>
<?php //get_footer();?>

