<?php
/*--------------------------------------------------------------------------------------------
* profile_sidebar.php
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
<?php echo get_languagesString($contentObj,$dataArrays) ?>
<?php set_articleEditSidebarWidget($dbObj, $contentObj, $userObj,$sqlObject, $dataArrays)?>
	<div class="wb-dialog">
	  <div style="margin:1em">
		<img class="leftBarImage" style="border-radius:8px" src="<?php echo CONTENTDIR . $contentObj->ownerImage ?>"/>
		<p/>
		<?php echo $contentObj->ownerBio ?>
	  </div>
	</div>
</div>
</div> <!-- close sidebar -->
</div> <!-- sidebar container -->




