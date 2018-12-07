<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: mm_change_event_state.php
 *
 * Date Last Modified: November 14, 2018 (Aditya Kaliappan)
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
 * This file implements the Change Event State tab for the Mission Manager
 * dashboard.
 */

//verify that file is accessed via OCdash tab
if(!defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
    function loadMissionEvents() {
        //request all events in mission from database
        $.ajax({
            url: "get_mm_mission_events.php",
            type: "GET",
            dataType: "html",
            data: {
                missionID: missionID
            },
            success: function(html) {
                $("#loadMissionEvents").html(html);
            }
        })
    }

    function refreshMissionEvents() {
        if (confirm("Press OK to refresh this tab (Note: any user input will be lost).")) {
            loadMissionEvents();
        }
    }

    function updateMissionEvents() {
        if (confirm("Press OK to make changes to these events.")) {
            var assignment = [];

            //References: https://stackoverflow.com/questions/18331973/loop-over-html-table-and-get-checked-checkboxes-jquery
            //            https://stackoverflow.com/questions/4027855/jquery-selector-for-table-cells-except-first-last-row-column
            $('#changeEventStateTable').find('tr:not(:first-child)').each(function() {
                //get the row
                var row = $(this);
                
                //get the eventID
                var eventID = row.data("value");

                //get value of active checkbox in the row
                var state = row.find('input:checked').val();
                
                if (state !== undefined) {
                    assignment.push({
                        eventID: eventID,
                        state: state
                    });
                }
            });

            $.ajax({
                url: "update_mm_change_event_state.php",
                type: "POST",
                data: {
                    assignEvents: JSON.stringify(assignment)
                },
                success: loadMissionEvents,
            });
        }
    }

    function updateStateRow(checkBox) {
        //get the row of the selected checkbox
        var checkBoxRow = checkBox.closest("tr").getElementsByTagName("input");
        
        //uncheck all other checkboxes in row
        for(var i = 0; i < checkBoxRow.length; i++){
            if(checkBoxRow[i] !== checkBox){
                checkBoxRow[i].checked = false;
            }
        }
    }

</script>

<div class = "contentPanel" id="loadMissionEvents">MM Change Event State</div>