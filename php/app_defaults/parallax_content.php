<?php
/*--------------------------------------------------------------------------------------------
 * parallax_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $userObj;
global $contentObj;
global $sqlObject;
global $dataArrays;
	
if( ! $dataArrays->get_parallaxItemsArray($dbObj, $sqlObject)) {
	$dbObj->error =  "parallex_content.php: an error occurred during a mysqli_query.<br/><br/>" .
			$dbObj->error . "<br/><br/>" . $sqlObject->sqlParallaxList;
	
}
	
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding: 0em 0em 0.01em 0em">

<div id="<?php $contentObj->title ?>"></div>
<div class="parallax" style="background-image: url(<?php echo replace_wb_variable($contentObj->articleImage,$dbObj,$sqlObject) ?>)">
	<div style="position:absolute;bottom:0;padding:2%;width:90%;text-align:right">
		<a class="menuItem" style="color:#EEEEEE" href="<?php echo $contentObj->authorLink?>" target="_blank"><em><?php echo $contentObj->authorFullName?></em></a>
	</div>
</div>

<?php foreach($dataArrays->parallaxItemsArray as $key => $values) { ?>
<div class="parallax" style="background-image: url(<?php echo replace_wb_variable($values['articleImage'],$dbObj, $sqlObject) ?>)">
	<div id="<?php echo $values['title']?>"></div>
	<div style="padding:1.5em .5em;color:white;font-size:22pt;font-weight:400;width:11em;text-align:center">
		<a class="menuItem" href="<?php echo WEBAPP . $values['permalink'] ?>"><?php echo $values['title']?></a>
	</div>
	<?php if(isset($values['authorName'])) { ?>
	<div style="position:relative;height:73%">
		<div style="position:absolute;bottom:0;padding:0em 2em;width:95%;text-align:right">
			<?php if(isset($values['authorLink']) and strlen(trim($values['authorLink']))) {?>
				<a class="menuItem" href="<?php echo $values['authorLink'] ?>" target="_blank"><em><?php echo $values['authorName'] ?></em></a>
			<?php } else { ?>
				<em><?php echo $values['authorName'] ?></em>
			<?php } ?>	
		</div>
	</div>
	<?php } ?>
</div>
<section>
	<?php //echo serialize($parallaxArray[$parent]) ?>
</section>
<?php } ?>
</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->
