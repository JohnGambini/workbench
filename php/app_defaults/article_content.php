<?php 
/*--------------------------------------------------------------------------------------------
 * article_content.php
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
?>

<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<?php get_rightbar($contentObj)?>
<div id="mainContent" style="padding: 0em 0em 0.01em 0em;border-top: 1px solid grey">
<?php if( count($dataArrays->tabsArray) <= 1 ) { ?>
 	<div style="height:1em;width:100%">&nbsp;</div>
<?php } ?>
	<div class="articleTabs fontSpecSmall"><?php $tabName = set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>
	<article id="article">
	<p/>
	<?php echo get_articleHeaderString($userObj, $contentObj)?>
	<div id="articleText"></div>

	<div style="margin:0em 0em 1em 0em">
		<!-- <div class="fontSpecVerySmall" style="text-align:center">Written by:&nbsp;<a class="menuItem" href="<?php echo WEBAPP . $userObj->permalink ?>"><?php echo $contentObj->authorFullName ?></a></div>  -->
		<div style="display:inline-block;width:69%; text-align:left; font-size:10pt; padding:0em 2em">&nbsp;</div>
<?php  	if(strlen($tabName)) {?>		
		<div id="dateModified" class="fontSpecVerySmall" style="text-align:center"><?php echo "Last Modified: " . $dataArrays->tabsArray[$tabName]['dateModified']?></div>
<?php 	} else {?>
		<div id="dateModified" class="fontSpecVerySmall" style="text-align:center"><?php echo "Last Modified: "?></div>
<?php 	}?>		
	</div>
	<hr style="width:50%"/>
	<p/>
	<!-- close article footer -->
	</article> <!-- close article -->
	<br/>
	
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
	sessionStorage.setItem('scrollPosArticle',scrollPos);
}

function pagePreferences()
{
	window.onhashchange();
}
</script>
