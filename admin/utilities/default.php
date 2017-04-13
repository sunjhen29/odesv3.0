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
		<h2>Utilities</h2>
	</div>
	<div id="display">
		<input type="text" value="" />	
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>
