<?php
/*
Template Name: Search Page
*/

$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'wordpress'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
mysqli_select_db($link, $database);

$field = $_GET['search-field'];
$operator = $_GET['search-query'];
$value = $_GET['s'];
$save = $_GET['save-query'];

if($operator=='LIKE'){
	$query = "SELECT * FROM SERLER WHERE ".$field." LIKE '%".$value."%'";
}else if($operator=='BETWEEN'){
	$values = explode("-", $value);
	$value_one = $values[0];
	$value_two = $values[1];
	$query = "SELECT * FROM SERLER WHERE ".$field." BETWEEN ".$value_one." AND ".$value_two;
}else{
	$query = "SELECT * FROM SERLER WHERE ".$field." ".$operator." ".$value;
}

$result = mysqli_query($link, $query);
if(!$result && !$num_results = mysqli_num_rows($result)){
	get_template_part( 'content', 'none' );
}else{
	while($rows = mysqli_fetch_row($result)){
		$row[] = $rows[0];
		$data[] = $row;
	}
	if($save=='yes'){
		file_put_contents("queries.txt", $query.PHP_EOL, FILE_APPEND);
	}
}

?>

<html>
<head>
<title>SERLER Submissions</title>
</head>
<body>
<table border="1">
	<tr>
		<th>Paper Name</th>
		<th>Paper Author</th>
		<th>Publication Year</th>
		<th>Paper Source</th>
		<th>Credibility Rating</th>
	<?php foreach ($data as $row): ?>
	<tr>
		<?php foreach ($row as $element): ?>
			<td align="center"><?php echo $element; ?></td>
		<?php endforeach; ?>
	</tr>
	<?php endforeach; ?>
</table>
</body>
</html>