<?php

use workbench\utils\StringUtils;

/*--------------------------------------------------------------------------------------------
 * pageTitle.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
function set_pageTitle($contentObj) {

	$linkSpec = ($contentObj->parentPageType == 'parallax' ? '#' . $contentObj->title : '');
	
	if($contentObj->parentId > 0 ) { ?>
	<div>
	<a class="icon icon-arrow-up2 menuItem"  style="text-decoration:none" href="<?php echo WEBAPP . $contentObj->parentPermalink . "?p=" . $contentObj->grandParentId . $linkSpec ?>">
	<span id="pageTitle" class="fontSpecTitle" style="overflow:hidden"><?php echo StringUtils::str_truncate_at(htmlspecialchars($contentObj->parentPermalink),32) ?></span>
	</a>
	</div>
<?php } else { ?>
		<div id="pageTitle" class="fontSpecTitle"><?php echo htmlspecialchars($contentObj->permalink) ?></div>
<?php } ?>

<?php } ?>