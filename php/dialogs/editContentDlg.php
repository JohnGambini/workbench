<?php
/*--------------------------------------------------------------------------------------------
 * editContentDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------
 * set_editContentDlg()
 * new
 *
 -------------------------------------------------------------------------------------*/
function set_editContentDlg( wbDatabase $dbObj, dbUser $userObj, dbContent $contentObj, wbSql $sqlObj, wbDataArrays & $dataArrays ) {
	global $errorMessage;
	global $contentFieldNames;
	if(! isset($contentFieldNames)) {
		$errorMessage = $errorMessage . "set_editContentDlg: contentFieldNames not set.<br/>";
		return;
	}
	
?>
<!-- Begin Edit Content Dialog -->
<div id="popupEditContent" class="wb-dialog" style="padding:0.5em">
	<div class="pagecomponent">
	<?php set_dlgHeader("Edit Page Attributes","popupEditContent"); ?>
		<div style="border-bottom: 1px solid black">
		<input style="margin:1em 0em 1em 2em" onclick="pageSelect('editAttributes')" type="radio" name="pageSelect" value="editAttributes" checked="checked"/>Edit Attributes
		<input style="margin:1em 0em 1em 2em" onclick="pageSelect('editOpenGraph')" type="radio" name="pageSelect" value="editContent"/>Edit Open Graph Metadata
		</div>
<form id="editPageForm" method="post" action="<?php echo get_linkSpec($contentObj)?>">
	<div  id="pageContainer">
		<input name="ID" type="number" hidden="true" value="<?php echo $contentObj->ID?>">
		<input name="ownerId" type="number" hidden="true" value="<?php echo $contentObj->ownerId?>">
		<input name="ownerType" type="number" hidden="true" value="<?php echo $contentObj->ownerType?>">
		<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
		<input name="oldParentId" hidden="true" type="number" value="<?php echo $contentObj->defaultParentId ?>"/>
		<?php set_editContentWidget($contentObj, $dataArrays, $contentFieldNames,true) ?>
		<input style="margin:1em 0.25em 1em 1em" type="submit" name="updateContent" value="Update Page"/>
		<input style="margin:1em;float:right" type="submit" name="deleteContent" value="Delete Page"/>
	</div> <!-- close pageContainer -->
</form>
	</div> <!-- close page component -->
<div id="editAttributes" style="display:none">
		<input name="ID" type="number" hidden="true" value="<?php echo $contentObj->ID?>">
		<input name="ownerId" type="number" hidden="true" value="<?php echo $contentObj->ownerId?>">
		<input name="ownerType" type="number" hidden="true" value="<?php echo $contentObj->ownerType?>">
		<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
		<input name="oldParentId" hidden="true" type="number" value="<?php echo $contentObj->defaultParentId ?>"/>
		<?php set_editContentWidget($contentObj, $dataArrays, $contentFieldNames,true) ?>
		<input style="margin:1em 0.25em 1em 1em" type="submit" name="updateContent" value="Update Page"/>
		<input style="margin:1em;float:right" type="submit" name="deleteContent" value="Delete Page"/>
</div>
<div id="editOpenGraph" style="display:none">
		<input name="ID" type="number" hidden="true" value="<?php echo $contentObj->ID?>">
		<input name="ownerId" type="number" hidden="true" value="<?php echo $contentObj->ownerId?>">
		<input name="ownerType" type="number" hidden="true" value="<?php echo $contentObj->ownerType?>">
		<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
		<input name="oldParentId" hidden="true" type="number" value="<?php echo $contentObj->defaultParentId ?>"/>
		<input name="parentId" hidden="true" type="number" value="<?php echo $contentObj->parentId ?>"/>
		<?php set_openGraphWidget($contentObj, $dataArrays, $contentFieldNames) ?>
		<input style="margin:1em 0.25em 1em 1em" type="submit" name="updateContent" value="Update Page"/>
		<input style="margin:1em;float:right" type="submit" name="deleteContent" value="Delete Page"/>
</div>
<script>
function pageSelect(pageId) {

	var pageContainer = document.getElementById('pageContainer');
	
	var sourceContainer = document.getElementById(pageId);
	
	var containerRect = pageContainer.getBoundingClientRect();
	
	pageContainer.innerHTML = sourceContainer.innerHTML;

	var scrollTable = document.getElementById('scrollTableWidget');
	
	if( scrollTable )
		scrollTable.style.height = (containerRect.height - 45) + "px";

	pageContainer.style.width = containerRect.width + "px";
	pageContainer.style.height = containerRect.height + "px";

	var updatePage = document.getElementById('updatePage');
	var updateGalleryItems = document.getElementById('updateGalleryItems');
	var deletePage = document.getElementById('deletePage');
	
	if(pageId == 'editAttributes') {
		updatePage.type = "submit";
		updatePage.disabled = false;
		updateGalleryItems.type = "hidden";
		updateGalleryItems.disabled = true;
		deletePage.type = "submit";
		deletePage.disabled = false;
	}
	
	if(pageId == 'addContent') {
		updatePage.type = "hidden";
		updatePage.disabled = true;
		updateGalleryItems.type = "hidden";
		updateGalleryItems.disabled = true;
		deletePage.type = "hidden";
		deletePage.disabled = true;
	}

	if(pageId == 'editContent') {
		updatePage.type = "hidden";
		updatePage.disabled = true;
		updateGalleryItems.type = "submit";
		updateGalleryItems.disabled = false;
		deletePage.type = "hidden";
		deletePage.disabled = true;
	}

}
</script>

</div> <!-- close popup edit dialog -->
<?php } ?>
<?php
/*------------------------------------------------------------------------------------
 * set_galleryEditContentDlg($db, $contentObj)
* new
*
-------------------------------------------------------------------------------------*/
function set_galleryEditContentDlg( wbDatabase $dbObj, dbUser $userObj, dbContent $contentObj, wbSql $sqlObject, wbDataArrays & $dataArrays) {
	global $errorMessage;
	global $contentFieldNames;
	if(! isset($contentFieldNames)) {
		$errorMessage = $errorMessage . "set_galleryEditContentDlg: contentFieldNames not set.<br/>";
		return;
	}
	
	/*-------------------------------------------------------------------
	 *  This sets up the array for the scroll table widget using the galleryItemsArray from $dataArrays
	 */
	$galleryTableArray = array(
		array(
			array('<div class="icon icon-bin"></div>', 'width:2%;text-align:right;padding:0.5em 0.5em'),
			array('Name', 'width:40%; text-align:center; padding:0.5em 0.5em'),
			array('seq', 'width:5%; text-align:center; padding:0.5em 0.5em'),
			array('Gallery Image', 'width:53%; text-align:center; padding:0.5em 0.5em 0.5em 0em'),
		)
	);

	$count = 1;
	foreach( $dataArrays->get_galleryItemsArray($dbObj, $sqlObject) as $key => $value ) {
	
		$galleryTableArray[$count] = array(
				array('<input type="checkbox" name="checkbox_' . $count . '" value="' . $value['itemId'] . '">', 'width:2%'),
				array($value['title'] . '<input hidden type="number" name="contentId_' . $count . '" value="' . $value['ID'] . '">', 'width:40%;padding:0em 0em 0em 0.5em'),
				array('<input style="width:4em" type="number" name="sequence_' . $count . '" value="' . $value['sequence'] . '">' . '<input hidden type="number" name="itemId_' . $count . '" value="' . $value['itemId'] . '">', 'width:5%;padding:0em 0em 0em 0em'),
				array('<input type="text" name="image_' . $count . '" value="' . $value['galleryImage'] . '"><input hidden type="number" name="cId_' . $count . '" value="' . $value['ID'] . '">', 'width:53%;padding:0em 0em 0em 0.5em')
		);
		$count++;
	}
	
	$settingsArray = array('header' => true, 'height' => '20em');
	
?>
<div id="popupEditContent" class="wb-dialog" style="max-width:60em;padding:0.5em">
<div class="pagecomponent">
<?php set_dlgHeader("Manage Gallery Page Attributes","popupEditContent") ?>
	<div style="border-bottom: 1px solid black">
	<input style="margin:1em 0em 1em 2em" onclick="pageSelect('editAttributes')" type="radio" name="pageSelect" value="editAttributes"/>Edit Attributes
	<input style="margin:1em 0em 1em 2em" onclick="pageSelect('editContent')" type="radio" name="pageSelect" value="editContent" checked="checked"/>Edit Content
	<input style="margin:1em 0em 1em 2em" onclick="pageSelect('editOpenGraph')" type="radio" name="pageSelect" value="editOpenGraph"/>Edit Open Graph Attributes
	</div>
	<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
	<div  id="pageContainer">
		<input name="ID" type="number" hidden="true" value="<?php echo $contentObj->ID?>">
		<input name="ownerId" type="number" hidden="true" value="<?php echo $contentObj->ownerId?>">
		<input name="ownerType" type="number" hidden="true" value="<?php echo $contentObj->ownerType?>">
		<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
		<input name="oldParentId" hidden="true" type="number" value="<?php echo $contentObj->defaultParentId ?>"/>
		<input name="parentId" hidden="true" type="number" value="<?php echo $contentObj->parentId ?>"/>
		<input hidden="true" type="number" name="<?php echo $contentFieldNames['menu-id'] ?>" value="<?php echo $contentObj->ID ?>"/>
		<?php set_scrollTableWidget($galleryTableArray, $settingsArray)?>
		<table style="width:100%">
		<tr>
			<td style="width:2%"><input type="checkbox" name="checkbox_add"/></td>
			<td style="width:38%"><?php set_selectWidget($dataArrays->contentArray,$contentFieldNames['content-id'])?></td>
			<td style="width:3em"><input style="width:4em" type="number" value="<?php echo $count ?>" name="<?php echo $contentFieldNames['sequence'] ?>"/></td>
		</tr>
		</table>
	</div>
	<input id="updatePage" style="margin: 1em" type="hidden" name="updateContent" disabled value="Update Page"/>
	<input id="updateGalleryItems" style="margin: 1em" type="submit" name="updateGalleryItems" value="Update Gallery Items"/>
	<input id="deletePage" style="margin: 1em;float:right" type="submit" name="deleteContent" value="Delete Page"/>
	</form>
</div> <!-- close page component -->

<div id="editAttributes" style="display:none">
	<input name="ID" type="number" hidden="true" value="<?php echo $contentObj->ID?>">
	<input name="ownerId" type="number" hidden="true" value="<?php echo $contentObj->ownerId?>">
	<input name="ownerType" type="number" hidden="true" value="<?php echo $contentObj->ownerType?>">
	<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
	<input name="oldParentId" hidden="true" type="number" value="<?php echo $contentObj->defaultParentId ?>"/>
	<input hidden="true" type="number" name="<?php echo $contentFieldNames['menu-id'] ?>" value="<?php echo $contentObj->ID ?>"/>
	<div style="display:inline-block;width:90%"><?php set_editContentWidget( $contentObj, $dataArrays, $contentFieldNames, true) ?></div>
</div>
<div id="editContent" style="display:none">
	<input name="ID" type="number" hidden="true" value="<?php echo $contentObj->ID?>">
	<input name="ownerId" type="number" hidden="true" value="<?php echo $contentObj->ownerId?>">
	<input name="ownerType" type="number" hidden="true" value="<?php echo $contentObj->ownerType?>">
	<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
	<input name="oldParentId" hidden="true" type="number" value="<?php echo $contentObj->defaultParentId ?>"/>
	<input name="parentId" hidden="true" type="number" value="<?php echo $contentObj->parentId ?>"/>
	<input hidden="true" type="number" name="<?php echo $contentFieldNames['sequence'] ?>" value="1"/>
	<input hidden="true" type="number" name="<?php echo $contentFieldNames['content-id'] ?>" value="<?php echo $contentObj->ID ?>"/>
	<?php set_scrollTableWidget($galleryTableArray, $settingsArray)?>
	<table style="width:100%">
	<tr>
		<td style="width:2%"><input type="checkbox" name="checkbox_add"/></td>
		<td style="width:38%"><?php set_selectWidget($dataArrays->contentArray,$contentFieldNames['content-id'])?></td>
		<td style="width:3em"><input style="width:4em" type="number" value="<?php echo $count ?>" name="<?php echo $contentFieldNames['content-id'] ?>"/></td>
	</tr>
	</table>
</div>
<div id="editOpenGraph" style="display:none">
	<input name="ID" type="number" hidden="true" value="<?php echo $contentObj->ID?>">
	<input name="ownerId" type="number" hidden="true" value="<?php echo $contentObj->ownerId?>">
	<input name="ownerType" type="number" hidden="true" value="<?php echo $contentObj->ownerType?>">
	<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
	<input name="oldParentId" hidden="true" type="number" value="<?php echo $contentObj->defaultParentId ?>"/>
	<input name="parentId" hidden="true" type="number" value="<?php echo $contentObj->parentId ?>"/>
	<input hidden="true" type="number" name="<?php echo $contentFieldNames['menu-id'] ?>" value="<?php echo $contentObj->ID ?>"/>
	<div style="display:inline-block;width:90%;vertical-align:top"><?php set_openGraphWidget( $contentObj, $dataArrays, $contentFieldNames ) ?></div>
</div>
<script>
function pageSelect(pageId) {

	var pageContainer = document.getElementById('pageContainer');
	
	var sourceContainer = document.getElementById(pageId);
	
	var containerRect = pageContainer.getBoundingClientRect();
	
	pageContainer.innerHTML = sourceContainer.innerHTML;

	var scrollTable = document.getElementById('scrollTableWidget');
	
	if( scrollTable )
		scrollTable.style.height = (containerRect.height - 45) + "px";

	pageContainer.style.width = containerRect.width + "px";
	pageContainer.style.height = containerRect.height + "px";

	var updatePage = document.getElementById('updatePage');
	var updateGalleryItems = document.getElementById('updateGalleryItems');
	var deletePage = document.getElementById('deletePage');
	
	if(pageId == 'editAttributes') {
		updatePage.type = "submit";
		updatePage.disabled = false;
		updateGalleryItems.type = "hidden";
		updateGalleryItems.disabled = true;
		deletePage.type = "submit";
		deletePage.disabled = false;
	}
	
	if(pageId == 'addContent') {
		updatePage.type = "hidden";
		updatePage.disabled = true;
		updateGalleryItems.type = "hidden";
		updateGalleryItems.disabled = true;
		deletePage.type = "hidden";
		deletePage.disabled = true;
	}

	if(pageId == 'editContent') {
		updatePage.type = "hidden";
		updatePage.disabled = true;
		updateGalleryItems.type = "submit";
		updateGalleryItems.disabled = false;
		deletePage.type = "hidden";
		deletePage.disabled = true;
	}

	if(pageId == 'editOpenGraph') {
		updatePage.type = "submit";
		updatePage.disabled = false;
		updateGalleryItems.type = "hidden";
		updateGalleryItems.disabled = true;
		deletePage.type = "submit";
		deletePage.disabled = false;
	}
}
</script>
</div> <!-- close popup edit dialog -->
<?php } ?>