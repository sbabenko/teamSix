<?php
//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
  function loadAssignMission(){
    console.log("load table");
  }
</script>

<div class = "contentPanel">OC Assign to Mission</div>