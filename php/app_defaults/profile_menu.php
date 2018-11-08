<?php
/*--------------------------------------------------------------------------------------------
 * profile_menu.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*/
global $contentObj;
global $userObj;
?>
<div id="mainmenu" class="mainmenu">
	<div id="mainmenuItem1" style="padding:0em 0em 0em 1em"><?php set_siteNameMenu($contentObj,$userObj) ?></div>
	<div id="mainmenuItem2">&nbsp;</div>
	<div id="mainmenuItem3">&nbsp;</div>
	<div id="mainmenuItem4" style="padding:0em 1% 0em 0em"><?php set_siteUserMenu($contentObj, $userObj); set_articleEditLink($contentObj, $userObj) ?></div>
</div> <!-- close main menu -->

