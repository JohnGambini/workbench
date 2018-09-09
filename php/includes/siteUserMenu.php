<?php
/*--------------------------------------------------------------------------------------------
 * siteUserMenu.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
function set_siteUserMenu($contentObj, $userObj) {
	
?>
<span class="fontSpecLogin" style="float:right;vertical-align:middle;margin:1em 0.5em">
<?php if( isset($userObj->ID)) { ?> 
	<a id="userMenu" class="menuItem icon icon-circle-down" style="text-decoration:none" href="javascript:void(0)" onclick="toggleMenu(event,'popupUserMenu','userMenu','left')"></a>
	<a id="userName" class="menuItem" style="margin:auto 0.5em" href="<?php echo WEBAPP . "/" .	substr($contentObj->lang,0,2) . substr($userObj->permalink, 3 ) ?>"><?php echo $userObj->fullName ?></a>
<?php } else {?>
	&nbsp;
<?php } ?>		
</span>
<?php } ?>