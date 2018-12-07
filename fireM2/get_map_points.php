<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: get_map_points.php
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
 * This file returns the information regarding map points to be displayed
 * on the map.
 */

require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

$query = "SELECT * FROM mmEvent natural join eventState WHERE (eventID, updateTime) " .
    "in (SELECT eventID, max(updateTime) FROM eventState GROUP BY eventID) AND missionID ";

if($_GET['missionID'] == null){
    $query = $query . "IS NULL ";
} else{
    $query = $query . "= " . $_GET['missionID'];
}

//convert list of categories to remove as PHP array
$category = json_decode($_GET['category']);

//iterate through categories to remove
foreach($category as $cat){
    $query = $query . " AND category != '" . $cat . "'";
}

//convert list of submission methods to remove as PHP array
$submitMethod = json_decode($_GET['submitMethod']);

//iterate through submission methods to remove
foreach($submitMethod as $method){
    $query = $query . " AND submitMethod != '" . $method . "'";
}

//convert list of event states to remove as PHP array
$eventState = json_decode($_GET['eventState']);

//iterate through event states to remove
foreach($eventState as $state){
    $query = $query . " AND state != '" . $state . "'";
}

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
