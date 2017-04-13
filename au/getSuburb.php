<?php
 require_once("../_includes/initialize.php"); 
	$suburb = AU_Postcode::search_suburb($_GET['suburb']);
	if($suburb){
		$formattedData = json_encode($suburb);
		print $formattedData;
	} else {
		print '{"post_code":"0000"}';
	}
?>

