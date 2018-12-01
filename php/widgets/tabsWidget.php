<?php
/*--------------------------------------------------------------------------------------------
 * tabsWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
 * set_tabsWidget
 *
 *
 -------------------------------------------------------------------------------------*/
function set_tabsWidget(wbDatabase $dbObj, wbSql $sqlObject, wbDataArrays $dataArrays, dbContent $contentObj) {

	$dataArrays->get_tabsArray( $dbObj, $sqlObject, $contentObj->ID);
	reset($dataArrays->tabsArray);
	$tabName = count($dataArrays->tabsArray) ? key($dataArrays->tabsArray) : '';

?>
	<!-- These hold the data needed for the ajax call to the server  -->
	<input id="contentId" hidden="true" type="number" name="contentId" value="<?php echo $contentObj->ID ?>"/>
	<input id="contentLang" hidden="true" type="text" name="contentLang" value="<?php echo $contentObj->lang ?>"/>
	<input id="parentIdent" hidden="true" type="number" name="parentId" value="<?php echo $contentObj->parentId ?>"/>
	<input id="ownerId" hidden="true" type="number" name="ownerId" value="<?php echo $contentObj->ownerId ?>"/>
	<input id="ownerType" hidden="true" type="number" name="ownerType" value="<?php echo $contentObj->ownerType ?>"/>
	<input id="defaultTab" hidden="true" type="text" name="tabName" value="<?php echo $tabName ?>"/>
	<input id="subsite" hidden="true" type="text" name="subsite" value="<?php echo SUBSITE_NAME ?>"/>

<?php if( count($dataArrays->tabsArray) > 1 ) { ?>
<div style="margin-left:-1em;padding-top:1em">
<?php foreach ( $dataArrays->tabsArray as $tabTitle => $value ) {?>
	<?php if($tabTitle == $tabName) {?>
	<span class="articleTab" style="color:#AA0000"><a class="menuItem" href="<?php echo WEBAPP . $contentObj->permalink . "?p=" . $contentObj->parentId . "&gp=" . $contentObj->grandParentId . "#" . $tabTitle ?>"><?php echo $tabTitle ?></a></span>
	<?php } else {?>
	<span class="articleTab" style="color:#000000"><a class="menuItem" href="<?php echo WEBAPP . $contentObj->permalink . "?p=" . $contentObj->parentId . "&gp=" . $contentObj->grandParentId . "#" . $tabTitle?>"><?php echo $tabTitle ?></a></span>
	<?php } ?>
		
 <?php } //close foreach ?>
  </div>
 <?php } //close if > 1 ?>

<!-- Copy this to the web page where you want the article to display
	<div id="articleText"></div>
 -->
 <script>
 function getArticle() {

	var fragment = window.location.hash.substring(1);
	var index = fragment.indexOf('?');
	if(index != -1)
		fragment = fragment.substring(0,index);
	if(fragment.length < 1)
		fragment = document.getElementById('defaultTab').value;

	fragment = fragment.replace('%20', ' ');
	
	dbParams = 
		'getPost=1' +
		'&contentId=' + document.getElementById('contentId').value +
		'&contentLang=' + document.getElementById('contentLang').value +
		'&parentId=' + document.getElementById('parentIdent').value +
		'&subsite=' + document.getElementById('subsite').value +
		'&tabName=' + fragment 
	;

   	//alert(document.getElementById('webapp').value + '/dbSelects.php');
 
	wbAjax(dbParams, document.getElementById('workbench_folder').value + '/ajax/dbSelects.php', function(responseText) {

		//document.getElementById("errorMessage").innerHTML = responseText;
        //javascript:showForm('errorDialog','content');
		//return;
		
    	var myObj = JSON.parse(responseText);

        //Dont's over write the error message that may have been generated by the page build
		var errString = document.getElementById("errorMessage").innerHTML;
		if(errString.length < 2 ) {
			document.getElementById("errorMessage").innerHTML = "" + myObj[0] + "";
		}
		//Dont's over write the success message that may have been generated by the page build
		var successString = document.getElementById("successMessage").innerHTML;
		if(successString.length < 2) {
        	document.getElementById("successMessage").innerHTML = "" + myObj[1] + "";
		}
		//Dont's over write the debug message that may have been generated by the page build
		//var debugString = document.getElementById("debugMessage").innerHTML;
        //if(debugString.length < 2 ) {
        //	document.getElementById("debugMessage").innerHTML = "" + myObj[2] + "";
        //}
    	if(myObj[0].length) {
    		javascript:showForm('errorDialog','content');
    	} else if (myObj[1].length){
    		javascript:showForm('successDialog','content');
    	} else {
    	   	var articleObj = myObj[3];
        	//requires <div id='articleText'></div> in page
        	if(document.getElementById("articleText"))
            	document.getElementById("articleText").innerHTML = "" + articleObj[0] + "";
        	if(document.getElementById("dateModified"))
        		document.getElementById("dateModified").innerHTML = "" + articleObj[1] + "";
        	MathJax.Hub.Queue(["Typeset",MathJax.Hub,articleText]);
        	//and finally, make sure the editor is up to date (if it exists)
        	if(typeof editor != 'undefined')
            	editor.setValue(articleObj[2]);
        	//
			//document.getElementById("errorMessage").innerHTML = "" + articleObj[0] + "";
            //javascript:showForm('errorDialog','content');
        	//
    	}

       	//update contentMenu width (if it exists) depending on status of vertical scrollbar
   	scrollbarWidth = 16;
       	
    	var sidebarContainer = document.getElementById('sidebarContainer');
    	var contentMenu = document.getElementById('contentMenu');
    	var content = document.getElementById('content');
    	var bodyElement = document.getElementById('body');
    	var contentContainer = document.getElementById('contentContainer');

     	var bodyRect = null;
    	var contentRect = null;
    	
    	if(bodyElement)
    		bodyRect = bodyElement.getBoundingClientRect();
    	if(content)
    		contentRect = content.getBoundingClientRect();
    	
		if(content.scrollHeight > contentContainer.scrollHeight) {
			if(sidebarContainer)
				contentMenu.style.width = "" + (parseInt(contentRect.width)-scrollbarWidth) + "px";
			else
				contentMenu.style.width = "" + (parseInt(bodyRect.width)-scrollbarWidth) + "px";
		} else  {
			if(sidebarContainer)
				contentMenu.style.width = "" + (parseInt(contentRect.width)) + "px";
			else
				contentMenu.style.width = "" + (parseInt(bodyRect.width)) + "px";
		}
        
	});

   	//update the article tabs
   	var x = document.getElementsByClassName('articleTab');
   	for(i = 0; i < x.length; i++) {

   		 var tab = x[i].getElementsByTagName('A')[0];

   		if(tab.innerHTML == fragment)
   			tab.style.color = "#AA0000";
   		else
   			tab.style.color = "#000000";
    				 
   	}

   	//set the default tab to the current value
   	document.getElementById('defaultTab').value = fragment;
   	//update the articleEditSidebar if it's present
   	if(typeof setHighlightedItem !== 'undefined') {
   		setHighlightedItem(fragment);
   	}

	return fragment;
}
	 
 </script>
<?php 
return $tabName;
} ?>