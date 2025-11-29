<?
require("../global/global.php");
$GLOBALS["whitespace"] = array(" ","\t","\n","\"","'",';',',','(',')','{','}',':','=','<','>','[',']','!');
?>

<html>
	<head>
		<title>Documentation</title>
		<style>
			body
			{
				font-family: Arial;
				font-size: 10pt;
				color: #333333;
				padding: 10px;
			}
			h2, h3, h4
			{
				margin: 0px;
				line-spacing: 0px;
			}
			h4
			{
				font-weight: normal;
			}
			h5
			{
				background-color: #96A5D5;
				padding: 10px;
			}
			h5, .h5
			{
				color: white;
			}
			hr
			{
				border: 0px;
				height: 2px;
				color: #333333;
				background-color: #333333;
				color: #96A5D5;
				background-color: #96A5D5;
			}
			ul
			{
				margin: 0px;
			}
			li
			{
				margin-top: 0px;
			}
			table
			{
				border: 0px;
				width: 100%;
				font-size: 10pt;
 			}
			th
			{
				background-color: #555555;
				color: #FFFFFF;
				text-align: left;
				padding: 3px;
				margin: 0px;
				width: 80px;
			}
			td
			{
				background-color: #EEEEEE;
				padding: 3px;
				margin: 0px;
			}
			pre
			{
				margin: 0px;
				background-color: #EEEEEE;
				background-color: #EDF3FE;
				padding: 8px;
				font-size: 9pt;
				overflow: auto;
			}
			.directory
			{
//				display: inline;
//				width: auto;
//				height: auto;
				padding: 10px;
				margin-right: 10px;
				margin-bottom: 10px;
				background-color: #EEEEEE;
				position: relative;
				float: left;
			}
		</style>
		<?= syntaxColourLib_getStyles("php"); ?>
		<script language="JavaScript">
			function toggle(id)
			{
				if (document.getElementById(id).style.display == "inline")
				{
					document.getElementById(id).style.display = 'none';
				} else {
					document.getElementById(id).style.display = 'inline';
				}
			}
		</script>
	</head>
	<body>

		<h5><a href="<?= $_SERVER["PHP_SELF"] ?>" class="h5"><b>Developer Documentation</b></a> for <a href="<?= $GLOBALS["webRoot"] ?>" class="h5"><?= $GLOBALS["webRoot"] ?></a></h5>

<?
		if ($_GET["class"] != "")
		{
			$class = new $_GET["class"];
?>
			<h1><?= $_GET["class"] ?></h1>
<?
			echo "<h4>";
			echo "Inherits from";
			$parents = class_parents($class);
			if (count($parents) > 0)
			{
				foreach ($parents AS $p)
				{
					echo " : <b><a href='". $_SERVER["PHP_SELF"] ."?class=". $p ."'>". $p ."</a></b>";
				}
			} else {
				echo " : none";
			}
			echo "</h4><br>";

			$classPath = getClassPath($_GET["class"]);
			$url = $GLOBALS["webRoot"] . str_replace($GLOBALS["localRoot"], "", $classPath);
			echo "<h4>web path to file: <b>". $url ."</b></h4>";
			echo "<h4>local path to file: <b>". $classPath ."</b></h4>";

			$contents = file_get_contents($classPath);
			$start = strpos($contents,"/*");
			$end = strpos($contents,"*/");
			$length = $end - $start + 2;
			if ($start > 0)
			{
				$notes = substr($contents, $start, $length);
			}
			if ($notes != "")
			{
				echo "<br>";
				echo "<h3>Notes</h3>";
				echo "<br>";
				echo "<pre>";
				echo $notes;
				echo "</pre>";
			}


			echo "<br>";
			echo "<h3>Parameters</h3>";
			echo "<br>";
			echo "<ul>";
			foreach (get_object_vars($class) AS $k => $v)
			{
				if ($v != "" || $v === 0)
				{
					$v = " = ". $v;
				}
				echo "<li>". $k ."<b>". $v ."</b></li>";
			}
			echo "</ul>";

			echo "<br>";
			echo "<h3>Methods</h3>";
			echo "<br>";
			echo "<ul>";
			foreach (get_this_class_methods($class) AS $m)
			{
				$start = strpos($contents, "function ". $m);
				$end = strpos($contents, ")",$start);
				$arguments = "";
				if ($start > 0)
				{
					$arguments = syntaxColourLib_colourize(substr($contents, $start + strlen("function ". $m), $end - $start - strlen("function ". $m) + 1),"php");
				}
				if ($arguments == "()")
				{
					$arguments = "( )";
				}

				$start = strpos($contents, "function ". $m);
				$end = strpos($contents, "\n	}",$start);
				$code = "";
				if ($start > 0)
				{
					$code = substr($contents, $start, $end - $start + 3);
				}
				$code = str_replace("\n	","\n",$code);
				$code = str_replace("	","   ",$code);
				$code = "<div id='". $m ."' style='display: none;'><pre tab-width='3'>". syntaxColourLib_colourize($code,"php") ."</pre></div>";

				echo "<li><a href=\"javascript:toggle('". $m ."')\"><b>". $m ."</b></a> <i>". $arguments ."</i>". $code ."</li>";
			}
			echo "</ul>";

			if (is_array($class->columns))
			{
				echo "<br><br>";
				echo "<h3>Properties</h3>";
				echo "<br>";
				echo "<table>";
				echo "<tr>";
				echo 	"<th>name</th>";
				echo 	"<th>type</th>";
				echo 	"<th>length</th>";
				echo 	"<th>default</th>";
				echo 	"<th>options</th>";
				echo "</tr>";
				foreach ($class->columns AS $m)
				{
					echo "<tr>";
					echo 	"<td>". $m["name"] ."</td>";
					echo 	"<td>". $m["type"] ."</td>";
					echo 	"<td>". $m["length"] ."</td>";
					echo 	"<td>". $m["default"] ."</td>";
					echo 	"<td>";
					if (is_array($m["options"]))
					{
						$out = "";
						foreach ($m["options"] AS $k => $v)
						{
							if ($out != "")
							{
								$out .= ", ";
							}
							$out .= $k ."=". $v;
						}
						echo $out;
					}
					echo 	"</td>";
					echo "</tr>";
				}
				echo "</table>";
			}

			if (is_array($class->relationships))
			{
				echo "<br><br>";
				echo "<h3>Relationships</h3>";
				echo "<br>";
				echo "<table>";
				echo "<tr>";
				echo 	"<th>column</th>";
				echo 	"<th>class</th>";
				echo "</tr>";
				foreach ($class->relationships AS $k => $v)
				{
					echo "<tr>";
					echo 	"<td>". $k ."</td>";
					echo 	"<td><a href='". $_SERVER["PHP_SELF"] ."?class=". $v ."'>". $v ."</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			}

			if (is_array($class->conditions))
			{
				echo "<br><br>";
				echo "<h3>Search Conditions</h3>";
				echo "<br>";
				echo "<table>";
				echo "<tr>";
				echo 	"<th>name</th>";
				echo 	"<th>type</th>";
				echo 	"<th>columns</th>";
				echo 	"<th>operator</th>";
				echo "</tr>";
				foreach ($class->conditions AS $m)
				{
					echo "<tr>";
					echo 	"<td>". $m["name"] ."</td>";
					echo 	"<td>". $m["type"] ."</td>";
					echo 	"<td>";
					if (is_array($m["columns"]))
					{
						$out = "";
						foreach ($m["columns"] AS $c)
						{
							if ($out != "")
							{
								$out .= ", ";
							}
							$out .= $c;
						}
						echo $out;
					}
					echo 	"</td>";
					echo 	"<td>". $m["operator"] ."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}

			echo "<br><br>";
			echo "<h3>Source</h3>";
			echo "<br>";
			echo "<div id='contents' style='display: inline;'><pre>";
			echo syntaxColourLib_colourize($contents,"php");
			echo "</pre></div>";

		} elseif ($_GET["phpinfo"]) {
			echo phpinfo();
		} else {
			$configuration = file_get_contents($GLOBALS["localRoot"] ."config.php");
			echo "<h1>". $GLOBALS["webRoot"] ."</h1>";
			$start = strpos($configuration,"/*");
			$end = strpos($configuration,"*/");
			$length = $end - $start + 2;
			if ($start > 0)
			{
//				echo "<br><h2><a href=\"javascript:toggle('notes')\">Notes</a></h2>";
//				echo "<br><h2>Notes</h2>";
				echo "<div id='notes' style='display: inline;'>";
				echo "<pre>";
				echo substr($configuration, $start, $length);
				echo "</pre>";
				echo "</div>";
				echo "<br>";
			}
			echo "<h2><a href=\"javascript:toggle('objects')\">Objects</a></h2>";
			echo "<div id='objects' style='display: none; width: 100%;'>";
/*
			foreach (getList($GLOBALS["localClassRoot"]) AS $v)
			{
				echo "<div class='directory'>";
				echo "<b>". $v["name"] ."</b>";
				foreach ($v["sub"] AS $s)
				{
					echo "<br><a href=''>". $s["name"] ."</a>";
				}
				echo "</div>";
			}
*/
			echo getListHTML(getList($GLOBALS["localClassRoot"]));
			echo "</div>";
			echo "<br><h2><a href=\"javascript:toggle('functions')\">Functions</a></h2>";
			$contents = file_get_contents($GLOBALS["localGlobalRoot"] ."functions.php");
			$functions = preg_match_all("/(function )(.*)(\()/", $contents, $matches);
			echo "<div id='functions' style='display: none;'>";
			echo "<ul>";
			foreach ($matches[2] AS $m)
			{
				$start = strpos($contents, "function ". $m);
				$end = strpos($contents, ")",$start);
				$arguments = "";
				if ($start > 0)
				{
					$arguments = syntaxColourLib_colourize(substr($contents, $start + strlen("function ". $m), $end - $start - strlen("function ". $m) + 1),"php");
				}
				if ($arguments == "()")
				{
					$arguments = "( )";
				}

				$start = strpos($contents, "function ". $m);
				$end = strpos($contents, "\n}",$start);
				$code = "";
				if ($start > 0)
				{
					$code = substr($contents, $start, $end - $start + 3);
				}
				$code = str_replace("	","   ",$code);
				$code = "<div id='". $m ."' style='display: none;'><pre tab-width='3'>". syntaxColourLib_colourize($code,"php") ."</pre></div>";

				echo "<li><a href=\"javascript:toggle('". $m ."')\"><b>". $m ."</b></a> <i>". $arguments ."</i>". $code ."</li>";
			}
			echo "</ul>";
			echo "</div>";
			echo "<br><h2><a href=\"javascript:toggle('configuration')\">Configuration</a></h2>";
			echo "<div id='configuration' style='display: none;'><pre>";
			echo syntaxColourLib_colourize($configuration,"php");
			echo "</pre></div>";
			echo "<br><h2><a href=\"javascript:toggle('server')\">Server</a></h2>";
			echo "<div id='server' style='display: none;'><pre>";
			echo "Operating System: ". php_uname("s");
			echo "\nVersion: ". php_uname("v");
			echo "\nMachine Type: ". php_uname("m");
			echo "\nHost Name: ". php_uname("n");
			echo "\n\n<a href='". $_SERVER["PHP_SELF"] ."?phpinfo=1'>PHP version: " . phpversion() ."</a>";
			echo "\n\n<a href=\"javascript:toggle('extensions')\">PHP Extensions</a>";
			echo "<div id='extensions' style='display: none;'>";
			print_pre(get_loaded_extensions());
			echo "</div>";
			echo "</pre></div>";
		}
?>

	</body>
</html>


<?

function getList($root)
{
	$tree = array();
	$dirs = scandir($root);
	foreach ($dirs AS $d)
	{
		if ($d != "." && $d != ".." && strpos($d,".") !== 0)
		{
			$thisTree["name"] = $d;
			if (is_dir($GLOBALS["localClassRoot"] . $d))
			{
				$thisTree["sub"] = getList($GLOBALS["localClassRoot"] . $d);
			}
			if (is_dir($GLOBALS["localClassRoot"] . $d) || strpos($d,"class") !== false)
			{
				$tree[] = $thisTree;
			}
		}
	}
	return $tree;
}

function getListHTML($tree)
{
	if (is_array($tree))
	{
		$out .= "<ul>";
		foreach ($tree AS $t)
		{
			if ($t["name"] != "")
			{
				$out .= "<li>";
				if (strpos($t["name"],"class") !== false)
				{
					$name = str_replace(".class.php","",basename($t["name"]));
					$out .= "<a href='". $_SERVER["PHP_SELF"] ."?class=". $name ."'>". $name ."</a>";
				} else {
					$out .= "<b>". $t["name"] ."</b>";
				}
				$out .= getListHTML($t["sub"]);
				$out .= "</li>";
			}
		}
		$out .= "</ul>";
	}
	return $out;
}

function get_this_class_methods($class){
   $array1 = get_class_methods($class);
   if($parent_class = get_parent_class($class)){
       $array2 = get_class_methods($parent_class);
       $array3 = array_diff($array1, $array2);
   }else{
       $array3 = $array1;
   }
   return($array3);
}

function getClassPath($class_name)
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
					return $GLOBALS["localClassRoot"] . $d ."/". $class_name . ".class.php";
				}
			}
		}
	}
	return false;
}


	function syntaxColourLib_colourize( $i_src, $i_language, $i_extraProps=array() )
	{
		switch (strtolower($i_language)) {
			case "c++":
			case "c":
				$html = _syntaxColourLib_colourize_cpp($i_src,$i_extraProps);
				break;

			case "php":
				$html = _syntaxColourLib_colourize_php($i_src,$i_extraProps);
				break;

			case "bash":
			case "shell":
				$html = _syntaxColourLib_colourize_shell($i_src,$i_extraProps);
				break;

			case "text":
			default:
				$html = _syntaxColourLib_colourize_text($i_src,$i_extraProps);
		}

		return $html;
	}

	function syntaxColourLib_getStyles($i_language)
	{
		switch ($i_language) {
			case "c++":
			case "c":
				return	"<style type=\"text/css\">\n".
						"\t.scl_source_frame { text-indent:0px; padding:5px; background-color:#fff6de; color:black; font-size:12px; }\n".
						"\t.scl_cpp_keyword { color:#006500; }\n".
						"\t.scl_cpp_type { color:#0099ff; }\n".
						"\t.scl_cpp_comment { color:#838183; }\n".
						"\t.scl_cpp_string { color:#b28808; }\n".
						"\t.scl_cpp_number { color:#0000ff; }\n".
						"\t.scl_cpp_lineNumber { color:red; }\n".
						"</style>";
			case "php":
				return	"<style type=\"text/css\">\n".
						"\t.scl_source_frame { text-indent:0px; padding:5px; background-color:#fff6de; color:black; font-size:12px; }\n".
						"\t.scl_php_keyword { color:#006500; }\n".
						"\t.scl_php_type { color:#0099ff; }\n".
						"\t.scl_php_comment { color:#838183; }\n".
						"\t.scl_php_string { color:#b28808; }\n".
						"\t.scl_php_number { color:#0000ff; }\n".
						"\t.scl_php_variable { color:#147777; }\n".
						"\t.scl_php_lineNumber { color:red; display: none; }\n".
						"</style>";
		} // switch
	}

	function syntaxColourLib_startExample()
	{
		ob_start();
	}
	function syntaxColourLib_endExample($i_language, $i_extraProps=array())
	{
		$example = ob_get_contents();
		ob_end_clean();
		$data = syntaxColourLib_colourize($example,$i_language,$i_extraProps);
		echo "<pre class=\"scl_source_frame\">$data</pre>";
	}

	function _syntaxColourLib_explodeOnAny($i_sep,$i_src)
	{
		$tokens = array();
		$srcSize = strlen($i_src);
		$offset = 0;
		$lastOffset = 0;
		while ($offset<$srcSize) {
			if (in_array($i_src[$offset],$i_sep)) {
				if ($lastOffset!=$offset) $tokens[] = substr($i_src,$lastOffset,$offset-$lastOffset);
				$tokens[] = $i_src[$offset];
				++$offset;
				$lastOffset = $offset;
			} else ++$offset;
		}
		
		return $tokens;		
	}

	function _syntaxColourLib_colourize_cpp( $i_src,$i_extraProps )
	{
		$keywords = array(	"class",
							"namespace",
							"virtual",
							"inline",
							"const",
							"mutable",
							"new",
							"typedef",
							"public",
							"private",
							"protected",
							"delete",
							"template",
							"if",
							"while",
							"else",
							"return",
							"exit",
							"throw",
							"catch",
							"try",
							"do" );
		$types = array(	"true",
						"false",
						"int",
						"unsigned",
						"signed",
						"long",
						"char",
						"void" );
		$srcTokens = _syntaxColourLib_explodeOnAny($GLOBALS["whitespace"],$i_src);
		$endTokens = array();
		$isComment = false;
		$commentTerm = false;
		foreach($srcTokens as $token) {
			$token = str_replace(">","&gt;",$token);
			$token = str_replace("<","&lt;",$token);
			if ($lastToken=="\n"||!isset($lastToken)) { $endTokens[] = "<span class=\"scl_cpp_lineNumber\">".str_pad(++$lineNumber,4,0,STR_PAD_LEFT)."</span> "; }
			$lastToken = $token;
			// Check for comments
			if (!$inQuotes) {
				if ($token===$commentTerm) { $isComment=false;  $commentTerm=false; $endTokens[] = $token; $endTokens[] = "</span>";  continue; }
				if ($token=="//") { $isComment=true; $commentTerm="\n"; $endTokens[] = "<span class=\"scl_cpp_comment\">"; $endTokens[] = $token;  continue; }
				if ($token=="/*") { $isComment=true; $commentTerm="*/"; $endTokens[] = "<span class=\"scl_cpp_comment\">"; $endTokens[] = $token;  continue; }
			}
			if (!$isComment) {
				if ($token=="\"") { if ($isQuote) { $endTokens[] = $token; $endTokens[] = "</span>"; $isQuote=false; } else { $endTokens[] = "<span class=\"scl_cpp_string\">"; $endTokens[] = $token; $isQuote=true; } continue; }
			}

			if (!$isComment) {
				if (in_array($token,$keywords)) {
					$token = "<span class=\"scl_cpp_keyword\">$token</span>";
				} else if (in_array($token,$types)) {
					$token = "<span class=\"scl_cpp_type\">$token</span>";
				} else
				 if (is_numeric($token)) {
					$token = "<span class=\"scl_cpp_number\">$token</span>";
				}
			}
			$endTokens[] = $token;
		}
		return implode("",$endTokens);
	}


	function _syntaxColourLib_colourize_php( $i_src,$i_extraProps )
	{
		$keywords = array(	"class",
							"new",
							"delete",
							"if",
							"while",
							"else",
							"do",
							"foreach",
							"return",
							"exit",
							"list" );
		$types = array(	"true",
						"false",
						"int",
						"unsigned",
						"signed",
						"long",
						"char",
						"void" );
		
		$srcTokens = _syntaxColourLib_explodeOnAny($GLOBALS["whitespace"],$i_src);
		$endTokens = array();
		$isComment = false;
		$commentTerm = false;
		foreach($srcTokens as $token) {
			$token = str_replace(">","&gt;",$token);
			$token = str_replace("<","&lt;",$token);
			if ($lastToken=="\n"||!isset($lastToken)) { $endTokens[] = "<span class=\"scl_php_lineNumber\">".str_pad(++$lineNumber,4,0,STR_PAD_LEFT)."</span> "; }
			$lastToken = $token;
			// Check for comments
			if (!$inQuotes) {
				if ($token===$commentTerm) { $isComment=false;  $commentTerm=false; $endTokens[] = $token; $endTokens[] = "</span>";  continue; }
				if ($token=="//") { $isComment=true; $commentTerm="\n"; $endTokens[] = "<span class=\"scl_php_comment\">"; $endTokens[] = $token;  continue; }
				if ($token=="/*") { $isComment=true; $commentTerm="*/"; $endTokens[] = "<span class=\"scl_php_comment\">"; $endTokens[] = $token;  continue; }
			}
			if (!$isComment) {
				if ($token=="\"") { if ($isQuote) { $endTokens[] = $token; $endTokens[] = "</span>"; $isQuote=false; } else { $endTokens[] = "<span class=\"scl_php_string\">"; $endTokens[] = $token; $isQuote=true; } continue; }
			}

			if (!$isComment) {
				if (in_array($token,$keywords)) {
					$token = "<span class=\"scl_php_keyword\">$token</span>";
				} else if (in_array($token,$types)) {
					$token = "<span class=\"scl_php_type\">$token</span>";
				} else if (is_numeric($token)) {
					$token = "<span class=\"scl_php_number\">$token</span>";
				} else if ($token[0]=="\$") {
					$token = "<span class=\"scl_php_variable\">$token</span>";
				}
			}
			$endTokens[] = $token;
		}
		return implode("",$endTokens);
	}


	function _syntaxColourLib_colourize_shell( $i_src,$i_extraProps )
	{

	}


	function _syntaxColourLib_colourize_text( $i_src,$i_extraProps )
	{

	}

?>