<?php
/*--------------------------------------------------------------------------------------------
 * openGraphWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*---------------------------------------------------------------------
 * set_addContentWidget()
 */
function set_openGraphWidget(dbContent $contentObj, wbDataArrays $dataArrays, array $contentFieldNames ) {

?>
<table style="width:100%;padding:1em">
<!-- 
<tr>
	<td style="width:20%;text-align:right"><?php echo 'Page URL:'?></td>
	<td style="width:80%">
		<input name="<?php /*echo $contentFieldNames['article-url'] ?>" value="<?php echo $contentObj->articleURL*/ ?>" autofocus type="text"/>
	</td>
</tr>
 -->
<tr>
	<td style="width:20%;text-align:right"><?php echo 'Type:'?></td>
	<td style="width:80%">
		<input style="width:40%" name="<?php echo $contentFieldNames['og-type'] ?>" value="<?php echo $contentObj->ogType ?>" type="text"/>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Article Image:'?></td>
	<td>
		<input name="<?php echo $contentFieldNames['article-image'] ?>" value="<?php echo $contentObj->articleImage ?>" type="text"/>
	</td>
</tr>
<tr>
	<td style="text-align:right;vertical-align:top"><?php echo 'Article Description:'?></td>
	<td>
		<textarea rows="6" name="<?php echo $contentFieldNames['article-description'] ?>"><?php echo $contentObj->articleDescription ?></textarea>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Author Name:'?></td>
	<td>
		<input name="<?php echo $contentFieldNames['author-name'] ?>" value="<?php echo $contentObj->authorFullName ?>" type="text"/>
	</td>
</tr>
<tr>
	<td style="text-align:right"><?php echo 'Author Link:'?></td>
	<td>
		<input name="<?php echo $contentFieldNames['author-link'] ?>" value="<?php echo $contentObj->authorLink ?>" type="text"/>
	</td>
</tr>
<tr>
	<td style="height:3.375em">&nbsp;</td>
</tr>
</table>
<?php } ?>