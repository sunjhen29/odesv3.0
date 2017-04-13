<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$modifyuser = User::find_by_id($_GET['id']);
?>
<?php include("../../_layout/adminheader1.php");?>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Update User</h2>
		<span class="message"><?php echo message($session->message);?></span>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<input type="hidden" name="id" value="<?php echo htmlentities($modifyuser['id']);?>" /><br>
				<label>Operator ID</label>
				<input type="text" class="small" name="operator_id" value="<?php echo htmlentities($modifyuser['operator_id']);?>" required pattern="[0-9]{2,3}"/ autofocus><br>
				<label>Username</label>
				<input type="text" class="verylong" name="username" value="<?php echo htmlentities($modifyuser['username']);?>" required pattern="[aA-zZ0-9]{4,50}"/><br>
				<label>Password</label>
				<input type="text" class="verylong" name="password" value="<?php echo htmlentities($modifyuser['password']);?>" required maxlength="20"/><br>
				<label>Firstname</label>
				<input type="text" class="verylong" name="firstname" value="<?php echo htmlentities($modifyuser['firstname']);?>" required maxlength="50"/><br>
				<label>Lastname</label>
				<input type="text" class="verylong" name="lastname" value="<?php echo htmlentities($modifyuser['lastname']);?>" required maxlength="50"/><br>
				<label>Access Level</label>
				<input type="text" name="access_level" class="small" value="<?php echo htmlentities($modifyuser['access_level']);?>" required pattern="[0-9]{1}" /><br><br>
				<input type="submit" name="add" value="Update User" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>