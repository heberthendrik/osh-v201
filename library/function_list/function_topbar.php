<?php

/*==========================================

/*==========================================*/

function GetAllUnreadNotification(){
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




?>