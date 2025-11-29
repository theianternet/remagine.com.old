<?php
// Contains global vars.
require('zoneconfig.php');

mysql_connect($DB_HOST, $DB_USER, $DB_PASS) 
    or die("could not connect");

mysql_select_db($DB_NAME) or die("Could not select database");
$query = 'SELECT ZONE_NAME'
        . ' FROM `dynzone_addzone`'
        . ' LIMIT 0 , 10';

$result = mysql_query($query);
$row = mysql_fetch_array($result, MYSQL_ASSOC)
echo $row['ZONE_NAME'];
?>
