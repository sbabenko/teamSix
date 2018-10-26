<?php
require 'db.php';

//setting header to json
header('Content-Type: application/json');

//Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

//Select number of events within last day
$query = "select hour(timediff(now(), updateTime)) as timeInterval, count(*) as quantity
            from eventState
            where updateTime > date_sub(now(), interval 1 day) and state = 'reported'
            group by timeInterval;";

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