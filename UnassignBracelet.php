<?php

//http://localhost/Kletterhalle3/UnassignBracelet.php?braceletid=1&climber=70

// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("braceletid", $_GET)) {
    $braceletid = $_GET["braceletid"];
} else {
    // TODO: maybe have some more appropriate behaviour here
    echo "No braceletid selected";
    return 0;
}

if (array_key_exists("climber", $_GET)) {
    $climber = $_GET["climber"];
} else {
    // TODO: maybe have some more appropriate behaviour here
    echo "No climber selected";
    return 1;
}

    $query = "DELETE FROM lease WHERE braceletid = '$braceletid' AND fkclimber = '$climber'";

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
    } else {
        echo "braceletid $braceletid from climber $climber unassigned";
    }
?>

