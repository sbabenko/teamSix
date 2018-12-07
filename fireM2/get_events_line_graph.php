<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: get_events_line_graph.php
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
 * This file returns the number of incoming events per hour within the
 * last 24 hours.
 */

require 'db.php';

//setting header to json
header('Content-Type: application/json');

//Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

//Select number of events within last day
$query = "select hour(timediff(now(), updateTime)) as elapsedTime, count(*) as quantity
            from eventState
            where updateTime > date_sub(now(), interval 1 day) and state = 'reported'
            group by elapsedTime;";

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