<?      require_once '/home/remagine/public_html/includes/remagine_defines.php';
        ob_start();
?>
<HTML>
<HEAD>
<TITLE>REMAGINE - Comprehensive Business Solution <? if ($section=="home") 
	                                               echo "- Home";
                                                       elseif ($section=="mission")
                                                       echo "- Mission";
                                                       elseif ($section=="services")
                                                       echo "- Services";
                                                       elseif ($section=="contact")
						       echo "- Contact Us";
						       elseif ($section=="aboutus")
						       echo "- About Us";							   
						       elseif ($section=="showcase")
						       echo "- Showcase"; ?></TITLE>
<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META NAME="DESCRIPTION" CONTENT="REMAGINE is a full service marketing firm that specializes in website design, graphic creation, site hosting, software development, internet technologies, communications, and branding strategies.">
<META NAME="KEYWORDS" CONTENT="www.remagine.net, remagine, marketing, website, design, hosting, advertising, graphics, publicity, public relations, business, internet, web, art, linux, microsoft, windows, massachusetts, internet">
<META Name="Author" Content="Ian Ricci">
<LINK rel="shortcut icon" href="images/favicon.ico" >
<LINK 
href="includes/newstyle.css" 
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
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-126775-2";
urchinTracker();
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 onLoad="MM_preloadImages('../images/services2.jpg','../images/mission2.jpg','../images/support2.jpg','../images/aboutus2.jpg','../images/showcase2.jpg','../images/contactus2.jpg')">
<TABLE WIDTH=1025 BORDER=0 CELLPADDING=0 CELLSPACING=0>
  <TR> 
    <TD COLSPAN=5> <a href="http://www.remagine.net"><IMG SRC="images/testremagine_02.jpg" ALT="" WIDTH=296 HEIGHT=63 border="0"></a></TD>
    <TD COLSPAN=6> <IMG SRC="images/testremagine_03.jpg" ALT="" WIDTH=464 HEIGHT=63 border="0"></TD>
    <TD width="264" ROWSPAN=8>&nbsp; </TD>
    <TD width="10"> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=63 ALT=""></TD>
  </TR>
  <TR> 
    <TD COLSPAN=2> <IMG SRC="images/testremagine_05.jpg" WIDTH=179 HEIGHT=19 ALT=""></TD>
    <TD COLSPAN=2> <a href="index.php?section=services" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Services','','images/services2.jpg',1)"><img src="images/services<? if ($section=="services") echo "2"?>.jpg" alt="Services" name="Services" width="89" height="19" border="0"></a></TD>
    <TD COLSPAN=2> <a href="index.php?section=mission" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Mission','','images/mission2.jpg',1)"><img src="images/mission<? if ($section=="mission") echo "2"?>.jpg" alt="Mission" name="Mission" width="81" height="19" border="0"></a></TD>
    <TD width="85"> <a href="index.php?section=contact" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Support','','images/support2.jpg',1)"><img src="images/testremagine_08.jpg" alt="Support" name="Support" width="85" height="19" border="0"></a></TD>
    <TD width="88"> <a href="index.php?section=aboutus" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('About Us','','images/aboutus2.jpg',1)"><img src="images/aboutus<? if ($section=="aboutus") echo "2"?>.jpg" alt="About Us" name="About Us" width="88" height="19" border="0"></a></TD>
    <TD width="96"> <a href="index.php?section=showcase" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Showcase','','images/showcase2.jpg',1)"><img src="images/showcase<? if ($section=="showcase") echo "2"?>.jpg" alt="Showcase" name="Showcase" width="96" height="19" border="0"></a></TD>
    <TD COLSPAN=2> <a href="index.php?section=contact" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Contact Us','','images/contactus2.jpg',1)"><img src="images/contactus<? if ($section=="contact") echo "2"?>.jpg" alt="Contact Us" name="Contact Us" width="142" height="19" border="0"></a></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=19 ALT=""></TD>
  </TR>
  <TR> 
    <TD COLSPAN=2><img src=<? if ($section=="home") 
	                        echo "images/business.jpg";
				elseif ($section=="contact")							 
                                echo "images/business.jpg";
                                elseif ($section=="services")
                                echo "images/business.jpg"; 
                                elseif ($section=="mission")
                                echo "images/business.jpg";			        
                                elseif ($section=="aboutus")
			        echo "images/business.jpg";
		                elseif ($section=="showcase")
			        echo "images/business.jpg"; ?> width="179" height="99"> </TD>
    <TD COLSPAN=8><img src=<? if ($section=="home") 
	                        echo "images/micoangelo.jpg";
                                elseif ($section=="mission")                                
                                echo "images/missionbanner.jpg";
                                elseif ($section=="services")
                                echo "images/servicesbanner.jpg";
                                elseif ($section=="aboutus")
				echo "images/aboutusbanner.jpg"; 							  
				elseif ($section=="contact")
			        echo "images/contactdish.jpg"; 
				elseif ($section=="showcase")
			        echo "images/clientsbanner.jpg"; ?> width="541" height="99"> </TD>
    <TD width="40" valign="top"><IMG SRC="images/testremagine_14.jpg" WIDTH=40 HEIGHT=99 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=99 ALT=""></TD>
  </TR>
  <TR> 
    <TD width="178"> <IMG SRC="images/testremagine_15.jpg" WIDTH=178 HEIGHT=51 ALT=""></TD>
    <TD COLSPAN=10> <IMG SRC=<? if ($section=="home") 
	                          echo "images/testremagine_16.jpg";
                                  elseif ($section=="mission")
                                  echo "images/missionbar.jpg";				  
                                  elseif ($section=="services")
                                  echo "images/servicesbar.jpg";
                                  elseif ($section=="contact")
				  echo "images/contactbar.jpg";
		                  elseif ($section=="aboutus")
				  echo "images/historybar.jpg";
				  elseif ($section=="showcase")
			          echo "images/clientsandaff.jpg"; ?> WIDTH=582 HEIGHT=51 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=51 ALT=""></TD>
  </TR>
  <TR> 
    <TD valign="top" height="104"><table width="145" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="145"> 
            <FORM style="DISPLAY: inline" action=/webmail/src/redirect.php method=post ?>
              <div align="left">Username:</div>
			  <div align="center"> 
                <input class="sp2_field" name="login_username" id="q2" value="" maxlength="255" size="25" type="text">
                <br>
                <div align="left">Password:</div>
                <input class="sp2_field" name="secretkey" id="q2" value="" maxlength="255" size="25" type="password">
                <br>
                <br>
                <input name="search" type="image" id="search" src="images/submit.gif" align="left" width="54" height="20" border="0" >
              </div>
            </form>
          </td>
        </tr>
      </table>
      </TD>
    <TD COLSPAN=2 ROWSPAN=3 background="images/leftbar.jpg">&nbsp; </TD>
    <TD COLSPAN=8 ROWSPAN=3 valign="top"><? include $site[$section][$page];?></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=104 ALT=""></TD>
  </TR>
  <TR> 
    <TD valign="top"><IMG SRC="images/testremagine_20.jpg" WIDTH=178 HEIGHT=3 ALT=""></TD>
    <TD valign="top"> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=3 ALT=""></TD>
  </TR>
  <TR> 
    <TD ROWSPAN=2 valign="top">&nbsp; </TD>
    <TD height="238"> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=237 ALT=""></TD>
  </TR>
  <TR> 
    <TD COLSPAN=10> <IMG SRC="images/testremagine_22.jpg" WIDTH=582 HEIGHT=9 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=9 ALT=""></TD>
  </TR>
  <TR> 
    <TD height="2"> <IMG SRC="images/spacer.gif" WIDTH=178 HEIGHT=1 ALT=""></TD>
    <TD width="1"> <IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=1 ALT=""></TD>
    <TD width="20"> <IMG SRC="images/spacer.gif" WIDTH=20 HEIGHT=1 ALT=""></TD>
    <TD width="69"> <IMG SRC="images/spacer.gif" WIDTH=69 HEIGHT=1 ALT=""></TD>
    <TD width="28"> <IMG SRC="images/spacer.gif" WIDTH=28 HEIGHT=1 ALT=""></TD>
    <TD width="53"> <IMG SRC="images/spacer.gif" WIDTH=53 HEIGHT=1 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=85 HEIGHT=1 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=88 HEIGHT=1 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=96 HEIGHT=1 ALT=""></TD>
    <TD width="102"> <IMG SRC="images/spacer.gif" WIDTH=102 HEIGHT=1 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=40 HEIGHT=1 ALT=""></TD>
    <TD> <IMG SRC="images/spacer.gif" WIDTH=264 HEIGHT=1 ALT=""></TD>
    <TD></TD>
  </TR>
</TABLE><br>Copyright &copy; 2003-<? echo date ("Y"); ?> REMAGINE, all rights reserved.
</BODY>
</HTML>
