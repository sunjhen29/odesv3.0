<?php
 require_once("../_includes/initialize.php"); 
	$description = Publication::find_description($_GET['q']);
	if($description){
		$formattedData = json_encode($description);
		print $formattedData;
	} else {
			echo json_encode("{job_number:''}");
		}
?>

