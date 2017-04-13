<?php	
	require_once("_includes/initialize.php");
	$_SESSION = array();
	
	//Active::log($session->operator_id,$session->application,'logout');
	
	//clears the cookie by setting cookie expiration a date in the past
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-14200,'/');
	}
	
	$session->logout();
	if (isset($_GET['logout']) && $_GET['logout']=='true'){
		redirect_to("login.php?logout=true");
	} else if(isset($_GET['session']) && $_GET['session']=='expired'){
		redirect_to("login.php?session=expire");	
	} else {
		redirect_to("login.php?access=failed");
	}
?>