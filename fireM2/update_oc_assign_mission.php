<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: update_oc_assign_mission.php
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
 * This file updates the database by deleting any specified events,
 * or by assigning events to the desired mission.
 */

require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

//convert list of events to delete as PHP array
$toDelete = json_decode($_POST['deleteEvents']);

//iterate through events to remove
foreach($toDelete as $del){
    //query to delete all notes attached with event
    $query = "DELETE FROM eventNote WHERE eventID = " . $del;
    
    //delete all notes for event
    $result = $mysqli->query($query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($mysqli));
    }
    
    //query to delete state attached with event
    $query = "DELETE FROM eventState WHERE eventID = " . $del;
    
    //delete all states for event
    $result = $mysqli->query($query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($mysqli));
    }
    
    //query to delete event
    $query = "DELETE FROM mmEvent WHERE eventID = " . $del;
    
    //delete event
    $result = $mysqli->query($query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($mysqli));
    }
}

//convert list of mission assignments as PHP array
$assignment = json_decode($_POST['assignEvents']);

//iterate through events to assign
foreach($assignment as $assign){
    //query to update missionID of event
    $query = "UPDATE mmEvent SET missionID = " . $assign->missionID . " WHERE eventID = " . $assign->eventID;
    
    //update missionID for event
    $result = $mysqli->query($query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($mysqli));
    }
    
    //query to set event to assigned state
    $query = "INSERT INTO eventState (eventID, updateTime, state) VALUES (" . $assign->eventID .
        ", now(), 'assigned')";
    
    //add new state for event
    $result = $mysqli->query($query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($mysqli));
    }
}

?>