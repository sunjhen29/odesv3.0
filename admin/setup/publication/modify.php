<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$modify = Publication::find_by_id($_GET['id']);
?>
<?php include("../../_layout/adminheader1.php");?>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Update Publication</h2>
		<span class="message"><?php echo message($session->message);?></span>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<input type="hidden" name="id" value="<?php echo $modify['id'];?>" /><br>
				<label>Application</label>
				<input type="text" class="small" name="application" value="<?php echo htmlentities($modify['application']); ?>" pattern="[aA-zZ]{2,3}" required /><br>
				<label>State</label>
				<input type="text" class="small" name="state_country" value="<?php echo htmlentities($modify['state_country']); ?>" pattern="[aA-zZ]{2,3}" required /><br>
				<label>Publication Name</label>
				<input type="text" class="superlong" name="pub_name" value="<?php echo htmlentities($modify['pub_name']); ?>" maxlength="150" required /><br>
				<label>Source</label>
				<input type="text" class="long" name="source" value="<?php echo htmlentities($modify['source']); ?>" maxlength="50" required /><br>
				<label>Issue</label>
				<input type="text" class="long" name="issue" value="<?php echo htmlentities($modify['issue']); ?>" maxlength="50" required /><br>
				<label>Job Number</label>
				<input type="text" class="medium" name="job_number" value="<?php echo htmlentities($modify['job_number']); ?>" pattern="[aA-zZ]{2}" required /><br>
				<label>Status</label>
				<input type="text" class="medium" name="status" value="<?php echo htmlentities($modify['status']); ?>" maxlength="15" required /><br>
				<label>Site</label>
				<input type="text" class="superlong" name="site" value="<?php echo htmlentities($modify['site']); ?>" maxlength="100"/><br>
				<label>Code</label>
				<input type="text" class="small" name="code" value="<?php echo htmlentities($modify['Code']); ?>" pattern="[aA-zZ0-9]{3}" required /><br>
				<label>Invalid</label>
				<input type="text" class="small" name="invalid" value="<?php echo htmlentities($modify['Invalid']); ?>" pattern="[yY]{1}"/><br><br>
				<input type="submit" name="add" value="Update Record" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>