<?php

/*==========================================

/*==========================================*/

function GetTotalReportGenerated(){
	global $db;
	
	$query_get = "select count(id::int) as total_lab from public.tab_lab_master where id_pengentri = '".$_SESSION['OSH']['ID_COMPOSITE']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$total_row = $row_get['total_lab'];
	
	return $total_row;
}

function GetPendingReport(){
	global $db;
	
	$query_get = "select count(kd_acc::int) as total_pending_report from public.tab_lab_master where kd_acc = '0' and id_pengentri = '".$_SESSION['OSH']['ID_COMPOSITE']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$total_row = $row_get['total_pending_report'];
	
	return $total_row;
	
}

function GetCompletedReport(){
	global $db;
	
	$query_get = "select count(kd_acc::int) as total_pending_report from public.tab_lab_master where kd_acc = '1' and id_pengentri = '".$_SESSION['OSH']['ID_COMPOSITE']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$total_row = $row_get['total_pending_report'];
	
	return $total_row;
	
}

function GetAllNotifikasi(){
	global $db;
	
	$query_get = "select * from notification where ID_MASTER_RECEIVER = '".$_SESSION['OSH']['COMPOSITE_ID']."' order by created_at desc";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;
	
	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_idmastersender[] = $row_get['ID_MASTER_SENDER'];
		$array_idmasterreceiver[] = $row_get['ID_MASTER_RECEIVER'];
		$array_isread[] = $row_get['IS_READ'];
		$array_messagetext[] = $row_get['MESSAGE_TEXT'];
		$array_link[] = $row_get['LINK'];
		$array_createdat[] = $row_get['CREATED_AT'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['ID_MASTER_SENDER'] = $array_idmastersender;
	$grand_array['ID_MASTER_RECEIVER'] = $array_idmasterreceiver;
	$grand_array['IS_READ'] = $array_isread;
	$grand_array['MESSAGE_TEXT'] = $array_messagetext;
	$grand_array['LINK'] = $array_link;
	$grand_array['CREATED_AT'] = $array_createdat;
	
	return $grand_array;
	
}

function GetNotifikasiByID($input_parameter){
	global $db;
	
	$query_get = "select * from notification where ID = '".$input_parameter['ID']."'";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;
	
	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_idmastersender[] = $row_get['ID_MASTER_SENDER'];
		$array_idmasterreceiver[] = $row_get['ID_MASTER_RECEIVER'];
		$array_isread[] = $row_get['IS_READ'];
		$array_messagetext[] = $row_get['MESSAGE_TEXT'];
		$array_link[] = $row_get['LINK'];
		$array_createdat[] = $row_get['CREATED_AT'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['ID_MASTER_SENDER'] = $array_idmastersender;
	$grand_array['ID_MASTER_RECEIVER'] = $array_idmasterreceiver;
	$grand_array['IS_READ'] = $array_isread;
	$grand_array['MESSAGE_TEXT'] = $array_messagetext;
	$grand_array['LINK'] = $array_link;
	$grand_array['CREATED_AT'] = $array_createdat;
	
	return $grand_array;
	
}

function UpdateProfilePicture($input_parameter){
	global $db;
	
	$query_update = "update public.users set image = '".$input_parameter['FILENAME']."' where id = '".$_SESSION['OSH']['ID_COMPOSITE']."'";
	$result_update = pg_query($db, $query_update);
	
	$_SESSION['OSH']['IMAGE'] = $input_parameter['FILENAME'];
	
}

function UpdateProfileByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from public.users b
	where
		b.email = '".addslashes($input_parameter['EMAIL'])."'
		and b.rs_id = '99999'
		and b.id != '99999'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Email (".$input_parameter['EMAIL'].") telah digunakan. Silahkan mencoba kembali dengan email yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.users
		set
			name = '".addslashes($input_parameter['NAMA'])."',
			email = '".addslashes($input_parameter['EMAIL'])."',
			password = '".password_hash($input_parameter['PASSWORD'], PASSWORD_BCRYPT, [10])."'
		where
			id = '".$_SESSION['OSH']['ID_COMPOSITE']."'
		";
		$result_update = pg_query($db, $query_update);
		
		$_SESSION['OSH']['NAME'] = $input_parameter['NAMA'];
		$_SESSION['OSH']['EMAIL'] = $input_parameter['EMAIL'];

		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data user telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function TruncateProfilePicture($input_parameter){
	global $db;
	
	$query_getnamafile = "select image from public.users where id = '".$_SESSION['OSH']['ID_COMPOSITE']."'";
	$result_getnamafile = pg_query($db, $query_getnamafile);
	$row_getnamafile = pg_fetch_assoc($result_getnamafile);
	$nama_file = $row_getnamafile['image'];

	$query_update = "update public.users set image = null where id = '".$_SESSION['OSH']['ID_COMPOSITE']."'";
	$result_update = pg_query($db, $query_update);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Profile picture telah berhasil dihapus." ;
	
	unlink('../../media_library/profilepicture/'.$_SESSION['OSH']['ID_COMPOSITE'].'/'.$nama_file);
	$_SESSION['OSH']['IMAGE'] = '';
	
	return $function_result;
	
}

function ExecuteNotification($input_parameter){
	
	global $db;
	
	$query_update = "update notification set is_read = 1 where ID = '".$input_parameter['ID']."'";
	$result_update = $db->query($query_update);
	
}

?>