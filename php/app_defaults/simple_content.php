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

$dataArrays->get_tabsArray( $dbObj, $sqlObject, $contentObj->ID);
reset($dataArrays->tabsArray);
$tabName = count($dataArrays->tabsArray) ? key($dataArrays->tabsArray) : '';
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding: 0em 1em 0.03em 1em;border-top: 1px solid grey">
<div class="articleTabs fontSpecSmall"><?php set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>

<?php if(strlen($tabName) != 0) {?>	
<div id="articleText"><?php echo replace_wb_variable($dataArrays->tabsArray[$tabName]['articleText']) ?></div>
<?php 	} else {?>
<div id="articleText"></div>
<?php	 }?>

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
