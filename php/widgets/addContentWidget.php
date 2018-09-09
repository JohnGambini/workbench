<?php
/*--------------------------------------------------------------------------------------------
 * addContentWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*//*---------------------------------------------------------------------
 * set_addContentWidget()
 */
function set_addContentWidget(dbUser $userObj, dbContent $contentObj, wbDataArrays $dataArrays, array $contentFieldNames, $galleryDefaults = false ) {
	
?>
<!-- set_addContentWidget -->
<!-- galleryDefaults = <?php echo $galleryDefaults ?> -->
<!-- contentObj->ID = <?php echo $contentObj->ID ?> -->
<!-- contentObj->parentId = <?php echo $contentObj->parentId ?> -->
<input id="languageCode" hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
<input id="guid" hidden="true" type="text" name="guid" value="<?php echo strtolower(trim(com_create_guid(),'{}')) ?>"/>
<input id="sequence" hidden="true" type="number" name="<?php echo $contentFieldNames['sequence']?>" value="<?php echo count($dataArrays->galleryItemsArray) + 1 ?>"/>
<input name="ownerId" type="number" hidden="true" value="<?php echo $userObj->ID ?>">
<table style="padding:1em">
<tr>
	<td style="text-align:right;width:20%"><?php echo 'Parent:'?></td>
	<td style="width:80%">
	<?php if($galleryDefaults == true ) {?>
		<div style="width:70%"><?php set_selectWidget($dataArrays->parentsArray, $contentFieldNames['parent'], $contentObj->ID) ?></div>
	<?php } else { ?>
		<div style="width:70%"><?php set_selectWidget($dataArrays->parentsArray, $contentFieldNames['parent'], $contentObj->parentId) ?></div>
	<?php }?>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Permalink:'?></td>
	<td>
		<input style="width:70%" id="permalink" name="<?php echo $contentFieldNames['permalink'] ?>" autofocus type="text"/>
		<input id="useGuid" type="checkbox" onclick="toggleUseGuid()"/><?php echo 'use guid'?>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Title:'?></td>
	<td><input style="width:70%" name="<?php echo $contentFieldNames['title'] ?>" placeholder="<?php echo 'Title'?>" type="text"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Sidebar Menu:'?></td>
	<td><div style="display:inline-block;width:70%"><?php set_selectWidget($dataArrays->menusArray,$contentFieldNames['menu-id'],$contentObj->ID)?></div>
		<?php if($galleryDefaults == true) {?>
			<input type="checkbox" name="isItem" checked="checked"/><?php echo 'add to menu'?>
		<?php } else {?>
			<input type="checkbox" name="isItem"/><?php echo 'add to menu'?>
		<?php } ?>
	</td>	
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Description:'?></td>
	<td><input style="width:70%" type="text" name="<?php echo $contentFieldNames['description']?>"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Gallery Image:'?></td>
	<td><input style="width:70%" type="text" name="<?php echo $contentFieldNames['gallery-image']?>"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Article File:'?></td>
	<td><input style="width:70%" type="text" name="<?php echo $contentFieldNames['article-file']?>"/></td>
</tr>

<tr>
	<td style="text-align:right"><?php echo 'Page Type:'?></td>
	<td><div style="display:inline-block;width:25%">
		<?php set_selectWidget($dataArrays->pageTypesArray, $contentFieldNames['page-type'], $contentObj->pageType)?>
		</div>
		&nbsp; <?php echo 'Page Argument:' ?>
		<div style="display:inline-block; width:28%">
			<input type="text" name="<?php echo $contentFieldNames['page-argument']?>" value="" />
		</div>
		<?php if($galleryDefaults) { ?>
		&nbsp; <?php echo 'Seq:'?>
			<input style="width:10%" id="seq" type="number" name="<?php echo $contentFieldNames['sequence']?>" value="<?php echo (count($dataArrays->galleryItemsArray)+1)?>" />
		<?php } ?>	
		</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Status:'?></td>
	<td>
		<div style="display:inline-block; width:25%">
			<?php set_selectWidget($dataArrays->statusArray, $contentFieldNames['status'], "Draft")?>
		</div>
	</td>
</tr>
<tr>
	<td style="text-align:right">&nbsp;</td>
	<td><input type="checkbox" name="isBlank"/><?php echo 'new tab'?><input style="margin:0em 0em 0em 3em" id="toNewPage" type="checkbox" name="toNewPage"/><?php echo 'new page'?></td>
</tr>
</table>

<script type="text/javascript">
function toggleUseGuid() {
	if( document.getElementById("useGuid").checked){
		var sel = document.getElementById("parentId");
		var per = document.getElementById("permalink");
		var guid = document.getElementById("guid");
		var lang = document.getElementById("languageCode");
		
		if(sel.options[sel.selectedIndex].text == 'none') {
			per.value = lang.value + "/" + guid.value;
		} else {
			per.value = sel.options[sel.selectedIndex].text + "/" + guid.value;
		}

		document.getElementById('title').focus();
	}
	else {
		var sel = document.getElementById("parentId");
		var per = document.getElementById("permalink");
		per.value = sel.options[sel.selectedIndex].text;
		per.focus();
	}
		
}
</script>

<?php } ?>