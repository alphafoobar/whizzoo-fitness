<?php
/**
 * util/Model.php
 * [model]
 * Implements common Model behaviours.
 * $Id: Model.php 36 2009-03-16 09:26:43Z alphafoobar $
 */
class Model
{ 
	/**
	 * If the data is not valid, save and insert functions will not be attempted.
	 *
	 * @var boolean
	 */
	
		
	/**
	 * This variable is used to hold input parameters, allowing a non-persistent
	 * memory of the object. Another array is required to define which values 
	 * are stored in the database, and another can be used to validate any 
	 * parameters in this store.
	 *
	 * @var array of strings pairs
	 */
	var $values = array(
	 // provides a data store
	);
	
		
	protected $valid = false;
		
	/**
	 * Run Query handles that DB stuff...
	 * 
	 * Throws UserException if no result is returned.
	 */
	protected function runQuery($query)
	{
		global $_sql_counter;
		$conn = Database::singleton()->connect();

		@$result = $conn->query($query);
		
		echo "sql: $query<br/>\n";
		if(!$result)
		{
			throw new DatabaseException("Exception running query: {$query}");
		}
		$_sql_counter++;
		return $result;
	}
	
	
	/**
	 * Run Query handles that DB stuff...
	 * 
	 * Throws UserException if no result is returned.
	 */
	protected function runInsert($query)
	{
		global $_sql_counter;
		$conn = Database::singleton()->connect();

		// @ represents an object handle?
		@$result = $conn->query($query);
		
		if(!$result)
		{
			throw new DatabaseException("Exception running query: {$query}");
		}
		$_sql_counter++;
		return $conn->insert_id;
	}
	
	/**
	 * Validates the Model based on the validation array in the child
	 * object.
	 */
	

	/**
	 * Returns true if the data is valid. Perhaps should also return messages?
	 *
	 * @return boolean
	 */
	public function validation()
	{
		foreach($this->values as $key => $value)
		{
			if(isset($this->validate[$key])) 
			{
				if(!ereg($this->validate[$key], $value))
				{
					$this->valid = false;
					echo "{$this->name} failed validation: {$value}:{$this->validate[$key]}<br/>\n";
					return $this->valid;
				}
			}
		}
		$this->valid = true;
		return $this->valid;
	}
	
	
	/**
	 * Sets a value in the values array
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		return $this->values[$key];
	}	
	
	
	/**
	 * Sets a particular value. If value is not null.
	 *
	 * @param string $key
	 * @param string $value
	 */
	public function set($key, $value)
	{
		if(isset($value))
		{
			$this->values[$key] = $value;
		}
	}
	
	/**
	 * @return string Representing the table name of this object.
	 */
	public function getTableName()
	{
		return $this->name;
	}
	
	/**
	 * Gets the column names of the table, prepended with the table name to avoid
	 * collisions.
	 * 
	 * @return array of strings 
	 */
	public function getColumnNames()
	{
		$result = array();
		$i=0;
		foreach($this->table_data as $value ) 
		{
			$result[$i++] = $this->name.".{$value}";
       	}
       	return $result;
	}
		
	/**
	 * Inserts this object as a new record.
	 *
	 * @return int The unique ID, if successful.
	 */
	public function insert()
	{
		// if valid
		if($this->validation()) 
		{
			$this->runInsert($this->insertQuery());
		}
			
		return false;
	}
		
	/**
	 * Updates an existing record.
	 *
	 */
	public function update()
	{
		// if valid
		if($this->validation()) 
		{
			$this->runQuery($this->updateQuery());
		}
	}
	
	private function insertQuery()
	{	
		$sql = "INSERT INTO ".$this->getTableName()." (";
		$values = "VALUES (";	
	
		foreach($this->table_data as $key)
		{
			if($this->values[$key])
			{
				$sql.="$key,";
				$values.="'{$this->values[$key]}',";
			}
			echo "$key = {$this->values[$key]}<br/>\n";
		}
		
		$sql.="modified)";
		$values.="NOW());";
		return $sql.$values;
	}
	
	private function updateQuery()
	{	
		$sql = "UPDATE ".$this->getTableName()." SET ";
	
		foreach($this->table_data as $key)
		{
			if($this->values[$key])
			{
				$sql.="$key='{$this->values[$key]}',";
			}
			echo "$key = {$this->values[$key]}<br/>\n";
		}
		
		return $sql.="modified=NOW() WHERE id={$this->values['exercise']};";
	}
	
	/**
	 * Generate the select statement.
	 *
	 * @param int $id
	 * @return string SQL Query.
	 */
	private function selectQuery($id)
	{	
		$sql = "SELECT ";
		$where = " FROM ".$this->getTableName()." WHERE id = $id;";	
		
		$i = 0;
		$length = count($this->table_data);	
		foreach($this->table_data as $key)
		{
			$sql.="$key";
			if(++$i < $length)
			{
				$sql.=", ";
			}
		}
		return $sql.$where;
	}
	
	/**
	 * Initialises this object using the selected id.
	 *
	 * @param int $id
	 */
	public function load($id)
	{
		$str = $this->selectQuery($id);
		$result = $this->runQuery($str);
		if($result)
		{
			$this->initialise($result->fetch_assoc());
		}
	}
	
	/**
	 * Initialise the data structure.
	 *
	 * @param array $results
	 */
	public function initialise($results)
	{
		if(isset($results))
		{
			foreach($results as $key => $value)
			{
				$this->values[$key] = $value;
			}
		}
	}
}
?>