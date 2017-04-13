<?php
 require_once("../_includes/initialize.php"); 
	$agent = NZ_Postcode::find($_GET['street'],$_GET['suburb']);
	if($agent){
		$formattedData = json_encode($agent);
		print $formattedData;
	}
?>

