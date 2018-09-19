<?php

/*==========================================

/*==========================================*/

function AddKodeLab($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_kdlab b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Kode Lab (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan kode lab yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_kdlab
		(
		nama,
		metoda,
		grup1,
		status
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".addslashes($input_parameter['METODA'])."',
		'".addslashes($input_parameter['GRUP'])."',
		'".$input_parameter['STATUS']."'
		)
		";
		
		$result_add = pg_query($db, $query_add);
		$row_add = pg_fetch_row($result_add);
		
		//echo $query_add;exit;
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Kode Lab telah berhasil ditambahkan." ;

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
	
	$result_add = pg_query($db, $query_add);
	$row_add = pg_fetch_row($result_add);
	
	//echo $query_add;exit;
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Nilai Rujukan telah berhasil ditambahkan." ;

	return $function_result;
}

function GetAllNilaiRujukanByKodeLabID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_n_rujukan where id_kdlab = '".$input_parameter['ID_KDLAB']."'";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
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
	$result_delete = pg_query($db, $query_delete);
	
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
	from public.tab_kdlab b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id != '".$input_parameter['ID']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Kode Lab (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama kode lab yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_kdlab
		set
			nama = '".addslashes($input_parameter['NAMA'])."'
			,metoda = '".addslashes($input_parameter['METODA'])."'
			,grup1 = '".addslashes($input_parameter['GRUP'])."'
			,status = '".$input_parameter['STATUS']."'
		where
			id = '".$input_parameter['ID']."'
		";
		//echo $query_update;exit;
		$result_update = pg_query($db, $query_update);
	
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
	from public.tab_kdlab
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data kode lab telah berhasil dihapus.";
	
	return $function_result;
}

function GetKodeLabByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_kdlab where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_grup1[] = $row_get['grup1'];
		$array_grup2[] = $row_get['grup2'];
		$array_grup3[] = $row_get['grup3'];
		$array_satuan[] = $row_get['satuan'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_metoda[] = $row_get['metoda'];
		$array_status[] = $row_get['status'];
		$array_kdlab[] = $row_get['kdlab'];
		$array_kdlis[] = $row_get['kd_lis'];
		$array_koma[] = $row_get['koma'];
		$array_yformat[] = $row_get['yformat'];
		$array_kddarialat[] = $row_get['kd_dari_alat'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['GRUP1'] = $array_grup1;
	$grand_array['GRUP2'] = $array_grup2;
	$grand_array['GRUP3'] = $array_grup3;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['STATUS'] = $array_status;
	$grand_array['KDLAB'] =	$array_kdlab;
	$grand_array['KD_LIS'] = $array_kdlis;
	$grand_array['KOMA'] = $array_koma;
	$grand_array['YFORMAT'] = $array_yformat;
	$grand_array['KD_DARI_ALAT'] = $array_kddarialat;
	
	return $grand_array;

}

function GetAllKodeLab(){
	global $db;
	
	$query_get = "select * from public.tab_kdlab";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_grup1[] = $row_get['grup1'];
		$array_grup2[] = $row_get['grup2'];
		$array_grup3[] = $row_get['grup3'];
		$array_satuan[] = $row_get['satuan'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_metoda[] = $row_get['metoda'];
		$array_status[] = $row_get['status'];
		$array_kdlab[] = $row_get['kdlab'];
		$array_kdlis[] = $row_get['kd_lis'];
		$array_koma[] = $row_get['koma'];
		$array_yformat[] = $row_get['yformat'];
		$array_kddarialat[] = $row_get['kd_dari_alat'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['GRUP1'] = $array_grup1;
	$grand_array['GRUP2'] = $array_grup2;
	$grand_array['GRUP3'] = $array_grup3;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['STATUS'] = $array_status;
	$grand_array['KDLAB'] =	$array_kdlab;
	$grand_array['KD_LIS'] = $array_kdlis;
	$grand_array['KOMA'] = $array_koma;
	$grand_array['YFORMAT'] = $array_yformat;
	$grand_array['KD_DARI_ALAT'] = $array_kddarialat;
	
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