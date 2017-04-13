<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	include("../../_layout/adminheader1.php");
	include("../../_layout/adminheader2.php");
?>
<div id="content">
	<div>
		<h2>Add User</h2>
		<span class="message"><?php echo message($session->message);?></span>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<label>Operator ID</label>
				<input type="text" class="small" name="operator_id" value="" required pattern="[0-9]{2,3}"/ autofocus><br>
				<label>Username</label>
				<input type="text" class="verylong" name="username" value="" required pattern="[aA-zZ0-9]{4,50}"/><br>
				<label>Password</label>
				<input type="text" class="verylong" name="password" value="" required maxlength="20"/><br>
				<label>Firstname</label>
				<input type="text" class="verylong" name="firstname" value="" required maxlength="50"/><br>
				<label>Lastname</label>
				<input type="text" class="verylong" name="lastname" value="" required maxlength="50"/><br>
				<label>Access Level</label>
				<input type="text" name="access_level" class="small" value="" required pattern="[0-9]{1}" /><br><br>
				<input type="submit" name="add" value="Add User" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>