<?php
require 'db.php';

header('Content-Type: application/json');

$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

$query = "select submitMethod, count(*) as quantity from mmEvent where " .
    "missionID = " . $_GET["missionID"] . " group by submitMethod;";

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

?>