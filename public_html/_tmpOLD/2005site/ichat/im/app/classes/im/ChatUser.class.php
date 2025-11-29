<?

class ChatUser extends Row {

	function define() {
		$this->tableName = "chatUser";
		$this->addColumn("chatUserId","id");
		$this->addColumn("username");
		$this->addColumn("sessionId");
		$this->addColumn("dateCreated","date");
	}

}

?>