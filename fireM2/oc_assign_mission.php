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
        if (confirm("Press OK to make changes to these events.")) {
            var toDelete = [];
            var assignment = [];

            //References: https://stackoverflow.com/questions/18331973/loop-over-html-table-and-get-checked-checkboxes-jquery
            $('.assign-box').find('.assignMissionObject').each(function() {
                //get the row
                var row = $(this);
                
                //get the checkbox in the row
                var checkBox = row.find('input');
                
                //get the dropdown in the row
                var dropDown = row.find('option:selected');
                
                if (checkBox.is(':checked')) {
                    toDelete.push(checkBox.val())
                } else if (dropDown.val() !== "none"){
                    assignment.push({
                        eventID: checkBox.val(),
                        missionID: dropDown.val()
                    });
                }
            });

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
        checkBox.closest(".assignMissionObject").getElementsByTagName(
            "select")[0].disabled = !!checkBox.checked;
    }

</script>

<div class="contentPanel" id="loadAssignMission">OC Assign to Mission</div>
