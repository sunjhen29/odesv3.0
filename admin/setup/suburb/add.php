<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	include("../../_layout/adminheader1.php");
	include("../../_layout/adminheader2.php");
?>
<div id="content">
	<div>
		<h2>Add Suburb</h2>
		<?php echo message($session->message); ?>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<label>State</label>
					<select name="state" autofocus>
						<?php echo keypairs($state_lkp_au,"",false,""); ?>
					</select><br>
				<label>Suburb</label>
				<input type="text" class="verylong" name="suburb" value=""/><br>
				<label>Post Code</label>
				<input type="text" class="medium" name="post_code" value="" pattern="[0-9]{1,4}"/><br><br>
				<input type="submit" name="add" value="Add Records" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>