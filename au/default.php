<?php 
	require_once("../_includes/initialize.php");
	$session->log_end();
	$publication_lookup = Publication::publication_lookup('AU');
	
	if(!$session->is_logged_in()){
		redirect_to("../logout.php"); //if not redirect to login page
	} else {
		$session->logout_newspaper();
	}
	
	if(isset($_POST['submit'])){
		$download = Download::authenticate($_POST['state'],$_POST['publication_name'],$_POST['publication_date'],$_POST['batch_id']);
		if($download){
			$pubdate = DateTime::CreateFromFormat('d/m/Y',$_POST['publication_date']);
			$job_number  = JobNumber::find_job_number($download['job_number'],substr($_POST['batch_id'],13,1),$pubdate->format('MY'));
			if ($job_number){
				$session->log_newspaper($_POST['state'],$_POST['publication_name'],$_POST['publication_date'],$_POST['batch_id'],$job_number['job_number']);
				redirect_to("view.php");
			} else {
				$session->set_message("Job Number Not Found.Contact Administrator.");
			}	
		} else {
			$session->set_message("No results found : ".$_POST['state']." ".$_POST['publication_name']." ".$_POST['publication_date']);
			redirect_to("default.php?state={$_POST['state']}&pubname={$_POST['publication_name']}&pubdate={$_POST['publication_date']}&batch_id={$_POST['batch_id']}&attemp=1");
		}
	}
?>
<?php layout_template('header.php'); ?>
<!-- script and css style goes here -->
<style>
	label{
		width: 135px;
		display: inline-block;
	}
	.pix{
		position: fixed;
		border-radius: 50px 50px 50px 50px;
		top: 150px;
		right: 10px;
		border: 1px solid lightgray;
	}
</style>
<script>
$(document).ready(function() {
	$.getJSON("getPublication.php",{q: $("select[name='state']").val(), ajax: 'true'}, function(j){
		console.log(j);
		var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].pub_name + '">' + j[i].pub_display + '</option>';
			}
			$("select[name='publication_name']").html(options);
	});
	
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
	$('#pubdetails').submit(function(){
		var batch_id = $('#batch_id').val().substr(4,8);
		var strdate = $('#publication_date').val().split("/");
		var strpubdate = strdate[2] + strdate[1] + strdate[0];
		if (batch_id == strpubdate){
			return true;
		} else {
			alert("Batch Id and Publication Date does not match!!");
			return false;
		}
	});
	
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
<div id="content">
	<h2>Enter Publication Details</h2>
	<form id="pubdetails" name="pubdetails" id="pubdetails" action="default.php" method="post">
		<fieldset>
			<?php echo message($message); ?>
			<label>Batch ID</label>
			<input id="batch_id" name="batch_id" type="text" value="<?php echo !empty($_GET['batch_id']) ? $_GET['batch_id'] : '';?>" pattern="[a-zA-Z0-9]{3}[_][0-9]{8}[_][sS|Rr][_][0-9]{2}" autofocus required/><br>
			<label>State</label>
			<select name="state">
				<?php echo keypairs($state_lkp_au,"",false,"NSW"); ?>
			</select><br>
			<label>Publication Name</label>
			<select name="publication_name" required>
			</select><br>
			<label>Publication Date</label>
			<input id="publication_date" name="publication_date" type="text" value="<?php echo !empty($_GET['pubdate']) ? $_GET['pubdate'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/><br><br>
			<input name="submit" type="submit" value="Submit" />
		</fieldset>
	</form>
</div>
<div>
	<img class="pix" src="<?php echo "../_userimages/".$session->operator_id.".jpg" ?>" />
</div>
<?php layout_template('footer.php'); ?>