<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('../../library/function_list.php');

if( $_POST['module'] == "UpdateMyProfile" ){

	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['EMAIL'] = $_POST['emailEmail'];
	$input_parameter['PASSWORD'] = $_POST['passwordPassword'];
	$input_parameter['FILE'] = $_FILES['fileImage'];
	
	$function_result = UpdateProfileByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	
	if( $input_parameter['FILE'] != null ){
		
		//UPLOAD PAYMENT RECEIPT
		$upload_parameter['TARGET_DIRECTORY'] = '../../media_library/profilepicture/'.$_SESSION['OSH']['COMPOSITE_ID'];
		$upload_parameter['IMAGE_FILE'] = $input_parameter['FILE'];
		CustomUploadFile($upload_parameter);
			
		$input_parameter_updateprofilepicture['FILENAME'] = $input_parameter['FILE']['name'];
		UpdateProfilePicture($input_parameter_updateprofilepicture);
		
	}
	
	header("Location:index.php");
	exit;
	
}

if( $_GET['module'] == "DeleteProfilePicture" ){
	
	$input_parameter['ID'] = $_SESSION['OSH']['COMPOSITE_ID'];
	
	$function_result = TruncateProfilePicture($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
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

if( $_GET['module'] == "VisitNotif" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = ExecuteNotification($input_parameter);
	
	$function_GetNotifikasiByID = GetNotifikasiByID($input_parameter);
	header("Location:".$function_GetNotifikasiByID['LINK'][0]);
	exit;
	
}

?>