<?php
	require_once('../../../_includes/initialize.php');
	include("../../_layout/checklogin.php");
	if ($_GET['action'] == 'save'){
		$publication = new Publication();
		$publication->id = isset($_POST['id']) ? $_POST['id'] : 0;
		$publication->state_country = strtoupper($_POST['state_country']);
		$publication->pub_name = strtoupper($_POST['pub_name']);
		$publication->pub_display = strtoupper($_POST['pub_name']);
		$publication->source = strtoupper($_POST['source']);
		$publication->issue = strtoupper($_POST['issue']);
		$publication->job_number = strtoupper($_POST['job_number']);
		$publication->status = strtoupper($_POST['status']);
		$publication->site = strtoupper($_POST['site']);
		$publication->code = strtoupper($_POST['code']);
		$publication->invalid = strtoupper($_POST['invalid']);
		$publication->application = strtoupper($_POST['application']);
		$publication->save();
		redirect_to("default.php?action=successful");
	}elseif($_GET['action']=='delete'){
		$deletepub = Publication::delete($_GET['id']);
		$session->set_message("One Record Deleted!!");
		redirect_to("default.php?action=deleted");
	}
?>