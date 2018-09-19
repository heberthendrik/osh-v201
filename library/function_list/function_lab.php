<?php

/*==========================================

/*==========================================*/

function AddHasilLabMaster($input_parameter){
	global $db;

	$query_getmax = "select max(id) as id_terakhir from public.tab_lab_master";
	$result_getmax = pg_query($db, $query_getmax);
	$row_getmax = pg_fetch_assoc($result_getmax);
	$id_terakhir = $row_getmax['id_terakhir'];
	$id_terbaru = $id_terakhir + 1;
	
	$datetime1 = new DateTime($input_parameter['TGL_LAHIR']);
	$datetime2 = new DateTime(date('Y-m-d'));
	$interval = $datetime1->diff($datetime2);
	$usia = $interval->format('%y Tahun %m Bulan and %d Hari');
	$usia_round = $interval->format('%y');
	
	$query_getnmruang = "select * from tab_ruang where id = '".$input_parameter['ID_RUANG']."'";
	$result_getnmruang = pg_query($db, $query_getnmruang);
	$row_getnmruang = pg_fetch_assoc($result_getnmruang);
	$display_nmruang = $row_getnmruang['nama'];
	
	$query_getnmkelas = "select * from tab_kelas where id = '".$input_parameter['ID_KELAS']."'";
	$result_getnmkelas = pg_query($db, $query_getnmkelas);
	$row_getnmkelas = pg_fetch_assoc($result_getnmkelas);
	$display_nmkelas = $row_getnmkelas['nama'];
	
	$query_getnmstatus = "select * from tab_status where id = '".$input_parameter['ID_STATUS']."'";
	$result_getnmstatus = pg_query($db, $query_getnmstatus);
	$row_getnmstatus = pg_fetch_assoc($result_getnmstatus);
	$display_nmstatus = $row_getnmstatus['nama'];
	
	$display_nmdokter = $input_parameter['NM_DOKTER'];
	
	
	$query_add = 
	"
	insert into public.tab_lab_master
	(
	id,
	no_lab,
	no_rm,
	umur,
	umur_sat,
	usia,
	nama,
	sex,
	alamat,
	tgl_lahir,
	id_ruang,
	nm_ruang,
	id_kelas,
	nm_kelas,
	id_status,
	nm_status,
	nm_dokter,
	alamat_dokter,
	ket_klinik,
	catatan_1,
	catatan_2,
	id_pengentri,
	nm_pengentri,
	id_rs,
	created_at,
	overall_status
	)
	values
	(
	'".$id_terbaru."',
	'".$id_terbaru."',
	'".$input_parameter['NO_RM']."',
	'".$usia_round."',
	'Tahun',
	'".$usia."',
	'".$input_parameter['NAMA']."',
	'".$input_parameter['SEX']."',
	'".$input_parameter['ALAMAT']."',
	'".$input_parameter['TGL_LAHIR']."',
	'".$input_parameter['ID_RUANG']."',
	'".$display_nmruang."',
	'".$input_parameter['ID_KELAS']."',
	'".$display_nmkelas."',
	'".$input_parameter['ID_STATUS']."',
	'".$display_nmstatus."',
	'".$display_nmdokter."',
	'".$input_parameter['ALAMAT_DOKTER']."',
	'".$input_parameter['KET_KLINIK']."',
	'".$input_parameter['CATATAN_1']."',
	'".$input_parameter['CATATAN_2']."',
	'".$_SESSION['OSH']['ID']."',
	'".$_SESSION['OSH']['NAME']."',
	'".$input_parameter['ID_RS']."',
	'".date('Y-m-d H:i:s')."',
	'1'
	)
	";
	
	$result_add = pg_query($db, $query_add);
	$row_add = pg_fetch_row($result_add);
	
	//echo $query_add;exit;
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data Lab telah berhasil ditambahkan." ;

	return $function_result;
}

function UpdateLabByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_lab b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
		and b.id != '".$input_parameter['ID']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Lab (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama lab yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_lab
		set
			nama = '".addslashes($input_parameter['NAMA'])."'
			,status = '".$input_parameter['STATUS']."'
			,kode = '".addslashes($input_parameter['KODE'])."'
			,id_rs = '".$input_parameter['ID_RS']."'
			,updated_at = '".date('Y-m-d H:i:s')."'
		where
			id = '".$input_parameter['ID']."'
		";

		$result_update = pg_query($db, $query_update);
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data lab telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteLabByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_lab
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data lab telah berhasil dihapus.";
	
	return $function_result;
}

function GetLabDetailByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_lab_detil where id_master = '".$input_parameter['ID_MASTER']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_idmaster[] = $row_get['id_master'];
		$array_idlab[] = $row_get['id_lab'];
		$array_satuan[] = $row_get['satuan'];
		$array_hasil[] = $row_get['hasil'];
		$array_flag[] = $row_get['flag'];
		$array_rujukanawal[] = $row_get['rujukan_awal'];
		$array_rujukanakhir[] = $row_get['rujukan_akhir'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_metoda[] = $row_get['metoda'];
		$array_dtperiksa[] = $row_get['dt_periksa'];
		$array_kdacc[] = $row_get['kd_acc'];
		$array_dtacc[] = $row_get['dt_acc'];
		$array_status[] = $row_get['status'];
		$array_hasilalamat[] = $row_get['hasil_alat'];
		$array_flagalat[] = $row_get['flag_alat'];
		$array_nrujukanalat[] = $row_get['n_rujukan_alat'];
		$array_satuanalat[] = $row_get['satuan_alat'];
		$array_merkalat[] = $row_get['merk_alat'];
		$array_tipealat[] = $row_get['tipe_alat'];
		$array_kodelat[] = $row_get['kode_alat'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_tgljamtes[] = $row_get['tgljam_tes'];
		$array_dtbilling[] = $row_get['dt_billing'];
		$array_iduser[] = $row_get['id_user'];
		$array_kdakses[] = $row_get['kd_akses'];
		$array_kolc1[] = $row_get['kol_c_1'];
		$array_kolc2[] = $row_get['kol_c_2'];
		$array_kolc3[] = $row_get['kol_c_3'];
		$array_koln1[] = $row_get['kol_n_1'];
		$array_koln2[] = $row_get['kol_n_2'];
		$array_dtedit[] = $row_get['dt_edit'];
		$array_dtunlock[] = $row_get['dt_unlock'];
		$array_dt001[] = $row_get['dt_001'];
		$array_dt002[] = $row_get['dt_002'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID_MASTER'] = $array_idmaster;
	$grand_array['ID_LAB'] = $array_idlab;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['HASIL'] = $array_hasil;
	$grand_array['FLAG'] = $array_flag;
	$grand_array['RUJUKAN_AWAL'] = $array_rujukanawal;
	$grand_array['RUJUKAN_AKHIR'] = $array_rujukanakhir;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['DT_PERIKSA'] = $array_dtperiksa;
	$grand_array['KD_ACC'] = $array_kdacc;
	$grand_array['DT_ACC'] = $array_dtacc;
	$grand_array['STATUS'] = $array_status;
	$grand_array['HASIL_ALAT'] = $array_hasilalamat;
	$grand_array['FLAG_ALAT'] = $array_flagalat;
	$grand_array['N_RUJUKAN_ALAT'] = $array_nrujukanalat;
	$grand_array['SATUAN_ALAT'] = $array_satuanalat;
	$grand_array['MERK_ALAT'] = $array_merkalat;
	$grand_array['TIPE_ALAT'] = $array_tipealat;
	$grand_array['KODE_ALAT'] = $array_kodelat;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['TGLJAM_TES'] = $array_tgljamtes;
	$grand_array['DT_BILLING'] = $array_dtbilling;
	$grand_array['ID_USER'] = $array_iduser;
	$grand_array['KD_AKSES'] = $array_kdakses;
	$grand_array['KOL_C_1'] = $array_kolc1;
	$grand_array['KOL_C_2'] = $array_kolc2;
	$grand_array['KOL_C_3'] = $array_kolc3;
	$grand_array['KOL_N_1'] = $array_koln1;
	$grand_array['KOL_N_2'] = $array_koln2;
	$grand_array['DT_EDIT'] = $array_dtedit;
	$grand_array['DT_UNLOCK'] = $array_dtunlock;
	$grand_array['DT_001'] = $array_dt001;
	$grand_array['DT_002'] = $array_dt002;
	
	return $grand_array;

}

function GetAllLabDetail(){
	global $db;
	
	$query_get = "select * from public.tab_lab_detil";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_idmaster[] = $row_get['id_master'];
		$array_idlab[] = $row_get['id_lab'];
		$array_satuan[] = $row_get['satuan'];
		$array_hasil[] = $row_get['hasil'];
		$array_flag[] = $row_get['flag'];
		$array_rujukanawal[] = $row_get['rujukan_awal'];
		$array_rujukanakhir[] = $row_get['rujukan_akhir'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_metoda[] = $row_get['metoda'];
		$array_dtperiksa[] = $row_get['dt_periksa'];
		$array_kdacc[] = $row_get['kd_acc'];
		$array_dtacc[] = $row_get['dt_acc'];
		$array_status[] = $row_get['status'];
		$array_hasilalamat[] = $row_get['hasil_alat'];
		$array_flagalat[] = $row_get['flag_alat'];
		$array_nrujukanalat[] = $row_get['n_rujukan_alat'];
		$array_satuanalat[] = $row_get['satuan_alat'];
		$array_merkalat[] = $row_get['merk_alat'];
		$array_tipealat[] = $row_get['tipe_alat'];
		$array_kodelat[] = $row_get['kode_alat'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_tgljamtes[] = $row_get['tgljam_tes'];
		$array_dtbilling[] = $row_get['dt_billing'];
		$array_iduser[] = $row_get['id_user'];
		$array_kdakses[] = $row_get['kd_akses'];
		$array_kolc1[] = $row_get['kol_c_1'];
		$array_kolc2[] = $row_get['kol_c_2'];
		$array_kolc3[] = $row_get['kol_c_3'];
		$array_koln1[] = $row_get['kol_n_1'];
		$array_koln2[] = $row_get['kol_n_2'];
		$array_dtedit[] = $row_get['dt_edit'];
		$array_dtunlock[] = $row_get['dt_unlock'];
		$array_dt001[] = $row_get['dt_001'];
		$array_dt002[] = $row_get['dt_002'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID_MASTER'] = $array_idmaster;
	$grand_array['ID_LAB'] = $array_idlab;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['HASIL'] = $array_hasil;
	$grand_array['FLAG'] = $array_flag;
	$grand_array['RUJUKAN_AWAL'] = $array_rujukanawal;
	$grand_array['RUJUKAN_AKHIR'] = $array_rujukanakhir;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['DT_PERIKSA'] = $array_dtperiksa;
	$grand_array['KD_ACC'] = $array_kdacc;
	$grand_array['DT_ACC'] = $array_dtacc;
	$grand_array['STATUS'] = $array_status;
	$grand_array['HASIL_ALAT'] = $array_hasilalamat;
	$grand_array['FLAG_ALAT'] = $array_flagalat;
	$grand_array['N_RUJUKAN_ALAT'] = $array_nrujukanalat;
	$grand_array['SATUAN_ALAT'] = $array_satuanalat;
	$grand_array['MERK_ALAT'] = $array_merkalat;
	$grand_array['TIPE_ALAT'] = $array_tipealat;
	$grand_array['KODE_ALAT'] = $array_kodelat;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['TGLJAM_TES'] = $array_tgljamtes;
	$grand_array['DT_BILLING'] = $array_dtbilling;
	$grand_array['ID_USER'] = $array_iduser;
	$grand_array['KD_AKSES'] = $array_kdakses;
	$grand_array['KOL_C_1'] = $array_kolc1;
	$grand_array['KOL_C_2'] = $array_kolc2;
	$grand_array['KOL_C_3'] = $array_kolc3;
	$grand_array['KOL_N_1'] = $array_koln1;
	$grand_array['KOL_N_2'] = $array_koln2;
	$grand_array['DT_EDIT'] = $array_dtedit;
	$grand_array['DT_UNLOCK'] = $array_dtunlock;
	$grand_array['DT_001'] = $array_dt001;
	$grand_array['DT_002'] = $array_dt002;
	
	return $grand_array;
}



function GetLabMasterByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_lab_master where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

/* 	echo $query_get;exit; */

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nolab[] = $row_get['no_lab'];
		$array_norm[] = $row_get['no_rm'];
		$array_umur[] = $row_get['umur'];
		$array_umursat[] = $row_get['umur_sat'];
		$array_usia[] = $row_get['usia'];
		$array_nama[] = $row_get['nama'];
		$array_sex[] = $row_get['sex'];
		$array_alamat[] = $row_get['alamat'];
		$array_tgllahir[] = $row_get['tgl_lahir'];
		$array_idruang[] = $row_get['id_ruang'];
		$array_nmruang[] = $row_get['nm_ruang'];
		$array_idkelas[] = $row_get['id_kelas'];
		$array_nmkelas[] = $row_get['nm_kelas'];
		$array_idstatus[] = $row_get['id_status'];
		$array_nmstatus[] = $row_get['nm_status'];
		$array_iddokter[] = $row_get['id_dokter'];
		$array_nmdokter[] = $row_get['nm_dokter'];
		$array_alamatdokter[] = $row_get['alamat_dokter'];
		$array_ketklinik[] = $row_get['ket_klinik'];
		$array_catatan1[] = $row_get['catatan_1'];
		$array_catatan2[] = $row_get['catatan_2'];
		$array_idpengentri[] = $row_get['id_pengentri'];
		$array_nmpengentri[] = $row_get['nm_pengentri'];
		$array_idpemeriksa[] = $row_get['id_pemeriksa'];
		$array_nmpemeriksa[] = $row_get['nm_pemeriksa'];
		$array_dtpemeriksa[] = $row_get['dt_pemeriksa'];
		$array_iddokteracc[] = $row_get['id_dokter_acc'];
		$array_nmdokteracc[] = $row_get['nm_dokter_acc'];
		$array_kdacc[] = $row_get['kd_acc'];
		$array_dtacc[] = $row_get['dt_acc'];
		$array_dtprint[] = $row_get['dt_print'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['udpated_at'];
		$array_notrans[] = $row_get['no_trans'];
		$array_dtbilling[] = $row_get['dt_billing'];
		$array_umur1[] = $row_get['umur1'];
		$array_umursat1[] = $row_get['umur_sat1'];
		$array_kolchar1[] = $row_get['kol_char1'];
		$array_kolchar2[] = $row_get['kol_char2'];
		$array_kolchar3[] = $row_get['kol_char3'];
		$array_kolnum1[] = $row_get['kol_num1'];
		$array_periksajam[] = $row_get['periksa_jam'];
		$array_accjam[] = $row_get['acc_jam'];
		$array_printjam[] = $row_get['print_jam'];
		$array_catatan3[] = $row_get['catatan_3'];
		$array_catatan4[] = $row_get['catatan_4'];
		$array_kdpemeriksa[] = $row_get['kd_pemeriksa'];
		$array_overallstatus[] = $row_get['overall_status'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NO_LAB'] = $array_nolab;
	$grand_array['NO_RM'] = $array_norm;
	$grand_array['UMUR'] = $array_umur;
	$grand_array['UMUR_SAT'] = $array_umursat;
	$grand_array['USIA'] = $array_usia;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['SEX'] = $array_sex;
	$grand_array['ALAMAT'] = $array_alamat;
	$grand_array['TGL_LAHIR'] = $array_tgllahir;
	$grand_array['ID_RUANG'] = $array_idruang;
	$grand_array['NM_RUANG'] = $array_nmruang;
	$grand_array['ID_KELAS'] = $array_idkelas;
	$grand_array['NM_KELAS'] = $array_nmkelas;
	$grand_array['ID_STATUS'] = $array_idstatus;
	$grand_array['NM_STATUS'] = $array_nmstatus;
	$grand_array['ID_DOKTER'] = $array_iddokter;
	$grand_array['NM_DOKTER'] = $array_nmdokter;
	$grand_array['ALAMAT_DOKTER'] = $array_alamatdokter;
	$grand_array['KET_KLINIK'] = $array_ketklinik;
	$grand_array['CATATAN_1'] = $array_catatan1;
	$grand_array['CATATAN_2'] = $array_catatan2;
	$grand_array['ID_PENGENTRI'] = $array_idpengentri;
	$grand_array['NM_PENGENTRI'] = $array_nmpengentri;
	$grand_array['ID_PEMERIKSA'] = $array_idpemeriksa;
	$grand_array['NM_PEMERIKSA'] = $array_nmpemeriksa;
	$grand_array['DT_PEMERIKSA'] = $array_dtpemeriksa;
	$grand_array['ID_DOKTER_ACC'] =	$array_iddokteracc;
	$grand_array['NM_DOKTER_ACC'] = $array_nmdokteracc;
	$grand_array['KD_ACC'] = $array_kdacc;
	$grand_array['DT_ACC'] = $array_dtacc;
	$grand_array['DT_PRINT'] = $array_dtprint;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UDPATED_AT'] = $array_updatedat;
	$grand_array['NO_TRANS'] = $array_notrans;
	$grand_array['DT_BILLING'] = $array_dtbilling;
	$grand_array['UMUR1'] =	$array_umur1;
	$grand_array['UMUR_SAT1'] = $array_umursat1;
	$grand_array['KOL_CHAR1'] = $array_kolchar1;
	$grand_array['KOL_CHAR2'] = $array_kolchar2;
	$grand_array['KOL_CHAR3'] =	$array_kolchar3;
	$grand_array['KOL_NUM1'] = $array_kolnum1;
	$grand_array['PERIKSA_JAM'] = $array_periksajam;
	$grand_array['ACC_JAM'] = $array_accjam;
	$grand_array['PRINT_JAM'] = $array_printjam;
	$grand_array['CATATAN_3'] = $array_catatan3;
	$grand_array['CATATAN_4'] = $array_catatan4;
	$grand_array['KD_PEMERIKSA'] = $array_kdpemeriksa;
	$grand_array['OVERALL_STATUS'] = $array_overallstatus;
	
	return $grand_array;

}

function GetAllLabMaster(){
	global $db;
	
	if( $_SESSION['OSH']['ROLES'] == 'superadmin' ){
		$query_get = "select * from public.tab_lab_master";
	} else {
		$query_get = "select * from public.tab_lab_master where id_rs = '".$_SESSION['OSH']['ID_RS']."' ";
	}

	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nolab[] = $row_get['no_lab'];
		$array_norm[] = $row_get['no_rm'];
		$array_umur[] = $row_get['umur'];
		$array_umursat[] = $row_get['umur_sat'];
		$array_usia[] = $row_get['usia'];
		$array_nama[] = $row_get['nama'];
		$array_sex[] = $row_get['sex'];
		$array_alamat[] = $row_get['alamat'];
		$array_tgllahir[] = $row_get['tgl_lahir'];
		$array_idruang[] = $row_get['id_ruang'];
		$array_nmruang[] = $row_get['nm_ruang'];
		$array_idkelas[] = $row_get['id_kelas'];
		$array_nmkelas[] = $row_get['nm_kelas'];
		$array_idstatus[] = $row_get['id_status'];
		$array_nmstatus[] = $row_get['nm_status'];
		$array_iddokter[] = $row_get['id_dokter'];
		$array_nmdokter[] = $row_get['nm_dokter'];
		$array_alamatdokter[] = $row_get['alamat_dokter'];
		$array_ketklinik[] = $row_get['ket_klinik'];
		$array_catatan1[] = $row_get['catatan_1'];
		$array_catatan2[] = $row_get['catatan_2'];
		$array_idpengentri[] = $row_get['id_pengentri'];
		$array_nmpengentri[] = $row_get['nm_pengentri'];
		$array_idpemeriksa[] = $row_get['id_pemeriksa'];
		$array_nmpemeriksa[] = $row_get['nm_pemeriksa'];
		$array_dtpemeriksa[] = $row_get['dt_pemeriksa'];
		$array_iddokteracc[] = $row_get['id_dokter_acc'];
		$array_nmdokteracc[] = $row_get['nm_dokter_acc'];
		$array_kdacc[] = $row_get['kd_acc'];
		$array_dtacc[] = $row_get['dt_acc'];
		$array_dtprint[] = $row_get['dt_print'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['udpated_at'];
		$array_notrans[] = $row_get['no_trans'];
		$array_dtbilling[] = $row_get['dt_billing'];
		$array_umur1[] = $row_get['umur1'];
		$array_umursat1[] = $row_get['umur_sat1'];
		$array_kolchar1[] = $row_get['kol_char1'];
		$array_kolchar2[] = $row_get['kol_char2'];
		$array_kolchar3[] = $row_get['kol_char3'];
		$array_kolnum1[] = $row_get['kol_num1'];
		$array_periksajam[] = $row_get['periksa_jam'];
		$array_accjam[] = $row_get['acc_jam'];
		$array_printjam[] = $row_get['print_jam'];
		$array_catatan3[] = $row_get['catatan_3'];
		$array_catatan4[] = $row_get['catatan_4'];
		$array_kdpemeriksa[] = $row_get['kd_pemeriksa'];
		$array_overallstatus[] = $row_get['overall_status'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NO_LAB'] = $array_nolab;
	$grand_array['NO_RM'] = $array_norm;
	$grand_array['UMUR'] = $array_umur;
	$grand_array['UMUR_SAT'] = $array_umursat;
	$grand_array['USIA'] = $array_usia;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['SEX'] = $array_sex;
	$grand_array['ALAMAT'] = $array_alamat;
	$grand_array['TGL_LAHIR'] = $array_tgllahir;
	$grand_array['ID_RUANG'] = $array_idruang;
	$grand_array['NM_RUANG'] = $array_nmruang;
	$grand_array['ID_KELAS'] = $array_idkelas;
	$grand_array['NM_KELAS'] = $array_nmkelas;
	$grand_array['ID_STATUS'] = $array_idstatus;
	$grand_array['NM_STATUS'] = $array_nmstatus;
	$grand_array['ID_DOKTER'] = $array_iddokter;
	$grand_array['NM_DOKTER'] = $array_nmdokter;
	$grand_array['ALAMAT_DOKTER'] = $array_alamatdokter;
	$grand_array['KET_KLINIK'] = $array_ketklinik;
	$grand_array['CATATAN_1'] = $array_catatan1;
	$grand_array['CATATAN_2'] = $array_catatan2;
	$grand_array['ID_PENGENTRI'] = $array_idpengentri;
	$grand_array['NM_PENGENTRI'] = $array_nmpengentri;
	$grand_array['ID_PEMERIKSA'] = $array_idpemeriksa;
	$grand_array['NM_PEMERIKSA'] = $array_nmpemeriksa;
	$grand_array['DT_PEMERIKSA'] = $array_dtpemeriksa;
	$grand_array['ID_DOKTER_ACC'] =	$array_iddokteracc;
	$grand_array['NM_DOKTER_ACC'] = $array_nmdokteracc;
	$grand_array['KD_ACC'] = $array_kdacc;
	$grand_array['DT_ACC'] = $array_dtacc;
	$grand_array['DT_PRINT'] = $array_dtprint;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UDPATED_AT'] = $array_updatedat;
	$grand_array['NO_TRANS'] = $array_notrans;
	$grand_array['DT_BILLING'] = $array_dtbilling;
	$grand_array['UMUR1'] =	$array_umur1;
	$grand_array['UMUR_SAT1'] = $array_umursat1;
	$grand_array['KOL_CHAR1'] = $array_kolchar1;
	$grand_array['KOL_CHAR2'] = $array_kolchar2;
	$grand_array['KOL_CHAR3'] =	$array_kolchar3;
	$grand_array['KOL_NUM1'] = $array_kolnum1;
	$grand_array['PERIKSA_JAM'] = $array_periksajam;
	$grand_array['ACC_JAM'] = $array_accjam;
	$grand_array['PRINT_JAM'] = $array_printjam;
	$grand_array['CATATAN_3'] = $array_catatan3;
	$grand_array['CATATAN_4'] = $array_catatan4;
	$grand_array['KD_PEMERIKSA'] = $array_kdpemeriksa;
	$grand_array['OVERALL_STATUS'] = $array_overallstatus;
	
	return $grand_array;
}

function ACCHasilLab($input_parameter){
	global $db;
	
	$query_acc = "update public.tab_lab_master set overall_status = 2 where id = '".$input_parameter['ID']."'";
	$result_acc = pg_query($db, $query_acc);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Lab (".$input_parameter['ID'].") telah berhasil di acc.";
	
	return $function_result;
}

function TolakHasilLab($input_parameter){
	global $db;
	
	$query_acc = "update public.tab_lab_master set overall_status = 3 where id = '".$input_parameter['ID']."'";
	$result_acc = pg_query($db, $query_acc);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Lab (".$input_parameter['ID'].") telah berhasil ditolak.";
	
	return $function_result;
}

function EmptyLab(){
	global $db;
	
	$query_empty = 
	"
	truncate lab;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua lab point telah berhasil dihapus.";
	
	return $function_result;
}





?>