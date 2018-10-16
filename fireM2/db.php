<?php
/* Database connection settings */



$host = 'mysql-instance1.crdymdfwdzej.us-east-1.rds.amazonaws.com';
$user = 'root';
$pass = 'GucciSwag420';
$db = 'FIREM2';

/*

$host = 'localhost:3306';
$user = 'root';
$pass = '';
$db = 'accounts';

*/
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);


/*
DB connection test suite below

<?php
# Fill our vars and run on cli
# $ php -f db-connect-test.php
$dbname = 'name';
$dbuser = 'user';
$dbpass = 'pass';
$dbhost = 'host';
$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysql_select_db($dbname) or die("Could not open the db '$dbname'");
$test_query = "SHOW TABLES FROM $dbname";
$result = mysql_query($test_query);
$tblCnt = 0;
while($tbl = mysql_fetch_array($result)) {
  $tblCnt++;
  #echo $tbl[0]."<br />\n";
}
if (!$tblCnt) {
  echo "There are no tables<br />\n";
} else {
  echo "There are $tblCnt tables<br />\n";
}
*/