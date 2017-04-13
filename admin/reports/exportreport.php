<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	if(isset($_GET['export_date1']) && isset($_GET['export_date2'])){
		$exports = Download::report_by_export_date($_GET['export_date1'],$_GET['export_date2']);
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
	.tocenter{
		text-align: center;
		font-size: 14px;
	}
	.toright{
		text-align: right;
		font-size: 14px;
	}
	.toleft{
		text-align: left;
		font-size: 14px;
	}
</style>
<script>
	$(document).ready(function() {
		$("#reports").addClass("current");
		$("#byexport").dataTable({
			"lengthMenu": [[-1], ["All"]]
		});
		
		AustralianDate_Input_Format("#export_date1");
		AustralianDate_Input_Format("#export_date2");
		
		var total_sale = 0;
		$("td.sale").each(function () { 
			total_sale += parseInt($(this).text());
			$("td.total_sale").text(total_sale);
		});
		var total_rent = 0;
		$("td.rent").each(function () { 
			total_rent += parseInt($(this).text());
			$("td.total_rent").text(total_rent);
		});
		
		sale_rent = parseInt($("td.total_sale").text()) + parseInt($("td.total_rent").text());
		$("td.sale_rent").text(sale_rent);
	});
</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Report By Exports</h2>
	</div>
	<div id="display">
	<form class="filter">
		<fieldset>
			<label style="width:100px;">Export Date</label>
				<input class="long" id="export_date1" name="export_date1" type="text" value="<?php echo !empty($_GET['export_date1']) ? $_GET['export_date1'] : date('d/m/Y');?>" placeholder="FROM" required/>
				<input class="long" id="export_date2" name="export_date2" type="text" value="<?php echo !empty($_GET['export_date2']) ? $_GET['export_date2'] : date('d/m/Y');?>" placeholder="TO"required/>
			<input type="submit" value="Submit" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['export_date2'])) {?>
	<table id="byexport">
		<thead>
			<tr>
				<th>START</th>
				<th>END</th>
				<th>EXPORT DATE</th>
				<th>STATE</th>
				<th>PUBLICATION NAME</th>
				<th>PUBLICATION DATE</th>
				<th>STATUS</th>
				<th>SALE</th>
				<th>RENT</th>
				<th>TOTAL</th>
				<th>ID</th>
				<th>DATE ADDED</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($exports as $export){ ?>
			<tr>
				<td class="tocenter"><?php echo htmlentities($export['Start']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['End']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Date_Export']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['State']);?></td>
				<td class="toleft"><?php echo htmlentities($export['Publication_Name']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Publication_Date']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Status']);?></td>
				<td class="toright sale"><?php echo htmlentities($export['Sale']);?></td>
				<td class="toright rent"><?php echo htmlentities($export['Rent']);?></td>
				<td class="toright salerent"><?php echo htmlentities($export['Sale']) + $export['Rent'];?></td>
				<td class="tocenter"><?php echo htmlentities($export['id']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Date_Creation']);?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan=7 class="toright">TOTAL:</td>
				<td class="toright total_sale"></td>
				<td class="toright total_rent"></td>
				<td class="toright sale_rent"></td>
				<td></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
	<?php }?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>	