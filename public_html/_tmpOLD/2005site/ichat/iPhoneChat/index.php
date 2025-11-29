<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>iPhone Interface in JavaScript</title>
		<style>
			<!--
			body {
				padding: 0px;
				margin: 0px;
				color: #999999;
				background: #000000;
				font-family: Arial, Sans-Serif;
			}
			a {
				color: #FFFFFF;
				text-decoration: none;
			}
			a:hover {
				text-decoration: underline;
			}
			a.download {
				font-weight: bold;
			}
			#div-iframe {
				position: absolute;
				left: 100px;
				top: 258px;
			}
				#screen {
					border: 0px;
					width: 320px;
					height: 355px;
					overflow: hidden;
				}
			a.button-back {
				position: absolute;
				left: 0px;
				top: 355px;
				display: block;
				width: 77px;
				height: 46px;
				background: url("button-back.jpg") 0px 0px no-repeat;
				float: left;
			}
				a.button-back:active {
					background: url("button-back.jpg") 0px -46px no-repeat;
				}
			a.button-forward {
				position: absolute;
				left: 77px;
				top: 355px;
				display: block;
				width: 77px;
				height: 46px;
				background: url("button-forward.jpg") 0px 0px no-repeat;
			}
				a.button-forward:active {
					background: url("button-forward.jpg") 0px -46px no-repeat;
				}
			#site {
				margin-right: 50px;
			}
			a.nav {
				padding: 20px;
				color: #BBBBBB;
				background: #333333;
				margin-top: 60px;
				display: block;
				float: right;
				margin-left: 20px;
				width: 100px;
				text-align: center;
				font-weight: bold;
			}
			a.on {
				color: #DAD311;
			}
			a.nav:hover {
				background: #444444;
				text-decoration: none;
			}
			
			-->
		</style>
		<script language="JavaScript">
			var lastURL;
		</script>
	</head>
	<body>
		<div id="site">
			<a href="http://www.publictivity.com/iPhoneChat/" class="nav on">iPhoneChat</a>
			<a href="http://davidcann.com/iphone/" class="nav">iPhoneDigg</a>
			<img src="iphone-interface.jpg" width="503" height="830" border="0" align="left" />
			<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
			<h1 style="font-size: 1.5em;">iChat for iPhone in JavaScript</h1>
			<p>&raquo; <a href="iPhoneChat.zip" class="download">Download Source (.zip)</a></p>
			<p>Generously hosted by my friends at <a href="http://www.publictivity.com">Publictivity</a>.</p>
			<p>Log in with your AOL IM account.  No data is logged, but all of your information does pass through my server.  <b>I am not harvesting any information.</b>  This app is server intensive, so I'm limiting sessions to 10 minutes for now.</p>
			<p>Use your mouse to flick (drag and release) your buddy list up and down like you're supposed to on the iPhone.  Click a buddy to start a conversation.  You can open multiple conversations... flick left/right to change conversations.</p>
			<p><b>Known Issues:</b></p>
			<li>No groups.</li>
			<li>No buddy icons (Anyone have full TOC2 documentation?).</li>
			<li>Opening more than 4 conversations gets unruly.</li>
			<p>Built with <a href="http://developer.yahoo.com/yui/">Yahoo! UI Library</a>, <a href="http://www.php.net/">PHP</a> and <a href="http://www.therisenrealm.com/scripts/bluetoc/">BlueTOC</a>.</p>
			<p>Send your thoughts and links with your own versions to: iphone [at] davidcann.com.</p>
			<div id="div-iframe">
				<iframe id="screen" name="screen" src="/im/"></iframe>
				<!-- <a href="javascript:void(0);" onClick="if(frames[0].slide){frames[0].slide('left'); return false;} document.getElementById('screen').src='/im/?url='+ lastURL; return false;" class="button-back"></a> -->
				<!-- <a href="javascript:void(0);" onClick="return false;" class="button-forward"></a> -->
			</div>
		</div>
	</body>
</html>
