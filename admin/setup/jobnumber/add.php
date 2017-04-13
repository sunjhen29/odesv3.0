<?php 
	require_once("../../../_includes/initialize.php");
	include("../../_layout/checklogin.php");
	include("../../_layout/adminheader1.php");
	include("../../_layout/adminheader2.php");
?>
<div id="content">
	<div>
		<h2>Add Job Number</h2>
		<?php echo message($session->message); ?>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>	
				<label>Job Number</label>
				<input type="text" class="medium" name="job_number" value="" pattern="[0-9]{4}"/>
				<br>
				<label>Description</label>
					<input type="text" class="small" name="description" value="" pattern="[aA-zZ]{2}"/>
					<span>
					Enter <strong>AU</strong> for Australia and Chinese, 
					<strong>NZ</strong> for New Zealand, 
					<strong>RP</strong> for RPConnect, 
					<strong>RM</strong> for RPMobile,
					<strong>GL</strong> for Gumtree Land, 
					<strong>GP</strong> for Gumtree SR
					</span>
					<br>
				<label>Sale / Rent</label>
				<input type="text" class="small" name="sale_rent" value="" pattern="[sS|Rr]{1}"/>
				<span> Enter <strong>S</strong> for Sale, <strong>R</strong> for Rent
				<br>
				<label>Current Month</label>
				<input type="text" class="long" name="current_month" value="" placeholder="MMMYYYY" pattern="[a-zA-Z]{3}[0-9]{4}"/>
				<span><strong><?php echo "e.g. ".strtoupper(date('YM'));?></strong></span>
				<br>
				<label>Publication Date</label>
				<input type="text" class="long" name="publication_date" value="" placeholder="MMMYYYY" pattern="[a-zA-Z]{3}[0-9]{4}"/>
				<span><strong><?php echo "e.g. ".strtoupper(date('YM'));?></strong></span><br>
				<label>Stats Output</label>
				<input type="text" class="long" name="stats_output" value="" placeholder="CODE MMM" maxlength="10" />
				Enter SP-S for Australia and Chinese Sale, 
				SP-R for Australia and Chinese Sale, 
				RPCONNE for RPConnect,
				RPMOBILE for RPMobile,
				GUMTREE for Gumtree
				<br><br>
				<input type="submit" name="add" value="Add JobNumber" />
				<a href="default.php" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../../_layout/adminfooter.php");?>