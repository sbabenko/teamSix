<?php
//verify that file is accessed via OCdash tab
if(!defined('OC_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<div class="sidePane">
    <h2>Map Type</h2>
    
    <table>
        <tr>
            <td>
                Pinpoints
                <input type="radio" name="mapType" value="pinpoint" checked>
            </td>
            <td>
                Heatmap
                <input type="radio" name="mapType" value="heatmap">
            </td>
        </tr>
    </table>
</div>
