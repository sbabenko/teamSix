$(document).ready(function(){
    var submitData = null;
    var graph = null;
    
    setInterval(function(){        
        $.ajax({
            url : "http://localhost/teamSix/fireM2/mm_submit_method_pie.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                
                
                if(JSON.stringify(data) != JSON.stringify(submitData)){
                    if(graph != null){
                        graph.destroy();
                    }

                  
                  	var amount = [];
                  	var cats = [];
                  	var colors = [];
                  	
                  	//fill labels array
                  	cats.push("Phone");
                  	cats.push("Email");
                  	cats.push("Facebook");
                  	cats.push("SMS");
                  	cats.push("Twitter");
                  	
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
                    		if(data[i].category == cats[x]){
                    			amount[x] = data[i].quantity;
                    		}
                    	}
                    }
                    
                    
                    var ctx = $("#mm_submit_method_pie");
                    
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
                    			text: 'Missions by Submission Method',
                    			fontColor: '#ffffff'
                    			}
                    		}
	                    });
                    
                    
                    submitData = data;
                }
            }
        });
    }, 1000);
});