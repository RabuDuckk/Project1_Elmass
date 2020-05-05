<?php

// Filename: overview.php
// Date: 23-03-2020
// Author: Elmass El Mokaddem
// Copyright: (C) 2020 Elmass



include("database/config.php");
include("database/opendb.php");


function fullname($row) {
    $fullname = $row['firstname'] . " ";
    $fullname .= $row['lastname'];
    return $fullname;
}


$query = "SELECT id, firstname, lastname, email, hobbies, pillows ";
$query .= "FROM persons";


$preparedquery = $dbaselink->prepare($query);
    // $preparedquery->bind_param("s",?);
$preparedquery->execute();


    if ($preparedquery->errno) {
        echo "fout bij uitvoeren van commando";
    } else {
        $result = $preparedquery->get_result();
        if ($result->num_rows === 0) {
            echo "Geen rijen gevonden";
        } else {
            while ($row = $result->fetch_assoc()) {
                echo fullname($row) . " " ;
                echo $row['email'];
                
                if ($row['hobbies'] >= 3) {
                    echo "*";                
                } else {
                    echo $row['hobbies'];
                }
                
                if ($row['pillows'] == 0) {
                    echo "*";                
                } else {
                    echo $row['pillows'];
                }
                
                echo "<a href=\"details.php?id=" . $row['id'] . "\">" . $row['firstname'] . " " . $row['lastname'] . "</a>";
                echo " &nbsp" . "<a href=\"deleteconfirm.php?id=" . $row["id"] . " \">" . "verwijder</a>";
                echo " " . "<a href=\"updateform.php?id=" . $row["id"] . " \">" . "wijzig</a>";
                echo "<br>";
            }
        }
    }

$preparedquery->close();

    echo "<a href=\"index.html\">Index HTML</a>" . "<br>";
    echo "<a href=\"addform.html\">Voeg persoon toe</a>";

include("database/closedb.php");
?>