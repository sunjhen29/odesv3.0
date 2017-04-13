<?php
require_once('database.class.php');

class AU_Postcode{
	public $id;
	public $state;
	public $suburb;
	public $post_code;
	
	public static function view() {
		global $database;
		$database->query("SELECT * from aupostcode ORDER BY state,suburb");
		return $database->resultset();
  	}	
	
	public static function search_suburb($suburb="") {
		global $database;
		$sql  = "SELECT * FROM aupostcode ";
		$sql .= "WHERE suburb LIKE :suburb ";
		$sql .= "GROUP BY state,suburb,post_code";
		$database->query($sql);
		$database->bind(':suburb','%'.$suburb.'%');
		return $database->resultset();
  	}
	
	public function add(){
		global $database;
		$sql  = "INSERT INTO aupostcode ";
		$sql .= "(state,suburb,post_code) ";
		$sql .= "VALUES ";
		$sql .= "(:state,:suburb,:post_code) ";
		$database->query($sql);
		$database->bind(':state',$this->state);
		$database->bind(':suburb',$this->suburb);
		$database->bind(':post_code',$this->post_code);
		$database->execute();
		return $database->lastInsertId();
	}
	
	public function update(){
		global $database;
		$sql  = "UPDATE aupostcode ";
		$sql .= "SET state=:state,suburb=:suburb,post_code=:post_code ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':state',$this->state);
		$database->bind(':suburb',$this->suburb);
		$database->bind(':post_code',$this->post_code);
		$database->bind(':id',$this->id);
		$database->execute();
	}
	
	public function delete($id=0){	
		global $database;
		$sql = "DELETE FROM aupostcode WHERE id=:id ";
		$database->query($sql);
		$database->bind(':id',$id);
		$database->execute();
	}
	
	public function save(){
		if ($this->id == 0){
			$this->add();
		} else {
			$this->update();
		}
	}
	
	public static function find_by_id($id=0) {
		global $database;
		$database->query('SELECT * from aupostcode WHERE id = :id');
		$database->bind(':id',$id);
		return $database->single();
  	}
	
	public static function find($street="Riverside Drive",$suburb="Abbey Caves"){
		global $database;
		$database->query('SELECT postcode from nzpostcode WHERE  street = :street AND suburb = :suburb');
		$database->bind(':street',$street);
		$database->bind(':suburb',$suburb);
		return $database->single();
	}
	
	public static function find_au_postcode($state="",$suburb=""){
		global $database;
		$database->query('SELECT post_code from aupostcode WHERE  state = :state AND suburb = :suburb');
		$database->bind(':state',$state);
		$database->bind(':suburb',$suburb);
		return $database->single();
	}
}
?>