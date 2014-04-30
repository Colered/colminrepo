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
include_once('classes/fedena_api.class.php');
include_once('classes/fedena_api_parent.php');

$varValArr=array(
         "lang_badLogoUrlErr"=>$lang_badLogoUrlErr,
         "lang_noServiceErr"=>$lang_noServiceErr,
         "lang_noMraksErr"=>$lang_noMraksErr,
         "lang_noSubjectErr"=>$lang_noSubjectErr,
         "lang_apiErr"=>$lang_apiErr,
         "lang_apiTknErr"=>$lang_apiTknErr,
         "lang_schoolErr"=>$lang_schoolErr,
         "lang_nameParent"=>$lang_nameParent,
         "lang_courseParent"=>$lang_courseParent,
         "lang_reprtGrdParent"=>$lang_reprtGrdParent,
         "lang_acadmcStsParent"=>$lang_acadmcStsParent,
         "lang_subjParent"=>$lang_subjParent,
         "lang_fstSemParent"=>$lang_fstSemParent,
         "lang_secSemParent"=>$lang_secSemParent,
         "lang_teachComntParent"=>$lang_teachComntParent,
         "lang_absncParent"=>$lang_absncParent,
         "lang_signofDirector"=>$lang_signofDirector,
         "lang_teachSignParent"=>$lang_teachSignParent,
         "lang_marksAvg"=>$lang_marksAvg,
         "lang_achieved"=>$lang_achieved,
         "lang_processing"=>$lang_processing,
         "lang_nomade"=>$lang_nomade,
		 "lang_levelParent"=>$lang_levelParent,
		 "lang_dateRange"=>$lang_dateRange,
		 "allLevelsParent"=>$allLevelsParent
    );


if(($_POST['schoolUrl'] !="") && ($_POST['accsssToken'] != "")) {
   	$fedObj = new Fedena_Parent_Data($varValArr);

    if(trim($_POST['class_level']) < 3 || trim($_POST['class_level'])==101 || trim($_POST['class_level'])==102 || trim($_POST['class_level'])==103 || trim($_POST['class_level'])==104 ){
      //report for the grade lower than three
      $fedObj->createReportKinder();
   	}else{
   	   $fedObj->createReport();
   	}

}

?>