<?php
require_once("../../_includes/initialize.php"); 
$exports_nz_property = NewZealand::backup($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
$nz_columns = NewZealand::get_columns($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);

$exports_nz_agent = Agent::backup($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
$agent_columns = Agent::get_columns($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);

$exports_au_property = Australia::backup($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
$au_columns = Australia::get_columns($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);

$exports_au_agent = Agent_Australia::backup($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
$agent_au_columns = Agent_Australia::get_columns($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);

$exports_invalid = Invalid::backup($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);
$invalid_columns = Invalid::get_columns($_GET['state'],$_GET['publication_name'],$_GET['publication_date']);

$backup = Download::backup($_GET['id']);

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("CCC Data Management Services Inc.")
							 ->setLastModifiedBy("CCC Data Management Services Inc.")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
$objPHPExcel->getActiveSheet()->setTitle('Property Address');
$objPHPExcel->createSheet()->setTitle('Agents');
$objPHPExcel->createSheet()->setTitle('Invalid');

if ($_GET['app'] == 'AU') {
	$objPHPExcel->setActiveSheetIndex(0);
	$row = 0;
	foreach ($exports_au_property as $export){
		$col = 0;
		$row++;
		foreach($au_columns as $column){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row , $export[$column['Field']]);
			$col++;
		}
	}
	$objPHPExcel->setActiveSheetIndex(1);
	$row = 0;
	foreach ($exports_au_agent as $export){
		$col = 0;
		$row++;
		foreach($agent_au_columns as $column){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row , $export[$column['Field']]);
			$col++;
		}
	}
	$objPHPExcel->setActiveSheetIndex(2);
	$row = 0;
	foreach ($exports_invalid as $export){
		$col = 0;
		$row++;
		foreach($invalid_columns as $column){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row , $export[$column['Field']]);
			$col++;
		}
	}
} elseif ($_GET['app'] == 'NZ') {
	$objPHPExcel->setActiveSheetIndex(0);
	$row = 0;
	foreach ($exports_nz_property as $export){
		$col = 0;
		$row++;
		foreach($nz_columns as $column){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row , $export[$column['Field']]);
			$col++;
		}
	}
	$objPHPExcel->setActiveSheetIndex(1);
	$row = 0;
	foreach ($exports_nz_agent as $export){
		$col = 0;
		$row++;
		foreach($agent_columns as $column){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row , $export[$column['Field']]);
			$col++;
		}
	}
}

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$_GET['state']." ".$_GET['publication_name']." ".$_GET['publication_date'].'.xls');
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
