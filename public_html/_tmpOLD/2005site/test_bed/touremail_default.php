<?
$tourid = $_REQUEST['tourID'];
$siteurl = $_REQUEST['siteURL'];
$siteid = $_REQUEST['siteID'];
?>
<html><head><title>Send This Tour</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="css/Level2_Verdana_Forms.css">
<center><table width="300" border="1" align="center" cellpadding="16" cellspacing="0" >
                    <tr>
                      <td width="300" height="300" >
<style type="text/css">
<!--
.style1 {color: #333333}
.style2 {color: #FFFFFF}
body {
	background-color: #FFFFFF;
}
body, td, th {
	color: #CCCCCC;
}
.style3 {color: #333333; font-weight: bold; }
-->
</style></head>
<center><script language="JavaScript">
function checkForm()
{
    var cname, cemail, cemail2, cphone, csubject, cmessage;
    with(window.document.msgform)
    {
        cname    = sname;
        cemail   = email;
        cemail2   = email2;
        csubject = subject;
        cmessage = message;
    }
    
    if(trim(cname.value) == '')
    {
        alert('Please enter your name');
        cname.focus();
        return false;
    }
    else if(trim(cemail.value) == '')
    {
        alert('Please enter your email');
        cemail.focus();
        return false;
    }
    else if(!isEmail(trim(cemail.value)))
    {
        alert('The recipients email address is not valid');
        cemail.focus();
        return false;
    }
    else if(trim(cemail2.value) == '')
    {
        alert('Please enter your email');
        cemail.focus();
        return false;
    }
    else if(!isEmail(trim(cemail2.value)))
    {
        alert('The recipients email address is not valid');
        cemail.focus();
        return false;
    }
    else if(trim(csubject.value) == '')
    {
        alert('Please enter message subject');
        csubject.focus();
        return false;
    }
    else
    {
        cname.value    = trim(cname.value);
        cemail.value   = trim(cemail.value);
        cemail2.value   = trim(cemail2.value);
        csubject.value = trim(csubject.value);
        cmessage.value = trim(cmessage.value);
        return true;
    }
}

/*
Strip whitespace from the beginning and end of a string
Input : a string
*/
function trim(str)
{
    return str.replace(/^\s+|\s+$/g,'');
}

/*
Check if a string is in valid email format. 
Returns true if valid, false otherwise.
*/
function isEmail(str)
{
    var regex = /^[-_.a-z0-9]+@(([-_a-z0-9]+\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i;
    return regex.test(str);
}
</script>
<?php

$errmsg  = ''; // error message
$sname   = ''; // sender's name
$email   = ''; // sender's email addres
$subject = ''; // message subject
$comments = ''; // the message itself

if(isset($_POST['send']))
{
    $sname   = $_POST['sname'];
    $email   = $_POST['email'];
    $email2   = $_POST['email2'];
    $subject = $_POST['subject'];
    $comments = $_POST['comments'];
    
   // Removed validation.
   //---------------------------------------------------
   // if(trim($sname) == '')
   //{
   //    $errmsg = 'Please enter your name';
   // 
   //lse if(trim($email) == '')
   //
   //   $errmsg = 'The recipients email address is not valid';
   //
   //else if(!isEmail($email))
   // {
   //     $errmsg = 'The recipients email address is not valid';
   // }
   //     else if(trim($email2) == '')
   // {
   //     $errmsg = 'Your email address is not valid';
   // }
   // else if(!isEmail($email2))
   // {
   //     $errmsg = 'Your email address is not valid';
   // }

   // if($errmsg == '')
   // {
   //     if(get_magic_quotes_gpc())
   //     {
   //        $subject = stripslashes($subject);
   //         $message = stripslashes($message);
   //     }
   //-------------------------------------------------------
   
   // Passed info from player.
   $siteLink = $siteurl . '?&SiteID=' . $siteid . '&TourID=' . $tourid;
   
   // Receipents email.

   $to = $email;

   // Subject Condition.
      if($sname == null)
		  {
			$subject = 'You have been sent a Dragonfly media tour.';
		  }
		  else
	      {
			$subject = $sname . ' has sent you a Dragonfly media tour.';
		  }
   // end

   // Body Text.
       if($sname == null)
		  {
			$body = 'You have been sent a Dragonfly media tour.';
		  }
		  else
	      {
			$body = $sname . ' has sent you a Dragonfly media tour.';
		  }
   // end
   
   // Message comments with removed slash from apostrophes.
   $usercomments = stripslashes($comments);
   
   // Dragonfly email message.
        $headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "From: Dragonfly Tours <tours@getdragonfly.com>\n";
		$headers .= "Reply-To: \"".$email2."\" <".$email2.">\n";
		$message = "<style type=text/css>";
		$message .= "<!--";
		$message .= ".style1 {color: #999999}";
		$message .= ".style2 {font-family: 'Lucida Grande', Verdana, Tahoma}";
		$message .= ".style4 {font-family: 'Lucida Grande', Verdana, Tahoma; font-size: 10px; }";
		$message .= ".style6 {";
		$message .= "font-family: 'Lucida Grande', Verdana, Tahoma";
		$message .= "font-style: italic;";
		$message .= "font-size: 14px;";
		$message .= "}";
		$message .= "-->";
		$message .= "</style>";
		$message .= "<center>";
		$message .= "<p><img src=http://getdragonfly.com/tgravett/060216_email_received/DF_logo-28_experience-1.gif width=327 height=49 /><br />";
		$message .= "<a href=$siteLink target=_blank><br /><img src=http://getdragonfly.com/tgravett/060216_email_received/DF_globe_anim_50x50-4.gif  width=130 height=50 border=0 longdesc=http://getdragonfly.com /></a><br />";
		$message .= "<span class=style4>click this button to view the tour.</span></p>";
		$message .= "<span class=style2>$body<br></span></p>";
		$message .= "<p><font face='Lucida Grande, Verdana, Tahoma' size=1>$usercomments</p></font>";
		$message .= "<span class=style4><font face='Lucida Grande, Verdana, Tahoma' size=1><p>Copyright 2006, Dragonfly. All Rights Reserved. Patent Pending.<br />";
		$message .= "Questions? <a href=http://www.getdragonfly.com/support/receiving-emails.html>http://getdragonfly.com/support</a></p></span>";
		$message .= "</center>";
        
        // Mail function.
		mail($to, $subject, $message, $headers);

   // Thank your message.
      if($sname == null)
		  {
			$thankyou = 'Your message has been sent.';
		  }
		  else
         	  {
			$thankyou = 'Your message has been sent.';
			// Taken out // $thankyou = 'Thank you ' . $sname . ', your tour has been sent.';
		  }
   // end
?>
<center><img src="touremail_files/DF_site_editor-20.gif"></center><br>
<div align="center"><font color="0000000"><? print $thankyou;?></font><br><br>
<p align="center"><a href="javascript:self.close();"><font color="#0000CC">Close this window</font></a><font color="#0000CC"></a>
</font>
</div>
<?php
    }

if(!isset($_POST['send']) || $errmsg != '')
{
?>
<center><img src="touremail_files/DF_site_editor-20.gif"></center>
<div align="center" class="errmsg"><br><strong><font color="6D50FF"><?=$errmsg;?></font></strong></div><br>
<form  method="post" name="msgform" id="msgform">
<center>
    <table border="0" align="left" cellpadding="3">
  <tbody>
    <tr>
      <td colspan="2" nowrap >
	  <div align="center"><span class="style1">Send this media tour to a friend:</span></div><br></td></tr>
  <tr> 
    <td width="120" nowrap> <div align="right" class="style1">&nbsp;recipient's
        <strong>email</strong>:</div></td>
    <td width="185"><div align="left"><font color="#ffffff"> 
        <div class="style1"><input name="email" type="text" class="emailField2" id="email" size="30" value="<?=$email;?>">
        </font></div></td>
  </tr>
  <tr> 
    <td> <div align="left"><font color="#ffffff">&nbsp;</font></div></td>
    <td><div align="center"><font color="#ffffff">&nbsp;</font></div></td>
  </tr>
  <tr> 
    <td nowrap> <div align="left" class="style1">
      <div align="right">your <strong>name</strong>:</div>

    </div></td>
    <td><div align="left"><font color="#ffffff"> 
      <input name="sname" type="text" class="emailField2" id="sname" size="30" value="<?=$sname;?>">
    </font></div></td>
  </tr>
  <tr> 
    <td nowrap> <div align="left" class="style1">
      <div align="right">&nbsp;your <strong>email</strong>:</div>

    </div></td>
    <td><div align="left"><font color="#ffffff"> 
      <input name="email2" type="text" class="emailField2" id="email2" size="30" value="<?=$email2;?>">
    </font></div></td>
  </tr>  
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr> 
      <td colspan="2" align="center"><span class="style1">optional
          message</span></td>
  </tr>
    <tr> 
      <td colspan="2" align="center" valign="top"><textarea cols="27" name="comments" rows="3" wrap="physical" id="comments"><?=$comments;?></textarea></td>
  </tr>
  <tr> 
    <td colspan="2" align="center"><input name="send" type="submit" class="searchFieldTopnav2" id="send" value="send media tour" onclick="return checkForm();"></td>
  </tr>
</tbody></table></center>

</form></center>
<?php
}


?>
</div></td></tr>  </table></html>
