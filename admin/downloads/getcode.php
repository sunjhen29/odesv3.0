<?php 
	require_once("../../_includes/initialize.php");
	$code = Publication::getCode($_GET['q']);
		if($code){
			$formattedData = json_encode($code);
			print $formattedData;
		} else {
			echo json_encode("{code: '',job_number:''}");
		}
?>