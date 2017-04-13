<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	if(isset($_GET['state']) && isset($_GET['publication_name']) && isset($_GET['publication_date'])){
		$batches = Invalid::viewbatches($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
		$total = Invalid::records_summary($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
	}
?>
<?php include("../_layout/adminheader1.php");?>
		<link rel="stylesheet" type="text/css" href="../_datatables/theme/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../_datatables/theme/dataTables.jqueryui.css">
		<script type="text/javascript" language="javascript" src="../_datatables/theme/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="../_datatables/theme/dataTables.jqueryui.js"></script>
		<style>
			.filter label:first-child{
				width: 65px;	
			}
			input{
				padding-left: 10px;
			}
			#summary td:first-child, #summary td:nth-child(3), #summary td:nth-child(4),#summary td:nth-child(5),#summary td:nth-child(6),#summary td:nth-child(7){
				text-align: center;	
			}
		</style>
		<script>
		$(document).ready(function() {
			$("#exports").addClass("current");
			$('#invalid').dataTable();
			$('#summary').dataTable({
				"paging": false,
				"ordering" :false,
				"info" :false,
				"searching" : false,
				"dom": '<"toolbar">frtip'
			});	
				
			$("div.toolbar").html('<h3>Summary</h3>');
			
			AustralianDate_Input_Format("#publication_date");
			
			$.getJSON("getInvalidPublication.php",{q: $("select[name='state']").val(), ajax: 'true'}, function(j){
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
				$.getJSON("getInvalidPublication.php",{q: $(this).val(), ajax: 'true'}, function(j){
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
<?php include("../_layout/adminheader2.php");?><div id="content">
	<div>
		<h2>Export Invalid</h2>
	</div>
	<div id='display'>
	<form class="filter" method="get" action="invalidexport.php">
		<fieldset>
			<label>State</label>
			<select name="state">
				<?php echo keypairs($state_lkp_pubstate_inv,$_GET['state'],false,""); ?>
			</select>
			<label style="width: 150px;">Publication Name</label>
			<input type="hidden" name="pubname" value="<?php echo htmlentities($_GET['publication_name']);?>" />
			<select name="publication_name" required>
			</select>
			<label>Publication Date</label>
			<input id="publication_date" class="medium" name="publication_date" type="text" value="<?php echo !empty($_GET['publication_date']) ? $_GET['publication_date'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/>
			<input name="submit" type="submit" value="View" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['state'])){ ?>
	<table id="invalid" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ENTRY</th>
				<th>BATCH ID</th>
				<th>PUBLICATION NAME</th>
				<th>PUBLICATION DATE</th>
				<th>NO. OF RECORDS</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($batches as $batch){?>
		<tr>
			<td><?php echo htmlentities($batch['entry_id']); ?></td>
			<td><?php echo htmlentities($batch['batch_id']); ?></td>
			<td><?php echo htmlentities($batch['publication_name']); ?></td>
			<td><?php echo htmlentities($batch['publication_date']); ?></td>
			<td><?php echo htmlentities($batch['entry_records']); ?></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
	<br>
	<table id="summary" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>State</th>
				<th>Publication Name</th>
				<th>Publication Date</th>
				<th>Sale</th>
				<th>Rent</th>
				<th>Total</th>
				<th>Export</th>
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo htmlentities($_GET['state']);?></td>
				<td><?php echo htmlentities($_GET['publication_name']);?></td>
				<td><?php echo htmlentities($_GET['publication_date']);?></td>
				<td><?php echo htmlentities($total['sale']);?></td>
				<td><?php echo htmlentities($total['rent']);?></td>
				<td><?php echo htmlentities($total['total']);?></td>
				<td><a href="<?php echo 'download.php?state='.$_GET['state'].'&publication_name='.urlencode($_GET['publication_name']).'&publication_date='.$_GET['publication_date'];?>"><button class="export">Export Invalid</button></a></td>
			</tr>
	</table>
	<?php } else {echo "<h3>No Result Found!!</h3>";}?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>