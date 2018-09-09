<?php 
/*--------------------------------------------------------------------------------------------
 * changeThemeDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------
 * set_changeThemeDlg()
 */
function set_changeThemeDlg($langues, $contentObj) {

	global $dataArrays;
	
?>
<div id="popupChangeThemeDlg" class="wb-dialog" style="padding:0.5em">
<form method="post" action="<?php echo get_linkSpec($contentObj)?>">
<div class="pagecomponent">
<?php set_dlgHeader("Change Theme","popupChangeThemeDlg") ?>
<div style="margin:1em 1em 0.5em 1em">
<?php set_selectWidget($dataArrays->themesArray, 'theme', $contentObj->theme)?>
<input style="margin: 1em 0em 0.5em 0em" type="submit" name="changeTheme" value="Change Theme"/>
</div> 
</div>
</form>
</div>
<?php } ?>
<?php 
/*------------------------------------------------------------------
 * set_changeThemeDlg()
 */
function set_changeThemeFrontPage($langues, $contentObj) {

	global $dataArrays;
	
?>
<div id="popupChangeThemeDlg" class="wb-dialog" style="padding:0.5em">
<form method="post" action="<?php echo get_linkSpec($contentObj)?>">
<div class="pagecomponent">
<?php set_dlgHeader("Change Theme","popupChangeThemeDlg") ?>
<div style="margin:1em 1em 0.5em 1em">
<?php set_selectWidget($dataArrays->themesArray, 'theme', $contentObj->theme)?>
<?php set_selectWidget($dataArrays->imageArray, 'image', $contentObj->galleryImage)?>
<input style="margin: 1em 0em 0.5em 0em" type="submit" name="changeTheme" value="Change Theme"/>
</div> 
</div>
</form>
</div>
<?php } ?>