$(document).ready(function(){
    var doughnutData = null;
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

                  
                  	var amount = [];
                  	var cats = [];
                  	
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
                    
                    for(var i = 0; i < 10; i++){
                    	console.log(data[i]);
                    	console.log(amount[i]);                    
                    }
                    
                    var ctx = $("#incomingDoughnutGraph");
                    
                    var myData = {
                    		labels : cats,
                    		datasets : [{
                    			data : amount
                    		}]
                    	};
                    
                    
                    graph = new Chart(ctx, {
                    	type: "doughnut",
                    	data: myData
                    	});
                    
                    
                    
                  
                    
                    doughnutData = data;
                }
            }
        });
    }, 1000);
});



