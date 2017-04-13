<?php
	require_once('../../../_includes/initialize.php');
	include("../../_layout/checklogin.php");
	if ($_GET['action'] == 'save'){
		$user = new User();
		$user->id = isset($_POST['id']) ? $_POST['id'] : 0;
		$user->operator_id = $_POST['operator_id'];
		$user->username = strtoupper($_POST['username']);
		$user->password = strtoupper($_POST['password']);
		$user->firstname = strtoupper($_POST['firstname']);
		$user->lastname = strtoupper($_POST['lastname']);
		$user->access_level = $_POST['access_level'];
		
		if (isset($_POST['id'])){
			//$find_duplicate = User::find_username($_POST['username']);
			//if ($find_duplicate){
				//$session->set_message("Username already exist!!");
				//redirect_to("adduser.php?action=failed");
			//}
			$session->set_message("Update Successfull!!");
		} else {
			$find_duplicate = User::find_duplicate($_POST['operator_id'],$_POST['username']);
			if ($find_duplicate){
				$session->set_message("Record already exist!!");
				redirect_to("adduser.php?action=failed");
			}
			$session->set_message("One Record Added!!");
		}
		$user->save();
		redirect_to("default.php?action=successful");
	}elseif($_GET['action']=='delete'){
		$deleteuser = User::delete($_GET['id']);
		$session->set_message("One Record Deleted!!");
		redirect_to("default.php?action=deleted");
	}
?>