<?php

require_once './include/User.php';

class UserUnitTest extends \PHPUnit\Framework\TestCase {

    public function testAuthenticationValidationEmail() {
        $mockMysql = $this->getMockBuilder(mysqli::class)
                          ->disableOriginalConstructor()
                          ->getMock();
        $user = new User($mockMysql);

        $result = $user->authentication('invalid_email', 'password123');
        $this->assertFalse($result['status']);
    }
    public function testAuthenticationValidationPasswordLength() {
        $mockMysql = $this->getMockBuilder(mysqli::class)
                          ->disableOriginalConstructor()
                          ->getMock();
        $user = new User($mockMysql);

        $result = $user->authentication('test@example.com', 'pass');
        $this->assertFalse($result['status']);
    }
    public function testAuthenticationValidationPasswordSymbols() {
        $mockMysql = $this->getMockBuilder(mysqli::class)
                          ->disableOriginalConstructor()
                          ->getMock();
        $user = new User($mockMysql);

        $result = $user->authentication('test@example.com', 'password!@#');
        $this->assertFalse($result['status']);
    }
    public function testRegistrationValidationEmail() {
        $mockMysql = $this->getMockBuilder(mysqli::class)
                          ->disableOriginalConstructor()
                          ->getMock();
        $user = new User($mockMysql);

        $result = $user->registration('test_user', 'invalid_email', 'password123');
        $this->assertFalse($result['status']);
    }
    public function testRegistrationValidationPasswordLength() {
        $mockMysql = $this->getMockBuilder(mysqli::class)
                          ->disableOriginalConstructor()
                          ->getMock();
        $user = new User($mockMysql);

        $result = $user->registration('test_user', 'test@example.com', 'pass');
        $this->assertFalse($result['status']);
    }
    public function testRegistrationValidationPasswordSymbols() {
        $mockMysql = $this->getMockBuilder(mysqli::class)
                          ->disableOriginalConstructor()
                          ->getMock();
        $user = new User($mockMysql);

        $result = $user->registration('test_user', 'test@example.com', 'password!@#');
        $this->assertFalse($result['status']);
    }
}
