<?php 
	require_once('../_includes/initialize.php');
	if(!$session->is_logged_in()){
		redirect_to("../logout.php"); //if not redirect to login page
	} 	
	if ($_GET['action']=='modify') {
		$property = new Australia();
		$property->id=$_POST['id'];
		$property->sequence_no = "";
		$property->state = strtoupper($_POST['state']);
		$property->publication_name = strtoupper($_POST['publication_name']);
		$publication_date = DateTime::createFromFormat('d/m/Y',$_POST['publication_date']);
		$property->publication_date = $publication_date->format('Y-m-d');
		$property->unit_no = strtoupper($_POST['unit_no']);
		$property->street_no = strtoupper($_POST['street_no']);
		$property->street_no_suffix = strtoupper($_POST['street_no_suffix']);
		$property->street_name = strtoupper($_POST['street_name']);
		$property->street_extension = strtoupper($_POST['street_extension']);
		$property->suburb = strtoupper($_POST['suburb']);
		$property->city = strtoupper($_POST['state']);
		$property->property_type = strtoupper($_POST['property_type']);
		$property->listing_type = strtoupper($_POST['listing_type']);
		$property->price_from = ($_POST['price_from']) ? $_POST['price_from'] : null;
		$property->price_to = ($_POST['price_to']) ? $_POST['price_to'] : null;
		$property->price_description = strtoupper($_POST['price_description']);
		$property->rental_period = !empty($_POST['rental_period']) ? strtoupper($_POST['rental_period']) : '';
		$auctiondate = DateTime::createFromFormat('d/m/Y',$_POST['auction_date']);
		$property->auction_date = !empty($_POST['auction_date']) ? $auctiondate->format('Y-m-d') : null;
		$property->auction_time = $_POST['auction_time'];
		$property->auction_location = strtoupper($_POST['auction_location']);
		$property->water_frontage = !empty($_POST["water_frontage"]) ? 'Y' : '';
		$property->scenic_view = !empty($_POST["scenic_view"]) ? 'Y' : '';
		$property->air_conditioned = !empty($_POST["air_conditioned"]) ? 'Y' : '';
		$property->heritage_other = !empty($_POST["heritage_other"]) ? 'Y' : '';
		$property->lift_installed = !empty($_POST["lift_installed"]) ? 'Y' : '';
		$property->access_security = !empty($_POST["access_security"]) ? 'Y' : '';
		$property->close_to_public = !empty($_POST["close_to_public"]) ? 'Y' : '';
		$property->vendor_will_trade = !empty($_POST["vendor_will_trade"]) ? 'Y' : '';
		$property->permanent_water = !empty($_POST["permanent_water"]) ? 'Y' : '';
		$property->mains_electricity = !empty($_POST["mains_electricity"]) ? 'Y' : '';
		$property->river_frontage = !empty($_POST["river_frontage"]) ? 'Y' : '';
		$property->coast_frontage = !empty($_POST["coast_frontage"]) ? 'Y' : '';
		$property->canal_frontage = !empty($_POST["canal_frontage"]) ? 'Y' : '';
		$property->lake_frontage = !empty($_POST["lake_frontage"]) ? 'Y' : '';
		$property->sealed_roads = !empty($_POST["sealed_roads"]) ? 'Y' : '';
		$property->open_plan = !empty($_POST["open_plan"]) ? 'Y' : '';
		$property->fireplace = !empty($_POST["fireplace"]) ? 'Y' : '';
		$property->polished_floors = !empty($_POST["polished_floors"]) ? 'Y' : '';
		$property->swimming_pool = !empty($_POST["swimming_pool"]) ? 'Y' : '';
		$property->renovated = !empty($_POST["renovated"]) ? 'Y' : '';
		$property->double_storey = !empty($_POST["double_storey"]) ? 'Y' : '';
		$property->ducted_heating = !empty($_POST["ducted_heating"]) ? 'Y' : '';
		$property->granny_flat = !empty($_POST["granny_flat"]) ? 'Y' : '';
		$property->selling_off = !empty($_POST["selling_off"]) ? 'Y' : '';
		$property->boat_ramp = !empty($_POST["boat_ramp"]) ? 'Y' : '';
		$property->ducted_vaccuum = !empty($_POST["ducted_vaccuum"]) ? 'Y' : '';
		$property->town_water = !empty($_POST["town_water"]) ? 'Y' : '';
		$property->town_sewerage = !empty($_POST["town_sewerage"]) ? 'Y' : '';
		$property->curb_chanelling = !empty($_POST["curb_chanelling"]) ? 'Y' : '';
		$property->all_weather_access = !empty($_POST["all_weather_access"]) ? 'Y' : '';
		$property->land_subject = !empty($_POST["land_subject"]) ? 'Y' : '';
		$property->phone_service = !empty($_POST["phone_service"]) ? 'Y' : '';
		$property->land_can_be = !empty($_POST["land_can_be"]) ? 'Y' : '';
		$property->trees_on_land = !empty($_POST["trees_on_land"]) ? 'Y' : '';
		$property->bedrooms = $_POST['bedrooms'];
		$property->m2_total_floor = !empty($_POST['m2_total_floor']) ? $_POST['m2_total_floor'] : null;
		$property->land_area = !empty($_POST['land_area']) ? $_POST['land_area'] : null;
		$property->land_area_metric = !empty($_POST['land_area']) ? $_POST['land_area_metric'] : '';
		$property->ensuites = !empty($_POST['ensuites']) ? $_POST['ensuites'] : null;
		$property->toilets = !empty($_POST['toilets']) ? $_POST['toilets'] : null;
		$property->dining_rooms = !empty($_POST['dining_rooms']) ? $_POST['dining_rooms'] : null;
		$property->lounge_dining = !empty($_POST['lounge_dining']) ? $_POST['lounge_dining'] : null;
		$property->other_rooms = !empty($_POST['other_rooms']) ? $_POST['other_rooms'] : null;
		$property->lockup_garages = !empty($_POST['lockup_garages']) ? $_POST['lockup_garages'] : null;
		$property->year_built = !empty($_POST['year_built']) ? $_POST['year_built'] : null;
		$property->floor_level = !empty($_POST['floor_level']) ? $_POST['floor_level'] : null;
		$property->no_of_floor = !empty($_POST['no_of_floor']) ? $_POST['no_of_floor'] : null;
		$property->bathrooms = !empty($_POST['bathrooms']) ? $_POST['bathrooms'] : null;
		$property->lounge_rooms = !empty($_POST['lounge_rooms']) ? $_POST['lounge_rooms'] : null;
		$property->no_of_study = !empty($_POST['no_of_study']) ? $_POST['no_of_study'] : null;
		$property->no_of_tennis = !empty($_POST['no_of_tennis']) ? $_POST['no_of_tennis'] : null;
		$property->family_rumpus = !empty($_POST['family_rumpus']) ? $_POST['family_rumpus'] : null;
		$property->car_spaces = !empty($_POST['car_spaces']) ? $_POST['car_spaces'] : null;
		$property->year_building = !empty($_POST['year_building']) ? $_POST['year_building'] : null;
		$property->total_floors = !empty($_POST['total_floors']) ? $_POST['total_floors'] : null;
		$property->construction_type = strtoupper($_POST['construction_type']);
		$property->materials_in_roof = strtoupper($_POST['materials_in_roof']);
		$property->type_of_scenic = strtoupper($_POST['type_of_scenic']);
		$property->ad_size = strtoupper($_POST['ad_size']);
		$property->ad_photo_type = strtoupper($_POST['ad_photo_type']);
		$property->ad_photo_count = strtoupper($_POST['ad_photo_count']);
		$property->ad_section = strtoupper($_POST['ad_section']);
		$property->ad_exclusive = strtoupper($_POST['ad_exclusive']);
		$property->additional_property = strtoupper($_POST['additional_property']);
		$property->data_entry_date = date('Y-m-d');
		$property->rp_property_id = "";
		$property->rp_account_id = "";
		$property->rp_personalized_id = "";
		$property->page_no = $_POST['page_no'];
		$property->batch_id = strtoupper($_POST['batch_id']);
		$property->street_direction = strtoupper($_POST['street_direction']);
		$property->sale_rent = strtoupper($_POST['sale_rent']);
		$property->postcode = !empty($_POST['post_code']) ? $_POST['post_code'] : '';
		$property->update();
		
		$agent_id = $_POST['agent_id'];
		$agency_name = $_POST['agency_name'];
		$agent_firstname = $_POST['agent_firstname'];
		$agent_surname = $_POST['agent_surname'];
		$agent_contact = $_POST['agent_contact'];
		
		for($count=0; $count<=4; $count++){
			if ($agency_name[$count] != "" || $agent_contact[$count] != ""){
				$addagent = new Agent_Australia();
				$addagent->id = !empty($agent_id[$count]) ? $agent_id[$count] : 0;
				$addagent->au_id = $property->id;
				$addagent->agency_name = strtoupper($agency_name[$count]);
				$addagent->agent_firstname = strtoupper($agent_firstname[$count]);
				$addagent->agent_surname = strtoupper($agent_surname[$count]);
				$addagent->agent_contact = strtoupper($agent_contact[$count]);
				$addagent->publication_name = $_POST['publication_name'];
				$addagent->publication_date = $_POST['publication_date'];
				$addagent->state = $_POST['state'];
				$addagent->save();
			} else {
				if($agent_id[$count]){
					$deleted = Agent_Australia::delete($agent_id[$count]);
				}
			}
		}
		redirect_to("default.php?&state=".$_POST['state']."&publication_name=".urlencode($_POST['publication_name'])."&publication_date=".$_POST['publication_date']."&batch_id=");
	} else if($_GET['action'] == 'delete'){
		$deleted_agent = Agent_Australia::delete_by_nzid($_GET['id']);
		$affected = Australia::delete($_GET['id']);
		redirect_to("default.php?&state=".$_GET['state']."&publication_name=".urlencode($_GET['publication_name'])."&publication_date=".$_GET['publication_date']."&batch_id=");
	} 	
	
?>
