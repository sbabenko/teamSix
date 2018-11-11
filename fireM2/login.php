<?php
/* User login process, checks if user exists and password is correct */

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
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['firstName'];
        $_SESSION['last_name'] = $user['lastName'];
        $_SESSION['active'] = $user['isActive'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['missionID'] = null;
        
        if($_SESSION['active']){
            //the user is logged in
            $_SESSION['logged_in'] = true;
            
            header("location: profile.php");
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

