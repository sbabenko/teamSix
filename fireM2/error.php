<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: error.php
 *
 * Date Last Modified: November 8, 2018 (Aditya Kaliappan)
 *
 * Copyright: (c) 2018 by FIRE^2
 * and all corresponding participants which include:
 * Aditya Kaliappan
 * Lorenzo Neil
 * Robert Duguay
 * Stanislav Babenko
 * Daniel Volinski
 *
 * File Description:
 * This file displays the specified error message.
 */

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
    //display error message
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
