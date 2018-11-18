<?php
require("db.php");

//range validation done in HTML select element in preceeding script page
//no possible issue of negative values here
//may want to modify get_resource to limit resources to those where
//quanitity > 0 later to limit generated resource objects to positive integers only
function resourceHandler($key, $value, $mysqli) {
    //code to be executed;
    if ($value > 0){
        $key = str_replace('\'', '', $key);
        //echo $key;
        //echo "<--- key";
        $query = "UPDATE resource SET quantity = quantity - $value WHERE resourceName = '$key';"; //"SELECT * FROM resource";
        $result = $mysqli->query($query);
        if (!$result) {
            die('Invalid query to modify resource in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
        }
    }
}

function missionAssignManagerHandler($ManagerName, $mysqli, $missionID) {
    //look up email by last name

    $names = explode(" ", $ManagerName);

    $query = "SELECT * FROM userAccount WHERE firstName = '$names[1]' AND lastName = '$names[2]'";

    $result = $mysqli->query($query);
        if (!$result) {
            die('Invalid query to get manager name in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
        }

    //should just be one name, but I don't know how to access just one row by a name lookup
    //so i put in a while loop for now
    while($row = $result->fetch_assoc()) {
            $email = $row["email"];
    }

    //assign mission name by file scope variable from 

    $query = "INSERT INTO FIREM2.missionAssignment (accountEmail, missionID) VALUES ('$email', $missionID)";

    $result = $mysqli->query($query);
        if (!$result) {
            die('Invalid query to assign Mission ID in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
    }
}

function missionNameHandler($name, $sqlObject) {
    //code to be executed;
    //echo $name;
    
    $query = "INSERT INTO mission (missionName,isActive) VALUES ('$name',1);"; //"SELECT * FROM resource";

    $result = $sqlObject->query($query);
    if (!$result) {
        die('Invalid query to name new mission in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
    }

    //Get back mission ID from missionName
    $query = "SELECT * FROM mission WHERE missionName = '$name'";

    $result = $sqlObject->query($query);
        if (!$result) {
            die('Invalid query to get mission ID in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
        }

    //should just be one name, but I don't know how to access just one row by a name lookup
    //so i put in a while loop for now
    while($row = $result->fetch_assoc()) {
            $missionID = $row["missionID"];
    }
    
    //echo '<script type="text/javascript">alert("Getting Mission Id...");</script>';
    return $missionID;

}

$params = array();
parse_str($_POST['passedInFormData'], $params);

$globalMissionID = "";

foreach ($params as $key => $value) {

    if ($key == "input_mission_name"){

        //Sent to server and new mission generated
        //returns a string of the new mission ID
        //which is passed to file scope variable
        //that variable is passed to missionAssignManagerHandler() below
        //since input_mission_name is the first item in the params array
        //this conditional should always run first
        //therefore, there should be no issue passing a null mission ID
        //to missionAssignManagerHandler() below
        $globalMissionID = missionNameHandler($value, $mysqli);

    }else if($key == "input_mission_manager"){
        missionAssignManagerHandler($value, $mysqli, $globalMissionID);
    }else{
        resourceHandler($key, $value, $mysqli);
    }

}

echo '<script type="text/javascript">alert("Mission Created Successfully");</script>';
echo '<script type="text/javascript"> location.reload(); </script>';

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
