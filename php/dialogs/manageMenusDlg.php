<?php 
/*--------------------------------------------------------------------------------------------
 * manageMenusDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
 * set_manageMenusDlg($db,$contentObj)
 *
 *
 -------------------------------------------------------------------------------------*/
function set_manageMenusDlg(dbUser $userObj, dbContent $contentObj, wbDataArrays $dataArrays) {
	global $menuItemFieldNames;
	global $contentFieldNames;
	global $sqlObject;
	global $dbObj;
	
	/*-------------------------------------------------------------------------------
	 * for new menus
	 */
	$guid = strtolower(trim(com_create_guid(),'{}')); 

	/*----------
	 * set up for menu list scroll table
	 */
	
	if( ! $dbObj->query($sqlObject->sqlMenuList)) {
		$dbObj->error = $dbObj->error . "manageMenusDlg: an sql error occurred:<br><br>" . $dbObj->error .
			"<br><br>" . $sqlObject->sqlMenuList . "<br/>";
	}
	
	$menuListArray = array(
			array(
					array('<div class="icon icon-bin">', 'width:2%;text-align:right;padding:0.5em 0.5em'),
					array('Menu Name', 'width:43%; text-align:center; padding:0.5em 0.5em'),
					array('type', 'width:5%; text-align:center; padding:0.5em 0.5em'),
					array('seq', 'width:5%; text-align:center; padding:0.5em 0.5em'),
					array('Item Name', 'width:45%; text-align:center; padding:0.5em 0.5em 0.5em 0em'),
			)
	);
	
	if($dbObj->result)
	for( $i = 1; $row = mysqli_fetch_array($dbObj->result); $i++ ) {
		$menuListArray[$i] = array(
				array('<input type="checkbox" name="checkbox_' . $i . '" value="' . $row['ID'] . '"/>', 'width:2%'),
				array('<a class="linkItem" href="' . SUBSITE_NAME . $row['menuPermalink'] . '">' . $row['menuDescription'] . '</a>', 'width:42%;padding:0em 0em 0em 0.5em'),
				array($row['menuType'], 'width:5%;padding:0em 0.5em 0em 0.5em'),
				array('<input type="number" name="sequence_' . $i . '" value="' .  $row['sequence'] . '"/><input hidden="true" type="number" name="itemId_' . $i . '" value="' . $row['ID'] . '"/>', 'width:8%;padding:0em 0.5em 0em 0.5em'),
				array($row['title'], 'width:43%;padding:0em 0em 0em 0.5em'),
		);
	}

	$settingsArray = array('header' => true, 'height' => '24em');
	
?>
<div id="popupManageMenus" class="wb-dialog" style="padding:0.5em">
<table style="width:100%">
<tr>
	<td style="width:35%">
	<div class="pagecomponent" style="width:100%">
		<?php set_dlgHeader('Add Menu Item','popupManageMenus')?>
		<div style="padding:1em 1em">
		<form  id="newMenuItemForm" method="post" action="<?php echo get_linkSpec($contentObj)?>">
				<div>Select Menu:</div>
				<?php set_selectWidget($dataArrays->menusDescArray, $contentFieldNames['menu-id'], $contentObj->ID)?>
				<div>Content:</div>
				<?php set_selectWidget($dataArrays->contentArray, $contentFieldNames['content-id'])?>
				<div style="margin:1em 0em 0em 0em">
					Sequence:&nbsp;
					<input style="width:15%" name="<?php echo $contentFieldNames['sequence'] ?>" type="number" value="0">
					&nbsp;&nbsp;
					Type:
					<input style="width:15%" name="<?php echo $contentFieldNames['menuType'] ?>" type="number" value="0">
				</div>
			<div style="margin:0.75em 0em 0em 0em"><input style="margin:0em auto" id="addMenuItem" name="addMenuItem" type="submit" value="Add Menu Item"></div>
		</form>
		</div>
	</div> <!-- close pagecomponent -->
	</td>

	<td style="width:65%;height:98%" rowspan="2">
	<div class="pagecomponent" style="height:98%">
		<?php set_dlgHeader('Menu Items','popupManageMenus')?>
		<form  id="deleteMenuItemForm" method="post" action="<?php echo get_linkSpec($contentObj)?>">
		<?php set_scrollTableWidget($menuListArray, $settingsArray) ?>
		<div style="margin:0.75em 0.75em"><input style="margin:0em auto" name="updateMenuItems" type="submit" value="Update/Delete Menu Item(s)"></div>
		</form>
	</div> <!-- close page component -->
	</td>
</tr>
<tr>
	<td style="width:35%">
	<div class="pagecomponent" style="width:100%">
		<?php set_dlgHeader('Add Menu','popupManageMenus')?>
		<div style="padding:1em 1em">
		<form  id="newMenuForm" method="post" action="<?php echo get_linkSpec($contentObj)?>">
			<input type="text" hidden="true" name="guid" value="<?php echo $guid ?>"/>
			<input type="text" hidden="true" name="pageType" value="menu"/>
			<input type="text" hidden="true" name="languageCode" value="<?php echo $contentObj->lang ?>"/>
			<input hidden="true" name="<?php echo $contentFieldNames['parent']?>" value="-1" type="number"/>
			<input hidden="true" name="<?php echo $contentFieldNames['permalink']?>" value="<?php echo "/" . substr($contentObj->lang,0,2) . "/" . $guid ?>" type="text"/>
			<input hidden="true" name="<?php echo $contentFieldNames['status']?>" value="Public" type="text"/>
			<input hidden="true" name="<?php echo $contentFieldNames['target']?>" value="_self" type="text"/>
			<input hidden="true" name="<?php echo $contentFieldNames['owner']?>" value="<?php echo $contentObj->ownerId ?>" type="text"/>
			<div><?php echo 'Title' ?></div><div><input style="width:100%" name="<?php echo $contentFieldNames['title']?>" placeholder="<?php echo 'Title'?>" type="text"></div>
			<div><?php echo 'Description' ?></div><div><input style="width:100%" name="<?php echo $contentFieldNames['description'] ?>" placeholder="<?php echo 'Description'?>" type="text"></div>
			<div style="margin:0.75em 0em 0em 0em"><input style="margin:0em auto" id="addMenu" name="addMenu" type="submit" value="Add Menu"></div>
		</form>
		</div>
	</div> <!-- close pagecomponent -->
	</td>
</tr>
</table>
</div> <!-- close maintenance -->
<?php } ?>