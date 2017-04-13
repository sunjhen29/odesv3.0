<?php
require_once("../_includes/initialize.php");
include("_layout/checklogin.php");
?>
<?php include("_layout/adminheader1.php");?>	
	<script>
		$(document).ready(function() {
			$("#exports").addClass("current")
		});
	</script>
<?php include("_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Exports</h2>
	</div>
	<div id="display">
		<a class="submenu" href="exports/bypublication.php">By Publication</a>
		<a class="submenu" href="exports/invalidexport.php">Invalid Entries</a>
		<a class="submenu" href="exports/operatorstats.php">Exports Stats</a>
		<a class="submenu" href="exports/operatorstatskpi.php">Exports Stats [KPI]</a>
		<a class="submenu" href="exports/cbhs_export.php">Export CBHS XML</a>
	</div>
</div>
<?php include("_layout/adminfooter.php");?>
