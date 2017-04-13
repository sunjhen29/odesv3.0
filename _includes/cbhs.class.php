<?php
require_once('database.class.php');

class Cbhs{
	public $id;
	public $batch_id;
	public $membershipId;
	public $identifier;
	public $exportfilename;
	public $claimstatus;
	public $pagecount;
	public $patientName;
	public $dateofbirth;
	public $providerNumber;
	public $serviceType;
	public $itemNumber;
	public $dateofservice;
	public $accountPaid;

	public static function find_by_batch($id=0)
	{
		global $database;
		$sql  = "SELECT * FROM cbhs";
		$sql .= " WHERE batch_id = :batch_id";
		$database->query($sql);
		$database->bind(':batch_id',$id);
		$database->execute();
		return $database->resultset();
	}

	public static function get_filename($id=0)
	{
		global $database;
		$sql  = "SELECT exportfilename FROM cbhs";
		$sql .= " WHERE batch_id = :batch_id";
		$database->query($sql);
		$database->bind(':batch_id',$id);
		$database->execute();
		return $database->single();
	}

	public static function group_by_batch($id=0)
	{
		global $database;
		$sql  = "SELECT exportfilename FROM cbhs";
		$sql .= " WHERE batch_id = :batch_id";
		$sql .= " GROUP BY exportfilename";
		$database->query($sql);
		$database->bind(':batch_id',$id);
		$database->execute();
		return $database->resultset();
	}

	public static function view_batches($id=0)
	{
		global $database;
		$sql  = "SELECT batch_id, membershipId, identifier, exportfilename, claimstatus, pagecount FROM cbhs";
		$sql .= " WHERE batch_id >= :batch_id";
		$sql .= " GROUP BY exportfilename";
		$database->query($sql);
		$database->bind(':batch_id',$id);
		$database->execute();
		return $database->resultset();
	}

	public static function find_by_exportfilename($exportfilename="",$batch_id=0)
	{
		global $database;
		$sql  = "SELECT * FROM cbhs";
		$sql .= " WHERE exportfilename = :exportfilename";
		$sql .= " AND batch_id=:batch_id";
		$database->query($sql);
		$database->bind(':exportfilename',$exportfilename);
		$database->bind(':batch_id',$batch_id);
		$database->execute();
		return $database->resultset();
	}

	public function insert_cbhs(){
		global $database;
		$sql  = "INSERT INTO cbhs ";
		$sql .= "(batch_id,membershipId,identifier,exportfilename,claimstatus,pagecount,patientName,dateofbirth,providerNumber,serviceType,itemNumber,dateofservice,accountPaid,fee) ";
		$sql .= "VALUES ";
		$sql .= "(:batch_id,:membershipId,:identifier,:exportfilename,:claimstatus,:pagecount,:patientName,:dateofbirth,:providerNumber,:serviceType,:itemNumber,:dateofservice,:accountPaid,:fee) ";
		$database->query($sql);
		$database->bind(':batch_id',$this->batch_id);
		$database->bind(':membershipId',$this->membershipId);
		$database->bind(':identifier',$this->identifier);
		$database->bind(':exportfilename',$this->exportfilename);
		$database->bind(':claimstatus',$this->claimstatus);
		$database->bind(':pagecount',$this->pagecount);
		$database->bind(':patientName',$this->patientName);
		$database->bind(':dateofbirth',$this->dateofbirth);
		$database->bind(':providerNumber',$this->providerNumber);
		$database->bind(':serviceType',$this->serviceType);
		$database->bind(':itemNumber',$this->itemNumber);
		$database->bind(':dateofservice',$this->dateofservice);
		$database->bind(':accountPaid',$this->accountPaid);
		$database->bind(':fee',$this->fee);
		$database->execute();
		return $database->lastInsertId();
	}
}
?>