<?php
/*--------------------------------------------------------------------------------------------
 * user-admin_content.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $sqlObject;
global $dataArrays;
global $contentFieldNames;
global $userObj;
global $contentObj;

$dataArrays->get_userGroupsArray( $dbObj, $sqlObject );

$userListArray = array(
		array(
				array('<div class="icon icon-bin">', 'width:2%;text-align:right;padding:0.5em 0.5em'),
				array('User Name', 'width:30%; text-align:center; padding:0.5em 0.5em'),
				array('Type', 'width:5%; text-align:center; padding:0.5em 0.5em 0.5em 0em'),
				array('Full Name', 'width:63%; text-align:center; padding:0.5em 0.5em 0.5em 0em'),
		)
);

if(isset($dbObj))
if( ! $dbObj->query($sqlObject->sqlUsers)) {
	$dbObj->error = "users_content.php: an sql error occurred:<br><br>" . $dbObj->error .
	"<br><br>" . $sqlObject->sqlUsers;
} else {

	for( $i = 1; $row = mysqli_fetch_array($dbObj->result); $i++ ) {
		$userListArray[$i] = array(
				array('<input type="checkbox" name="checkbox_' . $i . '" value="' . $row['ID'] . '">', 'width:2%'),
				array($row['username'], 'width:30%;padding:0em 0em 0em 0.5em'),
				array('<input style="width:4em" type="number" name="type_' . $i . '" value="' . $row['type'] . '">' . '<input hidden type="number" name="userId_' . $i . '" value="' . $row['ID'] . '">', 'width:5%;padding:0em 0em 0em 0em'),
				array('<a class="tableLinkItem" href="' . WEBAPP . $row['permalink'] . '">' . $row['fullName'] . '</a>', 'width:63%;padding:0em 0em 0em 0.5em'),
		);
	}

}

$settingsArrayUsers = array('header' => true, 'height' => '16em');

/*----------
 * set up for user groups list scroll table
 */

$groupListArray = array(
		array(
				array('<div class="icon icon-bin">', 'width:2%;text-align:right;padding:0.5em 0.5em'),
				array('Group Name', 'width:48%; text-align:center; padding:0.5em 0.5em'),
				array('User Name', 'width:48%; text-align:center; padding:0.5em 0.5em 0.5em 0em'),
		)
);

if( ! $dbObj->query($sqlObject->sqlUserGroupList)) {
	$dbObj->error = "user-groups_content.php: an sql error occurred:<br><br>" . $dbObj->error .
	"<br><br>" . $sqlObject->sqlUserGroupList;
} else {

	for( $i = 1; $row = mysqli_fetch_array($dbObj->result); $i++ ) {
		$groupListArray[$i] = array(
				array('<input type="checkbox" name="checkbox_' . $i . '" value="' . $row['ID'] . '">', 'width:2%'),
				array($row['shortDescription'], 'width:48%;padding:0em 0em 0em 0.5em'),
				array($row['fullname'], 'width:48%;padding:0em 0em 0em 0.5em'),
		);
	}

}

$settingsArrayGroups = array('header' => true, 'height' => '24em');


?>
<div id="contentContainer" class="contentContainer">
<div id="content" class="content" style="padding:1em 1em">
<?php get_contentMenu($contentObj)?>
<div id="mainContent" style="padding: 0em 0em 0.01em 0.01em;height:100%">

<table class="wb-dialog" style="width:90%;padding:0.5em;margin:0em auto">
<tr>
	<td style="width:45%;vertical-align:top">
		<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
		<div class="pagecomponent">
		<?php set_dlgHeader('add-user','')?>
		<div style="padding:1em">
		<?php set_addUserWidget( $contentObj,$dataArrays,$contentFieldNames)?>
		</div>
		<input style="margin:0.5em 0em 1em 1em" type="submit" name="addUser" value="Add User"/>
		</div>
		</form>
	</td>
	<td style="width:55%;vertical-align:top">
		<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
		<div class="pagecomponent">
		<?php set_dlgHeader('user-list','')?>
		<?php set_scrollTableWidget($userListArray, $settingsArrayUsers)?>
		<input style="margin:0.5em 0em 1em 1em" type="submit" name="updateUser" value="Update User(s)"/>
		</div>
		</form>
	</td>
</tr>
</table>
<p/>
<table class="wb-dialog" style="width:90%;padding:0.5em;margin:0em auto">
<tr>
<td style="width:40%">
	<div class="pagecomponent">
	<?php set_dlgHeader('add-user-to-group','')?>
	<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
	<div style="padding:0.5em">
		<div style="margin:0.5em 0em"><?php echo 'select-user-group' ?></div>
		<?php set_selectWidget($dataArrays->userGroupsArray, $contentFieldNames['user-group'], $userObj->ID)?>
		<div style="margin:0.5em 0em"><?php echo 'select-user' ?></div>
		<?php set_selectWidget($dataArrays->usersArray, $contentFieldNames['owner'], $userObj->ID)?>
		<input style="margin:1em 0em 0.25em 0em" type="submit" name="addToGroup" value="Add User to Group"/>
		<input style="margin:1em 0em 0.25em 0em;float:right" type="submit" name="deleteGroup" value="Delete Selected Group"/>
	</div>
	</form>
	</div><!-- close pagecomponent --> 
</td>
<td rowspan="2" style="width:60%;vertical-align:top">
	<div class="pagecomponent">
	<?php set_dlgHeader('user-group-list','')?>
	<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
	<?php set_scrollTableWidget($groupListArray, $settingsArrayGroups)?>
	<input style="margin:0.75em 0.5em" name="deleteGroupList" type="submit" value="Delete User(s) from group(s)"/>
	</form>
	</div><!-- close pagecomponent -->
</td>
</tr>
<tr>
<td style="width:40%">
	<div class="pagecomponent">
	<?php set_dlgHeader('add-user-group','')?>
	<form method="post" action="<?php echo WEBAPP . htmlspecialchars($contentObj->permalink)?>">
	<input type="text" name="lang" value="<?php echo $contentObj->lang?>" hidden="true"/>
	<div style="padding:0.5em">
		<div style="margin:0.5em 0em;width:20%"><?php echo 'name' ?></div>
		<div><input type="text" name="<?php echo $contentFieldNames['name'] ?>"/></div>
		<div style="margin:0.5em 0em;width:20%"><?php echo 'description' ?></div>
		<div><input type="text" name="<?php echo $contentFieldNames['description'] ?>"/></div>
		<div><input style="margin:1em 0em 0.5em 0em" type="submit" name="addGroup" value="Add Group"/></div>
	</div>
	</form>
	</div><!-- close page component -->
</td>
</tr>
</table>

</div> <!-- close mainContent -->
</div> <!-- close content -->
</div> <!-- close content container -->

