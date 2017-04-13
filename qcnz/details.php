<?php 
	require_once("../_includes/initialize.php");
		$details = NewZealand::find_property_details($_GET['id']);
		$agents = Agent::find_by_record_id($_GET['id']); 
		$publication_lookup = Publication::publication_lookup('NZ');
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
	width: 130px;
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
#address{
	display: none;
}
.price{
	width: 100px;
	text-align: right;
	padding-right: 5px;
}
#maindetails{
	border: 1px solid green;
}
</style>
<script>
$(document).ready(function() {
	var street = $.trim($("input[name='street_name']").val() +' '+ $("select[name='street_extension']").val());
	var postcodeURL = 'getpostcode.php?street='+street+'&suburb='+$("input[name='suburb']").val();
	$.getJSON(postcodeURL,function(data){
		console.log(data);
		$("#postcode").html(data.postcode);
	});
	
	var isCtrl = false;
	
	$("select[name='type_of_scenic']").change(function(){
        if($("select[name='type_of_scenic']").val() != ""){ 
			$("input[name='scenic_view']").prop('checked',true);  
		} else {
			$("input[name='scenic_view']").prop('checked',false); 
		}
    }).blur(function(){
        if($("select[name='type_of_scenic']").val() != ""){ 
			$("input[name='scenic_view']").prop('checked',true);  
		} else {
			$("input[name='scenic_view']").prop('checked',false); 
		}
    });
	
	$(':checkbox').focus(function(){
        $(this).parent('label').css('background','lightgreen');
    }).blur(
    function(){
        $(this).parent('label').css('background','white');
    });
	
	$(".contact").change(function(e){
		var index = $(".contact").index(this);
		var requestURL = 'getagent.php?q='+$(this).val();

		$.getJSON(requestURL,function(data){
			console.log(data);
			if (data.agency_name) $(".agency").eq(index).val(data.agency_name);
			if (data.agent_firstname) $(".firstname").eq(index).val(data.agent_firstname);
			if (data.agent_surname) $(".lastname").eq(index).val(data.agent_surname);
		});
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
		
		if ((e.keyCode) == 104 && isCtrl == true){
			e.preventDefault();
			$("input[name='bedrooms']").focus();
		}
		
		if ((e.keyCode) == 103 && isCtrl == true){
			e.preventDefault();
			$("input[name='air_conditioned']").focus();
		}
		
		if ((e.keyCode) == 96 && isCtrl == true){
			e.preventDefault();
			$(".contact:first").focus();
			$("html, body").animate({ scrollTop: $(document).height() }, "slow");
		}
		return;
	});
	
	$(window).keyup(function(e) {
		isCtrl = false;
		return;
	});

	$('#nzproperty').submit(function(){
		var flag = false;
		for (var count = 0; count <= 4; count++){
			if($(".contact").eq(count).val() != "" || $(".agency").eq(count).val() != ""){
				address = $("#property_address").text();
				msg = "Are you sure you want to submit this record to the database? " + address;
				r = confirm(msg);
				return r;
			} else {
				flag = false
			}
		}
		if (flag == false){
			$(".contact").eq(0).focus();
			alert("Please enter at least one valid agent!!!");	
		}
		return flag;
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
});
</script>
</head>
<body>
<div id="wrap">
<div id="header">
		<span class="entryheader">CCC Data Management Services Inc.</span>
		<span class="login"><?php echo $session->operator_id." : ".$session->name; ?>
		<a href="../logout.php">Logout</a></span><br>
</div><!-- end of header -->
<div id="content">
	<h2 id="property_address"><?php 
		echo $_GET['unit_no'];
		if($_GET['unit_no']){ echo "/";}
		echo trim(strtoupper($_GET['street_no'].$_GET['street_no_suffix']." ".$_GET['street_name']." ".$_GET['street_extension']." ".$_GET['street_direction']." ".$_GET['suburb']." ".$_GET['city'])); 
	?>
	<span id="postcode"></span>
	</h2>
	<form id="nzproperty" name="nzproperty" id="nzproperty" method="post" action="process.php?action=modify">
	<div id="maindetails">
		<fieldset>
		<label class="proplabel">State</label>
			<select name="state">
				<?php echo keypairs($state_lkp,$_GET['state'],false,""); ?>
			</select><br>
		<label class="proplabel">Publication Name</label>
			<select name="publication_name" required>
				<?php echo keypairs($publication_lookup,$_GET['publication_name'],false,""); ?>
			</select><br>
		<label class="proplabel">Publication Date</label>
			<input id="publication_date" name="publication_date" type="text" value="<?php echo htmlentities($_GET['publication_date']);?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/><br>
		<label class="proplabel">Batch ID</label>
			<input name="batch_id" type="text" value="<?php echo htmlentities($_GET['batch_id']);?>" pattern="[a-zA-Z0-9]{3}[_][0-9]{8}[_][sS|Rr][_][0-9]{2}" required/><br>
		</fieldset>
	</div><!-- end of main details -->
	<br>
	<div id="address"> 
		<fieldset>
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
			<label class="proplabel">Page No.</label>
				<input name="page_no"class="small" type="text" value="<?php echo htmlentities($_GET['page_no']);?>" required/><br><br>
			<label class="proplabel">Unit No.</label>
				<input class="small" name="unit_no" type="text" value="<?php echo htmlentities($_GET['unit_no']);?>"/><br>
			<label class="proplabel">Street No.</label>
				<input class="small" name="street_no" type="text" value="<?php echo htmlentities($_GET['street_no']);?>" required/> 
			<label>Suffix</label>
				<input class="small" name="street_no_suffix" type="text" value="<?php echo htmlentities($_GET['street_no_suffix']);?>"/><br>
			<label class="proplabel">Street Name</label>
				<input class="medium" name="street_name" type="text" value="<?php echo htmlentities($_GET['street_name']);?>" required/>
			<label>Extension</label>
				<select name="street_extension"><?php echo keypairs($street_extension_lkp,$_GET['street_extension'],true,""); ?></select>
				<select name="street_direction"><?php echo keypairs($street_direction_lkp,$_GET['street_direction'],true,""); ?></select><br>
			<label class="proplabel">Suburb</label>
				<input class="medium" name="suburb" type="text" value="<?php echo htmlentities($_GET['suburb']);?>" required/><br>
			<label class="proplabel">City</label>
				<input class="medium" name="city" type="text" value="<?php echo htmlentities($_GET['city']);?>"/><br>
			<label class="proplabel">Sale / Rent</label>	
				<select name="sale_rent">
					<?php if(substr($_GET['batch_id'],13,1) == 'S'){echo "<option value='SALE'>SALE</option>";} else {echo "<option value='RENT'>RENT</option>";} ?>
				</select>
		</fieldset>
	</div><!-- end of address -->
	<div id="listingdetails">
		<fieldset>
			<label class="proplabel">Property Type</label>
				<select name="property_type">
					<?php
						if(substr($_GET['property_type'],0,2) == "HO"){
							keypairs($house_lkp,$_GET['property_type'],false,"HO");
						}elseif(substr($_GET['property_type'],0,2) == "CO"){
							keypairs($commercial_lkp,$_GET['property_type'],false,"CO");
						}elseif(substr($_GET['property_type'],0,2) == "UN"){
							keypairs($unit_lkp,$_GET['property_type'],false,"UN");
						}elseif(substr($_GET['property_type'],0,2) == "FA"){
							keypairs($farm_lkp,$_GET['property_type'],false,"UN");
						}elseif(substr($_GET['property_type'],0,2) == "LA"){
							keypairs($land_lkp,$_GET['property_type'],false,"LA");
						}elseif(substr($_GET['property_type'],0,2) == "RV"){
							keypairs($retirement_village_lkp,$_GET['property_type'],false,"RV");
						}
					?>
				</select><br>
			<label class="proplabel">Listing Type</label>
				<select name="listing_type" autofocus>
				<?php
					if(substr($_GET['batch_id'],13,1) == 'S'){ 
						echo keypairs($listing_type_lkp,$details['Listing_Type'],false,"S");
					} else { 
						echo "<option value='R'>RENT</option>";
					}
				?>
				</select>
			<?php if(substr($_GET['batch_id'],13,1) == 'S'){ ?>
			<input class="rightside" id="auction_date" name="auction_date" type="text" placeholder="dd/mm/yyyy" value="<?php if($details['Auction_Date']){echo htmlentities(date('d/m/Y',strtotime($details['Auction_Date'])));}?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$"/>
				<label class="rightside">Auction/Tender Date</label><br>
			<?php } else { echo "<br>";}?>
			<label class="proplabel">Price From</label>
				<input name="price_from"type="text" class="price" value="<?php echo htmlentities($details['Price_From']);?>" pattern="[0-9]{1,10}"/>
			<?php if(substr($_GET['batch_id'],13,1) == 'S'){ ?>
			<input class="rightside" name="auction_time" type="text" placeholder="HH:MM AM/PM" value="<?php echo htmlentities($details['Auction_Time']);?>" pattern="^[0-1][0-9]:[0-5][0-9] [APap][mM]$"/>
				<label class="rightside">Auction/Tender Time</label><br>
			<?php } else { echo "<br>";}?>	
			<label class="proplabel">Price To</label>
				<input name="price_to" type="text" class="price" value="<?php echo htmlentities($details['Price_To']);?>" pattern="[0-9]{1,10}"/>
			<?php if(substr($_GET['batch_id'],13,1) == 'S'){ ?>	
			<input name="auction_location" class="rightside" type="text" value="<?php echo htmlentities($details['Auction_Location']);?>" pattern=".{3,}"/>
				<label class="rightside">Auction Venue</label><br>
			<?php } else { echo "<br>";}?>			
			<label class="proplabel">Price Description</label>
				<input name="price_description" type="text" style="width: 400px;" value="<?php echo htmlentities($details['Price_Description']);?>" pattern=".{3,}"/><br>
			<?php if(substr($_GET['batch_id'],13,1) == 'R'){ ?>
			<label class="proplabel">Rental</label>
				<select name="rental_period"><?php echo keypairs($rental_period_lkp,$details['Rental_Period'],false,"W"); ?></select>
			<?php } ?>
		</fieldset>
	</div> <!-- end of listing details -->
	<?php
		if(substr($_GET['property_type'],0,2) == "HO"){
			include("house.php");
		}elseif(substr($_GET['property_type'],0,2) == "CO"){
			include("commercial.php");
		}elseif(substr($_GET['property_type'],0,2) == "UN"){
			include("unit.php");
		}elseif(substr($_GET['property_type'],0,2) == "FA"){
			include("farm.php");
		}elseif(substr($_GET['property_type'],0,2) == "LA"){
			include("land.php");
		}elseif(substr($_GET['property_type'],0,2) == "RV"){
			include("retirement.php");
		}
	?>
	<div id="additional">
		<fieldset>
			<div>
				<label>Addtional Property Details</label><br>
				<textarea name="additional_property"><?php echo htmlentities($details['Additional_Property']);?></textarea>
			</div>
		</fieldset>
	</div>
	<div id="ad_details">
		<fieldset>
			<div class="addetails">
				<label>Ad Size</label><br>
				<select id="ad_size" name="ad_size"><?php echo keypairs($ad_size_lkp,$details['Ad_Size'],false,"SMALL"); ?></select>
			</div>
			<div class="addetails" style="width: 110px;">
				<label>Photo Type</label><br>
				<select id="ad_photo_type" name="ad_photo_type"><?php echo keypairs($photo_type_lkp,$details['Ad_Photo_Type'],false,"COLOUR"); ?></select>
			</div>
			<div class="addetails" style="width: 150px;">
				<label>Photo Count</label><br>
				<select id="ad_photo_count" name="ad_photo_count"><?php echo keypairs($photo_count_lkp,$details['Ad_Photo_Count'],false,"SINGLE"); ?></select>
			</div>
			<div class="addetails" style="width: 125px;">
				<label>Section</label><br>
				<select id="ad_section" name="ad_section"><?php echo keypairs($section_lkp,$details['Ad_Section'],false,"MIDDLE"); ?></select>
			</div>
			<div class="addetails">
				<label>Exclusive Agent</label><br>
				<select id="ad_section" name="ad_exclusive"><?php echo keypairs($exclusive_agent_lkp,$details['Ad_Exclusive'],false,"UNKNOWN"); ?></select>
			</div>
		</fieldset>
	</div>
	<div id="agentdetails">		
		<fieldset>
			<div class="agent">
				<table id="agenttable"> 
					<tr>
						<th></th>
						<th>Contact</th>
						<th>Agency Name</th>
						<th>Firstname</th>
						<th>Lastname</th>
					</tr>
					<?php foreach($agents as $agent){ ?>
					<tr>
						<td><input name="agent_id[]" type="hidden" value="<?php echo $agent['id'];?>" style="width: 130px;"></td>
						<td><input class="contact" name="agent_contact[]" type="text" value="<?php echo $agent['Agent_Contact'];?>" style="width: 130px;" pattern=".{6,}"></td>
						<td><input class="agency" name="agency_name[]" type="text" value="<?php echo $agent['Agency_Name'];?>" style="width: 250px;" pattern=".{3,}"></td>
						<td><input class="firstname" name="agent_firstname[]" type="text" value="<?php echo $agent['Agent_Firstname'];?>" style="width: 130px;" pattern=".{2,}"></td>
						<td><input class="lastname" name="agent_surname[]" type="text" value="<?php echo $agent['Agent_Surname'];?>" style="width: 130px;" pattern=".{2,}"></td>
					</tr>
					<?php } ?>
					<?php for($i=count($agents); $i<=4; $i++){?>
					<tr>
						<td><input name="agent_id[]" type="hidden" value="" style="width: 130px;"></td>
						<td><input class="contact" name="agent_contact[]" type="text" value="" style="width: 130px;" pattern=".{6,}"></td>
						<td><input class="agency" name="agency_name[]" type="text" value="" style="width: 250px;" pattern=".{3,}"></td>
						<td><input class="firstname" name="agent_firstname[]" type="text" value="" style="width: 130px;" pattern=".{2,}"></td>
						<td><input class="lastname" name="agent_surname[]" type="text" value="" style="width: 130px;" pattern=".{2,}"></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</fieldset>
	</div>
	<div id="buttons">
		<input type="submit" value="Submit" />
	</div>
	</form>
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>