<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	$production_date = !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y');
	$records = NewZealand::operator_stats($production_date);
	$au_records = Australia::operator_stats($production_date);
	$inv_records = Invalid::operator_stats($production_date);
	$job_description = JobNumber::stats_output_description($production_date);
?>
<?php include("../_layout/adminheader1.php");?>
<?php include("../_layout/datatables.php");?>
	<script>
		$(document).ready(function() {
			$("#exports").addClass("current");
			$('#operator_stats').dataTable({
				"lengthMenu":[[-1],["ALL"]]
				
			});
			AustralianDate_Input_Format("#production_date");
			
			var total = 0;
			$("td.records").each(function () { 
				total += parseInt($(this).text());
				$("td.total_records").text(total);
			});
		});
	</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Export Operator Stats [KPI]</h2>
	</div>
	<div id="display">
		<form class="filter">
			<fieldset>
				<label>Production Date:</label>
					<input id="production_date" class="medium" name="production_date" type="text" value="<?php echo !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y');?>" required/>
				<input type="submit" value="Submit" />
			</fieldset>
		</form>
	<?php if($records || $au_records || $inv_records) {?>
	
	<table id="operator_stats" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ACTIVITY</th>
				<th>OPERATOR</th>
				<th>PRODUCTION DATE</th>
				<th>TIME</th>
				<th>RECORDS</th>
			</tr>
		</thead>
		<tbody>
		<?php $total_time=0; foreach($records as $record){  $total_time += $record['total_time']; ?>
		<tr>
			<td style="text-align: center;"><?php echo $record['activity']=='E' ? 'ENTRY' : 'VERIFY'; ?></td>
			<td style="text-align: center;"><?php echo $record['entry_id']; ?></td>
			<td><?php echo !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y');echo 'NZ';?></td>
			<td style="text-align: center;"><?php echo gmdate('H:i:s',$record['total_time']);?></td>
			<td class="records" style="text-align: right;"><?php echo $record['entry_records']; ?></td>
		</tr>
		<?php } ?>
		<?php $total_time=0; foreach($au_records as $au){  $total_time += $au['total_time']; ?>
		<tr>
			<td style="text-align: center;"><?php echo $au['activity']=='E' ? 'ENTRY' : 'VERIFY'; ?></td>
			<td style="text-align: center;"><?php echo $au['entry_id']; ?></td>
			<td><?php echo !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y');echo 'AU';?></td>
			<td style="text-align: center;"><?php echo gmdate('H:i',$au['total_time']);?></td>
			<td class="records" style="text-align: right;"><?php echo $au['entry_records']; ?></td>
		</tr>
		<?php } ?>		
		<?php $total_time=0; foreach($inv_records as $inv){  $total_time += $inv['total_time']; ?>
		<tr>
			<td style="text-align: center;"><?php echo $inv['activity'] == 'E' ? 'ENTRY' : 'VERIFY'; ?></td>
			<td style="text-align: center;"><?php echo $inv['entry_id']; ?></td>
			<td><?php echo !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y');echo 'INV';?></td>
			<td style="text-align: center;"><?php echo gmdate('H:i',$inv['total_time']);?></td>
			<td class="records" style="text-align: right;"><?php echo $inv['entry_records']; ?></td>
		</tr>
		<?php } ?>	
		</tbody>
	</table>
	<?php } else { echo "<h3>No Results Found</h3>";}?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>
