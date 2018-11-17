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
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

// Select all unassigned events
$query = "SELECT * FROM resource";

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
if ( $result->num_rows == 0 ){ // User has no existing contacts
  echo "<div style='align:center;'>";
  echo "You have no resources available";
  echo "</div>";
}else{
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<div class = "eventObject">';

  //gives the event object the name of the event

  echo '&nbsp&nbsp&nbsp' . parseToXML($row['quantity']) .' '. parseToXML($row['resourceName']) . '(s) currently available for tasking ';
  echo '<br>';
  
  //produces the "open" and "delete" buttons in the event object
  echo '<br>';
  echo '<form action=\'/action_page.php\'>';
  echo '&nbsp&nbsp&nbsp Assign quantity (between 1 and '. parseToXML($row['quantity']) .'):';
  echo '<input type="number" style="float:right;width:20%;margin: -20px 20px 20px 0px;" name="quantity" max="'. parseToXML($row['quantity']) . '">';
  

  echo '</div>';


  $ind = $ind + 1;
}
}

// End XML file
echo '</div>';

?>