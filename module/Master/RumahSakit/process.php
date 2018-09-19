<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddRumahSakit" ){
	
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['ADDRESS'] = $_POST['textAlamat'];
	$input_parameter['LINK'] = $_POST['textLink'];
	$input_parameter['IS_ACTIVE'] = $_POST['selectStatus'];
	$input_parameter['FILE'] = $_FILES['fileImage'];
	
	$function_result = AddRumahSakit($input_parameter);
	
	if( $function_result['FUNCTION_RESULT'] == 1 ){
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		
		//UPLOAD PAYMENT RECEIPT
		mkdir('../../../media_library/logors/'.$function_result['NEW_ID']);
		$upload_parameter['TARGET_DIRECTORY'] = '../../../media_library/logors/'.$function_result['NEW_ID'];
		$upload_parameter['IMAGE_FILE'] = $input_parameter['FILE'];
		CustomUploadFile($upload_parameter);
		
		$input_parameter_updatelogo['FILENAME'] = $input_parameter['FILE']['name'];
		$input_parameter_updatelogo['ID'] = $function_result['NEW_ID'];
		UpdateLogoRumahSakit($input_parameter_updatelogo);
		
		header("Location:detail.php?id=".$function_result['NEW_ID']);
		exit;
		
	} else {
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:add.php");
		exit;
		
	}
	
}

if( $_POST['module'] == "UpdateRumahSakit" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['ADDRESS'] = $_POST['textAlamat'];
	$input_parameter['LINK'] = $_POST['textLink'];
	$input_parameter['IS_ACTIVE'] = $_POST['selectStatus'];
	$input_parameter['FILE'] = $_FILES['fileImage'];
	
	$function_result = UpdateRumahSakitByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	
	if( $input_parameter['FILE'] != null ){
		
		//UPLOAD PAYMENT RECEIPT
		$upload_parameter['TARGET_DIRECTORY'] = '../../../media_library/logors/'.$input_parameter['ID'];
		$upload_parameter['IMAGE_FILE'] = $input_parameter['FILE'];
		CustomUploadFile($upload_parameter);
			
		$input_parameter_updatelogo['FILENAME'] = $input_parameter['FILE']['name'];
		$input_parameter_updatelogo['ID'] = $input_parameter['ID'];
		UpdateLogoRumahSakit($input_parameter_updatelogo);
		
	}
	
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteLogo" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = TruncateLogoRumahSakit($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteRumahSakit" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteRumahSakitByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>