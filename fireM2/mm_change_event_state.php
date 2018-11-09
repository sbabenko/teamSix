<?php
//verify that file is accessed via OCdash tab
if(!defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<div class = "contentPanel">MM Change Event State</div>