<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?      require_once 'includes/remagineDefines.php';
        ob_start();
?>
<html>
<head>
<title>REMAGINE | Comprehensive Business Solution -
<? if ($section=="home")
                                                       echo "Welcome";
                                                       elseif ($section=="datam")
                                                       echo "Data Management";
                                                       elseif ($section=="aboutus")
                                                       echo "About Us";
                                                       elseif ($section=="contact")
                                                       echo "Contact";
                                                       elseif ($section=="support")
                                                       echo "Support";
                                                       elseif ($section=="showcase")
                                                       echo "Showcase";
                                                       elseif ($section=="mission")
                                                       echo "Mission";
                                                       elseif ($section=="isolutions")
                                                       echo "Internet Solutions";
                                                       elseif ($section=="telecom")
                                                       echo "Telecommunications";
                                                       elseif ($section=="services")
                                                       echo "Services";
?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META NAME="DESCRIPTION" CONTENT="REMAGINE is a full service firm that specializes in telecommunications solutions, data management, software development, web design, and internet technologies.">
<META NAME="KEYWORDS" CONTENT="www.remagine.com, www.remagine.net, www.remagine.org, remagine, marketing, design, hosting, data management, network design, springfield, internet solutions, business, internet, web, telecommunications solutions, linux, microsoft, massachusetts, internet">
<META Name="Author" Content="REMAGINE LLC"><LINK rel="shortcut icon" href="images/favicon.ico" ><LINK href="includes/remagineIndexStyle.css" type=text/css rel=stylesheet>
<meta name="verify-v1" content="oB9Zc/MELIxl4qo+R7027Vd2Mv7BkUP0rlWD56vVsJI=" />
	</head>
	<body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
		<div id="container">
		<div id="Table_01" class="ts-1">
			<div class="ts-1-1"><a href="index.php"><img height="67" alt="" src="images/REMAGINE.jpg" width="655" border="0"></a></div>
			<div class="ts-1-2"><div align="right" style="margin-right:30px; margin-top:0px;"><? echo date ("F j, Y"); ?></div></div>
			<div class="ts-1-3"><img height="56" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-4"><img height="11" alt="" src="images/remaginemain_03.jpg" width="340"></div>
			<div class="ts-1-5"><img height="11" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-6"><img height="272" alt="" src="images/remaginemain_04.jpg" width="31"></div>
			<div class="ts-1-7"><div class="isolnav<? if ($section=="isolutions") echo "_solutions"; else if ($section=="telecom") echo "_telecom";?>"><a href="main.php?section=isolutions"><img height="33" alt="" src="images/internetSolutionsm<? if ($section=="isolutions") echo "_isolution"; else if ($section=="telecom") echo "_telecom";?>.jpg" width="200" border="0"></a></div></div>
			<div class="ts-1-8"><div class="dmnav<? if ($section=="isolutions") echo "_solutions"; else if ($section=="telecom") echo "_telecom";?>"><a href="main.php?section=datam"><img height="33" alt="" src="images/dataManagementm<? if ($section=="datam") echo "2"; elseif ($section=="isolutions") echo "_isolution"; else if ($section=="telecom") echo "_telecom";?>.jpg" width="234" border="0"></a></div></div>
			<div class="ts-1-9"><div class="tcomnav<? if ($section=="isolutions") echo "_solutions"; else if ($section=="telecom") echo "_telecom";?>"><a href="main.php?section=telecom"><img height="33" alt="" src="images/telecommunicationsm<? if ($section=="telecom") echo "_telecom"; elseif ($section=="isolutions") echo "_isolution"; else if ($section=="telecom") echo "_telecom";?>.jpg" width="190" border="0"></a></div></div>
			<div class="ts-1-10"><div class="missionnav"><a href="main.php?section=mission"><img height="38" alt="" src="images/mission<? if ($section=="mission") echo "2"?>.jpg" width="340" border="0"></a></div></div>
			<div class="ts-1-11"><img height="33" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-12"><img height="111" alt="" src="images/possibilities<? if ($section=="isolutions") echo "_isolutions"; else if ($section=="telecom") echo "_telecom";?>.jpg" width="624"></div>
			<div class="ts-1-13"><img height="5" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-14"><div class="aboutnav"><a href="main.php?section=aboutus"><img height="34" alt="" src="images/aboutus<? if ($section=="aboutus") echo "2"?>.jpg" width="340" border="0"></a></div></div>
			<div class="ts-1-15"><img height="34" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-16"><div class="servicesnav"><a href="main.php?section=services"><img height="36" alt="" src="images/services<? if ($section=="services") echo "2"?>.jpg" width="340" border="0"></a></div></div>
			<div class="ts-1-17"><img height="36" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-18"><div class="supportnav"><a href="main.php?section=support"><img height="38" alt="" src="images/support<? if ($section=="support") echo "2"?>.jpg" width="340" border="0"></a></div></div>
			<div class="ts-1-19"><img height="36" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-20"><div align="center"><? include $site[$section][$page];?></div><br />
			<div align="center" style="margin-bottom:0px;"><br>Copyright &copy; 2003-<? echo date ("Y"); ?> <a href="http://www.remagine.com">REMAGINE, REMAGINE, LLC</a>, all rights reserved.</div>
			</div>
			<div class="ts-1-21"><img height="2" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-22"><div class="showcasenav"><a href="main.php?section=showcase"><img height="38" alt="" src="images/showcase<? if ($section=="showcase") echo "2"?>.jpg" width="340" border="0"></a></div></div>
			<div class="ts-1-23"><img height="38" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-24"><div class="contactnav"><a href="main.php?section=contact"><img height="55" alt="" src="images/contact<? if ($section=="contact") echo "2"?>.jpg" width="340" border="0"></a></div></div>
			<div class="ts-1-25"><img height="55" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-26"><img height="69" alt="" src="images/remaginemain_16.jpg" width="340"></div>
			<div class="ts-1-27"><img height="33" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-28"><img height="338" alt="" src="images/remaginemain_17.jpg" width="31"></div>
			<div class="ts-1-29"><img height="36" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-30"><img height="231" alt="" src="images/remaginemain_18.jpg" width="6"></div>
			<div class="ts-1-31"><div id="callremagine"><div style="padding:20px;"><? include "includes/sub_solutions.php"; ?></div></div></div>
			<div class="ts-1-32"><img height="231" alt="" src="images/remaginemain_20.jpg" width="30"></div>
			<div class="ts-1-33"><img height="231" alt="" src="images/spacer.gif" width="1"></div>
			<div class="ts-1-34"><img height="71" alt="" src="images/remaginemain_21.jpg" width="340"></div>
			<div class="ts-1-35"><img height="71" alt="" src="images/spacer.gif" width="1"></div>
		</div>
		</div>
</body>
</html>
