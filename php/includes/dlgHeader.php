<?php 
/*--------------------------------------------------------------------------------------------
 * dlgHeader.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
 * set_dlgHeader 
 * 
 * 
 -------------------------------------------------------------------------------------*/
function set_dlgHeader($title, $id) {
?>
<div class="header">
	<div style="display:inline-block;overflow:hidden;height:1.25em;text-overflow:ellipsis;width:85%"><?php echo $title?>&nbsp;&nbsp;</div> 
	<?php if( strlen($id)) { ?>
	<span style="float:right">
		<a class="menuItem" onclick="hideForm('<?php echo $id ?>')" href="javascript:void(0)">X</a>
	</span>
	<?php } ?>
</div><!-- close header -->
<?php } ?>