/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: oc_active_missions.js
 *
 * Date Last Modified: November 20, 2018 (Robert Duguay)
 *
 * Copyright: (c) 2018 by FIRE^2
 * and all corresponding participants which include:
 * Aditya Kaliappan
 * Lorenzo Neil
 * Robert Duguay
 * Stanislav Babenko
 * Daniel Volinski
 *
 * File Description:
 * This file creates the graph to display the percent completion of all
 * active missions.
 */

$(document).ready(function(){
    //initialize variables
    var barData2 = null;
    var graph = null;
    
    //refresh every second
    setInterval(function(){
        //request data from database
        $.ajax({
            url : "oc_active_missions.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) !== JSON.stringify(barData2)){
                    //delete old graph
                    if(graph != null){
                        graph.destroy();
                    }
                    
                    //declare empty arrays
                    var amounts = [];
                    var missions = [];
                    var colors = [];
                    
                    //add mission and percent completion data
                    for (var i in data){
                    	missions.push(data[i].missionName);
                    	amounts.push(data[i].totalPercent);
                    	colors.push('#ff0000');
                    }

                    //define location to add chart
                    var ctx = $("#oc_active_missions");
                    
                    //add styling to data
                    var myData = {
                    	labels : missions,
                    	datasets : [{
                    		backgroundColor : colors,
                    		data : amounts
                    		}]
                    	};
                    	
                    //create graph
                    graph = new Chart(ctx, {
                    	type : 'horizontalBar',
                    	data : myData,
                    	options: {
                    		legend: {display: false},
                    		title: {
                    			display: true,
                    			fontSize: 20,
                    			text: 'Current Active Missions',
                    			fontColor: '#ffffff'
                    			},
                    			scales: {
                    				xAxes: [{
                    					display: true,
                    					ticks: {
                    						min: 0,
                    						max: 100,
                    						stepSize: 25,
                    						fontColor: '#ffffff',
                    						fontSize: 15
                    					},
                    					scaleLabel: {
                    						display: true,
                    						labelString: 'Percent Complete',
                    						fontColor: '#ffffff',
                    						fontSize: 20
                    					}
                    				}],
                    				yAxes: [{
                    					display: true,
                    					ticks: {
                    						fontColor: '#ffffff',
                    						fontSize: 15
                    					}
                    				}]
                    			}
                    		}
                    	});
                    	
                    	barData2 = data;
                    
                }
            }
        });
    }, 1000);
});