<?php
/*--------------------------------------------------------------------------------------------
 * get_galleryWidgetString.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*/
function get_galleryWidgetString(dbContent $contentObj, $listItems ) {
	global $debugMessage;
	
	if(DEBUG_VERBOSE) $debugMessage .= '<span style="color:blue">called get_galleryWidgetString()</span><br/>';
	
	if(DEBUG_VERBOSE) $debugMessage .=  debug_backtrace_string();
	
	$retString = '';
	
	if($listItems === NULL )
		return;

	foreach( $listItems as $key => $value) {
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
			$imageLink = CONTENTDIR . $value['galleryImage'];
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