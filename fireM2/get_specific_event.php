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

// Select all the rows in the markers table
$query = "SELECT * FROM mmEvent WHERE missionID = 1";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";

//create div to hold all tables
echo "<div class = 'eventInfo'>";

//create table of general information
echo '<table>';

//get general information for event
$row = @mysqli_fetch_assoc($result);

//latitude information
echo '<tr>';
echo '<th>Latitude</th>';
echo '<td>' . $row['latitude'] . '</td>';
echo '</tr>';

// End XML file
echo '</table>';
echo '</div>';

?>