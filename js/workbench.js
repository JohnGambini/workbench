/*--------------------------------------------------------------------------------------------
 * workbench.css
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
var globalResizeTimer = null;
var globalResizeCounter = 0;
var scrollbarWidth = 16;
function prepDoc()
{
	var bodyElement = document.getElementById("body");
	window.addEventListener('resize', function() {
	    if(globalResizeTimer != null) window.clearTimeout(globalResizeTimer);
	    globalResizeTimer = window.setTimeout(function() {
	        resizeDoc();}, 200);
	});
	
	/* content opacity fades in */
	var contentElement = document.getElementById('content');
	if(contentElement)
		contentElement.style.opacity = "1";
	
	/* set main menu top for transition effect */
	var menuElement = document.getElementById('mainmenu');
	if(menuElement)
		menuElement.style.top = "0px";

	/* if present, menu groups opacity */
	var menugroupsElement = document.getElementById('menugroups');
	if(menugroupsElement)
		menugroupsElement.style.opacity = "1";

	/* if present, tab list slides in from the left */
	var tabsElement = document.getElementById('tabsList');
	if(tabsElement)
		tabsElement.style.left = "0px";
	
	//for articles
	//setArticleIntro();
	
	resizeDoc(globalResizeCounter++);

	var errorMessage = document.getElementById('errorMessage');
	if(errorMessage && errorMessage.innerHTML.length) {
		javascript:showForm('errorDialog','content');
	}
	
	var successMessage = document.getElementById('successMessage');
	if(successMessage && successMessage.innerHTML.length) {
		javascript:showForm('successDialog','content');
	}
	
	//add onclick listeners 

	document.getElementById('content').addEventListener('click', function() {
		javascript:hideForm('popupUserMenu');
		javascript:hideForm('popupContentMenu');
	});

	var sidebarContainer = document.getElementById('sidebarContainer');
	if(sidebarContainer) {
	document.getElementById('sidebarContainer').addEventListener('click', function() {
		javascript:hideForm('popupUserMenu');
		javascript:hideForm('popupContentMenu');});
	}

	var menuSpacer = document.getElementById('mainmenu');
	if(menuSpacer) {
		menuSpacer.addEventListener('click', function() {
		javascript:hideForm('popupUserMenu');
		javascript:hideForm('popupContentMenu');});
	}

	var contentMenu = document.getElementById('contentMenu');
	if(contentMenu) {
		contentMenu.addEventListener('click', function() {
		javascript:hideForm('popupUserMenu');
		javascript:hideForm('popupContentMenu');});
	}

	
	document.getElementById("content").scrollTop = sessionStorage.scrollPos;
	
	//document.getElementById('selectAddPage').addEventListener('click', function() {
	//	alert('OK');
	//	javascript:showForm('popupAddPage');
	//});

}

function resizeDoc(resizeCounter)
{
	var bodyElement = document.getElementById('body');
	var contentContainer = document.getElementById('contentContainer');
	var sidebarContainer = document.getElementById('sidebarContainer');
	var menuElement = document.getElementById('mainmenu');
	var contentMenu = document.getElementById('contentMenu');
	var transparentContentMenu = document.getElementById('transparentContentMenu');
	var rightbarContent = document.getElementById('rightbarContainer');
	var content = document.getElementById('content');
	var mainContent = document.getElementById('mainContent');
	var articleEdit = document.getElementById('articleEdit');

	var bodyRect = null;
	var contentContainerRect = null;
	var sidebarContainerRect = null;
	var menuElementRect = null;
	var contentMenuRect = null;
	var rightbarRect = null;
	var contentRect = null;
	var mainContentRect = null;
	
	if(bodyElement)
		bodyRect = bodyElement.getBoundingClientRect();
	if(contentContainer)
		contentContainerRect = contentContainer.getBoundingClientRect();
	if(sidebarContainer)
		sidebarContainerRect = sidebarContainer.getBoundingClientRect();
	if(menuElement)
		menuElementRect = menuElement.getBoundingClientRect();
	if(contentMenu)
		contentMenuRect = contentMenu.getBoundingClientRect();
	if(rightbarContent)
		rightbarRect = rightbarContent.getBoundingClientRect();
	if(content)
		contentRect = content.getBoundingClientRect();
	if(mainContent)
		mainContentRect = mainContent.getBoundingClientRect();
	
	if(menuElementRect && contentContainerRect ) {
		contentContainer.style.height = "" + (bodyRect.height-menuElementRect.height-1) + "px";
		contentContainer.style.top = "" + (menuElementRect.height+1) + "px";
	}

	if(!sidebarContainer && contentContainer){
		contentContainer.style.width = "100%";
	}
	
	if(sidebarContainer && menuElementRect){
		sidebarContainer.style.height =  "" + (bodyRect.height-menuElementRect.height-1) + "px";
		sidebarContainer.style.top =  "" + (menuElementRect.height+1) + "px";
	}

	if( contentContainer && content )
		content.style.height = "" + contentContainer.getBoundingClientRect().height + "px";
	
	if(mainContent && content) {
		mainContent.style.height = "" + (content.getBoundingClientRect().height) + "px";
	}
	

	if(content && mainContent && (contentMenu || transparentContentMenu)) {

		if(contentMenu) {
			if( resizeCounter <= 1 ) {
				//adjust content top margin	
				var str_1 = mainContent.style.padding.substr(0, mainContent.style.padding.indexOf(" "));
				//alert(str_1);
				var str = mainContent.style.padding;
				str = str.substr(str.indexOf(' ')+1); 
				str = "" + (parseInt(str_1,10) + 3) + "em " + str; 
				//alert(str);
				mainContent.style.padding = str;
			}

			//alert(content.scrollHeight + "," + contentContainer.scrollHeight + "," + parseInt(contentRect.width) + "," + contentContainerRect.width + "," + bodyRect.width);
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
			
		} else {
			
			
			if(content.scrollHeight > contentContainer.scrollHeight) {
				if(sidebarContainer)
					transparentContentMenu.style.width = "" + (parseInt(contentRect.width)-scrollbarWidth) + "px";
				else
					transparentContentMenu.style.width = "" + (parseInt(bodyRect.width)-scrollbarWidth) + "px";
			} else  {
				if(sidebarContainer)
					transparentContentMenu.style.width = "" + (parseInt(contentRect.width)) + "px";
				else
					transparentContentMenu.style.width = "" + (parseInt(bodyRect.width)) + "px";
			}
			
		}
		

		if(contentMenu)
			contentMenu.style.top = contentContainer.style.top;
		if(transparentContentMenu)
			transparentContentMenu.style.top = contentContainer.style.top;
	}
	
	if(rightbarContent) {
		if(contentMenu) {
			rightbarContent.style.top = "" + contentMenuRect.bottom + "px";
			rightbarContent.style.height = "" + (mainContent.scrollHeight-5 - contentMenuRect.bottom) + "px";
		} else {
			
			rightbarContent.style.height = "" + (mainContent.scrollHeight-5) + "px";
		}
		var displayStyle = rightbarContent.currentStyle ? rightbarContent.currentStyle.display : getComputedStyle(rightbarContent, null).display;
		if( displayStyle == 'block'){
			//displayStyle = element.currentStyle ? element.currentStyle.display : getComputedStyle(element, null).display;
			mainContent.style.width = "82%";
		}
		else
			mainContent.style.width ="100%";

	}
	
	if(mainContent && articleEdit) {
		//articleEdit.style.width = "" + (mainContentRect.width-scrollbarWidth-100) + "px";
		//alert("ok");
	}
	

	//fix up the main menu
	var width = window.innerWidth
	|| document.documentElement.clientWidth
	|| document.body.clientWidth;
	var mainmenuItem2 = document.getElementById('mainmenuItem2');
	var rightBar = document.getElementById('rightbarContainer');
	if(contentMenu || transparentContentMenu) {
		if(rightbarContent && width > 760) {
			if(mainmenuItem2 != null)
				mainmenuItem2.style.display = 'none';
		}
		else if(mainmenuItem2 != null)
			mainmenuItem2.style.display = 'inline-block';
	}
	//alert(typeof pagePreferences);

	if(typeof pagePreferences !== 'undefined') {
		pagePreferences();
	}
}

function hideForm(id)
{
	if(document.getElementById(id).style.display == "block")
		document.getElementById(id).style.display = "none";
	//special case for articleEdit
	if(id == 'articleEdit') {
		document.getElementById(id).style.top = "120%";
		document.getElementById(id).style.opacity = 0;
		if(document.getElementById('articleEditSidebarWidget')) {
			document.getElementById('articleEditSidebarWidget').style.left = "-120%";
			document.getElementById('articleEditSidebarWidget').style.opacity = 0;
		}
	}
}

function showForm(id,parentId)
{
	var popupUser = document.getElementById('popupUserMenu');
	if(popupUser)
		popupUser.style.display = "none";

	formElement = document.getElementById(id);
	formElement.style.display = "block";
	
	var parentRect = document.getElementById(parentId).getBoundingClientRect();
	var formRect = formElement.getBoundingClientRect();

	//center the popup vertically inside the parent
	formElement.style.left = "" + (parentRect.left + ((parentRect.width-formRect.width)/2)) + "px";
}

function toggleMenu(event, id, parentId, position )
{
	var e = event||window.event;
	
	var formElement = document.getElementById(id);
	
	if(formElement.style.display == "block")
		return hideForm(id);

	formElement.style.display = "block";

	var parentRect = document.getElementById(parentId).getBoundingClientRect();
	var formRect = formElement.getBoundingClientRect();

	if(position == 'right')
		formElement.style.left = "" + (parentRect.left) + "px"; 
	else
		formElement.style.left = "" + (parentRect.right - formRect.width) + "px"; 
		
	formElement.style.top = "" + (parentRect.bottom + 5) + "px"; 
	
	e.stopPropagation();

	//alert(formElement.style.left + " & " + formElement.style.top );
}

function setArticleIntro()
{
	var introDest = document.getElementById("introDest");
	var intro = document.getElementById("intro");
	/*if intrDest exists, this is an article page*/
	
	if( intro && introDest ) {
		introDest.innerHTML = intro.innerHTML;
		introDest.style.textAlign = intro.style.textAlign;
	}
}

function fixUpSubmit(webApp)
{
	//Set page to new page if box is checked
	if( document.getElementById('toNewPage').checked ) {
		document.getElementById('newPageForm').action = webApp + document.getElementById('permalink').value;
	}
}

function wbAjax(dbParams,file, callBack) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 404) {
            document.getElementById("debugMessage").innerHTML = "Page not found";
            document.getElementById("errorMessage").innerHTML = "Page not found";
        	javascript:showForm('errorDialog','content');
        } else if(this.readyState == 4 && this.status == 200) {
        	callBack(this.responseText,this.status);
        }
    };
    
	xmlhttp.open("POST", file, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send(dbParams);

}
