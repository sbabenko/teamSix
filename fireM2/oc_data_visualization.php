<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: oc_data_visualization.php
 *
 * Date Last Modified: November 21, 2018 (Stanislav Babenko)
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
 * This file implements the Data Visualization tab for the Operations
 * Chief dashboard.
 */

//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<div class = "contentPanel visContentMobile">
    <h2>Data Visualization</h2>
    <div class = "charts">
    	<canvas id = "incomingDataLineGraph"></canvas>
        <canvas id = "incomingDoughnutGraph"></canvas>
        <canvas id = "oc_submission_method"></canvas>
        <canvas id = "oc_active_missions"></canvas>
        
    </div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/incomingEventsLineGraph.js"></script>
<script type="text/javascript" src="js/get_event_cat_doughnut.js"></script>
<script type="text/javascript" src="js/oc_submission_method.js"></script>
<script type="text/javascript" src="js/oc_active_missions.js"></script>