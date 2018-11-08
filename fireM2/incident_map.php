<div class="mapWrapper">
    <div class="map" id="map"></div>
</div>

<script>
    var map;
    var heatmap;

    function initMap() {
        var infowindow = new google.maps.InfoWindow();
        var map = new google.maps.Map(document.getElementById('map'), {
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

        google.maps.event.addListener(map, 'click', function() {
            infowindow.close();
        });

        //Reference: https://stackoverflow.com/questions/36852063/how-do-you-switch-from-heatmap-to-clickable-markers-with-google-maps-js-api
        //toggle between points and heatmap
        function loadPoints(mapData) {
            var latLong;
            var markers = [];
            var heatMapData = [];

            for (i = 0; i < mapData.features.length; i++) {
                latLong = (new google.maps.LatLng(
                    mapData.features[i].geometry.coordinates[1],
                    mapData.features[i].geometry.coordinates[0]));

                var marker = new google.maps.Marker({
                    map: map,
                    position: latLong,
                    title: mapData.features[i].properties.name
                });

                markers.push(marker);

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(this.title);
                    infowindow.open(map, this);
                });

                heatMapData.push(latLong);
            }

            var pointArray = new google.maps.MVCArray(heatMapData);

            heatmap = new google.maps.visualization.HeatmapLayer({
                data: pointArray
            });

            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(true ? map : null);
            }

            heatmap.setMap(true ? null : map);
        }

        $.ajax({
            dataType: "json",
            url: "get_map_points",
            success: loadPoints
        });

        //google.maps.event.addDomListener(window, 'load', initMap);
    }

</script>

<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbNu4nnoEfW9vB55Ns4Ud1jqxeLH13qpQ&callback=initMap&libraries=visualization">
</script>
