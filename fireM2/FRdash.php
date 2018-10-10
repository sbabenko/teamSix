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

    <div class = "headerPane">
        <p class = "name">First Responder: {{ user.first_name }} {{ user.last_name }}</p>
        <div class = "logout"><a href="{% url 'logout'%}?next={{request.path}}">Logout</a></div>
          
        <!--<div><a href="{% url 'login'%}?next={{request.path}}">Login</a></div>-->
 
    <div class = "sidePane">Side Pane</div>

<!-- CONTENT GOES ABOVE HERE -->

<a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<?php include 'map_template_with_markers.php'; ?>
<?php include 'clock.php'; ?>

</body>
</html>
