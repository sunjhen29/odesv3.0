<?php
require_once('database.class.php');

class Reports{
	public static function cost_analysis($staff_id,$proddate1,$proddate2){
		global $database;
		$production_date1 = DateTime::createFromFormat('d/m/Y',$proddate1);
		$production_date2 = DateTime::createFromFormat('d/m/Y',$proddate2);
		$query  = " SELECT entry_id,job,sum(entry_records),sum(total_time) from (";
		$query .= " SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM au";
		$query .= " WHERE entry_id=:staff_id and data_entry_date BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job ";
		$query .= " UNION ";
		$query .= " SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM au";
		$query .= " WHERE verify_id=:staff_id and date_creation BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job";
		$query .= " UNION ";
		$query .= " SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM invalid";
		$query .= " WHERE entry_id=:staff_id and data_entry_date BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job";
		$query .= " UNION ";
		$query .= " SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM nz";
		$query .= " WHERE entry_id=:staff_id and data_entry_date BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job";
		$query .= " UNION ";
		$query .= " SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM nz";
		$query .= " WHERE verify_id=:staff_id and date_creation BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job) as tblCombined";
		$query .= " GROUP BY job ORDER BY job";
		$database->query($query);
		$database->bind(':staff_id',$staff_id);
		$database->bind(':production_date1',$production_date1->format('Y-m-d'));
		$database->bind(':production_date2',$production_date2->format('Y-m-d'));
		return $database->resultset();
	}
	
	public static function cost_analysis_all($proddate1='01/01/2016',$proddate2='31/01/2016'){
		global $database;
		$production_date1 = DateTime::createFromFormat('d/m/Y',$proddate1);
		$production_date2 = DateTime::createFromFormat('d/m/Y',$proddate2);
		$query  = " SELECT job,sum(entry_records),sum(total_time) from (";
		$query .= " SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM au";
		$query .= " WHERE data_entry_date BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job ";
		$query .= " UNION ";
		$query .= " SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM au";
		$query .= " WHERE date_creation BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job";
		$query .= " UNION ";
		$query .= " SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM invalid";
		$query .= " WHERE data_entry_date BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job";
		$query .= " UNION ";
		$query .= " SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM nz";
		$query .= " WHERE ata_entry_date BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job";
		$query .= " UNION ";
		$query .= " SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM nz";
		$query .= " WHERE date_creation BETWEEN :production_date1 AND :production_date2";
		$query .= " GROUP BY job) as tblCombined";
		$query .= " GROUP BY job ORDER BY job";
		$database->query($query);
		$database->bind(':production_date1',$production_date1->format('Y-m-d'));
		$database->bind(':production_date2',$production_date2->format('Y-m-d'));
		return $database->resultset();
	}
}
?>