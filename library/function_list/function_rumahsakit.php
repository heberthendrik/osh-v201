<?php

/*==========================================

/*==========================================*/

function AddRumahSakit($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from master_hospital b
	where
		b.NAME = '".addslashes($input_parameter['NAMA'])."'
	";
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Rumah Sakit (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan rumah sakit yang lain.";
	} else {
	
		$query_add = 
		"
		insert into master_hospital
		(
		NAME,
		LINK,
		ADDRESS,
		IS_ACTIVE,
		CREATED_AT,
		CREATED_BY
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".addslashes($input_parameter['LINK'])."',
		'".addslashes($input_parameter['ADDRESS'])."',
		'".$input_parameter['IS_ACTIVE']."',
		'".date('Y-m-d H:i:s')."',
		'".$_SESSION['OSH']['COMPOSITE_ID']."'
		)
		";
		$result_add = $db->query($query_add);
		
		//echo $query_add;exit;
		
		if( $result_add ){
			$function_result['FUNCTION_RESULT'] = 1;
			$function_result['SYSTEM_MESSAGE'] = "Rumah Sakit telah berhasil ditambahkan." ;	
			$function_result['NEW_ID'] = $db->insert_id;
		} else {
			$function_result['FUNCTION_RESULT'] = 0;
			$function_result['SYSTEM_MESSAGE'] = "Penambahan data gagal karena kesalahan teknis. Silahkan hubungi administrator." ;	
		}
		
	} 
	
	return $function_result;
}

function UpdateLogoRumahSakit($input_parameter){
	global $db;
	
	$query_update = "update master_hospital set logo = '".$input_parameter['FILENAME']."' where id = '".$input_parameter['ID']."'";
	$result_update = $db->query($query_update);
	
}

function TruncateLogoRumahSakit($input_parameter){
	global $db;
	
	$query_getnamafile = "select logo from master_hospital where id = '".$input_parameter['ID']."'";
	$result_getnamafile = $db->query($query_getnamafile);
	$row_getnamafile = $result_getnamafile->fetch_assoc();
	$nama_file = $row_getnamafile['logo'];

	$query_update = "update master_hospital set logo = null where id = '".$input_parameter['ID']."'";
	$result_update = $db->query($query_update);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Logo Rumah Sakit telah berhasil dihapus." ;
	
	unlink('../../../media_library/logors/'.$input_parameter['ID'].'/'.$nama_file);
	
	return $function_result;
	
}




function UpdateRumahSakitByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from master_hospital b
	where
		b.NAME = '".addslashes($input_parameter['NAMA'])."'
		and b.ID != '".$input_parameter['ID']."'
	";
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Rumah Sakit (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan rumah sakit yang lain.";
	} else {
	
		$query_update = 
		"
		update
			master_hospital
		set
			NAME = '".addslashes($input_parameter['NAMA'])."',
			LINK = '".addslashes($input_parameter['LINK'])."',
			ADDRESS = '".addslashes($input_parameter['ADDRESS'])."',
			UPDATED_AT = '".date('Y-m-d H:i:s')."',
			UPDATED_BY = '".$_SESSION['OSH']['COMPOSITE_ID']."'
		where
			id = '".$input_parameter['ID']."'
		";
		$result_update = $db->query($query_update);

		if( $result_update ){
			$function_result['FUNCTION_RESULT'] = 1;
			$function_result['SYSTEM_MESSAGE'] = "Data rumah sakit telah berhasil diperbaharui." ;
		} else {
			$function_result['FUNCTION_RESULT'] = 0;
			$function_result['SYSTEM_MESSAGE'] = "Perubahan data gagal karena kesalahan teknis. Silahkan hubungi administrator." ;	
		}
		
		
	}
	
	return $function_result;
}




function DeleteRumahSakitByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from master_hospital
	where ID = '".$input_parameter['ID']."'
	";
	$result_delete = $db->query($query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data rumahsakit telah berhasil dihapus.";
	
	return $function_result;
}




function GetRumahSakitByID($input_parameter){
	global $db;
	
	$query_get = "select * from master_hospital where id = '".$input_parameter['ID']."' ";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_logo[] = $row_get['LOGO'];
		$array_link[] = $row_get['LINK'];
		$array_address[] = $row_get['ADDRESS'];
		$array_isactive[] = $row_get['IS_ACTIVE'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_updatedby[] = $row_get['UDPATED_BY'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['LOGO'] = $array_logo;
	$grand_array['ADDRESS'] = $array_address;
	$grand_array['IS_ACTIVE'] = $array_isactive;
	$grand_array['LINK'] = $array_link;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_udpatedby;
	
	return $grand_array;

}




function GetAllRumahSakit(){
	global $db;
	
	$query_get = "select * from master_hospital";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_logo[] = $row_get['LOGO'];
		$array_link[] = $row_get['LINK'];
		$array_address[] = $row_get['ADDRESS'];
		$array_isactive[] = $row_get['IS_ACTIVE'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_updatedby[] = $row_get['UDPATED_BY'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['LOGO'] = $array_logo;
	$grand_array['ADDRESS'] = $array_address;
	$grand_array['IS_ACTIVE'] = $array_isactive;
	$grand_array['LINK'] = $array_link;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_udpatedby;
	
	return $grand_array;
}




function EmptyRumahSakit(){
	global $db;
	
	$query_empty = 
	"
	truncate rumahsakit;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Semua rumahsakit point telah berhasil dihapus.";
	
	return $function_result;
}





?>