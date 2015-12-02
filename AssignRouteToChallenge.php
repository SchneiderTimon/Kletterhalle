<?php
//http://localhost/kletterhalle/assignRouteToChallenge.php?route=22&challenge=6

// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("route", $_GET))	{
	$route = $_GET["route"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No route name selected";
        return 0;
}

if (array_key_exists("challenge", $_GET))	{
	$challenge = $_GET["challenge"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No challenge selected";
        return 0;
}

// 2) GENERATE SQL STATEMENT
$query = "INSERT INTO challengeroute(fkchallenge, fkroute) VALUES ('$challenge', '$route')";

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
}else
{
    echo "Route $route and Challenge $challenge is added to ChallengeRoute";
}

$result = array();

?>