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

?>