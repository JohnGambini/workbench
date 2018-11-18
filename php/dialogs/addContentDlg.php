<?php 
/*--------------------------------------------------------------------------------------------
 * addContentDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------
 * set_addContentDlg()
 */
function set_addContentDlg( wbDatabase $dbObj, dbUser $userObj, dbContent $contentObj, wbSql $sqlObject, wbDataArrays & $dataArrays ) {
	global $errorMessage;
	global $contentFieldNames;
	if( ! isset($contentFieldNames)) {
		$errorMessage = $errorMessage . "set_AddContentDlg: contentFieldNames not set.</br>";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		return;
	}
	
?>
<!-- set_addContentDlg -->
<div id="popupAddContent" class="wb-dialog" style="padding:0.5em">
<div class="pagecomponent">
	<?php set_dlgHeader('Add Content',"popupAddContent") ?>
	<form id="newPageForm" method="post" onsubmit="fixUpSubmit('<?php echo WEBAPP ?>')" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
		<?php set_addContentWidget( $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays, $contentFieldNames,true) ?>
		<input style="margin:0em 0em 1em 1em" type="submit" name="addContent" value="Add Content"/>
	</form>
</div> <!-- close page component -->
</div> <!-- close wb-dialog -->
<?php } ?>
<?php 
/*------------------------------------------------------------------
 * set_galleryAddContentDlg()
 */
function set_galleryAddContentDlg( wbDatabase $dbObj, dbUser $userObj, dbContent $contentObj, wbSql $sqlObject, wbDataArrays & $dataArrays) {
	global $errorMessage;
	global $contentFieldNames;
	if( ! isset($contentFieldNames)) {
		$errorMessage = $errorMessage . "set_galleryAddContentDlg: contentFieldNames not set.</br>";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		return;
	}

?>
<!-- set_galleryAddContentDlg -->
<div id="popupAddContent" class="wb-dialog" style="padding:0.5em">
<div class="pagecomponent">
<form id="newPageForm" method="post" onsubmit="fixUpSubmit('<?php echo WEBAPP ?>')" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
<?php set_dlgHeader('Add Content',"popupAddContent") ?>
<?php set_addContentWidget( $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays, $contentFieldNames, true) ?>
<input style="margin:0em 0em 1em 1em" type="submit" name="addContent" value="Add Content"/>
</form>
</div> <!-- close page component -->
</div> <!-- close wb-dialog -->
<?php } ?>
<?php
/*------------------------------------------------------------------
 * set_linkAddContentDlg()
 */
function set_linkAddContentDlg( dbUser $userObj, dbContent $contentObj, wbDataArrays $dataArrays) {
	global $errorMessage;
	global $contentFieldNames;
	if( ! isset($contentFieldNames)) {
		$errorMessage = $errorMessage . "set_linkAddContentDlg: contentFieldNames not set.</br>";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		return;
	}

?>
<div id="popupAddContent" class="wb-dialog" style="width:50%;padding:0.5em">
<div class="pagecomponent">
<?php set_dlgHeader("Add Link","popupAddContent") ?>
<table style="width:100%;padding:1em">
<tr>
	<td style="width:3em">link:</td>
	<td><input type="text" name=""/></td>
</tr>
</table>
</div> <!-- close page component -->
<input style="margin:0.5em 1em" type="button" value="Post">
</div> <!-- close wb-dialog -->
<?php }?>
<?php 
/*------------------------------------------------------------------
 * set_featuredAddContentDlg()
 */
function set_featuredAddContentDlg( dbUser $userObj, dbContent $contentObj, wbDataArrays $dataArrays ) {
	global $errorMessage;
	global $contentFieldNames;
	if( ! isset($contentFieldNames)) {
		$errorMessage = $errorMessage . "set_featuredAddContentDlg: contentFieldNames not set.</br>";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		return;
	}
	
?>
<div id="popupAddContent" class="wb-dialog" style="padding:0.5em">
<div class="pagecomponent">
	<?php set_dlgHeader('Add Content',"popupAddContent") ?>
	<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
		<?php set_addContentWidget($userObj, $contentObj, $dataArrays, $contentFieldNames,true) ?>
		<input style="margin:0em 0em 1em 1em" type="submit" name="addContent" value="Add Content"/>
	</form>
</div> <!-- close page component -->
</div> <!-- close wb-dialog -->
<?php } ?>