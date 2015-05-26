<?php

$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'serler'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
$query = '';
$paper_link = $_POST['paper_link'];
$user_name = $_POST['user_name'];
$date_submitted = date('Y/m/d H:i:s');

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

// Check if PAPER table is present
$test = mysqli_query($link, 'SELECT 1 FROM PAPER');
if($test==FALSE){
	$output = 'Unable to connect to PAPER table.';
	echo $output;
}else{
	$query = "INSERT INTO PAPER VALUES('','".$paper_link."','".$user_name."','".$date_submitted."')";
	if(!mysqli_query($link, $query)){
		$output = 'Error inputting data to PAPER.';
		echo $output;
		header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
		$output = 'Returning to homepage in 3 seconds...';
		echo "<br/>";
		echo $output;
	}else{
		$output = 'Successfully entered '.$paper_link.' into the database!';
		echo $output;
		header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
		$output = 'Returning to homepage in 3 seconds...';
		echo "<br/>";
		echo $output;
	}
}

mysqli_close($link);
	
?>