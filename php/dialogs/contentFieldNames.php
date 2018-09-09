<?php
/*--------------------------------------------------------------------------------------------
 * contentFieldNames.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 $contentFieldNames = array(
		'parent' => 'parentId',
		'permalink' => 'permalink',
		'title' => 'title',
		'menu-name' => 'title',
		'sequence' => 'sequence',
		'menuType' => 'menuType',
		'status' => 'status',
		'target' => 'target',
		'description' => 'shortDescription',
		'owner' => 'ownerId',
		'page-type' => 'pageType',
		'page-argument' => 'pageArgument',
		'gallery-image' => 'galleryImage',
		'article-file' => 'articleFile',
		'article-url' => 'articleURL',
		'article-image' => 'articleImage',
		'article-description' => 'articleDescription',
		'og-type' => 'ogType',
		'author-name' => 'author-name',
		'author-link' => 'author-link',
		'user-select' => 'userSelect',
		'language' => 'languageCode',
		'menu-id' => 'menuId',
		'content-id' => 'contentId',
		'name' => 'name',
		'user-group' => 'groupId',
		'password' => 'password',
		'user-type' => 'type',
		'username' => "username"
		
);


$menuGroupsFieldNames = array(
	array('Parent', 'parentId'),
	array('Page', 'contentId'),
	array('seq', 'mgseq'),
	array('Menu', 'menuId')				
);

$headersFieldNames = array(
	'contentId',
	'seq',
	'headerRecord'			
);
?>