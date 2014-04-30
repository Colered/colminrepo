<?php

//header('Content-Type: text/html; charset=ISO-8859-1');
include_once('classes/fedena_api.class.php');
$lang = isset($_POST['lang']) ? $_POST['lang'] : "es";
include_once('common.php');
include_once('lang/' . $lang . '.php');
$options = '';
$class_Level = '';
$checkbox = '';
$checkboxSubject = '';
$checkboxExamGrp = '';
$studentLevel = '';
$codeBlock = trim($_POST['codeBlock']);
$courseCodeandName = '';
$FedenaObj = new Fedena_Data(array());

switch ($codeBlock) {
    case "getCourses":
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "") {
            $url = trim($_POST['schoolUrl']) . "/api/courses?access_token=" . trim($_POST['accessTocken']) . "";
            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $options .='0';
                } else {
                    $options .='<option value="">' . utf8_encode($lang_slctCourse) . '</option>';
                    for ($i = 0; $i < count($xmlinfo->course); $i++) {
                        $options .= '<option value="' . $xmlinfo->course[$i]->course_code . '#' . $xmlinfo->course[$i]->course_name . ' ' . $xmlinfo->course[$i]->section_name . '">' . $xmlinfo->course[$i]->course_name . ' ' . $xmlinfo->course[$i]->section_name . '</option>';
                    }
                }
            } else {
                $options .='0';
            }
        } else {
            $options .='0';
        }
        echo $options;
        break;

    case "getBatches":

        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && $courseCode <> "") {
            $url = trim($_POST['schoolUrl']) . "/api/batches?access_token=" . trim($_POST['accessTocken']) . "&search[course_code_equals]=" . $courseCode . "";


            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
                } else {
                    $options .='<option value="">' . utf8_encode($lang_slctBatch) . '</option>';
                    for ($i = 0; $i < count($xmlinfo->batch); $i++) {
                        $options .= '<option value="' . $xmlinfo->batch[$i]->name . '">' . $xmlinfo->batch[$i]->name . '</option>';
                    }
                }
            } else {

                $options .='<option value="">' . utf8_encode($lang_noBtach) . '</option>';
            }
        } elseif ($courseCode == "") {
            $options .='<option value="">' . utf8_encode($lang_slctBatch) . '</option>';
        } else {
            $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
        }
        echo $options;
        break;

    case "getBatchStartEndDate":

        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && trim($_POST['batchName']) <> "") {
            $url = trim($_POST['schoolUrl']) . "/api/batches?access_token=" . trim($_POST['accessTocken']) . "&search[name_equals]=" . trim($_POST['batchName']) . "";


            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $options .='<span class="form-error">' . utf8_encode($lang_AccessTokenError) . '</span>';
                } else {
                    $options .='<input type="hidden" name="batchStartDate" value="' . substr($xmlinfo->batch->start_date, 0, 10) . '">';
                    $options .='<input type="hidden" name="batchEndDate" value="' . substr($xmlinfo->batch->end_date, 0, 10) . '">';
                }
            } else {
                $options .='<span style="color:#FF0000">' . utf8_encode($lang_AccessTokenError) . '</span>';
            }
        } else {
            $options .='<span style="color:#FF0000">' . utf8_encode($lang_AccessTokenError) . '</span>';
        }
        echo $options;

        break;

    case "getExamGroup":

        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && trim($_POST['batchName']) <> "" && $courseCode <> "") {
            $url = trim($_POST['schoolUrl']) . '/api/exam_groups?access_token=' . trim($_POST['accessTocken']) . '&search[batch_course_code_equals]=' . $courseCode . '&search[batch_name_equals]=' . trim($_POST['batchName']);

            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
                } else {
                    $options .='<option value="">' . utf8_encode($lang_slctExamGrp) . '</option>';
                    for ($i = 0; $i < count($xmlinfo->exam_group); $i++) {
                        $options .= '<option value="' . $xmlinfo->exam_group[$i]->name . '">' . $xmlinfo->exam_group[$i]->name . '</option>';
                    }
                }
            } else {
                $options .='<option value="">' . utf8_encode($lang_noExam) . '</option>';
            }
        } else {
            $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
        }
        echo $options;
        break;

    case "getSubject":

        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && trim($_POST['batchName']) <> "" && $courseCode <> "") {
            $url = trim($_POST['schoolUrl']) . '/api/subjects?access_token=' . trim($_POST['accessTocken']) . '&search[batch_name_equals]=' . trim($_POST['batchName']) . '&search[batch_course_code_equals]=' . $courseCode;

            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
                } else {
                    $options .='<option value="">' . utf8_encode($lang_slctSub) . '</option>';
                    for ($i = 0; $i < count($xmlinfo->subject); $i++) {
                        $options .= '<option value="' . $xmlinfo->subject[$i]->code . '#' . $xmlinfo->subject[$i]->name . '">' . $xmlinfo->subject[$i]->name . '</option>';
                    }
                }
            } else {

                $options .='<option value="">' . utf8_encode($lang_noSubject) . '</option>';
            }
        } else {
            $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
        }
        echo $options;
        break;

    case "getLevel":
        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if ($courseName <> "") {
            if (in_array($courseName, $courseLvl_9)) {
                $class_Level = '9';
            } elseif (in_array($courseName, $courseLvl_10)) {
                $class_Level = '10';
            } elseif (in_array($courseName, $courseLvl_11)) {
                $class_Level = '11';
            } elseif (in_array($courseName, $courseLvl_12)) {
                $class_Level = '12';
            }
        }
        echo $class_Level;
        break;

    case "getStudentsParent":
        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && trim($_POST['batchName']) <> "" && $courseCode <> "") {
            $url = trim($_POST['schoolUrl']) . '/api/students?access_token=' . trim($_POST['accessTocken']) . '&search[batch_course_code_equals]=' . $courseCode . '&search[batch_name_equals]=' . trim($_POST['batchName']);
            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $checkbox .= '<span  value="">' . utf8_encode($lang_AccessTokenError) . '</span>';
                } else {
                    for ($i = 0; $i < count($xmlinfo->student); $i++) {
                        $checkbox.='<div class="stdData">';
                        $checkbox.='<input  type="checkbox" class="chkClsStudent" onclick="removeError()" id="ckbStudent' . $i . '"  name="chkStudent[]" value="' . $xmlinfo->student[$i]->admission_no . '#' . $xmlinfo->student[$i]->student_name . '"></input>';
                        $checkbox.='<span class="student-name" value="' . $xmlinfo->student[$i]->student_name . '" >' . $xmlinfo->student[$i]->student_name . ' </span></div>';
                        if (($i + 1) % 3 == 0) {
                            $checkbox.='<br/>';
                        }
                    }
                }
            } else {
                $checkbox .= '<span  value="">' . utf8_encode($lang_noStudentErr) . '</span>';
            }
        } else {

            $checkbox .= '<span  value="">' . utf8_encode($lang_AccessTokenError) . '</span>';
        }
        echo $checkbox;
        break;

    case "getExamGroupsParent":
        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && trim($_POST['batchName']) <> "" && $courseCode <> "") {
            $url = trim($_POST['schoolUrl']) . '/api/exam_groups?access_token=' . trim($_POST['accessTocken']) . '&search[batch_course_code_equals]=' . $courseCode . '&search[batch_name_equals]=' . trim($_POST['batchName']);

            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
                } else {
                    $options .='<option value="">' . utf8_encode($lang_slctExamGrp) . '</option>';
                    for ($i = 0; $i < count($xmlinfo->exam_group); $i++) {
                        $options .= '<option value="' . $xmlinfo->exam_group[$i]->name . '">' . $xmlinfo->exam_group[$i]->name . '</option>';
                    }
                }
            } else {
                $options .='<option value="">' . utf8_encode($lang_noExam) . '</option>';
            }
        } else {
            $options .='<option value="">' . utf8_encode($lang_AccessTokenError) . '</option>';
        }
        echo $options;
        break;

    case "getSubjectParentSem1":

        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && trim($_POST['batchName']) <> "" && $courseCode <> "") {
            $url = trim($_POST['schoolUrl']) . '/api/subjects?access_token=' . trim($_POST['accessTocken']) . '&search[batch_name_equals]=' . trim($_POST['batchName']) . '&search[batch_course_code_equals]=' . $courseCode;

            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $checkboxSubject .= '<span  value="">' . utf8_encode($lang_AccessTokenError) . '</span>';
                } else {
                    for ($i = 0; $i < count($xmlinfo->subject); $i++) {
                        $checkboxSubject.='<div class="subjectData">';
                        $checkboxSubject.='<input  type="checkbox" class="ckbClsSubject ckbSubjSem1" onclick="removeError()" id="chkSubjectSem1' . $i . '"  name="chkSubjectSem1[]" value="' . $xmlinfo->subject[$i]->code . '#' . $xmlinfo->subject[$i]->name . '"></input>';
                        $checkboxSubject.='<span class="student-name" value="' . $xmlinfo->subject[$i]->name . '" >' . $xmlinfo->subject[$i]->name . ' </span></div>';
                    }
                }
            } else {

                $checkboxSubject .= '<span  value="">' . utf8_encode(lang_noSubjectErr) . '</span>';
            }
        } else {
            $checkboxSubject .= '<span  value="">' . utf8_encode($lang_AccessTokenError) . '</span>';
        }
        echo $checkboxSubject;
        break;

    case "getSubjectParentSem2":

        $courseCodeandName = trim($_POST['courseCodeandName']);
        $courseCodeandName = explode("#", $courseCodeandName);
        $courseCode = trim($courseCodeandName[0]);
        $courseName = trim($courseCodeandName[1]);
        if (trim($_POST['accessTocken']) <> "" && trim($_POST['schoolUrl']) <> "" && trim($_POST['batchName']) <> "" && $courseCode <> "") {
            $url = trim($_POST['schoolUrl']) . '/api/subjects?access_token=' . trim($_POST['accessTocken']) . '&search[batch_name_equals]=' . trim($_POST['batchName']) . '&search[batch_course_code_equals]=' . $courseCode;

            $xmlinfo = $FedenaObj->fedenaconnect($url);
            if (count($xmlinfo) > 0) {
                if (isset($xmlinfo->error->invalid_token_error)) {
                    $checkboxSubject .= '<span  value="">' . utf8_encode($lang_AccessTokenError) . '</span>';
                } else {
                    for ($i = 0; $i < count($xmlinfo->subject); $i++) {
                        $checkboxSubject.='<div class="subjectData">';
                        $checkboxSubject.='<input  type="checkbox" class="ckbClsSubject  ckbSubjSem2" onclick="removeError()" id="chkSubjectSem2' . $i . '"  name="chkSubjectSem2[]" value="' . $xmlinfo->subject[$i]->code . '#' . $xmlinfo->subject[$i]->name . '"></input>';
                        $checkboxSubject.='<span class="student-name" value="' . $xmlinfo->subject[$i]->name . '" >' . $xmlinfo->subject[$i]->name . ' </span></div>';
                    }
                }
            } else {

                $checkboxSubject .= '<span  value="">' . utf8_encode($lang_noStudentErr) . ' Found</span>';
            }
        } else {
            $checkboxSubject .= '<span  value="">' . utf8_encode($lang_AccessTokenError) . '</span>';
        }
        echo $checkboxSubject;
        break;
    case "getPedagogicArea":
        $selectedLevelVal = trim($_POST['selValLvl']);
        $checkboxSubject = "";
        $j = 1;
        $checkboxSubject.='<div class="form-text"><div class="numbers"><img src="images/5.png" /></div><div class="num-text">' . utf8_encode($lang_form5txtParent) . '</div>                   </div>
			<div  style="margin-bottom:15px;margin-left: 5px;" class="stuDetail">
				<input type="checkbox" id="ckbselctAllGrdVal" value="Select all" onclick="ckallcheckboxGrd();" ><strong>' . utf8_encode($lang_slctAllParent) . '</strong></input>
			</div>';
        if (($selectedLevelVal == 101) || ($selectedLevelVal == 102) || ($selectedLevelVal == 103) || ($selectedLevelVal == 104)) {
            if (count($zero_grade_title) > 0) {
                $checkboxSubject.='<div class="allData">';
                foreach ($zero_grade_title as $val) {
                    $value = utf8_encode($val);
                    $checkboxSubject.='<div class="stdDataLevel">';
                    $checkboxSubject.='<input  type="checkbox" class="chklevel ckbClsGrd" onclick="removeError()" name="chkLevels[]"  id="ckbGrdzero' . $j . '" value="' . $value . '"></input>';
                    $checkboxSubject.='<span class="level-name" >' . $value . '</span></div>';
                    $j++;
                }
                $checkboxSubject.='</div>';
            }
        } elseif ($selectedLevelVal == 1) {
            if (count($first_grade) > 0) {
                $checkboxSubject.='<div class="allData allDataDesign">';
                foreach ($first_grade as $key => $val) {
                    $title_key = utf8_encode($key);
                    $checkboxSubject.='<div class="main-title' . $j . '">';
                    $checkboxSubject.='<img src="images/plus_icon.png" class="show_hide' . $j . ' chnageImg" onclick="hideshowTitle(' . $j . ')" />';
                    $checkboxSubject.='<span class="level-name" ><strong>' . $title_key . '</strong></span>';
                    $checkboxSubject.='<div class="sub-title' . $j . ' sub_title_hide_show"  style="margin-left:25px">';
                    foreach ($first_grade[$FedenaObj->mb_convert($title_key)] as $k => $v) {
                        $sub_title_key = utf8_encode($k);
                        //check the depth of array
                        $depth = $FedenaObj->get_array_depth($first_grade[$FedenaObj->mb_convert($title_key)]);
                        if ($depth == 1) {
                            $checkboxSubject.='<input  type="checkbox" class="chklevel ckbClsGrd ckbslectUnslect' . $j . '"  name="chkLevels[]" id="ckbGrdone' . $j . '" value="' . $title_key . ">>" . $sub_title_key . '" onclick="removeError()"></input>';
                        }
                        $checkboxSubject.='<span class="level-name" >' . $sub_title_key . '</span>';
                        foreach ($first_grade[$FedenaObj->mb_convert($title_key)][$FedenaObj->mb_convert($sub_title_key)] as $k => $v) {
                            $checkboxSubject.='<div class="sec-sub-title" style="margin-left:22px">';
                            $sec_sub_title_key = utf8_encode($k);
                            if (is_array($v)) {
                                //check the depth of array
                                $depth = $FedenaObj->get_array_depth($first_grade[$FedenaObj->mb_convert($title_key)][$FedenaObj->mb_convert($sub_title_key)]);
                                if ($depth == 1) {
                                    $checkboxSubject.='<input  type="checkbox" class="chklevel ckbClsGrd ckbslectUnslect' . $j . '"  name="chkLevels[]" id="ckbGrdone' . $j . '" value="' . $title_key . ">>" . $sub_title_key . ">>" . $sec_sub_title_key . '"  onclick="removeError()"></input>';
                                }
                                $checkboxSubject.='<span class="level-name" >' . $sec_sub_title_key . '</span>';
                            }
                            $checkboxSubject.=' </div>';
                        }
                    }
                    $checkboxSubject.='</div>';
                    $checkboxSubject.='</div>';
                    //$checkboxSubject.='<div style="border:1px solid red" id="main_title"> test</div>';
                    $j++;
                }

                $checkboxSubject.='</div>';
            }
        } elseif ($selectedLevelVal == 2) {
            if (count($second_grade) > 0) {
                $checkboxSubject.='<div class="allData allDataDesign">';
                foreach ($second_grade as $key => $val) {
                    $title_key = utf8_encode($key);
                    $checkboxSubject.='<div class="main-title' . $j . '">';
                    $checkboxSubject.='<img src="images/plus_icon.png" class="show_hide' . $j . ' chnageImg" onclick="hideshowTitle(' . $j . ')" />';
                    $checkboxSubject.='<span class="level-name" ><strong>' . $title_key . '</strong></span>';
                    $checkboxSubject.='<div class="sub-title' . $j . ' sub_title_hide_show"  style="margin-left:25px">';
                    foreach ($second_grade[$FedenaObj->mb_convert($title_key)] as $k => $v) {
                        $sub_title_key = utf8_encode($k);
                        //check the depth of array
                        $depth = $FedenaObj->get_array_depth($second_grade[$FedenaObj->mb_convert($title_key)]);
                        if ($depth == 1) {
                            $checkboxSubject.='<input  type="checkbox" class="chklevel ckbClsGrd ckbslectUnslect' . $j . '"  name="chkLevels[]" id="ckbGrdone' . $j . '" value="' . $title_key . ">>" . $sub_title_key . '" onclick="removeError()" ></input>';
                        }
                        $checkboxSubject.='<span class="level-name" >' . $sub_title_key . '</span>';
                        foreach ($second_grade[$FedenaObj->mb_convert($title_key)][$FedenaObj->mb_convert($sub_title_key)] as $k => $v) {
                            $checkboxSubject.='<div class="sec-sub-title">';
                            $sec_sub_title_key = utf8_encode($k);
                            if (is_array($v)) {
                                $depth = $FedenaObj->get_array_depth($second_grade[$FedenaObj->mb_convert($title_key)][$FedenaObj->mb_convert($sub_title_key)]);
                                if ($depth == 1) {
                                    $checkboxSubject.='<input  type="checkbox" class="chklevel ckbClsGrd ckbslectUnslect' . $j . '"  name="chkLevels[]" id="ckbGrdone' . $j . '" value="' . $title_key . ">>" . $sub_title_key . ">>" . $sec_sub_title_key . '" onclick="removeError()"></input>';
                                }
                                $checkboxSubject.='<span class="level-name" >' . $sec_sub_title_key . '</span>';
                            }
                            $checkboxSubject.=' </div>';
                        }
                    }
                    $checkboxSubject.='</div>';
                    $checkboxSubject.='</div>';
                    $j++;
                }

                $checkboxSubject.='</div>';
            }
        } else {
            $checkboxSubject.='No Data Found';
        }
        $checkboxSubject.='<div class="form-error-stp5"></div>';
        echo $checkboxSubject;
        break;

    case "getPedagogicAreaVal":
        $selectedLevelVal = trim($_POST['selValLvl']);
        $chekedCkbVal = trim($_POST['chkbxVal']);
        $chekedCkbVal = explode("#", $chekedCkbVal);
        $checkboxSubject = "";
        $grd_zero_val = "";
        $grd_one_val = "";
        $grd_second_val = "";

        /** Shows select all checkbox at the top of page * */
        $checkboxSubject.='<div class="form-text"><div class="numbers"><img src="images/6.png" /></div><div class="num-text">' . utf8_encode($lang_form5txtParent) . '</div></div>
			<div  style="margin-bottom:15px;margin-left: 5px;" class="stuDetail">
				<input type="checkbox" id="ckbselctAllGrdValStep6" value="Select all" onclick="ckballcheckboxGrdStep6();" ><strong>' . utf8_encode($lang_slctAllParent) . '</strong></input>
			</div>';

        /** Step-6 for grade-0 * */
        if (($selectedLevelVal == 101) || ($selectedLevelVal == 102) || ($selectedLevelVal == 103) || ($selectedLevelVal == 104)) {
            if (count($zero_grade_title) > 0) {
                $checkboxSubject.='<div class="allData">';
                foreach ($chekedCkbVal as $key => $value) {
                    $chekedCkbVal = trim($value);

                    /** Step-6 for grade-0 main heading of table- subject name* */
                    $checkboxSubject.='<div class="maintblGrd0"><div class="subject-heading"><strong>' . $chekedCkbVal . '</strong></div>';

                    /** Step-6 for grade-0 content of subject name* */
                    foreach ($zero_grade[$FedenaObj->mb_convert($chekedCkbVal)] as $k => $v) {
                        $checkboxSubject.='<div class="mainouterdiv">
                                            <div class="contentGrd0">' . utf8_encode($v) . '</div>
                                                    <div class="ckGrd0"><input style="margin-left:35px;" class="ckbclsGrdStp6" type="checkbox" name="ckbGrade[]" value="' . $chekedCkbVal . '-' . utf8_encode($v) . '" onclick="removeError()"></div>
                                            </div>';
                    }
                    $checkboxSubject.='</div>';
                }
                $checkboxSubject.='</div>';
            }
        } elseif ($selectedLevelVal == 1) { /** Step-6 for grade-1 * */
            if (count($first_grade) > 0) {
                /** temporary variables to keep track of last heading * */
                $temp_lable_zero = '';
                $temp_lable_one = '';
                $checkboxSubject.='<div class="allData">';
                foreach ($chekedCkbVal as $key => $value) {
                    $chekedCkbVal = trim($value);
                    $grdOneIndexValue = explode(">>", $chekedCkbVal);
                    //echo $grdOneIndexValue[0];
                    //print"<pre>";print_r($grdOneIndexValue);
                    $checkboxSubject.='<div class="maintblGrd1">';
                    /** if array depth is > 2 for grade-1 * */
                    if (count($grdOneIndexValue) == 3) {
                        if ($temp_lable_zero != $grdOneIndexValue[0]) {
                            //prints main heading and subheading for grade-1
                            $checkboxSubject.='<div class="outerdivGrd03"><strong>' . $grdOneIndexValue[0] . '</strong></div>';
                            $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="subheading1Grd1"><strong>' . $grdOneIndexValue[1] . '</strong></div>
                                                <div class="ckGrd1"></div>
                                        </div>';
                        } elseif ($temp_lable_one != $grdOneIndexValue[1]) {
                            $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="subheading1Grd1"><strong>' . $grdOneIndexValue[1] . '</strong></div>
                                                <div class="ckGrd1"></div>
                                        </div>';
                        }
                        //prints subject heading for grade-1
                        $checkboxSubject.='<div class="mainouterdiv">
							<div class="subheadingGrd1"><strong>' . $grdOneIndexValue[2] . '</strong></div>
							<div class="ckGrd1"></div>
						</div>';
                    }

                    /** if array depth is 2 for grade-1 * */
                    if (count($grdOneIndexValue) == 2) {
                        //prints main heading and subheading for grade-1

                        if ($temp_lable_zero != $grdOneIndexValue[0]) {
                            $checkboxSubject.='<div class="outerdivGrd03"><strong>' . $grdOneIndexValue[0] . '</strong></div>';
                        }
                        $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="subheadingGrd1"><strong>' . $grdOneIndexValue[1] . '</strong></div>
                                                <div class="ckGrd1"></div>
                                        </div>';
                    }
                    //Prints content of subjects for grade-1
                    if (count($grdOneIndexValue) > 2) {
                        foreach ($first_grade[$FedenaObj->mb_convert($grdOneIndexValue[0])][$FedenaObj->mb_convert($grdOneIndexValue[1])][$FedenaObj->mb_convert($grdOneIndexValue[2])] as $k => $v) {
                            $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="contentGrd1">' . utf8_encode($v) . '</div>
                                                        <div class="ckGrd1"><input style="margin-left:35px;" type="checkbox" class="ckbclsGrdStp6" name="ckbGrade[]" value="' . $chekedCkbVal . '-' . utf8_encode($v) . '" onclick="removeError()"></div>
                                                </div>';
                        }
                    } else {
                        foreach ($first_grade[$FedenaObj->mb_convert($grdOneIndexValue[0])][$FedenaObj->mb_convert($grdOneIndexValue[1])] as $k => $v) {
                            $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="contentGrd1">' . utf8_encode($v) . '</div>
                                                        <div class="ckGrd1"><input style="margin-left:35px;" type="checkbox" class="ckbclsGrdStp6" name="ckbGrade[]" value="' . $chekedCkbVal . '-' . utf8_encode($v) . '" onclick="removeError()"></div>
                                                </div>';
                        }
                    }
                    $checkboxSubject.='</div>';
                    $temp_lable_zero = $grdOneIndexValue[0];
                    $temp_lable_one = $grdOneIndexValue[1];
                }
                $checkboxSubject.='</div>';
            }
            $checkboxSubject.='</div>';
        } elseif ($selectedLevelVal == 2) {    //step-6 for grade-2
            if (count($second_grade) > 0) {

                $checkboxSubject.='<div class="allData">';
                $temp_lable_zero = '';
                $temp_lable_one = '';
                foreach ($chekedCkbVal as $key => $value) {
                    $chekedCkbVal = trim($value);
                    $grdTwoIndexValue = explode(">>", $chekedCkbVal);
                    $checkboxSubject.='<div class="maintblGrd2">';
                    /** if array depth is > 2 for grade-2 * */
                    if (count($grdTwoIndexValue) == 3) {
                        //prints main heading and subheading for grade-2

                        if ($temp_lable_zero != $grdTwoIndexValue[0]) {
                            $checkboxSubject.='<div class="outerdivGrd03"><strong>' . $grdTwoIndexValue[0] . '</strong></div>';
                            $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="subheadingGrd2"><strong>' . $grdTwoIndexValue[1] . '</strong></div>
                                                <div class="ckGrd2"></div>
                                        </div>';
                        } elseif ($temp_lable_one != $grdTwoIndexValue[1]) {
                            $checkboxSubject.='<div class="mainouterdiv">
                                                    <div class="subheadingGrd2"><strong>' . $grdTwoIndexValue[1] . '</strong></div>
                                                    <div class="ckGrd2"></div>
                                    </div>';
                        }
                        //prints subject heading for grade-2
                        $checkboxSubject.='<div class="mainouterdiv">
                                            <div class="subheading2Grd2"><strong>' . $grdTwoIndexValue[2] . '</strong></div>
                                            <div class="ckGrd2"></div>
                                    </div>';
                    }
                    /** if array depth is 2 for grade-2 * */
                    if (count($grdTwoIndexValue) == 2) {
                        //prints main heading and subject heading for grade-2

                        if ($temp_lable_zero != $grdTwoIndexValue[0]) {
                            $checkboxSubject.='<div class="outerdivGrd03"><strong>' . $grdTwoIndexValue[0] . '</strong></div>';
                        }
                        $checkboxSubject.='<div class="mainouterdiv">
                                            <div class="subheadinglevel2"><strong>' . $grdTwoIndexValue[1] . '</strong></div>
                                            <div class="ckGrd2"></div>
                                    </div>';
                    }
                    // Prints content of subjects
                    if (count($grdTwoIndexValue) > 2) {
                        foreach ($second_grade[$FedenaObj->mb_convert($grdTwoIndexValue[0])][$FedenaObj->mb_convert($grdTwoIndexValue[1])][$FedenaObj->mb_convert($grdTwoIndexValue[2])] as $k => $v) {
                            $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="contentGrd2">' . utf8_encode($v) . '</div>
                                                        <div class="ckGrd2"><input style="margin-left:35px;" class="ckbclsGrdStp6" type="checkbox" name="ckbGrade[]" value="' . $chekedCkbVal . '-' . utf8_encode($v) . '" onclick="removeError()"></div>
                                                </div>';
                        }
                    } else {
                        foreach ($second_grade[$FedenaObj->mb_convert($grdTwoIndexValue[0])][$FedenaObj->mb_convert($grdTwoIndexValue[1])] as $k => $v) {
                            $checkboxSubject.='<div class="mainouterdiv">
                                                <div class="contentGrd1">' . utf8_encode($v) . '</div>
                                                        <div class="ckGrd2"><input style="margin-left:35px;" type="checkbox" class="ckbclsGrdStp6" name="ckbGrade[]" value="' . $chekedCkbVal . '-' . utf8_encode($v) . '" onclick="removeError()"></div>
                                               </div>';
                        }
                    }
                    $checkboxSubject.='</div>';
                    $temp_lable_zero = $grdTwoIndexValue[0];
                    $temp_lable_one = $grdTwoIndexValue[1];
                }
                $checkboxSubject.='</div>';
            }
        } else {
            $checkboxSubject.='No Data Found';
        }
        $checkboxSubject.='<div class="form-error-stp6"></div>';
        echo $checkboxSubject;
        break;
}
?>