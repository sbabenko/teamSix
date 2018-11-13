<?php
//verify that file is accessed via OCdash tab
if(!defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
    function loadMissionProgress() {
        $.ajax({
            url: "get_mission_progress.php",
            type: "GET",
            dataType: "html",
            data: {
                missionID: missionID
            },
            success: function(html) {
                $("#loadMissionProgress").html(html);
            }
        })
    }

    function refreshMissionProgress() {
        if (confirm("Press OK to refresh this tab (Note: any user input will be lost).")) {
            loadMissionProgress();
        }
    }
</script>

<div class = "contentPanel" id="loadMissionProgress">MM Mission Progress</div>