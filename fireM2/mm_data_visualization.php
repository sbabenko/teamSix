<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: mm_data_visualization.php
 *
 * Date Last Modified: November 20, 2018 (Robert Duguay)
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
 * This file implements the Data Visualization tab in the Mission Manager
 * dashboard.
 */

//verify that file is accessed via MMdash tab
if(!defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<div class = "contentPanel">
    <h2>Data Visualization</h2>
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