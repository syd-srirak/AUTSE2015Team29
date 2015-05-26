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

// Check if SERLER table is present
$test = mysqli_query($link, 'SELECT 1 FROM SERLER');
if($test==FALSE){
	$output = 'Unable to connect to SERLER table.';
	echo $output;
}else{
	$query = "SELECT * FROM SERLER";
	if(!($result=mysqli_query($link, $query))){
		$output = 'Error retrieving data from SERLER.';
		echo $output;
		header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
		$output = 'Returning to homepage in 3 seconds...';
		echo "<br/>";
		echo $output;
	}else{
		$num_results = mysqli_num_rows($result);
		if(!$num_results){
			$output = 'No metadata entered yet.';
			echo $output;
			header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
			$output = 'Returning to homepage in 3 seconds...';
			echo "<br/>";
			echo $output;
		}else{
			while($rows = mysqli_fetch_row($result)){
				foreach($rows as $row){
					echo $row.' ';
				}
				echo "<br/>";
			}
		}
	}
}

mysqli_close($link);

?>

<html>
<head>
<title>SERLER Metadata</title>
</head>
<body>
<a href=homepage.php?user_name=<?php echo $user_name?>>Back</a>
</body>
</html>