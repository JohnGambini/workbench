<?php
/*--------------------------------------------------------------------------------------------
 * set_galleryWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*//*---------------------------------------------------------------------
 * set_galleryWidget()
 */
function set_galleryWidget(wbDatabase $dbObj, wbSql $sqlObject, dbContent $contentObj, wbDataArrays & $dataArrays ) {

?>
<?php //Include the gallery component 
foreach( $dataArrays->get_galleryItemsArray($dbObj, $sqlObject) as $key => $value) {
	$linkSpec = substr($value['permalink'],0,4);
	$target = '_self';
	if($linkSpec == 'http') {
		$linkSpec = $value['permalink'];
		$target = "_blank";
	} else {
		$linkSpec = WEBAPP . htmlspecialchars($value['permalink']) . '?p=' . $contentObj->ID . "&gp=" .$contentObj->parentId;
	}

	$imageLink = substr($value['galleryImage'],0,4);
	if($imageLink == 'http') {
		$imageLink = $value['galleryImage'];
	} else {
		$imageLink = $contentObj->contentDir . $value['galleryImage'];
	}
?>
<div class="topicBlock fontSpecSmall">
<a class="menuItem" href="<?php echo $linkSpec ?>" target="<?php echo $target ?>">
<img src="<?php echo $imageLink ?>" style="margin:0em 0em 1em 0em"/><?php echo $value['title']?>
</a>
</div>
<?php } ?>

<?php 
}
?>