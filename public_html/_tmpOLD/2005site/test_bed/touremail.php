<?php      
		$tourid = $_REQUEST['tourID'];
		$siteurl = $_REQUEST['siteURL'];
		$siteid = $_REQUEST['siteID'];
		
		// Path for custom touremail.php file.
		$fileName3 = "/home/remagine/public_html/test_bed/touremail.html";
		
		// System defined default touremail page.
		$fileName1 = "touremail_default.php";

		$fileName2 = "touremail_defaultlimited.php";
		
		// Returns false if file is not found.
		$tmpDir = realpath($fileName3);

        // Object Tag for custom page.
		$fullForm = "<form  method='post' name='msgform' id='msgform'>
<center>
    <table border='0' align='left' cellpadding='3'>
  <tbody>
    <tr>
      <td colspan='2' nowrap >
	  <div align='center'><span class='style1'>Send this media tour to a friend:</span></div><br></td></tr>
  <tr> 
    <td width='120' nowrap> <div align='right' class='style1'>&nbsp;recipient's
        <strong>email</strong>:</div></td>
    <td width='185'><div align='left'><font color='#ffffff'> 
        <div class='style1'><input name='email' type='text' class='emailField2' id='email' size='30' value='" . $email . "'>
        </font></div></td>
  </tr>
  <tr> 
    <td> <div align='left'><font color='#ffffff'>&nbsp;</font></div></td>
    <td><div align='center'><font color='#ffffff'>&nbsp;</font></div></td>
  </tr>
  <tr> 
    <td nowrap> <div align='left' class='style1'>
      <div align='right'>your <strong>name</strong>:</div>

    </div></td>
    <td><div align='left'><font color='#ffffff'> 
      <input name='sname' type='text' class='emailField2' id='sname' size='30' value='" . $sname . "'>
    </font></div></td>
  </tr>
  <tr> 
    <td nowrap> <div align='left' class='style1'>
      <div align='right'>&nbsp;your <strong>email</strong>:</div>

    </div></td>
    <td><div align='left'><font color='#ffffff'> 
      <input name='email2' type='text' class='emailField2' id='email2' size='30' value='" . $email2 . "'>
    </font></div></td>
  </tr>  
  <tr>
    <td colspan='2' align='center'>&nbsp;</td>
  </tr>
  <tr> 
      <td colspan='2' align='center'><span class='style1'>optional
          message</span></td>
  </tr>
    <tr> 
      <td colspan='2' align='center' valign='top'><textarea cols='27' name='comments' rows='3' wrap='physical' id='comments'>" . $comments . "</textarea></td>
  </tr>
  <tr> 
    <td colspan='2' align='center'><input name='send' type='submit' class='searchFieldTopnav2' id='send' value='send media tour' onclick='return checkForm();'></td>
  </tr>
</tbody></table></center>

</form>"; // end

		// Varible for custom page object placement.
		$formtag = "<<TOUR_FORM>>";

		// Varible for custom page image placement.
		$tourinfo = "<<TOUR_INFO>>";

		$usercomments = stripslashes($comments);
		

		// Condition for using default or custom page.
      if($tmpDir == false){
                include $fileName1;
                    }
       elseif(is_file($fileName3)){
                    $dfOutput2 = "";
                    $file2 = fopen($fileName3, "r");
                          while(!feof($file2)){
                          // Reads file line by line into variable.
                          $dfOutput2 = $dfOutput2 . fgets($file2, 4096);
                    }
		fclose ($file2);
		
		// Replaces string '<<DRAGONFLY_OBJECT>>' with $Df and <<IMAGE>> with 
		// the custom image path $imagePath.
		$dfOutput2 = str_replace($formtag , $fullForm , $dfOutput2);
		 
	        echo $dfOutput2;
		} 

		// --------------------------------------------------------------------------
?>