<?php

  class ShoppingCart{
    private $mysql;

    public function __construct($mysql){
      $this->mysql = $mysql;
    }

    private function validationGoods($id_goods){
      $request = $this->mysql->query("SELECT `id_good` FROM `goods`");

      $id_all_goods = [];

      while($row = $request->fetch_assoc()){
        array_push($id_all_goods, $row["id_good"]);
      }

      return !in_array($id_goods, $id_all_goods);
    
    }
    private function validationUser($id_user){
      $request = $this->mysql->query("SELECT `id_user` FROM `user`");

      $id_all_users = [];

      while($row = $request->fetch_assoc()){
        array_push($id_all_users, $row["id_user"]);
      }

      return !in_array($id_user, $id_all_users);
    }
    private function isProductInUserCart($id_user, $id_goods){
      $result = $this->mysql->query("SELECT * FROM `trash` WHERE `id_good` = '$id_goods' AND `id_user` = '$id_user'");
      return mysqli_num_rows($result) > 0;
    }

    public function addGoods($id_user, $id_goods){
      if($this->validationGoods($id_goods)){
        return array("message" => "Такого товару немає в БД!", "status" => false);
      }
      if($this->validationUser($id_user)){
        return array("message" => "Такого користувача немає в БД!", "status" => false);
      }
      if($this->isProductInUserCart($id_user, $id_goods)){
        return array("message" => "Для цього користувача цей товар вже доданий!", "status" => false);
      }

      $request = $this->mysql->query("INSERT INTO `trash` VALUES(NULL, '$id_goods', '$id_user')");
      
      if($request === true){
        $result = $this->mysql->query("SELECT * FROM `trash` WHERE `id_good` = '$id_goods' AND `id_user` = '$id_user'");
        $shopping_cart_id = $result->fetch_row()[0];

        return array("message" => "Товар успішно додано!", "status" => true, "shopping_cart_id" => $shopping_cart_id);
      }else{
        return array("message" => "Товар не додано :(", "status" => false);
      }
    }
  }