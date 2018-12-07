/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: incomingEventsLineGraph.js
 *
 * Date Last Modified: November 14, 2018 (Aditya Kaliappan)
 *
 * Copyright: (c) 2018 by FIRE^2
 * and all corresponding participants which include:
 * Aditya Kaliappan
 * Lorenzo Neil
 * Robert Duguay
 * Stanislav Babenko
 * Daniel Volinski
 *
 * File Description:
 * This file creates the graph to display number of incoming events over
 * the past 24 hours.
 */

$(document).ready(function(){
    //initialize variables
    var lineGraphData = null;
    var graph = null;
    
    //refresh graph every second
    setInterval(function(){
        //request data from database
        $.ajax({
            url : "get_events_line_graph.php",
            type : "GET",
            success : function(data){
                //don't refresh graph if data did not change
                //https://www.w3schools.com/js/js_json_stringify.asp
                if(JSON.stringify(data) !== JSON.stringify(lineGraphData)){
                    //delete old graph
                    if(graph != null){
                        graph.destroy();
                    }

                    //initialize points on graph
                    var points = [];
                    for(var i = 0; i < 24; i++){
                        var pair = {x: i, y: 0};
                        points.push(pair);
                    }
                    
                    //update points to correct quantity
                    for(var i in data){
                        points[data[i].elapsedTime].y = data[i].quantity;
                    }
                    
                    //define location to add chart
                    var ctx = $("#incomingDataLineGraph");
                    
                    //create graph
                    //http://www.chartjs.org/docs/latest/charts/scatter.html
                    graph = new Chart(ctx, {
                        type: 'scatter',
                        data: {
                            datasets: [{
                                data: points
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Incoming Events Over Past 24 Hours'
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                xAxes: [{
                                    type: 'linear',
                                    position: 'bottom',
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Hours since Current Time'
                                    },
                                    ticks: {
                                        min: 0,
                                        max: 23,
                                        stepSize: 1
                                    }
                                }],
                                yAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Number of Events'
                                    },
                                    ticks: {
                                        min: 0,
                                        stepSize: 5
                                    }
                                }]
                            },
                            //https://codepen.io/k3no/pen/OReEKx?editors=0010
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return "Between " + Number(tooltipItem.xLabel) + "-" + Number(tooltipItem.xLabel + 1)
                                            + " hours: " + Number(tooltipItem.yLabel) + " events";
                                    }
                                }
                            },
                        }
                    });
                    
                    lineGraphData = data;
                }
            }
        });
    }, 1000);
});