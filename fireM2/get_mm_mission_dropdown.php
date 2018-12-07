<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: get_mm_mission_dropdown.php
 *
 * Date Last Modified: November 18, 2018 (Stanislav Babenko)
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
 * This file returns contents of the mission dropdown in the Mission Manager
 * dashboard.
 */

require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

// Select all missions
$query = "SELECT * FROM mission natural join missionAssignment WHERE isActive = true " .
    "AND accountEmail = '" . $_GET["email"] . "'";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

$counter = 0;
$selected = null;

$dropdown = '<select id="mmToggle" onchange="updateMission(this)" 
style="max-width:190px;box-shadow: 3px 3px 8px #818181;">';

//iterate through rows to add dropdown options
while ($row = @mysqli_fetch_assoc($result)){
  $dropdown = $dropdown . '<option value="' . $row["missionID"] . '"';
    
  if($selected == null){
      $selected = $row["missionID"];
  }

  if($row["missionID"] == $_GET["missionID"]){
      $dropdown = $dropdown . " selected";
      $selected = $row["missionID"];
  }
    
  $dropdown = $dropdown . '>' . $row["missionName"] . '</option>';

  $counter += 1;
}

$dropdown = $dropdown . '</select>';

header("Content-type: text/xml");

//prepend selected missionID
if($selected == null){
  echo "null";
} else{
  echo $selected;
}

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";

//create div to hold table
echo "<div>";
echo '<span class="custom-dropdown-MM" style="margin: -7px 0px 00px 5px;">';
echo  $dropdown;
echo '<span>';
echo '</div>';
?>