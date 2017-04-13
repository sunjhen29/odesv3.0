<?php
require_once('database.class.php');

class NZ_Postcode{
	public $id;
	public $street;
	public $suburb;
	public $postcode;
	public $matched_address;
	public $state;
	
	public static function find($street="Riverside Drive",$suburb="Abbey Caves"){
		global $database;
		$database->query('SELECT postcode from nzpostcode WHERE  street = :street AND suburb = :suburb');
		$database->bind(':street',$street);
		$database->bind(':suburb',$suburb);
		return $database->single();
	}
	
	public static function find_au_postcode($state="",$suburb=""){
		global $database;
		$database->query('SELECT post_code from aupostcode WHERE  state = :state AND suburb = :suburb');
		$database->bind(':state',$state);
		$database->bind(':suburb',$suburb);
		return $database->single();
	}
}
?>