<?php
/*--------------------------------------------------------------------------------------------
 * articleEditSidebarWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 function set_articleEditSidebarWidget($dbObj, $contentObj, $userObj, $sqlObject, $dataArrays) {
	if(can_user_edit($userObj,$contentObj)){

		$dataArrays->get_tabsArray($dbObj, $sqlObject, $contentObj->ID);
		reset($dataArrays->tabsArray);
		$currentTab = count($dataArrays->tabsArray) ? key($dataArrays->tabsArray) : '';
		
?>
<div id="articleEditSidebarWidget" class="wb-dialog" style="background-color:black">
	<div class="pagecomponent">
		<?php set_dlgHeader('Tabs','')?>
	</div>
	<ul id='sidebarList'>
	<?php foreach ( $dataArrays->tabsArray as $tabTitle => $value ) {?>
	<?php if($currentTab == $tabTitle) { ?>
		<li style="margin:0em 1em 0.25em -1em"><a class="sidebarLinkItem" href="<?php echo WEBAPP . $contentObj->permalink . "#" . $tabTitle ?>"><?php echo $tabTitle ?></a></li>
	<?php } else { ?>
		<li style="margin:0em 1em 0.25em -1em"><a class="sidebarLinkItem" href="<?php echo WEBAPP . $contentObj->permalink . "#" . $tabTitle ?>"><?php echo $tabTitle ?></a></li>
	<?php } } ?>	
	</ul>
</div>
<script>
function setHighlightedItem(tabName) {
//update the article tabs

var x = document.getElementById('sidebarList').getElementsByTagName('A');

for(i = 0; i < x.length; i++) {

	if(x[i].innerHTML == tabName)
		x[i].className = "sidebarHighlightLinkItem";
	else
		x[i].className = "sidebarLinkItem";
	}
}
</script>
<?php }} ?>