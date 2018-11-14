$(document).ready(function(){
    var doughnutData = null;
    var graph = null;
    
    setInterval(function(){        
        $.ajax({
            url : "http://localhost/teamSix/fireM2/mm_event_cat_pie.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                
                
                if(JSON.stringify(data) != JSON.stringify(doughnutData)){
                    if(graph != null){
                        graph.destroy();
                    }

                  
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
                  	
                  	
                  	for(var i = 0; i < 10; i++){
	                  	amount.push(0);              	
                  	}
                  	
                  	                  
                    for(var i in data){
                    	for(var x = 0; x < 10; x++){
                    		if(data[i].category == cats[x]){
                    			amount[x] = data[i].quantity;
                    		}
                    	}
                    }
                    
                    
                    var ctx = $("#mm_event_cat_pie");
                    
                    var myData = {
                    		labels : cats,
                    		datasets : [{
                    			backgroundColor: colors,
                    			data : amount
                    		}]
                    	};
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
                    			text: 'Events by Category',
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