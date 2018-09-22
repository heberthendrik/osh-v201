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
	
	if( $_SESSION['OSH']['ID_ROLE'] != 1 ){
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

if( $_POST['module'] == "AddHasilLabMasterPreview" ){
	
	$input_parameter['ID'] = $_POST['id'];
	$input_parameter['ID_RUANG'] = $_POST['selectRuang'];
	$input_parameter['ID_KELAS'] = $_POST['selectKelas'];
	$input_parameter['ID_STATUS'] = $_POST['selectStatus'];
	$input_parameter['ID_DOCTOR_ASSIGNED'] = $_POST['selectIDDokterPemeriksa'];
	$input_parameter['KET_KLINIK'] = $_POST['textKetKlinik'];
	$input_parameter['CATATAN_1'] = $_POST['textCatatan1'];
	$input_parameter['CATATAN_2'] = $_POST['textCatatan2'];
	
	if( $_SESSION['OSH']['ID_ROLE'] != 1 ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = InputLabTahap3($input_parameter);
	
	if( $function_result['FUNCTION_RESULT'] == 1 ){
		
		//$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:add_review.php?id=".$input_parameter['ID']);
		exit;
		
	} else {
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:add_3.php?id=".$input_parameter['ID']);
		exit;
		
	}
	
}

if( $_POST['module'] == "UpdateLab" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['KODE'] = $_POST['textKode'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ID_ROLE'] != 1 ){
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
	$master_link = GetMasterLink();
	
	$function_result = ACCHasilLab($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	
	$function_GetAllPetugas = GetAllPetugas();
	for( $i=0;$i<$function_GetAllPetugas['TOTAL_ROW'];$i++ ){
	
		if( $function_GetAllPetugas['ID_RS'][$i] == $_SESSION['OSH']['ID_RS'] ){
			$notification_parameter['ID_MASTER_SENDER'] = $_SESSION['OSH']['COMPOSITE_ID'];
			$notification_parameter['ID_MASTER_RECEIVER'] = $function_GetAllPetugas['ID'][$i];
			$notification_parameter['MESSAGE_TEXT'] = "Hasil ID LAB ".$display_nolab." di ACC oleh Dokter [".$_SESSION['OSH']['NAME']."] ";
			$notification_parameter['LINK'] = $master_link.'/module/Lab/detail.php?id='.$input_parameter['ID'];	
			$function_AddNotification = AddNotification($notification_parameter);
		}
		
	}
	
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}



if( $_GET['module'] == 'TolakHasilLab' ){
	
	$input_parameter['ID'] = $_GET['id'];
	$master_link = GetMasterLink();
	
	$function_result = TolakHasilLab($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	
	$function_GetAllPetugas = GetAllPetugas();
	for( $i=0;$i<$function_GetAllPetugas['TOTAL_ROW'];$i++ ){
	
		if( $function_GetAllPetugas['ID_RS'][$i] == $_SESSION['OSH']['ID_RS'] ){
			$notification_parameter['ID_MASTER_SENDER'] = $_SESSION['OSH']['COMPOSITE_ID'];
			$notification_parameter['ID_MASTER_RECEIVER'] = $function_GetAllPetugas['ID'][$i];
			$notification_parameter['MESSAGE_TEXT'] = "Hasil ID LAB ".$display_nolab." ditolak oleh Dokter [".$_SESSION['OSH']['NAME']."] ";
			$notification_parameter['LINK'] = $master_link.'/module/Lab/detail.php?id='.$input_parameter['ID'];	
			$function_AddNotification = AddNotification($notification_parameter);
		}
		
	}
	
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == 'AddTemporaryLab' ){
	
	$function_result = AddTemporaryLabNumber();
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	
	header("Location:add_1.php?id=".$function_result['NEW_ID']);
	exit;
	
}

if( $_GET['module'] == 'InputLabTahap1' ){
	
	$input_parameter['ID'] = $_GET['id'];
	$input_parameter['ID_PATIENT'] = $_GET['pid'];
	
	$function_result = InputLabTahap1($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	
	header("Location:add_2.php?id=".$input_parameter['ID']);
	exit;
}

if( $_GET['module'] == 'InputLabTahap2' ){
	
	$input_parameter['ID'] = $_GET['id'];
	$input_parameter['ID_DOCTOR'] = $_GET['did'];
	
	if( $_GET['isInternalDoctor'] == 1 ){
		
		$function_result = InputLabTahap2_Internal($input_parameter);
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
			
	}
	
	else if( $_GET['isInternalDoctor'] == 0 ){
		
		$input_parameter['DOCTOR_SENDER_NAME'] = $_GET['textDrPengirim'];
		$input_parameter['DOCTOR_SENDER_ADDRESS'] = $_GET['textAlamatDokter'];
		
		$function_result = InputLabTahap2_Eksternal($input_parameter);
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		
	}
	
	header("Location:add_3.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "FinalizeLabInput" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = FinalizeInputLab($input_parameter);
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	$master_link = GetMasterLink();
	
	$function_GetLabMasterByID = GetLabMasterByID($input_parameter);
	$current_idrs = $function_GetLabMasterByID['ID_RS'][0];
	
	if( strlen($function_GetLabMasterByID['NO_LAB'][0]) == 1 ){
		$display_nolab = '00'.$function_GetLabMasterByID['NO_LAB'][0];
	} else if( strlen($function_GetLabMasterByID['NO_LAB'][0]) == 2 ){
		$display_nolab = '0'.$function_GetLabMasterByID['NO_LAB'][0];
	} else if( strlen($function_GetLabMasterByID['NO_LAB'][0]) == 3 ){
		$display_nolab = $function_GetLabMasterByID['NO_LAB'][0];
	} 
	
	$display_nolab = $function_GetLabMasterByID['NO_LAB_PREFIX'][0].$display_nolab;
	
	if( $function_GetLabMasterByID['ID_DOCTOR_ASSIGNED'][0] == 0 ){
		$function_GetAllDokter = GetAllDokter();
		for( $i=0;$i<$function_GetAllDokter['TOTAL_ROW'];$i++ ){
		
			if( $function_GetAllDokter['ID_RS'][$i] == $current_idrs ){
				$notification_parameter['ID_MASTER_SENDER'] = $_SESSION['OSH']['COMPOSITE_ID'];
				$notification_parameter['ID_MASTER_RECEIVER'] = $function_GetAllDokter['ID'][$i];
				$notification_parameter['MESSAGE_TEXT'] = "Perlu melakukan pemeriksaan ID LAB ".$display_nolab;
				$notification_parameter['LINK'] = $master_link.'/module/Lab/detail.php?id='.$input_parameter['ID'];	
				$function_AddNotification = AddNotification($notification_parameter);
			}
			
		}	
	} else if( $function_GetLabMasterByID['ID_DOCTOR_ASSIGNED'][0] > 0 ){
		
		$notification_parameter['ID_MASTER_SENDER'] = $_SESSION['OSH']['COMPOSITE_ID'];
		$notification_parameter['ID_MASTER_RECEIVER'] = $function_GetLabMasterByID['ID_DOCTOR_ASSIGNED'][0];
		$notification_parameter['MESSAGE_TEXT'] = "Perlu melakukan pemeriksaan ID LAB ".$display_nolab;
		$notification_parameter['LINK'] = $master_link.'/module/Lab/detail.php?id='.$input_parameter['ID'];	
		$function_AddNotification = AddNotification($notification_parameter);
			
			
		
	}
	
	
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

?>