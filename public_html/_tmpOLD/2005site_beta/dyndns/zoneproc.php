<?php

// Contains global vars.
require('zoneconfig.php');

// Adds Zone data to REMAGINE dynDNS.
$addzone = $_REQUEST['addzone'];
$sqlzone = "insert into dynzone_addzone"." (zone)"." VALUES ('$addzone')";

mysql_pconnect($DB_HOST, $DB_USER, $DB_PASS) or
die("could not connect");
mysql_select_db($DB_NAME);
mysql_query($sqlzone) or
        die("<b>Error " . mysql_errno() . ": " .  mysql_error() . ", Try Again.</b>");
redirect('zoneadded.php');

?>
