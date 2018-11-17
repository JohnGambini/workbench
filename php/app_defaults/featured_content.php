<?php
/*--------------------------------------------------------------------------------------------
 * featured_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $userObj;
global $contentObj;
global $dataArrays;
global $dialogsObj;

//$dialogsObj->functions['add-content'] = 'set_linkAddContentDlg';

	$dataArrays->load_featuredArticles($contentObj);

	$n = count($dataArrays->featuredArticlesArray);

	$flip = 0;
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding:0.01em 0.01em 0.02em 0.09em">
<?php foreach( $dataArrays->featuredArticlesArray as $key => $value) {
	$flip = $flip + 1;
	
	if($flip == 1 ) {
?>
<div style="margin:1em">
<?php if( can_user_edit($userObj,$contentObj,1)) { set_urlInputDlg(); } ?>
<p/>
<div class="featuredItemMain">
	<h2><?php echo $value['title']?></h2>
	<a class="menuItem" href="<?php echo $value['url'] . '?p=' . $contentObj->ID ?>">
	<img  class="mainImage" src="<?php echo $value['image']?>"/>
	</a>
		<?php echo $value['description']?>
	<p/>
	<a class="linkItem" href="<?php echo $value['url'] . '?p=' . $contentObj->ID ?>" >
	<span style="color:#BBBBFF"><?php if($value['type'] == 'video'){  echo gettext("Watch the video ..."); } else { echo  gettext("Read the article ..."); }?></span></a>
</div>
<div class="articleList">
<?php } else if( $flip % 2) {?>
<div class="featuredItem">
<h2><?php echo $value['title']?></h2>
	<a class="menuItem" href="<?php echo $value['url'] . '?p=' . $contentObj->ID?>">
	<img class="leftImage" src="<?php echo $value['image']?>"/>
	</a>
		<?php echo $value['description']?>
	<p/>
	<a class="linkItem" href="<?php echo $value['url'] . '?p=' . $contentObj->ID?>" >
	<span style="color:#BBBBFF"><?php if($value['type'] == 'video'){ echo _("Watch the video ..."); } else { echo _("Read the article ...");}?></span></a>
</div>
<?php } else { ?>
<div class="featuredItem">
	<h2><?php echo $value['title']?></h2>
	<a class="menuItem" href="<?php echo $value['url'] . '?p=' . $contentObj->ID?>" >
	<img  class="rightImage" src="<?php echo $value['image']?>"/>
	</a>
		<?php echo $value['description']?>
	<p/>
	<a class="linkItem" href="<?php echo $value['url'] . '?p=' . $contentObj->ID?>" >
	<span style="color:#BBBBFF"><?php if($value['type'] == 'video'){ echo _("Watch the video ..."); } else { echo _("Read the article ...");}?></span></a>
</div>
<?php } ?>
<?php }?>
</div>
</div>
</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->
<script>
function pagePreferences() {
}
</script>
