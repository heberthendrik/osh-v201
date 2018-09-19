<?php
error_reporting(0);

/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */

date_default_timezone_set("Asia/Bangkok");

require("dbconnect.php");
require('phpmailer/PHPMailerAutoload.php');
include('function_list/function_general.php');
include('function_list/function_ruang.php');
include('function_list/function_kelas.php');
include('function_list/function_status.php');
include('function_list/function_dokter.php');
include('function_list/function_pasien.php');
include('function_list/function_petugas.php');
include('function_list/function_barang.php');
include('function_list/function_kategori.php');
include('function_list/function_satuan.php');
include('function_list/function_merk.php');
include('function_list/function_kodelab.php');
include('function_list/function_rumahsakit.php');
include('function_list/function_slider.php');
include('function_list/function_nilairujukan.php');
include('function_list/function_user.php');
include('function_list/function_profile.php');
include('function_list/function_topbar.php');
include('function_list/function_lab.php');
/* include('../../library/function_list/function_setting.php'); */
/* include('../../library/function_list/function_master_link.php'); */
/*
if( $_SESSION['OSH']['LOGIN_STATUS'] != 1 ){
	$_SESSION['OSH']['FUNCTION_RESULT'] = 0;
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = 'Username / Password Anda salah';
	header("Location:".GetMasterLink());
}
*/
?>