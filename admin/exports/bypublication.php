<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	
	if(isset($_GET['state']) && isset($_GET['publication_name']) && isset($_GET['publication_date'])){
		if ($_GET['state']=='NZ') {
			$batches = NewZealand::viewbatches($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
			$total = NewZealand::records_summary($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
			$end = ($_GET['start'] + $total['total']) - 1; 
		} else {
			$batches = Australia::viewbatches($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
			$total = Australia::records_summary($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
			$end = ($_GET['start'] + $total['total']) - 1; 
		}
			$download = Download::find_id($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
			$exports = Download::compare_records($_GET['state'],$_GET['publication_name']);
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
		$("#exports").addClass("current");		
		
		$('#bypublication').dataTable({
			"paging": false,
			"info":false
		});
		
		$('#records').dataTable({
			"paging": false,
			"ordering" :false,
			"info" :false,
			"searching" : false,
			"dom": '<"toolbar">frtip'
		});
		
		$('#compare').dataTable({
			"paging": false,
			"ordering" :false,
			"info" :false,
			"searching" : false,
			"dom": '<"toolbar">frtip'
		});
		
		$('.status').each(function(){
			if($(this).val()=="FOR VERIFY"){
				$(this).css("background","red");
			}else{
				$(this).css("background","green");
			}
		});
		
		if($(".status:first").val() == 'FOR EXPORT'){
			//$(".status:first").css("background","green");
			$(".export").show();
		} else {
			//$(".status:first").css("background","red");
			$(".export").hide();
		}
		
		if ($("#startsequence").val() != ''){
			maxnumber = parseInt($("#maxsequence").html()) + 1;
			startsequence = parseInt($("#startsequence").val());
			if(maxnumber != startsequence){
				$(".export").hide();
				alert("Start Sequence Error: Export will be disabled!!\nPlease check your sequence number.");
			}
		}
		
		$("div.toolbar").html('<h3>Summary</h3>');
		
		AustralianDate_Input_Format("#publication_date");
		
		
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
		
		$(window).keydown(function(e) {
			if ((e.keyCode) == 17){
				isCtrl = true;
			}
			if ((e.keyCode) == 69 && isCtrl == true){
				e.preventDefault();
				$(".export").toggle();
			}
			return;
		});
		
	});
	</script>
<?php include("../_layout/adminheader2.php");?>
<div id="content">
	<div>
		<h2>Export By Publication</h2>
	</div>
	<div id="display">
	<span id="maxsequence"><?php echo Download::maxsequence(); ?></span>
	<form class="filter" method="get" action="bypublication.php">
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
			<input id="publication_date" maxlength="10" class="medium" name="publication_date" type="text" value="<?php echo !empty($_GET['publication_date']) ? $_GET['publication_date'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/>
			<label>Start Sequence</label>
			<input id="startsequence" name="start" type="text" class="medium" value="<?php echo !empty($_GET['start']) ? $_GET['start'] : '';?>" pattern="[aA-zZ0-9]{6,7}" required/>
			<input name="submit" type="submit" value="View" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['state'])){ ?>
	<table id="bypublication" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ENTRY</th>
				<th>VERIFY</th>
				<th>BATCH ID</th>
				<th>PUBLICATION NAME</th>
				<th>PUBLICATION DATE</th>
				<th>ENTRY RECORDS</th>
				<th>VERIFY RECORDS</th>
				<th>STATUS</th>
			</tr>
		</thead>
		</tbody>
		<?php foreach($batches as $batch){?>
		<tr>
			<td><?php echo htmlentities($batch['entry_id']);?></td>
			<td><?php echo htmlentities($batch['verify_id']);?></td>
			<td><?php echo htmlentities($batch['batch_id']);?></td>
			<td><?php echo htmlentities($batch['publication_name']);?></td>
			<td><?php echo htmlentities($batch['publication_date']);?></td>
			<td><?php echo htmlentities($batch['entry_records']);?></td>
			<td><?php echo htmlentities($batch['verify_records']);?></td>
			<td><button class="status" value="<?php echo htmlentities($batch['status']);?>" ><?php echo htmlentities($batch['status']);?></button></td>
		</tr>
		<?php }; ?>
		</tbody>
	</table>
	<table id="records" class="display2" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>State</th>
				<th>Publication Name</th>
				<th>Publication Date</th>
				<th>Start Sequence</th>
				<th>End Sequence</th>
				<th>Sale</th>
				<th>Rent</th>
				<th>Total</th>
				<th>Export</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo htmlentities($download['id']);?></td>
				<td><?php echo htmlentities($_GET['state']);?></td>
				<td><?php echo htmlentities($_GET['publication_name']);?></td>
				<td><?php echo htmlentities($_GET['publication_date']);?></td>
				<td><?php echo htmlentities($_GET['start']);?></td>
				<td><?php echo htmlentities($end);?></td>
				<td><?php echo htmlentities($total['sale']);?></td>
				<td><?php echo htmlentities($total['rent']);?></td>
				<td><?php echo htmlentities($total['total']);?></td>
				<td><a href="<?php 
				if ($_GET['state']=='NZ'){
				echo 'nzoutput.php?state='.urlencode($_GET['state']).'&publication_name='.urlencode($_GET['publication_name']).'&publication_date='.urlencode($_GET['publication_date']).'&start='.urlencode($_GET['start'])."&end=".urlencode($end)."&sale=".urlencode($total['sale'])."&rent=".urlencode($total['rent'])."&download=".urlencode($download['id']);
				} else {
				echo 'textoutput.php?state='.urlencode($_GET['state']).'&publication_name='.urlencode($_GET['publication_name']).'&publication_date='.urlencode($_GET['publication_date']).'&start='.urlencode($_GET['start'])."&end=".urlencode($end)."&sale=".urlencode($total['sale'])."&rent=".urlencode($total['rent'])."&download=".urlencode($download['id']);
				}
				
				?>"><button class="export">Export Publication</button></a></td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<span style="font-weight: bold;color:red;">Records History</span>
	<table id="compare" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>ID</th>
				<th>State</th>
				<th>Publication Name</th>
				<th>Publication Date</th>
				<th>Start Sequence</th>
				<th>End Sequence</th>
				<th>Sale</th>
				<th>Rent</th>
				<th>Total</th>
				<th>Export</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($exports as $export){?>
			<tr>
				<td><?php echo htmlentities($export['id']);?></td>
				<td><?php echo htmlentities($export['State']);?></td>
				<td><?php echo htmlentities($export['Publication_Name']);?></td>
				<td><?php echo htmlentities($export['Publication_Date']);?></td>
				<td><?php echo htmlentities($export['Start']);?></td>
				<td><?php echo htmlentities($export['End']);?></td>
				<td><?php echo htmlentities($export['Sale']);?></td>
				<td><?php echo htmlentities($export['Rent']);?></td>
				<td><?php echo htmlentities($export['Sale'] + $export['Rent']);?></td>
				<td><?php echo htmlentities($export['Date_Export']);?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } else {echo "<h3>No Result Found!!</h3>";}?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>