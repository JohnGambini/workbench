<?php 
/*--------------------------------------------------------------------------------------------
 * menuGroupsDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
* set_addMenuGroups()
*
*
-------------------------------------------------------------------------------------*/
function set_addMenuGroupsDlg(dbUser $userObj, dbContent $contentObj, wbDataArrays $dataArrays) {
	global $contentFieldNames;
	global $dbObj;
	global $sqlObject;
	
	/*--------------------------
	 * set up for menu groups scroll table
	 */
	$tmpString = $dbObj->error;
	if( ! $dbObj->query($sqlObject->sqlMenuGroups)) {
		$dbObj->error =  $tmpString . "get_addMenuGroupsDlg: an error occurred during a mysqli_query.<br><br>" . 
			$dbObj->error . "<br><br>" . $sqlObject->sqlMenuGroups . "<br/><br/>";
	}
	
	$menuGroupsArray = array(
			array(
					array('<div class="icon icon-bin"></div>', 'width:2%;text-align:right;padding:0.5em 0.5em'),
					array('Parent', 'width:25%; text-align:center; padding:0.5em 0.5em'),
					array('Page', 'width:33%; text-align:center; padding:0.5em 0.5em'),
					array('seq', 'width:5%; text-align:center; padding:0.5em 0.5em 0.5em 0em'),
					array('Menu Description', 'width:35%; text-align:center; padding:0.5em 0.5em')
			)
	);
	
	if($dbObj->result)
	for( $i = 1; $row = mysqli_fetch_array($dbObj->result); $i++ ) {
	
		$menuGroupsArray[$i] = array(
				array('<input type="checkbox" name="checkbox_' . $i . '" value="' . $row['ID'] . '">', 'width:2%'),
				array($row['m_permalink'], 'width:25%;padding:0em 0em 0em 0.5em'),
				array($row['shortDescription'], 'width:33%;padding:0em 0em 0em 0.5em'),
				array($row['mgseq'], 'width:5%;text-align:right;padding:0em 0.5em 0em 0em'),
				array($row['menuDescription'], 'width:35%;padding:0em 0em 0em 0.5em'),
		);
	}

	$settingsArray = array('header' => true, 'height' => '22em');
		
?>
<div id="popupMenuGroups" class="wb-dialog" style="padding:1em">
<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink) .'?p=' . $contentObj->parentId ?>">
<div class="pagecomponent">
<input type="number" name="ownerId" hidden="true" value="<?php echo $contentObj->ownerId ?>"/>
<?php set_dlgHeader('Sidebar Menus','popupMenuGroups') ?>
<?php set_scrollTableWidget($menuGroupsArray, $settingsArray) ?>
<table style="width:98%;margin:0.5em auto">
<tr>
	<td style="width:1%;height:1.5em"><em>Add:</em></td>
	<td style="width:25%; text-align:center; height:1.5em"><?php echo 'Parent' ?></td>
	<td style="width:34%; text-align:center; height:1.5em"><?php echo 'Content' ?></td>
	<td style="width:5%; text-align:center; height:1.5em;text-align:left"><?php echo 'seq' ?></td>
	<td style="width:35%; text-align:center; height:1.5em"><?php echo 'Menu' ?></td>
</tr>
<tr>
	<td style="width:1%"><input type="checkbox" name="addMenuGroup"></td>
	<td style="width:25%"><?php set_selectWidget($dataArrays->parentsArray, $contentFieldNames['parent'], $contentObj->parentId)?></td>
	<td style="width:34%"><?php set_selectWidget($dataArrays->contentArray, $contentFieldNames['content-id'], $contentObj->ID)?></td>
	<td style="width:5%;text-align:center"><input style="width:3em" name="<?php echo $contentFieldNames['sequence'] ?>" type="number" value="1"></td>
	<td style="width:35%"><?php set_selectWidget($dataArrays->menusDescArray, $contentFieldNames['menu-id'], $contentObj->parentId )?></td>
</tr>
</table>
</div> <!-- close page component -->
<input style="margin:1em 0em 0em 0em" name="updateMenuGroups" type="submit" value="Update Menu Groups">
</form>
</div> <!-- close dialog -->
<?php } ?>