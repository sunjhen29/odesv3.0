<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	$publication_lookup = Publication::publication_lookup();
	$status = array('OPEN'=>'OPEN','CLOSED'=>'CLOSED');
	
	if (isset($_GET['status'])){
		$view = Download::delete_download($_GET['status'],$_GET['state'],$_GET['pubname'],$_GET['pubdate']);
	} 	
?>
<?php include("../_layout/adminheader1.php"); ?>
<?php include("../_layout/datatables.php"); ?>
	<style>
		td:nth-child(1),td:nth-child(4),td:nth-child(5),td:nth-child(7),td:nth-child(8),td:nth-child(9),td:nth-child(10){
			text-align: center;	
		}
		td:nth-child(6){
			text-align: right;
			color: green;
			font-weight: bold;
		}
		table input[type="text"],table select{
			height: 30px;
			font-size: 16px;
			padding-right: 2px;
			text-align: right;
			color: #075674;
		}
	</style>
	<script>
	$(document).ready(function() {
		AustralianDate_Input_Format("#pubdate");
		AustralianDate_Input_Format("input[name='export']");
		$("#utilities").addClass("current");
	
		$("#viewtable").dataTable({
			"order": [[ 0, "desc" ]]
		});
			
		var isCtrl = false;
		$(window).keydown(function(e) {
			if ((e.keyCode) == 17){
				isCtrl = true;
			}
			if ((e.keyCode) == 16){
				isShift = true;
			}
		
		if ((e.keyCode) == 70 && isCtrl == true && isShift==true){
				e.preventDefault();
				$(":input")[6].focus();
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
<?php include("../_layout/adminheader2.php"); ?>
<div id="content">
	<div>
		<h2>Delete Publication</h2>
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
				<th>PUB. DATE</th>
				<th>STATUS</th>	
				<th>DATE ADDED</th>
				<th>DATE EXPORT</th>
				<th>DATE BACK UP</th>
				<th>DATE REMOVED</th>
				<th>No. of Days</th>
				<th>COMMAND</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($view as $record){ ?>
			<tr>
				<td><?php echo htmlentities($record['id']);?></td>
				<td><?php echo htmlentities($record['State']);?></td>
				<td style="width: 400px;"><?php echo htmlentities($record['Publication_Name']);?></td>
				<td><?php echo htmlentities($record['Publication_Date']);?></td>
				<td style="text-align: center;"><?php echo htmlentities($record['Status']);?></td>
				<td><?php echo htmlentities($record['Date_Creation']);?></td>
				<td><?php echo htmlentities($record['Date_Export']);?></td>
				<td><?php echo htmlentities($record['Date_Backup']);?></td>
				<td><?php echo htmlentities($record['Date_Removed']);?></td>
				<td><?php echo htmlentities($record['Days'].' days ago'); ?></td>
				<td>
					<?php if($record['Date_Export'] != ''){ ?>	
						<?php if($record['Date_Backup'] != ''){ ?>			
							<a href="process.php?action=deletepublication&state=<?php echo urlencode($record['State'])."&pubname=".urlencode($record['Publication_Name'])."&pubdate=".urlencode($record['Publication_Date'])."&app=".urlencode($record['Job_Number'])."&id=".urlencode($record['id']);?>"><button class="action">DELETE</button></a>
						<?php } else { ?>
							<a href="backup.php?state=<?php echo urlencode($record['State'])."&publication_name=".urlencode($record['Publication_Name'])."&publication_date=".urlencode($record['Publication_Date'])."&app=".urlencode($record['Job_Number'])."&id=".urlencode($record['id']);?>"><button class="action">BACK UP</button></a>
						<?php }?>
					<?php }?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<?php }?>
	</div>
</div>
<?php include("../_layout/adminfooter.php");?>