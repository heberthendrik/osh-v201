<?php
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include('../../../library/function_list.php');

if( $_POST['module'] == "AddKodeLab" ){
	
	$input_parameter['NAME'] = $_POST['textNama'];
	$input_parameter['GROUP_1'] = $_POST['textGroup1'];
	$input_parameter['GROUP_2'] = $_POST['textGroup2'];
	$input_parameter['GROUP_3'] = $_POST['textGroup3'];
	$input_parameter['SATUAN'] = $_POST['textSatuan'];
	$input_parameter['METODA'] = $_POST['textMetoda'];
	$input_parameter['KD_LAB'] = $_POST['textKodeLab'];
	$input_parameter['KD_LIS'] = $_POST['textKodeLis'];
	$input_parameter['KOMA'] = $_POST['textKoma'];
	$input_parameter['YFORMAT'] = $_POST['textYFormat'];
	$input_parameter['KD_FROM_DEVICE'] = $_POST['textKodeDariAlat'];
	
	$function_result = AddKodeLab($input_parameter);
	
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

if( $_GET['module'] == 'TambahNilaiRujukan' ){
	
	$input_parameter['ID_KDLAB'] = $_GET['id'];
	$input_parameter['SEX'] = $_GET['sex'];
	$input_parameter['USIA_AWAL'] = $_GET['usiaawal'];
	$input_parameter['USIA_AKHIR'] = $_GET['usiaakhir'];
	$input_parameter['UMUR_SAT'] = $_GET['satuan'];
	$input_parameter['NILAI_RUJUKAN'] = $_GET['nilairujukan'];
	$input_parameter['KETERANGAN'] = $_GET['ket'];
	$input_parameter['STATUS'] = $_GET['status'];
	
	$function_AddNilaiRujukanByKodeLabID = AddNilaiRujukanByKodeLabID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_AddNilaiRujukanByKodeLabID['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_AddNilaiRujukanByKodeLabID['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID_KDLAB']);
	exit;
		
}

if( $_GET['module'] == "DeleteNilaiRujukan" ){
	
	$input_parameter['ID'] = $_GET['id'];
	$kdlabid = $_GET['kdlabid'];
	
	$function_DeleteNilaiRujukanByID = DeleteNilaiRujukanByID($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_DeleteNilaiRujukanByID['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_DeleteNilaiRujukanByID['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$kdlabid);
	exit;
	
}

if( $_POST['module'] == "UpdateKodeLab" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAME'] = $_POST['textNama'];
	$input_parameter['GROUP_1'] = $_POST['textGroup1'];
	$input_parameter['GROUP_2'] = $_POST['textGroup2'];
	$input_parameter['GROUP_3'] = $_POST['textGroup3'];
	$input_parameter['SATUAN'] = $_POST['textSatuan'];
	$input_parameter['METODA'] = $_POST['textMetoda'];
	$input_parameter['KD_LAB'] = $_POST['textKodeLab'];
	$input_parameter['KD_LIS'] = $_POST['textKodeLis'];
	$input_parameter['KOMA'] = $_POST['textKoma'];
	$input_parameter['YFORMAT'] = $_POST['textYFormat'];
	$input_parameter['KD_FROM_DEVICE'] = $_POST['textKodeDariAlat'];
	
	$function_result = UpdateKodeLabByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteKodeLab" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteKodeLabByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>