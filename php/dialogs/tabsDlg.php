<?php
/*--------------------------------------------------------------------------------------------
 * tabeDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------
 * set_tabsDlg()
*/
function set_tabsDlg(dbUser $userObj, dbContent $contentObj, wbDataArrays $dataArrays ) {
	global $contentFieldNames;

	$tabsArray = array(
		array(
				array('<div class="icon icon-bin"></div>', 'width:4%;text-align:right;padding:0.5em 0.5em'),
				array('seq', 'width:6%; text-align:center; padding:0.5em 0.5em'),
				array('Tab Name', 'width:90%; text-align:center; padding:0.5em 0.5em')
		)
	);
	
	$i = 1;
	foreach ( $dataArrays->tabsArray as $tabTitle => $value ) {

		$tabsArray[$i] = array(
			array('<input type="checkbox" name="checkbox_' . $i . '" value="' . $value['ID'] . '"/>', 'width:4%'),
			array('<input type="number" name="seq_' . $i . '" value="' . $value['sequence'] . '"/><input hidden="true type="number" name="articleId_' . $i . '" value="' . $value['ID'] . '"/>', 'width:6%'),
			array('<input type="text" name="tabTitle_' . $i . '" value="' . $tabTitle . '"/>', 'width:90%;padding:0em 0em 0em 0.5em')
		);
		
		$i++;
	}
		
	
	$settingsArray = array('header' => true, 'height' => '10em');
	
?>
<div id="popupManageTabs" class="wb-dialog" style="padding:0.5em;max-width:40em">
<form method="post" action="<?php echo get_linkSpec($contentObj)?>">
<input hidden="true" type="number" name="contentId" value="<?php echo $contentObj->ID ?>"/>
<div class="pagecomponent">
<?php set_dlgHeader("Manage Tabs","popupManageTabs") ?>
<?php set_scrollTableWidget($tabsArray, $settingsArray) ?>
<table style="width:98%;margin:0.5em auto">
<tr>
	<td style="width:4%;height:1.5em"><em>Add</em></td>
	<td style="width:6%;height:1.5em;text-align:center"><em>seq</em></td>
	<td style="width:90%; text-align:center; height:1.5em"><em>Tab Name</em></td>
</tr>
<tr>
	<td style="width:4%"><input type="checkbox" name="addTab"/></td>
	<td style="width:6%"><input type="number" name="sequence" value="<?php echo count($dataArrays->tabsArray)+1?>"/></td>
	<td style="width:90%"><input type="text" name="tabTitle"/></td>
</tr>
</table>
</div> <!-- close page component -->
<input style="margin:0.5em 0em 0.5em 1em" type="submit" name="updateTabs" value="Update Tabs"/>
</form>
</div> <!-- close wb-dialog -->
<?php } ?>