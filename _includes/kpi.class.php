<?php
require_once('database.class.php');

class KPI{
	public $id;
	public $ev;
	public $job_number;
	public $operator;
	public $job_description;
	public $production_date;
	public $hours;
	public $minutes;
	public $records;
	public $timestamp;
	public $reserve1;
	public $reserve2;

	public static function all_job_number($proddate){
		global $database;
		$sql  = "SELECT job_number, job_description,";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours from kpi";
		$sql .= " WHERE production_date=:production_date";
		$sql .= " GROUP BY job_number WITH ROLLUP";
		$database->query($sql);
		$database->bind(':production_date',$proddate);
		return $database->resultset();
	}

	public static function records_per_hour($proddate,$ev,$job_description){
		global $database;
		$sql  = " SELECT operator,job_description,";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours,sum(records) as records, ";
		$sql .= " truncate(sum(records) / truncate((sum(hours*60) + sum(minutes))/60,2),2) as recs_hour from kpi ";
		$sql .= " WHERE production_date=:production_date and ev=:ev AND";
		if(strtoupper($job_description) == 'AUSTRALIA') {
			$sql .= " job_description NOT LIKE :job_description AND job_description NOT IN('RPCONNE','RPMOBILE','GUMTREE') " ;
		} else {
			$sql .= " job_description LIKE :job_description";
		}
		$sql .= " GROUP BY operator WITH ROLLUP";
		$database->query($sql);
		$database->bind(':production_date',$proddate);
		$database->bind(':ev',$ev);
		if(strtoupper($job_description) == 'AUSTRALIA') {
			$database->bind(':job_description', 'SP-H%');
		} elseif (strtoupper($job_description) == 'HISTORICAL'){
			$database->bind(':job_description','SP-H%');
		} else {
			$database->bind(':job_description',$job_description.'%');
		}
		return $database->resultset();
	}

	public static function records_per_job_number($proddate,$ev){
		global $database;
		$sql  = "SELECT GROUP_CONCAT(DISTINCT job_number ORDER BY job_number) as job_number, job_description,";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours,sum(records) as records, ";
		$sql .= " truncate(sum(records) / truncate((sum(hours*60) + sum(minutes))/60,2),2) as recs_hour from kpi ";
		$sql .= " WHERE production_date=:production_date and ev=:ev";
		$sql .= " GROUP BY job_description WITH ROLLUP";
		$database->query($sql);
		$database->bind(':production_date',$proddate);
		$database->bind(':ev',$ev);
		return $database->resultset();
	}

	public static function per_job_number($proddate,$ev){
		global $database;
		$sql  = "SELECT job_number, ";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours,sum(records) as records, ";
		$sql .= " truncate(sum(records) / truncate((sum(hours*60) + sum(minutes))/60,2),2) as recs_hour from kpi ";
		$sql .= " WHERE production_date=:production_date and ev=:ev";
		$sql .= " GROUP BY job_number WITH ROLLUP ";
		$database->query($sql);
		$database->bind(':production_date',$proddate);
		$database->bind(':ev',$ev);
		return $database->resultset();
	}
	
	public static function per_operator($proddate,$ev){
		global $database;
		$sql  = "SELECT operator,job_number, ";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours,sum(records) as records, ";
		$sql .= " truncate(sum(records) / truncate((sum(hours*60) + sum(minutes))/60,2),2) as recs_hour from kpi ";
		$sql .= " WHERE production_date=:production_date and ev=:ev";
		$sql .= " GROUP BY operator ";
		$sql .= " ORDER BY job_number,recs_hour DESC";
		$database->query($sql);
		$database->bind(':production_date',$proddate);
		$database->bind(':ev',$ev);
		return $database->resultset();
	}
	
	public static function productive_hours($proddate){
		global $database;
		$sql  = " SELECT * FROM (SELECT operator, ";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours from kpi ";
		$sql .= " WHERE production_date=:production_date";
		$sql .= " GROUP BY operator WITH ROLLUP) t ORDER BY hours";
		//$sql .= " ORDER BY hours DESC ";
		$database->query($sql);
		$database->bind(':production_date',$proddate);
		return $database->resultset();
	}
	
	public static function all_records($proddate){
		global $database;
		$production_date = DateTime::createFromFormat('d/m/Y',$proddate);
		$sql  = "SELECT id,ev,job_number,operator,substr(job_description,1,3) as job,job_description, production_date, ";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours,sum(records) as records, ";
		$sql .= " truncate(sum(records) / truncate((sum(hours*60) + sum(minutes))/60,2),2) as recs_hour from kpi ";
		$sql .= " WHERE production_date=:production_date ";
		//$sql .= " GROUP BY operator, ev, substr(job_description,1,3) ";
		$sql .= " GROUP BY operator ";
		$sql .= " ORDER BY operator";
		$database->query($sql);
		$database->bind(':production_date',$proddate);
		return $database->resultset();
	}
	
	public static function view_records($optr,$proddate){
		global $database;
		$production_date = DateTime::createFromFormat('d/m/Y',$proddate);
		$sql  = "SELECT id,ev,job_number,operator,substr(job_description,1,3) as job,job_description, production_date, ";
		$sql .= " truncate((sum(hours*60) + sum(minutes))/60,2) as hours,sum(records) as records, ";
		$sql .= " truncate(sum(records) / truncate((sum(hours*60) + sum(minutes))/60,2),2) as recs_hour from kpi ";
		$sql .= " WHERE operator=:operator AND production_date=:production_date ";
		$sql .= " GROUP BY operator, ev, substr(job_description,1,3) ";
		$sql .= " ORDER BY operator";
		$database->query($sql);
		$database->bind(':operator',$optr);
		$database->bind(':production_date',$proddate);
		return $database->resultset();
	}
	
	public function addKPI(){
		global $database;
		$sql  = "INSERT INTO kpi ";
		$sql .= "(ev,job_number,operator,job_description,production_date,hours,minutes,records) ";
		$sql .= "VALUES ";
		$sql .= "(:ev,:job_number,:operator,:job_description,:production_date,:hours,:minutes,:records) ";
		$database->query($sql);
		$database->bind(':ev',$this->ev);
		$database->bind(':job_number',$this->job_number);
		$database->bind(':operator',$this->operator);
		$database->bind(':job_description',$this->job_description);
		$database->bind(':production_date',$this->production_date);
		$database->bind(':hours',$this->hours);
		$database->bind(':minutes',$this->minutes);
		$database->bind(':records',$this->records);
		$database->execute();
		return $database->lastInsertId();
	}
	
	
	
}

?>