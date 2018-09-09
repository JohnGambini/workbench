<?php
/*--------------------------------------------------------------------------------------------
 * pdo_load_workbench.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
require_once( WORKBENCH_DIR . '\php\includes\string_utils.php');
require_once( WORKBENCH_DIR . '\php\objects\wbDatabase.php');
require_once( WORKBENCH_DIR . '\php\objects\mysqliDatabase.php');
require_once( WORKBENCH_DIR . '\php\objects\pdoDatabase.php');

require_once( WORKBENCH_DIR . '\php\objects\dbObject.php');
require_once( WORKBENCH_DIR . '\php\objects\dbUser.php');
require_once( WORKBENCH_DIR . '\php\objects\dbContent.php');
require_once( WORKBENCH_DIR . '\php\objects\wbSql.php');
require_once( WORKBENCH_DIR . '\php\objects\wbDataArrays.php');

$userObj = new dbUser();

$errorMessage = NULL;
$successMessage = NULL;
$debugMessage = NULL;

$dbObj = new mysqliDatabase();
if( ! $dbObj->connect(DB_HOST, DB_USER, DB_PASSWORD, DATABASE, DB_CHARSET)) {
	echo $dbObj->error;
	exit;
}

if( empty($_SESSION['userID']) or isset($_GET["signoff"]))
{
	session_destroy();
	session_write_close();

} else if ( $userObj->get_user($dbObj,$_SESSION['userID']) == false ) {
	$errorMessage = $errorMessage . "dbUser::get_user: an error occured during database query<br><br>" . $userObj->db_error . "<p/>"; 
}

//die($userObj->dump());

$contentObj = new dbContent();
$contentObj->set_permalink($_SERVER['REQUEST_URI'], SUBSITE_NAME);

if( ! $contentObj->get_content($dbObj,$userObj)) {
	$errorMessage = $errorMessage . "dbContent::get_content: an error occured during database query:<br/>" . $contentObj->db_error . "<p/>";
}

//This should come after the database updates in case changeTheme() was called
$contentObj->set_directories($userObj);

echo "Error Message: " . $errorMessage . "<br/>";

require_once('../php-gettext/gettext.inc');

$encoding = 'UTF-8';
$domain = 'messages';
$locale = $contentObj->lang;

// gettext setup
T_setlocale(LC_MESSAGES, $locale);
// Set the text domain as 'messages'
T_bindtextdomain($domain, LOCALE_DIR);
T_bind_textdomain_codeset($domain, $encoding);
T_textdomain($domain);

die($contentObj->dump());

/* workbench includes use these objects as globals */
$sqlObject = new wbSql($userObj,$contentObj->ID,$contentObj->lang,$contentObj->parentId);
$dataArrays = new wbDataArrays();


/* load workbench */
require_once(WORKBENCH_DIR . '\php\includes\wb_functions.php');
require_once( WORKBENCH_DIR . '\php\includes\siteNameMenu.php');
require_once( WORKBENCH_DIR . '\php\includes\pageTitle.php');
require_once( WORKBENCH_DIR . '\php\includes\siteUserMenu.php');
require_once( WORKBENCH_DIR . '\php\includes\languages.php');

/* OK now build the page */
get_header($contentObj);
get_bannermenu($contentObj);
get_sidebar($contentObj);
get_content($contentObj);
set_popUpContentMenu();
set_popUpUserMenu($contentObj,$dialogsObj);
set_errorDlg();
get_footer($contentObj);
?>
<?php 
//echo LOCALE_DIR . "<br/>" ;
//print T_("this is message 1");
?>

