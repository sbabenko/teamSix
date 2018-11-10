<?php
//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
    function loadAssignMission() {
        $.ajax({
            url: "get_oc_assign_mission.php",
            type: "GET",
            dataType: "html",
            success: function(html) {
                $("#loadAssignMission").html(html);
            }
        })
    }

    function refreshAssignMission() {
        if (confirm("Press OK to refresh this tab (Note: any user input will be lost).")) {
            loadAssignMission();
        }
    }

    function updateAssignMission() {
        console.log("here!");

        $.ajax({
            url: "update_oc_assign_mission.php",
            type: "GET",
            dataType: "html",
            success: function(html) {
                $("#loadAssignMission").html(html);
            }
        })
    }

    function toggleDropdown(checkBox) {
        if (checkBox.checked) {
            checkBox.closest("tr").getElementsByTagName("select")[0].disabled = true;
        } else {
            checkBox.closest("tr").getElementsByTagName("select")[0].disabled = false;
        }
    }

</script>

<div class="contentPanel" id="loadAssignMission">OC Assign to Mission</div>
