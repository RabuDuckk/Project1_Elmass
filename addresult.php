<?php

// Filename: addresult.php
// Date: 29-03-2020
// Author: Elmass El Mokaddem
// Copyright: (C) 2020 Elmass


include("database/config.php");
include("database/opendb.php");


$query = "SELECT MAX(id) AS maxid ";
$query .= "FROM persons ";

$preparedquery = $dbaselink->prepare($query);
$preparedquery->execute();

if ($preparedquery->errno) {
echo "Fout bij uitvoeren commando, probeer het later nogmaals.";
}

$result = $preparedquery->get_result();

$maxId = 0;

while ($row = mysqli_fetch_array($result)) {
 $maxId = $row["maxid"];
}

$preparedquery->close();

$currentId = $maxId + 1;


$query = "INSERT INTO persons ";
$query .= "(id, firstname, lastname, email, password, hobbies, pillows,
description) ";
$query .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?) ";

$preparedquery = $dbaselink->prepare($query);

$preparedquery->bind_param("isssssss", $currentId, $firstname, $lastname,
$email, $password, $hobbies, $pillows, $description);

$preparedquery->execute();

if ($preparedquery->errno){
    echo "Er is een fout opgetreden. Verwerking afgebroken.";
} else {
    echo "Toegevoegd gebruiker met nummer " . $currentId;
  }

$preparedquery->close();

include("database/closedb.php");

?>