<?php
	require_once('../../../_includes/initialize.php');
	include("../../_layout/checklogin.php");
	
	if ($_GET['action'] == 'save'){
		$jobnumber = new JobNumber();
		$jobnumber->id = isset($_POST['id']) ? $_POST['id'] : 0;
		$jobnumber->job_number = strtoupper($_POST['job_number']);
		$jobnumber->description = strtoupper($_POST['description']);
		$jobnumber->sale_rent = strtoupper($_POST['sale_rent']);
		$jobnumber->current_month = strtoupper($_POST['current_month']);
		$jobnumber->publication_date = strtoupper($_POST['publication_date']);
		$jobnumber->stats_output = strtoupper($_POST['stats_output']);
		$jobnumber->save();
		redirect_to("default.php?action=successful");
	}elseif($_GET['action']=='delete'){
		$deletejonumber = JobNumber::delete($_GET['id']);
		$session->set_message("One Record Deleted!!");
		redirect_to("default.php?action=deleted");
	}
?>