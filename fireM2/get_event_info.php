<?php
require("db.php");

// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error($mysqli));
}

//select specific event information
$query = "SELECT * FROM mmEvent WHERE eventID = " . $_GET['eventID'];

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
echo '<h2>General Information</h2>';
echo '<br>';
echo '<table>';
echo '<col style="width:50%">';
echo '<col style="width:50%">';

//get general information for event
$row = @mysqli_fetch_assoc($result);

//latitude information
echo '<tr>';
echo '<th>Latitude</th>';
echo '<td>' . $row['latitude'] . '</td>';
echo '</tr>';

//longitude information
echo '<tr>';
echo '<th>Longitude</th>';
echo '<td>' . $row['longitude'] . '</td>';
echo '</tr>';

//category information
echo '<tr>';
echo '<th>Category</th>';
echo '<td>' . $row['category'] . '</td>';
echo '</tr>';

//report submission information
echo '<tr>';
echo '<th>Submission Method</th>';
echo '<td>' . $row['submitMethod'] . '</td>';
echo '</tr>';
echo '</table>';

echo '<br>';

//select event state information
$query = "SELECT * FROM eventState WHERE eventID = " . $_GET['eventID'] . " ORDER BY updateTime DESC";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}


//create table of state changes
echo '<br>';
echo '<h2>Changes in State</h2>';
echo '<br>';
echo '<table>';
echo '<col style="width:60%">';
echo '<col style="width:40%">';
echo '<tr>';
echo '<th>Timestamp</th>';
echo '<th>State</th>';
echo '</tr>';

//iterate through each row and add state change to table
while ($row = @mysqli_fetch_assoc($result)){
  echo '<tr align="center">';
  echo '<td align="center">' . $row["updateTime"] . '</td>';
  echo '<td align="center">' . $row["state"] . "</td>";
  echo '</tr>';
}

echo '</table>';

echo '<br>';

//select event notes information
$query = "SELECT * FROM eventNote WHERE eventID = " . $_GET['eventID'] . " ORDER BY createTime DESC";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

//create table of written notes
echo '<br>';
echo '<h2>Written Notes</h2>';
echo '<br>';
echo '<table>';
echo '<col style="width:30%">';
echo '<col style="width:70%">';
echo '<tr>';
echo '<th>Timestamp</th>';
echo '<th>Note</th>';
echo '</tr>';

//iterate through each row and add state change to table
while ($row = @mysqli_fetch_assoc($result)){
  echo '<tr>';
  echo '<td>' . $row["createTime"] . '</td>';
  echo '<td>' . $row["description"] . "</td>";
  echo '</tr>';
}

echo '</table>';

if($_GET["isNote"] == "true"){
  //written note text field
  echo '<br>';
  echo '<p>Add Written Note</p>';
  echo '<input type="text" id="writtenNote" style="height: 100px;width: 500px;margin: auto;width: 70%;">';
  echo '<br>';

  //add note button
  echo '<button id="myBtn" onclick="addWrittenNote(' . $_GET['eventID'] .
      ')">ADD</button>';
}

if($_GET["isChange"] == "true"){
  //assign to mission dropdown
  echo '<p>Assign to Mission</p>';

  //query for all available mission
  $query = "SELECT * FROM mission WHERE isActive = true";

  $result = $mysqli->query($query);
  if (!$result) {
    die('Invalid query: ' . mysqli_error($mysqli));
  }

  //generate dropdown for all available mission
  $dropdown = '<select id="eventAssignDropdown"><option value = "none"></option>';

  while ($row = @mysqli_fetch_assoc($result)){
    $dropdown = $dropdown . '<option value="' . $row["missionID"] . '">' . 
        $row["missionName"] . '</option>';
  }

  $dropdown = $dropdown . '</select>';

  echo $dropdown;

  //assign button
  echo '<button id="myBtn" onclick="assignEvent(' . $_GET['eventID'] .
      ')">ASSIGN</button>';

  echo '<br>';

  //delete event button
  echo '<button id="myBtn" onclick="deleteEvent(' . $_GET['eventID'] .
      ')">DELETE</button>';   
}

//refresh modal button
echo '<button id="myBtn" onclick="refreshEventModal(' . $_GET['eventID'] .
    ')">REFRESH</button>';

// End XML file
echo '</div>';

?>