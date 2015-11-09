<?php 

namespace DB;

/**
 * Version 0.1
 * Class to create db conection and execute query
 */
 
Class DataBase
{

	#only accessible on this class
	private static $instancia;

	private static $host = 'localhost';
	private static $user = 'root';
	private static $pass = '';
	private static $db_name = 'database';


	#can be modified by child classes
	protected $query;

	
	private $conn;

	/**
	 * Create PDO object
	 * 
	 */
	private function connect()
	{

		try {
			# change mysql for database manager that you use
			# mysql
			# pgsql
		    $this->conn = new \PDO(
		                          'mysql:host='.self::$host.';
		                          dbname='.self::$db_name, 
		                          self::$user, 
		                          self::$pass );
		   
		} catch (PDOException $e) {
		    print "¡Error!: " . $e->getMessage() . "<br/>";
		    die();
		}

		return True;
	}

	/**
	 * close connection
	 * 
	 */
	private function disconnect()
	{

		$this->conn = null;

	}

	/**
	 * Execute a query string, consider a previous clean
	 * 
	 */
	private function execQuery($query_r)
	{

		$this->query = $query_r;

		
		$this->connect();

		
		if ( ! $result = $this->conn->query($this->query) ) {

			return false;
		} 


		return $result;

	}

	/**
	 * Excecute a select query and return an array results
	 * @return array array results
	 */
	public function fetchAssoc($query_r)
	{
		
		if ( !$queryResult = $this->execQuery($query_r) ) {
			
			return false;
		
		}

		$rows = $queryResult;

		$queryResult = null;
		$this->disconnect();

		return $rows;

	}

}

