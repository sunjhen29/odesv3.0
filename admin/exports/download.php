<?php
require_once("../../_includes/initialize.php"); 
$exports = Invalid::export_records($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("CCC Data Management Services Inc.")
							 ->setLastModifiedBy("CCC Data Management Services Inc.")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

//set default style of a workbook
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(11); 
// Add Header
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'STATE')
            ->setCellValue('B1', 'PUBLICATION NAME')
            ->setCellValue('C1', 'PUBLICATION DATE')
            ->setCellValue('D1', 'UNIT #')
			->setCellValue('E1', 'STREET #')
            ->setCellValue('F1', 'STREET # SUFFIX')
            ->setCellValue('G1', 'STREET NAME')
            ->setCellValue('H1', 'STREET EXT.')
			->setCellValue('I1', 'SUBURB')
            ->setCellValue('J1', 'MULTIPLE PROPERTIES')
            ->setCellValue('K1', 'PROPERTY TYPE')
            ->setCellValue('L1', 'SALE TYPE')
			->setCellValue('M1', 'PRICE FROM')
            ->setCellValue('N1', 'PRICE TO')
            ->setCellValue('O1', 'AUCTION/TENDER DATE')
            ->setCellValue('P1', 'AUCTION/TENDER TIME')
			->setCellValue('Q1', 'AUCTION LOCATION')
			->setCellValue('R1', 'PRICE DESCRIPTION')
            ->setCellValue('S1', 'BEDROOMS')
            ->setCellValue('T1', 'BATHROOMS')
            ->setCellValue('U1', 'CAR SPACES')
			->setCellValue('V1', 'SWIMMING POOL')
            ->setCellValue('W1', 'AIR CONDITIONING')
            ->setCellValue('X1', 'CLOSE TO PUBLIC TRANSPORT')
            ->setCellValue('Y1', 'AD SIZE')
			->setCellValue('Z1', 'PHOTO FEATURES')
            ->setCellValue('AA1', 'PHOTO COUNT')
			->setCellValue('AB1', 'SECTION')
            ->setCellValue('AC1', 'EXCLUSIVE AGENCY')
            ->setCellValue('AD1', 'AGENCY NAME')
            ->setCellValue('AE1', 'AGENT FIRST NAME')
			->setCellValue('AF1', 'AGENT SURNAME')
			->setCellValue('AG1', 'AGENT CONTACT PHONE');
//change header fill color to black
$objPHPExcel->getActiveSheet()->getStyle('A1:AG1')->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()->setARGB('00000000');
//change header font color to white
$objPHPExcel->getActiveSheet()->getStyle('A1:AG1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
//change header style to bold
$objPHPExcel->getActiveSheet()->getStyle('A1:AG1')->getFont()->setBold(true);
//change header alignment to center
$objPHPExcel->getActiveSheet()->getStyle('A1:AG1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$columns = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG');

//display data
$row = 1;
$col = 0;
foreach ($exports as $export){
	$row++;
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$row , $export['property_state']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$row , $export['publication_name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$row , $export['publication_date']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$row , $export['unit_no']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$row , $export['street_no']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$row , $export['street_no_suffix']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,$row , $export['street_name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,$row , $export['street_extension']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,$row , $export['suburb']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,$row , $export['multiple']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,$row , $export['property_type']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11,$row , $export['listing_type']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12,$row , $export['price_from']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13,$row , $export['price_to']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14,$row , $export['auction_date']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15,$row , $export['auction_time']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16,$row , $export['auction_location']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17,$row , $export['price_description']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18,$row , $export['bedrooms']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19,$row , $export['bathrooms']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20,$row , $export['car_spaces']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21,$row , $export['air_conditioned']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22,$row , $export['close_to_public']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23,$row , $export['swimming_pool']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24,$row , $export['ad_size']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25,$row , $export['ad_photo_type']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26,$row , $export['ad_photo_count']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27,$row , $export['ad_section']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28,$row , $export['ad_exclusive']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29,$row , $export['agency_name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(30,$row , $export['firstname']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(31,$row , $export['lastname']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(32,$row , $export['contact']);
}
//format number
$objPHPExcel->getActiveSheet()->getStyle('M2:M'.$row)->getNumberFormat()->setFormatCode('#,##0');
$objPHPExcel->getActiveSheet()->getStyle('N2:N'.$row)->getNumberFormat()->setFormatCode('#,##0');
//autofit column
foreach($columns as $column){ $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$_GET['publication_name'].'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit; 
?>