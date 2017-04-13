<?php
require_once('database.class.php');

class User{
	public $id;
	public $operator_id;
	public $password;
	public $username;
	public $firstname;
	public $lastname;
	public $access_level;
	public $date_creation;
	
	public static function authenticate($username="",$password=""){
		global $database;
		$database->query('SELECT operator_id, username, password, firstname, lastname, access_level from user WHERE username = :username AND password = :password');
		$database->bind(':username',$username);
		$database->bind(':password',$password);
		return $database->single();
	}
	
	public function delete($id=0){
		global $database;
		$sql = "DELETE FROM user WHERE id=:id ";
		$database->query($sql);
		$database->bind(':id',$id);
		$database->execute();
	}
	
	public function save(){
		if ($this->id == 0){
			$this->addUser();
		} else {
			$this->updateUser();
		}
	}
	
	public static function view(){
		global $database;
		$sql = "SELECT * FROM user ORDER BY date_creation ASC";
		$database->query($sql);
		$database->execute();
		return $database->resultset();
	}
	
	public function addUser(){
		global $database;
		$sql  = "INSERT INTO user ";
		$sql .= "(operator_id,username,password,firstname,lastname,access_level,date_creation) ";
		$sql .= "VALUES ";
		$sql .= "(:operator_id,:username,:password,:firstname,:lastname,:access_level,:date_creation) ";
		$database->query($sql);
		$database->bind(':operator_id',$this->operator_id);
		$database->bind(':username',$this->username);
		$database->bind(':password',$this->password);
		$database->bind(':firstname',$this->firstname);
		$database->bind(':lastname',$this->lastname);
		$database->bind(':access_level',$this->access_level);
		$database->bind(':date_creation',date('Y-m-d'));
		$database->execute();
		return $database->lastInsertId();
	}
	
	public function updateUser(){
		global $database;
		$sql  = "UPDATE user ";
		$sql .= "SET operator_id=:operator_id,username=:username,password=:password,firstname=:firstname,lastname=:lastname,access_level=:access_level ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':operator_id',$this->operator_id);
		$database->bind(':username',$this->username);
		$database->bind(':password',$this->password);
		$database->bind(':firstname',$this->firstname);
		$database->bind(':lastname',$this->lastname);
		$database->bind(':access_level',$this->access_level);
		$database->bind(':id',$this->id);
		$database->execute();
	}
	
	public static function find_by_id($id=0) {
		global $database;
		$database->query('SELECT * from user WHERE id = :id');
		$database->bind(':id',$id);
		return $database->single();
  	}
	
	public static function find_duplicate($operator_id=0,$username="") {
		global $database;
		$database->query('SELECT operator_id from user WHERE operator_id = :operator_id OR username = :username');
		$database->bind(':operator_id',$operator_id);
		$database->bind(':username',$username);
		return $database->resultset();
  	}
	
	public static function find_username($username="") {
		global $database;
		$database->query('SELECT id from user WHERE username = :username');
		$database->bind(':username',$username);
		return $database->resultset();
  	}
}
?>