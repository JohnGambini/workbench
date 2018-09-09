<?php
/*--------------------------------------------------------------------------------------------
 * menuList.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
* set_menuList()
*
* first menu in the list has to set p= get parameter to parent
* all subsequent menus set their menu item's parent to the current ID like items in the gallery pages
*
*
-------------------------------------------------------------------------------------*/
function set_menuList($dbObj,$contentObj,$sqlObject, $dataArrays, $htmlId = "menugroups") {

	if(!$dbObj->isConnected())
		return;
	
	$dataArrays->get_sidebarMenusArray($dbObj,$sqlObject);
	
?>
<div class="fontSpecMenuList" id="<?php echo $htmlId?>">
<?php foreach($dataArrays->sidebarMenusArray as $menuId => $values ) {
if($values['menuParentId'] == -1) { ?>
	<div><?php echo $dataArrays->sidebarMenusArray[$menuId]['menuTitle']; ?></div>
<?php 
} else {?>
	<div><a class="menuItem" href="<?php echo WEBAPP . $dataArrays->sidebarMenusArray[$menuId]['menuPermalink']?>"><?php echo $dataArrays->sidebarMenusArray[$menuId]['menuTitle'] ?></a></div>
<?php } ?>
	<ul>
	<?php foreach($values['menuItems'] as $contentId => $contentData) {
		if( $contentObj->permalink == $contentData['permalink']) { ?>
			<li style="margin:0em 0em 0.5em -1em;list-style-type:square">
			<a class="menuHighlightItem" href="<?php echo WEBAPP . $contentData['permalink'] . ($values['mgseq'] == 1 ? "?p=" . $contentObj->parentId . "&gp=" . $contentObj->grandParentId : '')?>"><?php echo $contentData['title']?></a>
			</li>
		<?php } else {?>
			<li style="margin:0em 0em 0.5em -1em;list-style-type:square">
			<a class="menuItem" href="<?php echo WEBAPP . $contentData['permalink'] . ($values['mgseq'] == 1 ? "?p=" . $contentObj->parentId . "&gp=" . $contentObj->grandParentId : '')?>"><?php echo $contentData['title']?></a>
			</li>
		<?php }?>
	<?php }?>
	</ul>
<?php } //close menu loop?>
</div>
<?php } //close function ?>
