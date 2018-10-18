<?php
/*--------------------------------------------------------------------------------------------
 * get_articlesWidgetString.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*//*---------------------------------------------------------------------
* get_articlesWidgetString()
*/
function get_articlesWidgetString(wbDatabase $dbObj, wbSql $sqlObject, dbContent $contentObj, wbDataArrays $dataArrays ) {

	$retString = '';
	$flip = 'right';
	$count = 0;
	
	$dataArrays->get_articleItemsArray($dbObj, $sqlObject);
	
	foreach( $dataArrays->articleItemsArray as $key => $value) {
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

		if($count == 0) {
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<div class="featuredItemMain">';
			$retString = $retString . '<h2>' . $value['title'] . '</h2>';
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<img  class="MainImage" src="' . CONTENTDIR . $value['galleryImage'] . '"/>';
			$retString = $retString . '</a>';
			$retString = $retString . $value['articleDescription'];
			$retString = $retString . '<p/>';
			$retString = $retString . '<a class="linkItem" href="' . $linkSpec . '">';
			$retString = $retString . '<span>';
			if($value['type'] == 'video')
				{ $retString = $retString . "Watch the video"; } 
			else 
				{ $retString = $retString . "Read the article";}
			$retString = $retString . '....</span></a>';
			$retString = $retString . '</div>';
			$retString = $retString . '</a>';
				
		} else if($flip == 'right') {
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<div class="featuredItem">';
			$retString = $retString . '<h2>' . $value['title'] . '</h2>';
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<img  style="float:right; width:50%" src="' . CONTENTDIR . $value['galleryImage'] . '"/>';
			$retString = $retString . '</a>';
			$retString = $retString . $value['articleDescription'];
			$retString = $retString . '<p/>';
			$retString = $retString . '<a class="linkItem" href="' . $linkSpec . '">';
			$retString = $retString . '<span>';
			if($value['type'] == 'video')
			{ $retString = $retString . "Watch the video"; }
			else
			{ $retString = $retString . "Read the article";}
			$retString = $retString . '....</span></a>';
			$retString = $retString . '</div>';
			$retString = $retString . '</a>';
				
		} else { /* flip = left */
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<div class="featuredItem">';
			$retString = $retString . '<h2>' . $value['title'] . '</h2>';
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<img  style="float:left; width:50%;margin:0em 1em 0em 0em" src="' . CONTENTDIR . $value['galleryImage'] . '"/>';
			$retString = $retString . '</a>';
			$retString = $retString . $value['articleDescription'];
			$retString = $retString . '<p/>';
			$retString = $retString . '<a class="linkItem" href="' . $linkSpec . '">';
			$retString = $retString . '<span>';
			if($value['type'] == 'video')
			{ $retString = $retString . "Watch the video"; }
			else
			{ $retString = $retString . "Read the article";}
			$retString = $retString . '....</span></a>';
			$retString = $retString . '</div>';
			$retString = $retString . '</a>';
				
		}
		
		$count = $count + 1;
		if($count % 2)
			$flip == 'left' ? $flip = 'right' : $flip = 'left';
	}

	return $retString;
}
?>