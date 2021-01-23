<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// sprawdz czy przeslano dane
if(filter_has_var(INPUT_GET, 'recipientID')) {

    session_start();
    // zapisz dane
    $senderID = $_SESSION['id'];
    $recipientID = htmlspecialchars($_GET['recipientID']);

    // polacz z baza danych

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    addFriend($connection, $senderID, $recipientID);

}
?>