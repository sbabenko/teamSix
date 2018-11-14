<?php
//verify that file is accessed via MMdash tab
if(!defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<div class = "contentPanel">
	<div class = "charts">
		<canvas id = "mm_event_cat_pie"></canvas>
		<canvas id = "mm_submit_method_pie"></canvas>
		<canvas id = "mm_mission_state"></canvas>
		<canvas id = "incomingHorizontalBar"></canvas>
    	
    </div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/mm_event_cat_pie.js"></script>
<script type="text/javascript" src="js/mm_submit_method_pie.js"></script>
<script type="text/javascript" src="js/mm_mission_state.js"></script>
<script type="text/javascript" src="js/CurrentMissionStatus.js"></script>