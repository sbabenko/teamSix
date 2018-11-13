<?php
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