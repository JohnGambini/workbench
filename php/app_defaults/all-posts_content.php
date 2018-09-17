<?php 
/*--------------------------------------------------------------------------------------------
 * all-posts_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
	global $contentObj;
	global $userObj;
	global $sqlObject;
	
	
	$languageArray = array(
			array('Title','Titre'),
			array('Status','Statut'),
			array(' ',' '),
			array('Author','Auter'),
			array('Bytes','Bytes'),
			array('Last Modified','Dernière mise à jour')
	);
	
	$langIdx = $contentObj->lang == 'en' ? 0 : 1; 
	
	//die("<br/><br/><br/>" . $sqlObject->sqlListPosts);
	
	$dataArray = array(
		array(
			array('<div class="icon icon-bin">', 'width:2%; text-align:center; padding:0.5em 0.5em'),
			array($languageArray[0][$langIdx], 'width:33%; text-align:center; padding:0.5em 0.5em'),
			array($languageArray[1][$langIdx], 'width:20%; text-align:center'),
			array($languageArray[2][$langIdx], 'width:9%; text-align:center; padding:0.5em 0.5em'),
			array($languageArray[3][$langIdx], 'width:14%; text-align:center; padding:0.5em 0.5em 0.5em 0em'),
			array($languageArray[4][$langIdx], 'width:5%; text-align:left; padding:0.5em 0.5em'),
			array($languageArray[5][$langIdx], 'width:17%; text-align:center; padding:0.5em 0.5em')
		)
	);
	
	$linkSpec = NULL;
	$lang = $contentObj->lang;

	if( ! $dbObj->query($sqlObject->sqlListPosts)) {
		$dbObj->error =  "all-posts_content.php: an error occurred during a mysqli_query.<br/><br/>" .
				$dbObj->error . "<br/><br/>" . $sqlObject->sqlListPosts;
	} else {
	
		for( $i = 1; $row = mysqli_fetch_array($dbObj->result); $i++ ) {
			if($row['ownerId'] == $userObj->ID) {
				$linkSpec = "<a class='tableLinkItem' href = '" . SITE_NAME . SUBSITE_NAME . $row['permalink'] . "'>View</a>&nbsp;&nbsp;<a href = '" . SITE_NAME . SUBSITE_NAME . "/" . substr($lang,0,2) . "/edit-post?c=" . $row['permalink'] . "'>Edit</a>";
			} else {
				$linkSpec = "<a class='tableLinkItem' href = '" . SITE_NAME . SUBSITE_NAME . $row['permalink'] . "'>View</a>";
			}
			$dataArray[$i] = array(
					array('<input type="checkbox" name="checkbox_' . $i . '" value="' . $row['ID'] . '">', 'width:2%'),
					array($row['defaultParentId'] . ": " . $row['title'], 'width:33%;padding:0em 0em 0em 0.5em'),
					array($row['status'], 'width:20%;padding:0em 0em 0em 0.5em'),
					array($linkSpec, 'width:9%;text-align:center'),
					array($row['ownerFullName'], 'width:14%;padding:0em 0em 0em 0.5em'),
					array($row['byteCount'], 'width:5%;text-align:right;padding:0em 0.5em 0em 0em'),
					array($row['dateModified'], 'width:17%;text-align:right;padding:0em 0.5em 0em 0em')
			);
		}
	}
	
	$settingsArray = array('header' => true, 'height' => '100%');
	
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
<?php get_contentMenu($contentObj)?>
<div id="mainContent" style="padding: 0em 0em 0.01em 0.01em;height:90%">
<div id="allPosts" class="wb-dialog" style="width:98%;margin:2em auto;height:90%;min-width:700px">
<?php set_scrollTableWidget($dataArray, $settingsArray) ?>
</div>
</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->
