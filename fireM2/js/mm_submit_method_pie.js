/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: mm_submit_method_pie.js
 *
 * Date Last Modified: November 25, 2018 (Robert Duguay)
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
 * This file creates the graph to display the events by submission method
 * in a mission.
 */

$(document).ready(function(){
    //initialize variables
    var submitData = null;
    var graph = null;
    
    //refresh every second
    setInterval(function(){
        //request data from database
        $.ajax({
            url : "mm_submit_method_pie.php",
            type : "GET",
            data: {
                missionID: missionID
            },
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) !== JSON.stringify(submitData)){
                    //delete old graph
                    if(graph != null){
                        graph.destroy();
                    }

                    //declare empty arrays
                  	var amount = [];
                  	var cats = [];
                  	var colors = [];
                  	
                  	//fill labels array
                  	cats.push("phone");
                  	cats.push("email");
                  	cats.push("facebook");
                  	cats.push("sms");
                  	cats.push("twitter");
                  	
                  	//assign colors to each event
                  	colors.push("#ffffff");
                  	colors.push("#0000ff");
                  	colors.push("#3399ff");
                  	colors.push("#ff0000");
                  	colors.push("#654321");
                  	
                  	//initialize amount array
                  	for(var i = 0; i < 5; i++){
	                  	amount.push(0);              	
                  	}
                  	
                    //update amount values based on database query
                    for(var i in data){
                    	for(var x = 0; x < 5; x++){
                    		if(data[i].submitMethod === cats[x]){
                    			amount[x] = data[i].quantity;
                    		}
                    	}
                    }
                    
                    //define location to add chart
                    var ctx = $("#mm_submit_method_pie");
                    
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
                    			text: 'Events by Submission Method',
                    			fontColor: '#ffffff'
                    			}
                    		}
	                    });
                    
                    
                    submitData = data;
                }
            }
        });
    }, 1000);
});