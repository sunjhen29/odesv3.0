<?php
	require_once('../../_includes/initialize.php');
	include("../_layout/checklogin.php");
	if ($_GET['action'] == 'save'){
		$download = Download::find_duplicate($_POST['state'],$_POST['publication_name'],$_POST['publication_date']);
		if ($download){
			$session->set_message("Record already exist!!");
			redirect_to("adddownload.php");
		} else {
			$download = new Download();
			$download->state = strtoupper($_POST['state']);
			$download->publication_name = strtoupper($_POST['publication_name']);
			$download->publication_date = $_POST['publication_date'];
			$download->pages = $_POST['pages'];
			$download->remarks = strtoupper($_POST['remarks']);
			$download->status = strtoupper($_POST['status']);
			$download->download_id = $session->operator_id;
			$download->code = strtoupper($_POST['pubcode']);
			$download->job_number = strtoupper($_POST['jobnumber']);
			$download->add_download();
			$session->set_message("One record added successfully!!");
			redirect_to("default.php?status=OPEN&state=&pubname=".urlencode($_POST['publication_name'])."&pubdate=");
		}
	}elseif($_GET['action']=='modify'){
		$download = new Download();
		$download->id = $_POST['id'];
		$download->state = strtoupper($_POST['state']);
		$download->publication_name = strtoupper($_POST['publication_name']);
		$download->publication_date = $_POST['publication_date'];
		$download->pages = strtoupper($_POST['pages']);
		$download->remarks = strtoupper($_POST['remarks']);
		$download->status = strtoupper($_POST['status']);
		$download->code = strtoupper($_POST['pubcode']);
		$download->job_number = strtoupper($_POST['jobnumber']);
		$download->update_details();
		$session->set_message("Update Successfull!!");
		redirect_to("default.php?status=OPEN&state=&pubname=&pubdate=");
	}elseif($_GET['action']=='close'){
		$update = new Download();
		$update->id = $_GET['id'];
		$update->status = 'CLOSED';
		$update->sale = $_POST['sale'];
		$update->rent = $_POST['rent'];
		$update->start = $_POST['start'];
		$update->end = $_POST['end'];
		$update->export_date = $_POST['export'];
		$update->update();
		$session->set_message("One record affected!!");
		redirect_to("default.php?status=CLOSED&state=&pubname=&pubdate=");
	}elseif($_GET['action']=='delete'){
		$deletedownload = Download::delete($_GET['id']);
		$session->set_message("One Record Deleted!!");
		redirect_to("default.php?status=OPEN&state=&pubname=&pubdate=");
	}elseif($_GET['action']=='deletepublication'){
		if ($_GET['app']=='AU'){
			$deletepub = Australia::delete_publication($_GET['state'],$_GET['pubname'],$_GET['pubdate']);
			$deleteagents = Agent_Australia::delete_agents($_GET['state'],$_GET['pubname'],$_GET['pubdate']);
			$updatedownload = Download::removed($_GET['id']);
			$session->set_message("Deletion Successfull!!");
			redirect_to("deletepub.php?status=CLOSE&state=&pubname=&pubdate=");
		} elseif($_GET['app']=='NZ'){
			$deletepub = NewZealand::delete_publication($_GET['state'],$_GET['pubname'],$_GET['pubdate']);
			$deleteagents = Agent::delete_agents($_GET['state'],$_GET['pubname'],$_GET['pubdate']);
			$updatedownload = Download::removed($_GET['id']);
			$session->set_message("Deletion Successfull!!");
			redirect_to("deletepub.php?status=CLOSE&state=&pubname=&pubdate=");
		} else {
			$session->set_message("Deletion Failed!!");
			redirect_to("deletepub.php?status=CLOSE&state=&pubname=&pubdate=");
		}
	} 
?>