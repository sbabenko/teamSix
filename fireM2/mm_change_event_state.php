<?php
//verify that file is accessed via OCdash tab
if(!defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<script>
    function loadMissionEvents() {        
        $.ajax({
            url: "get_mm_mission_events.php",
            type: "GET",
            dataType: "html",
            data: {
                missionID: 1
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
                
                if (state != undefined) {
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
        var checkBoxRow = checkBox.closest("tr").getElementsByTagName("input");
        
        for(var i = 0; i < checkBoxRow.length; i++){
            if(checkBoxRow[i] != checkBox){
                checkBoxRow[i].checked = false;
            }
        }
    }

</script>

<div class = "contentPanel" id="loadMissionEvents">MM Change Event State</div>