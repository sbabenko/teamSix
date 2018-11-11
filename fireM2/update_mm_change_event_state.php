<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

//convert list of state assignments as PHP array
$assignment = json_decode($_POST['assignEvents']);

//iterate through events to remove
foreach($assignment as $assign){
    //query to set event to assigned state
    $query = "INSERT INTO eventState (eventID, updateTime, state) VALUES (" . $assign->eventID .
        ", now(), '" . $assign->state . "')";
    
    //add new state for event
    $result = $mysqli->query($query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($mysqli));
    }
}

?>