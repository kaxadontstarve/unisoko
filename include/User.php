<?php 
class User {
  private $mysql;

  public function __construct($mysql){
		$this->mysql = $mysql;
	}
  private function validationEmail($email){
    return !filter_var($email, FILTER_VALIDATE_EMAIL) ? false : true;
  }
  private function validationLenghtPassword($password){
    return strlen($password) >= 8;
  }
  private function validationSymbolPassword($password){
    return !preg_match("#[\W]+#", $password);
  }

  public function registration($login, $email, $password){
    $email = $this->mysql->real_escape_string($email);

    if(!$this->validationEmail($email)){
      return array("message" => "Email не пройшов валідацію!", "status" => false);
    }
    if(!$this->validationLenghtPassword($password)){
      return array("message" => "Пароль повинен містити принаймні 8 символів!", "status" => false);
    }
    if(!$this->validationSymbolPassword($password)){
      return array("message" => "Пароль не містити спеціальні символи!", "status" => false);
    }

    $result = $this->mysql->query("SELECT `email_user` FROM `user` WHERE `email_user` = '$email'");
  
    if(mysqli_num_rows($result) > 0){
      return array("message" => "Користувач з даним email вже зареєстровано!", "status" => false);
    }
 
    $login = $this->mysql->real_escape_string($login);
    $password = md5($this->mysql->real_escape_string($password));

    $request = $this->mysql->query("INSERT INTO `user` VALUES(NULL, '$login', '$email', '$password')");
    
    if($request === true){
      $result = $this->mysql->query("SELECT * FROM `user` WHERE `email_user` = '$email'");
      $user_id = $result->fetch_row()[0];
      return array("message" => "Користувач свторився успішно!", "status" => true, "id_user" => $user_id);
    }else{
      return array("message" => "Користувач не свторився :(", "status" => false);
    }
  }
  public function authentication($email, $password){
    $email = $this->mysql->real_escape_string($email);

    if(!$this->validationEmail($email)){
      return array("message" => "Email не пройшов валідацію!", "status" => false);
    }
    if(!$this->validationLenghtPassword($password)){
      return array("message" => "Пароль повинен містити принаймні 8 символів!", "status" => false);
    }
    if(!$this->validationSymbolPassword($password)){
      return array("message" => "Пароль не містити спеціальні символи!", "status" => false);
    }
    
		$password = md5($password);

		$result = $this->mysql->query("SELECT * FROM user WHERE `email_user` = '$email' AND `pass_user` = '$password'");
    $user = $result->fetch_assoc();

		if(mysqli_num_rows($result) === 1){
      return array("message" => "Користувач успішно авторизувався!", "status" => true, "id_user" => $user['id_user']);
		}else{
      return array("message" => "Не вірний логін або пароль", "status" => false);
		}
	}
}