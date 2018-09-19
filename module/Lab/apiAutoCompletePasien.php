<?php
header('Access-Control-Allow-Origin: *');
include('../../library/function_list.php');

/*
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}

$result = pg_query($conn, "SELECT * FROM public.users ORDER BY id ASC ");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "Author: $row[0]  E-mail: $row[1]";
  echo "<br />\n";
}
*/



/*
*
*
*
*
--Auto Complete Pasien--
*
*
*
*
*/

if( $_GET['action'] == 'AutoCompletePasien' ){

	$no_rm = $_POST['no_rm'];
	
	$query = "select * from public.tab_customer where no_rm = '".$no_rm."' order by nama asc";
	$result = pg_query($db, $query);
	$num_rows = pg_num_rows($result);
	
	if( $num_rows == 0 ){
	
		$json['display_content'] .= '';
		
		$json['function_result'] = 0;
		$json['system_message'] = 'Data pasien tidak ditemukan.';
		
	} else if( $num_rows == 1 ){
	
		while( $row = pg_fetch_assoc($result) ){
			
			$json['function_result'] = 1;
			//$json['system_message'] = $num_rows.' berhasil ditemukan.';
			$json['nama'] = $row['nama'];
			$json['tgl_lahir'] = $row['tgl_lahir'];
			$json['alamat'] = $row['alamat'];
			$json['sex'] = $row['sex'];
			
			$json['display_content'] .= '';
			
		}
		
	} else if( $num_rows > 1 ){
	
		$json['display_content'] .= '';
		
		$json['function_result'] = 2;
		$json['system_message'] = $num_rows.' berhasil ditemukan. Silahkan pastikan No Rekam Medis pasien unik.';
		
	} else {
	
		$json['display_content'] .= '';
		
		$json['function_result'] = 3;
		$json['system_message'] = 'Data pasien tidak ditemukan.';
	
	}
	
	echo json_encode($json);
	
}









?>