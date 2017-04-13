<?php 
	///admin page
	require_once("../_includes/initialize.php");
	if(isset($_GET['optr_id']) && isset($_GET['production_date'])){
		$juliandate = DateTime::createFromFormat('d/m/Y',$_GET['production_date']);
		$dayNumber = $juliandate->format('y').$juliandate->format('z') + 1;
		if (strtoupper($_GET['optr_id']) == 'ALL'){
			$records = KPI::all_records($dayNumber);
		} else {
			$records = KPI::view_records($_GET['optr_id'],$dayNumber);
		}
	} 
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
<script>
$(document).ready(function() {
	var totalrecords = 0;
	var totalhours = 0;
	
	$("td.records").each(function () { 
		totalrecords += parseInt($(this).text());
		$("td.trecords").text(totalrecords);
	});
	
	$("td.hours").each(function () { 
		totalhours += parseFloat($(this).text());
		$("td.thours").text(totalhours);
	});
	
		
	function Ymd_format(str,inpt){
		if (str.length == 2){
			$(inpt).val(str+"/"); 
		} else if (str.length == 5){
			$(inpt).val(str+"/");
		} 
	};	
	$("#production_date").keyup(function(){
		Ymd_format($("#production_date").val(),"#production_date");
	});
	$("#publication_date").keypress(function(){
		Ymd_format($("#production_date").val(),"#production_date");
	});
	$("#production_date").blur(function(){
		Ymd_format($("#production_date").val(),"#production_date");
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
<div id="content">
	<h2>Performance Query Page</h2>
	<form>
		<fieldset>
			<label>Staff ID</label>
				<input name="optr_id"type="text" value="<?php echo !empty($_GET['optr_id']) ? $_GET['optr_id'] : 'all';?>" required autofocus/><br>
			<label>Production Date</label>
				<input id="production_date" name="production_date" type="text" value="<?php echo !empty($_GET['production_date']) ? $_GET['production_date'] : date('d/m/Y');?>" required/><br>
			<input type="submit" value="Submit" />
		</fieldset>
	</form>
	<?php if(!empty($_GET['optr_id'])) {?>
	<hr>
	<table>
		<thead>
		<tr>
			<th>Julian Date</th>
			<th>Job #</th>
			<th>Operator</th>
			<th>Job Description</th>
			<th>Hours</th>
			<th>Records</th>
			<th style="text-align: right;">R / H</th>
		</tr>
		</thead>
		<?php $total_time=0; foreach($records as $record){ ?>
		<tr>
			<td style="text-align: center;"><?php echo $record['production_date']; ?></td>
			<td><?php echo $record['job_number'].$record['ev']; ?></td>
			<td style="text-align: center;"><?php echo $record['operator']; ?></td>
			<td width="400px"><?php echo $record['job_description']; ?></td>
			<td class="hours" style="text-align: right;"><?php echo $record['hours']; ?></td>
			<td class="records" style="text-align: right;"><?php echo $record['records']; ?></td>
			<td width="150px" class="recordsperhour" style="text-align: right;"><?php echo $record['recs_hour']; ?></td>
		</tr>
		<?php } ?>
		<tfoot>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td class="thours"></td>
			<td class="trecords"></td>
			<td></td>
		</tr>
		</tfoot>
	</table>
	<?php } else { echo "<h3>No Results Found</h3>";}?>
</div>
<?php layout_template('footer.php'); ?>
