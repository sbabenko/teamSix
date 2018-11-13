<?php
require("db.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

// Select all missions
$query = "SELECT * FROM mission WHERE isActive = true";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

$dropdown = '<select><option value = "none"></option>';

while ($row = @mysqli_fetch_assoc($result)){
  $dropdown = $dropdown . '<option value="' . $row["missionID"] . '">' .
              $row["missionName"] . '</option>';
}

$dropdown = $dropdown . '</select>';

// Select all unassigned events
$query = "SELECT * FROM mmEvent where missionID IS NULL";

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
echo '<h2>Assign to Mission</h2>';
echo '<table id = "assignMissionTable">';
echo '<tr>';
echo '<th>Event Name</th>';
echo '<th>Mission Name</th>';
echo '<th>Delete?</th>';
echo '</tr>';

// Iterate through the rows
while ($row = @mysqli_fetch_assoc($result)){
  echo '<div class="assignMissionObject">';
  echo '<div><a href="javascript:openEvent(' . $row["eventID"] . ',`' .
      $row["eventName"] . '`, true, false)">';
  
  echo $row["eventName"];
  echo '</a></div>';
  echo '<div>' . $dropdown . '</div>';
  echo '<div><input type="checkbox" onChange="toggleDropdown(this)" value=' . $row["eventID"] . '></div>';
  echo '</div>';
}

echo '</table>';

//add update button
echo '<button onclick="updateAssignMission()">UPDATE</button>';

//add refresh button
echo '<button onclick="refreshAssignMission()">REFRESH</button>';

// End XML file
echo '</div>';

?>