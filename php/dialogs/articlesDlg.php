<?php
/*--------------------------------------------------------------------------------------------
 * articlesDlg.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*/
function set_articlesDlg(wbDatabase $dbObj, dbUser $userObj, dbContent $contentObj, wbSql $sqlObject, wbDataArrays & $dataArrays ) {
	global $contentFieldNames;
	global $debugMessage;

	if(DEBUG_VERBOSE) $debugMessage = $debugMessage . "set_articlesDlg() was called.<br/>";
	
	$articlesArray = array(
			array(
					array('<div class="icon icon-bin"></div>', 'width:4%;text-align:right;padding:0.5em 0.5em'),
					array('seq', 'width:6%; text-align:center; padding:0.5em 0.5em'),
					array('Item Name', 'width:90%; text-align:center; padding:0.5em 0.5em'),
			)
	);

	$count = 1;
	foreach ( $dataArrays->get_articleItemsArray($dbObj, $sqlObject) as $key => $value ) {

		$articlesArray[$count] = array(
				array('<input type="checkbox" name="checkbox_' . $count . '" value="' . $value['itemId'] . '"/>', 'width:4%'),
				array('<input type="number" name="seq_' . $count . '" value="' . $value['sequence'] . '"/><input hidden="true type="number" name="menuID_' . $count . '" value="' . $value['ID'] . '"/>', 'width:6%'),
				array($value['title'], 'width:90%;padding:0em 0em 0em 0.5em')
		);

		$count++;
	}


	$settingsArray = array('header' => true, 'height' => '10em');

	?>
<div id="popupManageArticles" class="wb-dialog" style="padding:0.5em;max-width:40em">
<form method="post" action="<?php echo get_linkSpec($contentObj)?>">
<input hidden="true" type="number" name="<?php echo $contentFieldNames['menu-id'] ?>" value="<?php echo $contentObj->ID ?>"/>
<input hidden="true" type="number" name="<?php echo $contentFieldNames['menuType'] ?>" value="3"/>
<div class="pagecomponent">
<?php set_dlgHeader("Manage Articles","popupManageArticles") ?>
<?php set_scrollTableWidget($articlesArray, $settingsArray) ?>
<table style="width:98%;margin:0.5em auto">
<tr>
	<td style="width:4%;height:1.5em"><em>Add</em></td>
	<td style="width:6%;height:1.5em;text-align:center"><em>seq</em></td>
	<td style="width:90%; text-align:center; height:1.5em"><em>Content</em></td>
</tr>
<tr>
	<td style="width:4%"><input type="checkbox" name="addArticle"/></td>
	<td style="width:6%"><input type="number" name="sequence" value="<?php echo $count?>"/></td>
	<td style="width:90%"><?php set_selectWidget($dataArrays->contentArray, $contentFieldNames['content-id'])?>
</td>
</tr>
</table>
</div> <!-- close page component -->
<input style="margin:0.5em 0em 0.5em 1em" type="submit" name="updateArticles" value="Update Articles"/>
</form>
</div> <!-- close wb-dialog -->
<?php } ?>
