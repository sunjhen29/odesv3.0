<?php 
	require_once("../_includes/initialize.php");
	if(!$session->is_logged_in()){
		redirect_to("../logout.php"); //if not redirect to login page
	} else {
		if(!$session->state || !$session->publication_name || !$session->publication_date || !$session->job_number || !$session->batch_id){
		redirect_to("default.php"); //if not redirect to login page
		}
	}
	$session->log_action("VIEW");
	$session->log_start();
	$withinvalid = Publication::find_invalid($session->state,$session->publication_name);
	
	$records = NewZealand::view_records($session->operator_id,date('d/m/Y'));
	$aus_records = Australia::view_records($session->operator_id,date('d/m/Y'));
	$inv_records = Invalid::view_records($session->operator_id,date('d/m/Y'));
	
	
	
?>
<?php layout_template('header.php'); ?>
<!-- script and css style goes here -->
<style>
.login{
	position: relative;
	float: right;
	top: 1px;
	right: 0px;
	color: gray;
	font-size: 14px;
	font-weight: bold;
	line-height: 16px;
}
#header{
	width: 700px;
	height: 20px;
}
#wrap,#footer{
	width: 700px;
}
#view{
	width: 100%;
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-collapse: collapse;
}
th,td{
	border: 1px solid lightgray;
}
.gitna{
	text-align: center;
}
thead,tfoot{
	background: #0489B1;
	opacity: .7;
	color: white;
}
tr:hover{
	background: lightgray;
}
h2{
	color: darkgray;
}
</style>
<style>
	#submenu{
		margin-top: 2px;
		width: 700px;
		height: 55px;
		background: #0489B1;
	}
	#submenu>h3{
		color: white;
		padding-left: 5px;
	}
	ul{
		display: block;
		margin: 0px;
		padding: 0px;
		padding-left: 8px;
		width: 695px;
		height: 27px;
		background: white;
	}
	#submenu>ul>li{
		float: left;
		width: 60px;
		height: 27px;
		background: white;
	}

	ul>li>a{
		display: block;
		height: 27px;
		font-weight: bold;
		color: #0489B1;
		padding-left: 5px;
		
	}
	ul>li>a:hover{
		color: white;
		background: lightblue;
	}
		
	.active{
		background: #0489B1;
		color: white;
		
	}
</style>
</head>
<body>
<div id="wrap">
<div id="header">
		<span class="entryheader">CCC Data Management Services Inc.</span>
		<span class="login"><?php echo $session->operator_id." : ".$session->name; ?>
		<a href="../logout.php">Logout</a></span><br>
</div><!-- end of header -->
<div id="submenu">
	<ul>
		<li><a href="default.php">&laquoBack</a></li>
		<li><a href="address.php?id=0">Entry</a></li>
		<?php if($session->access_level >= 2){ ?>
		<li><a href="verify.php">Verify</a></li>
		<?php } ?>
		<?php if ($withinvalid['invalid'] == 'Y') { ?>
			<li><a href="invalid.php" style="color: red;">Invalid</a></li>
		<?php } ?>
		<li><a href="view.php">View</a></li>
		<li><a href="history.php" class="active">History</a></li>
	</ul>
	<h3><?php echo "(".$session->state.") ".$session->publication_name." ".$session->publication_date; ?></h3>
</div> <!-- submenu -->
<div id="content">
	<h2><?php echo "[".$session->operator_id."] ".$session->name." - ".date('d/m/Y'); ?></h2>
	<h3>Work History</h3>
	<table id="view">
		<thead>	
			<tr>
				<th>APP</th>
				<th>JOB #</th>
				<th>OPTR</th>
				<th>BATCH ID</th>
				<th>PUBLICATION NAME</th>
				<th>PUB. DATE</th>
				<th>RECS</th>
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
			<td colspan=8></td>
		</tfoot>
	</table>
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>