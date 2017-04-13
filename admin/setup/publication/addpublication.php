<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	include("../../_layout/adminheader1.php");
	include("../../_layout/adminheader2.php");
?>
<div id="content">
	<div>
		<h2>Add Publication</h2>
		<span class="message"><?php echo message($session->message);?></span>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<label>Application</label>
				<input type="text" class="small" name="application" value="" pattern="[aA-zZ]{2,3}" required autofocus />
				<span>Enter AU for Australia, NZ for New Zealand</span>
				<br>
				<label>State</label>
				<input type="text" class="small" name="state_country" value="" pattern="[aA-zZ]{2,3}" required /><br>
				<label>Publication Name</label>
				<input type="text" class="superlong" name="pub_name" value="" maxlength="150" required /><br>
				<label>Source</label>
				<input type="text" class="long" name="source" value="" maxlength="50" required />
				<span>e.g. ONLINE, FTP, EMAIL</span>
				<br>
				<label>Issue</label>
				<input type="text" class="long" name="issue" value="" maxlength="50" required />
				<span>WEEKLY, MONTHLY, RANDOM, BI-WEEKLY, FORNIGHTLY, WEEKDAYS ONLY</span>
				<br>
				<label>Job Number</label>
				<input type="text" class="medium" name="job_number" value="" pattern="[aA-zZ]{2}" required />
				<span>
					Enter <strong>AU</strong> for Australia and Chinese, 
					<strong>NZ</strong> for New Zealand, 
					<strong>RP</strong> for RPConnect, 
					<strong>RM</strong> for RPMobile,
					<strong>GL</strong> for Gumtree Land, 
					<strong>GP</strong> for Gumtree SR
				</span>
				<br>
				<label>Status</label>
				<input type="text" class="medium" name="status" value="" maxlength="15" required />
				<span>Enter ACTIVE or INACTIVE</span>
				<br>
				<label>Site</label>
				<input type="text" class="superlong" name="site" value="" maxlength="100"/><br>
				<label>Code</label>
				<input type="text" class="small" name="code" value="" pattern="[aA-zZ0-9]{3}" required /><br>
				<label>Invalid</label>
				<input type="text" class="small" name="invalid" value="" pattern="[yY]{1}"/><br><br>				
				<input type="submit" name="add" value="Add Publication" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>