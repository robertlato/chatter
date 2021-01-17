<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    session_start();

    // todo sprawdz czy uzytkownik jest uprawniony do tego zapytania
//    if ((isset($_SESSION['id']))) {
//        if(filter_has_var(INPUT_GET, 'senderID')) {
            $senderID = htmlspecialchars($_GET['senderID']);
//            if ($_SESSION['id'] === $senderID) {

                $recipientID = htmlspecialchars($_GET['recipientID']);

                require_once 'db.inc.php';
                require_once 'functions.inc.php';

                $result = loadConversation($connection, $senderID, $recipientID);

                echo json_encode($result);
//            }
//        }
//    }
?>