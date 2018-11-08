<div class = "mapWrapper">
  <div class ="map" id="map"></div>
</div>

<script>
var map;
var heatmap;
    
// reduced size of data set to fit in post
var geoJsonShooting = {
  "type": "FeatureCollection",
  "features": [{
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.67129, 39.33763]
    },
    "properties": {
      "crimedate": "2016-02-09T00:00:00.000",
      "post": "613",
      "location_1_address": null,
      "location": "3000 W COLD SPRING LA",
      "description": "SHOOTING",
      "neighborhood": "Towanda-Grantley",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "NORTHWESTERN",
      "crimetime": "1612"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.59531, 39.28513]
    },
    "properties": {
      "crimedate": "2016-02-10T00:00:00.000",
      "post": "213",
      "location_1_address": null,
      "location": "500 S BOND ST",
      "description": "SHOOTING",
      "neighborhood": "Fells Point",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHEASTERN",
      "crimetime": "0135"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.59531, 39.28513]
    },
    "properties": {
      "crimedate": "2016-02-10T00:00:00.000",
      "post": "213",
      "location_1_address": null,
      "location": "500 S BOND ST",
      "description": "SHOOTING",
      "neighborhood": "Fells Point",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHEASTERN",
      "crimetime": "0135"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.68361, 39.34287]
    },
    "properties": {
      "crimedate": "2016-02-07T00:00:00.000",
      "post": "623",
      "location_1_address": null,
      "location": "4100 W BELVEDERE AV",
      "description": "SHOOTING",
      "neighborhood": "Woodmere",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "NORTHWESTERN",
      "crimetime": "1845"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.70401, 39.28251]
    },
    "properties": {
      "crimedate": "2016-02-01T00:00:00.000",
      "post": "823",
      "location_1_address": null,
      "location": "200 BOSWELL RD",
      "description": "SHOOTING",
      "neighborhood": "Westgate",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHWESTERN",
      "crimetime": "1818"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.67611, 39.28487]
    },
    "properties": {
      "crimedate": "2016-02-27T00:00:00.000",
      "post": "842",
      "location_1_address": null,
      "location": "100 S MORLEY ST",
      "description": "SHOOTING",
      "neighborhood": "Saint Josephs",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHWESTERN",
      "crimetime": "1721"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.63785, 39.31029]
    },
    "properties": {
      "crimedate": "2016-01-08T00:00:00.000",
      "post": "733",
      "location_1_address": null,
      "location": "1200 W NORTH AV",
      "description": "SHOOTING",
      "neighborhood": "Penn North",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "WESTERN",
      "crimetime": "1852"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.55906, 39.34631]
    },
    "properties": {
      "crimedate": "2016-02-25T00:00:00.000",
      "post": "426",
      "location_1_address": null,
      "location": "3400 ECHODALE AV",
      "description": "SHOOTING",
      "neighborhood": "Waltherson",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "NORTHEASTERN",
      "crimetime": "1227"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.67444, 39.30995]
    },
    "properties": {
      "crimedate": "2013-07-13T00:00:00.000",
      "post": "812",
      "location_1_address": null,
      "location": "3400 WALBROOK AV",
      "description": "SHOOTING",
      "neighborhood": "Mount Holly",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHWESTERN",
      "crimetime": "2128"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.53564, 39.35372]
    },
    "properties": {
      "crimedate": "2016-02-25T00:00:00.000",
      "post": "425",
      "location_1_address": null,
      "location": "6400 BROOK AV",
      "description": "SHOOTING",
      "neighborhood": "Rosemont East",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "NORTHEASTERN",
      "crimetime": "1933"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.65021, 39.28703]
    },
    "properties": {
      "crimedate": "2016-02-04T00:00:00.000",
      "post": "842",
      "location_1_address": null,
      "location": "2100 HOLLINS ST",
      "description": "SHOOTING",
      "neighborhood": "Boyd-Booth",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHWESTERN",
      "crimetime": "1224"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.59893, 39.29428]
    },
    "properties": {
      "crimedate": "2014-05-17T00:00:00.000",
      "post": "212",
      "location_1_address": null,
      "location": "200 N EDEN ST",
      "description": "SHOOTING",
      "neighborhood": "Dunbar-Broadway",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHEASTERN",
      "crimetime": "0146"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.64921, 39.28469]
    },
    "properties": {
      "crimedate": "2011-04-05T00:00:00.000",
      "post": "934",
      "location_1_address": null,
      "location": "200 HARMISON ST",
      "description": "SHOOTING",
      "neighborhood": "Carrollton Ridge",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHERN",
      "crimetime": "0146"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.64921, 39.28469]
    },
    "properties": {
      "crimedate": "2011-04-05T00:00:00.000",
      "post": "934",
      "location_1_address": null,
      "location": "200 HARMISON ST",
      "description": "SHOOTING",
      "neighborhood": "Carrollton Ridge",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHERN",
      "crimetime": "0146"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.64921, 39.28469]
    },
    "properties": {
      "crimedate": "2011-04-05T00:00:00.000",
      "post": "934",
      "location_1_address": null,
      "location": "200 HARMISON ST",
      "description": "SHOOTING",
      "neighborhood": "Carrollton Ridge",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHERN",
      "crimetime": "0146"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.62384, 39.29182]
    },
    "properties": {
      "crimedate": "2015-07-12T00:00:00.000",
      "post": "121",
      "location_1_address": null,
      "location": "200 N GREENE ST",
      "description": "SHOOTING",
      "neighborhood": "University Of Maryland",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "CENTRAL",
      "crimetime": "0512"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.62579, 39.29688]
    },
    "properties": {
      "crimedate": "2016-02-16T00:00:00.000",
      "post": "143",
      "location_1_address": null,
      "location": "600 N MARTIN L KING JR BLVD",
      "description": "SHOOTING",
      "neighborhood": "Seton Hill",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "CENTRAL",
      "crimetime": "1817"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.59842, 39.31605]
    },
    "properties": {
      "crimedate": "2016-02-19T00:00:00.000",
      "post": "342",
      "location_1_address": null,
      "location": "2300 AIKEN ST",
      "description": "SHOOTING",
      "neighborhood": "East Baltimore Midway",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "EASTERN",
      "crimetime": "1239"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.59842, 39.31605]
    },
    "properties": {
      "crimedate": "2016-02-19T00:00:00.000",
      "post": "342",
      "location_1_address": null,
      "location": "2300 AIKEN ST",
      "description": "SHOOTING",
      "neighborhood": "East Baltimore Midway",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "EASTERN",
      "crimetime": "1239"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.60933, 39.34107]
    },
    "properties": {
      "crimedate": "2011-04-26T00:00:00.000",
      "post": "524",
      "location_1_address": null,
      "location": "500 E 43RD ST",
      "description": "SHOOTING",
      "neighborhood": "Wilson Park",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "NORTHERN",
      "crimetime": "0150"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.67385, 39.28643]
    },
    "properties": {
      "crimedate": "2016-02-27T00:00:00.000",
      "post": "842",
      "location_1_address": null,
      "location": "3400 W CATON AV",
      "description": "SHOOTING",
      "neighborhood": "Saint Josephs",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHWESTERN",
      "crimetime": "1345"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.63108, 39.30639]
    },
    "properties": {
      "crimedate": "2013-02-12T00:00:00.000",
      "post": "132",
      "location_1_address": null,
      "location": "1700 MADISON AV",
      "description": "SHOOTING",
      "neighborhood": "Madison Park",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "CENTRAL",
      "crimetime": "1929"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.53242, 39.33067]
    },
    "properties": {
      "crimedate": "2013-01-31T00:00:00.000",
      "post": "441",
      "location_1_address": null,
      "location": "5900 RADECKE AV",
      "description": "SHOOTING",
      "neighborhood": "Cedonia",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "NORTHEASTERN",
      "crimetime": "2136"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.67429, 39.311]
    },
    "properties": {
      "crimedate": "2016-02-22T00:00:00.000",
      "post": "812",
      "location_1_address": null,
      "location": "3400 CLIFTON AV",
      "description": "SHOOTING",
      "neighborhood": "Mount Holly",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "SOUTHWESTERN",
      "crimetime": "1305"
    }
  }, {
    "type": "Feature",
    "geometry": {
      "type": "Point",
      "coordinates": [-76.66198, 39.34353]
    },
    "properties": {
      "crimedate": "2011-04-26T00:00:00.000",
      "post": "532",
      "location_1_address": null,
      "location": "4500 LANIER AV",
      "description": "SHOOTING",
      "neighborhood": "Parklane",
      "total_incidents": "1",
      "location_1_city": null,
      "location_1_state": null,
      "crimecode": "9S",
      "weapon": "FIREARM",
      "location_1_zip": null,
      "district": "NORTHERN",
      "crimetime": "2316"
    }
  }],
  "crs": {
    "type": "name",
    "properties": {
      "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
    }
  }
};

function initMap() {
  var infowindow = new google.maps.InfoWindow();
  /*var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, {
    center: {
      lat: 39.2888414,
      lng: -76.6099112
    },
    zoom: 12
  });*/
    
    var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(38.434046,-74.340284),
          zoom: 8,

            mapTypeControl: false,
            streetViewControl: false,
            zoomControl: false,
            scaleControl: false,
            rotateControl: false,
            fullscreenControl: false,
            minZoom: 2,
            
            styles: [
  {
    "stylers": [
      {
        "visibility": "on"
      }
    ]
  },
  {
    "elementType": "labels",
    "stylers": [
      {
        "saturation": "-100"
      },
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
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
    "stylers": [
      {
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
    "stylers": [
      {
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
    "stylers": [
      {
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
    "stylers": [
      {
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
    "stylers": [
      {
        "color": "#4d6059"
      }
    ]
  },
  {
    "featureType": "landscape",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4d6059"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#4d6059"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "lightness": 21
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#4d6059"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#4d6059"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
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
    "stylers": [
      {
        "color": "#7f8d89"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      {
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
    "stylers": [
      {
        "color": "#7f8d89"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#7f8d89"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.fill",
    "stylers": [
      {
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
    "stylers": [
      {
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
    "stylers": [
      {
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
    "stylers": [
      {
        "color": "#7f8d89"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#7f8d89"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#000000"
      },
      {
        "lightness": 19
      }
    ]
  },
  {
    "featureType": "water",
    "stylers": [
      {
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
    "stylers": [
      {
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
    "stylers": [
      {
        "color": "#0d0e0f"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "color": "#24282b"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
]
});
    
  google.maps.event.addListener(map, 'zoom_changed', function() {
    var zoom = map.getZoom();
    if (zoom > 12) {
      // hide the heatmap, show the markers
      heatmap.setMap(null);
      map.data.setMap(map);
    } else {
      // hide the markers, show the heatmap
      heatmap.setMap(map);
      map.data.setMap(null);
    }
  })

  google.maps.event.addListener(map, 'click', function() {
    infowindow.close();
  });
  // map.data.loadGeoJson('https://data.baltimorecity.gov/resource/4ih5-d5d5.geojson?description=SHOOTING');
  map.data.addGeoJson(geoJsonShooting);
  // map.data.loadGeoJson('https://data.baltimorecity.gov/resource/4ih5-d5d5.geojson?description=HOMICIDE');

  var data;
  /*   $.ajax({
        dataType: "json",
        url: "https://data.baltimorecity.gov/resource/4ih5-d5d5.geojson?description=SHOOTING",
        data: data,
        success: letsGo
      });
  */
  var JSONLoaded;

  var latLngList = [];
  var heatMapData = [];

  function letsGo(mapData) {
    // console.log(mapData.features.length);

    for (i = 0; i < mapData.features.length; i++) {
      tempLocation = mapData.features[i]
      latLngList.push(tempLocation.geometry.coordinates);
      //console.log(latLngList);
    }

    // console.log(latLngList);
    // console.log(latLngList.length);
    for (i = 0; i < latLngList.length; i++) {
      var tempLat = latLngList[i][1];
      var tempLong = latLngList[i][0];
      var tempVar = new google.maps.LatLng(tempLat, tempLong);
      heatMapData.push(new google.maps.LatLng(tempLat, tempLong));
      //  console.log(tempLat);
      //  console.log(tempLong);
    }

    var pointArray = new google.maps.MVCArray(heatMapData);

    //  console.log(pointArray);

    heatmap = new google.maps.visualization.HeatmapLayer({
      data: pointArray
    });

    console.log("got to heatmap");
    heatmap.setMap(map);
    map.data.setMap(null);
  }

  map.data.addListener('click', function(event) {
    infowindow.setContent(event.feature.getProperty('description') + "<br>" + event.feature.getProperty('crimedate'));
    infowindow.setPosition(event.latLng);
    infowindow.setOptions({
      pixelOffset: new google.maps.Size(0, -34)
    });
    infowindow.open(map);
  });

  letsGo(geoJsonShooting);

google.maps.event.addDomListener(window, 'load', initMap);
    }
</script>

<script async 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbNu4nnoEfW9vB55Ns4Ud1jqxeLH13qpQ&callback=initMap&libraries=visualization">    
</script>