<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$jobnumbers = JobNumber::view();
?>
<?php include("../../_layout/adminheader1.php");?>
	<link rel="stylesheet" type="text/css" href="../../_datatables/theme/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../../_datatables/theme/dataTables.jqueryui.css">
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/dataTables.jqueryui.js"></script>
	<style>
		td:first-child,td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(7),td:nth-child(8){
			text-align: center;	
		}
		table{
			color: #238BB2;
		}
	</style>
	<script>
	$(document).ready(function() {
		$("#setup").addClass("current");
		$('#jobnumber').dataTable();
	});
	</script>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Job Number</h2>
		<span class="message"><?php echo htmlentities(message($session->message)); ?></span>
	</div>
	<div id="display">
	<table id="jobnumber" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>JOB NUMBER</th>
				<th>DESCRIPTION</th>
				<th>SALE/RENT</th>
				<th>CURRENT MONTH</th>
				<th>PUBLICATION DATE</th>
				<th>STATS OUTPUT</th>
				<th>ACTIONS</th>
				<th>DATE ADDED</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($jobnumbers as $jobnumber){ ?>
			<tr>
				<td><?php echo $jobnumber['Job_Number'];?></td>
				<td><?php echo $jobnumber['Description'];?></td>
				<td><?php echo $jobnumber['Sale_Rent'];?></td>
				<td><?php echo $jobnumber['Current_Month'];?></td>
				<td><?php echo $jobnumber['Publication_Date'];?></td>
				<td><?php echo $jobnumber['Stats_Output'];?></td>
				<td>
					<a href="modify.php?id=<?php echo $jobnumber['id'];?>"><button class="action">Modify</button></a>
					<a onclick="return confirm('Are you sure want to delete this record?')" href="process.php?action=delete&id=<?php echo $jobnumber['id'];?>"><button class="action">Delete</button></a>
				</td>
				<td><?php echo $jobnumber['Date_Creation'];?></td>
			</tr>
			<?php }; ?>
		</tbody>
	</table>
	</div>
	<div>
		<br>
		<a href="add.php"><button class="addlink">+ Add Job Number</button></a>
		<br>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>