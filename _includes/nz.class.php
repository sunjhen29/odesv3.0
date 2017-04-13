<?php
require_once('database.class.php');

class NewZealand{
	public $id;
	public $sequence_no;
	public $state;
	public $publication_name;
	public $publication_date;
	public $unit_no;
	public $street_no;
	public $street_no_suffix;
	public $street_name;
	public $street_extension;
	public $suburb;
	public $city;
	public $property_type;
	public $listing_type;
	public $price_from;
	public $price_to;
	public $price_description;
	public $rental_period;
	public $auction_date;
	public $auction_time;
	public $auction_location;
	public $water_frontage;
	public $scenic_view;
	public $air_conditioned;
	public $heritage_other;
	public $lift_installed;
	public $access_security;
	public $close_to_public;
	public $vendor_will_trade;
	public $permanent_water;
	public $mains_electricity;
	public $river_frontage;
	public $coast_frontage;
	public $canal_frontage;
	public $lake_frontage;
	public $sealed_roads;
	public $open_plan;
	public $fireplace;
	public $polished_floors;
	public $swimming_pool;
	public $renovated;
	public $double_storey;
	public $ducted_heating;
	public $granny_flat;
	public $selling_off;
	public $boat_ramp;
	public $ducted_vaccuum;
	public $town_water;
	public $town_sewerage;
	public $curb_chanelling;
	public $all_weather_access;
	public $land_subject;
	public $phone_service;
	public $land_can_be;
	public $trees_on_land;
	public $bedrooms;
	public $m2_total_floor;
	public $land_area;
	public $land_area_metric;
	public $ensuites;
	public $toilets;
	public $dining_rooms;
	public $lounge_dining;
	public $other_rooms;
	public $lockup_garages;
	public $year_built;
	public $floor_level;
	public $no_of_floor;
	public $bathrooms;
	public $lounge_rooms;
	public $no_of_study;
	public $no_of_tennis;
	public $family_rumpus;
	public $car_spaces;
	public $year_building;
	public $total_floors;
	public $construction_type;
	public $materials_in_roof;
	public $type_of_scenic;
	public $ad_size;
	public $ad_photo_type;
	public $ad_photo_count;
	public $ad_section;
	public $ad_exclusive;
	public $additional_property;
	public $data_entry_date;
	public $rp_property_id;
	public $rp_account_id;
	public $rp_personalized_id;
	public $page_no;
	public $batch_id;
	public $street_direction;
	public $sale_rent;
	public $entry_id;
	public $verify_id;
	public $entry_time;
	public $verify_time;
	public $date_creation;
	public $time_stamp;
	
	public static function all_recordsperhour($proddate1,$proddate2){
		global $database;
		$production_date1 = DateTime::createFromFormat('d/m/Y',$proddate1);
		$production_date2 = DateTime::createFromFormat('d/m/Y',$proddate2);
		$sql  = "SELECT job,sum(entry_records) as entry_records,entry_id,sec_to_time(sum(total_time)) as total_time, ";
		$sql .= "round(sum(entry_records)/(hour(sec_to_time(sum(total_time))) + (minute(sec_to_time(sum(total_time)))/60) + (second(sec_to_time(sum(total_time)))/3600)),2)  as records_per_hour, ";
		$sql .= "hour(sec_to_time(sum(total_time))) + (minute(sec_to_time(sum(total_time)))/60) + (second(sec_to_time(sum(total_time)))/3600)  as dectime FROM(";
		$sql .= "SELECT 'ENTRY' as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date, data_entry_date,sum(entry_time) as total_time FROM nz ";
		$sql .= "WHERE data_entry_date BETWEEN :data_entry_date1 AND :data_entry_date2 ";
		$sql .= "GROUP BY data_entry_date,entry_id ";
		$sql .= "UNION ";
		$sql .= "SELECT 'VERIFY' as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM nz ";
		$sql .= "WHERE date_creation BETWEEN :date_creation1 AND :date_creation2 ";
		$sql .= "GROUP BY date_creation,verify_id ";
		$sql .= ")t GROUP BY job,entry_id";
		$database->query($sql);
		$database->bind(':data_entry_date1',$production_date1->format('Y-m-d'));
		$database->bind(':data_entry_date2',$production_date2->format('Y-m-d'));
		$database->bind(':date_creation1',$production_date1->format('Y-m-d'));
		$database->bind(':date_creation2',$production_date2->format('Y-m-d'));
		return $database->resultset();
	}
		
	public static function export_records($state,$pubname,$pubdate){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT id as sequence,'P' as pc,state,publication_name,DATE_FORMAT(publication_date,'%d/%m/%Y') as publication_date,unit_no,street_no,street_no_suffix,street_name,concat(street_extension,' ',street_direction) as street_extension, ";//1-10
		$sql .= "suburb,city,property_type,listing_type,price_from,price_to,price_description,rental_period,DATE_FORMAT(auction_date,'%d/%m/%Y') as auction_date,auction_time, ";//11-20
		$sql .= "auction_location,water_frontage,scenic_view,air_conditioned,heritage_other,lift_installed,access_security,close_to_public,vendor_will_trade,permanent_water, ";//21-30
		$sql .= "mains_electricity,river_frontage,coast_frontage,canal_frontage,lake_frontage,sealed_roads,open_plan,fireplace,polished_floors,swimming_pool, "; //31-40
		$sql .= "renovated,double_storey,ducted_heating,granny_flat,selling_off,boat_ramp,ducted_vaccuum,town_water,town_sewerage,curb_chanelling, "; //50
		$sql .= "all_weather_access,land_subject,phone_service,land_can_be,trees_on_land,bedrooms,m2_total_floor,land_area,land_area_metric,ensuites, "; //60
		$sql .= "toilets,dining_rooms,lounge_dining,other_rooms,lockup_garages,year_built,floor_level,no_of_floor,bathrooms,lounge_rooms, ";//70
		$sql .= "no_of_study,no_of_tennis,family_rumpus,car_spaces,year_building,total_floors,construction_type,materials_in_roof,type_of_scenic,ad_size, "; //80
		$sql .= "ad_photo_type,ad_photo_count,ad_section,ad_exclusive,additional_property,DATE_FORMAT(data_entry_date,'%d/%m/%Y') as data_entry_date ";
		$sql .= "from nz WHERE state=:state AND publication_name=:publication_name AND publication_date=:publication_date ";
		$sql .= "UNION ";
		$sql .= "SELECT nz_id as sequence,'C' as pc,agency_name,agent_firstname,agent_surname,agent_contact,'','','','', ";
		$sql .= "'','','','','','','','','','', ";//20
		$sql .= "'','','','','','','','','','', ";//30
		$sql .= "'','','','','','','','','','', ";//40
		$sql .= "'','','','','','','','','','', ";//50
		$sql .= "'','','','','','','','','','', ";//60
		$sql .= "'','','','','','','','','','', ";//70
		$sql .= "'','','','','','','','','','', ";//80
		$sql .= "'','','','','','' ";//86
		$sql .= "from agents WHERE publication_name=:publication_name AND publication_date=:publication_date ";
		$sql .= "ORDER BY sequence, pc DESC";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		return $database->resultset();
	}
	public static function view_records($optr,$proddate){
		global $database;
		$production_date = DateTime::createFromFormat('d/m/Y',$proddate);
		$sql  = "SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM nz ";
		$sql .= "WHERE entry_id=:entry_id and data_entry_date=:data_entry_date ";
		$sql .= "GROUP BY job,batch_id,state,publication_name,publication_date,batch_id ";
		$sql .= "UNION ";
		$sql .= "SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM nz ";
		$sql .= "WHERE verify_id=:verify_id and date_creation=:date_creation ";
		$sql .= "GROUP BY job,batch_id,state,publication_name,publication_date,batch_id ";
		$database->query($sql);
		$database->bind(':entry_id',$optr);
		$database->bind(':data_entry_date',$production_date->format('Y-m-d'));
		$database->bind(':verify_id',$optr);
		$database->bind(':date_creation',$production_date->format('Y-m-d'));
		return $database->resultset();
	}
	public static function view_records_advance($optr,$proddate1,$proddate2){
		global $database;
		$production_date1 = DateTime::createFromFormat('d/m/Y',$proddate1);
		$production_date2 = DateTime::createFromFormat('d/m/Y',$proddate2);
		$sql  = "SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date,data_entry_date,sum(entry_time) as total_time FROM nz ";
		$sql .= "WHERE entry_id=:entry_id and data_entry_date BETWEEN :data_entry_date1 AND :data_entry_date2 ";
		$sql .= "GROUP BY data_entry_date,job,batch_id,state,publication_name,publication_date,batch_id ";
		$sql .= "UNION ";
		$sql .= "SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM nz ";
		$sql .= "WHERE verify_id=:verify_id and date_creation BETWEEN :date_creation1 AND :date_creation2 ";
		$sql .= "GROUP BY date_creation,job,batch_id,state,publication_name,publication_date,batch_id ";
		$database->query($sql);
		$database->bind(':entry_id',$optr);
		$database->bind(':data_entry_date1',$production_date1->format('Y-m-d'));
		$database->bind(':data_entry_date2',$production_date2->format('Y-m-d'));
		$database->bind(':verify_id',$optr);
		$database->bind(':date_creation1',$production_date1->format('Y-m-d'));
		$database->bind(':date_creation2',$production_date2->format('Y-m-d'));
		return $database->resultset();
	}
	public static function all_records($proddate){
		global $database;
		$production_date = DateTime::createFromFormat('d/m/Y',$proddate);
		$sql  = "SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date, data_entry_date,sum(entry_time) as total_time FROM nz ";
		$sql .= "WHERE data_entry_date=:data_entry_date ";
		$sql .= "GROUP BY job, entry_id,batch_id,state,publication_name,publication_date,batch_id ";
		$sql .= "UNION ";
		$sql .= "SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM nz ";
		$sql .= "WHERE date_creation=:date_creation ";
		$sql .= "GROUP BY job, verify_id,batch_id,state,publication_name,publication_date,batch_id ";
		$database->query($sql);
		$database->bind(':data_entry_date',$production_date->format('Y-m-d'));
		$database->bind(':date_creation',$production_date->format('Y-m-d'));
		return $database->resultset();
	}
	public static function all_records_advance($proddate1,$proddate2){
		global $database;
		$production_date1 = DateTime::createFromFormat('d/m/Y',$proddate1);
		$production_date2 = DateTime::createFromFormat('d/m/Y',$proddate2);
		$sql  = "SELECT job_number as job, sum(if(entry_id!='',1,0)) as entry_records,entry_id,batch_id,publication_name,publication_date, data_entry_date,sum(entry_time) as total_time FROM nz ";
		$sql .= "WHERE data_entry_date BETWEEN :data_entry_date1 AND :data_entry_date2 ";
		$sql .= "GROUP BY data_entry_date,job,entry_id,batch_id,state,publication_name,publication_date,batch_id ";
		$sql .= "UNION ";
		$sql .= "SELECT job_number2 as job,sum(if(verify_id!='',1,0)) as entry_records,verify_id,batch_id,publication_name,publication_date,date_creation,sum(verify_time) as total_time FROM nz ";
		$sql .= "WHERE date_creation BETWEEN :date_creation1 AND :date_creation2 ";
		$sql .= "GROUP BY date_creation,job,verify_id,batch_id,state,publication_name,publication_date,batch_id ";
		$database->query($sql);
		$database->bind(':data_entry_date1',$production_date1->format('Y-m-d'));
		$database->bind(':data_entry_date2',$production_date2->format('Y-m-d'));
		$database->bind(':date_creation1',$production_date1->format('Y-m-d'));
		$database->bind(':date_creation2',$production_date2->format('Y-m-d'));
		return $database->resultset();
	}
	public static function operator_stats($proddate){
		global $database;
		$production_date = DateTime::createFromFormat('d/m/Y',$proddate);
		$sql  = "SELECT RIGHT(job_number,1) as activity,LEFT(job_number,4) as job, DATE_FORMAT(data_entry_date,'%y') as year,DAYOFYEAR(data_entry_date) as juliandate,sum(if(entry_id!='',1,0)) as entry_records,entry_id,sum(entry_time) as total_time FROM nz ";
		$sql .= "WHERE data_entry_date=:data_entry_date ";
		$sql .= "GROUP BY activity, entry_id, job ";
		$sql .= "UNION ";
		$sql .= "SELECT RIGHT(job_number2,1) as activity,LEFT(job_number2,4) as job,DATE_FORMAT(date_creation,'%y') as year,DAYOFYEAR(date_creation) as juliandate,sum(if(verify_id!='',1,0)) as entry_records,verify_id,sum(verify_time) as total_time FROM nz ";
		$sql .= "WHERE date_creation=:date_creation ";
		$sql .= "GROUP BY activity, verify_id, job ";
		$database->query($sql);
		$database->bind(':data_entry_date',$production_date->format('Y-m-d'));
		$database->bind(':date_creation',$production_date->format('Y-m-d'));
		return $database->resultset();
	}
	public static function viewbatches($state,$pubname,$pubdate){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT GROUP_CONCAT(DISTINCT(entry_id),'|') as entry_id, GROUP_CONCAT(DISTINCT(verify_id),'|') as verify_id,batch_id,state,publication_name,publication_date,sum(if(entry_id!='',1,0)) as entry_records,sum(if(verify_id!='',1,0)) as verify_records,if(sum(if(entry_id!='',1,0))!=sum(if(verify_id!='',1,0)),'FOR VERIFY','FOR EXPORT') as status FROM nz ";
		$sql .= "WHERE state=:state AND publication_name=:publication_name AND publication_date=:publication_date ";
		$sql .= "GROUP BY batch_id,state,publication_name,publication_date ";
		$sql .= "UNION ";
		$sql .= "SELECT '' as entry_id,'' as verify_id,'' as batch_id,'' as state,'' as publication_name,'TOTAL :' as publication_date,sum(if(entry_id!='',1,0)) as entry_records,sum(if(verify_id!='',1,0)) as verify_records,if(sum(if(entry_id!='',1,0))!=sum(if(verify_id!='',1,0)),'FOR VERIFY','FOR EXPORT') as status FROM nz ";
		$sql .= "WHERE state=:state AND publication_name=:publication_name AND publication_date=:publication_date ";
		$sql .= "GROUP BY state,publication_name,publication_date ";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		return $database->resultset();
	}
	public static function records_summary($state,$pubname,$pubdate){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql = "SELECT count(state) as total, sum(if(sale_rent='SALE',1,0)) as sale, sum(if(sale_rent='RENT',1,0)) as rent FROM nz ";
		$sql .= "WHERE state=:state AND publication_name=:publication_name AND publication_date=:publication_date ";
		$sql .= "GROUP BY state,publication_name,publication_date ";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		return $database->single();
	}
	public static function rowCount($batch_id,$state,$pubname,$pubdate){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT count(batch_id) ";
		$sql .= "FROM nz WHERE batch_id = :batch_id AND state = :state AND publication_name = :publication_name ";
		$sql .= "AND publication_date = :publication_date";
		$database->query($sql);
		$database->bind('batch_id',$batch_id);
		$database->bind('state',$state);
		$database->bind('publication_name',$pubname);
		$database->bind('publication_date',$publication_date->format('Y-m-d'));
		$database->execute();
		return $database->rowCount();
	}
	public static function find_next($batch_id,$state,$pubname,$pubdate){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT id, batch_id, page_no,state, publication_name, publication_date,sale_rent,unit_no,street_no,";
		$sql .= "street_no_suffix,street_name,street_extension,street_direction,suburb,city,entry_id,";
		$sql .= "verify_id, property_type ";
		$sql .= "FROM nz WHERE batch_id = :batch_id AND state = :state AND publication_name = :publication_name ";
		$sql .= "AND publication_date = :publication_date AND verify_id = :verify_id ORDER BY id ASC";
		$database->query($sql);
		$database->bind(':verify_id','');
		$database->bind(':batch_id',$batch_id);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$publication_date->format('Y-m-d'));
		return $database->single();		
	}
	Public static function find_property_details($id){
		global $database;
		$sql = "SELECT * from nz WHERE id=:id";
		$database->query($sql);
		$database->bind(':id',$id);
		return $database->single();
	}
	public static function find_property($state,$pubname,$unit,$street,$suffix,$stname,$extension,$direction,$suburb,$city,$sr,$proptype){
		global $database;
		$sql  = "SELECT id from nz ";
		$sql .= "WHERE state=:state AND publication_name=:publication_name AND property_type=:property_type AND ";
		$sql .= "unit_no=:unit_no AND street_no=:street_no AND street_no_suffix=:street_no_suffix AND ";
		$sql .= "street_name=:street_name AND street_extension=:street_extension AND street_direction=:street_direction AND suburb=:suburb AND ";
		$sql .= "city=:city AND sale_rent=:sale_rent ORDER BY id DESC";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':property_type',$proptype);
		$database->bind(':unit_no',$unit);
		$database->bind(':street_no',$street);
		$database->bind(':street_no_suffix',$suffix);
		$database->bind(':street_name',$stname);
		$database->bind(':street_extension',$extension);
		$database->bind(':street_direction',$direction);
		$database->bind(':suburb',$suburb);
		$database->bind(':city',$city);
		$database->bind(':sale_rent',$sr);
		return $database->single();
	}
	public static function view($batch_id,$state,$pubname,$pubdate){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT id, batch_id, page_no,state, publication_name, publication_date,sale_rent,unit_no,street_no,";
		$sql .= "street_no_suffix,street_name,street_extension,street_direction,suburb,city,entry_id,";
		$sql .= "verify_id ";
		$sql .= "FROM nz WHERE batch_id = :batch_id AND state = :state AND publication_name = :publication_name ";
		$sql .= "AND publication_date = :publication_date ORDER BY id ASC";
		$database->query($sql);
		$database->bind('batch_id',$batch_id);
		$database->bind('state',$state);
		$database->bind('publication_name',$pubname);
		$database->bind('publication_date',$publication_date->format('Y-m-d'));
		return $database->resultset();		
	}	
	public static function nzqc($batch_id,$state,$pubname,$pubdate){
		global $database;
		$publication_date = DateTime::createFromFormat('d/m/Y',$pubdate);
		$sql  = "SELECT id, batch_id, page_no,state, publication_name, publication_date,sale_rent,unit_no,street_no,";
		$sql .= "street_no_suffix,street_name,street_extension,street_direction,suburb,city,entry_id,";
		$sql .= "verify_id ";
		$sql .= "FROM nz WHERE batch_id LIKE :batch_id AND state = :state AND publication_name = :publication_name ";
		$sql .= "AND publication_date = :publication_date ORDER BY batch_id ASC, Page_No";
		$database->query($sql);
		$database->bind('batch_id','%'.$batch_id.'%');
		$database->bind('state',$state);
		$database->bind('publication_name',$pubname);
		$database->bind('publication_date',$publication_date->format('Y-m-d'));
		return $database->resultset();		
	}
	public function insert(){
		global $database;
		$sql  = "INSERT INTO nz ";
		$sql .= "(sequence_no,state,publication_name,publication_date,unit_no,street_no,street_no_suffix,street_name,street_extension,suburb,city,property_type,
				listing_type,price_from,price_to,price_description,rental_period,auction_date,auction_time,auction_location,water_frontage,scenic_view,air_conditioned,
				heritage_other,lift_installed,access_security,close_to_public,vendor_will_trade,permanent_water,mains_electricity,river_frontage,coast_frontage,canal_frontage,
				lake_frontage,sealed_roads,open_plan,fireplace,polished_floors,swimming_pool,renovated,double_storey,ducted_heating,granny_flat,selling_off,boat_ramp,ducted_vaccuum,
				town_water,town_sewerage,curb_chanelling,all_weather_access,land_subject,phone_service,land_can_be,trees_on_land,bedrooms,m2_total_floor,land_area,land_area_metric,
				ensuites,toilets,dining_rooms,lounge_dining,other_rooms,lockup_garages,year_built,floor_level,no_of_floor,bathrooms,lounge_rooms,no_of_study,no_of_tennis,family_rumpus,
				car_spaces,year_building,total_floors,construction_type,materials_in_roof,type_of_scenic,ad_size,ad_photo_type,ad_photo_count,ad_section,ad_exclusive,additional_property,
				data_entry_date,rp_property_id,rp_account_id,rp_personalized_id,page_no,batch_id,street_direction,sale_rent,entry_id,job_number,entry_time)";
		$sql .= "VALUES ";
		$sql .= "(:sequence_no,:state,:publication_name,:publication_date,:unit_no,:street_no,:street_no_suffix,:street_name,:street_extension,:suburb,:city,:property_type,
				:listing_type,:price_from,:price_to,:price_description,:rental_period,:auction_date,:auction_time,:auction_location,:water_frontage,:scenic_view,:air_conditioned,
				:heritage_other,:lift_installed,:access_security,:close_to_public,:vendor_will_trade,:permanent_water,:mains_electricity,:river_frontage,:coast_frontage,:canal_frontage,
				:lake_frontage,:sealed_roads,:open_plan,:fireplace,:polished_floors,:swimming_pool,:renovated,:double_storey,:ducted_heating,:granny_flat,:selling_off,:boat_ramp,:ducted_vaccuum,
				:town_water,:town_sewerage,:curb_chanelling,:all_weather_access,:land_subject,:phone_service,:land_can_be,:trees_on_land,:bedrooms,:m2_total_floor,:land_area,:land_area_metric,
				:ensuites,:toilets,:dining_rooms,:lounge_dining,:other_rooms,:lockup_garages,:year_built,:floor_level,:no_of_floor,:bathrooms,:lounge_rooms,:no_of_study,:no_of_tennis,:family_rumpus,
				:car_spaces,:year_building,:total_floors,:construction_type,:materials_in_roof,:type_of_scenic,:ad_size,:ad_photo_type,:ad_photo_count,:ad_section,:ad_exclusive,:additional_property,
				:data_entry_date,:rp_property_id,:rp_account_id,:rp_personalized_id,:page_no,:batch_id,:street_direction,:sale_rent,:entry_id,:job_number,:entry_time)";
		$database->query($sql);
		$database->bind(':sequence_no',$this->sequence_no);
		$database->bind(':state',$this->state);
		$database->bind(':publication_name',$this->publication_name);
		$database->bind(':publication_date',$this->publication_date);
		$database->bind(':unit_no',$this->unit_no);
		$database->bind(':street_no',$this->street_no);
		$database->bind(':street_no_suffix',$this->street_no_suffix);
		$database->bind(':street_name',$this->street_name);
		$database->bind(':street_extension',$this->street_extension);
		$database->bind(':suburb',$this->suburb);
		$database->bind(':city',$this->city);
		$database->bind(':property_type',$this->property_type);
		$database->bind(':listing_type',$this->listing_type);
		$database->bind(':price_from',$this->price_from);
		$database->bind(':price_to',$this->price_to);
		$database->bind(':price_description',$this->price_description);
		$database->bind(':rental_period',$this->rental_period);
		$database->bind(':auction_date',$this->auction_date);
		$database->bind(':auction_time',$this->auction_time);
		$database->bind(':auction_location',$this->auction_location);
		$database->bind(':water_frontage',$this->water_frontage);
		$database->bind(':scenic_view',$this->scenic_view);
		$database->bind(':air_conditioned',$this->air_conditioned);
		$database->bind(':heritage_other',$this->heritage_other);
		$database->bind(':lift_installed',$this->lift_installed);
		$database->bind(':access_security',$this->access_security);
		$database->bind(':close_to_public',$this->close_to_public);
		$database->bind(':vendor_will_trade',$this->vendor_will_trade);
		$database->bind(':permanent_water',$this->permanent_water);
		$database->bind(':mains_electricity',$this->mains_electricity);
		$database->bind(':river_frontage',$this->river_frontage);
		$database->bind(':coast_frontage',$this->coast_frontage);
		$database->bind(':canal_frontage',$this->canal_frontage);
		$database->bind(':lake_frontage',$this->lake_frontage);
		$database->bind(':sealed_roads',$this->sealed_roads);
		$database->bind(':open_plan',$this->open_plan);
		$database->bind(':fireplace',$this->fireplace);
		$database->bind(':polished_floors',$this->polished_floors);
		$database->bind(':swimming_pool',$this->swimming_pool);
		$database->bind(':renovated',$this->renovated);
		$database->bind(':double_storey',$this->double_storey);
		$database->bind(':ducted_heating',$this->ducted_heating);
		$database->bind(':granny_flat',$this->granny_flat);
		$database->bind(':selling_off',$this->selling_off);
		$database->bind(':boat_ramp',$this->boat_ramp);
		$database->bind(':ducted_vaccuum',$this->ducted_vaccuum);
		$database->bind(':town_water',$this->town_water);
		$database->bind(':town_sewerage',$this->town_sewerage);
		$database->bind(':curb_chanelling',$this->curb_chanelling);
		$database->bind(':all_weather_access',$this->all_weather_access);
		$database->bind(':land_subject',$this->land_subject);
		$database->bind(':phone_service',$this->phone_service);
		$database->bind(':land_can_be',$this->land_can_be);
		$database->bind(':trees_on_land',$this->trees_on_land);
		$database->bind(':bedrooms',$this->bedrooms);
		$database->bind(':m2_total_floor',$this->m2_total_floor);
		$database->bind(':land_area',$this->land_area);
		$database->bind(':land_area_metric',$this->land_area_metric);
		$database->bind(':ensuites',$this->ensuites);
		$database->bind(':toilets',$this->toilets);
		$database->bind(':dining_rooms',$this->dining_rooms);
		$database->bind(':lounge_dining',$this->lounge_dining);
		$database->bind(':other_rooms',$this->other_rooms);
		$database->bind(':lockup_garages',$this->lockup_garages);
		$database->bind(':year_built',$this->year_built);
		$database->bind(':floor_level',$this->floor_level);
		$database->bind(':no_of_floor',$this->no_of_floor);
		$database->bind(':bathrooms',$this->bathrooms);
		$database->bind(':lounge_rooms',$this->lounge_rooms);
		$database->bind(':no_of_study',$this->no_of_study);
		$database->bind(':no_of_tennis',$this->no_of_tennis);
		$database->bind(':family_rumpus',$this->family_rumpus);
		$database->bind(':car_spaces',$this->car_spaces);
		$database->bind(':year_building',$this->year_building);
		$database->bind(':total_floors',$this->total_floors);
		$database->bind(':construction_type',$this->construction_type);
		$database->bind(':materials_in_roof',$this->materials_in_roof);
		$database->bind(':type_of_scenic',$this->type_of_scenic);
		$database->bind(':ad_size',$this->ad_size);
		$database->bind(':ad_photo_type',$this->ad_photo_type);
		$database->bind(':ad_photo_count',$this->ad_photo_count);
		$database->bind(':ad_section',$this->ad_section);
		$database->bind(':ad_exclusive',$this->ad_exclusive);
		$database->bind(':additional_property',$this->additional_property);
		$database->bind(':data_entry_date',$this->data_entry_date);
		$database->bind(':rp_property_id',$this->rp_property_id);
		$database->bind(':rp_account_id',$this->rp_account_id);
		$database->bind(':rp_personalized_id',$this->rp_personalized_id);
		$database->bind(':page_no',$this->page_no);
		$database->bind(':batch_id',$this->batch_id);
		$database->bind(':street_direction',$this->street_direction);
		$database->bind(':sale_rent',$this->sale_rent);
		$database->bind(':entry_id',$this->entry_id);
		$database->bind(':job_number',$this->job_number);
		$database->bind(':entry_time',$this->entry_time);
		$database->execute();
	}
	public function record_id(){
		global $database;
		return $database->lastInsertId();
	}
	public function verify(){
		global $database;
		$sql  = "UPDATE nz ";
		$sql .= "SET sequence_no = :sequence_no,state = :state,publication_name = :publication_name,publication_date = :publication_date,unit_no = :unit_no,street_no = :street_no,
				street_no_suffix = :street_no_suffix,street_name = :street_name,street_extension = :street_extension,suburb = :suburb,city = :city,property_type = :property_type,listing_type = :listing_type,
				price_from = :price_from,price_to = :price_to,price_description = :price_description,rental_period = :rental_period,auction_date = :auction_date,auction_time = :auction_time,
				auction_location = :auction_location,water_frontage = :water_frontage,scenic_view = :scenic_view,air_conditioned = :air_conditioned,heritage_other = :heritage_other,lift_installed = :lift_installed,
				access_security = :access_security,close_to_public = :close_to_public,vendor_will_trade = :vendor_will_trade,permanent_water = :permanent_water,mains_electricity = :mains_electricity,
				river_frontage = :river_frontage,coast_frontage = :coast_frontage,canal_frontage = :canal_frontage,lake_frontage = :lake_frontage,sealed_roads = :sealed_roads,open_plan = :open_plan,
				fireplace = :fireplace,polished_floors = :polished_floors,swimming_pool = :swimming_pool,renovated = :renovated,double_storey = :double_storey,ducted_heating = :ducted_heating,
				granny_flat = :granny_flat,selling_off = :selling_off,boat_ramp = :boat_ramp,ducted_vaccuum = :ducted_vaccuum,town_water = :town_water,town_sewerage = :town_sewerage,curb_chanelling = :curb_chanelling,
				all_weather_access = :all_weather_access,land_subject = :land_subject,phone_service = :phone_service,land_can_be = :land_can_be,trees_on_land = :trees_on_land,bedrooms = :bedrooms,
				m2_total_floor = :m2_total_floor,land_area = :land_area,land_area_metric = :land_area_metric,ensuites = :ensuites,toilets = :toilets,dining_rooms = :dining_rooms,lounge_dining = :lounge_dining,
				other_rooms = :other_rooms,lockup_garages = :lockup_garages,year_built = :year_built,floor_level = :floor_level,no_of_floor = :no_of_floor,bathrooms = :bathrooms,lounge_rooms = :lounge_rooms,
				no_of_study = :no_of_study,no_of_tennis = :no_of_tennis,family_rumpus = :family_rumpus,car_spaces = :car_spaces,year_building = :year_building,total_floors = :total_floors,
				construction_type = :construction_type,materials_in_roof = :materials_in_roof,type_of_scenic = :type_of_scenic,ad_size = :ad_size,ad_photo_type = :ad_photo_type,ad_photo_count = :ad_photo_count,
				ad_section = :ad_section,ad_exclusive = :ad_exclusive,additional_property = :additional_property,rp_property_id = :rp_property_id,rp_account_id = :rp_account_id,
				rp_personalized_id = :rp_personalized_id,page_no = :page_no,batch_id = :batch_id,street_direction = :street_direction,sale_rent = :sale_rent,verify_id = :verify_id,date_creation=:date_creation,job_number2=:job_number2,verify_time=:verify_time ";
		$sql .= "WHERE id = :id";
		$database->query($sql);
		$database->bind(':id',$this->id);
		$database->bind(':sequence_no',$this->sequence_no);
		$database->bind(':state',$this->state);
		$database->bind(':publication_name',$this->publication_name);
		$database->bind(':publication_date',$this->publication_date);
		$database->bind(':unit_no',$this->unit_no);
		$database->bind(':street_no',$this->street_no);
		$database->bind(':street_no_suffix',$this->street_no_suffix);
		$database->bind(':street_name',$this->street_name);
		$database->bind(':street_extension',$this->street_extension);
		$database->bind(':suburb',$this->suburb);
		$database->bind(':city',$this->city);
		$database->bind(':property_type',$this->property_type);
		$database->bind(':listing_type',$this->listing_type);
		$database->bind(':price_from',$this->price_from);
		$database->bind(':price_to',$this->price_to);
		$database->bind(':price_description',$this->price_description);
		$database->bind(':rental_period',$this->rental_period);
		$database->bind(':auction_date',$this->auction_date);
		$database->bind(':auction_time',$this->auction_time);
		$database->bind(':auction_location',$this->auction_location);
		$database->bind(':water_frontage',$this->water_frontage);
		$database->bind(':scenic_view',$this->scenic_view);
		$database->bind(':air_conditioned',$this->air_conditioned);
		$database->bind(':heritage_other',$this->heritage_other);
		$database->bind(':lift_installed',$this->lift_installed);
		$database->bind(':access_security',$this->access_security);
		$database->bind(':close_to_public',$this->close_to_public);
		$database->bind(':vendor_will_trade',$this->vendor_will_trade);
		$database->bind(':permanent_water',$this->permanent_water);
		$database->bind(':mains_electricity',$this->mains_electricity);
		$database->bind(':river_frontage',$this->river_frontage);
		$database->bind(':coast_frontage',$this->coast_frontage);
		$database->bind(':canal_frontage',$this->canal_frontage);
		$database->bind(':lake_frontage',$this->lake_frontage);
		$database->bind(':sealed_roads',$this->sealed_roads);
		$database->bind(':open_plan',$this->open_plan);
		$database->bind(':fireplace',$this->fireplace);
		$database->bind(':polished_floors',$this->polished_floors);
		$database->bind(':swimming_pool',$this->swimming_pool);
		$database->bind(':renovated',$this->renovated);
		$database->bind(':double_storey',$this->double_storey);
		$database->bind(':ducted_heating',$this->ducted_heating);
		$database->bind(':granny_flat',$this->granny_flat);
		$database->bind(':selling_off',$this->selling_off);
		$database->bind(':boat_ramp',$this->boat_ramp);
		$database->bind(':ducted_vaccuum',$this->ducted_vaccuum);
		$database->bind(':town_water',$this->town_water);
		$database->bind(':town_sewerage',$this->town_sewerage);
		$database->bind(':curb_chanelling',$this->curb_chanelling);
		$database->bind(':all_weather_access',$this->all_weather_access);
		$database->bind(':land_subject',$this->land_subject);
		$database->bind(':phone_service',$this->phone_service);
		$database->bind(':land_can_be',$this->land_can_be);
		$database->bind(':trees_on_land',$this->trees_on_land);
		$database->bind(':bedrooms',$this->bedrooms);
		$database->bind(':m2_total_floor',$this->m2_total_floor);
		$database->bind(':land_area',$this->land_area);
		$database->bind(':land_area_metric',$this->land_area_metric);
		$database->bind(':ensuites',$this->ensuites);
		$database->bind(':toilets',$this->toilets);
		$database->bind(':dining_rooms',$this->dining_rooms);
		$database->bind(':lounge_dining',$this->lounge_dining);
		$database->bind(':other_rooms',$this->other_rooms);
		$database->bind(':lockup_garages',$this->lockup_garages);
		$database->bind(':year_built',$this->year_built);
		$database->bind(':floor_level',$this->floor_level);
		$database->bind(':no_of_floor',$this->no_of_floor);
		$database->bind(':bathrooms',$this->bathrooms);
		$database->bind(':lounge_rooms',$this->lounge_rooms);
		$database->bind(':no_of_study',$this->no_of_study);
		$database->bind(':no_of_tennis',$this->no_of_tennis);
		$database->bind(':family_rumpus',$this->family_rumpus);
		$database->bind(':car_spaces',$this->car_spaces);
		$database->bind(':year_building',$this->year_building);
		$database->bind(':total_floors',$this->total_floors);
		$database->bind(':construction_type',$this->construction_type);
		$database->bind(':materials_in_roof',$this->materials_in_roof);
		$database->bind(':type_of_scenic',$this->type_of_scenic);
		$database->bind(':ad_size',$this->ad_size);
		$database->bind(':ad_photo_type',$this->ad_photo_type);
		$database->bind(':ad_photo_count',$this->ad_photo_count);
		$database->bind(':ad_section',$this->ad_section);
		$database->bind(':ad_exclusive',$this->ad_exclusive);
		$database->bind(':additional_property',$this->additional_property);
		$database->bind(':rp_property_id',$this->rp_property_id);
		$database->bind(':rp_account_id',$this->rp_account_id);
		$database->bind(':rp_personalized_id',$this->rp_personalized_id);
		$database->bind(':page_no',$this->page_no);
		$database->bind(':batch_id',$this->batch_id);
		$database->bind(':street_direction',$this->street_direction);
		$database->bind(':sale_rent',$this->sale_rent);
		$database->bind(':verify_id',$this->verify_id);
		$database->bind(':job_number2',$this->job_number2);
		$database->bind(':verify_time',$this->verify_time);
		$database->bind(':date_creation',$this->date_creation);
		$database->execute();		
	}
	public function update(){
		global $database;
		$sql  = "UPDATE nz ";
		$sql .= "SET sequence_no = :sequence_no,state = :state,publication_name = :publication_name,publication_date = :publication_date,unit_no = :unit_no,street_no = :street_no,
				street_no_suffix = :street_no_suffix,street_name = :street_name,street_extension = :street_extension,suburb = :suburb,city = :city,property_type = :property_type,listing_type = :listing_type,
				price_from = :price_from,price_to = :price_to,price_description = :price_description,rental_period = :rental_period,auction_date = :auction_date,auction_time = :auction_time,
				auction_location = :auction_location,water_frontage = :water_frontage,scenic_view = :scenic_view,air_conditioned = :air_conditioned,heritage_other = :heritage_other,lift_installed = :lift_installed,
				access_security = :access_security,close_to_public = :close_to_public,vendor_will_trade = :vendor_will_trade,permanent_water = :permanent_water,mains_electricity = :mains_electricity,
				river_frontage = :river_frontage,coast_frontage = :coast_frontage,canal_frontage = :canal_frontage,lake_frontage = :lake_frontage,sealed_roads = :sealed_roads,open_plan = :open_plan,
				fireplace = :fireplace,polished_floors = :polished_floors,swimming_pool = :swimming_pool,renovated = :renovated,double_storey = :double_storey,ducted_heating = :ducted_heating,
				granny_flat = :granny_flat,selling_off = :selling_off,boat_ramp = :boat_ramp,ducted_vaccuum = :ducted_vaccuum,town_water = :town_water,town_sewerage = :town_sewerage,curb_chanelling = :curb_chanelling,
				all_weather_access = :all_weather_access,land_subject = :land_subject,phone_service = :phone_service,land_can_be = :land_can_be,trees_on_land = :trees_on_land,bedrooms = :bedrooms,
				m2_total_floor = :m2_total_floor,land_area = :land_area,land_area_metric = :land_area_metric,ensuites = :ensuites,toilets = :toilets,dining_rooms = :dining_rooms,lounge_dining = :lounge_dining,
				other_rooms = :other_rooms,lockup_garages = :lockup_garages,year_built = :year_built,floor_level = :floor_level,no_of_floor = :no_of_floor,bathrooms = :bathrooms,lounge_rooms = :lounge_rooms,
				no_of_study = :no_of_study,no_of_tennis = :no_of_tennis,family_rumpus = :family_rumpus,car_spaces = :car_spaces,year_building = :year_building,total_floors = :total_floors,
				construction_type = :construction_type,materials_in_roof = :materials_in_roof,type_of_scenic = :type_of_scenic,ad_size = :ad_size,ad_photo_type = :ad_photo_type,ad_photo_count = :ad_photo_count,
				ad_section = :ad_section,ad_exclusive = :ad_exclusive,additional_property = :additional_property,rp_property_id = :rp_property_id,rp_account_id = :rp_account_id,
				rp_personalized_id = :rp_personalized_id,page_no = :page_no,batch_id = :batch_id,street_direction = :street_direction,sale_rent = :sale_rent ";
		$sql .= "WHERE id = :id";
		$database->query($sql);
		$database->bind(':id',$this->id);
		$database->bind(':sequence_no',$this->sequence_no);
		$database->bind(':state',$this->state);
		$database->bind(':publication_name',$this->publication_name);
		$database->bind(':publication_date',$this->publication_date);
		$database->bind(':unit_no',$this->unit_no);
		$database->bind(':street_no',$this->street_no);
		$database->bind(':street_no_suffix',$this->street_no_suffix);
		$database->bind(':street_name',$this->street_name);
		$database->bind(':street_extension',$this->street_extension);
		$database->bind(':suburb',$this->suburb);
		$database->bind(':city',$this->city);
		$database->bind(':property_type',$this->property_type);
		$database->bind(':listing_type',$this->listing_type);
		$database->bind(':price_from',$this->price_from);
		$database->bind(':price_to',$this->price_to);
		$database->bind(':price_description',$this->price_description);
		$database->bind(':rental_period',$this->rental_period);
		$database->bind(':auction_date',$this->auction_date);
		$database->bind(':auction_time',$this->auction_time);
		$database->bind(':auction_location',$this->auction_location);
		$database->bind(':water_frontage',$this->water_frontage);
		$database->bind(':scenic_view',$this->scenic_view);
		$database->bind(':air_conditioned',$this->air_conditioned);
		$database->bind(':heritage_other',$this->heritage_other);
		$database->bind(':lift_installed',$this->lift_installed);
		$database->bind(':access_security',$this->access_security);
		$database->bind(':close_to_public',$this->close_to_public);
		$database->bind(':vendor_will_trade',$this->vendor_will_trade);
		$database->bind(':permanent_water',$this->permanent_water);
		$database->bind(':mains_electricity',$this->mains_electricity);
		$database->bind(':river_frontage',$this->river_frontage);
		$database->bind(':coast_frontage',$this->coast_frontage);
		$database->bind(':canal_frontage',$this->canal_frontage);
		$database->bind(':lake_frontage',$this->lake_frontage);
		$database->bind(':sealed_roads',$this->sealed_roads);
		$database->bind(':open_plan',$this->open_plan);
		$database->bind(':fireplace',$this->fireplace);
		$database->bind(':polished_floors',$this->polished_floors);
		$database->bind(':swimming_pool',$this->swimming_pool);
		$database->bind(':renovated',$this->renovated);
		$database->bind(':double_storey',$this->double_storey);
		$database->bind(':ducted_heating',$this->ducted_heating);
		$database->bind(':granny_flat',$this->granny_flat);
		$database->bind(':selling_off',$this->selling_off);
		$database->bind(':boat_ramp',$this->boat_ramp);
		$database->bind(':ducted_vaccuum',$this->ducted_vaccuum);
		$database->bind(':town_water',$this->town_water);
		$database->bind(':town_sewerage',$this->town_sewerage);
		$database->bind(':curb_chanelling',$this->curb_chanelling);
		$database->bind(':all_weather_access',$this->all_weather_access);
		$database->bind(':land_subject',$this->land_subject);
		$database->bind(':phone_service',$this->phone_service);
		$database->bind(':land_can_be',$this->land_can_be);
		$database->bind(':trees_on_land',$this->trees_on_land);
		$database->bind(':bedrooms',$this->bedrooms);
		$database->bind(':m2_total_floor',$this->m2_total_floor);
		$database->bind(':land_area',$this->land_area);
		$database->bind(':land_area_metric',$this->land_area_metric);
		$database->bind(':ensuites',$this->ensuites);
		$database->bind(':toilets',$this->toilets);
		$database->bind(':dining_rooms',$this->dining_rooms);
		$database->bind(':lounge_dining',$this->lounge_dining);
		$database->bind(':other_rooms',$this->other_rooms);
		$database->bind(':lockup_garages',$this->lockup_garages);
		$database->bind(':year_built',$this->year_built);
		$database->bind(':floor_level',$this->floor_level);
		$database->bind(':no_of_floor',$this->no_of_floor);
		$database->bind(':bathrooms',$this->bathrooms);
		$database->bind(':lounge_rooms',$this->lounge_rooms);
		$database->bind(':no_of_study',$this->no_of_study);
		$database->bind(':no_of_tennis',$this->no_of_tennis);
		$database->bind(':family_rumpus',$this->family_rumpus);
		$database->bind(':car_spaces',$this->car_spaces);
		$database->bind(':year_building',$this->year_building);
		$database->bind(':total_floors',$this->total_floors);
		$database->bind(':construction_type',$this->construction_type);
		$database->bind(':materials_in_roof',$this->materials_in_roof);
		$database->bind(':type_of_scenic',$this->type_of_scenic);
		$database->bind(':ad_size',$this->ad_size);
		$database->bind(':ad_photo_type',$this->ad_photo_type);
		$database->bind(':ad_photo_count',$this->ad_photo_count);
		$database->bind(':ad_section',$this->ad_section);
		$database->bind(':ad_exclusive',$this->ad_exclusive);
		$database->bind(':additional_property',$this->additional_property);
		$database->bind(':rp_property_id',$this->rp_property_id);
		$database->bind(':rp_account_id',$this->rp_account_id);
		$database->bind(':rp_personalized_id',$this->rp_personalized_id);
		$database->bind(':page_no',$this->page_no);
		$database->bind(':batch_id',$this->batch_id);
		$database->bind(':street_direction',$this->street_direction);
		$database->bind(':sale_rent',$this->sale_rent);
		$database->execute();		
	}	
	public static function delete($id){
		global $database;
		$sql = "DELETE FROM nz ";
		$sql .= "WHERE id = :id";
		$database->query($sql);
		$database->bind(':id',$id);
		$database->execute();
	}
	public static function delete_publication($state="",$pubname="",$pubdate=""){
		global $database;
		$sql = "DELETE FROM nz ";
		$sql .= "WHERE state=:state AND publication_name=:publication_name AND publication_date=:publication_date";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$pubdate);
		$database->execute();
	}
	public function save(){
		if ($this->id == 0){
			$this->insert();
		} else {
			$this->update();
		}
	}
	public function __construct($id=0){
		$this->id=$id;
		$this->sequence_no="";
		$this->state="";
		$this->publication_name="";
		$this->publication_date="";
		$this->unit_no="";
		$this->street_no="";
		$this->street_no_suffix="";
		$this->street_name="";
		$this->street_extension="";
		$this->suburb="";
		$this->city="";
		$this->property_type="";
		$this->listing_type="";
		$this->price_from="";
		$this->price_to="";
		$this->price_description="";
		$this->rental_period="";
		$this->auction_date="";
		$this->auction_time="";
		$this->auction_location="";
		$this->water_frontage="";
		$this->scenic_view="";
		$this->air_conditioned="";
		$this->heritage_other="";
		$this->lift_installed="";
		$this->access_security="";
		$this->close_to_public="";
		$this->vendor_will_trade="";
		$this->permanent_water="";
		$this->mains_electricity="";
		$this->river_frontage="";
		$this->coast_frontage="";
		$this->canal_frontage="";
		$this->lake_frontage="";
		$this->sealed_roads="";
		$this->open_plan="";
		$this->fireplace="";
		$this->polished_floors="";
		$this->swimming_pool="";
		$this->renovated="";
		$this->double_storey="";
		$this->ducted_heating="";
		$this->granny_flat="";
		$this->selling_off="";
		$this->boat_ramp="";
		$this->ducted_vaccuum="";
		$this->town_water="";
		$this->town_sewerage="";
		$this->curb_chanelling="";
		$this->all_weather_access="";
		$this->land_subject="";
		$this->phone_service="";
		$this->land_can_be="";
		$this->trees_on_land="";
		$this->bedrooms="";
		$this->m2_total_floor="";
		$this->land_area="";
		$this->land_area_metric="";
		$this->ensuites="";
		$this->toilets="";
		$this->dining_rooms="";
		$this->lounge_dining="";
		$this->other_rooms="";
		$this->lockup_garages="";
		$this->year_built="";
		$this->floor_level="";
		$this->no_of_floor="";
		$this->bathrooms="";
		$this->lounge_rooms="";
		$this->no_of_study="";
		$this->no_of_tennis="";
		$this->family_rumpus="";
		$this->car_spaces="";
		$this->year_building="";
		$this->total_floors="";
		$this->construction_type="";
		$this->materials_in_roof="";
		$this->type_of_scenic="";
		$this->ad_size="";
		$this->ad_photo_type="";
		$this->ad_photo_count="";
		$this->ad_section="";
		$this->ad_exclusive="";
		$this->additional_property="";
		$this->data_entry_date="";
		$this->rp_property_id="";
		$this->rp_account_id="";
		$this->rp_personalized_id="";
		$this->page_no="";
		$this->batch_id="";
		$this->street_direction="";
		$this->sale_rent="";
		$this->entry_id="";
		$this->verify_id="";
		$this->date_creation="";
		$this->time_stamp="";
	}
	/* public function __toString(){
		$output = "<label>id  :   </label>".$this->id.'<br>';
		$output.= "<label>sequence_no  :   </label>".$this->sequence_no.'<br>';
		$output.= "<label>state  :   </label>".$this->state.'<br>';
		$output.= "<label>publication_name  :   </label>".$this->publication_name.'<br>';
		$output.= "<label>publication_date  :   </label>".$this->publication_date.'<br>';
		$output.= "<label>unit_no  :   </label>".$this->unit_no.'<br>';
		$output.= "<label>street_no  :   </label>".$this->street_no.'<br>';
		$output.= "<label>street_no_suffix  :   </label>".$this->street_no_suffix.'<br>';
		$output.= "<label>street_name  :   </label>".$this->street_name.'<br>';
		$output.= "<label>street_extension  :   </label>".$this->street_extension.'<br>';
		$output.= "<label>suburb  :   </label>".$this->suburb.'<br>';
		$output.= "<label>city  :   </label>".$this->city.'<br>';
		$output.= "<label>property_type  :   </label>".$this->property_type.'<br>';
		$output.= "<label>listing_type  :   </label>".$this->listing_type.'<br>';
		$output.= "<label>price_from  :   </label>".$this->price_from.'<br>';
		$output.= "<label>price_to  :   </label>".$this->price_to.'<br>';
		$output.= "<label>price_description  :   </label>".$this->price_description.'<br>';
		$output.= "<label>rental_period  :   </label>".$this->rental_period.'<br>';
		$output.= "<label>auction_date  :   </label>".$this->auction_date.'<br>';
		$output.= "<label>auction_time  :   </label>".$this->auction_time.'<br>';
		$output.= "<label>auction_location  :   </label>".$this->auction_location.'<br>';
		$output.= "<label>water_frontage  :   </label>".$this->water_frontage.'<br>';
		$output.= "<label>scenic_view  :   </label>".$this->scenic_view.'<br>';
		$output.= "<label>air_conditioned  :   </label>".$this->air_conditioned.'<br>';
		$output.= "<label>heritage_other  :   </label>".$this->heritage_other.'<br>';
		$output.= "<label>lift_installed  :   </label>".$this->lift_installed.'<br>';
		$output.= "<label>access_security  :   </label>".$this->access_security.'<br>';
		$output.= "<label>close_to_public  :   </label>".$this->close_to_public.'<br>';
		$output.= "<label>vendor_will_trade  :   </label>".$this->vendor_will_trade.'<br>';
		$output.= "<label>permanent_water  :   </label>".$this->permanent_water.'<br>';
		$output.= "<label>mains_electricity  :   </label>".$this->mains_electricity.'<br>';
		$output.= "<label>river_frontage  :   </label>".$this->river_frontage.'<br>';
		$output.= "<label>coast_frontage  :   </label>".$this->coast_frontage.'<br>';
		$output.= "<label>canal_frontage  :   </label>".$this->canal_frontage.'<br>';
		$output.= "<label>lake_frontage  :   </label>".$this->lake_frontage.'<br>';
		$output.= "<label>sealed_roads  :   </label>".$this->sealed_roads.'<br>';
		$output.= "<label>open_plan  :   </label>".$this->open_plan.'<br>';
		$output.= "<label>fireplace  :   </label>".$this->fireplace.'<br>';
		$output.= "<label>polished_floors  :   </label>".$this->polished_floors.'<br>';
		$output.= "<label>swimming_pool  :   </label>".$this->swimming_pool.'<br>';
		$output.= "<label>renovated  :   </label>".$this->renovated.'<br>';
		$output.= "<label>double_storey  :   </label>".$this->double_storey.'<br>';
		$output.= "<label>ducted_heating  :   </label>".$this->ducted_heating.'<br>';
		$output.= "<label>granny_flat  :   </label>".$this->granny_flat.'<br>';
		$output.= "<label>selling_off  :   </label>".$this->selling_off.'<br>';
		$output.= "<label>boat_ramp  :   </label>".$this->boat_ramp.'<br>';
		$output.= "<label>ducted_vaccuum  :   </label>".$this->ducted_vaccuum.'<br>';
		$output.= "<label>town_water  :   </label>".$this->town_water.'<br>';
		$output.= "<label>town_sewerage  :   </label>".$this->town_sewerage.'<br>';
		$output.= "<label>curb_chanelling  :   </label>".$this->curb_chanelling.'<br>';
		$output.= "<label>all_weather_access  :   </label>".$this->all_weather_access.'<br>';
		$output.= "<label>land_subject  :   </label>".$this->land_subject.'<br>';
		$output.= "<label>phone_service  :   </label>".$this->phone_service.'<br>';
		$output.= "<label>land_can_be  :   </label>".$this->land_can_be.'<br>';
		$output.= "<label>trees_on_land  :   </label>".$this->trees_on_land.'<br>';
		$output.= "<label>bedrooms  :   </label>".$this->bedrooms.'<br>';
		$output.= "<label>m2_total_floor  :   </label>".$this->m2_total_floor.'<br>';
		$output.= "<label>land_area  :   </label>".$this->land_area.'<br>';
		$output.= "<label>land_area_metric  :   </label>".$this->land_area_metric.'<br>';
		$output.= "<label>ensuites  :   </label>".$this->ensuites.'<br>';
		$output.= "<label>toilets  :   </label>".$this->toilets.'<br>';
		$output.= "<label>dining_rooms  :   </label>".$this->dining_rooms.'<br>';
		$output.= "<label>lounge_dining  :   </label>".$this->lounge_dining.'<br>';
		$output.= "<label>other_rooms  :   </label>".$this->other_rooms.'<br>';
		$output.= "<label>lockup_garages  :   </label>".$this->lockup_garages.'<br>';
		$output.= "<label>year_built  :   </label>".$this->year_built.'<br>';
		$output.= "<label>floor_level  :   </label>".$this->floor_level.'<br>';
		$output.= "<label>no_of_floor  :   </label>".$this->no_of_floor.'<br>';
		$output.= "<label>bathrooms  :   </label>".$this->bathrooms.'<br>';
		$output.= "<label>lounge_rooms  :   </label>".$this->lounge_rooms.'<br>';
		$output.= "<label>no_of_study  :   </label>".$this->no_of_study.'<br>';
		$output.= "<label>no_of_tennis  :   </label>".$this->no_of_tennis.'<br>';
		$output.= "<label>family_rumpus  :   </label>".$this->family_rumpus.'<br>';
		$output.= "<label>car_spaces  :   </label>".$this->car_spaces.'<br>';
		$output.= "<label>year_building  :   </label>".$this->year_building.'<br>';
		$output.= "<label>total_floors  :   </label>".$this->total_floors.'<br>';
		$output.= "<label>construction_type  :   </label>".$this->construction_type.'<br>';
		$output.= "<label>materials_in_roof  :   </label>".$this->materials_in_roof.'<br>';
		$output.= "<label>type_of_scenic  :   </label>".$this->type_of_scenic.'<br>';
		$output.= "<label>ad_size  :   </label>".$this->ad_size.'<br>';
		$output.= "<label>ad_photo_type  :   </label>".$this->ad_photo_type.'<br>';
		$output.= "<label>ad_photo_count  :   </label>".$this->ad_photo_count.'<br>';
		$output.= "<label>ad_section  :   </label>".$this->ad_section.'<br>';
		$output.= "<label>ad_exclusive  :   </label>".$this->ad_exclusive.'<br>';
		$output.= "<label>additional_property  :   </label>".$this->additional_property.'<br>';
		$output.= "<label>data_entry_date  :   </label>".$this->data_entry_date.'<br>';
		$output.= "<label>rp_property_id  :   </label>".$this->rp_property_id.'<br>';
		$output.= "<label>rp_account_id  :   </label>".$this->rp_account_id.'<br>';
		$output.= "<label>rp_personalized_id  :   </label>".$this->rp_personalized_id.'<br>';
		$output.= "<label>page_no  :   </label>".$this->page_no.'<br>';
		$output.= "<label>batch_id  :   </label>".$this->batch_id.'<br>';
		$output.= "<label>street_direction  :   </label>".$this->street_direction.'<br>';
		$output.= "<label>sale_rent  :   </label>".$this->sale_rent.'<br>';
		$output.= "<label>entry_id  :   </label>".$this->entry_id.'<br>';
		$output.= "<label>verify_id  :   </label>".$this->verify_id.'<br>';
		$output.= "<label>date_creation  :   </label>".$this->date_creation.'<br>';
		$output.= "<label>time_stamp  :   </label>".$this->time_stamp.'<br>';
		return $output;
    } */
	public static function backup($state='',$pubname='',$pubdate=''){
		global $database;
		$sql  = "SELECT * FROM nz ";
		$sql .= "WHERE State=:state and Publication_Name=:publication_name and Publication_Date=:publication_date ";
		$database->query($sql);
		$database->bind(':state',$state);
		$database->bind(':publication_name',$pubname);
		$database->bind(':publication_date',$pubdate);
		return $database->resultset();		
	}
	
	
	public function get_columns(){
		global $database;
		$sql = "SHOW COLUMNS FROM nz";
		$database->query($sql);
		return $database->resultset();
	}
	
}
?>