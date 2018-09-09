<?php 
/*--------------------------------------------------------------------------------------------
 * default_sidebar.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $contentObj;
global $sqlObject;
global $dataArrays;
global $userObj;

?>
<div id="sidebarContainer" class="sidebarContainer">
<div id="sidebar" class="sidebar">
<div style="margin:0em 1em">
<?php set_languages($contentObj,$dataArrays->langArray) ?>
<?php set_articleEditSidebarWidget($dbObj, $contentObj, $userObj,$sqlObject, $dataArrays)?>
<?php set_menuList($dbObj, $contentObj, $sqlObject, $dataArrays)?>
</div>
</div> <!-- close sidebar -->
</div> <!-- sidebar container -->
