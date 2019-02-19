<?php
/*--------------------------------------------------------------------------------------------
 * wbDialogs.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 class wbDialogs {

	public $functions = NULL;
	
	function Init(dbUser $userObj, dbContent $contentObj ) {
		
		$this->functions = array ();

		if($userObj->type > 1 )
			$this->functions['add-content'] = 'set_addContentDlg';
		
		if(can_user_edit_attributes($userObj,$contentObj))
			$this->functions['edit-content'] = 'set_editContentDlg';

		if(can_user_edit_attributes($userObj,$contentObj) and ($contentObj->hasRightbar > 0 ))
			$this->functions['manage-rightbar'] = 'set_rightbarDlg';

		if(can_user_edit_attributes($userObj,$contentObj) and ($contentObj->canEdit > 0 ))
			$this->functions['manage-tabs'] = 'set_tabsDlg';
			
		if(can_user_edit_attributes($userObj,$contentObj) and ($contentObj->canEdit > 0 ))
			$this->functions['manage-articles'] = 'set_articlesDlg';
					
		if(can_user_edit_attributes($userObj,$contentObj) and $contentObj->pageType != 'profile')
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
	
	function set_dialogs(wbDatabase $dbObj,  dbUser $userObj, dbContent $contentObj, wbSql $sqlObject, wbDataArrays & $dataArrays)
	{
		global $contentFieldNames;
		
		if($userObj->ID != NULL) {
			if(isset($this->functions['add-content']))
				@call_user_func($this->functions['add-content'], $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays);
			if(isset($this->functions['edit-content']))
				@call_user_func($this->functions['edit-content'], $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays);
			if(isset($this->functions['manage-tabs']))
				@call_user_func($this->functions['manage-tabs'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['manage-rightbar']))
				@call_user_func($this->functions['manage-rightbar'], $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays);
			else
				$this->functions['manage-rightbar'] = NULL;
			if(isset($this->functions['manage-articles']))
				@call_user_func($this->functions['manage-articles'], $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays);
			else
				$this->functions['manage-articles'] = NULL;
			if(isset($this->functions['sidebar-menus']))
				@call_user_func($this->functions['sidebar-menus'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['manage-menus']))
				@call_user_func($this->functions['manage-menus'], $userObj, $contentObj, $dataArrays);
			if(isset($this->functions['change-theme']))
				@call_user_func($this->functions['change-theme'], $userObj, $contentObj);
			if(isset($this->functions['content-dump']))
				@call_user_func($this->functions['content-dump'], $contentObj);
			if(isset($this->functions['user-dump']))
				@call_user_func($this->functions['user-dump'], $userObj);
			if(isset($this->functions['debug-dump']))
				@call_user_func($this->functions['debug-dump'], $contentObj);
		}
	}
}
?>
