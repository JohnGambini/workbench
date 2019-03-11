<?php
/*--------------------------------------------------------------------------------------------
 * default_rightbar.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $sqlObject;
global $contentObj;
global $dataArrays;

if(! $dataArrays->get_rightbarItemsArray($dbObj, $sqlObject))
	return;

?>
<div id="rightbarContainer" class="rightbar">
<?php foreach ( $dataArrays->get_rightbarItemsArray($dbObj, $sqlObject) as $key => $value ) {
	$linkSpec = substr($value['permalink'],0,4);
	$target = '_self';
	if($linkSpec == 'http') {
		$linkSpec = $value['permalink'];
		$target = "_blank";
	}
	else
		$linkSpec = WEBAPP . $value['permalink'] . '?p=' . $contentObj->ID . "&gp=" .$contentObj->parentId;

	$imageLink = substr($value['galleryImage'],0,4);
	if($imageLink == 'http') {
		$imageLink = $value['galleryImage'];
	}
	else
		$imageLink = $contentObj->contentDir . $value['galleryImage'];
		
		
	?>
	<div class="topicBlock fontSpecSmall" style="width:100%">
	<a class="menuItem" href="<?php echo $linkSpec ?>" target="<?php echo $value['target'] ?>" >
	<img class="menuItem" style="margin:0em 0em 1em 0em"  src="<?php echo $imageLink ?>"/>
	<?php echo $value['title'] ?></a>
	</div>
<?php } ?>
</div>

