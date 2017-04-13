<?php 
	require_once("../../_includes/initialize.php");
	$production_date = !empty($_GET['q']) ? $_GET['q'] : date('d/m/Y');
	$records = NewZealand::operator_stats($production_date);
	$au_records = Australia::operator_stats($production_date);
	$inv_records = Invalid::operator_stats($production_date);
	$job_description = JobNumber::stats_output_description($production_date);
	
	$juliandate = DateTime::createFromFormat('d/m/Y',$production_date);
	$dayNumber = $juliandate->format('y').$juliandate->format('z') + 1;
	$file = $dayNumber.".txt";
	
	header("Content-type: application/octet-stream");//A MIME attachment with the content type "application/octet-stream" is a binary file.
	header("Content-Disposition: attachment; filename={$file}");//with this extension of file name you tell what kind of file it is.
	header("Pragma: no-cache");//Prevent Caching
	header("Expires: 0");//Expires and 0 mean that the browser will not cache the page on your hard drive
	
	
	$fh = fopen($file, 'w');
	//new zealand
	foreach($records as $record){
		fwrite($fh,$record['activity']."       ");
		fwrite($fh,"O".$record['job']."        ");
		fwrite($fh,strlen($record['entry_id'])== 3 ? $record['entry_id'] : "0".$record['entry_id'] );
		fwrite($fh,$job_description["{$record['job']}"]);
		$a = 16 - strlen($job_description["{$record['job']}"]);
		for ($b=1; $b<=$a; $b++){ fwrite($fh," ");}
		fwrite($fh,$record['year'].$record['juliandate']."      ");
		fwrite($fh,$record['total_time'] >= 59 ? gmdate('H i',$record['total_time']) : '00 01');
		fwrite($fh,"          ");
		fwrite($fh,$record['total_time'] >= 59 ? gmdate('H i',$record['total_time']) : '00 01');
		$x = 4 - strlen($record['entry_records']);
		for ($i=0; $i<=$x; $i++){fwrite($fh," ");}
		fwrite($fh,$record['entry_records']);
		fwrite($fh, "\r\n");
	}
	//australia
	foreach($au_records as $au){
		fwrite($fh,$au['activity']."       ");
		fwrite($fh,"O".$au['job']."        ");
		fwrite($fh,strlen($au['entry_id'])== 3 ? $au['entry_id'] : "0".$au['entry_id'] );
		fwrite($fh,$job_description["{$au['job']}"]);
		$a = 16 - strlen($job_description["{$au['job']}"]);
		for ($b=1; $b<=$a; $b++){ fwrite($fh," ");}
		fwrite($fh,$au['year'].$au['juliandate']."      ");
		fwrite($fh,$au['total_time'] >= 59 ? gmdate('H i',$au['total_time']) : '00 01');
		fwrite($fh,"          ");
		fwrite($fh,$au['total_time'] >= 59 ? gmdate('H i',$au['total_time']) : '00 01');
		$x = 4 - strlen($au['entry_records']);
		for ($i=0; $i<=$x; $i++){fwrite($fh," ");}
		fwrite($fh,$au['entry_records']);
		fwrite($fh, "\r\n");
	}
	//invalid
	foreach($inv_records as $inv){
		fwrite($fh,$inv['activity']."       ");
		fwrite($fh,"O".$inv['job']."        ");
		fwrite($fh,strlen($inv['entry_id'])== 3 ? $inv['entry_id'] : "0".$inv['entry_id'] );
		fwrite($fh,'INVALID ');
		for ($b=1; $b<=$a; $b++){ fwrite($fh," ");}
		fwrite($fh,$inv['year'].$inv['juliandate']."      ");
		fwrite($fh,$inv['total_time'] >= 59 ? gmdate('H i',$inv['total_time']) : '00 01');
		fwrite($fh,"          ");
		fwrite($fh,$inv['total_time'] >= 59 ? gmdate('H i',$inv['total_time']) : '00 01');
		$x = 4 - strlen($inv['entry_records']);
		for ($i=0; $i<=$x; $i++){fwrite($fh," ");}
		fwrite($fh,$inv['entry_records']);
		fwrite($fh, "\r\n");
	}
	
	fclose($fh);
	if ($handle = fopen($file,'r')){
		$content = fread($handle, 10000000);
		fclose($handle);
	}
	//echo "<pre>";
	echo $content;
	//echo "</pre>";
?>