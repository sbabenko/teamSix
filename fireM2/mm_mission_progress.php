<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: mm_mission_progress.php
 *
 * Date Last Modified: November 20, 2018 (Stanislav Babenko)
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
 * This file implements the Mission Progress tab of the Mission Manager
 * dashboard.
 */

//verify that file is accessed via OCdash tab
if(!defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
    function loadMissionProgress() {
        //get current mission progress information
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
        if (confirm("Press OK to refresh this tab.")) {
            loadMissionProgress();
        }
    }

</script>

<div class="contentPanel" id="loadMissionProgress">MM Mission Progress</div>
