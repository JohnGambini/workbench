<?php
/*--------------------------------------------------------------------------------------------
 * profile_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $userObj;
global $contentObj;
global $dataArrays;
global $sqlObject;
global $dialogsObj;

if($userObj->type > 1 ){
	$dialogsObj->functions['add-content'] = 'set_galleryAddContentDlg';
	$dialogsObj->functions['edit-content'] = 'set_galleryEditContentDlg';
}

?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<?php get_rightbar($contentObj)?>
<div id="mainContent" style="padding: 0em 0.01em 0em 0em">
<p/>
<div class="articleTabs fontSpecSmall"><?php $tabName = set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>

<div id="articleText"></div>

</div> <!--  close main content -->
<?php set_articleEditorWidget($userObj,$contentObj, '')?>
</div> <!-- close content -->
</div> <!-- close content container -->
<script>
window.onhashchange = function() {

	getArticle();
	
}

function getScrollPos() {
	var scrollPos = document.getElementById('content').scrollTop;
	sessionStorage.setItem('scrollPos',scrollPos);
}

function pagePreferences()
{
	getArticle();

	//lose the page title
	//var pageTitle = document.getElementById("pageTitle");
	//if(pageTitle){
	//	pageTitle.hidden= "true";
	//}

	//overide the display:none setting for mobile
	var siteName = document.getElementById('siteName');
	if(siteName)
		siteName.style.display = 'inline-block';
}
</script>