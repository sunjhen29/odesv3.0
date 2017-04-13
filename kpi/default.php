<?php 
	///admin page
	require_once("../_includes/initialize.php");

?>
<?php layout_template('header.php'); ?>
<!-- script and css style goes here -->
<style>
	label{
		width: 125px;
		display: inline-block;
	}
	thead{
		background: lightgray;
		font-weight: bold;
		color: green;
	}
	tfoot{
		background: lightgray;
		font-weight: bold;
		color: green;
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
	<h2>Select Report</h2>
	<ul>
		<li><a href="rptjobnumber.php">Per Job Number</a></li>
		<li><a href="rptoperator.php">Per Job</a></li>
		<li><a href="rpthours.php">Productive Hours</a></li>
		<li><a href="rptrecsperhour.php">Records Per Hour Report</a></li>
		<li><a href="rptdailyreport.php">Daily Report</a></li>
	</ul>
</div>
<?php layout_template('footer.php'); ?>
