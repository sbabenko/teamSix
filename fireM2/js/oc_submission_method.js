/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: oc_submission_method.js
 *
 * Date Last Modified: December 2, 2018 (Aditya Kaliappan)
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
 * This file creates the graph to display unassigned events by submission
 * method.
 */

$(document).ready(function(){
    //initialize variables
    var submitData2 = null;
    var graph = null;
    
    //refresh every second
    setInterval(function(){
        //request data from database
        $.ajax({
            url : "oc_submission_method.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) !== JSON.stringify(submitData2)){
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
                    var ctx = $("#oc_submission_method");
                    
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
                    			text: 'Unassigned Events by Submission Method',
                    			fontColor: '#ffffff'
                    			}
                    		}
	                    });
                    
                    
                    submitData2 = data;
                }
            }
        });
    }, 1000);
});