<?php 
/*--------------------------------------------------------------------------------------------
 * scrollTableWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------------
 * set_scrollTableWidget(array[][]) 
 *  
 */
function set_scrollTableWidget($dataArray, $settingsArray) { 
?>
<!-- begin scrollTableWidget -->
<table id="scrollTableWidget" class="outer-table" style="height:<?php echo $settingsArray['height']?>">
<?php if( $settingsArray['header'] == true ) {?>
<tr> <?php 
	for($colmn = 0; $colmn < count($dataArray[0]); $colmn++ ) {?>
	<td style="<?php echo $dataArray[0][$colmn][1] ?>"><em><?php echo $dataArray[0][$colmn][0] ?></em></td>
	<?php } ?>
</tr>
<?php } ?>
<tr>
	<td colspan=<?php echo count($dataArray[0]) ?> style="width:inherit;height:98%">
	<div class="inner-div" style="height:98%; overflow-y:auto;overflow-x:hidden">
		<table class="inner-table" style="height:98%">
		<?php for( $settingsArray['header'] == true ? $i = 1 : $i = 0; $i < count($dataArray); $i++) { ?>
		<tr>
		<?php for($colmn = 0; $colmn < count($dataArray[$i]); $colmn++){ ?>
			<td style="<?php echo $dataArray[$i][$colmn][1] ?>"><?php echo $dataArray[$i][$colmn][0] ?></td>
		<?php } ?>
		</tr>
		<?php } ?>
		</table>
	</div>
	</td>
</tr>
</table>
<input hidden="true" type="number" name="recordCount" value="<?php echo $settingsArray['header'] == true ? count($dataArray)-1 : count($dataArray) ?>">
 <!-- end scrollTableWidget -->
 <?php } ?>