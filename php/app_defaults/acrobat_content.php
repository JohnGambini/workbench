<?php 
/*-------------------------------------------------------------------------------------------------
 * acrobat_content.php
 * 
 * Copyright 2015 2016 2017 2018 by John Gambini
 -------------------------------------------------------------------------------------------------*/
global $dbObj;
global $userObj;
global $contentObj; 
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" class="mainContent" style="padding: 0em 0em 0.01em 0em; height:100%;border:0px solid green">
    <object id="acrobatObj" data="<?php echo replace_wb_variable($contentObj->articleFile, $dbObj, $userObj, $contentObj ) ?>" type="application/pdf" width="100%" height="100%">
        alt : <a href="<?php echo replace_wb_variable($contentObj->articleFile, $dbObj, $userObj, $contentObj ) ?>">test.pdf</a>
    </object>
</div>
</div> <!-- close content -->
</div> <!-- close content container  -->
<script>
function pagePreferences() {

	var mainContent = document.getElementById("mainContent");
	var contentMenu = document.getElementById("contentMenu");
	var content = document.getElementById("content");
	var mainMenu = document.getElementById("mainmenu");

	content.style.overflowY = "hidden";
	
	mainContentRect = mainContent.getBoundingClientRect();

	var acrobat = document.getElementById('acrobatObj');
	if(acrobat && contentMenu) {
		acrobat.style.height = "" + (mainContentRect.height-contentMenu.getBoundingClientRect().height-2) + "px";
	}
	else if( acrobat && mainMenu) {
		acrobat.style.height = "" + (mainContentRect.height-2) + "px";
	}

	//lose the page title
	var pageTitle = document.getElementById("pageTitle");
	if(pageTitle){
			
		//pageTitle.hidden= "true";
	}
	
}
</script>