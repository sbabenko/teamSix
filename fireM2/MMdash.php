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
else if ($_SESSION['role'] != 'MM'){
    $_SESSION['message'] = "You do not have the credentials to view this page!";
    header("location: error.php");
}
else if ($_SESSION['missionID'] == null){
    header("location: logout.php");
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
define('MM_Tab', TRUE);
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
        <li class="statictab" id="missionNameToggle">Mission Name</li>
        <li class="tab active" onclick="showTab(1,4)"><a href="#IncidentMap">Incident Map</a></li>
        <li class="tab" onclick="showTab(2,4); loadMissionEvents();"><a href="#ChangeEventState">Change Event State</a></li>
        <li class="tab" onclick="showTab(3,4); loadMissionProgress();"><a href="#MissionProgress">Mission Progress</a></li>
        <li class="tab" onclick="showTab(4,4)"><a href="#DataVisualization">Data Visualization</a></li>
        <li class="statictab digital-clock">Clock</li>
    </ul>

    <div class="tab-content dashboard-menu-buttons">

        <div id="IncidentMap" class="tabs-1">
            <?php require 'incident_map_toggle.php'; ?>
        </div>

        <div id="ChangeEventState" class="tabs-2">
            <?php require 'mm_change_event_state.php'; ?>
        </div>

        <div id="MissionProgress" class="tabs-3">
            <?php require 'mission_progress.php'; ?>
        </div>

        <div id="DataVisualization" class="tabs-4">
            <?php require 'mm_data_visualization.php'; ?>
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
    <div class="footer">Welcome, Mission Manager
        <?= $first_name.' '.$last_name ?>
    </div>

    <!-- included for a bunch of javascript libraries -->

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

    <script>
        var missionID = null;

        function showTab(selected, total) {
            for (i = 1; i <= total; i += 1) {
                var A = document.getElementsByClassName('tabs-' + i);
                A.item(0).style.display = 'none';
            }

            var A = document.getElementsByClassName('tabs-' + selected);
            A.item(0).style.display = 'block';

            missionID = "<?php echo $_SESSION['missionID']; ?>";
            var email = "<?php echo $email; ?>";

            //ajax request for mission dropdown
            $.ajax({
                url: "get_mm_mission_dropdown.php",
                type: "GET",
                data: {
                    email: email,
                    missionID: missionID
                },
                dataType: "html",
                success: function(html) {
                    var currMissionID = html.substr(0, html.indexOf("<"));

                    dropdownCode = html.substr(html.indexOf("<"));
                    $("#missionNameToggle").html(dropdownCode);

                    //refresh dashboard if originally selected mission not available
                    if (missionID != currMissionID) {
                        if (currMissionID == "null") {
                            missionID = null;
                            refreshDashboard(false, true);
                        } else {
                            missionID = currMissionID;
                            refreshDashboard(false, false);
                        }
                    }
                }
            });
        }

        function updateMission(dropdown) {
            //get the selected missionID from dropdown
            missionID = dropdown.value;

            refreshDashboard(true, false);
        }

        function refreshDashboard(fromUpdateMission, noMissions) {
            if (noMissions) {
                alert("There are no more missions available to you. Logging out.");
            } else if (fromUpdateMission) {
                alert("The dashboard will be refreshed to load the selected mission.");
            } else {
                alert("The selected mission no longer exists. Loading available mission.");
            }

            //update session missionID
            $.ajax({
                url: "update_mm_missionID.php",
                type: "POST",
                data: {
                    missionID: missionID
                }
            });

            location.reload(true);
        }

        //display incident map toggle panel on load
        showTab(1, 4);

        //initialize map to display pinpoints
        dispPoints(true);
        setMissionID(missionID);

    </script>

</body>

</html>
