<?php
require_once("../../_includes/initialize.php");
$cbhs = Cbhs::find_by_batch($_GET['id']);

header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');

$xmlDoc = new DOMDocument();
$root = $xmlDoc->appendChild($xmlDoc->createElement("membershipApplication"));

	foreach($cbhs as $row){
		$membershipdetails = $root->appendChild($xmlDoc->createElement('membershipDetails'));
		$membershipdetails->appendChild($xmlDoc->createAttribute("membershipId"))->appendChild($xmlDoc->createTextNode($row['membershipId']));

		$claimdetails = $membershipdetails->appendChild($xmlDoc->createElement('claimDetails'));
		$claimdetails->appendChild($xmlDoc->createAttribute("identifier"))->appendChild($xmlDoc->createTextNode($row['identifier']));
		$claimdetails->appendChild($xmlDoc->createAttribute("exportfilename"))->appendChild($xmlDoc->createTextNode($row['exportfilename']));
		$claimdetails->appendChild($xmlDoc->createAttribute("claimstatus"))->appendChild($xmlDoc->createTextNode($row['claimstatus']));
		$claimdetails->appendChild($xmlDoc->createAttribute("pagecount"))->appendChild($xmlDoc->createTextNode($row['pagecount']));

		$claimlines = $claimdetails->appendChild($xmlDoc->createElement('claimlines'));
		$claimlines->appendChild($xmlDoc->createAttribute("patientName"))->appendChild($xmlDoc->createTextNode($row['patientName']));
		$claimlines->appendChild($xmlDoc->createAttribute("dateofbirth"))->appendChild($xmlDoc->createTextNode($row['dateofbirth']));
		$claimlines->appendChild($xmlDoc->createAttribute("providerNumber"))->appendChild($xmlDoc->createTextNode($row['providerNumber']));
		$claimlines->appendChild($xmlDoc->createAttribute("serviceType"))->appendChild($xmlDoc->createTextNode($row['serviceType']));
		$claimlines->appendChild($xmlDoc->createAttribute("dateofbirth"))->appendChild($xmlDoc->createTextNode($row['dateofbirth']));
		$claimlines->appendChild($xmlDoc->createAttribute("itemNumber"))->appendChild($xmlDoc->createTextNode($row['itemNumber']));
		$claimlines->appendChild($xmlDoc->createAttribute("dateofservice"))->appendChild($xmlDoc->createTextNode($row['dateofservice']));
		$claimlines->appendChild($xmlDoc->createAttribute("fee"))->appendChild($xmlDoc->createTextNode($row['fee']));
		$claimlines->appendChild($xmlDoc->createAttribute("accountPaid"))->appendChild($xmlDoc->createTextNode($row['accountPaid']));
	}
$xmlDoc->formatOutput = true;
echo $xmlDoc->saveXML();
?>
