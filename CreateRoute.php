<?php
//localhost/kletterhalle/createRoute.php?route_name=test&level=1

// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("route_name", $_GET))	{
	$route_name = $_GET["route_name"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No challenge name selected";
        return 0;
}

if (array_key_exists("level", $_GET))	{
	$level = $_GET["level"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No description selected";
        return 0;
}

// 2) GENERATE SQL STATEMENT
$query = "INSERT INTO route(name, level) VALUES ('$route_name', '$level')";

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