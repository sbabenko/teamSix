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
$query = "SELECT * FROM mmEvent";

#$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<div class="events">';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<div class = "eventObject">';

  //gives the event object the name of the event
  echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . parseToXML($row['eventName']) . ' ';
  
  //produces the "open" and "delete" buttons in the event object
  echo '<br>';
  echo '<button id="myBtn" onclick="openEvent(this, ' . $row["eventID"] .')">OPEN</button>';
  echo '&nbsp&nbsp';
  echo '<button id="delBtn" onclick="openEvent(this, ' . $row["eventID"] .')">DELETE</button>';

  echo '</div>';


  $ind = $ind + 1;
}

// End XML file
echo '</div>';

?>