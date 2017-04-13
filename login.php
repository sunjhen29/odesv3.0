<?php 
	require_once("_includes/initialize.php");
	
	if($session->is_logged_in() && $session->access_level < 3){
		redirect_to($session->application);		
	}
	$application = "";
	
	if(isset($_POST['submit'])){
		$found = User::authenticate($_POST['username'],$_POST['password']);
		if($found){
			if ($found['access_level'] == 0){
				$message = "Operator Inactive Status!!";
				redirect_to("login.php?account=inactive");
			}
			$application = $_POST['application']."/";
			$operator_id = $found['operator_id'];
			$name = $found['lastname'].", ".$found['firstname'];
			$access_level = $found['access_level'];
			$session->login($operator_id,$application,$name,$access_level);
			Active::log($operator_id,$_POST['application'],'login');
			redirect_to($application);
		} else {
			$message = "Invalid Username or Password!!";
		}
	}
?>
<html>
<head>
	<title>Offline Data Entry System v2.0</title>
	<meta http-equiv="refresh" content="600;url=logout.php" />
	<link rel="SHORTCUT ICON" href="_images/logo.ico">
	<link href="_css/reset.css" media="all" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="_scripts/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" HREF="_css/reset.css" />
<link rel="stylesheet" type="text/css" HREF="_css/login.css" />
<?php layout_template('loginheader.php'); ?>
<div id="content">
	<form name="login" id="login" method="post" action="login.php">
		<h2>Staff Login</h2>
		<fieldset>
			<label>Username</label><input name="username" type="text" value="" required autofocus autocomplete='off'/><br>
			<label>Password</label><input name="password" type="password" value="" required autocomplete='off'/><br>
			<label>Application<label>
			<select name="application">
				<option value="au">AUSTRALIAN NEWSPAPER</option>
				<option value="nz">NEW ZEALAND NEWSPAPER</option>
				<option value="admin">ADMIN PAGE</option>
				<option value="qcnz">QC NZ NEWSPAPER</option>
				<option value="qcau">QC AU NEWSPAPER</option>
				<option value="kpi">KPI</option>
			</select><br>
			<?php echo message($message); ?>
			<span class="message">
				<?php 
					if(isset($_GET['access']) && $_GET['access']=='failed'){
						echo message("Unathorized Access!!"); 
					} else if (isset($_GET['logout']) && $_GET['logout']=='true'){
						echo message("You have logout!!"); 
					}else if (isset($_GET['session']) && $_GET['session']=='expire'){
						echo message("Your session expire!!");
					}
				?>
			</span>
			<br>
			<input name="submit" type="submit" value="Submit" />
			<input name="cancel" type="submit" value="Cancel" />
		</fieldset>
	</form>
</div>
<?php layout_template('footer.php'); ?>