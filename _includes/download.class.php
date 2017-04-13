<?php
require_once('database.class.php');

class Download{
	public $id;
	public $state;
	public $publication_name;
	public $publication_date;
	public $pages;
	public $remarks;
	public $status;
	public $sale;
	public $rent;
	public $start;
	public $end;
	public $download_id;
	public $date_creation;
	public $date_export;
	public $time_stamp;
	public $code;
	public $job_number;
	
	public static function compare_records($state,$pubname){
		global $database;
		$sql  = "SELECT id,State,Publication_Name,DATE_FORMAT(Publication_Date,'%d/%m/%y') as Publication_Date,Pages,Remarks,Status,Sale,Rent,Start,End,DATE_FORMAT(Date_Export,'%d/%m/%Y') as Date_Export,Date_Creation,Download_Id,Code,Job_Number FROM download ";
		$sql .= "WHERE state=:state AND Publication_Name=:pubname ";
		$sql .= "ORDER BY id DESC limit 50";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':pubname',$pubname);
		$database->execute();
		return $database->resultset();
	}
	
	public static function bypublication($state,$pubname,$pubdate1="",$pubdate2=""){
		global $database;
		$publication_date1 = DateTime::createFromFormat('d/m/Y',$pubdate1);
		$publication_date2 = DateTime::createFromFormat('d/m/Y',$pubdate2);
		$sql  = "SELECT id,State,Publication_Name,DATE_FORMAT(Publication_Date,'%d/%m/%y') as Publication_Date,Pages,Remarks,Status,Sale,Rent,Start,End,DATE_FORMAT(Date_Export,'%d/%m/%Y') as Date_Export,Date_Creation,Download_Id,Code,Job_Number FROM download ";
		$sql .= "WHERE state=:state AND Publication_Name=:pubname AND Publication_Date BETWEEN :publicationdate1 AND :publicationdate2 ";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':pubname',$pubname);
		$database->bind(':publicationdate1',$publication_date1->format('Y-m-d'));
		$database->bind(':publicationdate2',$publication_date2->format('Y-m-d'));
		$database->execute();
		return $database->resultset();
	}
	
	public static function report_by_export_date($exp_date1="",$exp_date2=""){
		global $database;
		$export_date1 = DateTime::createFromFormat('d/m/Y',$exp_date1);
		$export_date2 = DateTime::createFromFormat('d/m/Y',$exp_date2);
		$sql  = "SELECT id,State,Publication_Name,DATE_FORMAT(Publication_Date,'%d/%m/%y') as Publication_Date,Pages,Remarks,Status,Sale,Rent,Start,End,DATE_FORMAT(Date_Export,'%d/%m/%Y') as Date_Export,Date_Creation,Download_Id,Code,Job_Number FROM download ";
		$sql .= "WHERE DATE_FORMAT(date_export,'%Y-%m-%d') BETWEEN :export_date1 AND :export_date2 ";
		$sql .= "ORDER BY date_export,start";
		$database->query($sql);
		$database->bind(':export_date1',$export_date1->format('Y-m-d'));
		$database->bind(':export_date2',$export_date2->format('Y-m-d'));
		$database->execute();
		return $database->resultset();
	}
	
	public static function authenticate($state="",$publication_name="",$publication_date="",$code=""){
		global $database;
		$pubcode = substr($code,0,3);
		$pubdate = DateTime::createFromFormat('d/m/Y',$publication_date);
		$database->query('SELECT state,publication_name,publication_date,job_number from download WHERE state=:state AND publication_name = :publication_name AND publication_date = :publication_date AND status=:status AND code=:code' );
		$database->bind('state',$state);
		$database->bind(':publication_name',$publication_name);
		$database->bind(':publication_date',$pubdate->format('Y-m-d'));
		$database->bind(':code',$pubcode);
		$database->bind(':status','OPEN');
		return $database->single();
	}
	
	public static function find_duplicate($state="",$publication_name="",$publication_date=""){
		global $database;
		$pubdate = DateTime::createFromFormat('d/m/Y',$publication_date);
		$database->query('SELECT state,publication_name,publication_date from download WHERE state=:state AND publication_name = :publication_name AND publication_date = :publication_date' );
		$database->bind('state',$state);
		$database->bind(':publication_name',$publication_name);
		$database->bind(':publication_date',$pubdate->format('Y-m-d'));
		return $database->single();
	}
	
	public function add_download(){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$this->publication_date);
		$sql  = "INSERT INTO download ";
		$sql .= "(state,publication_name,publication_date,pages,remarks,status,date_creation,download_id,code,job_number) ";
		$sql .= "VALUES ";
		$sql .= "(:state,:publication_name,:publication_date,:pages,:remarks,:status,:date_creation,:download_id,:code,:job_number)";
		$database->query($sql);
		$database->bind(':state',$this->state);
		$database->bind(':publication_name',$this->publication_name);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		$database->bind(':pages',$this->pages);
		$database->bind(':remarks',$this->remarks);
		$database->bind(':status',$this->status);
		$database->bind(':date_creation',date('Y-m-d'));
		$database->bind(':download_id',$this->download_id);
		$database->bind(':code',$this->code);
		$database->bind(':job_number',$this->job_number);
		$database->execute();
	}
	
	public static function view(){
		global $database;
		$sql = "SELECT * FROM download ORDER BY id DESC";
		$database->query($sql);
		$database->execute();
		return $database->resultset();
	}
	
	public static function view_download($status="",$state="",$pubname="",$pubdate=""){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT id,State,Publication_Name,DATE_FORMAT(Publication_Date,'%d/%m/%y') as Publication_Date,Pages,Remarks,Status,Sale,Rent,Start,End,DATE_FORMAT(Date_Export,'%d/%m/%Y') as Date_Export,Date_Creation,Download_Id,Code,Job_Number FROM download ";
		$sql .= "WHERE Status LIKE :Status AND State LIKE :State AND Publication_Name LIKE :Publication_Name ";
		if ($pubdate != ""){
			$sql .= "AND Publication_Date=:Publication_Date ";
		}
		$database->query($sql);
		$database->bind(':Status','%'.$status.'%');
		$database->bind(':State','%'.$state.'%');
		$database->bind(':Publication_Name','%'.$pubname.'%');
		if ($pubdate != ""){
			$database->bind(':Publication_Date',$publication_date->format('Y-m-d'));
		}
		$database->execute();
		return $database->resultset();
	}
	
	public static function delete_download($status="",$state="",$pubname="",$pubdate=""){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT id,State,Publication_Name,Publication_Date,Pages,Remarks,Status,Sale,Rent,Start,End, ";
		$sql .= "Date_Export,Date_Creation,Download_Id,Code,Job_Number,Date_Removed,DATEDIFF(CURDATE(),Date_Creation) as Days, Date_Backup FROM download ";
		$sql .= "WHERE Status LIKE :Status AND State LIKE :State AND Publication_Name LIKE :Publication_Name ";
		if ($pubdate != ""){
			$sql .= "AND Publication_Date=:Publication_Date ";
		}
		$database->query($sql);
		$database->bind(':Status','%'.$status.'%');
		$database->bind(':State','%'.$state.'%');
		$database->bind(':Publication_Name','%'.$pubname.'%');
		if ($pubdate != ""){
			$database->bind(':Publication_Date',$publication_date->format('Y-m-d'));
		}
		$database->execute();
		return $database->resultset();
	}
	
	public static function delete($id=0){
		global $database;
		$sql = "DELETE FROM download WHERE id=:id ";
		$database->query($sql);
		$database->bind(':id',$id);
		$database->execute();
	}
	
	public static function find_by_id($id=0){
		global $database;
		$sql = "SELECT State,Publication_Name,DATE_FORMAT(Publication_Date,'%d/%m/%Y') as Publication_Date,Pages,Remarks, Status,Code,Job_Number FROM download WHERE id=:id ";
		$database->query($sql);
		$database->bind(':id',$id);
		return $database->single();
	}
	
	public static function find_id($state='',$pubname='',$pubdate=''){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT id from download ";
		$sql .= "WHERE state=:state AND publication_name=:publication_name AND publication_date=:publication_date";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		return $database->single();
	}
	
	public function update(){
		global $database;
		$export_date = DateTime::createFromFormat('d/m/Y',$this->export_date);
		$sql  = "UPDATE download ";
		$sql .= "SET status=:status,sale=:sale,rent=:rent,start=:start,end=:end,date_export=:date_export ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':status',$this->status);
		$database->bind(':sale',$this->sale);
		$database->bind(':rent',$this->rent);
		$database->bind(':start',$this->start);
		$database->bind(':end',$this->end);
		$database->bind(':date_export',$export_date->format('Y-m-d H:i:s'));
		$database->bind(':id',$this->id);
		$database->execute();
	}
	
	public static function backup($id=0){
		global $database;
		$sql  = "UPDATE download ";
		$sql .= "SET date_backup=:date_backup ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':date_backup',date('Y-m-d'));
		$database->bind(':id',$id);
		$database->execute();
	}
	
	public function close(){
		global $database;
		$sql  = "UPDATE download ";
		$sql .= "SET status=:status,sale=:sale,rent=:rent,start=:start,end=:end,date_export=:date_export ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':status',$this->status);
		$database->bind(':sale',$this->sale);
		$database->bind(':rent',$this->rent);
		$database->bind(':start',$this->start);
		$database->bind(':end',$this->end);
		$database->bind(':date_export',date('Y-m-d H:i:s'));
		$database->bind(':id',$this->id);
		$database->execute();
	}
	
	
	public function removed($id=0){
		global $database;
		$sql  = "UPDATE download ";
		$sql .= "SET date_removed=:date_removed, status=:status ";
		$sql .= "WHERE id=:id";
		$database->query($sql);
		$database->bind(':status','REMOVED');
		$database->bind(':date_removed',date('Y-m-d'));
		$database->bind(':id',$id);
		$database->execute();
	}
	
	public function update_details(){
		global $database;
		$pubdate = DateTime::createFromFormat('d/m/Y',$this->publication_date);
		$sql  = "UPDATE download ";
		$sql .= "SET state=:state,publication_name=:publication_name,publication_date=:publication_date,pages=:pages,remarks=:remarks,status=:status,code=:code,job_number=:job_number ";
		$sql .= "WHERE id=:id ";
		$database->query($sql);
		$database->bind(':state',$this->state);
		$database->bind(':publication_name',$this->publication_name);
		$database->bind(':publication_date',$pubdate->format('Y-m-d'));
		$database->bind(':pages',$this->pages);
		$database->bind(':remarks',$this->remarks);
		$database->bind(':status',$this->status);
		$database->bind(':code',$this->code);
		$database->bind(':job_number',$this->job_number);
		$database->bind(':id',$this->id);
		$database->execute();
	}
	
	public static function maxsequence($state='NZ'){
		global $database;
		$sql  = "SELECT max(End) as end from download ";
		$sql .= "WHERE state!=:state ";
		$database->query($sql);
		$database->bind(':state',$state);
		$result = $database->single();
		return $result['end'];
	}
}
?>