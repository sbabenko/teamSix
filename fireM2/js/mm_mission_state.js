/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: mm_mission_state.js
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
 * This file creates the graph to display the events by state in a mission.
 */

$(document).ready(function(){
    //initialize variables
    var stateData = null;
    var graph = null;
    
    //refresh every second
    setInterval(function(){
        //request data from database
        $.ajax({
            url : "mm_mission_state.php",
            type : "GET",
            data: {
                missionID: missionID  
            },
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) !== JSON.stringify(stateData)){
                    //delete old graph
                    if(graph != null){
                        graph.destroy();
                    }

                    //declare empty arrays
                  	var amount = [];
                  	var cats = [];
                  	var colors = [];
                  	
                  	//fill labels array
                  	cats.push("assigned");
                  	cats.push("on hold");
                  	cats.push("in progress");
                  	cats.push("completed");
                  	
                  	
                  	//assign colors to each event
                  	colors.push("#ffffff");
                  	colors.push("#0000ff");
                  	colors.push("#3399ff");
                  	colors.push("#ff0000");
                  	
                  	//initialize amount array
                  	for(var i = 0; i < 4; i++){
	                  	amount.push(0);              	
                  	}
                  	
                    //update amount values based on database query        
                    for(var i in data){
                    	for(var x = 0; x < 4; x++){
                    		if(data[i].state === cats[x]){
                    			amount[x] = data[i].quantity;
                    		}
                    	}
                    }
                    
                    //define location to add chart
                    var ctx = $("#mm_mission_state");
                    
                    //add styling to data
                    var myData = {
                    		labels : cats,
                    		datasets : [{
                    			backgroundColor: colors,
                    			data : amount
                    		}]
                    	};
                    
                    //create graph
                    graph = new Chart(ctx, {
                    	type: "doughnut",
                    	data: myData,
                    	options: {
                    		legend: {
                    			position: 'bottom',
                    			labels : {
                    				fontColor: '#ffffff'
                    			}
                    		},
                    		title: {
                    			display: true,
                    			fontSize: 20,
                    			text: 'Event Statuses',
                    			fontColor: '#ffffff'
                    			}
                    		}
	                    });
                    
                    
                    stateData = data;
                }
            }
        });
    }, 1000);
});