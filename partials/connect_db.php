<?php 

	session_start();

	//creating constant for non repeating values
	define('DB_HOST', 'peicloud.ca');
	define('DB_USER', 'u134');
	define('DB_PASS', 'u134');
	define('DB_NAME', 'db134');

	//connecting to the database
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die(mysqli_error());

	//seleting my database
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

?>