<?php require_once("../../_includes/initialize.php");
	$filename = "CCC_".date('Ymd')."_".date('His').".txt";
	header("Content-type: application/octet-stream");//A MIME attachment with the content type "application/octet-stream" is a binary file.
	header("Content-Disposition: attachment; filename={$filename}");//with this extension of file name you tell what kind of file it is.
	header("Pragma: no-cache");//Prevent Caching
	header("Expires: 0");//Expires and 0 mean that the browser will not cache the page on your hard drive
	$sequence = $_GET['start'] - 1;
	
	$file = "data.txt";
	$fh = fopen('data.txt', 'w');
	
	fwrite($fh,"P/C1\tP/C2\t");
	for ($count = 3; $count <= 111; $count++){ fwrite($fh,"P".$count."\t");} 
	fwrite($fh,"P112\r\n");

	$au_export = Australia::export_records($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
	$parent = false;
	$error = false;
	$record_id = 0;
	
	foreach($au_export as $au){
		if ($au['pc'] == "P" && $parent == true ){
			$error = true;
			fwrite($fh,"\r\n\r\n\r\n##########PARENT RECORD WITHOUT A CHILD RECORD ERROR!!!  OPERATION HALTED on record number :".$record_id);
			break;
		}
		if($au['pc'] == "P"){
			$parent = true;
			$record_id = $au['sequence'];
			$sequence++;
			//fwrite($fh,$au['sequence']."\t");
			fwrite($fh,$au['pc']."\t".$sequence."\t".$au['state']."\t".$au['publication_name']."\t".$au['publication_date']."\t".$au['unit_no']."\t".$au['street_no']."\t".$au['street_no_suffix']."\t".$au['street_name']."\t".$au['street_extension']."\t");
			fwrite($fh,$au['suburb']."\t".$au['state']."\t".$au['property_type']."\t".$au['listing_type']."\t".$au['price_from']."\t".$au['price_to']."\t".$au['price_description']."\t".$au['rental_period']."\t".$au['auction_date']."\t".$au['auction_time']."\t");
			fwrite($fh,$au['auction_location']."\t".$au['water_frontage']."\t".$au['scenic_view']."\t".$au['air_conditioned']."\t".$au['heritage_other']."\t".$au['lift_installed']."\t".$au['access_security']."\t".$au['close_to_public']."\t".$au['vendor_will_trade']."\t".$au['permanent_water']."\t");
			fwrite($fh,$au['mains_electricity']."\t".$au['river_frontage']."\t".$au['coast_frontage']."\t".$au['canal_frontage']."\t".$au['lake_frontage']."\t".$au['sealed_roads']."\t".$au['open_plan']."\t".$au['fireplace']."\t\t".$au['polished_floors']."\t".$au['swimming_pool']."\t");
			fwrite($fh,$au['renovated']."\t\t".$au['double_storey']."\t".$au['ducted_heating']."\t".$au['granny_flat']."\t".$au['selling_off']."\t".$au['boat_ramp']."\t".$au['ducted_vaccuum']."\t".$au['town_water']."\t".$au['town_sewerage']."\t".$au['curb_chanelling']."\t");
			fwrite($fh,$au['all_weather_access']."\t".$au['land_subject']."\t".$au['phone_service']."\t".$au['land_can_be']."\t".$au['trees_on_land']."\t\t\t\t\t\t\t\t\t\t\t\t\t".$au['bedrooms']."\t".$au['m2_total_floor']."\t".$au['land_area']."\t".$au['land_area_metric']."\t".$au['ensuites']."\t");
			fwrite($fh,$au['toilets']."\t".$au['dining_rooms']."\t".$au['lounge_dining']."\t".$au['other_rooms']."\t".$au['lockup_garages']."\t".$au['year_built']."\t".$au['floor_level']."\t".$au['no_of_floor']."\t".$au['bathrooms']."\t".$au['lounge_rooms']."\t");
			fwrite($fh,$au['no_of_study']."\t".$au['no_of_tennis']."\t".$au['family_rumpus']."\t".$au['car_spaces']."\t\t".$au['year_building']."\t".$au['total_floors']."\t\t\t\t\t\t\t".$au['construction_type']."\t".$au['materials_in_roof']."\t".$au['type_of_scenic']."\t\t\t".$au['ad_size']."\t");
			fwrite($fh,$au['ad_photo_type']."\t".$au['ad_photo_count']."\t".$au['ad_section']."\t".$au['ad_exclusive']."\t".$au['additional_property']."\t".$au['data_entry_date']."\t\t\t\r\n");
		} elseif($au['pc']=="C"){
			$parent = false;
			if($record_id != $au['sequence']){
				$error = true;
				fwrite($fh,"\r\n\r\n\r\n##########CHILD RECORD WITHOUT PARENT ERROR!!!   OPERATION HALTED on RECORD number :".$au['sequence']);
				break;
			}
			
			if(trim($au['state']) =="" && trim($au['unit_no']) == ""){
				
			} else {
				//fwrite($fh,$au['sequence']."\t");
				fwrite($fh,$au['pc']."\t".$sequence."\t".$au['state']."\t".$au['publication_name']."\t".$au['publication_date']."\t".$au['unit_no']."\t");
				for ($i = 7; $i<=88; $i++){
					fwrite($fh,"\t");
				}
				fwrite($fh,"\r\n");		
			}
		}	
	}
	if($parent == true){
		$error = true;
		fwrite($fh,"\r\n\r\n\r\n##########Last Record has no child ERROR!!!   OPERATION HALTED on RECORD number :".$au['sequence']);
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
