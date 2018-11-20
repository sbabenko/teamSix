<?php
//verify that file is accessed via OCdash tab
if(!defined('OC_Tab') && !defined('MM_Tab')) {
    //redirect back to correct dashboard
    header("location: profile.php");
}
?>

<div class="sidePane">
    <!-- display map type options -->
    <h2>Map Type</h2>

    <table>
        <col style="width:50%">
        <col style="width:50%">
        <tr>
            <td>
                <input type="radio" name="mapType" onclick="dispPoints(true)" checked>
                <label>Pinpoints</label>
            </td>
            <td>
                <input type="radio" name="mapType" onclick="dispPoints(false)">
                <label>Heatmap</label>
            </td>
        </tr>
    </table>

    <br>
    <br>

    <!-- display event category options -->
    <h2>Category</h2>

    <table>
        <col style="width:50%">
        <col style="width:50%">
        <tr>
            <td>
                <input type="checkbox" name="category" value="hurricane" onChange="toggleCategory(this)" checked>
                <label>Hurricane</label>
            </td>
            <td>
                <input type="checkbox" name="category" value="landslide" onChange="toggleCategory(this)" checked>
                <label>Landslide</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="category" value="flood" onChange="toggleCategory(this)" checked>
                <label>Flood</label>
            </td>
            <td>
                <input type="checkbox" name="category" value="sinkhole" onChange="toggleCategory(this)" checked>
                <label>Sinkhole</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="category" value="tsunami" onChange="toggleCategory(this)" checked>
                <label>Tsunami</label>
            </td>
            <td>
                <input type="checkbox" name="category" value="volcano" onChange="toggleCategory(this)" checked>
                <label>Volcano</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="category" value="fire" onChange="toggleCategory(this)" checked>
                <label>Fire</label>
            </td>
            <td>
                <input type="checkbox" name="category" value="tornado" onChange="toggleCategory(this)" checked>
                <label>Tornado</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="category" value="earthquake" onChange="toggleCategory(this)" checked>
                <label>Earthquake</label>
            </td>
            <td>
                <input type="checkbox" name="category" value="naturalGas" onChange="toggleCategory(this)" checked>
                <label>Natural Gas</label>
            </td>
        </tr>
    </table>

    <br>
    <br>

    <!-- display event submission method options -->
    <h2>Submission Method</h2>

    <table>
        <tr>
            <td>
                <input type="checkbox" name="submitMethod" value="phone" onChange="toggleSubmitMethod(this)" checked>
                <label>Phone</label>
            </td>
            <td>
                <input type="checkbox" name="submitMethod" value="sms" onChange="toggleSubmitMethod(this)" checked>
                <label>SMS</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="submitMethod" value="email" onChange="toggleSubmitMethod(this)" checked>
                <label>Email</label>
            </td>
            <td>
                <input type="checkbox" name="submitMethod" value="twitter" onChange="toggleSubmitMethod(this)" checked>
                <label>Twitter</label>
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="submitMethod" value="facebook" onChange="toggleSubmitMethod(this)" checked>
                <label>Facebook</label>
            </td>
        </tr>
    </table>

    <?php
        //if user is Mission Manager, allow toggle by event state
        if(defined('MM_Tab')){
            echo '<br>';
            echo '<br>';
            echo '<h2>Event State</h2>';
            echo '<table>';
            echo '<tr>';
            echo '<td>';
            echo '<input type="checkbox" name="eventState" value="assigned" onChange="toggleEventState(this)" checked>';
            echo '<label>Assigned</label>';
            echo '</td>';
            echo '<td>';
            echo '<input type="checkbox" name="eventState" value="on hold" onChange="toggleEventState(this)" checked>';
            echo '<label>On Hold</label>';
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>';
            echo '<input type="checkbox" name="eventState" value="in progress" onChange="toggleEventState(this)" checked>';
            echo '<label>In Progress</label>';
            echo '</td>';
            echo '<td>';
            echo '<input type="checkbox" name="eventState" value="completed" onChange="toggleEventState(this)" checked>';
            echo '<label>Completed</label>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
        }
    ?>
</div>
