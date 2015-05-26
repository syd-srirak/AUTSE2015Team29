<?php

$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'serler'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
$query = '';
$user_name = $_POST['user_name'];
$is_mod = $_POST['is_mod'];

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
	$query = "SELECT * FROM PAPER";
	if(!($result=mysqli_query($link, $query))){
		$output = 'Error retrieving data from PAPER.';
		echo $output;
		header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
		$output = 'Returning to homepage in 3 seconds...';
		echo "<br/>";
		echo $output;
	}else{
		$num_results = mysqli_num_rows($result);
		if(!$num_results){
			$output = 'No submissions yet.';
			echo $output;
			header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
			$output = 'Returning to homepage in 3 seconds...';
			echo "<br/>";
			echo $output;
		}else{
			while($rows = mysqli_fetch_row($result)){
				$paper_id = $rows[0];
				echo $rows[1].' ';
				echo $rows[2].' ';
				echo $rows[3].' ';
				if($is_mod){
					echo "<a href=add_metadata.php?paper_id=".$paper_id."&amp;user_name=".$user_name.">Add Metadata</a>";
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
<title>SERLER Submissions</title>
</head>
<body>
<a href=homepage.php?user_name=<?php echo $user_name?>>Back</a>
</body>
</html>