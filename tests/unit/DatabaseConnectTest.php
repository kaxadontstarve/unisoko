<?php
require './include/DatabaseConnect.php';

use PHPUnit\Framework\TestCase;

class DatabaseConnectTest extends TestCase {
    public function testConnection() {
        $db = new DatabaseConnect();

        $this->assertInstanceOf(DatabaseConnect::class, $db);


        $this->assertInstanceOf(mysqli::class, $db->getConnection());

        $result = $db->getConnection()->query("SHOW VARIABLES LIKE 'character_set_connection'");
        $row = $result->fetch_assoc();
        $this->assertEquals('utf8mb3', $row['Value']);
    }
}
