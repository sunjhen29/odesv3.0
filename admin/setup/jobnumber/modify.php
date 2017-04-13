<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$modify = JobNumber::find_by_id($_GET['id']);
?>
<?php include("../../_layout/adminheader1.php");?>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Modify Job Number</h2>
		<span class="message"><?php echo message($session->message);?></span>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<input type="hidden" name="id" value="<?php echo htmlentities($modify['id']);?>" /><br>
				<label>Job Number</label>
				<input type="text" class="medium" name="job_number" value="<?php echo htmlentities($modify['Job_Number']);?>" pattern="[0-9]{4}" readonly/><br>
				<label>Description</label>
					<input type="text" class="long" name="description" value="<?php echo htmlentities($modify['Description']);?>" pattern="[aA-zZ]{2}"/><br>
				<label>Sale / Rent</label>
				<input type="text" class="small" name="sale_rent" value="<?php echo htmlentities($modify['Sale_Rent']);?>" pattern="[sS|Rr]{1}"/><br>
				<label>Current Month</label>
				<input type="text" class="long" name="current_month" value="<?php echo htmlentities($modify['Current_Month']);?>" pattern="[a-zA-Z]{3}[0-9]{4}"/><br>
				<label>Publication Date</label>
				<input type="text" class="long" name="publication_date" value="<?php echo htmlentities($modify['Publication_Date']);?>" pattern="[a-zA-Z]{3}[0-9]{4}"/><br>
				<label>Stats Output</label>
				<input type="text" class="long" name="stats_output" value="<?php echo htmlentities($modify['Stats_Output']);?>" maxlength="10" /><br><br>
				<input type="submit" name="update" value="Update Number" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>