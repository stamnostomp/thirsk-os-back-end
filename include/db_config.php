<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'login');
define('DB_PASSWORD', '601215002Dz$$');
define('DB_DATABASE', 'login');

class DB_con {
	public $connection;
	function __construct(){
		$this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);

		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);

	}

	function ret_obj(){
		return $this->connection;
	}

}
