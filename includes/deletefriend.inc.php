<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['id'])) {
    $myID = $_SESSION['id'];
    if (filter_has_var(INPUT_GET, 'friendID')) {

        $friendID = htmlspecialchars($_GET['friendID']);

        // polacz z baza danych

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        deteleFriend($connection, $myID, $friendID);
    }
}

?>