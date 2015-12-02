<?php

//http://localhost/Kletterhalle3/UploadRouteClimbed.php?climber=70&routes[]=21&routes[]=26
// 1) READ (GET OR POST) PARAMETERS?
if (array_key_exists("climber", $_GET)) {
    $climber = $_GET["climber"];
} else {
    // TODO: maybe have some more appropriate behaviour here
    echo "No climber selected";
    return 0;
}

if (array_key_exists("routes", $_GET)) {
    $routes = $_GET["routes"];
} else {
    // TODO: maybe have some more appropriate behaviour here
    echo "No routes selected";
    return 1;
}

$date = date('d.m.Y', time());



foreach ($routes as $route) {
    // 2) GENERATE SQL STATEMENT
    $query = "INSERT INTO achievement(date, fkclimber, fkroute) VALUES('$date', '$climber', '$route') ";

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
        echo "route $route add to climber $climber on date $date<br>";
    }
}
?>