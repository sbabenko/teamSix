<?php
require('db.php');

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,'FIREM2');
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

header('Content-type: text/xml');

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<div>';

//table of events by state
echo '<h2>General Information</h2>';
echo '<table>';
echo '<tr>';
echo '<th>Event State</th>';
echo '<th>Number of Events</th>';
echo '</tr>';

// Select all missions
$query = 'SELECT count(*) as quantity, state FROM mmEvent natural join ' .
    'eventState WHERE (eventID, updateTime) in (SELECT eventID, ' .
    'max(updateTime) FROM eventState GROUP BY eventID) AND missionID = ' .
    $_GET['missionID'] . ' GROUP BY state';

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

while ($row = @mysqli_fetch_assoc($result)){
  echo '<tr>';
  echo '<td>' . $row['state'] . '</td>';
  echo '<td>' . $row['quantity'] . '</td>';
  echo '</tr>';
}

echo '</table>';

//table of resources allocated
echo '<h2>Resources Allocated</h2>';
echo '<table>';
echo '<tr>';
echo '<th>Resource Name</th>';
echo '<th>Quantity</th>';
echo '</tr>';

$query = 'SELECT resourceName, resourceMission.quantity as numResource FROM ' .
    'resource join resourceMission on resource.resourceID = ' .
    'resourceMission.resourceID WHERE missionID = ' . $_GET['missionID'];

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

while ($row = @mysqli_fetch_assoc($result)){
  echo '<tr>';
  echo '<td>' . $row['resourceName'] . '</td>';
  echo '<td>' . $row['numResource'] . '</td>';
  echo '</tr>';
}

echo '</table>';

//table of events by state
echo '<h2>Events in Mission</h2>';
echo '<table>';
echo '<tr>';
echo '<th>Event Name</th>';
echo '<th>Current State</th>';
echo '</tr>';

$query = 'SELECT eventID, eventName, state FROM mmEvent natural join ' .
    'eventState WHERE (eventID, updateTime) in (SELECT eventID, ' .
    'max(updateTime) FROM eventState GROUP BY eventID) AND missionID = ' .
    $_GET['missionID'];

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

while ($row = @mysqli_fetch_assoc($result)){
  echo '<tr>';
  echo '<td><a href="javascript:openEvent(this, ' . $row["eventID"] . ',`' 
                                                  . $row["eventName"] . '`)">';
  
  echo $row["eventName"];
  echo '</a></td>';
  echo '<td>' . $row['state'] . '</td>';
  echo '</tr>';
}

echo '</table>';

//add refresh button
echo '<button onclick="refreshMissionProgress(' . $_GET["missionID"] .
    ')">REFRESH</button>';

echo '</div>';

?>