<?php
	require_once('../../../_includes/initialize.php');
	include("../../_layout/checklogin.php");
	
	if ($_GET['action'] == 'save'){
		$daily = new AU_Postcode();
		$daily->id = isset($_POST['id']) ? $_POST['id'] : 0;
		$daily->state = strtoupper($_POST['state']);
		$daily->suburb = strtoupper($_POST['suburb']);
		$daily->post_code = strtoupper($_POST['post_code']);
		$daily->save();
		redirect_to("default.php?action=successful");
	}elseif($_GET['action']=='delete'){
		$delete = AU_Postcode::delete($_GET['id']);
		$session->set_message("One Record Deleted!!");
		redirect_to("default.php?action=deleted");
	}
?>