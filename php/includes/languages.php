<?php
/*--------------------------------------------------------------------------------------------
 * languages.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
function set_languages($contentObj,$langArray) {

	$imgStyle = "width: 28px";
	
?>
<div style="width:100%;text-align:center">
<ul class="minimenu">
<?php for( $i = 0; $i < count($langArray); $i++ ) { 
	if($langArray[$i] == substr($contentObj->lang,0,2))
		$imgStyle = "langElementHighlight";
	else
		$imgStyle = "langElement";
?>
	<li class="<?php echo $imgStyle ?>">
		<a href="<?php echo WEBAPP . "/" . $langArray[$i] . substr($contentObj->permalink, 3) ?>">
			<img src="<?php echo WORKBENCH_FOLDER ?>/images/flag-<?php echo $langArray[$i]?>.png">
		</a>
	</li>
<?php } ?>	
</ul>
</div> <!-- close language flags  -->
<?php } ?>