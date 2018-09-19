<?php
/*==========================================

AUTHENTICATION

1. AdminLogin($email, $password)
2. SetAdminLoginSession($user_id)
3. PreventAdminURLDirectAccess()
4. DirectAccessToDashboard()
5. UpdateLastLogin()
6. AdminLogout()

SHARE FUNCTION LIST

1. SendSystemEmail($email_metadata)
2. CustomUploadFile($file_metadata)
3. GenerateRandomString($character_length)
4. GetSiteConfiguration()
5. GetSiteName()

==========================================*/

/*
*
* AUTHENTICATION
*
*/


function GetMasterLink(){
	
	$master_link = "http://localhost/development_site/jpu_wifiid_central/";
	
	return $master_link;
	
}

function GetMasterLinkAgenDashboard(){
	
	$master_link = "http://localhost/development_site/jpu_wifiid_agen/";
	
	return $master_link;
	
}


?>