<?php 
/*--------------------------------------------------------------------------------------------
 * errorDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------
 * set_errorDlg()
 */
function set_errorDlg() {
	global $errorMessage;
?>
<div id="errorDialog" class="wb-dialog" style="max-width:50%;padding:0.5em">
<div class="pagecomponent">
<?php set_dlgHeader('error-message',"errorDialog") ?>
<div class="outer-div" style="max-height:20em">
<div id="errorMessage" style="margin:1em"><?php echo $errorMessage ?></div>
</div> <!-- close outer div -->
</div> <!-- close page component -->
</div> <!-- close wb-dialog -->
<?php } ?>