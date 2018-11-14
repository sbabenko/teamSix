<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
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

$dropdown = '<select id="mmToggle" onchange="updateMission(this)">';

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
echo '<span class="custom-dropdown" style="margin: -7px 0px 00px 5px;">';
echo  $dropdown;
echo '<span>';
echo '</div>';
?>