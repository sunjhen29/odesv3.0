<?php
require_once("../_includes/initialize.php");
if(!$session->is_logged_in()){
	redirect_to("../logout.php"); 
} else {
	if($session->access_level < 4){
		$session->set_message("You are not authorized to access the page!!");
		redirect_to("../logout.php"); 
	}
}
?>
<?php include("_layout/adminheader1.php");?>	
	<style>
		p{
			color: gray;
			font-size: 24px;
		}
		img{
			border: 1px solid gray;
		}
	</style>
	<script>
		$(document).ready(function() {
			$("#contact").addClass("current")
		});
	</script>
<?php include("_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Contact</h2>
	</div>
	<div id="display">
		<div class="contact">
			<p>10F Salustiana D. Ty Tower,<br>
			   104 Paseo de Roxas Avenue, Makati City<br><br>
			   +63 2 556 9967<br>
			   +63 2 808 8087
			</p>	
		</div>
		<div class="map">
			<img src="_images/map.jpg" />
		</div>
	</div>
</div>
<?php include("_layout/adminfooter.php");?>
