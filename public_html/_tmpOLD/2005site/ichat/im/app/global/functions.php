<?

function get_url($base = true, $query = true){
	$URL = ''; //open return variable
	$URL .= (($_SERVER['HTTPS'] != '') ? "https://" : "http://"); //get protocol
	//$URL .= (($www == true && !preg_match("/^www\./", $_SERVER['HTTP_HOST'])) ? 'www.'.$_SERVER['HTTP_HOST'] : $_SERVER['HTTP_HOST']); //get host
	$URL .= $_SERVER['HTTP_HOST']; //get host
	$path = (($_SERVER['REQUEST_URI'] != '') ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']); //tell the function what path variable to use
	$URL .= ((pathinfo($path, PATHINFO_DIRNAME) != '/') ? pathinfo($path, PATHINFO_DIRNAME).'/' : pathinfo($path, PATHINFO_DIRNAME)); //set up directory
	$URL .= (($base == true) ? pathinfo($path, PATHINFO_BASENAME) : ""); //add basename
	$URL  = preg_replace("/\?".preg_quote($_SERVER['QUERY_STRING'])."/", "", $URL); //remove query string if found in url
	$URL .= (($query == true && $_SERVER['QUERY_STRING'] != '') ? "?".$_SERVER['QUERY_STRING'] : ""); //add query string
	return $URL;
}

function formatFileSize($filesize=0)
{
	if (trim($filesize) == "")
	{
		$filesize = 0;
	}
   $array = array(
       'YB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
       'ZB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
       'EB' => 1024 * 1024 * 1024 * 1024 * 1024 * 1024,
       'PB' => 1024 * 1024 * 1024 * 1024 * 1024,
       'TB' => 1024 * 1024 * 1024 * 1024,
       'GB' => 1024 * 1024 * 1024,
       'MB' => 1024 * 1024,
       'KB' => 1024,
   );
   if($filesize <= 1024)
   {
       $filesize = $filesize . ' Bytes';
   }
   foreach($array AS $name => $size)
   {
       if($filesize > $size || $filesize == $size)
       {
           $filesize = round((round($filesize / $size * 100) / 100), 2) ." ". $name;
       }
   }
   return $filesize;
}

function replaceCharacters($str)
{
	$str = str_replace(chr(194),"",$str);
	$str = str_replace(chr(226).chr(132).chr(162),chr(153),$str);
	$str = str_replace(chr(226).chr(150).chr(170),chr(149),$str);
	$str = str_replace(chr(195).chr(177),chr(241),$str);
	$str = str_replace(chr(195).chr(169),chr(233),$str);
	$str = str_replace(chr(226).chr(128).chr(162),chr(149),$str);
	$str = str_replace(chr(195).chr(145),chr(209),$str);
	return $str;
}

function isOdd($inputInt)
{
	$halfValue = $inputInt/2;
	$wholeTest = floor($halfValue);
	$test = $halfValue-$wholeTest;
	if($test>0) return true;
	else return false;
}

function __autoload($class_name)
{
	if (is_dir($GLOBALS["localClassRoot"]))
	{
		$dirs = scandir($GLOBALS["localClassRoot"]);
		foreach ($dirs AS $d)
		{
			if (is_dir($GLOBALS["localClassRoot"] . $d))
			{
				if (file_exists($GLOBALS["localClassRoot"] . $d ."/" . $class_name . ".class.php"))
				{
					require_once($GLOBALS["localClassRoot"] . $d ."/". $class_name . ".class.php");
					return true;
				}
			}
		}
	} else {
		require_once($GLOBALS["localClassRoot"] . $class_name . ".class.php");
	}
}

function databaseEscapeString($value)
{
	// Stripslashes
	if (get_magic_quotes_gpc())
	{
		$value = stripslashes($value);
	}
	// Quote if not integer
	if (!is_numeric($value))
	{
		databaseConnect();
		$value = mysql_real_escape_string($value, $GLOBALS["databaseConnectionPointer"]);
	}
	return $value;
}

function HTMLEscapeString($value)
{
	$value = str_replace("\"","&quot;",$value);
	return $value;
}

function databaseConnect()
{
	if (!$GLOBALS["databaseIsConnected"]){
		$databaseConnectionPointer = mysql_connect($GLOBALS["databaseAddress"], $GLOBALS["databaseUsername"], $GLOBALS["databasePassword"]) or die('database connection failed');
		mysql_select_db($GLOBALS["databaseName"]) or die('database selection failed');
		$GLOBALS["databaseConnectionPointer"] = $databaseConnectionPointer;
		$GLOBALS["databaseIsConnected"] = true;
	}
}

function databaseQuery($query)
{
	databaseConnect();
	$result = mysql_query($query);
	if (mysql_errno() == "1146")
	{
		return mysql_errno();
	}
	if (mysql_errno() && $GLOBALS["databaseShowErrors"])
	{
		// disable when live
		if (mysql_errno() != "1146")
		{
			echo "database error ". mysql_errno() .": ". mysql_error() .": ". $query;
		}
		return mysql_errno();
	}
	$GLOBALS["databaseQueryCount"]++;
	return $result;
}

function formatdollars($v,$option=""){
	if (strpos($v,".") === 0)
	{
		$v = "0". $v;
	}
	if (ereg("-",$v,$regs)){
		$negative = true;
	}
	if (ereg("([0-9]{1,9})\.([0-9]{2})",$v,$regs)){
		$w = $regs[1] .".". $regs[2];
	} elseif (ereg("([0-9]{1,9})\.([0-9]{1})",$v,$regs)){
		$w = $regs[1] .".". $regs[2] ."0";
	} elseif (ereg("([0-9]{1,9})",$v,$regs)){
		$w = $regs[1] .".00";
	} else {
		$w = "0.00";
	}
	if ($negative){
		$w = "-". $w;
	}
	if ($option == "noLeadingZero")
	{
		if (strpos($w,"0.") === 0)
		{
			$w = str_replace("0.",".",$w);
		}
	}
	return $w;
}

function limitCharacters($limit,$str,$middle=false)
{
	if (strlen($str) > $limit)
	{
		if ($middle)
		{
			$str = substr($str,0,($limit / 2) - 2) ."...". substr($str,strlen($str) - (($limit / 2) - 2));
		} else {
			$str = substr($str,0,$limit - 2) ."...";
		}
	}
	return $str;
}

function formatDateForDatabase($in="")
{
	if ($in == "")
	{
		$in = time();
	}
	if (!is_numeric($in))
	{
		$in = strToTime($in);
	}
	return date("Y-m-d H:i:s",$in);
}

function print_pre($var)
{
	echo '<pre style="font-size: 10px; color: #000000; text-align: left;">';
	print_r($var);
	echo '</pre>';
}

?>