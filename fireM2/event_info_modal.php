<!--
 Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 Product Name: FIRE-M^2 (First Responder Mission Management)
 File Name: event_info_modal.php
 
 Date Last Modified: November 20, 2018 (Stanislav Babenko)
 
 Copyright: (c) 2018 by FIRE^2
 and all corresponding participants which include:
 Aditya Kaliappan
 Lorenzo Neil
 Robert Duguay
 Stanislav Babenko
 Daniel Volinski
 
 File Description:
 This file consists of the implementation of the event information modal.
 -->

<!-- Hidden button object that makes all the javascript for the
event pop-up modals work. No idea how/why this works. DO NOT REMOVE!!!! -->
<button id="eventButton" style="display:none;"></button>

<!-- The Modal -->
<div id="eventModal" class="modal eventModal">

    <!-- Modal content -->
    <div class="modal-content" style="width:60%;">
        <div class="modal-header">
            <span id="eventClose" class="close">&times;</span>
            <h2 id="eventHeader"></h2>
        </div>
        <div id="modal-body" class="modal-body" ><!--style="background-color: rgba(0, 0, 0, 0.8);">-->
            <div class="eventTables"></div>
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
    
    //initialize variables
    var isNote = false;
    var isChange = false;

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
        if (event.target === eModal) {
            eModal.style.display = "none";
        }
    });

    function openEvent(eventID, eventName, changeNote, updateEvent) {
        //display modal
        eModal.style.display = "block";
        document.getElementById("eventHeader").innerHTML = eventName;

        //update variables
        isNote = changeNote;
        isChange = updateEvent;
        
        //load information into modal
        loadEventModal(eventID);
    }

    function loadEventModal(eventID) {        
        //update event information tables
        $.ajax({
            url: "get_event_info.php",
            type: "GET",
            data: {
                eventID: eventID,
                isNote: isNote,
                isChange: isChange
            },
            dataType: "html",
            success: function(html) {
                $(".eventTables").html(html);
            }
        }); //end ajax call
    }

    function refreshEventModal(eventID) {
        if (confirm("Press OK to refresh this modal (Note: any user input will be lost).")) {
            loadEventModal(eventID);
        }
    }

    function addWrittenNote(eventID) {
        //get value in textfield
        var textFieldVal = document.getElementById("writtenNote").value;

        //add note to event
        if (textFieldVal.length > 0) {
            if (confirm("Press OK to add this note to the event.")) {
                $.ajax({
                    url: "add_event_note.php",
                    type: "POST",
                    data: {
                        eventID: eventID,
                        note: textFieldVal
                    },
                    success: loadEventModal(eventID)
                }); //end ajax call
            }
        }
    }

    function assignEvent(eventID) {
        //get value in textfield
        var dropdownVal = document.getElementById("eventAssignDropdown").value;

        //add note to event
        if (dropdownVal !== "none") {
            if (confirm("Press OK to assign event to mission.")) {
                $.ajax({
                    url: "update_event_assignment.php",
                    type: "POST",
                    data: {
                        eventID: eventID,
                        missionID: dropdownVal
                    },
                    success: function() {
                        //close the modal
                        eModal.style.display = "none";
                    }
                }); //end ajax call
            }
        }
    }

    function deleteEvent(eventID) {
        if (confirm("Press OK to delete this event.")) {
            $.ajax({
                url: "delete_event.php",
                type: "POST",
                data: {
                    eventID: eventID
                },
                success: function() {
                    //close the modal
                    eModal.style.display = "none";
                }
            }); //end ajax call
        }
    }

</script>
