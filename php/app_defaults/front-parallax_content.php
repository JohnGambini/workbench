<?php
/*--------------------------------------------------------------------------------------------
 * parallax_content.php
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

if( ! $dataArrays->get_galleryItemsArray($dbObj, $sqlObject)) {
	$dbObj->error =  "parallex_content.php: an error occurred during a mysqli_query.<br/><br/>" .
			$dbObj->error . "<br/><br/>" . $sqlObject->sqlParallaxList;
	
}
	
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding: 0em 0em 0.01em 0em">

<div id="<?php $contentObj->title ?>"></div>
<div class="parallax" style="background-image: url(<?php echo replace_wb_variable($contentObj->articleImage,$dbObj, $userObj, $contentObj) ?>)">
	<div style="padding:1.5em .5em;color:white;font-size:22pt;font-weight:400;width:11em;text-align:center">
		<a class="menuItem" href="<?php echo WEBAPP . $contentObj->permalink ?>"><?php echo $contentObj->title ?></a>
	</div>
	<div style="position:absolute;bottom:0;padding:2%;width:90%;text-align:right">
		<a class="menuItem" style="color:#EEEEEE" href="<?php echo $contentObj->authorLink?>" target="_blank"><em><?php echo $contentObj->authorFullName?></em></a>
	</div>
</div>
<section style="min-height:97%">
	<div class="articleTabs fontSpecSmall"><?php $tabName = set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>
	<?php if(strlen($tabName) != 0) {?>	
	<div id="articleText"><?php echo replace_wb_variable($dataArrays->tabsArray[$tabName]['articleText'], $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays) ?></div>
	<?php 	} else {?>
	<div id="articleText"></div>
	<?php	 }?>
</section>
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
