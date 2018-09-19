<?php
session_start();

/*==========================================

1. function Login($email, $password)
2. function PreventAdminURLDirectAccess()
3. function DirectAccessToDashboard()
4. function Logout()
5. function SendSystemEmail($email_metadata)
6. function CustomUploadFile($file_metadata)
7. function GetMasterLink()
8. function AddLog($log_parameter)
9. function Terbilang($x) 

==========================================*/

function Login($input_parameter){
	global $db;
	
	$email = $input_parameter['EMAIL'];
	$password = $input_parameter['PASSWORD'];
	
	$query = "select * from master_user where email = '".$email."'";
	$result = $db->query($query);
	$num_rows = $result->num_rows;
	
/* 	echo $query;exit; */
	//echo $num_rows;exit;
	
	if( $num_rows == 0 ){
	
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = 'Login gagal. Pastikan username dan password Anda benar.';
		
	} else {
	
		$row = $result->fetch_assoc();
		$validpassword = $row['PASSWORD'];
		
		$value = $password;
		$passwordlaravel = $validpassword;
		$password = password_hash($value, PASSWORD_BCRYPT, [10]);
		$result = password_verify($value, $passwordlaravel);
		
		if( $result ){
			
			$function_result['FUNCTION_RESULT'] = 1;
			//$function_result['SYSTEM_MESSAGE'] = 'Login berhasil.';
			
			$query_getdetail = 
			"
			select
				t1.ID as ID_COMPOSITE,
				t1.ID_ROLE as ID_ROLE,
				t1.ID_RS as ID_RS,
				t2.ID as ID_USER,
				t2.NAME as NAME,
				t2.EMAIL as EMAIL,
				t2.PROFILE_PICTURE as PROFILE_PICTURE,
				t3.ID as ID_DOCTOR,
				t4.ID as ID_OFFICER
			from master_user_composite t1
				left join master_user t2 on t1.ID_USER = t2.ID
				left join master_doctor t3 on t1.ID_DOCTOR = t3.ID
				left join master_officer t4 on t1.ID_OFFICER = t4.ID
			";
/* 			echo $query_getdetail;exit; */
			$result_getdetail = $db->query($query_getdetail);
			$row_getdetail = $result_getdetail->fetch_assoc();
			
			$_SESSION['OSH']['LOGIN_STATUS'] = 1;
			$_SESSION['OSH']['COMPOSITE_ID'] = 1;
			$_SESSION['OSH']['ID_ROLE'] = 1;
			$_SESSION['OSH']['ID_USER'] = 1;
			$_SESSION['OSH']['NAME'] = 'Hebert Hendrik';
			$_SESSION['OSH']['EMAIL'] = 'hebert.hendrik@gmail.com';
			$_SESSION['OSH']['PROFILE_PICTURE'] = $row['PROFILE_PICTURE'];
			$_SESSION['OSH']['ID_RS'] = 0;
			
		} else {
			
			unset($_SESSION['OSH']);
			
			$function_result['FUNCTION_RESULT'] = 0;
			$function_result['SYSTEM_MESSAGE'] = 'Login gagal. Pastikan username dan password Anda benar.';
			
		}
		
	}
	
	return $function_result;
}
function PreventAdminURLDirectAccess(){
	global $db;
	
	$master_link = GetMasterLink();
	
	if( $_SESSION['OSH']['LOGIN_STATUS'] != 1 ){
		$_SESSION['OSH']['RESULT'] = 0;
		$_SESSION['OSH']['MESSAGE'] = "Anda sudah keluar dari sistem. Silahkan login kembali.";
		header("Location:".$master_link);
	}
}
function DirectAccessToDashboard(){
	global $db;
	
	if( $_SESSION['OSH']['LOGIN_STATUS'] == 1 ){
		header("Location:dashboard.php");
	}
}
function Logout(){
	global $db;
	
	unset($_SESSION['OSH']);
	
}
function SendSystemEmail($email_metadata){
	global $db;
	
	//SEND EMAIL TO CUSTOMER
	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'openswelab@gmail.com';                 // SMTP username
	$mail->Password = 'passw0rd$1';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	
	$mail->From = 'openswelab@gmail.com';
	$mail->FromName = '[NO-REPLY] OPEN SWELAB MAILER';
	$mail->addAddress($email_metadata['RECIPIENT_EMAIL'], $email_metadata['NAME'] );     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $email_metadata['SUBJECT'];
	$mail->Body    = $email_metadata['CONTENT'];
	
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	$mail->send();
	
	/*	
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}
	*/
}
function CustomUploadFile($file_metadata){
	
	$target_dir = $file_metadata['TARGET_DIRECTORY'];
	$target_file = $target_dir.'/' . basename($file_metadata['IMAGE_FILE']["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($file_metadata['IMAGE_FILE']["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        //echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    //echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    //echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" && $imageFileType != "csv" && $imageFileType != "mp4" ) {
	    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    //echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	
	    if (move_uploaded_file($file_metadata['IMAGE_FILE']["tmp_name"], $target_file)) {
	        //echo "The file ". basename( $file_metadata['IMAGE_FILE']["name"]). " has been uploaded.";
	    } else {
	        //echo "Sorry, there was an error uploading your file.";
	    }
	   
	}
	
}
function GetMasterLink(){
	
	$master_link = "http://localhost/development_site/osh-v201";
	return $master_link;
	
}
function GetSiteTitle(){
	$site_title = "Open Swelab V201";
	return $site_title;
}
function AddLog($log_parameter){
	
	global $db;
	
	$query_add = "
	insert into master_log 
	(
	PANEL,
	USER_ID,
	IP,
	MODULE,
	MESSAGE,
	DATE_CREATED
	) 
	values 
	(
	'1',
	'".$_SESSION['JPU_WIFIID']['USER_ID']."',
	'".$_SERVER['REMOTE_ADDR']."',
	'".$log_parameter['MODULE']."',
	'".$log_parameter['MESSAGE']."',
	'".date('Y-m-d H:i:s')."'
	)
	"
	;
	$result_add = $db->query($query_add);
	
}
function Terbilang($x) { 
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"); 
  if ($x < 12) 
    return " " . $abil[$x]; 
  elseif ($x < 20) 
    return Terbilang($x - 10) . " belas"; 
  elseif ($x < 100) 
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10); 
  elseif ($x < 200) 
    return " seratus" . Terbilang($x - 100); 
  elseif ($x < 1000) 
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100); 
  elseif ($x < 2000) 
    return " seribu" . Terbilang($x - 1000); 
  elseif ($x < 1000000) 
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000); 
  elseif ($x < 1000000000) 
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000); 
    
    
} 

/*
function UpdateLastLogin(){
	global $db;
	
	$query_update = 
	"
	update
		public.users
	set
		last_login = '".date('Y-m-d H:i:s')."'
	where
		id = '".$_SESSION['JPU_WIFIID']['USER_ID']."'
	";
	$result_update = $db->query($query_update);
	
}

function GenerateRandomString($character_length){
	
	$characters = '23456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $character_length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	
}

function GetConfiguration($field_name){
	
	global $db;
	
	$query_get = " select SETTING_VALUE from olstoremaster_configuration_mdb where SETTING_FIELD = '".$field_name."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$value = $row_get['SETTING_VALUE'];
	
	return $value;
	
}

function UpdateConfiguration( $field_name, $field_value ){
	
	global $db;
	
	$query_update = 
	"
	update olstoremaster_configuration_mdb
	set
	SETTING_VALUE = '".$field_value."'
	where
	SETTING_FIELD = '".$field_name."'
	";
	$result_update = $db->query($query_update);
	
}

function GetSiteName(){
	
	$site_name = "JPU wifi@id";
	
	return $site_name;
	
}

function GetSiteConfiguration(){
	
	$site_configuration['COMPANY_NAME'] = 'JPU';
	
	return $site_configuration;
	
}

function ConvertDateFormToDB($input_parameter){
	
	$explode_origindate = explode('-',$input_parameter);
	$db_fulldate = $explode_origindate[2].'-'.$explode_origindate[0].'-'.$explode_origindate[1];
	
	return $db_fulldate;
	
}

function rrmdir($dir) { 

	if (is_dir($dir)) { 
		
		$objects = scandir($dir); 
		
		foreach ($objects as $object) { 
		
			if ($object != "." && $object != "..") { 
		
				if (is_dir($dir."/".$object)) {
					rrmdir($dir."/".$object);
				}
		
				else {
					unlink($dir."/".$object); 
				}
			} 
		}
		rmdir($dir); 
	} 
}

?>