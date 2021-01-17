<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $senderID = htmlspecialchars($_GET['senderID']);
    $recipientID = htmlspecialchars($_GET['recipientID']);
    $lastMessageDate = htmlspecialchars($_GET['lastMessageDate']);

    // polacz z baza danych

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    $result = loadNewMessages($connection, $senderID, $recipientID, $lastMessageDate);

    echo json_encode($result);




?>