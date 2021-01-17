<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


    // polacz z baza danych i sprawdz czy uzytkownik istnieje

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    $result = loadUsers($connection);

    echo json_encode($result);


?>