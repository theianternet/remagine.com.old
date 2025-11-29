<?
	$remoteip = $_SERVER['REMOTE_ADDR'];
	$zone = $_REQUEST['zone'];
	$auth = $_REQUEST['PHP_AUTH_USER'];
	$pass = $_REQUEST['PHP_AUTH_PW'];	

	echo $remoteip;
	echo $auth;
	echo '<BR><BR><BR>';
	echo $zone;
	echo '<BR>';
	echo $pass;
?>
