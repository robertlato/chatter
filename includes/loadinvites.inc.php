<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['id'])) {
    $myID = $_SESSION['id'];

    // polacz z baza danych

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    $result = loadInvites($connection, $myID);

    echo json_encode($result);
}

?>