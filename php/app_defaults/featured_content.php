<?php
/*--------------------------------------------------------------------------------------------
 * featured_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $contentObj;
global $dbObj;
global $dialogsObj;

//$dialogsObj->functions['add-content'] = 'set_linkAddContentDlg';

$ini_array = array();
$filename = ABSDIR . "\\featured." . substr($contentObj->lang,0,2) . ".ini";
//die($filename);
if(file_exists($filename))
	$ini_array = parse_ini_file($filename,TRUE);

	$n = count($ini_array);

	$flip = 0;
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding:0.01em 0.01em 0.02em 0.09em">
<?php foreach( $ini_array as $key => $value) {
	$flip = $flip + 1;
	
	if($flip == 1 ) {
?>
<div style="margin:1em 0em 0em 0em">
<div class="featuredItemMain">
	<h2><?php echo $ini_array[$key]['title']?></h2>
	<a class="menuItem" href="<?php echo $ini_array[$key]['url'] . '?p=' . $contentObj->ID ?>">
	<img  class="MainImage" src="<?php echo $ini_array[$key]['image']?>"/>
	</a>
		<?php echo $ini_array[$key]['description']?>
	<p/>
	<a class="linkItem" href="<?php echo $ini_array[$key]['url'] . '?p=' . $contentObj->ID ?>" >
	<span style="color:#BBBBFF"><?php if($ini_array[$key]['type'] == 'video'){ echo "Watch the video"; } else { echo "Read the article";}?> ...</span></a>
</div>
<?php } else if( $flip % 2) {?>
<div class="featuredItem">
<h2><?php echo $ini_array[$key]['title']?></h2>
	<a class="menuItem" href="<?php echo $ini_array[$key]['url'] . '?p=' . $contentObj->ID?>">
	<img class="LeftImage" src="<?php echo $ini_array[$key]['image']?>"/>
	</a>
		<?php echo $ini_array[$key]['description']?>
	<p/>
	<a class="linkItem" href="<?php echo $ini_array[$key]['url'] . '?p=' . $contentObj->ID?>" >
	<span style="color:#BBBBFF"><?php if($ini_array[$key]['type'] == 'video'){ echo "Watch the video"; } else { echo "Read the article";}?> ...</span></a>
</div>
<?php } else { ?>
<div class="featuredItem">
	<h2><?php echo $ini_array[$key]['title']?></h2>
	<a class="menuItem" href="<?php echo $ini_array[$key]['url'] . '?p=' . $contentObj->ID?>" >
	<img  class="RightImage" src="<?php echo $ini_array[$key]['image']?>"/>
	</a>
		<?php echo $ini_array[$key]['description']?>
	<p/>
	<a class="linkItem" href="<?php echo $ini_array[$key]['url'] . '?p=' . $contentObj->ID?>" >
	<span style="color:#BBBBFF"><?php if($ini_array[$key]['type'] == 'video'){ echo "Watch the video"; } else { echo "Read the article";}?> ...</span></a>
</div>
<?php } ?>
<?php }?>
</div>
</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->
<script>
function pagePreferences() {
}
</script>
