<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Error</title>
    <?php include 'css/css.html'; ?>

</head>

<body>

    <div class="form">
        <h1>Error</h1>
        <p>
            <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: profile.php" );
    endif;
    ?>
        </p>
        <a href="profile.php"><button class="button button-block" />Home</button></a>
    </div>

    <?php include 'incident_map.php'; ?>

    <script>
        //initialize map to display heatmap of unassigned events
        dispPoints(false);

    </script>
</body>

</html>
