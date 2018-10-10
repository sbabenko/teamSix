
<div class = "mapWrapper">
  <div class ="map" id="map"></div>
</div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {

        // Heatmap data: 500 Points
      function getPoints() {
        return [
          new google.maps.LatLng(37.782551, -122.445368),
          new google.maps.LatLng(37.782745, -122.444586),
          new google.maps.LatLng(37.782842, -122.443688),
          new google.maps.LatLng(37.782919, -122.442815),
          new google.maps.LatLng(37.782992, -122.442112),
          new google.maps.LatLng(37.783100, -122.441461),
          new google.maps.LatLng(37.783206, -122.440829),
          new google.maps.LatLng(37.783273, -122.440324),
          new google.maps.LatLng(37.783316, -122.440023),
          new google.maps.LatLng(37.783357, -122.439794),
          new google.maps.LatLng(37.783371, -122.439687),
          new google.maps.LatLng(37.783368, -122.439666),
          new google.maps.LatLng(37.783383, -122.439594),
          new google.maps.LatLng(37.783508, -122.439525),
          new google.maps.LatLng(37.783842, -122.439591),
          new google.maps.LatLng(37.784147, -122.439668),
          new google.maps.LatLng(37.784206, -122.439686),
          new google.maps.LatLng(37.784386, -122.439790),
          new google.maps.LatLng(37.784701, -122.439902),
          new google.maps.LatLng(37.784965, -122.439938),
          new google.maps.LatLng(37.785010, -122.439947),
          new google.maps.LatLng(37.785360, -122.439952),
          new google.maps.LatLng(37.785715, -122.440030),
          new google.maps.LatLng(37.786117, -122.440119),
          new google.maps.LatLng(37.786564, -122.440209),
          new google.maps.LatLng(37.786905, -122.440270),
          new google.maps.LatLng(37.786956, -122.440279),
          new google.maps.LatLng(37.800224, -122.433520),
          new google.maps.LatLng(37.800155, -122.434101),
          new google.maps.LatLng(37.800160, -122.434430),
          new google.maps.LatLng(37.800378, -122.434527),
          new google.maps.LatLng(37.800738, -122.434598),
          new google.maps.LatLng(37.800938, -122.434650),
          new google.maps.LatLng(37.801024, -122.434889),
          new google.maps.LatLng(37.800955, -122.435392),
          new google.maps.LatLng(37.800886, -122.435959),
          new google.maps.LatLng(37.800811, -122.436275),
          new google.maps.LatLng(37.800788, -122.436299),
          new google.maps.LatLng(37.800719, -122.436302),
          new google.maps.LatLng(37.800702, -122.436298),
          new google.maps.LatLng(37.800661, -122.436273),
          new google.maps.LatLng(37.800395, -122.436172),
          new google.maps.LatLng(37.800228, -122.436116),
          new google.maps.LatLng(37.800169, -122.436130),
          new google.maps.LatLng(37.800066, -122.436167),
          new google.maps.LatLng(37.784345, -122.422922),
          new google.maps.LatLng(37.784389, -122.422926),
          new google.maps.LatLng(37.784437, -122.422924),
          new google.maps.LatLng(37.784746, -122.422818),
          new google.maps.LatLng(37.785436, -122.422959),
          new google.maps.LatLng(37.786120, -122.423112),
          new google.maps.LatLng(37.786433, -122.423029),
          new google.maps.LatLng(37.786631, -122.421213),
          new google.maps.LatLng(37.786660, -122.421033),
          new google.maps.LatLng(37.786801, -122.420141),
          new google.maps.LatLng(37.786823, -122.420034),
          new google.maps.LatLng(37.786831, -122.419916),
          new google.maps.LatLng(37.787034, -122.418208),
          new google.maps.LatLng(37.787056, -122.418034),
          new google.maps.LatLng(37.787169, -122.417145),
          new google.maps.LatLng(37.787217, -122.416715),
          new google.maps.LatLng(37.786144, -122.416403),
          new google.maps.LatLng(37.785292, -122.416257),
          new google.maps.LatLng(37.780666, -122.390374),
          new google.maps.LatLng(37.780501, -122.391281),
          new google.maps.LatLng(37.780148, -122.392052),
          new google.maps.LatLng(37.780173, -122.391148),
          new google.maps.LatLng(37.780693, -122.390592),
          new google.maps.LatLng(37.781261, -122.391142),
          new google.maps.LatLng(37.781808, -122.391730),
          new google.maps.LatLng(37.782340, -122.392341),
          new google.maps.LatLng(37.782812, -122.393022),
          new google.maps.LatLng(37.783300, -122.393672),
          new google.maps.LatLng(37.783809, -122.394275),
          new google.maps.LatLng(37.784246, -122.394979),
          new google.maps.LatLng(37.784791, -122.395958),
          new google.maps.LatLng(37.785675, -122.396746),
          new google.maps.LatLng(37.786262, -122.395780),
          new google.maps.LatLng(37.786776, -122.395093),
          new google.maps.LatLng(37.787282, -122.394426),
          new google.maps.LatLng(37.787783, -122.393767),
          new google.maps.LatLng(37.788343, -122.393184),
          new google.maps.LatLng(37.788895, -122.392506),
          new google.maps.LatLng(37.789371, -122.391701),
          new google.maps.LatLng(37.789722, -122.390952),
          new google.maps.LatLng(37.790315, -122.390305),
          new google.maps.LatLng(37.790738, -122.389616),
          new google.maps.LatLng(37.779448, -122.438702),
          new google.maps.LatLng(37.779023, -122.438585),
          new google.maps.LatLng(37.778542, -122.438492),
          new google.maps.LatLng(37.778100, -122.438411),
          new google.maps.LatLng(37.777986, -122.438376),
          new google.maps.LatLng(37.777680, -122.438313),
          new google.maps.LatLng(37.777316, -122.438273),
          new google.maps.LatLng(37.777135, -122.438254),
          new google.maps.LatLng(37.776987, -122.438303),
          new google.maps.LatLng(37.776946, -122.438404),
          new google.maps.LatLng(37.776944, -122.438467),
          new google.maps.LatLng(37.776892, -122.438459),
          new google.maps.LatLng(37.776842, -122.438442),
          new google.maps.LatLng(37.776822, -122.438391),
          new google.maps.LatLng(37.776814, -122.438412),
          new google.maps.LatLng(37.776787, -122.438628),
          new google.maps.LatLng(37.776729, -122.438650),
          new google.maps.LatLng(37.776759, -122.438677),
          new google.maps.LatLng(37.776772, -122.438498),
          new google.maps.LatLng(37.776787, -122.438389),
          new google.maps.LatLng(37.776848, -122.438283),
          new google.maps.LatLng(37.776870, -122.438239),
          new google.maps.LatLng(37.777015, -122.438198),
          new google.maps.LatLng(37.777333, -122.438256),
          new google.maps.LatLng(37.777595, -122.438308),
          new google.maps.LatLng(37.777797, -122.438344),
          new google.maps.LatLng(37.778160, -122.438442),
          new google.maps.LatLng(37.778414, -122.438508),
          new google.maps.LatLng(37.778445, -122.438516),
          new google.maps.LatLng(37.778503, -122.438529),
          new google.maps.LatLng(37.778607, -122.438549),
          new google.maps.LatLng(37.778670, -122.438644),
          new google.maps.LatLng(37.778847, -122.438706),
          new google.maps.LatLng(37.779240, -122.438744),
          new google.maps.LatLng(37.779738, -122.438822),
          new google.maps.LatLng(37.780201, -122.438882),
          new google.maps.LatLng(37.780400, -122.438905),
          new google.maps.LatLng(37.780501, -122.438921),
          new google.maps.LatLng(37.780892, -122.438986),
          new google.maps.LatLng(37.781446, -122.439087),
          new google.maps.LatLng(37.781985, -122.439199),
          new google.maps.LatLng(37.782239, -122.439249),
          new google.maps.LatLng(37.782286, -122.439266),
          new google.maps.LatLng(37.797847, -122.429388),
          new google.maps.LatLng(37.797874, -122.429180),
          new google.maps.LatLng(37.797885, -122.429069),
          new google.maps.LatLng(37.797887, -122.429050),
          new google.maps.LatLng(37.797933, -122.428954),
          new google.maps.LatLng(37.798242, -122.428990),
          new google.maps.LatLng(37.798617, -122.429075),
          new google.maps.LatLng(37.798719, -122.429092),
          new google.maps.LatLng(37.798944, -122.429145),
          new google.maps.LatLng(37.799320, -122.429251),
          new google.maps.LatLng(37.799590, -122.429309),
          new google.maps.LatLng(37.799677, -122.429324),
          new google.maps.LatLng(37.799966, -122.429360),
          new google.maps.LatLng(37.800288, -122.429430),
          new google.maps.LatLng(37.800443, -122.429461),
          new google.maps.LatLng(37.800465, -122.429474),
          new google.maps.LatLng(37.800644, -122.429540),
          new google.maps.LatLng(37.800948, -122.429620),
          new google.maps.LatLng(37.801242, -122.429685),
          new google.maps.LatLng(37.801375, -122.429702),
          new google.maps.LatLng(37.801400, -122.429703),
          new google.maps.LatLng(37.801453, -122.429707),
          new google.maps.LatLng(37.801473, -122.429709),
          new google.maps.LatLng(37.801532, -122.429707),
          new google.maps.LatLng(37.801852, -122.429729),
          new google.maps.LatLng(37.802173, -122.429789),
          new google.maps.LatLng(37.802459, -122.429847),
          new google.maps.LatLng(37.802554, -122.429825),
          new google.maps.LatLng(37.802647, -122.429549),
          new google.maps.LatLng(37.802693, -122.429179),
          new google.maps.LatLng(37.802729, -122.428751),
          new google.maps.LatLng(37.766104, -122.409291),
          new google.maps.LatLng(37.766103, -122.409268),
          new google.maps.LatLng(37.766138, -122.409229),
          new google.maps.LatLng(37.778738, -122.415584),
          new google.maps.LatLng(37.778812, -122.415189),
          new google.maps.LatLng(37.778824, -122.415092),
          new google.maps.LatLng(37.778833, -122.414932),
          new google.maps.LatLng(37.778834, -122.414898),
          new google.maps.LatLng(37.778740, -122.414757),
          new google.maps.LatLng(37.778501, -122.414433),
          new google.maps.LatLng(37.778182, -122.414026),
          new google.maps.LatLng(37.777851, -122.413623),
          new google.maps.LatLng(37.777486, -122.413166),
          new google.maps.LatLng(37.777109, -122.412674),
          new google.maps.LatLng(37.776743, -122.412186),
          new google.maps.LatLng(37.776440, -122.411800),
          new google.maps.LatLng(37.776295, -122.411614),
          new google.maps.LatLng(37.776158, -122.411440),
          new google.maps.LatLng(37.775806, -122.410997),
          new google.maps.LatLng(37.775422, -122.410484),
          new google.maps.LatLng(37.775126, -122.410087),
          new google.maps.LatLng(37.775012, -122.409854),
          new google.maps.LatLng(37.775164, -122.409573),
          new google.maps.LatLng(37.775498, -122.409180),
          new google.maps.LatLng(37.775868, -122.408730),
          new google.maps.LatLng(37.776256, -122.408240),
          new google.maps.LatLng(37.776519, -122.407928),
          new google.maps.LatLng(37.776539, -122.407904),
          new google.maps.LatLng(37.776595, -122.407854),
          new google.maps.LatLng(37.776853, -122.407547),
          new google.maps.LatLng(37.777234, -122.407087),
          new google.maps.LatLng(37.777644, -122.406558),
          new google.maps.LatLng(37.778066, -122.406017),
          new google.maps.LatLng(37.778468, -122.405499),
          new google.maps.LatLng(37.778866, -122.404995),
          new google.maps.LatLng(37.779295, -122.404455),
          new google.maps.LatLng(37.779695, -122.403950),
          new google.maps.LatLng(37.779982, -122.403584),
          new google.maps.LatLng(37.780295, -122.403223),
          new google.maps.LatLng(37.780664, -122.402766),
          new google.maps.LatLng(37.781043, -122.402288),
          new google.maps.LatLng(37.781399, -122.401823),
          new google.maps.LatLng(37.781727, -122.401407),
          new google.maps.LatLng(37.781853, -122.401247),
          new google.maps.LatLng(37.781894, -122.401195),
          new google.maps.LatLng(37.782076, -122.400977),
          new google.maps.LatLng(37.782338, -122.400603),
          new google.maps.LatLng(37.782666, -122.400133),
          new google.maps.LatLng(37.783048, -122.399634),
          new google.maps.LatLng(37.783450, -122.399198),
          new google.maps.LatLng(37.783791, -122.398998),
          new google.maps.LatLng(37.784177, -122.398959),
          new google.maps.LatLng(37.784388, -122.398971),
          new google.maps.LatLng(37.784404, -122.399128),
          new google.maps.LatLng(37.784586, -122.399524),
          new google.maps.LatLng(37.784835, -122.399927),
          new google.maps.LatLng(37.785116, -122.400307),
          new google.maps.LatLng(37.785282, -122.400539),
          new google.maps.LatLng(37.785346, -122.400692),
          new google.maps.LatLng(37.765769, -122.407201),
          new google.maps.LatLng(37.765790, -122.407414),
          new google.maps.LatLng(37.765802, -122.407755),
          new google.maps.LatLng(37.765791, -122.408219),
          new google.maps.LatLng(37.765763, -122.408759),
          new google.maps.LatLng(37.765726, -122.409348),
          new google.maps.LatLng(37.765716, -122.409882),
          new google.maps.LatLng(37.765708, -122.410202),
          new google.maps.LatLng(37.765705, -122.410253),
          new google.maps.LatLng(37.765707, -122.410369),
          new google.maps.LatLng(37.765692, -122.410720),
          new google.maps.LatLng(37.765699, -122.411215),
          new google.maps.LatLng(37.765687, -122.411789),
          new google.maps.LatLng(37.765666, -122.412373),
          new google.maps.LatLng(37.765598, -122.412883),
          new google.maps.LatLng(37.765543, -122.413039),
          new google.maps.LatLng(37.765532, -122.413125),
          new google.maps.LatLng(37.765500, -122.413553),
          new google.maps.LatLng(37.765448, -122.414053),
          new google.maps.LatLng(37.765388, -122.414645),
          new google.maps.LatLng(37.765323, -122.415250),
          new google.maps.LatLng(37.765303, -122.415847),
          new google.maps.LatLng(37.765251, -122.416439),
          new google.maps.LatLng(37.765204, -122.417020),
          new google.maps.LatLng(37.765172, -122.417556),
          new google.maps.LatLng(37.765164, -122.418075),
          new google.maps.LatLng(37.765153, -122.418618),
          new google.maps.LatLng(37.765136, -122.419112),
          new google.maps.LatLng(37.765129, -122.419378),
          new google.maps.LatLng(37.765119, -122.419481),
          new google.maps.LatLng(37.765100, -122.419852),
          new google.maps.LatLng(37.765083, -122.420349),
          new google.maps.LatLng(37.765045, -122.420930),
          new google.maps.LatLng(37.764992, -122.421481),
          new google.maps.LatLng(37.764980, -122.421695),
          new google.maps.LatLng(37.764993, -122.421843),
          new google.maps.LatLng(37.764986, -122.422255),
          new google.maps.LatLng(37.764975, -122.422823),
          new google.maps.LatLng(37.764939, -122.423411),
          new google.maps.LatLng(37.764902, -122.424014),
          new google.maps.LatLng(37.764853, -122.424576),
          new google.maps.LatLng(37.764826, -122.424922),
          new google.maps.LatLng(37.764796, -122.425375),
          new google.maps.LatLng(37.764782, -122.425869),
          new google.maps.LatLng(37.764768, -122.426089),
          new google.maps.LatLng(37.764766, -122.426117),
          new google.maps.LatLng(37.764723, -122.426276),
          new google.maps.LatLng(37.764681, -122.426649),
          new google.maps.LatLng(37.782012, -122.404200),
          new google.maps.LatLng(37.781574, -122.404911),
          new google.maps.LatLng(37.781055, -122.405597),
          new google.maps.LatLng(37.780479, -122.406341),
          new google.maps.LatLng(37.779996, -122.406939),
          new google.maps.LatLng(37.779459, -122.407613),
          new google.maps.LatLng(37.778953, -122.408228),
          new google.maps.LatLng(37.778409, -122.408839),
          new google.maps.LatLng(37.777842, -122.409501),
          new google.maps.LatLng(37.777334, -122.410181),
          new google.maps.LatLng(37.776809, -122.410836),
          new google.maps.LatLng(37.776240, -122.411514),
          new google.maps.LatLng(37.775725, -122.412145),
          new google.maps.LatLng(37.775190, -122.412805),
          new google.maps.LatLng(37.774672, -122.413464),
          new google.maps.LatLng(37.774084, -122.414186),
          new google.maps.LatLng(37.773533, -122.413636),
          new google.maps.LatLng(37.773021, -122.413009),
          new google.maps.LatLng(37.772501, -122.412371),
          new google.maps.LatLng(37.771964, -122.411681),
          new google.maps.LatLng(37.771479, -122.411078),
          new google.maps.LatLng(37.770992, -122.410477),
          new google.maps.LatLng(37.770467, -122.409801),
          new google.maps.LatLng(37.770090, -122.408904),
          new google.maps.LatLng(37.769657, -122.408103),
          new google.maps.LatLng(37.769132, -122.407276),
          new google.maps.LatLng(37.768564, -122.406469),
          new google.maps.LatLng(37.767980, -122.405745),
          new google.maps.LatLng(37.767380, -122.405299),
          new google.maps.LatLng(37.766604, -122.405297),
          new google.maps.LatLng(37.765838, -122.405200),
          new google.maps.LatLng(37.765139, -122.405139),
          new google.maps.LatLng(37.764457, -122.405094),
          new google.maps.LatLng(37.763716, -122.405142),
          new google.maps.LatLng(37.762932, -122.405398),
          new google.maps.LatLng(37.762126, -122.405813),
          new google.maps.LatLng(37.761344, -122.406215),
          new google.maps.LatLng(37.760556, -122.406495),
          new google.maps.LatLng(37.759732, -122.406484),
          new google.maps.LatLng(37.758910, -122.406228),
          new google.maps.LatLng(37.758182, -122.405695),
          new google.maps.LatLng(37.757676, -122.405118),
          new google.maps.LatLng(37.757039, -122.404346),
          new google.maps.LatLng(37.756335, -122.403719),
          new google.maps.LatLng(37.755503, -122.403406),
          new google.maps.LatLng(37.754665, -122.403242),
          new google.maps.LatLng(37.753837, -122.403172),
          new google.maps.LatLng(37.752986, -122.403112),
          new google.maps.LatLng(37.751266, -122.403355)
        ];
      }

        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(38.434046,-74.340284),
          zoom: 8,

            mapTypeControl: false,
            streetViewControl: false,
            zoomControl: false,
            scaleControl: false,
            rotateControl: false,
            fullscreenControl: false,
            
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
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('map_api_test.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
                if (type == 'restaurant'){
                    var image = 'map_icons/hurricane_2.png';
                }else if (type == 'tsunami'){
                    var image = 'map_icons/tsunami.png';
                }else if (type == 'fire'){
                    var image = 'map_icons/fire.png';
                }
              var marker = new google.maps.Marker({
                icon: image,
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });

        var heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map
        });
        

        }// CLOSES INIT MAP

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbNu4nnoEfW9vB55Ns4Ud1jqxeLH13qpQ&callback=initMap&libraries=visualization">
    </script>
