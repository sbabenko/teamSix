<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: oc_assign_mission.php
 *
 * Date Last Modified: November 30, 2018 (Aditya Kaliappan)
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
 * This file implements the Assign to Mission tab of the Operations Chief
 * dashboard.
 */

//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
    function loadAssignMission() {
        //load table of unassigned events
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
        if (confirm("Press OK to make changes to these events.")) {
            //declare empty variables
            var toDelete = [];
            var assignment = [];

            //References: https://stackoverflow.com/questions/18331973/loop-over-html-table-and-get-checked-checkboxes-jquery
            $('#assignMissionTable').find('tr').each(function() {
                //get the row
                var row = $(this);
                
                //get the checkbox in the row
                var checkBox = row.find('input');
                
                //get the dropdown in the row
                var dropDown = row.find('option:selected');
                
                //verify if event is to be deleted
                if (checkBox.is(':checked')) {
                    toDelete.push(checkBox.val())
                }
                //verify if event is to be assigned to mission
                else if (dropDown.val() !== "none"){
                    assignment.push({
                        eventID: checkBox.val(),
                        missionID: dropDown.val()
                    });
                }
            });

            //update database with new event states
            $.ajax({
                url: "update_oc_assign_mission.php",
                type: "POST",
                data: {
                    deleteEvents: JSON.stringify(toDelete),
                    assignEvents: JSON.stringify(assignment)
                },
                success: loadAssignMission,
            });
        }
    }

    function toggleDropdown(checkBox) {
        //enable/disable dropdown based on checkbox state
        checkBox.closest("tr").getElementsByTagName("select")[0].disabled =
            !!checkBox.checked;
    }

</script>

<div class="contentPanel" id="loadAssignMission">OC Assign to Mission</div>
