<?php
require_once('header.php');
?>
<div id="page">
    <div id="wrapper">
        <div class="erromes"><?php if(isset($_SESSION['errorMess'])){echo $_SESSION['errorMess']; unset($_SESSION['errorMess']); } ?></div>
            <div id="slider">
				<div class="form-step" >
                    <div class="form-text">
                        <div class="numbers"></div><div class="num-text" style="padding-left:0;"> <?php echo $welcomeMessage; ?> </div>
                    </div>
                    <div class="rowleft">
                        <div class="form-left fform"> </div>
                        <div class="form-right"><a class="rhino-btn-index" href="parent.php?lang=<?php echo $lang; ?>"><?php echo $lang_forParent; ?></a></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="rowright">
                        <div class="form-left fform"> </div>
                        <div class="form-right"><a class="rhino-btn-index" href="ministry.php?lang=<?php echo $lang; ?>"><?php echo $lang_forMinistry; ?></a></div>
                        <div class="form-error"></div>
                    </div>
                    <div class="errorDiv"><?php echo $lang_AccessTokenError; ?></div>
					<div class="loading-image"><img src="images/loading2.gif"  /><div class="wait-text">Please Wait...</div></div>
                </div>
    	  </div>
</div>
<div id="hidden-proceed"></div>
<?php require_once('footer.php'); ?>