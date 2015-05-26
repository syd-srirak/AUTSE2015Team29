<?php

$paper_id = $_GET['paper_id'];
$user_name = $_GET['user_name'];

?>

<html>
<head>
<title>Input Metadata</title>
</head>
<body>
<form action="" method="post">
<div><label for="paper_name">Paper Name:
	<input type="text" name="paper_name" id="paper_name" maxlength="255" required/></label></div>
<div><label for="bibliography">Bibliography:
	<input type="text" name="bibliography" id="bibliography" maxlength="255" required/></label></div>
<div>Research Level:
	<select name="research_level">
		<option value="Beginner">Beginner</option>
		<option value="Medium">Medium</option>
		<option value="Expert">Expert</option>
</select></div>
<div>Methodology Researched:
	<select name="methodology_researched">
		<option value="Agile">Agile</option>
		<option value="Extreme">Extreme Programming</option>
		<option value="Kanban">KANBAN</option>
		<option value="Pair">Pair Programming</option>
		<option value="Scrum">SCRUM</option>
		<option value="Test">Test-driven Development</option>
		<option value="Waterfall">Waterfall Model</option>
</select></div>
<div>Practice Investigated:
	<select name="practice_investigated">
		<option value="Planning">Planning Poker</option>
		<option value="Refactoring">Refactoring</option>
		<option value="Testing">Testing</option>
</select></div>
<div><label for="benefit">Benefit or Outcome:
	<input type="text" name="benefit" id="benefit" maxlength="255" required/></label></div>
<div><label for="context">Context of the Study:
	<input type="text" name="context" id="context" maxlength="255" required/></label></div>	
<div><label for="result">Result of the Study:
	<input type="text" name="result" id="result" maxlength="255" required/></label></div>
<div><label for="integrity">Integrity of the Implementation:
	<input type="text" name="integrity" id="integrity" maxlength="255" required/></label></div>
<div><label for="research_question">Research Question:
	<input type="text" name="research_question" id="research_question" maxlength="255" required/></label></div>
<div>Research Method:
	<select name="research_method">
		<option value="Documents">Documents</option>
		<option value="Interviews">Interviews</option>
		<option value="Surveys">Surveys</option>
</select></div>	
<div><label for="research_metrics">Research Metrics Used:
	<input type="text" name="research_metrics" id="research_metrics" maxlength="255" required/></label></div>
<div>Nature of the Participants:
	<select name="participants">
		<option value="Positive">Positive</option>
		<option value="Negative">Negative</option>
</select></div>		
<div ><input type="submit" name="submit" value="Submit Metadata"/></div></form>
<a href=homepage.php?user_name=<?php echo $user_name?>>Back</a>
</body>
</html>

<?php

if(isset($_POST['submit'])){
	
	$hostname = 'localhost'; // Replace with host name
	$username = 'root'; // Replace with user name
	$password = ''; // Replace with password
	$database = 'serler'; // Replace with database
	$link = mysqli_connect($hostname, $username, $password);
	$query = '';
	$paper_name = $_POST['paper_name'];
	$bibliography = $_POST['bibliography'];
	$research_level = $_POST['research_level'];
	$methodology_researched = $_POST['methodology_researched'];
	$practice_investigated = $_POST['practice_investigated'];
	$benefit = $_POST['benefit'];
	$context = $_POST['context'];
	$result = $_POST['result'];
	$integrity = $_POST['integrity'];
	$research_question = $_POST['research_question'];
	$research_method = $_POST['research_method'];
	$research_metrics = $_POST['research_metrics'];
	$participants = $_POST['participants'];
	
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
		$results = mysqli_query($link, "SELECT PAPER_LINK FROM PAPER WHERE PAPER_ID LIKE '".$paper_id."'");
		$paper_link = mysqli_fetch_array($results)[0];
		$query = "INSERT INTO SERLER VALUES('".$paper_id."','".$user_name."','','".$paper_name."','".$paper_link."','"
					.$bibliography."','".$research_level."','".$methodology_researched."','"
					.$practice_investigated."','".$benefit."','".$context."','".$result."','"
					.$integrity."','".$research_question."','".$research_method."','".$research_metrics."','"
					.$participants."')";
		if(!mysqli_query($link, $query)){
			$output = 'Error inputting into SERLER table.';
			echo $output;
			header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
			$output = 'Returning to homepage in 3 seconds...';
			echo "<br/>";
			echo $output;
		}else{
			$output = 'Successfully inputted metadata.';
			echo $output;
			header('Refresh: 3; URL=homepage.php?user_name='.$user_name);
			$output = 'Returning to homepage in 3 seconds...';
			echo "<br/>";
			echo $output;
		}
	}
	
	mysqli_close($link);

}

?>