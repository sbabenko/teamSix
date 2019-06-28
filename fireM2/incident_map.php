<!--
 Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 Product Name: FIRE-M^2 (First Responder Mission Management)
 File Name: incident_map.php
 
 Date Last Modified: November 30, 2018 (Aditya Kaliappan)
 
 Copyright: (c) 2018 by FIRE^2
 and all corresponding participants which include:
 Aditya Kaliappan
 Lorenzo Neil
 Robert Duguay
 Stanislav Babenko
 Daniel Volinski
 
 File Description:
 This file contains the functions needed to load the map, as well as
 to toggle the map type and points visible.
 -->

<div class="mapWrapper">
    <div class="map" id="map"></div>
</div>

<script>
    //initialize variables used in this session
    var map = null;
    var heatmap = null;
    var infowindow = null;
    var markers = [];
    var currPoints = [];
    var pointArray;
    var isPoints = false;
    var mapTypeChanged = false;
    var category = [];
    var submitMethod = [];
    var eventState = [];
    var missionID = null;

    $(document).ready(function() {
        //refresh every .5 seconds
        setInterval(function() {
            //request for all map points
            $.ajax({
                url: "get_map_points.php",
                type: "GET",
                data: {
                    category: JSON.stringify(category),
                    submitMethod: JSON.stringify(submitMethod),
                    eventState: JSON.stringify(eventState),
                    missionID: missionID
                },
                dataType: "json",
                success: loadPoints
            });
        }, 500);
    });

    function initMap() {
        //initialize map
        infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(38.434046, -74.340284),
            zoom: 8,

            mapTypeControl: false,
            streetViewControl: false,
            zoomControl: false,
            scaleControl: false,
            rotateControl: false,
            fullscreenControl: false,
            minZoom: 2,

            styles: [{
                    "stylers": [{
                        "visibility": "on"
                    }]
                },
                {
                    "elementType": "labels",
                    "stylers": [{
                            "saturation": "-100"
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "saturation": 36
                        },
                        {
                            "lightness": 40
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "lightness": 16
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#4d6059"
                    }]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#4d6059"
                    }]
                },
                {
                    "featureType": "landscape.natural",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#4d6059"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                        "lightness": 21
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#4d6059"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#4d6059"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#7f8d89"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#7f8d89"
                    }]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#7f8d89"
                    }]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#7f8d89"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                            "color": "#7f8d89"
                        },
                        {
                            "lightness": -25
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                            "color": "#7f8d89"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#7f8d89"
                    }]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#7f8d89"
                    }]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#000000"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "stylers": [{
                            "color": "#2b3638"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#2b3638"
                        },
                        {
                            "lightness": 27
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#0d0e0f"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#24282b"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }
            ]
        });

        //initialize listener for event name dialog box
        google.maps.event.addListener(map, 'click', function() {
            infowindow.close();
        });

        //initialize array for heatmap
        pointArray = new google.maps.MVCArray();

        //create heatmap
        heatmap = new google.maps.visualization.HeatmapLayer({
            data: pointArray
        });

        //set heatmap specifications
        heatmap.set('radius', 15);
        heatmap.set('opacity', 0.7);
    }

    //Reference: https://stackoverflow.com/questions/36852063/how-do-you-switch-from-heatmap-to-clickable-markers-with-google-maps-js-api
    //toggle between points and heatmap
    function loadPoints(mapData) {
        var toDelete = []; //in old, but not new
        var toAdd = []; //in new, but not old
        var newPoints = [];

        //toggle map type
        if (mapTypeChanged && markers.length > 0) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(isPoints ? map : null);
            }

            heatmap.setMap(isPoints ? null : map);

            mapTypeChanged = false;
        }

        //get points from query
        for (var i = 0; i < mapData.features.length; i++) {
            newPoints.push(mapData.features[i]);
        }

        //Reference: https://stackoverflow.com/questions/1723168/what-is-the-fastest-or-most-elegant-way-to-compute-a-set-difference-using-javasc
        toDelete = currPoints.filter(function(x) {
            return newPoints.map(function(y) {
                return y.id
            }).indexOf(x.id) < 0
        });

        toAdd = newPoints.filter(function(x) {
            return currPoints.map(function(y) {
                return y.id
            }).indexOf(x.id) < 0
        });

        var isModified = toDelete.length > 0 || toAdd.length > 0;

        //update set of points based on set difference
        for (var i = 0; i < markers.length && isModified;) {
            if (toDelete.length > 0 && markers[i].id === toDelete[0].id) {
                deletePoint(i);
                toDelete.shift();
            } else if (toAdd.length > 0 && markers[i].id > toAdd[0].id) {
                addPoint(toAdd[0], i);
                toAdd.shift();
                i++;
            } else {
                i++;
            }
        }

        //add remaining points at end of array
        for (var i = 0; i < toAdd.length && isModified; i++) {
            addPoint(toAdd[i], markers.length);
        }

        //update current set of points on map
        currPoints = newPoints;
    }

    function addPoint(toAdd, pos) {
        //initialize coordinate
        coordinate = (new google.maps.LatLng(
            toAdd.geometry.coordinates[1],
            toAdd.geometry.coordinates[0]));

        //create marker
        var marker = new google.maps.Marker({
            map: map,
            position: coordinate,
            title: toAdd.properties.name,
            id: toAdd.id
        });

        marker.setMap(isPoints ? map : null);

        markers.splice(pos, 0, marker);

        //set listener for opening event information modal
        google.maps.event.addListener(marker, 'click', function() {
            var role = "<?php echo $_SESSION['role']; ?>";
            
            var canDelete = "false";
            
            if(role === "OC"){
                canDelete = "true";
            }
            
            var content = "<a href = \"javascript:openEvent(" + this.id +
                ", `" + this.title + "`, true, " + canDelete +
                ")\">" + this.title + "</a>";

            infowindow.setContent(content);
            infowindow.open(map, this);
        });

        pointArray.insertAt(pos, coordinate);
    }

    function deletePoint(pos) {
        //remove point from map
        markers[pos].setMap(null);
        markers.splice(pos, 1);
        pointArray.removeAt(pos);
    }

    function dispPoints(flag) {
        mapTypeChanged = true;
        isPoints = flag;
    }

    function toggleCategory(checkBox) {
        if (checkBox.checked) {
            category.splice(category.indexOf(checkBox.value), 1);
        } else {
            category.push(checkBox.value);
        }
    }

    function toggleSubmitMethod(checkBox) {
        if (checkBox.checked) {
            submitMethod.splice(submitMethod.indexOf(checkBox.value), 1);
        } else {
            submitMethod.push(checkBox.value);
        }
    }
    
    function toggleEventState(checkBox) {
        if (checkBox.checked) {
            eventState.splice(eventState.indexOf(checkBox.value), 1);
        } else {
            eventState.push(checkBox.value);
        }
    }
    
    function setMissionID(idNum){
        missionID = idNum;
    }

</script>

<script async src="https://maps.googleapis.com/maps/api/js?key=###########&callback=initMap&libraries=visualization"></script>
