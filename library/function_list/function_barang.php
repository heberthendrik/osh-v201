<?php

/*==========================================

/*==========================================*/

function AddBarang($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_barang b
	where
		b.name = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Barang (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan barang yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_barang
		(
		name,
		id_satuan,
		katalog,
		id_kategori,
		id_supplier,
		tgl_masuk,
		id_merk,
		tipe,
		id_principal,
		hrg_perolehan,
		hrg_jual,
		status,
		komputer,
		nama_user,
		tgl_entri,
		diskonv,
		id_rs,
		created_at
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".$input_parameter['SATUAN']."',
		'".addslashes($input_parameter['KATALOG'])."',
		'".$input_parameter['KATEGORI']."',
		'".addslashes($input_parameter['ID_SUPPLIER'])."',
		'".$input_parameter['TGL_MASUK']."',
		'".$input_parameter['MERK']."',
		'".addslashes($input_parameter['TIPE'])."',
		'".addslashes($input_parameter['ID_PRINCIPAL'])."',
		'".$input_parameter['HRG_PEROLEHAN']."',
		'".$input_parameter['HRG_JUAL']."',
		'".$input_parameter['STATUS']."',
		'".addslashes($input_parameter['KOMPUTER'])."',
		'".addslashes($input_parameter['USER'])."',
		'".$input_parameter['TGL_ENTRI']."',
		'".addslashes($input_parameter['DISKONV'])."',
		'".$input_parameter['ID_RS']."',
		'".date('Y-m-d H:i:s')."'
		)
		";
		
		$result_add = pg_query($db, $query_add);
		$row_add = pg_fetch_row($result_add);
		
		//echo $query_add;exit;
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Barang telah berhasil ditambahkan." ;

	}
	
	return $function_result;
}

function UpdateBarangByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_barang b
	where
		b.name = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
		and b.id != '".$input_parameter['ID']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Barang (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama barang yang lain.";
	} else {
	
		$query_update = 
		"
		update 
			public.tab_barang 
		SET 
			name = '".addslashes($input_parameter['NAMA'])."'
			,id_satuan = '".$input_parameter['SATUAN']."'
			,katalog = '".addslashes($input_parameter['KATALOG'])."'
			,id_kategori = '".$input_parameter['KATEGORI']."'
			,id_supplier = '".addslashes($input_parameter['ID_SUPPLIER'])."'
			,tgl_masuk = '".$input_parameter['TGL_MASUK']."'
			,id_merk = '".$input_parameter['MERK']."'
			,tipe = '".addslashes($input_parameter['TIPE'])."'
			,id_principal = '".addslashes($input_parameter['ID_PRINCIPAL'])."'
			,hrg_perolehan = '".$input_parameter['HRG_PEROLEHAN']."'
			,hrg_jual = '".$input_parameter['HRG_JUAL']."'
			,status = '".$input_parameter['STATUS']."'
			,komputer = '".addslashes($input_parameter['KOMPUTER'])."'
			,tgl_entri = '".$input_parameter['TGL_ENTRI']."'
			,diskonv = '".addslashes($input_parameter['DISKONV'])."'
			,nama_user = '".addslashes($input_parameter['USER'])."'
			,id_rs = '".$input_parameter['ID_RS']."'
			,updated_at = '".date("Y-m-d H:i:s")."'
		where id = '".$input_parameter['ID']."'
		";
/* 		echo $query_update;exit; */
		$result_update = pg_query($db, $query_update);
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data barang telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteBarangByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_barang
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data barang telah berhasil dihapus.";
	
	return $function_result;
}

function GetBarangByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_barang where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_name[] = stripslashes($row_get['name']);
		$array_idsatuan[] = $row_get['id_satuan'];
		$array_katalog[] = $row_get['katalog'];
		$array_idkategori[] = $row_get['id_kategori'];
		$array_idsupplier[] = $row_get['id_supplier'];
		$array_tglmasuk[] = $row_get['tgl_masuk'];
		$array_idmerk[] = $row_get['id_merk'];
		$array_tipe[] = $row_get['tipe'];
		$array_idprincipal[] = $row_get['id_principal'];
		$array_hrgperolehan[] = $row_get['hrg_perolehan'];
		$array_hrgjual[] = $row_get['hrg_jual'];
		$array_status[] = $row_get['status'];
		$array_komputer[] = $row_get['komputer'];
		$array_namauser[] = $row_get['nama_user'];
		$array_tglentri[] = $row_get['tgl_entri'];
		$array_diskonv[] = $row_get['diskonv'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAME'] = $array_name;
	$grand_array['ID_SATUAN'] = $array_idsatuan;
	$grand_array['KATALOG'] = $array_katalog;
	$grand_array['ID_KATEGORI'] = $array_idkategori;
	$grand_array['ID_SUPPLIER'] = $array_idsupplier;
	$grand_array['TGL_MASUK'] = $array_tglmasuk;
	$grand_array['ID_MERK'] = $array_idmerk;
	$grand_array['TIPE'] = $array_tipe;
	$grand_array['ID_PRINCIPAL'] = $array_idprincipal;
	$grand_array['HRG_PEROLEHAN'] = $array_hrgperolehan;
	$grand_array['HRG_JUAL'] = $array_hrgjual;
	$grand_array['STATUS'] = $array_status;
	$grand_array['KOMPUTER'] = $array_komputer;
	$grand_array['NAMA_USER'] = $array_namauser;
	$grand_array['TGL_ENTRI'] = $array_tglentri;
	$grand_array['DISKONV'] = $array_diskonv;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;

}

function GetAllBarang(){
	global $db;
	
	if( $_SESSION['OSH']['ROLES'] == 'superadmin' ){
		$query_get = "select * from public.tab_barang";
	} else {
		$query_get = "select * from public.tab_barang where id_rs = '".$_SESSION['OSH']['ID_RS']."' ";
	}
	
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_name[] = stripslashes($row_get['name']);
		$array_idsatuan[] = $row_get['id_satuan'];
		$array_katalog[] = $row_get['katalog'];
		$array_idkategori[] = $row_get['id_kategori'];
		$array_idsupplier[] = $row_get['id_supplier'];
		$array_tglmasuk[] = $row_get['tgl_masuk'];
		$array_idmerk[] = $row_get['id_merk'];
		$array_tipe[] = $row_get['tipe'];
		$array_idprincipal[] = $row_get['id_principal'];
		$array_hrgperolehan[] = $row_get['hrg_perolehan'];
		$array_hrgjual[] = $row_get['hrg_jual'];
		$array_status[] = $row_get['status'];
		$array_komputer[] = $row_get['komputer'];
		$array_namauser[] = $row_get['nama_user'];
		$array_tglentri[] = $row_get['tgl_entri'];
		$array_diskonv[] = $row_get['diskonv'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAME'] = $array_name;
	$grand_array['ID_SATUAN'] = $array_idsatuan;
	$grand_array['KATALOG'] = $array_katalog;
	$grand_array['ID_KATEGORI'] = $array_idkategori;
	$grand_array['ID_SUPPLIER'] = $array_idsupplier;
	$grand_array['TGL_MASUK'] = $array_tglmasuk;
	$grand_array['ID_MERK'] = $array_idmerk;
	$grand_array['TIPE'] = $array_tipe;
	$grand_array['ID_PRINCIPAL'] = $array_idprincipal;
	$grand_array['HRG_PEROLEHAN'] = $array_hrgperolehan;
	$grand_array['HRG_JUAL'] = $array_hrgjual;
	$grand_array['STATUS'] = $array_status;
	$grand_array['KOMPUTER'] = $array_komputer;
	$grand_array['NAMA_USER'] = $array_namauser;
	$grand_array['TGL_ENTRI'] = $array_tglentri;
	$grand_array['DISKONV'] = $array_diskonv;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;
}

function EmptyBarang(){
	global $db;
	
	$query_empty = 
	"
	truncate barang;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua barang point telah berhasil dihapus.";
	
	return $function_result;
}





?>