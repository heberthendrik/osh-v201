<?php

/*==========================================

/*==========================================*/

function AddKodeLab($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from lab_code b
	where
		b.NAME = '".addslashes($input_parameter['NAME'])."'
	";
/* 	echo $query_check;exit; */
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Kode Lab (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan kode lab yang lain.";
	} else {
	
		$query_add = 
		"
		insert into lab_code
		(
		NAME,
		GROUP_1,
		GROUP_2,
		GROUP_3,
		SATUAN,
		METODA,
		KD_LAB,
		KD_LIS,
		KOMA,
		YFORMAT,
		KD_FROM_DEVICE,
		CREATED_AT,
		CREATED_BY
		)
		values
		(
		'".addslashes($input_parameter['NAME'])."',
		'".addslashes($input_parameter['GROUP_1'])."',
		'".addslashes($input_parameter['GROUP_2'])."',
		'".addslashes($input_parameter['GROUP_3'])."',
		'".addslashes($input_parameter['SATUAN'])."',
		'".addslashes($input_parameter['METODA'])."',
		'".addslashes($input_parameter['KD_LAB'])."',
		'".addslashes($input_parameter['KD_LIS'])."',
		'".addslashes($input_parameter['KOMA'])."',
		'".addslashes($input_parameter['YFORMAT'])."',
		'".addslashes($input_parameter['KD_FROM_DEVICE'])."',
		'".date('Y-m-d H:i:s')."',
		'".$_SESSION['OSH']['COMPOSITE_ID']."'
		)
		";
		
		$result_add = $db->query($query_add);
		$new_id = $db->insert_id;
		
/* 		echo $query_add;exit; */
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Kode Lab telah berhasil ditambahkan." ;
		$function_result['NEW_ID'] = $new_id;

	}
	
	return $function_result;
}

function AddNilaiRujukanByKodeLabID($input_parameter){
	global $db;
	
	$query_add = 
	"
	insert into public.tab_n_rujukan
	(
	id_kdlab,
	sex,
	age_1,
	age_2,
	umur_sat,
	n_rujukan,
	status,
	ket,
	created_at
	)
	values
	(
	'".$input_parameter['ID_KDLAB']."',
	'".$input_parameter['SEX']."',
	'".$input_parameter['USIA_AWAL']."',
	'".$input_parameter['USIA_AKHIR']."',
	'".$input_parameter['UMUR_SAT']."',
	'".$input_parameter['NILAI_RUJUKAN']."',
	'".$input_parameter['STATUS']."',
	'".$input_parameter['KETERANGAN']."',
	'".date('Y-m-d H:i:s')."'
	)
	";
	
	$result_add = $db->query($query_add);
	$row_add = $result_add->fetch_assoc();
	
	//echo $query_add;exit;
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Nilai Rujukan telah berhasil ditambahkan." ;

	return $function_result;
}

function GetAllNilaiRujukanByKodeLabID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_n_rujukan where id_kdlab = '".$input_parameter['ID_KDLAB']."'";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['id'];
		$array_sex[] = $row_get['sex'];
		$array_age1[] = $row_get['age_1'];
		$array_age2[] = $row_get['age_2'];
		$array_satuan[] = $row_get['umur_sat'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_ket[] = $row_get['ket'];
		$array_status[] = $row_get['status'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['SEX'] = $array_sex;
	$grand_array['AGE_1'] = $array_age1;
	$grand_array['AGE_2'] = $array_age2;
	$grand_array['UMUR_SAT'] = $array_satuan;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['KET'] = $array_ket;
	$grand_array['STATUS'] = $array_status;
	
	return $grand_array;
	
}

function DeleteNilaiRujukanByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_n_rujukan
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = $db->query($query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data nilai rujukan telah berhasil dihapus.";
	
	return $function_result;
}














function UpdateKodeLabByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from lab_code b
	where
		b.NAME = '".addslashes($input_parameter['NAME'])."'
		and b.id != '".$input_parameter['ID']."'
	";
/* 	echo $query_check;exit; */
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Kode Lab (".$input_parameter['NAME'].") telah digunakan. Silahkan mencoba kembali dengan nama kode lab yang lain.";
	} else {
	
		$query_update = 
		"
		update
			lab_code
		set
		
			NAME = '".addslashes($input_parameter['NAME'])."',
			GROUP_1 = '".addslashes($input_parameter['GROUP_1'])."',
			GROUP_2 = '".addslashes($input_parameter['GROUP_2'])."',
			GROUP_3 = '".addslashes($input_parameter['GROUP_3'])."',
			SATUAN = '".addslashes($input_parameter['SATUAN'])."',
			METODA = '".addslashes($input_parameter['METODA'])."',
			KD_LAB = '".addslashes($input_parameter['KD_LAB'])."',
			KD_LIS = '".addslashes($input_parameter['KD_LIS'])."',
			KOMA = '".addslashes($input_parameter['KOMA'])."',
			YFORMAT = '".addslashes($input_parameter['YFORMAT'])."',
			KD_FROM_DEVICE = '".addslashes($input_parameter['KD_FROM_DEVICE'])."',
			UPDATED_AT = '".date('Y-m-d H:i:s')."',
			UPDATED_BY = '".$_SESSION['OSH']['COMPOSITE_ID']."'
		where
			id = '".$input_parameter['ID']."'
		";
/* 		echo $query_update;exit; */
		$result_update = $db->query($query_update);
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data kode lab telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteKodeLabByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from lab_code
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = $db->query($query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data kode lab telah berhasil dihapus.";
	
	return $function_result;
}

function GetKodeLabByID($input_parameter){
	global $db;
	
	$query_get = "select * from lab_code where id = '".$input_parameter['ID']."' ";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_grup1[] = $row_get['GROUP_1'];
		$array_grup2[] = $row_get['GROUP_2'];
		$array_grup3[] = $row_get['GROUP_3'];
		$array_satuan[] = $row_get['SATUAN'];
		$array_metoda[] = $row_get['METODA'];
		$array_kdlab[] = $row_get['KD_LAB'];
		$array_kdlis[] = $row_get['KD_LIS'];
		$array_koma[] = $row_get['KOMA'];
		$array_yformat[] = $row_get['YFORMAT'];
		$array_kddarialat[] = $row_get['KD_FROM_DEVICE'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_updatedby[] = $row_get['UPDATED_BY'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAME'] = $array_nama;
	$grand_array['GROUP_1'] = $array_grup1;
	$grand_array['GROUP_2'] = $array_grup2;
	$grand_array['GROUP_3'] = $array_grup3;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['KD_LAB'] = $array_kdlab;
	$grand_array['KD_LIS'] = $array_kdlis;
	$grand_array['KOMA'] = $array_koma;
	$grand_array['YFORMAT'] = $array_yformat;
	$grand_array['KD_FROM_DEVICE'] = $array_kddarialat;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	
	return $grand_array;

}

function GetAllKodeLab(){
	global $db;
	
	$query_get = "select * from lab_code";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_grup1[] = $row_get['GROUP_1'];
		$array_grup2[] = $row_get['GROUP_2'];
		$array_grup3[] = $row_get['GROUP_3'];
		$array_satuan[] = $row_get['SATUAN'];
		$array_metoda[] = $row_get['METODA'];
		$array_kdlab[] = $row_get['KD_LAB'];
		$array_kdlis[] = $row_get['KD_LIS'];
		$array_koma[] = $row_get['KOMA'];
		$array_yformat[] = $row_get['YFORMAT'];
		$array_kddarialat[] = $row_get['KD_FROM_DEVICE'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_updatedby[] = $row_get['UPDATED_BY'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAME'] = $array_nama;
	$grand_array['GROUP_1'] = $array_grup1;
	$grand_array['GROUP_2'] = $array_grup2;
	$grand_array['GROUP_3'] = $array_grup3;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['KD_LAB'] = $array_kdlab;
	$grand_array['KD_LIS'] = $array_kdlis;
	$grand_array['KOMA'] = $array_koma;
	$grand_array['YFORMAT'] = $array_yformat;
	$grand_array['KD_FROM_DEVICE'] = $array_kddarialat;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	
	return $grand_array;
}

function EmptyKodeLab(){
	global $db;
	
	$query_empty = 
	"
	truncate kodelab;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua kodelab point telah berhasil dihapus.";
	
	return $function_result;
}





?>