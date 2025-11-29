<?

require_once "inc/global.php";

if ($_GET["t"] != "") {
	$new = new ChatMessage();
	$new->fromUsername = $_SESSION["username"];
	$new->toUsername = $_GET["toUsername"];
	$new->body = strip_tags(str_replace("<","&lt;",str_replace(">","&gt;",$_GET["t"])));
	$new->save();
	if (!$_GET["history"] == "true") {
		exit();
	}
}

if ($_GET["history"] == "true") {
	if ($_SESSION["username"]) {
		$search = new Search("ChatUser");
		$search->addCondition("username","=",$_SESSION["username"]);
		$search->addCondition("sessionId","=",session_id());
		$search->getResultsWithColumns("chatUserId","username");
		if ($search->totalResultsCount > 0) {
			if (!headers_sent()) {
				header("Content-type: text/xml");
			}
			echo "<chat object=\"". $_GET["callbackObject"] ."\" participants=\"\">";
			//echo "<object>". $_GET["callbackObject"] ."</object>";
			$search = new Search("ChatMessage");
			$search->addCondition("toUsername","=",$_SESSION["username"]);
			$search->addCondition("type","<",3);
			if (is_numeric($_GET["last"])) {
				$search->addCondition("dateCreated",">=",$_GET["last"]);
			} else {
				$search->addCondition("dateCreated",">=",time() - (60*60));
			}
			$search->sortBy = "dateCreated";
			$search->sortOrder = "ASC";
			foreach ($search->getResults() AS $r) {
				if ($r->type == 0) {
					echo "<message><id>". $r->chatMessageId ."</id><time>". strtotime($r->dateCreated) ."</time><name>". $r->fromUsername ."</name><t>". $r->body ."</t></message>";
				} else {
					$status = "-";
					if (strlen($r->body) == 3 && substr($r->body, -1) == "U") {
						$status = "away";
					}
					echo "<buddy><username>". $r->fromUsername ."</username><type>". $r->type ."</type><t>". $status ."</t></buddy>";
				}
				$r->delete();
			}
			echo "</chat>";
		}
	}
}

?>