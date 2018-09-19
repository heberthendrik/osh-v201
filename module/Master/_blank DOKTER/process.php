<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddDokter" ){
	
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['KODE'] = $_POST['textKode'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	$function_result = AddDokter($input_parameter);
	
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

if( $_POST['module'] == "UpdateDokter" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['KODE'] = $_POST['textKode'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	$function_result = UpdateDokterByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteDokter" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteDokterByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>