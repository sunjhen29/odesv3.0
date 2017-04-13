<?php
require_once("../_includes/initialize.php");
include("_layout/checklogin.php");
?>
<?php include("_layout/adminheader1.php");?>	
	<script>
		$(document).ready(function() {
			$("#setup").addClass("current")
		});
	</script>
<?php include("_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Setup</h2>
	</div>
	<div id="display">
		<a class="submenu" href="setup/user/default.php">System User</a>
		<a class="submenu" href="setup/jobnumber/default.php">Job Number</a>
		<a class="submenu" href="setup/publication/default.php">Publication List</a>
		<a class="submenu" href="setup/daily/default.php">Daily Records</a>
		<a class="submenu" href="setup/suburb/default.php">AU Postcode</a>
	</div>
</div>
<?php include("_layout/adminfooter.php");?>
