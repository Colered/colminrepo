<?php
class Fedena_Data {
	public static $base_url = 'http://reporteminerd.colered.edu.do';
	private $sem1_ExamCounts;
    private $sem2_ExamCounts;
    private $langVar = array();
    public function __construct($varValArr = array()) {
        $this->langVar = $varValArr;
    }
    public function createCsv($subject_countsArr, $reportTitleArr, $totalWorkingDay, $exam_countArr) {
        $this->sem1_ExamCounts = $exam_countArr['sem1_ExamCounts'];
        $this->sem2_ExamCounts = $exam_countArr['sem2_ExamCounts'];
		if (isset($_POST['schoolUrl']) && (trim($_POST['schoolUrl']) != '') && trim($_POST['accsssToken']) != '') {
			$course = $_POST['courses'];
			$coursearrName = explode("#", $course);
			$course = $this->convert_to_utf8($coursearrName[0]);
			$sclURL = trim($_POST['schoolUrl']);
			$accToken = trim($_POST['accsssToken']);
			$centerName = (isset($_POST['centerName'])) ? $this->convert_to_utf8(trim($_POST['centerName'])) : '';
			$deirectionReasonal = (isset($_POST['regionalAdd'])) ? $this->convert_to_utf8(trim($_POST['regionalAdd'])) : '';
			$schShift = (isset($_POST['school_shift'])) ? $this->convert_to_utf8(trim($_POST['school_shift'])) : '';
			$schSector = (isset($_POST['school_sector'])) ? $this->convert_to_utf8(trim($_POST['school_sector'])) : '';
			$area = (isset($_POST['school_area'])) ? $this->convert_to_utf8(trim($_POST['school_area'])) : '';
			$distEdu = (isset($_POST['eduDist'])) ? $this->convert_to_utf8(trim($_POST['eduDist'])) : '';
			$codiCent = (isset($_POST['centerCode'])) ? $this->convert_to_utf8(trim($_POST['centerCode'])) : '';
			$school_year = (isset($_POST['school_year'])) ? $this->convert_to_utf8(trim($_POST['school_year'])) : '';
			$batchName = (isset($_POST['batchName'])) ? $this->convert_to_utf8($_POST['batchName']) : '';
			$sem1_subjectArr = (isset($_POST['s1s'])) ? $_POST['s1s'] : '';
			$sem2_subjectArr = (isset($_POST['s2s'])) ? $_POST['s2s'] : '';
			$sem1_examsArr = (isset($_POST['s1e'])) ? $_POST['s1e'] : '';
			$sem2_examsArr = (isset($_POST['s2e'])) ? $_POST['s2e'] : '';
			$batchStartDate = (isset($_POST['batchStartDate'])) ? $_POST['batchStartDate'] : '';
			$batchEndDate = (isset($_POST['batchEndDate'])) ? $_POST['batchEndDate'] : '';
			if (isset($_POST['class_level'])) {
				$class_level = trim($_POST['class_level']);
				$totalWorkingDay = $totalWorkingDay[$class_level];
			}
			// reform subjects snd exams arrays
			$sem1_subjectArrNew = $this->formingArray($sem1_subjectArr);
			$sem2_subjectArrNew = $this->formingArray($sem2_subjectArr);
			$sem1_examsArrNew = $this->formingArray($sem1_examsArr);
			$sem2_examsArrNew = $this->formingArray($sem2_examsArr);
			// end reform 
		} else {
			$_SESSION['errorMess'] = $this->langVar['lang_postErr'];
			header("Location:index.php");
			exit();
		}
        $txt1 = file_get_contents('report_header.xml');
        $txt1 = str_replace("_NAME_OF_CENTER_", $centerName, $txt1);
        $txt1 = str_replace("_REGIONAL_ADDRESS_", $deirectionReasonal, $txt1);
        $txt1 = str_replace("_EDUCATIONAL_DISTRICT_", $distEdu, $txt1);
        $txt1 = str_replace("_CENTER_CODE_", $codiCent, $txt1);
        $txt1 = str_replace("_SCHOOLYEAR_", $school_year, $txt1);
        $txt1 = str_replace("_REPORT_TITLE_", $reportTitleArr[$class_level], $txt1);
        $txt1 = str_replace("_SCH_SHIFT_", $schShift, $txt1);
        $txt1 = str_replace("_SCH_SECTOR_", $schSector, $txt1);
        $txt1 = str_replace("_AREA_", $area, $txt1);
        $subject_firstsem = '';
        $subject_secondsem = '';
        $examGroup = '';
        // get the subject count according selected level
        $subject_count_sem_1 = $subject_countsArr[$class_level . '_sem_1'];
        $subject_count_sem_2 = $subject_countsArr[$class_level . '_sem_2'];
        $sem1_countSubwidth = ($subject_count_sem_1 * 3) - 1;
        $sem2_countSubwidth = ($subject_count_sem_2 * 3) - 1;
        $sem1_indexVal = 4;
        $sem2_indexVal = $sem1_countSubwidth + $sem1_indexVal + 1;
        $imgindex = $sem1_countSubwidth + $sem1_indexVal - 1;
        $lastRow_indexVal = $sem2_indexVal + $sem2_countSubwidth + 1;
        $mainTitleIndex = $imgindex - 4;
        $subTitleIndex = $imgindex - 2;
        $cnt = 4;
        $verticalStartRow = "D17";
        $verticalEndRow = ($subject_count_sem_1 * 3) + ($subject_count_sem_2 * 3) + 5;
        foreach ($sem1_subjectArrNew as $i => $k) {
            if (trim($k) <> "") {
                $subject_name = explode("#", $k);
                $subject_firstsem .= '<Cell ss:Index="' . $cnt . '" ss:MergeAcross="2" ss:MergeDown="1" ss:StyleID="m56977252"><Data ss:Type="String">' . $subject_name[1] . '</Data></Cell>';
                $examGroup .= $this->addThreeColsForSubject();
                $cnt = $cnt + 3;
            }
        }
        $cnt = (count($sem1_subjectArrNew) * 3) + 4;
        foreach ($sem2_subjectArrNew as $i => $k) {
            if (trim($k) <> "") {
                $subject_name = explode("#", $k);
                $subject_secondsem .= '<Cell ss:Index="' . $cnt . '"  ss:MergeAcross="2" ss:MergeDown="1" ss:StyleID="m56977600"><Data ss:Type="String">' . $subject_name[1] . '</Data></Cell>';
                $examGroup .= $this->addThreeColsForSubject();
                $cnt = $cnt + 3;
            }
        }
        $examGroup .='<Cell ss:MergeDown="2" ss:StyleID="m56978088"><Data ss:Type="String">Reprobado</Data></Cell>
					   <Cell ss:MergeDown="2" ss:StyleID="m56978088"><Data ss:Type="String">Aprovado con Asig. Pend</Data></Cell>
					   <Cell ss:MergeDown="2" ss:StyleID="m56978088"><Data ss:Type="String">Aprovado</Data></Cell>';
        $txt1 = str_replace("_FIRSTSEMSUBJECTS_", $subject_firstsem, $txt1);
        $txt1 = str_replace("_SECONDSEMSUBJECTS_", $subject_secondsem, $txt1);
        $txt1 = str_replace("_SEM1_MERGESUBWIDTH_", $sem1_countSubwidth, $txt1);
        $txt1 = str_replace("_SEM2_MERGESUBWIDTH_", $sem2_countSubwidth, $txt1);
        $txt1 = str_replace("_SEM1_INDEXVAL_", $sem1_indexVal, $txt1);
        $txt1 = str_replace("_SEM2_INDEXVAL_", $sem2_indexVal, $txt1);
        $txt1 = str_replace("_LASTROW_INDEXVAL_", $lastRow_indexVal, $txt1);
        $txt1 = str_replace("_EXAM_GROUPS_", $examGroup, $txt1);
        $txt1 = str_replace("_MAIN_TITLE_INDEX_", $mainTitleIndex, $txt1);
        $txt1 = str_replace("_SUB_TITLE_INDEX_", $subTitleIndex, $txt1);
        $arrayValue = array("sclURL" => $sclURL, "accToken" => $accToken, "batch" => $batchName, "course" => $course, "totalWorkingDay" => $totalWorkingDay, "batchStartDate" => $batchStartDate, "batchEndDate" => $batchEndDate);
        $studentsArr = $this->getStudents($arrayValue);
        $marksArr = $this->getAllSubjectMarksByExamGroup($arrayValue, $sem1_examsArrNew, $sem2_examsArrNew);
		$marksRows = $this->getStudentMarksRow($studentsArr, $marksArr, $arrayValue, $sem1_subjectArrNew, $sem2_subjectArrNew, $sem1_examsArrNew, $sem2_examsArrNew);
        file_put_contents('report_content.xml', $marksRows);
        $txt1 .= "\n" . file_get_contents('report_content.xml');
        $txt1 .= "\n" . file_get_contents('report_footer.xml');
        $fp = fopen('student_report.xml', 'w');
        if (!$fp)
            die('Could not create / open xml file for writing.');
        if (fwrite($fp, $txt1) === false)
            die('Could not write to xml file.');
        //writing to second file now
        $detailExamGroups_sem1 = '<Cell ss:StyleID="s65"><Data ss:Type="String">1st Sem Subject</Data></Cell>';
        if ($this->sem1_ExamCounts == count($sem1_examsArrNew)) {
            $sem1_counts = count($sem1_examsArrNew) - 1;
        } else {
            $sem1_counts = count($sem1_examsArrNew);
        }
        for ($i = 0; $i < 5; $i++) {
            $detailExamGroups_sem1 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">' . $sem1_examsArrNew[$i] . '</Data></Cell>';
        }
        $detailExamGroups_sem1 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">Examen Completivo Primer Semestre</Data></Cell>';
        $detailExamGroups_sem1 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">Examen Extraordinario Primer Semestre</Data></Cell>';
        $detailExamGroups_sem1 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">Promedio 1st Sem</Data></Cell>
					<Cell ss:StyleID="s66"><Data ss:Type="String">70% Promedio 1st Sem</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">30 % 1st Sem Final Exam</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">50% Promedio 1st Sem</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">50% 1st Sem Completivo Exam</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">30% Promedio 1st Sem</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">70% 1st Sem  Extraordinario Exam</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">1st Sem Final Grade</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">1st Sem Completivo Grade</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">1st Sem Extraordinario Grade</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">Pendent Subject</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">Pending Class 1st Test</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">Pendent Subject</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">Pending Class 1st Test</Data></Cell>';
        $detailExamGroups_sem2 = '<Cell ss:StyleID="s65"><Data ss:Type="String">2nd Sem Subject</Data></Cell>';
        if ($this->sem2_ExamCounts == count($sem2_examsArrNew)) {
            $sem2_counts = count($sem2_examsArrNew) - 1;
        } else {
            $sem2_counts = count($sem2_examsArrNew);
        }
        for ($i = 0; $i < 5; $i++) {
            $detailExamGroups_sem2 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">' . $sem2_examsArrNew[$i] . '</Data></Cell>';
        }
        $detailExamGroups_sem2 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">Examen Completivo Segundo Semestre</Data></Cell>';
        $detailExamGroups_sem2 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">Examen Extraordinario Segundo Semestre</Data></Cell>';

        $detailExamGroups_sem2 .= '<Cell ss:StyleID="s65"><Data ss:Type="String">Promedio 2nd Sem</Data></Cell>
					<Cell ss:StyleID="s66"><Data ss:Type="String">70% Promedio 2nd Sem</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">30 % 2nd Sem Final Exam</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">50% Promedio 2nd Sem</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">50% 2nd Sem Completivo Exam</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">30% Promedio 2nd Sem</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">70% 2nd Sem  Extraordinario Exam</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">2nd Sem Final Grade</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">2nd Sem Completivo Grade</Data></Cell>
					<Cell ss:StyleID="s65"><Data ss:Type="String">2nd Sem Extraordinario Grade</Data></Cell>
					<Cell ss:StyleID="s68"><Data ss:Type="String">Pendent Subject</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">Pending Class 2nd Test</Data></Cell>
					<Cell ss:StyleID="s68"><Data ss:Type="String">Pendent Subject</Data></Cell>
					<Cell ss:StyleID="s67"><Data ss:Type="String">Pending Class 2nd Test</Data></Cell>';
        $marksRowsDetails = $this->getStudentMarksRowDetail($studentsArr, $marksArr, $arrayValue, $sem1_subjectArrNew, $sem2_subjectArrNew, $sem1_examsArrNew, $sem2_examsArrNew);
        $detail = file_get_contents('detail_header.xml');
        $detail = str_replace("_detailExamGroups_sem1_", $detailExamGroups_sem1, $detail);
        $detail = str_replace("_detailExamGroups_sem2_", $detailExamGroups_sem2, $detail);
        $detail = str_replace("_detailmarks_", $marksRowsDetails, $detail);
        $detail .= "\n" . file_get_contents('detail_secondsheetTemp.xml');
        $detail .= "\n" . file_get_contents('detail_footer.xml');
        $fp_detail = fopen('the_tool_to_generate_report.xml', 'w');
        if (!$fp_detail)
            die('Detail marks file could not create / open xml file for writing.');
        if (fwrite($fp_detail, $detail) === false)
            die('Could not write to detail xml file.');
        //convert the xml file to xlsx file
		require_once $_SERVER['DOCUMENT_ROOT']."/cidotnew/classes/PHPExcel.php";
		$inputFileName = $_SERVER['DOCUMENT_ROOT']."/cidotnew/student_report.xml";
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//code to insert the logo image
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('PHPExcel logo');
		$objDrawing->setDescription('PHPExcel logo');
		$objDrawing->setPath('./images/ministry-logo.png');
		$objDrawing->setHeight(115);
		$pos = PHPExcel_Cell::stringFromColumnIndex($imgindex);
		$endPosVertixalCell = PHPExcel_Cell::stringFromColumnIndex($verticalEndRow);
		$finalVerticalRows = $verticalStartRow . ':' . $endPosVertixalCell . '17';
		$objDrawing->setCoordinates($pos . '2');
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle($finalVerticalRows)->getAlignment()->setTextRotation(90);
		$objPHPExcel->getActiveSheet()->getStyle($finalVerticalRows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$objPHPExcel->getActiveSheet()->getStyle("B14:C14")->getBorders()->getTop()->setBorderStyle(true);
		$objPHPExcel->getActiveSheet()->getStyle("B14:B16")->getBorders()->getLeft()->setBorderStyle(true);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		//header("Content-Type: application/xlsx;");
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
		header('Set-Cookie: fileDownload=1; path=/');
		header("Content-Disposition: attachment;Filename=fedena-reports.xlsx");
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
    }

	/**
	 * function to get students list
	 * @return all the student list from the fedena api in a given course and batch.
	 */
    public function getStudents($arrayValue) {
        $url = $arrayValue['sclURL'] . '/api/students?access_token=' . $arrayValue['accToken'] . '&search[batch_course_code_equals]=' . $arrayValue['course'] . '&search[batch_name_equals]=' . $arrayValue['batch'];
        $xmlinfo = $this->fedenaconnect($url);
        if (count($xmlinfo->student) == 0) {
            $_SESSION['errorMess'] = $this->langVar['lang_noStudentErr'] . ' ' . $arrayValue['batch'];
            header("Location:index.php");
            exit();
        }
        return $xmlinfo;
    }
	/**
	 * function to get students rows and their marks in ministry report
	 */
    public function getStudentMarksRow($studentsArr, $marks, $arrayValue, $sem1_subjectArr, $sem2_subjectArr, $sem1_examsArr, $sem2_examsArr) {
        try {
            $marksRows = '';
            $srno = 0;
            foreach ($studentsArr->student as $srow) {
                $srno++;
                $indexdatavar = "";
                if ($srno == 1) {
                    $indexdatavar = "ss:Index='20'";
                }
                $marksRows .= '<Row ' . $indexdatavar . ' ><Cell ss:Index="2" ss:StyleID="s153"><Data ss:Type="Number" x:Ticked="1">' . $srno . '</Data></Cell>
                                        <Cell ss:StyleID="s777"><Data ss:Type="String">' . $srow->student_name . '('.$srow->admission_no.')</Data></Cell>';
                $arrayValue['admission_no'] = trim($srow->admission_no);
                //writing marks for first sem
                $marksRows .= $this->getAvgMarks($marks, $sem1_subjectArr, $sem1_examsArr, $arrayValue);
                //writing marks for second sem
                $marksRows .= $this->getAvgMarks($marks, $sem2_subjectArr, $sem2_examsArr, $arrayValue);
                // get final results 3 columns
                $marksRows .= $this->getFinalStatus($marks, $sem1_subjectArr, $sem2_subjectArr, $sem1_examsArr, $sem2_examsArr, $arrayValue);
                $marksRows .= '</Row>';
            }// end of foreach loop
            if (empty($marksRows)) {
                throw new Exception($this->langVar['lang_noMraksErr']);
            }
            return $marksRows;
        } catch (Exception $e) {
            $_SESSION['errorMess'] = $e->getMessage();
            header("Location:index.php");
            exit();
        }
    }
	/**
	 * function to get students rows and their marks in verification detail xml file
	 * write the retrieved data into xml file.
	 */
    public function getStudentMarksRowDetail($studentsArr, $marks, $arrayValue, $sem1_subjectArr, $sem2_subjectArr, $sem1_examsArr, $sem2_examsArr) {
		try {
            $marksRows = '';
            $secondSheetData = '<Row ss:AutoFitHeight="0" ss:Height="123.75">
                                            <Cell ss:StyleID="s72"/>
                                            <Cell />
                                            <Cell ss:StyleID="s65"><Data ss:Type="String">Reprovado</Data></Cell>
                                            <Cell ss:StyleID="s65"><Data ss:Type="String">Aprovado con Asig Pend</Data></Cell>
                                            <Cell ss:StyleID="s65"><Data ss:Type="String">Aprovado</Data></Cell>
                               </Row>';
            foreach ($studentsArr->student as $srow) {
                $arrayValue['admission_no'] = trim($srow->admission_no);
                $sem1_subject_count = count($sem1_subjectArr);
                $sem2_subject_count = count($sem2_subjectArr);
                $sem_subject_count = max($sem1_subject_count, $sem2_subject_count);
                $blank_cell_for_pendent = '<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>
                                            <Cell ss:StyleID="s71"><Data ss:Type="Number"></Data></Cell>
                                            <Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>
                                            <Cell ss:StyleID="s71"><Data ss:Type="Number"></Data></Cell>';
                // get final results 2 columns
                $marksRowsPendent_sem1 = $this->getPendingTestStatusDetail($arrayValue, $sem1_examsArr);
                // get final results 2 columns
                $marksRowsPendent_sem2 = $this->getPendingTestStatusDetail($arrayValue, $sem2_examsArr);
                for ($i = 0; $i < $sem_subject_count; $i++) {
                    $marksRows .= '<Row ss:AutoFitHeight="0"><Cell ss:StyleID="s70"/><Cell ss:StyleID="s777"><Data ss:Type="String">' . $srow->student_name . '('.$srow->admission_no.')</Data></Cell>';
                    //for first sem subject
                    $sem1_splitArr = $sem1_subjectArr[$i];
                    $sem1_splitArr = explode("#", $sem1_splitArr);
                    $subject_code_sem1 = trim($sem1_splitArr[0]);
                    $subject_name = trim($sem1_splitArr[1]);
                    $marksRows .= $this->getMarksDetail($marks, $subject_code_sem1, $subject_name, $sem1_examsArr, $arrayValue);
                    if ($i == 0) {
                        $marksRows .= $marksRowsPendent_sem1;
                    } else {
                        $marksRows .= $blank_cell_for_pendent;
                    }
                    //for second sem subject
                    $sem2_splitArr = $sem2_subjectArr[$i];
                    $sem2_splitArr = explode("#", $sem2_splitArr);
                    $subject_code_sem2 = trim($sem2_splitArr[0]);
                    $subject_name = trim($sem2_splitArr[1]);
                    $marksRows .= $this->getMarksDetail($marks, $subject_code_sem2, $subject_name, $sem2_examsArr, $arrayValue);
                    if ($i == 0) {
                        $marksRows .= $marksRowsPendent_sem2;
                    } else {
                        $marksRows .= $blank_cell_for_pendent;
                    }
                    $marksRows .= '</Row>';
                }
                // get final results 3 columns
                $secondSheetData .= '<Row ss:AutoFitHeight="0">
                                        <Cell ss:StyleID="s73"/>
                                        <Cell ss:StyleID="s777"><Data ss:Type="String">' . $srow->student_name . '</Data></Cell>';
                $secondSheetData .= $this->getFinalStatusDetail($arrayValue, $marks, $sem1_subjectArr, $sem2_subjectArr, $sem1_examsArr, $sem2_examsArr);
                $secondSheetData .= '</Row>';
            }
            $fhandle = fopen('detail_secondsheet.xml', 'r');
            $sec_sheetstring = fread($fhandle, filesize('detail_secondsheet.xml'));
            $sec_sheet = str_replace("_finalResultforDetailSheet_", $secondSheetData, $sec_sheetstring);
            file_put_contents('detail_secondsheetTemp.xml', $sec_sheet);
            fclose($fhandle);
            if (empty($marksRows)) {
                throw new Exception($this->langVar['lang_noMraksErr']);
            }
            return $marksRows;
        } catch (Exception $e) {
            $_SESSION['errorMess'] = $e->getMessage();
            header("Location:index.php");
            exit();
        }
    }

    /**
	 * function to get the exam marks array for both the semister
	 * @return marks array for all the user selected exams .
	 */
    public function getAllSubjectMarksByExamGroup($arrayValue, $examsArr_sem1, $examsArr_sem2) {
	    $markArr = array();
        // exam score for sem1
        if ($this->sem1_ExamCounts == count($examsArr_sem1)) {
            $sem1_counts = count($examsArr_sem1) - 1;
        } else {
            $sem1_counts = count($examsArr_sem1);
        }
        if ($this->sem2_ExamCounts == count($examsArr_sem2)) {
            $sem2_counts = count($examsArr_sem2) - 1;
        } else {
            $sem2_counts = count($examsArr_sem2);
        }
        // exam score for sem1
        for ($z = 0; $z < $sem1_counts; $z++) {
            $exam_name = $examsArr_sem1[$z];
            if ($exam_name <> "") {
                $socreArr = $this->getExamScoreGroup($arrayValue, $exam_name);
                for ($i = 0; $i < count($socreArr->exam_score); $i++) {
                    $rollNo = trim($socreArr->exam_score[$i]->student);
                    for ($j = 0; $j < count($socreArr->exam_score); $j++) {
                        if ($rollNo == trim($socreArr->exam_score[$j]->student)) {
                              $examGrp = trim($socreArr->exam_score[$j]->exam_group);
                              $subject = trim($socreArr->exam_score[$j]->subject);
                              $markArr[$rollNo][$examGrp][$subject] = $socreArr->exam_score[$j]->marks;
                        }
                    }
                }
            }
        }
		// exam score for sem2
        for ($z = 0; $z < $sem2_counts; $z++) {
            $exam_name = $examsArr_sem2[$z];
            if ($exam_name <> "") {
                $socreArr = $this->getExamScoreGroup($arrayValue, $exam_name);
                for ($i = 0; $i < count($socreArr->exam_score); $i++) {
                    $rollNo = trim($socreArr->exam_score[$i]->student);
                    for ($j = 0; $j < count($socreArr->exam_score); $j++) {
                        if ($rollNo == trim($socreArr->exam_score[$j]->student)) {
                            $examGrp = trim($socreArr->exam_score[$j]->exam_group);
                            $subject = trim($socreArr->exam_score[$j]->subject);
                            $markArr[$rollNo][$examGrp][$subject] = $socreArr->exam_score[$j]->marks;
                        }
                    }
                }
            }
        }
		return $markArr;
    }

    /**
	 * function to get final result status of the main ministry report xlsx sheet
	 * @return a final column for the xml sheet with grade status.
	 */
    public function getFinalStatus($marks, $sem1_subjectArr, $sem2_subjectArr, $examsArr_sem1, $examsArr_sem2, $arrayValue)
    {
        $datarow = '';
        $reprobado_flag = '';
        $aprovado_asig_pend_flag = '';
        $aprovado_flag = '';
        $absent = $this->getAttendance($arrayValue);
		// check for fail in cuurent year
		$failCnt_current = 0;
		$failCnt_current = $this->getFailCount($marks, $sem1_subjectArr, $examsArr_sem1, $arrayValue, $failCnt_current);
		$failCnt_current = $this->getFailCount($marks, $sem2_subjectArr, $examsArr_sem2, $arrayValue, $failCnt_current);

		//check for fail in prior year
		$pass_in_sem1 = 1;
		$pass_in_sem1 = $this->getFailCountPriorYear($arrayValue, $examsArr_sem1[7]);

		$pass_in_sem2 = 1;
		$pass_in_sem2 = $this->getFailCountPriorYear($arrayValue, $examsArr_sem2[7]);

		if ($absent > 20 || $failCnt_current > 2 || (($pass_in_sem1 == 0) && ($pass_in_sem2 == 0))) {
			$reprobado_flag = 'X';
		} else if ($absent <= 20 && (($pass_in_sem1 == 1) || ($pass_in_sem2 == 1)) && ($failCnt_current == 1 || $failCnt_current == 2)) {
			$aprovado_asig_pend_flag = 'X';
		} else if ($absent <= 20 && (($pass_in_sem1 == 1) || ($pass_in_sem2 == 1)) && ($failCnt_current == 0)) {
			$aprovado_flag = 'X';
		}

        $datarow .= '<Cell ss:StyleID="s154"><Data ss:Type="String">' . $reprobado_flag . '</Data></Cell>
                <Cell ss:StyleID="s161"><Data ss:Type="String">' . $aprovado_asig_pend_flag . '</Data></Cell>
                <Cell ss:StyleID="s162"><Data ss:Type="String">' . $aprovado_flag . '</Data></Cell>';
        return $datarow;
    }
	/**
     *@return count of the fail in pendent exam group
     */
    public function getFailCountPriorYear($arrayValue, $pendent_exam)
	{
	    $pass_status = 1;
		if ($pendent_exam != '') {
			$xmlprimary_pendent = $this->getExamScoreGroup($arrayValue, $pendent_exam, false);
			for ($i = 0; $i < count($xmlprimary_pendent->exam_score); $i++) {
				if ((trim($xmlprimary_pendent->exam_score[$i]->marks) < 70) && (trim($xmlprimary_pendent->exam_score[$i]->marks) != '')) {
					$pass_status = 0;
				}
			}
		}
		return $pass_status;
    }

    /**
     *@return count of the fail in a current year semister
     */
	public function getFailCount($marks, $subjectArr, $examsArr, $arrayValue, $failCntpre)
	{
		$failCnt = $failCntpre;
		foreach ($subjectArr as $i => $k) {
			$subject_code = explode("#", $k);
			$subject_code = trim($subject_code[0]);
			if ($subject_code <> "") {
				$passed_currYear = 0;
				$passed_currYear = $this->checkPassFailCurrentYear($marks, $subject_code, $examsArr, $arrayValue);
				if ($failCnt > 2) {
					break;
				} elseif (($passed_currYear > 0) && ($passed_currYear < 70)) {
					$failCnt++;
				}
			}
		}
		return $failCnt;
	}

	/**
	 * function to get final result status of the detail xml sheet for the marks varification
	 * @return a final column for the xml sheet with grade status.
	 */
    public function getFinalStatusDetail($arrayValue, $marks, $sem1_subjectArr, $sem2_subjectArr, $examsArr_sem1, $examsArr_sem2)
    {
        $datarow = '';
        $reprobado_flag = '';
        $aprovado_asig_pend_flag = '';
        $aprovado_flag = '';
        $absent = $this->getAttendance($arrayValue);
        // check for fail in cuurent year
		$failCnt_current = 0;
		$failCnt_current = $this->getFailCount($marks, $sem1_subjectArr, $examsArr_sem1, $arrayValue, $failCnt_current);
		$failCnt_current = $this->getFailCount($marks, $sem2_subjectArr, $examsArr_sem2, $arrayValue, $failCnt_current);
		//check for fail in prior year
		$pass_in_sem1 = 1;
		$pass_in_sem1 = $this->getFailCountPriorYear($arrayValue, $examsArr_sem1[7]);

		$pass_in_sem2 = 1;
		$pass_in_sem2 = $this->getFailCountPriorYear($arrayValue, $examsArr_sem2[7]);

		if ($absent > 20 || $failCnt_current > 2 || (($pass_in_sem1 == 0) && ($pass_in_sem2 == 0))) {
			$reprobado_flag = 'X';
		} else if ($absent <= 20 && (($pass_in_sem1 == 1) || ($pass_in_sem2 == 1)) && ($failCnt_current == 1 || $failCnt_current == 2)) {
			$aprovado_asig_pend_flag = 'X';
		} else if ($absent <= 20 && (($pass_in_sem1 == 1) || ($pass_in_sem2 == 1)) && ($failCnt_current == 0)) {
			$aprovado_flag = 'X';
		}

        $datarow .= '<Cell ss:StyleID="s73"><Data ss:Type="String">' . $reprobado_flag . '</Data></Cell>
					<Cell ss:StyleID="s71"><Data ss:Type="String">' . $aprovado_asig_pend_flag . '</Data></Cell>
					<Cell ss:StyleID="s71"><Data ss:Type="String">' . $aprovado_flag . '</Data></Cell>';
        return $datarow;
    }

	/**
	 * function to get pendent exams marks and add a column for pendent subjects and marks
	 */
    public function getPendingTestStatusDetail($arrayValue, $examsArr) {
        $datarow = '';
        if ($examsArr[7] != '') {
            $xml_pendent = $this->getExamScoreGroup($arrayValue, $examsArr[7], false);
            if (count($xml_pendent->exam_score) > 0) {
                for ($i = 0; $i < count($xml_pendent->exam_score); $i++) {
                    if ($i < 2) {
                        $datarow .= '<Cell ss:StyleID="s71"><Data ss:Type="String">' . $xml_pendent->exam_score[$i]->subject . '</Data></Cell>
								 <Cell ss:StyleID="s71"><Data ss:Type="Number">' . $xml_pendent->exam_score[$i]->marks . '</Data></Cell>';
                    }
                }
            } else {
                $datarow .= '<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>
						<Cell ss:StyleID="s71"><Data ss:Type="Number"></Data></Cell>';
                $datarow .= '<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>
						<Cell ss:StyleID="s71"><Data ss:Type="Number"></Data></Cell>';
            }
        }else{
		 		$datarow .= '<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>
						<Cell ss:StyleID="s71"><Data ss:Type="Number"></Data></Cell>';
                $datarow .= '<Cell ss:StyleID="s71"><Data ss:Type="String"></Data></Cell>
						<Cell ss:StyleID="s71"><Data ss:Type="Number"></Data></Cell>';
		}
        return $datarow;
    }

	/**
	 * function to check final, completivo and extraordinary exams marks
	 * @return calculated percent of the mark in a exam.
	 */
    public function checkPassFailCurrentYear($marks, $subject_code, $examsArr, $arrayValue) {
        $totalPrimaryMarks = 0;
		$examsArr=$this->formingArrayTrim($examsArr);
		$arrayValue['admission_no']= trim($arrayValue['admission_no']);
        //calculate average
		$avgValCount = 0;
		if ($marks[$arrayValue['admission_no']][$examsArr[0]][$subject_code] <> "") {
			$avgValCount++;
		}
		if ($marks[$arrayValue['admission_no']][$examsArr[1]][$subject_code] <> "") {
			$avgValCount++;
		}
		if ($marks[$arrayValue['admission_no']][$examsArr[2]][$subject_code] <> "") {
			$avgValCount++;
		}
		if ($marks[$arrayValue['admission_no']][$examsArr[3]][$subject_code] <> "") {
			$avgValCount++;
		}
        if($avgValCount==0){
           $avgValCount = 1;
        }
        $avgPrimaryMarks = ($marks[$arrayValue['admission_no']][$examsArr[0]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[1]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[2]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[3]][$subject_code]) / $avgValCount;
        //Calculate total marks for Primary Examination
        $avgPrimary = $avgPrimaryMarks * 0.7;
        $ExamenFifth = $marks[$arrayValue['admission_no']][$examsArr[4]][$subject_code] * 0.3;
        $totalPrimaryMarks = $avgPrimary + $ExamenFifth;

        $ExamMraksSixth = $marks[$arrayValue['admission_no']][$examsArr[5]][$subject_code];
        if ($totalPrimaryMarks < 70 && $ExamMraksSixth<>"") {
            //Calculate totalCompletivo marks for Primary Examination
            $avgPrimary = $avgPrimaryMarks * 0.5;
            $ExamMraksSixth = $ExamMraksSixth * 0.5;
            $totalPrimaryMarks = $avgPrimary + $ExamMraksSixth;

            $ExamMraksseventh = $marks[$arrayValue['admission_no']][$examsArr[6]][$subject_code];
            if ($totalPrimaryMarks < 70 && $ExamMraksseventh<>"") {
                //Calculate total Extraordinario marks for Primary Examination
                $avgPrimary = $avgPrimaryMarks * 0.3;
                $ExamMraksseventh = $ExamMraksseventh * 0.7;
                $totalPrimaryMarks = $avgPrimary + $ExamMraksseventh;
            }
        }
        return $totalPrimaryMarks;
    }
    /**
	 * function to get student final score in a subject
	 * on the given average alogorith.
	 */
    public function getAvgMarks($marks, $subjectArr, $examsArr, $arrayValue) {
	    $examsArr=$this->formingArrayTrim($examsArr);
		$arrayValue['admission_no']=trim($arrayValue['admission_no']);
        $datarow = '';
        foreach ($subjectArr as $i => $k) {
            $subject_code = explode("#", $k);
            $subject_code = trim($subject_code[0]);
            if ($subject_code <> "") {
                $totalPrimaryMarks = 0;
                $totalCompPrimaryMarks = 0;
                $totalExtraPrimaryMarks = 0;
                //calculate average
                $avgValCount = 0;
                if ($marks[$arrayValue['admission_no']][$examsArr[0]][$subject_code] <> "") {
                    $avgValCount++;
                }
                if ($marks[$arrayValue['admission_no']][$examsArr[1]][$subject_code] <> "") {
                    $avgValCount++;
                }
                if ($marks[$arrayValue['admission_no']][$examsArr[2]][$subject_code] <> "") {
                    $avgValCount++;
                }
                if ($marks[$arrayValue['admission_no']][$examsArr[3]][$subject_code] <> "") {
                    $avgValCount++;
                }
                if($avgValCount==0){
				   $avgValCount = 1;
                }
                $avgPrimaryMarks = ($marks[$arrayValue['admission_no']][$examsArr[0]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[1]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[2]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[3]][$subject_code]) / $avgValCount;
                //Calculate total marks for Primary Examination
                $avgPrimary = $avgPrimaryMarks * 0.7;
                $ExamenFifth = $marks[$arrayValue['admission_no']][$examsArr[4]][$subject_code];
                $ExamenFifth = $ExamenFifth * 0.3;
                $totalPrimaryMarks = $avgPrimary + $ExamenFifth;
                $ExamMraksSixth = $marks[$arrayValue['admission_no']][$examsArr[5]][$subject_code];
                if ($totalPrimaryMarks < 70 && $ExamMraksSixth <> "") {
                    //Calculate totalCompletivo marks for Primary Examination
                    $avgPrimary = $avgPrimaryMarks * 0.5;
                    $ExamMraksSixth = $ExamMraksSixth * 0.5;
                    $totalCompPrimaryMarks = $avgPrimary + $ExamMraksSixth;
                    $ExamMraksseventh = $marks[$arrayValue['admission_no']][$examsArr[6]][$subject_code];
                    if ($totalCompPrimaryMarks < 70 && $ExamMraksseventh <> "") {
                        //Calculate total Extraordinario marks for Primary Examination
                        $avgPrimary = $avgPrimaryMarks * 0.3;
                        $ExamMraksseventh = $ExamMraksseventh * 0.7;
                        $totalExtraPrimaryMarks = $ExamMraksseventh + $avgPrimary;
                    }
                } else {
                    //$errorMess = $this->langVar['lang_mrkLess70PerCompErr1'].' '.$arrayValue['admission_no'].' '. $this->langVar['lang_mrkLess70PerCompErr2'];
                    //$_SESSION['errorMess'] = $errorMess;
                    //header("Location:index.php");
                    //exit();
                }
                $datarow .= '<Cell ss:StyleID="s156"><Data ss:Type="Number">' . round($totalPrimaryMarks) . '</Data></Cell>
							 <Cell ss:StyleID="s157"><Data ss:Type="Number">' . round($totalCompPrimaryMarks) . '</Data></Cell>
							 <Cell ss:StyleID="s158"><Data ss:Type="Number">' . round($totalExtraPrimaryMarks) . '</Data></Cell>';
            }
        }
        return $datarow;
    }
	/**
	 * function to get student detail score in a subject.
	 * @retun detailed specification on the marks in a particular subject.
	 */
    public function getMarksDetail($marks, $subject_code, $subject_name, $examsArr, $arrayValue) {
	    
        $datarow = '';
		$examsArr=$this->formingArrayTrim($examsArr);
        if ($subject_code <> "") {
				$avgValCount = 0;
				if ($marks[$arrayValue['admission_no']][$examsArr[0]][$subject_code] <> "") {
					$avgValCount++;
				}
				if ($marks[$arrayValue['admission_no']][$examsArr[1]][$subject_code] <> "") {
					$avgValCount++;
				}
				if ($marks[$arrayValue['admission_no']][$examsArr[2]][$subject_code] <> "") {
					$avgValCount++;
				}
				if ($marks[$arrayValue['admission_no']][$examsArr[3]][$subject_code] <> "") {
					$avgValCount++;
				}
				if($avgValCount==0){
					$avgValCount = 1;
				}
				$initial_four_exam_avg = ($marks[$arrayValue['admission_no']][$examsArr[0]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[1]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[2]][$subject_code] + $marks[$arrayValue['admission_no']][$examsArr[3]][$subject_code]) / $avgValCount;
				$promedio = $initial_four_exam_avg;
				$promedio_70_percent = $initial_four_exam_avg * (0.7);
				$final_exam_30_percent = $marks[$arrayValue['admission_no']][$examsArr[4]][$subject_code] * (0.3);
				$final_grade = $promedio_70_percent + $final_exam_30_percent;
				if ($final_grade < 70 && $examsArr['5']!="") {
					$completivo_exam = $marks[$arrayValue['admission_no']][$examsArr[5]][$subject_code];
					$promedio_50_percent = $initial_four_exam_avg * (0.5);
					$completivo_exam_50_percent = $completivo_exam * (0.5);
					$completivo_grade = $promedio_50_percent + $completivo_exam_50_percent;
				} else {
					$completivo_exam = '';
					$promedio_50_percent = '';
					$completivo_exam_50_percent = '';
					$extraordinario_exam = '';
					$completivo_grade = '';
					$extraordinario_grade = '';
				}
				if ($completivo_grade < 70 && $completivo_grade > 0 && $examsArr['6']!="") {
					$extraordinario_exam = $marks[$arrayValue['admission_no']][$examsArr[6]][$subject_code];
					$promedio_30_percent = $initial_four_exam_avg * (0.3);
					$extraordinario_exam_70_percent = $extraordinario_exam * (0.7);
					$extraordinario_grade = $promedio_30_percent + $extraordinario_exam_70_percent;
				} else {
					$extraordinario_exam = '';
					$promedio_30_percent = '';
					$extraordinario_exam_70_percent = '';
					$extraordinario_grade = '';
				}
				$datarow .= '<Cell ss:StyleID="s777"><Data ss:Type="String">' . $subject_name . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . $marks[$arrayValue['admission_no']][$examsArr[0]][$subject_code] . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . $marks[$arrayValue['admission_no']][$examsArr[1]][$subject_code] . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . $marks[$arrayValue['admission_no']][$examsArr[2]][$subject_code] . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . $marks[$arrayValue['admission_no']][$examsArr[3]][$subject_code] . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . $marks[$arrayValue['admission_no']][$examsArr[4]][$subject_code] . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($completivo_exam,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($extraordinario_exam,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($promedio,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($promedio_70_percent,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($final_exam_30_percent,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($promedio_50_percent,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($completivo_exam_50_percent,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($promedio_30_percent,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($extraordinario_exam_70_percent,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($final_grade,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($completivo_grade,2) . '</Data></Cell>
							<Cell ss:StyleID="s71"><Data ss:Type="Number">' . round($extraordinario_grade,2) . '</Data></Cell>';
        }
        return $datarow;
    }
	/**
	 * @retun the marks for a given exam group.
	 * This method is used for both pendent and regular exams.
	 */
    public function getExamScoreGroup($arrayValue, $gpName, $show_error = true)
    {
    	if (!$show_error) {
		 	$url_score = $arrayValue['sclURL'] . '/api/exam_scores?access_token=' . $arrayValue['accToken'] . '&search[exam_exam_group_name_equals]=' . $gpName . '&search[exam_exam_group_batch_name_equals]=' . $arrayValue['batch'] . '&search[exam_exam_group_batch_course_code_equals]=' . $arrayValue['course'] . '&search[student_admission_no_equals]=' . $arrayValue['admission_no'];
		 '<br>';
		} else {
	     	$url_score = $arrayValue['sclURL'] . '/api/exam_scores?access_token=' . $arrayValue['accToken'] . '&search[exam_exam_group_name_equals]=' . $gpName . '&search[exam_exam_group_batch_name_equals]=' . $arrayValue['batch'] . '&search[exam_exam_group_batch_course_code_equals]=' . $arrayValue['course'];
		  '<br>';
		}
		$xmlinfo_score1 = $this->fedenaconnect($url_score);
		if ($show_error) {
			if (count($xmlinfo_score1->exam_score) == 0) {
				//$_SESSION['errorMess'] = $this->langVar['lang_noExamErr'] . ' ' . $gpName;
				//header("Location:index.php");
				//exit();
			}
			return $xmlinfo_score1;
		} else {
			if (count($xmlinfo_score1->exam_score) == 0) {
				return '';
			}
			return $xmlinfo_score1;
		}

    }
    /**
     * This method add 3 columns below to every choosed subject in report
     */
    public function addThreeColsForSubject()
    {
          $examName = '';
		  $examName ='<Cell ss:MergeDown="2" ss:StyleID="m56978088"><Data ss:Type="String">Final</Data></Cell>
					 <Cell ss:MergeDown="2" ss:StyleID="m56978088"><Data ss:Type="String">Completivo</Data></Cell>
					 <Cell ss:MergeDown="2" ss:StyleID="m56978088"><Data ss:Type="String">Extraordinario</Data></Cell>';
         return $examName;
    }

	/**
	 * @return the absent percent in a batch duration
	 */
	public function getAttendance($arrayValue) {
		  $absent = 0;
		  if ($arrayValue['batchStartDate'] <> "" && $arrayValue['batchEndDate'] <> "") {
			  $url_atten = $arrayValue['sclURL'] . '/api/attendances?access_token=' . $arrayValue['accToken'] . '&search[batch_name_equals]=' . $arrayValue['batch'] . '&search[month_date_gt]=' . $arrayValue['batchStartDate'] . '&search[month_date_lt]=' . $arrayValue['batchEndDate'] . '&search[student_admission_no_equals]=' . $arrayValue['admission_no'];
			  $xmlinfo_atten = $this->fedenaconnect($url_atten);
			  if (count($xmlinfo_atten->attendance) > 0) {
				  $absentAtten = count($xmlinfo_atten->attendance);
			  }
			  //calculate  the absent of student in percentage
			  if($arrayValue['totalWorkingDay'] > 0) {
				 $absent = ($absentAtten * 100) / $arrayValue['totalWorkingDay'];
			  }
		  }
		  return $absent;
	}
    /**
     * To forming  in array from post data
     * and replace the blank values and convert special character in utf8
     */
	public function formingArrayTrim($dataArr)
	{
	    $newArr = array();
		foreach ($dataArr as $key => $val) {
			if (trim($val) <> "") {
				$newArr[] = trim($val);
			}
		}
		return $newArr;

	}
	public function formingArray($dataArr)
	{
	    $newArr = array();
		foreach ($dataArr as $key => $val) {
			if ($val <> "") {
				$newArr[] = $this->convert_to_utf8($val);
			}
		}
		return $newArr;

	}
	/**
	 * CURL for Fedena API access
	 */
    public function fedenaconnect($service_url, $method = 'GET')
    {
        try {

            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/xml;charset=UTF-8'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_ENCODING, 1);
            if ($method == "POST")
                curl_setopt($curl, CURLOPT_POST, true);
            else if ($method == "PUT")
                curl_setopt($curl, CURLOPT_PUT, true);
            $data = curl_exec($curl);
            $dataArr = array();
            if (substr($data, 0, 5) == "<?xml") {
                $dataArr = new SimpleXMLElement($data);
            }
            if (isset($dataArr['error']) && trim($dataArr['error']) != '') {
                $_SESSION['errorMess'] = 'Error :: ' . $dataArr['status'] . ' ' . $dataArr['message'];
                header("Location:index.php");
                exit();
            }
            curl_close($curl);

            return $dataArr;
        } catch (Exception $e) {
            $_SESSION['errorMess'] = $this->langVar['lang_apiErr'];
            header("Location:index.php");
            exit();
        }
    }
	/**
     * find the max depth of a multidimention array
     */
	public function get_array_depth($arr, $n = 0) {
		$max = $n;
		foreach ($arr as $item) {
			if (is_array($item)) {
				$max = max($max, $this->get_array_depth($item, $n + 1));
			}
		}
		return $max;
	}
    /**
     * conver special charter in its equivalent utf8
     */
    public function convert_to_utf8($text) {
	    $map = array(
	        chr(0x8A) => chr(0xA9),
	        chr(0x8C) => chr(0xA6),
	        chr(0x8D) => chr(0xAB),
	        chr(0x8E) => chr(0xAE),
	        chr(0x8F) => chr(0xAC),
	        chr(0x9C) => chr(0xB6),
	        chr(0x9D) => chr(0xBB),
	        chr(0xA1) => chr(0xB7),
	        chr(0xA5) => chr(0xA1),
	        chr(0xBC) => chr(0xA5),
	        chr(0x9F) => chr(0xBC),
	        chr(0xB9) => chr(0xB1),
	        chr(0x9A) => chr(0xB9),
	        chr(0xBE) => chr(0xB5),
	        chr(0x9E) => chr(0xBE),
	        chr(0x80) => '&euro;',
	        chr(0x82) => '&sbquo;',
	        chr(0x84) => '&bdquo;',
	        chr(0x85) => '&hellip;',
	        chr(0x86) => '&dagger;',
	        chr(0x87) => '&Dagger;',
	        chr(0x89) => '&permil;',
	        chr(0x8B) => '&lsaquo;',
	        chr(0x91) => '&lsquo;',
	        chr(0x92) => '&rsquo;',
	        chr(0x93) => '&ldquo;',
	        chr(0x94) => '&rdquo;',
	        chr(0x95) => '&bull;',
	        chr(0x96) => '&ndash;',
	        chr(0x97) => '&mdash;',
	        chr(0x99) => '&trade;',
	        chr(0x9B) => '&rsquo;',
	        chr(0xA6) => '&brvbar;',
	        chr(0xA9) => '&copy;',
	        chr(0xAB) => '&laquo;',
	        chr(0xAE) => '&reg;',
	        chr(0xB1) => '&plusmn;',
	        chr(0xB5) => '&micro;',
	        chr(0xB6) => '&para;',
	        chr(0xB7) => '&middot;',
	        chr(0xBB) => '&raquo;',
	    );
	    return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8');
	}
      public function mb_convert($str){
       return mb_convert_encoding(trim($str),"iso-8859-1","utf-8");
    }

}
