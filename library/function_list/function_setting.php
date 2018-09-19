<?php

/*==========================================

/*==========================================*/

function UpdateMasterSetting($input_parameter){
	global $db;
	
	$query_update = 
	"
	update 
		master_setting 
	set  
		VALUE = '".addslashes($input_parameter['VALUE'])."' 
	where
		PARAMETER = '".addslashes($input_parameter['PARAMETER'])."' 
	";
	//echo $query_update;exit;
	$result_update = $db->query($query_update);

	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Master harga JPU telah berhasil diubah." ;
	
	return $function_result;
}

function GetMasterSetting($input_parameter){
	
	global $db;
	
	$query_get = "select VALUE from master_setting where PARAMETER = '".$input_parameter['PARAMETER']."'";
	//echo $query_get;exit;
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$value = $row_get['VALUE'];
	
	return $value;
	
}

?>