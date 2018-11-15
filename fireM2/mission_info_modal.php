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
            <div class="missionInfoTables"></div>
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
        mModal.style.display = "block";
        document.getElementById("missionHeader").innerHTML = missionName;

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
        if (confirm("Press OK to refresh this tab (Note: any user input will be lost).")) {
            loadMissionProgress(mID);
        }
    }

</script>
