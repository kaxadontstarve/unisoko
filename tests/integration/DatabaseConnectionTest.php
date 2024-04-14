<?php

require_once './include/DatabaseConnect.php';

  class DatabaseConnectionTest extends \PHPUnit\Framework\TestCase{
    public function testConnection(){

      $dbConnector = new DatabaseConnect();
      $connection = $dbConnector->getConnection();

      $this->assertInstanceOf(mysqli::class, $connection);
    }
  }