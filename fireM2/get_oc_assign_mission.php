<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: get_oc_assign_mission.php
 *
 * Date Last Modified: November 30, 2018 (Aditya Kaliappan)
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
 * This file returns a table of unassigned events, with options to
 * toggle mission assignment and event deletion.
 */

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

//create mission dropdown
$dropdown = '<select><option value="none" selected>Select Mission</option>';

while ($row = @mysqli_fetch_assoc($result)){
  $dropdown = $dropdown . '<option value="' . $row["missionID"] . '">' .
              $row["missionName"] . '</option>';
}

$dropdown = $dropdown . '</select>';

//Select all unassigned events
$query = "SELECT * FROM mmEvent where missionID IS NULL";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";

//create div to hold table
echo "<div class = 'tableInfo'>";

//create table of general information
echo '<h2>Assign to Mission</h2>';
echo '<br>';

//Apply defined-height box
echo '<div class = "resource-box assign-box parent">';
//echo '<br>'; //create space for the column headers

//create table of general information

if(mysqli_num_rows($result)==0){
  echo('<table class = "child" style="z-index:500;">');
 }else{
  echo('<table class = "child" style="position:fixed;z-index:500;">');
 }

echo '<col style="width:72%">';
echo '<col style="width:40%">';
echo '<col style="width:20%">';
echo '<tr>';
echo '<th>Event Name</th>';
echo '<th>Mission Name</th>';
echo '<th>Delete?</th>';
echo '</tr>';
echo '</table>';
echo '<table id = "assignMissionTable" style="margin-top:50px;">';
echo '<col style="width:70%">';
echo '<col style="width:30%">';
echo '<col style="width:20%">';
// Iterate through the rows
while ($row = @mysqli_fetch_assoc($result)){
  echo '<tr>';
  echo '<td><a href="javascript:openEvent(' . $row["eventID"] . ',`' .
      $row["eventName"] . '`, true, false)">';
  
  echo $row["eventName"];
  echo '</a></td>';
  echo '<td><div class="custom-dropdown-Assign" style="margin:0px;">' . $dropdown . '</div></td>';
  echo '<td><input type="checkbox" onChange="toggleDropdown(this)" value=' . $row["eventID"] . '></td>';
  echo '</tr>';
}

echo '</table>';
echo '<br>';
echo '<br>';
echo '</div>';

//add update button
echo '<button id="myBtn" class="assign_msn_btn_1" onclick="updateAssignMission()">UPDATE</button>';

//add refresh button
echo '<button id="myBtn" class="assign_msn_btn_2" onclick="refreshAssignMission()">REFRESH</button>';

// End XML file
echo '</div>';

?>


<!--adjusts the width of the fixed table header labels to that of the resource box 
source:
https://stackoverflow.com/questions/16018520/is-it-possible-to-keep-the-width-of-the-parent-element-when-position-fixed-is-a
-->
<script>
 function toggleFixed() {
   adjustWidth();
   $(".child").toggleClass("fixed");
 }

 function adjustWidth() {
   var parentwidth = $(".parent").width();
   parentwidth = parentwidth - 31;
   $(".child").width(parentwidth);
 }

 $(function() {

   $("#fixer").click(
     function() {
       toggleFixed();
     });

   $(window).resize(
     function() {
       adjustWidth();
     })

     $(window).ready(
     function() {
       adjustWidth();
     })

 })
</script>