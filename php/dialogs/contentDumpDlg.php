<?php 
/*--------------------------------------------------------------------------------------------
 * contentDumpDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
 * set_addMenuDlg($db,$contentObj)
 *
 *
 -------------------------------------------------------------------------------------*/
function set_contentDumpDlg( dbContent $contentObj) {

?>
<div id="popupContentDump" class="wb-dialog" style="padding:0.5em;width:50%">
	<div class="pagecomponent" style="width:100%">
	<?php set_dlgHeader('Content Dump','popupContentDump')?>
	<div class="outer-div" style="max-height:30em">
	<div style="margin:1em"><?php echo $contentObj->dump() ?></div>
	</div>
	</div><!-- close page component -->
</div><!-- close wb-dialog -->
<?php } ?>