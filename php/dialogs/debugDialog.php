<?php 
/*--------------------------------------------------------------------------------------------
 * debugDialog.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------
 * set_debugDlg()
 */
function set_debugDlg() {

	global $debugMessage;
?>
<div id="debugDialog" class="wb-dialog" style="max-width:50%;padding:0.5em">
<div class="pagecomponent">
<?php set_dlgHeader('Debug Dump',"debugDialog") ?>
<div class="outer-div" style="max-height:20em;margin:05.em">
<div id="debugMessage" style="margin:1em"><?php echo $debugMessage ?></div>
</div> <!-- close outer div -->
</div> <!-- close page component -->
</div> <!-- close wb-dialog -->
<?php } ?>