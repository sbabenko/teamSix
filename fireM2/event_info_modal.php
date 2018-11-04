<!-- Hidden button object that makes all the javascript for the
event pop-up modals work. No idea how/why this works. DO NOT REMOVE!!!! -->
<button id="myBtn" style="display:none;"></button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2 id="m_hdr_msg"></h2>
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
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {

  //Removes all iframes (should just be one instance of 
  //active iframes at any time for the 
  //embedded modal maps)

  var iframes = document.querySelectorAll('iframe');
  for (var i = 0; i < iframes.length; i++) {
    iframes[i].parentNode.removeChild(iframes[i]);
  }

  //sets modal to invisible
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function openEvent(ele, eventID, eventName, lat, long, missionID){
  modal.style.display = "block";
  document.getElementById("m_hdr_msg").innerHTML = eventName;

  //update event information tables
  $.ajax({
        url: "get_event_info.php",
        type: "GET",
        data: {eventID: eventID},
        dataType: "html",
        success: function(html) {
        $(".eventTables").html(html);
    }
  });//end ajax call
    
  //add buttons to footer
}

</script>