<?php
 require_once("../_includes/initialize.php"); 
	$agent = NZ_Postcode::find_au_postcode($_GET['state'],$_GET['suburb']);
	if($agent){
		$formattedData = json_encode($agent);
		print $formattedData;
	} else {
		print '{"post_code":"0000"}';
	}
?>

