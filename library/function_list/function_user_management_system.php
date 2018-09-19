<?php


/*==========================================

USER MANAGEMENT

1. GetAllUser()
2. AddNewUser($input_parameter)
3. UpdateUserByID($input_parameter)
4. ChangeUserPasswordByID($input_parameter)
5. GetUserByID($input_parameter)
6. DeleteUserByID($input_parameter)
7. EmptyUser()

USER ACCESS MANAGEMENT
1. GetAllAdminMenuSidebar()
2. GetAllAdminSubmenuSidebar($admin_submenu_metadata)
3. GetAdminMenuSidebarByID($admin_menu_metadata)
4. GetAdminSubmenuSidebarByID($admin_submenu_metadata)

/*==========================================

/*
*
*
* USER MANAGER
*
*
*/

function GetAllUser(){
	global $db;
	
	$query_get = 
	"
	select
		mu.ID as ID,
		mu.FIRSTNAME as FIRSTNAME,
		mu.LASTNAME as LASTNAME,
		mu.EMAIL as EMAIL,
		mu.PASSWORD as PASSWORD,
		mu.MENU_UAC as MENU_UAC,
		mu.SUBMENU_UAC as SUBMENU_UAC,
		mu.IS_ACTIVE as IS_ACTIVE,
		mu.DATE_CREATED as DATE_CREATED,
		mu.DATE_MODIFIED as DATE_MODIFIED
	from user mu
	";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;
	
	for( $i=0;$i<$num_get;$i++ ){
		$row_get = $result_get->fetch_assoc();
		$array_id[] = $row_get['ID'];
		$array_firstname[] = $row_get['FIRSTNAME'];
		$array_lastname[] = $row_get['LASTNAME'];
		$array_email[] = $row_get['EMAIL'];
		$array_password[] = $row_get['PASSWORD'];
		$array_menuuac[] = $row_get['MENU_UAC'];
		$array_submenuuac[] = $row_get['SUBMENU_UAC'];
		$array_isactive[] = $row_get['IS_ACTIVE'];
		$array_datecreated[] = $row_get['DATE_CREATED'];
		$array_datemodified[] = $row_get['DATE_MODIFIED'];
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['FIRSTNAME'] = $array_firstname;
	$grand_array['LASTNAME'] = $array_lastname;
	$grand_array['EMAIL'] = $array_email;
	$grand_array['PASSWORD'] = $array_password;
	$grand_array['MENU_UAC'] = $array_menuuac;
	$grand_array['SUBMENU_UAC'] = $array_submenuuac;
	$grand_array['IS_ACTIVE'] = $array_isactive;
	$grand_array['DATE_CREATED'] = $array_datecreated;
	$grand_array['DATE_MODIFIED'] = $array_datemodified;
	
	return $grand_array;
	
}

function AddNewUser($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(mu.ID) as total_row
	from user mu
	where
		mu.EMAIL = '".addslashes($input_parameter['EMAIL'])."'
	";
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['RESULT'] = 0;
		$function_result['MESSAGE'] = "Email Anda sudah terdaftar sebelumnya.";
	} 
	else if( $total_row == 0 ){
		
		if( $input_parameter['PASSWORD'] != $input_parameter['CONFIRM_PASSWORD'] ){
			$function_result['RESULT'] = 0;
			$function_result['MESSAGE'] = "Kata sandi tidak cocok. Silahkan mencoba kembali.";
		} else if( $input_parameter['PASSWORD'] == $input_parameter['CONFIRM_PASSWORD'] ){
			$query_add = 
			"
			insert into
				user
			(
			FIRSTNAME,
			LASTNAME,
			EMAIL,
			PASSWORD,
			MENU_UAC,
			SUBMENU_UAC,
			IS_ACTIVE,
			DATE_CREATED
			)
			values
			(
			'".addslashes($input_parameter['FIRSTNAME'])."',
			'".addslashes($input_parameter['LASTNAME'])."',
			'".addslashes($input_parameter['EMAIL'])."',
			'".md5(addslashes($input_parameter['PASSWORD']))."',
			'".addslashes($input_parameter['MENU_UAC'])."',
			'".addslashes($input_parameter['SUBMENU_UAC'])."',
			'".addslashes($input_parameter['IS_ACTIVE'])."',
			'".date('Y-m-d H:i:s')."'
			)
			";
			$result_add = $db->query($query_add);
		
			$function_result['RESULT'] = 1;
			$function_result['MESSAGE'] = "User telah berhasil didaftarkan pada sistem.";	
			$function_result['NEW_ID'] = $db->insert_id;
		}
		
	}
	
	return $function_result;
}

function UpdateUserByID($input_parameter){
	
	global $db;
	
	$query_check = 
	"
	select
		count(mu.ID) as total_row
	from user mu
	where
		mu.EMAIL = '".addslashes($input_parameter['EMAIL'])."'
		and mu.ID != '".$input_parameter['ID']."'
	";
	$result_check = $db->query($query_check);
	$row_check = $result_check->fetch_assoc();
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['RESULT'] = 0;
		$function_result['MESSAGE'] = "Email Anda sudah terdaftar sebelumnya.";
	}
	else if( $total_row == 0 ){
	
		$query_update = 
		"
		update
			user
		set
			FIRSTNAME = '".addslashes($input_parameter['FIRSTNAME'])."',
			LASTNAME = '".addslashes($input_parameter['LASTNAME'])."',
			EMAIL = '".addslashes($input_parameter['EMAIL'])."',
			
			MENU_UAC = '".$input_parameter['MENU_UAC']."',
			SUBMENU_UAC = '".$input_parameter['SUBMENU_UAC']."',
			
			IS_ACTIVE = '".$input_parameter['IS_ACTIVE']."',
			
			DATE_MODIFIED = '".date('Y-m-d H:i:s')."'
		where
			ID = '".$input_parameter['ID']."'
		";
		$result_update = $db->query($query_update);
		
		$function_result['RESULT'] = 1;
		$function_result['MESSAGE'] = "Informasi akun Anda telah berhasil diperbaharui.";
	}
	
	return $function_result;

}

function ChangeUserPasswordByID($input_parameter){
	
	global $db;
	
	$function_GetUserByID = GetUserByID($input_parameter);
	
	if( md5($input_parameter['CURRENT_PASSWORD']) != $function_GetUserByID['PASSWORD'] ){
		
		$function_result['RESULT'] = 0;
		$function_result['MESSAGE'] = "Kata sandi Anda saat ini tidak benar. Silahkan mencoba kembali.";
		
	} else if( md5($input_parameter['CURRENT_PASSWORD']) == $function_GetUserByID['PASSWORD'] ){
	
		if( $input_parameter['NEW_PASSWORD'] != $input_parameter['NEW_PASSWORD_CONFIRMATION'] ){
		
			$function_result['RESULT'] = 0;
			$function_result['MESSAGE'] = "Kata sandi baru Anda tidak cocok. Silahkan mencoba kembali.";
			
		} else if( $input_parameter['NEW_PASSWORD'] == $input_parameter['NEW_PASSWORD_CONFIRMATION'] ){
			$query_update = 
			"
			update 
				user
			set
				PASSWORD = '".md5($input_parameter['NEW_PASSWORD'])."'
			where
				ID = '".$input_parameter['ID']."'
			";
			$result_update = $db->query($query_update);
			
			$function_result['RESULT'] = 1;
			$function_result['MESSAGE'] = "Kata sandi Anda telah berhasil diperbaharui.";	
		
			$log_parameter['MODULE'] = 'change password';
			$log_parameter['MESSAGE'] = '[USER ID: '.$_SESSION['JPU_WIFIID']['USER_ID'].'] change password to '.md5($input_parameter['NEW_PASSWORD']);
			AddLog($log_parameter);
			
		}
	
	}
	
	return $function_result;
	
}

function ForceChangeUserPasswordByID($input_parameter){
	
	global $db;
	
	$function_GetUserByID = GetUserByID($input_parameter);
	
	if( $input_parameter['NEW_PASSWORD'] != $input_parameter['NEW_PASSWORD_CONFIRMATION'] ){
	
		$function_result['RESULT'] = 0;
		$function_result['MESSAGE'] = "Kata sandi baru Anda tidak cocok. Silahkan mencoba kembali.";
		
	} else if( $input_parameter['NEW_PASSWORD'] == $input_parameter['NEW_PASSWORD_CONFIRMATION'] ){
		$query_update = 
		"
		update 
			user
		set
			PASSWORD = '".md5($input_parameter['NEW_PASSWORD'])."'
		where
			ID = '".$input_parameter['ID']."'
		";
		$result_update = $db->query($query_update);
		
		$function_result['RESULT'] = 1;
		$function_result['MESSAGE'] = "Kata sandi Anda telah berhasil diperbaharui.";	
		
		$log_parameter['MODULE'] = 'change password (force)';
		$log_parameter['MESSAGE'] = '[USER ID: '.$input_parameter['ID'].'] change password to '.md5($input_parameter['NEW_PASSWORD']);
		AddLog($log_parameter);
	}

	return $function_result;
	
}

function GetUserByID($input_parameter){
	
	global $db;
	
	$query_get = 
	"
	select
		mu.ID as ID,
		mu.FIRSTNAME as FIRSTNAME,
		mu.LASTNAME as LASTNAME,
		mu.EMAIL as EMAIL,
		mu.PASSWORD as PASSWORD,
		mu.MENU_UAC as MENU_UAC,
		mu.SUBMENU_UAC as SUBMENU_UAC,
		mu.IS_ACTIVE as IS_ACTIVE,
		mu.DATE_CREATED as DATE_CREATED,
		mu.DATE_MODIFIED as DATE_MODIFIED
	from user mu
	where
		mu.ID = '".$input_parameter['ID']."'
	";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$grand_array['ID'] = $row_get['ID'];
	$grand_array['FIRSTNAME']= $row_get['FIRSTNAME'];
	$grand_array['LASTNAME'] = $row_get['LASTNAME'];
	$grand_array['EMAIL'] = $row_get['EMAIL'];
	$grand_array['PASSWORD'] = $row_get['PASSWORD'];
	$grand_array['MENU_UAC'] = $row_get['MENU_UAC'];
	$grand_array['SUBMENU_UAC'] = $row_get['SUBMENU_UAC'];
	$grand_array['IS_ACTIVE'] = $row_get['IS_ACTIVE'];
	$grand_array['DATE_CREATED'] = $row_get['DATE_CREATED'];
	$grand_array['DATE_MODIFIED'] = $row_get['DATE_MODIFIED'];
	
	return $grand_array;
}

function DeleteUserByID($input_parameter){
	
	global $db;
	
	$query_delete = 
	"
	delete from master_user
	where ID = '".$input_parameter['ID']."'
	";
	$result_delete = $db->query($query_delete);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Data user telah berhasil dihapus.";
	
	return $function_result;

}

function EmptyUser(){
	
	global $db;
	
	$query_empty = 
	"
	truncate master_user
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Data user telah berhasil dikosongkan.";
	
	return $function_result;
	
}















/*
*
*
* USER ACCESS MANAGEMENT
*
*
*/

function GetAllAdminMenuSidebar(){
	global $db;
	
	$query_get = 
	"
	select 
		mm.ID as ID,
		mm.CUSTOM_CLASS as CUSTOM_CLASS,
		mm.NAME as NAME,
		mm.MODULE as MODULE,
		mm.DESTINATION_LINK as DESTINATION_LINK,
		mm.IS_ACTIVE as IS_ACTIVE,
		mm.FOR_AGENT as FOR_AGENT
	from menu_mdb mm
	order by mm.ORDER_NUMBER ASC
	";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;
	
	for( $i=0;$i<$num_get;$i++ ){
		$row_get = $result_get->fetch_assoc();
		$array_id[] = $row_get['ID'];
		$array_customclass[] = $row_get['CUSTOM_CLASS'];
		$array_name[] = $row_get['NAME'];
		$array_module[] = $row_get['MODULE'];
		$array_destinationlink[] = $row_get['DESTINATION_LINK'];
		$array_isactive[] = $row_get['IS_ACTIVE'];
		$array_foragent[] = $row_get['FOR_AGENT'];
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['CUSTOM_CLASS'] = $array_customclass;
	$grand_array['NAME'] = $array_name;
	$grand_array['MODULE'] = $array_module;
	$grand_array['DESTINATION_LINK'] = $array_destinationlink;
	$grand_array['IS_ACTIVE'] = $array_isactive;
	$grand_array['FOR_AGENT'] = $array_foragent;
	
	return $grand_array;
}

function GetAllAdminSubmenuSidebar($admin_submenu_metadata){
	global $db;
	
	$query_get = 
	"
	select 
		sm.ID as ID,
		sm.PARENT_MENU_ID as PARENT_MENU_ID,
		sm.NAME as NAME,
		sm.MODULE as MODULE,
		sm.DESTINATION_LINK as DESTINATION_LINK,
		sm.IS_ACTIVE as IS_ACTIVE,
		sm.IS_VISIBLE as IS_VISIBLE
	from submenu_mdb sm	
	where
		sm.PARENT_MENU_ID = '".$admin_submenu_metadata['PARENT_MENU_ID']."'
	";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;
	
	for( $i=0;$i<$num_get;$i++ ){
		$row_get = $result_get->fetch_assoc();
		$array_id[] = $row_get['ID'];
		$array_parentmenuid[] = $row_get['PARENT_MENU_ID'];
		$array_name[] = $row_get['NAME'];
		$array_module[] = $row_get['MODULE'];
		$array_destinationlink[] = $row_get['DESTINATION_LINK'];
		$array_isactive[] = $row_get['IS_ACTIVE'];
		$array_isvisible[] = $row_get['IS_VISIBLE'];
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['PARENT_MENU_ID'] = $array_parentmenuid;
	$grand_array['NAME'] = $array_name;
	$grand_array['MODULE'] = $array_module;
	$grand_array['DESTINATION_LINK'] = $array_destinationlink;
	$grand_array['IS_ACTIVE'] = $array_isactive;
	$grand_array['IS_VISIBLE'] = $array_isvisible;
	
	return $grand_array;
	
}

function GetAdminMenuSidebarByID($admin_menu_metadata){
	global $db;
	
	$query_get = 
	"
	select 
		mm.ID as ID,
		mm.CUSTOM_CLASS as CUSTOM_CLASS,
		mm.NAME as NAME,
		mm.DESTINATION_LINK as DESTINATION_LINK,
		mm.IS_ACTIVE as IS_ACTIVE,
		mm.FOR_AGENT as FOR_AGENT
	from menu_mdb mm
	where
		mm.ID = '".$admin_menu_metadata['ID']."'
	";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	
	$grand_array['ID'] = $row_get['ID'];
	$grand_array['CUSTOM_CLASS'] = $row_get['CUSTOM_CLASS'];
	$grand_array['NAME'] = $row_get['NAME'];
	$grand_array['DESTINATION_LINK'] = $row_get['DESTINATION_LINK'];
	$grand_array['IS_ACTIVE'] = $row_get['IS_ACTIVE'];
	$grand_array['FOR_AGENT'] = $row_get['FOR_AGENT'];
	
	return $grand_array;
}

function GetAdminSubmenuSidebarByID($admin_submenu_metadata){
	global $db;
	
	$query_get = 
	"
	select 
		sm.ID as ID,
		sm.PARENT_MENU_ID as PARENT_MENU_ID,
		sm.NAME as NAME,
		sm.MODULE as MODULE,
		sm.DESTINATION_LINK as DESTINATION_LINK,
		sm.IS_ACTIVE as IS_ACTIVE
	from submenu_mdb sm	
	where
		sm.PARENT_MENU_ID = '".$admin_submenu_metadata['PARENT_MENU_ID']."'
		and sm.ID = '".$admin_submenu_metadata['ID']."'
	";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	
	$grand_array['ID'] = $row_get['ID'];
	$grand_array['PARENT_MENU_ID'] = $row_get['PARENT_MENU_ID'];
	$grand_array['MODULE'] = $row_get['MODULE'];
	$grand_array['NAME'] = $row_get['NAME'];
	$grand_array['DESTINATION_LINK'] = $row_get['DESTINATION_LINK'];
	$grand_array['IS_ACTIVE'] = $row_get['IS_ACTIVE'];
	
	return $grand_array;
	
}

















function IsAllowToManageHargaBeli(){

	$current_user_metadata['ID'] = $_SESSION['HIFEST_CREDENTIAL']['USER_ID'];
	$function_helper_GetUACByUserID = GetUserByID($current_user_metadata);
	
	$array_submenu_uac = $function_helper_GetUACByUserID['SUBMENU_UAC'];
	$array_explode_submenu_uac = explode(',', $array_submenu_uac);
	
	if (in_array("54", $array_explode_submenu_uac)) {
		$array_result['BOOLEAN'] = 1;
		$array_result['STYLE'] = "";
	} else {
		$array_result['BOOLEAN'] = 0;
		$array_result['STYLE'] = " display:none; ";
	}
	
	return $array_result;
	exit;
	
}

?>