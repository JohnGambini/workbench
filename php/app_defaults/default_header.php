<?php 
/*--------------------------------------------------------------------------------------------
 * default_header.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
global $dbObj;
global $userObj;
global $contentObj;
global $sqlObject;
global $dataArrays;
?>
<!DOCTYPE html>
<html lang="<?php echo $contentObj->lang ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php if( strlen($contentObj->title) == 0 ) { ?>
    <title><?php echo APP_NAME ?></title>
<?php } else { ?>
    <title><?php echo htmlspecialchars($contentObj->title) . " - " . APP_NAME?></title>
<?php } ?>
	<!-- code mirror support -->
	<link rel="stylesheet" href="/codemirror/lib/codemirror.css">
	<script src="/codemirror/lib/codemirror.js"></script>
	<script src="/codemirror/mode/xml/xml.js"></script>
	<script src="/codemirror/addon/selection/active-line.js"></script>
	<style type="text/css">
	.CodeMirror {width:100%;height:37.5em;border-top: 1px solid #888; border-bottom: 1px solid #888;}
	</style>
	<meta name="author" content="<?php echo $contentObj->authorFullName ?>">
	<meta property="og:title" content="<?php echo $contentObj->title ?>" />
	<meta property="og:locale" content="<?php echo $contentObj->lang ?>" />
	<meta property="og:type" content="<?php echo $contentObj->ogType ?>" />
	<meta property="og:url" content="<?php echo SITE_NAME . SUBSITE_NAME . $contentObj->permalink ?>" />
	<meta property="og:image" content="<?php echo replace_wb_variable($contentObj->articleImage, $dbObj, $userObj, $contentObj) ?>" />
	<meta name="description" content="<?php echo htmlspecialchars($contentObj->articleDescription)?>">
	<meta property="og:description" content="<?php echo htmlspecialchars($contentObj->articleDescription) ?>" />
	<meta property="og:site_name" content="<?php echo APP_NAME  ?>" />
	<link rel="shortcut icon" href="<?php echo SITE_NAME . SUBSITE_NAME ?>/favicon.ico">
	<link rel="stylesheet" href="<?php echo WORKBENCH_FOLDER ?>/css/dialogs.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo WORKBENCH_FOLDER ?>/css/workbench.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo WORKBENCH_FOLDER ?>/css/icomoon.css" type="text/css" media="screen"/>

	<!-- css theme specific overides of default workbench css  -->
	<link rel="stylesheet" href="<?php echo $contentObj->themeDir ?>/css/workbench.css" type="text/css" media="screen"/>

	<script type="text/javascript" src="<?php echo WORKBENCH_FOLDER ?>/js/workbench.js"></script>
	<script type="text/javascript" async src="/MathJax-2.6/MathJax.js?config=TeX-AMS_SVG"></script>
	<meta http-equiv="Cache-Control" content="no-store" />
</head>
<body id="body">
<!-- This is so javascript:wbAjax has somewhere to grab the web application directory from -->
<input id="webapp" type="text" hidden="true" value="<?php echo WEBAPP ?>"/>
<input id="workbench_folder" type="text" hidden="true" value="<?php echo WORKBENCH_FOLDER ?>"/>
<input id="pageType" type="text" hidden="true" value="<?php echo $contentObj->pageType ?>"/>
