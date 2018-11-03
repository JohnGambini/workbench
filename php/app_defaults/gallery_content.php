<?php
/*--------------------------------------------------------------------------------------------
 * gallery_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $userObj;
global $sqlObject;
global $contentObj;
global $dataArrays;
global $dialogsObj;
global $errorMessage;

if($userObj->type > 1 ){
	$dialogsObj->functions['add-content'] = 'set_galleryAddContentDlg';
	$dialogsObj->functions['edit-content'] = 'set_galleryEditContentDlg';
}

if(isset($dataArrays)) {
	if( ! $dataArrays->get_galleryItemsArray($dbObj, $sqlObject)) {
		$errorMessage = "gallery_content.php: " . $dbObj->error;
		$contentObj->error = "";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		return;
	}
} else {
	$contentObj->error = "gallery_content.php: The dataArrays object is not set.";
	$contentObj->pageType = 'error';
	require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
	return;
}

?>

<div id="contentContainer" class="contentContainer">
<div id="content" class="content"  onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<?php get_rightbar($contentObj)?>
<div  id="mainContent" class="gallery" style="padding:0.5em 0.01em 0.5em 0.1em" >
<div id="galleryTitle" style="width:98.5%"><?php echo $contentObj->title ?></div>
<?php if(strlen($contentObj->articleDescription)){?>
	<div class="fontSpecVerySmall" style="max-width:80%;text-align:left;margin:0em auto"><?php echo $contentObj->articleDescription ?></div>
<?php }?>

<?php echo get_galleryWidgetString( $dbObj, $sqlObject, $contentObj, $dataArrays ); ?>

<div class="articleTabs fontSpecSmall"><?php $tabName = set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>
<?php if(strlen($tabName) != 0) {?>	
<div id="articleText"><?php echo replace_wb_variable($dataArrays->tabsArray[$tabName]['articleText'], $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays) ?></div>
<?php 	} else {?>
<div id="articleText"></div>
<?php	 }?>
</div> <!-- close main content -->
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
	window.onhashchange();
}
</script>