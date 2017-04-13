<?php require_once("../../_includes/initialize.php");
	$filename = "CCC_".date('Ymd')."_".date('His').".txt";
	header("Content-type: application/octet-stream");//A MIME attachment with the content type "application/octet-stream" is a binary file.
	header("Content-Disposition: attachment; filename={$filename}");//with this extension of file name you tell what kind of file it is.
	header("Pragma: no-cache");//Prevent Caching
	header("Expires: 0");//Expires and 0 mean that the browser will not cache the page on your hard drive
	$sequence = $_GET['start'] - 1;
	
	$file = "excel.txt";
	$fh = fopen('excel.txt', 'w');
	
	$exports = Invalid::export_records($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
	$column = 33;

	$record_id = 0;
	
	fwrite($fh,"State\tPublication Name\tPublication_Date\tUnit #\tStreet #\tStreet # Suffix\tStreet Name\tStreet Ext.\tSuburb\tMultiple Properties\t");
	fwrite($fh,"Property Type\tSale Type\tPrice From\tPrice To\tAuction/Tender Date\tAuction/Tender Time\tAuction Location\tPrice Description\tBedrooms\tBathrooms\t");
	fwrite($fh,"Car Spaces\tSwimming Pool\tAir Conditioning\tClose to public transport\tAd Size\tPhoto Features\tPhoto Count\tSection\tExclusive Agency\tAgency Name\t");
	fwrite($fh,"Agent First Name\tAgent Surname\tAgent Contact Phone\t\r\n");
	
	foreach($exports as $nz){
		$record_id = $nz['sequence'];
		$sequence++;
		fwrite($fh,$nz['property_state']."\t".$nz['publication_name']."\t".$nz['publication_date']."\t".$nz['unit_no']."\t".$nz['street_no']."\t".$nz['street_no_suffix']."\t".$nz['street_name']."\t".$nz['street_extension']."\t");
		fwrite($fh,$nz['suburb']."\t".$nz['multiple']."\t".$nz['property_type']."\t".$nz['listing_type']."\t".$nz['price_from']."\t".$nz['price_to']."\t".$nz['auction_date']."\t".$nz['auction_time']."\t");
		fwrite($fh,$nz['auction_location']."\t".$nz['price_description']."\t");
		fwrite($fh,"'".$nz['bedrooms']."\t"."'".$nz['bathrooms']."\t"."'".$nz['car_spaces']."\t");
		fwrite($fh,$nz['air_conditioned']."\t".$nz['close_to_public']."\t".$nz['swimming_pool']."\t");
		fwrite($fh,$nz['ad_size']."\t".$nz['ad_photo_type']."\t".$nz['ad_photo_count']."\t".$nz['ad_section']."\t".$nz['ad_exclusive']."\t");
		fwrite($fh,$nz['agency_name']."\t".$nz['firstname']."\t".$nz['lastname']."\t".$nz['contact']."\t\r\n");
	}
	fclose($fh);
	if ($handle = fopen($file,'r')){
		$content = fread($handle, 10000000);
		fclose($handle);
	}
	//if ($error == false){
		echo $content; 
	//} 
?>
