<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$modify = AU_Postcode::find_by_id($_GET['id']);
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
				<label>State</label>
					<select name="state" autofocus>
						<?php echo keypairs($state_lkp_au,$modify['State'],false,""); ?>
					</select><br>
				<label>Suburb</label>
				<input type="text" class="verylong" name="suburb" value="<?php echo htmlentities($modify['Suburb']);?>" /><br>
				<label>Post Code</label>
				<input type="text" class="medium" name="post_code" value="<?php echo htmlentities($modify['Post_Code']);?>" pattern="[0-9]{1,4}"/><br><br>
				<input type="submit" name="update" value="Update Record" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>