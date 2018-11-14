$(document).ready(function(){
    var pieData = null;
    var graph = null;
    
    setInterval(function(){        
        $.ajax({
            url : "http://localhost/teamSix/fireM2/get_event_cat_doughnut.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                
                
                if(JSON.stringify(data) != JSON.stringify(pieData)){
                    if(graph != null){
                        graph.destroy();
                    }
                    
                    var amount = [];
                    var cats = [];
                    var colors = [];
                    
                    
                    //mission statuses
                    cats.push("Assigned");
                    cats.push("In Progress");
                    cats.push("On Hold");
                    cats.push("Completed");
                    
                    //chart colors
                    colors.push("#ff0000");
                    colors.push("#ffff00");
                    colors.push("#55AE3A");
                    
                    for(var i = 0; i < 3; i++){
	                  	amount.push(0);              	
                  	}
                    
                    for(var i in data){
                    	for(var x=0; x<3; x++){
                    	
                    	
                    	//Whatever element of the event that tracks its status is checked 
                    	//here. "SOMETHING" needs to be replaced with whatever that 
                    	//element is 
                    		if(data[i].SOMETHING == cats[x]){
                    			amount[x] = amount[x]+1;
                    		}
                    	}
                    }
                    
                    
                    var ctx = $("#incomingPieGraph");
                    
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
                    		legend: { position: 'bottom'},
                    		title: {
                    			display: true,
                    			fontSize: 20,
                    			text: 'Mission Statuses'
                    			}
                    		}
	                    });
                    
                    
                    pieData = data;
                }
            }
        });
    }, 1000);
});