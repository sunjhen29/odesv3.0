<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$modify = Records::find_by_id($_GET['id']);
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
				<label>Production Date</label>
				<input type="date" class="long" name="production_date" value="<?php echo htmlentities($modify['production_date']);?>"/><br>
				<label>New zealand</label>
				<input type="text" class="medium" name="nz" value="<?php echo htmlentities($modify['nz']);?>" pattern="[aA-zZ0-9]{1,11}"/><br>
				<label>Australia</label>
				<input type="text" class="medium" name="au" value="<?php echo htmlentities($modify['au']);?>" pattern="[aA-zZ0-9]{1,11}"/><br>
				<label>Invalid</label>
				<input type="text" class="medium" name="inv" value="<?php echo htmlentities($modify['inv']);?>" pattern="[aA-zZ0-9]{1,11}"/><br><br>
				<input type="submit" name="update" value="Update Record" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>