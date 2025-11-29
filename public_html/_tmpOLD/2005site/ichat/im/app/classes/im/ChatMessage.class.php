<?

class ChatMessage extends Row {

	function define() {
		$this->tableName = "chatMessages";
		$this->addColumn("chatMessageId","id");
		$this->addColumn("fromUsername");
		$this->addColumn("toUsername");
		$this->addColumn("body","text",4000);
		$this->addColumn("type","int",11,0,array( 0 => "Instant Message", 1 => "Buddy Online", 2 => "Buddy Offline", 3 => "Self Log Off" ));
		$this->addColumn("dateCreated","date");
	}

}

?>