<?php


// Filename: details.php
// Date: 23-03-2020
// Author: Elmass El Mokaddem
// Copyright: (C) 2020 Elmass



$id = $_GET['id'];

include("database/config.php");
include("database/opendb.php");


function getName($firstname, $lastname, $email, $password, $hobbies, $pillows, $description) {
    echo "First name: " . $firstname . "<br>" . "Last name: " . $lastname . "<br>" . "Email: " . $email . "<br>" . "Password: " . $password . "<br>" . "Hobbies (aantal): " . $hobbies . "<br>" . "Pillows (aantal): " . $pillows . "<br>" . "Description: " . $description . "<br>";

    if($hobbies >= 3){
        echo "";
    }

    if($pillows == 0) {
        echo " ";
    }
        
                
};


$query = "SELECT firstname, lastname, email, password, hobbies, pillows, description ";
$query .= "FROM persons ";
$query .= "WHERE id = ? ";


$preparedquery = $dbaselink ->prepare($query);
$preparedquery->bind_param("i", $id);
$preparedquery->execute();

    if ($preparedquery->errno){
        echo "Fout bij uitvoeren commando. Probeer het later nogmaals.";
    }

    $result = $preparedquery->get_result();
        if($result->num_rows === 0) {
            echo "Geen rijen gevonden";
        } else {
            while($row = $result->fetch_assoc()) {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                $password = $row['password'];
                $hobbies = $row['hobbies'];
                $pillows = $row['pillows'];
                $description = $row['description'];
                echo "<br>";
            }
                
            getName($firstname, $lastname, $email, $password, $hobbies, $pillows, $description);
        }


        echo "<br><a href=\"index.html\">Index HTML</a>";


include("database/closedb.php");

?>