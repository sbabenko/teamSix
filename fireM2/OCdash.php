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
  <?php include 'css/dashboard_css.html'; ?>
</head>

<body>

<!-- CONTENT GOES BELOW HERE -->

<?php
// Set the active MySQL database
$db_selected = mysqli_select_db($mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM mmEvent";

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

        <!--<div><a href="{% url 'login'%}?next={{request.path}}">Login</a></div>-->

  <ul class="dashboard-tab">
        <li class="tab active" onclick="showTab(1,5)"><a href="#NewEvents">Incident Map</a></li>
        <li class="tab" onclick="showTab(2,5)"><a href="#HistoricalData">Historical Data</a></li>
        <li class="tab" onclick="showTab(3,5)"><a href="#MissionAssignment">Mission Assignment</a></li>
        <li class="tab" onclick="showTab(4,5)"><a href="#NewMission">Create New Mission</a></li>
        <li class="tab" onclick="showTab(5,5)"><a href="#ActiveMissions">Active Missions</a></li>
        <li class="statictab digital-clock">Clock</li>
  </ul>

 <div class="tab-content dashboard-menu-buttons">

    <div id="NewEvents" class ="tabs-1">
    </div>

    <div id="HistoricalData" class ="tabs-2">   
      <?php require 'dsp_fr_historical.php'; ?>   
    </div>
 
    <div id="MissionAssignment" class ="tabs-3">   
      <?php require 'dsp_fr_mission_assign.php'; ?>   
    </div>  

    <div id="NewMission" class ="tabs-4">   
      <?php require 'dsp_fr_new_mission.php'; ?> 
    </div>  

    <div id="ActiveMissions" class ="tabs-5">   
      <?php require 'dsp_fr_active_mission.php'; ?> 
    </div>  

  </div><!-- tab-content -->

  <div class = "sidePane">Side Pane</div>

<!-- Hidden button object that makes all the javascript for the
event pop-up modals work. No idea how/why this works. DO NOT REMOVE!!!! -->
<button id="myBtn" style="display:none;">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 id="m_hdr_msg">Modal Header</h2>
    </div>
    <div id="modal-body" class="modal-body">
      <p id="eventInfo">Information about Event</p>
      <p id="eventStates">State changes of Event</p>
      <p id="eventNotes">Written notes about Event</p>
    </div>
    <div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>
  </div>

</div>


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {

  //Removes all iframes (should just be one instance of 
  //active iframes at any time for the 
  //embedded modal maps)

  var iframes = document.querySelectorAll('iframe');
  for (var i = 0; i < iframes.length; i++) {
    iframes[i].parentNode.removeChild(iframes[i]);
  }

  //sets modal to invisible
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function openEvent(ele, eventID, eventName, lat, long, missionID){
  modal.style.display = "block";
  document.getElementById("m_hdr_msg").innerHTML = eventName;
  document.getElementById("eventInfo").innerHTML = "test<br>testing";
  document.getElementById("eventStates").innerHTML = "test";
  document.getElementById("eventNotes").innerHTML = "test";

  //Loads street view iframe and map
  var iframe = document.createElement('iframe');
  iframe.setAttribute("style", "margin: -40px 0px 80px 40px; width: 40%; height: 300px;");
  iframe.setAttribute("id", "iframe;");
  var modalBody = document.getElementById("modal-body")
  var html = '<iframe id = "small_map" width="700" height="650" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/streetview?location=38.7662%2C-77.2523&key=AIzaSyDbNu4nnoEfW9vB55Ns4Ud1jqxeLH13qpQ" allowfullscreen></iframe>';

  modalBody.appendChild(iframe);
  iframe.contentWindow.document.open();
  iframe.contentWindow.document.write(html);
  iframe.contentWindow.document.close();

  //Loads non-street view map
  var iframe = document.createElement('iframe');
  iframe.setAttribute("style", "margin: -40px 0px 80px 40px; width: 40%; height: 300px;");
  iframe.setAttribute("id", "iframe;");
  var modalBody = document.getElementById("modal-body")
  var html = '<iframe id = "small_map" width="700" height="650" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/streetview?location=38.7662%2C-77.2523&key=AIzaSyDbNu4nnoEfW9vB55Ns4Ud1jqxeLH13qpQ" allowfullscreen></iframe>';
  
  modalBody.appendChild(iframe);
  iframe.contentWindow.document.open();
  iframe.contentWindow.document.write(html);
  iframe.contentWindow.document.close();

  var id = ele.id;

}

</script>

<script>
  function showTab(selected, total){

    for(i = 1; i <= total; i += 1){
      var A = document.getElementsByClassName('tabs-' + i);//.style.display = 'none';
      A.item(0).style.display = 'none';
    }
  //document.getElementById('tabs-' + selected).style.display = 'block';
  var A = document.getElementsByClassName('tabs-' + selected);//.style.display = 'none';
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
