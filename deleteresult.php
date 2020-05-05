<?php

// Filename: deleteresult.php
// Date: 06-04-2020
// Author: Elmass El Mokaddem
// Copyright: (C) 2020 Elmass



$id = $_GET['id'];

include("database/config.php");
include("database/opendb.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
echo "Het verwijderen van de gebruiker is mislukt.";
}

$query = "DELETE FROM persons ";
$query .= "WHERE id = ?";

$preparedquery = $dbaselink ->prepare($query);
$preparedquery->bind_param("i", $id);
$preparedquery->execute();

if ($preparedquery->errno){
 echo "Er is een fout opgetreden. Verwijderen is mislukt.";
} else {
 echo "Gebruiker " . $id . " is verwijderd. <br>";
}

echo"<a href='overview.php'>Terug naar overview</a>";

$preparedquery->close();


include("database/closedb.php");

?>