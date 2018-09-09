<?php
/*--------------------------------------------------------------------------------------------
 * addUserWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/function set_addUserWidget(dbContent $contentObj, wbDataArrays $dataArrays, array $contentFieldNames) {

?>
<input hidden="true" type="text" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
<input hidden="true" type="text" name="pageType" value="profile"/>
<table style="width:100%">
<tr>
	<td style="text-align:right;width:25%"><?php echo 'parent:'?></td>
	<td style="width:75%">
		<?php set_selectWidget($dataArrays->parentsArray, $contentFieldNames['parent'], $contentObj->defaultParentId) ?>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'permalink:'?></td>
	<td>
		<input value="<?php echo $contentObj->permalink ?>" name="<?php echo $contentFieldNames['permalink'] ?>" type="text"/>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'user-name:'?></td>
	<td><input name="<?php echo $contentFieldNames['username'] ?>" type="text"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'password:'?></td>
	<td><input type="text" name="<?php echo $contentFieldNames['password']?>"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'user-type:'?></td>
	<td><input style="width:3em" value="1" type="number" name="<?php echo $contentFieldNames['user-type']?>"/></td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'fullname:'?></td>
	<td><input type="text" name="<?php echo $contentFieldNames['title']?>"/></td>
</tr>
</table>
<?php } ?>