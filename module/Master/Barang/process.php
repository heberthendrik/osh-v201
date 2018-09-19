<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddBarang" ){
	
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['SATUAN'] = $_POST['selectSatuan'];
	$input_parameter['KATALOG'] = $_POST['textKatalog'];
	$input_parameter['KATEGORI'] = $_POST['selectKategori'];
	$input_parameter['ID_SUPPLIER'] = $_POST['textIDSupplier'];
	$input_parameter['TGL_MASUK'] = $_POST['dateTglMasuk'];
	$input_parameter['MERK'] = $_POST['selectMerk'];
	$input_parameter['TIPE'] = $_POST['textTipe'];
	$input_parameter['ID_PRINCIPAL'] = $_POST['textIDPrincipal'];
	$input_parameter['HRG_PEROLEHAN'] = $_POST['numberHargaPerolehan'];
	$input_parameter['HRG_JUAL'] = $_POST['numberHargaJual'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['KOMPUTER'] = $_POST['textKomputer'];
	$input_parameter['USER'] = $_POST['textUser'];
	$input_parameter['TGL_ENTRI'] = $_POST['dateTglEntri'];
	$input_parameter['DISKONV'] = $_POST['textDiskonv'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ROLES'] != 'superadmin' ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = AddBarang($input_parameter);
	
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

if( $_POST['module'] == "UpdateBarang" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['SATUAN'] = $_POST['selectSatuan'];
	$input_parameter['KATALOG'] = $_POST['textKatalog'];
	$input_parameter['KATEGORI'] = $_POST['selectKategori'];
	$input_parameter['ID_SUPPLIER'] = $_POST['textIDSupplier'];
	$input_parameter['TGL_MASUK'] = $_POST['dateTglMasuk'];
	$input_parameter['MERK'] = $_POST['selectMerk'];
	$input_parameter['TIPE'] = $_POST['textTipe'];
	$input_parameter['ID_PRINCIPAL'] = $_POST['textIDPrincipal'];
	$input_parameter['HRG_PEROLEHAN'] = $_POST['numberHargaPerolehan'];
	$input_parameter['HRG_JUAL'] = $_POST['numberHargaJual'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['KOMPUTER'] = $_POST['textKomputer'];
	$input_parameter['USER'] = $_POST['textUser'];
	$input_parameter['TGL_ENTRI'] = $_POST['dateTglEntri'];
	$input_parameter['DISKONV'] = $_POST['textDiskonv'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	if( $_SESSION['OSH']['ROLES'] != 'superadmin' ){
		$input_parameter['ID_RS'] = $_SESSION['OSH']['ID_RS'];
	}
	
	$function_result = UpdateBarangByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeleteBarang" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeleteBarangByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>