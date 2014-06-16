$(document).ready(function() {
    $('#slider').rhinoslider({
        controlsPlayPause: false,
        showControls: 'never',
        showBullets: 'never',
        controlsMousewheel: false,
        prevText: lang_backButton,
        nextText: lang_proceedButton,
        slidePrevDirection: 'toRight',
        slideNextDirection: 'toLeft',
		controlsKeyboard: false
    });
	//$("#class_level").hide();infotext
	$(".loading-img").hide();
	$(".infotext").hide();
    $(".rhino-prev").hide();
    $('.rhino-next').after('<a class="form-submit" href="javascript:void(0);" >'+lang_proceedButton+'</a>');
    $(".rhino-next").hide();
    var info = ["step1", "step2", "step3", "step4", "step5"];
    var images = ["personal-details-icon.png", "account-details.png", "contact-details.png"];
    $('.rhino-bullet').each(function(index) {
        $(this).html('<p style="margin: 0pt; font-size: 13px; font-weight: bold;"><img src="./img/' +
                images[index] + '"></p><p class="bullet-desc">' + info[index] + '</p></a>');
    });
    $("#class-9, #class-10, #class-11, #class-12").hide();
	$(".form-submit").css( { "margin" : "-375px 48px 20px 20px", "position" : "relative" } );
});

$(document).ready(function() {
	$("#rhino-item1,#rhino-item2, #rhino-item3, #rhino-item4, #rhino-item5").hide();
	});
$(document).ready(function() {
 $('.rhino-prev').live("click", function() {
	var current_tab = $('#slider').find('.rhino-active').attr("id");
	switch (current_tab) {
        case 'rhino-item1':
			$("#rhino-item0").show();
			$("#rhino-item1,#rhino-item2, #rhino-item3, #rhino-item4, #rhino-item5").hide();
            $(".form-submit").hide()
			$(".form-submit").css( { "margin" : "-375px 48px 20px 20px", "position" : "relative" } );
			$(".form-submit").show(1200);
            break;
		case 'rhino-item2':
            $("#rhino-item1").show();
			$("#rhino-item0,#rhino-item2, #rhino-item3, #rhino-item4, #rhino-item5").hide();
            break;
		case 'rhino-item3':
            $("#rhino-item2").show();
			$("#rhino-item0,#rhino-item1, #rhino-item3, #rhino-item4, #rhino-item5").hide();
            break;
		case 'rhino-item4':
            $("#rhino-item3").show();
			$("#rhino-item0,#rhino-item1, #rhino-item2, #rhino-item4, #rhino-item5").hide();
            break;
		case 'rhino-item5':
            $("#rhino-item4").show();
			$("#rhino-item0,#rhino-item1, #rhino-item2, #rhino-item3, #rhino-item5").hide();
            break;
	}
	});
						   
$('.form-submit').live("click", function() {

    $('.form-error').html("");

    var current_tab = $('#slider').find('.rhino-active').attr("id");
    switch (current_tab) {
        case 'rhino-item0':
            step1_validation();
            break;
        case 'rhino-item1':
			step2_validation();
            break;
        case 'rhino-item2':
			step3_validation();
            break;
        case 'rhino-item3':
			step4_validation();
            break;
        case 'rhino-item4':
			step5_validation();
            break;
		case 'rhino-item5':
			step6_validation();
            break;
    }
});
});

var step1_validation = function() {
    if ($('#schoolUrl').val() == '') {
		if(!$( "#schoolUrl" ).hasClass( "errorDisplay" )){
		     $("#schoolUrl").addClass('errorDisplay');
		}
        $('#schoolUrl').parent().parent().find('.form-error').show().html(lang_schReq);
        $(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
		$(".form-submit").css( { "margin" : "-375px 48px 20px 20px", "position" : "relative" } );
    }
    if ($('#accsssToken').val() == '') {
		if(!$( "#accsssToken" ).hasClass( "errorDisplay" )){
		     $("#accsssToken").addClass('errorDisplay');
		}
        $('#accsssToken').parent().parent().find('.form-error').show().html(lang_accTknReq);
        $(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
		$(".form-submit").css( { "margin" : "-375px 48px 20px 20px", "position" : "relative" } );
    }
	if (($('#schoolUrl').val() != '') && ($('#accsssToken').val() != '')) {
			$(".loading-image").show();
			$(".errorDiv").hide();
			$.ajax({
				url: "./ajax.php",
				type: "POST",
				data: {
					'lang': $("#lang").val(),
					'codeBlock': 'getCourses',
					'accessTocken': $("#accsssToken").val(),
					'schoolUrl': $("#schoolUrl").val(),
				},
				success: function(data) {
					$(".loading-image").hide();
					if (data == 0) {
						$(".errorDiv").show().delay(3000).fadeOut();
						$(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
						$(".form-submit").css( { "margin" : "-375px 48px 20px 20px", "position" : "relative" } );
					} else {
						$("#rhino-item1").show();
						$("#rhino-item0,#rhino-item2, #rhino-item3, #rhino-item4, #rhino-item5,#rhino-item6").hide();
            			$("#courses").html(data);
						$(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
						$(".rhino-next").show();
						$(".form-submit").css( { "margin" : "0 48px 20px 20px;", "position" : "absolute" } );
						$('.form-submit').hide();
						$('.rhino-next').trigger('click');
					}
				},
				error: function(errorThrown) {
					alert(errorThrown);
					console.log(errorThrown);
				}
			});
	}
};

var step2_validation = function() {
    var err = 0;
	if ($('#centerName').val() == '') {
        $('#centerName').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#centerName" ).hasClass( "errorDisplay" )){
		     $("#centerName").addClass('errorDisplay');
		}
        err++;
    }
    if ($('#regionalAdd').val() == '') {
        $('#regionalAdd').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#regionalAdd" ).hasClass( "errorDisplay" )){
		     $("#regionalAdd").addClass('errorDisplay');
		}
        err++;
    }
    if ($('#eduDist').val() == '') {
        $('#eduDist').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#eduDist" ).hasClass( "errorDisplay" )){
		     $("#eduDist").addClass('errorDisplay');
		}
        err++;
    }
    if ($('#centerCode').val() == '') {
        $('#centerCode').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#centerCode" ).hasClass( "errorDisplay" )){
		     $("#centerCode").addClass('errorDisplay');
		}
        err++;
    }
    if ($('#school_year').val() == '') {
        $('#school_year').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#school_year" ).hasClass( "errorDisplay" )){
		     $("#school_year").addClass('errorDisplay');
		}
        err++;
    }
	if ($('#school_shift').val() == '') {
        $('#school_shift').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#school_shift" ).hasClass( "errorDisplay" )){
		     $("#school_shift").addClass('errorDisplay');
		}
        err++;
    }
	if ($('#school_sector').val() == '') {
        $('#school_sector').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#school_sector" ).hasClass( "errorDisplay" )){
		     $("#school_sector").addClass('errorDisplay');
		}
        err++;
    }
	if ($('#school_area').val() == '') {
        $('#school_area').parent().parent().find('.form-error').show().html(lang_stpTwoFldReq);
		if(!$( "#school_area" ).hasClass( "errorDisplay" )){
		     $("#school_area").addClass('errorDisplay');
		}
        err++;
    }
	if ($('#from').val() == '') {
        $('#from').parent().parent().find('.date-form-error').show().html(lang_stpTwoParentDate);
		if(!$( "#from" ).hasClass( "errorDisplay" )){
		     $("#from").addClass('errorDisplay');
		}
        err++;
    }
	if ($('#to').val() == '') {
        $('#to').parent().parent().find('.date-form-error').show().html(lang_stpTwoParentDate);
		if(!$( "#to" ).hasClass( "errorDisplay" )){
		     $("#to").addClass('errorDisplay');
		}
        err++;
    }
    if (err == 0) {
        $("#rhino-item2").show();
		$("#rhino-item0,#rhino-item1, #rhino-item3, #rhino-item4, #rhino-item5,#rhino-item6").hide();
        $(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
        $(".rhino-next").show();
        $('.form-submit').hide();
		//$("#class_level").prop("selectedIndex", 0);
        $('.rhino-next').trigger('click');
    } else {
        $(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
    }

};

var step3_validation = function() {
    var err = 0;
	
    if ($('#courses').val() == '') {
        $('#courses').parent().parent().find('.form-error').show().html(lang_courseReq);
		if(!$( "#courses" ).hasClass( "errorDisplay" )){
		     $("#courses").addClass('errorDisplay');
		}
        err++;
    }
	if ($('#class_level').val() == '') {
        $('#class_level').parent().parent().find('.form-error').show().html(lang_levelReq);
		if(!$( "#class_level" ).hasClass( "errorDisplay" )){
		     $("#class_level").addClass('errorDisplay');
		}
        err++;
    }
    if ($('#batchName').val() == '') {
        $('#batchName').parent().parent().find('.form-error').show().html(lang_batchReq);
		if(!$( "#batchName" ).hasClass( "errorDisplay" )){
		     $("#batchName").addClass('errorDisplay');
		}
        err++;
    }
    if (err == 0) {
        $("#rhino-item3").show();
		$("#rhino-item0,#rhino-item1, #rhino-item2, #rhino-item4, #rhino-item5,#rhino-item6").hide();
        $(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
        $(".rhino-next").show();
        $('.form-submit').hide();
		//map the subjects in next step
		mapSubjects();
		//for parents report only- for show hide areas in step 5
		var $parentDiv = $('#parentReport');
		if($parentDiv.length){
		   showAreasStep5Parent();
		}
		//trigger to next step
         if($('.rhino-next').trigger('click'))
		{   
		   // alert('yes');
		    var $ministryDiv=$('#ministry_report');
		    if($ministryDiv.length){
			 errorMinstryStep4();
			}
		}
    } else {
        $(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
    }
};

var step4_validation = function() {
	$(".form-error1").hide();
	$(".form-error2").hide();
    var err = parseInt(0); var counterVal = parseInt(0); var counterValtwo = parseInt(0); var idForsem1 = ''; var idForsem2 = '';
	if (($('#class_level :selected').val()) == 9) {
		var counterVal = parseInt($('#countLev9Sem1').text());
		var counterValtwo = parseInt($('#countLev9Sem2').text());
		var idForsem1 = '#9ss';
		var idForsem2 = '#9s2s';
    }else if (($('#class_level :selected').val()) == 10) {
		var counterVal = parseInt($('#countLev10Sem1').text());
		var counterValtwo = parseInt($('#countLev10Sem2').text());
		var idForsem1 = '#10ss';
		var idForsem2 = '#10s2s';
    }else if (($('#class_level :selected').val()) == 11) {
		var counterVal = parseInt($('#countLev11Sem1').text());
		var counterValtwo = parseInt($('#countLev11Sem2').text());
		var idForsem1 = '#11ss';
		var idForsem2 = '#11s2s';
    }else if (($('#class_level :selected').val()) == 12) {
		var counterVal = parseInt($('#countLev12Sem1').text());
		var counterValtwo = parseInt($('#countLev12Sem2').text());
		var idForsem1 = '#12ss';
		var idForsem2 = '#12s2s';
	}
	for(var i=0; i<parseInt(counterVal); i++){
		var sid = idForsem1 + i;
		if(($(sid).val()) == '') {
			$(sid).addClass('errorDisplay');
			err++;
		 }
	}
	for(var j=0; j<parseInt(counterValtwo); j++){
		var sidsem2 = idForsem2 + j;
		if(($(sidsem2).val()) == '') {
			 $(sidsem2).addClass('errorDisplay');
			err++;
		 }
	}
	
	var $myDiv = $('#ckbCheckAllStu');
	if ($myDiv.length){
	    if ($("input[type='checkbox'][name='chkStudent[]']:checked").length==0){
			$('.form-error1').show();
			
			$('.form-error1').html(lang_ckbStuReq);
			err++;
		}
	}
    if (err == 0) {
		$("#rhino-item4").show();
		$("#rhino-item0,#rhino-item1, #rhino-item2, #rhino-item3, #rhino-item5,#rhino-item6").hide();
		$(".form-error-stp5").hide();
		$(".form-error-stp6").hide();
        $('.form-error1').hide();
        $(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
        $(".rhino-next").show();
        $('.form-submit').hide();
        if($('.rhino-next').trigger('click'))
		{   
			var $ministryDiv=$('#ministry_report');
		    mapExamGroup();
			if($ministryDiv.length){
			  errorMinstryStep5();
			}
		}
		

    } else {
        $(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
    }
};
var step5_validation = function() { 
	$('.form-error2').hide();
    var err = 0;
	var totaltestOnStep5Sem1 = parseInt($('#totaltestOnStep5Sem1').text())-3;
	var totaltestOnStep5Sem2 = parseInt($('#totaltestOnStep5Sem2').text())-3;
	var cntExamGrpLevSem1Parent = parseInt($('#cntExamGrpLevSem1').text());
	var cntExamGrpLevSem2Parent = parseInt($('#cntExamGrpLevSem2').text());
	var sumParentBothExamGrp=parseInt(cntExamGrpLevSem1Parent+cntExamGrpLevSem2Parent);
    var clsLvlVal=$("#class_level option:selected").val();
	if(clsLvlVal==101 || clsLvlVal==102 || clsLvlVal==103 || clsLvlVal==104 || clsLvlVal==1 || clsLvlVal==2){
	 var $below3ParentDiv = $('#forLevelbelow3');
	 if ($below3ParentDiv.length){
	     if ($("input[type='checkbox'][name='chkLevels[]']:checked").length==0){
			 $('.form-error-stp5').show();
			 $('.form-error-stp5').html(lang_stpblw3ParentErr);
			 err++;
		 }
	 }
	}else{
		  for(var i=1; i<=parseInt(totaltestOnStep5Sem1); i++){
		var sid = '#s1e' + i;
		if(($(sid).val()) == '') {
			$(sid).addClass('errorDisplay');	
			err++;
		 }
	}
	for(var j=1; j<=parseInt(totaltestOnStep5Sem2); j++){
		var sidsem2 = '#s2e' + j;
		if(($(sidsem2).val()) == '') {
			$(sidsem2).addClass('errorDisplay');
			err++;
		 }
	}
	var $parentExamDiv=$('.divexamparent');
	if($parentExamDiv.length){
	if($('.subexamParent option[value=""]:selected').length==parseInt(sumParentBothExamGrp)){	
		$('.form-error2').show();
		$('.form-error2').html(lang_examGrpReq);
	   err++;}
	else{
		err=0;
	}
	}
	var $myDiv = $('.checkboxs');
	if ($myDiv.length){
		if($( ".subexamParent" ).hasClass( "errorDisplay" )){
			err++;
		}
	}
		
		}
    if (err == 0) {
		$("#rhino-item5").show();
        $('.form-error2').hide();
		$('.form-error-stp5').hide();
        $(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
        $(".rhino-next").hide();
        $('.rhino-next').trigger('click');
		var $parentDiv = $('#parentReport');
		if($parentDiv.length){
		   $('.form-submit').show();
		   $("#rhino-item0,#rhino-item1, #rhino-item2, #rhino-item3, #rhino-item4,#rhino-item6,.rhino-prev").hide();
		}else{
		   $('.form-submit').hide();
		   if($('#multiForm').attr('action', "report.php").submit()){
			$('.show-hide-loading').show(); 
			$('.show-download').hide();
			$(".rhino-prev").hide();
			$(".loading-img").show();
			$(".infotext").show();
	     }
		   $("#rhino-item0,#rhino-item1, #rhino-item2, #rhino-item3, #rhino-item4").hide();
		}
		//added for grade <3
		var $parentDiv = $('#parentReport');
		if($parentDiv.length){
		   showAreasStep6Parent();
		}
		
    } else {
        $(".rhino-active-bullet").removeClass("step-success").addClass("step-error");
    }
};
var step6_validation = function() {
 
    var err=0;
	var clsLvlVal=$("#class_level option:selected").val();
	if(clsLvlVal==101 || clsLvlVal==102 || clsLvlVal==103 || clsLvlVal==104 || clsLvlVal==1 || clsLvlVal==2){
	 var $stp6ParentDiv = $('#forLevelbelow6');
	 if ($stp6ParentDiv.length){
	     if ($("input[type='checkbox'][name='ckbGrade[]']:checked").length==0){
			 $('.form-error-stp6').show();
			 $('.form-error-stp6').html(lang_stpblw3ParentErr);
			 err++;
		 }
	 }
	}else{
     var $parentDiv = $('.parentSub');
	  if ($parentDiv.length){
		if ($("input[type='checkbox'][name='chkSubjectSem1[]']:checked").length==0 && $("input[type='checkbox'][name='chkSubjectSem2[]']:checked").length==0){
			$('.form-error2').show();
			$('.form-error2').html(lang_subReqParent);
			err++;
		}
	}
	}
	if(err==0){
		$('.form-error-stp6').hide();
	    $("#rhino-item6").show();
		$("#rhino-item0,#rhino-item1, #rhino-item2, #rhino-item3, #rhino-item4","#rhino-item5").hide();
        $('.form-error2').hide();
        $(".rhino-active-bullet").removeClass("step-error").addClass("step-success");
        $(".rhino-next").hide();
        //$('.form-submit').show();
        if($('#multiForm').submit()){
			$(".loading-img").show();
			$(".infotext").show();
	     }
		$('.rhino-next').trigger('click');
		$('.form-submit').hide();
	}else
	{
	  $(".rhino-active-bullet").removeClass("step-success").addClass("step-error");   	
	}
     
};
function getBatches(course) {
	getLevel(course);
    $("#loading-img-course").show();
    $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
            'lang': $("#lang").val(),
			'codeBlock': 'getBatches',
            'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
            'courseCodeandName': course,
        },
        success: function(data) {
            $("#loading-img-course").hide();
            $("#batchName").html(data);
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
}
function getExamGroup(batch,course) {
    $("#loadingimg").show();
    $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
            'lang': $("#lang").val(),
			'codeBlock': 'getExamGroup',
            'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
            'batchName': batch,
			'courseCodeandName': course,
        },
        success: function(data) {
            getBatchStartEndDate(batch);
	    $("#loadingimg").hide();
            $(".subexam").html(data);
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
}

function getBatchStartEndDate(batch) {
    $("#loadingimg").show();
    $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
            'lang': $("#lang").val(),
			'codeBlock': 'getBatchStartEndDate',
            'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
            'batchName': batch,
        },
        success: function(data) {
	    $("#loadingimg").hide();
            $("#batchStartEndDate").html(data);
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
}


function getSubject(batch) {
    $("#loadingimg").show();
    $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
            'lang': $("#lang").val(),
			'codeBlock': 'getSubject',
            'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
            'batchName': batch,
            'courseCodeandName': $('#courses :selected').val(),
        },
        success: function(data) {
            getExamGroup(batch,$('#courses :selected').val());
	    $("#loadingimg").hide();
            $(".subject").html(data);
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
}
function getShowHideSub() {
    if (($('#class_level :selected').val()) == 9) {
        $("#class-9").show();
        $("#class-10, #class-11, #class-12, #no-class").hide();
    } else if (($('#class_level :selected').val()) == 10) {
        $("#class-10").show();
        $("#class-9, #class-11, #class-12, #no-class").hide();
    } else if (($('#class_level :selected').val()) == 11) {
        $("#class-11").show();
        $("#class-9, #class-10, #class-12, #no-class").hide();
    } else if (($('#class_level :selected').val()) == 12) {
        $("#class-12").show();
        $("#class-9, #class-10, #class-11, #no-class").hide();
    } else {
        $("#no-class").show();
        $("#class-9, #class-10, #class-11, #class-12").hide();
    }
}

function showAreasStep5Parent(){
	$selValLvl = $('#class_level :selected').val();
	if (($selValLvl == 101) || ($selValLvl == 102) || ($selValLvl == 103) || ($selValLvl == 104) || ($selValLvl == 1) || ($selValLvl == 2)){
		$("#forLevelAbove3").hide();
		$("#forLevelbelow3").show();
		$.ajax({
			url: "./ajax.php",
			type: "POST",
			data: {
				'lang': $("#lang").val(),
				'codeBlock': 'getPedagogicArea',
				'selValLvl': $selValLvl,
			},
			success: function(data) {
				$("#forLevelbelow3").html(data);
				childDivParent();
	   		},
			error: function(errorThrown) {
				console.log(errorThrown);
			}
		});
	}else{
		$("#forLevelAbove3").show();
		$("#forLevelbelow3").hide();
	}
}

function showAreasStep6Parent(){
	   var chkbxIdStep5 = '';
        $('.chklevel:checked').each(function() {
          chkbxIdStep5 += $(this).val() + "#";
        });
        chkbxIdStep5 =  chkbxIdStep5.slice(0,-1);
	$selValLvl = $('#class_level :selected').val();
	if (($selValLvl == 101) || ($selValLvl == 102) || ($selValLvl == 103) || ($selValLvl == 104) || ($selValLvl == 1) || ($selValLvl == 2)){
		$("#forLevelAbove6").hide();
		$("#forLevelbelow6").show();
		$.ajax({
			url: "./ajax.php",
			type: "POST",
			data: {
				'lang': $("#lang").val(),
				'codeBlock': 'getPedagogicAreaVal',
				'selValLvl': $selValLvl,
				'chkbxVal':chkbxIdStep5
			},
			success: function(data) {
				$("#forLevelbelow6").html(data);
	   		},
			error: function(errorThrown) {
				console.log(errorThrown);
			}
		});
	}else{
		$("#forLevelAbove6").show();
		$("#forLevelbelow6").hide();
	}
}


function mapSubjects() {
	if (($('#class_level :selected').val()) == 9) { // for level 9
		var curcesLevelsNineSemOne = parseInt($("#countLev9Sem1").html());
		var curcesLevelsNineSemTwo = parseInt($("#countLev9Sem2").html());
		//for first semester
		for($i=0; $i<curcesLevelsNineSemOne; $i++){
			$tempPercentage = 0;
			$("#9ss" + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev9Sem1Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			});
		}
		//for second semester
		for($i=0; $i<curcesLevelsNineSemTwo; $i++){
			$tempPercentage = 0;
			$('#9s2s' + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev9Sem2Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}									 
			});
		}
    } else if (($('#class_level :selected').val()) == 10) { // for level 10
		var curcesLevelsTenSemOne = parseInt($("#countLev10Sem1").html());
		var curcesLevelsTenSemTwo = parseInt($("#countLev10Sem2").html());
        //for first semester
		for($i=0; $i<curcesLevelsTenSemOne; $i++){
			$tempPercentage = 0;
			$("#10ss" + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev10Sem1Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}	
			});
		}
		//for second semester
		for($i=0; $i<curcesLevelsTenSemTwo; $i++){
			$tempPercentage = 0;
			$('#10s2s' + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev10Sem2Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			});
		}
    } else if (($('#class_level :selected').val()) == 11) { // for level 11
		var curcesLevelsElevenSemOne = parseInt($("#countLev11Sem1").html());
		var curcesLevelsElevenSemTwo = parseInt($("#countLev11Sem2").html());
       //for first semester
		for($i=0; $i<curcesLevelsElevenSemOne; $i++){
			$tempPercentage = 0;
			$("#11ss" + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev11Sem1Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			});
		}
		//for second semester
		for($i=0; $i<curcesLevelsElevenSemTwo; $i++){
			$tempPercentage = 0;
			$('#11s2s' + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev11Sem2Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			});
		}
    } else if (($('#class_level :selected').val()) == 12) { // for level 12
		var curcesLevelsTwelveSemOne = parseInt($("#countLev12Sem1").html());
		var curcesLevelsTwelveSemTwo = parseInt($("#countLev12Sem2").html());
       //for first semester
		for($i=0; $i<curcesLevelsTwelveSemOne; $i++){
			$tempPercentage = 0;
			$("#12ss" + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev12Sem1Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			});
		}
		//for second semester
		for($i=0; $i<curcesLevelsTwelveSemTwo; $i++){
			$tempPercentage = 0;
			$('#12s2s' + $i +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(countLev12Sem2Val[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			});
		}
    }
	
	
};
function mapExamGroup(){
		var examGpCntSem1 = parseInt($("#selectedExamGpCntSem1").html());
		var examGpCntSem2 = parseInt($("#selectedExamGpCntSem2").html());
		//for first semester
		$count = 1;
		for($i=0; $i<examGpCntSem1; $i++){
			$tempPercentage = 0;
			$("#s1e" + $count +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(examGroupMapSem1[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			}); $count++;
		}
		//for second semester
		$countS2 = 1;
		for($i=0; $i<examGpCntSem2; $i++){
			$tempPercentage = 0;
			$('#s2e' + $countS2 +' option').each(function(){
				$matchedPercent = similar_text($.trim($(this).text()), $.trim(examGroupMapSem2[$i]), 1);
				if($matchedPercent>=70){
					if($matchedPercent > $tempPercentage){
						$tempPercentage = $matchedPercent;
						$(this).attr("selected", "selected");
					}
				}
			}); $countS2++;
		}
	
}
function getLevel(course)
{
  $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
   			'lang': $("#lang").val(),
            'codeBlock': 'getLevel',
            'courseCodeandName': course,
        },
        success: function(data) {
			$("#loadingimg").hide();
			$("#class_level").val(data);
			if($('#class_level').val()!=""){
			 $('#class_level').removeClass('errorDisplay');
			}
			getShowHideSub();
   },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
 
}

$(document).ready(function() {
	$(".show-download").hide();
	$(".show-download-parent").hide();
	$(".show-hide-loading").show();
});
setInterval(function(){
  if ($.cookie("fileDownload")) {
	  
    $(".show-download").show();
	$(".show-hide-loading").hide();
	$(".rhino-prev").show();
	$.removeCookie('fileDownload', { path: '/' });
  }
},1000);

setInterval(function(){
  if ($.cookie("fileDownloadParent")) {
    $(".show-download-parent").show();
	$(".show-hide-loading, .rhino-prev").hide();
	$.removeCookie('fileDownloadParent', { path: '/' });
  }
},1000);
function similar_text(first, second, percent) {
  if (first === null || second === null || typeof first === 'undefined' || typeof second === 'undefined') {
    return 0;
  }
  first += '';
  second += '';
  var pos1 = 0,
    pos2 = 0,
    max = 0,
    firstLength = first.length,
    secondLength = second.length,
    p, q, l, sum;
  max = 0;
  for (p = 0; p < firstLength; p++) {
    for (q = 0; q < secondLength; q++) {
      for (l = 0;
      (p + l < firstLength) && (q + l < secondLength) && (first.charAt(p + l) === second.charAt(q + l)); l++);
      if (l > max) {
        max = l;
        pos1 = p;
        pos2 = q;
      }
    }
  }
  sum = max;
  if (sum) {
    if (pos1 && pos2) {
      sum += this.similar_text(first.substr(0, pos1), second.substr(0, pos2));
    }

    if ((pos1 + max < firstLength) && (pos2 + max < secondLength)) {
      sum += this.similar_text(first.substr(pos1 + max, firstLength - pos1 - max), second.substr(pos2 + max, secondLength - pos2 - max));
    }
  }
  if (!percent) {
    return sum;
  } else {
    return (sum * 200) / (firstLength + secondLength);
  }
}

function removeError(){
	$(".date-form-error").hide();
	$(".form-error1").hide();
	$(".form-error2").hide();
	$(".form-error-stp5").hide();
	$(".form-error-stp6").hide();
	
	}
function removeErrorst5($this){
		$(".form-error1").hide();
		$(".form-error2").hide();
		if($('#'+$this).val() == ""){
			$('#'+$this).addClass('errorDisplay');
		}else{
			$('#'+$this).removeClass('errorDisplay');
		}
	}
function getStudentsParent(batch)
{     
	 $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
   			'lang': $("#lang").val(),
            'codeBlock': 'getStudentsParent',
			'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
			'batchName': batch,
            'courseCodeandName': $('#courses :selected').val(),
        },
        success: function(data) {
			$("#loadingimg").hide();
			getExamGroupsParent(batch,$('#courses :selected').val());
			$("#check-student").html(data);
			showhideCkbSelAll();
			
   },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
 
}

function showhideCkbSelAll()
{   
	var stuCnt=$('.chkClsStudent');
	    if(stuCnt.length==0){
			$(".stuDetail").hide();
		}else{
     		$(".stuDetail").show();
		 }
	var subSem1Cnt=$('.ckbSubjSem1');
	    if(subSem1Cnt.length==0){
			$(".sem1subject").hide();
		}else{
     		$(".sem1subject").show();
		 }
		 
		 var subSem2Cnt=$('.ckbSubjSem2');
	    if(subSem2Cnt.length==0){
			$(".sem2subject").hide();
		}else{
     		$(".sem2subject").show();
		 }
}
function getExamGroupsParent(batch,course)
{ 
  $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
            'lang': $("#lang").val(),
			'codeBlock': 'getExamGroupsParent',
            'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
            'batchName': batch,
			'courseCodeandName': course,
        },
        success: function(data) {
			$("#loadingimg").hide();
			getSubjectParentSem1();
            $(".subexamParent").html(data);
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
}
function getSubjectParentSem1() {
    $("#loadingimg").show();
    $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
            'lang': $("#lang").val(),
			'codeBlock': 'getSubjectParentSem1',
            'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
            'batchName':$('#batchName :selected').val(),
            'courseCodeandName': $('#courses :selected').val(),
        },
        success: function(data) {
			getSubjectParentSem2();
	      $("#loadingimg").hide();
          $(".subjectSem1").html(data);
		  showhideCkbSelAll();
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
}
function getSubjectParentSem2() {
    $("#loadingimg").show();
    $.ajax({
        url: "./ajax.php",
        type: "POST",
        data: {
            'lang': $("#lang").val(),
			'codeBlock': 'getSubjectParentSem2',
            'accessTocken': $("#accsssToken").val(),
            'schoolUrl': $("#schoolUrl").val(),
            'batchName':$('#batchName :selected').val(),
            'courseCodeandName': $('#courses :selected').val(),
        },
        success: function(data) {
	    $("#loadingimg").hide();
            $(".subjectSem2").html(data);
			showhideCkbSelAll();
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
}
$(document).ready(function() {
	$('input:radio[value=reg]').attr('checked', 'checked');	
			$("div#sem1Regular").show();
			$("div#sem2Regular").show();
			$("div#sem1Technical").hide();
			$("div#sem2Technical").hide();
	$('#regular').click(function() {     
		var checked = $(this).attr('checked', true);
		if(checked)
		{ 
			$("div#sem1Regular").show();
			$("div#sem2Regular").show();
			$("div#sem1Technical").hide();
			$("div#sem2Technical").hide();
		}
	});
	$('#technical').click(function() {     
		var checked = $(this).attr('checked', true);
		if(checked)
		{ 
			$("div#sem1Regular").hide();
			$("div#sem2Regular").hide();
			$("div#sem1Technical").show();
			$("div#sem2Technical").show();
		}
	});
});
$(document).ready(function(){
   var $prntDiv = $('#parentReport');
    if($prntDiv.length){
		$("#ckbCheckAllStu").click(function () {
			$(".chkClsStudent").prop('checked', $(this).prop('checked'));
			$(".form-error1").hide();
			
		});
		
	$('#ckbCheckAllSem1ExamGrp').click(function(event) {  
		if(this.checked) { 
			$('.ckbSem1ExmGrp').each(function() { 
				this.checked = true;  
				$('.slctSem1Exam').show();
				$('.slctSem1Exam').prop('selectedIndex',0);
				$('.slctSem1Exam').addClass('errorDisplay');
			});
		}else{
			$('.ckbSem1ExmGrp').each(function() { 
				this.checked = false; 
				$('.slctSem1Exam').hide();
				$('.slctSem1Exam').prop('selectedIndex',0);
				$('.slctSem1Exam').removeClass('errorDisplay');
			});         
		}
	});
	$('#ckbCheckAllSem2ExamGrp').click(function(event) {   
		if(this.checked) { 
			$('.ckbSem2ExmGrp').each(function() { 
				this.checked = true;      
				$('.slctSem2Exam').show();
				$('.slctSem2Exam').prop('selectedIndex',0);
				$('.slctSem2Exam').addClass('errorDisplay');
			});
		}else{
			$('.ckbSem2ExmGrp').each(function() { 
				this.checked = false; 
				$('.slctSem2Exam').hide();
				$('.slctSem2Exam').prop('selectedIndex',0);
				$('.slctSem2Exam').removeClass('errorDisplay');
			});         
		}
});
		$("#ckbCheckAllSem1Subj").click(function () {
			$(".ckbSubjSem1").prop('checked', $(this).prop('checked'));
			$(".form-error2").hide();
		});
		$("#ckbCheckAllSem2Subj").click(function () {
			$(".ckbSubjSem2").prop('checked', $(this).prop('checked'));
			$(".form-error2").hide();
		});
	}
});
function showExamGps(chkID, dropdID){
	$checkIdVal = '#'+chkID;
	$idVal = '#'+dropdID;
	if($($checkIdVal).is(':checked')){
		$($idVal).show();
		$($idVal).prop('selectedIndex',0);
		$($idVal).addClass('errorDisplay');
	}else{
		$($idVal).hide();
		$($idVal).prop('selectedIndex',0);
		$($idVal).removeClass('errorDisplay');
	}
}
$(document).ready(function() {
	$("input").keydown(function(){
		var currID = '#'+this.id;
	   $(currID).parent().parent().find('.form-error').html("");
	   $(".erromes:first").html("");
	   $(currID).removeClass('errorDisplay');
	   if($(currID).val()!="")
	   { 
	      $(currID).removeClass('errorDisplay'); 
		   }
	});
	
	$("select").change(function(){
		var currID = '#'+this.id;
	   $(currID).parent().parent().find('.form-error').html("");
	   $("#rhino-item2").find('.form-error:first').html("");
	   $(".erromes:first").html("");
	   $(currID).removeClass('errorDisplay');
	   
	}); 
});
$(document).ready(function() {
	$('.subexamParent').hide();
});

$(document).ready(function () {
(function () {
$('#clicktovalidate').on("click",function() {
	$('#multiForm').attr('action', "report_to_validate.php").submit();
	return true;
    //$('.last-form').wrap('<form  name="validationSheetForm" id="validationSheetForm" action="report_to_validate.php" method="post"></form>');
});
})();
//hide the proceed button on index page	
	if ($('#hidden-proceed').length){
		$(".form-submit").hide();
	}
});
function ckallcheckboxGrd() {
	 $('.form-error-stp5').hide();
	var $prntDiv = $('#parentReport');
    if($prntDiv.length){
		if($('#ckbselctAllGrdVal').is(':checked'))
		{  
			$('.chnageImg').attr({src: 'images/minus_icon.png'});
			$(".sub_title_hide_show").show();
			$(".ckbClsGrd").attr("checked","checked");
		}else{
			$('.chnageImg').attr({src: 'images/plus_icon.png'});
			$(".ckbClsGrd").removeAttr("checked");
			$(".sub_title_hide_show").hide();
		}
		
	}
}
function ckballcheckboxGrdStep6() {
	$('.form-error-stp6').hide();
	var $prntDiv = $('#parentReport');
    if($prntDiv.length){
		if($('#ckbselctAllGrdValStep6').is(':checked'))
		{
			$(".ckbclsGrdStp6").attr("checked","checked");
		}else{
			$(".ckbclsGrdStp6").removeAttr("checked");
		}
		
	}
}
function childDivParent(){
	$('.sub_title_hide_show').hide();
}
function hideshowTitle(j)
{
	var currSubDivCls = '.sub-title'+j;
    var imageCls='.show_hide'+j;
	var ckbGrdCls='.ckbslectUnslect'+j;
		if($(currSubDivCls).css('display') == 'none') {
        $(currSubDivCls).slideDown("fast");
        $(imageCls).attr({src: 'images/minus_icon.png'});
    }
    else {
        $(currSubDivCls).slideUp("fast");
        $(imageCls).attr({src: 'images/plus_icon.png'});
		$(ckbGrdCls).removeAttr("checked");
    }

}
$(document).ready(function() {
   //function to select a date range on parent report
	$(function() {
		$( "#from" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				        $("#from").removeClass('errorDisplay');	
						$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
						$("#to").removeClass('errorDisplay');	
						$( "#from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
});
function errorMinstryStep4(){
  var counterVal = parseInt(0); var counterValtwo = parseInt(0); var idForsem1 = ''; var idForsem2 = '';
	if (($('#class_level :selected').val()) == 9) {
		$('.sublevel10').prop('selectedIndex',0);
		$('.sublevel11').prop('selectedIndex',0);
		$('.sublevel12').prop('selectedIndex',0);
		
		var counterVal = parseInt($('#countLev9Sem1').text());
		var counterValtwo = parseInt($('#countLev9Sem2').text());
		var idForsem1 = '#9ss';
		var idForsem2 = '#9s2s';
    }else if (($('#class_level :selected').val()) == 10) {
		$('.sublevel9').prop('selectedIndex',0);
		$('.sublevel11').prop('selectedIndex',0);
		$('.sublevel12').prop('selectedIndex',0);
		var counterVal = parseInt($('#countLev10Sem1').text());
		var counterValtwo = parseInt($('#countLev10Sem2').text());
		var idForsem1 = '#10ss';
		var idForsem2 = '#10s2s';
    }else if (($('#class_level :selected').val()) == 11) {
		$('.sublevel9').prop('selectedIndex',0);
		$('.sublevel10').prop('selectedIndex',0);
		$('.sublevel12').prop('selectedIndex',0);
		var counterVal = parseInt($('#countLev11Sem1').text());
		var counterValtwo = parseInt($('#countLev11Sem2').text());
		var idForsem1 = '#11ss';
		var idForsem2 = '#11s2s';
    }else if (($('#class_level :selected').val()) == 12) {
		$('.sublevel9').prop('selectedIndex',0);
		$('.sublevel10').prop('selectedIndex',0);
		$('.sublevel11').prop('selectedIndex',0);
		var counterVal = parseInt($('#countLev12Sem1').text());
		var counterValtwo = parseInt($('#countLev12Sem2').text());
		var idForsem1 = '#12ss';
		var idForsem2 = '#12s2s';
	}
	for(var i=0; i<parseInt(counterVal); i++){
		var sid = idForsem1 + i;
		if(!($(sid).val()) == '') {
			$(sid).removeClass('errorDisplay');	 
		 }
	}
	for(var j=0; j<parseInt(counterValtwo); j++){
		var sidsem2 = idForsem2 + j;
		if(!($(sidsem2).val()) == '') {
			 $(sidsem2).removeClass('errorDisplay');	
		 }
	}
}
function errorMinstryStep5()
{
	var totaltestOnStep5Sem1 = parseInt($('#totaltestOnStep5Sem1').text())-3;
	var totaltestOnStep5Sem2 = parseInt($('#totaltestOnStep5Sem2').text())-3;
    for(var i=1; i<=parseInt(totaltestOnStep5Sem1); i++){
		var sid = '#s1e' + i;
		if(!($(sid).val()) == '') {
			$(sid).removeClass('errorDisplay');	
		 }
	}
	for(var j=1; j<=parseInt(totaltestOnStep5Sem2); j++){
		var sidsem2 = '#s2e' + j;
		if(!($(sidsem2).val()) == '') {
			$(sidsem2).removeClass('errorDisplay');	
		 }
	}
}
function removeErrorSch(){
	$('#schoolUrl').removeClass('errorDisplay');
	//$('.form-error').hide();
}