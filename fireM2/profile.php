<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: profile.php
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
 * This file redirects the user to the respective dashboard based
 * on their login credentials.
 */

require 'db.php';
/* Displays user information and some useful messages */
session_start();


//Redirect to role based pages
if ($_SESSION['logged_in'] && $_SESSION['role'] == 'MM'){
    header( "location: MMdash.php" );
}elseif ($_SESSION['logged_in'] && $_SESSION['role'] == 'OC'){
    header( "location: OCdash.php" );
} else {
    header( "location: index.php" );
}
?>
