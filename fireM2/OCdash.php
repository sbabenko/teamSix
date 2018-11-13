<?php
/*needed for queries to the user's contacts and messages*/
require 'db.php';
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}
//verify the user class before allowing access
else if ($_SESSION['role'] != 'OC'){
    $_SESSION['message'] = "You do not have the credentials to view this page!";
    header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}

//define constant to prevent direct access to PHP files containing tab contents
//https://stackoverflow.com/questions/409496/prevent-direct-access-to-a-php-include-file
define('OC_Tab', TRUE);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome
        <?= $first_name.' '.$last_name ?>
    </title>
    <?php include 'css/css.html'; ?>
</head>

<body>
    <ul class="dashboard-tab">
        <li class="tab active" onclick="showTab(1,5)"><a href="#IncidentMap">Incident Map</a></li>
        <li class="tab" onclick="showTab(2,5)"><a href="#CreateMission">Create Mission</a></li>
        <li class="tab" onclick="showTab(3,5); loadAssignMission();"><a href="#AssignToMission">Assign to Mission</a></li>
        <li class="tab" onclick="showTab(4,5); loadMissionInfo();"><a href="#MissionInformation">Mission Information</a></li>
        <li class="tab" onclick="showTab(5,5)"><a href="#DataVisualization">Data Visualization</a></li>
        <li class="statictab digital-clock">Clock</li>
    </ul>

    <div class="tab-content dashboard-menu-buttons">

        <div id="IncidentMap" class="tabs-1">
            <?php require 'incident_map_toggle.php'; ?>
        </div>

        <div id="CreateMission" class="tabs-2">
            <?php require 'oc_create_mission.php'; ?>
        </div>

        <div id="AssignToMission" class="tabs-3">
            <?php require 'oc_assign_mission.php'; ?>
        </div>

        <div id="MissionInformation" class="tabs-4">
            <?php require 'oc_mission_info.php'; ?>
        </div>

        <div id="DataVisualization" class="tabs-5">
            <?php require 'oc_data_visualization.php'; ?>
        </div>

    </div><!-- tab-content -->

    <?php include 'event_info_modal.php'; ?>

    <!-- logout button -->

    <a href="logout.php"><button class="button button-block logout" name="logout" />Log Out</button></a>

    <!-- Displays the background map -->

    <?php include 'incident_map.php'; ?>

    <!-- Displays the clock -->
    <?php include 'clock.php'; ?>

    <!-- Displays a footer message -->
    <div class="footer">Welcome, Operations Chief
        <?= $first_name.' '.$last_name ?>
    </div>

    <!-- included for a bunch of javascript libraries -->

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

    <script>
        function showTab(selected, total) {
            for (i = 1; i <= total; i += 1) {
                var A = document.getElementsByClassName('tabs-' + i);
                A.item(0).style.display = 'none';
            }

            var A = document.getElementsByClassName('tabs-' + selected);
            A.item(0).style.display = 'block';
        }

        //display incident map toggle panel on load
        showTab(1, 5);
        
        //initialize map to display pinpoints of unassigned events
        dispPoints(true);
    </script>

</body>

</html>
