<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['id'])) {
    $myID = $_SESSION['id'];

    if (filter_has_var(INPUT_POST, 'status')) {

        // zapisz dane
        $status = htmlspecialchars($_POST['status']);
        $recipientID = htmlspecialchars($_POST['recipientID']);


        // polacz z baza danych

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        $result = setInvitationResponse($connection, $myID, $recipientID, $status);

        echo json_encode($result);
    }
}

?>