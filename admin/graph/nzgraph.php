<?php
require_once("../../_includes/initialize.php");
	$graph = new PHPGraphLib(800,400);
	$data = Records::nz_graph();
	for ($count = count($data)+ 1; $count <= date('t'); $count++){
		$data[$count] = 0;
	}
	$graph->addData($data);
	$graph->setTitle('Daily Production Total Records '.date('F Y'));
	$graph->setBarColor('255,255,204');
	$graph->createGraph();
?>