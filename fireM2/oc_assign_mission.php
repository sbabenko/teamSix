<?php
//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
  function loadAssignMission(){
    $.ajax({
      url: "get_events.php",
      type: "GET",
      dataType: "html",
      success: function(html) {
        $("#loadAssignMission").html(html);
      }
    })
  }
</script>

<div class = "contentPanel" id = "loadAssignMission">OC Assign to Mission</div>