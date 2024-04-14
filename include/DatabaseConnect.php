<?php
class DatabaseConnect{
  private $connection;

  public function __construct(){
    $this->connection = new mysqli("localhost", "root", "", "unisoko");

    if (!$this->connection)
	  die('Database connecting error!');

    $this->connection->query("SET NAMES 'utf8'");
  }

  public function getConnection(){
    return $this->connection;
  }
}