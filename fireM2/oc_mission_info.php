<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: oc_mission_info.php
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
 * This file implements the Mission Information tab of the Operations
 * Chief dashboard.
 */

//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
    function loadMissionInfo() {
        //get list of all mission
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
        //update mission state to completed
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