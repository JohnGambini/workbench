<?php
/*--------------------------------------------------------------------------------------------
 * profile_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $contentObj;
global $dbObj;
global $dataArrays;
global $sqlObject;
global $userObj;

?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<?php get_rightbar($contentObj)?>
<div id="mainContent" style="padding: 1.25em 1em 0em 1em">
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
}
</script>