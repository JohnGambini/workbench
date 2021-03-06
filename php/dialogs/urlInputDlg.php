<?php
/*--------------------------------------------------------------------------------------------
 * urlInputDlg.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------------
 * set_urlInputDlg()
 * new
 *
 -------------------------------------------------------------------------------------*/
function set_urlInputDlg() {
?>
<div id="urlInput">
	<p/>
	<div class="wb-dialog" style="width:80%; margin:0em auto; padding:1em; vertical-align:top">
		<div class="header">Enter Url:</div>
		<input type="text" name="urlLink" id="urlLink"/><button onclick="onUrlInputClick()">Post</button>
	</div>
	<br/>
	<br/>
	<br/>
</div>
<script>
function onUrlInputClick() {

	dbParams =  
		'getPost=1' +
		'&urlInput=' + document.getElementById('urlLink').value;

	alert(dbParams);
	
   	//alert(document.getElementById('webapp').value + '/dbSelects.php');
    	
	wbAjax(dbParams, document.getElementById('webapp').value + '/dbSelects.php', function(responseText) {

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
	} );
}
</script>
<?php 
}
?>