<?php
/*--------------------------------------------------------------------------------------------
 * get_articleHeaderString.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------
 * get_articleHeaderString()
 */
function get_articleHeaderString(dbUser $userObj, dbContent $contentObj ) {

	$retString = '';

	$retString .= '<div class="articleHeader">';
	$retString .= '<div style="display:flex;align-items:center;margin:0em auto">';
	$retString .= '<div style="flex:1 0 11%">&nbsp;</div>';
	$retString .= '<div style="flex:1 0 76%"><h1>' . $contentObj->title . '</h1></div>';
	$retString .= '<div class="fontSpecVerySmall" style="flex:1 0 12%">';
	if($contentObj->ownerId == $userObj->ID or (in_array($contentObj->status,$userObj->groupsArray))) {
		$retString .= $contentObj->status; 
	}
	$retString .= '</div>';
	$retString .= '</div>';
	$retString .= '</div> <!-- close article header -->';
	
	return $retString;

}


?>
