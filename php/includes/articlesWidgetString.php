<?php
/*--------------------------------------------------------------------------------------------
 * get_articlesWidgetString.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------
* get_articlesWidgetString()
*/
function get_articlesWidgetString(dbContent $contentObj, $itemsList ) {

	$retString = '';
	$flip = 'right';
	$count = 0;
	
	if($itemsList === NULL)
		return;
	
	foreach( $itemsList as $key => $value) {
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
			$retString = $retString . '<img  class="mainImage" src="' . CONTENTDIR . $value['galleryImage'] . '"/>';
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
			$retString = $retString . '<div class="articleList">';
				
		} else if($flip == 'right') {
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<div class="featuredItem">';
			$retString = $retString . '<h2>' . $value['title'] . '</h2>';
			$retString = $retString . '<a class="menuItem" href="' . $linkSpec . '">';
			$retString = $retString . '<img  class="rightImage" src="' . CONTENTDIR . $value['galleryImage'] . '"/>';
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
			$retString = $retString . '<img  class="leftImage" src="' . CONTENTDIR . $value['galleryImage'] . '"/>';
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
	
	$retString = $retString . '</div>';

	return $retString;
}
?>