<?php
//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<div class = "contentPanel create-mission-panel">

<script>
$(document).ready(function() {
    //setInterval(function(){   NO interval
       $.ajax({
           url: "get_resources.php",
           type: "GET",
           dataType: "html",
           success: function(html) {
           $(".resourcesPane").html(html);
        }
      });//end ajax call
    //},1000);//end setInterval
});//end docReady 
</script>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<script>

function validateForm() {
    alert("Mission name validation triggered");
    var x = document.forms["myform"]["input_mission_name"].value;
    if (x == "") {
        alert("Mission name must be filled out");
        return false;
    }
}
</script>

<h2 align="center">Create Mission</h2>
<form id="myform" method="post" action="/teamSix/fireM2/oc_create_mission.php" onsubmit="return validateForm()">  
  <label align="center" style="opacity: 0.5;position:relative;left:60px;top:30px;
    font-size: 20px;">Mission Name</label>
  <input autofocus maxlength="40" style="display:block;width:80%;margin:auto;" type="text" name="input_mission_name">
  <span class="error"><?php echo $nameErr;?></span>
  

  <!-- Resources objects generated from inside "get_resources.php" 
       and are placed here -->
  <h3 align="center">Resources</h3>
  <div class = "resource-box">
    <div class = "resourcesPane">Resources Pane</div>
  </div>


  <h3 align="center">Assign To Mission Manager</h3>
  <div class="sel_mission_manage">
    Select Mission Manager:
  </div>
    <span class="custom-dropdown" style="margin: -7px 0px 00px 285px;">
      <select name="input_mission_manager" style="margin: 0px 0px 20px 0px;">
    </span>
<br>
<br>
<script>
$(document).ready(function () {
    $('#myform').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "GET",
            data: $(this).serialize(),
            success: function (data) {
                document.getElementById("myform").reset();
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

      var resultString = $('form').serialize();
      //prompt(resultString);

      $.ajax({
        type: 'POST',
        url: 'oc_create_mission_submit.php',
        data: {passedInFormData: resultString},
        success: function(html) {
          //alert('oc_create_mission_submit.php called successfully');
          $("#result").html(html);
        }
      });

      $.ajax({
        url: "get_resources.php",
        type: "GET",
        dataType: "html",
        success: function(html) {
        $(".resourcesPane").html(html);
        }
      });//end ajax call

    });
});
</script>

<?php 
$sql = mysqli_query($mysqli, "SELECT * FROM userAccount WHERE role='MM'");
while ($row = $sql->fetch_assoc()){
echo "<option value=\" " . $row['firstName'] ." ". $row['lastName'] . "\">" . $row['firstName'] ." ". $row['lastName'] .  "</option>";
}
?>
</select>
  <br><br>

  <div class="createMissionbutton" style="width:100%;margin:auto;">
    <input type="submit" name="submit" value="Create" style="margin: -21px 0px 0px -100px;">
  </div>  
</form>
  <div id="result" style="position:absolute;top:-100px;"></div>
</div>