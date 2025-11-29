<?

class Search
{
	public $sortBy;
	public $sortOrder;
	public $outputType;
	public $findAll;
	public $resultsArray;
	public $totalResultsCount;
	public $userAndOr;
	public $valuesAndOr;
	public $resultsPerPage;
	public $currentPage;
	public $currentPageStartResult;
	public $currentPageEndResult;
	public $resultsPageCount;
	public $isPaginated;

	function __construct($type="")
	{
		$this->findAll = 0;
		$this->isPaginated = 0;
		$this->userAndOr = "or";
		$this->type = $type;
		if ($type != "")
		{
			if ($this->reference = new $type)
			{
				// success
			}
		}
	}

	function getOrderByClause()
	{
		$clause = "";
		if (!is_array($this->sortBy))
		{
			$this->sortBy = array($this->sortBy);
		}
		if (!is_array($this->sortOrder))
		{
			$this->sortOrder = array($this->sortOrder);
		}
		foreach($this->sortBy AS $k => $v)
		{
			if ($clause != "")
			{
				$clause .= ", ";
			}
			if ($v == "shuffle")
			{
				$clause .= " RAND() ";
			} elseif (is_array($this->reference->columns)) {
				foreach ($this->reference->columns AS $c)
				{
					if ($c["name"] == $v)
					{
						$clause .= $this->reference->tableName .".". $c["name"] ." ";
					}
				}
			}
			if (strpos($v,"->") !== false)
			{
				$pieces = explode("->",$v);
				if (is_array($this->reference->relationships))
				{
					$template = new $this->reference->relationships[$pieces[0]]();
					$clause .= $template->tableName .".". $pieces[1] ." ";
				}
			}
			if ($clause == "")
			{
				$clause .= $this->reference->tableName .".". $this->reference->idName ." ";
			}
			switch (strtolower(trim($this->sortOrder[$k])))
			{
				case "asc":
					$clause .= " ASC ";
					break;
				case "desc":
					$clause .= " DESC ";
					break;
				default:
					$clause .= " ASC ";
					break;
			}
		}
		$clause = " ORDER BY ". $clause;
		return $clause;
	}

	function getSelectClause()
	{
		$out = str_replace(" ORDER BY ","",str_replace(" ASC ","",str_replace(" DESC ","",$this->getOrderByClause())));
		if (strpos($out,$this->reference->tableName .".". $this->reference->idName) === false)
		{
			$out .= ", ". $this->reference->tableName .".". $this->reference->idName ." ";
		}
		return $out;
	}

	function getQuery($joinString="")
	{
		$whereString = $this->getWhereString();
		if ($whereString != "")
		{
			$query = "SELECT ". $this->getSelectClause() ." FROM ". $this->reference->tableName ." ". $joinString ." ". $whereString ." ". $this->getOrderByClause();
		}
		return $query;
	}

	function getWhereString()
	{
		if (is_array($this->conditions))
		{
			foreach ($this->conditions AS $c)
			{
				if (is_array($this->reference->conditions))
				{
					foreach ($this->reference->conditions AS $r)
					{
						$pieces = explode("->",$c["name"]);
						if ($c["name"] == $r["name"] || (strpos($c["name"],"->") && $pieces[0] == $r["name"]))
						{
							if (is_array($c["values"]))
							{
								foreach ($c["values"] AS $v)
								{
									if ($v != "" || $c["operator"] == "isNull" || $c["operator"] == "isNotNull" || $c["operator"] == "isNotEmpty")
									{
										if ($out2 != "")
										{
											if ($this->valuesAndOr == "or")
											{
												$out2 .= " OR ";
											} else {
												$out2 .= " AND ";
											}
										}
										$out3 = "";
										if (is_array($r["columns"]))
										{
											foreach ($r["columns"] AS $column)
											{
												if ($out3 != "")
												{
													$out3 .= " || ";
												}
												if ($c["operator"] == "")
												{
													$c["operator"] = $r["operator"];
												}
												if (strpos($c["name"],"->")) {
													$pieces = explode("->",$c["name"]);
													if (is_array($this->reference->getRelationship($pieces[0],"empty")->conditions)) {
														foreach ($this->reference->getRelationship($pieces[0],"empty")->conditions AS $cc) {
															if ($cc["name"] == $pieces[1]) {
																$r["type"] = $cc["type"];
																$column = $c["name"];
															}
														}
													}
												}
												switch ($r["type"])
												{
													case "string":
														if (strpos($column,"->"))
														{
															$pieces = explode("->",$column);
															$y = $this->reference->getRelationship($pieces[0],"empty")->tableName .".". $pieces[1];
															switch ($c["operator"])
															{
																case "=":
																	$out3 .= $y ." = '". databaseEscapeString($v) ."'";
																	break;
																case "!=":
																	$out3 .= $y ." != '". databaseEscapeString($v) ."'";
																	break;
																case "contains":
																	$out3 .= $y ." LIKE '%". databaseEscapeString($v) ."%'";
																	break;
																case "startsWith":
																	$out3 .= $y ." LIKE '". databaseEscapeString($v) ."%'";
																	break;
																case "endsWith":
																	$out3 .= $y ." LIKE '%". databaseEscapeString($v) ."'";
																	break;
																case "isNull":
																	$out3 .= $y ." IS NULL";
																	break;
																case "isNotNull":
																	$out3 .= $y ." IS NOT NULL";
																	break;
																case "isEmpty":
																	$out3 .= $y ." = ''";
																	break;
																case "isNotEmpty":
																	$out3 .= $y ." != ''";
																	break;
															}
														} else {
															switch ($c["operator"])
															{
																case "=":
																	$out3 .= $this->reference->tableName .".". $column ." = '". databaseEscapeString($v) ."'";
																	break;
																case "!=":
																	$out3 .= $this->reference->tableName .".". $column ." != '". databaseEscapeString($v) ."'";
																	break;
																case "contains":
																	$out3 .= $this->reference->tableName .".". $column ." LIKE '%". databaseEscapeString($v) ."%'";
																	break;
																case "startsWith":
																	$out3 .= $this->reference->tableName .".". $column ." LIKE '". databaseEscapeString($v) ."%'";
																	break;
																case "endsWith":
																	$out3 .= $this->reference->tableName .".". $column ." LIKE '%". databaseEscapeString($v) ."'";
																	break;
																case "isNull":
																	$out3 .= $this->reference->tableName .".". $column ." IS NULL";
																	break;
																case "isNotNull":
																	$out3 .= $this->reference->tableName .".". $column ." IS NOT NULL";
																	break;
																case "isEmpty":
																	$out3 .= $y ." = ''";
																	break;
																case "isNotEmpty":
																	$out3 .= $this->reference->tableName .".". $column ." != ''";
																	break;
															}
														}
														break;
													case "date":
														if (strpos($column,"->"))
														{
															$pieces = explode("->",$column);
															$y = $this->reference->getRelationship($pieces[0],"empty")->tableName .".". $pieces[1];
															switch ($c["operator"])
															{
																case "=":
																case "!=":
																case ">":
																case "<":
																case ">=":
																case "<=":
																	if ($v != "")
																	{
																		$out3 .= $y ." ". $c["operator"] ." '". formatDateForDatabase($v) ."'";
																	}
																	break;
																case "isNull":
																	$out3 .= $y ." IS NULL";
																	break;
																case "isNotNull":
																	$out3 .= $y ." IS NOT NULL";
																	break;
															}
														} else {
															switch ($c["operator"])
															{
																case "=":
																case "!=":
																case ">":
																case "<":
																case ">=":
																case "<=":
																	if ($v != "")
																	{
																		$out3 .= $this->reference->tableName .".". $column ." ". $c["operator"] ." '". formatDateForDatabase($v) ."'";
																	}
																	break;
																case "isNull":
																	$out3 .= $this->reference->tableName .".". $column ." IS NULL";
																	break;
																case "isNotNull":
																	$out3 .= $this->reference->tableName .".". $column ." IS NOT NULL";
																	break;
															}
														}
														break;
													case "number":
														if (is_numeric($v))
														{
															switch ($c["operator"])
															{
																case "=":
																case "!=":
																case ">":
																case "<":
																case ">=":
																case "<=":
																	$out3 .= $this->reference->tableName .".". $column ." ". $c["operator"] ." ". databaseEscapeString($v);
																	break;
																case "isNull":
																	$out3 .= $this->reference->tableName .".". $column ." IS NULL";
																	break;
																case "isNotNull":
																	$out3 .= $this->reference->tableName .".". $column ." IS NOT NULL";
																	break;
															}
														}
														break;
													case "binary":
														switch ($c["operator"])
														{
															case "=":
															case "!=":
																if ($v)
																{
																	$out3 .= $this->reference->tableName .".". $column ." ". $c["operator"] ." 1";
																} else {
																	$out3 .= $this->reference->tableName .".". $column ." ". $c["operator"] ." 0";
																}
																break;
															case "isNull":
																$out3 .= $this->reference->tableName .".". $column ." IS NULL";
																break;
															case "isNotNull":
																$out3 .= $this->reference->tableName .".". $column ." IS NOT NULL";
																break;
														}
														break;
												}
											}
										}
										if ($out3 != "")
										{
											$out2 .= " (". $out3 .") ";
										}
										$out3 = "";
									}
								}
							}
						}
						if ($out != "" && $out2 != "")
						{
							$out .= " AND ";
						}
						if ($out2 != "")
						{
							$out .= "(". $out2 .")";
						} else {
							$out .= $out2;
						}
						$out2 = "";
					}
				}
			}
			if ($out != "")
			{
				$out = " AND (". $out .") ";
			}
		}
		if ($out != "" || $this->findAll)
		{
			$whereString = " WHERE ". $this->reference->tableName .".". $this->reference->idName ." > 0 ". $out;
		}
		return $whereString;
	}

	function getResultsIdArray($joinString="")
	{
		$resultsArray = array();
		$query = $this->getQuery($joinString);
		if ($query != ""){
			$result = databaseQuery($query);
			if (!is_numeric($result))
			{
				while ($row = mysql_fetch_array($result))
				{
					$resultsArray[] = $row[$this->reference->idName];
				}
			}
		}

		if (is_array($resultsArray))
		{
			$resultsArray = array_unique($resultsArray);
		}

		$this->totalResultsCount = count($resultsArray);

		if ($this->isPaginated)
		{
			if (!is_numeric($this->currentPage))
			{
				$this->currentPage = 1;
			}
			if (!is_numeric($this->resultsPerPage))
			{
				$this->resultsPerPage = 13;
			}
			if ($this->resultsPerPage == "all")
			{
				$this->resultsPageCount = 1;
				$this->currentPageStartResult = 1;
				$this->currentPageEndResult = $this->totalResultsCount;
			}
			elseif ($this->resultsPerPage > 0 && $this->currentPage > 0)
			{
				$this->resultsPageCount = ceil($this->totalResultsCount / $this->resultsPerPage);
				if ($this->currentPage <= $this->resultsPageCount)
				{
					$this->currentPageStartResult = ($this->resultsPerPage * ($this->currentPage - 1)) + 1;
				} else {
					$this->currentPageStartResult = $this->resultsPageCount;
				}
				if ($this->totalResultsCount < $this->resultsPerPage || $this->totalResultsCount < ($this->resultsPerPage * $this->currentPage))
				{
					$this->currentPageEndResult = $this->totalResultsCount;
				} else {
					$this->currentPageEndResult = $this->resultsPerPage * $this->currentPage;
				}
				if (is_array($resultsArray))
				{
					$resultsArray = array_slice ($resultsArray, $this->currentPageStartResult - 1, $this->resultsPerPage);
				}
			}
		}

		$this->resultsArray = $resultsArray;
		return $resultsArray;
	}

	function getResultsObjectsArray()
	{
		$resultsArray = $this->getResultsIdArray();
		$resultsObjectsArray = array();
		if (is_array($resultsArray))
		{
			foreach ($resultsArray AS $m)
			{
				if (is_numeric($m))
				{
					$resultsObjectsArray[] = new $this->type($m);
				}
			}
		}
		return $resultsObjectsArray;
	}

	function getResults()
	{
		return $this->getResultsObjectsArray();
	}

	function getResultsWithColumns()
	{
		$resultsArray = array();
		$alreadyJoined = array();
		$args = func_get_args();
		if (is_array($args))
		{
			if (is_array($args[0]))
			{
				$args = $args[0];
			}
		}
		if (is_array($args))
		{
			foreach ($args AS $c)
			{
				if ($c != "")
				{
					$pieces = explode("->",$c);
					if ($pieces[0] != "" && $pieces[1] != "")
					{
						$tableReference = new $this->reference->relationships[$pieces[0]]();
						if (array_key_exists($pieces[1],$tableReference->columns))
						{
							$table = $tableReference->tableName;
							$column = $pieces[1];
							if (!in_array($table,$alreadyJoined)) {
								$joinString .= " LEFT JOIN ". $table ." ON ". $table .".". $tableReference->idName ." = ". $this->reference->tableName .".". $pieces[0] ." ";
								$alreadyJoined[] = $table;
							}
							$as = " AS `". $c ."` ";
						} else {
							$table = "";
							$column = "";
							$as = "";
						}
						
						// add to stringQuery condition
						if (is_array($this->reference->conditions))
						{
							foreach ($this->reference->conditions AS $y => $z)
							{
								if (is_array($z))
								{
									if ($z["name"] == "stringQuery")
									{
										$this->reference->conditions[$y]["columns"][] = $c;
									}
								}
							}
						}
					
					} else {
						$table = $this->reference->tableName;
						$column = $pieces[0];
						$as = "";
					}
					if ($column != "")
					{
						if ($selectClause != "")
						{
							$selectClause .= " , ";
						}
						$selectClause .= $table .".`". $column ."` ". $as ." ";
					}
				}
			}
		}
		$ids = $this->getResultsIdArray($joinString);
		if (is_array($ids))
		{
			foreach ($ids AS $id)
			{
				if ($addToWhere != "")
				{
					$addToWhere .= " OR ";
				}
				$addToWhere .= $this->reference->idName ." = ". $id ." ";
			}
		}
		$whereString = $this->getWhereString();
		if ($whereString != "" && $addToWhere != "" && $selectClause != "") {
			$query = "SELECT ". $selectClause ." FROM ". $this->reference->tableName ." ". $joinString ." ". $whereString ." AND ( ". $addToWhere ." ) ". $this->getOrderByClause();
		}
		if ($query != ""){
			$result = databaseQuery($query);
			if (!is_numeric($result))
			{
				while ($row = mysql_fetch_array($result))
				{
					$resultsArray[$row[$this->reference->idName]] = $row;
				}
			}
		}
		return $resultsArray;
	}

	function getResultsWithQuery($query) {
		if ($query != "") {
			$result = databaseQuery($query);
			if (!is_numeric($result)) {
				while ($row = mysql_fetch_array($result)) {
					$resultsArray[$row[$this->reference->idName]] = $row;
				}
			}
		}
		return $resultsArray;
	}

	function getObjectResultsWithColumns()
	{
		$resultsArray = array();
		$args = func_get_args();
		if (is_array($args))
		{
			foreach ($args AS $c)
			{
				if ($c != "")
				{
					$pieces = explode("->",$c);
					if ($pieces[0] != "" && $pieces[1] != "")
					{
						$tableReference = new $this->reference->relationships[$pieces[0]]();
						if (array_key_exists($pieces[1],$tableReference->columns))
						{
							$table = $tableReference->tableName;
							$column = $pieces[1];
							$joinString .= " LEFT JOIN ". $table ." ON ". $table .".". $tableReference->idName ." = ". $this->reference->tableName .".". $pieces[0] ." ";
							$as = " AS `". $c ."` ";
						} else {
							$table = "";
							$column = "";
							$as = "";
						}
					} else {
						$table = $this->reference->tableName;
						$column = $pieces[0];
						$as = "";
					}
					if ($column != "")
					{
						if ($selectClause != "")
						{
							$selectClause .= " , ";
						}
						$selectClause .= $table .".`". $column ."` ". $as ." ";
					}
				}
			}
		}
		$ids = $this->getResultsIdArray();
		if (is_array($ids))
		{
			foreach ($ids AS $id)
			{
				if ($addToWhere != "")
				{
					$addToWhere .= " OR ";
				}
				$addToWhere .= $this->reference->idName ." = ". $id ." ";
			}
		}
		$whereString = $this->getWhereString();
		if ($whereString != "" && $addToWhere != "" && $selectClause != "")
		{
			$query = "SELECT ". $selectClause ." FROM ". $this->reference->tableName ." ". $joinString ." ". $whereString ." AND ( ". $addToWhere ." ) ". $this->getOrderByClause();
		}
		if ($query != ""){
			$result = databaseQuery($query);
			if (!is_numeric($result))
			{
				while ($row = mysql_fetch_array($result))
				{
					$thisRow = $row;
					$thisResult = new TemporaryRow();
					foreach ($row AS $k => $v)
					{
						if ($k != "" && !is_numeric($k))
						{
							$pieces = explode("->",$k);
							if ($pieces[0] != "" && $pieces[1] != "")
							{
								$thisTemporary = new TemporaryRow();
								$thisTemporary->$pieces[1] = $v;
								$thisResult->relationships[$pieces[0]] = $thisTemporary;
							} else {
								$thisResult->$k = $v;
							}
						}
					}
				
					$resultsArray[$row[$this->reference->idName]] = $thisResult;
				}
			}
		}
		return $resultsArray;
	}

	function addCondition($name="",$operator="",$values="")
	{
		if ($name != "")
		{
			if (!is_array($values))
			{
				$values = array($values);
			}
			$condition = array(
								"name" => $name,
								"operator" => $operator,
								"values" => $values
							);
		}
		$this->conditions[] = $condition;
	}

	function parseSettings($settings)
	{
		$this->resultsPerPage = $settings["resultsPerPage"];
		$this->currentPage = $settings["currentPage"];
		$this->sortBy = $settings["sortBy"];
		$this->sortOrder = $settings["sortOrder"];
	}
}

?>
