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

	$backups = Backup::view();
?>
<?php include("../_layout/adminheader1.php");?>
	<style>
		th,td{
			width: auto;
			text-align: center;
		}
		input{
			margin-left: 0;
			padding: 0;
		}
	</style>
	<script>
		$(document).ready(function() {
			$("#utilities").addClass("current")
		});
	</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Database Backup</h2>
	</div>
	<div id="display">
		<span class="message"><?php echo message($session->message);?></span>
		<form method="POST" action="process.php?action=backup">
			<input type="submit" value="Backup Database" style="width:200px;"/>
		</form>
		<br><br>
		<table cellpadding="2px">
			<tr>
				<th>ID</th>
				<th>Folder</th>
				<th>Filename</th>
				<th>Date Backup</th>
			</tr>
			<?php foreach($backups as $backup){ ?>
			<tr>
				<td><?php echo htmlentities($backup['id']);?></td>
				<td><?php echo htmlentities($backup['folder']);?></td>
				<td><?php echo htmlentities($backup['filename']);?></td>
				<td><?php echo htmlentities($backup['backup_date']);?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>
