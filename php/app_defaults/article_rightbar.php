<?php
/*--------------------------------------------------------------------------------------------
 * article_rightbar.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*/
global $dbObj;
global $sqlObject;
global $contentObj;
global $dataArrays;
global $isRightbarSet;

$contentId = null;

if(!$dbObj->isConnected())
	return;

if($contentObj->pageArgument != null) {
	$dataArrays->get_parallaxItemsArray($dbObj, $sqlObject);
	reset($dataArrays->parallaxItemsArray);
	$contentId = count($dataArrays->parallaxItemsArray) ? key($dataArrays->parallaxItemsArray) : '';
}

if($contentId == null)
	return;
	
?>
<div id="rightbarContainer" class="rightbar">
<p/>
<div class="fontSpecMenuList">
<?php if($contentId != null){?>
<div style="font-size:x-large; font-weight:bold;text-align:center;margin:0em 0em 1em 0em"><a class="menuItem" href="<?php echo WEBAPP . $dataArrays->parallaxItemsArray[$contentId]['menuLink']?>"><?php echo $dataArrays->parallaxItemsArray[$contentId]['menuTitle'] ?></a></div>
<?php }?>
<?php foreach($dataArrays->parallaxItemsArray as $key => $values ) { 
	$linkSpec = substr($values['permalink'],0,4);
	$target = '_self';
	if($linkSpec == 'http') {
		$linkSpec = $values['permalink'];
		$target = "_blank";
	}
	else
		$linkSpec = WEBAPP . $values['permalink'] . '?p=' . $contentObj->parentId . "&gp=" .$contentObj->grandParentId;
	
	$imageLink = substr($values['galleryImage'],0,4);
	if($imageLink == 'http') {
		$imageLink = $values['galleryImage'];
	}
	else
		$imageLink = $contentObj->contentDir . $values['galleryImage'];
	
	if( $contentObj->permalink == $values['permalink']) { ?>
		<div class="topicBlock fontSpecSmall" style="width:100%">
		<a class="menuItem" href="<?php echo $linkSpec ?>" target="<?php echo $target ?>" >
		<img class="menuItem" style="margin:0em 0em 1em 0em"  src="<?php echo $imageLink ?>"/>
		<?php echo $values['title'] ?></a>
		</div>
	<?php } else {?>
		<div class="topicBlock fontSpecSmall" style="width:100%">
		<a class="menuItem" href="<?php echo $linkSpec ?>" target="<?php echo $target ?>" >
		<img class="menuItem" style="margin:0em 0em 1em 0em"  src="<?php echo $imageLink ?>"/>
		<?php echo $values['title'] ?></a>
		</div>
	<?php }?>
<?php } //close menu loop?>
	</div>
</div>
