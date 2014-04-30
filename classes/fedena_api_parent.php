<?php

class Fedena_Parent_Data extends Fedena_Data {

    private $langVar = array();

    public function __construct($varValArr = array()) {
        $this->langVar = $varValArr;
    }

    /**
     * funtion to create monthly report
     */
    public function createReport() {
        if (isset($_POST['schoolUrl']) && (trim($_POST['schoolUrl']) != '') && trim($_POST['accsssToken']) != '') {
            $course = trim($_POST['courses']);
            $course = explode("#", $course);
            $courseCode = trim($this->convert_to_utf8($course[0]));
            $courseName = trim($this->convert_to_utf8($course[1]));
            $sclUrl = trim($_POST['schoolUrl']);
            $accToken = trim($_POST['accsssToken']);
            $datefrom = trim($_POST['from']);
            $datefrom = date("Y-m-d", strtotime($datefrom));
            $dateto = trim($_POST['to']);
            $dateto = date("Y-m-d", strtotime($dateto));
            $class_level = (isset($_POST['class_level'])) ? trim($_POST['class_level']) : '';
            foreach ($this->langVar['allLevelsParent'] as $k => $v) {
                if ($class_level == $v) {
                    $class = $k;
                }
            }
            $batchName = (isset($_POST['batchName'])) ? trim($this->convert_to_utf8($_POST['batchName'])) : '';
            $studentArr = (isset($_POST['chkStudent'])) ? $_POST['chkStudent'] : '';
            $sem1_examsArr = (isset($_POST['s1e'])) ? $_POST['s1e'] : '';
            $sem2_examsArr = (isset($_POST['s2e'])) ? $_POST['s2e'] : '';
            $subArrSem1 = (isset($_POST['chkSubjectSem1'])) ? $_POST['chkSubjectSem1'] : '';
            $subArrSem2 = (isset($_POST['chkSubjectSem2'])) ? $_POST['chkSubjectSem2'] : '';
            $sem1_subArrNew = $this->formingArray($subArrSem1);
            $sem2_subArrNew = $this->formingArray($subArrSem2);
            $studentArrNew = $this->formingArray($studentArr);
            $sem1_examsArrNew = $this->formingArray($sem1_examsArr);
            $sem2_examsArrNew = $this->formingArray($sem2_examsArr);
        }
        //calculate the max length of subjects for both semester
        $max_sub_length = $this->get_max_length($sem1_subArrNew, $sem2_subArrNew);
        $max_sub_length = $max_sub_length * 4.5;
        $widthExamGrp = (750 - $max_sub_length) / 9;
        $arrayValue = array("sclUrl" => $sclUrl, "accToken" => $accToken, "batch" => $batchName, "course" => $courseCode, "dateFrom" => $datefrom, "dateTo" => $dateto);
        $absent = array();
        $studentGenArr = array();
        for ($i = 0; $i < count($studentArrNew); $i++) {
            $studentValue = explode("#", $studentArrNew[$i]);
            $studentRollNo = trim($studentValue[0]);
            $absentVal = $this->getAttendence($arrayValue, $studentRollNo);
            $absent[] = count($absentVal->attendance);

            $studentInfoArr = $this->getStudentInfo($arrayValue, $studentRollNo);
            $studentGenArr[$studentRollNo]['gender'] = $studentInfoArr->student->gender;
        }
        $school = $this->getSchool($arrayValue);
        $school = $school->school->institute_name;
        $marksArr_sem1 = $this->getSubjectMarksByExamGrp($arrayValue, $sem1_examsArrNew);
        $marksArr_sem2 = $this->getSubjectMarksByExamGrp($arrayValue, $sem2_examsArrNew);
        if (empty($marksArr_sem1) && empty($marksArr_sem2)) {
            $_SESSION['errorMess'] = $this->langVar['lang_noMraksErr'];
            header("Location:index.php");
            exit();
        }
        $result = $this->get_web_page($sclUrl);
        if ($result['errno'] != 0) {
            $_SESSION['errorMess'] = $this->langVar['lang_badLogoUrlErr'];
            header("Location:parent.php");
            exit();
        }
        if ($result['http_code'] != 200) {
            $_SESSION['errorMess'] = $this->langVar['lang_noServiceErr'];
            header("Location:parent.php");
            exit();
        }
        $current = $result['content'];
        $doc = new DomDocument();
        $doc->loadHTML($current);
        $div = $doc->getElementById('top_logo');
        $logo_url = $sclUrl . $div->getElementsByTagName('img')->item(0)->getAttribute('src');
        $finalHTM = '';
        $finalHTM .=$this->header_html();
        for ($i = 0; $i < count($studentArrNew); $i++) {
            $studentValue = explode("#", $studentArrNew[$i]);
            $studentRollNo = trim($studentValue[0]);
            $studentName = trim($studentValue[1]);
            $colspanDynamic_sem1 = 8 - count($sem1_examsArrNew);
            $colspanDynamic_sem1 = count($sem1_examsArrNew) + $colspanDynamic_sem1 + 1;
            $colspanDynamic_sem2 = 8 - count($sem2_examsArrNew);
            $colspanDynamic_sem2 = count($sem2_examsArrNew) + $colspanDynamic_sem2 + 1;
            $studentGender = $studentGenArr[$studentRollNo]['gender'];
            $student_pic = ($studentGender == 'm') ? "male.jpg" : "female.jpg";
            $student_pic_url = parent::$base_url . '/images/' . $student_pic;
            $finalHTM .=$this->body_html($school, $studentName, $courseName, $logo_url, $student_pic_url, $class);
            $finalHTM .='<tr><td colspan="3" align="center">&nbsp;</td></tr>
						   <tr>
							 <td colspan="3" align="center">
							 <table width="750" border="1" cellpadding="0" cellspacing="0" bgcolor="#5B9BD5">
							   <tr bgcolor="#FFFFFF">
								 <td rowspan="2" align="center" width="' . $max_sub_length . '"><strong>' . $this->langVar['lang_subjParent'] . '</strong></td>
								 <td colspan="' . $colspanDynamic_sem1 . '" align="center"><strong>' . $this->langVar['lang_fstSemParent'] . '</strong></td>
							   </tr>';
            $finalHTM .= $this->getSubjectsExamsMarksRow($sem1_examsArrNew, $sem1_subArrNew, $marksArr_sem1, $studentRollNo, $class_level, $max_sub_length, $widthExamGrp);
            //get second sem data row
            $finalHTM .= '</table><table width="750" border="1" cellpadding="0" cellspacing="0" bgcolor="#5B9BD5">
							 <tr bgcolor="#FFFFFF">
							   <td rowspan="2" align="center" width="' . $max_sub_length . '"><strong>' . $this->langVar['lang_subjParent'] . '</strong></td>
							   <td colspan="' . $colspanDynamic_sem2 . '" align="center"><strong>' . $this->langVar['lang_secSemParent'] . '</strong></td>
							 </tr>';
            $finalHTM .= $this->getSubjectsExamsMarksRow($sem2_examsArrNew, $sem2_subArrNew, $marksArr_sem2, $studentRollNo, $class_level, $max_sub_length, $widthExamGrp);
            $finalHTM.='</table></td></tr>';
            $finalHTM.=$this->footer_html($absent[$i], $i, count($studentArrNew));
        }
        $finalHTM .='</body></html>';
        echo $finalHTM;
        header("Content-type: application/vnd.ms-word ");
        header('Set-Cookie: fileDownloadParent=1; path=/');
        header("Content-Disposition: attachment;Filename=parent_report.doc;");
    }

    /**
     * function to create report for the grade lower than three
     */
    public function createReportKinder() {

        if (isset($_POST['schoolUrl']) && (trim($_POST['schoolUrl']) != '') && trim($_POST['accsssToken']) != '') {
            $course = trim($_POST['courses']);
            $course = explode("#", $course);
            $courseCode = trim($this->convert_to_utf8($course[0]));
            $courseName = trim($this->convert_to_utf8($course[1]));
            $sclUrl = trim($_POST['schoolUrl']);
            $accToken = trim($_POST['accsssToken']);
            $datefrom = trim($_POST['from']);
            $datefrom = date("Y-m-d", strtotime($datefrom));
            $dateto = trim($_POST['to']);
            $dateto = date("Y-m-d", strtotime($dateto));
            $class_level = (isset($_POST['class_level'])) ? trim($_POST['class_level']) : '';
            foreach ($this->langVar['allLevelsParent'] as $k => $v) {
                if ($class_level == $v) {
                    $class = $k;
                }
            }
            $batchName = (isset($_POST['batchName'])) ? trim($this->convert_to_utf8($_POST['batchName'])) : '';
            $studentArr = (isset($_POST['chkStudent'])) ? $_POST['chkStudent'] : '';
            $studentArrNew = $this->formingArray($studentArr);
            $slectedGrdCkb = (isset($_POST['chkLevels'])) ? $_POST['chkLevels'] : '';
            $slectedGrdCkbArr = $this->formingArray($slectedGrdCkb);
            $slectedGrdCkbstp6Val = (isset($_POST['ckbGrade'])) ? $_POST['ckbGrade'] : '';
            $slectedGrdCkbstp6ValArr = $this->formingArray($slectedGrdCkbstp6Val);
        }
        //calculate the max length of subjects for both semester
        $arrayValue = array("sclUrl" => $sclUrl, "accToken" => $accToken, "batch" => $batchName, "course" => $courseCode, "dateFrom" => $datefrom, "dateTo" => $dateto);
        $absent = array();
        $studentGenArr = array();
        for ($i = 0; $i < count($studentArrNew); $i++) {
            $studentValue = explode("#", $studentArrNew[$i]);
            $studentRollNo = trim($studentValue[0]);
            $absentVal = $this->getAttendence($arrayValue, $studentRollNo);
            $absent[] = count($absentVal->attendance);
            $studentInfoArr = $this->getStudentInfo($arrayValue, $studentRollNo);
            $studentGenArr[$studentRollNo]['gender'] = $studentInfoArr->student->gender;
        }
        $school = $this->getSchool($arrayValue);
        $school = $school->school->institute_name;
        $result = $this->get_web_page($sclUrl);
        if ($result['errno'] != 0) {
            $_SESSION['errorMess'] = $this->langVar['lang_badLogoUrlErr'];
            header("Location:parent.php");
            exit();
        }
        if ($result['http_code'] != 200) {
            $_SESSION['errorMess'] = $this->langVar['lang_noServiceErr'];
            header("Location:parent.php");
            exit();
        }
        $current = $result['content'];
        $doc = new DomDocument();
        $doc->loadHTML($current);
        $div = $doc->getElementById('top_logo');
        $logo_url = $sclUrl . $div->getElementsByTagName('img')->item(0)->getAttribute('src');
        $finalHTM = '';
        $finalHTM .=$this->header_html();
        for ($i = 0; $i < count($studentArrNew); $i++) {
            $studentValue = explode("#", $studentArrNew[$i]);
            $studentRollNo = trim($studentValue[0]);
            $studentName = trim($studentValue[1]);
            $studentGender = $studentGenArr[$studentRollNo]['gender'];
            $student_pic = ($studentGender == 'm') ? "male.jpg" : "female.jpg";
            $student_pic_url = parent::$base_url . '/images/' . $student_pic;
            // main outer table start
            $finalHTM.='<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">';
            // top html
            $finalHTM .=$this->body_html_kinder($school, $studentName, $courseName, $logo_url, $student_pic_url, $slectedGrdCkbArr, $slectedGrdCkbstp6ValArr, $class);
            //footer
            $finalHTM.=$this->footer_html_kinder($absent[$i]);
            // end outer main table
            $finalHTM.='</table>';
            $finalHTM.='<br clear=all style="mso-special-character:line-break;page-break-before:always">';
        }
        $finalHTM .='</body></html>';
        echo $finalHTM;
        header("Content-type: application/vnd.ms-word ");
        header('Set-Cookie: fileDownloadParent=1; path=/');
        header("Content-Disposition: attachment;Filename=parent_report.doc;");
    }

    /**
     * header html
     */
    public function header_html() {
        $header = '<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">
	            <meta http-equiv=Content-Type content="text/html;charset=UTF-8"><meta name=ProgId content=Excel.Sheet><meta name=Generator content="Microsoft Excel 12">
				<head>				
				<style>
						body {
						font-family:Tahoma,Arial,Helvetica,Sans-Serif;
						font-size: 0.6em;
						font-style:normal;
						font-weight:normal;
						}
						.rowclass{
						font-size:12px;
						padding-left:5px;
						}
						.contentclass{
						font-size:12px;
						padding-left:35px;
						}
						.contentclass1{
						font-size:12px;
						padding-left:5px;
						}
						.text1{
						text-align:center;
						font-size:16px;
						}
						.text2{
						text-align:center;
						font-size:14px;
						}
						.text3{
						font-size:14px;
						padding-left:5px;
						}
						.text-heading{
						font-size:14px;
						padding-left:16px;
						}						
						.title_text{
						margin-right:10px;
						}
						<!--<xml>
						 <w:WordDocument>
						  <w:View>Print</w:View>
						  <w:DoNotHyphenateCaps/>
						  <w:PunctuationKerning/>
						  <w:DrawingGridHorizontalSpacing>9.35 pt</w:DrawingGridHorizontalSpacing>
						  <w:DrawingGridVerticalSpacing>9.35 pt</w:DrawingGridVerticalSpacing>
						 </w:WordDocument>
						</xml><![endif]-->
				</style>
				</head>
				<body>';
        return $header;
    }

    /**
     * footer html for monthly report less than grade 3
     */
    public function footer_html_kinder($absent) {
        $footer = ' <tr><td colspan="3" align="center">&nbsp;</td></tr>
			<tr>
			  <td colspan="3" align="center">
				  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td align="left" valign="bottom"><table width="250" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #5B9BD5;">
					<tr>
					  <td class="text3" height="40" align="center" bgcolor="#D9D9D9"><strong>' . $this->langVar['lang_teachComntParent'] . '</strong></td>
					</tr>
				  </table></td>
				  <td align="center" valign="top"><table width="250" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#5B9BD5">
					<tr>
					  <td class="text3" height="30" width="100" align="center" bgcolor="#D9D9D9"><strong>' . $this->langVar['lang_absncParent'] . '</strong></td>
					  <td align="center" bgcolor="#FFFFFF">' . $absent . '</td>
					</tr>
				  </table></td>
				</tr>
			  </table></td>
			</tr>
			<tr>
			  <td colspan="3" align="center">
				<table width="700" height="95" border="1" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #5B9BD5;">
				  <tr>
					<td class="rowclass" bgcolor="#FFFFFF" align="center" height="95" valign="top" style="text-align:left">&nbsp;</td>
				  </tr>
				</table>
			  </td>
			</tr>';
        return $footer;
    }

    /**
     * footer html for monthly report more than grade 3
     */
    public function footer_html($absent, $i, $stuCnt) {
        $footer = '<tr><td colspan="3" align="center">&nbsp;</td></tr>
			<tr>
			  <td colspan="3" align="center">
				  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td align="left" valign="bottom"><table width="250" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #5B9BD5;">
					<tr>
					  <td height="40" align="center" bgcolor="#D9D9D9"><strong>' . $this->langVar['lang_teachComntParent'] . '</strong></td>
					</tr>
				  </table></td>
				  <td align="center" valign="top"><table width="250" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#5B9BD5">
					<tr>
					  <td height="30" width="100" align="center" bgcolor="#D9D9D9"><strong>' . $this->langVar['lang_absncParent'] . '</strong></td>
					  <td align="center" bgcolor="#FFFFFF">' . $absent . '</td>
					</tr>
				  </table></td>
				</tr>
			  </table></td>
			</tr>
			<tr>
			  <td colspan="3" align="center">
				<table width="750" height="95" border="1" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #5B9BD5;">
				  <tr>
					<td align="center" height="95" valign="top" style="text-align:left">&nbsp;</td>
				  </tr>
				</table>
				  <tr>
			  <td colspan="3" >&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="3" >&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="3" align="center">
				<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td align="left" valign="top"><table width="250" border="0" cellspacing="0" cellpadding="0">
				 <tr>
					<td colspan="3">&nbsp;</td>
				 </tr>
				  <tr>
					<td height="40" align="center" style="border-top: solid 1px black;"><strong>' . $this->langVar['lang_signofDirector'] . '</strong></td>
				  </tr>
				</table></td>
				<td align="center" valign="top"><table width="250" border="0"  cellpadding="0" cellspacing="0" >
				  <tr>
					<td colspan="3">&nbsp;</td>
				  </tr>
				  <tr>
					<td height="40" align="center" style="border-top: solid 1px black;"><strong>' . $this->langVar['lang_teachSignParent'] . '</strong></td>
				  </tr>
				</table></td>
			  </tr>
			</table></td>
		  </tr>
		 </td>
		  </tr>
		</table>';
        if ($i != ($stuCnt - 1))
            $footer.='<br clear=all style="mso-special-character:line-break;page-break-before:always">';

        return $footer;
    }

    /**
     * body html for monthly report to more than 3 grade
     */
    public function body_html($school, $studentName, $courseName, $logo_url, $student_pic, $class_level) {
        $body_html = '<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td>
				  <table width="150" height="110" border="1" align="left" cellpadding="0" cellspacing="0">
				  <tr>
					<td align="center"><img id="logo-img" src="' . $logo_url . '" width="150" height="110"></td>
					</tr>
				  </table>
				  </td>
				  <td align="left"><table width="250" height="110" border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#5B9BD5">
					<tr>
					  <td colspan="4" align="center" bgcolor="#D9D9D9"><strong>' . $school . '</strong> </td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td rowspan="4" align="center"><img id="logo-img" src="' . $student_pic . '" width="100" height="60"/></td>
					  <td align="center"><strong>' . $this->langVar['lang_nameParent'] . '</strong></td>
					  <td colspan="2" align="center">' . $studentName . '</td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center"><strong>' . $this->langVar['lang_courseParent'] . '</strong></td>
					  <td colspan="2" align="center">' . $courseName . '</td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center"><strong>' . $this->langVar['lang_levelParent'] . '</strong></td>
					  <td colspan="2" align="center">' . $class_level . '</td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center"><strong>' . $this->langVar['lang_dateRange'] . '</strong></td>
					  <td colspan="2" align="center">&nbsp;</td>
					</tr>
				  </table></td>
				  <td><table width="250"  height="110" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#5B9BD5">
					<tr>
					  <td colspan="2" align="center" bgcolor="#D9D9D9"><strong>' . $this->langVar['lang_reprtGrdParent'] . ' </strong></td>
					  <td align="center" bgcolor="#D9D9D9"><strong>' . $this->langVar['lang_acadmcStsParent'] . '</strong> </td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center">A</td>
					  <td align="center">90-100%</td>
					  <td rowspan="4" align="center" style="width:200;white-space: pre-wrap;">&nbsp;</td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center">B</td>
					  <td align="center">80-89%</td>
					  </tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center">C</td>
					  <td align="center">70-79%</td>
					  </tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center">D</td>
					  <td align="center">60-69%</td>
					  </tr>
				  </table></td>
				</tr>';
        return $body_html;
    }

    /**
     * body html for monthly report to less than 3 grade
     */
    public function body_html_kinder($school, $studentName, $courseName, $logo_url, $student_pic, $slectedGrdCkbArr, $slectedGrdCkbstp6ValArr, $class_level) {
        $icon_pic_url = parent::$base_url . '/images/';

        // Making a new array which will concatenate all the contents together with same subject name -- start
        $newarray = array();
        $k = 0;
        foreach ($slectedGrdCkbstp6ValArr as $key => $value) {
            $titles = explode("-", $value);
            if (!in_array($titles[0], $newarray)) {
                $newarray[$k]['title'] = $titles[0];
            }
            if (!in_array($titles[0], $newarray)) {
                $newarray[$k]['checkdata'] = $titles[1];
            }
            $k++;
        }
        $result = array();
        foreach ($newarray as $value) {
            if (!isset($result[$value['title']])) {
                $result[$value['title']] = array('title' => $value['title'], 'checkdata' => array());
            }
            $result[$value['title']]['checkdata'][] = $value['checkdata'];
        }
        // Making a new array which will concatenate all the contents together with same subject name -- end
        $body_html = "";
        // prints the header of the report
        $body_html.='<tr>
				  <td>
				  <table width="150" height="110" border="1" align="left" bordercolor="#5B9BD5" cellpadding="0" cellspacing="0">
				  	<tr><td align="center"><img id="logo-img" src="' . $logo_url . '" width="150" height="110"></td></tr>
				  </table>
				  </td>
				  <td align="left">
				  	<table width="250" height="110" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#5B9BD5">
						<tr><td class="text3" colspan="4" align="center" bgcolor="#D9D9D9"><strong>' . $school . '</strong> </td></tr>
						<tr bgcolor="#FFFFFF">
						  <td rowspan="4" align="center"><img id="logo-img" src="' . $student_pic . '" width="100" height="60"/></td>
						  <td align="left" class="text3"><strong>' . $this->langVar['lang_nameParent'] . '</strong></td>
						  <td colspan="2" align="left" class="rowclass">' . $studentName . '</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						  <td align="left" class="text3"><strong>' . $this->langVar['lang_courseParent'] . '</strong></td>
						  <td colspan="2" align="left" class="rowclass">' . $courseName . '</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						  <td align="left" class="text3"><strong>' . $this->langVar['lang_levelParent'] . '</strong></td>
						  <td colspan="2" align="left" class="rowclass">' . $class_level . '</td>
						</tr>
						<tr bgcolor="#FFFFFF">
						  <td align="left" class="text3"><strong>' . $this->langVar['lang_dateRange'] . '</strong></td>
						  <td colspan="2" align="left" class="rowclass">&nbsp;</td>
						</tr>
				    </table>
				  </td>
				  <td>
				   <table width="215"  height="110" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#5B9BD5">
					<tr>
					  <td class="text3" colspan="2" align="center" bgcolor="#D9D9D9"><strong>' . $this->langVar['lang_reprtGrdParent'] . ' </strong></td>
					  <td class="text3" align="center" bgcolor="#D9D9D9"><strong>' . utf8_encode($this->langVar['lang_acadmcStsParent']) . '</strong> </td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center"><img src="' . $icon_pic_url . 'right.png" width="30" height="30"/></td>
					  <td align="left" class="rowclass">' . $this->langVar['lang_achieved'] . '</td>
					  <td rowspan="3" align="left" class="rowclass" style="width:200;white-space: pre-wrap;">&nbsp;</td>
					</tr>
					<tr bgcolor="#FFFFFF">
					  <td align="center"><img src="' . $icon_pic_url . 'equals.png" width="30" height="30"/></td>
					  <td align="left" class="rowclass">' . $this->langVar['lang_processing'] . '</td>
					  </tr>
					 
					<tr bgcolor="#FFFFFF">
					  <td align="center"><img src="' . $icon_pic_url . 'wrong.png" width="30" height="30"/></td>
					  <td align="left" class="rowclass">' . $this->langVar['lang_nomade'] . '</td>
					</tr>
				  </table></td>
				</tr>
				<tr>
				<td colspan="3" align="center">&nbsp;</td>
			  </tr>';
        //Prints the main content of the report
        $temp_var_for_title = '';
        $top_title = '';
        foreach ($result as $key => $value) {
            $title_arr = explode(">>", $value['title']);
            $body_html.='<tr>
				<td colspan="3" align="center"><table width="700" border="1" bordercolor="#5B9BD5" cellpadding="0" cellspacing="0">';
            if ($top_title != 1) {
                $body_html.='<tr bgcolor="#FFFFFF">
				<td width="550" rowspan="2" align="center" colspan="7" class="text2"><strong>Indicadores de processo</strong></td>
				<td width="150" colspan="3" align="center" class="text2">Periodos</td>
			   </tr>
			   <tr bgcolor="#FFFFFF" class="text2">
					<td width="50" align="center"><strong>1era</strong></td>
					<td width="50" align="center"><strong>2era</strong></td>
					<td width="50" align="center"><strong>3era</strong></td>			   
			   </tr>';
            }
            if ($temp_var_for_title_zero != $title_arr[0]) {
                $body_html.='
				<tr>
					<td colspan="7" bgcolor="#ffffff" class="text1"><strong><span class="title_text">' . $title_arr[0] . '</span></strong></td>
					<td class="rowclass" width="50" align="left">&nbsp;</td>
					<td class="rowclass" width="50" align="left">&nbsp;</td>
					<td class="rowclass" width="50" align="left">&nbsp;</td>
				</tr>';
            }
            $cnt_tile = count($title_arr);
            for ($i = 1; $i < $cnt_tile; $i++) {
                if ($temp_var_for_title_one != $title_arr[$i]) {
                    if ($i == 1) {
                        $body_html.='<tr bgcolor="#CDD3D8">
							  <td colspan="7" class="text3"><strong>' . $title_arr[$i] . '</strong>
							  </td>
							  <td class="rowclass" width="50" align="left">&nbsp;</td>
								<td class="rowclass" width="50" align="left">&nbsp;</td>
								<td class="rowclass" width="50" align="left">&nbsp;</td>
							  </tr>';
                    } else {
                        $body_html.='<tr bgcolor="#CDD3D8" class="text3">
							  <td colspan="7" class="text-heading">' . $title_arr[$i] . '
							  </td>
							  <td class="rowclass" width="50" align="left">&nbsp;</td>
								<td class="rowclass" width="50" align="left">&nbsp;</td>
								<td class="rowclass" width="50" align="left">&nbsp;</td>
							  </tr>';
                    }
                }
            }
            if ($class_level >= 1) {
                $class = 'class="contentclass"';
            } else {
                $class = 'class="contentclass1"';
            }
            foreach ($value['checkdata'] as $key => $val) {
                $body_html.='
				  <tr bgcolor="#ffffff">
					<td ' . $class . ' width="550" align="left" colspan="7">' . $val . '</td>
					<td class="rowclass" width="50" align="left">&nbsp;</td>
					<td class="rowclass" width="50" align="left">&nbsp;</td>
					<td class="rowclass" width="50" align="left">&nbsp;</td>					
				  </tr>';
            }
            $temp_var_for_title_zero = $title_arr[0];
            $temp_var_for_title_one = $title_arr[1];
            $top_title = 1;

            $body_html.='</table></td></tr>';
        }
        return $body_html;
    }

    /**
     * function to get subjects exams and their marks
     */
    public function getSubjectsExamsMarksRow($examsArrNew, $subArrNew, $marksArr, $studentRollNo, $class_level, $max_sub_length, $widthExamGrp) {
        $txtRows = '';
        $txtRows.='<tr bgcolor="#FFFFFF">';
        for ($j = 0; $j < count($examsArrNew); $j++) {
            $examGrpSem1 = trim($examsArrNew[$j]);
            if (count($examsArrNew) < 4) {
                $txtRows .= '<td align="center" width="' . $widthExamGrp . '" style="font-size:7px!important; max-width="' . $widthExamGrp . '""><b>' . $examGrpSem1 . '</b></td>';
            } else {
                $txtRows .= '<td align="center" width="' . $widthExamGrp . '" style="font-size:7px!important; max-width="' . $widthExamGrp . '""><b>' . substr($examGrpSem1, 0, 15) . '</b></td>';
            }
        }
        for ($i = 1; $i <= (8 - count($examsArrNew)); $i++) {
            $txtRows .= '<td width="' . $widthExamGrp . '"></td>';
        }
        $txtRows .= '<td align="center" width="' . $widthExamGrp . '" style="font-size:7px!important; max-width="' . $widthExamGrp . '""><b>' . $this->langVar['lang_marksAvg'] . '</b></td>';
        $txtRows.='</tr>';
        $txtRows.='<tr bgcolor="#ffffff"></tr>';
        for ($k = 0; $k < count($subArrNew); $k++) {
            $subject = explode("#", $subArrNew[$k]);
            $subjectCode = trim($subject['0']);
            $subjectName = trim($subject['1']);
            $bgcolor = ($k % 2) ? "#D9D9D9" : "#FFFFFF";
            $txtRows.='<tr bgcolor="' . $bgcolor . '"><td align="left" width="' . $max_sub_length . '">' . $subjectName . '</td>';
            for ($j = 0; $j < count($examsArrNew); $j++) {
                $examGrp = trim($examsArrNew[$j]);
                $txtRows.= '<td width="' . $widthExamGrp . '" style="text-align: center;">' . round($marksArr[$studentRollNo][$examGrp][$subjectCode][0]) . '</td>';
            }
            for ($i = 1; $i <= (8 - count($examsArrNew)); $i++) {
                $txtRows .= '<td width="' . $widthExamGrp . '"></td>';
            }
            $txtRows.= '<td style="text-align: center;">' . round($this->getAverage($marksArr, $subjectCode, $examsArrNew, $studentRollNo, $class_level)) . '</td>';
            $txtRows.='</tr><tr bgcolor="#ffffff"></tr>';
        }
        return $txtRows;
    }

    /**
     * function to get student information
     * @return an array with student info
     */
    public function getStudentInfo($arrayValue, $studentRollNo) {
        $url_st = trim($arrayValue['sclUrl']) . '/api/students/' . $studentRollNo . '?access_token=' . trim($arrayValue['accToken']);
        $xmlinfo = $this->fedenaconnect($url_st);
        return $xmlinfo;
    }

    /**
     * get the marks of students with subject and examgroup
     */
    public function getSubjectMarksByExamGrp($arrayValue, $examGrpArrNew) {
        $markArr = array();
        for ($z = 0; $z < count($examGrpArrNew); $z++) {
            $examGrp = $examGrpArrNew[$z];
            if ($examGrp <> "") {
                $url = $arrayValue['sclUrl'] . '/api/exam_scores?access_token=' . $arrayValue['accToken'] . '&search[exam_exam_group_name_equals]=' . $examGrp . '&search[exam_exam_group_batch_name_equals]=' . $arrayValue['batch'] . '&search[exam_exam_group_batch_course_code_equals]=' . $arrayValue['course'];
                $socreArr = $this->fedenaconnect($url);
                for ($i = 0; $i < count($socreArr->exam_score); $i++) {
                    $studentRollNo = trim($socreArr->exam_score[$i]->student);
                    for ($j = 0; $j < count($socreArr->exam_score); $j++) {
                        if ($studentRollNo == trim($socreArr->exam_score[$j]->student)) {
                            $examGrp = trim($socreArr->exam_score[$j]->exam_group);
                            $subject = trim($socreArr->exam_score[$j]->subject);
                            $markArr[$studentRollNo][$examGrp][$subject] = $socreArr->exam_score[$j]->marks;
                        }
                    }
                }
            }
        }//end of for loop
        return $markArr;
    }

    /**
     * To get the school name
     */
    public function getSchool($arrayValue) {
        $url = trim($arrayValue['sclUrl']) . '/api/schools?access_token=' . trim($arrayValue['accToken']);
        $xmlinfo = $this->fedenaconnect($url);
        if (count($xmlinfo->school->institute_name) == 0) {
            $_SESSION['errorMess'] = $this->langVar['lang_schoolErr'];
            header("Location:parent.php");
            exit();
        }
        return $xmlinfo;
    }

    /**
     * get the absent of students
     */
    public function getAttendence($arrayValue, $studentRollNo) {
        $url_atten = trim($arrayValue['sclUrl']) . '/api/attendances?access_token=' . trim($arrayValue['accToken']) . '&search[batch_name_equals]=' . trim($this->$arrayValue['batch']) . '&search[month_date_gt]=' . trim($arrayValue['dateFrom']) . '&search[month_date_lt]=' . trim($arrayValue['dateTo']) . '&search[student_admission_no_equals]=' . trim($studentRollNo);
        $xmlinfo = $this->fedenaconnect($url_atten);
        return $xmlinfo;
    }

    /**
     * function to get average of the selected exam's marks
     */
    public function getAverage($marks, $subject_code, $examsArr, $admission_no, $class_level) {
        $totalAvgMarks = 0;
        $marksAvg = 0;
        $avg_count = 0;
        if ($class_level >= 3 && $class_level <= 8) {
            for ($j = 0; $j < count($examsArr); $j++) {
                $student_marks = $marks[$admission_no][$examsArr[$j]][$subject_code];
                if ($examsArr[$j] <> "" && $student_marks > 0) {
                    $marksAvg += $student_marks;
                    $avg_count++;
                }
            }
            $avg_count = ($avg_count > 0) ? $avg_count : 1;
            $totalAvgMarks = $marksAvg / $avg_count;
            return $totalAvgMarks;
        } else if ($class_level >= 9 && $class_level <= 12) {

            for ($j = 0; $j < count($examsArr); $j++) {
                $student_marks = $marks[$admission_no][$examsArr[$j]][$subject_code];
                if (trim($examsArr[$j]) <> "" && $j < 4 && $student_marks > 0) {
                    $marksAvg += $student_marks;
                    $avg_count++;
                }
            }
            $avg_count = ($avg_count > 0) ? $avg_count : 1;
            $avgPrimaryMarks = $marksAvg / $avg_count;
            $fifth_exam_mark = $marks[$admission_no][$examsArr[4]][$subject_code];
            $sixth_exam_mark = $marks[$admission_no][$examsArr[5]][$subject_code];
            $seventh_exam_mark = $marks[$admission_no][$examsArr[6]][$subject_code];

            if (trim($examsArr[4]) <> "" && $fifth_exam_mark <> "" && $fifth_exam_mark > 0) {
                $avgPrimary = $avgPrimaryMarks * 0.7;
                $totalAvgMarks = $avgPrimary + $fifth_exam_mark * 0.3;
            }
            if (trim($examsArr[5]) <> "" && $sixth_exam_mark <> "" && $sixth_exam_mark > 0) {
                $avgPrimary = $avgPrimaryMarks * 0.5;
                $totalAvgMarks = $avgPrimary + $sixth_exam_mark * 0.5;
            }
            if (trim($examsArr[6]) <> "" && $seventh_exam_mark <> "" && $seventh_exam_mark > 0) {
                $avgPrimary = $avgPrimaryMarks * 0.3;
                $totalAvgMarks = $avgPrimary + $seventh_exam_mark * 0.7;
            }
            if (!$totalAvgMarks) {
                $totalAvgMarks = $avgPrimaryMarks;
            }
            return $totalAvgMarks;
        }
    }

    /**
     * get the max length of subject string for both semester
     */
    public function get_max_length($sem1_subArrNew, $sem2_subArrNew) {
        for ($i = 0; $i < count($sem1_subArrNew); $i++) {
            $subject = explode("#", $sem1_subArrNew[$i]);
            $subjectNameSem1[] = trim($subject['1']);
        }
        for ($i = 0; $i < count($sem2_subArrNew); $i++) {
            $subject = explode("#", $sem2_subArrNew[$i]);
            $subjectNameSem2[] = trim($subject['1']);
        }
        $lengthSem1 = max(array_map('strlen', $subjectNameSem1));
        $lengthSem2 = max(array_map('strlen', $subjectNameSem2));
        if ($lengthSem1 >= $lengthSem2) {
            return $lengthSem1;
        } else {
            return $lengthSem2;
        }
    }

    /**
     * get the logo dynamically from the website
     */
    public function get_web_page($url) {
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        $options = array(
            CURLOPT_CUSTOMREQUEST => "GET", //set request type post or get
            CURLOPT_POST => false, //set to GET
            CURLOPT_USERAGENT => $user_agent, //set user agent
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);
        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $header;
    }

}
