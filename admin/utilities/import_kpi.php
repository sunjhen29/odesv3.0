<?php
require_once("../../_includes/initialize.php");
	if(!$session->is_logged_in()){
		redirect_to("../../logout.php"); 
	} else {
		if($session->access_level < 4){
			$session->set_message("You are not authorized to access the page!!");
			redirect_to("../../logout.php"); 
		}
	}
	set_time_limit (300);
	
	
	
	if (isset($_POST['submit'])){
		//check for errors
		$name = $_FILES['file']['name'];
		$filetype = $_FILES['file']['type'];
		$error = $_FILES['file']['error'];
		$size = $_FILES['file']['size'];
		$tmpname = $_FILES['file']['tmp_name'];
		
		//upload file
		$myfile = fopen($_FILES['file']['tmp_name'], "r") or die("Unable to open file!");
		$contents = fread($myfile,filesize($_FILES['file']['tmp_name']));
		fclose($myfile);
		
		$rows= explode("\n",$contents);
		$countrows = count($rows) - 2;
		$record_count = 0;
		
		for($x=0; $x<=$countrows; $x++){	
			$record_count++;
			$kpi = new KPI();
			$kpi->ev = substr($rows[$x],0,8);
			$kpi->job_number = substr($rows[$x],9,5);
			$kpi->operator = substr($rows[$x],21,3);
			$kpi->job_description = trim(substr($rows[$x],24,16));
			$kpi->production_date = substr($rows[$x],40,5);
			$kpi->hours = substr($rows[$x],66,2);
			$kpi->minutes = substr($rows[$x],69,2);
			$kpi->records = substr($rows[$x],72,4);
			$kpi->addKPI();
		}
		//$message = $rows[1]."<br>";
		$message .= 'Filename : '.$name.'<br>';
		$message .= 'Filetype : '.$filetype.'<br>';
		$message .= 'Errors : '.$upload_error[$error].'<br>';
		$message .= 'File Size : '.$size.'<br>';
		$message .= 'No. Of Rows : '.$countrows.'<br>';
		$message .= 'Record Count : '.$record_count.'<br>';
		$message .= 'Uploaded Successfully!!';
		$session->set_message($message);
		redirect_to('import_kpi.php?action=upload');
	}
?>
<?php include("../_layout/adminheader1.php");?>
	<script>
		$(document).ready(function() {
			$("#utilities").addClass("current")
		});
	</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Import KPI Data</h2>
	</div>
	<div id="display">
		<form method="POST" action="import_kpi.php" class="filter" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<input type="file" name="file" id="file" required />
				<input type="submit" name="submit" value="Import Data" />
			</fieldset>
		</form>
	</div>
	<div>
		<span><?php echo message($session->message);?></span>
		
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>