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
<div id="content" class="content" style="background-image: url(<?php echo replace_wb_variable($contentObj->articleImage, $dbObj, $userObj, $contentObj )?>); background-position:center; background-size:cover; background-repeat:no-repeat;background-attachment:fixed">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding: 0em 0.01em 0em 0.01em">

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

	var siteName = document.getElementById('siteName');
	if(siteName)
		siteName.style.display = 'inline-block';
	
}
</script>