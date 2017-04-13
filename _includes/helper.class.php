<?php
//initialization
function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name){
	$class_name = strtolower($class_name);
	$path = INCLUDES_FOLDER.DS."{$class_name}.php";

	if(file_exists($path)){
		require_once($path);
	} else {
		die("The file {$class_name}.php could not be found.");
	}
}

function keypairs(array $type,$match, $blank, $default){
	if ($blank){
			echo "<option value=''>--</option>";
	}
	foreach($type as $key => $value){
		echo '<option value="'.$key.'" ';
			if ($match == ""){
				if($key == $default){echo "selected";}
				echo " >".htmlentities($value)."</option>";
			} else {
				if($key == $match){echo "selected";}
				echo " >".htmlentities($value)."</option>";
			}	
		}
}

function layout_template($template){
	include(SITE_ROOT.DS."_layout".DS."{$template}");
}
function links($link){
	echo "http://".DB_IPADDRESS."/".APP."/admin/".$link;
}
function logout(){
	echo "http://".DB_IPADDRESS."/odesv2.0/logout.php?session=expired";
}
function logout_user(){
	echo "http://".DB_IPADDRESS."/odesv2.0/logout.php?logout=true";
}
function find_pubname($pubname){
	if ($pubname == "AGENT BOOKLET - BARRY PLANT REAL ESTATE - EMAIL"){
		$output_pub = "AGENT BOOKLET - BARRY PLANT REAL ESTATE";
	} else if ($pubname == "AGENT BOOKLET - BARRY PLANT (MONTHLY)"){
		$output_pub = "AGENT BOOKLET - BARRY PLANT";
	} else if ($pubname == "INNER WEST COURIER - INNER WEST"){
		$output_pub = "INNER WEST COURIER";
	} else if ($pubname == "INNER WEST COURIER - INNER CITY"){
		$output_pub = "INNER WEST COURIER";
	} else if ($pubname == "REALESTATEWORLD.COM.AU - ILLAWARRA"){
		$output_pub = "REALESTATEWORLD.COM.AU";
	} else if ($pubname == "REALESTATEWORLD.COM.AU - NAMBUCCA"){
		$output_pub = "REALESTATEWORLD.COM.AU";
	} else if ($pubname == "REALESTATEWORLD.COM.AU - NORTHERN RIVERS"){
		$output_pub = "REALESTATEWORLD.COM.AU";
	} else if ($pubname == "GUM TREE - SR"){
		$output_pub = "GUMTREE.COM.AU";
	} else if ($pubname == "GUM TREE - LAND"){
		$output_pub = "GUMTREE.COM.AU";
	} else {
		$output_pub = $pubname;
	}
	return $output_pub;
}

?>