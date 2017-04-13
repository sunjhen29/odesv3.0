<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	if(isset($_GET['optr_id']) && isset($_GET['production_date1'])){
		if (strtoupper($_GET['optr_id']) == 'ALL'){
			$records = NewZealand::all_recordsperhour($_GET['production_date1'],$_GET['production_date2']);
			$aus_records = Australia::all_recordsperhour($_GET['production_date1'],$_GET['production_date2']);
		} else {
			$records = NewZealand::all_recordsperhour($_GET['production_date1'],$_GET['production_date2']);
			$aus_records = Australia::all_recordsperhour($_GET['production_date1'],$_GET['production_date2']);
		}
	} 
?>
<?php include("../_layout/adminheader1.php");?>
<?php include("../_layout/datatables.php");?>
<script>
	$(document).ready(function() {
		$("#reports").addClass("current");
		$("#bystaffid").dataTable({
			dom: 'T<"clear">lfrtip',
			tableTools: {
            "sSwfPath": "../_TableTools-2.2.4/swf/copy_csv_xls_pdf.swf"
			},
			"lengthMenu": [[-1], ["All"]]
		});
		
		AustralianDate_Input_Format("#production_date1");
		AustralianDate_Input_Format("#production_date2");
	});
</script>
<style>
	.filter label:first-child{
		width: 65px;	
	}
	input{
		padding-left: 10px;
	}
	.tocenter{
		text-align: center;
	}
	.toright{
		text-align: right;
	}
	.rightindent{
		padding-right: 25px;
	}
</style>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Records Per Hour Report</h2>
	</div>
	<div id="display">
	<form class="filter">
		<fieldset>
			<div style="display: none;">
			<label>Staff ID</label>
				<input class="medium" name="optr_id"type="text" value="<?php echo !empty($_GET['optr_id']) ? $_GET['optr_id'] : 'all';?>" required/>
			</div>
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
				<th>CATEGORY</th>
				<th>OPERATOR</th>
				<th>TIME</th>
				<th>RECORDS</th>
				<th>RECORDS/HOUR</th>
			</tr>
		</thead>
		<tbody>
		<?php $total_time=0; foreach($records as $record){ ?>
			<tr>
				<td class="tocenter">NZ - <?php echo htmlentities($record['job']); ?></td>
				<td class="tocenter"><?php echo htmlentities($record['entry_id']); ?></td>
				<td class="tocenter"><?php echo htmlentities($record['total_time']); ?></td>
				<td class="toright"><?php echo htmlentities($record['entry_records']); ?></td>
				<td class="toright"><?php echo htmlentities($record['records_per_hour']); ?></td>
			</tr>
		<?php } ?>
		<?php foreach($aus_records as $aus){ ?>
			<tr>
				<td class="tocenter">AU - <?php echo htmlentities($aus['job']); ?></td>
				<td class="tocenter"><?php echo htmlentities($aus['entry_id']); ?></td>
				<td class="tocenter"><?php echo htmlentities($aus['total_time']); ?></td>
				<td class="toright"><?php echo htmlentities($aus['entry_records']); ?></td>
				<td class="toright"><?php echo htmlentities($aus['records_per_hour']); ?></td>
			</tr>
		<?php } ?>		
		</tbody>
	</table>
	<?php }?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>	