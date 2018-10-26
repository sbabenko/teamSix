$(document).ready(function(){
    var lineGraphData = null;
    
    setInterval(function(){        
        $.ajax({
            url : "http://localhost/teamSix/fireM2/get_events_line_graph.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) != JSON.stringify(lineGraphData)){
                    var timeInterval = [];
                    var quantity = [];

                    for(var i in data) {
                        timeInterval.push("UserID " + data[i].timeInterval);
                        quantity.push(data[i].quantity);
                    }

                    var chartdata = {
                        labels: timeInterval,
                        datasets: [
                            {
                                label: "googleplus",
                                fill: false,
                                lineTension: 0.1,
                                backgroundColor: "rgba(211, 72, 54, 0.75)",
                                borderColor: "rgba(211, 72, 54, 1)",
                                pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
                                pointHoverBorderColor: "rgba(211, 72, 54, 1)",
                                data: quantity
                            }
                        ]
                    };

                    var ctx = $("#incomingDataLineGraph");

                    var LineGraph = new Chart(ctx, {
                        type: 'line',
                        data: chartdata
                    });
                    
                    lineGraphData = data;
                }
            }
        });
    }, 1000);
});