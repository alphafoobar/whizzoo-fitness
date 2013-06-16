<?php
/**
 * util/Database.php
 * [utility]
 * We'll use these functions to interact with a database.
 * $Id: Database.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

class Database
{
    // Hold an instance of the class, should only be valid per session.
    private static $instance;
	private $connection = null;
	
    
    // A private constructor; prevents direct creation of object
    private function __construct() 
    {    }

    // we want to make sure that when we go, we close our connection
	function __destruct() 
    {    
    	$this->close();
    }
    
    // The singleton method
    public static function singleton() 
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__; // we know what we are...
            self::$instance = new $c;
        }

        return self::$instance;
    }

	/**
	 * connect to the database.
	 *
	 * @return mysqli $conn A database connection. Or throw an exception if we can't
	 * return a connection.
	 */
	public function connect()
	{
		if(isset($this->connection))
		{
			if($this->connection->ping()) { return $this->connection; }
			else { $this->connection->close(); }
		}	
		
		@$this->connection = new mysqli(DatabaseConfig::$DB_SERVER, 
			DatabaseConfig::$DB_USER, DatabaseConfig::$DB_PASSWD, 
			DatabaseConfig::$DB_NAME);
		if (!$this->connection||mysqli_connect_errno())
		{
			throw new DatabaseException('Could not connect to database server: '.
				mysqli_connect_error());
		}		
		// Make sure any results we retrieve or commands we send use the same 
		// charset and collation as the database:
		//$db_charset = $conn->query( "SHOW VARIABLES LIKE 'character_set_database';" );
		//$charset_row = mysqli_fetch_assoc( $db_charset );
		//echo "charset: ". $charset_row['Value']."<br/>";
		//turns out we are getting latin1 form the database connection.
		$this->connection->query( "SET NAMES 'utf8'" );
		$this->connection->set_charset("utf8");
		//unset( $db_charset, $charset_row );
		
		return $this->connection;
	}
	
	/**
	 * Attempts to close the connection.
	 * @throws DatabaseException
	 */
	public function close()
	{
		try {
			$this->connection->close();
			$this->connection = null;
		} catch(Exception $e) {
			throw new DatabaseException('Could not close database connection: '.
				$e->getMessage());
		}
	}
}
?>