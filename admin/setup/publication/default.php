<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$publications = Publication::view();
?>
<?php include("../../_layout/adminheader1.php");?>
<link rel="stylesheet" type="text/css" href="../../_datatables/theme/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../../_datatables/theme/dataTables.jqueryui.css">
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/dataTables.jqueryui.js"></script>
	<style>
		td:first-child,td:nth-child(4),td:nth-child(6),td:nth-child(7),td:nth-child(8),td:nth-child(9),td:nth-child(10){
			text-align: center;	
		}
		table{
			color: #238BB2;
		}
	</style>
	<script>
	$(document).ready(function() {
		$("#setup").addClass("current");
		$('#publication').dataTable();
	});
	</script>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>List Of Publications</h2>
		<span><?php echo message($session->message); ?></span>
	</div>
	<br>
	<div id="datatables">
	<table id="publication" class="display">
		<thead>
			<tr>
				<th>APP</th>
				<th>STATE</th>
				<th>PUBLICATION NAME</th>
				<th>SOURCE</th>
				<th>ISSUE</th>
				<th>STATUS</th>
				<th>CODE</th>
				<th>INV.</th>
				<th>ACTIONS</th>
				<th>ADDED</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($publications as $publication){ ?>
			<tr>
				<td><?php echo htmlentities($publication['application']);?></td>
				<td><?php echo htmlentities($publication['state_country']);?></td>
				<td><?php echo htmlentities($publication['pub_name']);?></td>
				<td><?php echo htmlentities($publication['source']);?></td>
				<td><?php echo htmlentities($publication['issue']);?></td>
				<td><?php echo htmlentities($publication['status']);?></td>
				<td><?php echo htmlentities($publication['Code']);?></td>
				<td><?php echo htmlentities($publication['Invalid']);?></td>
				<td>
					<a href="modify.php?id=<?php echo urlencode($publication['id']);?>"><button class="action">Modify</button></a>
					<a onclick="return confirm('Are you sure want to delete this record?')" href="process.php?action=delete&id=<?php echo urlencode($publication['id']);?>"><button class="action">Delete</button></a>
				</td>
				<td><?php echo $publication['date_creation'];?></td>
			</tr>
			<?php }; ?>
		</tbody>
	</table>
	</div>
	<div>
		<br>
		<a href="addpublication.php"><button class="addlink">+ Add Publication</button></a>
		<br>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>