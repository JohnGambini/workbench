<?php
/*--------------------------------------------------------------------------------------------
 * gallery_content.php
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
global $errorMessage;

if($userObj->type > 1 ){
	$dialogsObj->functions['add-content'] = 'set_galleryAddContentDlg';
	$dialogsObj->functions['edit-content'] = 'set_galleryEditContentDlg';
}

?>

<div id="contentContainer" class="contentContainer">
<div id="content" class="content"  onscroll="getScrollPos()">
<?php get_contentMenu($contentObj) ?>
<?php get_rightbar($contentObj)?>
<div  id="mainContent" class="gallery" style="padding:0em 0.01em 0em 0.1em" >
<p/>
<?php echo get_articleHeaderString( $userObj, $contentObj )?>
<p/>
<?php echo get_galleryWidgetString( $contentObj, $dataArrays->get_galleryItemsArray($dbObj, $sqlObject)); ?>
</div> <!-- close main content -->
</div> <!-- close content -->
</div> <!-- close content container -->
<script>

function getScrollPos() {
	var scrollPos = document.getElementById('content').scrollTop;
	sessionStorage.setItem('scrollPos',scrollPos);
}

</script>