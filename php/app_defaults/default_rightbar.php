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
global $isRightbarSet;

$isRightbarSet = true;

//see if there is content for the right column
$dataArrays->get_rightbarArray($dbObj, $sqlObject, $contentObj->ID);
if( count($dataArrays->rightbarArray) == 0) {
	return;
}
?>
<div id="rightbarContainer" class="rightbar">
<?php foreach ( $dataArrays->rightbarArray as $key => $value ) {
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
	<?php echo $dataArrays->rightbarArray[$key]['title'] ?></a>
	</div>
<?php } ?>
</div>

