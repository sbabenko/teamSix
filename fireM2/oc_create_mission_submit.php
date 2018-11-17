<?php

$params = array();
parse_str($_POST['passedInFormData'], $params);


foreach ($params as $key => $value) {
    echo "<tr>";
    echo "<td>";
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
}

?>
