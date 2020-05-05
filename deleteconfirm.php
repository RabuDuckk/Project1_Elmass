<?php

// Filename: deleteconfirm.php
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

echo "Weet je zeker dat je deze persoon wilt verwijderen? <br>";
echo"<a href='deleteresult.php?id=". $id ."'>Ja</a>" . " ";
echo"<a href='overview.php'>Nee</a>";

include("database/closedb.php");

?>