<?

//  Start TIMER
//  -----------
$stimer = explode( ' ', microtime() );
$stimer = $stimer[1] + $stimer[0];
//  -----------

//header("Content-type: text/html; charset=utf-8");

// cache control
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//header("Cache-Control: chat"); 
session_cache_limiter("must-revalidate");

require_once(dirname(__FILE__) .'/../../../global/global.php');

$GLOBALS["localHTMLRoot"] = $GLOBALS["localInterfacesRoot"] ."chat/";
$GLOBALS["localIncRoot"] = $GLOBALS["localHTMLRoot"] ."inc/";
$GLOBALS["localPagesRoot"] = $GLOBALS["localHTMLRoot"];
$GLOBALS["localXSLRoot"] = $GLOBALS["localHTMLRoot"] ."xsl/";
$GLOBALS["webHTMLRoot"] = $GLOBALS["webInterfacesRoot"] ."chat/";
$GLOBALS["webPagesRoot"] = $GLOBALS["webHTMLRoot"];
$GLOBALS["webIncRoot"] = $GLOBALS["webHTMLRoot"] ."inc/";
$GLOBALS["webCSSRoot"] = $GLOBALS["webPagesRoot"] ."inc/";
$GLOBALS["webIncRoot"] = $GLOBALS["webPagesRoot"] ."inc/";

$GLOBALS["localImagesRoot"] = $GLOBALS["localHTMLRoot"] ."img/";
$GLOBALS["webImagesRoot"] = $GLOBALS["webHTMLRoot"] ."img/";

require_once($GLOBALS["localIncRoot"] ."functions.php");

session_start();

?>