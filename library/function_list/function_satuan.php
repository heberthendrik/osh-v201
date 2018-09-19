<?php

/*==========================================

/*==========================================*/

function AddSatuan($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_satuan b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Satuan (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan satuan yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_satuan
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
		$function_result['SYSTEM_MESSAGE'] = "Satuan telah berhasil ditambahkan." ;

	}
	
	return $function_result;
}

function UpdateSatuanByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_satuan b
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
		$function_result['SYSTEM_MESSAGE'] = "Satuan (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama satuan yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_satuan
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
		$function_result['SYSTEM_MESSAGE'] = "Data satuan telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteSatuanByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_satuan
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data satuan telah berhasil dihapus.";
	
	return $function_result;
}

function GetSatuanByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_satuan where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nm_satuan']);
		$array_status[] = $row_get['status'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	
	return $grand_array;

}

function GetAllSatuan(){
	global $db;
	
	$query_get = "select * from public.tab_satuan";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nm_satuan']);
		$array_status[] = $row_get['status'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	
	return $grand_array;
}

function EmptySatuan(){
	global $db;
	
	$query_empty = 
	"
	truncate satuan;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua satuan point telah berhasil dihapus.";
	
	return $function_result;
}





?>