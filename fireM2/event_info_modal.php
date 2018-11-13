<!-- Hidden button object that makes all the javascript for the
event pop-up modals work. No idea how/why this works. DO NOT REMOVE!!!! -->
<button id="eventButton" style="display:none;"></button>

<!-- The Modal -->
<div id="eventModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span id="eventClose" class="close">&times;</span>
            <h2 id="eventHeader"></h2>
        </div>
        <div id="modal-body" class="modal-body">
            <div class="eventTables"></div>
        </div>
        <div class="modal-footer">
            <h3></h3>
        </div>
    </div>

</div>

<script>
    // Get the modal
    var eModal = document.getElementById('eventModal');

    // Get the button that opens the modal
    var eBtn = document.getElementById("eventButton");

    // Get the <span> element that closes the modal
    var eSpan = document.getElementById("eventClose");

    // When the user clicks the button, open the modal 
    eBtn.addEventListener("click", function() {
        eModal.style.display = "block";
    });

    // When the user clicks on <span> (x), close the modal
    eSpan.addEventListener("click", function() {
        //sets modal to invisible
        eModal.style.display = "none";
    });

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener("click", function(event) {
        if (event.target == eModal) {
            eModal.style.display = "none";
        }
    });

    function openEvent(ele, eventID, eventName) {
        eModal.style.display = "block";
        document.getElementById("eventHeader").innerHTML = eventName;

        //update event information tables
        $.ajax({
            url: "get_event_info.php",
            type: "GET",
            data: {
                eventID: eventID
            },
            dataType: "html",
            success: function(html) {
                $(".eventTables").html(html);
            }
        }); //end ajax call
    }

</script>
