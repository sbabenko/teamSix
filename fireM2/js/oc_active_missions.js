$(document).ready(function(){
    var barData2 = null;
    var graph = null;
    
    setInterval(function(){        
        $.ajax({
            url : "oc_active_missions.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                
                
                if(JSON.stringify(data) != JSON.stringify(barData2)){
                    if(graph != null){
                        graph.destroy();
                    }
                    
                    var amounts = [];
                    var missions = [];
                    
                    for (var i in data){
                    	missions.push(data[i].missionName);
                    	amounts.push(data[i].totalPercent);
                    }

                    
                    var ctx = $("#oc_active_missions");
                    
                    var myData = {
                    	labels : missions,
                    	datasets : [{
                    		backgroundColor : ['#ff0000'],
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