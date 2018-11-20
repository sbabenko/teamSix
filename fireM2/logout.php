<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy();

//set user role to general public
$_SESSION['role'] = 'GP';
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
        <br>
        <br>
        <br>
        <br>
        <h1>Logout Successful</h1>
        <br>
        <br>
        <br>
        <p>
            <?= 'Thanks for using FIRE-M<sup>2</sup>!'; ?>
        </p>

        <a href="index.php"><button class="button button-block" />Home</button></a>

    </div>
    <?php include 'incident_map.php'; ?>
    <?php include 'clock.php'; ?>

    <script>
        //initialize map to display heatmap of unassigned events
        dispPoints(false);
    </script>
</body>

</html>
