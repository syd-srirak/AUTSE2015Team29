<?php

session_start();
$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'serler'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
$query = '';
$user_name = $_GET['user_name'];
$is_mod = '';
$is_admin = '';

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

$query = "SELECT USER_IS_MOD, USER_IS_ADMIN FROM USER WHERE USER_NAME LIKE '".$user_name."'";
$result = mysqli_query($link, $query);
$results = mysqli_fetch_array($result);
$is_mod = $results[0];
$is_admin = $results[1];
if(isset($_SESSION['user_name'])){
	$_SESSION['user_name'] = $_GET['user_name'];
}
if(isset($_SESSION['is_mod'])){
	$_SESSION['is_mod'] = $is_mod;
}
if(isset($_SESSION['is_admin'])){
	$_SESSION['is_admin'] = $is_admin;
}

mysqli_close($link);

?>

<html>
<head>
<title>SERLER Homepage</title>
</head>
<body>
<form action="submit_paper.php" method="post">
<div><label for="paper_link">Link to Paper:
	<input type="text" name="paper_link" id="paper_link" required/></label></div>
<div><input type="hidden" name="user_name" value="<?php echo $user_name ?>"/></div>
<div><input type="submit" value="Submit Paper"/></div></form>
<form action="view_submissions.php" method="post">
<div><input type="hidden" name="user_name" value="<?php echo $user_name ?>"/></div>
<div><input type="hidden" name="is_mod" value="<?php echo $is_mod ?>"/></div>
<div><input type="submit" value="View Submissions"/></div></form>
<form action="view_metadata.php" method="post">
<div><input type="hidden" name="user_name" value="<?php echo $user_name ?>"/></div>
<div><input type="submit" value="View Metadata"/></div></form>
</body>
</html>