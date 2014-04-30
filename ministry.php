<?php
require_once('header.php');
?>
<div id="page">
    <div id="wrapper">
        <form action="report.php" method="post" id="multiForm">
		  <input type="hidden" name="lang" id="lang" value="<?php echo $lang;?>" />
            <div id="slider">
                <!--step 1 for ministry form-->
				<div class="form-step" >
				<div class="erromes" style="min-height:<?php if(isset($_SESSION['errorMess'])){echo "35px"; } ?>; padding-bottom:0px;"><?php if(isset($_SESSION['errorMess'])){echo $_SESSION['errorMess']; unset($_SESSION['errorMess']); } ?></div>
                    <div class="form-text">
                        <div class="numbers"><img src="images/1.png"  /></div><div class="num-text"> <?php echo $lang_formOneText; ?> </div>
                    </div>
                    <div class="rowleft">
                        <div class="form-left fform"> <?php echo $lang_schUrl; ?>*</div>
                        <div class="form-right"><input type="text" name="schoolUrl" id="schoolUrl"  class="form-input errorDisplay"  onblur="removeErrorSch();"/></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="rowright">
                        <div class="form-left fform"> <?php echo $lang_api; ?>*</div>
                        <div class="form-right"><input type="text" name="accsssToken" id="accsssToken"  autocomplete="off" class="form-input errorDisplay" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="errorDiv"><?php echo $lang_AccessTokenError; ?></div>
					<div class="loading-image"><img src="images/loading2.gif"  /><div class="wait-text">Please Wait...</div></div>
                </div>
                <!--step 2 for ministry form-->
				<div class="form-step" style="display:none" >
                    <div class="form-text">
                        <div class="numbers"><img src="images/2.png"  /></div><div class="num-text"> <?php echo  $lang_formTwoText; ?></div>
                    </div>
                    <div class="rowleft">
                        <div class="form-left"><?php  echo  $lang_centrName; ?>*</div>
                        <div class="form-right"><input type="text" name="centerName" value="" id="centerName"   autocomplete="off" class="form-input errorDisplay" maxlength="100" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="rowright">
                        <div class="form-left"><?php  echo  $lang_regAddrs; ?>*</div>
                        <div class="form-right"><input type="text" name="regionalAdd" value="" id="regionalAdd" autocomplete="off" class="form-input errorDisplay" maxlength="100" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="rowleft">
                        <div class="form-left"><?php  echo  $lang_eduDist; ?>*</div>
                        <div class="form-right"><input type="text" name="eduDist" value="" id="eduDist"  autocomplete="off" class="form-input errorDisplay" maxlength="100" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="rowright">
                        <div class="form-left"><?php  echo  $lang_codeCentr; ?>*</div>
                        <div class="form-right"><input type="text" name="centerCode" value="" id="centerCode"  autocomplete="off" class="form-input errorDisplay" maxlength="100" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-left"><?php  echo  $lang_schYear; ?>*</div>
                        <div class="form-right"><input type="text" name="school_year" value="" id="school_year"   autocomplete="off" class="form-input errorDisplay" maxlength="100" /></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-left"><?php echo  $lang_tanda; ?>*</div>
                        <div class="form-right"> <select  name="school_shift" id="school_shift" class="errorDisplay">
                                <option value=""><?php  echo  $lang_slctTanda;?></option>
                                <?php
                                for ($i = 0; $i < count($tandaList); $i++) {
                                    ?>
                                    <option value="<?php echo $tandaList[$i]; ?>"><?php echo $tandaList[$i]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-left"><?php echo  $lang_sector; ?>*</div>
                        <div class="form-right">
                            <select name="school_sector" id="school_sector" class="errorDisplay">
                                <option value=""><?php echo $lang_slctSector;?></option>
                                <?php
                                for ($i = 0; $i < count($sectorList); $i++) {
                                    ?>
                                    <option value="<?php echo $sectorList[$i]; ?>"><?php echo $sectorList[$i]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-left"><?php echo $lang_zona; ?>*</div>
                        <div class="form-right">
                            <select name="school_area" id="school_area" class="errorDisplay">
                                <option value=""><?php echo $lang_slctZona; ?></option>
                                <?php
                                for ($i = 0; $i < count($zoneList); $i++) {
                                    ?>
                                    <option value="<?php echo $zoneList[$i]; ?>"><?php echo $zoneList[$i]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-error"></div>
                    </div>
                </div>
                <!--step 3 for ministry form-->
				<div class="form-step" style="display:none">
                    <div class="form-text">
                        <div class="numbers"><img src="images/3.png"  /></div><div class="num-text"> <?php echo  $lang_formThreeText; ?></div>
                    </div>
                    <div class="row">
                        <div class="form-left"><?php echo  $lang_cursName; ?>*</div>
                        <div class="form-right" style="float:left">
                            <select name="courses" id="courses" class="errorDisplay" onchange="getBatches(this.value);">
                                <option value=""><?php  echo $lang_slctCourse;  ?></option>
                            </select>
                        </div><div id="loading-img-course" style="display:none; padding-top:5px;"><img src="images/loading-img.gif" /></div>
                        <div class="form-error"></div>
                    </div>
					<div class="row">
                        <div class="form-left"><?php echo $lang_level; ?></div>
                        <div class="form-right">
                            <select name="class_level" id="class_level"  class="errorDisplay" onchange="getShowHideSub();">
                                <option value=""><?php echo $lang_slctlevel; ?></option>
                                <?php
                                for ($i = 0; $i < count($allLevelsMinistry); $i++) {
                                    ?>
                                    <option value="<?php echo $allLevelsMinistry[$i]; ?>"><?php echo $allLevelsMinistry[$i]; ?></option>
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
                            <select name="batchName" id="batchName"  class="errorDisplay" onchange="getSubject(this.value);">
                                <option value=""><?php echo $lang_slctBatch; ?></option>
                            </select>
                        </div>
                        <div class="form-error"></div>
                    <div id="batchStartEndDate"></div>
					</div>
                </div>
                <!--step 4 for ministry form-->
				<div class="form-step" style="display:none">
                    <div class="form-text">
                        <div class="numbers"><img src="images/4.png"  /></div><div class="num-text"> <?php echo $lang_formFourText; ?></div>
                    </div>
					<div class="programSelect">
					    <div class="rowleft" style="width:20%;"><strong>Program of Study</strong></div>
						<div class="rowright" style="width:80%;">
						<input type="radio" name="radioBtn"  id="regular" value="reg">Regular</input>
						<input type="radio" name="radioBtn" id="technical" value="tech">Technical</input>
						</div>
					</div>
                    <div id="no-class"><?php echo $lang_slctClsLevelError; ?></div>
					<div class="allData">
				       <div id="class-9">
				
					<div class="rowleft">
						<div class="form-text"><?php echo $lang_semOne; ?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsNineSemOne); $i++) {
							?>
							 <div class="leble-name" id="sem1Regular"><?php echo $curcesLevelsNineSemOne[$i]; ?>*</div>
							<div class="leble-name" id="sem1Technical"><?php echo $techSubNineSemOne[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s1s[]" id="<?php echo '9ss' . $i; ?>" class="subject sublevel9 errorDisplay" >
									<option value=""><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
					<div class="rowright">
						<div class="form-text"><?php echo $lang_semTwo;?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsNineSemTwo); $i++) {
							?>
							<div class="leble-name"  id="sem2Regular"><?php echo $curcesLevelsNineSemTwo[$i]; ?>*</div>
							<div class="leble-name"  id="sem2Technical"><?php echo $techSubNineSemTwo[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s2s[]" id="<?php echo '9s2s' . $i; ?>" class="subject sublevel9 errorDisplay" >
									<option value=" "><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				       <div id="class-10">
					<div class="rowleft">
						<div class="form-text"><?php echo $lang_semOne; ?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsTenSemOne); $i++) {
							?>
							<div class="leble-name" id="sem1Regular"><?php echo $curcesLevelsTenSemOne[$i]; ?>*</div>
							<div class="leble-name" id="sem1Technical"><?php echo $techSubTenSemOne[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s1s[]" id="<?php echo '10ss' . $i; ?>" class="subject sublevel10 errorDisplay" >
									<option value=""><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
					<div class="rowright">
						<div class="form-text"><?php echo $lang_semTwo;?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsTenSemTwo); $i++) {
							?>
							<div class="leble-name"  id="sem2Regular"><?php echo $curcesLevelsTenSemTwo[$i]; ?>*</div>
							<div class="leble-name"  id="sem2Technical"><?php echo $techSubTenSemTwo[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s2s[]" id="<?php echo '10s2s' . $i; ?>" class="subject sublevel10 errorDisplay">
									<option value=""><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				       <div id="class-11">
					<div class="rowleft">
						<div class="form-text"><?php echo $lang_semOne; ?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsElevenSemOne); $i++) {
							?>
							<div class="leble-name" id="sem1Regular"><?php echo $curcesLevelsElevenSemOne[$i]; ?>*</div>
							<div class="leble-name" id="sem1Technical"><?php echo $techSubElevenSemOne[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s1s[]" id="<?php echo '11ss' . $i; ?>" class="subject sublevel11 errorDisplay">
									<option value=""><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
					<div class="rowright">
						<div class="form-text"><?php echo $lang_semTwo;?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsElevenSemTwo); $i++) {
							?>
							<div class="leble-name"  id="sem2Regular"><?php echo $curcesLevelsElevenSemTwo[$i]; ?>*</div>
							<div class="leble-name"  id="sem2Technical"><?php echo $techSubElevenSemTwo[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s2s[]" id="<?php echo '11s2s' . $i; ?>" class="subject sublevel11 errorDisplay">
									<option value=""><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				       <div id="class-12">
					<div class="rowleft">
						<div class="form-text"><?php echo $lang_semOne; ?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsTwelveSemOne); $i++) {
							?>
							<div class="leble-name" id="sem1Regular"><?php echo $curcesLevelsTwelveSemOne[$i]; ?>*</div>
							<div class="leble-name" id="sem1Technical"><?php echo $techSubTwleveSemOne[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s1s[]" id="<?php echo '12ss' . $i; ?>" class="subject sublevel12 errorDisplay">
									<option value=""><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
					<div class="rowright">
						<div class="form-text"><?php echo $lang_semTwo;?></div>
						<?php
						for ($i = 0; $i < count($curcesLevelsTwelveSemTwo); $i++) {
							?>
							<div class="leble-name"  id="sem2Regular"><?php echo $curcesLevelsTwelveSemTwo[$i]; ?>*</div>
							<div class="leble-name"  id="sem2Technical"><?php echo $techSubTwelveSemTwo[$i]; ?>*</div>
							<div class="lable-val">
								<select name="s2s[]" id="<?php echo '12s2s' . $i; ?>" class="subject sublevel12 errorDisplay" >
									<option value=""><?php echo $lang_slctSub; ?></option>
								</select>
							</div>
							<?php
						}
						?>
					</div>
				</div>
					</div>
                </div>
                <!--step 5 for ministry form-->
				<div class="form-step" style="display:none">
                    <div class="form-text">
                        <div class="numbers"><img src="images/5.png"  /></div><div class="num-text"> <?php echo $lang_form5txtMinistry; ?></div>
                    </div>

                    <div class="rowleft">
                        <div class="form-text"><?php echo $lang_semOne ?></div>
						<?php
							$cnt = 0;
							for ($i = 0; $i < count($examgroupLevelSemOne); $i++) {
							$cnt = $i+1;
						?>
								<div class="leble-name"><?php echo $examgroupLevelSemOne[$i]; ?><?php if($i<5)echo '*';?></div>
								<div class="lable-val">
									<select name="s1e[]" id="s1e<?php echo $cnt;?>" class="subexam <?php if($i<5){echo "errorDisplay";} ?>" >
										<option value=""><?php echo $lang_slctExamGrp;?></option>
									</select>
								</div>
						<?php } ?>
                    </div>
                    <div class="rowleft">
                        <div class="form-text"><?php echo $lang_semTwo ?></div>
                        <?php
							$cnt = 0;
							for ($i = 0; $i < count($examgroupLevelSemTwo); $i++) {
							$cnt = $i+1;
						?>
								<div class="leble-name"><?php echo $examgroupLevelSemTwo[$i]; ?><?php if($i<5)echo '*';?></div>
								<div class="lable-val">
									<select name="s2e[]" id="s2e<?php echo $cnt;?>" class="subexam <?php if($i<5){echo "errorDisplay";} ?>" >
										<option value=""><?php echo $lang_slctExamGrp;?></option>
									</select>
								</div>
						<?php } ?>
                    </div>
                </div>
				<!--download report page on form-->
					<div class="form-step last-form" style="display:none">
						<div class="form-text show-hide-loading">
							<div class="loading-img"><img id="loading-img" src="images/loading.gif" /></div>
							<div class="infotext"><?php echo $lang_loadingText; ?></div>
						</div>
						<div class="show-download">
						<?php echo $lang_validateDwnldText; ?>
						<div class="download-button"><input type="submit" name="clicktovalidate" id="clicktovalidate" value="<?php echo $lang_downloadFileText; ?>" /></div>
						</div>
				   </div>
			</div>
        </form>
		<div id="ministry_report"></div>
    </div>
</div>
<?php require_once('common_ministry.php'); ?>
<?php require_once('footer.php'); ?>

