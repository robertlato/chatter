<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    session_start();

    if (isset($_SESSION['id'])) {
            $senderID = htmlspecialchars($_GET['senderID']);
            $recipientID = htmlspecialchars($_GET['recipientID']);

            require_once 'db.inc.php';
            require_once 'functions.inc.php';

            $result = loadConversation($connection, $senderID, $recipientID);

            echo json_encode($result);
    }
?>