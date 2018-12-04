<?php
/*--------------------------------------------------------------------------------------------
 * simple_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $userObj;
global $contentObj;
global $sqlObject;
global $dataArrays;
global $dialogsObj;

if($userObj->type > 1 ){
	$dialogsObj->functions['edit-content'] = 'set_galleryEditContentDlg';
}

if( $dataArrays->get_galleryItemsArray($dbObj, $sqlObject) === NULL) {
	$dbObj->error =  "simple_content.php: an error occurred during a mysqli_query.<br/><br/>" .
			$dbObj->error . "<br/><br/>" . $sqlObject->sqlPageItems;

}

?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<?php get_rightbar($contentObj)?>
<div id="mainContent" style="padding: 0em 0em 0.03em 0em;border-top: 1px solid grey">
<p/>
<div class="articleTabs fontSpecSmall"><?php set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>

<div id="articleText"></div>

</div> <!-- close mainContent -->
<?php set_articleEditorWidget($userObj,$contentObj, '')?>
</div> <!-- close content -->
</div> <!-- close content container -->
<script>
window.onhashchange = function() {

	fragment = getArticle();

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
