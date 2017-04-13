<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	if(isset($_GET['optr_id']) && isset($_GET['production_date'])){
		if (strtoupper($_GET['optr_id']) == 'ALL'){
			$records = NewZealand::all_records($_GET['production_date']);
			$aus_records = Australia::all_records($_GET['production_date']);
			$inv_records = Invalid::all_records($_GET['production_date']);
		} else {
			$records = NewZealand::view_records($_GET['optr_id'],$_GET['production_date']);
			$aus_records = Australia::view_records($_GET['optr_id'],$_GET['production_date']);
			$inv_records = Invalid::view_records($_GET['optr_id'],$_GET['production_date']);
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
			"lengthMenu":[[100,200,-1],[100,200,"ALL"]]
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
		<h2>Listings By Staff ID</h2>
	</div>
	<div id="display">
	<form class="filter">
		<fieldset>
			<label>Staff ID</label>
				<input class="medium" name="optr_id"type="text" value="<?php echo !empty($_GET['optr_id']) ? $_GET['optr_id'] : 'all';?>" required/>
			<label>Production Date</label>
				<input class="long" id="production_date" name="production_date" type="text" value="<?php echo !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y');?>" required/>
			<input type="submit" value="Submit" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['optr_id'])) {?>
	<table id="bystaffid">
		<thead>
			<tr>
				<th>APPLICATION</th>
				<th>Job Number</th>
				<th>OPERATOR</th>
				<th>BATCH ID</th>
				<th>PUBLICATION NAME</th>
				<th>DATE</th>
				<th>RECORDS</th>
				<th>TIME</th>
			</tr>
		</thead>
		<tbody>
		<?php $total_time=0; foreach($records as $record){ ?>
			<tr>
				<td>NEW ZEALAND</td>
				<td><?php echo htmlentities($record['job']); ?></td>
				<td><?php echo htmlentities($record['entry_id']); ?></td>
				<td><?php echo htmlentities($record['batch_id']); ?></td>
				<td><?php echo htmlentities($record['publication_name']); ?></td>
				<td><?php echo htmlentities($record['publication_date']); ?></td>
				<td class="records"><?php echo htmlentities($record['entry_records']); ?></td>
				<td><?php echo gmdate("H.i.s",$record['total_time']); $total_time += $record['total_time'];?></td>
			</tr>
		<?php } ?>
		<?php foreach($aus_records as $aus){ ?>
			<tr>
				<td>AUSTRALIA</td>
				<td><?php echo htmlentities($aus['job']);?></td>
				<td><?php echo htmlentities($aus['entry_id']); ?></td>
				<td><?php echo htmlentities($aus['batch_id']); ?></td>
				<td><?php echo htmlentities($aus['publication_name']); ?></td>
				<td><?php echo htmlentities($aus['publication_date']); ?></td>
				<td class="records"><?php echo htmlentities($aus['entry_records']); ?></td>
				<td><?php echo gmdate("H.i.s",$aus['total_time']); $total_time += $aus['total_time'];?></td>
			</tr>
		<?php } ?>		
		<?php foreach($inv_records as $inv){ ?>
			<tr>
				<td>INVALID</td>
				<td><?php echo htmlentities($inv['job']);?></td>
				<td><?php echo htmlentities($inv['entry_id']);?></td>
				<td><?php echo htmlentities($inv['batch_id']);?></td>
				<td><?php echo htmlentities($inv['publication_name']);?></td>
				<td><?php echo htmlentities($inv['publication_date']);?></td>
				<td class="records"><?php echo htmlentities($inv['entry_records']);?></td>
				<td><?php echo gmdate("H.i.s",$inv['total_time']); $total_time += $inv['total_time'];?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>Total:</td>
				<td class="total_records"></td>
				<td><?php echo gmdate("H.i.s",$total_time);?></td>
			</tr>
		</tfoot>
	</table>
	<?php }?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>	