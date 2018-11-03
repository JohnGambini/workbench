<?php
/*--------------------------------------------------------------------------------------------
 * front-page_content.php
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

$dialogsObj->functions['change-theme'] = 'set_changeThemeFrontPage';

?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding: 0em 0em 0.01em 0em">

<div id="<?php echo $contentObj->title ?>"></div>
<div class="parallax" style="background-image: url(<?php echo replace_wb_variable($contentObj->articleImage, $dbObj, $userObj, $contentObj, $sqlObject)?>)">
	<div style="position:absolute;bottom:0;padding:2%;width:90%;text-align:right">
		<a class="linkItem" style="color:#EEEEEE" href="<?php echo $contentObj->authorLink?>" target="_blank"><em><?php echo $contentObj->authorFullName?></em></a>
	</div>
</div>

</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->
<script>
function pagePreferences() {
	var contentMenu = document.getElementById('contentMenu');
	if(contentMenu)
		contentMenu.style.backgroundColor = 'inherit';
	
	//lose the page title
	var pageTitle = document.getElementById("pageTitle");
	if(pageTitle){
		pageTitle.hidden= "true";
	}
	
}
</script>