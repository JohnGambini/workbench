<?php
/*--------------------------------------------------------------------------------------------
 * dbUpdates.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
session_start();

$old_error_handler = set_error_handler("myErrorHandler");

$errorMessage = '';
$successMessage = '';
$debugMessage = '';

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
	$errorMessage = 'dbUpdates.php: ' . $errstr . ' in ' . $errfile . ' line number: ' . $errline;
	$successMessage = '';
	$debugMessage = 'No debug output.';
	exit(json_encode(array($errorMessage,$successMessage,$debugMessage)));
}

define('ABSDIR', $_SERVER["DOCUMENT_ROOT"] . $_POST['subsite']);

require_once( ABSDIR . '\config\app_defs.php');

/* autoload composer installed packages */
require SUBSITE_DIR . '\\vendor\\autoload.php';

require_once( WORKBENCH_DIR . '\php\objects\wbSql.php');
require_once( WORKBENCH_DIR . '\php\objects\wbDataArrays.php');
require_once( WORKBENCH_DIR . '\php\includes\wb_functions.php');
require_once( WORKBENCH_DIR . '\php\includes\galleryWidgetString.php');
require_once( WORKBENCH_DIR . '\php\includes\articlesWidgetString.php');
require_once( WORKBENCH_DIR . '\php\includes\languagesString.php');
require_once( WORKBENCH_DIR . '\php\includes\articleHeaderString.php');

$userObj = new dbUser();
$dbObj = new mysqliDatabase();

if( ! $dbObj->connect(DB_HOST,DB_USER,DB_PASSWORD,DATABASE,DB_CHARSET)) {
	$errorMessage = $dbObj->error;
	die(json_encode(array($errorMessage,$successMessage,$debugMessage)));
}

if ( $userObj->get_user($dbObj,$_SESSION['userID']) == false ) {
	$errorMessage = $errorMessage . $dbObj->error;
	die(json_encode(array($errorMessage,$successMessage,$debugMessage)));
}

require_once( WORKBENCH_DIR . '\php\wb_database_updates.php');

if(database_updates($dbObj, $userObj) == false) {
	$errorMessage = $errorMessage . $dbObj->error;
	$articleData = array(
			replace_wb_variable($_POST['editor'], $dbObj, $userObj ),
			'Last Modified: ' . date("Y-m-d h:i:sa"),
			//unproccessed text for the client editor
			$_POST['editor']
	);
	die(json_encode(array($errorMessage,$successMessage,$debugMessage,$articleData)));
} else {
	$successMessage = "The database has been successfully updated.";
	$contentObj = new dbContent();
	$contentObj->ID = $_POST['Id'];
	$userObj->get_user_groups($dbObj);
	if($contentObj->get_content_by_id($dbObj,$userObj) == false) {
		$errorMessage = "dbUpdates: " . $contentObj->db_error;
	}
	
	$sqlObject = new wbSql();
	$sqlObject->Init($userObj,$contentObj);
	$dataArrays = new wbDataArrays();
	$dataArrays->Init();

	//$error = 'Always throw this error';
	//throw new Exception($error);
	
	$articleData = array(
			replace_wb_variable("" . $_POST['editor'], $dbObj, $userObj, $contentObj, $sqlObject, $dataArrays),
			'Last Modified: ' . date("Y-m-d h:i:sa"),
			//unproccessed text for the client editor
			"" . $_POST['editor']
	);
	exit(json_encode(array($errorMessage,$successMessage,$debugMessage,$articleData)));
}

//$dbObj->close();

?>