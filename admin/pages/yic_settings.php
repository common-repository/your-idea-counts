 <?php
 	if( ! defined( 'ABSPATH' ) ){
		exit; // Exit if accessed directly.
	}
 ?>
 
 

<?php global $wpdb;?>


<?php

function yic_set_default_editor() {
	$r = 'html';
	return $r;
}

add_filter( 'wp_default_editor', 'yic_set_default_editor' );


$setting_url = admin_url("edit.php?post_type=yic_idea&page=idea-settings");

////////////// Start manage active tab class ///////////////////////////

$yic_shotcode_cls_list_li 	= 'active';
$yic_shotcode_cls_list_tab 	= 'in active';
////////////// End manage active tab class ///////////////////////////

?>
<script>
	var button_icon_url = '<?php echo YIC_IDEA_PLUGIN_URL.'images/Calendar-icon.png';?>';
</script>

 <div class="wrap">

    <!-- <nav class="navbar navbar-inverse navbar-fixed-top">-->
    
        <div class="container-fluid">

            <div class="navbar-header">

               <!-- <a class="navbar-brand" href="#"><strong>Settinga</strong></a>-->

               <h1 class="wp-heading-inline">Shortcodes</h1>
            </div>
        </div>



    <!--</nav>-->


    <div class="yic_wrapper">







        <!--Tab navigation start here-->



        <ul class="nav nav-tabs">

            <li class="<?php echo $yic_shotcode_cls_list_li;?>"><a href="#yic_shotcode_list">Shortcodes</a></li>            

        </ul>



        <!--Tab navigation end here-->


         <!--Tab content start here-->



        <div class="tab-content">
        
            <!--Shotcode List panel start here-->
            <div id="yic_shotcode_list" class="tab-pane fade <?php echo $yic_shotcode_cls_list_tab;?>">
            	<?php include_once('settings-tab/yic_shotcode_list_tab.php');?>
            </div>
            <!--Shotcode List panel end here-->

            
        </div>



         <!--Tab content end here-->



    </div>

</div>