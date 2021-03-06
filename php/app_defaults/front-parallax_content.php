<?php
/*--------------------------------------------------------------------------------------------
 * front-parallax_content.php
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
	$dbObj->error =  "front-parallax_content.php: an error occurred during a mysqli_query.<br/><br/>" .
			$dbObj->error . "<br/><br/>" . $sqlObject->sqlPageItems;
	
}
	
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<div id="<?php $contentObj->title ?>"></div>
<div class="parallax" style="background-image: url(<?php echo replace_wb_variable($contentObj->articleImage, $dbObj, $userObj, $contentObj) ?>)">
	<div style="padding:1.5em 8%;color:white;font-size:22pt;font-weight:400">
		<?php echo $contentObj->title ?>
	</div>
	<div style="position:absolute;bottom:0;padding:2%;width:90%;text-align:right">
		<a class="menuItem" style="color:#EEEEEE" href="<?php echo $contentObj->authorLink?>" target="_blank"><em><?php echo $contentObj->authorFullName?></em></a>
	</div>
</div>
<section style="min-height:100%">
<?php get_rightbar($contentObj)?>
<div id="mainContent" style="width:100%">
	<div class="articleTabs fontSpecSmall"><?php $tabName = set_tabsWidget($dbObj, $sqlObject, $dataArrays, $contentObj)?></div>
	<div id="articleText"></div>
</div> <!-- close main content -->
</section>
<?php set_articleEditorWidget($userObj,$contentObj, '')?>
</div> <!-- close content -->
</div> <!-- close content container -->
<script>
window.onhashchange = function() {

	getArticle();
	
}

function getScrollPos() {
	var scrollPos = document.getElementById('content').scrollTop;
	sessionStorage.setItem('scrollPosParallax',scrollPos);
}

function pagePreferences()
{
	window.onhashchange();
}
</script>
