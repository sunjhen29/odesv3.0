<?php 
	require_once('../_includes/initialize.php');
	if(!$session->is_logged_in()){
		redirect_to("../logout.php"); //if not redirect to login page
	}
	if ($_GET['action']=='modify') {
		$property = new Invalid();
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
		$property->multiple = strtoupper($_POST['multiple']);
		$property->property_type = strtoupper($_POST['property_type']);
		$property->property_state = strtoupper($_POST['property_state']);
		$property->listing_type = strtoupper($_POST['listing_type']);
		$property->price_from = ($_POST['price_from']) ? $_POST['price_from'] : null;
		$property->price_to = ($_POST['price_to']) ? $_POST['price_to'] : null;
		$property->price_description = strtoupper($_POST['price_description']);
		$auctiondate = DateTime::createFromFormat('d/m/Y',$_POST['auction_date']);
		$property->auction_date = !empty($_POST['auction_date']) ? $auctiondate->format('Y-m-d') : null;
		$property->auction_time = $_POST['auction_time'];
		$property->auction_location = strtoupper($_POST['auction_location']);
		$property->air_conditioned = !empty($_POST["air_conditioned"]) ? 'YES' : 'NO';
		$property->close_to_public = !empty($_POST["close_to_public"]) ? 'YES' : 'NO';
		$property->swimming_pool = !empty($_POST["swimming_pool"]) ? 'YES' : 'NO';
		$property->bedrooms = $_POST['bedrooms'];
		$property->bathrooms = !empty($_POST['bathrooms']) ? $_POST['bathrooms'] : null;
		$property->car_spaces = !empty($_POST['car_spaces']) ? $_POST['car_spaces'] : null;
		$property->ad_size = strtoupper($_POST['ad_size']);
		$property->ad_photo_type = strtoupper($_POST['ad_photo_type']);
		$property->ad_photo_count = strtoupper($_POST['ad_photo_count']);
		$property->ad_section = strtoupper($_POST['ad_section']);
		$property->ad_exclusive = strtoupper($_POST['ad_exclusive']);
		$property->agency_name = strtoupper($_POST['agency_name']);
		$property->contact = strtoupper($_POST['contact']);
		$property->firstname = strtoupper($_POST['firstname']);
		$property->lastname = strtoupper($_POST['lastname']);
		$property->comment = strtoupper($_POST['comment']);
		$property->data_entry_date = date('Y-m-d');
		$property->page_no = $_POST['page_no'];
		$property->batch_id = strtoupper($_POST['batch_id']);
		$property->street_direction = strtoupper($_POST['street_direction']);
		$property->sale_rent = strtoupper($_POST['sale_rent']);
		$property->entry_id = $session->operator_id;
		$property->job_number = $session->job_number."E";
		$property->entry_time = time() - $session->start;
		$property->date_creation = date('Y-m-d');
		$property->save();
		redirect_to("default.php?&state=".$_POST['state']."&publication_name=".urlencode($_POST['publication_name'])."&publication_date=".$_POST['publication_date']."&batch_id=");
	} else if($_GET['action']=='delete'){
		$delete_invalid = Invalid::delete($_GET['id']);
		redirect_to("default.php?&state=".$_GET['state']."&publication_name=".urlencode($_GET['publication_name'])."&publication_date=".$_GET['publication_date']."&batch_id=");
	}
?>
