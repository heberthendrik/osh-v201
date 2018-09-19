<?php
session_start();
$db = @new mysqli('localhost', 'root', 'root', 'newosh');
if (mysqli_connect_errno()) {
	die ('Could not open a mysql connection: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
}
?>
