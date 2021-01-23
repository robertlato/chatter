<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (filter_has_var(INPUT_GET, 'userID')) {


    $userID = htmlspecialchars($_GET['userID']);


    // polacz z baza danych

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    $result = loadUserById($connection, $userID);

    echo json_encode($result);
}


?>