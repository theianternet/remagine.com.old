
<table width="552" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="271"><div align="justify">
          <center>
            <p align="left">For General inquiries: <a href="mailto:info@remagine.com">info@remagine.com</a></p>
            <p align="left">For Technical support: <a href="mailto:support@remagine.com">support@remagine.com</a></p>
            <p align="left">For Customer service: <a href="mailto:service@remagine.com">service@remagine.com</a></p>
            <p align="left"><b>To reach us via phone:</b><br><br>
    <b>(877) 307-8383</b> (General Inquiries)<br>
    <b>(877) 307-8383 ext 2</b> (Sales)<br>
    <b>(877) 307-8383 ext 3</b> (Technical Support)<br>
    <b>(877) 307-8383 ext 4</b> (Customer Service)
    <br><b>(801) 752-4655</b> (Fax)</p>
            <p align="left"><b>Mailing address:</b><br/><br/>
              <strong>REMAGINE</strong><br>
    P.O. Box 3067 <br>
    Amherst, MA 01004</font><br>
            </p>
          </center>
  </div></td>
        <td width="10">&nbsp;</td>
        <td width="271" valign="top"><div align="justify"><img src="images/springfield.jpg" width="271" height="200"><br>
        </div></td>
      </tr>
</table>
        <hr size="1" color="E4E3DF">
        <table width="532" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
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
    with(window.document.msgform)
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

if(isset($_POST['send']))
{
    $sname   = $_POST['sname'];
    $email   = $_POST['email'];
	$sphone = $_POST['sphone'];
 	$scompany = $_POST['scompany'];
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
        $to      = "ian@remagine.com";
        
        // the email subject ( modify it as you wish )
        $subject = 'REMAGINE <<CONTACT>> Question';
        
        // the mail message ( add any additional information if you want )
        $msg = "A user has sent a contact message from: " . $_SERVER['HTTP_HOST'];
		$msg .= "\r\n-----------------------------------------------------------------";	
		$msg .= "\r\nName : $sname \r\n";
		$msg .= "\r\nCompany: $scompany \r\n";
		$msg .= "\r\nPhone: $sphone \r\n";
		$msg .= "\r\nMessage: \r\n\r\n" . $message;
		$msg .= "\r\n-----------------------------------------------------------------";
		$msg .= "\r\n" . date("Y") . " REMAGINE - Comprehensive Business Solution";
        
        mail($to, $subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");
?>
<center>
<br>
Your message has been sent.<br>

<strong>Your submission will be responded to within 24 hours. For immediate contact, please contact:</strong><br>
            <br>
 <a href="mailto:support@remagine.net">info@remagine.com</a> <strong><br>
(413) 642-0130 </strong><br>
<br>
<?php
    }
}

if(!isset($_POST['send']) || $errmsg != '')
{
?>
<div align="center" class="errmsg"><?=$errmsg;?></div>
  <form  method="post" name="msgform" id="msgform"><center>
  <table width="559" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" class="maincell">
    <tr bgcolor="#FFFFFF">
      <td height="26" colspan="2" valign="top" align="left"> 
	        Use the form below to contact <strong>REMAGINE</strong> from the web. <br>
        <br>
      </td>
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
      <td align="left">Phone: </td>
      <td align="left"><input name="sphone" type="text" class="sp2_field" id="email" size="30" value="<?=$sphone;?>"></td>
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
