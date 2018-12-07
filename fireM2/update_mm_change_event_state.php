<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: update_mm_change_event_state.php
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
 * This file updates the database by updating the state of each
 * event to the desired new state.
 */

require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
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