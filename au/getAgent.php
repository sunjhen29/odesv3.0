<?php
 require_once("../_includes/initialize.php"); 
	if ($session->action == "ENTRY"){
		if($_GET['q']!=''){
			$agent = Agent_Australia::find_agent($_GET['q'],$session->publication_name);
			if($agent){
				$formattedData = json_encode($agent);
				print $formattedData;
			}
		}
	}
?>

