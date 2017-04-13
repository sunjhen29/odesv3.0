<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	$users = User::view();
?>
<?php include("../../_layout/adminheader1.php");?>
	<link rel="stylesheet" type="text/css" href="../../_datatables/theme/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../../_datatables/theme/dataTables.jqueryui.css">
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../_datatables/theme/dataTables.jqueryui.js"></script>
	<style>
		td:first-child,td:nth-child(6),td:nth-child(7),td:nth-child(8){
			text-align: center;	
		}
		table{
			color: #238BB2;
		}
	</style>
	<script>
	$(document).ready(function() {
		$("#setup").addClass("current");
		$('#user').dataTable();
	});
	</script>
<?php include("../../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>System Users</h2>
		<span class="message"><?php echo message($session->message); ?></span>
	</div>
	<div id="display">
		<table id="user" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>OPERATOR ID</th>
					<th>USERNAME</th>
					<th>PASSWORD</th>
					<th>FIRSTNAME</th>
					<th>LASTNAME</th>
					<th>ACCESS LEVEL</th>
					<th>ACTIONS</th>
					<th>DATE ADDED</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user){ ?>
				<tr>
					<td><?php echo htmlentities($user['operator_id']);?></td>
					<td><?php echo htmlentities($user['username']);?></td>
					<td><?php echo htmlentities($user['password']);?></td>
					<td><?php echo htmlentities($user['firstname']);?></td>
					<td><?php echo htmlentities($user['lastname']);?></td>
					<td><?php echo htmlentities($user['access_level']);?></td>
					<td>
						<a href="modify.php?id=<?php echo urlencode($user['id']);?>"><button class="action">Modify</button></a>
						<a onclick="return confirm('Are you sure want to delete this record?')" href="process.php?action=delete&id=<?php echo urlencode($user['id']);?>"><button class="action">Delete</button></a>
					</td>
					<td><?php echo $user['date_creation'];?></td>
				</tr>
				<?php }; ?>
			</tbody>
		</table>
	</div>
	<div>
		<a href="adduser.php"><button class="addlink">+ Add User</button></a>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>