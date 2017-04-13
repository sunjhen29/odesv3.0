<?php 
	require_once("../../_includes/initialize.php");
	$columns = Invalid::get_columns();
	
	foreach ($columns as $column){
		echo $column['Field'];
	}
	
	echo "<pre>";
	print_r($columns);
	echo "</pre>";


?>
