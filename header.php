<?php
session_start();
$lang = isset($_GET['lang']) ? $_GET['lang']: "es";
require_once('lang/'.$lang.'.php');
require_once('common.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang_title; ?></title>
<link type="text/css" rel="stylesheet"  href="css/style.css" />
<link type="text/css" rel="stylesheet"  href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" > 
//define dynamic error message variables for jquery
	var lang_schReq='<?php echo  $lang_schReq; ?>';
	var lang_accTknReq='<?php echo $lang_accTknReq; ?>';
	var lang_stpTwoFldReq='<?php echo $lang_stpTwoFldReq; ?>';
	var lang_levelReq='<?php echo $lang_levelReq; ?>';
	var lang_courseReq='<?php echo $lang_courseReq; ?>';
	var lang_batchReq='<?php echo $lang_batchReq; ?>';
	var lang_ckbStuReq='<?php echo $lang_ckbStuReq; ?>';
	var lang_ckbExamGrpReq='<?php echo $lang_ckbExamGrpReq; ?>';
	var lang_stpTwoParentDate='<?php echo $lang_stpTwoParentDate; ?>';
	var lang_examGrpReq='<?php echo $lang_examGrpReq; ?>';
	var lang_subReqParent='<?php echo $lang_subReqParent; ?>';
	
	var lang_backButton='<?php echo $lang_backButton; ?>';
	var lang_proceedButton='<?php echo $lang_proceedButton; ?>';
	var lang_stpblw3ParentErr='<?php echo $lang_stpblw3ParentErr; ?>';

//for sem 9
countLev9Sem1Val = []; countLev9Sem2Val = [];
<?php for($j=0; $j<count($curcesLevelsNineSemOne); $j++){ ?>
	countLev9Sem1Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsNineSemOne[$j]; ?>" ;
<?php } ?>
<?php for($j=0; $j<count($curcesLevelsNineSemTwo); $j++){ ?>
	countLev9Sem2Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsNineSemTwo[$j]; ?>" ;
<?php } ?>
//for sem 10
countLev10Sem1Val = []; countLev10Sem2Val = [];
<?php for($j=0; $j<count($curcesLevelsTenSemOne); $j++){ ?>
	countLev10Sem1Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsTenSemOne[$j]; ?>" ;
<?php } ?>
<?php for($j=0; $j<count($curcesLevelsTenSemTwo); $j++){ ?>
	countLev10Sem2Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsTenSemTwo[$j]; ?>" ;
<?php } ?>
//for sem 11
countLev11Sem1Val = []; countLev11Sem2Val = [];
<?php for($j=0; $j<count($curcesLevelsElevenSemOne); $j++){ ?>
	countLev11Sem1Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsElevenSemOne[$j]; ?>" ;
<?php } ?>
<?php for($j=0; $j<count($curcesLevelsElevenSemTwo); $j++){ ?>
	countLev11Sem2Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsElevenSemTwo[$j]; ?>" ;
<?php } ?>

countLev12Sem1Val = []; countLev12Sem2Val = [];
<?php for($j=0; $j<count($curcesLevelsTwelveSemOne); $j++){ ?>
	countLev12Sem1Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsTwelveSemOne[$j]; ?>" ;
<?php } ?>
<?php for($j=0; $j<count($curcesLevelsTwelveSemTwo); $j++){ ?>
	countLev12Sem2Val[<?php echo $j; ?>] = "<?php echo $curcesLevelsTwelveSemTwo[$j]; ?>" ;
<?php } ?>

//for mapping of exam groups in step 5
examGroupMapSem1 = []; examGroupMapSem2 = [];
<?php for($j=0; $j<count($selectedExamGroupSem1); $j++){ ?>
	examGroupMapSem1[<?php echo $j; ?>] = "<?php echo $selectedExamGroupSem1[$j]; ?>" ;
<?php } ?>
<?php for($j=0; $j<count($selectedExamGroupSem2); $j++){ ?>
	examGroupMapSem2[<?php echo $j; ?>] = "<?php echo $selectedExamGroupSem2[$j]; ?>" ;
<?php } ?>
</script>

<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/rhinoslider-1.05.min.js"></script>
</head>
<body>
<div id="main-content">
	<div class="header" id="header">
		<div style="width:930px; margin:0 auto;">
			<div style="float:right">
			<form name="lanffrm" id="lanffrm" action="" method="get">
			 <?php echo $lang_Text; ?>:
			  <select name="lang" id="lang-id" onChange="this.form.submit();">
				 <option value="es"><?php echo $lang_Esp; ?></option>
				 <option value="en"><?php echo $lang_Eng; ?></option>
				 <option value="fr"><?php echo $lang_Frch; ?></option>
			  </select>
			  <script type="text/javascript">
				jQuery('#lang-id').val("<?php echo $lang;?>");
			  </script>
			</form>
			</div>
			<div class="head-logo"><div class="logo"><a href="./"><img src="images/logo.png" width="200" /></a></div>
			<div class="logo-right">
			<div class="header-text"><?php echo $textHeader; ?></div>
			<div class="header-image"><img src="images/logo-right.png" /></div>
			</div></div>
			<div class="home-button"><a href="./"><?php echo $lang_homePageLink; ?></a></div>
		</div>
	</div>
	<div class="main-menu"></div>
	<div style="width:930px; margin:0 auto;">
<!--check if javascript is disabled for browser-->
<noscript>
	<h3>JavaScript is disabled! Please enable JavaScript in your web browser to access the application!</h3>
</noscript>