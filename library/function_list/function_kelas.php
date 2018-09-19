<?php

/*==========================================

/*==========================================*/

function AddKelas($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from master_kelas b
	where
		b.NAME = '".addslashes($input_parameter['NAMA'])."'
		and b.ID_RS = '".$input_parameter['ID_RS']."'
	";
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Kelas (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan kelas yang lain.";
	} else {
	
		$query_add = 
		"
		insert into master_kelas
		(
		NAME,
		STATUS,
		ID_RS,
		CREATED_AT,
		CREATED_BY
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".$input_parameter['STATUS']."',
		'".$input_parameter['ID_RS']."',
		'".date('Y-m-d H:i:s')."',
		'".$_SESSION['OSH']['COMPOSITE_ID']."'
		)
		";
		
		$result_add = $db->query($query_add);
		$new_id = $db->insert_id;
		
		if( $result_add ){
			$function_result['FUNCTION_RESULT'] = 1;
			$function_result['SYSTEM_MESSAGE'] = "Kelas telah berhasil ditambahkan." ;
			$function_result['NEW_ID'] = $new_id;	
		} else {
			$function_result['FUNCTION_RESULT'] = 0;
			$function_result['SYSTEM_MESSAGE'] = "Penambahan data gagal karena masalah teknis. Silahkan hubungi administrator." ;
		}
		
	}
	
	return $function_result;
}

function UpdateKelasByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from master_kelas b
	where
		b.NAME = '".addslashes($input_parameter['NAMA'])."'
		and b.ID_RS = '".$input_parameter['ID_RS']."'
		and b.ID != '".$input_parameter['ID']."'
	";
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Kelas (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama kelas yang lain.";
	} else {
	
		$query_update = 
		"
		update
			master_kelas
		set
			NAME = '".addslashes($input_parameter['NAMA'])."'
			,STATUS = '".$input_parameter['STATUS']."'
			,ID_RS = '".$input_parameter['ID_RS']."'
			,UPDATED_AT = '".date('Y-m-d H:i:s')."'
			,UPDATED_BY = '".$_SESSION['OSH']['COMPOSITE_ID']."'
		where
			id = '".$input_parameter['ID']."'
		";

		//echo $query_update;exit;
		$result_update = $db->query($query_update);
	
		if( $result_update ){
			$function_result['FUNCTION_RESULT'] = 1;
			$function_result['SYSTEM_MESSAGE'] = "Data kelas telah berhasil diperbaharui." ;	
		} else {
			$function_result['FUNCTION_RESULT'] = 0;
			$function_result['SYSTEM_MESSAGE'] = "Perubahan data gagal karena masalah teknis. Silahkan hubungi administrator." ;
		}
	
		
	}
	
	return $function_result;
}

function DeleteKelasByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from master_kelas
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = $db->query($query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data kelas telah berhasil dihapus.";
	
	return $function_result;
}

function GetKelasByID($input_parameter){
	global $db;
	
	$query_get = "select * from master_kelas where id = '".$input_parameter['ID']."' ";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_status[] = $row_get['STATUS'];
		$array_idrs[] = $row_get['ID_RS'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_udpatedby[] = $row_get['UPDATED_BY'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	
	return $grand_array;

}

function GetAllKelas(){
	global $db;
	
	if( $_SESSION['OSH']['ID_ROLE'] == 1 ){
		$query_get = "select * from master_kelas";
	} else {
		$query_get = "select * from master_kelas where ID_RS = '".$_SESSION['OSH']['ID_RS']."' ";
	}
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_status[] = $row_get['STATUS'];
		$array_idrs[] = $row_get['ID_RS'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_udpatedby[] = $row_get['UPDATED_BY'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	
	return $grand_array;
}

function EmptyKelas(){
	global $db;
	
	$query_empty = 
	"
	truncate kelas;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua kelas point telah berhasil dihapus.";
	
	return $function_result;
}





?>