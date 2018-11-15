<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

//query to update mission to inactive
$query = "UPDATE mission SET isActive = false WHERE missionID = " 
    . $_POST["missionID"];

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

//query to add resources back to table
$query = "UPDATE resource, resourceMission SET resource.quantity = " .
    "resource.quantity + resourceMission.quantity WHERE resource.resourceID " .
    "= resourceMission.resourceID AND missionID = " . $_POST["missionID"];

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

?>