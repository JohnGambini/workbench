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
<?php header('Content-Type: charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="<?php echo $contentObj->lang ?>">
<head>
	<meta charset="UTF-8">
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
	<link rel="shortcut icon" href="<?php echo SITE_NAME . SUBSITE_NAME ?>/favicon.ico">
	<link rel="stylesheet" href="<?php echo WORKBENCH_FOLDER ?>/css/dialogs.css" type="text/css" media="screen">
	<style>
	a.menuItem { text-decoration:none; color:inherit; }
	a.menuItem:hover { text-decoration:underline; color:inherit; text-shadow:0px 0px #000000; }
	a.linkItem { text-decoration:none; color:#000099; }
	a.linkItem:hover { text-decoration:underline; text-shadow: 0px 0px #000000;	}
	a.sidebarLinkItem { text-decoration:none; color:inherit; }
	a.sidebarLinkItem:hover { text-decoration:underline; }
	a.sidebarHighlightLinkItem { text-decoration:underline; color:inherit; }
	a.sidebarHighlightLinkItem:hover { text-decoration:underline; }
	#articleEdit { position: fixed; display: block; margin:0em 1em; width:60%; border-radius:10px; color:white; top:120%; opacity:0; z-index:10; transition: top 1s, opacity 1s; }
	#articleEditSidebarWidget { position: fixed; display: block; margin:0em 1em; width:18%; color:white; left:-120%; opacity:0; z-index:10; transition: left 1s, opacity 1s; }
	#popupContentMenu { position: fixed; display: none; font-family: verdana, tahoma, arial, sans-serif; padding: 0.5em 2em 0.5em 0em; top:0; left:0; z-index:11; }
	#popupUserMenu { position: fixed; display: none; font-family: verdana, tahoma, arial, sans-serif; padding: 0.5em 1em 0.5em 0em; border-radius:10px; border:2px solid black; font-size:10pt; color: black; top:0; left:0; z-index:11; }
	#popupLanguages { display:none;	}
	#popupMainMenu { display:none; }
	#popupHr { display:none; }
	@media all and (max-width:699px) { #popupLanguages { display:block; } #popupMainMenu { display:block; } #popupHr { display:block; } }
	</style>
	<style>
	body { margin: 0; padding: 0; height: 100vh; }
	img { display: block; width: 100%; height: auto; }
	.fontSpecMenuList { font-family: times-new-roman; font-size: medium; }
	.fontSpecTitle { font-family: times-new-roman; font-size: Large; }
	.fontSpecLogin { font-family: times-new-roman; font-size: small; }
	.fontSpecVerySmall { font-family: times-new-roman; font-size:small }
	.fontSpecSmall { font-family: times-new-roman; font-size:medium; }
	.fontSpecMedium { font-family: times-new-roman; font-size:large; }
	.fontSpecLarge { font-family: times-new-roman; font-size:x-large; }
	.fontSpecVeryLarge { font-family: times-new-roman; font-size:xx-large; }
	ul.minimenu { list-style: none; padding: 0px; width: 100%; height:100%; vertical-align:middle; }
	.minimenu li { display: inline-block; text-align: center; padding: 0px 2px; height:100%; }
	.wb-icon::before { display: inline-block; width: 60px; text-align: center; text-transform: none; font-weight: normal; font-style: normal; font-variant: normal; font-family: 'ecoicons'; line-height: 1; speak: none; font-smoothing: antialiased; -webkit-font-smoothing: antialiased; -moz-font-smoothing: antialiased; }
	.wb-icon-menu::before { margin-left: -6px; vertical-align: 0px; width: 24px; height: 3px; background: #5f6fA1; box-shadow: 0 -6px #5f6fA1, 0 -12px #5f6fA1; text-shadow: 3px 3px #E4E4FF; content: ''; }
	.wb-icon-menu:hover::before { background: #AAAAAA; box-shadow: 0 -6px #AAAAAA, 0 -12px #AAAAAA; content: ''; }
	.icon-circle-down::before { color: #888888; font-size:14pt; vertical-align: -4px; }
	.icon-circle-down:hover::before { color: #000000; }
	.icon-point-up::before { color: #999999; font-size: 14pt; vertical-align: 4px; }
	.icon-point-up:hover::before { color: #000000; }
	.icon-arrow-up2::before { color: #888888; font-size: 14pt; vertical-align: -2px; }
	.icon-arrow-up2:hover::before { color: #000000; }
	.mainmenu { display:flex; align-items:center; position:fixed; top: -2.5em; left: 0px; width: 100%; height: 3.50em; z-index:1; background-color:white; box-shadow: 0px 2px 12px #888888; transition: top 0.5s; }
	#mainmenuItem1 { flex:1 1 19%; }
	#mainmenuItem2 { flex:1 1 15%; }
	#mainmenuItem3 { flex:1 1 45%; }
	#mainmenuItem4 { flex:1 1 20%; }
	.contentContainer { position: relative; top: 0px; float:left; width: 82%; height: inherit; overflow-y: hidden; }
	.content { display:block; position: relative; width: 100%; height:100%; opacity: 0; overflow-y: auto; transition: opacity 1s; }
	.contentMenu { 
		position:fixed; 
		top:0; 
		display: flex; 
		display: -ms-flexbox; 
		display: -webkit-flex; 
		width:100%; 
		align-items: center;
		-ms-flex-align: center; 
		-webkit-align-items: center; 
		-webkit-box-align: center; 
		height:3.0em; 
		z-index: 3; 
	}
	.transparentContentMenu { 
		position:fixed; 
		top:0; 
		display: flex; 
		display: -ms-flexbox; 
		display: -webkit-flex; 
		width:100%; 
		align-items: center; 
		-ms-flex-align: center; 
		-webkit-align-items: center; 
		-webkit-box-align: center; 
		height:3.0em; 
		z-index: 3; 
	}
	.mainContent { display:block; position: relative; width:inherit; height:inherit; top: 0; }
	.sidebarContainer { position: relative; top:0px; float:left; width: 18%; height: 100%; overflow-y: hidden; border-right: 1px solid #AAAAAA; }
	.sidebar { display: flex; flex-direction: column; position: relative; top: 0; width: 100%; height: 100%; overflow-y: auto; overflow-x: wrap; }
	.rightbar { display:block; position: relative; float:right; border-left: 1px solid #AAAAAA; width:18%; height:100%; padding:0.6em; }
	.leftMargin { margin:0em 0.5em 0em 17% }
	.forMobileOnly { display: none }
	.leftBar { width:16%;float:left;margin:0em 0em 1em 0em }
	.leftBarImage {width:80%;margin:0em auto; float:none }
	@media all and (max-width:760px) { 
		.sidebarContainer { display:none; } 
		.contentContainer { width:100%; }
		#mainmenuItem2 {display:inline-block;} 
		.rightbar { display:none; } 
		.leftMargin { margin:0em 0.5em }
		.forMobileOnly { display: block }
		.leftBar { width:100%;float:none }
		.leftBarImage {width:20%; float:left; margin:0em 1em 0em 0em }
	}
	.gallery {}
	.parallax { width:inherit; height:100%; color:white; text-shadow: 1px 1px #004400; background-position:center; background-size:cover; background-repeat:no-repeat;background-attachment:fixed}
	.imageContent { background-color:#EEEEEE; border-radius: 8px; border: 1px solid #0000DD; min-height:75%; margin-top: 10px; margin-bottom: 0.5em; font-smoothing: antialiased; -webkit-font-smoothing: antialiased; -moz-font-smoothing: antialiased; }
	ul.imagefooter { list-style: none; margin: 0em 2em; padding: 0px; }
	.imagefooter li { display: inline-block; text-align: left; font-style: italic; }
	.featuredItemMain { display:inline-block; width:97.5%; vertical-align:top;margin:0em 0em 1% 1%;padding:1em;border:1px solid #AAAADD; border-radius:5px; box-shadow: 2px 2px 10px #333355 }
	.featuredItem { display:inline-block; width:48%; vertical-align:top;margin:0em 0em 1% 1%;padding:1em;border:1px solid #AAAADD; border-radius:5px; box-shadow: 2px 2px 10px #333355 }
	.featuredItem img { outline:1px solid #333399; color:inherit; border-radius:5px }
	.featuredItem img:hover { outline:1px solid #F0000F; color:inherit; border-radius:5px }
	.featuredItemMain img { outline:1px solid #333399; color:inherit; border-radius:5px }
	.featuredItemMain img:hover { outline:1px solid #F0000F; color:inherit; border-radius:5px }
	.featuredItemMain .MainImage { width:50%; float:left; margin:0em 2em 1em 0em; }
	.featuredItem .LeftImage { width:33%; float:left; margin:0em 2em 1em 0em; border-radius:5px	}
	.featuredItem .RightImage { width:33%; float:right; margin:0em 0em 1em 2em; border-radius:5px }
	@media all and (max-width:760px) { 
		.imageViewer img { float:none; width:100%; margin:0 auto; }
		.featuredItem {width:98%} 
		.featuredItem .MainImage { float:none; width:100%; margin:1em auto; } 
		.featuredItem .LeftImage { float:none; width:100%; margin:1em auto; } 
		.featuredItem .RightImage { float:none; width:100%; margin:1em auto; } 
	}
	@media all and (max-width:760px) { .parallax { background-position:center center; }	}
	#pageTitle:hover { color: #AAAAAA; }
	.siteName { font-family: times-new-roman; font-size: 20pt; }
	.siteName:hover { color: #777777; }
	#userMenu { font-size: 14pt; }
	#userMenu:hover { color: #AAAAAA; }
	#galleryTitle { /*display:none;*/ font-family: times-new-roman; font-size: 18pt; width:100%; text-align:center; margin:0.75em 0em 0.5em 0em; }
	#articleEditLink { margin:auto 0em; vertical-align:center; text-decoration:none; color:inherit; }
	#articleEditLink:hover { text-decoration:underline; color:inherit; text-shadow:0px 0px #000000;	}
	#menugroups { position: relative; opacity: 0; overflow-y: auto; transition: opacity 0.5s; }
	#tabsList { position: relative; left: -20em; transition: left 0.5s; }
	.topicBlock { display: inline-block; height: auto; width:24.5%; padding: 15px 2%; vertical-align:top; text-align: center; }
	.topicBlock img { outline:1px solid #333399; color:inherit; }
	.topicBlock img:hover { outline:1px solid #F0000F; color:inherit; }
	.langElement { vertical-align:middle; height:30px; }
	.langElement a img { width: 26px; margin:2px 0px; border:1px solid black; }
	.langElement a img:hover { width: 26px; margin:2px 0px; border: 2px solid #0000FF; }
	.langElementHighlight { vertical-align:middle; }
	.langElementHighlight a img { width: 28px; outline: 2px solid #AAAAFF; }
	.listBlocks { display:flex;display:-webkit-flex;flex-direction:row;align-items:center;justify-content:left;align-content:center;-webkit-align-content:center }
	@media all and (max-width:760px) { .topicBlock { width:49%; } /* #galleryTitle { display:block; } */ }
	@media all and (max-width:699px) {
		.siteName { display:none; } 
		#userName { display:none; } 
		.listBlocks { flex-direction:column }
	}
	.article { background-color: #FFFFFF; color: #000000; text-shadow: 0px 0px #000000; margin:0em 1em 1em 1em; padding:0em 0em; }
	.articleHeader { background-color: inherit; color: inherit; width:100%; text-align:center; font-size:10pt; margin:0em auto; }
	.articleTab { margin:0em 1%; padding:0em 3%; background-color:#FFFFFF; text-shadow: 0px 0px #000000; height:2em; color:#000000; border-radius:5px 5px 0px 0px; border-bottom:1px solid #CCCCCC }
	.articleTabHighlight { margin:0em 1%; padding:0em 3%; background-color:#FFFFFF; text-shadow: 0px 0px #000000; height:2em; color:#AA0000; border-radius:5px 5px 0px 0px; border-bottom:1px solid #CCCCCC }
	.articleTabs { margin: 1em 2em 0em 3em }
	.firstCharacter:first-letter { color: #B04; float: left; font-family:Georgia; font-size: 2.25em; line-height:0.975em; padding-top: 0em; padding-bottom: 0px; padding-right: 0.08em; padding-left: -0.125em; }
	#articleText { }
	ul.articleHeader { diplay:table-row; list-style: none; margin: 0px; padding: 0px; }
	.articleHeader li { display: table-cell; text-align: left; font-size: 8pt; font-style: italic; vertical-align: bottom; }
	#intro { width:85%; margin:0em auto; }
	.imageViewer { margin:2% 4%; }
	.imageViewer hr { border-style:solid; border-color:#AAAAAA;	}
	a.articleLinkItem { text-decoration:none; color:#2222BB; }
	a.articleLinkItem:hover { text-decoration:underline; text-shadow: 0px 0px #000000;	}
	.webArticle { background-color: inherit; color: inherit; text-shadow: inherit; margin:0em 4%; }
	.webArticle hr { border-style:solid; border-color:#AAAAAA; }
	.newspaper { background-color: inherit; color: inherit; text-shadow: inherit; margin: 0em 4%; -webkit-column-count: 2; /* Chrome, Safari, Opera */ -moz-column-count: 2; /* Firefox */ column-count: 2; -webkit-column-width: 18em; /* Chrome, Safari, Opera */ -moz-column-width: 18em; /* Firefox */ column-width: 18em; -webkit-column-gap: 2em; /* Chrome, Safari, Opera */ -moz-column-gap: 2em; /* Firefox */ column-gap: 2em; }
	.newspaper hr { border-style:solid; border-color:#AAAAAA; }
	.webArticle ul { margin: 0 auto; padding: 0 auto; }
	.newspaper ul { margin: 0 auto; padding: 0 auto; }
	.webArticle ol { margin: 0 auto; padding: 0 auto; }
	.newspaper ol { margin: 0 auto; padding: 0 auto; }
	.webArticle li { padding:0.25em 0em; }
	.newspaper li { padding:0.25em 0em; }
	.articleHeader h1 { font-size: 22pt; font-weight: bold; margin: 10px 0em 10px 0em; text-align:center; width:100% }
	h1 { font-size: 160%; font-weight: bold; margin: 0em 0em 10px 0em; }
	h2 { font-size: 140%; font-weight: bold; margin: 0px 0em 10px 0em; }
	h3 { font-size:105%; font-weight: bold; margin: 0px 0em 0.25em 0em; }
	.underline { text-decoration: underline; }
	.indent { text-indent: 2em; }
	.center { text-align: center; }
	.caption { font-size:8pt; text-indent:0em; }
	.article-dialog { background-color:#FEFEFE; border-radius:10px; border:2px solid #AAAAAA; color: black; text-shadow: 0px 0px #500303; font-smoothing: antialiased; -webkit-font-smoothing: antialiased; -moz-font-smoothing: antialiased; }
	.article-dialog .pagecomponent { width:100%; border:1px solid black; border-radius:7px;	}
	.article-dialog .header { background-color:#AAAAAA; border-radius:6px 6px 0px 0px; color:white; padding:0.25em 1em;	}
	.newspaper table, ul, div, ol { -webkit-column-break-inside:avoid; -moz-column-break-inside:avoid; -o-column-break-inside:avoid; -ms-column-break-inside:avoid; column-break-inside:avoid; }
	.imageViewer img { width:45%; float:left; margin:0em 2% 2% 0%; border:1px solid #DDDDDD; border-radius:5px; }
	.codeBlock { margin:0.5em 0em 0.5em 0.5em; padding:0em 0em 0em 0.5em; border-left:3px solid green; font-family:courier; }
	.rightBlock { width:50%; float:right; margin:0.75em -0.5em 0.75em 1em; }
	.leftBlock { width:50%; float:left; margin:0.75em 1em 0.75em -0.5em; }
	.rightBlockSmall { width:25%; float:right; margin:1em -0.5em 0em 1em; }
	.leftBlockSmall { width:25%; float:left; margin:1em 1em 0em -0.5em; }
	@media all and (max-width:760px) { 
		.article .articleImage { width:89%; } 
		.imageViewer img { float:none; width:100%; margin:0 auto; } 
		.rightBlock { width:95%; float:none; margin:1em auto; } 
		.leftBlock { width:95%; float:none; margin:1em auto; } 
		.rightBlockSmall { width:50%; float:right; margin:1em -0.5em 0em 1em; }
		.leftBlockSmall { width:50%; float:left; margin:1em 1em 0em -0.5em; }
		.featuredItem{} .MainImage { float:none; width:100%; margin:1em auto; } 
		.featuredItem .LeftImage { float:none; width:100%; margin:1em auto; } 
		.featuredItem .RightImage { float:none; width:100%; margin:1em auto; } 
	}
	@media print {
		#mainmenu { display: none; }
		#rightbarContainer { display: none; }
		#content { overflow: hidden; }
	}
	</style>
	<link rel="stylesheet" href="<?php echo WORKBENCH_FOLDER ?>/css/icomoon.css" type="text/css" media="screen"/>
	<link rel="stylesheet" href="<?php echo $contentObj->themeDir ?>/css/calliopesutra.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="<?php echo WORKBENCH_FOLDER ?>/js/workbench.js"></script>
	<script type="text/javascript" async src="/MathJax-2.6/MathJax.js?config=TeX-AMS_SVG"></script>
	<meta http-equiv="Cache-Control" content="no-store" />
</head>
<body id="body">
<!-- This is so javascript:wbAjax has somewhere to grab the web application directory from -->
<input id="webapp" type="text" hidden="true" value="<?php echo WEBAPP ?>"/>
