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
$query = "SELECT * FROM mission natural join missionAssignment WHERE isActive = true " .
    "AND accountEmail = '" . $_GET["email"] . "'";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

$dropdown = '<select id="mmToggle" onchange="updateMission(this)">';

while ($row = @mysqli_fetch_assoc($result)){
  $dropdown = $dropdown . '<option value="' . $row["missionID"] . '"';

  if($row["missionID"] == $_GET["missionID"]){
      $dropdown = $dropdown . " selected";
  }
    
  $dropdown = $dropdown . '>' . $row["missionName"] . '</option>';
}

$dropdown = $dropdown . '</select>';

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";

//create div to hold table
echo "<div>" . $dropdown . '</div>';

?>