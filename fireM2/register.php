<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash) " 
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Account Verification ( paradigm.vision )';
        $message_body = '
        Hello '.$first_name.',

        Thank you for signing up. 

		The idea of a paradigm shift comes from Thomas Kuhn’s 1962 book The Structure of Scientific Revolutions. 
		Kuhn, a physicist turned philosopher of science, had spent a year in the late 1950s at the then-new Center for 
		Advanced Study in the Behavioral Sciences at Stanford and been struck by how the assembled psychologists, economists, 
		historians, sociologists, and the like often disagreed over the very fundamentals of their disciplines. Physicists, 
		in his experience, didn’t do that. This wasn’t because they were any smarter than social scientists, Kuhn concluded. 
		It was because they had found a paradigm within which to work. 

		A Kuhnian paradigm is a set of assumptions that allows scientists in a particular field to avoid time-wasting 
		arguments over the basics and spend their days solving small but useful puzzles. Scientific assumptions are never 
		perfect mirrors of reality, though (“all models are wrong; but some are useful“). When evidence piles up that contradicts 
		the paradigm, a science sometimes needs to go through the painful process of a paradigm shift.

        Please click this link to activate your account:

        http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

        header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}