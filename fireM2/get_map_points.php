<?php
require("db.php");
// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

//select all unassigned events
$query = "SELECT * FROM mmEvent where missionID IS NULL order by eventID";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

//Reference: https://gist.github.com/wboykinm/5730504
//parsing MySQL data into GeoJSON form
//initialize GeoJSON feature collection array
$geojson = array(
   'type' => 'FeatureCollection',
   'features' => array()
);

//iterate through each row
while($row = @mysqli_fetch_assoc($result)){
  //define feature for event
  $feature = array(
        'id' => $row['eventID'],
        'type' => 'Feature', 
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array($row['longitude'], $row['latitude'])
        ),
        # Pass other attribute columns here
        'properties' => array(
            'name' => $row['eventName'],
            )
        );
    
    //add feature to feature collection
    array_push($geojson['features'], $feature);
}


header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);

?>