<?php

// Global DB vars.
$DB_HOST = "localhost";
$DB_USER = "dyndns";
$DB_PASS = "abysstech";
$DB_NAME = "dynzone";

function redirect($rel_url)
{
header("Location: http://".$_SERVER['HTTP_HOST']
                   .dirname($_SERVER['PHP_SELF'])
                   ."/".$rel_url);
}

?>
