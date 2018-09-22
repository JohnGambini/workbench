<?php
/*--------------------------------------------------------------------------------------------
 * user_menus.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
 * set_popupUserMenu
 *
 *
 -------------------------------------------------------------------------------------*/
function set_popupUserMenu(dbUser $userObj, dbContent $contentObj, wbDialogs $dialogsObj) {
	
?>
<div id="popupUserMenu" class="wb-dialog">
<div style="padding:0em 1em 0em 0em">
<ul>
	<?php if(isset($dialogsObj->functions['add-content'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupAddContent','content')" 
		href="javascript:void(0)"><?php echo 'Add Content'?></a>
		</li>
	<?php }?>
	<?php if(isset($dialogsObj->functions['edit-content'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupEditContent','content')" 
		href="javascript:void(0)"><?php echo 'Edit Page Attributes'?></a>
		</li>
	<?php }?>
	<?php if(isset($dialogsObj->functions['manage-tabs'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupManageTabs','content')" 
		href="javascript:void(0)"><?php echo 'Manage Tabs'?></a>
		</li>
	<?php }?>
	<?php if(isset($dialogsObj->functions['manage-rightbar'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupManageRightbar','content')" 
		href="javascript:void(0)"><?php echo 'Manage Rightbar'?></a>
		</li>
	<?php }?>
	<?php if(isset($dialogsObj->functions['sidebar-menus'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupMenuGroups','content')" 
		href="javascript:void(0)"><?php echo 'Sidebar Menus'?></a>
		</li>
	<?php } ?>	
	<?php if(isset($dialogsObj->functions['manage-menus'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupManageMenus','content')" 
		href="javascript:void(0)"><?php echo 'Manage Menus'?></a>
		</li>
	<?php } ?>	
	<?php if(isset($dialogsObj->functions['headers'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupHeadersDlg','content')" 
		href="javascript:void(0)"><?php echo 'Headers'?></a>
		</li>
	<?php }?>
	<?php if(isset($dialogsObj->functions['change-theme'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupChangeThemeDlg','content')" 
		href="javascript:void(0)"><?php echo "Change Theme"?></a>
		</li>
	<?php }?>
	<?php if(isset($dialogsObj->functions['content-dump'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupContentDump','content')" 
		href="javascript:void(0)"><?php echo 'Content-Dump'?></a>
		</li>
	<?php }?>
	<?php if(isset($dialogsObj->functions['user-dump'])) { ?>
		<li><a class="menuItem" onclick="showForm('popupUserDump','content')" 
		href="javascript:void(0)"><?php echo 'User Dump'?></a></li>
	<?php } ?>
	<?php if(isset($dialogsObj->functions['debug-dump'])) { ?>
		<li><a class="menuItem" onclick="showForm('debugDialog','content')" 
		href="javascript:void(0)"><?php echo 'Debug Dump'?></a></li>
	<?php }?>
	<li><a class="menuItem" href="<?php echo SITE_NAME . SUBSITE_NAME . htmlspecialchars($contentObj->permalink) ."?signoff=1" ?>"><?php echo 'Sign Off'?></a>
	</li>
</ul>
</div>
</div> <!-- close popupEditMenu -->
<?php } ?>
<?php
/*------------------------------------------------------------------------------------
 * set_popupContentMenu
 *
 *
 -------------------------------------------------------------------------------------*/
function set_popupContentMenu(wbDatabase $dbObj, wbSql $sqlObject) {
	global $contentObj;
	global $dataArrays;
	global $errorMessage;
?>
<div id="popupContentMenu" class="wb-dialog">
	<div id="popupLanguages" style="margin:0em 1em;width:100%"><?php set_languages($contentObj, $dataArrays->langArray) ?></div>
	<div id="popupMainMenu" style="margin:0em 1em;width:100%"><?php set_menuList($dbObj, $contentObj, $sqlObject, $dataArrays, 'abcdefg')?></div>
	<hr  id="popupHr" style="margin:0em 1em;width:100%"/>
	<ul>
	<?php
		if($dataArrays->get_rootContentArray($dbObj, $sqlObject)) {
		
			foreach($dataArrays->rootContentArray as $key => $values) {
				if( $contentObj->permalink == $values['permalink']) { ?>
						
				<li style="margin:0em 0em 0.5em 0em"><a class="tableHighlightLinkItem" href="<?php echo SITE_NAME . SUBSITE_NAME . $values['permalink']?>"><?php echo $values['title']?></a></li>
	<?php 
				} else {
	?>
				<li style="margin:0em 0em 0.5em 0em"><a class="tableLinkItem" href="<?php echo SITE_NAME . SUBSITE_NAME . $values['permalink']?>"><?php echo $values['title']?></a></li>
	<?php 
				} 
	 		} 
		} else { 
			$errorMessage = $dbObj->error;
		} ?>	
	</ul>
</div>
<?php } ?>
