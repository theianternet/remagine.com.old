<?

/*
* im
*/

// development config
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", "On");
$GLOBALS["databaseShowErrors"] = true;

// live config
/*
error_reporting();
ini_set("display_errors", "Off");
$GLOBALS["databaseShowErrors"] = false;
*/

ini_set("session.gc_maxlifetime","14400");

$GLOBALS["localRoot"] = "";
if ($GLOBALS["localRoot"] == "")
{
	$GLOBALS["localRoot"] = dirname(__FILE__) ."/";
}
$GLOBALS["localClassRoot"] = $GLOBALS["localRoot"] ."classes/";
$GLOBALS["localGlobalRoot"] = $GLOBALS["localRoot"] ."global/";
$GLOBALS["localInterfacesRoot"] = $GLOBALS["localRoot"] ."interfaces/";
$GLOBALS["localVaultRoot"] = $GLOBALS["localRoot"] ."vault/";

$GLOBALS["domainRoot"] = "";
$GLOBALS["webRoot"] = "";
$GLOBALS["webInterfacesRoot"] = $GLOBALS["webRoot"] ."interfaces/";

$GLOBALS["databaseAddress"] = "localhost";
$GLOBALS["databaseUsername"] = "root";
$GLOBALS["databasePassword"] = "";
$GLOBALS["databaseName"] = "iPhoneChat";
$GLOBALS["tableNamePrefix"] = "im_";

$GLOBALS["cacheSeed"] = rand(100000,999999);
//$GLOBALS["cacheSeed"] = 1;

$GLOBALS["sendEmailsFromAddress"] = "";
$GLOBALS["sendEmailsHostName"] = "";
$GLOBALS["sendEmailsUsername"] = "";
$GLOBALS["sendEmailsPassword"] = "";
$GLOBALS["sendEmailsLocalhost"] = "localhost";
$GLOBALS["sendEmailsTimeOut"] = 10;

?>