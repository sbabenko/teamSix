<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form">
          <h1>Logout Successful</h1>
        
          <p><?= 'Thanks for using FIRE-M<sup>2</sup>!'; ?></p>
          
          <a href="index.php"><button class="button button-block"/>Home</button></a>

    </div>
<?php include 'map_template_with_markers.php'; ?>
<?php include 'clock.php'; ?>
</body>
</html>
