<?php

include('../../library/function_list.php');


if( $_POST['module'] == "BankAdd" ){

	$input_parameter['BANK'] = $_POST['textBank'];
	
	if( isset( $_POST['submitSimpan'] ) ){
		
		$function_result = AddBank($input_parameter);
		$bank_new_id = $function_result['NEW_ID'];
		
		$_SESSION['HIFEST_FUNCTION_RESULT']['RESULT'] = $function_result['RESULT'];
		$_SESSION['HIFEST_FUNCTION_RESULT']['MESSAGE'] = $function_result['MESSAGE'];
		
		if( $function_result['RESULT'] == 0 ){
			
			header("Location:Add.php");
			exit;
			
		} else if( $function_result['RESULT'] == 1 ){
			
			header("Location:Detail.php?id=".$bank_new_id);
			exit;
			
		} else {
			header("Location:View.php");
			exit;
		}
		
	}
	
}

if( $_POST['module'] == "BankDetail" ){
	
	$input_parameter['ID'] = $_POST['HiddenCurrentID'];
	$input_parameter['BANK'] = $_POST['textBank'];
	
	if( isset( $_POST['submitSimpan'] ) ){
		
		$function_result = UpdateBankByID($input_parameter);
		
		$_SESSION['HIFEST_FUNCTION_RESULT']['RESULT'] = $function_result['RESULT'];
		$_SESSION['HIFEST_FUNCTION_RESULT']['MESSAGE'] = $function_result['MESSAGE'];
		
		if( $function_result['RESULT'] == 0 ){
			
			header("Location:Detail.php?id=".$input_parameter['ID']);
			exit;
			
		} else if( $function_result['RESULT'] == 1 ){
			
			header("Location:Detail.php?id=".$input_parameter['ID']);
			exit;
			
		} else {
			header("Location:View.php");
			exit;
		}
	} 
}

?>