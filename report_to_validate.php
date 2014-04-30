<?php
session_start();
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
set_time_limit(0);
if ($_POST) {
	require_once $_SERVER['DOCUMENT_ROOT']."/cidotnew/classes/PHPExcel.php";
	$inputFileName2 = $_SERVER['DOCUMENT_ROOT']."/cidotnew/the_tool_to_generate_report.xml";
	$inputFileType = PHPExcel_IOFactory::identify($inputFileName2);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($inputFileName2);
	$objPHPExcel->setActiveSheetIndex(1);
	$objPHPExcel->getActiveSheet()->getStyle("C1:E1")->getAlignment()->setTextRotation(90);
	$objPHPExcel->getActiveSheet()->getStyle("C1:E1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->getStyle("C1:AT1")->getAlignment()->setTextRotation(90);
	$objPHPExcel->getActiveSheet()->getStyle("C1:AT1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header("Content-Disposition: attachment;Filename=file_validate_data.xlsx");
	header('Cache-Control: max-age=0'); 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
}
?>