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
			$('#operator_stats').dataTable();
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
		<h2>Export Operator Stats</h2>
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
				<th>JOB NUMBER</th>
				<th>OPERATOR</th>
				<th>JULIAN DATE</th>
				<th>TIME 1</th>
				<th>TIME 2</th>
				<th>RECORDS</th>
			</tr>
		</thead>
		<tbody>
		<?php $total_time=0; foreach($records as $record){  $total_time += $record['total_time']; ?>
		<tr>
			<td style="text-align: center;"><?php echo $record['activity']; ?></td>
			<td style="text-align: center;"><?php echo "O".$record['job']; ?></td>
			<td style="text-align: center;"><?php echo $record['entry_id'].$job_description["{$record['job']}"]; ?></td>
			<td style="text-align: center;"><?php echo $record['year'].$record['juliandate']; ?></td>
			<td style="text-align: center;"><?php echo gmdate('H i',$record['total_time']);?></td>
			<td style="text-align: center;"><?php echo gmdate('H i',$record['total_time']);?></td>
			<td class="records" style="text-align: right;"><?php echo $record['entry_records']; ?></td>
		</tr>
		<?php } ?>
		<?php $total_time=0; foreach($au_records as $au){  $total_time += $au['total_time']; ?>
		<tr>
			<td style="text-align: center;"><?php echo $au['activity']; ?></td>
			<td style="text-align: center;"><?php echo "O".$au['job']; ?></td>
			<td style="text-align: center;"><?php echo $au['entry_id'].$job_description["{$au['job']}"]; ?></td>
			<td style="text-align: center;"><?php echo $au['year'].$au['juliandate']; ?></td>
			<td style="text-align: center;"><?php echo gmdate('H i',$au['total_time']);?></td>
			<td style="text-align: center;"><?php echo gmdate('H i',$au['total_time']);?></td>
			<td class="records" style="text-align: right;"><?php echo $au['entry_records']; ?></td>
		</tr>
		<?php } ?>		
		<?php $total_time=0; foreach($inv_records as $inv){  $total_time += $inv['total_time']; ?>
		<tr>
			<td style="text-align: center;"><?php echo $inv['activity']; ?></td>
			<td style="text-align: center;"><?php echo "O".$inv['job']; ?></td>
			<td style="text-align: center;"><?php echo $inv['entry_id'].$job_description["{$inv['job']}"]; ?></td>
			<td style="text-align: center;"><?php echo $inv['year'].$inv['juliandate']; ?></td>
			<td style="text-align: center;"><?php echo gmdate('H i',$inv['total_time']);?></td>
			<td style="text-align: center;"><?php echo gmdate('H i',$inv['total_time']);?></td>
			<td class="records" style="text-align: right;"><?php echo $inv['entry_records']; ?></td>
		</tr>
		<?php } ?>	
		</tbody>
		<tfoot>
		<tr>
			<td style="text-align: center;"><a href="statsoutput.php?q=<?php echo !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y'); ?>"><button class="export">Export File</button></a></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="text-align: right;">Total:</td>
			<td style="text-align: center; width:150px;"><?php echo gmdate("H i",$total_time);?></td>
			<td class="total_records" style="text-align: right;"></td>
		</tr>
		</tfoot>
	</table>
	<?php } else { echo "<h3>No Results Found</h3>";}?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>
