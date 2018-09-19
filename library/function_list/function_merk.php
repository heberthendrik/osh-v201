<?php

/*==========================================

/*==========================================*/

function AddMerk($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_merk b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Merk (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan merk yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_merk
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
		$function_result['SYSTEM_MESSAGE'] = "Merk telah berhasil ditambahkan." ;

	}
	
	return $function_result;
}

function UpdateMerkByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_merk b
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
		$function_result['SYSTEM_MESSAGE'] = "Merk (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama merk yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_merk
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
		$function_result['SYSTEM_MESSAGE'] = "Data merk telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteMerkByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_merk
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data merk telah berhasil dihapus.";
	
	return $function_result;
}

function GetMerkByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_merk where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_status[] = $row_get['status'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	
	return $grand_array;

}

function GetAllMerk(){
	global $db;
	
	$query_get = "select * from public.tab_merk";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_status[] = $row_get['status'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	
	return $grand_array;
}

function EmptyMerk(){
	global $db;
	
	$query_empty = 
	"
	truncate merk;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua merk point telah berhasil dihapus.";
	
	return $function_result;
}





?>