<?php

/*==========================================

/*==========================================*/

function GetTotalReportGenerated(){
	global $db;
	
	$query_get = "select count(ID) as total_lab from lab_main where overall_status > 0 and created_by = '".$_SESSION['OSH']['COMPOSITE_ID']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$total_row = $row_get['total_lab'];
	
	return $total_row;
}

function GetPendingReport(){
	global $db;
	
	$query_get = "select count(ID) as total_pending_report from lab_main where overall_status = 1 and created_by = '".$_SESSION['OSH']['COMPOSITE_ID']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$total_row = $row_get['total_pending_report'];
	
	return $total_row;
	
}

function GetCompletedReport(){
	global $db;
	
	$query_get = "select count(ID) as total_completed_report from lab_main where overall_status > 1 and created_by = '".$_SESSION['OSH']['COMPOSITE_ID']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$total_row = $row_get['total_completed_report'];
	
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
	
	$query_get_userid = "select * from master_user_composite where ID = '".$_SESSION['OSH']['COMPOSITE_ID']."'";
	$result_get_userid = $db->query($query_get_userid);
	$row_get_userid = $result_get_userid->fetch_assoc();
	$fk_userid = $row_get_userid['ID_USER'];
	
	$query_update = "update master_user set PROFILE_PICTURE = '".$input_parameter['FILENAME']."' where id = '".$fk_userid."'";
	$result_update = $db->query($query_update);
	
	$_SESSION['OSH']['PROFILE_PICTURE'] = $input_parameter['FILENAME'];
	
}

function UpdateProfileByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from master_user b
	where
		b.email = '".addslashes($input_parameter['EMAIL'])."'
		and b.id is null
	";
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Email (".$input_parameter['EMAIL'].") telah digunakan. Silahkan mencoba kembali dengan email yang lain.";
	} else {
	
		$query_get_userid = "select * from master_user_composite where ID = '".$_SESSION['OSH']['COMPOSITE_ID']."'";
		$result_get_userid = $db->query($query_get_userid);
		$row_get_userid = $result_get_userid->fetch_assoc();
		$fk_userid = $row_get_userid['ID_USER'];
		
		$query_update = 
		"
		update 
			master_user 
		set 
			EMAIL = '".addslashes($input_parameter['EMAIL'])."',
			NAME = '".addslashes($input_parameter['NAMA'])."',
			PASSWORD = '".password_hash($input_parameter['PASSWORD'], PASSWORD_BCRYPT, [10])."'
		where
			ID = '".$fk_userid."'
		";
/* 		echo $query_update;exit; */
		$result_update = $db->query($query_update);
		
		$_SESSION['OSH']['NAME'] = $input_parameter['NAMA'];
		$_SESSION['OSH']['EMAIL'] = $input_parameter['EMAIL'];

		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data user telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function TruncateProfilePicture($input_parameter){
	global $db;
	
	$query_get_userid = "select * from master_user_composite where ID = '".$_SESSION['OSH']['COMPOSITE_ID']."'";
	$result_get_userid = $db->query($query_get_userid);
	$row_get_userid = $result_get_userid->fetch_assoc();
	$fk_userid = $row_get_userid['ID_USER'];
	
	$query_getnamafile = "select profile_picture from master_user where id = '".$fk_userid."'";
	$result_getnamafile = $db->query($query_getnamafile);
	$row_getnamafile = $result_getnamafile->fetch_assoc();
	$nama_file = $row_getnamafile['image'];

	$query_update = "update master_user set profile_picture = null where id = '".$_SESSION['OSH']['COMPOSITE_ID']."'";
	$result_update = $db->query($query_update);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Profile picture telah berhasil dihapus." ;
	
	unlink('../../media_library/profilepicture/'.$_SESSION['OSH']['COMPOSITE_ID'].'/'.$nama_file);
	$_SESSION['OSH']['PROFILE_PICTURE'] = '';
	
	return $function_result;
	
}

function ExecuteNotification($input_parameter){
	
	global $db;
	
	$query_update = "update notification set is_read = 1 where ID = '".$input_parameter['ID']."'";
	$result_update = $db->query($query_update);
	
}

?>