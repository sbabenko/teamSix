<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: login.php
 *
 * Date Last Modified: November 12, 2018 (Aditya Kaliappan)
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
 * This file processes the user login input and validates that the user
 * credentials are correct.
 */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM userAccount WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['loginPass']) ) {
        //store user information
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['firstName'];
        $_SESSION['last_name'] = $user['lastName'];
        $_SESSION['active'] = $user['isActive'];
        $_SESSION['role'] = $user['role'];
        
        if ($_SESSION['active']){
            if($_SESSION['role'] == 'MM'){
                //query if missions are assigned to mission manager
                $result = $mysqli->query("SELECT * FROM mission natural join missionAssignment WHERE isActive = true AND accountEmail='$email'");
            
                //no missions available
                if($result->num_rows == 0){
                    $_SESSION['logged_in'] = false;
                    $_SESSION['message'] = "There are no missions available to be viewed!";
                    header("location: error.php");
                }
                //at least one mission, so proceed to dashboard
                else{
                    $_SESSION['missionID'] = $result->fetch_assoc()["missionID"];
                    $_SESSION['logged_in'] = true;
                    header("location: profile.php");
                }
            } else{
                //the user is logged in
                $_SESSION['logged_in'] = true;
            
                header("location: profile.php");
            }
        } else{
            //user account is not active
            $_SESSION['logged_in'] = false;
            $_SESSION['message'] = "This account is no longer active!";
            header("location: error.php");
        }
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}