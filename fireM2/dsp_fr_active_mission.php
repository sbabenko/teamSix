<div class="FR_ActiveMissions">Active Missions
  <div class = "missionPane">Mission Pane</div>
</div>

<?php
$db_selected = mysqli_select_db( $mysqli ,"FIREM2");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM mission";

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
           url: "get_missions.php",
           type: "GET",
           dataType: "html",
           success: function(html) {
           $(".missionPane").html(html);
        }
      });//end ajax call
    },1000);//end setInterval

});//end docReady 

</script>