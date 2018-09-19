<?php

/*==========================================

/*==========================================*/

function AddSlider($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from public.sliders b
	where
		b.alt = '".addslashes($input_parameter['ALT'])."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Slider (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan slider yang lain.";
	} else {
	
		$timestamp = date('Y-m-d H:i:s');
	
		$query_getlastid = "select max(id) as id_terakhir from public.sliders";
		$result_getlastid = pg_query($db, $query_getlastid);
		$row_getlastid = pg_fetch_assoc($result_getlastid);
		$id_terakhir = $row_getlastid['id_terakhir'];
		$id_increment = $id_terakhir+1;
	
		$query_add = 
		"
		insert into sliders
		(
		id,
		alt,
		image,
		created_at
		)
		values
		(
		'".$id_increment."',
		'".addslashes($input_parameter['ALT'])."',
		'".$input_parameter['FILE']['name']."',
		'".$timestamp."'
		)
		";
		$result_add = pg_query($db, $query_add);

		$query_getid = "select * from sliders where created_at = '".$timestamp."'";
		$result_getid = pg_query($db, $query_getid);
		$row_getid = pg_fetch_assoc($result_getid);
		$new_id = $row_getid['id'];
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Slider telah berhasil ditambahkan." ;
		$function_result['NEW_ID'] = $new_id;
	}
	
	return $function_result;
}

function UpdateLogoSlider($input_parameter){
	global $db;
	
	$query_update = "update public.sliders set image = '".$input_parameter['FILENAME']."' where id = '".$input_parameter['ID']."'";
	$result_update = pg_query($db, $query_update);
	
}

function TruncateImageSlider($input_parameter){
	global $db;
	
	$query_getnamafile = "select image from public.sliders where id = '".$input_parameter['ID']."'";
	$result_getnamafile = pg_query($db, $query_getnamafile);
	$row_getnamafile = pg_fetch_assoc($result_getnamafile);
	$nama_file = $row_getnamafile['image'];

	$query_update = "update public.sliders set image = null where id = '".$input_parameter['ID']."'";
	$result_update = pg_query($db, $query_update);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Gambar Slider telah berhasil dihapus." ;
	
	unlink('../../../media_library/slider/'.$input_parameter['ID'].'/'.$nama_file);
	
	return $function_result;
	
}




function UpdateSliderByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from public.sliders b
	where
		b.alt = '".addslashes($input_parameter['ALT'])."'
		and b.id != '".$input_parameter['ID']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Slider (".$input_parameter['ALT'].") telah digunakan. Silahkan mencoba kembali dengan slider yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.sliders
		set
			alt = '".addslashes($input_parameter['ALT'])."'
		where
			id = '".$input_parameter['ID']."'
		";
		$result_update = pg_query($db, $query_update);

		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data slider telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}




function DeleteSliderByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.sliders
	where ID = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db,$query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data slider telah berhasil dihapus.";
	
	return $function_result;
}




function GetSliderByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.sliders where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_image[] = $row_get['image'];
		$array_alt[] = $row_get['alt'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['IMAGE'] = $array_image;
	$grand_array['ALT'] = $array_alt;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;

}




function GetAllSlider(){
	global $db;
	
	$query_get = "select * from public.sliders";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_image[] = $row_get['image'];
		$array_alt[] = $row_get['alt'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['IMAGE'] = $array_image;
	$grand_array['ALT'] = $array_alt;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;
}




function EmptySlider(){
	global $db;
	
	$query_empty = 
	"
	truncate slider;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Semua slider point telah berhasil dihapus.";
	
	return $function_result;
}





?>