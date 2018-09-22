<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddPetugas" ){
	
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ID_ROLE'] != 1 ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = AddPetugas($input_parameter);
	mkdir('../../../media_library/profilepicture/'.$function_result['NEW_ID']);
	
	if( $function_result['FUNCTION_RESULT'] == 1 ){
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:detail.php?id=".$function_result['NEW_ID']);
		exit;
		
	} else {
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:add.php");
		exit;
		
	}
	
}

if( $_POST['module'] == "UpdatePetugas" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAME'] = $_POST['textNama'];
	$input_parameter['NIK_EMPLOYEE'] = $_POST['textNIKEmployee'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ID_ROLE'] != 1 ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$input_parameter['NIK'] = $_POST['textNIK'];
	$input_parameter['PHONE_NUMBER'] = $_POST['textNoTelp'];
	$input_parameter['EMAIL'] = $_POST['emailEmail'];
	$input_parameter['SEX'] = $_POST['selectSex'];
	$input_parameter['BIRTH_DATE'] = $_POST['dateTanggalLahir'];
	
	$function_result = UpdatePetugasByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeletePetugas" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeletePetugasByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>