<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('../../library/function_list.php');

if( $_POST['module'] == "AddHasilLabMaster" ){
	
	$input_parameter['NO_RM'] = $_POST['textNorm'];
	$input_parameter['ID_RUANG'] = $_POST['selectRuang'];
	$input_parameter['ID_KELAS'] = $_POST['selectKelas'];
	$input_parameter['ID_STATUS'] = $_POST['selectStatus'];
	$input_parameter['KET_KLINIK'] = $_POST['textKetKlinik'];
	$input_parameter['CATATAN_1'] = $_POST['textCatatan1'];
	$input_parameter['CATATAN_2'] = $_POST['textCatatan2'];
	$input_parameter['NM_DOKTER'] = $_POST['textDrPengirim'];
	$input_parameter['ALAMAT_DOKTER'] = $_POST['textAlamatDokter'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	$input_parameter['TGL_LAHIR'] = $_POST['hiddenTglLahir'];
	$input_parameter['NAMA'] = $_POST['hiddenNama'];
	$input_parameter['ALAMAT'] = $_POST['hiddenAlamat'];
	$input_parameter['SEX'] = $_POST['hiddenSex'];
	
	if( $_SESSION['OSH']['ROLES'] != 'superadmin' ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = AddHasilLabMaster($input_parameter);
	
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

if( $_POST['module'] == "UpdateLab" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['KODE'] = $_POST['textKode'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ROLES'] != 'superadmin' ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = UpdateLabByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteLab" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteLabByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

if( $_GET['module'] == 'AccHasilLab' ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = ACCHasilLab($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}



if( $_GET['module'] == 'TolakHasilLab' ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = TolakHasilLab($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

?>