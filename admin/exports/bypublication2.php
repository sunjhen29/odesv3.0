<?php 
	///admin page
	require_once("../../_includes/initialize.php");
	$publication_lookup = Publication::publication_lookup();
	if(isset($_GET['state']) && isset($_GET['publication_name']) && isset($_GET['publication_date'])){
		$batches = Australia::viewbatches($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
		$total = Australia::records_summary($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
		$end = ($_GET['start'] + $total['total']) - 1; 
	}
?>
<?php layout_template('header3.php'); ?>
<!-- script and css style goes here -->
<link href="../ddmenu/ddmenu.css" rel="stylesheet" type="text/css" />
<script src="../ddmenu/ddmenu.js" type="text/javascript"></script>
<style>

	label{
		width: 135px;
		display: inline-block;
		text-align: right;
	}
	#records{
		text-align: right;
		border: 1px solid gray;
		background: lightgray;
	}
	#record th{
		padding: 0;
	}
	#batch tr{
		border-bottom: 1px solid lightgray;
	}
	#batch th{
		background: lightgray;
	}
	#batch tr:last-child{
		background: lightgray;
	}
	#export{
		width: 220px;
		height: 50px;
		font-color: gray;
		font-weight: bold;
	}
	#export:hover{
		background: green;
		color: white;
		padding: 0;
		margin: 0;
	}
</style>
<script>
$(document).ready(function() {
	function Ymd_format(str,inpt){
		if (str.length == 2){
			$(inpt).val(str+"/"); 
		} else if (str.length == 5){
			$(inpt).val(str+"/");
		} 
	};	
	$("#publication_date").keyup(function(){
		Ymd_format($("#publication_date").val(),"#publication_date");
	});
	$("#publication_date").keypress(function(){
		Ymd_format($("#publication_date").val(),"#publication_date");
	});
	$("#publication_date").blur(function(){
		Ymd_format($("#publication_date").val(),"#publication_date");
	});
});
</script>
</head>
<body>
<div id="wrap">
<div id="header">
		<h1>CCC Data Management Services Inc.</h1>
		<span class="login"><?php echo date('F j, Y')." "; ?></span><br><br>
		<span class="login">Welcome, <?php echo $session->name." [".$session->operator_id."]"; ?>
		<a href="../../logout.php">Logout</a></span><br>
</div><!-- end of header -->
<nav id="ddmenu">
    <ul>
        <li><a href="../default.php">Home</a></li>
        <li>Download
            <div>
                <div class="column">
                    <a href="../downloads/default.php?status=&state=&pubname=&pubdate=">View Download</a>
                    <a href="#">Add Download</a>
                    <a href="#">Edit Download</a>
                </div>
            </div>
        </li>
        <li>Reports
            <div>
                <div class="column">
                    <a href="../reports/bystaffid.php">Listing By Staff ID</a>
                    <a href="#">Listings By Publication</a>
                    <a href="#">Report Sample</a>
                </div>
            </div>
        </li>
        <li>Exports
            <div>
                <div class="column">
                    <a href="bypublication.php">By Publication</a>
                    <a href="#">By Batch ID</a>
                </div>
            </div>
        </li>
        <li><a href="#">Setup</a>
            <div>
                <div class="column">
                    <a href="#">User</a>
                    <a href="#">Job Number</a>
                    <a href="#">Publication [AU]</a>
                </div>
            </div>
        </li>
        <li><a href="#">About</a></li>
    </ul>
</nav>
<div id="content">
	<h2>Export By Publication [AUSTRALIA]</h2>
	<form method="get" action="bypublication2.php">
		<fieldset>
			<label>State</label>
			<select name="state">
				<?php echo keypairs($state_lkp_au,$_GET['state'],false,""); ?>
			</select><br>
			<label>Publication Name</label>
			<select name="publication_name" required>
				<?php echo keypairs($publication_lookup,$_GET['publication_name'],false,""); ?>
			</select><br>
			<label>Publication Date</label>
			<input id="publication_date" name="publication_date" type="text" value="<?php echo !empty($_GET['publication_date']) ? $_GET['publication_date'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/><br>
			<label>Start Sequence</label>
			<input name="start" type="text" value="<?php echo !empty($_GET['start']) ? $_GET['start'] : '';?>" required/>
			<br><br>
			<input name="submit" type="submit" value="View" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['state'])){ ?>
	<h3>Batch Summary</h3>
	<table id="batch">
		<tr>
			<th>Entry</th>
			<th>Verify</th>
			<th>Batch Id</th>
			<th>Publication Name</th>
			<th>Date</th>
			<th>Entry Records</th>
			<th>Verify Records</th>
			<th>Status</th>
		</tr>
		<?php foreach($batches as $batch){?>
		<tr>
			<td><?php echo $batch['entry_id']; ?></td>
			<td><?php echo $batch['verify_id']; ?></td>
			<td><?php echo $batch['batch_id']; ?></td>
			<td><?php echo $batch['publication_name']; ?></td>
			<td><?php echo $batch['publication_date']; ?></td>
			<td><?php echo $batch['entry_records']; ?></td>
			<td><?php echo $batch['verify_records']; ?></td>
			<td><?php echo $batch['status']; ?></td>
		</tr>
		<?php } ?>
	</table>
	
	<br><br>
	<h3>Records Summary</h3>
	<table id="records">
		<tr>
			<td>Sale : </td>
			<th><?php echo $total['sale'];?></th>
		</tr>
		<tr>
			<td>Rent : </td>
			<th><?php echo $total['rent'];?></th>
		</tr>
		<tr>
			<td>Total : </td>
			<th><?php echo $total['total'];?></th>
		</tr>
		<tr>
			<td>Start Sequence : </td>
			<th><?php echo $_GET['start'];?></th>
		</tr>
		<tr>
			<td>End Sequence : </td>
			<th><?php echo $end;?></th>
		</tr>
		<tr>
			<th colspan=2>
			<a href="<?php echo 'textoutput2.php?state='.$_GET['state'].'&publication_name='.$_GET['publication_name'].'&publication_date='.$_GET['publication_date'].'&start='.$_GET['start'];?>"><button id="export">Export File</button></a>
			</th>
		</tr>
	</table>
	<?php } else {echo "<h3>No Result Found!!</h3>";}?>
</div>
<?php layout_template('footer.php'); ?>