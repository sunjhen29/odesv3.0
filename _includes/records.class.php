<?php
require_once('database.class.php');

class Records{
	public $id;
	public $production_date;
	public $records;
	public $timestamp;
	public $au;
	public $nz;
	public $inv;
		
	public static function view() {
		global $database;
		$database->query("SELECT * from daily ORDER BY production_date");
		return $database->resultset();
  	}
		
	public function add(){
		global $database;
		$sql  = "INSERT INTO daily ";
		$sql .= "(production_date,nz,au,inv) ";
		$sql .= "VALUES ";
		$sql .= "(:production_date,:nz,:au,:inv) ";
		$database->query($sql);
		$database->bind(':production_date',$this->production_date);
		$database->bind(':nz',$this->nz);
		$database->bind(':au',$this->au);
		$database->bind(':inv',$this->inv);
		$database->execute();
		return $database->lastInsertId();
	}
	
	public function update(){
		global $database;
		$sql  = "UPDATE daily ";
		$sql .= "SET production_date=:production_date,nz=:nz,au=:au,inv=:inv ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':production_date',$this->production_date);
		$database->bind(':nz',$this->nz);
		$database->bind(':au',$this->au);
		$database->bind(':inv',$this->inv);
		$database->bind(':id',$this->id);
		$database->execute();
	}
	
	public function delete($id=0){	
		global $database;
		$sql = "DELETE FROM daily WHERE id=:id ";
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
		$database->query('SELECT * from daily WHERE id = :id');
		$database->bind(':id',$id);
		return $database->single();
  	}
	
	public static function nz_graph() {
		global $database;
		$sql  = "SELECT DATE_FORMAT(production_date,'%d') as production_date,nz ";
		$sql .= "FROM daily ";
		$sql .= "WHERE MONTH(production_date) = MONTH(CURDATE()) AND YEAR(production_date)=YEAR(CURDATE()) ";
		$sql .= "ORDER BY production_date ";
		$database->query($sql);
		return $database->keypair();
  	}
	
	public static function au_graph() {
		global $database;
		$sql  = "SELECT DATE_FORMAT(production_date,'%d') as production_date,au ";
		$sql .= "FROM daily ";
		$sql .= "WHERE MONTH(production_date) = MONTH(CURDATE()) AND YEAR(production_date)=YEAR(CURDATE()) ";
		$sql .= "ORDER BY production_date ";
		$database->query($sql);
		return $database->keypair();
  	}
}
?>