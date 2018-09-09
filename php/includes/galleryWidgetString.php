<?php
/*--------------------------------------------------------------------------------------------
 * get_galleryWidgetString.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*//*---------------------------------------------------------------------
* get_galleryWidgetString()
*/
function get_galleryWidgetString(wbDatabase $dbObj, wbSql $sqlObject, dbContent $contentObj, wbDataArrays $dataArrays ) {

	$retString = '';
	$dataArrays->get_galleryItemsArray($dbObj, $sqlObject);

	foreach( $dataArrays->galleryItemsArray as $key => $value) {
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
		
		$retString = $retString . '<div class="topicBlock fontSpecSmall">';
		$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '" target="' . $target . '">';
		$retString = $retString . '<img src="' . $imageLink . '" style="margin:0em 0em 1em 0em"/>' . $value["title"];
		$retString = $retString . '</a>';
		$retString = $retString . '</div>';
	}
	
	return $retString;
}
?>