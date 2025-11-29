<br>
<table width="532" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
                    <tr>
                      <td width="532" height="300" bgcolor="#FFFFFF">
<script language="JavaScript">
function checkForm()
{
    var cname, cemail, ccompany, csupport, cphone, csubject, cmessage;
    with(window.document.msgform)
    {
        cname    = sname;
		csupport = ssupport;
        cemail   = email;
		ccompany = scompany;
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
        alert('Email address is not valid');
        cemail.focus();
        return false;
    }
	else if(trim(ccompany.value) == '')
    {
        alert('Please enter your company');
        ccompany.focus();
        return false;
    }
    else if(trim(csubject.value) == '')
    {
        alert('Please enter message subject');
        csubject.focus();
        return false;
    }
    else if(trim(cmessage.value) == '')
    {
        alert('Please enter your message');
        cmessage.focus();
        return false;
    }
    else
    {
        cname.value    = trim(cname.value);
        cemail.value   = trim(cemail.value);
		ccompany.value = trim(ccompany.value);
        csubject.value = trim(csubject.value);
		csupport.value = trim(cssupport.value);
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
$scompany = ''; // severs company
$sspport = ''; // support message
$subject = ''; // message subject
$message = ''; // the message itself

if(isset($_POST['send']))
{
    $sname   = $_POST['sname'];
    $email   = $_POST['email'];
	$scompany = $_POST['scompany'];
	$ssupport = $_POST['sspport'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    if(trim($sname) == '')
    {
        $errmsg = 'Please enter your name';
    } 
    else if(trim($email) == '')
    {
        $errmsg = 'Please enter your email address';
    }
    else if(!isEmail($email))
    {
        $errmsg = 'Your email address is not valid';
    }
    else if(trim($message) == '')
    {
        $errmsg = 'Please enter your message';
    }
    
    if($errmsg == '')
    {
        if(get_magic_quotes_gpc())
        {
            $subject = stripslashes($subject);
            $message = stripslashes($message);
        }    
        
        // the email will be sent here
        $to      = "ian@remagine.net";
        
        // the email subject ( modify it as you wish )
        $subject = 'REMAGINE <<SUPPORT>> Question';
        
        // the mail message ( add any additional information if you want )
        $msg = "A user has sent a support message from: " . $_SERVER['HTTP_HOST'];
		$msg .= "\r\n-----------------------------------------------------------------";	
		$msg .= "\r\nName : $sname \r\n";
		$msg .= "\r\nCompany: $scompany \r\n";
		$msg .= "\r\nSupport topic: $ssupport \r\n";
		$msg .= "\r\nMessage: \r\n\r\n" . $message;
		$msg .= "\r\n-----------------------------------------------------------------";
		$msg .= "\r\n" . date("Y") . " REMAGINE - Comprehensive Business Solution";
        
        mail($to, $subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");
?>
<center>
<div align="center">Your message has been sent.<br><br>
</div>
<strong>Your support question will be responded to within 24 hours. For immediate support, please contact:</strong><br>
            <br>
Technical support:<br>
<br>
 <a href="mailto:support@remagine.net">support@remagine.net</a> <strong><br>
(518) 755-4436 </strong><br>
<br>
<?php
    }
}

if(!isset($_POST['send']) || $errmsg != '')
{
?>
<div align="center" class="errmsg"><?=$errmsg;?></div>
  <form  method="post" name="msgform" id="msgform"><center>
  <table width="500" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" class="maincell">

    <tr bgcolor="#FFFFFF">
      <td height="26" colspan="2" valign="top" bgcolor="#FFFFFF"> 
	  <center><table width="532" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E4E3E0">
        <!--DWLayoutTable-->
        <tr bgcolor="#265E8A">
          <td height="10" colspan="4" align="left" valign="top"><strong>&nbsp;&nbsp;<span class="smallheaders">Network Status</span></strong>        
        </tr>
        <tr>
          <td height="11" colspan="4" valign="top">         
        </tr>
        <tr>
          <td width="8"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td width="177" align="left">mars.remagine.net</td>
          <td width="221" align="left">Server &gt;&gt;  <strong>online</strong> &lt;&lt; Location</td>
          <td width="126" align="left"><strong>New York City, NY </strong></td>
        </tr>
        <tr>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="left">deimos.remagine.net</td>
          <td align="left">Server &gt;&gt; <strong>online</strong> &lt;&lt; Location</td>
          <td align="left"><strong>Springfield, MA </strong></td>
        </tr>
        <tr>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td align="left">phobos.remagine.net</td>
          <td align="left">Server &gt;&gt; <strong>online</strong> &lt;&lt; Location</td>
          <td align="left"><strong>Springfield, MA </strong></td>
        </tr>
        <tr>
          <td colspan="2"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
        </tr>
      </table>
	  </center>
	  <br>
	  <br>
	         <hr size="1" color="E4E3DF">    
      <p align="left">Use the form below to submit a support issue to <strong>REMAGINE</strong>. If your topic is not listed, choose &quot;Other&quot; and leave a detailed message. <br>
        <br>
      </p></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="88" align="left"> Name:</td>
      <td width="416" align="left"><input name="sname" type="text" class="sp2_field" id="sname" size="30" value="<?=$sname;?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td align="left">Company:</td>
      <td align="left"><input name="scompany" type="text" class="sp2_field" id="scompany" size="30" value="<?=$scompany;?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left">Email:</td>
      <td align="left"><input name="email" type="text" class="sp2_field" id="email" size="30" value="<?=$email;?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left">Support issue: </td>
      <td align="left"><select name="ssupport" id="ssupport" class="sp3_field">
        <option value="Web Site Related">Web Site Related</option>
        <option value="Domain Name">Domain Name</option>
        <option value="Hosting">Hosting</option>
        <option value="Billing">Billing</option>
        <option value="Marketing">Marketing</option>
        <option value="IT Consulting">IT Consulting</option>
        <option value="Software">Software</option>
        <option value="Graphics">Graphics</option>
        <option value="Other">Other</option>
      </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td valign="top" align="left">Message:</td>
      <td align="left"><textarea name="message" cols="55" rows="10" wrap="OFF" class="sp2_field" id="message"><?=$message;?></textarea></td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF"> 
      <td colspan="2"><input name="send" type="submit" class="bluebox" id="send" value="Send Message" onclick="return checkForm();"></td>
    </tr>
  </table>
</form></center>
<?php
}

function isEmail($email)
{
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
            ,$email));
}
?>
</div></td></tr>  </table>
