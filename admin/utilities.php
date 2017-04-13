<?php
require_once("../_includes/initialize.php");
include("_layout/checklogin.php");
?>
<?php include("_layout/adminheader1.php");?>	
	<script>
		$(document).ready(function() {
			$("#utilities").addClass("current")
		});
	</script>
<?php include("_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>System Utilities</h2>
	</div>
	<div id="display">
		<a class="submenu" href="utilities/backupdatabase.php">Backup Database</a>
		<a class="submenu" href="downloads/deletepub.php?status=CLOSE&state=&pubname=&pubdate=">Delete Publication</a>
		<a class="submenu" href="utilities/import.php">Import Data</a>
		<a class="submenu" href="utilities/import_kpi.php">Import KPI Data</a>
		<a class="submenu" href="utilities/import_cbhs.php">Import CBHS File</a>
	</div>
</div>
<?php include("_layout/adminfooter.php");?>
