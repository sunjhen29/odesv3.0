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

		/* if (is_uploaded_file($_FILES['filename']['tmp_name'])){
			echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded;
			echo "<h2>Displaying contents:</h2>";
			readfile($_FILES['filename']['tmp_name']);
			}
		 */


		//check for errors
		$name = $_FILES['file']['name'];
		$filetype = $_FILES['file']['type'];
		$error = $_FILES['file']['error'];
		$size = $_FILES['file']['size'];
		$tmpname = $_FILES['file']['tmp_name'];
		$row_count = 0;
		$handle = fopen($_FILES['file']['tmp_name'], "r") or die("Unable to open file!");

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$import_csv = new Cbhs();
			$import_csv->batch_id = $data[1];
			$import_csv->membershipId = $data[2];
			$import_csv->identifier = $data[3];
			$import_csv->exportfilename = $data[4];
			$import_csv->claimstatus = $data[5];
			$import_csv->pagecount = $data[6];
			$import_csv->patientName = $data[7];
			$import_csv->dateofbirth = $data[8];
			$import_csv->providerNumber = $data[9];
			$import_csv->serviceType = $data[10];
			$import_csv->itemNumber = $data[11];
			$import_csv->dateofservice = $data[12];
			$import_csv->accountPaid = $data[13];
			$import_csv->fee = $data[14];
			$import_csv->insert_cbhs();
			$row_count++;
	    }

		$message  = 'Filename : '.$name.'<br>';
		$message .= 'File Type : '.$filetype.'<br>';
		$message .= 'Error : '.$error.'<br>';
		$message .= 'Size : '.$size.'<br>';
		$message .= 'No. of rows Read: '.$row_count.'<br>';
		$message .= $row_count.' records uploaded Successfully!!<br>';

		$session->set_message($message);
		redirect_to('import_cbhs.php?action=upload');
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
		<h2>Import Data</h2>
	</div>
	<div id="display">
		<form method="POST" action="import_cbhs.php" class="filter" enctype="multipart/form-data">
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