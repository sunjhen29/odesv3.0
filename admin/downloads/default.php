<?php 
	///admin page
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	$publication_lookup = Publication::publication_lookup();
	$status = array('OPEN'=>'OPEN','CLOSED'=>'CLOSED');
	
	if (isset($_GET['status'])){
		$view = Download::view_download($_GET['status'],$_GET['state'],$_GET['pubname'],$_GET['pubdate']);
	} 	
?>
<?php include("../_layout/adminheader1.php"); ?>
<?php include("../_layout/datatables.php"); ?>
	<script>
	$(document).ready(function() {
		AustralianDate_Input_Format("#pubdate");
		AustralianDate_Input_Format("input[name='export']");
		$("#download").addClass("current");
	
		$("#viewtable").dataTable({
			"order": [[ 0, "asc" ]],
			"lengthMenu":[[100,200,-1],[100,200,"ALL"]]
		});
		
		
		$(".action").click(function(){
			sale = $("input[name='sale']").val();
			rent = $("input[name='rent']").val();
			start = $("input[name='start']").val();
			end = $("input[name='end']").val();
			total1 = parseInt(sale) + parseInt(rent);
			total2 = (parseInt(end) - parseInt(start)) + 1;
			if(total1 == total2){
				return confirm("Are you sure you want to Update this record?");
			} else {
				alert("Total records does not match with the sequence no.");
				return false;
			}
		});

		var isCtrl = false;
		$(window).keydown(function(e) {
			if ((e.keyCode) == 17){
				isCtrl = true;
			}
			if ((e.keyCode) == 16){
				isShift = true;
			}
		
		if ((e.keyCode) == 65 && isCtrl == true && isShift==true){
				e.preventDefault();
				$("#add").click();
			}
		
		if ((e.keyCode) == 70 && isCtrl == true && isShift==true){
				e.preventDefault();
				$(":input")[6].focus();
			}		
			
		if ((e.keyCode) == 13 && isCtrl == true){
				e.preventDefault();
				$(":input")[7].focus();
			}	
			return;
		});
		
		$(window).keyup(function(e) {
			isCtrl = false;
			isShift = false;
			return;
		});
	});
</script>
<style>
	td:nth-child(1),td:nth-child(3),td:nth-child(5),td:nth-child(6),td:nth-child(8),td:nth-child(9){
		text-align: center;
	}	
	td:nth-child(10),td:nth-child(11),td:nth-child(13),td:nth-child(14),td:nth-child(15),td:nth-child(16),td:nth-child(17){
		text-align: center;
	}
	td:nth-child(7),td:nth-child(12){
		text-align: right;
	}
	
	table input[type="text"],table select{
			margin: 0;
			height: 22px;
			font-size: 12px;
			padding-right: 5px;
			text-align: right;
			color: #075674;
			border: 0;
		}
	table{
		font-size: 12px;
		}
	table.dataTable tbody td {
		padding: 0;
		}
	.action{
		height: 21px;
	}
</style>
<?php include("../_layout/adminheader2.php"); ?>
<div id="content">
	<div>
		<h2>Download Page</h2>
		<span class="message"><?php echo message($session->message);?></span>
	</div>
	<div id="display">
		<form method="get" class="filter">
		<fieldset>
		<label style="width: 50px;">Status</label>
				<select name="status"> 
					<?php echo keypairs($status,$_GET['status'],true,"OPEN"); ?>
				</select>
		<label style="width: 50px;">State</label>
			<select name="state">
				<?php echo keypairs($all_state,$_GET['state'],true,""); ?>
			</select>
		<label style="width: 150px;">Publication Name</label>
			<input type="text" style="width: 400px;" name="pubname" list="publication" value="<?php echo !empty($_GET['pubname']) ? htmlentities($_GET['pubname']) : '';?>" autofocus>
			<datalist id="publication">
				<?php echo keypairs($publication_lookup,"",false,""); ?>
			</datalist>
		<label>Publication Date</label>
			<input id="pubdate" class="medium" name="pubdate" type="text" value="<?php echo !empty($_GET['pubdate']) ? $_GET['pubdate'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$"/>
		<input type="submit" value="Filter" />
		</fieldset>
		</form>
	<?php if(isset($view)){ ?>
	<table id="viewtable" class="display" cellpadding="0" cellspacing="0" width="100%" > 
		<thead>
			<tr>
				<th>ID</th>
				<th>STATE</th>
				<th>PUBLICATION NAME</th>
				<th>CODE</th>
				<th>DATE</th>
				<th>PAGES</th>
				<th>REMARKS</th>
				<th>STATUS</th>
				<th>SALE</th>
				<th>RENT</th>
				<th>TOTAL</th>
				<th>START</th>
				<th>END</th>
				<th>EXPORT</th>
				<th>COMMAND</th>
				<th>ADDED</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($view as $record){ ?>
			<tr>
				<td><?php echo htmlentities($record['id']);?></td>
				<form method="post" action="process.php?action=close&id=<?php echo $record['id']; ?>">
					<td><?php echo htmlentities($record['State']);?></td>
					<td style="width: 400px;"><?php echo htmlentities($record['Publication_Name']);?></td>
					<td><?php echo htmlentities($record['Code']);?></td>
					<td><?php echo htmlentities($record['Publication_Date']);?></td>
					<td><?php echo htmlentities($record['Pages']);?></td>
					<td><?php echo htmlentities($record['Remarks']);?></td>
					<td style="text-align: center;"><?php echo htmlentities($record['Status']);?></td>
					<td><input style="width: 90px;" name='sale' type="text" value="<?php echo htmlentities($record['Sale']);?>" required pattern="[0-9]{1,7}" /></td>
					<td><input style="width: 90px;" name='rent' type='text' value="<?php echo htmlentities($record['Rent']);?>" required pattern="[0-9]{1,7}" /></td>
					<td><?php echo $record['Sale'] + $record['Rent'];?></td>
					<td><input name='start' style="width: 80px;" type='text' value="<?php echo htmlentities($record['Start']);?>" required pattern="[0-9]{1,7}" /></td>
					<td><input name='end' style="width: 80px;" type='text' value="<?php echo htmlentities($record['End']);?>" required pattern="[0-9]{1,7}" /></td>
					<td><input class='medium' style="text-align: center;" name='export' type='text' value="<?php echo htmlentities($record['Date_Export']);?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required /></td>
					<td><input class="action" name='update' type='submit' value="<?php echo $record['Status'] == 'CLOSED' ? 'Update' : 'Close';?>" />
						<!-- <a href="process.php?action=delete&id=<?php //echo $record['id'];?>">
						<button class="action" onclick="return confirm('Are you sure want to delete this record?');">DELETE</button></a> -->
					</td>
				</form>
				<td style="width:90px;"><a tabindex='-1' href='modify.php?id=<?php echo $record['id']; ?>'><?php echo htmlentities($record['Date_Creation']);?></a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table><br>
	<a href="adddownload.php"><button id="add" class="addlink">+ Add Download</button></a>
	<?php }?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>