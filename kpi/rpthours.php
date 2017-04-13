<?php 
	///admin page
	require_once("../_includes/initialize.php");
	$julian = isset($_GET['day']) ? $_GET['day'] : '15201';

	$job_numbers = KPI::productive_hours($julian);

?>
<?php layout_template('header.php'); ?>
<!-- script and css style goes here -->
<style>
	label{
		width: 125px;
		display: inline-block;
	}
	.left{
		text-align: left;
	}
	.right{
		text-align: right;
	}
	.center {
		text-align: center;
	}
</style>
</head>
<body>
<div id="wrap">
<div id="header">
		<h1>CCC Data Management Services Inc.</h1>
		<span class="login"><?php echo date('F j, Y')." "; ?></span><br><br>
		<span class="login">Welcome, <?php echo $session->name." [".$session->operator_id."]"; ?>
		<a href="../logout.php">Logout</a></span><br>
</div><!-- end of header -->
<div id="content">
	<span><a href="default.php" />Reports</a>/<a href="rpthourS.php">Productive Hours</a></span>
	<h2>Productive Hours Per Operator</h2>
	<br>
	<form>
		<label>Julian Date</label>
		<input type="text" name="day" value="<?php echo isset($_GET['day']) ? $_GET['day'] : ""; ?>" /><br>
	</form>
	<br>
	<table>
	<tr>
		<th>Operator</th>
		<th>Total Hours</th>
	</tr>
	<?php foreach($job_numbers as $job_number){ ?>
		<tr>
			<td class="left"><?php echo htmlentities($job_number['operator']);?></td>
			<td class="right"><?php echo htmlentities($job_number['hours']);?></td>
		</tr>
	<?php } ?>
	</table>
	
</div>
<?php layout_template('footer.php'); ?>
