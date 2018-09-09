<?php
/*--------------------------------------------------------------------------------------------
 * successDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------
 * set_successDlg()
*/
function set_successDlg() {

	global $successMessage;
?>
<div id="successDialog" class="wb-dialog" style="max-width:50%;padding:0.5em">
<div class="pagecomponent">
<?php set_dlgHeader('Success Message',"successDialog") ?>
<div class="outer-div" style="max-height:20em">
<div id="successMessage" style="margin:1em"><?php echo htmlspecialchars($successMessage) ?></div>
</div> <!-- close outer div -->
</div> <!-- close page component -->
</div> <!-- close wb-dialog -->
<?php } ?>