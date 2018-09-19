<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddRuang" ){
	
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ID_ROLE'] != 1 ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = AddRuang($input_parameter);
	
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

if( $_POST['module'] == "UpdateRuang" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ID_ROLE'] != 1 ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = UpdateRuangByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteRuang" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteRuangByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>