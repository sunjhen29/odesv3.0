<?php
require_once('database.class.php');

class Publication{
	public $id;
	public $state_country;
	public $pub_name;
	public $pub_display;
	public $source;
	public $issue;
	public $job_number;
	public $status;
	public $site;
	public $date_creation;
	public $time_stamp;
	
	public static function publication_lookup_au($application="",$state_country="") {
		global $database;
		$database->query("SELECT pub_name, pub_display from publication WHERE status=:status and application=:application and state_country=:state_country ORDER BY pub_display");
		$database->bind(':status','ACTIVE');
		$database->bind(':application',$application);
		$database->bind(':state_country',$state_country);
		$result = $database->keypair();
		return $result;
  	}
	public static function publication_lookup($application="") {
		global $database;
		$database->query("SELECT pub_name, pub_display from publication WHERE status=:status and application LIKE :application ORDER BY pub_display");
		$database->bind(':status','ACTIVE');
		$database->bind(':application','%'.$application.'%');
		$result = $database->keypair();
		return $result;
  	}
	
	public static function publication_lookup_with_invalid($application='AU',$state_country='') {
		global $database;
		$database->query("SELECT pub_name, pub_display from publication WHERE state_country=:state_country AND invalid=:invalid ORDER BY pub_display");
		//$database->query("SELECT pub_name, pub_display from publication WHERE state_country=:state_country AND invalid=:invalid AND application LIKE :application ORDER BY pub_display");
		$database->bind(':state_country',$state_country);
		$database->bind(':invalid','Y');
		//$database->bind(':application','%'.$application.'%'); ///2016-09-10 change
		return $database->resultset(); 

  	}
	
	public static function addPublication(){
		global $database;
		$sql = 'SELECT id, pub_name FROM publication';
		$result = $db->query($sql);
		return $result->fetchAll(PDO::FETCH_KEY_PAIR);
	}
	
	public static function getCode($pubname=""){
		global $database;
		$sql = 'SELECT code,job_number FROM publication WHERE pub_name=:pub_name';
		$database->query($sql);
		$database->bind(':pub_name',$pubname);
		return $database->single();
	}	
	
	public static function find_description($pubname=""){
		global $database;
		$sql = 'SELECT job_number FROM publication WHERE pub_name=:pub_name';
		$database->query($sql);
		$database->bind(':pub_name',$pubname);
		return $database->single();
	}
	
	public static function filter_publication_lookup($application="",$filter="") {
		global $database;
		$database->query("SELECT pub_name, pub_display from publication WHERE status=:status and application=:application and state_country LIKE :filter ORDER BY pub_display");
		$database->bind(':status','ACTIVE');
		$database->bind(':application',$application);
		$database->bind(':filter','%'.$filter.'%');
		return $database->resultset(); 
  	}
	
	public static function all_publication_lookup($filter="") {
		global $database;
		$database->query("SELECT pub_name, pub_display from publication WHERE status=:status and state_country LIKE :filter ORDER BY pub_display");
		$database->bind(':status','ACTIVE');
		$database->bind(':filter','%'.$filter.'%');
		return $database->resultset(); 
  	}
	
	public static function view(){
		global $database;
		$sql = "SELECT * FROM publication ORDER BY date_creation DESC";
		$database->query($sql);
		$database->execute();
		return $database->resultset();
	}
	
	public function add(){
		global $database;
		$sql  = "INSERT INTO publication ";
		$sql .= "(state_country,pub_name,pub_display,source,issue,job_number,status,site,date_creation,code,invalid,application) ";
		$sql .= "VALUES ";
		$sql .= "(:state_country,:pub_name,:pub_display,:source,:issue,:job_number,:status,:site,:date_creation,:code,:invalid,:application) ";
		$database->query($sql);
		$database->bind(':state_country',$this->state_country);
		$database->bind(':pub_name',$this->pub_name);
		$database->bind(':pub_display',$this->pub_display);
		$database->bind(':source',$this->source);
		$database->bind(':issue',$this->issue);
		$database->bind(':job_number',$this->job_number);	
		$database->bind(':status',$this->status);
		$database->bind(':site',$this->site);
		$database->bind(':date_creation',date('Y-m-d'));
		$database->bind(':code',$this->code);
		$database->bind(':invalid',$this->invalid);
		$database->bind(':application',$this->application);		
		$database->execute();
		return $database->lastInsertId();
	}
	public function update(){
		global $database;
		$sql  = "UPDATE publication ";
		$sql .= "SET state_country=:state_country,pub_name=:pub_name,pub_display=:pub_display,source=:source,issue=:issue,job_number=:job_number,status=:status,site=:site,code=:code,invalid=:invalid,application=:application ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':state_country',$this->state_country);
		$database->bind(':pub_name',$this->pub_name);
		$database->bind(':pub_display',$this->pub_display);
		$database->bind(':source',$this->source);
		$database->bind(':issue',$this->issue);
		$database->bind(':job_number',$this->job_number);	
		$database->bind(':status',$this->status);
		$database->bind(':site',$this->site);
		$database->bind(':code',$this->code);
		$database->bind(':invalid',$this->invalid);
		$database->bind(':application',$this->application);		
		$database->bind(':id',$this->id);
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
		$database->query('SELECT * from publication WHERE id = :id');
		$database->bind(':id',$id);
		return $database->single();
  	}
	
	public static function find_invalid($state,$pubname) {
		global $database;
		$sql  = ('SELECT invalid from publication ');
		$sql .= ('WHERE state_country=:state_country AND pub_name=:pub_name');
		$database->query($sql);
		$database->bind(':state_country',$state);
		$database->bind(':pub_name',$pubname);
		return $database->single();
  	}
	
	public function delete($id=0){
		global $database;
		$sql = "DELETE FROM publication WHERE id=:id ";
		$database->query($sql);
		$database->bind(':id',$id);
		$database->execute();
	}
	
}
?>