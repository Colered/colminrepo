<?php
session_start();
ob_start();
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
set_time_limit(0);
$lang = isset($_POST['lang']) ? $_POST['lang']: "es";
include_once('common.php');
include_once('lang/'.$lang.'.php');
$varValArr=array(
            "lang_postErr"=>$lang_postErr,
            "lang_noStudentErr"=>$lang_noStudentErr,
            "lang_noMraksErr"=>$lang_noMraksErr,
            "lang_mrkLess70PerCompErr1"=>$lang_mrkLess70PerCompErr1,
            "lang_mrkLess70PerCompErr2"=>$lang_mrkLess70PerCompErr2,
            "lang_mrkLess70PerExtraErr1"=>$lang_mrkLess70PerExtraErr1,
            "lang_mrkLess70PerExtraErr2"=>$lang_mrkLess70PerExtraErr2,
            "lang_noExamErr"=>$lang_noExamErr,
            "lang_apiErr"=>$lang_apiErr
 );
include_once('classes/fedena_api.class.php');
if(($_POST['schoolUrl'] !="") && ($_POST['accsssToken'] != "")) {
   	$fedObj = new Fedena_Data($varValArr);
	$fedObj->createCsv($subject_countsArr,$reportTitleArr,$totalWorkingDay,array('sem1_ExamCounts'=>count($examgroupLevelSemOne),'sem2_ExamCounts'=>count($examgroupLevelSemTwo)));
}
?>