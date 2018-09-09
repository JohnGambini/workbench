<?php
/*--------------------------------------------------------------------------------------------
 * articleEditLink.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
function set_articleEditLink(dbContent $contentObj, dbUser $userObj) {
?>
<span style="float:right;vertical-align:middle;margin:7px 0em;margin:1em 0.5em">
<?php 
	if(can_user_edit($userObj,$contentObj)) { ?>
		<a id="articleEditLink" href="javascript:void(0)" onclick="articleEdit()">Edit</a>
	<?php 
	}
?>
</span>
<?php } ?>