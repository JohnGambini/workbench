<?php
/*--------------------------------------------------------------------------------------------
 * userDumpDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------
* set_userDumpDlg($langues,$contentObj)
*
*
-------------------------------------------------------------------------------------*/
function set_userDumpDlg( dbUser $userObj) {

	?>
<div id="popupUserDump" class="wb-dialog" style="padding:0.5em">
	<div class="pagecomponent">
	<?php set_dlgHeader("User Dump",'popupUserDump')?>
	<div style="margin:1em">
	<?php echo $userObj->dump() ?>
	</div>
	</div><!-- close page component -->
</div><!-- close wb-dialog -->
<?php } ?>