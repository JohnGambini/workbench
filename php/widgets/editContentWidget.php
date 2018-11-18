<?php
/*--------------------------------------------------------------------------------------------
 * editContentWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*---------------------------------------------------------------------
 * set_editContentWidget()
 */
function set_editContentWidget( dbContent $contentObj, wbDataArrays & $dataArrays, array $contentFieldNames, $userUpdate = false) {
	
?>
<table style="max-width:55em;padding:1em">
<tr>
	<td style="text-align:right;width:20%"><?php echo 'Parent:'?></td>
	<td style="width:80%">
		<div><?php set_selectWidget($dataArrays->parentsArray, $contentFieldNames['parent'], $contentObj->defaultParentId) ?></div>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Permalink:'?></td>
	<td>
		<input value="<?php echo $contentObj->permalink ?>" name="<?php echo $contentFieldNames['permalink'] ?>" type="text"/>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Title:'?></td>
	<td><input value="<?php echo $contentObj->title ?>" name="<?php echo $contentFieldNames['title'] ?>" type="text"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Description:'?></td>
	<td><input value="<?php echo $contentObj->shortDescription ?>" type="text" name="<?php echo $contentFieldNames['description']?>"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Gallery Image:'?></td>
	<td><input value="<?php echo $contentObj->galleryImage ?>" type="text" name="<?php echo $contentFieldNames['gallery-image']?>"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Article File:'?></td>
	<td><input value="<?php echo $contentObj->articleFile ?>" type="text" name="<?php echo $contentFieldNames['article-file']?>"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Page Type:'?></td>
	<td>
		<div style="display:inline-block;width:36%"><?php set_selectWidget($dataArrays->pageTypesArray, $contentFieldNames['page-type'], $contentObj->pageType)?></div>
		&nbsp;&nbsp;<?php echo 'Page Argument:'?>
		<div style="display:inline-block; width:32%"><input value="<?php echo $contentObj->pageArgument ?>" type="text" name="<?php echo $contentFieldNames['page-argument']?>"/></div>
	</td>
</tr>
<?php if($userUpdate) { ?>
<tr>
	<td style="text-align:right"><?php echo 'Owner:'?></td>
	<td>
		<div style="display:inline-block;width:38%"><?php set_selectWidget($dataArrays->usersArray, $contentFieldNames['owner'], $contentObj->ownerId)?></div>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Target:'?>
		<div style="display:inline-block;width:25%"><?php set_selectWidget($dataArrays->targetArray, $contentFieldNames['target'], $contentObj->target)?></div>
	</td>
</tr>	
<?php } ?>
<tr>
	<td style="text-align:right"><?php echo 'Status:'?></td>
	<td><div style="width:38%"><?php set_selectWidget($dataArrays->statusArray, $contentFieldNames['status'], $contentObj->status)?></div></td>
</tr>
</table>

<?php } ?>