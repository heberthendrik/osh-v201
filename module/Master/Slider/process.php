<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddSlider" ){
	
	$input_parameter['ALT'] = $_POST['textAlt'];
	$input_parameter['FILE'] = $_FILES['fileImage'];
	
	$function_result = AddSlider($input_parameter);
	
	if( $function_result['FUNCTION_RESULT'] == 1 ){
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		
		//UPLOAD PAYMENT RECEIPT
		mkdir('../../../media_library/slider/'.$function_result['NEW_ID']);
		$upload_parameter['TARGET_DIRECTORY'] = '../../../media_library/slider/'.$function_result['NEW_ID'];
		$upload_parameter['IMAGE_FILE'] = $input_parameter['FILE'];
		CustomUploadFile($upload_parameter);
		
		$input_parameter_updatelogo['FILENAME'] = $input_parameter['FILE']['name'];
		$input_parameter_updatelogo['ID'] = $function_result['NEW_ID'];
		UpdateLogoSlider($input_parameter_updatelogo);
		
		header("Location:index.php");
		exit;
		
	} else {
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:add.php");
		exit;
		
	}
	
}

if( $_POST['module'] == "UpdateSlider" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['ALT'] = $_POST['textAlt'];
	
	$function_result = UpdateSliderByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteGambarSlider" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = TruncateImageSlider($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteSlider" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteSliderByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>