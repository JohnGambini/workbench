<?php 
/*--------------------------------------------------------------------------------------------
 * image_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $contentObj; 
global $userObj;
global $dbObj;
global $dataArrays;
global $sqlObject;
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding: 0.01em 1em 0em 1em">
<div class="articleTabs fontSpecSmall"><?php set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>
<div class="imageContent">
<div id="articleText"></div>
</div> <!-- close imageViewer -->	
<ul class="imagefooter">
	<li class="fontSpecVerySmall"><?php echo $contentObj->authorFullName . "&nbsp;&nbsp;" . $contentObj->dateModified ?></li>
</ul>
<p/>
</div> <!-- close mainContent -->
<?php set_articleEditorWidget($userObj,$contentObj,'')?>
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