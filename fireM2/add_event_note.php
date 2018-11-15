<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

//query to add note to event
$query = "INSERT INTO eventNote (eventID, createTime, description) " .
    "VALUES (" . $_POST["eventID"] . ", now(), '" . $_POST["note"] . "')";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

?>