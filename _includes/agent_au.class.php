<?php
require_once('database.class.php');

class Agent_Australia{
	public $id;
	public $au_id;
	public $agency_name;
	public $agent_firstname;
	public $agent_surname;
	public $agent_contact;
	public $state;
	public $publication_name;
	public $publication_date;
	
	public function addAgent(){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$this->publication_date);
		$sql  = "INSERT INTO agents_au ";
		$sql .= "(au_id,agency_name,agent_firstname,agent_surname,agent_contact,publication_name,publication_date,state) ";
		$sql .= "VALUES ";
		$sql .= "(:au_id,:agency_name,:agent_firstname,:agent_surname,:agent_contact,:publication_name,:publication_date,:state) ";
		$database->query($sql);
		$database->bind(':au_id',$this->au_id);
		$database->bind(':agency_name',$this->agency_name);
		$database->bind(':agent_firstname',$this->agent_firstname);
		$database->bind(':agent_surname',$this->agent_surname);
		$database->bind(':agent_contact',$this->agent_contact);
		$database->bind(':publication_name',$this->publication_name);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		$database->bind(':state',$this->state);
		$database->execute();
		return $database->lastinsertid();
	}
	public function updateAgent(){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$this->publication_date);
		$sql  = "UPDATE agents_au ";
		$sql .= "SET au_id=:au_id,agency_name=:agency_name,agent_firstname=:agent_firstname,agent_surname=:agent_surname,agent_contact=:agent_contact,publication_name=:publication_name,publication_date=:publication_date,state=:state ";
		$sql .= "WHERE id=:id";
		$database->query($sql);
		$database->bind(':id',$this->id);
		$database->bind(':au_id',$this->au_id);
		$database->bind(':agency_name',$this->agency_name);
		$database->bind(':agent_firstname',$this->agent_firstname);
		$database->bind(':agent_surname',$this->agent_surname);
		$database->bind(':agent_contact',$this->agent_contact);
		$database->bind(':publication_name',$this->publication_name);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		$database->bind(':state',$this->state);
		$database->execute();
	}
	public function save(){
		if ($this->id == 0){
			$this->addAgent();
		} else {
			$this->updateAgent();
		} 
	}
	public static function delete($id){
		global $database;
		$sql = "DELETE FROM agents_au ";
		$sql .= "WHERE id = :id";
		$database->query($sql);
		$database->bind(':id',$id);
		$database->execute();
	}
	public static function delete_by_nzid($au_id){
		global $database;
		$sql = "DELETE FROM agents_au ";
		$sql .= "WHERE au_id = :au_id";
		$database->query($sql);
		$database->bind(':au_id',$au_id);
		$database->execute();
	}
	
	public static function find_by_record_id($record_id){
		global $database;
		$sql  = "SELECT * FROM agents_au WHERE au_id = :record_id ORDER BY id";
		$database->query($sql);
		$database->bind(':record_id',$record_id);
		return $database->resultset();
	}
	
	public static function find_agent($agent_contact="",$pubname){
		global $database;
		$sql  = "SELECT  id, agency_name,agent_firstname,agent_surname,agent_contact,publication_name,publication_date,state FROM agents_au ";
		$sql .= "WHERE agent_contact = :agent_contact and publication_name=:publication_name ";
		$sql .= "ORDER BY id DESC LIMIT 1";
		$database->query($sql);
		$database->bind(':agent_contact',$agent_contact);
		$database->bind(':publication_name',$pubname);
		return $database->single();
	}
	public static function delete_agents($state="",$pubname="",$pubdate=""){
		global $database;
		$sql = "DELETE FROM agents_au ";
		$sql .= "WHERE state=:state AND publication_name=:publication_name AND publication_date=:publication_date";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$pubdate);
		$database->execute();
	}
	
	public static function backup($state="",$pubname="",$pubdate=""){
		global $database;
		$sql  = "SELECT * FROM agents_au ";
		$sql .= "WHERE state=:state and publication_name=:publication_name and publication_date=:publication_date ";
		$database->query($sql);
		$database->bind('state',$state);
		$database->bind('publication_name',$pubname);
		$database->bind('publication_date',$pubdate);
		return $database->resultset();		
	}
	
	
	public function get_columns(){
		global $database;
		$sql = "SHOW COLUMNS FROM agents_au";
		$database->query($sql);
		return $database->resultset();
	}
}
?>