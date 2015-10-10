<?php
/**
 * 
 * @authors Yurii Kostenko (y.kostenko111@ya.ru)
 * @date    2015-10-09 00:48:04
 * @version 1
 */

class chat 
	{
  	private $_db;
  	private static $_self = null;
  	private function __construct($db){
      	$this->_db = $db;
	}
  	public static function _self($db){
      	if(self::$_self == null){
          	self::$_self = new self($db);
    	}

      	return self::$_self;
  	}

  	//Аторизация
  	public function LoginMembers($login,$password){
      	$login = strip_tags(trim($login));
      	$login = $this->_db->real_escape_string($login);
      	$password = hash("sha256", $password);

      	$query = $this->_db->query("SELECT `id`, `login`, `password` FROM  `login` WHERE `login` = '$login'");
      	$result = $query->fetch_object();

      	if(trim($result->login) === $login  && trim($result->password) === trim($password)){
          	$_SESSION['user']['login'] = $result->login;
          	$_SESSION['user']['id'] = $result->id;
          	$_SESSION['user']['ip'] = getenv("REMOTE_ADDR");
		return true;
      	}


    return false;
	}

  	//Выход
  	public function Logout(){
      	session_destroy();
  	}

 	//перезаписываем цвет сообщений
  	public function collor($collor, $id){
      	$color = $this->_db->real_escape_string($collor);
      	$query = $this->_db->query("UPDATE `login` SET `color` = '$collor' WHERE `id` = $id");
      	if(!$query) throw new Exception("Не удалось выполнить запрос:".$this->_db->error." ".__LINE__);

      	return true;
  	}

  	//Выборка логина по id
  	private static function LoginToId($db,$id){
      	$query = $db->query("SELECT `login` FROM `login` WHERE `id` = $id");
      	$result = $query->fetch_assoc();

      	return ($result['login']) ? $result['login'] : NULL;
  	}

  	//Выборка id по логину
  	private static function IdToLogin($db, $login){
    	$login = $db->real_escape_string($login);
    	$query = $db->query("SELECT `id` FROM `login` WHERE `login` = '$login'");
    	$result = $query->fetch_assoc();

    	return $result['id'];
  	}

  	//Достаем цвет по id юзера
  	public function ShowCollor($uid){
      	$query = $this->_db->query("SELECT `color` FROM `login` WHERE `id` = $uid");
      	$result = $query->fetch_assoc();

      	return $result['color'];
  	}

  	//Добовляем сообщение
  	public function newMessage($message){
      	$time = time();
      	$uid = !empty($_SESSION['user']['id']) ? $_SESSION['user']['id']
                                               : self::IdToLogin($this->_db, $_SESSION['user']['login']);
      	$query = $this->_db->prepare("INSERT INTO `message` (`time`,`message`,`uid`) VALUES(?,?,?)");
      	$query->bind_param('isi', $time, $message, $uid);

      	return $query->execute();
  	}

  	//выборка всех сообщений

   	public function ShowMessage(){
          	$query = $this->_db->query("SELECT `id`,`time`,`message`,`uid` FROM `message` ORDER BY `id` DESC");
          	while($result = $query->fetch_assoc()){
              	$login = self::LoginToId($this->_db, (int)$result['uid']);
              	$color = $this->ShowCollor($result['uid']);
              	$Uid[] = $result['uid'];
              	$Id[] = $result['id'];
              	$Login[] = $login;
              	$Color[] = $color;
              	$Date[] = date('Y-m-d(H:i:s)',$result['time']);
              	$Message[] = $result['message'];

          	}
          	$return = array("id" => $Id,
                          	"uid" => $Uid,
                          	"login" => $Login,
                          	"color" => $Color,
                          	"date" => $Date,
                          	"message" => $Message,
                          	"ssid" => $_SESSION['user']['id']);
          	return json_encode($return);

    }

    //Удаление
    public function DeleteMessage($id){
     	$query = $this->_db->query("DELETE FROM `message` WHERE `id` = $id");
     	if(!$query) return false;

     	return true;
    }

}