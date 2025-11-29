<html>
<head>
<title>S.T.C.C Articles</title>
<LINK rel="shortcut icon" href="images/favicon.ico" >
<LINK href="http://remagine.net/includes/newstyle.css" 
type=text/css rel=stylesheet>
<style type="text/css">
<!--
body,td,th {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #666666;
	list-style-image: url(images/bullet.png);}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	list-style-image: url(images/bullet.png);
}
a:link {color: #336699;
	text-decoration: none;}
a:visited {text-decoration: none;
	color: #336699;}
a:hover {text-decoration: none;
	color: #CC6600;}
a:active {text-decoration: none;
	color: #000000;}
.disclaimer {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #999999;}
.searchbox {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #666666;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: small-caps;
	text-transform: none;
	background-color: #FFFFFF;
	display: inline;
	border: 1px solid #999999;}
-->
</style>
<style type="text/css">
.sp2_field {border:1px solid #999999; background-color:#ffffff; font-family:Verdana; font-style:normal; color:#999999; font-size:10px; font-weight:normal; }.sp2_btn {font-family:Verdana; font-style:normal; color:#000000; font-size:10px; font-weight:normal; }.sp2_i_select {background-color:#ffffff; font-family:Verdana; font-style:normal; color:#000000; font-size:10px; font-weight:normal; }a.sp2_advanced:link,a.sp2_advanced:active,a.sp2_advanced:visited {font-family:Verdana; font-style:normal; text-decoration:none; color:#7777cc; font-size:10px; font-weight:normal; }a.sp2_advanced:hover {font-family:Verdana; font-style:normal; text-decoration:underline; color:#7777cc; font-size:10px; font-weight:normal; }.sp2_info {font-family:Verdana; font-style:normal; text-decoration:none; color:#000000; font-size:10px; font-weight:bold; }a.sp2_title:link,a.sp2_title:active,a.sp2_title:visited {font-family:Verdana; font-style:normal; text-decoration:none; color:#7777cc; font-size:10px; font-weight:bold; }a.sp2_title:hover {font-family:Verdana; font-style:normal; text-decoration:underline; color:#7777cc; font-size:10px; font-weight:bold; }.sp2_result {font-family:Verdana; font-style:normal; text-decoration:none; color:#000000; font-size:10px; font-weight:normal; }.sp2_select {font-family:Verdana; font-style:normal; text-decoration:none; color:#990000; font-size:10px; font-weight:bold; }.sp2_address {font-family:Verdana; font-style:normal; text-decoration:none; color:#008000; font-size:10px; font-weight:normal; }.sp2_page {font-family:Verdana; font-style:normal; text-decoration:none; color:#000000; font-size:10px; font-weight:normal; }a.sp2_page:link,a.sp2_page:active,a.sp2_page:visited {font-family:Verdana; font-style:normal; text-decoration:underline; color:#000000; font-size:10px; font-weight:normal; }a.sp2_page:hover {font-family:Verdana; font-style:normal; text-decoration:underline; color:#000000; font-size:10px; font-weight:normal; }.sp2_nowpage {font-family:Verdana; font-style:normal; text-decoration:none; color:#a90a08; font-size:10px; font-weight:bold; }.style1 {color: #265e8a}
</style>
</head>
<body>
<center><table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign=top align=right><img src="images/ministcclogo.gif"></td>
    <td>&nbsp;</td>
<BR><center>
    <td><strong>Springfield Technical Community College</strong><BR><BR>Press  Release - <a href="http://www.remagine.net">REMAGINE</a><br><br>
<?php
// Condition for reading and listing dir content as hyperlink.
$num = 1;
if ($handle = opendir('/home/remagine/public_html/news/stcc/articles')) {   
while (false !== ($file = readdir($handle))) {  
     if ($file != "." && $file != "..") {   
        echo "Article - " . $num++ .  " - <a href='articles/$file\n'>$file</a>";     
        echo "<BR>";        
        echo "<BR>";       
	}
   }   
closedir($handle);
}
?>
</td>
  </tr>
</table></center>
</body>
</html>
