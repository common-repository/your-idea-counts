<?php
	if ( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
	

	add_shortcode( 'yic_show_widget', 'yic_show_widget_func' );
	function yic_show_widget_func( $atts ) {

		//return "class = {$atts['class']}";
		
		ob_start();

		if(isset($atts['class']) && !empty($atts['class']) && class_exists($atts['class'])){

			$instance	= array();

			if(!empty($atts['title'])){

				$instance['title']	= $atts['title'];

			}

			

			if(!empty($atts['show_items'])){

				$instance['total_show_item']	= $atts['show_items'];

			}

			

			if(!empty($atts['show_border'])){

				$instance['show_border']	= $atts['show_border'];

			}

			

			if(!empty($atts['border_color'])){

				$instance['border_color']	= $atts['border_color'];

			}

			

			if(!empty($atts['border_size'])){

				$instance['border_size']	= $atts['border_size'];

			}else{
				$instance['border_size']	= 1;
			}

			

			if(!empty($atts['padding_top'])){

				$instance['padding_top']	= $atts['padding_top'];

			}

			

			if(!empty($atts['padding_right'])){

				$instance['padding_right']	= $atts['padding_right'];

			}

			

			if(!empty($atts['padding_bottom'])){

				$instance['padding_bottom']	= $atts['padding_bottom'];

			}

			

			if(!empty($atts['padding_left'])){

				$instance['padding_left']	= $atts['padding_left'];

			}

			

			

			//yes

			

			//$total_show_item	= !empty( $instance['total_show_item'] ) ? $instance['total_show_item'] : 5 ;  

	



			//$show_border		= (isset($instance['show_border']) && !empty($instance['show_border'])) ? true : false ;

		

			

		

			//$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'FFFFFF'; 

		

			//$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;

		

			

		

			//$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;

		

			//$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;

		

			//$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 

		

			//$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 

			

			



			echo '<div class="yic-section-outer">';

				//$instance

				//the_widget( $atts['class'], $instance );

				the_widget( $atts['class'], $instance );



			echo '</div>';



		}



		return ob_get_clean();



	}



	
	
	
	
	///////////// start Add shotcode for create idea ///////////////////////////
	add_shortcode( 'create_idea', 'yic_show_create_idea_widget_func' );
	function yic_show_create_idea_widget_func( $atts ) {
		
		ob_start();

			$instance	= array();
			
			if(!empty($atts['title'])){
				
				$instance['title']	= $atts['title'];

			}

			
			

			if(!empty($atts['show_border'])){

				$instance['show_border']	= $atts['show_border'];

			}

			

			if(!empty($atts['border_color'])){

				$instance['border_color']	= $atts['border_color'];

			}

			

			if(!empty($atts['border_size'])){

				$instance['border_size']	= $atts['border_size'];

			}else{
				$instance['border_size']	= 1;
			}

			

			if(!empty($atts['padding_top'])){

				$instance['padding_top']	= $atts['padding_top'];

			}

			

			if(!empty($atts['padding_right'])){

				$instance['padding_right']	= $atts['padding_right'];

			}

			

			if(!empty($atts['padding_bottom'])){

				$instance['padding_bottom']	= $atts['padding_bottom'];

			}

			

			if(!empty($atts['padding_left'])){

				$instance['padding_left']	= $atts['padding_left'];

			}

			

			echo '<div class="yic-section-outer">';

				the_widget( 'yic_create_idea_widget', $instance );

			echo '</div>';





		return ob_get_clean();



	}
	
	///////////// End Add shotcode for create idea ///////////////////////////
	
	
	
	///////////// start Add shotcode for recent ideas ///////////////////////////
	
	add_shortcode( 'recent_ideas', 'yic_show_recent_ideas_widget_func' );
	function yic_show_recent_ideas_widget_func( $atts ) {
		
		ob_start();

			$instance	= array();
			
			if(!empty($atts['title'])){
				
				$instance['title']	= $atts['title'];

			}

			

			if(!empty($atts['show_items'])){

				$instance['total_show_item']	= $atts['show_items'];

			}

			

			if(!empty($atts['show_border'])){

				$instance['show_border']	= $atts['show_border'];

			}

			

			if(!empty($atts['border_color'])){

				$instance['border_color']	= $atts['border_color'];

			}

			

			if(!empty($atts['border_size'])){

				$instance['border_size']	= $atts['border_size'];

			}else{
				$instance['border_size']	= 1;
			}

			

			if(!empty($atts['padding_top'])){

				$instance['padding_top']	= $atts['padding_top'];

			}

			

			if(!empty($atts['padding_right'])){

				$instance['padding_right']	= $atts['padding_right'];

			}

			

			if(!empty($atts['padding_bottom'])){

				$instance['padding_bottom']	= $atts['padding_bottom'];

			}

			

			if(!empty($atts['padding_left'])){

				$instance['padding_left']	= $atts['padding_left'];

			}

			

			echo '<div class="yic-section-outer">';

				the_widget( 'yic_recent_idea_widget', $instance );

			echo '</div>';


		return ob_get_clean();

	}
	///////////// End Add shotcode for Recent ideas ///////////////////////////
	
	
	
	///////////// start Add shotcode for browse ideas ///////////////////////////

	add_shortcode( 'browse_ideas', 'yic_show_browse_ideas_widget_func' );
	function yic_show_browse_ideas_widget_func( $atts ) {
		
		ob_start();

			$instance	= array();
			
			if(!empty($atts['title'])){
				
				$instance['title']	= $atts['title'];

			}

			

			if(!empty($atts['show_items'])){

				$instance['total_show_item']	= $atts['show_items'];

			}

			

			if(!empty($atts['show_border'])){

				$instance['show_border']	= $atts['show_border'];

			}

			

			if(!empty($atts['border_color'])){

				$instance['border_color']	= $atts['border_color'];

			}

			

			if(!empty($atts['border_size'])){

				$instance['border_size']	= $atts['border_size'];

			}else{
				$instance['border_size']	= 1;
			}

			

			if(!empty($atts['padding_top'])){

				$instance['padding_top']	= $atts['padding_top'];

			}

			

			if(!empty($atts['padding_right'])){

				$instance['padding_right']	= $atts['padding_right'];

			}

			

			if(!empty($atts['padding_bottom'])){

				$instance['padding_bottom']	= $atts['padding_bottom'];

			}

			

			if(!empty($atts['padding_left'])){

				$instance['padding_left']	= $atts['padding_left'];

			}

			

			echo '<div class="yic-section-outer">';

				the_widget( 'yic_browse_report_widget', $instance );

			echo '</div>';


		return ob_get_clean();

	}
	///////////// End Add shotcode for browse ideas ///////////////////////////
	
	
	///////////// start Add shotcode for idea tag cloud ///////////////////////////

	add_shortcode( 'idea_tag_cloud', 'yic_show_tag_cloud_widget_func' );
	function yic_show_tag_cloud_widget_func( $atts ) {
		
		ob_start();

			$instance	= array();
			
			if(!empty($atts['title'])){
				
				$instance['title']	= $atts['title'];

			}
			
			if(!empty($atts['items_per_page'])){
				
				$instance['items_per_page']	= $atts['items_per_page'];

			}
			

			if(!empty($atts['show_border'])){

				$instance['show_border']	= $atts['show_border'];

			}else{
				
				$instance['show_border'] = 'yes';
				
			}

			

			if(!empty($atts['border_color'])){

				$instance['border_color']	= $atts['border_color'];

			}else{
				
				$instance['border_color'] = 'bdbdbd';
				
			}

			

			if(!empty($atts['border_size'])){

				$instance['border_size']	= $atts['border_size'];

			}else{
				$instance['border_size']	= 1;
			}

			

			if(!empty($atts['padding_top'])){

				$instance['padding_top']	= $atts['padding_top'];

			}

			

			if(!empty($atts['padding_right'])){

				$instance['padding_right']	= $atts['padding_right'];

			}

			

			if(!empty($atts['padding_bottom'])){

				$instance['padding_bottom']	= $atts['padding_bottom'];

			}

			

			if(!empty($atts['padding_left'])){

				$instance['padding_left']	= $atts['padding_left'];

			}

			

			echo '<div class="yic-section-outer widget_yic_tag_cloud">';

				the_widget( 'yic_tag_cloud_widget', $instance );

			echo '</div>';


		return ob_get_clean();

	}
	///////////// End Add shotcode for idea tag cloud ///////////////////////////
	
	
	
	///////////// start Add shotcode for view default template ///////////////////////////

	add_shortcode( 'view_idea_template', 'yic_view_idea_template_func' );
	function yic_view_idea_template_func( $atts ) {
		
		ob_start();
			include(YIC_IDEA_PLUGIN_DIR . '/templates/view_idea_template.php');
		return ob_get_clean();

	}
	///////////// End Add shotcode for  view default template ///////////////////////////
	
?>