<?php

// Filename: updateresult.php
// Date: 14-04-2020
// Author: Elmass El Mokaddem
// Copyright: (C) 2020 Elmass

$id = $_POST['id'];

include("database/config.php");
include("database/opendb.php");


if(isset($_POST['firstname']) || $_POST['firstname']=="") {
    $firstname = $_POST['firstname'];
}

if(isset($_POST['lastname']) || $_POST['lastname']=="") {
    $lastname = $_POST['lastname'];
}

if(isset($_POST['email']) || $_POST['email']=="") {
    $email = $_POST['email'];
}

if(isset($_POST['password']) || $_POST['password']=="") {
    $password = $_POST['password'];
}

if(isset($_POST['pillows']) || $_POST['pillows']=="") {
    $pillows = $_POST['pillows'];
}

if(isset($_POST['hobbies']) || $_POST['hobbies']=="") {
    $hobbies = $_POST['hobbies'];
}

if(isset($_POST['description']) || $_POST['description']=="") {
    $description = $_POST['description'];
}


$query =  "UPDATE persons ";
$query .= "SET firstname = ?, lastname = ?, email = ?, password = ?, pillows = ?, hobbies = ?, description = ? ";
$query .= "WHERE id = ? ";

$preparedquery = $dbaselink ->prepare($query);
$preparedquery->bind_param("ssssiisi", $firstname, $lastname, $email, $password, $pillows, $hobbies, $description, $id);
$preparedquery->execute();

if ($preparedquery->errno){
 echo "Er is een fout opgetreden. Verwijderen is mislukt.";
} else {
 echo "Gebruiker " . $id . " is gewijzigd. <br>";
}

echo"<a href='overview.php'>Terug naar overview</a>";

$preparedquery->close();


include("database/closedb.php");

?>