<?php

$query = "INSERT INTO cities ";
$query .= "VALUES(0, ?, ?, ?) ";

$preparedquery = $dbaselink->prepare($query);

for($i=0;$i<count($cities);$i++) {

    $city = $cities[$i];

    $preparedquery->bind_param('sss', $city[0],$city[1],$city[2]);
    $preparedquery->execute();
    if ($preparedquery->errno) {
        echo "Toevoegen in tabel mislukt";
        exit;
    }
}

$preparedquery->close();


?>