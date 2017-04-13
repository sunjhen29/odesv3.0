<?php
require_once("../../_includes/initialize.php");
	if(!$session->is_logged_in()){
		redirect_to("../../logout.php"); 
	} else {
		if($session->access_level < 4){
			$session->set_message("You are not authorized to access the page!!");
			redirect_to("../../logout.php"); 
		}
	}
	set_time_limit (300);
	
	if (isset($_POST['submit'])){
		//check for errors
		$name = $_FILES['file']['name'];
		$filetype = $_FILES['file']['type'];
		$error = $_FILES['file']['error'];
		$size = $_FILES['file']['size'];
		$tmpname = $_FILES['file']['tmp_name'];
		
		//upload file
		$myfile = fopen($_FILES['file']['tmp_name'], "r") or die("Unable to open file!");
		$contents = fread($myfile,filesize($_FILES['file']['tmp_name']));
		fclose($myfile);
		
		$rows= explode("\n",$contents);
		$countrows = count($rows) - 1;
		$record_count = 0;
		
		for($x = 1; $x<=$countrows; $x++){	
			$field = explode("\t",$rows[$x]);
			if($field[0]=='P'){
				$record_count++;
				$state = $field[2];
				$publication_name = $field[3];
				$pubdate = $field[4];
				$property = new Australia();
				$property->sequence_no = '';
				$property->state = $field[2];
				$property->publication_name = $field[3];
				$publication_date = DateTime::createFromFormat('d/m/Y',$field[4]);
				$property->publication_date = $publication_date->format('Y-m-d');
				$property->unit_no = $field[5];
				$property->street_no = $field[6];
				$property->street_no_suffix = $field[7];
				$property->street_name = $field[8];
				$extension = explode(" ",$field[9]);
				$property->street_extension = $extension[0];
				$property->suburb = $field[10];
				$property->city = $field[11];
				$property->property_type = $field[12];
				$property->listing_type = $field[13];
				$property->price_from = ($field[14]) ? $field[14] : null;
				$property->price_to = ($field[15]) ? $field[15] : null;
				$property->price_description = $field[16];
				$property->rental_period = $field[17];
				$auctiondate = DateTime::createFromFormat('d/m/Y',$field[18]);
				$property->auction_date = !empty($field[18]) ? $auctiondate->format('Y-m-d') : null;
				$property->auction_time = $field[19];
				$property->auction_location = $field[20];
				$property->water_frontage = $field[21];
				$property->scenic_view = $field[22];
				$property->air_conditioned = $field[23];
				$property->heritage_other = $field[24];
				$property->lift_installed = $field[25];
				$property->access_security = $field[26];
				$property->close_to_public = $field[27];
				$property->vendor_will_trade = $field[28];
				$property->permanent_water = $field[29];
				$property->mains_electricity = $field[30];
				$property->river_frontage = $field[31];
				$property->coast_frontage = $field[32];
				$property->canal_frontage = $field[33];
				$property->lake_frontage = $field[34];
				$property->sealed_roads = $field[35];
				$property->open_plan = $field[36];
				$property->fireplace = $field[37];
				$property->polished_floors = $field[39];
				$property->swimming_pool = $field[40];
				$property->renovated = $field[41];
				$property->double_storey = $field[43];
				$property->ducted_heating = $field[44];
				$property->granny_flat = $field[45];
				$property->selling_off = $field[46];
				$property->boat_ramp = $field[47];
				$property->ducted_vaccuum = $field[48];
				$property->town_water = $field[49];
				$property->town_sewerage = $field[50];
				$property->curb_chanelling = $field[51];
				$property->all_weather_access = $field[52];
				$property->land_subject = $field[53];
				$property->phone_service = $field[54];
				$property->land_can_be = $field[55];
				$property->trees_on_land = $field[56];
				$property->bedrooms = $field[69];
				$property->m2_total_floor = !empty($field[70]) ? $field[70] : null;
				$property->land_area = !empty($field[71]) ? $field[71] : null;
				$property->land_area_metric = !empty($field[71]) ? $field[72] : '';
				$property->ensuites = !empty($field[73]) ? $field[73] : null;
				$property->toilets = !empty($field[74]) ? $field[74] : null;
				$property->dining_rooms = !empty($field[75]) ? $field[75] : null;
				$property->lounge_dining = !empty($field[76]) ? $field[76] : null;
				$property->other_rooms = !empty($field[77]) ? $field[77] : null;
				$property->lockup_garages = !empty($field[78]) ? $field[78] : null;
				$property->year_built = !empty($field[79]) ? $field[79] : null;
				$property->floor_level = !empty($field[80]) ? $field[80] : null;
				$property->no_of_floor = !empty($field[81]) ? $field[81] : null;
				$property->bathrooms = !empty($field[82]) ? $field[82] : null;
				$property->lounge_rooms = !empty($field[83]) ? $field[83] : null;
				$property->no_of_study = !empty($field[84]) ? $field[84] : null;
				$property->no_of_tennis = !empty($field[85]) ? $field[85] : null;
				$property->family_rumpus = !empty($field[86]) ? $field[86] : null;
				$property->car_spaces = !empty($field[87]) ? $field[87] : null;
				$property->year_building = !empty($field[89]) ? $field[89] : null;
				$property->total_floors = !empty($field[90]) ? $field[90] : null;
				$property->construction_type = $field[97];
				$property->materials_in_roof = $field[98];
				$property->type_of_scenic = $field[99];
				$property->ad_size = $field[102];
				$property->ad_photo_type = $field[103];
				$property->ad_photo_count = $field[104];
				$property->ad_section = $field[105];
				$property->ad_exclusive = $field[106];
				$property->additional_property = $field[107];
				$property->data_entry_date = '';
				$property->rp_property_id = '';
				$property->rp_account_id = '';
				$property->rp_personalized_id = '';
				$property->page_no = '';
				$property->batch_id = '';
				$property->street_direction = !empty($extension[1]) ? $extension[1] : '';
				$property->sale_rent = $field[13] == 'R' ? 'RENT' : 'SALE';
				$property->entry_id = '';
				$property->verify_id = '';
				$property->job_number = '';
				$property->job_number2 = '';
				$property->entry_time = '';
				$property->verify_time = '';
				$property->postcode = '0000';
				$au_id = $property->insert();
			} elseif ($field[0]=='C'){
				$addagent = new Agent_Australia();
				$addagent->au_id = $au_id;
				$addagent->agency_name = $field[2];
				$addagent->agent_firstname = $field[3];
				$addagent->agent_surname =$field[4];
				$addagent->agent_contact = $field[5];
				$addagent->publication_name = $publication_name;
				$addagent->publication_date = $pubdate;
				$addagent->state = $state;
				$addagent->addAgent();
			}
		}
			$message = 'State : '.$state.'<br>';
			$message .= 'Publication Name : '.$publication_name.'<br>';
			$message .= 'Publication Date : '.$pubdate.'<br>';
			$message .= 'Filename : '.$name.'<br>';
			$message .= 'Filetype : '.$filetype.'<br>';
			$message .= 'Errors : '.$upload_error[$error].'<br>';
			$message .= 'File Size : '.$size.'<br>';
			$message .= 'No. Of Rows : '.$countrows.'<br>';
			$message .= 'Record Count : '.$record_count.'<br>';
			$message .= 'Uploaded Successfully!!';
			$session->set_message($message);
			redirect_to('import.php?action=upload');
	}
?>
<?php include("../_layout/adminheader1.php");?>
	<script>
		$(document).ready(function() {
			$("#utilities").addClass("current")
		});
	</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Import Data</h2>
	</div>
	<div id="display">
		<form method="POST" action="import.php" class="filter" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<input type="file" name="file" id="file" required />
				<input type="submit" name="submit" value="Import Data" />
			</fieldset>
		</form>
	</div>
	<div>
		<span><?php echo message($session->message);?></span>
		
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>