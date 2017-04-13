<?php require_once("../../_includes/initialize.php");

	ini_set('memory_limit','256M');

	$update = new Download();
	$update->id = $_GET['download'];
	$update->status = 'CLOSED';
	$update->sale = $_GET['sale'];
	$update->rent = $_GET['rent'];
	$update->start = $_GET['start'];
	$update->end = $_GET['end'];
	$update->close();
	
	$filename = "CCC_".date('Ymd')."_".date('His').".txt";
	header("Content-type: application/octet-stream");//A MIME attachment with the content type "application/octet-stream" is a binary file.
	header("Content-Disposition: attachment; filename={$filename}");//with this extension of file name you tell what kind of file it is.
	header("Pragma: no-cache");//Prevent Caching
	header("Expires: 0");//Expires and 0 mean that the browser will not cache the page on your hard drive
	$sequence = $_GET['start'] - 1;
	
	$file = "data.txt";
	$fh = fopen('data.txt', 'w');
	
	
	
	if ($_GET['state'] == 'NZ'){
		$exports = NewZealand::export_records($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
		$column = 88;
	} else {
		$exports = Australia::export_records($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
		$column = 111;
	}
	$parent = false;
	$error = false;
	$record_id = 0;
	
	fwrite($fh,"P/C1\tP/C2\t");
	for ($count = 3; $count <= $column; $count++){ fwrite($fh,"P".$count."\t");} 
	fwrite($fh,"P".$count."\r\n");
	
	foreach($exports as $nz){
		if ($nz['pc'] == "P" && $parent == true ){
			$error = true;
			fwrite($fh,"\r\n\r\n\r\n##########PARENT RECORD WITHOUT A CHILD RECORD ERROR!!!  OPERATION HALTED on record number :".$record_id);
			break;
		}
		if($nz['pc'] == "P"){
			$parent = true;
			$record_id = $nz['sequence'];
			$sequence++;
			
			//$pubname = isset($find_pubname[$nz['publication_name']]) ? $find_pubname[$nz['publication_name']] : $nz['publication_name'];
			$pubname = find_pubname($nz['publication_name']);
			fwrite($fh,$nz['pc']."\t".$sequence."\t".$nz['state']."\t".$pubname."\t".$nz['publication_date']."\t".$nz['unit_no']."\t".$nz['street_no']."\t".$nz['street_no_suffix']."\t".$nz['street_name']."\t".$nz['street_extension']."\t");
			fwrite($fh,$nz['suburb']."\t".$nz['city']."\t".$nz['property_type']."\t".$nz['listing_type']."\t".$nz['price_from']."\t".$nz['price_to']."\t".$nz['price_description']."\t".$nz['rental_period']."\t".$nz['auction_date']."\t".$nz['auction_time']."\t");
			fwrite($fh,$nz['auction_location']."\t".$nz['water_frontage']."\t".$nz['scenic_view']."\t".$nz['air_conditioned']."\t".$nz['heritage_other']."\t".$nz['lift_installed']."\t".$nz['access_security']."\t".$nz['close_to_public']."\t".$nz['vendor_will_trade']."\t".$nz['permanent_water']."\t");
			fwrite($fh,$nz['mains_electricity']."\t".$nz['river_frontage']."\t".$nz['coast_frontage']."\t".$nz['canal_frontage']."\t".$nz['lake_frontage']."\t".$nz['sealed_roads']."\t".$nz['open_plan']."\t".$nz['fireplace']."\t\t".$nz['polished_floors']."\t".$nz['swimming_pool']."\t");
			fwrite($fh,$nz['renovated']."\t\t".$nz['double_storey']."\t".$nz['ducted_heating']."\t".$nz['granny_flat']."\t".$nz['selling_off']."\t".$nz['boat_ramp']."\t".$nz['ducted_vaccuum']."\t".$nz['town_water']."\t".$nz['town_sewerage']."\t".$nz['curb_chanelling']."\t");
			fwrite($fh,$nz['all_weather_access']."\t".$nz['land_subject']."\t".$nz['phone_service']."\t".$nz['land_can_be']."\t".$nz['trees_on_land']."\t\t\t\t\t\t\t\t\t\t\t\t\t".$nz['bedrooms']."\t".$nz['m2_total_floor']."\t".$nz['land_area']."\t".$nz['land_area_metric']."\t".$nz['ensuites']."\t");
			fwrite($fh,$nz['toilets']."\t".$nz['dining_rooms']."\t".$nz['lounge_dining']."\t".$nz['other_rooms']."\t".$nz['lockup_garages']."\t".$nz['year_built']."\t".$nz['floor_level']."\t".$nz['no_of_floor']."\t".$nz['bathrooms']."\t".$nz['lounge_rooms']."\t");
			fwrite($fh,$nz['no_of_study']."\t".$nz['no_of_tennis']."\t".$nz['family_rumpus']."\t".$nz['car_spaces']."\t\t".$nz['year_building']."\t".$nz['total_floors']."\t\t\t\t\t\t\t".$nz['construction_type']."\t".$nz['materials_in_roof']."\t".$nz['type_of_scenic']."\t\t\t".$nz['ad_size']."\t");
			fwrite($fh,$nz['ad_photo_type']."\t".$nz['ad_photo_count']."\t".$nz['ad_section']."\t".$nz['ad_exclusive']."\t".$nz['additional_property']."\t".$nz['data_entry_date']."\t\t\t\r\n");
		} elseif($nz['pc']=="C"){
			$parent = false;
			if($record_id != $nz['sequence']){
				$error = true;
				fwrite($fh,"\r\n\r\n\r\n##########CHILD RECORD WITHOUT PARENT ERROR!!!   OPERATION HALTED on RECORD number :".$nz['sequence']);
				break;
			}
			
			if(trim($nz['state']) =="" && trim($nz['unit_no']) == ""){
				
			} else {
				//fwrite($fh,$nz['sequence']."\t");
				fwrite($fh,$nz['pc']."\t".$sequence."\t".$nz['state']."\t".$nz['publication_name']."\t".$nz['publication_date']."\t".$nz['unit_no']."\t");
				for ($i = 7; $i<=$column; $i++){
					fwrite($fh,"\t");
				}
				fwrite($fh,"\r\n");		
			}
		}	
	}
	if($parent == true){
		$error = true;
		fwrite($fh,"\r\n\r\n\r\n##########Last Record has no child ERROR!!!   OPERATION HALTED on RECORD number :".$nz['sequence']);
	}
	fclose($fh);
	if ($handle = fopen($file,'r')){
		$content = fread($handle, 10000000);
		fclose($handle);
	}
	//if ($error == false){
		echo $content; 
	//} 
?>
