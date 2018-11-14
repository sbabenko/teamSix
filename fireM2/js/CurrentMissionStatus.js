$(document).ready(function(){
    var barData = null;
    var graph = null;
    
    setInterval(function(){        
        $.ajax({
            url : "http://localhost/teamSix/fireM2/CurrentMissionStatus.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                
                
                if(JSON.stringify(data) != JSON.stringify(barData)){
                    if(graph != null){
                        graph.destroy();
                    }
                                
                    var amounts = [];
                    var missions = [];
                    
                    missions.push("Current Mission");
            
                    
					for (var x in data){
						amounts.push(data[x].eventPercent);
					}

                    
                    var ctx = $("#incomingHorizontalBar");
                    
                    
                    var myData = {
                    	labels : missions,
                    	datasets : [{
                    		data : amounts
                    		}]
                    	};
                    
                    graph = new Chart(ctx, {
                    	type : 'horizontalBar',
                    	data : myData,
                    	options: {
                    		legend: {display: false},
                    		title: {
                    			display: true,
                    			fontSize: 20,
                    			text: 'Current Mission Status'
                    			},
                    			scales: {
                    				xAxes: [{
                    					display: true,
                    					ticks: {
                    						max: 1,
                    						min: 0,
                    						stepSize: 0.33
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
        