<?php 
	require_once("../_includes/initialize.php");
	if(!$session->is_logged_in()){
		redirect_to("../logout.php"); //if not redirect to login page
	} 
	$invalid = Invalid::find_property_details(isset($_GET['id']) ? $_GET['id'] : 0);
	//$publication_lookup = Publication::publication_lookup_with_invalid('AU',$invalid['State']);
	$publication_date = DateTime::createFromFormat('Y-m-d',$invalid['Publication_Date']);
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
.headlabel{
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
<script>
$(document).ready(function() {
	
	$.getJSON("getInvalidPublication.php",{q: $("select[name='state']").val(), ajax: 'true'}, function(j){
		console.log(j);
		var options = '';
			for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].pub_name + '" ';
					
				if ($("input[name='pubname']").val() == j[i].pub_name){
					options += 'selected';
				}
					options += '>' + j[i].pub_display + '</option>';
			}
			$("select[name='publication_name']").html(options);
	});
	$("select[name='state']").change(function(){
		$.getJSON("getInvalidPublication.php",{q: $(this).val(), ajax: 'true'}, function(j){
		console.log(j);
		var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].pub_name + '">' + j[i].pub_display + '</option>';
			}
			$("select[name='publication_name']").html(options);
		});
	});

	function Ymd_format(str,inpt){
		if (str.length == 2){
			$(inpt).val(str+"/"); 
		} else if (str.length == 5){
			$(inpt).val(str+"/");
		} 
	};	
	$("#auction_date").keyup(function(){
		Ymd_format($("#auction_date").val(),"#auction_date");
	});
	$("#auction_date").keypress(function(){
		Ymd_format($("#auction_date").val(),"#auction_date");
	});
	$("#auction_date").blur(function(){
		Ymd_format($("#auction_date").val(),"#auction_date");
	});
	
	//keyboard shortcuts	
	$(window).keydown(function(e) {
		if ((e.keyCode) == 17){
			isCtrl = true;
		}
		if ((e.keyCode) == 101 && isCtrl == true){
			e.preventDefault();
			$("#ad_size").focus();
			$("html, body").animate({ scrollTop: $(document).height() }, "slow");
		}
		return;
	});
	
	$(window).keyup(function(e) {
		isCtrl = false;
		return;
	});
	
	$("#ad_size").blur(function(){
		if($("#ad_size").val() == "CLASSIFIEDS"){
			$("#ad_photo_type").val('NO PHOTO');
			$("#ad_photo_count").val('NOT APPLICABLE');
			$("#ad_section").val('CLASSIFIEDS');
		} else {
			$("#ad_photo_type").val('COLOUR');
			$("#ad_photo_count").val('SINGLE');
			$("#ad_section").val('MIDDLE')
		} 
	});
	
	$("#ad_size").change(function(){
		if($("#ad_size").val() == "CLASSIFIEDS"){
			$("#ad_photo_type").val('NO PHOTO');
			$("#ad_photo_count").val('NOT APPLICABLE');
			$("#ad_section").val('CLASSIFIEDS');
		} else {
			$("#ad_photo_type").val('COLOUR');
			$("#ad_photo_count").val('SINGLE');
			$("#ad_section").val('MIDDLE')
		} 
	});
	
	$("#ad_photo_type").change(function(){
		if($("#ad_photo_type").val() == "NO PHOTO"){
			$("#ad_photo_count").val('NOT APPLICABLE');
		} else {
			$("#ad_photo_count").val('SINGLE');
		} 
	});
	
	$("#ad_photo_type").blur(function(){
		if($("#ad_photo_type").val() == "NO PHOTO"){
			$("#ad_photo_count").val('NOT APPLICABLE');
		} else {
			$("#ad_photo_count").val('SINGLE');
		} 
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
<div id="content">
	<h2>Modify Invalid Record</h2>
	<form name="nzproperty" id="nzproperty" method="post" action="process_invalid.php?action=modify">
	<div id="maindetails">
		<fieldset>
		<label class="headlabel">State</label>
			<select name="state">
				<?php echo keypairs($state_lkp_pubstate_inv,$invalid['State'],false,""); ?>
			</select><br>
		<label class="headlabel">Publication Name</label>
			<input type="hidden" name="pubname" value="<?php echo htmlentities($invalid['Publication_Name']);?>" />
			<select name="publication_name" required>
			</select><br>
		<label class="headlabel">Publication Date</label>
			<input id="publication_date" name="publication_date" type="text" value="<?php echo htmlentities($publication_date->format('d/m/Y'));?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/><br>
		<label class="headlabel">Batch ID</label>
			<input name="batch_id" type="text" value="<?php echo htmlentities($invalid['Batch_Id']);?>" pattern="[a-zA-Z0-9]{3}[_][0-9]{8}[_][sS|Rr][_][0-9]{2}" required/><br>
		</fieldset>
	</div><!-- end of maindetails -->
	<div id="address"> 
			<br>
			<fieldset>
				<input type="hidden" name="id" value="<?php echo $invalid['id'] ? $invalid['id'] : 0;?>" />
				<label class="proplabel">Page No.</label>
					<input name="page_no"class="small" type="text" value="<?php echo htmlentities($invalid['Page_No']); ?>" pattern="[aA-zZ0-9]{1,25}" autofocus required/><br><br>
				<label class="proplabel">Unit No.</label>
					<input class="small" name="unit_no" type="text" value="<?php echo htmlentities($invalid['Unit_No']); ?>" pattern="[aA-zZ0-9]{1,10}" /><br>
				<label class="proplabel">Street No.</label>
					<input class="small" name="street_no" type="text" value="<?php echo htmlentities($invalid['Street_No']); ?>" pattern="[aA-zZ0-9]{1,10}"/> 
				<label>Suffix</label>
					<input class="small" name="street_no_suffix" type="text" value="<?php echo htmlentities($invalid['Street_No_Suffix']); ?>" pattern="[aA-zZ]{1,5}"/><br>
				<label class="proplabel">Street Name</label>
					<input class="medium" name="street_name" type="text" value="<?php echo htmlentities($invalid['Street_Name']); ?>" pattern="[aA-zZ0-9 ]{1,25}"/>
				<label>Extension</label>
					<select name="street_extension"><?php echo keypairs($street_extension_lkp,$invalid['Street_Extension'] ? $invalid['Street_Extension'] : '',true,""); ?></select>
					<select name="street_direction"><?php echo keypairs($street_direction_lkp,$invalid['Street_Direction'] ? $invalid['Street_Direction'] : '',true,""); ?></select><br>
				<label class="proplabel">Suburb</label>
					<input class="medium" name="suburb" type="text" value="<?php echo htmlentities($invalid['Suburb']); ?>" pattern="[aA-zZ'0-9 ]{1,50}"/>
				<label>Property State</label>
					<select name="property_state">
						<?php echo keypairs($state_lkp_au_inv,$invalid['Property_State'] ? $invalid['Property_State'] : $invalid['State'],false,$invalid['State']); ?>
					</select><br>
				<label class="proplabel">Property Type</label>
					<select name="property_type"><?php echo keypairs($property_type_inv,$invalid['Property_Type'] ? $invalid['Property_Type'] : '',false,"HO"); ?></select>
				<label>Multiple Properties</label>
					<select name="multiple">
						<?php $yesno = array('YES'=>'YES','NO'=>'NO'); 
							echo keypairs($yesno,$invalid['Multiple'] ? $invalid['Multiple'] : '',true,'');
						?>
				</select><br>
				<label class="proplabel">Sale / Rent</label>	
					<select name="sale_rent">
					<?php if(substr($invalid['Batch_Id'],13,1) == 'S'){echo "<option value='SALE'>SALE</option>";}else{echo "<option value='RENT'>RENT</option>";} ?>
					</select> &nbsp &nbsp &nbsp
			</fieldset>
	</div><!-- end of address -->
	<div id="listingdetails">
		<fieldset>
			<label class="proplabel">Listing Type</label>
				<select name="listing_type" autofocus>
				<?php
					if(substr($invalid['Batch_Id'],13,1) == 'S'){ 
						echo keypairs($listing_type_lkp,$invalid['Listing_Type'] ? $invalid['Listing_Type'] : '',false,"S");
					} else { 
						echo "<option value='R'>RENT</option>";
					}
				?>
				</select>
			<?php if(substr($invalid['Batch_Id'],13,1) == 'S'){ ?>
			<input class="rightside" id="auction_date" name="auction_date" type="text" placeholder="dd/mm/yyyy" value="<?php echo $invalid['Auction_Date'] ? date('d/m/Y',strtotime($invalid['Auction_Date'])) : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$"/>
				<label class="rightside">Auction/Tender Date</label><br>
			<?php } else { echo "<br>";}?>
			<label class="proplabel">Price From</label>
				<input name="price_from"type="text" class="price" value="<?php echo htmlentities($invalid['Price_From']); ?>" pattern="[0-9]{1,10}"/>
			<?php if(substr($invalid['Batch_Id'],13,1) == 'S'){ ?>
			<input class="rightside" name="auction_time" type="text" placeholder="HH:MM AM/PM" value="<?php echo htmlentities($invalid['Auction_Time']); ?>" pattern="^[0-1][0-9]:[0-5][0-9] [APap][mM]$"/>
				<label class="rightside">Auction/Tender Time</label><br>
			<?php } else { echo "<br>";}?>	
			<label class="proplabel">Price To</label>
				<input name="price_to" type="text" class="price" value="<?php echo htmlentities($invalid['Price_To']); ?>" pattern="[0-9]{1,10}"/>
			<?php if(substr($invalid['Batch_Id'],13,1) == 'S'){ ?>	
			<input name="auction_location" class="rightside" type="text" value="<?php echo htmlentities($invalid['Auction_Location']); ?>" pattern=".{3,}"/>
				<label class="rightside">Auction Venue</label><br>
			<?php } else { echo "<br>";}?>			
			<label class="proplabel">Price Description</label>
				<input name="price_description" type="text" style="width: 400px;" value="<?php echo htmlentities($invalid['Price_Description']); ?>" pattern=".{3,}"/><br>
			<?php if(substr($invalid['Batch_Id'],13,1) == 'R'){ ?>
			<label class="proplabel">Rental</label>
				<select name="rental_period"><?php echo keypairs($rental_period_lkp,$details['Rental_Period'],false,"W"); ?></select>
			<?php } ?>
		</fieldset>
	</div> <!-- end of listing details -->
	<div id="attributes">	
		<fieldset>
		<div class="property_attribute">
			<input name="bedrooms" class="small" type="text" value="<?php echo htmlentities($invalid['Bedrooms']); ?>" pattern="[0-9-]{1,5}"/>
			<label>Bedrooms</label>
		</div>
		<div class="property_attribute">
			<input name="bathrooms" class="small" type="text" value="<?php echo htmlentities($invalid['Bathrooms']); ?>" pattern="[0-9]{1,3}"/>
			<label>Bathrooms</label>
		</div>
		<div class="property_attribute">
			<input name="car_spaces" class="small" type="text" value="<?php echo htmlentities($invalid['Car_Spaces']); ?>" pattern="[0-9]{1}"/>
			<label>Lock-up Garage</label>
		</div>
		<div class="property_attribute">
			<label><input name="air_conditioned" type="checkbox" value="YES" <?php echo $invalid['Air_Conditioned'] == 'YES' ? 'checked' : '';?>>Air Conditioned</label>
		</div>
		<div class="property_attribute">
			<label><input name="swimming_pool" type="checkbox" value="YES<?php echo $invalid['Swimming_Pool'] == 'YES' ? 'checked' : '';?>>Swimming Pool</label>
		</div>
		<div class="property_attribute">
			<label><input name="close_to_public" type="checkbox" value="YES" <?php echo $invalid['Close_To_Public'] == 'YES' ? 'checked' : '';?>>Close To Public Transport</label>
		</div>
		</fieldset>
	</div><!-- end of attributes -->
	<div id="ad_details">
		<fieldset>
			<div class="addetails">
				<label>Ad Size</label><br>
				<select id="ad_size" name="ad_size"><?php echo keypairs($ad_size_lkp,$invalid['Ad_Size'],false,"SMALL"); ?></select>
			</div>
			<div class="addetails" style="width: 110px;">
				<label>Photo Type</label><br>
				<select id="ad_photo_type" name="ad_photo_type"><?php echo keypairs($photo_type_lkp,$invalid['Ad_Photo_Type'],false,"COLOUR"); ?></select>
			</div>
			<div class="addetails" style="width: 150px;">
				<label>Photo Count</label><br>
				<select id="ad_photo_count" name="ad_photo_count"><?php echo keypairs($photo_count_lkp,$invalid['Ad_Photo_Count'],false,"SINGLE"); ?></select>
			</div>
			<div class="addetails" style="width: 125px;">
				<label>Section</label><br>
				<select id="ad_section" name="ad_section"><?php echo keypairs($section_lkp,$invalid['Ad_Section'],false,"MIDDLE"); ?></select>
			</div>
			<div class="addetails">
				<label>Exclusive Agent</label><br>
				<select id="ad_section" name="ad_exclusive"><?php echo keypairs($exclusive_agent_lkp,$invalid['Ad_Exclusive'],false,"UNKNOWN"); ?></select>
			</div>
		</fieldset>
	</div>
	<div id="agentdetails">		
		<fieldset>
			<div class="agent">
				<table id="agenttable"> 
					<tr>
						<td>Agency Name</td>
						<td><input name="agency_name" type="text" value="<?php echo htmlentities($invalid['Agency_Name']); ?>" style="width: 550px;" required /></td>
					</tr>
					<tr>
						<td>Firstname</td>
						<td><input name="firstname" type="text" value="<?php echo htmlentities($invalid['Firstname']); ?>" style="width: 550px;"/></td>
					</tr>
					<tr>
						<td>Lastname</td>
						<td><input name="lastname" type="text" value="<?php echo htmlentities($invalid['Lastname']); ?>" style="width: 550px;"/></td>
					</tr>
					<tr>
						<td>Contact</td>
						<td><input name="contact" type="text" value="<?php echo htmlentities($invalid['Contact']); ?>" style="width: 550px;" pattern="[0-9, ]{1,50}"/></td>
					</tr>
				</table>
			</div>
		</fieldset>
	</div>
	<div id="additional">
		<fieldset>
			<div>
				<label>Comments</label><br>
				<textarea name="comment"><?php echo htmlentities($invalid['Comment']); ?></textarea>
			</div>
		</fieldset>
	</div>
	<div id="buttons">
		<input type="submit" onclick="return confirm('Are you sure want to save this record?');" value="<?php echo $invalid['id'] ? 'Update Record' : 'Save Record'; ?>" style="width: 200px;"/>
	</div>
	</form>
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>