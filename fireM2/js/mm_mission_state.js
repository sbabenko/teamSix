$(document).ready(function(){
    var stateData = null;
    var graph = null;
    
    setInterval(function(){        
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
                    if(graph != null){
                        graph.destroy();
                    }

                  
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
                  	
                  	
                  	for(var i = 0; i < 4; i++){
	                  	amount.push(0);              	
                  	}
                  	
                  	                  
                    for(var i in data){
                    	for(var x = 0; x < 4; x++){
                    		if(data[i].state === cats[x]){
                    			amount[x] = data[i].quantity;
                    		}
                    	}
                    }
                    
                    
                    var ctx = $("#mm_mission_state");
                    
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