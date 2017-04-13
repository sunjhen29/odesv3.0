<?php 
	require_once("../_includes/initialize.php");
	if(!$session->is_logged_in()){
		redirect_to("../logout.php"); //if not redirect to login page
	} else {
		if(!$session->state || !$session->publication_name || !$session->publication_date || !$session->job_number || !$session->batch_id){
		redirect_to("default.php"); //if not redirect to login page
		}
	}
	$session->log_action("ENTRY");
	$session->log_start();

	$withinvalid = Publication::find_invalid($session->state,$session->publication_name);
	
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
.proplabel{
	width: 90px;
	text-align: right;
	display: inline-block;
}
.small{
	width: 80px;
}
.medium{
	width: 210px;
}
.rightside{
	float: right;
	margin: 0px;
}
.property_attribute{
	position: relative;
	margin: 0px;
	padding: 0px;
	padding-left: 15px;
	width: 300px;
	height: 25px;
	float: left;
}
.tick{
	position: relative;
	float: left;
	width: 300px;
	padding-left: 15px;
}
.addetails{
	float: left;
	width: 130px;
}
#agenttable{
	margin-bottom: 0px;
}
#agenttable>th,td{
	padding-top: 0px;
	padding-bottom: 0px;
	padding-left: 1px;
	padding-right: 1px;
}
#additional{
	position: relative;
	margin: auto;
}
textarea{
	position: relative;
	width:650px;;
	height: 40px;
	margin: 0px;
	padding: 0px;
}
fieldset{
	margin-bottom: 2px;
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
<script>
$(document).ready(function() {
	$("#linkpostcode").click(function(){
		window.open("search_postcode.php", "Search Suburb", "width=400, height=500, top=200, left=500");
	});

	$("#suburb").change(function(e){
		var requestURL = 'getpostcode.php?state=' + $("#city").val() + '&suburb=' + $(this).val();
		$.getJSON(requestURL,function(data){
			console.log(data);
			if (data.post_code) {
				$(".postcode").html(data.post_code)
			} else {
				$(".postcode").html("0000")
			};
		});
	});
	$("#suburb").blur(function(e){
		var requestURL = 'getpostcode.php?state=' + $("#city").val() + '&suburb=' + $(this).val();
		$.getJSON(requestURL,function(data){
			console.log(data);
			if (data.post_code) {
				$(".postcode").html(data.post_code)
			} else {
				$(".postcode").html("0000")
			};
		});
	});
});
</script>
</head>
<body>
<div id="wrap">
<div id="header">
		<span class="entryheader">CCC Data Management Services Inc.</span>
		<span class="login"><?php echo $session->operator_id." : ".$session->name; ?>
		<a href="../logout.php" tabindex='-1'>Logout</a></span><br>
</div><!-- end of header -->
<div id="submenu">
	<ul>
		<li><a href="default.php">&laquoBACK</a></li>
		<li><a href="address.php?id=0" class="active">Entry</a></li>
		<?php if($session->access_level >= 2){ ?>
		<li><a href="verify.php">Verify</a></li>
		<?php } ?>
		<?php if ($withinvalid['invalid'] == 'Y') { ?>
			<li><a href="invalid.php" style="color: red;">Invalid</a></li>
		<?php } ?>
		<li><a href="view.php">View</a></li>
		
	</ul>
	<h3><?php echo "(".$session->state.") ".$session->publication_name." ".$session->publication_date; ?></h3>
</div> <!-- submenu -->
<div id="content">
	<form name="nzproperty" id="nzproperty" method="get" action="details.php">
	<div id="address"> 
		<span id="view_address"><?php //echo message("Last Added : ".$session->message); ?></span>
			<fieldset>
				<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
				<label class="proplabel">Batch ID :</label>
					<?php echo $session->batch_id;?><br>
				<label class="proplabel">Page No.</label>
					<input name="page_no"class="small" type="text" value="<?php echo isset($session->page_no) ? htmlentities($session->page_no) : '';?>" pattern="[aA-zZ0-9]{1,25}" autofocus required/><br><br>
				<label class="proplabel">Unit No.</label>
					<input class="small" name="unit_no" type="text" value="" pattern="[aA-zZ0-9]{1,10}"/><br>
				<label class="proplabel">Street No.</label>
					<input class="small" name="street_no" type="text" value="" pattern="[aA-zZ0-9]{1,10}" required/> 
				<label>Suffix</label>
					<input class="small" name="street_no_suffix" type="text" value="" pattern="[aA-zZ]{1,5}"/><br>
				<label class="proplabel">Street Name</label>
					<input class="medium" name="street_name" type="text" value="" pattern="[aA-zZ0-9 ]{1,50}" required/>
				<label>Extension</label>
					<select name="street_extension"><?php echo keypairs($street_extension_lkp,"",true,"STREET"); ?></select>
					<select name="street_direction"><?php echo keypairs($street_direction_lkp,"",true,""); ?></select><br>
				<label class="proplabel">Suburb</label>
					<input class="medium" name="suburb" id="suburb" type="text" value="" pattern="[aA-zZ'0-9- ]{1,50}" required/><span class="postcode" style="color:red;"></span><br>
				<label class="proplabel">Property Type</label>
					<select name="property_type"><?php echo keypairs($property_type_lkp_au,"",false,"HO"); ?></select><br>
				<label class="proplabel">State</label>
					<input class="small" name="city" id="city" type="text" value="<?php echo $session->state; ?>" readonly /><br>
				<label class="proplabel">Sale / Rent</label>	
					<select name="sale_rent">
					<?php if(substr($session->batch_id,13,1) == 'S'){echo "<option value='SALE'>SALE</option>";}else{echo "<option value='RENT'>RENT</option>";} ?>
					</select><br>
			</fieldset>
	</div><!-- end of address -->
	<div id="buttons">
		<input type="submit" value="Property Details" style="width: 200px;"/>
	</div>
	</form>
	<br>
	<div>
	<hr>
		<span style="color:red;">New!!</span><br><br>
		<button id="linkpostcode">Click Here to check for Suburb</button>
	</div>
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>