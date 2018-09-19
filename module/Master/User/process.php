<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddUser" ){
	
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['EMAIL'] = $_POST['emailEmail'];
	$input_parameter['PASSWORD'] = $_POST['passwordPassword'];
	$input_parameter['ROLE'] = $_POST['selectRole'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ROLES'] != 'superadmin' ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = AddUser($input_parameter);
	$new_id = $function_result['NEW_ID'];
	mkdir('../../../media_library/profilepicture/'.$new_id);
	
	if( $function_result['FUNCTION_RESULT'] == 1 ){
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:index.php");
		exit;
		
	} else {
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:add.php");
		exit;
		
	}
	
}

if( $_POST['module'] == "UpdateUser" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['EMAIL'] = $_POST['emailEmail'];
	$input_parameter['PASSWORD'] = $_POST['passwordPassword'];
	$input_parameter['ROLE'] = $_POST['selectRole'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ROLES'] != 'superadmin' ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = UpdateUserByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteUser" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteUserByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>