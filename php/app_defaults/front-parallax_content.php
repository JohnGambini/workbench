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

if($userObj->type > 1 ){
	$dialogsObj->functions['add-content'] = 'set_galleryAddContentDlg';
	$dialogsObj->functions['edit-content'] = 'set_galleryEditContentDlg';
}

if( ! $dataArrays->get_galleryItemsArray($dbObj, $sqlObject)) {
	$dbObj->error =  "parallex_content.php: an error occurred during a mysqli_query.<br/><br/>" .
			$dbObj->error . "<br/><br/>" . $sqlObject->sqlParallaxList;
	
}
	
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
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
<div id="galleryTitle" style="width:98.5%"><?php echo $contentObj->title ?></div>
<?php echo get_galleryWidgetString( $dbObj, $sqlObject, $contentObj, $dataArrays ); ?>
</section>

</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->