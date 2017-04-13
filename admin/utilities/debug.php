<?php
	require_once('../../_includes/initialize.php');
	$str = "STREET";
	$split = explode(" ",$str);
	
	print_r($split);
	echo "<br>";
	echo $split[0];
	echo "<br>";
	echo $split[1];
	
	
?>