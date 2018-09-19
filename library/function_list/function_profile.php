<?php

/*==========================================

/*==========================================*/

function GetTotalReportGenerated(){
	global $db;
	
	$query_get = "select count(id::int) as total_lab from public.tab_lab_master where id_pengentri = '".$_SESSION['OSH']['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$row_get = pg_fetch_assoc($result_get);
	$total_row = $row_get['total_lab'];
	
	return $total_row;
}

function GetPendingReport(){
	global $db;
	
	$query_get = "select count(kd_acc::int) as total_pending_report from public.tab_lab_master where kd_acc = '0' and id_pengentri = '".$_SESSION['OSH']['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$row_get = pg_fetch_assoc($result_get);
	$total_row = $row_get['total_pending_report'];
	
	return $total_row;
	
}

function GetCompletedReport(){
	global $db;
	
	$query_get = "select count(kd_acc::int) as total_pending_report from public.tab_lab_master where kd_acc = '1' and id_pengentri = '".$_SESSION['OSH']['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$row_get = pg_fetch_assoc($result_get);
	$total_row = $row_get['total_pending_report'];
	
	return $total_row;
	
}

function GetAllNotifikasi(){
	global $db;
	
	$query_get = "select * from public.tab_notifikasi where receiver = '".$_SESSION['OSH']['ID']."' order by created_at desc";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);
	
	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_sender[] = $row_get['sender'];
		$array_receiver[] = $row_get['receiver'];
		$array_sendername[] = $row_get['sender_name'];
		$array_receivername[] = $row_get['receiver_name'];
		$array_link[] = $row_get['link'];
		$array_read[] = $row_get['read'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_text[] = $row_get['text'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['SENDER'] = $array_sender;
	$grand_array['RECEIVER'] = $array_receiver;
	$grand_array['SENDER_NAME'] = $array_sendername;
	$grand_array['RECEIVER_NAME'] = $array_receivername;
	$grand_array['LINK'] = $array_link;
	$grand_array['READ'] = $array_read;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['TEXT'] = $array_text;
	
	return $grand_array;
	
}

function UpdateProfilePicture($input_parameter){
	global $db;
	
	$query_update = "update public.users set image = '".$input_parameter['FILENAME']."' where id = '".$_SESSION['OSH']['ID']."'";
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
			id = '".$_SESSION['OSH']['ID']."'
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
	
	$query_getnamafile = "select image from public.users where id = '".$_SESSION['OSH']['ID']."'";
	$result_getnamafile = pg_query($db, $query_getnamafile);
	$row_getnamafile = pg_fetch_assoc($result_getnamafile);
	$nama_file = $row_getnamafile['image'];

	$query_update = "update public.users set image = null where id = '".$_SESSION['OSH']['ID']."'";
	$result_update = pg_query($db, $query_update);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Profile picture telah berhasil dihapus." ;
	
	unlink('../../media_library/profilepicture/'.$_SESSION['OSH']['ID'].'/'.$nama_file);
	$_SESSION['OSH']['IMAGE'] = '';
	
	return $function_result;
	
}

?>