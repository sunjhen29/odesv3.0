<?php
require_once('database.class.php');

class JobNumber{
	public $id;
	public $job_number;
	public $description;
	public $sale_rent;
	public $current_month;
	public $publication_date;
	public $date_creation;
	public $time_stamp;
	
	public static function find_job_number($desc="",$sr="",$pubdate=""){
		global $database;
		$database->query("SELECT  job_number from job_number WHERE description=:description AND sale_rent=:sale_rent AND current_month=:current_month AND publication_date=:publication_date");
		$database->bind(':description',$desc);
		$database->bind(':sale_rent',$sr);
		$database->bind(':current_month',date('MY'));
		$database->bind(':publication_date',$pubdate);
		return $database->single();
	}
	
	public static function find_all(){
		global $database;
		$database->query("SELECT id,job_number,description,sale_rent, current_month, publication_date  from job_number");
		return $database->resultset();
	}
	
	public static function stats_output_description($production_date) {
		$current_month = DateTime::createFromFormat('d/m/Y',$production_date);
		global $database;
		$database->query("SELECT job_number,stats_output from job_number WHERE current_month=:current_month");
		$database->bind(':current_month',$current_month->format('MY'));
		$result = $database->keypair();
		return $result;
  	}
	
	public static function view(){
		global $database;
		$database->query("SELECT * from job_number ORDER BY date_creation DESC");
		return $database->resultset();
	}
	
	public static function current(){
		global $database;
		$database->query("SELECT * from job_number WHERE current_month = :current_month ORDER BY date_creation ASC");
		$database->bind(':current_month',date('MY'));
		return $database->resultset();
	}
	
	public function add(){
		global $database;
		$sql  = "INSERT INTO job_number ";
		$sql .= "(job_number,description,sale_rent,current_month,publication_date,stats_output,date_creation) ";
		$sql .= "VALUES ";
		$sql .= "(:job_number,:description,:sale_rent,:current_month,:publication_date,:stats_output,:date_creation) ";
		$database->query($sql);
		$database->bind(':job_number',$this->job_number);
		$database->bind(':description',$this->description);
		$database->bind(':sale_rent',$this->sale_rent);
		$database->bind(':current_month',$this->current_month);
		$database->bind(':publication_date',$this->publication_date);
		$database->bind(':stats_output',$this->stats_output);
		$database->bind(':date_creation',date('Y-m-d'));
		$database->execute();
		return $database->lastInsertId();
	}
	
	public function save(){
		if ($this->id == 0){
			$this->add();
		} else {
			$this->update();
		}
	}
	
	public function delete($id=0){
		global $database;
		$sql = "DELETE FROM job_number WHERE id=:id ";
		$database->query($sql);
		$database->bind(':id',$id);
		$database->execute();
	}
	
	public static function find_by_id($id=0) {
		global $database;
		$database->query('SELECT * from job_number WHERE id = :id');
		$database->bind(':id',$id);
		return $database->single();
  	}
	
	public function update(){
		global $database;
		$sql  = "UPDATE job_number ";
		$sql .= "SET job_number=:job_number,description=:description,sale_rent=:sale_rent,current_month=:current_month,publication_date=:publication_date,stats_output=:stats_output ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':job_number',$this->job_number);
		$database->bind(':description',$this->description);
		$database->bind(':sale_rent',$this->sale_rent);
		$database->bind(':current_month',$this->current_month);
		$database->bind(':publication_date',$this->publication_date);
		$database->bind(':stats_output',$this->stats_output);
		$database->bind(':id',$this->id);
		$database->execute();
	}
}
?>