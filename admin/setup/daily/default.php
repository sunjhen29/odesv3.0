<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$daily = Records::view();
?>
<?php include("../../_layout/adminheader1.php");?>
	<link rel="stylesheet" type="text/css" href="../../_datatables/theme/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../../_datatables/theme/dataTables.jqueryui.css">
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/dataTables.jqueryui.js"></script>
	<style>
		td:first-child,td:nth-child(3){
			text-align: center;	
		}
		td:nth-child(2){
			text-align: right;	
		}
		table{
			color: #238BB2;
		}
	</style>
	<script>
	$(document).ready(function() {
		$("#setup").addClass("current");
		$('#daily').dataTable();
	});
	</script>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Daily Records Setup</h2>
		<span class="message"><?php echo htmlentities(message($session->message)); ?></span>
	</div>
	<div id="display">
	<table id="daily" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>PRODUCTION DATE</th>
				<th>NEW ZEALAND</th>
				<th>AUSTRALIA</th>
				<th>INVALID</th>
				<th>TOTAL</th>
				<th>COMMAND</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($daily as $day){ ?>
			<tr>
				<td><?php echo $day['production_date'];?></td>
				<td><?php echo $day['nz'];?></td>
				<td><?php echo $day['au'];?></td>
				<td><?php echo $day['inv'];?></td>
				<td><?php echo $day['nz'] + $day['au'] + $day['inv'];?></td>
				<td>
					<a href="modify.php?id=<?php echo $day['id'];?>"><button class="action">Modify</button></a>
					<a onclick="return confirm('Are you sure want to delete this record?')" href="process.php?action=delete&id=<?php echo $day['id'];?>"><button class="action">Delete</button></a>
				</td>
			</tr>
			<?php }; ?>
		</tbody>
	</table>
	</div>
	<div>
		<br>
		<a href="add.php"><button class="addlink">+ Add Daily Records</button></a>
		<br>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>