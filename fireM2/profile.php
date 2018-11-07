<?php
/*needed for queries to the user's contacts and messages*/
require 'db.php';
/* Displays user information and some useful messages */
session_start();


//Redirect to role based pages
if ($_SESSION['role'] == 'MM'){
    header( "location: MMdash.php" );
}elseif ($_SESSION['role'] == 'OC'){
    header( "location: OCdash.php" );
} else {
    header( "location: index.php" );
}
?>
