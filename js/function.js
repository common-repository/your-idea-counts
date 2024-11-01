/*FUNCTION JS*/
/* Date picker start here*/
        jQuery(document).ready(function() {
			
			if(document.querySelector('input[name="date"]')){
				
				/*var date_input = $('input[name="date"]'); //our date input has the name "date"
				var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
				date_input.datepicker({
					//format: 'mm/dd/yyyy',
					format: 'yyyy-mm-dd',
					container: container,
					todayHighlight: true,
					autoclose: true,
					orientation: "top" // add this
				});*/
				
			   /*$('input[name="date"]' ).datepicker({
				  showOn: "button",
				  buttonImage: "images/calendar.gif",
				  buttonImageOnly: true,
				  buttonText: "Select date"
				});*/
				
				
			}
			
        });
/* Date picker end here*/


/*Line chart js start here*/
        window.onload = function(){

            var options = {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: ""
                },
                axisX: {
                    valueFormatString: "DD MMM"
                },
                axisY: {
                    title: "Lorem Ipsum",
                    suffix: "K",
                    minimum: 30
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor: "pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "left",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [{
                    type: "line",
                    showInLegend: true,
                    name: "Lorem Ipsum",
                    markerType: "square",
                    xValueFormatString: "DD MMM, YYYY",
                    color: "#F08080",
                    yValueFormatString: "#,##0K",
                    dataPoints: [{
                        x: new Date(2017, 10, 1),
                        y: 63
                    }, {
                        x: new Date(2017, 10, 2),
                        y: 69
                    }, {
                        x: new Date(2017, 10, 3),
                        y: 65
                    }, {
                        x: new Date(2017, 10, 4),
                        y: 70
                    }, {
                        x: new Date(2017, 10, 5),
                        y: 71
                    }, {
                        x: new Date(2017, 10, 6),
                        y: 65
                    }, {
                        x: new Date(2017, 10, 7),
                        y: 73
                    }, {
                        x: new Date(2017, 10, 8),
                        y: 96
                    }, {
                        x: new Date(2017, 10, 9),
                        y: 84
                    }, {
                        x: new Date(2017, 10, 10),
                        y: 85
                    }, {
                        x: new Date(2017, 10, 11),
                        y: 86
                    }, {
                        x: new Date(2017, 10, 12),
                        y: 94
                    }, {
                        x: new Date(2017, 10, 13),
                        y: 97
                    }, {
                        x: new Date(2017, 10, 14),
                        y: 86
                    }, {
                        x: new Date(2017, 10, 15),
                        y: 89
                    }]
                }, {
                    type: "line",
                    showInLegend: true,
                    name: "Lorem Ipsum",
                    lineDashType: "dash",
                    yValueFormatString: "#,##0K",
                    dataPoints: [{
                        x: new Date(2017, 10, 1),
                        y: 60
                    }, {
                        x: new Date(2017, 10, 2),
                        y: 57
                    }, {
                        x: new Date(2017, 10, 3),
                        y: 51
                    }, {
                        x: new Date(2017, 10, 4),
                        y: 56
                    }, {
                        x: new Date(2017, 10, 5),
                        y: 54
                    }, {
                        x: new Date(2017, 10, 6),
                        y: 55
                    }, {
                        x: new Date(2017, 10, 7),
                        y: 54
                    }, {
                        x: new Date(2017, 10, 8),
                        y: 69
                    }, {
                        x: new Date(2017, 10, 9),
                        y: 65
                    }, {
                        x: new Date(2017, 10, 10),
                        y: 66
                    }, {
                        x: new Date(2017, 10, 11),
                        y: 63
                    }, {
                        x: new Date(2017, 10, 12),
                        y: 67
                    }, {
                        x: new Date(2017, 10, 13),
                        y: 66
                    }, {
                        x: new Date(2017, 10, 14),
                        y: 56
                    }, {
                        x: new Date(2017, 10, 15),
                        y: 64
                    }]
                }]
            };
			
			if(document.querySelector("#chartContainer")){
				jQuery("#chartContainer").CanvasJSChart(options);
			}
			
			if(document.querySelector("#chartContainer1")){
				jQuery("#chartContainer1").CanvasJSChart(options);
			}
			
			if(document.querySelector("#chartContainer2")){
				jQuery("#chartContainer2").CanvasJSChart(options);
			}
			
            //$("#chartContainer").CanvasJSChart(options);
            //$("#chartContainer1").CanvasJSChart(options);
            //$("#chartContainer2").CanvasJSChart(options);

            function toogleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                e.chart.render();
            }
        }
/*Line chart js end here*/




/////////// Start For download csv by url ///////////////////////
function yic_download_csv(csv_url){
	var link;
	var csv_arr 	= csv_url.split("/");
	var csv_name	= csv_arr[csv_arr.length-1];
	link = document.createElement('a');
	link.setAttribute('href', csv_url);		
	link.setAttribute('download', csv_name);
	//link.click();
	link.target = '_blank';
	document.body.appendChild(link);
	link.click();
	document.body.removeChild(link);
}
/////////// Start For download csv by url ///////////////////////



/////////// Start for sumoselect search filter///////////////////
	yic_set_multi_select_search_filter();
	function yic_set_multi_select_search_filter(){
		
		jQuery('.search_text_author').SumoSelect({
			search: true, 
			searchText: 'Search author here.', 
			selectAll: true,
			csvDispCount: 2,
    		captionFormat: 'Authors ({0})',
			captionFormatAllSelected: 'All selected ({0})' ,
			okCancelInMulti: true,
			locale :  ['OK', 'Cancel', 'Select All'],  
		});
		
		jQuery('.search_text_cat').SumoSelect({
			search: true, 
			searchText: 'Search category here.', 
			selectAll: true, 
			csvDispCount: 2,
    		captionFormat: 'Categories ({0})',
			captionFormatAllSelected: 'All selected ({0})' ,
			okCancelInMulti: true,
			locale :  ['OK', 'Cancel', 'Select All'],   
		});
		
		jQuery('.search_text_tag').SumoSelect({
			search: true, 
			searchText: 'Search tag here.', 
			selectAll: true, 
			csvDispCount: 2,
    		captionFormat: 'Tags ({0})',
			captionFormatAllSelected: 'All selected ({0})' ,
			okCancelInMulti: true,
			locale :  ['OK', 'Cancel', 'Select All'],   
		});
		
		jQuery('.yic_browse_status').SumoSelect({
			search: true, 
			searchText: 'Search status here.', 
			selectAll: true, 
			csvDispCount: 2,
    		captionFormat: 'Status ({0})',
			captionFormatAllSelected: 'All selected ({0})' ,
			okCancelInMulti: true,
			locale :  ['OK', 'Cancel', 'Select All'], 
		});
		
	}
/////////// End for sumoselect search filter ///////////////////


jQuery(document).ready(function($){
	
	yic_set_idea_save_tags();
	function yic_set_idea_save_tags(){
		var yic_ideas_saved_tags = document.querySelector(".yic_ideas_saved_tags");
		if(yic_ideas_saved_tags !== null){
			var yic_tags = $(".yic_ideas_saved_tags").text();
			$('.yic_edit_tags').val(yic_tags);
			console.log(yic_tags);
		}
	}
    ////////// Start for add tags ////////////////////////         
	$('.flexdatalist-json').flexdatalist({
		 searchContain: false,
		 textProperty: '{capital}, {name}, {continent}',
		 valueProperty: 'Value',
		 minLength: 1,
		 focusFirstResult: true,
		 selectionRequired: true,
		 groupBy: 'continent',
		 visibleProperties: ["name","continent","capital","capital_timezone"],
		 searchIn: ["name","continent","capital"],
		 //data: 'countries.json'
	});		
    ////////// End for add tags //////////////////////// 
	
});