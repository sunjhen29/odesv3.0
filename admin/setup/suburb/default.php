<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$suburbs = AU_Postcode::view();
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
		$('#aupostcode').dataTable();
	});
	</script>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Australian Suburb Setup</h2>
		<span class="message"><?php echo htmlentities(message($session->message)); ?></span>
	</div>
	<div id="display">
	<table id="aupostcode" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>State</th>
				<th>Suburb</th>
				<th>Post Code</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($suburbs as $suburb){ ?>
			<tr>
				<td><?php echo $suburb['State'];?></td>
				<td><?php echo $suburb['Suburb'];?></td>
				<td><?php echo $suburb['Post_Code'];?></td>
				<td>
					<a href="modify.php?id=<?php echo $suburb['id'];?>"><button class="action">Modify</button></a>
					<a onclick="return confirm('Are you sure want to delete this record?')" href="process.php?action=delete&id=<?php echo $suburb['id'];?>"><button class="action">Delete</button></a>
				</td>
			</tr>
			<?php }; ?>
		</tbody>
	</table>
	</div>
	<div>
		<br>
		<a href="add.php"><button class="addlink">+ Add Suburb</button></a>
		<br>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>