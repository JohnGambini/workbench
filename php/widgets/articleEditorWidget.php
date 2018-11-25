<?php
/*--------------------------------------------------------------------------------------------
 * articleEditorWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 function set_articleEditorWidget(dbUser $userObj, dbContent $contentObj,$tabName) {
	if(can_user_edit($userObj, $contentObj)){
?>
<div id="articleEdit" class="wb-dialog" style="background-color:black">
	<div class="pagecomponent">
		<?php set_dlgHeader('Edit Post','articleEdit')?>
		
		<table style="width:100%">
		<tr>
	  		<td id="editorParent" style="width:90%;height:37.5em;border:1px solid red;margin:0em 0em 1em 0em">
				<textarea id="editor" name="editor" autofocus style="height:37.5em">
				<?php //echo trim(htmlspecialchars($tabsArray[$tabName]['articleText'])," \t\0") ?>
				</textarea>
			</td>
			<td style="vertical-align:top;text-align:center;width:10%">
				<div><button style="margin: 1em" onclick="saveArticle()">Save</button></div>
				<div><a id="previewLink" class="menuItem" href="<?php echo WEBAPP . $contentObj->permalink . "#" . $tabName ?>" target="_blank"><?php echo 'preview'?></a></div>
			</td>
		</tr>
		</table>
	</div>
</div>

<script>
function articleEdit() {
	scrollbarWidth = 20;
	var articleEdit = document.getElementById('articleEdit');
	var articleEditSidebarWidget = document.getElementById('articleEditSidebarWidget');
	var menugroups = document.getElementById('menugroups');
	var mainContent = document.getElementById('mainContent');
	var contentMenu = document.getElementById('contentMenu');
	var content = document.getElementById('content');

	if(content && articleEdit && contentMenu) {
		contentRect = content.getBoundingClientRect();
		contentMenuRect = contentMenu.getBoundingClientRect();
		articleEdit.style.width = "" + (contentRect.width-scrollbarWidth-20) + "px";
		articleEdit.style.top = "" + (contentMenuRect.bottom) + "px";
	} else if(content && articleEdit) {
		contentRect = content.getBoundingClientRect();
		articleEdit.style.width = "" + (contentRect.width-scrollbarWidth-20) + "px";
		articleEdit.style.top = "" + (contentRect.top+6) + "px";
	}

	//articleEdit.style.display = 'block';
	articleEdit.style.opacity = 1;

	if(articleEditSidebarWidget) {
		if(menugroups) {
			menugroupsRect = menugroups.getBoundingClientRect();
			articleEditSidebarWidget.style.width = "" + (menugroupsRect.width) + "px";
		}
		articleEditSidebarWidget.style.display = 'block';
		articleEditSidebarWidget.style.opacity = 1;
		articleEditSidebarWidget.style.left = '0px';
	}
}

function saveArticle() {

	var articleText = document.getElementById('articleText');
	if(! articleText) {
		alert("No 'articleText' page element.");
		return;
	}
	
    dbParams = 
		'savePost=1' +
		'&Id=' + document.getElementById('contentId').value +
		'&ownerId=' + document.getElementById('ownerId').value +
		'&ownerType=' + document.getElementById('ownerType').value +
		'&editor=' + encodeURIComponent(editor.getValue()) +
		'&tabTitle=' + document.getElementById('defaultTab').value 
	;

	wbAjax(dbParams, document.getElementById('workbench_folder').value + '/ajax/dbUpdates.php', function(responseText,status) {

		//document.getElementById("errorMessage").innerHTML = responseText;
        //javascript:showForm('errorDialog','content');
		//return;

		var myObj = JSON.parse(responseText);
		
		document.getElementById("errorMessage").innerHTML = "" + myObj[0];
        document.getElementById("successMessage").innerHTML = "" + myObj[1];
        if(document.getElementById("debugMessage")) {
        	document.getElementById("debugMessage").innerHTML = "" + myObj[2];
        }
        if(myObj[0].length) {
            javascript:showForm('errorDialog','content');
        	//editor.setValue(articleText.innerHTML);
        } else {
        	var articleObj = myObj[3];
        	//requires <div id='articleText'></div> in page
        	if(document.getElementById("articleText"))
            	document.getElementById("articleText").innerHTML = "" + articleObj[0] + "";
        	if(document.getElementById("dateModified"))
        		document.getElementById("dateModified").innerHTML = "" + articleObj[1] + "";
        	MathJax.Hub.Queue(["Typeset",MathJax.Hub,articleText]);
        	//and finally, make sure the editor is up to date (if it exists)
        	//if(typeof editor !== 'undefined')
            //	editor.setValue(articleObj[2]);
            javascript:showForm('successDialog','content');
        }
	});

}

var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
  	mode: "application/xml",
  	styleActiveLine: true,
  	lineNumbers: true,
  	lineWrapping: true,
	indentWithTabs: true 
});


</script>
<?php }} ?>