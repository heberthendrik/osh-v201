<?php

/*==========================================

/*==========================================*/

function AddNilaiRujukan($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_n_rujukan b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "NilaiRujukan (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nilairujukan yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_n_rujukan
		(
		nama,
		status,
		kode,
		id_rs,
		created_at
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".$input_parameter['STATUS']."',
		'".addslashes($input_parameter['KODE'])."',
		'".$input_parameter['ID_RS']."',
		'".date('Y-m-d H:i:s')."'
		)
		";
		
		$result_add = pg_query($db, $query_add);
		$row_add = pg_fetch_row($result_add);
		
		//echo $query_add;exit;
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "NilaiRujukan telah berhasil ditambahkan." ;

	}
	
	return $function_result;
}

function UpdateNilaiRujukanByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_n_rujukan b
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
		$function_result['SYSTEM_MESSAGE'] = "NilaiRujukan (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama nilairujukan yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_n_rujukan
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
		$function_result['SYSTEM_MESSAGE'] = "Data nilairujukan telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function xDeleteNilaiRujukanByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_n_rujukan
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data nilairujukan telah berhasil dihapus.";
	
	return $function_result;
}

function GetNilaiRujukanByKodeLabID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_n_rujukan where id_kdlab = '".$input_parameter['ID_KDLAB']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);
	
	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_idkdlab[] = $row_get['id_kdlab'];
		$array_urut[] = $row_get['urut'];
		$array_idrange[] = $row_get['id_range'];
		$array_idcase[] = $row_get['id_case'];
		$array_sex[] = $row_get['sex'];
		$array_age1[] = $row_get['age_1'];
		$array_age2[] = $row_get['age_2'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_nr1[] = $row_get['nr_1'];
		$array_nr2[] = $row_get['nr_2'];
		$array_status[] = $row_get['status'];
		$array_umursat[] = $row_get['umur_sat'];
		$array_idage[] = $row_get['id_age'];
		$array_ket[] = $row_get['ket'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['ID_KDBLAB'] = $array_idkdlab;
	$grand_array['URUT'] = $array_urut;
	$grand_array['ID_RANGE'] = $array_idrange;
	$grand_array['ID_CASE'] = $array_idcase;
	$grand_array['SEX'] = $array_sex;
	$grand_array['AGE_1'] = $array_age1;
	$grand_array['AGE_2'] = $array_age2;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['NR_1'] = $array_nr1;
	$grand_array['NR_2'] = $array_nr2;
	$grand_array['STATUS'] = $array_status;
	$grand_array['UMUR_SAT'] = $array_umursat;
	$grand_array['ID_AGE'] = $array_idage;
	$grand_array['KET'] = $array_ket;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;

}

function GetNilaiRujukanByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_n_rujukan where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_idkdlab[] = $row_get['id_kdlab'];
		$array_urut[] = $row_get['urut'];
		$array_idrange[] = $row_get['id_range'];
		$array_idcase[] = $row_get['id_case'];
		$array_sex[] = $row_get['sex'];
		$array_age1[] = $row_get['age_1'];
		$array_age2[] = $row_get['age_2'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_nr1[] = $row_get['nr_1'];
		$array_nr2[] = $row_get['nr_2'];
		$array_status[] = $row_get['status'];
		$array_umursat[] = $row_get['umur_sat'];
		$array_idage[] = $row_get['id_age'];
		$array_ket[] = $row_get['ket'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['ID_KDBLAB'] = $array_idkdlab;
	$grand_array['URUT'] = $array_urut;
	$grand_array['ID_RANGE'] = $array_idrange;
	$grand_array['ID_CASE'] = $array_idcase;
	$grand_array['SEX'] = $array_sex;
	$grand_array['AGE_1'] = $array_age1;
	$grand_array['AGE_2'] = $array_age2;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['NR_1'] = $array_nr1;
	$grand_array['NR_2'] = $array_nr2;
	$grand_array['STATUS'] = $array_status;
	$grand_array['UMUR_SAT'] = $array_umursat;
	$grand_array['ID_AGE'] = $array_idage;
	$grand_array['KET'] = $array_ket;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;

}

function GetAllNilaiRujukan(){
	global $db;
	
	$query_get = "select * from public.tab_n_rujukan";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_idkdlab[] = $row_get['id_kdlab'];
		$array_urut[] = $row_get['urut'];
		$array_idrange[] = $row_get['id_range'];
		$array_idcase[] = $row_get['id_case'];
		$array_sex[] = $row_get['sex'];
		$array_age1[] = $row_get['age_1'];
		$array_age2[] = $row_get['age_2'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_nr1[] = $row_get['nr_1'];
		$array_nr2[] = $row_get['nr_2'];
		$array_status[] = $row_get['status'];
		$array_umursat[] = $row_get['umur_sat'];
		$array_idage[] = $row_get['id_age'];
		$array_ket[] = $row_get['ket'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['ID_KDBLAB'] = $array_idkdlab;
	$grand_array['URUT'] = $array_urut;
	$grand_array['ID_RANGE'] = $array_idrange;
	$grand_array['ID_CASE'] = $array_idcase;
	$grand_array['SEX'] = $array_sex;
	$grand_array['AGE_1'] = $array_age1;
	$grand_array['AGE_2'] = $array_age2;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['NR_1'] = $array_nr1;
	$grand_array['NR_2'] = $array_nr2;
	$grand_array['STATUS'] = $array_status;
	$grand_array['UMUR_SAT'] = $array_umursat;
	$grand_array['ID_AGE'] = $array_idage;
	$grand_array['KET'] = $array_ket;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;
}

function EmptyNilaiRujukan(){
	global $db;
	
	$query_empty = 
	"
	truncate nilairujukan;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua nilairujukan point telah berhasil dihapus.";
	
	return $function_result;
}





?>