$(document).ready(function(){
    var submitData2 = null;
    var graph = null;
    
    setInterval(function(){        
        $.ajax({
            url : "oc_submission_method.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                
                
                if(JSON.stringify(data) !== JSON.stringify(submitData2)){
                    if(graph != null){
                        graph.destroy();
                    }

                  
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
                  	
                  	
                  	for(var i = 0; i < 5; i++){
	                  	amount.push(0);              	
                  	}
                  	
                  	                  
                    for(var i in data){
                    	for(var x = 0; x < 5; x++){
                    		if(data[i].submitMethod === cats[x]){
                    			amount[x] = data[i].quantity;
                    		}
                    	}
                    }
                    
                    
                    var ctx = $("#oc_submission_method");
                    
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
                    			text: 'Missions by Submission Method',
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