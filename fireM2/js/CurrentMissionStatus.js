$(document).ready(function(){
    var barData = null;
    var graph = null;
    
    setInterval(function(){        
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
                    if(graph != null){
                        graph.destroy();
                    }
                                
                    var amounts = [];
                    var missions = [];
                    
                    missions.push("Current Mission");
            
                    
					for (var x in data){
						amounts.push(data[x].totalPercent);
					}

                    
                    var ctx = $("#incomingHorizontalBar");
                    
                    
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
        