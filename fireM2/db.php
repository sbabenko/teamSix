<?php
/* Database connection settings */
$host = 'mysql-instance1.crdymdfwdzej.us-east-1.rds.amazonaws.com';
$user = 'root';
$pass = 'GucciSwag420';
$db = 'FIREM2';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
