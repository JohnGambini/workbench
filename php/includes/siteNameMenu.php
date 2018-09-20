<?php
/*--------------------------------------------------------------------------------------------
 * siteNameMenu.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
function set_siteNameMenu($contentObj,$userObj, $id = NULL) {
	
	$menuTriggerId = 'contentMenuTrigger-1';
	if($id != NULL)
		$menuTriggerId = $id;
	
?>	
<span class="siteNameMenu" style="margin:auto 0.25;white-space:nowrap">
	<a class="menuItem wb-icon wb-icon-menu" id="<?php echo $menuTriggerId ?>" style="text-decoration:none" href="javascript:void(0)" onclick="toggleMenu(event,'popupContentMenu','<?php echo $menuTriggerId?>', 'right')"></a>
	<a id="siteName" class="siteName" style="text-decoration:none;padding:0em 0em 0em 0.25em" href="<?php echo WEBAPP . "/" . substr($contentObj->lang,0,2)?>">
		<em><?php echo APP_NAME?></em>
	</a>
</span>
<?php } ?>