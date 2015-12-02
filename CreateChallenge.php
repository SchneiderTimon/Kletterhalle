<?php
//http://localhost/kletterhalle/createChallenge.php?challenge_name=test&description=hello

// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("challenge_name", $_GET))	{
	$challenge_name = $_GET["challenge_name"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No challenge name selected";
        return 0;
}

if (array_key_exists("description", $_GET))	{
	$description = $_GET["description"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No description selected";
        return 0;
}

// 2) GENERATE SQL STATEMENT
$query = "INSERT INTO challenge(name, description) VALUES ('$challenge_name', '$description')";

// 3) EXECUTE SQL STATEMENT IN DATABASE

// 3.1) CONNECT TO DATABSE AND CHECK FOR ERRORS
$db = new mysqli("160.85.61.45", "admin", "password", "kletterhalle");
if ($db->connect_errno) {
	die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
}

// 3.2) EXECUTE SQL STATEMENT AND CHECK FOR ERROS
$result_iterator = $db->query($query);
if (!$result_iterator)	{
	die("Failed to execute SQL statement \"" . $query . "\": " . $db->error);
}

$result = array();

?>