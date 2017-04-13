<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	if(isset($_GET['pubdate1']) && isset($_GET['pubdate2'])){
		$exports = Download::bypublication($_GET['state'],$_GET['publication_name'],$_GET['pubdate1'],$_GET['pubdate2']);
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
		#bypublication td{	
			text-align: center;	
		}
		#records td:first-child, #records td:nth-child(3), #records td:nth-child(4),#records td:nth-child(7),#records td:nth-child(8),#records td:nth-child(9){
			text-align: center;	
		}
		#records td:nth-child(4), #records td:nth-child(5), #records td:nth-child(6){
			text-align: right;	
		}
		.status{
			color: white;
			font-weight: bold;
			background: green;
			border: 1px;
			margin: 0;
			height: 25px;
		}
		#content{
			background: white;
		}
	</style>
	<script>
	$(document).ready(function() {	
		$("#reports").addClass("current");		
		
		$("#bypublication").dataTable({
			"lengthMenu": [[-1], ["All"]]
		});
		
	
		AustralianDate_Input_Format("#pubdate1");
		AustralianDate_Input_Format("#pubdate2");
		
		$.getJSON("getPublication.php",{q: $("select[name='state']").val(), ajax: 'true'}, function(j){
			console.log(j);
			var options = '';
				for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].pub_name + '" ';
					if ($("input[name='pubname']").val() == j[i].pub_name){
						options += 'selected';
					}
						options += '>' + j[i].pub_display + '</option>';
				}
				$("select[name='publication_name']").html(options);
		});
		$("select[name='state']").change(function(){
			$.getJSON("getPublication.php",{q: $(this).val(), ajax: 'true'}, function(j){
			console.log(j);
			var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].pub_name + '">' + j[i].pub_display + '</option>';
				}
				$("select[name='publication_name']").html(options);
			});
		});
				
	});
	</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>By Publication Report</h2>
	</div>
	<div id="display">
	<form class="filter" method="get" action="comparepub.php">
		<fieldset>
			<label>State</label>
			<select name="state">
				<?php echo keypairs($all_state,$_GET['state'],false,""); ?>
			</select>
			<label style="width: 150px;">Publication Name</label>
			<input type="hidden" name="pubname" value="<?php echo htmlentities($_GET['publication_name']);?>" />
			<select name="publication_name" required>
			</select>
			<label>Publication Date</label>
			<input id="pubdate1" maxlength="10" class="medium" name="pubdate1" type="text" value="<?php echo !empty($_GET['pubdate1']) ? $_GET['pubdate1'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/>
			<input id="pubdate2" maxlength="10" class="medium" name="pubdate2" type="text" value="<?php echo !empty($_GET['pubdate2']) ? $_GET['pubdate2'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/>
			<input name="submit" type="submit" value="View" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['pubdate2'])) {?>
	<table id="bypublication">
		<thead>
			<tr>
				<th>ID</th>
				<th>STATE</th>
				<th>PUBLICATION NAME</th>
				<th>PUBLICATION DATE</th>
				<th>STATUS</th>
				<th>SALE</th>
				<th>RENT</th>
				<th>TOTAL</th>
				<th>START</th>
				<th>END</th>
				<th>EXPORT DATE</th>
				<th>DATE ADDED</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($exports as $export){ ?>
			<tr>
				<td class="tocenter"><?php echo htmlentities($export['id']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['State']);?></td>
				<td class="toleft"><?php echo htmlentities($export['Publication_Name']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Publication_Date']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Status']);?></td>
				<td class="toright sale"><?php echo htmlentities($export['Sale']);?></td>
				<td class="toright rent"><?php echo htmlentities($export['Rent']);?></td>
				<td class="toright salerent"><?php echo htmlentities($export['Sale']) + $export['Rent'];?></td>
				<td class="tocenter"><?php echo htmlentities($export['Start']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['End']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Date_Export']);?></td>
				<td class="tocenter"><?php echo htmlentities($export['Date_Creation']);?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<?php }?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>