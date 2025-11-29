<?

require "inc/global.php";

if (!$_SESSION["username"]) {
	header("Location: login.php");
	exit();
} else if ($_SESSION["username"]) {
	$search = new Search("ChatUser");
	$search->addCondition("username","=",$_SESSION["username"]);
	$search->addCondition("sessionId","=",session_id());
	$results = $search->getResults();
	if ($search->totalResultsCount == 0) {
		header("Location: login.php");
		exit();
	}
}

$title = "Chat";
$menu = "home";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>iPhoneChat</title>
		<link rel="stylesheet" href="inc/style.css?<?= rand(100000,999999) ?>" type="text/css" />
		<script type="text/javascript" src="yui/yahoo-dom-event.js"></script>
		<script type="text/javascript" src="yui/animation-min.js"></script>
		<script type="text/javascript" src="yui/dragdrop-min.js"></script>
		<script type="text/javascript" src="yui/connection-min.js"></script>
		<script type="text/javascript" src="FocusChat/FocusChat.class.js"></script>
		<script type="text/javascript" src="FocusChat/bubblesort.js"></script>
		<script type="text/javascript" src="inc/javascript.js"></script>
		<script language="JavaScript">
			var currentUsername = '<?= $_SESSION["username"] ?>';
			window.setTimeout("alert('You will be automatically signed out in 1 minute.');", 540000); // 9 minutes
			window.setTimeout("window.location='logout.php';", 600000); // 9 minutes
		</script>
	</head>
	<body onSelectStart="return false;" onLoad="myChat = new FocusChat('myChat'); myChat.setRefreshInterval(myChat.intervalDefault); myChat.updateChat(); zoomUp();">
		<img src="img/row-repeat-x.gif" width="1" height="1" border="0" style="position: fixed; left: -10;" />
		<img src="img/row-arrow.gif" width="1" height="1" border="0" style="position: fixed; left: -10;" />
		<div id="sheet" style="display: none;">
			<div id="sheet-content">
				<p>Are you sure you<br />want to log off?</p>
				<input type="button" onClick="document.getElementById('sheet').style.display='none';" value="&nbsp;Cancel&nbsp;" class="button" />
				&nbsp;
				<input type="button" onClick="window.location='logout.php';" value="&nbsp;Log&nbsp;Off&nbsp;" class="button" />
			</div>
		</div>
		<div id="footer">
			<div id="tabs"></div>
			<div id="xChat" style="display: none;"><img src="img/x-circle.png" width="1" height="1" border="0" style="margin-left: 6px;" onClick="return false; killCurrentChat();" /></div>
			<div id="goBack" onClick="slide('left',1,-1,1);" style="display: none;"><img src="img/list.gif" width="34" height="50" border="0" /><div class="username"><?= $_SESSION["username"] ?></div></div>
			<div id="logoff" style="display: block;" onClick="fadeInSheet();"><img src="img/x.gif" width="34" height="50" border="0" /><div class="username"><?= $_SESSION["username"] ?></div></div>
		</div>
		<div id="typing" style="display: none;"><form onSubmit="submitText(); return false;" action="javascript:void(0);" method="get"><input type="text" id="typing-text" /><input type="submit" value="Send" style="display: none;" /></form></div>
		<div id="site">
			<div id="wide">
				<div class="col" id="col1">
					<ul id="buddies"></ul>
				</div>
			</div>
			<div id="scroll"></div>
		</div>
	</body>
</html>
