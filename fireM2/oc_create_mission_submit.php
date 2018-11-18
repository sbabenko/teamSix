<?php
require("db.php");


function resourceHandler() {
    //code to be executed;
    echo "CCCCC";
}

function missionAssignManagerHandler() {
    //code to be executed;
    echo "BBBB";
}

function missionNameHandler($name, $sqlObject) {
    //code to be executed;
    echo $name;

    $query = "INSERT INTO mission (missionName,isActive) VALUES ('$name',1);"; //"SELECT * FROM resource";

    $result = $sqlObject->query($query);
    if (!$result) {
        die('Invalid query to name new mission in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
    }

}

$params = array();
parse_str($_POST['passedInFormData'], $params);

foreach ($params as $key => $value) {

    //Delete this stuff later
    echo "<tr>";
    echo "<td>";

    if ($key == "input_mission_name"){
        missionNameHandler($value, $mysqli);
    }else if($key == "input_mission_manager"){
        missionAssignManagerHandler();
    }else{
        resourceHandler();
    }

    //Delete this stuff later
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
}


echo '<script type="text/javascript">alert("Mission Created Successfully");</script>';

//Delete this stuff later

// Select all unassigned events
$query = "SELECT * FROM resource";

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

if ($result->num_rows > 0) {
    //output stuff
} else {
    echo "0 results";
}


?>
