<?php

/*==========================================

/*==========================================*/

function AddDokter($input_parameter){
	global $db;
	
	$random_email = rand(123456, 654321).'@shree.com';
	$random_password = rand(123456, 654321);
	
	$query_add_user = 
	"
	insert into master_user
	(
	NAME,
	EMAIL,
	NIK_TYPE,
	PASSWORD,
	TEMP_PASSWORD
	)
	values
	(
	'".addslashes($input_parameter['NAMA'])."',
	'".$random_email."',
	'1',
	'".password_hash($random_password, PASSWORD_BCRYPT, [10])."',
	'".$random_password."'
	)
	";
	$result_add_user = $db->query($query_add_user);
	if( $result_add_user ){
		$query_status_user = 1;
	} else {
		$query_status_user = 0;
	}
	$new_user_id = $db->insert_id;
	
	
	$query_add_doctor = 
	"
	insert into master_doctor
	(
	IS_ACTIVE,
	CREATED_AT,
	CREATED_BY
	)
	values
	(
	'1',
	'".date('Y-m-d H:i:s')."',
	'".$_SESSION['OSH']['COMPOSITE_ID']."'
	)
	";
	$result_add_doctor = $db->query($query_add_doctor);
	if( $result_add_doctor ){
		$query_status_doctor = 1;
	} else {
		$query_status_doctor = 0;
	}
	$new_doctor_id = $db->insert_id;
	
	
	
	$query_add_composite = 
	"
	insert into master_user_composite
	(
	ID_USER,
	ID_RS,
	ID_ROLE,
	ID_DOCTOR
	)
	values
	(
	'".$new_user_id."',
	'".$input_parameter['ID_RS']."',
	4,
	'".$new_doctor_id."'
	)
	";
	
	$result_add_composite = $db->query($query_add_composite);
	if( $result_add_composite ){
		$query_status_composite = 1;
	} else {
		$query_status_composite = 0;
	}
	$new_composite_id = $db->insert_id;
	
	if( $query_status_user == 1 && $query_status_doctor == 1 && $query_status_composite == 1 ){
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Dokter telah berhasil ditambahkan." ;
		$function_result['NEW_ID'] = $new_composite_id;
	} else {
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Penambahan data gagal karena masalah teknis. Silahkan hubungi administrator." ;
	}
	
	return $function_result;
}

function UpdateDokterByID($input_parameter){
	global $db;
	
	$query_getdoctorid = 
	"
	select 
		* 
	from master_user_composite
	where 
		ID = '".$input_parameter['ID']."' 
		and ID_RS = '".$input_parameter['ID_RS']."'
	";
	$result_getdoctorid = $db->query($query_getdoctorid);
	$row_getdoctorid = $result_getdoctorid->fetch_assoc();
	$id_doctor = $row_getdoctorid['ID_DOCTOR'];
	$id_user = $row_getdoctorid['ID_USER'];
	
	
	
	
	$query_update_user = 
	"
	update
		master_user
	set
	
		NIK = '".$input_parameter['NIK']."',
		PHONE_NUMBER = '".$input_parameter['PHONE_NUMBER']."',
		EMAIL = '".$input_parameter['EMAIL']."',
		NAME = '".$input_parameter['NAME']."',
		SEX = '".$input_parameter['SEX']."',
		BIRTH_DATE = '".$input_parameter['BIRTH_DATE']."'
	where
		ID = '".$id_user."'
	";

/* 	echo '<br>'.$query_update_user; */
	$result_update_user = $db->query($query_update_user);
	if( $result_update_user ){
		$query_status_update_user = 1;
	} else {
		$query_status_update_user = 0;
	}
	
	
	$query_update_doctor = 
	"
	update
		master_doctor
	set
		NIK_EMPLOYEE = '".$input_parameter['NIK_EMPLOYEE']."',
		IS_ACTIVE = '".$input_parameter['STATUS']."',
		UPDATED_AT = '".date('Y-m-d H:i:s')."',
		UPDATED_BY = '".$_SESSION['OSH']['COMPOSITE_ID']."'
	where
		ID = '".$id_doctor."'
	";
/* 	echo '<br>'.$query_update_doctor;exit; */
	$result_update_doctor = $db->query($query_update_doctor);
	if( $result_update_doctor ){
		$query_status_update_doctor = 1;
	} else {
		$query_status_update_doctor = 0;
	}

	if( $query_status_update_user == 1 && $query_status_update_doctor == 1 ){
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data dokter telah berhasil diperbaharui." ;	
	} else {
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Perubahan data gagal karena masalah teknis. Silahkan hubungi administrator." ;
	}
	
	return $function_result;
}

function DeleteDokterByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from master_user_composite
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = $db->query($query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data dokter telah berhasil dihapus.";
	
	return $function_result;
}

function GetDokterByID($input_parameter){
	global $db;
	
	$query_get = 
	"
	select 
		t1.ID as ID,
		t1.ID_RS as ID_RS,
		t2.ID as ID_USER,
		t2.NIK as NIK,
		t2.PHONE_NUMBER as PHONE_NUMBER,
		t2.EMAIL as EMAIL,
		t2.NAME as NAME,
		t2.SEX as SEX,
		t2.BIRTH_DATE as BIRTH_DATE,
		t2.PROFILE_PICTURE as PROFILE_PICTURE,
		t2.PASSWORD as PASSWORD,
		t2.TEMP_PASSWORD as TEMP_PASSWORD,
		t3.NIK_EMPLOYEE as NIK_EMPLOYEE,
		t3.IS_ACTIVE as IS_ACTIVE
	from master_user_composite t1
		left join master_user t2 on t2.ID = t1.ID_USER
		left join master_doctor t3 on t3.ID = t1.ID_DOCTOR 
	where 
		t1.ID = '".$input_parameter['ID']."' 
	";
	//echo $query_get;exit;
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_idrs[] = $row_get['ID_RS'];
		$array_iduser[] = $row_get['ID_USER'];
		$array_nik[] = $row_get['NIK'];
		$array_phonenumber[] = $row_get['PHONE_NUMBER'];
		$array_email[] = $row_get['EMAIL'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_sex[] = $row_get['SEX'];
		$array_birthdate[] = $row_get['BIRTH_DATE'];
		$array_profilepicture[] = $row_get['PROFILE_PICTURE'];
		$array_password[] = $row_get['PASSWORD'];
		$array_temppassword[] = $row_get['TEMP_PASSWORD'];
		$array_nikemployee[] = $row_get['NIK_EMPLOYEE'];
		$array_isactive[] = $row_get['IS_ACTIVE'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_udpatedby[] = $row_get['UPDATED_BY'];
		$array_lastlogin[] = $row_get['LAST_LOGIN'];
		$array_loginip[] = $row_get['LOGIN_IP'];
		$array_loginmac[] = $row_get['LOGIN_MAC'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['ID_USER'] = $array_iduser;
	$grand_array['NIK'] = $array_nik;
	$grand_array['PHONE_NUMBER'] = $array_phonenumber;
	$grand_array['EMAIL'] = $array_email;
	$grand_array['NAME'] = $array_nama;
	$grand_array['SEX'] = $array_sex;
	$grand_array['BIRTH_DATE'] = $array_birthdate;
	$grand_array['PROFILE_PICTURE'] = $array_profilepicture;
	$grand_array['PASSWORD'] = $array_password;
	$grand_array['TEMP_PASSWORD'] = $array_temppassword;
	$grand_array['NIK_EMPLOYEE'] = $array_nikemployee;
	$grand_array['IS_ACTIVE'] = $array_isactive;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	$grand_array['LAST_LOGIN'] = $array_lastlogin;
	$grand_array['LOGIN_IP'] = $array_loginip;
	$grand_array['LOGIN_MAC'] = $array_loginmac;
	
	return $grand_array;

}

function GetAllDokter(){
	global $db;
	
	if( $_SESSION['OSH']['ID_ROLE'] == 1 ){
		$query_get = 
		"
		select 
			t1.ID as ID,
			t1.ID_RS as ID_RS,
			t2.ID as ID_USER,
			t2.NIK as NIK,
			t2.PHONE_NUMBER as PHONE_NUMBER,
			t2.EMAIL as EMAIL,
			t2.NAME as NAME,
			t2.SEX as SEX,
			t2.BIRTH_DATE as BIRTH_DATE,
			t2.PROFILE_PICTURE as PROFILE_PICTURE,
			t2.PASSWORD as PASSWORD,
			t2.TEMP_PASSWORD as TEMP_PASSWORD,
			t3.NIK_EMPLOYEE as NIK_EMPLOYEE,
			t3.IS_ACTIVE as IS_ACTIVE
		from master_user_composite t1
			left join master_user t2 on t2.ID = t1.ID_USER
			left join master_doctor t3 on t3.ID = t1.ID_DOCTOR
		where
			t1.ID_ROLE = 4
		";
	} else {
		$query_get = 
		"
		select 
			t1.ID as ID,
			t1.ID_RS as ID_RS,
			t2.ID as ID_USER,
			t2.NIK as NIK,
			t2.PHONE_NUMBER as PHONE_NUMBER,
			t2.EMAIL as EMAIL,
			t2.NAME as NAME,
			t2.SEX as SEX,
			t2.BIRTH_DATE as BIRTH_DATE,
			t2.PROFILE_PICTURE as PROFILE_PICTURE,
			t2.PASSWORD as PASSWORD,
			t2.TEMP_PASSWORD as TEMP_PASSWORD,
			t3.NIK_EMPLOYEE as NIK_EMPLOYEE,
			t3.IS_ACTIVE as IS_ACTIVE,
			t3.CREATED_AT as CREATED_AT,
			t3.UPDATED_AT as UPDATED_AT,
			t3.CREATED_BY as CREATED_BY,
			t3.UPDATED_BY as UPDATED_BY,
			t3.LAST_LOGIN as LAST_LOGIN,
			t3.LOGIN_IP as LOGIN_IP,
			t3.LOGIN_MAC as LOGIN_MAC
		from master_user_composite t1
			left join master_user t2 on t2.ID = t1.ID_USER
			left join master_doctor t3 on t3.ID = t1.ID_DOCTOR 
		where 
			t1.ID_ROLE = 4
			and t1.ID_RS = '".$_SESSION['OSH']['ID_RS']."' 
		";
	}
	//echo $query_get;exit;
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	while( $row_get = $result_get->fetch_assoc() ){
		
		$array_id[] = $row_get['ID'];
		$array_idrs[] = $row_get['ID_RS'];
		$array_iduser[] = $row_get['ID_USER'];
		$array_nik[] = $row_get['NIK'];
		$array_phonenumber[] = $row_get['PHONE_NUMBER'];
		$array_email[] = $row_get['EMAIL'];
		$array_nama[] = stripslashes($row_get['NAME']);
		$array_sex[] = $row_get['SEX'];
		$array_birthdate[] = $row_get['BIRTH_DATE'];
		$array_profilepicture[] = $row_get['PROFILE_PICTURE'];
		$array_password[] = $row_get['PASSWORD'];
		$array_temppassword[] = $row_get['TEMP_PASSWORD'];
		$array_nikemployee[] = $row_get['NIK_EMPLOYEE'];
		$array_isactive[] = $row_get['IS_ACTIVE'];
		$array_createdat[] = $row_get['CREATED_AT'];
		$array_updatedat[] = $row_get['UPDATED_AT'];
		$array_createdby[] = $row_get['CREATED_BY'];
		$array_udpatedby[] = $row_get['UPDATED_BY'];
		$array_lastlogin[] = $row_get['LAST_LOGIN'];
		$array_loginip[] = $row_get['LOGIN_IP'];
		$array_loginmac[] = $row_get['LOGIN_MAC'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['ID_USER'] = $array_iduser;
	$grand_array['NIK'] = $array_nik;
	$grand_array['PHONE_NUMBER'] = $array_phonenumber;
	$grand_array['EMAIL'] = $array_email;
	$grand_array['NAME'] = $array_nama;
	$grand_array['SEX'] = $array_sex;
	$grand_array['BIRTH_DATE'] = $array_birthdate;
	$grand_array['PROFILE_PICTURE'] = $array_profilepicture;
	$grand_array['PASSWORD'] = $array_password;
	$grand_array['TEMP_PASSWORD'] = $array_temppassword;
	$grand_array['NIK_EMPLOYEE'] = $array_nikemployee;
	$grand_array['IS_ACTIVE'] = $array_isactive;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['CREATED_BY'] = $array_createdby;
	$grand_array['UPDATED_BY'] = $array_updatedby;
	$grand_array['LAST_LOGIN'] = $array_lastlogin;
	$grand_array['LOGIN_IP'] = $array_loginip;
	$grand_array['LOGIN_MAC'] = $array_loginmac;
		
	return $grand_array;
}

function EmptyDokter(){
	global $db;
	
	$query_empty = 
	"
	truncate dokter;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua dokter point telah berhasil dihapus.";
	
	return $function_result;
}





?>