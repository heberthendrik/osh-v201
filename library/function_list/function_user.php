<?php

/*==========================================

/*==========================================*/

function AddUser($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.users b
	where
		b.email = '".addslashes($input_parameter['EMAIL'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Email (".$input_parameter['EMAIL'].") telah digunakan. Silahkan mencoba kembali dengan email yang lain.";
	} else {
	
		$value = $input_parameter['PASSWORD'];
/* 		$passwordlaravel = $validpassword; */
/* 		$password = password_hash($value, PASSWORD_BCRYPT, [10]); */
/* 		$result = password_verify($value, $passwordlaravel); */
		$finalpassword = password_hash($value, PASSWORD_BCRYPT, [10]);
	
		$current_timestamp = date('Y-m-d H:i:s');
		$query_getlastid = "select max(id) as id_terakhir from public.users";
		$result_getlastid = pg_query($db, $query_getlastid);
		$row_getlastid = pg_fetch_assoc($result_getlastid);
		$lastid = $row_getlastid['id_terakhir'];
		$new_id = $lastid+1;
	
		$query_add = 
		"
		insert into public.users
		(
		id,
		name,
		email,
		password,
		roles,
		id_rs,
		created_at
		)
		values
		(
		'".$new_id."',
		'".addslashes($input_parameter['NAMA'])."',
		'".addslashes($input_parameter['EMAIL'])."',
		'".$finalpassword."',
		'".addslashes($input_parameter['ROLE'])."',
		'".$input_parameter['ID_RS']."',
		'".$current_timestamp."'
		)
		";
		
		$result_add = pg_query($db, $query_add);
		$row_add = pg_fetch_row($result_add);
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "User telah berhasil ditambahkan." ;
		
		$query_getnewid = "select * from public.users where created_at = '".$current_timestamp."'";
		$result_getnewid = pg_query($db, $query_getnewid);
		$row_getnewid = pg_fetch_assoc($result_getnewid);
		$new_id = $row_getnewid['id'];
		$function_result['NEW_ID'] = $new_id;

	}
	
	return $function_result;
}

function UpdateUserByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.users b
	where
		b.email = '".addslashes($input_parameter['EMAIL'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
		and b.id != '".$input_parameter['ID']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Email (".$input_parameter['EMAIL'].") telah digunakan. Silahkan mencoba kembali dengan email yang lain.";
	} else {
	
		$finalpassword = password_hash($input_parameter['PASSWORD'], PASSWORD_BCRYPT, [10]);
	
		$query_update = 
		"
		update
			public.users
		set
			name = '".addslashes($input_parameter['NAMA'])."'
			,email = '".$input_parameter['EMAIL']."'
			,password = '".$finalpassword."'
			,roles = '".$input_parameter['ROLE']."'
			,id_rs = '".$input_parameter['ID_RS']."'
			,updated_at = '".date('Y-m-d H:i:s')."'
		where
			id = '".$input_parameter['ID']."'
		";

		$result_update = pg_query($db, $query_update);
/* 		echo $query_update;exit; */
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data user telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteUserByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.users
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data user telah berhasil dihapus.";
	
	return $function_result;
}

function GetUserByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.users where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_email[] = $row_get['email'];
		$array_password[] = $row_get['password'];
		$array_remembertoken[] = $row_get['remember_token'];
		$array_roles[] = $row_get['roles'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_image[] = $row_get['image'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['EMAIL'] = $array_email;
	$grand_array['PASSWORD'] = $array_password;
	$grand_array['REMEMBER_TOKEN'] = $array_remembertoken;
	$grand_array['ROLES'] = $array_roles;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['IMAGE'] = $array_image;
	
	return $grand_array;

}

function GetAllUser(){
	global $db;
	
	if( $_SESSION['OSH']['ROLES'] == 'superadmin' ){
		$query_get = "select * from public.users";
	} else {
		$query_get = "select * from public.users where id_rs = '".$_SESSION['OSH']['ID_RS']."' ";
	}
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['name']);
		$array_email[] = $row_get['email'];
		$array_password[] = $row_get['password'];
		$array_remembertoken[] = $row_get['remember_token'];
		$array_roles[] = $row_get['roles'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_image[] = $row_get['image'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['EMAIL'] = $array_email;
	$grand_array['PASSWORD'] = $array_password;
	$grand_array['REMEMBER_TOKEN'] = $array_remembertoken;
	$grand_array['ROLES'] = $array_roles;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['IMAGE'] = $array_image;
	
	return $grand_array;
}

function EmptyUser(){
	global $db;
	
	$query_empty = 
	"
	truncate user;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua user point telah berhasil dihapus.";
	
	return $function_result;
}





?>