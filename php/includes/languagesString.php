<?php
/*--------------------------------------------------------------------------------------------
* get_languagesString.php
*
* Copyright 2015 2016 2017 2018 by John Gambini
*
---------------------------------------------------------------------------------------------*/
function get_languagesString(dbContent $contentObj, wbDataArrays & $dataArrays ) {
	
	$imgStyle = "width: 28px";
	
	$retString = '<div style="width:100%;text-align:center">';
	$retString = $retString . '<ul class="minimenu">';

	for( $i = 0; $i < count($dataArrays->langArray); $i++ ) {
		if($dataArrays->langArray[$i] == substr($contentObj->lang,0,2))
			$imgStyle = "langElementHighlight";
			else
				$imgStyle = "langElement";

		$retString = $retString . '<li class="' . $imgStyle . '">';
		$retString = $retString . '<a href="' . WEBAPP . "/" . $dataArrays->langArray[$i] . substr($contentObj->permalink, 3) . '">';
		$retString = $retString . '<img src="' . WORKBENCH_FOLDER . '/images/flag-' . $dataArrays->langArray[$i] . '.png">';
		$retString = $retString . '</a>';
		$retString = $retString . '</li>';
	}
	
	$retString = $retString . '</ul>';
	$retString = $retString . '</div> <!-- close language flags  -->' . "\r\n";
	
	return $retString;
}

?>
