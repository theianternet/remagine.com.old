<?

class Row
{
	public $tableName;
	public $idName;

	function __construct($id="")
	{
		if ($id == "new") {
			$id = "";
		}
		if (method_exists($this,"define"))
		{
			$this->define();
			$this->tableName = $GLOBALS["tableNamePrefix"] . $this->tableName;
			$this->id = $id;
			if (is_array($this->columns))
			{
				foreach ($this->columns AS $column)
				{
					if ($column["type"] == "text")
					{
						$strings[] = $column["name"];
					}
				}
				if (is_array($strings))
				{
					$this->addCondition("stringQuery","string",$strings,"contains");
				}
				if ($this->id > 0){
					$this->populate();
				}
			} else {
				$this->columns = array();
			}
		}
	}

	function addColumn($name="",$type="text",$length="",$default="NULL",$options="")
	{
		if ($type == "id")
		{
			$this->idName = $name;
		}
		if ($length == "")
		{
			switch ($type)
			{
				case "text":
					$length = 200;
					break;
				case "float":
					$length = 11;
					break;
				case "binary":
					$length = 1;
					break;
			}
		}
		$column = array(
							"name" => $name,
							"type" => $type,
							"length" => $length,
							"default" => $default,
							"options" => $options
						);
		$this->columns[$name] = $column;

		switch ($type)
		{
			case "text":
				$this->addCondition($name,"string",array($name),"=");
				break;
			case "date":
				$this->addCondition($name,"date",array($name),"=");
				break;
			case "float":
			case "int":
			case "id":
				$this->addCondition($name,"number",array($name),"=");
				break;
			case "binary":
				$this->addCondition($name,"binary",array($name),"=");
				break;
		}
	}

	function addRelationship($from,$to)
	{
		$this->relationships[$from] = $to;
	}

	function populate()
	{
		if ($this->id > 0 && is_numeric($this->id)){
			$result = databaseQuery("SELECT * FROM ". $this->tableName ." WHERE ". $this->tableName .".". $this->idName ." = ". $this->id);
			if ($result == "1146")
			{
				databaseQuery($this->getCreateTableCode());
				$this->populate();
			} elseif ($result) {
				while ($row = mysql_fetch_array($result))
				{
					foreach ($this->columns AS $c)
					{
						if ($row[$c["name"]] != "")
						{
							$this->$c["name"] = $row[$c["name"]];
						}
					}
				}
			}
		}
	}

	function getRelationship($from,$empty=0)
	{
		if ($from != "")
		{
			if (is_array($this->relationships) && is_numeric($this->$from))
			{
				return new $this->relationships[$from]($this->$from);
			} elseif (is_array($this->relationships) && $empty) {
				return new $this->relationships[$from]();
			}
		}
		return new Row();
	}

	function save() {
		global $currentUser;

		if (!is_numeric($this->id) || $this->id == "new" || $this->id == 0 || $this->id == "") {
			$result = databaseQuery("INSERT INTO ". $this->tableName ." () VALUES ()");
			if ($result === 1146) {
				databaseQuery($this->getCreateTableCode());
				$result = databaseQuery("INSERT INTO ". $this->tableName ." () VALUES ()");
			}
			$this->id = mysql_insert_id();
			$temp = $this->idName;
			$this->$temp = $this->id;

			$isNew = true;
		}
		if (is_numeric($this->id)) {
			foreach ($this->columns AS $c) {
				if (($c["type"] != "id" && isset($this->$c["name"]) && $this->$c["name"] != "userTypeId") || $c["name"] == "dateCreated" || $c["name"] == "dateModified" || ($c["name"] == "createdByUserId" && get_class($this) != "User")) {
					if ($set != "") {
						$set .= ", ";
					}
					if ($this->$c["name"] == "" && $c["name"] == "createdByUserId" && is_numeric($currentUser->userId) && $currentUser->userId > 0) {
						$set .= " `". $c["name"] ."` = ". $currentUser->userId ." ";
					} elseif ($this->$c["name"] === "NULL") {
						$set .= " `". $c["name"] ."` = NULL ";
					} elseif ($c["type"] == "date" && $c["name"] == "dateModified" || ($c["name"] == "dateCreated" && $this->dateCreated == "")) {
						$set .= " `". $c["name"] ."` = '". formatDateForDatabase() ."' ";
					} elseif ($c["type"] == "date" && trim($this->$c["name"]) == "") {
						$set .= " `". $c["name"] ."` = NULL ";
					} elseif ($c["type"] == "date") {
						$set .= " `". $c["name"] ."` = '". formatDateForDatabase($this->$c["name"]) ."' ";
					} else {
						$set .= " `". $c["name"] ."` = '". databaseEscapeString($this->$c["name"]) ."' ";
					}
				}
			}
			if ($set != "") {
				if (databaseQuery("UPDATE ". $this->tableName ." SET ". $set ." WHERE ". $this->idName ." = '". $this->id ."'")) {
					return true;
				}
			} else {
				return true;
			}
		}
		return false;
	}

	function delete() {
		global $currentUser;
		if (is_numeric($this->id))
		{
			if (databaseQuery("DELETE FROM ". $this->tableName ." WHERE ". $this->idName ." = '". $this->id ."'"))
			{
				return true;
			}
		}
		return false;
	}

	function getCreateTableCode()
	{
		$out = "CREATE TABLE IF NOT EXISTS `". $this->tableName ."` (";
		foreach ($this->columns AS $c)
		{
			switch ($c["type"])
			{
				case "text":
					if ($c["length"] >= 2000)
					{
						$type = "text";
					} else {
						$type = "varchar(". $c["length"] .")";
					}
					break;
				case "int":
					$type = "int(11)";
					break;
				case "date":
					$type = "datetime";
					break;
				case "float":
					$type = "float";
					break;
				case "binary":
					$type = "binary(1)";
					break;
			}
			if ($c["default"] != "NULL" && !is_numeric($c["default"]))
			{
				$c["default"] = "'". $c["default"] ."'";
			}
			switch ($c["type"])
			{
				case "id":
					$out .= "\n`". $this->idName ."` int(11) NOT NULL auto_increment,";
					break;
				case "text":
					$out .= "\n`". $c["name"] ."` ". $type .",";
					break;
				default:
					$out .= "\n`". $c["name"] ."` ". $type ." default ". $c["default"] .",";
					break;
			}
		}
		$out .= "\nPRIMARY KEY  (`". $this->idName ."`)";
		$out .= "\n) TYPE=MyISAM;";
		return $out;
	}

	function getThis() {
		return $this;
	}

	function addCondition($name="",$type="string",$columns="",$operator="=")
	{
		if ($name != "" && $columns != "")
		{
			if ($columns != "" && !is_array($columns))
			{
				$columns = array($columns);
			}
			$condition = array(
								"name" => $name,
								"type" => $type,
								"columns" => $columns,
								"operator" => $operator
							);
		}
		$this->conditions[] = $condition;
	}

	function parseInput($input)
	{
		if (is_array($input) && is_array($this->columns))
		{
			foreach ($this->columns AS $k => $v)
			{
				if (array_key_exists($k,$input))
				{
					$this->$k = $input[$k];
				}
			}
		}
		return true;
	}

	function parseInputAndSave($input)
	{
		$this->parseInput($input);
		if ($this->save())
		{
			return true;
		}
		return false;
	}

}

?>