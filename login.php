<?php

$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'serler'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
$query = '';
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];

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
if($test==FALSE){
	$output = 'Unable to connect to USER table.';
	echo $output;
}else{
	$query = "SELECT USER_PASSWORD FROM USER WHERE USER_NAME LIKE '".$user_name."'";
	$results = mysqli_query($link, $query);
	$username_present = mysqli_num_rows($results);
	if($username_present){
		$password = mysqli_fetch_array($results)[0];
		if($password==$user_password){
			$output = 'Logging in...';
			echo $output;
			header("Refresh: 2; URL=homepage.php?user_name=$user_name");
			//header("Refresh: 2; URL=homepage.html");
		}else{
			$output = 'Wrong password!';
			echo $output;
			include 'return_to_main.php';
		}
	}else{
		$output = 'Invalid login!';
		echo $output;
		include 'return_to_main.php';
	}
}

mysqli_close($link);
	
?>