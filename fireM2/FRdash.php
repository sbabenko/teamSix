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

<?php
// Set the active MySQL database
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM events WHERE 1";

#$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

$result = $mysqli->query($query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($mysqli));
}

?>

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
    },1000);//end setInterval

});//end docReady 
</script>

  <div class = "headerPane">
  <div class="digital-clock dashboard-clock">00:00:00 00:00:00</div>
      <p class = "name">First Responder: {{ user.first_name }} {{ user.last_name }}</p>
      <div class = "logout"><a href="{% url 'logout'%}?next={{request.path}}">Logout</a></div>    
        <!--<div><a href="{% url 'login'%}?next={{request.path}}">Login</a></div>-->

  <ul class="dashboard-tab">
        <li class="tab active"><a href="#NewEvents">New Events</a></li>
        <li class="tab"><a href="#HistoricalData">Historical Data</a></li>
        <li class="tab"><a href="#MissionAssignment">Mission Assignment</a></li>
        <li class="tab"><a href="#NewMission">New Mission</a></li>
        <li class="tab"><a href="#ActiveMissions">Active Missions</a></li>
  </ul>

 <div class="tab-content dashboard-menu-buttons">

    <div id="New Events">   
      <h1>New Events</h1>
    </div>

    <div id="HistoricalData">   
      <h1>Historical Data Tab</h1>
    </div>
 
    <div id="MissionAssignment">   
      <h1>Mission Assignment Tab</h1>
    </div>  

    <div id="NewMission">   
      <h1>New Missions</h1>
    </div>  

    <div id="ActiveMissions">   
      <h1>Active Missions</h1>
    </div>  

  </div><!-- tab-content -->

    <div class = "sidePane">Side Pane</div>

<!-- CONTENT GOES ABOVE HERE -->

<a href="logout.php"><button class="button button-block logout" name="logout"/>Log Out</button></a>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<?php include 'map_template_with_markers.php'; ?>
<?php include 'clock.php'; ?>

</body>
</html>
