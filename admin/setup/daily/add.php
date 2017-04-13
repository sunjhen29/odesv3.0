<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	include("../../_layout/adminheader1.php");
	include("../../_layout/adminheader2.php");
?>
<div id="content">
	<div>
		<h2>Add Daily Records</h2>
		<?php echo message($session->message); ?>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<label>Production Date</label>
				<input type="date" class="long" name="production_date" value=""/><br>
				<label>NEW ZEALAND</label>
				<input type="text" class="medium" name="nz" value="" pattern="[0-9]{1,11}"/><br>
				<label>AUSTRALIA</label>
				<input type="text" class="medium" name="au" value="" pattern="[0-9]{1,11}"/><br>
				<label>INVALID</label>
				<input type="text" class="medium" name="inv" value="" pattern="[0-9]{1,11}"/><br><br>
				<input type="submit" name="add" value="Add Records" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>