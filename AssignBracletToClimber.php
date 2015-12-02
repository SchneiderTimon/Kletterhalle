<?php
//http://localhost/kletterhalle/AssignBracletToClimber.php?braceletid=2&climber=71
//
// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("braceletid", $_GET))	{
	$braceletid = $_GET["braceletid"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No braceletid selected";
        return 0;
}

if (array_key_exists("climber", $_GET))	{
	$climber = $_GET["climber"];
} else	{
	// TODO: maybe have some more appropriate behaviour here
	echo "No climber selected";
        return 0;
}

$date = date('d.m.Y', time());
echo $date;
// 2) GENERATE SQL STATEMENT
$query = "INSERT INTO lease(braceletid, date, fkclimber) VALUES ('$braceletid', '$date', '$climber')";

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
    echo "BraceletID = $braceletid, Climber = $climber and Date = $date is added to lease";
}

$result = array();

?>