<?php
require_once('database.class.php');

class Active{
	public $id;
	public $operator_id;
	public $action;
	public $application;
	public $timestamp;
	
	public static function view() {
		global $database;
		$database->query("SELECT * from onlineuser ORDER BY timestamp,action,operator_id");
		return $database->resultset();
  	}	
	
	public static function log($optr,$app,$action){
		global $database;
		$sql  = "INSERT INTO onlineuser ";
		$sql .= "(operator_id,action,application,timestamp) ";
		$sql .= "VALUES ";
		$sql .= "(:operator_id,:action,:application,:timestamp) ";
		$database->query($sql);
		$database->bind(':operator_id',$optr);
		$database->bind(':action',$action);
		$database->bind(':timestamp',date('Y-m-d H:i:s'));
		$database->bind(':application',$app);
		$database->execute();
		return $database->lastInsertId();
	}
}
?>