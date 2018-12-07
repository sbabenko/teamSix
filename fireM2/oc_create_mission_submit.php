<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: oc_create_mission_submit.php
 *
 * Date Last Modified: December 1, 2018 (Stanislav Babenko)
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
 * This file updates the database with the information specified for the
 * new mission.
 */

require("db.php");

//range validation done in HTML select element in preceeding script page
//no possible issue of negative values here
//may want to modify get_resource to limit resources to those where
//quanitity > 0 later to limit generated resource objects to positive integers only
function resourceHandler($key, $value, $mysqli, $missionID) {
    //code to be executed;
    if ($value > 0){
        $key = str_replace('\'', '', $key);
        $key = str_replace('_', ' ', $key);
        //echo $key;
        //echo "<--- key";
        $query = "UPDATE resource SET quantity = quantity - $value WHERE resourceName = '$key';";
        $result = $mysqli->query($query);
        if (!$result) {
            die('Invalid query to modify resource in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
        }
        
        //get resourceID
        $query = "SELECT resourceID FROM resource WHERE resourceName = '$key';";
        $result = $mysqli->query($query);
        if (!$result) {
            die('Invalid query to resourceID in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
        }
        
        $resourceID = $result->fetch_assoc()["resourceID"];
        
        $query = "insert into resourceMission(missionID, resourceID, " .
            "quantity) values (" . $missionID . ", " . $resourceID . ", " .
            $value . ")";
        
        $result = $mysqli->query($query);
        if (!$result) {
            die('Invalid query to add resources in oc_create_mission_submit.php: ' . mysqli_error($mysqli));
        }
    }
}

function missionAssignManagerHandler($email, $mysqli, $missionID) {
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
        resourceHandler($key, $value, $mysqli, $globalMissionID);
    }

}

echo '<script type="text/javascript">alert("Mission Created Successfully");</script>';
echo '<script type="text/javascript"> location.reload(); </script>';

?>
