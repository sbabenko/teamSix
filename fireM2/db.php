<?php
/*
 * Team Name: FIRE^2 (First Responder Framework Improvement Researchers)
 * Product Name: FIRE-M^2 (First Responder Mission Management)
 * File Name: db.php
 *
 * Date Last Modified: November 14, 2018 (Stanislav Babenko)
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
 * This file contains the database connection settings.
 */

/* Database connection settings */
$host = 'mysql-instance1.crdymdfwdzej.us-east-1.rds.amazonaws.com';
$user = 'root';
$pass = 'GucciSwag420';
$db = 'FIREM2';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);