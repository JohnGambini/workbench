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

?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content">
<?php get_contentMenu($contentObj) ?>
<div id="mainContent" style="padding:0.01em 0.01em 0.02em 0.09em">
<?php if( can_user_edit($userObj,$contentObj,1)) { set_urlInputDlg(); } ?>
<?php echo get_articleHeaderString( $userObj, $contentObj) ?>
<?php echo get_articlesWidgetString($contentObj, $dataArrays->get_featuredItemsArray($contentObj))?>
<?php  //echo count($dataArrays->get_featuredItemsArray($contentObj));?>

</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->
<script>
function pagePreferences() {
}
</script>
