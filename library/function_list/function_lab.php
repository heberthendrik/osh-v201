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
	
	$query_get = "select * from lab_main where ID = '".$input_parameter['ID']."' ";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['id'];
		$array_idmaster[] = $row_get['id_master'];
		$array_idlab[] = $row_get['id_lab'];
		$array_satuan[] = $row_get['satuan'];
		$array_hasil[] = $row_get['hasil'];
		$array_hasiledit[] = $row_get['hasil_edit'];
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
	$grand_array['HASIL_EDIT'] = $array_hasiledit;
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
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['id'];
		$array_idmaster[] = $row_get['id_master'];
		$array_idlab[] = $row_get['id_lab'];
		$array_satuan[] = $row_get['satuan'];
		$array_hasil[] = $row_get['hasil'];
		$array_hasiledit[] = $row_get['hasil_edit'];
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
	$grand_array['HASIL_EDIT'] = $array_hasiledit;
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
	
	$query_get = "select * from lab_main where id = '".$input_parameter['ID']."' ";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nolabprefix[] = $row_get['NO_LAB_PREFIX'];
		$array_nolab[] = $row_get['NO_LAB'];
		$array_idpatient[] = $row_get['ID_PATIENT'];
		$array_norm[] = $row_get['NO_RM'];
		$array_age[] = $row_get['AGE'];
		$array_patientname[] = $row_get['PATIENT_NAME'];
		$array_patientsex[] = $row_get['PATIENT_SEX'];
		$array_patientaddress[] = $row_get['PATIENT_ADDRESS'];
		$array_birthdate[] = $row_get['BIRTH_DATE'];
		$array_idroom[] = $row_get['ID_ROOM'];
		$array_roomname[] = $row_get['ROOM_NAME'];
		$array_idkelas[] = $row_get['ID_KELAS'];
		$array_kelasname[] = $row_get['KELAS_NAME'];
		$array_idstatus[] = $row_get['ID_STATUS'];
		$array_statusname[] = $row_get['STATUS_NAME'];
		$array_isinternaldoctor[] = $row_get['IS_INTERNAL_DOCTOR'];
		$array_iddoctorsender[] = $row_get['ID_DOCTOR_SENDER'];
		$array_doctorsendername[] = $row_get['DOCTOR_SENDER_NAME'];
		$array_doctorsenderaddress[] = $row_get['DOCTOR_SENDER_ADDRESS'];
		$array_ketklinik[] = $row_get['KET_KLINIK'];
		$array_note1[] = $row_get['NOTE_1'];
		$array_note2[] = $row_get['NOTE_2'];
		$array_idmasteruserlabcreation[] = $row_get['ID_MASTER_USER_LAB_CREATION'];
		$array_masteruserlabcreationname[] = $row_get['MASTER_USER_LAB_CREATION_NAME'];
		$array_iddoctorassigned[] = $row_get['ID_DOCTOR_ASSIGNED'];
		$array_accat[] = $row_get['ACC_AT'];
		$array_iddokteracc[] = $row_get['ID_DOCTOR_ACC'];
		$array_nmdokteracc[] = $row_get['DOCTOR_ACC_NAME'];
		$array_rejectedat[] = $row_get['REJECTED_AT'];
		$array_iddoctorrejection[] = $row_get['ID_DOCTOR_REJECTION'];
		$array_doctorrejectionname[] = $row_get['DOCTOR_REJECTION_NAME'];
		$array_idrs[] = $row_get['ID_RS'];
		$array_overallstatus[] = $row_get['OVERALL_STATUS'];
		$array_islabdetailedited[] = $row_get['IS_LAB_DETAIL_EDITED'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_updatedby[] = $row_get['UDPATED_BY'];
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	
	$grand_array['ID'] = $array_id;
	$grand_array['NO_LAB_PREFIX'] = $array_nolabprefix;
	$grand_array['NO_LAB'] = $array_nolab;
	$grand_array['ID_PATIENT'] = $array_idpatient;
	$grand_array['NO_RM'] = $array_norm;
	$grand_array['AGE'] = $array_age;
	$grand_array['PATIENT_NAME'] = $array_patientname;
	$grand_array['PATIENT_SEX'] = $array_patientsex;
	$grand_array['PATIENT_ADDRESS'] = $array_patientaddress;
	$grand_array['BIRTH_DATE'] = $array_birthdate;
	$grand_array['ID_ROOM'] = $array_idroom;
	$grand_array['ROOM_NAME'] = $array_roomname;
	$grand_array['ID_KELAS'] = $array_idkelas;
	$grand_array['KELAS_NAME'] = $array_kelasname;
	$grand_array['ID_STATUS'] = $array_idstatus;
	$grand_array['STATUS_NAME'] = $array_statusname;
	$grand_array['IS_INTERNAL_DOCTOR'] = $array_isinternaldoctor;
	$grand_array['ID_DOCTOR_SENDER'] = $array_iddoctorsender;
	$grand_array['DOCTOR_SENDER_NAME'] = $array_doctorsendername;
	$grand_array['DOCTOR_SENDER_ADDRESS'] = $array_doctorsenderaddress;
	$grand_array['KET_KLINIK'] = $array_ketklinik;
	$grand_array['NOTE_1'] = $array_note1;
	$grand_array['NOTE_2'] = $array_note2;
	$grand_array['ID_MASTER_USER_LAB_CREATION'] = $array_idmasteruserlabcreation;
	$grand_array['MASTER_USER_LAB_CREATION_NAME'] = $array_masteruserlabcreationname;
	$grand_array['ID_DOCTOR_ASSIGNED'] = $array_iddoctorassigned;
	$grand_array['ACC_AT'] = $array_accat;
	$grand_array['ID_DOCTOR_ACC'] = $array_iddokteracc;
	$grand_array['DOCTOR_ACC_NAME'] = $array_nmdokteracc;
	$grand_array['REJECTED_AT'] = $array_rejectedat;
	$grand_array['ID_DOCTOR_REJECTION'] = $array_iddoctorrejection;
	$grand_array['DOCTOR_REJECTION_NAME'] = $array_doctorrejectionname;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['OVERALL_STATUS'] = $array_overallstatus;
	$grand_array['IS_LAB_DETAIL_EDITED'] = $array_islabdetailedited;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UDPATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	
	return $grand_array;

}

function GetAllLabMaster(){
	global $db;
	
	if( $_SESSION['OSH']['ID_ROLE'] == 1 ){
		$query_get = "select * from lab_main";
	} else {
		$query_get = "select * from lab_main where ID_RS = '".$_SESSION['OSH']['ID_RS']."' ";
	}

	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nolabprefix[] = $row_get['NO_LAB_PREFIX'];
		$array_nolab[] = $row_get['NO_LAB'];
		$array_idpatient[] = $row_get['ID_PATIENT'];
		$array_norm[] = $row_get['NO_RM'];
		$array_age[] = $row_get['AGE'];
		$array_patientname[] = $row_get['PATIENT_NAME'];
		$array_patientsex[] = $row_get['PATIENT_SEX'];
		$array_patientaddress[] = $row_get['PATIENT_ADDRESS'];
		$array_birthdate[] = $row_get['BIRTH_DATE'];
		$array_idroom[] = $row_get['ID_ROOM'];
		$array_roomname[] = $row_get['ROOM_NAME'];
		$array_idkelas[] = $row_get['ID_KELAS'];
		$array_kelasname[] = $row_get['KELAS_NAME'];
		$array_idstatus[] = $row_get['ID_STATUS'];
		$array_statusname[] = $row_get['STATUS_NAME'];
		$array_isinternaldoctor[] = $row_get['IS_INTERNAL_DOCTOR'];
		$array_iddoctorsender[] = $row_get['ID_DOCTOR_SENDER'];
		$array_doctorsendername[] = $row_get['DOCTOR_SENDER_NAME'];
		$array_doctorsenderaddress[] = $row_get['DOCTOR_SENDER_ADDRESS'];
		$array_ketklinik[] = $row_get['KET_KLINIK'];
		$array_note1[] = $row_get['NOTE_1'];
		$array_note2[] = $row_get['NOTE_2'];
		$array_idmasteruserlabcreation[] = $row_get['ID_MASTER_USER_LAB_CREATION'];
		$array_masteruserlabcreationname[] = $row_get['MASTER_USER_LAB_CREATION_NAME'];
		$array_iddoctorassigned[] = $row_get['ID_DOCTOR_ASSIGNED'];
		$array_accat[] = $row_get['ACC_AT'];
		$array_iddokteracc[] = $row_get['ID_DOCTOR_ACC'];
		$array_nmdokteracc[] = $row_get['DOCTOR_ACC_NAME'];
		$array_rejectedat[] = $row_get['REJECTED_AT'];
		$array_iddoctorrejection[] = $row_get['ID_DOCTOR_REJECTION'];
		$array_doctorrejectionname[] = $row_get['DOCTOR_REJECTION_NAME'];
		$array_idrs[] = $row_get['ID_RS'];
		$array_overallstatus[] = $row_get['OVERALL_STATUS'];
		$array_islabdetailedited[] = $row_get['IS_LAB_DETAIL_EDITED'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_updatedby[] = $row_get['UDPATED_BY'];
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	
	$grand_array['ID'] = $array_id;
	$grand_array['NO_LAB_PREFIX'] = $array_nolabprefix;
	$grand_array['NO_LAB'] = $array_nolab;
	$grand_array['ID_PATIENT'] = $array_idpatient;
	$grand_array['NO_RM'] = $array_norm;
	$grand_array['AGE'] = $array_age;
	$grand_array['PATIENT_NAME'] = $array_patientname;
	$grand_array['PATIENT_SEX'] = $array_patientsex;
	$grand_array['PATIENT_ADDRESS'] = $array_patientaddress;
	$grand_array['BIRTH_DATE'] = $array_birthdate;
	$grand_array['ID_ROOM'] = $array_idroom;
	$grand_array['ROOM_NAME'] = $array_roomname;
	$grand_array['ID_KELAS'] = $array_idkelas;
	$grand_array['KELAS_NAME'] = $array_kelasname;
	$grand_array['ID_STATUS'] = $array_idstatus;
	$grand_array['STATUS_NAME'] = $array_statusname;
	$grand_array['IS_INTERNAL_DOCTOR'] = $array_isinternaldoctor;
	$grand_array['ID_DOCTOR_SENDER'] = $array_iddoctorsender;
	$grand_array['DOCTOR_SENDER_NAME'] = $array_doctorsendername;
	$grand_array['DOCTOR_SENDER_ADDRESS'] = $array_doctorsenderaddress;
	$grand_array['KET_KLINIK'] = $array_ketklinik;
	$grand_array['NOTE_1'] = $array_note1;
	$grand_array['NOTE_2'] = $array_note2;
	$grand_array['ID_MASTER_USER_LAB_CREATION'] = $array_idmasteruserlabcreation;
	$grand_array['MASTER_USER_LAB_CREATION_NAME'] = $array_masteruserlabcreationname;
	$grand_array['ID_DOCTOR_ASSIGNED'] = $array_iddoctorassigned;
	$grand_array['ACC_AT'] = $array_accat;
	$grand_array['ID_DOCTOR_ACC'] = $array_iddokteracc;
	$grand_array['DOCTOR_ACC_NAME'] = $array_nmdokteracc;
	$grand_array['REJECTED_AT'] = $array_rejectedat;
	$grand_array['ID_DOCTOR_REJECTION'] = $array_iddoctorrejection;
	$grand_array['DOCTOR_REJECTION_NAME'] = $array_doctorrejectionname;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['OVERALL_STATUS'] = $array_overallstatus;
	$grand_array['IS_LAB_DETAIL_EDITED'] = $array_islabdetailedited;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UDPATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	
	return $grand_array;
}

function ACCHasilLab($input_parameter){
	global $db;
	
	$query_acc = 
	"
	update lab_main 
	set 
		overall_status = 2,
		ACC_AT = '".date('Y-m-d H:i:s')."',
		ID_DOCTOR_ACC = '".$_SESSION['OSH']['COMPOSITE_ID']."',
		DOCTOR_ACC_NAME = '".$_SESSION['OSH']['NAME']."'
	where id = '".$input_parameter['ID']."'
	";
	$result_acc = $db->query($query_acc);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Lab (".$input_parameter['ID'].") telah berhasil di acc.";
	
	return $function_result;
}

function TolakHasilLab($input_parameter){
	global $db;
	
	$query_acc = 
	"
	update lab_main 
	set 
		overall_status = 3,
		REJECTED_AT = '".date('Y-m-d H:i:s')."',
		ID_DOCTOR_REJECTION = '".$_SESSION['OSH']['COMPOSITE_ID']."',
		DOCTOR_REJECTION_NAME = '".$_SESSION['OSH']['NAME']."'
	where id = '".$input_parameter['ID']."'
	";
	$result_acc = $db->query($query_acc);
	
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

function AddTemporaryLabNumber(){
	global $db;
	
	$query_getmax = "select max(id) as ID_TERAKHIR from lab_main";
	$result_getmax = $db->query($query_getmax);
	$row_getmax = $result_getmax->fetch_assoc();
	$last_id = $row_getmax['ID_TERAKHIR'];
	
	$new_id = $last_id+1;
	$query_add_temporary = "insert into lab_main (ID) values('".$new_id."')";
	$result_add_temporary = $db->query($query_add_temporary);
	$new_id = $db->insert_id;
	
	$function_result['NEW_ID'] = $new_id;
	
	return $function_result;
	
}

function InputLabTahap1($input_parameter){
	global $db;
	
	$input_parameter_patient['ID'] = $input_parameter['ID_PATIENT'];
	$function_GetPatientByID = GetPasienByID($input_parameter_patient);
	
	$input_parameter_calculateage['DATE_START'] = $function_GetPatientByID['BIRTH_DATE'][0];
	$function_CalculateAge = CalculateAge($input_parameter_calculateage);
	
	$query_update = 
	"
	update lab_main set 
		ID_PATIENT = '".$function_GetPatientByID['ID'][0]."',
		NO_RM = '".$function_GetPatientByID['NO_RM'][0]."',
		AGE = '".$function_CalculateAge."',
		PATIENT_NAME = '".$function_GetPatientByID['NAME'][0]."',
		PATIENT_SEX = '".$function_GetPatientByID['SEX'][0]."',
		PATIENT_ADDRESS = '".$function_GetPatientByID['ADDRESS'][0]."',
		BIRTH_DATE = '".$function_GetPatientByID['BIRTH_DATE'][0]."',
		ID_RS = '".$function_GetPatientByID['ID_RS'][0]."'
	where
		ID = '".$input_parameter['ID']."'
	";
	$result_update = $db->query($query_update);
}

function InputLabTahap2_Internal($input_parameter){
	global $db;
	
	$input_parameter_doctor['ID'] = $input_parameter['ID_DOCTOR'];
	$function_GetDoctorByID = GetDokterByID($input_parameter_doctor);
	
	$input_parameter_hospital['ID'] = $function_GetDoctorByID['ID_RS'][0];
	$function_GetRumahSakitByID = GetRumahSakitByID($input_parameter_hospital);
	
	$query_update = "
	update lab_main set
		IS_INTERNAL_DOCTOR = 1,
		ID_DOCTOR_SENDER = '".$function_GetDoctorByID['ID'][0]."',
		DOCTOR_SENDER_NAME = '".$function_GetDoctorByID['NAME'][0]."',
		DOCTOR_SENDER_ADDRESS = '".$function_GetRumahSakitByID['ADDRESS'][0]."'
	where
		ID = '".$input_parameter['ID']."'
	";
	$result_update = $db->query($query_update);
	
}

function InputLabTahap2_Eksternal($input_parameter){
	global $db;
	
	$query_update = "
	update lab_main set
		IS_INTERNAL_DOCTOR = 0,
		ID_DOCTOR_SENDER = null,
		DOCTOR_SENDER_NAME = '".$input_parameter['DOCTOR_SENDER_NAME']."',
		DOCTOR_SENDER_ADDRESS = '".$input_parameter['DOCTOR_SENDER_ADDRESS']."'
	where
		ID = '".$input_parameter['ID']."'
	";

	$result_update = $db->query($query_update);
	
}

function InputLabTahap3($input_parameter){
	global $db;
	
	$input_parameter_ruang['ID'] = $input_parameter['ID_RUANG'];
	$function_GetRuangByID = GetRuangByID($input_parameter_ruang);
	
	$input_parameter_kelas['ID'] = $input_parameter['ID_KELAS'];
	$function_GetKelasByID = GetKelasByID($input_parameter_kelas);
	
	$input_parameter_status['ID'] = $input_parameter['ID_STATUS'];
	$function_GetStatusByID = GetStatusByID($input_parameter_status);
	
	$query_update = 
	"
	update lab_main set
		ID_ROOM = '".$input_parameter['ID_RUANG']."',
		ROOM_NAME = '".$function_GetRuangByID['NAMA'][0]."',
		ID_KELAS = '".$input_parameter['ID_KELAS']."',
		KELAS_NAME = '".$function_GetKelasByID['NAMA'][0]."',
		ID_STATUS = '".$input_parameter['ID_STATUS']."',
		ID_DOCTOR_ASSIGNED = '".$input_parameter['ID_DOCTOR_ASSIGNED']."',
		STATUS_NAME = '".$function_GetStatusByID['NAMA'][0]."',
		KET_KLINIK = '".$input_parameter['KET_KLINIK']."',
		NOTE_1 = '".$input_parameter['CATATAN_1']."',
		NOTE_2 = '".$input_parameter['CATATAN_2']."'
	where
		ID = '".$input_parameter['ID']."'
	";
	//echo $query_update;exit;
	$result_udpate = $db->query($query_update);
	
	if( $result_udpate ){
		$function_result['FUNCTION_RESULT'] = 1;
	} else {
		$function_result['FUNCTION_RESULT'] = 0;
	}
	
	return $function_result;
	
}

function FinalizeInputLab($input_parameter){
	global $db;
	
	$query_getmaxnolab = "select max(NO_LAB) as last_id_oftheday from lab_main where no_lab_prefix = '".date('Ymd')."'";
	$result_getmaxnolab = $db->query($query_getmaxnolab);
	$row_getmaxnolab = $result_getmaxnolab->fetch_assoc();
	$last_id = $row_getmaxnolab['last_id_oftheday'];
	$new_id = $last_id + 1;
	
	if( strlen($new_id) == 1 ){
		$new_id = '00'.$new_id;
	} else if( strlen($new_id) == 2 ){
		$new_id = '00'.$new_id;
	} else if( strlen($new_id) == 3 ){
		$new_id = $new_id;
	}
	
	$query_update = 
	"
	update lab_main
	set 
		ID_MASTER_USER_LAB_CREATION = '".$_SESSION['OSH']['COMPOSITE_ID']."',
		MASTER_USER_LAB_CREATION_NAME = '".$_SESSION['OSH']['NAME']."',
		OVERALL_STATUS = 1,
		NO_LAB_PREFIX = '".date('Ymd')."',
		NO_LAB = '".$new_id."',
		CREATED_AT = '".date('Y-m-d H:i:s')."',
		CREATED_BY = '".$_SESSION['OSH']['COMPOSITE_ID']."'
	where
		ID = '".$input_parameter['ID']."'
	";
	$result_udpate = $db->query($query_update);
	
	if( $result_udpate ){
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data lab telah berhasil ditambahkan." ;
	} else {
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Penambahan data gagal. Silahkan hubungi adminsitrator." ;
	}
		
	return $function_result;
}

function UpdateLabDetail($input_parameter){
	global $db;
	
	for( $i=0;$i<count($input_parameter['ARRAY_LAB_DETAIL_ID']);$i++ ){
		
		$query_update = 
		"
		update lab_detail 
		set 
			HASIL_EDIT = '".$input_parameter['ARRAY_HASIL'][$i]."' 
		where 
			ID = '".$input_parameter['ARRAY_LAB_DETAIL_ID'][$i]."' 
			and ID_LAB_MAIN = '".$input_parameter['ID']."'
		";
		$result_update = $db->query($query_update);
		
	}
	
	$query_update = "update lab_main set IS_LAB_DETAIL_EDITED = 1 where id = '".$input_parameter['ID']."'";
	$result_update = $db->query($query_update);
	
	if( $result_update ){
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data lab telah berhasil diubah." ;
	} else {
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Pengubahan data lab detail gagal. Silahkan hubungi adminsitrator." ;
	}
		
	return $function_result;
	
}





?>