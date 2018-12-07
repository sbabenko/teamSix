/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: get_event_cat_doughnut.js
 *
 * Date Last Modified: December 2, 2018 (Robert Duguay)
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
 * This file creates the donut graph to display unassigned events by category.
 */

$(document).ready(function(){
    //initialize variables
    var doughnutData = null;
    var graph = null;
    
    //refresh graph every second
    setInterval(function(){
        //request data from database
        $.ajax({
            url : "get_event_cat_doughnut.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) !== JSON.stringify(doughnutData)){
                    //delete old graph
                    if(graph != null){
                        graph.destroy();
                    }

                    //declare empty arrays
                  	var amount = [];
                  	var cats = [];
                  	var colors = [];
                  	
                  	//fill labels array
                  	cats.push("hurricane");
                  	cats.push("flood");
                  	cats.push("tsunami");
                  	cats.push("fire");
                  	cats.push("earthquake");
                  	cats.push("landslide");
                  	cats.push("sinkhole");
                  	cats.push("volcano");
                  	cats.push("tornado");
                  	cats.push("natural gas");
                  	
                  	//assign colors to each event
                  	colors.push("#ffffff");
                  	colors.push("#0000ff");
                  	colors.push("#3399ff");
                  	colors.push("#ff0000");
                  	colors.push("#654321");
                  	colors.push("#999966");
                  	colors.push("#000000");
                  	colors.push("#cc6600");
                  	colors.push("#999999");
                  	colors.push("#e6e600");
                  	
                  	//initialize amount array
                  	for(var i = 0; i < 10; i++){
	                  	amount.push(0);              	
                  	}
                  	
                    //update amounts based on data in database
                    for(var i in data){
                    	for(var x = 0; x < 10; x++){
                    		if(data[i].category === cats[x]){
                    			amount[x] = data[i].quantity;
                    		}
                    	}
                    }
                    
                    //define location to add chart
                    var ctx = $("#incomingDoughnutGraph");
                    
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
                    			labels: {
	                    			fontColor: '#ffffff'
                    			}
                    		},
                    		title: {
                    			display: true,
                    			fontSize: 20,
                    			text: 'Unassigned Events by Category',
                    			fontColor: '#ffffff'
                    			}
                    		}
	                    });
                    
                    
                    doughnutData = data;
                }
            }
        });
    }, 1000);
});