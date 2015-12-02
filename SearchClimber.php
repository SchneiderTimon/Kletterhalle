<?php

//http://localhost/Kletterhalle3/SearchClimber.php?climbername=Sa
// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("climbername", $_GET)) {
    $climbername = $_GET["climbername"];
} else {
    // TODO: maybe have some more appropriate behaviour here
    echo "No climbername selected";
    return 0;
}
$query = "SELECT * FROM climber c WHERE c.name LIKE '%$climbername%'";

// 3) EXECUTE SQL STATEMENT IN DATABASE
// 3.1) CONNECT TO DATABSE AND CHECK FOR ERRORS
$db = new mysqli("160.85.61.45", "admin", "password", "kletterhalle");
if ($db->connect_errno) {
    die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
}

// 3.2) EXECUTE SQL STATEMENT AND CHECK FOR ERROS
$result_iterator = $db->query($query);
if (!$result_iterator) {
    die("Failed to execute SQL statement \"" . $query . "\": " . $db->error);
}

$result = array();
// 4) READ RESULT (IN CASE OF SELECT STATEMENTS)
$result_tuple = $result_iterator->fetch_assoc();
while ($result_tuple) {
    $result[] = $result_tuple;
    $result_tuple = $result_iterator->fetch_assoc();
}

// 5) PREPARE FOR MUSTACHE (WRAP IN OUTER OBJECT) AND ECHO AS JSON
$result_mustache = array(
    "climbers" => $result
);

$json = json_encode($result_mustache);
header('Content-type: application/json');
echo $json;
?>

