<?php
/*--------------------------------------------------------------------------------------------
 * wbDialogs.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 class wbDialogs {

	public $functions = NULL;
	
	function wbDialogs(dbUser $userObj, dbContent $contentObj ) {
		
		$this->functions = array ();

		if($userObj->type > 1 )
			$this->functions['add-content'] = 'set_addContentDlg';
		
		if(can_user_edit_attributes($userObj,$contentObj))
			$this->functions['edit-content'] = 'set_editContentDlg';

		if(can_user_edit_attributes($userObj,$contentObj) and ($contentObj->pageType == 'gallery' or $contentObj->pageType == 'profile' or $contentObj->pageType == 'article'))
			$this->functions['manage-rightbar'] = 'set_rightbarDlg';

		if(can_user_edit_attributes($userObj,$contentObj) and ($contentObj->pageType == 'gallery' or $contentObj->pageType == 'profile' or $contentObj->pageType == 'article' or $contentObj->pageType == 'image'))
			$this->functions['manage-tabs'] = 'set_tabsDlg';
			
		if(can_user_edit_attributes($userObj,$contentObj))
			$this->functions['sidebar-menus'] = 'set_addMenuGroupsDlg';
		
		if($userObj->type > 1 )
			$this->functions['manage-menus'] = 'set_manageMenusDlg';
		
		if($userObj->type > 0 )
			$this->functions['change-theme'] = 'set_changeThemeDlg';
		
		if($userObj->type > 2 )
			$this->functions['content-dump'] = 'set_contentDumpDlg';
		
		if($userObj->type > 2 )
			$this->functions['user-dump'] = 'set_userDumpDlg';
		
		if($userObj->type > 2 )
			$this->functions['debug-dump'] = 'set_debugDlg';
	}
	
	function set_dialogs(dbUser $userObj, dbContent $contentObj, wbDataArrays $dataArrays)
	{
		global $contentFieldNames;
		global $isRightbarSet;
		
		if($userObj->ID != NULL) {
			if(isset($this->functions['add-content']))
				call_user_func($this->functions['add-content'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['edit-content']))
				call_user_func($this->functions['edit-content'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['manage-tabs']))
				call_user_func($this->functions['manage-tabs'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['manage-rightbar']) and $isRightbarSet )
				call_user_func($this->functions['manage-rightbar'], $userObj, $contentObj, $dataArrays);
			else
				$this->functions['manage-rightbar'] = NULL;
			
			if(isset($this->functions['sidebar-menus']))
				call_user_func($this->functions['sidebar-menus'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['manage-menus']))
				call_user_func($this->functions['manage-menus'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['change-theme']))
				call_user_func($this->functions['change-theme'], $userObj, $contentObj);
			if(isset($this->functions['content-dump']))
				call_user_func($this->functions['content-dump'], $contentObj);
			if(isset($this->functions['user-dump']))
				call_user_func($this->functions['user-dump'], $userObj);
			if(isset($this->functions['debug-dump']))
				call_user_func($this->functions['debug-dump'], $contentObj);
		}
	}
}
?>