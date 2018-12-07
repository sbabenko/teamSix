<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: delete_event.php
 *
 * Date Last Modified: November 13, 2018 (Aditya Kaliappan)
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
 * This file deletes a specified event, as well as its notes and state
 * changes, from the database.
 */

require("db.php");

//query to delete all notes attached with event
$query = "DELETE FROM eventNote WHERE eventID = " . $_POST["eventID"];
    
//delete all notes for event
$result = $mysqli->query($query);
if (!$result) {
    die('Invalid query: ' . mysqli_error($mysqli));
}
    
//query to delete state attached with event
$query = "DELETE FROM eventState WHERE eventID = " . $_POST["eventID"];
    
//delete all states for event
$result = $mysqli->query($query);
if (!$result) {
    die('Invalid query: ' . mysqli_error($mysqli));
}
    
//query to delete event
$query = "DELETE FROM mmEvent WHERE eventID = " . $_POST["eventID"];

//delete event
$result = $mysqli->query($query);
if (!$result) {
    die('Invalid query: ' . mysqli_error($mysqli));
}

?>