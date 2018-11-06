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

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $first_name.' '.$last_name ?></title>
  <?php include 'css/css.html'; ?>
</head>

<body>

<!-- CONTENT GOES BELOW HERE -->

<script>
$(document).ready(function() {
    setInterval(function(){
       $.ajax({
           url: "get_events.php",
           type: "GET",
           dataType: "html",
           success: function(html) {
           $(".sidePane").html(html);
        }
      });//end ajax call
    },400);//end setInterval
});//end docReady 

</script>

  <ul class="dashboard-tab">
        <li class="tab active" onclick="showTab(1,5)"><a href="#IncidentMap">Incident Map</a></li>
        <li class="tab" onclick="showTab(2,5)"><a href="#CreateMission">Create Mission</a></li>
        <li class="tab" onclick="showTab(3,5)"><a href="#AssignToMission">Assign to Mission</a></li>
        <li class="tab" onclick="showTab(4,5)"><a href="#MissionInformation">Mission Information</a></li>
        <li class="tab" onclick="showTab(5,5)"><a href="#DataVisualization">Data Visualization</a></li>
        <li class="statictab digital-clock">Clock</li>
  </ul>

 <div class="tab-content dashboard-menu-buttons">

    <div id="IncidentMap" class ="tabs-1">
    </div>

    <div id="CreateMission" class ="tabs-2">   
      <?php require 'dsp_fr_historical.php'; ?>   
    </div>
 
    <div id="AssignToMission" class ="tabs-3">   
      <?php require 'dsp_fr_mission_assign.php'; ?>   
    </div>  

    <div id="MissionInformation" class ="tabs-4">   
      <?php require 'dsp_fr_new_mission.php'; ?> 
    </div>  

    <div id="DataVisualization" class ="tabs-5">   
      <?php require 'dsp_fr_active_mission.php'; ?> 
    </div>  

  </div><!-- tab-content -->

<?php include 'event_info_modal.php'; ?>

<script>
  function showTab(selected, total){
    for(i = 1; i <= total; i += 1){
      var A = document.getElementsByClassName('tabs-' + i);
      A.item(0).style.display = 'none';
    }

  var A = document.getElementsByClassName('tabs-' + selected);
  A.item(0).style.display = 'block';
}
</script>

<!-- logout button -->

<a href="logout.php"><button class="button button-block logout" name="logout"/>Log Out</button></a>

<!-- included for a bunch of javascript libraries -->

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

<!-- Displays the background map -->

<?php include 'map_template_with_markers.php'; ?>

<!-- Displays the clock -->
<?php include 'clock.php'; ?>

<!-- Displays a footer message -->
<div class="footer">Welcome, Operations Chief <?= $first_name.' '.$last_name ?></div>

</body>
</html>
