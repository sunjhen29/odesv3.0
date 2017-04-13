<?php
require_once("../../_includes/initialize.php");
include("../_layout/checklogin.php");

$batch_no = isset($_GET['batch_no']) ? $_GET['batch_no'] : 9999;
$records = Cbhs::view_batches($batch_no);

?>
<?php include("../_layout/adminheader1.php");?>
<?php include("../_layout/datatables.php");?>
<script>
	$(document).ready(function() {
		$("#exports").addClass("current");
		$('#operator_stats').dataTable({
			"lengthMenu": [[-1], ["All"]]

		});
	});
</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Export CBHS XML File</h2>
	</div>
	<div id="display">
		<form class="filter">
			<fieldset>
				<label>Batch No. From :</label>
				<input id="batch_no" class="medium" name="batch_no" type="text" value="<?php echo !empty($_GET['batch_no']) ? $_GET['batch_no'] : '9999'; ?>" required/>
				<input type="submit" value="Submit" />
			</fieldset>
		</form>
		<?php if($records) {?>
			<table id="operator_stats" class="display" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>BATCH ID</th>
					<th>MEMBERSHIP ID</th>
					<th>IDENTIFIER</th>
					<th>EXPORTFILENAME</th>
					<th>CLAIM STATUS</th>
					<th>PAGE COUNT</th>
					<th>CLAIMS COUNT</th>
					<th>COMMAND</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($records as $record){  ?>
					<tr>
						<td style="text-align: center;"><?php echo $record['batch_id']; ?></td>
						<td style="text-align: center;"><?php echo $record['membershipId']; ?></td>
						<td style="text-align: center;"><?php echo $record['identifier']; ?></td>
						<td style="text-align: center;"><?php echo $record['exportfilename']; ?></td>
						<td style="text-align: center;"><?php echo $record['claimstatus'];?></td>
						<td style="text-align: center;"><?php echo $record['pagecount'];?></td>
						<td style="text-align: center;"></td>
						<td style="text-align: center">
							<button><a href="<?php echo 'view_cbhs_xml.php?id='.$record['batch_id'];?>" target="_blank">View</a></button>
							<button><a href="<?php echo 'cbhs_export_xml.php?id='.$record['batch_id'];?>">Download</a></button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		<?php } else { echo "<h3>No Results Found</h3>";}?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>
