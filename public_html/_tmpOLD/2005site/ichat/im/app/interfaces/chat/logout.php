<?

require "inc/global.php";

if ($_SESSION["username"]) {
	$search = new Search("ChatUser");
	$search->addCondition("username","=",$_SESSION["username"]);
	$search->addCondition("sessionId","=",session_id());
	$results = $search->getResults();
	if ($search->totalResultsCount > 0) {
		$new = new ChatMessage();
		$new->fromUsername = $_SESSION["username"];
		$new->type = 3;
		$new->save();
		foreach ($results AS $r) {
			$r->delete();
		}
		session_destroy();
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Digg API iPhone Interface</title>
		<script type="text/javascript" src="yui/yahoo-dom-event.js"></script>
		<script type="text/javascript" src="yui/animation-min.js"></script>
		<script type="text/javascript" src="yui/dragdrop-min.js"></script>
		<script type="text/javascript" src="yui/connection-min.js"></script>
		<style>
			<!--
			body {
				padding: 0px;
				margin: 0px;
				color: #444444;
				background: #FFFFFF;
				font-family: Arial, Sans-Serif;
				overflow: visible;
			}
			body, div, ul, a {
				cursor: hand;
			}
			a {
				text-decoration: none;
			}
			a.download {
				font-weight: bold;
			}
			form {
				margin: 30px;
			}
				form input.text {
					width: 100%;
					font-size: 16px;
				}
				form input.button {
					font-size: 16px;
				}
			#site {
				width: 100%;
				height: 100%;
				overflow: hidden;
			}
			#wide {
				width: 200%;
				margin-top: 355px;
			}
			div.col {
				width: 50%;
				float: left;
				min-height: 355px;
				position: relative;
			}
			ul {
				list-style: none;
				padding: 0px;
				margin: 0px;
			}
				ul li {
					border-bottom: 1px solid #E9E9E9;
					background: url("row-arrow.gif") right center no-repeat;
				}
					ul li a, ul li a:active, ul li div.story {
						display: block;
						padding: 7px;
						padding-left: 15px;
						color: #444444;
						min-height: 24px;
					}
					ul li a div.spinner {
						display: none;
					}
						ul li a.on div.spinner {
							display: block;
							float: right;
							height: 16px;
							color: #FFFFFF;
							font-size: .7em;
							font-style: italic;
							margin-right: 10px;
							margin-top: 6px;
						}
					ul li div.story {
						font-size: .8em;
						padding-right: 35px;
						padding-left: 54px;
					}
						ul li div.story div.diggs {
							background: url("shade-compact.gif") no-repeat;
							color: rgb(147, 136, 63);
							width: 36px;
							height: 24px;
							float: left;
							text-align: center;
							margin-left: -46px;
							line-height: 1.9em;
						}
					ul li a.on, ul li div.on {
						background: url("row-repeat-x.gif") left bottom repeat-x #408cef;
						color: #FFFFFF;
					}
						ul li div.on div.diggs {
							background-image: none;
							color: #FFFFFF;
							border: 1px solid #FFFFFF;
							width: 34px;
							height: 22px;
						}
					ul li a div.container {
						font-size: .6em;
						color: #888888;
					}
					ul li a.on div.container {
						color: #FFFFFF;
					}
			#scroll {
				background: #999999;
				position: absolute;
				right: 3px;
				margin-top: 2px;
				top: 0px;
				height: 0px;
				width: 4px;
				z-index: 10;
				display: none;
			}
			-->
		</style>
	</head>
	<body onSelectStart="return false;">
		<div id="site">
			<form method="post" action="<?= get_url(true, false); ?>" class="">
				<label>Logged out.</label>
				<br /><br />
				<input type="button" name="submit" onClick="window.location='login.php';" value="&nbsp;Return to Log In&nbsp;" class="button" />
			</form>
		</div>
	</body>
</html>