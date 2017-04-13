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
		<a href="../logout.php">Logout</a></span><br>
</div><!-- end of header -->
<div id="menu">
	<a href="reports.php">Reports</a>
	<a href="export.php">Export</a>
</div>
<div id="content">
	<h2>Enter Publication Details</h2>

</div>
<?php layout_template('footer.php'); ?>