/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: CurrentMissionStatus.js
 *
 * Date Last Modified: November 14, 2018 (Robert Duguay)
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
 * This file creates the graph to display the current mission progress.
 */

$(document).ready(function(){
    //initialize variables
    var barData = null;
    var graph = null;
    
    //refresh graph every second
    setInterval(function(){
        //request data from database
        $.ajax({
            url : "CurrentMissionStatus.php",
            type : "GET",
            data : {
                missionID: missionID
            },
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) !== JSON.stringify(barData)){
                    //delete old graph
                    if(graph != null){
                        graph.destroy();
                    }

                    //declare empty arrays
                    var amounts = [];
                    var missions = [];
                    
                    missions.push("Current Mission");
            
                    //add data to chart
					for (var x in data){
						amounts.push(data[x].totalPercent);
					}

                    //define location to add chart
                    var ctx = $("#incomingHorizontalBar");
                    
                    //add styling to data
                    var myData = {
                    	labels : missions,
                    	datasets : [{
                    		backgroundColor : ['#ff0000'],
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
                    			text: 'Current Mission Status',
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
                    						fontSize: 20
                    					},
                    					scaleLabel: {
                    						display: true,
                    						labelString: 'Percent Complete',
                    						fontColor: '#ffffff',
                    						fontSize: 20
                    					}
                    				}],
                    				yAxes: [{
                    					display: false
                    				}]
                    			}
                    		}
                    	});
                    	
                    	barData = data;
                    
                }
            }
        });
    }, 1000);
});     