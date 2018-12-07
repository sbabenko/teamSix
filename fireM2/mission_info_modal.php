<!--
 Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 Product Name: FIRE-M^2 (First Responder Mission Management)
 File Name: mission_info_modal.php
 
 Date Last Modified: December 1, 2018 (Aditya Kaliappan)
 
 Copyright: (c) 2018 by FIRE^2
 and all corresponding participants which include:
 Aditya Kaliappan
 Lorenzo Neil
 Robert Duguay
 Stanislav Babenko
 Daniel Volinski
 
 File Description:
 This file implements the mission information modal.
 -->

<!-- Hidden button object that makes all the javascript for the
event pop-up modals work. No idea how/why this works. DO NOT REMOVE!!!! -->
<button id="missionBtn" style="display:none;"></button>

<!-- The Modal -->
<div id="missionModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span id="missionClose" class="close">&times;</span>
            <h2 id="missionHeader"></h2>
        </div>
        <div id="modal-body" class="modal-body">
            <div class="missionInfoTables" style="color:white;"></div>
        </div>
    </div>

</div>

<script>
    // Get the modal
    var mModal = document.getElementById('missionModal');

    // Get the button that opens the modal
    var mBtn = document.getElementById("missionBtn");

    // Get the <span> element that closes the modal
    var mSpan = document.getElementById("missionClose");

    // When the user clicks the button, open the modal 
    mBtn.addEventListener("click", function() {
        mModal.style.display = "block";
    });

    // When the user clicks on <span> (x), close the modal
    mSpan.addEventListener("click", function() {
        //sets modal to invisible
        mModal.style.display = "none";
    });

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener("click", function(event) {
        if (event.target === mModal) {
            mModal.style.display = "none";
        }
    });

    function openMission(ele, mID, missionName) {
        //display modal
        mModal.style.display = "block";
        document.getElementById("missionHeader").innerHTML = missionName;

        //get information for modal
        loadMissionProgress(mID);
    }

    function loadMissionProgress(mID) {
        $.ajax({
            url: "get_mission_progress.php",
            type: "GET",
            dataType: "html",
            data: {
                missionID: mID
            },
            success: function(html) {
                $(".missionInfoTables").html(html);
            }
        })
    }

    function refreshMissionProgress(mID) {
        if (confirm("Press OK to refresh this window.")) {
            loadMissionProgress(mID);
        }
    }

</script>
