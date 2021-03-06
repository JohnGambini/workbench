<?php
/*--------------------------------------------------------------------------------------------
 * load_workbench.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
/* autoload composer installed packages */
require SUBSITE_DIR . '\\vendor\\autoload.php';

session_start();

/*initial objects needed*/
require_once( WORKBENCH_DIR . '\php\objects\wbSql.php');
require_once( WORKBENCH_DIR . '\php\objects\wbDataArrays.php');

$userObj = new dbUser();
$dbObj = new mysqliDatabase();

$errorMessage = NULL;
$successMessage = NULL;
$debugMessage = NULL;
$isArticleEditSet = 0;

if( ! $dbObj->connect(DB_HOST,DB_USER,DB_PASSWORD,DATABASE,DB_CHARSET)) {
	$errorMessage = $dbObj->error . "<br/>";
}

if( empty($_SESSION['userID']) or isset($_GET["signoff"]))
{
	session_destroy();
	session_write_close();

} else if ( $userObj->get_user($dbObj,$_SESSION['userID']) == false ) {
	$errorMessage = $errorMessage . $dbObj->error . "<br/>";
}

//die($userObj->dump());

require_once( WORKBENCH_DIR . '\php\wb_database_updates.php');
require_once( WORKBENCH_DIR . '\php\dialogs\contentFieldNames.php');

/* database updates */
if($userObj->ID != NULL) {
	if( !database_updates($dbObj, $userObj) ) {
		$errorMessage = $errorMessage . $dbObj->error . "<br/>";
		//die($errorMessage);
	}
}

//die();

/* content object */
$contentObj = new dbContent();
$contentObj->set_permalink($_SERVER['REQUEST_URI'], SUBSITE_NAME);

/* This has to come before the content query */
$userObj->get_user_groups($dbObj);

if( ! $contentObj->get_content($dbObj,$userObj)){
	//Sets the page type to error_content if content not found
}
//This needs to come after the database updates in case changeTheme() was called
$contentObj->set_directories($userObj);

//die($contentObj->dump());

// gettext setup
//require_once('../php-gettext/gettext.inc');

$encoding = 'UTF-8';
$domain = 'messages';
$locale = $contentObj->lang;

// Set the text domain as 'messages'
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("messages", LOCALE_DIR);
bind_textdomain_codeset('messages', 'UTF-8');
textdomain("messages");

/*
echo $locale . "\n";
echo LOCALE_DIR . "\n";

if (!function_exists("gettext")){
	echo "gettext is not installed\n";
}
else{
	echo "gettext is supported\n";
}

die(gettext("Read the article ..."));
*/

/* load the rest of workbench */
require_once( WORKBENCH_DIR . '\php\dialogs\errorDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\successDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\user_menus.php');
require_once( WORKBENCH_DIR . '\php\dialogs\addContentDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\editContentDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\tabsDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\rightbarDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\articlesDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\menuGroupsDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\manageMenusDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\changeThemeDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\contentDumpDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\userDumpDlg.php');
require_once( WORKBENCH_DIR . '\php\dialogs\debugDialog.php');
require_once( WORKBENCH_DIR . '\php\dialogs\urlInputDlg.php');

/* more objects */
require_once( WORKBENCH_DIR . '\php\objects\wbDialogs.php');

/* includes */
require_once( WORKBENCH_DIR . '\php\includes\dlgHeader.php');
require_once( WORKBENCH_DIR . '\php\includes\siteNameMenu.php');
require_once( WORKBENCH_DIR . '\php\includes\pageTitle.php');
require_once( WORKBENCH_DIR . '\php\includes\siteUserMenu.php');
require_once( WORKBENCH_DIR . '\php\includes\articleEditLink.php');
require_once( WORKBENCH_DIR . '\php\includes\languages.php');
require_once( WORKBENCH_DIR . '\php\includes\languagesString.php');
require_once( WORKBENCH_DIR . '\php\includes\menuList.php');
require_once( WORKBENCH_DIR . '\php\includes\galleryWidgetString.php');
require_once( WORKBENCH_DIR . '\php\includes\articlesWidgetString.php');
require_once( WORKBENCH_DIR . '\php\includes\articleHeaderString.php');

/* Widgets */
require_once( WORKBENCH_DIR . '\php\widgets\tabsWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\addContentWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\scrollTableWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\selectWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\editContentWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\openGraphWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\articleEditorWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\articleEditSidebarWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\addUserWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\searchBarWidget.php');
require_once( WORKBENCH_DIR . '\php\widgets\galleryWidget.php');
/*
require_once( WORKBENCH_DIR . '\php\includes\\tabsList.php');
*/

$sqlObject = new wbSql();
$sqlObject->Init($userObj,$contentObj);

$dataArrays = new wbDataArrays();
$dataArrays->Init();
//$dataArrays->load_pageItems($dbObj, $sqlObject);

if($userObj->ID != NULL) {
	$dataArrays->getDialogArrays($dbObj, $contentObj, $sqlObject);
}

require_once( WORKBENCH_DIR . '\php\includes\wb_functions.php');

$dialogsObj = new wbDialogs();
$dialogsObj->Init( $userObj, $contentObj );

/* This can go anywhere after the content is loaded and before the page is built */
//$userObj->get_user_bio($dbObj, $contentObj->lang);
$contentObj->get_owner_info($dbObj);
$errorMessage .= $dbObj->error;

/*OK build the page */
get_header($contentObj);
get_menu($contentObj);
get_sidebar($contentObj);
get_content($contentObj);

set_popUpContentMenu($dbObj, $sqlObject);
set_popUpUserMenu($userObj, $contentObj,$dialogsObj);

$dialogsObj->set_dialogs($dbObj, $userObj, $contentObj, $sqlObject, $dataArrays);
$errorMessage = $dbObj->error;

set_errorDlg();
set_successDlg();

get_footer($contentObj);

$dbObj->close();

?>
<?php 
//echo LOCALE_DIR . "<br/>" ;
//print T_("this is message 1");
?>
