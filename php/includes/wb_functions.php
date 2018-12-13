<?php
/*--------------------------------------------------------------------------------------
 * wb_functions.php
 * 
 * 1. Check the application source directory for the specified form file.
 * 2. No? Ok, check for the right form name in the app_defaults directory
 * 3. No? Set the contentObj error message and error form and check for a default form in the application directory.
 * 4. If a default form isn't found in the application directory use the default form in the app_defaults directory.
 * 5. If the pageType isn't set, the contentObj wasn't set so check for a default form in
 *    the application directory and if not found use the default form in the app_defaults directory.   
 * 
 * Copyright 2015 2016 2017 2018 by John Gambini
 --------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------
 * get_header()
 * 
 * 
 --------------------------------------------------------------------------------------*/
function get_header(dbContent $contentObj)
{
	if( isset($contentObj->pageType) ) {

		if( file_exists( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_header.php'))
			//echo 'sourceDir ' . $contentObj->pageType . '_header.php<br/>';
			require_once( $contentObj->sourceDir . "\\" .  $contentObj->pageType . '_header.php');

		else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_header.php'))
			//echo 'workbench ' . $contentObj->pageType . '_header.php<br/>';
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_header.php');

		else if( file_exists( $contentObj->sourceDir . "\\" .  'default_header.php'))
			//echo 'sourceDir default_header.php<br/>';
			require_once( $contentObj->sourceDir . "\\" . 'default_header.php');

		else  if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_header.php')){
			//echo 'workbench default_header.php<br/>';
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_header.php');

		} else {
			$contentObj->db_error = $contentObj->db_error . "The default_header.php file was not found.<p/>";
			$contentObj->pageType = 'error';
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		}
				
	}
	else if( file_exists( $contentObj->sourceDir . "\\" . 'default_header.php'))
		require_once( $contentObj->sourceDir . "\\" . 'default_header.php');
		
	else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_header.php'))
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_header.php');
		
	else {
		$contentObj->db_error = $contentObj->db_error . "The default_header.php file was not found.<p/>";
		$contentObj->pageType = "error";
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
	}
	
}

/*--------------------------------------------------------------------------------------
 * get_content()
 * 
 * The steps are a little different for content. 
 * 
 * Check for the form name in the application directory and then in the app_defaults directory
 * but if it's not found set the contentObj's error message and set the page type to "error".
 * As with the others, if the page type isn't set, the contentObj was not set so check
 * for the default_content.php first in the application directory and then in the app_defaults dir.
 --------------------------------------------------------------------------------------*/
function get_content(dbContent $contentObj)
{
	if( isset($contentObj->pageType) ) {
		
		if( file_exists( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_content.php'))
			require_once( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_content.php');
		
		else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_content.php'))
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_content.php');
		
		else {
			$contentObj->db_error = $contentObj->db_error . "The " . $contentObj->pageType . "_content.php file was not found.<p/>";
			$contentObj->pageType = 'error';
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		}
					
	}
	else if( file_exists( $contentObj->sourceDir . "\\" . 'default_content.php'))
		require_once( $contentObj->sourceDir . "\\" . 'default_content.php');
	
	else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_content.php'))
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_content.php');
	
	else {
		$contentObj->db_error = $contentObj->db_error . "The default_content.php file was not found.<p/>";
		$contentObj->pageType = "error";
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
	}

}

/*--------------------------------------------------------------------------------------
 * get_footer()
 * 
 * 
 --------------------------------------------------------------------------------------*/
function get_footer(dbContent $contentObj)
{
	if( isset($contentObj->pageType) ) {
		
		if( file_exists( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_footer.php'))
			require_once( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_footer.php');
		
		else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_footer.php'))
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_footer.php');
		
		else if( file_exists( $contentObj->sourceDir . "\\" . 'default_footer.php'))
			require_once( $contentObj->sourceDir . "\\" . 'default_footer.php');
		
		else  if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_footer.php'))
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_footer.php');
		
		else {
			$contentObj->db_error = $contentObj->db_error . "The default_footer.php file was not found.<p/>";
			$contentObj->pageType = 'error';
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		}
					
	}
	else if( file_exists( $contentObj->sourceDir . "\\default_footer.php"))
		require_once( $contentObj->sourceDir . "\\default_footer.php");
	
	else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\default_footer.php'))
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\default_footer.php');
	
	else {
		$contentObj->db_error = $contentObj->db_error . "The default_footer.php file was not found.<p/>";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
	}
}

/*--------------------------------------------------------------------------------------
 * get_menu()
 * 
 * 
 --------------------------------------------------------------------------------------*/
function get_menu(dbContent $contentObj)
{
	if( isset($contentObj->pageType) ) {
		
		if( file_exists( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_menu.php'))
			require_once( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_menu.php');
		
		else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_menu.php'))
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_menu.php');
		
		else if( file_exists( $contentObj->sourceDir . '\\default_menu.php'))
			require_once( $contentObj->sourceDir . '\\default_menu.php');
		
		else  if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_menu.php')){
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_menu.php');
			
		} else {
			$contentObj->db_error = $contentObj->db_error . "The default_menu.php file was not found.<p/>";
			$contentObj->pageType = 'error';
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		}
				
	}
	else if( file_exists( $contentObj->sourceDir . "\\" . 'default_menu.php'))
		require_once( $contentObj->sourceDir . "\\" .  'default_menu.php');
		
	else if( file_exists( WEBROOT . '/../workbench/php/app_defaults/default_menu.php'))
		require_once( WEBROOT . '/../workbench/php/app_defaults/default_menu.php');
	
	else {
		$contentObj->db_error = $contentObj->db_error . "The default_menu.php file was not found.<p/>";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
	}
}

/*--------------------------------------------------------------------------------------
 * get_sidebar()
 * 
 * 
 --------------------------------------------------------------------------------------*/
function get_sidebar(dbContent $contentObj)
{
	if( isset($contentObj->pageType) ) {
		
		if( file_exists( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_sidebar.php'))
			require_once( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_sidebar.php');
		
		else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_sidebar.php'))
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_sidebar.php');
		
		else if( file_exists( $contentObj->sourceDir . "\\" . 'default_sidebar.php'))
			require_once( $contentObj->sourceDir . "\\" . 'default_sidebar.php');
		
		else  if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_sidebar.php')){
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_sidebar.php');
			
		} else {
			$contentObj->db_error = $contentObj->db_error . "The default_sidebar.php file was not found.<p/>";
			$contentObj->pageType = 'error';
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
		}
					
	}
	else if( file_exists( $contentObj->sourceDir . "\\" . 'default_sidebar.php')){
		require_once( $contentObj->sourceDir . "\\" . 'default_sidebar.php');
		
	} else  if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_sidebar.php')){
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_sidebar.php');
		
	} else {
		$contentObj->db_error = $contentObj->db_error . "The default_sidebar.php file was not found.<p/>";
		$contentObj->pageType = 'error';
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'error_content.php');
	}
}

/*--------------------------------------------------------------------------------------
 * get_contentMenu()
 *
 *
 --------------------------------------------------------------------------------------*/
function get_contentMenu(dbContent $contentObj)
{
	global $errorMessage;
	
	if( isset($contentObj->pageType) ) {

		if( file_exists( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_contentMenu.php'))
			require_once( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_contentMenu.php');

			else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_contentMenu.php'))
				require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_contentMenu.php');

				else if( file_exists( $contentObj->sourceDir . '\\default_contentMenu.php'))
					require_once( $contentObj->sourceDir . '\\default_contentMenu.php');

					else  if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_contentMenu.php')){
						require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_contentMenu.php');
							
					} else {
						$errorMessage = $errorMessage . "The default_contentMenu.php file was not found.<p/>";
					}

	}
	else if( file_exists( $contentObj->sourceDir . "\\" . 'default_contentMenu.php'))
		require_once( $contentObj->sourceDir . "\\" .  'default_contentMenu.php');

		else if( file_exists( WEBROOT . '/../workbench/php/app_defaults/default_contentMenu.php'))
			require_once( WEBROOT . '/../workbench/php/app_defaults/default_contentMenu.php');

			else {
				$errorMessage = $errorMessage . "The default_contentMenu.php file was not found.<p/>";
			}
}

/*--------------------------------------------------------------------------------------
 * get_rightbar()
 *
 *
 --------------------------------------------------------------------------------------*/
function get_rightbar(dbContent $contentObj)
{
	global $errorMessage;
	
	if( isset($contentObj->pageType) ) {
		
		if( file_exists( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_rightbar.php'))
			require_once( $contentObj->sourceDir . "\\" . $contentObj->pageType . '_rightbar.php');
		
		else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_rightbar.php'))
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . $contentObj->pageType . '_rightbar.php');
		
		else if( file_exists( $contentObj->sourceDir . "\\" . 'default_rightbar.php'))
			require_once( $contentObj->sourceDir . "\\" . 'default_rightbar.php');

		else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_rightbar.php')) {
			require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_rightbar.php');
		} else {
			$errorMessage = $errorMessage . "The default_rightbar.php file was not found.<p/>";
			$isRighbarSet = false;
		}
				
	}
	else if( file_exists( $contentObj->sourceDir . "\\" . 'default_rightbar.php')){
		require_once( $contentObj->sourceDir . "\\" . 'default_rightbar.php');

	} else if( file_exists( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_rightbar.php')) {
		require_once( WORKBENCH_DIR . '\\php\\app_defaults\\' . 'default_rightbar.php');
	} else {
		$errorMessage = $errorMessage . "The default_rightbar.php file was not found.<p/>";
		$isRighbarSet = false;
	}
}

/*--------------------------------------------------------------------------------------
 * get_linkSpec()
 *
 *
 --------------------------------------------------------------------------------------*/
function get_linkSpec(dbContent $contentObj)
{
	$linkSpec = WEBAPP . htmlspecialchars($contentObj->permalink);
	
	$i = 0;
	foreach( $_GET as $key => $value) {
		if($i == 0) $linkSpec = $linkSpec . "?";
		if($i > 0) $linkSpec = $linkSpec . "&";
		$linkSpec = $linkSpec . $key . "=" . $value;
		$i++;
	}
	
	return $linkSpec;
}

/*--------------------------------------------------------------------------------------
 * replace_wb_variable()
 *
 *
 --------------------------------------------------------------------------------------*/
/*
function replace_wb_variable($subject)
{
	
	return preg_replace_callback_array(
			[
					'#(\[\[)\s*(content-dir)\s*(\]\])#' => function($match) {
						echo CONTENTDIR;
					},
					'#(\[\[)\s*(workbench-dir)\s*(\]\])#' => function($match) {
						echo WORKBENCH_FOLDER;
					}
			],
			$subject
			);
			
}
*/			
function replace_wb_variable($subject, wbDatabase $dbObj, dbUser $userObj, dbContent $contentObj = NULL, wbSql $sqlObject = NULL, wbDataArrays & $dataArrays = NULL)
{
	global $debugMessage;
	if(DEBUG_VERBOSE) $debugMessage = $debugMessage . "replace_wb_variable() was called.<br/>";
	
	$patternArray = array(
		'#(\[\[)\s*(web-app)\s*(\]\])#',
		'#(\[\[)\s*(content-dir)\s*(\]\])#',
		'#(\[\[)\s*(pdf-dir)\s*(\]\])#',
		'#(\[\[)\s*(workbench-dir)\s*(\]\])#',
		'#(\[\[)\s*(article-image)\s*(\]\])#',
		'#(\[\[)\s*(article-description)\s*(\]\])#',
		'#(\[\[)\s*(article-title)\s*(\]\])#',
		'#(\[\[)\s*(article-file)\s*(\]\])#',
		'#(\[\[)\s*(gallery-widget)\s*(\]\])#',
		'#(\[\[)\s*(articles-widget)\s*(\]\])#',
		'#(\[\[)\s*(languages-widget)\s*(\]\])#',
		'#(\[\[)\s*(profile-image)\s*(\]\])#',
		'#(\[\[)\s*(profile-bio)\s*(\]\])#',
		'#(\[\[)\s*(gallery-widget\(1\))\s*(\]\])#',
		'#(\[\[)\s*(gallery-widget\(2\))\s*(\]\])#',
		'#(\[\[)\s*(gallery-widget\(3\))\s*(\]\])#',
		'#(\[\[)\s*(gallery-widget\(4\))\s*(\]\])#',
		'#(\[\[)\s*(articles-widget\(1\))\s*(\]\])#',
		'#(\[\[)\s*(articles-widget\(2\))\s*(\]\])#',
		'#(\[\[)\s*(articles-widget\(3\))\s*(\]\])#',
		'#(\[\[)\s*(articles-widget\(4\))\s*(\]\])#',
		'#(\[\[)\s*(article-header)\s*(\]\])#',
		'#(\[\[)[\s]*(EditGroupOnly:)([\s\S]*)(\]\])#'
	);
	
	$replaceArray = array(
		WEBAPP,
		CONTENTDIR,
		PDFDIR,
		WORKBENCH_FOLDER,
		isset($contentObj) ? $contentObj->articleImage : "<span style='color:red'>no content object</span>",
		isset($contentObj) ? $contentObj->articleDescription : "<span style='color:red'>no content object</span>",
		isset($contentObj) ? $contentObj->title : "<span style='color:red'>no content object</span>",
		isset($contentObj) ? $contentObj->articleFile : "<span style='color:red'>no content object</span>",
		isset($dataArrays) ? get_galleryWidgetString( $contentObj, $dataArrays->get_galleryItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_articlesWidgetString( $contentObj, $dataArrays->get_articleItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_languagesString( $contentObj, $dataArrays) : "<span style='color:red'>no data array object</span>",
		isset($contentObj) ? CONTENTDIR . $contentObj->ownerImage : "<span style='color:red'>no content object</span>",
		isset($contentObj) ? $contentObj->ownerBio : "<span style='color:red'>no content object</span>",
		isset($dataArrays) ? get_galleryWidgetString( $contentObj, $dataArrays->get_galleryItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_galleryWidgetString( $contentObj, $dataArrays->get_rightbarItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_galleryWidgetString( $contentObj, $dataArrays->get_articleItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_galleryWidgetString( $contentObj, $dataArrays->get_pageItems4Array($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_articlesWidgetString( $contentObj, $dataArrays->get_galleryItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_articlesWidgetString( $contentObj, $dataArrays->get_rightbarItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_articlesWidgetString( $contentObj, $dataArrays->get_articleItemsArray($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($dataArrays) ? get_articlesWidgetString( $contentObj, $dataArrays->get_pageItems4Array($dbObj, $sqlObject)) : "<span style='color:red'>no data array object</span>",
		isset($contentObj) ? get_articleHeaderString( $userObj, $contentObj) : "<span style='color:red'>no data array object</span>",
		can_user_edit($userObj, $contentObj) ? "$3" : ""
	);
	
	return preg_replace($patternArray,$replaceArray,$subject);
}

/*--------------------------------------------------------------------------------------
 * can_user_edit()
 * You can update an article if your user priveledge is greater than the content owner's
 * and your in the same group as the content's status 
 --------------------------------------------------------------------------------------*/
function can_user_edit( dbUser $userObj, dbContent $contentObj, $canEditOverride = 0 )
{
	/* for now this is only for profile, image, gallery and article pages */
	/* this is only for the article edit link, for edit attributes see can_user_edit_attribute */
	if($contentObj->canEdit < 1 and $canEditOverride < 1 )
		return false;
	
	if($contentObj->ownerId <> $userObj->ID) {
		if(in_array($contentObj->status,$userObj->groupsArray)) {
			if($userObj->type <= $contentObj->ownerType) {
				return false;
			}
			return true;
		}
		if($userObj->type < 4 )
			return false;
	}

	return true;	
}

/*--------------------------------------------------------------------------------------
 * can_user_edit_attributes()
 * You can update page attributes if your user priveledge is greater than the content owner's
 * and your in the same group as the content's status
 --------------------------------------------------------------------------------------*/
function can_user_edit_attributes( dbUser $userObj, dbContent $contentObj )
{
	/* for now this is only for profile, image, gallery and article pages */
	//if($contentObj->pageType != 'profile' and $contentObj->pageType != 'article' and $contentObj->pageType != 'image' and $contentObj->pageType != 'gallery' )
	//	return false;

		if($contentObj->ownerId <> $userObj->ID) {
			if(in_array($contentObj->status,$userObj->groupsArray)) {
				if($userObj->type <= $contentObj->ownerType) {
					return false;
				}
				return true;
			}
			if($userObj->type < 4)
				return false;
		}

		return true;
}
