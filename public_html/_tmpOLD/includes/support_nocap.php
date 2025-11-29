<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p align="justify">
<img src="images/04support.gif" />
    </td>
  </tr>
</table>        
<br />        
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
                    <tr>
                      <td width="532" bgcolor="#FFFFFF">
<style type="text/css">

.bluebox {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    font-weight: bolder;
    color: #FFFFFF;
    background-color: #255E8B;
    border: 1px solid #000000;
}	
.errmsg {
    font-family: "Courier New", Courier, mono;
    font-size: 12px;
    font-weight: bolder;
    color: #CC0000;
}

</style>
<script language="JavaScript">
function checkForm()
{
    var cname, cemail, ccompany, csupport, cphone, csubject, cmessage;
    if(window.document.msgform == null) return false;
    with(document.getElementById("msgform"))
    {
        cname    = sname;
		csupport = ssupport;
        cemail   = email;
		ccompany = scompany;
		cphone = sphone;
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
		cphone.value = trim(cphone.value);
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
$email   = ''; // sender's email address
$sphone  = ''; // sender's phone
$scompany = ''; // severs company
$ssupport = ''; // support message
$subject = ''; // message subject
$message = ''; // the message itself
$reason = ''; // the reason why

if(isset($_POST['send']))
{
    $sname   = $_POST['sname'];
    $email   = $_POST['email'];
	$sphone = $_POST['sphone'];
 	$scompany = $_POST['scompany'];
    $message = $_POST['message'];
    $reason = $_POST['reason'];    

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
        $to      = "info@remagine.com";
        
        // the email subject ( modify it as you wish )
        $subject = 'REMAGINE web support question ' . date("m-j-Y G:i:s ");
        
        // the mail message ( add any additional information if you want )
        $msg = "A user has sent a contact message from the support form on: " . $_SERVER['HTTP_HOST'];
		$msg .= "\r\n--------------------------------------------------------------------------------------------------------------------";	
		$msg .= "\r\nName : $sname \r\n";
		$msg .= "\r\nCompany: $scompany \r\n";
		$msg .= "\r\nPhone: $sphone \r\n";
		$msg .= "\r\nEmail: $email \r\n";
		$msg .= "\r\nReason: $reason \r\n";
		$msg .= "\r\nMessage: \r\n\r\n" . $message;
		$msg .= "\r\n--------------------------------------------------------------------------------------------------------------------";
		$msg .= "\r\n" . date("Y") . " REMAGINE | Comprehensive Business Solution";
        
        mail($to, $subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");
?>
<div align="left" class="body_text">
<br />
Your message has been sent.<br>

<strong>Your submission will be responded to within 24 hours. For immediate contact, please contact:</strong><br>
            <br>
 <a href="mailto:support@remagine.net">info@remagine.com</a> <strong><br>
888.571.0050 </strong><br>
<br />
<?php
    }
}

if(!isset($_POST['send']) || $errmsg != '')
{
?>
<div align="center" class="errmsg"><?=$errmsg;?></div>
  <form  method="post" name="msgform" id="msgform"><center>
  <table width="600" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" class="maincell">
    <tr bgcolor="#FFFFFF">
      <td height="26" colspan="2" valign="top" align="left"> 
	        <div class="body_text">Use the form below to contact <strong>REMAGINE</strong> from the web. This form can be used for: free quotes, general inquiries, or support questions. Free quotes can also be received by calling us toll free at 1.888.571.0050  <br>
        <br>
      <div class="body_text"><font color="#cc0000">*</font> indicates a required field</div><br/>
	</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="88" align="left"><div class="body_text">Name: <font color="#cc0000">*</font></div></td>
      <td width="416" align="left"><input name="sname" type="text" class="sp2_field" id="sname" size="30" value="<?=$sname;?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td align="left"><div class="body_text">Company:</div></td>
      <td align="left"><input name="scompany" type="text" class="sp2_field" id="scompany" size="30" value="<?=$scompany;?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left"><div class="body_text">Email: <font color="#cc0000">*</font></div></td>
      <td align="left"><input name="email" type="text" class="sp2_field" id="email" size="30" value="<?=$email;?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left"><div class="body_text">Phone:</div></td>
      <td align="left"><input name="sphone" type="text" class="sp2_field" id="email" size="30" value="<?=$sphone;?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="left"><div class="body_text">Reason: </div></td>
      <td align="left">
    <select name="reason" id="reason" class="body_text">
    <option value="Web Hosting Quote">Web Hosting Quote</option>
    <option value="Marketing Services Quote">Marketing Services Quote</option>
    <option value="Telecommunications Quote" selected="selected">Telecommunications Quote</option>
    <option value="Data Managment Quote">Data Managment Quote</option>
    <option value="General Support Question">General Support Question</option>
    <option value="Web Design Quote">Web Deisgn Quote</option>
    <option value="Software Development">Software Development</option>
    <option value="Co-Location Quote">Co-Location Quote</option>
    <option value="Network Design">Network Design</option>
    <option value="Other">Other</option>
    </select>
    </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td valign="top" align="left"><div class="body_text">Message: <font color="#cc0000">*</font></div></td>
      <td align="left"><textarea name="message" cols="55" rows="10" wrap="OFF" class="sp2_field" id="message"><?=$message;?></textarea></td>
    </tr>
    <tr align="center" bgcolor="#FFFFFF"> 
      <td colspan="2">      <input name="send" type="hidden" value="Send Message">
      <!--<input name="send_button" type="image" src="http://www.remagine.com/images/remagine_sendMessage.gif" id="send"  ><br>
      --><input type="image" src="http://www.remagine.com/images/remagine_sendMessage.gif"></td>
    </tr>
  </table></div>
</form></div>
<?php
}

function isEmail($email)
{
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
            ,$email));
}
?>
</div></td></tr>  </table>
