<?php
	require_once('../../../_includes/initialize.php');
	include("../../_layout/checklogin.php");
	
	if ($_GET['action'] == 'save'){
		$daily = new Records();
		$daily->id = isset($_POST['id']) ? $_POST['id'] : 0;
		$daily->production_date = strtoupper($_POST['production_date']);
		$daily->au = strtoupper($_POST['au']);
		$daily->nz = strtoupper($_POST['nz']);
		$daily->inv = strtoupper($_POST['inv']);
		$daily->save();
		redirect_to("default.php?action=successful");
	}elseif($_GET['action']=='delete'){
		$delete = Records::delete($_GET['id']);
		$session->set_message("One Record Deleted!!");
		redirect_to("default.php?action=deleted");
	}
?>