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
	//valid
	$properties = Australia::view($session->batch_id,$session->state,$session->publication_name,$session->publication_date);
	$totalrecords = Australia::rowCount($session->batch_id,$session->state,$session->publication_name,$session->publication_date);
	//invalid
	$invalid_properties = Invalid::view($session->batch_id,$session->state,$session->publication_name,$session->publication_date);
	$invalid_totalrecords = Invalid::rowCount($session->batch_id,$session->state,$session->publication_name,$session->publication_date);
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
		<li><a href="view.php" class="active">View</a></li>
		<li><a href="history.php">History</a></li>
	</ul>
	<h3><?php echo "(".$session->state.") ".$session->publication_name." ".$session->publication_date; ?></h3>
</div> <!-- submenu -->
<div id="content">
	<h2><?php echo $session->batch_id."   Job No.:".$session->job_number; ?></h2>
	<h3>Valid Address Listings</h3>
	<h4><?php echo "Total Results Found : ".$totalrecords; ?></h4>
	<?php if ($totalrecords) { ?>
	<table id="view">
		<thead>	
			<tr>
				<th>PAGE</th>
				<th>ADDRESS</th>
				<th>S / R</th>
				<th>ENTRY</th>
				<th>VERIFY</th>
				<th colspan=2>COMMAND</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($properties as $property) { ?>
			<tr>
				<td class="gitna"><?php echo $property['page_no']; ?></td>
				<td><?php echo $property['unit_no'];if (!empty($property['unit_no'])){echo "/";} echo $property['street_no']." ".$property['street_name']." ".$property['street_extension']." ".$property['street_direction']." ".$property['suburb']." ".$property['city'].", ".$property['postcode']; ?></td>
				<td class="gitna"><?php echo $property['sale_rent']; ?></td>
				<td class="gitna"><?php echo $property['entry_id']; ?></td>
				<td class="gitna"><?php echo $property['verify_id']; ?></td>
				<td class="gitna"><?php echo "<a href='modify.php?id=".$property['id']."'><button>Modify</button></a>" ?></td>
				<td class="gitna"><?php echo "<a onclick=\"return confirm('Are you sure want to delete this record?')\" href='process.php?action=delete&id=".$property['id']."'><button>Delete</button></a>" ?></td>
			</tr>
			<?php }; ?>
		</tbody>
		<tfoot>
			<td colspan=7></td>
		</tfoot>
	</table>
	<?php }; ?>
	<br>
	<h3>Invalid Address Listings</h3>
	<h4><?php echo "Total Results Found : ".$invalid_totalrecords; ?></h4>
	<?php if ($invalid_totalrecords) { ?>
	<table id="view">
		<thead>
			<tr>
				<th>PAGE</th>
				<th>ADDRESS</th>
				<th>S / R</th>
				<th>ENTRY</th>
				<th colspan=2>COMMAND</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($invalid_properties as $property) { ?>
			<tr>
				<td class="gitna"><?php echo $property['page_no']; ?></td>
				<td><?php echo $property['unit_no'];if (!empty($property['unit_no'])){echo "/";} echo $property['street_no']." ".$property['street_name']." ".$property['street_extension']." ".$property['street_direction']." ".$property['suburb']." ".$property['multiple']; ?></td>
				<td class="gitna"><?php echo $property['sale_rent']; ?></td>
				<td class="gitna"><?php echo $property['entry_id']; ?></td>
				<td class="gitna"><?php echo "<a href='invalid.php?id=".$property['id']."'><button>Modify</button></a>" ?></td>
				<td class="gitna"><?php echo "<a onclick=\"return confirm('Are you sure want to delete this record?')\" href='process_invalid.php?action=delete&id=".$property['id']."'><button>Delete</button></a>" ?></td>
			</tr>
			<?php }; ?>
		</tbody>
		<tfoot>
			<td colspan=7></td>
		</tfoot>
	</table>
	<?php }; ?>	
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>