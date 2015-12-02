<?php
//http://localhost/kletterhalle/getAwards.php?climber=69

// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("climber", $_GET))	{
	$climber = $_GET["climber"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No climber selected";
        return 0;
}

// 2) GENERATE SQL STATEMENT
$query = "SELECT * FROM award a WHERE a.fkclimber = $climber";

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
// 4) READ RESULT (IN CASE OF SELECT STATEMENTS)
$result_tuple = $result_iterator->fetch_assoc();
while ($result_tuple)	{
	$result[] = $result_tuple;
	$result_tuple = $result_iterator->fetch_assoc();
}

// 5) PREPARE FOR MUSTACHE (WRAP IN OUTER OBJECT) AND ECHO AS JSON
$result_mustache = array(
	"challange" => $result
);

$json = json_encode($result_mustache);
header('Content-type: application/json');
echo $json;

?>
