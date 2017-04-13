<?php
 require_once("../../_includes/initialize.php"); 
	$publication_lookup = Publication::publication_lookup_with_invalid('AU',$_GET['q']);
	if($publication_lookup){
		print json_encode($publication_lookup);
	}
?>

