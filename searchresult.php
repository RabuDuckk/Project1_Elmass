<?php

// Filename: searchresult.php
// Date: 29-03-2020
// Author: Elmass El Mokaddem
// Copyright: (C) 2020 Elmass



include("database/config.php");
include("database/opendb.php");

if (isset($_POST["hobbies"])) {
    $hobbies= $_POST["hobbies"];
    if ($hobbies == "") {
        echo "Leeg gelaten";
        include("database/closedb.php");
        exit;
    }
} else {
    echo "Er niets opgegeven";
    include("database/closedb.php");
    exit;
} 

$query = "SELECT firstname, lastname ";
$query .= "FROM persons ";
$query .= "WHERE hobbies = \"" . $hobbies . "\"";

$preparedquery = $dbaselink->prepare($query);
$preparedquery->execute();


if ($preparedquery->errno) {
    echo "Fout bij uitvoeren commando";
} else {
    $result = $preparedquery->get_result();
    if ($result->num_rows === 0) {
        echo "Geen rijen gevonden";
    }
}

if (!$result) {
    echo "error bij uitvoeren query". $query . "<br>";
    include("closedb.php");
    exit;
}

$found = false;

while ($row = mysqli_fetch_array($result)) {
    echo $row['firstname'] . " " . $row['lastname'] . "<br>";
    $found = true;
}

if (!$found){
    echo "Geen data gevonden";
}

include("database/closedb.php");
?>