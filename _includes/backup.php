<?php
require_once('dbconfig.php');
require_once('database.class.php');

class Backup{
	public $id;
	public $folder;
	public $filename;
	public $backup_date;
	public $time_created;
	public $last_update;
	public $table_name;
	public $database_name;
	
	public function backupdatabase(){
		$command = 'mysqldump -u'.DB_USER.' -p'.DB_PASS.' --result-file=D:'.DS.'databasebackup'.DS.DB_NAME."_".date("Ymd_His").".sql ".DB_NAME;
		self::logbackup();
		system($command);
		return "Back Up Successfull!!";
	}
	
	public function logbackup(){
		global $database;
		$sql  = "INSERT INTO backup ";
		$sql .= "(folder,filename,backup_date) ";
		$sql .= "VALUES ";
		$sql .= "(:folder,:filename,:backup_date) ";
		$database->query($sql);
		$database->bind(':folder','D:'.DS.'databasebackup'.DS);
		$database->bind(':filename',DB_NAME."_".date("Ymd_His"));
		$database->bind(':backup_date',date('Y-m-d'));
		$database->execute();
		return $database->lastInsertId();
	}
	
	public static function view(){
		global $database;
		$sql = "SELECT * FROM backup ORDER BY id ASC";
		$database->query($sql);
		$database->execute();
		return $database->resultset();
	}
}
?>