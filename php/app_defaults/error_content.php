<?php 
/*--------------------------------------------------------------------------------------------
 * error_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $contentObj; 
?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content fontSpecMedium">
<?php get_contentMenu($contentObj) ?>
<?php get_rightbar($contentObj)?>
<div id="mainContent" style="padding: 0em 0em 0.03em 0em;border-top: 1px solid grey">
	<div class="fontSpecMedium">&nbsp;</div>	
	<div class="fontSpecSmall" style="text-align:center"><?php echo $contentObj->db_error ?></div>
</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->
