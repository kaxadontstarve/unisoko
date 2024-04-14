<?php

require_once './include/User.php';
require_once './include/DatabaseConnect.php';

class UserTest extends \PHPUnit\Framework\TestCase{
  public function testRegistration(){
    $db_connection = new DatabaseConnect();
    $mysql = $db_connection->getConnection();

    $user = new User($mysql);
    $this->assertTrue(true);
    $this->assertTrue($user->registration("TestForReg", "test@gmail.com", "12345678")["status"]);
    $this->assertFalse($user->registration("Test", "test@gmail", "12345678")["status"]);
    $this->assertFalse($user->registration("Test", "test@gmail", "1234567")["status"]);
    $this->assertFalse($user->registration("Test", "test@gmail", "12345678)")["status"]);
    $this->assertFalse($user->registration("Test", "test@gmail.com", "12345678)")["status"]);
  }
  public function testAuthentication(){
    $db_connection = new DatabaseConnect();
    $mysql = $db_connection->getConnection();
  
    $user = new User($mysql);

    $this->assertFalse($user->authentication("test@gmail", "12345678")["status"]);
    $this->assertFalse($user->authentication("test1@gmail.com", "12345678")["status"]);
    $this->assertFalse($user->authentication("test@gmail", "1234567")["status"]);
    $this->assertFalse($user->authentication("test@gmail", "12345678)")["status"]);
    $this->assertTrue($user->authentication("test@gmail.com", "12345678")["status"]);
  }
}