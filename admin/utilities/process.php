<?php
	require_once('../../_includes/initialize.php');
	include("../_layout/checklogin.php");
	if ($_GET['action'] == 'backup'){
		$backup = Backup::backupdatabase();
		$session->set_message("Backup Successful!!");
		redirect_to("backupdatabase.php");
	}
?>