<?php
/*--------------------------------------------------------------------------------------------
 * front-page_menu.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $contentObj;
global $userObj;
?>
<div id="mainmenu" class="mainmenu">
	<div style="flex:1 1 79%;padding:0em 0em 0em 1em">
		<div  id="siteNameWdget">
			<a class="menuItem wb-icon wb-icon-menu" id="menuTrigger" style="text-decoration:none" href="javascript:void(0)" onclick="toggleMenu(event,'popupContentMenu','menuTrigger', 'right')"></a>
			<a class="siteName menuItem" style="text-decoration:none;padding:0em 0em 0em 0.25em" href="<?php echo WEBAPP . "/" . substr($contentObj->lang,0,2)?>">
				<em><?php echo APP_NAME?></em>
			</a>
		</div>
	</div>
	<div style="flex:1 1 20%;padding:0em 1% 0em 0em"><?php set_siteUserMenu($contentObj, $userObj) ?></div>
</div> <!-- close main menu -->
