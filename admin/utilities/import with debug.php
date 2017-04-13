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

	$backups = Backup::view();
?>
<?php include("../_layout/adminheader1.php");?>
	<style>
		th,td{
			width: auto;
			text-align: center;
		}
		input{
			margin-left: 0;
			padding: 0;
		}
	</style>
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
		<span class="message"><?php echo message($session->message);?></span>
		<form method="post" action="import.php?check=true" class="filter" enctype="multipart/form-data">
			<fieldset>
				<input type="file" name="file" id="file" required />
			<input type="submit" value="View" />
			</fieldset>
		</form>
	</div>
	<div>
		<?php
			$myfile = fopen($_FILES['file']['tmp_name'], "r") or die("Unable to open file!");
			$contents = fread($myfile,filesize($_FILES['file']['tmp_name']));
			fclose($myfile);

			$rows= explode("\n",$contents);
			$countrows = count($rows) - 1;
			
			if (isset($myfile)){
				for($x = 1; $x<=$countrows; $x++){	
					$field = explode("\t",$rows[$x]);
						if($field[0]=='P'){		
							$property = new Australia();
							//$property->id=$_POST['id'];
							$property->sequence_no = "";
							echo 'state : '.$property->state = $field[2].'<br>';
							echo 'publication_name : '.$property->publication_name = $field[3].'<br>';
							$publication_date = DateTime::createFromFormat('d/m/Y',$field[4]);
							echo 'publication date : '.$property->publication_date = $publication_date->format('Y-m-d').'<br>';
							echo 'unit no : '.$property->unit_no = $field[5].'<br>';
							echo 'street no : '.$property->street_no = $field[6].'<br>';
							echo 'street_no_suffix : '.$property->street_no_suffix = $field[7].'<br>';
							echo 'street name : '.$property->street_name = $field[8].'<br>';
							echo 'street extension : '.$property->street_extension = $field[9].'<br>';
							echo 'suburb : '.$property->suburb = $field[10].'<br>';
							echo 'property state : '.$property->city = $field[11].'<br>';
							echo 'property type : '.$property->property_type = $field[12].'<br>';
							echo 'listing type : '.$property->listing_type = $field[13].'<br>';
							echo 'price from : '.$property->price_from = ($field[14]) ? $field[14] : null;
							echo '<br>';
							echo 'price to : '.$property->price_to = ($field[15]) ? $field[15] : null;
							echo '<br>';
							echo 'price descripttion : '.$property->price_description = $field[16].'<br>';
							echo 'rental period : '.$property->rental_period = $field[17].'<br>';
							$auctiondate = DateTime::createFromFormat('d/m/Y',$field[18]);
							echo 'auction date : '.$property->auction_date = !empty($field[18]) ? $auctiondate->format('Y-m-d') : null;
							echo '<br>';
							echo 'auction time : '.$property->auction_time = $field[19].'<br>';
							echo 'auction location : '.$property->auction_location = $field[20].'<br>';
							echo 'water frontage : '.$property->water_frontage = $field[21].'<br>';
							echo 'scenic view : '.$property->scenic_view = $field[22].'<br>';
							echo 'air conditioned : '.$property->air_conditioned = $field[23].'<br>';
							echo 'heritage : '.$property->heritage_other = $field[24].'<br>';
							echo 'lift installed : '.$property->lift_installed = $field[25].'<br>';
							echo 'access security : '.$property->access_security = $field[26].'<br>';
							echo 'close to transport : '.$property->close_to_public = $field[27].'<br>';
							echo 'vendor will trade : '.$property->vendor_will_trade = $field[28].'<br>';
							echo 'permanent water : '.$property->permanent_water = $field[29].'<br>';
							echo 'mains electricity : '.$property->mains_electricity = $field[30].'<br>';
							echo 'river frontage : '.$property->river_frontage = $field[31].'<br>';
							echo 'coast frontage : '.$property->coast_frontage = $field[32].'<br>';
							echo 'canal frontage'.$property->canal_frontage = $field[33].'<br>';
							echo 'lake frontage : '.$property->lake_frontage = $field[34].'<br>';
							echo 'sealed roades : '.$property->sealed_roads = $field[35].'<br>';
							echo 'open plan : '.$property->open_plan = $field[36].'<br>';
							echo 'fireplace : '.$property->fireplace = $field[37].'<br>';
							echo 'polished floor : '.$property->polished_floors = $field[39].'<br>';
							echo 'swimming pool : '.$property->swimming_pool = $field[40].'<br>';
							echo 'renovated : '.$property->renovated = $field[41].'<br>';
							echo 'double storey : '.$property->double_storey = $field[43].'<br>';
							echo 'ducted heating : '.$property->ducted_heating = $field[44].'<br>';
							echo 'granny flat : '.$property->granny_flat = $field[45].'<br>';
							echo 'selling off : '.$property->selling_off = $field[46].'<br>';
							echo 'boat ramp : '.$property->boat_ramp = $field[47].'<br>';
							echo 'ducted vacuum : '.$property->ducted_vaccuum = $field[48].'<br>';
							echo 'town water : '.$property->town_water = $field[49].'<br>';
							echo 'town sewerage : '.$property->town_sewerage = $field[50].'<br>';
							echo 'curb chanelling : '.$property->curb_chanelling = $field[51].'<br>';
							echo 'all weather access : '.$property->all_weather_access = $field[52].'<br>';
							echo 'land subject : '.$property->land_subject = $field[53].'<br>';
							echo 'phone service : '.$property->phone_service = $field[54].'<br>';
							echo 'land can be : '.$property->land_can_be = $field[55].'<br>';
							echo 'trees on land : '.$property->trees_on_land = $field[56].'<br>';
							echo 'bedrooms : '.$property->bedrooms = $field[69].'<br>';
							echo 'm2 total floor : '.$property->m2_total_floor = !empty($field[70]) ? $field[70] : null;
							echo 'land area : '.$property->land_area = !empty($field[71]) ? $field[71] : null;
							echo '<br>';
							echo 'land area metric : '.$property->land_area_metric = !empty($field[71]) ? $field[72] : '';
							echo '<br>';
							echo 'ensuites : '.$property->ensuites = !empty($field[73]) ? $field[73] : null;
							echo '<br>';
							echo 'toilets : '.$property->toilets = !empty($field[74]) ? $field[74] : null;
							echo '<br>';
							echo 'dining rooms : '.$property->dining_rooms = !empty($field[75]) ? $field[75] : null;
							echo '<br>';
							echo 'lounge / dining : '.$property->lounge_dining = !empty($field[76]) ? $field[76] : null;
							echo '<br>';
							echo 'other rooms : '.$property->other_rooms = !empty($field[77]) ? $field[77] : null;
							echo '<br>';
							echo 'lock up garages : '.$property->lockup_garages = !empty($field[78]) ? $field[78] : null;
							echo '<br>';
							echo 'year built : '.$property->year_built = !empty($field[79]) ? $field[79] : null;
							echo '<br>';
							echo 'floor level : '.$property->floor_level = !empty($field[80]) ? $field[80] : null;
							echo '<br>';
							echo 'no of floor : '.$property->no_of_floor = !empty($field[81]) ? $field[81] : null;
							echo '<br>';
							echo 'bathrooms : '.$property->bathrooms = !empty($field[82]) ? $field[82] : null;
							echo '<br>';
							echo 'lounge rooms : '.$property->lounge_rooms = !empty($field[83]) ? $field[83] : null;
							echo '<br>';
							echo 'study rooms : '.$property->no_of_study = !empty($field[84]) ? $field[84] : null;
							echo '<br>';
							echo 'tennis court : '.$property->no_of_tennis = !empty($field[85]) ? $field[85] : null;
							echo '<br>';
							echo 'family rumpus : '.$property->family_rumpus = !empty($field[86]) ? $field[86] : null;
							echo '<br>';
							echo 'car spaces : '.$property->car_spaces = !empty($field[87]) ? $field[87] : null;
							echo '<br>';
							echo 'year building : '.$property->year_building = !empty($field[89]) ? $field[89] : null;
							echo '<br>';
							echo 'total floors : '.$property->total_floors = !empty($field[90]) ? $field[90] : null;
							echo '<br>';
							echo 'construction type : '.$property->construction_type = $field[97].'<br>';
							echo 'roof materials : '.$property->materials_in_roof = $field[98].'<br>';
							echo 'type of scenic : '.$property->type_of_scenic = $field[99].'<br>';
							echo 'adsize : '.$property->ad_size = $field[102].'<br>';
							echo 'ad photo type : '.$property->ad_photo_type = $field[103].'<br>';
							echo 'ad photo count : '.$property->ad_photo_count = $field[104].'<br>';
							echo 'ad section : '.$property->ad_section = $field[105].'<br>';
							echo 'exclusive : '.$property->ad_exclusive = $field[106].'<br>';
							echo 'additional property : '.$property->additional_property = $field[107].'<br>';
							echo $property->data_entry_date = date('Y-m-d');
							echo $property->rp_property_id = "";
							echo $property->rp_account_id = "";
							echo $property->rp_personalized_id = "";
							echo $property->page_no = $x;
							echo $property->batch_id = '';
							echo $property->street_direction = '';
							echo $property->sale_rent = $field[13] == 'R' ? 'RENT' : 'SALE';
							echo $property->entry_id = $session->operator_id;
							echo $property->verify_id = $session->operator_id;
							echo $property->job_number = '5544E';
							echo $property->job_number2 = '5544V';
							$property->entry_time = '';
							$property->verify_time = '';
							$property->date_creation = date('Y-m-d');
							$property->postcode = '0000';
							$property->insert(); 			
						} elseif ($field[0]=='C'){
							$addagent = new Agent_Australia();
							$addagent->au_id = 1;
							$addagent->agency_name = $field[2];
							$addagent->agent_firstname = $field[3];
							$addagent->agent_surname =$field[4];
							$addagent->agent_contact = $field[5];
							$addagent->publication_name = 'THE AGE';
							$addagent->publication_date = '25/03/2015';
							$addagent->state = 'NSW';
							$addagent->addAgent();
						}
					echo "<hr>";
				}
			}
		?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>