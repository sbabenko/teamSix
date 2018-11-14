<?php
require 'db.php';

header('Content-Type: application/json');

$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

$query = "select sum(percent) / count(*) * 100 as totalPercent from (select (case when state = 'assigned' then 0 when state = 'on hold' then 0.33 when state = 'in progress' then 0.66 when state = 'completed' then 1 end) as percent from mmEvent natural join eventState where (eventID, updateTime) in (select eventID, max(updateTime) from eventState group by eventID) and missionID = 1) as eventPercent";

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