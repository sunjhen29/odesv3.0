<?php 
	require_once("../../_includes/initialize.php");
	include("../_layout/checklogin.php");
	$publication_lookup = Publication::publication_lookup();
?>
<?php include("../_layout/adminheader1.php"); ?>
<script>
$(document).ready(function() {
	AustralianDate_Input_Format("#publication_date");
	//onload
	$.getJSON("getPublication.php",{q: $("select[name='state']").val(), ajax: 'true'}, function(j){
		console.log(j);
		var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].pub_name + '">' + j[i].pub_display + '</option>';
			}
			$("select[name='publication_name']").html(options);
			
			$.getJSON("getcode.php",{q: j[0].pub_name, ajax: 'true'}, function(z){
				console.log(z);
				$("input[name='pubcode']").val(z.code);
				$("input[name='jobnumber']").val(z.job_number);
			});	
	});
	//on change
	$("select[name='state']").change(function(){
		$.getJSON("getPublication.php",{q: $(this).val(), ajax: 'true'}, function(j){
		console.log(j);
		var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].pub_name + '">' + j[i].pub_display + '</option>';
			}
			$("select[name='publication_name']").html(options);
		});
	});
	
	$("select[name='publication_name']").change(function(e){
		var requestURL = 'getcode.php?q='+encodeURIComponent($(this).val());
		$.getJSON(requestURL,function(data){
			console.log(data);
			$("input[name='pubcode']").val(data.code);
			$("input[name='jobnumber']").val(data.job_number);
		});
	}).blur(function(e){
		var requestURL = 'getcode.php?q='+encodeURIComponent($(this).val());
		$.getJSON(requestURL,function(data){
			console.log(data);
			$("input[name='pubcode']").val(data.code);
			$("input[name='jobnumber']").val(data.job_number);
		});
	});
});
</script>
<?php include("../_layout/adminheader2.php"); ?>
<div id="content">
	<div>
		<h2>Add Download</h2>
		<span class="message"><?php echo message($session->message);?></span>
	</div>
	<div id="display">
		<form action="process.php?action=save" method="POST">
			<fieldset>
				<label>State</label>
					<select name="state" autofocus>
						<?php echo keypairs($state_lkp,"",false,""); ?>
						<?php echo keypairs($state_lkp_au,"",false,""); ?>
					</select><br>
				<label>Publication Name</label>
					<select name="publication_name" required>
					</select><br>
				<label>Publication Code</label>
					<input type="text" class="small" name="pubcode" value="" pattern="[a-zA-Z0-2]{3}" required readonly />
				<label style="width:90px;">Application</label>
					<input class="small" name="jobnumber" type="text" value="" required readonly /><br>
				<label>Publication Date</label>
					<input id="publication_date" class="medium" name="publication_date" type="text" value="" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/><br>
				<label>Pages</label>
					<input class="verylong" name="pages" type="text" value="" required/><br>
				<label>Remarks</label>
					<input type="text" name="remarks" list="remarks" />
						<datalist id="remarks">
							<option value="TIER 1">
							<option value="PRIORITY">
							<option value="NO RE">
							<option value="HARD COPY">
							<option value="NO VALID RECORD">
						</datalist><br>
				<label>Status</label>
					<select name="status">
						<option value="OPEN">OPEN</option>
						<option value="CLOSED">CLOSED</option>
						<option value="PENDING">PENDING</option>
					</select><br>
				<input name="add" type="submit" value="Add Download" />
				<a href="default.php?status=&state=&pubname=&pubdate" tabindex="-1"><input type="button" class="cancel" name="cancel" value="Cancel" /></a>
			</fieldset>
		</form>
	</div>
</div>
<?php include("../_layout/adminfooter.php"); ?>