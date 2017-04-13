<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	if(isset($_GET['optr_id']) && isset($_GET['production_date1'])){
		if($_GET['optr_id'] != strtoupper('ALL')){
			$records = Reports::cost_analysis($_GET['optr_id'],$_GET['production_date1'],$_GET['production_date2']);
		} else {
			$records = Reports::cost_analysis_all($_GET['production_date1'],$_GET['production_date2']);
		}
	} 
?>
<?php include("../_layout/adminheader1.php");?>
<?php include("../_layout/datatables.php");?>
<style>
	.filter label:first-child{
		width: 65px;	
	}
	input{
		padding-left: 10px;
	}
	#bystaffid td:first-child,#bystaffid td:nth-child(2),#bystaffid td:nth-child(3),#bystaffid td:nth-child(4),#bystaffid td:nth-child(6),#bystaffid td:nth-child(8){
		text-align: center;	
	}
	#bystaffid td:nth-child(7){
		text-align: right;	
	}
</style>
<script>
	$(document).ready(function() {
		$("#reports").addClass("current");
		$("#bystaffid").dataTable({
			"lengthMenu": [[-1], ["All"]]
		});
		
		AustralianDate_Input_Format("#production_date1");
		AustralianDate_Input_Format("#production_date2");
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
		<h2>Cost Analysis Report</h2>
	</div>
	<div id="display">
	<form class="filter">
		<fieldset>
			<label>Staff ID</label>
				<input class="medium" name="optr_id" type="text" value="<?php echo !empty($_GET['optr_id']) ? $_GET['optr_id'] : 'all';?>" required/>
				<label>Production Date</label>
				<input class="long" id="production_date1" name="production_date1" type="text" value="<?php echo !empty($_GET['production_date1']) ? $_GET['production_date1'] : date('d/m/Y');?>" placeholder="FROM" required/>
				<input class="long" id="production_date2" name="production_date2" type="text" value="<?php echo !empty($_GET['production_date2']) ? $_GET['production_date2'] : date('d/m/Y');?>" placeholder="TO"required/>
			<input type="submit" value="Submit" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['optr_id'])) {?>
	<table id="bystaffid">
		<thead>
			<tr>
				<th>Staff ID</th>
				<th>Job Number</th>
				<th>Records</th>
				<th>Time</th>
			</tr>
		</thead>
		<tbody>
		<?php $total_time=0; foreach($records as $record){ ?>
			<tr>
				<td><?php echo htmlentities($record['entry_id']);?></td>
				<td><?php echo htmlentities($record['job']);?></td>
				<td><?php echo htmlentities($record['sum(entry_records)']); ?></td>
				<td><?php echo htmlentities($record['sum(total_time)']); ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
	<?php }?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>	