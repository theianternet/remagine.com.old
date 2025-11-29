<?

function getFileTypeIcon($name)
{
	$ext = substr($name,strlen($name) - 3);
	switch ($ext)
	{
		case "xls":
			return "file.xls.gif";
			break;
		case "doc":
			return "file.doc.gif";
			break;
		case "pdf":
			return "file.pdf.gif";
			break;
		default:
			return "file.gif";
			break;
	}
}

function createThumbnailImage($tbServerFileName,$targetWidth,$targetHeight)
{
	$uploaddir = $GLOBALS["localUploadRoot"];
	$webdir = $GLOBALS["webUploadRoot"];
	$image_p = imagecreatetruecolor($targetWidth, $targetHeight);
	$image = imagecreatefromjpeg($uploaddir ."originals/". $tbServerFileName);
	imagefill($image_p, 0, 0, imagecolorallocate($image_p, 0, 0, 0));
	$size = getimagesize($uploaddir ."originals/". $tbServerFileName);
	$oldRatio = $size[0] / $size[1];
	$targetRatio = $targetWidth / $targetHeight;
	if ($oldRatio > $targetRatio)
	{
		$newWidth = $targetWidth + 1;
		$newHeight = ceil($targetWidth / $oldRatio) + 1;
	} else {
		$newHeight = $targetHeight + 1;
		$newWidth = ceil($targetHeight * $oldRatio) + 1;
	}
	imagecopyresampled($image_p, $image, ($targetWidth - $newWidth) / 2, ($targetHeight - $newHeight) / 2, 0, 0, $newWidth, $newHeight, $size[0], $size[1]);
	imagejpeg($image_p, $uploaddir . $targetWidth ."x". $targetHeight ."/". $tbServerFileName, 100);
	chmod($uploaddir . $targetWidth ."x". $targetHeight ."/". $tbServerFileName, 0666);
}

function drawTextLines($pdf,$lines,$x=0,$y=0,$lineHeight=0,$lineOffset=0)
{
	if (is_array($lines))
	{
		foreach ($lines AS $l)
		{
			$y += $lineHeight;
			$pdf->Text($x,$y,$l);
			$y += $lineOffset;
		}
	}
}

function parseXSL($XMLString,$XSLFile,$mode=NULL,$param=NULL)
{
	$XMLString = str_replace("&","&#38;",$XMLString);

	// Load the XML source
	$xml = new DOMDocument;
	$xml->loadXML("<?xml version=\"1.0\" encoding=\"UTF-8\"?>". $XMLString);

	$xsl = new DOMDocument;
	$xsl->load($GLOBALS["localXSLRoot"] . $XSLFile);

	// Configure the transformer
	$proc = new XSLTProcessor;
	$proc->setParameter("", "mode", $mode);
	if (is_array($param))
	{
		foreach ($param AS $p => $a)
		{
			$proc->setParameter("", $p, str_replace("\"","'",$a));
		}
	}
	$proc->importStyleSheet($xsl);

	return $proc->transformToXML($xml);
}

function queryStringValueReplace($key,$newValue,$queryString)
{
	parse_str($queryString, $arr);
	$arr[$key] = $newValue;
	return http_build_query($arr);
}

function formatDate($in="",$length="long")
{
	if ($in == "")
	{
//		$in = time();
		return false;
	}
	if (!is_numeric($in))
	{
		$in = strToTime($in);
	}
	if ($in != "")
	{
		if ($length == "short")
		{
			return date("n/j/Y",$in);
		} else {
			if (time() - $in < 3600) // less than one hour
			{
				$minutes = floor((time() - $in) / 60);
				$out .= $minutes ." minute";
				if ($minutes != 1)
				{
					$out .= "s";
				}
				$rem = fmod((time() - $in), 60);
				if ($rem > 0)
				{
					$out .= " and ". $rem ." seconds";
				}
				$out .= " ago";
			} elseif (time() - $in < 86400) // less than one day
			{
				$hours = floor((time() - $in) / 3600);
				$out .= $hours ." hour";
				if ($hours != 1)
				{
					$out .= "s";
				}
				$rem = fmod((time() - $in), 3600);
				if ($rem > 0)
				{
					$minutes = floor($rem / 60);
					$out .= " ". $minutes ." minute";
					if ($minutes != 1)
					{
						$out .= "s";
					}
					$seconds = fmod($rem, 60);
					if ($seconds > 0)
					{
						$out .= " and ". $seconds ." second";
						if ($seconds != 1)
						{
							$out .= "s";
						}
					}
				}
				$out .= " ago";
			} else {
				$out = str_replace(" ","&nbsp;",date("n/j/Y \a\\t h:i:s a T",$in));
			}
			return $out;
		}
	}
}

function getPageNavigation($search,$pages=6)
{
	$low = ($search->currentPage - ($pages / 2));
	$high = ($search->currentPage + ($pages / 2));
	if ($high > $search->resultsPageCount)
	{
		$low -= ($pages / 2) - ($search->resultsPageCount - $search->currentPage);
	}
	if ($low < 1)
	{
		$high += 1 - $low;
	}

	if ($search->currentPageStartResult > 1)
	{
		$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$search->currentPage-1,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'">&nbsp;&laquo;&nbsp;previous&nbsp;</a>&nbsp;';
	} else {
		$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	for ($i = 1; $i <= $search->resultsPageCount; $i++)
	{
		if ($search->currentPage == $i)
		{
			$class = "searchPageLinkSelected";
			$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$i,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'"><b>(&nbsp;'. $i .'&nbsp;)</b></a>&nbsp;';
		} else {
			if ($i >= $low && $i <= $high)
			{
				$class = "searchPageLinkNotSelected";
				$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$i,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'">&nbsp;'. $i .'&nbsp;</a>&nbsp;';
			}
		}
	}
	if ($search->currentPageEndResult < $search->totalResultsCount)
	{
		$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$search->currentPage+1,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'">&nbsp;next&nbsp;&raquo;&nbsp;</a>&nbsp;';
	} else {
		$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	return $out;
}

function getPageNavigationImages($search,$pages=6)
{
	$low = ($search->currentPage - ($pages / 2));
	$high = ($search->currentPage + ($pages / 2));
	if ($high > $search->resultsPageCount)
	{
		$low -= ($pages / 2) - ($search->resultsPageCount - $search->currentPage);
	}
	if ($low < 1)
	{
		$high += 1 - $low;
	}

	if ($search->currentPageStartResult > 1)
	{
		$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$search->currentPage-1,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'"><img src="img/numbers/previous.gif" style="vertical-align: bottom;" border="0" /></a>&nbsp;';
	} else {
		$out .= '<img src="img/spacer.gif" style="vertical-align: bottom;" width="56" height="19" border="0" />&nbsp;';
	}
	for ($i = 1; $i <= $search->resultsPageCount; $i++)
	{
		if ($search->currentPage == $i)
		{
			$class = "searchPageLinkSelected";
			$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$i,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'"><img src="img/numbers/on/'. $i .'.gif" border="0" style="vertical-align: bottom;" /></a>&nbsp;';
		} else {
			if ($i >= $low && $i <= $high)
			{
				$class = "searchPageLinkNotSelected";
				$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$i,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'"><img src="img/numbers/off/'. $i .'.gif" border="0" style="vertical-align: bottom;" /></a>&nbsp;';
			}
		}
	}
	if ($search->currentPageEndResult < $search->totalResultsCount)
	{
		$out .= '<a href="'. $_SERVER["PHP_SELF"] .'?'. queryStringValueReplace("currentPage",$search->currentPage+1,$_SERVER["QUERY_STRING"]) .'" class="'. $class .'"><img src="img/numbers/next.gif" style="vertical-align: bottom;" border="0" /></a>&nbsp;';
	} else {
		$out .= '<img src="img/spacer.gif" style="vertical-align: bottom;" width="34" height="19" border="0" />&nbsp;';
	}
	return $out;
}

function getPerPageForm()
{
	$out .= '<form action="'. $_SERVER["PHP_SELF"] .'" method="get" name="navigationForm3">';
	foreach ($_GET AS $k => $v)
	{
		if ($k != "resultsPerPage")
		{
			$out .= '<input type="hidden" name="'. $k .'" value="'. $v .'" />';
		}
	}
	$out .= '<select name="resultsPerPage" onChange="document.navigationForm3.submit();">';
	$out .= 	'<option value="'. $GLOBALS["perPageOptions"][0] .'">per page...</option>';
	if (is_array($GLOBALS["perPageOptions"]))
	{
		foreach ($GLOBALS["perPageOptions"] AS $p)
		{
			$out .= '<option value="'. $p .'">'. $p .' results</option>';
		}
	}
	$out .= '</select>';
	$out .= '</form>';
	return $out;
}

function formatColumnHeading($search,$name,$column)
{
	$newQueryString = queryStringValueReplace("currentPage",1,queryStringValueReplace("sortBy",$column,$_SERVER["QUERY_STRING"]));
	if ($_GET["sortBy"] == $column && $_GET["sortOrder"] == "desc")
	{
		$newQueryString = queryStringValueReplace("sortOrder","asc",$newQueryString);
	} else {
		$newQueryString = queryStringValueReplace("sortOrder","desc",$newQueryString);
	}
	$out = '<a href="'. $_SERVER["PHP_SELF"] .'?'. $newQueryString .'" class="islandHeadingA">'. $name .'</a>';
	if ($_GET["sortBy"] == $column)
	{
		if ($_GET["sortOrder"] == "desc")
		{
			$out .= '&nbsp;<a href="'. $_SERVER["PHP_SELF"] .'?'. $newQueryString .'"><img src="img/sortOrderDown.gif" border="0" /></a>';
		} else {
			$out .= '&nbsp;<a href="'. $_SERVER["PHP_SELF"] .'?'. $newQueryString .'"><img src="img/sortOrderUp.gif" border="0" /></a>';
		}
	}
	return $out;
}

function getSearchBar($search,$options="",$column="",$addToSearch="")
{
	if (is_array($options))
	{
		$out = '<table width="100%" cellspacing="0" cellpadding="0" border="0" class="toolbar">';
		$out .= '	<tr>';
		if (in_array("select",$options))
		{
			$out .= '		<td class="toolbarLeft">';
			$out .= '<form action="'. $_SERVER["PHP_SELF"] .'" method="get" name="navigationForm1">';
			foreach ($_GET AS $k => $v)
			{
				if ($k != $column)
				{
					$out .= '<input type="hidden" name="'. $k .'" value="'. $v .'" />';
				}
			}
			$out .= '	<select name="'. $column .'" onChange="document.navigationForm1.submit();">';
			$out .= '		<option value="">show only...</option>';
			if (is_array($search->reference->columns[$column]["options"]))
			{
				foreach ($search->reference->columns[$column]["options"] AS $k => $v)
				{
					$out .= '<option value="'. $k .'"';
					if ($_GET[$column] == $k && $_GET[$column] != "")
					{
						$out .= ' selected';
					}
					$out .= '>'. $v .'</option>';
				}
			}
			$out .= '		<option value="">show all</option>';
			$out .= '	</select>';
			$out .= '</form>';
			$out .= '		</td>';
		}
		if (in_array("html",$options))
		{
			$out .= '		<td class="toolbarLeft">';
			$out .= $column;
			$out .= '		</td>';
		}
		if (in_array("stringQuery",$options) || in_array("startDate",$options) || in_array("endDate",$options) || in_array("isActive",$options) || $addToSearch != "")
		{
			$out .= '		<td class="toolbarRight">';
			$out .= '			<form action="'. $_SERVER["PHP_SELF"] .'" method="get" id="searchForm" name="searchForm">';
			if (in_array("stringQuery",$options))
			{
				$out .= '				<label for="stringQuery" class="inside">search</label>';
				$out .= '				<input type="text" class="search" name="stringQuery" id="stringQuery" size="16" value="'. $_GET["stringQuery"] .'" tabindex="1" />';
			}
			if (in_array("startDate",$options))
			{
				$out .= '				<label for="startDate" class="inside">start date</label>';
				$out .= '				<input type="text" class="search" name="startDate" id="startDate" size="12" value="'. $_GET["startDate"] .'" tabindex="1" onClick="calendar.select(document.forms[\'searchForm\'].startDate,\'startDate\',\'MM/dd/yyyy\'); roundEm(); return false;" />';
			}
			if (in_array("endDate",$options))
			{
				$out .= '				<label for="endDate" class="inside">end date</label>';
				$out .= '				<input type="text" class="search" name="endDate" id="endDate" size="12" value="'. $_GET["endDate"] .'" tabindex="1" onClick="calendar.select(document.forms[\'searchForm\'].endDate,\'endDate\',\'MM/dd/yyyy\'); roundEm(); return false;" />';
			}
			if (in_array("isActive",$options) && is_array($search->reference->columns["isActive"]["options"]))
			{
				$out .= '				<select name="isActive">';
				$getValue = $_GET["isActive"];
				if ($getValue == "")
				{
					$getValue = $search->reference->columns["isActive"]["default"];
				}
				foreach ($search->reference->columns["isActive"]["options"] AS $k => $v)
				{
					$out .= '<option name="isActive" value="'. $k .'"';
					if ($getValue == $k)
					{
						$out .= ' selected="true" ';
					}
					$out .= '>'. $v .'</option>';
				}
				$out .= '				</select>';
			}
			$out .= $addToSearch;
			$out .= '				&nbsp;<input type="submit" name="sumbit" value="Go" />';
			$out .= '			</form>';
			$out .= '		</td>';
		}
		$out .= '	</tr>';
		$out .= '</table>';
	}
	if ($_GET["stringQuery"] != "" || $_GET["startDate"] != "" || $_GET["endDate"] != "" || $_GET[$column] != "" || $_GET["emailListId"])
	{
		$out .= getClearSearchBar($search);
	}
	return $out;
}

function getClearSearchBar($search)
{
	$out = '<table width="100%" cellspacing="0" cellpadding="0" border="0" class="toolbar">';
	$out .= '	<tr>';
	$out .= '		<td class="toolbarLeft">search ';
	if ($_GET["stringQuery"] != "")
	{
		$out .= 'for <b>'. $_GET["stringQuery"] .'</b>';
	}
	$out .= ' returned <b>'. $search->totalResultsCount .'</b> result';
	if ($search->totalResultsCount > 1)
	{
		$out .= "s";
	}
	$out .= '</td>';
	$out .= '		<td class="toolbarRight"><a href="'. $_SERVER["PHP_SELF"] .'" class="islandA">&raquo; clear search</a></td>';
	$out .= '	</tr>';
	$out .= '</table>';
	return $out;
}

function getResultsNavigation($search="")
{
	if ($search->totalResultsCount > 0)
	{
	$out .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" class="islandTable">';
//	$out .= 	'<tr>';
//	$out .= 		'<td style="height: 10px;"></td>';
//	$out .= 	'</tr>';
	$out .= 	'<tr>';
	$out .= 		'<td class="toolbarLeft" style="width: 180px;">displaying <b>'. $search->currentPageStartResult .'</b> to <b>'. $search->currentPageEndResult .'</b> of <b>'. $search->totalResultsCount .'</b></td>';
	$out .= 		'<td class="toolbarLeft" style="text-align: center;">';
	$out .= 			getPageNavigation($search,6);
	$out .= 		'</td>';
	$out .= 		'<td class="toolbarRight" align="right" style="width: 180px;">';
	$out .= 			getPerPageForm();
	$out .= 		'</td>';
	$out .= 	'</tr>';
	$out .= '</table>';
	}
	return $out;
}



// Calendar functions

function getDaysLinksForCalendar($events = array())
{
	$events[] = array("dateTimeScheduled" => "September 25, 2006");
	if ($events)
	{
		$days = array();
		foreach($events AS $e)
		{
			$days[date("j", strtotime($e["dateTimeScheduled"]))] = array("calendar.php?day=". date("j", strtotime($e["dateTimeScheduled"])) ."&month=". date("n", strtotime($e["dateTimeScheduled"])) ."&year=". date("Y", strtotime($e["dateTimeScheduled"])) ."&calendarEventId=". $e["calendarEventId"],"calendar-linked-day");
		}
		return $days;
	}
}

function getAllDaysLinksForSelectCalendar($month=0, $year=0, $add="")
{
	if (!$month)
	{
		$month = date("n");
	}
	if (!$year)
	{
		$year = date("Y");
	}
	$days = array();

	for ($i=1; $i <= date("t",mktime(0,0,0,$month,1,$year)); $i++)
	{
		if (mktime(0,0,0,$month,$i,$year) == mktime(0,0,0))
		{
			$days[$i] = array("javascript:void(0);","calendar-linked-today");
		} else {
			$days[$i] = array("javascript:void(0);","calendar-linked-day");
		}
	}

	return $days;
}

# PHP Calendar (version 2.3), written by Keith Devens
# http://keithdevens.com/software/php_calendar
#  see example at http://keithdevens.com/weblog
# License: http://keithdevens.com/software/license

function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array()){
	$first_of_month = gmmktime(0,0,0,$month,1,$year);
	#remember that mktime will automatically correct if invalid dates are entered
	# for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
	# this provides a built in "rounding" feature to generate_calendar()

	$day_names = array(); #generate all the day names according to the current locale
	for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
		$day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

	list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
	$weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day
	$title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

	#Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
	@list($p, $pl) = each($pn); @list($n, $nl) = each($pn); #previous and next links, if applicable
	if($p) $p = '<span class="calendar-prev">'.($pl ? '<a href="'.htmlspecialchars($pl).'">'.$p.'</a>' : $p).'</span>&nbsp;';
	if($n) $n = '&nbsp;<span class="calendar-next">'.($nl ? '<a href="'.htmlspecialchars($nl).'">'.$n.'</a>' : $n).'</span>';
	$calendar = '<table cellspacing="0" cellpadding="0" border="0" class="calendar">'."\n".
		'<caption class="calendar-month" style="text-align: center;">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'" class="calendar-month">'.$title.'</a>' : $title).$n."</caption>\n<tr><td class='calendarRowLeft'><img src='img/calendarRowLeft.gif' width='10' height='20' border='0' /></td>";

	if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
		#if day_name_length is >3, the full name of the day will be printed
		foreach($day_names as $d)
			$calendar .= '<th abbr="'.htmlentities($d).'">'.htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d).'</th>';
		$calendar .= "</tr>\n<tr>";
	}

	if($weekday > 0) $calendar .= '<td class="calendar-day" colspan="'.$weekday.'">&nbsp;</td>'; #initial 'empty' days
	for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
		if($weekday == 7){
			$weekday   = 0; #start a new week
			$calendar .= "<td class='calendarRowRight'><img src='img/calendarRowRight.gif' width='10' height='20' border='0' /></td></tr>\n<tr><td class='calendarRowLeft'><img src='img/calendarRowLeft.gif' width='10' height='20' border='0' /></td>";
		}
		if(isset($days[$day]) and is_array($days[$day])){
			@list($link, $classes, $content) = $days[$day];
			if(is_null($content))  $content  = $day;
			if (strpos($link,"javascript:") !== false)
			{
				$tdlink = str_replace("javascript:","",$link);
			} else {
				$tdlink = "window.location = '". $link ."';";
			}
			$calendar .= '<td'.($classes ? ' class="'.htmlspecialchars($classes).'" onclick="'. htmlspecialchars($tdlink) .'">' : '>').
				($link ? '<a href="'.htmlspecialchars($link).'" id="day'.$content.'" class="calendar-linked-day">'.$content.'</a>' : $content).'</td>';
		}
		else $calendar .= "<td class='calendar-day'>$day</td>";
	}
	if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'" class="calendar-day">&nbsp;</td>'; #remaining "empty" days

	return $calendar."<td class='calendarRowRight'><img src='img/calendarRowRight.gif' width='10' height='20' border='0' /></td></tr>\n</table>\n";
}

?>