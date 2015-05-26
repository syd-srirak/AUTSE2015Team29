<?php

$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'serler'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
$query = '';
$user_name = $_POST['user_name'];

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
$test = mysqli_query($link, 'SELECT 1 FROM PAPER');
if($test==FALSE){
	$output = 'Unable to connect to USER table.';
	echo $output;
}else{
	$query = "SELECT USER_PASSWORD FROM USER WHERE USER_NAME LIKE '".$user_name."'";
	$results = mysqli_query($link, $query);
	$password_available = mysqli_num_rows($results);
	if($password_available){
		$password = mysqli_fetch_array($results)[0];
		$output = 'Your password is => '.$password.' <=.';
		echo $output;
		header('Refresh: 6; URL=login_page.html');
		$output = 'Returning to main page in 6 seconds...';
		echo "<br/>";
		echo $output;
	}else{
		$output = 'User '.$user_name.' does not exist.';
		echo $output;
		include 'return_to_main.php';
	}
}

mysqli_close($link);
	
?>