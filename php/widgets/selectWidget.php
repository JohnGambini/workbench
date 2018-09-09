<?php
/*--------------------------------------------------------------------------------------------
 * selectWidget.php
 *
 * Copyright 2015 2016 2017 2018 by John Gambini
 *
 ---------------------------------------------------------------------------------------------*/
 /*------------------------------------------------------------------------------------
 * set_selectWidget
 *
 *
 -------------------------------------------------------------------------------------*/
function set_selectWidget($dataArray, $inputName, $selectId = NULL, $size = NULL) {

	$sizeSpec = "";
	if( isset($size)) {
	$sizeSpec = "size='" . $size . "'";
	}
?>	
<select id="<?php echo $inputName ?>" <?php echo $sizeSpec ?> name="<?php echo $inputName ?>">
<?php foreach ( $dataArray as $key => $value ) {?>
	<?php if($selectId != NULL and $selectId == $key ) { ?>
	<option selected value="<?php echo $key ?>"><?php echo $value ?></option>
	<?php } else { ?>
	<option value="<?php echo $key ?>"><?php echo $value ?></option>
	<?php } ?>
<?php } ?>
</select>
<?php } ?>
<?php
/*------------------------------------------------------------------------------------
 * set_selectTag
 *
 *
 -------------------------------------------------------------------------------------*/
function set_selectTag($dataArray, $inputName, $selectId = NULL, $size = NULL) {

	$sizeSpec = "";
	if( isset($size)) {
	$sizeSpec = "size='" . $size . "'";
	}

	$retString = '<select id="' .  $inputName . '" ' . $sizeSpec . ' name="' .  $inputName . '">';

	foreach ( $dataArray as $key => $value ) {
		if($selectId != NULL and $selectId == $key ) { 
			$retString = $retString . '<option selected value="' . $key . '">' . $value . '</option>';
		} else {
			$retString = $retString . '<option value="' . $key . '">' . $value . '</option>';
		}
	}

	return $retString . "</select>";
}
?>