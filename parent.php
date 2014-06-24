<?php
require_once('header.php');
//header ('Content-type: text/html; charset=utf-8');
?>
<div id="page">
    <div id="wrapper">
        <form action="report_parent.php" method="post" id="multiForm">
		  <input type="hidden" name="lang" id="lang" value="<?php echo $lang;?>" />
		   <div id="parentReport"></div>
            <div id="slider">
                <div class="form-step" >
				<div class="erromes" style="min-height:<?php if(isset($_SESSION['errorMess'])){echo "35px"; } ?>; padding-bottom:0px;"><?php if(isset($_SESSION['errorMess'])){echo $_SESSION['errorMess']; unset($_SESSION['errorMess']); } ?></div>
                    <div class="form-text">
                        <div class="numbers"><img src="images/1.png"  /></div><div class="num-text"> <?php echo $lang_formOneText; ?> </div>
                    </div>
                    <div class="rowleft">
                        <div class="form-left fform"> <?php echo $lang_schUrl; ?>*</div>
                        <div class="form-right"><input type="text" name="schoolUrl" id="schoolUrl" class="form-input errorDisplay"  onblur="removeErrorSch();"/></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="rowright">
                        <div class="form-left fform"> <?php echo $lang_api; ?>*</div>
                        <div class="form-right"><input type="text" name="accsssToken" id="accsssToken" autocomplete="off" class="form-input errorDisplay"/></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="errorDiv"><?php echo $lang_AccessTokenError; ?></div>
					<div class="loading-image"><img src="images/loading2.gif"  /><div class="wait-text">Please Wait...</div></div>
                </div>
                <div class="form-step" style="display:none" >
                    <div class="form-text">
                        <div class="numbers"><img src="images/2.png"  /></div><div class="num-text"> <?php echo  $lang_formTwoText; ?></div>
                    </div>
					<div class="rowleft">
                        <label for="from"><?php echo $lang_Datefrom; ?></label>
						<input type="text" id="from" name="from" class="form-input errorDisplay"  autocomplete="off"  onfocus="removeError();" >
					</div>
					<div class="rowright">
                        <label for="to"><?php echo $lang_Dateto; ?></label>
                        <input type="text" id="to" name="to" class="form-input errorDisplay" autocomplete="off" onfocus="removeError();">
					 </div>
					<div class="date-form-error" style="padding:64px 64px 0; color: #FF0000;" ></div>
                </div>
                <div class="form-step" style="display:none">
                    <div class="form-text">
                        <div class="numbers"><img src="images/3.png"  /></div><div class="num-text"> <?php echo  $lang_formThreeText; ?></div>
                    </div>
					<div class="form-error" style="margin-left:40px;"></div>
                    <div class="row">
                        <div class="form-left"><?php echo  $lang_cursName; ?>*</div>
                        <div class="form-right">
                            <select name="courses" id="courses" class="errorDisplay" onclick="removeErrorst5(this.id)" onchange="getBatches(this.value);">
                                <option value=""><?php  echo $lang_slctCourse;  ?></option>
                            </select>
                        </div><div id="loading-img-course" style="display:none; padding-top:5px;"><img src="images/loading-img.gif" /></div>
                        <div class="form-error"></div>
                    </div>

                    <div class="row">
						<div class="form-left"><?php echo $lang_level; ?></div>
						<div class="form-right">
							<select name="class_level" id="class_level" class="errorDisplay" onclick="removeErrorst5(this.id)" onchange="getShowHideSub();">
								<option value=""><?php echo $lang_slctlevel; ?></option>
								<?php
								 foreach($allLevelsParent as $key=>$value){
									?>
									<option value="<?php echo $value; ?>"><?php echo $key; ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="form-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-left"><?php echo $lang_btach;?>*</div>
                        <div class="form-right">
                            <select name="batchName" id="batchName" class="errorDisplay"  onclick="removeErrorst5(this.id)" onchange="getStudentsParent(this.value);">
                                <option value=""><?php echo $lang_slctBatch; ?></option>
                            </select>
                        </div>
                        <div class="form-error"></div>
                    <div id="batchStartEndDate"></div>
					</div>
                </div>
                <div class="form-step" style="display:none">
				    <div class="form-text">
                        <div class="numbers"><img src="images/4.png"  /></div><div class="num-text"> <?php echo $lang_slctStuParent; ?></div>
                    </div>
					 <div class="form-msg">
                        <div class="msg"><?php echo $lang_ckbStuReq; ?></div>
                    </div>
					<div  style="margin-bottom:15px;margin-left: 5px;" class="stuDetail">
						<input type="checkbox" id="ckbCheckAllStu" value="Select all" ><strong><?php echo $lang_slctAllParent;?></strong></input>
					</div>
					<div id="check-student"></div>
					<div class="form-error1"></div>
                </div>
			    <div class="form-step" style="display:none">
				<div id="forLevelAbove3">
                    <div class="form-text">
                        <div class="numbers"><img src="images/5.png"  /></div><div class="num-text"> <?php echo $lang_form5txtParent; ?></div>
                    </div>
					<div class="form-msg">
                        <div class="msg"><?php echo $lang_ckbStuReq; ?></div>
                    </div>
                    <div class="rowleft">
                        <div class="form-text"><?php echo $lang_semOne ?></div>
						<div class="sem1ExamGrp" style="margin-bottom:15px">
						  <input type="checkbox" id="ckbCheckAllSem1ExamGrp" value="Select all"  onclick="removeError();"><strong><?php echo $lang_slctAllParent;?></strong></input>
					    </div>
						<?php
							$cnt = 0;
							for ($i = 0; $i < count($examgroupLevelSemOne); $i++) {
							$cnt = $i+1;
						?>
								<div class="leble-name"><?php echo $examgroupLevelSemOne[$i]; ?></div>
								<div class="checkboxs">
									<input type="checkbox" name="s1ckbe[]" id="s1ckbe<?php echo $cnt;?>" onclick="showExamGps('s1ckbe<?php echo $cnt;?>', 's1e<?php echo $cnt; ?>');removeError();" class="ckbSem1ExmGrp"></input>
								</div>
								<div class="lable-val divexamparent">
									<select name="s1e[]" id="s1e<?php echo $cnt; ?>" class="subexamParent examgroup slctSem1Exam"  onchange="removeErrorst5(this.id)">
										<option value=" "><?php echo $lang_slctExamGrp;?></option>
									</select>
								</div>
						<?php } ?>
                    </div>
					
                    <div class="rowleft">
                        <div class="form-text"><?php echo $lang_semTwo ?></div>
						<div class="sem2ExamGrp" style="margin-bottom:15px">
						  <input type="checkbox" id="ckbCheckAllSem2ExamGrp" value="Select all" onclick="removeError();" ><strong><?php echo $lang_slctAllParent;?></strong></input>
					    </div>
                        <?php
							$cnt = 0;
							for ($i = 0; $i < count($examgroupLevelSemTwo); $i++) {
							$cnt = $i+1;
						?>
								<div class="leble-name"><?php echo $examgroupLevelSemTwo[$i]; ?></div>
								<div class="checkboxs">
									<input type="checkbox" name="s2ckbe[]" id="s2ckbe<?php echo $cnt;?>" onclick="showExamGps('s2ckbe<?php echo $cnt;?>', 's2e<?php echo $cnt; ?>'); removeError();"  class="ckbSem2ExmGrp"></input>
								</div>
								<div class="lable-val divexamparent" >
									<select name="s2e[]" id="s2e<?php echo $cnt; ?>" class="subexamParent examgroup slctSem2Exam" onchange="removeErrorst5(this.id)" >
										<option value=" "><?php echo $lang_slctExamGrp; ?></option>
									</select>
								</div>
						<?php } ?>
                    </div>
					<div class="form-error2"></div>
                </div>
				<div id="forLevelbelow3" >   
					</div>
				</div>
				<div class="form-step" style="display:none">
				<div id="forLevelAbove6">
                    <div class="form-text">
                        <div class="numbers"><img width="40" height="45" src="images/6.png"  /></div><div class="num-text"> <?php echo $lang_stp6comntParent; ?></div>
                    </div>
					<div class="form-msg">
                        <div class="msg"><?php echo $lang_ckbStuReq; ?></div>
                    </div>
					
                    <div class="rowleft">
					
					    <div class="form-text"><?php echo $lang_semOne ?></div>
						<div class="sem1subject" style="margin-bottom:15px">
						  <input type="checkbox" id="ckbCheckAllSem1Subj" value="Select all" onclick="removeError();" ><strong><?php echo $lang_slctAllParent;?></strong></input>
					    </div>
						<div class="subjectSem1 parentSub"></div>
						
					</div>
                    <div class="rowleft">
					
                        <div class="form-text"><?php echo $lang_semTwo ?></div>
						<div class="sem2subject" style="margin-bottom:15px">
						  <input type="checkbox" id="ckbCheckAllSem2Subj" value="Select all"  onclick="removeError();"><strong><?php echo $lang_slctAllParent;?></strong></input>
					    </div>
						<div class="subjectSem2 parentSub" ></div>
					
                    </div>
					
					<div class="form-error2"></div>
                </div>
				
				<div id="forLevelbelow6"></div>
				</div>
				
				<div class="form-step" style="display:none">
                    <div class="form-text show-hide-loading">
                        <div class="loading-img"><img id="loading-img" src="images/loading.gif" /></div>
						<div class="infotext"><?php echo $lang_loadingText; ?></div>
                    </div>
					<div class="show-download-parent">
					<?php echo $thankyouMess; ?>
					</div>
         		</div>
				</div>
				
		   </div>
        </form>
   </div>
</div>
<div class="hide" id="cntExamGrpLevSem1"><?php echo count($examgroupLevelSemOne); ?></div>
<div class="hide" id="cntExamGrpLevSem2"><?php echo count($examgroupLevelSemTwo); ?></div>
<div class="hide" id="checkvalidToken"></div>
<?php include('footer.php'); ?>

