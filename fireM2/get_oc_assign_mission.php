<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

// Select all missions
$query = "SELECT * FROM mission WHERE isActive = true";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

$dropdown = '<select><option value="none" selected>Select Mission</option>';

while ($row = @mysqli_fetch_assoc($result)){
  $dropdown = $dropdown . '<option value="' . $row["missionID"] . '">' .
              $row["missionName"] . '</option>';
}

$dropdown = $dropdown . '</select>';

//Select all unassigned events where char len < 50 (more than 50 will mess up styling)
//Will fix it later
$query = "SELECT * FROM mmEvent where missionID IS NULL AND CHAR_LENGTH(eventName) < 25";


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
echo '<br>';
echo '<div id = "assign_mission_col_headers">';
echo 'Event Name';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo 'Mission Name';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
echo 'Delete?';
echo '</div>';

//Apply defined-height box
echo '<div class = "resource-box assign-box">';
echo '<br>'; //create space for the column headers

// Iterate through the rows
while ($row = @mysqli_fetch_assoc($result)){
  echo '<div class="assignMissionObject">';
  
  echo '<div class="assign_mission_incident" id="assign_mission_names"><a href="javascript:openEvent(' . $row["eventID"] . ',`' .
      $row["eventName"] . '`, true, false)">';
  
  echo $row["eventName"];
  echo '</a></div>';

  echo '<div class="custom-dropdown" style="margin:0px;">';
  echo '<div class="assign_mission_dropdown">';
  echo $dropdown;
  echo '</div>';
  echo '</div>';

  echo '<div class="assign_checkbox"><input type="checkbox" onChange="toggleDropdown(this)" value=' . $row["eventID"] . '></div>';
  echo '</div>';
}

echo '</div>';

//add update button
echo '<button id="myBtn" class="assign_msn_btn_1" onclick="updateAssignMission()">UPDATE</button>';

//add refresh button
echo '<button id="myBtn" class="assign_msn_btn_2" onclick="refreshAssignMission()">REFRESH</button>';

// End XML file
echo '</div>';

?>