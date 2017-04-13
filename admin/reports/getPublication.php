<?php
 require_once("../../_includes/initialize.php"); 
	$publication_lookup = Publication::all_publication_lookup($_GET['q']);
	if($publication_lookup){
		print json_encode($publication_lookup);
	}
?>

