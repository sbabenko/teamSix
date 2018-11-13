<?php
//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}

include 'mission_info_modal.php';
?>

<script>
    function loadMissionInfo() {
        $.ajax({
            url: "get_oc_mission_info.php",
            type: "GET",
            dataType: "html",
            success: function(html) {
                $("#loadMissionInfo").html(html);
            }
        })
    }

    function updateMissionInfo(idNum) {
        if (confirm("Press OK to set this mission to completed.")) {
            $.ajax({
                url: "update_oc_mission_info.php",
                type: "POST",
                data: {
                    missionID: idNum
                },
                success: loadMissionInfo,
            });
        }
    }
</script>

<div class = "contentPanel" id="loadMissionInfo">OC Mission Information</div>