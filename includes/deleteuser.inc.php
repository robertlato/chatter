<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'db.inc.php';
require_once 'functions.inc.php';

$userEmail = $_SESSION['email'];

if (deleteUser($connection, $userEmail)) {
    // jezeli uzytkownik zaktualizowal swoje zdjecie profilowe to je usun
    if ($_SESSION['img'] !== 'defaultpicture.jpg') {
        $fname = "../img/".$_SESSION['img'];
        unlink($fname);
    }
    session_unset();
    session_destroy();
    header("Location: /templates/login.php?userdeleted");
    exit();
} else {
    header("Location: /templates/deleteuser.php?error=deletionfail");
    exit();
}

?>