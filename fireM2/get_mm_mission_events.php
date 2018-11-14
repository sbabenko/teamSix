<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

//select events in mission
$query = "SELECT * FROM mmEvent natural join eventState " .
    "WHERE (eventID, updateTime) in (SELECT eventID, max(updateTime) ".
    "from eventState group by eventID) and missionID = " . $_GET['missionID'];

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";

//create div to hold table
echo "<div class = 'eventInfo'>";

//create table of general information
echo '<h2>Change Event State</h2>';
echo '<table id = "changeEventStateTable">';
echo '<tr>';
echo '<th></th>';
echo '<th>Current State</th>';
echo '<th>On Hold</th>';
echo '<th>In Progress</th>';
echo '<th>Completed</th>';

// Iterate through the rows
while ($row = @mysqli_fetch_assoc($result)){
  echo '<tr data-value=' . $row["eventID"] . '>';
  echo '<td><a href="javascript:openEvent(' . $row["eventID"] . ',`' .
      $row["eventName"] . '`, true, false)">';
  echo $row["eventName"];
  echo '</a></td>';
  echo '<td>' . $row["state"] . '</td>';
  echo '<td><input type="checkbox" name="stateRow" onChange="updateStateRow(this)" value="on hold"';

  if($row["state"] != 'assigned'){
    echo ' disabled';
  }

  echo '></td>';
  
  echo '<td><input type="checkbox" name="stateRow" onChange="updateStateRow(this)" value="in progress"';
  
  if($row["state"] != 'assigned' && $row["state"] != 'on hold'){
    echo ' disabled';
  }

  echo '></td>';
  
  echo '<td><input type="checkbox" name="stateRow" onChange="updateStateRow(this)" value="completed"';
      
  if($row["state"] != 'in progress'){
    echo ' disabled';
  }

  echo '></td>';

  echo '</tr>';
}

echo '</table>';

//add update button
echo '<button id="myBtn" onclick="updateMissionEvents()">UPDATE</button>';

//add refresh button
echo '<button id="myBtn" onclick="refreshMissionEvents()">REFRESH</button>';

// End XML file
echo '</div>';

?>