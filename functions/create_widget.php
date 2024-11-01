<?php
if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly.
}

/**
 * This file will create a two widgets. one is for creat ideas and second is for showing recent ideas upto 10 limit. here one button is also created which will show all ideas while we click on that.
 */
class yic_create_idea_widget extends WP_Widget {
  // Set up the widget name and description.
  public function __construct() 
  {
    $widget_options = array( 'classname' => 'yic_create_idea', 'description' => 'We want to hear from you!' );
    parent::__construct( 'create_idea', 'Ideas: Create An Idea', $widget_options );
  }
  // Create the widget output.
  public function widget( $args, $instance ) 
  {
     echo $args['before_widget'];
	if ( ! empty( $instance['title'] ) ) {
		echo '<div class="yic-widget-title">';
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		echo '</div>';
	}
	
	
	
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$style  = '';
	$style .= 'padding-top:'.$padding_top.'px;';
	$style .= 'padding-right:'.$padding_right.'px;';
	$style .= 'padding-bottom:'.$padding_bottom.'px;';
	$style .= 'padding-left:'.$padding_left.'px;';
	
	if($show_border){
		$style .= 'border-width:'.$border_size.'px;';
		$style .= 'border-style:solid;';
		$style .= 'border-color:#'.$border_color.';';
	}
	
	?>
		<div class="yic-widget-contener" style=" <?php echo $style;?>">
        	<?php echo yic_create_idea();?>
        </div>
	<?php
    echo $args['after_widget'];
  }
  
  // Create the admin area widget settings form.
  public function form( $instance ){
		
	$default_title	= "Leave blank for no title or consider entering Create Idea as the title";
    $title 			= ! empty( $instance['title'] ) ? $instance['title'] : ''; 
	
	
	
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$show_border_check	= ($show_border) ? ' checked="checked" ' : '';
	
	
	?>
    <p>
      <?php /*?><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: <span>[<strong>Suggestion:</strong> <?php echo $default_title;?>]</span></label><?php */?>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" style="width:80%;" />      
    </p>
	
        
        <p>
            <input class="checkbox" id="<?php echo $this->get_field_id( 'show_border' ); ?>" name="<?php echo $this->get_field_name( 'show_border' ); ?>" type="checkbox" value="yes" <?php echo $show_border_check;?> >
            <label for="<?php echo $this->get_field_id( 'show_border' ); ?>">Show border?</label>
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_color' ); ?>">Border Color:</label>
            <input type="text" class=" yic-small-text" id="<?php echo $this->get_field_id( 'border_color' ); ?>" name="<?php echo $this->get_field_name( 'border_color' ); ?>" value="<?php echo esc_attr( $border_color ); ?>" />
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_size' ); ?>">Border Size:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'border_size' ); ?>" name="<?php echo $this->get_field_name( 'border_size' ); ?>" value="<?php echo esc_attr( $border_size ); ?>" /> px
        </p>
        
        
        <p>
        	<label>Padding Option:</label>
        </p>
        
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_top' ); ?>">Padding-top:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_top' ); ?>" name="<?php echo $this->get_field_name( 'padding_top' ); ?>" value="<?php echo esc_attr( $padding_top ); ?>" /> px
        </p>
                
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_right' ); ?>">Padding-right:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_right' ); ?>" name="<?php echo $this->get_field_name( 'padding_right' ); ?>" value="<?php echo esc_attr( $padding_right ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_bottom' ); ?>">Padding-bottom:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_bottom' ); ?>" name="<?php echo $this->get_field_name( 'padding_bottom' ); ?>" value="<?php echo esc_attr( $padding_bottom ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_left' ); ?>">Padding-left:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_left' ); ?>" name="<?php echo $this->get_field_name( 'padding_left' ); ?>" value="<?php echo esc_attr( $padding_left ); ?>" /> px
        </p>
	
	<?php
  }
  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance 				= $old_instance;
    $instance[ 'title' ] 	= strip_tags( $new_instance[ 'title' ] );
	
	
	if(isset($new_instance[ 'show_border' ])){
		$instance['show_border'] 	= strip_tags( $new_instance[ 'show_border' ] );
	}elseif(isset($instance['show_border'])){
		unset($instance['show_border']);
	}
	
    $instance[ 'border_color' ] 	= strip_tags( $new_instance[ 'border_color' ] );
    $instance[ 'border_size' ] 		= strip_tags( $new_instance[ 'border_size' ] );
	
    $instance[ 'padding_top' ] 		= strip_tags( $new_instance[ 'padding_top' ] );
    $instance[ 'padding_right' ]	= strip_tags( $new_instance[ 'padding_right' ] );
    $instance[ 'padding_bottom' ]	= strip_tags( $new_instance[ 'padding_bottom' ] );
    $instance[ 'padding_left' ]		= strip_tags( $new_instance[ 'padding_left' ] );
	
    return $instance;
  }
}
// Register the create idea form widget.


/* create widget for recent idea */
class yic_recent_idea_widget extends WP_Widget {
  // Set up the widget name and description.
  public function __construct(){
    $widget_options = array( 'classname' => 'yic_recent_idea', 'description' => 'The creative juices keep flowing' );
    parent::__construct( 'yic_recent_idea', 'Ideas: Recent Ideas', $widget_options );
  }
  // Create the widget output.
  public function widget( $args, $instance ){
    echo $args['before_widget'];
	//if ( ! empty( $instance['title'] ) ) {
//		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
//	}
	
	if ( empty( $instance['title'] ) ) {
		$instance['title'] = "Recent Ideas";
	}
//	
//	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
	
	
	$total_show_item	= !empty( $instance['total_show_item'] ) ? $instance['total_show_item'] : 5 ;  
	
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$style  = '';
	$style .= 'padding-top:'.$padding_top.'px;';
	$style .= 'padding-right:'.$padding_right.'px;';
	$style .= 'padding-bottom:'.$padding_bottom.'px;';
	$style .= 'padding-left:'.$padding_left.'px;';
	
	if($show_border){
		$style .= 'border-width:'.$border_size.'px;';
		$style .= 'border-style:solid;';
		$style .= 'border-color:#'.$border_color.';';
	}
	
	/*
	?>
		<!--<div class="yic-widget-contener" style="padding-top:5px; padding-right:5px; padding-bottom:5px; padding-left:5px; border-width:1px; border-style:solid; border-color:#bdbdbd;">-->
        <div class="yic-widget-contener" style=" <?php echo $style;?>">
			<?php echo yic_get_recent_ideas($total_show_item); ?>
		</div>
	<?php*/
		echo yic_get_recent_ideas($total_show_item, $instance['title'], $style);
	
	
    echo $args['after_widget'];
  }
  
  // Create the admin area widget settings form.
  public function form( $instance ){
    
   // $default_title 		= "Recent Ideas";
	$default_title 		= "Leave blank for no title or consider entering Recent Ideas as the title";
    $title 				= !empty( $instance['title'] ) ? $instance['title'] : 'Recent Ideas'; 
	
	
	$total_show_item	= !empty( $instance['total_show_item'] ) ? $instance['total_show_item'] : 5;  
	
	
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	//var_dump($instance['show_border']);
	//var_dump($instance['border_color']);
	if($instance['border_color'] === NULL){
		$show_border	= true;
	}
	
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$show_border_check	= ($show_border) ? ' checked="checked" ' : '';
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: <?php /*?><span>[<strong>Suggestion:</strong> <?php echo $default_title;?>]</span><?php */?></label>            
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />            
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'total_show_item' ); ?>">Number of ideas shown at a time:</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'total_show_item' ); ?>" name="<?php echo $this->get_field_name( 'total_show_item' ); ?>" step="1" min="1" value="<?php echo $total_show_item;?>" size="3" type="number">
            <span id="err_msg_<?php echo $this->get_field_id( 'total_show_item' ); ?>" style="color:#F70B0F; display:block;"></span>
        </p>
        
        <p>
            <input class="checkbox" id="<?php echo $this->get_field_id( 'show_border' ); ?>" name="<?php echo $this->get_field_name( 'show_border' ); ?>" type="checkbox" value="yes" <?php echo $show_border_check;?> >
            <label for="<?php echo $this->get_field_id( 'show_border' ); ?>">Show border?</label>
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_color' ); ?>">Border Color:</label>
            <input type="text" class=" yic-small-text" id="<?php echo $this->get_field_id( 'border_color' ); ?>" name="<?php echo $this->get_field_name( 'border_color' ); ?>" value="<?php echo esc_attr( $border_color ); ?>" />
                	
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_size' ); ?>">Border Size:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'border_size' ); ?>" name="<?php echo $this->get_field_name( 'border_size' ); ?>" value="<?php echo esc_attr( $border_size ); ?>" /> px
        </p>
        
        
        <p>
        	<label>Padding Option:</label>
        </p>
        
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_top' ); ?>">Padding-top:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_top' ); ?>" name="<?php echo $this->get_field_name( 'padding_top' ); ?>" value="<?php echo esc_attr( $padding_top ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_right' ); ?>">Padding-right:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_right' ); ?>" name="<?php echo $this->get_field_name( 'padding_right' ); ?>" value="<?php echo esc_attr( $padding_right ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_bottom' ); ?>">Padding-bottom:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_bottom' ); ?>" name="<?php echo $this->get_field_name( 'padding_bottom' ); ?>" value="<?php echo esc_attr( $padding_bottom ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_left' ); ?>">Padding-left:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_left' ); ?>" name="<?php echo $this->get_field_name( 'padding_left' ); ?>" value="<?php echo esc_attr( $padding_left ); ?>" /> px
        </p>
        
        <script>
        	jQuery(document).ready(function($){
                $(document).on('change', '#<?php echo $this->get_field_id( 'total_show_item' ); ?>', function(){
					var total_show_item = $(this).val().trim();
					
					$('#err_msg_<?php echo $this->get_field_id( 'total_show_item' ); ?>').html('');
					
					if(total_show_item == "" || (!isNaN(total_show_item) && total_show_item < 1 ) ){
						$(this).val(1);
						var msg = '( <strong>Number of ideas shown</strong> should be at least 1 )';
						$('#err_msg_<?php echo $this->get_field_id( 'total_show_item' ); ?>').html(msg);
					}
				});
            });
        </script>
        
	<?php
  }
  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
	  
    $instance 						= $old_instance;
    $instance[ 'title' ] 			= strip_tags( $new_instance[ 'title' ] );
    $instance[ 'total_show_item' ] 	= strip_tags( $new_instance[ 'total_show_item' ] );
	
	if(isset($new_instance[ 'show_border' ])){
		$instance['show_border'] 	= strip_tags( $new_instance[ 'show_border' ] );
	}elseif(isset($instance['show_border'])){
		unset($instance['show_border']);
	}
	
    $instance[ 'border_color' ] 	= strip_tags( $new_instance[ 'border_color' ] );
    $instance[ 'border_size' ] 		= strip_tags( $new_instance[ 'border_size' ] );
	
    $instance[ 'padding_top' ] 		= strip_tags( $new_instance[ 'padding_top' ] );
    $instance[ 'padding_right' ]	= strip_tags( $new_instance[ 'padding_right' ] );
    $instance[ 'padding_bottom' ]	= strip_tags( $new_instance[ 'padding_bottom' ] );
    $instance[ 'padding_left' ]		= strip_tags( $new_instance[ 'padding_left' ] );
	
	
    return $instance;
	
  }
}
// Register the create idea form widget.



/////////// Widget for Browse Report //////////
class yic_browse_report_widget extends WP_Widget {
  // Set up the widget name and description.
  public function __construct() 
  {
    $widget_options = array( 'classname' => 'yic_browse_report', 'description' => 'Browse ideas any way you like' );
    parent::__construct( 'yic_browse_report', 'Ideas: Browse Ideas', $widget_options );
  }
  // Create the widget output.
  public function widget( $args, $instance ){
    echo $args['before_widget'];
	if ( ! empty( $instance['title'] ) ) {
		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
	}
	
	$total_show_item	= !empty( $instance['total_show_item'] ) ? $instance['total_show_item'] : 25 ;  
	
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$style  = '';
	$style .= 'padding-top:'.$padding_top.'px;';
	$style .= 'padding-right:'.$padding_right.'px;';
	$style .= 'padding-bottom:'.$padding_bottom.'px;';
	$style .= 'padding-left:'.$padding_left.'px;';
	
	if($show_border){
		$style .= 'border-width:'.$border_size.'px;';
		$style .= 'border-style:solid;';
		$style .= 'border-color:#'.$border_color.';';
	}
	
	
	?>
		<!--<div class="yic-widget-contener" style="padding-top:5px; padding-right:5px; padding-bottom:5px; padding-left:5px; border-width:1px; border-style:solid; border-color:#bdbdbd;">-->
        <div class="yic-widget-contener" style=" <?php echo $style;?>">
			<?php echo yic_get_browse_report($total_show_item); ?>
		</div>
	<?php
	
    echo $args['after_widget'];
  }
  
  // Create the admin area widget settings form.
  public function form( $instance ){
	$default_title 		= "Leave blank for no title or consider entering Browse Ideas as the title";
    $title 				= !empty( $instance['title'] ) ? $instance['title'] : ''; 
	$total_show_item	= !empty( $instance['total_show_item'] ) ? $instance['total_show_item'] : 25;  
	
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$show_border_check	= ($show_border) ? ' checked="checked" ' : '';
	?>
        <p>
            <?php /*?><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: <span>[<strong>Suggestion:</strong> <?php echo $default_title;?>]</span></label><?php */?>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'total_show_item' ); ?>">Number of ideas shown at a time:</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'total_show_item' ); ?>" name="<?php echo $this->get_field_name( 'total_show_item' ); ?>" step="1" min="1" value="<?php echo $total_show_item;?>" size="3" type="number">
            <span id="err_msg_<?php echo $this->get_field_id( 'total_show_item' ); ?>" style="color:#F70B0F; display:block;"></span>
        </p>
        
        <p>
            <input class="checkbox" id="<?php echo $this->get_field_id( 'show_border' ); ?>" name="<?php echo $this->get_field_name( 'show_border' ); ?>" type="checkbox" value="yes" <?php echo $show_border_check;?> >
            <label for="<?php echo $this->get_field_id( 'show_border' ); ?>">Show border?</label>
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_color' ); ?>">Border Color:</label>
            <input type="text" class=" yic-small-text" id="<?php echo $this->get_field_id( 'border_color' ); ?>" name="<?php echo $this->get_field_name( 'border_color' ); ?>" value="<?php echo esc_attr( $border_color ); ?>" />
                	
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_size' ); ?>">Border Size:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'border_size' ); ?>" name="<?php echo $this->get_field_name( 'border_size' ); ?>" value="<?php echo esc_attr( $border_size ); ?>" /> px
        </p>
        
        
        <p>
        	<label>Padding Option:</label>
        </p>
        
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_top' ); ?>">Padding-top:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_top' ); ?>" name="<?php echo $this->get_field_name( 'padding_top' ); ?>" value="<?php echo esc_attr( $padding_top ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_right' ); ?>">Padding-right:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_right' ); ?>" name="<?php echo $this->get_field_name( 'padding_right' ); ?>" value="<?php echo esc_attr( $padding_right ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_bottom' ); ?>">Padding-bottom:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_bottom' ); ?>" name="<?php echo $this->get_field_name( 'padding_bottom' ); ?>" value="<?php echo esc_attr( $padding_bottom ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_left' ); ?>">Padding-left:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_left' ); ?>" name="<?php echo $this->get_field_name( 'padding_left' ); ?>" value="<?php echo esc_attr( $padding_left ); ?>" /> px
        </p>
        
        
        
        <script>
        	jQuery(document).ready(function($){
                $(document).on('change', '#<?php echo $this->get_field_id( 'total_show_item' ); ?>', function(){
					var total_show_item = $(this).val().trim();
					
					$('#err_msg_<?php echo $this->get_field_id( 'total_show_item' ); ?>').html('');
					
					if(total_show_item == "" || (!isNaN(total_show_item) && total_show_item < 1 ) ){
						$(this).val(1);
						var msg = '( <strong>Number of ideas shown</strong> should be at least 1 )';
						$('#err_msg_<?php echo $this->get_field_id( 'total_show_item' ); ?>').html(msg);
					}
				});
            });
        </script>
        
        
	<?php
  }
  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
	  
    $instance 						= $old_instance;
    $instance[ 'title' ] 			= strip_tags( $new_instance[ 'title' ] );
    $instance[ 'total_show_item' ] 	= strip_tags( $new_instance[ 'total_show_item' ] );
	
	if(isset($new_instance[ 'show_border' ])){
		$instance['show_border'] 	= strip_tags( $new_instance[ 'show_border' ] );
	}elseif(isset($instance['show_border'])){
		unset($instance['show_border']);
	}
	
    $instance[ 'border_color' ] 	= strip_tags( $new_instance[ 'border_color' ] );
    $instance[ 'border_size' ] 		= strip_tags( $new_instance[ 'border_size' ] );
	
    $instance[ 'padding_top' ] 		= strip_tags( $new_instance[ 'padding_top' ] );
    $instance[ 'padding_right' ]	= strip_tags( $new_instance[ 'padding_right' ] );
    $instance[ 'padding_bottom' ]	= strip_tags( $new_instance[ 'padding_bottom' ] );
    $instance[ 'padding_left' ]		= strip_tags( $new_instance[ 'padding_left' ] );
	
	
    return $instance;
	
  }
}
// Register the create idea form widget.



/////////// Widget for Tag Cloud //////////
class yic_tag_cloud_widget extends WP_Widget {
	
  // Set up the widget name and description.
  public function __construct() 
  {
    $widget_options = array( 'classname' => 'yic_tag_cloud', 'description' => 'Easily find popular ideas' );
    parent::__construct( 'yic_tag_cloud', 'Ideas: Tag Cloud', $widget_options );
  }
  // Create the widget output.
  public function widget( $args, $instance ){
    echo $args['before_widget'];
	
	$title	= 'Tag Cloud';
	if ( !empty( $instance['title'] ) ) {
		//$title		=  $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		$title			=  $instance['title'];
	}
		
	$items_per_page	= !empty( $instance['items_per_page'] ) ? $instance['items_per_page'] : 25 ; 
	
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$style  = '';
	$style .= 'padding-top:'.$padding_top.'px;';
	$style .= 'padding-right:'.$padding_right.'px;';
	$style .= 'padding-bottom:'.$padding_bottom.'px;';
	$style .= 'padding-left:'.$padding_left.'px;';
	
	if($show_border){
		$style .= 'border-width:'.$border_size.'px;';
		$style .= 'border-style:solid;';
		$style .= 'border-color:#'.$border_color.';';
	}
	
	
	?>
		<!--<div class="yic-widget-contener" style="padding-top:5px; padding-right:5px; padding-bottom:5px; padding-left:5px; border-width:1px; border-style:solid; border-color:#bdbdbd;">-->
        <?php /*?><div class="yic-widget-contener" style=" <?php echo $style;?>"><?php */?>
			<?php echo yic_show_tag_cloud($title,$items_per_page, $style); ?>
		<?php /*?></div><?php */?>
	<?php
	
    echo $args['after_widget'];
  }
  
  // Create the admin area widget settings form.
  public function form( $instance ){
	$default_title 		= "Leave blank for no title or consider entering Tag Cloud as the title";
    $title 				= !empty( $instance['title'] ) ? $instance['title'] : 'Tag Cloud';  
	$items_per_page		= !empty( $instance['items_per_page'] ) ? $instance['items_per_page'] : 25;  
	$show_border		= (isset($instance['show_border']) && !empty($instance['show_border']) && $instance['show_border'] == 'yes') ? true : false ;
	
	//var_dump($instance['show_border']);
	//var_dump($instance['border_color']);
	if($instance['border_color'] === NULL){
		$show_border	= true;
	}
	
	
	
	$border_color		= !empty( $instance['border_color'] ) ? $instance['border_color'] : 'bdbdbd'; 
	$border_size		= !empty( $instance['border_size'] ) ? $instance['border_size'] : 1;
	$padding_top		= !empty( $instance['padding_top'] ) ? $instance['padding_top'] : 0;
	$padding_right		= !empty( $instance['padding_right'] ) ? $instance['padding_right'] : 0;
	$padding_bottom		= !empty( $instance['padding_bottom'] ) ? $instance['padding_bottom'] : 0; 
	$padding_left		= !empty( $instance['padding_left'] ) ? $instance['padding_left'] : 0; 
	
	$show_border_check	= ($show_border) ? ' checked="checked" ' : '';
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: <?php /*?><span>[<strong>Suggestion:</strong> <?php echo $default_title;?>]</span><?php */?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'items_per_page' ); ?>">Number of tags shown at a time:</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'items_per_page' ); ?>" name="<?php echo $this->get_field_name( 'items_per_page' ); ?>" step="1" min="1" value="<?php echo $items_per_page;?>" size="3" type="number">
            <span id="err_msg_<?php echo $this->get_field_id( 'items_per_page' ); ?>" style="color:#F70B0F; display:block;"></span>
        </p>
        
        <p>
            <input class="checkbox" id="<?php echo $this->get_field_id( 'show_border' ); ?>" name="<?php echo $this->get_field_name( 'show_border' ); ?>" type="checkbox" value="yes" <?php echo $show_border_check;?> >
            <label for="<?php echo $this->get_field_id( 'show_border' ); ?>">Show border?</label>
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_color' ); ?>">Border Color:</label>
            <input type="text" class=" yic-small-text" id="<?php echo $this->get_field_id( 'border_color' ); ?>" name="<?php echo $this->get_field_name( 'border_color' ); ?>" value="<?php echo esc_attr( $border_color ); ?>" />
                	
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'border_size' ); ?>">Border Size:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'border_size' ); ?>" name="<?php echo $this->get_field_name( 'border_size' ); ?>" value="<?php echo esc_attr( $border_size ); ?>" /> px
        </p>
        
        
        <p>
        	<label>Padding Option:</label>
        </p>
        
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_top' ); ?>">Padding-top:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_top' ); ?>" name="<?php echo $this->get_field_name( 'padding_top' ); ?>" value="<?php echo esc_attr( $padding_top ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_right' ); ?>">Padding-right:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_right' ); ?>" name="<?php echo $this->get_field_name( 'padding_right' ); ?>" value="<?php echo esc_attr( $padding_right ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_bottom' ); ?>">Padding-bottom:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_bottom' ); ?>" name="<?php echo $this->get_field_name( 'padding_bottom' ); ?>" value="<?php echo esc_attr( $padding_bottom ); ?>" /> px
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id( 'padding_left' ); ?>">Padding-left:</label>
            <input type="number" class="tiny-text" id="<?php echo $this->get_field_id( 'padding_left' ); ?>" name="<?php echo $this->get_field_name( 'padding_left' ); ?>" value="<?php echo esc_attr( $padding_left ); ?>" /> px
        </p>
        
        
        
        <script>
        	jQuery(document).ready(function($){
                $(document).on('change', '#<?php echo $this->get_field_id( 'items_per_page' ); ?>', function(){
					var total_show_item = $(this).val().trim();
					
					$('#err_msg_<?php echo $this->get_field_id( 'items_per_page' ); ?>').html('');
					
					if(total_show_item == "" || (!isNaN(total_show_item) && total_show_item < 1 ) ){
						$(this).val(1);
						var msg = '( <strong>Number of tags</strong> should be at least 1 )';
						$('#err_msg_<?php echo $this->get_field_id( 'items_per_page' ); ?>').html(msg);
					}
				});
            });
        </script>
        
        
	<?php
  }
  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
	  
    $instance 						= $old_instance;
    $instance[ 'title' ] 			= strip_tags( $new_instance[ 'title' ] );
    $instance[ 'items_per_page' ] 	= strip_tags( $new_instance[ 'items_per_page' ] );
	
	if(isset($new_instance[ 'show_border' ])){
		$instance['show_border'] 	= strip_tags( $new_instance[ 'show_border' ] );
	}elseif(isset($instance['show_border'])){
		unset($instance['show_border']);
	}
	
    $instance[ 'border_color' ] 	= strip_tags( $new_instance[ 'border_color' ] );
    $instance[ 'border_size' ] 		= strip_tags( $new_instance[ 'border_size' ] );
	
    $instance[ 'padding_top' ] 		= strip_tags( $new_instance[ 'padding_top' ] );
    $instance[ 'padding_right' ]	= strip_tags( $new_instance[ 'padding_right' ] );
    $instance[ 'padding_bottom' ]	= strip_tags( $new_instance[ 'padding_bottom' ] );
    $instance[ 'padding_left' ]		= strip_tags( $new_instance[ 'padding_left' ] );
	
	
    return $instance;
	
  }

}
// Register the create idea form widget.




function yic_widget_register() { 
	register_widget( 'yic_create_idea_widget' );
	register_widget( 'yic_recent_idea_widget' );
	register_widget( 'yic_browse_report_widget' );
	register_widget( 'yic_tag_cloud_widget' );
}
add_action( 'widgets_init', 'yic_widget_register' );
?>