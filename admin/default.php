<?php
	require_once("../_includes/initialize.php");
	include("_layout/checklogin.php");
	$jobnumbers = JobNumber::current();
	$invalid_qc = Invalid::view_complete();
?>
<?php include("_layout/adminheader1.php");?>
<link rel="stylesheet" type="text/css" href="_css/table.css">
	<style>
		#wrap{
			position: relative;
		}
		#sub{
			position: fixed;
			top: 210px;
			left: 25px;
			float: left;
			background: lightblue;
			width: 225px;
		}
		.onepage{
			position: relative;
			margin-left: 250px;
			margin-right: 25px;
			margin-bottom: 20px;
			background: #EAF4FF;
			border: 0;
			padding: 10px;
			height: 500px;
			float: left;
			min-width: 800px;
			clear: both;
		}
		.bottom{
			position: relative;
			margin-left: 250px;
			margin-right: 25px;
			margin-bottom: 20px;
			border: 0;
			padding: 10px;
			height: 300px;
			float: left;
			min-width: 800px;
			clear: both;
		}
		h3{
			padding: 0;
			margin: 0;
			font-size: 25px;
			color: #238BB2;
		}
		#jobnumber{
			position: absolute;
			top: 80px;
			left: 1150px;
		}
		#clock{
			position: fixed;
			bottom: 120px;
			left: 50px;
		}
	</style>
	<script>
		$(document).ready(function() {
			$("#home").addClass("current")
			
			$('a').click(function(){
				$('html, body').animate({
				scrollTop: $( $(this).attr('href') ).offset().top -210
				}, 1000);
			return false;
			});
		});
	</script>
<?php include("_layout/adminheader2.php");?>
<div id="content">
	<div>
	</div>
	<div id="display">
		<div id="sub">
			<a class="submenu" href="#nzgraph">NZ Graph</a>
			<a class="submenu" href="#augraph">AU Graph</a>
			<a class="submenu" href="#invalidqc">Invalid QC</a>
			
		</div>
		<div class="onepage" id="nzgraph">
			<h3>New Zealand</h3>
			<div>
				<h4>Daily Production Records</h4>
				<img src="graph/nzgraph.php" />
			</div>
		</div>
		<div class="onepage" id="augraph">
			<h3>Australia</h3>
			<div>
				<h4>Daily Production Records</h4>
				<img src="graph/augraph.php" />
			</div>
		</div>
		<div class="onepage" id="invalidqc">
			<h3>Invalid QC</h3>
			<div>
				<table>
						<tr>
							<th>State</th>
							<th>Publication Name </th>
							<th>Publication Date</th>
							<th>Property Address</th>
						</tr>
						<?php foreach($invalid_qc as $invalid){ ?>
						<tr>
							<td><?php echo $invalid['State']; ?></td>
							<td><?php echo $invalid['Publication_Name']; ?></td>
							<td><?php echo $invalid['Publication_Date']; ?></td>
							<td><?php 
								$address  = $invalid['Unit_No'];
								if ($invalid['Unit_No'] != ''){
									$address .= "/";
								}
								$address .= $invalid['Street_No']." ";
								$address .= $invalid['Street_No_Suffix']." ";
								$address .= $invalid['Street_Name']." ";
								$address .= $invalid['Street_Extension']." ";
								$address .= $invalid['Street_Direction']." ";
								$address .= $invalid['Suburb']." ";
								echo trim($address);
								?></td>
						</tr>
						<?php } ?>
				</table>
			</div>
		</div>
		<div class="onepage" id="records">
			<h3>Records / Hour</h3>
		</div>
		<div class="bottom"> 
			<h3><a href="#recordsgraph">Back To Top</a></h3>
		</div>
		<div id="clock">
			<!-- <iframe src="http://free.timeanddate.com/clock/i4l8y57h/n145/szw160/szh160/hoc09f/hbw1/hfc09f/cf100/hncfff/fas20/fdi76/mqc000/mql15/mqw4/mqd98/mhc000/mhl15/mhw4/mhd98/mmc000/mml10/mmw1/mmd98/hhs2/hms2/hsv0" frameborder="0" width="162" height="166"></iframe> -->
		</div>
		<div id="jobnumber">
			<h3>Job Numbers For The Month</h3>
			<table class="CSSTableGenerator" style="width:400px;height:150px;">
				<tbody>
					<tr>
						<td>Job Number</td>
						<td>Description</td>
						<td>Sale / Rent</td>
						<td>Publication Date</td>
					</tr>
					<?php foreach($jobnumbers as $job){ ?>
					<tr>
						<td style="text-align: center;"><?php echo $job['Job_Number'];?></td>
						<td style="text-align: center;"><?php echo $job['Description'];?></td>
						<td style="text-align: center;"><?php echo $job['Sale_Rent'];?></td>
						<td style="text-align: center;"><?php echo $job['Publication_Date'];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
</div>
<?php include("_layout/adminfooter.php");?>
