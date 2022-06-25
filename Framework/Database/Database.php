<?php
class Database{
  public $connection;
	public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = '', $charset = 'utf8mb4')
  {
		$this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($this->connection->connect_error) {
			die('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}
		$this->connection->set_charset($charset);
		$this->connection->query("SET NAMES {$charset}");
	}

  public function Escape($value)
  {
    return $this->connection->real_escape_string($value);
  }
}
?>