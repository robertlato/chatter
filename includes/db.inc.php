<?php

    $servername = 'localhost';
    $username = 'admin';
    $password = 'projektPW!';
    $dbName = "chatter";

    // utworz polaczenie
    $connection = new mysqli($servername, $username, $password, $dbName);

     //sprawdz polaczenie
    if ($connection->connect_error) {
        echo "Błąd połączenia!";
        die("Błąd połączenia: " . $connection->connect_error);
    }
    //echo "Połączony";


    //phpinfo();
