<?php 
	require_once("../_includes/initialize.php");
	
	if(!$session->is_logged_in()){
		redirect_to("../logout.php"); //if not redirect to login page
	} else {
		if($session->access_level < 3){
		$session->set_message("You are not authorized to access the page!!");
		redirect_to("../logout.php"); //if not redirect to login page
		}
	}
	
	if(!empty($_GET['state'])){
		$properties = Australia::auqc($_GET['batch_id'],$_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
		$invalid_properties = Invalid::invalidqc($_GET['batch_id'],$_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
	} else {
		$properties = Australia::auqc('','','','00/00/0000');
		$invalid_properties = Invalid::invalidqc('','','','00/00/0000');
	}
?>
<?php layout_template('header.php'); ?>
<!-- script and css style goes here -->
<style>
	#header{
		height: 25px;
	}
	.login{
		top: 5px;
	}
	thead{
		background: #0489B1;
		color: white;
	}
	.gitna{
		text-align: center;
	}
	tbody>tr:hover{
		background: lightgreen;
	}
	tr>td{
		border-bottom: 1px solid green;
		padding: 0px;
		font-size: 14px;
	}
	fieldset{
		border: 1px solid green;
	}
</style>
<script>
$(document).ready(function() {
	var $_GET = <?php echo json_encode($_GET); ?>;
	$.getJSON("getPublication.php",{q: $("select[name='state']").val(), ajax: 'true'}, function(j){
		console.log(j);
		var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].pub_name + '" ';
				if (j[i].pub_name == $_GET["publication_name"]){
					options += 'selected';
				}
				options += '>' + j[i].pub_display + '</option>';
			}
			$("select[name='publication_name']").html(options);
	});
	$("select[name='state']").change(function(){
		$.getJSON("getPublication.php",{q: $(this).val(), ajax: 'true'}, function(j){
		console.log(j);
		var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].pub_name + '" ';
				options += '>' + j[i].pub_display + '</option>';
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
		<span class="entryheader">CCC Data Management Services Inc.</span>
		<span class="login"><?php echo $session->operator_id." : ".$session->name; ?>
		<a href="../logout.php">Logout</a></span><br>
</div><!-- end of header -->
<div id="content">
	<h2>Quality Control Page</h2>
	<form action="default.php" method="get">
		<fieldset>
			<label>State</label>
			<select name="state">
				<?php echo keypairs($state_lkp_au,$_GET['state'],false,"NSW"); ?>
			</select>
			<label>Publication Name</label>
				<select name="publication_name" required>
			</select>
			<label>Publication Date</label>
			<input id="publication_date" style="width: 80px; text-align: center;"name="publication_date" type="text" value="<?php echo !empty($_GET['publication_date']) ? $_GET['publication_date'] : '';?>" pattern="^(((0[1-9]|[12]\d|3[01])/(0[13578]|1[02])/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)/(0[13456789]|1[012])/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])/02/((19|[2-9]\d)\d{2}))|(29/02/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$" required/><br><br>	
			<label>Batch ID</label>
				<input name="batch_id" type="text" value="<?php echo !empty($_GET['batch_id']) ? $_GET['batch_id'] : '';?>" />
			<input name="submit" type="submit" value="Filter" />
		</fieldset>
	</form>
	<?php echo message($session->message);?>
	
	<?php if($properties){ ?>
		<h3>Valid Listings</h3>
		<table>
		<thead>
			<tr>
				<th style="text-align: left;">ID</th>
				<th>Page</th>
				<th>Address</th>
				<th>S / R</th>
				<th>Entry</th>
				<th>Verify</th>
				<th colspan=2>Command</th>
				<th>Batch Id</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($properties as $property){ ?>
			<tr>
				<td style="width: 50px;"><?php echo $property['id'];?></td>
				<td><?php echo $property['page_no']; ?></td>
				<td style="width: 480px;"><?php echo $property['unit_no'];if (!empty($property['unit_no'])){echo "/";} echo $property['street_no']." ".htmlentities($property['street_name'])." ".$property['street_extension']." ".$property['street_direction']." ".htmlentities($property['suburb'])." ".$property['city'].", ".$property['postcode']; ?></td>
				<td class="gitna"><?php echo $property['sale_rent']; ?></td>
				<td class="gitna"><?php echo $property['entry_id']; ?></td>
				<td class="gitna"><?php echo $property['verify_id']; ?></td>
				<td class="gitna"><?php echo "<a href='modify.php?id=".$property['id']."'><button>Modify</button></a>" ?></td>
				<td class="gitna"><?php echo "<a onclick=\"return confirm('Are you sure want to delete this record?')\" href='process.php?action=delete&id=".$property['id']."&state=".$_GET['state']."&publication_name=".urlencode($_GET['publication_name'])."&publication_date=".$_GET['publication_date']."'><button>Delete</button></a>" ?></td>
				<td class="gitna"><?php echo $property['batch_id']; ?></td>
			</tr>
			<?php }?>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
	<?php } else { echo "<h3>No Valid Listings</h3>";}?>
	
	
	<?php if($invalid_properties){ ?>
		<h3>No Invalid Address Listings</h3>
		<table>
		<thead>
			<tr>
				<th style="text-align: left;">ID</th>
				<th>Page</th>
				<th>Address</th>
				<th>S / R</th>
				<th>Entry</th>
				<th>Verify</th>
				<th colspan=2>Command</th>
				<th>Batch Id</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($invalid_properties as $property){ ?>
			<tr>
				<td style="width: 50px;"><?php echo $property['id'];?></td>
				<td><?php echo $property['page_no']; ?></td>
				<td style="width: 480px;"><?php echo $property['unit_no'];if (!empty($property['unit_no'])){echo "/";} echo $property['street_no']." ".$property['street_name']." ".$property['street_extension']." ".$property['street_direction']." ".$property['suburb']." ".$property['property_state']; ?></td>
				<td class="gitna"><?php echo $property['sale_rent']; ?></td>
				<td class="gitna"><?php echo $property['entry_id']; ?></td>
				<td class="gitna"><?php echo $property['comment']; ?></td>
				<td class="gitna"><?php echo "<a href='invalid.php?id=".$property['id']."'><button>Modify</button></a>" ?></td>
				<td class="gitna"><?php echo "<a onclick=\"return confirm('Are you sure want to delete this record?')\" href='process_invalid.php?action=delete&id=".$property['id']."&state=".$_GET['state']."&publication_name=".urlencode($_GET['publication_name'])."&publication_date=".$_GET['publication_date']."'><button>Delete</button></a>" ?></td>
				<td class="gitna"><?php echo $property['batch_id']; ?></td>
				
			</tr>
			<?php }?>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
	<?php } else { echo "<h3>No Invalid Address Listings</h3>";}?>
	
	
</div> <!-- end of content -->
<?php layout_template('footer.php'); ?>