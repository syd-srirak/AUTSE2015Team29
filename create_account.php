<?php

$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'serler'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
$query = '';
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$user_email = $_POST['user_email'];
$date_created = date('Y/m/d H:i:s');
$is_mod = $_POST['is_mod'];
$is_admin = $_POST['is_admin'];

// Check if connection can be established
if(!$link){
	$output = 'Unable to connect to the server.';
	echo $output;
}

// Check if database exists
if(!mysqli_select_db($link, $database)){
	$output = 'Database does not exist.';
	echo $output;
}

// Check if USER table is present
$test = mysqli_query($link, 'SELECT 1 FROM USER');
if($test==TRUE){
	$query = "SELECT * FROM USER WHERE USER_NAME LIKE '".$user_name."'";
	$results = mysqli_query($link, $query);
	$username_taken = mysqli_num_rows($results);
	if($username_taken){
		$output = 'That username is already taken!';
		echo $output;
		header('Refresh: 3; URL=create_account.html');
		$output = 'Returning in 3 seconds...';
		echo "<br/>";
		echo $output;
	}else{
		$query = "INSERT INTO USER VALUES('','".$user_name."','".$user_password."','".$user_email."','".$date_created."',NULL,".$is_mod.",".$is_admin.")";
		if(!mysqli_query($link, $query)){
			$output = 'Failed to create account.';
			echo $output;
			header('Refresh: 3; URL=create_account.html');
			$output = 'Returning in 3 seconds...';
			echo "<br/>";
			echo $output;
		}else{
			$output = 'Account successfully created!';
			echo $output;
			include 'return_to_main.php';
		}
	}
}

mysqli_close($link);
	
?>