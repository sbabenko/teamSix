<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

//query to assign event to mission
$query = "UPDATE mmEvent SET missionID = " . $_POST["missionID"] .
    " WHERE eventID = " . $_POST["eventID"];

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

//query to set event to assigned state
$query = "INSERT INTO eventState (eventID, updateTime, state) VALUES (" . $_POST["eventID"] .
    ", now(), 'assigned')";
    
//add new state for event
$result = $mysqli->query($query);
if (!$result) {
    die('Invalid query: ' . mysqli_error($mysqli));
}

?>
