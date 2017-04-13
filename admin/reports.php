<?php
require_once("../_includes/initialize.php");
include("_layout/checklogin.php");
?>
<?php include("_layout/adminheader1.php");?>	
	<script>
		$(document).ready(function() {
			$("#reports").addClass("current")
		});
	</script>
<?php include("_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Reports</h2>
	</div>
	<div id="display">
		<a class="submenu" href="reports/bystaffid.php">By Staff ID</a>
		<a class="submenu" href="reports/bystaffrange.php">By Staff ID Advance</a>
		<a class="submenu" href="reports/exportreport.php">Publication Export</a>
		<a class="submenu" href="reports/comparepub.php">Per Publication</a>
		<a class="submenu" href="reports/records.php">Records Per Hour</a>
		<a class="submenu" href="reports/analysis.php">Cost Analysis</a>
	</div>
</div>
<?php include("_layout/adminfooter.php");?>

