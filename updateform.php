<?php


// Filename: updateform.php
// Date: 14-04-2020
// Author: Elmass El Mokaddem
// Copyright: (C) 2020 Elmass


$id = $_GET['id'];


include("database/config.php");
include("database/opendb.php");


if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
echo "Het wijzigen van deze gebruiker is mislukt.";
}


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
$row = $result->fetch_assoc();


$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$password = $row['password'];
$hobbies = $row['hobbies'];
$pillows = $row['pillows'];
$description = $row['description'];          

include("database/closedb.php");
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wijzig Gegevens</title>
    </head>
    <body>
            <form action="updateresult.php" method="POST">
                <table>
                    <tr>  
                    <td></td>
                    <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
                </tr>
                <tr>
                    <td>Voornaam</td>
                    <td><input type="text" name="firstname" value="<?php echo $firstname;?>"></td>
                </tr>
                <tr>
                    <td>Achternaam</td>
                    <td><input type="text" name="lastname" value="<?php echo $lastname;?>"></td>
                </tr>
                <tr>
                    <td>Email adres</td>
                    <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                </tr>
                <tr>
                    <td>Wachtwoord</td>
                    <td><input type="text" name="password" value="<?php echo $password;?>"></td>
                </tr>
                <tr>
                    <td>Aantal hobby's</td>
                    <td><input type="text" name="hobbies" value="<?php echo $hobbies;?>"></td>
                </tr>
                <tr>
                    <td>Aantal kussens</td>
                    <td><input type="text" name="pillows" value="<?php echo $pillows;?>"></td>
                </tr>
                <tr>
                    <td>Omschrijving</td>
                    <td><input type="text" name="description" value="<?php echo $description;?>"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Wijzig"></td>
                </tr>
            </table>
        </form>        
        <br>
        <a href="overview.php">Terug naar overview</a> 
    </body>
</html>