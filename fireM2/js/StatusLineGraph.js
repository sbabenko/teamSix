$(document).ready(function(){
    var barData = null;
    var graph = null;
    
    setInterval(function(){        
        $.ajax({
            url : "http://localhost/teamSix/fireM2/get_event_cat_doughnut.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                
                if(JSON.stringify(data) != JSON.stringify(doughnutData)){
                    if(graph != null){
                        graph.destroy();
                    }
                    
                    var missions = [];
                    var amounts = [];
                    
                    //This section is dependant on whether or not the database contains
                    //a value for the percentage of a mission's completion.  If it is,
                    //that number goes in for "MISSION_STATUS_AMOUNT"
                    
					for (var x in data){
						missions.push("Mission " + data[x]);
						amounts.push(data[x].MISSION_STATUS_AMOUNT);
					}

                    
                    var ctx = $("#incomingHorizontalBar");
                    
                    
                    var myData = {
                    	labels : missions,
                    	datasets : [{
                    		data : amount
                    		}]
                    	};
                    
                    }
                    
                    
                    graph = new Chart(ctx, {
                    	type = 'horizontalBar',
                    	data : myData,
                    	options: {
                    		legend: {display: false},
                    		title: {
                    			display: true,
                    			fontSize: 20,
                    			text: 'Current Mission Statuses'
                    			}
                    		}
                    	});
                    	
                    	
                    	barData = data;
                    	
                }
            }
        });
    }, 1000);
});
        