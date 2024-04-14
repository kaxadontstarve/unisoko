<?php

require_once './include/ShoppingCart.php';
require_once './include/DatabaseConnect.php';

class ShoppingCartTest extends PHPUnit\Framework\TestCase{
  public function testShoppingCart(){
    $db_connection = new DatabaseConnect();
    $mysql = $db_connection->getConnection();
  
    $shopping_cart = new ShoppingCart($mysql);
    
    $this->assertTrue($shopping_cart->addGoods("14", "1")["status"]);
    $this->assertFalse($shopping_cart->addGoods("1", "100")["status"]);
    $this->assertFalse($shopping_cart->addGoods("1", "1")["status"]);
    $this->assertFalse($shopping_cart->addGoods("14", "1")["status"]);
  }
}