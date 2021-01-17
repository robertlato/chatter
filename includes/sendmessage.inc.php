<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // sprawdz czy przeslano dane
    if(filter_has_var(INPUT_POST, 'message')) {

        // zapisz dane
        $message = htmlspecialchars($_POST['message']);
        $senderID = htmlspecialchars($_POST['senderID']);
        $recipientID = htmlspecialchars($_POST['recipientID']);

        // polacz z baza danych

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        sendmessage($connection, $senderID, $recipientID, $message);



    } else {
        header("Location: /templates/editprofile.php");
        exit();
    }

?>