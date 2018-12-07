<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: update_oc_mission_info.php
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
 * This file updates the database by returning resources back to the
 * pool of all available resources once a mission is completed.
 */

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