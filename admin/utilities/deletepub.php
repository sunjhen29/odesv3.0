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

	$downloads = Download::view_download('','','','');
?>
<?php include("../_layout/adminheader1.php");?>
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
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>State</th>
					<th>Publication Name</th>
					<th>Publication Date</th>
					<th>Status</th>
					<th>Action</th>
					<th>No. of Days</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($downloads as $download){?>
				<tr>
					<td><?php echo htmlentities($download['id']);?></td>
					<td><?php echo htmlentities($download['State']);?></td>
					<td><?php echo htmlentities($download['Publication_Name']);?></td>
					<td><?php echo htmlentities($download['Publication_Date']);?></td>
					<td><?php echo htmlentities($download['Status']);?></td>
					<td><?php echo htmlentities($download['Date_Creation']);?></td>
					<td><?php echo htmlentities($download['Date_Export']);?></td>
					<td><button>Delete</button></td>
					<td></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>
