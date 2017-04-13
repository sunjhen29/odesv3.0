<?php 
	require_once("../_includes/initialize.php");
	$details = NewZealand::find_property_details($_GET['id']);
	$publication_lookup = Publication::publication_lookup('NZ');
	$publication_date = DateTime::createFromFormat('Y-m-d',$details['Publication_Date']);
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
	width: 150px;
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
#maindetails{
	border: 1px solid green;
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
<div id="content">
	<?php if($details) {?>
	<h2>Modify Page</h2>
	<form name="nzproperty" id="nzproperty" method="get" action="details.php">
	<div id="maindetails">
		<fieldset>
		<label class="proplabel">State</label>
			<select name="state">
				<?php echo keypairs($state_lkp,$details['State'],false,""); ?>
			</select><br>
		<label class="proplabel">Publication Name</label>
			<select name="publication_name" required>
				<?php echo keypairs($publication_lookup,$details['Publication_Name'],false,""); ?>
			</select><br>
		<label class="proplabel">Publication Date</label>
			<input id="publication_date" name="publication_date" type="text" value="<?php echo htmlentities($publication_date->format('d/m/Y'));?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/><br>
		<label class="proplabel">Batch ID</label>
			<input name="batch_id" type="text" value="<?php echo htmlentities($details['Batch_Id']);?>" pattern="[a-zA-Z0-9]{3}[_][0-9]{8}[_][sS|Rr][_][0-9]{2}" required/><br>
		</fieldset>
	</div><!-- end of main details -->
	<div id="address"> 
		<span id="view_address"></span>
			<fieldset>
				<input name="id" type="hidden" value="<?php echo htmlentities($details['id']);?>" autofocus required/><br><br>
				<label class="proplabel">Page No.</label>
					<input name="page_no"class="small" type="text" value="<?php echo htmlentities($details['Page_No']);?>" autofocus required/><br><br>
				<label class="proplabel">Unit No.</label>
					<input class="small" name="unit_no" type="text" value="<?php echo htmlentities($details['Unit_No']);?>"/><br>
				<label class="proplabel">Street No.</label>
					<input class="small" name="street_no" type="text" value="<?php echo htmlentities($details['Street_No']);?>" required/> 
				<label>Suffix</label>
					<input class="small" name="street_no_suffix" type="text" value="<?php echo htmlentities($details['Street_No_Suffix']);?>"/><br>
				<label class="proplabel">Street Name</label>
					<input class="medium" name="street_name" type="text" value="<?php echo htmlentities($details['Street_Name']);?>" required/>
				<label>Extension</label>
					<select name="street_extension"><?php echo keypairs($street_extension_lkp,$details['Street_Extension'],true,""); ?></select>
					<select name="street_direction"><?php echo keypairs($street_direction_lkp,$details['Street_Direction'],true,""); ?></select><br>
				<label class="proplabel">Suburb</label>
					<input class="medium" name="suburb" type="text" value="<?php echo htmlentities($details['Suburb']);?>" required/><br>
				<label class="proplabel">City</label>
					<input class="medium" name="city" type="text" value="<?php echo htmlentities($details['City']);?>"/><br>
				<label class="proplabel">Property Type</label>
					<select name="property_type"><?php echo keypairs($property_type_lkp,$details['Property_Type'],false,"HO"); ?></select><br>
				<label class="proplabel">Sale / Rent</label>	
					<select name="sale_rent">
					<?php if(substr($details['Batch_Id'],13,1) == 'S'){echo "<option value='SALE'>SALE</option>";}else{echo "<option value='RENT'>RENT</option>";} ?>
					</select>
			</fieldset>
	</div><!-- end of address -->
	<div id="buttons">
		<input type="submit" value="Property Details" style="width: 200px;"/>
	</div>
	</form>
	<?php }?>
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>