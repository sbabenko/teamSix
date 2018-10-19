<div class="FR_ActiveMissions">
  <div class = "missionPane">Mission Pane</div>
</div>


<script>
$(document).ready(function() {
    setInterval(function(){
       $.ajax({
           url: "get_missions.php",
           type: "GET",
           dataType: "html",
           success: function(html) {
           $(".missionPane").html(html);
        }
      });//end ajax call
    },1000);//end setInterval

});//end docReady 

</script>