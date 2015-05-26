<?php

$hostname = 'localhost'; // Replace with host name
$username = 'root'; // Replace with user name
$password = ''; // Replace with password
$database = 'serler'; // Replace with database
$link = mysqli_connect($hostname, $username, $password);
$query = '';

// Check if connection can be established
if(!$link){
	$output = 'Unable to connect to the server.';
	echo $output;
	exit();
}

// Check if database exists
if(!mysqli_select_db($link, $database)){
	$output = 'Database does not exist.';
	echo $output;
	exit();
}

// Create USER table if not present
$test = mysqli_query($link, 'SELECT 1 FROM USER');
if($test==FALSE){
	$query = "CREATE TABLE USER(
				user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				user_name VARCHAR(25) NOT NULL UNIQUE,
				user_password VARCHAR(15) NOT NULL,
				user_email VARCHAR(50) NOT NULL,
				user_date_registered DATETIME NOT NULL,
				user_date_modified DATETIME,
				user_is_mod BOOLEAN,
				user_is_admin BOOLEAN)";
	if(!mysqli_query($link, $query)){
		$output = 'Error creating USER table. ' . mysqli_error($link);
		echo $output;
		exit();
	}
}

// Create PAPER table if not present
$test = mysqli_query($link, 'SELECT 1 FROM PAPER');
if($test==FALSE){
	$query = "CREATE TABLE PAPER(
				paper_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				paper_link VARCHAR(255) NOT NULL,
				paper_user_name VARCHAR(25),
				paper_date_submitted DATETIME)";
	if(!mysqli_query($link, $query)){
		$output = 'Error creating PAPER table. ' . mysqli_error($link);
		echo $output;
		exit();
	}
}

// Create SERLER table if not present
$test = mysqli_query($link, 'SELECT 1 FROM SERLER');
if($test==FALSE){
	$query = "CREATE TABLE SERLER(
				paper_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				paper_submitter_name VARCHAR(25),
				paper_moderator_name VARCHAR(25),
				paper_name VARCHAR(255),
				paper_link VARCHAR(255) NOT NULL,
				paper_bibliography VARCHAR(255) NOT NULL,
				paper_research_level ENUM('Beginner', 'Medium', 'Expert'),
				paper_methodology_researched ENUM('Agile', 'Extreme', 'Kanban', 'Pair', 'Scrum', 'Test', 'Waterfall'),
				paper_practice_investigated ENUM ('Planning', 'Refactoring', 'Testing'),
				paper_benefit VARCHAR(255),
				paper_context VARCHAR(255),
				paper_result VARCHAR(255),
				paper_integrity VARCHAR(255),
				paper_research_question VARCHAR(255),
				paper_research_method ENUM('Documents', 'Interviews', 'Surveys'),
				paper_research_metrics VARCHAR(255),
				paper_participants ENUM('Positive', 'Negative'))";
	if(!mysqli_query($link, $query)){
		$output = 'Error creating SERLER table. ' . mysqli_error($link);
		echo $output;
		exit();
	}
}

mysqli_close($link);

?>